<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::orderBy("id", "DESC")
            ->get();
    }

    public function getAllActive()
    {
        return Product::where("active", true)
            ->orderBy("id", "DESC")->get();
    }

    public function getById(int $id)
    {
        return Product::findOrFail($id);
    }

    public function getByCategoryId(int $id)
    {
        return Product::where("category_id", $id)->orderBy("id", "DESC")->get();
    }
    public function getByBrandId(int $id)
    {
        return Product::where("brand_id", $id)->orderBy("id", "DESC")->get();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function updateActive(int $id)
    {
        $product = Product::findOrFail($id);
        $product->active = !$product->active;
        $product->save();
        return $product;
    }

    public function delete(int $id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
