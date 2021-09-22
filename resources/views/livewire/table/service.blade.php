<div>
    <x-data-table :data="$data" :model="$services">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama')" role="button" href="#">
                    Nama
                    @include('components.sort-icon', ['field' => 'nama'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nopol')" role="button" href="#">
                    No Polisi
                    @include('components.sort-icon', ['field' => 'nopol'])
                </a></th>
                <th><a wire:click.prevent="sortBy('status')" role="button" href="#">
                    Status
                    @include('components.sort-icon', ['field' => 'status'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($services as $service)
                <tr x-data="window.__controller.dataTableController({{ $service->id }})">
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->customer->nama }}</td>
                    <td>{{ $service->customer->nopol }}</td>
                    <td>{{ $service->status }}</td>
                    <td>{{ $service->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click="edit({{ $service->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
    @if ($isOpen)
    @include('modal.modal-service')
    @endif  
</div>
