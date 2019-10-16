<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 * @package App\Http\Models
 */
class Stat extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'character_id',
        'health',
        'mana',
        'attack_power',
        'defence',
        'magic_power',
        'intelligence',
        'agility',
        'resistance',
        'level',
        'level_percentage',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
