<div>
    <x-data-table :data="$data" :model="$items">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('category')" role="button" href="#">
                    Category
                    @include('components.sort-icon', ['field' => 'category'])
                </a></th>
                <th><a wire:click.prevent="sortBy('item')" role="button" href="#">
                    Item
                    @include('components.sort-icon', ['field' => 'item'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($items as $item)
                <tr x-data="window.__controller.dataTableController({{ $item->id }})">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->category->category }}</td>
                    <td>{{ $item->item }}</td>
                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click="edit({{ $item->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
    @if ($isOpen)
    @include('modal.modal-item')
    @endif  
</div>
