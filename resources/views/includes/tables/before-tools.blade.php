<div 
    @class([
        'd-flex flex-row space-x-2 align-items-center align-content-center items-center mx-2 px-2 py-2 pb-4' => ($this->getTheme() == 'bootstrap-4' || $this->getTheme() == 'bootstrap-5'),
        'flex flex-cols space-x-2 align-content-center items-center py-2 pb-4' => $this->getTheme() == 'tailwind',
    ])>
    <div class="px-2 font-bold	fw-bold">
        Demo Controls:
    </div>
    <div class="px-2">
        Trim Search String <input type="checkbox" wire:model.live="demoTrimSearchString" />
    </div>
    <div class="px-2">
        Pagination
        <select wire:model.live="externalPaginationMethod" style="color: #000; background-color: #FFF" >
            <option style="color: #000; background-color: #FFF" value='simple'>Simple</option>
            <option style="color: #000; background-color: #FFF" value='cursor'>Cursor</option>
            <option style="color: #000; background-color: #FFF" value='standard'>Standard</option>
        </select>
    </div>
    <div class="px-2">
        Search Method
        <select wire:model.live="searchMethodOption" style="color: #000; background-color: #FFF" >
            @foreach($searchMethodOptions as $index => $value)
                <option style="color: #000; background-color: #FFF" value='{{ $index }}'>{{ $value }}</option>
            @endforeach
        </select>
    </div>
    <div class="px-2">
        Filter Switcher
        <select wire:model.live="filterLayout" style="color: #000; background-color: #FFF" >
            <option value='popover'>Filter Pop-Over</option>
            <option value='slide-down'>Filter Slide-Down</option>
        </select>
    </div>
    <div class="px-2">
        Debug <input type="checkbox" wire:model.live="showDebug" />
    </div>

</div>