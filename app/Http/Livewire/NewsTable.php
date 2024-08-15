<?php

namespace App\Http\Livewire;

use App\Exports\NewsExport;
use App\Models\News;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{ArrayColumn,BooleanColumn, ButtonGroupColumn, ComponentColumn, ImageColumn, LinkColumn};
use Rappasoft\LaravelLivewireTables\Views\Filters\{DateFilter, DateRangeFilter, DateTimeFilter, MultiSelectDropdownFilter, MultiSelectFilter, NumberFilter, NumberRangeFilter, SelectFilter, TextFilter};
use App\Traits\Tables\UsesDemoTables;

class NewsTable extends DataTableComponent
{
    use UsesDemoTables;

    public $myParam = 'Default123';

    public string $tableName = 'newstable';

    public array $newstable = [];

    public array $fileList;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['news.id as id'])
            ->setFilterLayout($this->filterLayout)
            ->setReorderEnabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
                if ($column->getTitle() == 'Address') {
                    return ['class' => 'text-red-500 break-all', 
                            'default' => false
                    ];
                }
                else return ['default' => true];

            })
            ->setSecondaryHeaderTrAttributes(function ($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setSecondaryHeaderTdAttributes(function (Column $column, $rows) {
                if ($column->isField('id') || $column->isField('address.address')) {
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
            ->setQueryStringAlias('news-table')
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setEagerLoadAllRelationsEnabled()
             ->setDefaultReorderSort('sort_order', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
            ->sortable()
            ->collapseOnMobile()
            ->deselected()
            ->excludeFromColumnSelect(),
            
            Column::make('sort_order', 'sort_order')
            ->sortable()
            ->collapseOnMobile(),
            
            Column::make('Name', 'name')
                ->sortable(function (Builder $query, string $direction) {
                    return $query->orderBy('news.name', $direction); // Example, ->sortable() would work too.
                })
                ->searchable()
                ->secondaryHeader($this->getFilterByKey('name'))
                ->footer($this->getFilterByKey('name')),

            Column::make('Description', 'description'),
            Column::make('User', 'user.name')
            ->searchable()
            ->collapseAlways(),

            ArrayColumn::make('Topics')
            ->data(fn($value, $row) => ($row->topics))
            ->outputFormat(fn($index, $value) => $value->title)
            ->collapseOnTablet()
            ->emptyValue('None')
            ->separator('<br />')
            ->sortable(),
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
                $builder->where('news.name', 'like', '%'.$value.'%');
            }),
            MultiSelectDropdownFilter::make('Topics', 'topics')
            ->options(
               $this->getTopicsForFilter()
            )
            ->setFirstOption('All')
            ->filter(function (Builder $builder, array $values) {
                return $builder->whereHas('topics', function (Builder $query) use ($values) {
                    $query->whereIn('topic_id', $values);
                });
            })

        ];
    }

    protected function getTopicsForFilter()
    {
        return Cache::rememberForever('topics-for-filter', function () {
            return Topic::select('id','title as name')->orderBy('name')->get()->pluck('name','id')->toArray();
        });
    }

    public function builder(): Builder
    {
        return News::with(['user','topics']);
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
        $news = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new NewsExport($news), 'news.xlsx');
    }

    public function activate()
    {
        News::whereIn('id', $this->getSelected())->update(['active' => true]);

        $this->clearSelected();
    }

    public function deactivate()
    {
        News::whereIn('id', $this->getSelected())->update(['active' => false]);

        $this->clearSelected();
    }


    public function reorder(array $items): void
    {
        News::upsert($items, [$this->getPrimaryKey()], ['sort_order']);
    }

}
