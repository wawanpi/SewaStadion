@props(['icon', 'title'])

<div class="text-center bg-white dark:bg-gray-700 p-6 rounded-lg shadow hover:shadow-xl transition">
    <div class="mx-auto mb-4 w-12 h-12 rounded-full bg-five dark:bg-third flex items-center justify-center">
        <img src="{{ asset('img/layanan/' . $icon) }}" class="w-6 h-6" />
    </div>
    <h4 class="text-xl font-bold dark:text-white">{{ $title }}</h4>
    <p class="text-gray-500 mt-2 dark:text-gray-300">
        {{ $slot }}
    </p>
</div>
