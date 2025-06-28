<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Response;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAll()
    {
        return Response::success(data: $this->categoryService->getAll());
    }

    public function getAllActive()
    {
        return Response::success(data: $this->categoryService->getAllActive());
    }

    public function getById(int $id)
    {
        try {
            $category = $this->categoryService->getById($id);
            return Response::success(data: $category);
        } catch (ModelNotFoundException $e) {
            return Response::notFoundError("category");
        }
    }

    public function create(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->create($request->validated());

        return Response::success(
            t("created_success", "category"),
            $category,
            201
        );
    }

    public function update(int $id, UpdateCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->update($id, $request->validated());

            return Response::success(
                t("updated_success", "category"),
                $category
            );
        } catch (ModelNotFoundException $e) {
            return Response::notFoundError("category");
        }
    }

    public function updateActive(int $id)
    {
        try {
            $category = $this->categoryService->updateActive($id);

            return Response::success(
                t("active_updated_success", "category"),
                $category
            );
        } catch (ModelNotFoundException $e) {
            return Response::notFoundError("category");
        }
    }

    public function delete(int $id)
    {
        try {
            $this->categoryService->delete($id);

            return Response::success(
                 t("deleted_success", "category")
            );
        } catch (ModelNotFoundException $e) {
            return Response::notFoundError("category");
        }
    }
}
