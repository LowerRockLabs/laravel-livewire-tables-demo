<?php

namespace App\Http\Livewire\OldDemos;

use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsExternalFilter;

class MyTestExternalFilter extends Component
{
    use IsExternalFilter;
    
    public function render()
    {
        return view('livewire.external-filter');
    }
}
