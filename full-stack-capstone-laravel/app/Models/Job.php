<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'company',
        'location',
        'description',
        'salary',
        'job_type',
        'skills',
    ];

    /**
     * Job belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Job has many applications.
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}