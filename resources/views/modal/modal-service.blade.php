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
                <div class="text-center">
                    <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Add Data Items</h1>
                </div>
                <div class="flex flex-col m-5">
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
                        <div class="flex items-center mb-2">
                            {{-- <div class="relative flex flex-col w-1/3 mx-1 mb-2 text-center border-b border-teal-500">
                                <input wire:model='idservice' type="hidden" id="iditem" class="w-full px-1 py-1 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:teal"/>
                                <select wire:model='customer_id' class="block w-full px-1 py-2 pr-8 leading-tight bg-white border-none appearance-none focus:outline" autofocus>
                                    <option value=""> Customer </option>
                                    @foreach ($customers as $s)
                                    <option value="{{ $s->id }}">{{ $s->nopol }} </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-1 text-gray-700 pointer-events-none">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div> --}}
                            <div class="flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                                <input wire:model='customer' type="text" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none text-uppercase focus:outline" placeholder="Nomor Polisi" aria-label="nopol"/>
                            </div>
                            <div class="flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                                <input wire:model.defer='nama' type="text" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline" placeholder="Nama" aria-label="nama" readonly/>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="relative flex flex-col w-1/3 px-1 mx-1">
                                @error('category_id')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                            <div class="relative flex flex-col w-1/3 px-1 mx-1">
                                @error('item')
                                <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="relative flex flex-col w-1/3 mx-1 mb-2 text-center border-b border-teal-500">
                                <select wire:model='category' class="block w-full px-1 py-2 pr-8 leading-tight bg-white border-none appearance-none focus:outline" autofocus>
                                    <option value="" selected> Category </option>
                                    @foreach ($category_id as $s)
                                    <option value="{{ $s->id }}">{{ $s->category }} </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-1 text-gray-700 pointer-events-none">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
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
                            {{-- <div class="flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                                <input wire:model.defer='item_id' type="text" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline" placeholder="Item" aria-label="item" />
                            </div> --}}
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
                        <div class="flex items-center mb-2">
                            <div class="flex flex-col w-1/3 mx-1 mb-2 text-center border-b border-teal-500">
                                <input wire:model.defer='jumlah' type="number" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" placeholder="Jumlah" aria-label="jumlah" />
                            </div>
                            <div class="flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                                <input wire:model='harga' type="number" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" placeholder="Harga" aria-label="harga" />
                            </div>
                        </div>
                        <div class="my-4">
                            <button wire:click.prevent="store()" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700 focus:outline-none focus:shadow-outline-blue" type="button">
                                Simpan
                            </button>
                            <button wire:click.prevent='hideModal()' class="flex-shrink-0 px-2 py-1 text-sm text-teal-500 bg-gray-200 border-4 border-transparent rounded focus:shadow-outline-blue focus:outline-none hover:bg-gray-300" type="button">
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
