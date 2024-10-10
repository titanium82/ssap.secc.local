<?php

namespace App\Admin\DataTables\Customer;

class OneCustomerContactDataTable extends CustomerContactDataTable
{
    public string $nameModule = 'admin';

    public string $nameTable = 'customer_contact';
    
    protected string $dataTableVariable = 'customer_contact_datatable';

    protected function setUrlFetchData(): void
    {
        $this->urlFetchData = route('admin.customer.render_contact_dt', $this->customer_id);
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
        return $this->repository->getByQueryBuilder(['customer_id' => $this->customer_id], ['customer', 'admin']);
    }
}