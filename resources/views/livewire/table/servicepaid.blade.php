<div>
    <x-data-table :data="$data" :model="$services">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a role="button" href="#">
                    No Polisi
                </a></th>
                <th><a role="button" href="#">
                    Nama
                </a></th>
                <th><a wire:click.prevent="sortBy('total')" role="button" href="#">
                    Total
                    @include('components.sort-icon', ['field' => 'total'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th><a wire:click.prevent="sortBy('status')" role="button" href="#">
                    Status
                    @include('components.sort-icon', ['field' => 'status'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($services as $key => $service)
                <tr x-data="window.__controller.dataTableController({{ $service->id }})">
                    <td>{{ $services->firstItem() + $key }}</td>
                    <td>{{ $service->customer->nopol }}</td>
                    <td>{{ $service->customer->nama }}</td>
                    <td>Rp. {{ number_format($service->total,0,",",".") }}</td>
                    <td>{{ $service->created_at->format('d M Y H:i') }}</td>
                    <td><a role="button" wire:click="edit({{ $service->id }})" class="mr-3 btn btn-primary">{{ $service->status }}</a></td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click="editpayment({{ $service->id }})" class="mr-3"><i class="fa fa-16px fa-print"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
    @if ($isOpen)
    @include('modal.modal-servicepaid')
    @endif  
    @if ($isOpens)
    @include('modal.modal-paid')
    @endif  
</div>
