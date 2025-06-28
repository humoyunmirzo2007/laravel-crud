<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return response()->json([
            "data" => $this->productService->getAll()
        ], 200);
    }

    public function getById(int $id)
    {
        try {
            $product = $this->productService->getById($id);

            return response()->json([
                "data" => $product
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.not_found", ["item" => __("messages.product")]),
            ], 404);
        }
    }

    public function getAllActive()
    {
        return response()->json([
            "data" => $this->productService->getAllActive()
        ], 200);
    }

    public function getByCategoryId(int $id)
    {

        return response()->json([
            "data" => $this->productService->getByCategoryId($id)
        ], 200);
    }

    public function getByBrandId(int $id)
    {

        return response()->json([
            "data" => $this->productService->getByBrandId($id)
        ], 200);
    }

    public function create(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());

        return response()->json([
            "message" => __("messages.created_success", ["item" => __("messages.product")]),
            "data" => $product
        ], 201);
    }

    public function update(int $id, UpdateProductRequest $request)
    {
        $product = $this->productService->update($id, $request->validated());

        return response()->json([
            "message" => __("messages.updated_success", ["item" => __("messages.product")]),
            "data" => $product
        ], 200);
    }

    public function updateActive(int $id)
    {
        try {
            $product = $this->productService->updateActive($id);
            $productStatus = $product->active ? __("messages.activated") : __("messages.deactivated");

            return response()->json([
                "message" => __("messages.active_updated_success", ["status" => $productStatus, "item" => __("messages.product")]),
                "data" => $product
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.not_found", ["item" => __("messages.product")]),
            ], 404);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->productService->delete($id);

            return response()->json([
                "message" => __("messages.deleted_success", ["item" => __("messages.product")]),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.not_found", ["item" => __("messages.product")]),
            ], 404);
        }
    }
}
