<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Character
 * @package App\Http\Models
 */
class Character extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'job_id',
        'appearance_id',
        'name',
        'gender',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
