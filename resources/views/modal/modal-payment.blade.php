<div class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>  
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            {{-- End Of Show Modal --}}
            {{-- Your Form Should Inside Down Here --}}
            {{-- Start Of Display Form --}}
            <div class="w-full p-2 mx-1 my-3 bg-white rounded-md shadow-sm">
                <div class="text-center rounded-md bg-danger">
                    <h1 class="my-2 text-2xl font-semibold text-white dark:text-gray-200">Payment</h1>
                </div>
                <div class="px-1 py-1 border-t border-b border-red-500">
                    <button class="flex-shrink-0 px-2 py-1 text-sm text-white bg-blue-500 border-4 border-blue-500 rounded hover:bg-blue-700 hover:border-blue-700 focus:outline-none focus:shadow-outline-blue" type="button">
                        {{ $nopol }}
                    </button>
                    <button class="flex-shrink-0 px-2 py-1 text-sm text-white bg-green-500 border-4 border-green-500 rounded hover:bg-green-700 hover:border-green-700 focus:outline-none focus:shadow-outline-blue" type="button">
                        {{ $nama }}
                    </button>
                </div>
                <div class="flex flex-col m-1">
                    <form class="w-full">
                        <div class="flex items-center">
                            <div class="relative flex flex-col w-1/3 px-1 mx-1">
                                @error('customer_id')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                            <div class="relative flex flex-col w-1/3 px-1 mx-1">
                                @error('nama')
                                <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                        </div>

                        {{-- Add Barang Atau Jasa --}}
                        <div class="flex items-center">
                            <div class="relative flex flex-col w-1/5 px-1 mx-1">
                                @error('category')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                            <div class="relative flex flex-col w-1/4 px-1 mx-1">
                                @error('item')
                                <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                            <div class="relative flex flex-col w-1/6 px-1 mx-1">
                                @error('jumlah')
                                <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                            <div class="relative flex flex-col w-1/4 px-1 mx-1">
                                @error('harga')
                                <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                        </div>
                        <div class="flex items-center mb-2">
                            <input wire:model="idservice" type="hidden" />
                            <div class="relative flex flex-col w-1/5 mx-1 mb-2 text-center border-b border-teal-500">
                                <select wire:model='category' class="block w-full px-1 py-2 pr-8 leading-tight bg-white border-none appearance-none focus:outline" autofocus>
                                    <option value="" selected> Category </option>
                                    @foreach ($categories as $s)
                                    <option value="{{ $s->id }}">{{ $s->category }} </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-1 text-gray-700 pointer-events-none">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="relative flex flex-col w-1/4 mx-1 mb-2 text-center border-b border-teal-500">
                                <select wire:model='item' class="block w-full px-1 py-2 pr-8 leading-tight bg-white border-none appearance-none focus:outline" autofocus>
                                    @if (!is_null($category))
                                    <option value="" selected> Items </option>
                                    @foreach ($items as $s)
                                    <option value="{{ $s->id }}">{{ $s->item }} </option>
                                    @endforeach
                                    @endif
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-1 text-gray-700 pointer-events-none">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex flex-col w-1/6 mx-1 mb-2 text-center border-b border-teal-500">
                                <input wire:model='jumlah' type="number" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" placeholder="Jumlah" aria-label="jumlah" />
                            </div>
                            <div class="flex flex-col w-1/4 mx-1 mb-2 text-center border-b border-teal-500">
                                <input wire:model='harga' type="number" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" placeholder="Harga" aria-label="harga" readonly/>
                            </div>
                            <div class="flex flex-col w-1/12 mx-1 mb-2">
                                <button wire:click.prevent="add()" class="flex-shrink-0 px-1 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700 focus:outline-none focus:shadow-outline-blue" type="button">
                                    Add
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="relative flex flex-col w-1/3 px-1 mx-1">
                                @error('jumlah')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                            <div class="relative flex flex-col w-1/3 px-1 mx-1">
                                @error('harga')
                                <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                        </div>
                        <div class="border-t border-red-500">
                            <table class="table text-sm text-gray-600 table-bordered table-striped table-responsive">
                                <thead>
                                    <th>Item</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </thead>
                                @foreach ($temps as $temp )
                                <tr>
                                    <td>{{ $temp->item->item }}</td>
                                    <td>{{ $temp->jumlah }}</td>
                                    <td class="text-right">{{ $temp->harga }}</td>
                                    <td class="text-right">{{ $temp->total }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="px-4 py-2 text-2xl text-right border-t border-red-500">
                            <b>
                                Rp. {{ number_format($grandtotal,0,",",".") }}
                            </b>
                        </div>
                        <div class="my-4">
                            <button wire:click.prevent="store()" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700 focus:outline-none focus:shadow-outline-blue" type="button">
                                Bayar
                            </button>
                            <button wire:click.prevent='hideModals()' class="flex-shrink-0 px-2 py-1 text-sm text-teal-500 bg-gray-200 border-4 border-transparent rounded focus:shadow-outline-blue focus:outline-none hover:bg-gray-300" type="button">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
                <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
            </div>
            {{-- End Of Display Form --}}
            {{-- Your Form Should Inside Up Here --}}
        </div>
    </div>
</div>
