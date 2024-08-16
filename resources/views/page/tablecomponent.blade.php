<div style="margin-top: 2em;">
    @include('includes.sections.header.demoControls')
    <div class="h-screen {{ $demoTableWidthClass ?? 'w-full' }}" wire:key="{{ $demoFilterDemoKey }}-wrapper">
        <livewire:dynamic-component :key="$demoFilterDemoKey" :is="$demoSelectedTable" theme="{{ $demoTableTheme }}"  />
    </div>
</div>
