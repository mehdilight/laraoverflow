<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Votable;
use DOMDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Answer extends Model
{
    use HasFactory;
    use Commentable;
    use Votable;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookmark(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function summary(): string
    {
        $body = $this->getAttribute('body');
        $dom = new DOMDocument();
        $dom->loadHTML($body);

        return Str::limit($dom->textContent, 200);
    }
}
