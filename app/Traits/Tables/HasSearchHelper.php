<?php

namespace App\Traits\Tables;

use Livewire\Attributes\{Locked, Url};

trait HasSearchHelper 
{
    #[Locked]
    public array $searchMethodOptions = ['debounce-250' => 'Debounce 250ms', 'debounce-2000' => 'Debounce 2000ms', 'blur' => 'Blur', 'live' => 'Live', 'defer' => 'Defer', 'lazy' => 'Lazy'];

    #[Url(as: 'smo')]
    public string $searchMethodOption = '';

    public function resetSearchMethod()
    {
        $this->searchFilterLazy = $this->searchFilterBlur = $this->searchFilterLive = $this->searchFilterDefer = $this->searchFilterDebounce = $this->searchFilterThrottle = null;
    }

    public function configuredHasSearchHelper()
    {
        $this->setupSearchMethod();
    }

    public function updatedSearchMethodOption($value)
    {
        $this->setupSearchMethod();
        $this->boot();
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