<div x-data="{
    selectOpen: false,
    selectedItem: '',
    selectableItems: [
        {
            title: 'Milk',
            value: 'milk',
            disabled: false
        },
        {
            title: 'Eggs',
            value: 'eggs',
            disabled: false
        },
        {
            title: 'Cheese',
            value: 'cheese',
            disabled: false
        },
        {
            title: 'Bread',
            value: 'bread',
            disabled: false
        },
        {
            title: 'Apples',
            value: 'apples',
            disabled: false
        },
        {
            title: 'Bananas',
            value: 'bananas',
            disabled: false
        },
        {
            title: 'Yogurt',
            value: 'yogurt',
            disabled: false
        },
        {
            title: 'Sugar',
            value: 'sugar',
            disabled: false
        },
        {
            title: 'Salt',
            value: 'salt',
            disabled: false
        },
        {
            title: 'Coffee',
            value: 'coffee',
            disabled: false
        },
        {
            title: 'Tea',
            value: 'tea',
            disabled: false
        }
    ],
    selectableItemActive: null,
    selectId: $id('select'),
    selectKeydownValue: '',
    selectKeydownTimeout: 1000,
    selectKeydownClearTimeout: null,
    selectDropdownPosition: 'bottom',
    selectableItemIsActive(item) {
        return this.selectableItemActive && this.selectableItemActive.value==item.value;
    },
    selectableItemActiveNext(){
        let index = this.selectableItems.indexOf(this.selectableItemActive);
        if(index < this.selectableItems.length-1){
            this.selectableItemActive = this.selectableItems[index+1];
            this.selectScrollToActiveItem();
        }
    },
    selectableItemActivePrevious(){
        let index = this.selectableItems.indexOf(this.selectableItemActive);
        if(index > 0){
            this.selectableItemActive = this.selectableItems[index-1];
            this.selectScrollToActiveItem();
        }
    },
    selectScrollToActiveItem(){
        if(this.selectableItemActive){
            activeElement = document.getElementById(this.selectableItemActive.value + '-' + this.selectId)
            newScrollPos = (activeElement.offsetTop + activeElement.offsetHeight) - this.$refs.selectableItemsList.offsetHeight;
            if(newScrollPos > 0){
                this.$refs.selectableItemsList.scrollTop=newScrollPos;
            } else {
                this.$refs.selectableItemsList.scrollTop=0;
            }
        }
    },
    selectKeydown(event){
        if (event.keyCode >= 65 && event.keyCode <= 90) {
            
            this.selectKeydownValue += event.key;
            selectedItemBestMatch = this.selectItemsFindBestMatch();
            if(selectedItemBestMatch){
                if(this.selectOpen){
                    this.selectableItemActive = selectedItemBestMatch;
                    this.selectScrollToActiveItem();
                } else {
                    this.selectedItem = this.selectableItemActive = selectedItemBestMatch;
                }
            }
            
            if(this.selectKeydownValue != ''){
                clearTimeout(this.selectKeydownClearTimeout);
                this.selectKeydownClearTimeout = setTimeout(() => {
                    this.selectKeydownValue = '';
                }, this.selectKeydownTimeout);
            }
        }
    },
    selectItemsFindBestMatch(){
        typedValue = this.selectKeydownValue.toLowerCase();
        var bestMatch = null;
        var bestMatchIndex = -1;
        for (var i = 0; i < this.selectableItems.length; i++) {
            var title = this.selectableItems[i].title.toLowerCase();
            var index = title.indexOf(typedValue);
            if (index > -1 && (bestMatchIndex == -1 || index < bestMatchIndex) && !this.selectableItems[i].disabled) {
                bestMatch = this.selectableItems[i];
                bestMatchIndex = index;
            }
        }
        return bestMatch;
    },
    selectPositionUpdate(){
        selectDropdownBottomPos = this.$refs.selectButton.getBoundingClientRect().top + this.$refs.selectButton.offsetHeight + parseInt(window.getComputedStyle(this.$refs.selectableItemsList).maxHeight);
        if(window.innerHeight < selectDropdownBottomPos){
            this.selectDropdownPosition = 'top';
        } else {
            this.selectDropdownPosition = 'bottom';
        }
    }
}"
x-init="
    $watch('selectOpen', function(){
        if(!selectedItem){ 
            selectableItemActive=selectableItems[0];
        } else {
            selectableItemActive=selectedItem;
        }
        setTimeout(function(){
            selectScrollToActiveItem();
        }, 10);
        selectPositionUpdate();
        window.addEventListener('resize', (event) => { selectPositionUpdate(); });
    });
"
@keydown.escape="if(selectOpen){ selectOpen=false; }"
@keydown.down="if(selectOpen){ selectableItemActiveNext(); } else { selectOpen=true; } event.preventDefault();"
@keydown.up="if(selectOpen){ selectableItemActivePrevious(); } else { selectOpen=true; } event.preventDefault();"
@keydown.enter="selectedItem=selectableItemActive; selectOpen=false;"
@keydown="selectKeydown($event);"
class="relative w-64 ">

<button  x-ref="selectButton" @click="selectOpen=!selectOpen"
    
    class="relative min-h-[38px] flex items-center justify-between w-[215px] py-2 pl-3 pr-10 text-left bg-white border rounded-md shadow-sm cursor-default border-neutral-200/70 focus:outline-none  text-sm">
    <span x-text="selectedItem ? selectedItem.title : 'By Type'" class="truncate">By Type</span>
    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-gray-400"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd"></path></svg>
    </span>
</button>

<ul x-show="selectOpen"
    x-ref="selectableItemsList"
    @click.away="selectOpen = false"
    x-transition:enter="transition ease-out duration-50"
    x-transition:enter-start="opacity-0 -translate-y-1"
    x-transition:enter-end="opacity-100"
    :class="{ 'bottom-0 mb-10' : selectDropdownPosition == 'top', 'top-0 mt-10' : selectDropdownPosition == 'bottom' }"
    class="absolute w-full py-1 mt-1 overflow-auto text-sm bg-white rounded-md shadow-md max-h-56 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
    x-cloak>

    <template x-for="item in selectableItems" :key="item.value">
        <li 
            @click="selectedItem=item; selectOpen=false; $refs.selectButton.focus();"
            :id="item.value + '-' + selectId"
            :data-disabled="item.disabled"
            :class="{ 'bg-neutral-100 text-gray-900' : selectableItemIsActive(item), '' : !selectableItemIsActive(item) }"
            @mousemove="selectableItemActive=item"
            class="relative flex items-center h-full py-2 pl-8 text-gray-700 cursor-default select-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
            <svg x-show="selectedItem.value==item.value" class="absolute left-0 w-4 h-4 ml-2 stroke-current text-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            <span class="block font-medium truncate" x-text="item.title"></span>
        </li>
    </template>

</ul>

</div>