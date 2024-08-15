<?php

namespace App\Traits;

use Livewire\Attributes\Url;
use App\Traits\Pages\{ProvidesLocales, ProvidesTableWidths, ProvidesThemes};

trait DemoTrait {
    use ProvidesLocales,
        ProvidesTableWidths,
        ProvidesThemes;

    public $filterDemoKey = '';

    #[Url(as: 'selected-table', keep: true)]
    public $selectedTable = 'news-table';

    public function setFilterDemoKey()
    {
        $this->filterDemoKey = $this->selectedTable.'-'.$this->theme;
    }

    public function rendering()
    {
        $this->setFilterDemoKey();
    }
}
