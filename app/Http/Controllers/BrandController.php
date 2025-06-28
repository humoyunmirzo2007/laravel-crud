<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\BrandService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        return response()->json([
            "data" => $this->brandService->getAll()
        ], 200);
    }

    public function create(StoreBrandRequest $request)
    {
        $brand = $this->brandService->create($request->validated());

        return response()->json([
            "message" => __("messages.brand_created_success"),
            "data" => $brand
        ], 201);
    }

    public function getById($id)
    {
        try {
            $brand = $this->brandService->getById($id);
            return response()->json([
                "data" => $brand
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __("messages.brand_not_found"),
            ], 404);
        }
    }

    public function update(UpdateBrandRequest $request, int $id)
    {
        try {
            $brand = $this->brandService->update($id, $request->validated());

            return response()->json([
                "message" => __("messages.brand_updated_success"),
                "data" => $brand
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.brand_not_found"),
            ], 404);
        }
    }

    public function updateActive(int $id)
    {
        try {
            $brand = $this->brandService->updateActive($id);
            $brandStatus = $brand->active ? __("messages.activated") : __("messages.deactivated");

            return response()->json([
                "message" => __("messages.brand_active_updated_success", ['status' => $brandStatus]),
                "data" => $brand
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.brand_not_found"),
            ], 404);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->brandService->delete($id);
            return response()->json([
                "message" => __("messages.brand_delete_success")
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => __("messages.brand_not_found"),
            ], 404);
        }
    }
}
