<?php

namespace App\Interfaces;

use App\Enums\ProductInvoiceTypes;

interface ProductInvoiceRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(ProductInvoiceTypes $type, array $data);
    public function approve(int $id, array $data);
    public function delete(int $id);
}
