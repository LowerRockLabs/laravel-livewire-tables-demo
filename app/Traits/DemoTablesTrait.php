<?php

namespace App\Traits;

use App\Traits\Tables\DemoSearchHelper;


trait DemoTablesTrait {

    use DemoSearchHelper;
    
    public string $externalPaginationMethod = 'standard';
    
    public string $filterLayout = 'popover';

    public function bootDemoTablesTrait()
    {
        $this->setConfigurableAreas([
            'before-tools' => 'livewire.tables.before-tools.table-controls',
        ]);
        if ($this->demoTrimSearchString == true)
        {
            $this->setTrimSearchStringEnabled();
        }
        else
        {
            $this->setTrimSearchStringDisabled();
        }
 
 
        
    }

    public function refreshWindow()
    {
        $this->js('window.location.reload()'); 
    }

}
