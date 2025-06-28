<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Response;
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

    public function getAll()
    {
        return Response::success(data: $this->brandService->getAll());
    }

    public function getAllActive()
    {
        return Response::success(data: $this->brandService->getAllActive());
    }

    public function getById($id)
    {
        try {
            $brand = $this->brandService->getById($id);
            return Response::success(data: $brand);
        } catch (ModelNotFoundException) {
            return Response::notFoundError("brand");
        }
    }
    public function create(StoreBrandRequest $request)
    {
        $brand = $this->brandService->create($request->validated());

        return Response::success(
            t("created_success", "brand"),
            $brand,
            201
        );
    }

    public function update(UpdateBrandRequest $request, int $id)
    {
        try {
            $brand = $this->brandService->update($id, $request->validated());

            return Response::success(
                t("updated_success", "brand"),
                $brand,
            );
        } catch (ModelNotFoundException) {
            return Response::notFoundError("brand");
        }
    }

    public function updateActive(int $id)
    {
        try {
            $brand = $this->brandService->updateActive($id);

            return Response::success(
                t('active_updated_success', 'brand'),
                $brand
            );
        } catch (ModelNotFoundException) {
            return Response::notFoundError("brand");
        }
    }


    public function delete(int $id)
    {
        try {
            $this->brandService->delete($id);
            return Response::success(
                t('deleted_success', 'brand'),
            );
        } catch (ModelNotFoundException) {
            return Response::notFoundError("brand");
        }
    }
}
