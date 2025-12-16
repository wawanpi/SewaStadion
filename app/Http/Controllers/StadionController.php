<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadion;
use App\Models\User;
use App\Models\PenyewaanStadion; // Pastikan model ini ada
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod; // Import ini penting untuk loop tanggal grafik

class StadionController extends Controller
{
    // ==========================================
    // BAGIAN CRUD STADION (TIDAK BERUBAH)
    // ==========================================

    // Tampilkan semua data stadion
    public function index(Request $request)
    {
        $query = Stadion::query();

        if ($search = $request->input('search')) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('lokasi', 'like', "%{$search}%");
        }

        $stadions = $query->latest()->paginate(10);
        return view('stadion.index', compact('stadions'));
    }

    // Tampilkan form tambah stadion
    public function create()
    {
        return view('stadion.create');
    }

    // Simpan data stadion baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = [
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('stadion_foto', 'public');
            $data['foto'] = $path;
        }

        Stadion::create($data);

        return redirect()->route('stadion.index')->with('success', 'Stadion berhasil ditambahkan');
    }

    // Tampilkan form edit stadion
    public function edit($id)
    {
        $stadion = Stadion::findOrFail($id);
        return view('stadion.edit', compact('stadion'));
    }

    // Update data stadion
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $stadion = Stadion::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            if ($stadion->foto && Storage::disk('public')->exists($stadion->foto)) {
                Storage::disk('public')->delete($stadion->foto);
            }

            $path = $request->file('foto')->store('stadion_foto', 'public');
            $data['foto'] = $path;
        }

        $stadion->update($data);

        return redirect()->route('stadion.index')->with('success', 'Data stadion berhasil diupdate');
    }

    // Hapus data stadion
    public function destroy($id)
    {
        $stadion = Stadion::findOrFail($id);

        if ($stadion->foto && Storage::disk('public')->exists($stadion->foto)) {
            Storage::disk('public')->delete($stadion->foto);
        }

        $stadion->delete();

        return redirect()->route('stadion.index')->with('success', 'Data stadion berhasil dihapus');
    }

    // ==========================================
    // LOGIKA DASHBOARD ADMIN (SMART CHART FIX)
    // ==========================================
    
    public function showDashboard(Request $request)
    {
        $user = Auth::user();

        // 1. JIKA ADMIN
        if ($user->is_admin) {
            
            // Konfigurasi Status (Sesuai Database Anda)
            $statusPaid = 'Selesai'; 

            // --- A. SETUP FILTER TANGGAL ---
            $startDate = $request->input('start_date') 
                ? Carbon::parse($request->input('start_date'))->startOfDay() 
                : Carbon::now()->subDays(6)->startOfDay();

            $endDate = $request->input('end_date') 
                ? Carbon::parse($request->input('end_date'))->endOfDay() 
                : Carbon::now()->endOfDay();

            // --- B. HITUNG STATISTIK FIX (TIDAK TERPENGARUH FILTER) ---
            
            // 1. Pendapatan Hari Ini
            $todayRevenue = PenyewaanStadion::where('status', $statusPaid)
                ->whereDate('created_at', Carbon::today())
                ->sum('harga'); 

            // 2. Pendapatan Bulan Ini
            $monthlyRevenue = PenyewaanStadion::where('status', $statusPaid)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('harga'); 

            // --- C. HITUNG STATISTIK DINAMIS (TERPENGARUH FILTER) ---

            // 3. Pendapatan Berdasarkan Filter Range (Periode Ini)
            $filteredRevenue = PenyewaanStadion::where('status', $statusPaid)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('harga'); 

            // 4. Total Booking Berdasarkan Filter Range
            $filteredBooking = PenyewaanStadion::whereBetween('created_at', [$startDate, $endDate])
                ->count(); 

            // --- D. DATA CHART DINAMIS (SMART LOGIC) ---
            $chartData = [];
            $chartLabels = [];
            
            // Hitung selisih hari untuk menentukan mode grafik
            $diffInDays = $startDate->diffInDays($endDate);

            if ($diffInDays > 31) {
                // KASUS 1: JIKA RENTANG > 31 HARI -> TAMPILKAN PER BULAN
                // Loop per bulan
                $period = CarbonPeriod::create($startDate, '1 month', $endDate);

                foreach ($period as $date) {
                    $monthStart = $date->copy()->startOfMonth();
                    $monthEnd = $date->copy()->endOfMonth();

                    // Pastikan tidak melebihi range yang dipilih user (clamping)
                    if ($monthStart < $startDate) $monthStart = $startDate;
                    if ($monthEnd > $endDate) $monthEnd = $endDate;

                    $revenue = PenyewaanStadion::where('status', $statusPaid)
                        ->whereBetween('created_at', [$monthStart, $monthEnd])
                        ->sum('harga');
                    
                    $chartLabels[] = $date->format('M Y'); // Label: Jan 2025
                    $chartData[] = $revenue;
                }

            } else {
                // KASUS 2: JIKA RENTANG <= 31 HARI -> TAMPILKAN PER HARI
                $period = CarbonPeriod::create($startDate, $endDate);

                foreach ($period as $date) {
                    // Hitung pendapatan per tanggal
                    $revenue = PenyewaanStadion::where('status', $statusPaid)
                        ->whereDate('created_at', $date)
                        ->sum('harga'); 
                    
                    $chartLabels[] = $date->format('d M'); // Label: 12 Jan
                    $chartData[] = $revenue;
                }
            }

            // --- E. PACKING DATA UNTUK VIEW ---
            $stats = [
                'total_user' => User::count(),
                'total_stadion' => Stadion::count(),
                
                // Data Dinamis
                'total_booking' => $filteredBooking,
                'pendapatan_total' => $filteredRevenue,
                
                // Data Statis
                'pendapatan_hari_ini' => $todayRevenue,
                'pendapatan_bulan_ini' => $monthlyRevenue,
                
                // Chart
                'chart_labels' => json_encode($chartLabels),
                'chart_data' => json_encode($chartData),
                
                // Info Filter
                'filter_start' => $startDate->format('Y-m-d'),
                'filter_end' => $endDate->format('Y-m-d'),
                'label_periode' => $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y'),
            ];

            return view('admin.dashboard', compact('stats'));
        }

        // 2. JIKA USER BIASA
        $query = Stadion::query();

        if ($search = $request->input('search')) {
            $query->where('nama', 'like', "%{$search}%");
        }

        $stadions = $query->latest()->paginate(6); 

        return view('user.dashboard', compact('stadions'));
    }
}