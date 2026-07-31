<?php

namespace App\Http\Controllers;

use App\Actions\Bookmark\GetBookmarks;
use App\Http\Resources\BookmarkResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class BookmarksController extends Controller
{
    public function index(Request $request): Response
    {
        $perPage = $request->integer('per_page', 15);

        return Inertia::render('bookmarks/index', [
            'bookmarks' => BookmarkResource::collection(
                GetBookmarks::handle(Auth::user(), $perPage)
            ),
        ]);
    }
}
