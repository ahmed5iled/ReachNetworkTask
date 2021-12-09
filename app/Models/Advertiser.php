<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 */
class Advertiser extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'advertisers';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'email'];

    /**
     * @return HasMany
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class, 'advertiser_id');
    }
}
