<?php

namespace App\Traits\Tables;

trait HasTrimSearchHelper 
{
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
   