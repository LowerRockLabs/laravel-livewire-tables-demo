<?php

namespace App\Traits\Pages;

use Livewire\Attributes\Url;

trait ProvidesTableWidths 
{
    #[Url(as: 'tableWidth', keep: false)]
    public int $tableWidth = 100;

    public string $tableWidthClass = 'w-full';

    public function mountProvidesTableWidths()
    {
        if ($this->tableWidth == 25)
        {
            $this->tableWidthClass = 'w-1/4';
        }
        elseif ($this->tableWidth == 50)
        {
            $this->tableWidthClass = 'w-1/2';
        }
        elseif ($this->tableWidth == 75)
        {
            $this->tableWidthClass = 'w-3/4';
        }
        else
        {
            $this->tableWidthClass = 'w-full';
        }

    }

    public function updatedTableWidth($value)
    {
        if ($value == 25)
        {
            $this->tableWidthClass = 'w-1/4';
        }
        elseif ($value == 50)
        {
            $this->tableWidthClass = 'w-1/2';
        }
        elseif ($value == 75)
        {
            $this->tableWidthClass = 'w-3/4';
        }
        else
        {
            $this->tableWidthClass = 'w-full';
        }
    }

}