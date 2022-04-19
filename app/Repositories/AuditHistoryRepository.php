<?php

namespace App\Repositories;

use App\Models\AuditHistory;

class AuditHistoryRepository extends BaseRepository
{
    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->model = new AuditHistory;
    }
}
