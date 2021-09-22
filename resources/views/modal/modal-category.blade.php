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
                    <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Add Category</h1>
                </div>
                <div class="flex flex-col m-5">
                    <form class="w-full">
                        <div class="flex items-center">
                            <div class="relative flex flex-col w-1/3 px-1 mx-1">
                                @error('category')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                @enderror
                            </div>
                        </div>
                        <div class="flex items-center mb-2">
                            <input wire:model='idcategory' type="hidden" id="idcategory" class="w-full px-1 py-1 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:teal"/>
                            <div class="flex flex-col w-1/3 mx-1 mb-2 text-center border-b border-teal-500">
                                <input wire:model='category' type="text" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" placeholder="Category" aria-label="category" autofocus/>
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
