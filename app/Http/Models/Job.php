<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 * @package App\Http\Models
 */
class Job extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];
}
