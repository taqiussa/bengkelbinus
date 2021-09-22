<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Services Done') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Bengkel Binusa</a></div>
            <div class="breadcrumb-item"><a href="#">Service</a></div>
            <div class="breadcrumb-item"><a href="{{ route('servicedone') }}">Service Done</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.tableservicedone name="servicedone" :model="$service" />
    </div>
</x-app-layout>
