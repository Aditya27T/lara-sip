<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'status',
        'description',
        'image'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }   

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value);
    }
    
}
