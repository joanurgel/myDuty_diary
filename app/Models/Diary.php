<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
    
    protected $fillable = [
        'author_id',
        'supervisor_id',
        'plan_today',
        'end_day',
        'plan_tomorrow',
        'roadblocks',
        'summary',
        'status'
    ];
}
