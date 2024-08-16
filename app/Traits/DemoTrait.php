<?php

namespace App\Traits;

use Livewire\Attributes\Url;
use App\Traits\Pages\{ProvidesLocales, ProvidesTableWidths, ProvidesThemes};

trait DemoTrait {
    use ProvidesLocales,
        ProvidesTableWidths,
        ProvidesThemes;

    public $demoFilterDemoKey = '';

    #[Url(as: 'selected-table', keep: true)]
    public $demoSelectedTable = 'news-table';

    public function setFilterDemoKey()
    {
        $this->demoFilterDemoKey = $this->demoSelectedTable.'-'.$this->demoTheme;
    }

    public function rendering()
    {
        $this->setFilterDemoKey();
    }
}
