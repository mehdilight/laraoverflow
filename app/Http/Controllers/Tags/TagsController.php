<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $searchQuery = $request->query('q');

            return Tag::query()
                ->when($searchQuery, function (Builder $query) use ($searchQuery) {
                    $query->where('name', 'like',  sprintf('%%%s%%', $searchQuery));
                })
                ->limit(3)
                ->get()
                ->transform(fn(Tag $tag, $key) => [
                    'option' => $tag->getAttribute('name'),
                    'id'     => $tag->getAttribute('id'),
                ]);
        }

        return view('pages.tags.index');
    }
}
