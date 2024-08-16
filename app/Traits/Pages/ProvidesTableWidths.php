<?php

namespace App\Traits\Pages;

use Livewire\Attributes\{Locked, Url};

trait ProvidesTableWidths 
{
    #[Url(as: 'tableWidth', keep: false)]
    public int $demoTableWidth = 100;

    #[Locked]
    public string $demoTableWidthClass = 'w-full';

    public function mountProvidesTableWidths()
    {
        $this->setTableWidthClasses();
    }

    public function updatedDemoTableWidth($value)
    {
        $this->setTableWidthClasses($value);
    }

    protected function setTableWidthClasses(?int $value = null)
    {
        if (!isset($value))
        {
            $value = $this->demoTableWidth;
        }

        if ($value == 25)
        {
            $this->demoTableWidthClass = ($this->demoTheme == 'tailwind' ? 'w-1/4' : 'w-25');
        }
        elseif ($value == 50)
        {
            $this->demoTableWidthClass = ($this->demoTheme == 'tailwind' ? 'w-1/2' : 'w-50');
        }
        elseif ($value == 75)
        {
            $this->demoTableWidthClass = ($this->demoTheme == 'tailwind' ? 'w-3/4' : 'w-75');
        }
        else
        {
            $this->demoTableWidthClass = ($this->demoTheme == 'tailwind' ? 'w-full' : 'w-100');
        }


    }

}