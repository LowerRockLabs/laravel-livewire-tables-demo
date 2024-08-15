<?php

namespace App\Traits\Pages;

use Livewire\Attributes\Url;
use Illuminate\Support\Facades\App;

trait ProvidesLocales 
{
    #[Url(as: 'chosenLocale', keep: true)]
    public string $chosenLocale = 'en';

    public array $availableLocales = [];

    public function updatedChosenLocale($val)
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