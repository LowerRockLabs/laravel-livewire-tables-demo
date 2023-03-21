<?php

namespace App\Http\Livewire;

use App\Exports\UsersExport;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
//use LowerRockLabs\LaravelLivewireTablesAdvancedFilters\CustomFilter;
use LowerRockLabs\LaravelLivewireTablesAdvancedFilters\DatePickerFilter;
use LowerRockLabs\LaravelLivewireTablesAdvancedFilters\DateRangeFilter;
//use LowerRockLabs\LaravelLivewireTablesAdvancedFilters\SlimSelectFilter;
use LowerRockLabs\LaravelLivewireTablesAdvancedFilters\NumberRangeFilter;
use LowerRockLabs\LaravelLivewireTablesAdvancedFilters\SmartSelectFilter;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
//use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class UsersTableSlidedown extends DataTableComponent
{
    public $myParam = 'Default';

    public $filterData = [];

    public string $tableName = 'users2';

    public array $users1 = [];

    public array $allTags = [];





    public function configure(): void
    {
        /* $tags = Tag::query()
         ->select('id', 'name', 'created_at')
         ->orderBy('name')
         ->get()
         ->map(function ($tag) {
             $tagValue['id'] = $tag->id;
             $tagValue['name'] = $tag->name;
             $tagValue['text'] = $tag->name;
             $tagValue['html'] = strval($tag->created_at);
             $tagValue['selected'] = (isset(($this->{$this->tableName}['filters']['tag_ss'])) ? (in_array($tag->id, $this->{$this->tableName}['filters']['tag_ss']) ? 'true' : false) : 'false');

             return $tagValue;
         });

         dd($tags);*/
        $this->setPrimaryKey('id')
            ->setDebugEnabled()
            ->setAdditionalSelects(['users.id as id'])
            ->setConfigurableAreas([
                'toolbar-left-start' => ['includes.areas.toolbar-left-start', ['param1' => $this->myParam, 'param2' => ['param2' => 2]]],
            ])
            ->setTableAttributes([
                'x-data' => "{ test: \$wire.entangle('filterData'), init() { console.log(this.test) }}",

              ])
            ->setReorderEnabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->setSecondaryHeaderTrAttributes(function ($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setSecondaryHeaderTdAttributes(function (Column $column, $rows) {
                if ($column->isField('id')) {
                    return ['class' => 'text-red-500'];
                }

                return ['default' => true];
            })
            ->setFooterTrAttributes(function ($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setFooterTdAttributes(function (Column $column, $rows) {
                if ($column->isField('name')) {
                    return ['class' => 'text-green-500'];
                }

                return ['default' => true];
            })
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setTableRowUrl(function ($row) {
                return 'https://google-'.$row->id.'.com';
            })
            ->setTableRowUrlTarget(function ($row) {
                return '_blank';
            })->setEagerLoadAllRelationsEnabled()->setFilterLayoutSlideDown();



        $this->allTags = Tag::select('id', 'name', 'created_at')
        ->orderBy('name')
        ->get()
        ->map(function ($tag) {
            $tagValue['id'] = $tag->id;
            $tagValue['name'] = $tag->name;

            return $tagValue;
        })->keyBy('id')->toArray();
    }

    public function columns(): array
    {
        return [
            Column::make('Order', 'sort')
                ->sortable()
                ->collapseOnMobile()
                ->excludeFromColumnSelect(),
            Column::make('Name')
                ->sortable(function (Builder $query, string $direction) {
                    return $query->orderBy('name', $direction); // Example, ->sortable() would work too.
                })
                ->searchable()
                ->secondaryHeader($this->getFilterByKey('name'))
                ->footer($this->getFilterByKey('name')),

            Column::make('Success Rate', 'success_rate')
            ->sortable()
            ->searchable()
            ->collapseOnTablet(),

            Column::make('parent_id', 'parent_id')
            ->sortable()
            ->collapseOnMobile()
            ->excludeFromColumnSelect(),

            ComponentColumn::make('Email', 'email')
                ->sortable()
                ->searchable()
                ->component('email')
                ->attributes(fn ($value, $row, Column $column) => [
                    'type' => Str::endsWith($value, 'example.org') ? 'success' : 'danger',
                    'dismissible' => true,
                ])
                ->secondaryHeader($this->getFilterByKey('e-mail'))
                ->footer($this->getFilterByKey('e-mail')),

            Column::make('Address', 'address.address')
            ->sortable()
            ->searchable()
            ->collapseOnTablet(),
            Column::make('Address Group', 'address.group.name')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Group City', 'address.group.city.name')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            BooleanColumn::make('Active')
                ->sortable()
                ->collapseOnMobile()
                ->secondaryHeaderFilter('active')
                ->footerFilter('active'),

            Column::make('Group City', 'address.group.city.name')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),

            Column::make('Tags')
                ->label(fn ($row) => $row->tags->pluck('name')->implode(', ')),

            ButtonGroupColumn::make('Actions')
                ->unclickable()
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('My Link 1')
                        ->title(fn ($row) => 'Link 1')
                        ->location(fn ($row) => 'https://'.$row->id.'google1.com')
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'underline text-blue-500',
                            ];
                        }),
                    LinkColumn::make('My Link 2')
                        ->title(fn ($row) => 'Link 2')
                        ->location(fn ($row) => 'https://'.$row->id.'google2.com')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500',
                            ];
                        }),
                    LinkColumn::make('My Link 3')
                        ->title(fn ($row) => 'Link 3')
                        ->location(fn ($row) => 'https://'.$row->id.'google3.com')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500',
                            ];
                        }),
                ]),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Name')
                ->config([
                    'maxlength' => 10,
                    'placeholder' => 'Search Name',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.name', 'like', '%'.$value.'%');
                })
                ->hiddenFromMenus(),
            TextFilter::make('Email')
                ->config([
                    'maxlength' => 10,
                    'placeholder' => 'Search E-mail',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.email', 'like', '%'.$value.'%');
                })
                ->hiddenFromMenus(),
            /**CustomFilter::make('Test Custom Filter')
            ->config([
                'maxlength' => 10,
                'placeholder' => 'Search E-mail',
            ])
            ->filter(function (Builder $builder, string $value) {
                $builder->where('users.email', 'like', '%'.$value.'%');
            }),*/
            SmartSelectFilter::make('SmartSelect')
            ->options(
                $this->allTags
            )->setIconStyling(true, '#00FF00', '1.25em', 'both')
            ->filter(function (Builder $builder, array $values) {
                $builder->whereHas('tags', fn ($query) => $query->whereIn('tags.id', $values));
            }),

            /*SmartSelectFilter::make('Parent')
            ->config(['optionsMethod' => 'simple'])
            ->setCustomPillBlade('testfilter')
            ->options(
                User::query()
                    ->without(['parent'])
                    ->select('id', 'name')
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray()
            )->setIconStyling(true, '#00FF00', '1.25em', 'both')
            ->filter(function (Builder $builder, array $values) {
                $builder->whereIn('parent_id', $values);
            }),*/
            /*SlimSelectFilter::make('TagSlimSelect')
            ->options(
                Tag::query()
                ->select('id', 'name')
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray()
            )->filter(function (Builder $builder, array $values) {
                $builder->withWhereHas('tags', fn ($query) => $query->whereIn('tags.id', $values));
            }),*/

            /*SlimSelectFilter::make('TagSlimSelect', 'tag_ss')
            ->options(
                Tag::query()
                ->select('id', 'name', 'created_at')
                ->orderBy('name')
                ->get()
                ->map(function ($tag) {
                    $tagValue['id'] = $tag->id;
                    $tagValue['name'] = $tag->name;
                    $tagValue['text'] = $tag->name;
                    $tagValue['value'] = $tag->id;
                    $tagValue['html'] = $tag->name;
                    $tagValue['selected'] = (isset(($this->{$this->tableName}['filters']['tag_ss'])) ? (in_array($tag->id, $this->{$this->tableName}['filters']['tag_ss']) ? 'true' : false) : 'false');

                    return $tagValue;
                })->toArray()*/
            // )->filter(function (Builder $builder, array $values) {
            //     $builder->withWhereHas('tags', fn ($query) => $query->whereIn('tags.id', $values));
            // }),

            DateRangeFilter::make('EMail Verified Range')
            ->config([
                'ariaDateFormat' => 'F j, Y',
                'dateFormat' => 'Y-m-d',
                'earliestDate' => '2020-01-01',
                'latestDate' => '2023-07-01',
            ])
            ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate'])
            ->filter(function (Builder $builder, array $dateRange) {
                $builder->whereDate('email_verified_at', '>=', $dateRange['minDate'])->whereDate('email_verified_at', '<=', $dateRange['maxDate']);
            }),
            NumberRangeFilter::make('Success Rate')
            ->options(
                [
                    'min' => 0,
                    'max' => 100,
                ]
            )
            ->config([
                'minRange' => 0,
                'maxRange' => 100,
                'suffix' => '%',
            ])
            ->filter(function (Builder $builder, array $values) {
                $builder->where('users.success_rate', '>=', intval($values['min']))
                ->where('users.success_rate', '<=', intval($values['max']));
            })->setFilterSlidedownRow('2')
            ->setFilterSlidedownColspan('2'),

            DatePickerFilter::make('EMail Verified Before DateTime')
            ->config([
                'ariaDateFormat' => 'F j, Y',
                'dateFormat' => 'Y-m-d',
                'earliestDate' => '2020-01-01',
                'latestDate' => '2023-07-01',
                'timeEnabled' => true,
            ])
            ->filter(function (Builder $builder, string $value) {
                $builder->whereDate('email_verified_at', '<=', $value);
            }),

            DatePickerFilter::make('Verified Before Date')
            ->config([
                'ariaDateFormat' => 'F j, Y',
                'dateFormat' => 'Y-m-d',
                'earliestDate' => '2020-01-01',
                'latestDate' => '2023-07-01',
                'timeEnabled' => false,
            ])
            ->filter(function (Builder $builder, string $value) {
                $builder->where('email_verified_at', '<=', $value);
            }),

            SelectFilter::make('E-mail Verified', 'email_verified_at')
                ->setFilterPillTitle('Verified')
                ->options([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === 'yes') {
                        $builder->whereNotNull('email_verified_at');
                    } elseif ($value === 'no') {
                        $builder->whereNull('email_verified_at');
                    }
                }),
            SelectFilter::make('Active')
                ->setFilterPillTitle('User Status')
                ->setFilterPillValues([
                    '1' => 'Active',
                    '0' => 'Inactive',
                ])
                ->options([
                    '' => 'All',
                    '1' => 'Yes',
                    '0' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('active', true);
                    } elseif ($value === '0') {
                        $builder->where('active', false);
                    }
                })
                ->hiddenFromAll(),
            DateFilter::make('Verified From')
                ->config([
                    'min' => '2020-01-01',
                    'max' => '2021-12-31',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereDate('email_verified_at', '>=', $value);
                }),
            DateFilter::make('Verified To')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('email_verified_at', '<=', $value);
                })
    ,

        ];
    }

    public function builder(): Builder
    {
        return User::query()->with(['tags', 'parent']);
    }

    public function bulkActions(): array
    {
        return [
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
            'export' => 'Export',
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new UsersExport($users), 'users.xlsx');
    }

    public function activate()
    {
        User::whereIn('id', $this->getSelected())->update(['active' => true]);

        $this->clearSelected();
    }

    public function deactivate()
    {
        User::whereIn('id', $this->getSelected())->update(['active' => false]);

        $this->clearSelected();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            User::find((int) $item['value'])->update(['sort' => (int) $item['order']]);
        }
    }
}
