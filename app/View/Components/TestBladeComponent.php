<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestBladeComponent extends Component
{
    public $weight;
    public $newWeight;

    /**
     * Create a new component instance.
     */
    public function __construct($weight = 'nothing')
    {
        $this->weight = $weight;
        $this->newWeight = $weight;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.test-blade-component');
    }
}
