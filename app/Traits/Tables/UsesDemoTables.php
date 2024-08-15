<?php

namespace App\Traits\Tables;

use Livewire\Attributes\{Locked, Url};

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

    }

    public function configuredUsesDemoTables()
    {
        $this->setConfigurableArea('before-tools', 'includes.tables.before-tools');
    }

    public function refreshWindow()
    {
        $this->js('window.location.reload()'); 
    }
    

}
