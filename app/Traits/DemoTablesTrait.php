<?php

namespace App\Traits;

use App\Traits\Tables\DemoCoreHelper;


trait DemoTablesTrait {

    use DemoCoreHelper;
    
    public string $externalPaginationMethod = 'standard';
    
    public string $filterLayout = 'popover';

}
