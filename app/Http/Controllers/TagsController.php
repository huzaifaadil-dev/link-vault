<?php

namespace App\Http\Controllers;

use App\Actions\Tag\CreateTag;
use App\Actions\Tag\GetTags;
use App\Data\TagData;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Resources\TagResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

    public function store(CreateTagRequest $request): RedirectResponse
    {
        $data = TagData::from($request->validated());

        CreateTag::handle($data, Auth::user());

        return Inertia::flash('success', 'Tag created successfully')->back();
    }
}
