<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getAll();
    public function getAllActive();
    public function getById(int $id);
    public function getByBrandId(int $id);
    public function getByCategoryId(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function updateActive(int $id);
    public function delete(int $id);
}
