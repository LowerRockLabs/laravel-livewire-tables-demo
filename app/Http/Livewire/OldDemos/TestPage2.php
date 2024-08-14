<?php

namespace App\Http\Livewire\OldDemos;

use Livewire\Component;
use Livewire\Attributes\Url;

class TestPage2 extends Component
{
    #[Url(except: null)]
    public ?int $bathrooms = null;

    public function render()
    {
        return <<<'HTML'
            <div>
                <input type="number" wire:model.live="bathrooms" />
                <button wire:click="set('bathrooms', null)">Reset Bathrooms</button>
            </div>
        HTML;

    }
}
