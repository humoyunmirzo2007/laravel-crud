<?php

namespace App\Services;

use App\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function  getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function  getActive()
    {
        return $this->categoryRepository->getActive();
    }

    public function  getById(int $id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function  create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function  update(int $id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function  updateActive(int $id)
    {
        return $this->categoryRepository->updateActive($id);
    }

    public function  delete(int $id)
    {
        return $this->categoryRepository->delete($id);
    }
}
