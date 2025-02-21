<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<div x-data="{
    dropdownOpen: false
}"
class="relative ">

<button @click="dropdownOpen=true" class="inline-flex items-center justify-center h-10 px-8 py-4 text-sm font-medium transition-colors bg-custom-kcolor text-white border rounded-md hover:bg-custom-lblue active:bg-custom-lblue focus:bg-custom-lblue focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">FILTER</button>


<div x-show="dropdownOpen" 
    @click.away="dropdownOpen=false"
    x-transition:enter="ease-out duration-200"
    x-transition:enter-start="-translate-y-2"
    x-transition:enter-end="translate-y-0"
    class="absolute top-0  right-0.5 z-50 w-56 mt-12  "
    x-cloak>
    <div class="p-1 mt-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
        
        <div x-data="{
            selectOpen: false,
            selectedItem: { title: 'By Type', value: '' },
            selectableItems: [
                { title: 'By Type', value: '' },
                { title: 'In-Person', value: 'In-Person', disabled: false },
                { title: 'Virtual', value: 'Virtual', disabled: false }
            ],
            selectableItemActive: null,
            selectId: $id('select'),
            selectKeydownValue: '',
            selectKeydownTimeout: 1000,
            selectKeydownClearTimeout: null,
            selectDropdownPosition: 'bottom',
            selectableItemIsActive(item) {
                return this.selectableItemActive && this.selectableItemActive.value === item.value;
            },
            selectableItemActiveNext(){
                let index = this.selectableItems.indexOf(this.selectableItemActive);
                if(index < this.selectableItems.length - 1){
                    this.selectableItemActive = this.selectableItems[index + 1];
                    this.selectScrollToActiveItem();
                }
            },
            selectableItemActivePrevious(){
                let index = this.selectableItems.indexOf(this.selectableItemActive);
                if(index > 0){
                    this.selectableItemActive = this.selectableItems[index - 1];
                    this.selectScrollToActiveItem();
                }
            },
            selectScrollToActiveItem(){
                if(this.selectableItemActive){
                    let activeElement = document.getElementById(this.selectableItemActive.value + '-' + this.selectId);
                    let newScrollPos = (activeElement.offsetTop + activeElement.offsetHeight) - this.$refs.selectableItemsList.offsetHeight;
                    this.$refs.selectableItemsList.scrollTop = newScrollPos > 0 ? newScrollPos : 0;
                }
            },
            selectKeydown(event){
                if(event.keyCode >= 65 && event.keyCode <= 90){
                    this.selectKeydownValue += event.key;
                    let selectedItemBestMatch = this.selectItemsFindBestMatch();
                    if(selectedItemBestMatch){
                        if(this.selectOpen){
                            this.selectableItemActive = selectedItemBestMatch;
                            this.selectScrollToActiveItem();
                        } else {
                            this.selectedItem = this.selectableItemActive = selectedItemBestMatch;
                        }
                    }
                    if(this.selectKeydownValue !== ''){
                        clearTimeout(this.selectKeydownClearTimeout);
                        this.selectKeydownClearTimeout = setTimeout(() => {
                            this.selectKeydownValue = '';
                        }, this.selectKeydownTimeout);
                    }
                }
            },
            selectItemsFindBestMatch(){
                let typedValue = this.selectKeydownValue.toLowerCase();
                let bestMatch = null;
                let bestMatchIndex = -1;
                for(let i = 0; i < this.selectableItems.length; i++){
                    let title = this.selectableItems[i].title.toLowerCase();
                    let index = title.indexOf(typedValue);
                    if(index > -1 && (bestMatchIndex === -1 || index < bestMatchIndex) && !this.selectableItems[i].disabled){
                        bestMatch = this.selectableItems[i];
                        bestMatchIndex = index;
                    }
                }
                return bestMatch;
            },
            selectPositionUpdate(){
                let selectDropdownBottomPos = this.$refs.selectButton.getBoundingClientRect().top 
                    + this.$refs.selectButton.offsetHeight 
                    + parseInt(window.getComputedStyle(this.$refs.selectableItemsList).maxHeight);
                this.selectDropdownPosition = window.innerHeight < selectDropdownBottomPos ? 'top' : 'bottom';
            }
        }" 
        x-init="
            // Set up the UI watchers
            $watch('selectOpen', function(){
                if(!selectedItem){
                    selectableItemActive = selectableItems[0];
                } else {
                    selectableItemActive = selectedItem;
                }
                setTimeout(function(){
                    selectScrollToActiveItem();
                }, 10);
                selectPositionUpdate();
                window.addEventListener('resize', (event) => { selectPositionUpdate(); });
            });
            // Watch for changes in selectedItem and update the query string (for 'filter')
            $watch('selectedItem', value => {
                let params = new URLSearchParams(window.location.search);
                if(value && value.value !== ''){
                    params.set('filter', value.value);
                } else {
                    params.delete('filter');
                }
                window.location.search = params.toString();
            });
        " 
        @keydown.escape="if(selectOpen){ selectOpen = false; }"
        @keydown.down="if(selectOpen){ selectableItemActiveNext(); } else { selectOpen = true; } event.preventDefault();"
        @keydown.up="if(selectOpen){ selectableItemActivePrevious(); } else { selectOpen = true; } event.preventDefault();"
        @keydown.enter="selectedItem = selectableItemActive; selectOpen = false;"
        @keydown="selectKeydown($event);"
        class="relative w-64 ">
        
          <button x-ref="selectButton" @click="selectOpen = !selectOpen"
                  class="relative min-h-[38px] flex items-center justify-between w-[215px] py-2 pl-3 pr-10 text-left bg-white border rounded-md shadow-sm cursor-default border-neutral-200/70 focus:outline-none text-sm">
            <span x-text="selectedItem ? selectedItem.title : 'By Type'" class="truncate">By Type</span>
            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-gray-400">
                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
              </svg>
            </span>
          </button>
        
          <ul x-show="selectOpen"
              x-ref="selectableItemsList"
              @click.away="selectOpen = false"
              x-transition:enter="transition ease-out duration-50"
              x-transition:enter-start="opacity-0 -translate-y-1"
              x-transition:enter-end="opacity-100"
              :class="{ 'bottom-0 mb-10': selectDropdownPosition == 'top', 'top-0 mt-10': selectDropdownPosition == 'bottom' }"
              class="absolute w-full py-1 mt-1 overflow-auto text-sm bg-white rounded-md shadow-md max-h-56 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
              x-cloak>
            <template x-for="item in selectableItems" :key="item.value">
              <li @click="selectedItem = item; selectOpen = false; $refs.selectButton.focus();"
                  :id="item.value + '-' + selectId"
                  :data-disabled="item.disabled"
                  :class="{ 'bg-neutral-100 text-gray-900': selectableItemIsActive(item) }"
                  @mousemove="selectableItemActive = item"
                  class="relative flex items-center h-full py-2 pl-8 text-gray-700 cursor-default select-none hover:bg-gray-100">
                <svg x-show="selectedItem.value == item.value" class="absolute left-0 w-4 h-4 ml-2 stroke-current text-neutral-400"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span class="block font-medium truncate" x-text="item.title"></span>
              </li>
            </template>
          </ul>
        </div>
        
        
        
       {{-- SELECT END --}}
        <div class="h-px my-1 -mx-1 bg-neutral-100"></div>
        {{-- SELECT START --}}
        <div x-data="{
            selectOpen: false,
            selectedItem: { title: 'By Category', value: '' },
            selectableItems: [
                { title: 'By Category', value: '' },
                { title: 'Seminars and Talks', value: 'Seminars and Talks', disabled: false },
                { title: 'Workshop', value: 'Workshop', disabled: false },
                { title: 'Exhibition', value: 'Exhibition', disabled: false },
                { title: 'Cultural', value: 'Cultural Fest', disabled: false },
                { title: 'Award Ceremonies', value: 'Award Ceremonies', disabled: false },
                { title: 'Festivals', value: 'Festivals', disabled: false },
                { title: 'Annual Day', value: 'Annual Day', disabled: false },
                { title: 'Sports Competition', value: 'Sports Competitions', disabled: false },
                { title: 'Technical Competition', value: 'Technical Competition', disabled: false },
                { title: 'Competition', value: 'Competition', disabled: false },
                { title: 'Hackathon', value: 'Hackathon', disabled: false },
                { title: 'Esports/Gaming', value: 'Esports/Gaming', disabled: false },
                { title: 'Quizzes', value: 'Quizzes', disabled: false },
                { title: 'Community Service', value: 'Community Service', disabled: false },
                { title: 'Awareness Campaigns', value: 'Awareness Campaigns', disabled: false },
                { title: 'Drama and Theater', value: 'Drama and Theater', disabled: false },
                { title: 'Art and Craft', value: 'Art and Craft', disabled: false },
                { title: 'Carnivals and Fairs', value: 'Carnivals and Fairs', disabled: false },
                { title: 'Photography and Videography', value: 'Photography and Videography', disabled: false }
            ],
            selectableItemActive: null,
            selectId: $id('select'),
            selectKeydownValue: '',
            selectKeydownTimeout: 1000,
            selectKeydownClearTimeout: null,
            selectDropdownPosition: 'bottom',
            selectableItemIsActive(item) {
                return this.selectableItemActive && this.selectableItemActive.value === item.value;
            },
            selectableItemActiveNext(){
                let index = this.selectableItems.indexOf(this.selectableItemActive);
                if(index < this.selectableItems.length - 1){
                    this.selectableItemActive = this.selectableItems[index + 1];
                    this.selectScrollToActiveItem();
                }
            },
            selectableItemActivePrevious(){
                let index = this.selectableItems.indexOf(this.selectableItemActive);
                if(index > 0){
                    this.selectableItemActive = this.selectableItems[index - 1];
                    this.selectScrollToActiveItem();
                }
            },
            selectScrollToActiveItem(){
                if(this.selectableItemActive){
                    let activeElement = document.getElementById(this.selectableItemActive.value + '-' + this.selectId);
                    let newScrollPos = (activeElement.offsetTop + activeElement.offsetHeight) - this.$refs.selectableItemsList.offsetHeight;
                    this.$refs.selectableItemsList.scrollTop = newScrollPos > 0 ? newScrollPos : 0;
                }
            },
            selectKeydown(event){
                if(event.keyCode >= 65 && event.keyCode <= 90){
                    this.selectKeydownValue += event.key;
                    let selectedItemBestMatch = this.selectItemsFindBestMatch();
                    if(selectedItemBestMatch){
                        if(this.selectOpen){
                            this.selectableItemActive = selectedItemBestMatch;
                            this.selectScrollToActiveItem();
                        } else {
                            this.selectedItem = this.selectableItemActive = selectedItemBestMatch;
                        }
                    }
                    if(this.selectKeydownValue !== ''){
                        clearTimeout(this.selectKeydownClearTimeout);
                        this.selectKeydownClearTimeout = setTimeout(() => {
                            this.selectKeydownValue = '';
                        }, this.selectKeydownTimeout);
                    }
                }
            },
            selectItemsFindBestMatch(){
                let typedValue = this.selectKeydownValue.toLowerCase();
                let bestMatch = null;
                let bestMatchIndex = -1;
                for(let i = 0; i < this.selectableItems.length; i++){
                    let title = this.selectableItems[i].title.toLowerCase();
                    let index = title.indexOf(typedValue);
                    if(index > -1 && (bestMatchIndex === -1 || index < bestMatchIndex) && !this.selectableItems[i].disabled){
                        bestMatch = this.selectableItems[i];
                        bestMatchIndex = index;
                    }
                }
                return bestMatch;
            },
            selectPositionUpdate(){
                let selectDropdownBottomPos = this.$refs.selectButton.getBoundingClientRect().top 
                    + this.$refs.selectButton.offsetHeight 
                    + parseInt(window.getComputedStyle(this.$refs.selectableItemsList).maxHeight);
                this.selectDropdownPosition = window.innerHeight < selectDropdownBottomPos ? 'top' : 'bottom';
            }
        }" 
        x-init="
            $watch('selectOpen', function(){
                if(!selectedItem){
                    selectableItemActive = selectableItems[0];
                } else {
                    selectableItemActive = selectedItem;
                }
                setTimeout(function(){
                    selectScrollToActiveItem();
                }, 10);
                selectPositionUpdate();
                window.addEventListener('resize', (event) => { selectPositionUpdate(); });
            });
            $watch('selectedItem', value => {
                let params = new URLSearchParams(window.location.search);
                if(value && value.value !== ''){
                    params.set('category', value.value);
                } else {
                    params.delete('category');
                }
                window.location.search = params.toString();
            });
        " 
        @keydown.escape="if(selectOpen){ selectOpen = false; }"
        @keydown.down="if(selectOpen){ selectableItemActiveNext(); } else { selectOpen = true; } event.preventDefault();"
        @keydown.up="if(selectOpen){ selectableItemActivePrevious(); } else { selectOpen = true; } event.preventDefault();"
        @keydown.enter="selectedItem = selectableItemActive; selectOpen = false;"
        @keydown="selectKeydown($event);"
        class="relative w-64 ">
        
          <button x-ref="selectButton" @click="selectOpen = !selectOpen"
                  class="relative min-h-[38px] flex items-center justify-between w-[215px] py-2 pl-3 pr-10 text-left bg-white border rounded-md shadow-sm cursor-default border-neutral-200/70 focus:outline-none text-sm">
            <span x-text="selectedItem ? selectedItem.title : 'By Category'" class="truncate">By Category</span>
            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-gray-400">
                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
              </svg>
            </span>
          </button>
        
          <ul x-show="selectOpen"
              x-ref="selectableItemsList"
              @click.away="selectOpen = false"
              x-transition:enter="transition ease-out duration-50"
              x-transition:enter-start="opacity-0 -translate-y-1"
              x-transition:enter-end="opacity-100"
              :class="{ 'bottom-0 mb-10': selectDropdownPosition == 'top', 'top-0 mt-10': selectDropdownPosition == 'bottom' }"
              class="absolute w-full py-1 mt-1 overflow-auto text-sm bg-white rounded-md shadow-md max-h-56 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
              x-cloak>
            <template x-for="item in selectableItems" :key="item.value">
              <li @click="selectedItem = item; selectOpen = false; $refs.selectButton.focus();"
                  :id="item.value + '-' + selectId"
                  :data-disabled="item.disabled"
                  :class="{ 'bg-neutral-100 text-gray-900': selectedItem.value == item.value }"
                  @mousemove="selectableItemActive = item"
                  class="relative flex items-center h-full py-2 pl-8 text-gray-700 cursor-default select-none hover:bg-gray-100">
                <svg x-show="selectedItem.value == item.value" class="absolute left-0 w-4 h-4 ml-2 stroke-current text-neutral-400"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span class="block font-medium truncate" x-text="item.title"></span>
              </li>
            </template>
          </ul>
        </div>
        
        
        
        
    </div>
</div>
</div>