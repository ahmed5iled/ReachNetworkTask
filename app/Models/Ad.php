<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *
 */
class Ad extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'ads';

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'description', 'category_id', 'type', 'advertiser_id', 'start_date'];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'ad_tags', 'ad_id', 'tag_id')
            ->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function advertiser(): BelongsTo
    {
        return $this->belongsTo(Advertiser::class, 'advertiser_id');
    }
}
