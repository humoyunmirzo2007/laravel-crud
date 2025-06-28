<?php

namespace App\Http\Controllers;

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
        return response()->json([
            "data" => $this->categoryService->getAll()
        ], 200);
    }

    public function getAllActive()
    {
        return response()->json([
            "data" => $this->categoryService->getAllActive()
        ], 200);
    }

    public function getById(int $id)
    {
        try {
            $category = $this->categoryService->getById($id);
            return response()->json([
                "data" => $category
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.not_found", ["item" => __("messages.category")]),
            ], 404);
        }
    }

    public function create(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->create($request->validated());

        return response()->json([
            "message" => __("messages.created_success", ["item" => __("messages.category")]),
            "data" => $category
        ], 201);
    }

    public function update(int $id, UpdateCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->update($id, $request->validated());

            return response()->json([
                "message" => __("messages.updated_success", ["item" => __("messages.category")]),
                "data" => $category
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.not_found", ["item" => __("messages.category")]),
            ], 404);
        }
    }

    public function updateActive(int $id)
    {
        try {
            $category = $this->categoryService->updateActive($id);
            $categoryStatus = $category->active ? __("messages.activated") : __("messages.deactivated");

            return response()->json([
                "message" => __("messages.active_updated_success", ["status" => $categoryStatus, "item" => __("messages.category")]),
                "data" => $category
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.not_found", ["item" => __("messages.category")]),
            ], 404);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->categoryService->delete($id);

            return response()->json([
                "message" => __("messages.deleted_success", ["item" => __("messages.category")])
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.not_found", ["item" => __("messages.category")]),
            ], 404);
        }
    }
}
