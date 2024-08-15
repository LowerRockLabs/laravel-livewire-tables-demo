<?php

namespace App\Traits\Tables;

use Livewire\Attributes\{Locked, Url};

trait HasTrimSearchHelper 
{
    #[Url(as: 'dts', keep: false)]
    public bool $demoTrimSearchString = false;

    public function configuringHasTrimSearchHelper()
    {

        if ($this->demoTrimSearchString)
        {
            $this->setTrimSearchStringEnabled();
        }
        else
        {
            $this->setTrimSearchStringDisabled();
        }

    }
    public function updatedDemoTrimSearchString(bool $value)
    {
        if ($value)
        {
            $this->setTrimSearchStringEnabled();
        }
        else
        {
            $this->setTrimSearchStringDisabled();
        }
        $this->boot();
    }
}
   