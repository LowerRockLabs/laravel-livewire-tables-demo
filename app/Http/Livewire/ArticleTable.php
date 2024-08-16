<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\{Builder,Collection};
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\{Paginator, CursorPaginator,LengthAwarePaginator};
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{BooleanColumn,ImageColumn,ButtonGroupColumn,ComponentColumn,LinkColumn, DateColumn};
use Rappasoft\LaravelLivewireTables\Views\Filters\{DateFilter,NumberFilter,MultiSelectFilter,SelectFilter,TextFilter};
use App\Traits\Tables\UsesDemoTables;
use App\Exports\ArticleExport;
use App\Models\Article;

class ArticleTable extends DataTableComponent
{
    use UsesDemoTables;

    public $myParam = 'Default123';

    public string $tableName = 'articletable';

    public array $articletable = [];

    public array $fileList;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['articles.id as id'])
            ->setFilterLayout($this->filterLayout)
            ->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
                if ($column->getTitle() == 'Title') {
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
                if ($column->isField('id')) {
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
                if ($column->isField('title')) {
                    return ['class' => 'text-green-500'];
                }

                return ['default' => true];
            })
            ->setQueryStringAlias('article-table')
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setEagerLoadAllRelationsEnabled()
            ->setSearchDebounce(500);
            $this->useComputedPropertiesEnabled();

    }

    public function columns(): array
    {



        return [
            Column::make('Article ID', 'id')
            ->sortable()
            ->collapseOnMobile()
            ->excludeFromColumnSelect(),

            Column::make('Title')
                ->sortable(function (Builder $query, string $direction) {
                    return $query->orderBy('title', $direction); // Example, ->sortable() would work too.
                })
                ->searchable()
                ->secondaryHeader($this->getFilterByKey('title'))
                ->footer($this->getFilterByKey('title'))->excludeFromColumnSelect(),

                Column::make('Country')
                ->sortable(function (Builder $query, string $direction) {
                    return $query->orderBy('country', $direction); // Example, ->sortable() would work too.
                })
                ->searchable()
                ->collapseOnTablet(),
    
            BooleanColumn::make('Is Published', 'is_published'),
            
            Column::make('Likes', 'likes')->sortable(),

            Column::make('User', 'user.name')->searchable()
            ->collapseOnTablet(),

            DateColumn::make('Published At', 'published_at')
            ->inputFormat('Y-m-d H:i:s')
            ->outputFormat('Y-m-d H:i:s')
            ->sortable(function (Builder $query, string $direction) {
                return $query->orderBy('published_at', $direction); // Example, ->sortable() would work too.
            })
            ->searchable()
            ->collapseOnTablet(),

            Column::make('Published By', 'published_by')
            ->sortable(function (Builder $query, string $direction) {
                return $query->orderBy('published_by', $direction); // Example, ->sortable() would work too.
            })
            ->searchable()
            ->collapseOnMobile(),

        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Title')
            ->config([
                'maxlength' => 10,
                'placeholder' => 'Search Title',
            ])
            ->filter(function (Builder $builder, string $value) {
                $builder->where('title', 'like', '%'.$value.'%');
            }),
            NumberFilter::make('Minimum Likes', 'min_like_filter')
                ->filter(function (Builder $builder, int $value) {
                    return $builder->where('likes', '>', $value);
                }),
            SelectFilter::make('Published', 'published_status')
            ->options(
                [
                    '' => 'Select',
                    0 => 'No',
                    1 => 'Yes',
                ]
            )
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('is_published', $value);
            })

        ];
    }

    public function builder(): Builder
    {
        return Article::with(['user:id,name']);
    }

    public function bulkActions(): array
    {
        return [
            'publish' => 'Publish',
            'unpublish' => 'Unpublish',
            'export' => 'Export',
        ];
    }

    public function export()
    {
        $articles = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new ArticleExport($articles), 'articles.xlsx');
    }

    public function publish()
    {
        Article::whereIn('id', $this->getSelected())->update(['is_published' => true]);

        $this->clearSelected();
    }

    public function unpublish()
    {
        Article::whereIn('id', $this->getSelected())->update(['is_published' => false]);

        $this->clearSelected();
    }
    
    public function prependRows($rows)
    {
        $newRow = new Article;
        $newRow->id ='1';
        $rows->push($newRow);

        return $rows;
    }


}
