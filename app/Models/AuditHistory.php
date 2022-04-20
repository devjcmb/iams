<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditHistory extends Model
{
    use HasFactory;

    protected $table = "audit_history";

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'data'
    ];

}

