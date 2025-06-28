<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::orderBy("id", "DESC")
            ->get();
    }

    public function getAllActive()
    {
        return Category::where("active", true)
            ->orderBy("id", "DESC")->get();
    }

    public function getById(int $id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(int $id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function updateActive(int $id)
    {
        $category = Category::findOrFail($id);
        $category->active = !$category->active;
        $category->save();
        return $category;
    }

    public function delete(int $id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}
