<?php

namespace App\Traits\Pages;

use Livewire\Attributes\{Locked, Url};

trait ProvidesTableWidths 
{
    #[Url(as: 'tableWidth', keep: false)]
    public int $tableWidth = 100;

    #[Locked]
    public string $tableWidthClass = 'w-full';

    public function mountProvidesTableWidths()
    {
        $this->setTableWidthClasses();
    }

    public function updatedTableWidth($value)
    {
        $this->setTableWidthClasses($value);
    }

    protected function setTableWidthClasses(?int $value = null)
    {
        if (!isset($value))
        {
            $value = $this->tableWidth;
        }

        if ($value == 25)
        {
            $this->tableWidthClass = ($this->theme == 'tailwind' ? 'w-1/4' : 'w-25');
        }
        elseif ($value == 50)
        {
            $this->tableWidthClass = ($this->theme == 'tailwind' ? 'w-1/2' : 'w-50');
        }
        elseif ($value == 75)
        {
            $this->tableWidthClass = ($this->theme == 'tailwind' ? 'w-3/4' : 'w-75');
        }
        else
        {
            $this->tableWidthClass = ($this->theme == 'tailwind' ? 'w-full' : 'w-100');
        }


    }

}