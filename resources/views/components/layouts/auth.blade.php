@props(['title'])

<x-layouts.app :title="$title">
    <div class="relative min-h-screen flex items-center justify-center bg-gray-900 text-white overflow-hidden">
        {{-- Background Effects --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-gray-900 to-black animate-gradient-xy"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,_rgba(30,200,150,0.1),_transparent_40%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_30%,_rgba(241,196,15,0.1),_transparent_40%)]"></div>
        </div>

        {{-- Centered Content Slot --}}
        <main class="relative z-10 w-full max-w-md px-4">
            {{ $slot }}
        </main>
    </div>
</x-layouts.app>
