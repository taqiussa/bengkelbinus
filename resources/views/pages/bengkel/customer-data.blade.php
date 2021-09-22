<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Customers') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Bengkel Binusa</a></div>
            <div class="breadcrumb-item"><a href="#">Data</a></div>
            <div class="breadcrumb-item"><a href="{{ route('customer') }}">Data Customers</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.tablecustomer name="customer" :model="$customer" />
    </div>
</x-app-layout>
