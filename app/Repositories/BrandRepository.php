<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Interfaces\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
    public function getAll()
    {
        return Brand::orderBy("id", "DESC")->get();
    }

    public function getActive()
    {
        return Brand::where("active", true)->orderBy("id", "DESC")->get();
    }


    public function getById(int $id)
    {
        return Brand::findOrFail($id);
    }

    public function create(array $data)
    {
        return Brand::create($data);
    }

    public function update(int $id, array $data)
    {
        $brand = Brand::findOrFail($id);
        $brand->update($data);
        return $brand;
    }

    public function updateActive(int $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->active = !$brand->active;
        $brand->save();
        return $brand;
    }

    public function delete(int $id)
    {
        $brand = Brand::findOrFail($id);
        return $brand->delete();
    }
}
