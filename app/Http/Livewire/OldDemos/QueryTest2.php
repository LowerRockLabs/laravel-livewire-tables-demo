<?php

namespace App\Http\Livewire\OldDemos;

use Livewire\Attributes\Url;
use Livewire\Component;

class QueryTest2 extends Component
{
    #[Url]
    public ?string $param1 = null;

    #[Url]
    public ?string $param2 = null;

    #[Url]
    public ?string $param3 = null;

    #[Url]
    public ?string $param4 = null;

    public $tinymce;

    public function resetAllVariables(): void
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.query-test2');
    }

}
