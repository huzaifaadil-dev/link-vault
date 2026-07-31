<?php

namespace App\Http\Controllers;

use App\Actions\Tag\GetTags;
use App\Http\Resources\TagResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TagsController extends Controller
{
    public function index(Request $request): Response
    {
        $perPage = $request->integer('per_page', 15);

        return Inertia::render('tags/index', [
            'tags' => TagResource::collection(
                GetTags::handle(Auth::user(), $perPage)
            ),
        ]);
    }
}
