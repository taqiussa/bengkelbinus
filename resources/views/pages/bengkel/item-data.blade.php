<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Items') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Bengkel Binusa</a></div>
            <div class="breadcrumb-item"><a href="#">Data</a></div>
            <div class="breadcrumb-item"><a href="{{ route('item') }}">Data Items</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.tableitem name="item" :model="$item" />
    </div>
</x-app-layout>
