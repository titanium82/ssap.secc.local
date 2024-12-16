<?php

namespace App\Admin\DataTables\Customer;

use App\Admin\DataTables\Exhibition\ExhibitionEventDataTable;

class CustomerExhibitionEventDataTable extends ExhibitionEventDataTable
{
    public string $nameModule = 'admin';

    public string $nameTable = 'exhibition_event';

    protected string $dataTableVariable = 'customer_exhibitionevent_datatable';

    protected function setUrlFetchData(): void
    {
        $this->urlFetchData = route('admin.customer.render_exhibitionevent_dt', $this->customer_id);
    }

    protected function setRemoveColumns(): void
    {
        $this->removeColumns = ['customer_id', 'admin_id'];
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getByQueryBuilder(['customer_id' => $this->customer_id], ['customer','admin'])->currentAuth();
    }
}
