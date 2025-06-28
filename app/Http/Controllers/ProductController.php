<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Response;
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

    public function getAll()
    {
        return Response::success(data: $this->productService->getAll());
    }

    public function getById(int $id)
    {
        try {
            $product = $this->productService->getById($id);

            return Response::success(data: $product);
        } catch (ModelNotFoundException) {
            return Response::notFoundError("product");
        }
    }

    public function getAllActive()
    {
        return Response::success(data: $this->productService->getAllActive());
    }

    public function getByCategoryId(int $id)
    {
        return Response::success(data: $this->productService->getByCategoryId($id));
    }

    public function getByBrandId(int $id)
    {
        return Response::success(data: $this->productService->getByBrandId($id));
    }

    public function create(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());

        return Response::success(
            t("created_success", "product"),
            $product,
            201
        );
    }

    public function update(int $id, UpdateProductRequest $request)
    {
        $product = $this->productService->update($id, $request->validated());

        return Response::success(
            t("updated_success", "product"),
            $product,
        );
    }

    public function updateActive(int $id)
    {
        try {
            $product = $this->productService->updateActive($id);

            return Response::success(
                t("active_updated_success", "product"),
                $product,
            );
        } catch (ModelNotFoundException) {
            return Response::notFoundError("product");
        }
    }

    public function delete(int $id)
    {
        try {
            $this->productService->delete($id);

            return Response::success(
                t("deleted_success", "product"),
            );
        } catch (ModelNotFoundException) {
            return Response::notFoundError("product");
        }
    }
}
