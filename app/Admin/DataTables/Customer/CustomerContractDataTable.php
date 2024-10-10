<?php

namespace App\Admin\DataTables\Customer;

use App\Admin\DataTables\Contract\ContractDataTable;

class CustomerContractDataTable extends ContractDataTable
{
    public string $nameModule = 'admin';

    public string $nameTable = 'contract';
    
    protected string $dataTableVariable = 'customer_contract_datatable';

    protected function setUrlFetchData(): void
    {
        $this->urlFetchData = route('admin.customer.render_contract_dt', $this->customer_id);
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
        return $this->repository->getByQueryBuilder(['customer_id' => $this->customer_id], ['customer', 'type', 'admin'])->currentAuth();
    }
}