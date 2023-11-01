<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ads extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'show_in',
        'status',
        'start_at',
        'end_at',
        'credit',
        'link'
    ];

    /**
     * Get the category that owns the Ads
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'show_in', 'id');
    }
}
