<?php

namespace App\Traits\Tables;

trait UsesDemoTables {
   
    use HasTrimSearchHelper;
    use HasPaginationHelper;
    use HasSearchHelper;
    use HasFilterHelper;
    use HasDebugHelper;

    public string $filterLayout = 'popover';

    public function bootUsesDemoTables()
    {
        $this->setConfigurableAreas([
            'before-tools' => 'livewire.tables.before-tools.table-controls',
        ]); 
        $this->setPerPageAccepted([10, 25, 50, 100, 250]);

    }

    public function configuredUsesDemoTables()
    {
        $this->setConfigurableArea('before-tools', 'includes.tableCustomView');
    }

    public function refreshWindow()
    {
        $this->js('window.location.reload()'); 
    }
    

}
