<?php

namespace App\Repositories;

use App\Models\AuditHistory;

class RaceRepository extends BaseRepository
{
    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->model = new AuditHistory;
    }
}
