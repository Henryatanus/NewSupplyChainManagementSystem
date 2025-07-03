<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorApplication extends Model
{
    protected $fillable = [
        'user_id',
        'pdf_path',
        'financial_score',
        'reputation_score',
        'regulatory_clearance',
        'status',
        'scheduled_visit_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
