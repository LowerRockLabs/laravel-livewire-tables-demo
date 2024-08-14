<?php

namespace App\Http\Livewire\Demos;

use Livewire\Component;
use Livewire\Attributes\{Layout,Url};
use App\Traits\DemoTrait;

class Tailwind2 extends Component
{
    use DemoTrait;

    public function mount()
    {
        $this->originalTheme = 'tw2';
        $this->setTableTheme('tw2');        
    }

    #[Layout('layouts.tw2')] 
    public function render()
    {
        return view('page.tablecomponent');
    }
}
