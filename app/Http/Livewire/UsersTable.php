<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\{Builder,Collection};
use Illuminate\Pagination\{Paginator, CursorPaginator,LengthAwarePaginator};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Cache,Storage};
use Livewire\Attributes\On; 
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{BooleanColumn, ButtonGroupColumn, ColorColumn, ComponentColumn, ImageColumn, LinkColumn};
use Rappasoft\LaravelLivewireTables\Views\Filters\{DateFilter, DateRangeFilter, DateTimeFilter, MultiSelectDropdownFilter, MultiSelectFilter, NumberFilter, NumberRangeFilter, SelectFilter, TextFilter};
use App\Exports\UsersExport;
use App\Models\{Tag, User};
use App\Traits\Tables\UsesDemoTables;

class UsersTable extends DataTableComponent
{
    use UsesDemoTables;
    
    public $myParam = 'Default';

    public string $tableName = 'users2';

    public array $users2 = [];

    public bool $onlyOpen = false;

    public array $allTags = [];

    public bool $secondaryHeaderEnabled = false;

    public User $userInstance;

    public array $tagFilterList = [];

    public array $userFilterList = [];

    #[Reactive] 
    public string $testWireable = 'tesat 123';

    #[On('update-the-filter')] 
    public function updateTheFilter()
    {
        return;
    }

    
    public function getTagFilterList()
    {
        $this->tagFilterList = $tagFilterList = Cache::remember('allTags', 3600, function () {
            return Tag::select('id', 'name', 'created_at')->orderBy('name')
            ->get()
            ->pluck('name','id')->toArray();
        });

        return $tagFilterList;
    }

    public function getUserFilterList()
    {
        $this->userFilterList = $userFilterList = Cache::remember('allUsers', 3600, function () {
            return User::select('name','id')
            ->get()
            ->pluck('name','id')->toArray();
        });


        return $userFilterList;
    }

    public function configuring(): void
    {

        $this->setReorderEnabled()
        ->setHideBulkActionsWhenEmptyEnabled()
        ->setSingleSortingDisabled()
        ->setTableRowUrl(function ($row) {
            return 'https://google-'.$row->id.'.com';
        })
        ->setTableRowUrlTarget(function ($row) {
            return '_blank';
        });
    }

    public function configure(): void
    {
        $componentQueryString = [];
        $this->setPrimaryKey('id')
        ->setAdditionalSelects(['users.id as id', 'users.parent_id as parent_id', 'users.remember_token as remember_token'])
        ->setReorderDisabled()
        ->setDefaultReorderSort('sort', 'asc')
        ->setEagerLoadAllRelationsDisabled()
        ->setPerPageAccepted([10, 25, 50, 100])
        ->setHideReorderColumnUnlessReorderingDisabled()
        ->setLoadingPlaceholderEnabled()
        ->setFilterLayout($this->filterLayout)
        ->setPaginationVisibilityStatus(true)
        ->setConfigurableAreas([
            'before-tools' => 'tables.user-before-tools'
        ])
        ->setQueryStringEnabled();


    }

    public function placeholder()
    {
        return <<<'HTML'
        <div style="font-size: xxx-large">
            COMPONENT PLACEHOLDER
        </div>
        HTML;
    }

    public function configured(): void
    {
    }


    public function prependColumns(): array
    {
       return [

        ];
    }

    public function appendColumns(): array
    {
        return [
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
    public function columns(): array
    {
        return [
            Column::make('Order', 'sort')
            ->sortable(),

            Column::make("sortsortsort")->label(fn($row) => $row->sort),

            ColorColumn::make('Favourite Colour', 'favourite_color'),
            Column::make('DD')
            ->label(function ($row) {
              return $row->id;
            }),

            ImageColumn::make('Avatar')
            ->location(
                fn($row) => 'https://i.pravatar.cc/100?u=' . $row->remember_token
                )
            ->attributes(fn($row) => [
                'class' => 'rounded-full',
                'alt' => $row->name . ' Avatar',
            ]),
            Column::make('PWD')
            ->label(function ($row) {
              return $row->password;
            }),

            Column::make('Name')
                ->sortable(function (Builder $query, string $direction) {
                    return $query->orderBy('users.name', $direction); // Example, ->sortable() would work too.
                })
                ->searchable()
                ->excludeFromColumnSelect()
                //->collapseOnMobile()
                ->footer($this->getFilterByKey('name')),

    
            Column::make('Test2')
            ->label(function ($row) {
              return $row->success_rate;
            })
            ->collapseOnTablet()
            ->sortable(function(Builder $query, string $direction) {
              return $query->orderBy('users.name', $direction);
            }),

            BooleanColumn::make('Has Parent', 'has_parent')
            ->setCallback(function (string $value, $row) {
                return $row->has_parent;
            })
            ->collapseOnMobile()
            ->footer(fn ($rows) => $rows->count()),

            Column::make('Parent', 'parent.name'),

            Column::make('Success Rate')
            ->sortable(function (Builder $query, string $direction) {
                return $query->orderBy('success_rate', $direction); // Example, ->sortable() would work too.
            })
            //->collapseOnTablet()
            ->searchable(),

            Column::make('E-Mail', 'email')
            ->sortable(function (Builder $query, string $direction) {
                return $query->orderBy('email', $direction); // Example, ->sortable() would work too.
            })
            ->searchable(
                function (Builder $query, $searchTerm) {
                    $query->orWhere('users.email', 'like', '%'.$searchTerm.'%');
                } 
            )
            ->secondaryHeaderFilter('email')
            ->footer($this->getFilterByKey('email')),


            Column::make('Verified At', 'email_verified_at')
            ->sortable()
            ->searchable()
            //->collapseOnTablet()
            ->format(
                fn ($value, $row, Column $column) => Carbon::parse($value)->format('d M Y')
            ),

            Column::make('Address', 'address.address')
            ->sortable()
            ->collapseAlways()
            ->searchable()
                        ->footer(function($rows) {
                return 'Count: ' . $rows->count(). ' of ' . $this->paginationTotalItemCount;
            }),
           

            Column::make('Address Group', 'address.group.name')
                ->sortable()
                //->collapseOnTablet()
                ->setCustomSlug('addressgroupname')
                ->searchable(),

            Column::make('Group City', 'address.group.city.name')
                ->sortable()
                ->setCustomSlug('addressgroupcityname')
                ->searchable(),

            BooleanColumn::make('Active')
                ->sortable()
                ->footerFilter('active'),

            Column::make('Tags')
                ->label(fn ($row) => $row->tags->pluck('name')->implode(', ')),



        ];
    }

    public function filters(): array
    {
        return [ 
           // LivewireComponentFilter::make('My External Filter')
          //  ->setLivewireComponent('select-2-filter')
          //  ->filter(function (Builder $builder, array $values) {
         //       dd($values);
         //       //$builder->where('users.name', 'like', '%'.$value.'%');
         //   }),
            SelectFilter::make('UserFilter')
            ->options(
                (!empty($this->userFilterList) ? $this->userFilterList : $this->getUserFilterList())
            ),

            MultiSelectDropdownFilter::make('TagFilter')
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
                })
                ->setCustomView('text-custom-view'),

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
                    'prefix' => '!',
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
      //  dd();

    }

   // public function rowsRetrieved($data)
   // {
  //      dd($data);
  //  }

}
