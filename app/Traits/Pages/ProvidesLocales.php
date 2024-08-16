<?php

namespace App\Traits\Pages;

use Livewire\Attributes\{Locked, Url};
use Illuminate\Support\Facades\App;

trait ProvidesLocales 
{
    #[Url(as: 'chosenLocale', keep: true)]
    public string $demoChosenLocale = 'en';

    #[Locked]
    public array $demoAvailableLocales = [];

    public function updatedDemoChosenLocale($val)
    {
        $this->checkAndUpdateChosenLocale($val);
    }

    public function checkAndUpdateChosenLocale($val)
    {
        if (in_array($val, $this->availableLocales))
        {
            App::setLocale($val);
        }
    }


}