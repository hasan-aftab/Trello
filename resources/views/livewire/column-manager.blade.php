<div x-init="console.log('hasan')" x-data="{ columnTitleInputs: @js($columnTitleInputs) }">

    {{-- 1. BOARD WRAPPER: Added 'overflow-x-auto', 'items-start', and a fixed height 'h-[85vh]' --}}
    <div class="mt-4 flex gap-4 overflow-x-auto items-start h-[85vh] p-4" wire:sortable="sortColumn">

        {{-- All Columns --}}
        @foreach ($columns as $column)
            {{-- 2. COLUMN WRAPPER: Added 'shrink-0' (so columns don't squish horizontally) and 'max-h-full' --}}
            <div draggable="true" wire:key="{{ $column->id }}" wire:sortable.item="{{ $column->id }}"
                class="w-72 shrink-0 bg-gray-100 dark:bg-black rounded-lg pb-2 flex flex-col h-full max-h-full text-gray-900 dark:text-white"
                @keydown.esc.window="columnTitleInputs[{{ $column->id }}] = false"
                wire:click.window="$dispatch( 'setcolumnid', { value: {{ $column->id }}} )">

                {{-- Column Upper Block - Note: Removed the wrapping 'flex-grow' div to separate header and body --}}

                {{-- 3. COLUMN HEADER: Added 'shrink-0' so the header never squishes --}}
                <div class="column-header shrink-0">
                    {{-- Column swap icon --}}
                    <div wire:sortable.handle
                        class="text-center text-gray-500 dark:text-slate-400 text-lg font-medium py-1">
                        <i class="fa-solid fa-right-left hover:cursor-pointer px-5"></i>
                    </div>

                    {{-- Column Management --}}
                    <div class="column-management mb-2">
                        <div class="flex justify-between ms-6 w-60 items-center hover:cursor-pointer"
                            x-on:keydown.enter.window.prevent=
                                 "
                                  if (columnTitleInputs[{{ $column->id }}]){
                                   @this.editColumnTitle( {{ $column->id }} )
                                  }
                                 ">
                            <h3 x-show="!columnTitleInputs[{{ $column->id }}]"
                                class="text-lg text-gray-800 dark:text-slate-400 font-extrabold w-full "
                                x-on:click=
                                    "
                                     $nextTick(
                                      () => columnTitleInputs[{{ $column->id }}] && $refs['columnTitleInput_' + {{ $column->id }}].focus()
                                     )
                                     @this.setFocusedColumn({{ $column->id }});
                                     columnTitleInputs[{{ $column->id }}] = !columnTitleInputs[{{ $column->id }}];
                                    ">
                                {{ $column->title }}
                            </h3>

                            <div x-show="columnTitleInputs[{{ $column->id }}]"
                                x-on:hide-column-edit-div.window=
                                     "
                                        $nextTick(() => {
                                           console.log( 'hasan' );
                                          if (columnTitleInputs[{{ $column->id }}]){
                                           columnTitleInputs[{{ $column->id }}] = false;
                                          }
                                        });
                                     "
                                class="flex justify-between w-full items-center gap-2" x-cloak>
                                <input type="text" placeholder="Enter new title..."
                                    x-ref="columnTitleInput_{{ $column->id }}" wire:model="columnTitleInput"
                                    id="column-title-input-field"
                                    class=
                                           "
                                            py-1 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-none rounded-md my-0 px-2 me-3
                                           " />

                                <div x-on:click="columnTitleInputs[{{ $column->id }}] = false"
                                    class="close-btn px-2 py-1 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white font-bold rounded-md hover:bg-gray-400 dark:hover:bg-gray-900 hover:cursor-pointer">
                                    X
                                </div>

                            </div>

                            <i x-show="!columnTitleInputs[{{ $column->id }}]"
                                onclick="{{ str_replace(' ', '', $column->title) }}.showModal()"
                                class=" fa-solid fa-trash text-lg text-gray-500 dark:text-slate-400 hover:cursor-pointer hover:text-red-600 dark:hover:text-red-700">
                            </i>

                        </div>
                    </div>
                </div>

                {{-- 4. COLUMN BODY (Cards): Added 'flex-1', 'overflow-y-auto', and 'min-h-0' --}}
                <div
                    class="column-body flex-1 overflow-y-auto min-h-0 scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-700 pb-2">
                    {{-- Card Management --}}
                    <div class="card-management ms-2 flex flex-col">

                        <div x-parent class="h-full" id="uniqueColumn_{{ $column->id }}" x-data="{ cardDisplay: @js($columnCardIds) }">

                            @foreach ($column->cards as $card)
                                <div x-data="{ dragging: false, active: false }" wire:key="{{ $card->id }}"
                                    x-on:dragover.prevent.stop=""
                                    x-on:drop.prevent.stop=
                                        "
                                         const targetElement = event.target.closest('[x-child]');
                                         const draggedElementCardId = event.dataTransfer.getData('text/plain');
                                         const draggedElement = document.getElementById(draggedElementCardId);

                                         const oldColumnId = draggedElement.getAttribute('column-id');
                                         const newColumnId = targetElement.getAttribute('column-id');

                                         const newColumn = document.getElementById('uniqueColumn_' + newColumnId);
                                         const oldColumn = document.getElementById('uniqueColumn_' + oldColumnId);

                                         targetElement.before(draggedElement);

                                         oldColumnCards = $(oldColumn).find('[x-child]');
                                         newColumnCards = $(newColumn).find('[x-child]');

                                         oldColumnCardIds = [];
                                         oldColumnCards.each(function(){
                                            var oldColumnId = $(this).attr('card-id');
                                         oldColumnCardIds.push(oldColumnId);
                                         });

                                         newColumnCardIds = [];
                                         newColumnCards.each(function(){
                                            var newColumnId = $(this).attr('card-id');
                                         newColumnCardIds.push(newColumnId);
                                         });

                                         dragging=false;
                                         active=false;

                                         const cardRealId = $(draggedElement).attr('card-id');
                                         @this.updateCardPosition({{ $column->id }}, cardRealId, oldColumnCardIds, newColumnCardIds);
                                        ">

                                    <div x-child draggable="true" card-id={{ $card->id }}
                                        column-id={{ $column->id }} position={{ $card->position }}
                                        id="cardDisplay[{{ $card->id }}]"
                                        :class="{ 'border-gray-400 dark:border-gray-800 border': dragging, 'bg-gray-300 dark:bg-slate-400 text-gray-900 dark:text-black': active }"
                                        x-on:dragstart.stop=
                                             "
                                              dragging = true;
                                              event.dataTransfer.effectAllowed='move';
                                              event.dataTransfer.setData('text/plain', event.target.id)
                                              @this.test = true;
                                             "
                                        x-on:dragover.prevent.stop="active=true"
                                        x-on:dragleave.stop="dragging = false; active=false; @this.test = true; "
                                        x-on:dragend.stop="dragging = false; active=false; @this.test = true;"
                                        x-on:dragenter.stop="active = true" x-show="!cardDisplay[{{ $card->id }}]"
                                        x-on:click=
                                             "
                                                       {{ 'openCardModal' . $card->id }}.showModal();
                                                        @this.columnId = {{ $column->id }};
                                                        @this.cardId = {{ $card->id }};
                                                      "
                                        x-on:card-input-title-field.window="cardDisplay[{{ $card->id }}] = false"
                                        class="card-title-block flex justify-between ps-3 w-64 ms-2 rounded-md my-2 py-2 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 border border-gray-200 dark:border-none shadow-sm dark:shadow-none hover:bg-gray-50 dark:hover:bg-black hover:cursor-pointer">
                                        <p class="font-bold">{{ $card->title }}</p>
                                        <i @this.cardTitleId={{ $card->id }};
                                            x-on:click.stop=
                                               "
                                                @this.cardTitleId = {{ $card->id }};
                                                cardDisplay[{{ $card->id }}] = true;
                                                $nextTick(
                                                 () => { cardDisplay[{{ $card->id }}] && $refs['cardDisplay_' + {{ $card->id }}].focus()}
                                                );
                                               "
                                            class=" fa-solid fa-pen-to-square me-2 hover:bg-gray-200 dark:hover:bg-slate-600 rounded-xl p-1 opacity-60 dark:opacity-30 hover:opacity-100 dark:hover:opacity-80 text-gray-500 dark:text-inherit"></i>
                                    </div>

                                    {{-- Card Modal (Unchanged) --}}
                                    <dialog class="modal card-modal" wire:ignore.self
                                        id="{{ 'openCardModal' . $card->id }}">

                                        <div
                                            class="modal-box w-11/12 max-w-3xl h-[80vh] text-gray-900 dark:text-gray-100">



                                            <form method="dialog" class="card-modal-close-btn">

                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">

                                                    x

                                                </button>

                                            </form>



                                            <div class="card-title mt-5">

                                                <div class="flex gap-2 flex-col">

                                                    <div class="flex items-center gap-2">

                                                        <i class="fa-solid fa-window-maximize text-lg"></i>

                                                        <p class="text-2xl font-extrabold">Card Title</p>

                                                    </div>

                                                    <div class="ps-7">

                                                        <p class="font-bold text-xl">{{ $card->title }}</p>

                                                    </div>

                                                </div>

                                            </div>



                                            <div class="card-description mt-5">

                                                <div class="flex items-center gap-2 py-4">

                                                    <i class="fa-solid fa-align-justify text-lg"></i>

                                                    <p class="text-2xl font-extrabold">Card Description</p>

                                                </div>

                                                <div wire:ignore>

                                                    <textarea id="cardDescription" class="ck5 mt-3 text-gray-900 dark:text-black">

                                                    {{ $card->description }}

                                                    </textarea>

                                                </div>

                                            </div>



                                            <div class="card-acitivity mt-3">

                                                <div class="flex items-center gap-2 py-4">

                                                    <i class="fa-solid fa-align-center text-lg"></i>

                                                    <p class="text-2xl font-extrabold">Card Activity</p>

                                                </div>

                                                <div wire:ignore>

                                                    <textarea id="cardActivity" class="ck5 mt-3 text-gray-900 dark:text-black">

{{ $card->description }}

</textarea>

                                                </div>

                                            </div>



                                        </div>

                                    </dialog>

                                    <div x-cloak class="card-title-change" x-show="cardDisplay[{{ $card->id }}]">

                                        <input wire:model="cardTitle" value="{{ $card->title }}"
                                            x-ref="cardDisplay_{{ $card->id }}"
                                            placeholder="Change card title name..."
                                            x-on:click.outside="cardDisplay[{{ $card->id }}] = false"
                                            x-on:keydown.enter.window=
                                                   "
                                                    if (cardDisplay[{{ $card->id }}])
                                                    { @this.editCardTitle( {{ $column->id }}, {{ $card->id }} ) }
                                                   "
                                            class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-none py-2 ms-2 mt-1 ps-3 w-64 rounded-md">
                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                {{-- 5. COLUMN FOOTER: Added 'shrink-0' --}}
                <div class="column-footer shrink-0 mt-2">
                    {{-- Add New Card --}}
                    <div x-data="{ openCard: false }" class="card-button ms-4 bg-gray-100 dark:bg-black rounded-md w-64 ">
                        <div x-show="!openCard"
                            x-on:click=
                                 "
                                  openCard = true;
                                  $nextTick(()=>{ openCard && $refs.newCardInput.focus() });
                                 "
                            class=" hover:cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-800 text-gray-700 dark:text-slate-300 w-64 py-2 rounded-lg flex justify-start gap-2 items-center">
                            <i class="fa-solid fa-plus text-gray-500 dark:text-slate-300 ms-2"></i>
                            <p class="px-2 font-bold">Add a card</p>
                        </div>

                        <div x-cloak x-show="openCard"
                            x-on:keydown.enter=
                                 "
                                   if (openCard){
                                       openCard = false;
                                   }
                                 "
                            class="column-card-title w-64 rounded-md"
                            x-on:reset-card-title.window="$refs.newCardInput.value = ''">
                            <input x-ref="newCardInput" wire:model="cardTitle" x-on:click.outside="openCard = false"
                                placeholder="Enter card title here..."
                                class=
                                       "
                                         p-2 w-[255px] border border-gray-300 dark:border-none outline-0 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-md
                                         @error('cardTitle') text-red-600 border-red-600 @enderror
                                       ">
                            @error('cardTitle')
                                <span class="text-red-600 w-60 text-md">{{ $message }}</span>
                            @enderror

                            <div class="flex gap-2 justify-start items-center mt-2">
                                <button type="button" wire:click.prevent="createCardTitle({{ $column->id }})"
                                    class="p-2 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-slate-400 font-bold rounded-md hover:bg-gray-300 dark:hover:bg-black">
                                    Add Card
                                </button>
                                <button type="button" x-on:click="openCard = false" wire:loading.attr="disabled">
                                    <i
                                        class="fa-solid fa-x text-gray-500 dark:text-slate-300 font-extrabold hover:bg-gray-200 dark:hover:bg-gray-800 p-3 rounded-md"></i>
                                </button>
                            </div>

                        </div>
                    </div>

                    {{-- Delete Column Modal --}}
                    {{-- Delete Column Modal --}}

                    <dialog id="{{ str_replace(' ', '', $column->title) }}" class="modal">



                        <div class="modal-box text-gray-900 dark:text-gray-100">

                            <h3 class="font-extrabold text-xl text-center mt-2">

                                Are you sure you want to delete this column?

                            </h3>

                            <p class="py-4 text-red-600 text-extrabold text-center text-lg">

                                Warning! Everything will be deleted

                            </p>



                            <div class="flex justify-center gap-5">

                                <button class="btn" wire:click="deleteColumn('{{ $column->id }}')">

                                    Delete

                                </button>

                                <div class="modal-action m-0">

                                    <form method="dialog">

                                        <button class="btn">Close</button>

                                    </form>

                                </div>

                            </div>

                        </div>



                    </dialog>
                </div>
            </div>
        @endforeach

        {{-- Add New Column Element (Added shrink-0 here too) --}}
        <div x-data="{ open: false }" class="w-64 shrink-0 ms-5 text-center">

            <div x-show="!open"
                @keydown.window.escape=
                     "
                       open = false;
                       $dispatch('reset-field')
                     "
                x-on:click="open = !open; $nextTick(()=>{$refs.createNewColumn.focus()})"
                class="flex justify-start items-center gap-3 ps-4 list-column py-2 rounded-xl bg-gray-200 dark:bg-gray-800 bg-opacity-60 backdrop-blur-sm hover:bg-gray-300 dark:hover:bg-black hover:bg-opacity-65 hover:cursor-pointer text-gray-700 dark:text-slate-300">
                <i class="fa-solid fa-plus"></i>
                <p class="font-bold"> Add column here </p>
            </div>

            <div x-cloak x-show="open" x-on:click.outside="open=false" x-on:keydown.window.escape="open = false"
                x-on:hide-column-creation-form.window="open = false"
                class="column-card w-full bg-gray-100 dark:bg-black rounded-lg py-3 px-3">
                <input type="text" id="column-input-field" x-ref="createNewColumn" wire:model="columnTitle"
                    placeholder="Enter column title..."
                    class=
                           "
                            input input-bordered input-info w-full bg-white dark:bg-gray-900 text-gray-900 dark:text-white
                            @error('columnTitle') border-red-700 @enderror
                           " />
                @error('columnTitle')
                    <span class="text-red-600 text-sm">{{ $message }} </span>
                @enderror

                <div class="flex gap-3 justify-start items-center mt-2">
                    <button type="button" wire:click.prevent="createColumn"
                        class="p-2 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-slate-400 rounded-md font-bold hover:bg-gray-300 dark:hover:bg-black">
                        Create column
                    </button>
                    <button type="button" x-on:click="open = !open" wire:loading.attr="disabled">
                        <i
                            class="fa-solid fa-x text-gray-500 dark:text-slate-300 font-extrabold hover:bg-gray-200 dark:hover:bg-gray-800 p-3 rounded-md"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Dump DB Button --}}
        <div class="shrink-0">
            <livewire:dump-d-b />
        </div>

    </div>

</div>
