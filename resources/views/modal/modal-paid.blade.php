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
                    <h1 class="my-2 text-2xl font-semibold text-white dark:text-gray-200">Paid</h1>
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
                        <div class="border-red-500">
                            <table class="table">
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
                        <div class="flex py-2 text-2xl border-t border-red-500">
                            <div class="flex flex-col w-1/3 mx-1 text-center">
                                <b>
                                    TOTAL
                                </b>
                            </div>
                            <div class="flex flex-col w-full px-2 mx-1 text-right">
                                <b>
                                    Rp. {{ number_format($grandtotal,0,",",".") }}
                                </b>
                            </div>
                        </div>
                        <div class="my-4">
                            <button wire:click.prevent="print()" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700 focus:outline-none focus:shadow-outline-blue" type="button">
                                Print
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
