<?php

namespace App\Interfaces;

interface BrandRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function updateActive(int $id);
    public function delete(int $id);
}
