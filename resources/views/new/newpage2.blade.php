<div style="margin-top: 5em;">
Page 2
<a href='newpage1' wire:navigate>Page 1</a>
<a href='newpage2' wire:navigate>Page 2</a>
@include('includes.sections.header.demoControls')
    
    <div class="h-screen" wire:key="{{ $filterDemoKey }}-wrapper">
        <livewire:dynamic-component lazy :key="$filterDemoKey" :is="$selectedTable" theme="{{ $tableTheme }}" filterLayout="{{ $filterLayout }}"  externalPaginationMethod="{{ $chosenPaginationMethod }}" />
    </div>
</div>
