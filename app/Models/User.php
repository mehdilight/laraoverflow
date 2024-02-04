<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    protected function isAuthenticated(): Attribute
    {
        return Attribute::make(function () {
            return Auth::user()?->getAttribute('id') === $this->getAttribute('id');
        });
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarkLists(): HasMany
    {
        return $this->hasMany(BookmarkList::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function bookmarked(Model $model): bool
    {
        return $this->bookmarks
            ->where(get_class($model) === Question::class ? 'question_id' : 'answer_id', $model->id)
            ->first() instanceof Bookmark;
    }

    public function upvoted(Model $model): bool
    {
        return $this->votes
            ->where('votable_type', get_class($model))
            ->where('votable_id', $model->id)
            ->first()?->value === Vote::UPVOTE_TYPE;
    }

    public function downvoted(Model $model): bool
    {
        return $this->votes
                ->where('votable_type', get_class($model))
                ->where('votable_id', $model->id)
                ->first()?->value === Vote::DOWN_UPVOTE_TYPE;
    }

    protected function profilePhotoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->profile_photo_path
                ? Storage::disk('public')->url($this->profile_photo_path)
                : $this->defaultProfilePhotoUrl();
        });
    }

    protected function defaultProfilePhotoUrl(): string
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }
}
