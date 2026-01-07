<x-admin-layout :currentView="$currentView">
    <div data-aos="fade-up">
        @include('admin.partials.' . $currentView)
    </div>
</x-admin-layout>
