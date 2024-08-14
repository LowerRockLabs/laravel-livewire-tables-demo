<?php

namespace App\Traits\Tables;

trait HasDebugHelper 
{
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