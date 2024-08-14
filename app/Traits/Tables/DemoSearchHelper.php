<?php

namespace App\Traits\Tables;

use Livewire\Attributes\Url;

trait DemoSearchHelper {

    #[Url(as: 'smo')]
    public string $searchMethodOption = '';

    public array $searchMethodOptions = ['debounce-250' => 'Debounce 250ms', 'debounce-2000' => 'Debounce 2000ms', 'blur' => 'Blur', 'live' => 'Live', 'defer' => 'Defer', 'lazy' => 'Lazy'];

    public bool $demoTrimSearchString = false;

    public function resetSearchMethod()
    {
        $this->searchFilterLazy = $this->searchFilterBlur = $this->searchFilterLive = $this->searchFilterDefer = $this->searchFilterDebounce = $this->searchFilterThrottle = null;
    }

    public function bootDemoSearchHelper()
    {
       // $this->setupSearchMethod();
       if ($this->demoTrimSearchString == true)
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
        if ($value == true)
        {
            $this->setTrimSearchStringEnabled();
        }
        else
        {
            $this->setTrimSearchStringDisabled();
        }
 
    }

    public function updatedSearchMethodOption($value)
    {
        $this->setupSearchMethod();
        $this->refreshWindow();
    }

    protected function setupSearchMethod()
    {
        $this->resetSearchMethod();


        if ($this->searchMethodOption == 'debounce-250')
        {
            $this->setSearchDebounce(250);
        }
        else if ($this->searchMethodOption == 'debounce-2000')
        {
            $this->setSearchDebounce(2000);
        }
        else if ($this->searchMethodOption == 'blur')
        {
            $this->setSearchBlur();
        }
        else if ($this->searchMethodOption == 'live')
        {
            $this->setSearchLive();
        }
        else if ($this->searchMethodOption == 'defer')
        {
            $this->setSearchDefer();
        }
        else if ($this->searchMethodOption == 'lazy')
        {
            $this->setSearchLazy();
        }
        else
        {
            $this->setSearchLive();
        }
        
    }

}
