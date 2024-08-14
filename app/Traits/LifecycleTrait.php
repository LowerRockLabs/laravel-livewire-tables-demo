<?php

namespace App\Traits;

trait LifecycleTrait {

    public function configuredLifecycleTrait()
    {
        $this->addAdditionalSelects(['users.password as password']);
    }
}
