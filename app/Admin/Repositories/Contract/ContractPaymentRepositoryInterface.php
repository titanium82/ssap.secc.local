<?php

namespace App\Admin\Repositories\Contract;

use App\Core\Repositories\EloquentRepositoryInterface;

interface ContractPaymentRepositoryInterface extends EloquentRepositoryInterface
{
    public function uploadLicense($id, $license);
    
    public function accept($id);

    public function updateWrongStatusLate();
    
    public function getWrongStatusLate(array $relations = []);
    
    public function getDueReminder(array $relations = []);

    public function getLazyByIdWrongStatusLate($size = 1000, array $relations = []);

    public function getLazyByIdDueReminder($size = 1000, array $relations = []);
}