<?php

namespace App\Services;

use App\Interfaces\BrandRepositoryInterface;


class BrandService
{
    protected $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function  getAll()
    {
        return $this->brandRepository->getAll();
    }

    public function  getActive()
    {
        return $this->brandRepository->getActive();
    }

    public function  getById(int $id)
    {
        return $this->brandRepository->getById($id);
    }

    public function  create(array $data)
    {
        return $this->brandRepository->create($data);
    }

    public function  update(int $id, array $data)
    {
        return $this->brandRepository->update($id, $data);
    }

    public function  updateActive(int $id)
    {
        return $this->brandRepository->updateActive($id);
    }

    public function  delete(int $id)
    {
        return $this->brandRepository->delete($id);
    }
}
