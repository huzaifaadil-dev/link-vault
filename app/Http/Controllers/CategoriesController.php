<?php

namespace App\Http\Controllers;

use App\Actions\Category\CreateCategory;
use App\Actions\Category\GetCategories;
use App\Data\CategoryData;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CategoriesController extends Controller
{
    public function index(Request $request): Response
    {
        $perPage = $request->integer('per_page', 15);

        return Inertia::render('categories/index', [
            'categories' => CategoryResource::collection(
                GetCategories::handle(Auth::user(), $perPage)
            ),
        ]);
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        $data = CategoryData::from($request->validated());

        CreateCategory::handle($data, Auth::user());

        return Inertia::flash('success', 'Category created successfully')->back();
    }
}
