<?php

namespace App\Http\Livewire\OldDemos;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Traits\DemoTrait;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;

#[Layout('layouts.bs5')]
class NewPage2 extends Component
{
    use DemoTrait;

    public function placeholder()
    {
        return <<<'HTML'
        <div style="font-size: xxx-large">
            FULL PAGE PLACEHOLDER
        </div>
        HTML;
    }

    public function mount()
    {
        $this->setTableTheme('bs5');        
        if (empty($this->availableLocales))
        {
            $this->availableLocales = config('app.available_locales');
        }
        $this->checkAndUpdateChosenLocale($this->chosenLocale);

    }
    
    #[Layout('layouts.bs5')] 
    public function render()
    {
        return view('new.newpage2');
    }
}
