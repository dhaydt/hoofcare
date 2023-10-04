<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Item extends Model
{
    use HasFactory;

    use Commentable;

    protected $fillable = [
        'name',
        'description',
        'online_link',
        'pic1',
        'pic2',
        'pic3',
        'pic4',
        'pic5',
        'file_link1',
        'file_link2',
        'credit',
        'category_id',
        'user_id',
        'status',
        'fb_id',
        'fb_post_id',
        'message',
    ];

    /**
     * Get the category that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the user that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the pdf1 that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file1(): BelongsTo
    {
        return $this->belongsTo(Flip::class, 'file_link1', 'id');
    }
    
    public function file2(): BelongsTo
    {
        return $this->belongsTo(Flip::class, 'file_link2', 'id');
    }
}
