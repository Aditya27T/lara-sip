<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportvote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_id',
        'vote'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function getVoteAttribute($value)
    {
        return $value ? 'Upvote' : 'Downvote';
    }

    public function setVoteAttribute($value)
    {
        if ($value == 'Upvote') {
            $this->attributes['vote'] = 1;
        } else {
            $this->attributes['vote'] = 0;
        }
    }
}
