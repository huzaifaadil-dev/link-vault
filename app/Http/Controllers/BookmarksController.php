<?php

namespace App\Http\Controllers;

use App\Actions\Bookmark\CreateBookmark;
use App\Actions\Bookmark\GetBookmarks;
use App\Actions\Category\GetCategoryOptions;
use App\Actions\Tag\GetTagOptions;
use App\Data\BookmarkData;
use App\Http\Requests\Bookmarks\CreateBookmarkRequest;
use App\Http\Resources\BookmarkResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BookmarksController extends Controller
{
    public function index(Request $request): Response
    {
        $perPage = $request->integer('per_page', 15);

        return Inertia::render('bookmarks/index', [
            'bookmarks' => BookmarkResource::collection(
                GetBookmarks::handle(Auth::user(), $perPage)
            ),
            'categories' => Inertia::defer(
                fn () => CategoryResource::collection(GetCategoryOptions::handle(Auth::user()))
            ),
            'tags' => Inertia::defer(
                fn () => TagResource::collection(GetTagOptions::handle(Auth::user()))
            ),
        ]);
    }

    public function store(CreateBookmarkRequest $request): RedirectResponse
    {
        $data = BookmarkData::from([
            ...$request->validated(),
            'tags' => $request->validated('tags', []),
            'is_favorite' => $request->boolean('is_favorite'),
            'read_later' => $request->boolean('read_later'),
        ]);

        CreateBookmark::handle($data, Auth::user());

        return Inertia::flash('success', 'Bookmark created successfully')->back();
    }
}
