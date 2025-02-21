
<div x-data="{ modalOpen: false }"
    @keydown.escape.window="modalOpen = false"
    class="relative z-50 w-auto h-auto">
    <button @click="modalOpen=true" class="inline-flex items-center justify-center h-8 px-4 py-2 text-sm font-medium transition-colors bg-custom-lgreen border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-1 disabled:opacity-50 disabled:pointer-events-none">preview</button>
    <template x-teleport="body">
        <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
            <div x-show="modalOpen" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="modalOpen=false" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
            <div x-show="modalOpen"
                x-trap.inert.noscroll="modalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-[350] py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg h-[500]">
                <div class="flex items-center justify-between pb-2 ">
                    <h3 class="text-lg font-semibold">Event Card</h3>
                    <button @click="modalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                    </button>
                </div>
                <div class="relative ">
                    
                    <div class="event_template p-0 bg-white flex flex-col items-start h-[400] transition-transform transform hover:scale-105 hover:translate-y-1 shadow-md rounded-md ">
                        <!-- Event Image -->
                         
                        {{ $image }}
                    
                        <!-- Event Details -->
                        <div class="event_template_details px-4 mt-4 flex flex-col leading-none">
                            
                                <h1 class="event_title text-left font-bold font-teko font-semibold text-2xl m-0 p-0 leading-none cursor-pointer">Event Title </h1>
                            
                            <p class="event_date text-gray-800 font-light font-calibri font-normal m-0 p-0 leading-none mb-1">Category: [category]</p>
                            <p class="event_date text-gray-800 font-light font-calibri font-normal m-0 p-0 leading-none">
                                Mon, May 17, 20XX | 10:00 AM to 2:00 PM
                            </p>
                        </div>
                    
                        <!-- Event Type Section -->
                        <div class="event_type px-4 mt-auto mb-4 flex items-center w-full pt-8">
                            <ion-icon name="person-outline" class="text-gray-600 text-xl mr-2"></ion-icon>
                            <p class="text-gray-600 font-light font-calibri font-normal m-0 p-0 leading-none">Type of Event</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </template>
</div>