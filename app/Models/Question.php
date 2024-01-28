<?php

namespace App\Models;

use App\Models\Filter\Filters;
use App\Models\QueryMutators\QueryMutator;
use App\Models\QueryMutators\Question\SortingMutator;
use App\Models\QueryMutators\Question\TagsMutator;
use App\Models\Traits\Commentable;
use App\Models\Traits\Votable;
use DOMDocument;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;
    use Commentable;
    use Votable;

    protected $guarded = [];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeFilter(Builder $query, Filters $filters): void
    {
        /** @var Pipeline $pipeline */
        $pipeline = app(Pipeline::class);

        $pipeline->send(
            new QueryMutator($query, $filters)
        )->through(
            [
                SortingMutator::class,
                TagsMutator::class
            ]
        )->thenReturn();
    }

    public function summary(): string
    {
        $body = $this->getAttribute('body');
        $dom = new DOMDocument();
        $dom->loadHTML($body);

        return Str::limit($dom->textContent, 150);
    }
}
