<?php

namespace App\Services;

use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function  getAll()
    {
        return $this->productRepository->getAll();
    }

    public function  getAllActive()
    {
        return $this->productRepository->getAllActive();
    }

    public function  getById(int $id)
    {
        return $this->productRepository->getById($id);
    }

    public function  getByCategoryId(int $id)
    {
        return $this->productRepository->getByCategoryId($id);
    }

    public function  getByBrandId(int $id)
    {
        return $this->productRepository->getByBrandId($id);
    }

    public function  create(array $data)
    {
        if (isset($data["image"]) && $data["image"] instanceof UploadedFile) {
            $uniqueName = Str::uuid() . "." . $data["image"]->getClientOriginalExtension();
            $path = $data["image"]->storeAs("products", $uniqueName, "public");
            $data["image"] = asset("storage/" . $path);
        }
        return $this->productRepository->create($data);
    }

    public function  update(int $id, array $data)
    {
        $product = $this->productRepository->getById($id);

        if (isset($data["image"]) && $data["image"] instanceof UploadedFile) {
            if ($product->image) {
                $path = str_replace(asset("storage/") . "/", "", $product->image);
                Storage::disk("public")->delete($path);
            }
            $uniqueName = Str::uuid() . "." . $data["image"]->getClientOriginalExtension();
            $path = $data["image"]->storeAs("products", $uniqueName, "public");
            $data["image"] = asset("storage/" . $path);
        }
        return $this->productRepository->update($id, $data);
    }

    public function  updateActive(int $id)
    {
        return $this->productRepository->updateActive($id);
    }

    public function  delete(int $id)
    {
        return $this->productRepository->delete($id);
    }
}
