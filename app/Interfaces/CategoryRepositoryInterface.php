<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function getActive();
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function updateActive(int $id);
    public function delete(int $id);
}
