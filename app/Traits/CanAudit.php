<?php

namespace App\Traits;

use App\Repositories\AuditHistoryRepository;

trait CanAudit
{
    public function audit($data)
    {
        $repo = new AuditHistoryRepository;

        $repo->create($data);
    }

}
