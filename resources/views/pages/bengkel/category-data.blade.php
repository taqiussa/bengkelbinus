<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Categories') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Bengkel Binusa</a></div>
            <div class="breadcrumb-item"><a href="#">Data</a></div>
            <div class="breadcrumb-item"><a href="{{ route('category') }}">Data Categories</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.tablecategory name="category" :model="$category" />
    </div>
</x-app-layout>
