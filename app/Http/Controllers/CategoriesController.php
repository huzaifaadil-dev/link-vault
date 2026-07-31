<?php

namespace App\Http\Controllers;

use App\Actions\Category\GetCategories;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

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
}
