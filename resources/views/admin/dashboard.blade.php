@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard Overview</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Statistik performa aplikasi booking stadion.</p>
        </div>
        
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col md:flex-row items-end gap-3">
                
                {{-- Input Tanggal Mulai --}}
                <div>
                    <label for="start_date" class="block mb-1 text-xs font-medium text-gray-700 dark:text-gray-300">Dari Tanggal</label>
                    <input type="date" id="start_date" name="start_date" value="{{ $stats['filter_start'] }}" 
                        onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-pointer">
                </div>

                {{-- Input Tanggal Selesai --}}
                <div>
                    <label for="end_date" class="block mb-1 text-xs font-medium text-gray-700 dark:text-gray-300">Sampai Tanggal</label>
                    <input type="date" id="end_date" name="end_date" value="{{ $stats['filter_end'] }}" 
                        onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-pointer">
                </div>

                {{-- Tombol Reset (Tombol Filter dihapus karena sudah auto-submit) --}}
                <div class="flex gap-2">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-l-4 border-indigo-500 transition hover:shadow-md">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendapatan (Periode Ini)</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                        Rp {{ number_format($stats['pendapatan_total'], 0, ',', '.') }}
                    </h3>
                </div>
                <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-indigo-600 font-semibold bg-indigo-50 dark:bg-indigo-900/20 px-2 py-1 rounded w-fit">
                <span>{{ $stats['label_periode'] }}</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-l-4 border-emerald-500 transition hover:shadow-md">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendapatan Bulan Ini</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                        Rp {{ number_format($stats['pendapatan_bulan_ini'], 0, ',', '.') }}
                    </h3>
                </div>
                <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500">
                <span>{{ \Carbon\Carbon::now()->format('F Y') }}</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-l-4 border-blue-500 transition hover:shadow-md">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendapatan Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                        Rp {{ number_format($stats['pendapatan_hari_ini'], 0, ',', '.') }}
                    </h3>
                </div>
                <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
             <div class="mt-4 flex items-center text-xs text-gray-500">
                <span>{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-l-4 border-amber-500 transition hover:shadow-md">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Booking (Periode)</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                        {{ $stats['total_booking'] }}
                    </h3>
                </div>
                <div class="p-2 bg-amber-50 dark:bg-amber-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-amber-600 font-semibold bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded w-fit">
                <span>{{ $stats['label_periode'] }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Grafik Pendapatan: <span class="text-blue-600 text-sm font-normal">{{ $stats['label_periode'] }}</span></h3>
            </div>
            <div class="relative h-80 w-full">
                <div id="revenueChart"></div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Statistik Database</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                            <span class="text-gray-600 dark:text-gray-300">Total User</span>
                        </div>
                        <span class="font-bold text-gray-900 dark:text-white">{{ $stats['total_user'] }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-gray-600 dark:text-gray-300">Total Stadion</span>
                        </div>
                        <span class="font-bold text-gray-900 dark:text-white">{{ $stats['total_stadion'] }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                 <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informasi Sistem</h3>
                 <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                    <li class="flex justify-between">
                        <span>Laravel:</span> <span class="font-semibold">{{ app()->version() }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span>PHP:</span> <span class="font-semibold">{{ phpversion() }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Status Server:</span> <span class="text-green-500 font-bold">Online</span>
                    </li>
                 </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil data dari Controller
        const labels = {!! $stats['chart_labels'] !!};
        const data = {!! $stats['chart_data'] !!};

        var options = {
            series: [{
                name: 'Pendapatan',
                data: data
            }],
            chart: {
                type: 'bar',
                height: 320,
                fontFamily: 'Figtree, sans-serif',
                toolbar: { show: false }
            },
            colors: ['#3b82f6'], 
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    borderRadius: 4
                },
            },
            dataLabels: { enabled: false },
            stroke: { show: true, width: 2, colors: ['transparent'] },
            xaxis: {
                categories: labels,
                labels: {
                    style: { colors: '#6b7280', fontSize: '12px' }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return "Rp " + new Intl.NumberFormat('id-ID').format(value);
                    },
                    style: { colors: '#6b7280' }
                }
            },
            fill: { opacity: 1 },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "Rp " + new Intl.NumberFormat('id-ID').format(val)
                    }
                }
            },
            grid: {
                borderColor: '#e5e7eb',
                strokeDashArray: 4,
            }
        };

        var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
        chart.render();
    });
</script>
@endsection