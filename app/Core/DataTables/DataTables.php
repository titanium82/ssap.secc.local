<?php

namespace App\Core\DataTables;

use Yajra\DataTables\Services\DataTable as BaseDataTable;
use Yajra\DataTables\Html\Column;

abstract class DataTables extends BaseDataTable
{
    /**
     * ['pageLength', 'excel', 'reset', 'reload']
     *
     * @var array
     */
    protected array $actions = ['reset', 'reload'];
    /**
     * Mảng chứa đường dẫn tới views
     *
     * @var array
     */
    protected $viewColumns;
    /**
     * Current Object instance
     *
     * @var object|array|mixed
     */
    protected $instanceDataTable;
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    protected $instanceHtml;
    /**
     * make columns
     *
     * @var array
     */
    protected array $buildColumns = [];

    protected array $configColumns = [];

    protected array $editColumns;

    protected array $addColumns;

    protected array $filterColumns;

    protected array $rawColumns;

    protected array $removeColumns = [];

    protected array $columnHasSearch;

    protected array $columnSearchDate;

    protected array $columnSearchSelect;

    protected array $columnSearchSelect2;

    public string $nameModule = '';

    public string $nameTable = '';

    protected array $parameters;

    protected string $urlFetchData = '';

    protected function getConfigColumns(): void
    {
        $arr = explode('\\', (new \ReflectionClass(get_class($this)))->name);

        if($this->nameModule == '')
        {
            $this->nameModule = strtolower($arr[1]);
        }

        if($this->nameTable == '')
        {
            $this->nameTable = str()->snake(str_replace('DataTable', '', $arr[count($arr)-1]));
        }

        $this->configColumns = config($this->nameModule. '.datatables_columns.' . $this->nameTable, []);

        if(count($this->getRemoveColumns()) > 0)
        {
            foreach($this->removeColumns as $value)
            {
                unset($this->configColumns[$value]);
            }
        }
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [];
    }

    protected function setEditColumns(): void
    {
        $this->editColumns = [];
    }

    protected function setAddColumns(): void
    {
        $this->addColumns = [];
    }

    protected function setFilterColumns(): void
    {
        $this->filterColumns = [];
    }

    protected function setRawColumns(): void
    {
        $this->rawColumns = [];
    }

    public function makeParameters(): array
    {
        return $this->parameters = [
            // 'responsive' => true,
            'ordering' => true,
            'autoWidth' => false,
            // 'searching' => false,
            // 'searchDelay' => 350,
            'lengthMenu' => [ [15, 50, -1], [20, 50, 100, "All"] ], //Số lượng dòng hiển thị trên trang DS Hợp Đồng
            'language' => [
                'url' => asset('/public/core/libs/datatables/lang/'.trans()->getLocale().'.json')
            ]
        ];
    }

    protected function setRemoveColumns(): void
    {
        $this->removeColumns = [];
    }

    protected function getRemoveColumns(): array
    {
        $this->setRemoveColumns();

        return $this->removeColumns;
    }

    protected function handleRemoveColumns(): void
    {
        if(count($this->getRemoveColumns()) > 0){
            foreach($this->removeColumns as $value){
                unset($this->editColumns[$value], $this->addColumns[$value], $this->filterColumns[$value], $this->rawColumns[$value]);
            }
        }
    }

    protected function buildColumns(): array
    {

        $this->exportVisiableColumns();

        foreach($this->configColumns as $key => $items)
        {
            if(!in_array($key, $this->removeColumns))
            {
                $buildColumn = Column::make($key);

                if(empty($items['addClass']))
                {
                    $items['addClass'] = '';
                }

                foreach($items as $key => $item)
                {
                    if($key == 'title'){
                        $buildColumn = $buildColumn->$key(__($item));
                    }elseif($key == 'addClass')
                    {
                        $buildColumn = $buildColumn->$key($item. ' align-middle');
                    }else{
                        $buildColumn = $buildColumn->$key($item);
                    }
                }
                array_push($this->buildColumns, $buildColumn);
            }
        }
        return $this->buildColumns;
    }

    protected function makeEditColumns(): void
    {
        $this->setEditColumns();

        foreach($this->editColumns as $key => $value)
        {
            $this->instanceDataTable = $this->instanceDataTable->editColumn($key, $value);
        }
    }

    protected function makeAddColumns(): void
    {
        $this->setAddColumns();

        foreach($this->addColumns as $key => $value)
        {
            $this->instanceDataTable = $this->instanceDataTable->addColumn($key, $value);
        }
    }

    protected function makeFilterColumns(): void
    {
        $this->setFilterColumns();

        foreach($this->filterColumns as $key => $value)
        {
            $this->instanceDataTable = $this->instanceDataTable->filterColumn($key, $value);
        }
    }

    protected function setUrlFetchData(): void
    {
        $this->urlFetchData = '';
    }
    protected function getUrlFetchData(): string
    {
        $this->setUrlFetchData();

        return $this->urlFetchData;
    }

    protected function makeRawColumns(): void
    {
        $this->setRawColumns();

        $this->instanceDataTable = $this->instanceDataTable->rawColumns($this->rawColumns);
    }

    protected function makeColumns(): void
    {
        $this->makeEditColumns();
        $this->makeAddColumns();
        $this->makeFilterColumns();
        $this->makeRawColumns();
        $this->handleRemoveColumns();
    }

    protected function exportVisiableColumns(): void
    {
        if ($this->request && in_array($this->request->get('action'), ['excel', 'csv']))
        {
            if ($this->request->get('visible_columns'))
            {
                foreach ($this->configColumns as $key => $item)
                {
                    if (!in_array($key, $this->request->get('visible_columns')))
                    {
                        $this->configColumns[$key]['exportable'] = false;
                    }
                }
            }
        }
    }

    protected function makeBuilderDataTable($query): void
    {
        $this->instanceDataTable = datatables()->eloquent($query);
    }

    protected function setColumnHasSearch(): void
    {
        $this->columnHasSearch = [];
    }

    protected function getColumnHasSearch(): array
    {
        $this->setColumnHasSearch();

        return $this->convertColumnSearch($this->columnHasSearch);
    }

    protected function setColumnSearchDate(): void
    {
        $this->columnSearchDate = [];
    }

    protected function getColumnSearchDate(): array
    {
        $this->setColumnSearchDate();

        return $this->convertColumnSearch($this->columnSearchDate);
    }

    protected function setColumnSearchSelect(): void
    {
        $this->columnSearchSelect = [];
    }

    protected function getColumnSearchSelect(): array
    {
        $this->setColumnSearchSelect();

        return $this->convertColumnSearchSelect($this->columnSearchSelect);
    }
    protected function setColumnSearchSelect2(): void
    {
        $this->columnSearchSelect2 = [];
    }

    protected function getColumnSearchSelect2(): array
    {
        $this->setColumnSearchSelect2();

        return $this->convertColumnSearchSelect($this->columnSearchSelect2);
    }

    protected function convertColumnSearchSelect($columns): array
    {
        if(count($columns) || count($this->configColumns))
        {
            $col = [];

            $configColumns = array_keys($this->configColumns);

            foreach($columns as $key => $item)
            {
                $index = array_search($key, $configColumns);

                if($index !== false)
                {
                    $col[$index] = $item;
                }
            }
            return $col;
        }

        return [];
    }

    protected function convertColumnSearch($columns)
    {
        if(count($columns) || count($this->configColumns))
        {
            $col = [];

            $configColumns = array_keys($this->configColumns);

            foreach($columns as $value)
            {
                $index = array_search($value, $configColumns);

                if($index !== false)
                {
                    array_push($col, $index);
                }
            }
            return $col;
        }

        return [];
    }

    protected function htmlParameters()
    {
        $this->makeParameters();

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#{$this->nameTable}');

            searchColumsDataTable(this, ".json_encode($this->getColumnHasSearch()).", ".json_encode($this->getColumnSearchDate()).", ".json_encode($this->getColumnSearchSelect()).", ".json_encode($this->getColumnSearchSelect2()).");

            addWrapTableScroll('#{$this->nameTable}');

            ".( !empty($this->getColumnSearchSelect2()) ? 'addSelect2(); select2LoadDataMany();' : '' )."
        }";

        $this->instanceHtml = $this->instanceHtml->parameters($this->parameters);
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setViewColumns();

        $this->makeBuilderDataTable($query);

        $this->makeColumns();

        return $this->instanceDataTable;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $this->getConfigColumns();

        $this->instanceHtml = $this->builder()
        ->setTableId($this->nameTable)
        ->columns($this->buildColumns())
        ->minifiedAjax($this->getUrlFetchData())
        // ->ajax($this->getUrlFetchData())
        ->dom('Bfrtip')
        ->orderBy(0)
        ->selectStyleSingle();

        $this->htmlParameters();

        return $this->instanceHtml;
    }

    protected function filename(): string
    {
        return $this->nameTable .'-' . date('YmdHis');
    }
}
