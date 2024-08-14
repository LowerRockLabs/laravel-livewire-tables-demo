<?php

namespace App\Traits;

use Livewire\Attributes\Url;
use Illuminate\Support\Facades\App;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait ExampleTrait {

    public function bootExampleTrait()
    {
        $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->getTitle() == 'Address') {
                return [
                    'class' => 'text-red-500 break-all',
                ];
            }
            if ($column->getTitle() == 'Name') {
                return [
                    'class' => 'text-red-500 break-all',
                ];
            }

            else return [];

        })
        ->setSecondaryHeaderTrAttributes(function ($rows) {
            return ['class' => 'bg-gray-100'];
        })
        ->setSecondaryHeaderTdAttributes(function (Column $column, $rows) {
            if ($column->isField('address.address')) {
                return ['class' => 'text-red-500'];
            }
            else if ($column->isHidden())
            {
                return ['class' => 'invisible',
                'default' => false];
            }
            else return ['default' => true];
        })
        ->setFooterTrAttributes(function ($rows) {
            return ['class' => 'bg-gray-100'];
        })
        ->setFooterTdAttributes(function (Column $column, $rows) {
            if ($column->isField('name')) {
                return ['class' => 'text-green-500'];
            }

            return ['default' => true];
        });

    }

}
