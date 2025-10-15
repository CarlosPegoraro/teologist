
<x-layouts.app :title="'Phrónesis – Sabedoria prática'">
    @include('home.hero-section')
    @include('home.modules')
    <livewire:home.categories />
    @include('home.featured-posts')
</x-layouts.app>
