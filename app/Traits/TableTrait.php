<?php

namespace App\Traits;

trait TableTrait {

    public function configuredTableTrait()
    {
        $this->setPerPageAccepted([10, 25, 50, 100, 250]);
    }
}
