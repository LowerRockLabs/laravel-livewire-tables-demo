<?php

namespace App\Http\Livewire\OldDemos;

use Livewire\Component;
use Livewire\Attributes\Modelable;
use App\Models\Species;

class Select2Filter extends Component
{
    #[Modelable] 
    public $value = [];

    public $filterKey = '';

    public array $optionList = [];

    public function mount()
    {
        $this->optionList = Species::select('id','name')->pluck('name','id')->toArray();
    }

    public function render()
    {
        return view('livewire.select2-filter');
    }
}
