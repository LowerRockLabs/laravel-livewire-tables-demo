<div style="margin-top: 2em;">
    @include('includes.sections.header.demoControls')
    <div class="h-screen {{ $tableWidthClass ?? 'w-full' }}" wire:key="{{ $filterDemoKey }}-wrapper">
        <livewire:dynamic-component :key="$filterDemoKey" :is="$selectedTable" theme="{{ $tableTheme }}"  />
    </div>
</div>
