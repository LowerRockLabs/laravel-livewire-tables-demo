<?php

namespace App\Http\Livewire;

use App\Exports\UsersExport;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{BooleanColumn, ButtonGroupColumn, ComponentColumn, ImageColumn, LinkColumn};
use Rappasoft\LaravelLivewireTables\Views\Filters\{DateFilter, DateRangeFilter, DateTimeFilter, MultiSelectDropdownFilter, MultiSelectFilter, NumberFilter, NumberRangeFilter, SelectFilter, TextFilter};
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Traits\TestFilterTrait;
use Rappasoft\LaravelLivewireTables\Views\Filters\LivewireComponentFilter;
use Livewire\Attributes\On; 
use App\Traits\DemoTablesTrait;
use Illuminate\Database\Eloquent\Collection;

class UsersTable extends DataTableComponent
{
    use TestFilterTrait;
    use DemoTablesTrait;

    public $myParam = 'Default';

    public string $tableName = 'users2';

    public array $users1 = [];
    public array $users2 = [];

    public bool $onlyOpen = false;

    #[Reactive] 
    public array $filterComponents2 = ['test_filter' => ''];

    public array $allTags = [];

    public array $fileList;

    public string $temp = '';

    public bool $secondaryHeaderEnabled = false;

    public User $userInstance;

    public array $tagFilterList = [];

    public array $userFilterList = [];

    #[Reactive] 
    public string $testWireable = 'tesat 123';

    public function updatedFilterComponents($val, $key)
    {
        return;
    }

    #[On('update-the-filter')] 
    public function updateTheFilter()
    {
        return;
    }

    public function getTagFilterList()
    {
        $tagFilterList = Cache::remember('allTags', 3600, function () {
            return Tag::select('id', 'name', 'created_at')->orderBy('name')
            ->get()
            ->pluck('name','id')->toArray();
        });
        $this->tagFilterList = $tagFilterList;

        return $tagFilterList;
    }
    public function getUserFilterList()
    {
        $userFilterList = Cache::remember('allUsers', 3600, function () {
            return User::select('name','id')
            ->get()
            ->pluck('name','id')->toArray();
        });

        $this->userFilterList = $userFilterList;

        return $userFilterList;
    }

    public function configure(): void
    {
        $componentQueryString = [];
        
        $this->setPrimaryKey('id')
            ->setReorderEnabled()
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setSearchBlur()
            ->setAdditionalSelects(['users.id as id', 'users.parent_id as parent_id'])
            ->setFilterLayout($this->filterLayout)
            ->setSingleSortingDisabled()
            ->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
                if ($column->getTitle() == 'Address') {
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
            })
            ->setTableRowUrl(function ($row) {
                return 'https://google-'.$row->id.'.com';
            })
            ->setTableRowUrlTarget(function ($row) {
                return '_blank';
            })
            ->setTableAttributes([
                'id' => 'table-users2',
                'class' => 'bg-red-500 min-h-full',
            ])
            ->setReorderDisabled()
            ->setDefaultReorderSort('sort', 'asc')
            ->setEagerLoadAllRelationsDisabled()
            ->setPaginationMethod('cursor')
            ->setPerPageAccepted([10, 25, 50, 100])
            ->setHideReorderColumnUnlessReorderingDisabled()
            ->setLoadingPlaceholderEnabled()
            ->setConfigurableAreas([
                'before-tools' => 'tables.user-before-tools'
            ])
            ->setQueryStringEnabled();


    }
    public function prependColumns(): array
    {
       return [

        ];
    }
    public function columns(): array
    {
        return [
            Column::make('Order', 'sort')
            ->sortable(),

            ImageColumn::make('Avatar')
            ->location(
                fn($row) => 'storage/avatars/' . $row->id . '.jpg'
            )
            ->attributes(fn($row) => [
                'class' => 'rounded-full',
                'alt' => $row->name . ' Avatar',
            ]),

            Column::make('Name')
                ->sortable(function (Builder $query, string $direction) {
                    return $query->orderBy('users.name', $direction); // Example, ->sortable() would work too.
                })
                ->searchable()
                ->excludeFromColumnSelect()
                ->collapseOnMobile()
                ->footer($this->getFilterByKey('name')),

            

            Column::make('Test1')
            ->label(function ($row) {
                return $row->email;
            })
            ->sortable(function(Builder $query, string $direction) {
                return $query->orderBy('users.name', $direction);
            })
            ->collapseOnTablet(),
    
            Column::make('Test2')
            ->label(function ($row) {
              return $row->success_rate;
            })
            ->sortable(function(Builder $query, string $direction) {
              return $query->orderBy('users.name', $direction);
            })
            ->collapseOnTablet(),
            BooleanColumn::make('Has Parent', 'has_parent')
            ->setCallback(function (string $value, $row) {
                return $row->has_parent;
            })
            ->collapseOnMobile(),

            Column::make('Parent', 'parent.name'),

            Column::make('Success Rate')
            ->sortable(function (Builder $query, string $direction) {
                return $query->orderBy('success_rate', $direction); // Example, ->sortable() would work too.
            })
            ->searchable()
            ->collapseOnTablet(),

            Column::make('E-Mail', 'email')
            ->sortable(function (Builder $query, string $direction) {
                return $query->orderBy('email', $direction); // Example, ->sortable() would work too.
            })
            ->searchable(
                function (Builder $query, $searchTerm) {
                    $query->orWhere('users.email', 'like', '%'.$searchTerm.'%');
                } 
            ),


            Column::make('Verified At', 'email_verified_at')
            ->sortable()
            ->searchable()
            ->collapseOnTablet()
            ->format(
                fn ($value, $row, Column $column) => Carbon::parse($value)->format('d M Y')
            ),

            Column::make('Address', 'address.address')
            ->sortable()
            ->searchable()
                        ->footer(function($rows) {
                return 'Count: ' . $rows->count(). ' of ' . $this->paginationTotalItemCount;
            })
            ->collapseAlways(),

            Column::make('Address Group', 'address.group.name')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),

            Column::make('Group City', 'address.group.city.name')
                ->sortable()
                ->searchable(),

            BooleanColumn::make('Active')
                ->sortable()
                ->footerFilter('active'),

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

            SelectFilter::make('UserFilter')
            ->options(
                (!empty($this->userFilterList) ? $this->userFilterList : $this->getUserFilterList())
            ),

            SelectFilter::make('TagFilter')
            ->options(
                (!empty($this->tagFilterList) ? $this->tagFilterList : $this->getTagFilterList())
            ),

            TextFilter::make('Name')
                ->config([
                    'maxlength' => 10,
                    'placeholder' => 'Search Name',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.name', 'like', '%'.$value.'%');
                })->setFilterLabelAttributes(
                    ['class' => 'text-xl', 'for' => 'test1231231', 'default' => true]
                ),

            TextFilter::make('Email')
                ->config([
                    'maxlength' => 10,
                    'placeholder' => 'Search Email',
                ])
                ->filter(function (Builder $builder, string $value) {
                   $builder = $this->applyEmailFilter($builder, $value);
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
                }),

            MultiSelectFilter::make('Tags')
            ->options(
                (!empty($this->tagFilterList) ? $this->tagFilterList : $this->getTagFilterList())
            )->filter(function (Builder $builder, array $values) {
                $builder->whereHas('tags', fn ($query) => $query->whereIn('tags.id', $values));
            })
            ->setFilterPillValues([
                '3' => 'Tag 1',
            ]),


            DateRangeFilter::make('EMail Verified Range')
            ->config([
                'ariaDateFormat' => 'F j, Y',
                'dateFormat' => 'Y-m-d',
                'earliestDate' => '2020-01-01',
                'latestDate' => '2023-08-01',
                'placeholder' => 'Enter Date',
            ])
            ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate'])
            ->filter(function (Builder $builder, array $dateRange) {
                $builder->whereDate('users.email_verified_at', '>=', $dateRange['minDate'])->whereDate('users.email_verified_at', '<=', $dateRange['maxDate']);
            }),

            SelectFilter::make('E-mail Verified', 'email_verified_at')
                ->setFilterPillTitle('Verified')
                ->setCustomFilterLabel('includes.customFilterLabel1')
                ->setFilterPillBlade('includes.customFilterPills2')
                ->options([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === 'yes') {
                        $builder->whereNotNull('users.email_verified_at');
                    } elseif ($value === 'no') {
                        $builder->whereNull('users.email_verified_at');
                    }
                }),
                    
                SelectFilter::make('Active')
                    ->setFilterSlidedownRow(2)
                    ->setFilterSlidedownColspan(2)
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
                            $builder->where('users.active', true);
                        } elseif ($value === '0') {
                            $builder->where('users.active', false);
                        }
                    })
                    ->hiddenFromAll(),
            
                DateFilter::make('Verified From')
                    ->config([
                        'min' => '2023-07-01',
                        'max' => '2023-12-01',
                        'pillFormat' => 'd-m-Y'
                    ])
                    ->filter(function (Builder $builder, string $value) {
                        $builder->whereDate('users.email_verified_at', '>=', $value);
                    })
                    ->setFilterSlidedownRow(2)
                    ->setFilterSlidedownColspan("2"),

                DateTimeFilter::make('Verified To')
                ->config([
                    'pillFormat' => 'd-m-Y H:i',
                ])
                    ->filter(function (Builder $builder, string $value) {
                        $builder->where('users.email_verified_at', '<=', $value);
                    })->setFilterSlidedownRow(3)
                    ->setFilterSlidedownColspan(2)
                    ->setFilterPillBlade('includes.customFilterPillBlade'),

                TextFilter::make('Email5')
                ->setFilterPillTitle('User Email')
                ->setCustomFilterLabel('includes.customFilterLabel2')
                ->config([
                    'maxlength' => 10,
                    'placeholder' => 'Search Email',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.email', 'like', '%'.$value.'%');
                })->setFilterSlidedownRow("2"),

                NumberFilter::make('Success No')
                ->setFilterPillTitle('Success No')
                ->config([
                    'placeholder' => 'Success No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.success_rate', $value);
                })->setFilterSlidedownRow("2"),

            ];
    }

    public function filters2(): array
    {
        return [

            
                DateFilter::make('Verified From')
                    ->config([
                        'min' => '2023-07-01',
                        'max' => '2023-12-01',
                        'pillFormat' => 'd-m-Y'
                    ])
                    ->filter(function (Builder $builder, string $value) {
                        $builder->whereDate('users.email_verified_at', '>=', $value);
                    })
                    ->setFilterSlidedownRow(2)
                    ->setFilterSlidedownColspan("2"),

                    DateTimeFilter::make('Verified To')
                    ->config([
                        'pillFormat' => 'd-m-Y H:i'
                    ])
                        ->filter(function (Builder $builder, string $value) {
                            $builder->where('users.email_verified_at', '<=', $value);
                        })->setFilterSlidedownRow(3)
                        ->setFilterSlidedownColspan(2)
                        ->setFilterPillBlade('includes.customFilterPillBlade'),
                        
                    TextFilter::make('User Namesss', 'user_name_filter')
                    ->filter(function (Builder $builder, string $value) {
                        return $builder->where('users.name', '=', $value);
                    }),
        
        ];
    }

    public function applyEmailFilter(Builder $builder, string $value)
    {
        return $builder->where('users.email', 'like', '%'.$value.'%');
    }

    public function builder(): Builder
    {
        return User::with(['tags:id,name']);
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

    public function reorder(array $items): void
    {
        foreach ($items as $item) {
            User::find($item[$this->getPrimaryKey()])->update(['sort_order' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }


    public function rendering()
    {
        if(method_exists(parent::class, 'rendering'))
        {
            parent::rendering();
        }
        if ($this->secondaryHeaderEnabled)
        {
            $this->getColumnBySlug('name')->secondaryHeaderFilter('name');
            
            $this->getColumnBySlug('e-mail')->secondaryHeader($this->getFilterByKey('email'));
            $this->getColumnBySlug('active')->secondaryHeaderFilter('active');
            

        }
    }
}
