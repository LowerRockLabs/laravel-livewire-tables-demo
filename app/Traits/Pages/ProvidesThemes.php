<?php

namespace App\Traits\Pages;

use Livewire\Attributes\Url;

trait ProvidesThemes 
{
    public string $originalTheme;

    #[Url(as: 'theme', keep: true)]
    public string $theme = 'tw3';

    #[Url(as: 'tableTheme', keep: true)]
    public string $tableTheme = 'tailwind';

    public function updatedTheme(string $theme)
    {
        $this->setTableTheme($theme);        
    }

    public function setTableTheme(string $theme)
    {
        $this->theme = $theme;
        $this->tableTheme = "tailwind";

        if ($theme == "bs4")
        {
            $this->tableTheme = "bootstrap-4";
        }
        else if ($theme == "bs5")
        {
            $this->tableTheme = "bootstrap-5";
        }
    }

}
