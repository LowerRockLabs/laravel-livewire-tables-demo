<?php

namespace App\Traits\Tables;

use Livewire\Attributes\{Locked, Url};

trait HasDebugHelper 
{
    #[Url(as: 'showDebug', keep: false)]
    public bool $showDebug = false;

    public function configuredHasDebugHelper()
    {
        if ($this->showDebug)
        {
            $this->setDebugEnabled();
        }
        else
        {
            $this->setDebugDisabled();
        }

    }

    public function updatedShowDebug($value)
    {
        if ($value)
        {
            $this->setDebugEnabled();
        }
        else
        {
            $this->setDebugDisabled();
        }


        $this->boot();
    }
}