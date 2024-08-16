<?php

namespace App\Traits\Pages;

use Livewire\Attributes\Url;

trait ProvidesThemes 
{
    public string $originalTheme;

    #[Url(as: 'theme', keep: true)]
    public string $demoTheme = 'tw3';

    #[Url(as: 'tableTheme', keep: true)]
    public string $demoTableTheme = 'tailwind';

    public function updatedDemoTheme(string $demoTheme)
    {
        $this->setTableTheme($demoTheme);        
    }

    public function setTableTheme(string $demoTheme)
    {
        $this->demoTheme = $demoTheme;
        $this->demoTableTheme = "tailwind";

        if ($demoTheme == "bs4")
        {
            $this->demoTableTheme = "bootstrap-4";
        }
        else if ($demoTheme == "bs5")
        {
            $this->demoTableTheme = "bootstrap-5";
        }
    }

}
