<?php

namespace App\Traits\Tables;

trait DemoCoreHelper {

    use DemoSearchHelper;

    public function bootDemoCoreHelper()
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
