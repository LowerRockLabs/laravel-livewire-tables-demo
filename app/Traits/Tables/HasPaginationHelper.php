<?php

namespace App\Traits\Tables;

trait HasPaginationHelper 
{
    public string $externalPaginationMethod = 'standard';

    public function configuredHasPaginationHelper()
    {
        $this->setPerPageAccepted([10, 25, 50, 100, 250]);

        if ($this->externalPaginationMethod == 'simple')
        {
            $this->setPaginationMethod('simple');
        }
        else if ($this->externalPaginationMethod == 'cursor')
        {
            $this->setPaginationMethod('cursor');
        }
        else
        {
            $this->setPaginationMethod('standard');
        }
    }

    public function updatedExternalPaginationMethod($value)
    {
        if ($value == 'simple')
        {
            $this->setPaginationMethod('simple');
        }
        else if ($value == 'cursor')
        {
            $this->setPaginationMethod('cursor');
        }
        else
        {
            $this->setPaginationMethod('standard');
        }
        $this->boot();
    }

}