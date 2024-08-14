<?php

namespace App\Http\Livewire\OldDemos;

use Livewire\Attributes\Url;
use Livewire\Component;

class QueryTest extends Component
{
    #[Url(history: true)]
    public array $test = [];

    #[Url(history: true)]
    public $param1 = '';

    public function mount()
    {
    }

    public function render()
    {

        return view('livewire.query-test');
    }

}
