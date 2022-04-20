<?php

namespace App\Http\Controllers;

use App\Repositories\AuditHistoryRepository;
use Throwable;

class AuditHistoryController extends BaseController
{
    protected $repo;
    protected $logData;

    public function __construct(AuditHistoryRepository $auditHistoryRepo) {
        $this->repo = $auditHistoryRepo;
        $this->logData = [
            'controller' => 'AuditHistoryController',
            'method' => null
        ];
    }

}
