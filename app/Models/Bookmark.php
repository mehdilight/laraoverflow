<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Bookmark extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookmarkList(): BelongsTo
    {
        return $this->belongsTo(BookmarkList::class);
    }

    public function bookmarkable(): MorphTo
    {
        return $this->morphTo();
    }
}
