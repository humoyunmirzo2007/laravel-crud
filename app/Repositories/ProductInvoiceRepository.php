<?php

namespace App\Repositories;

use App\Enums\ProductInvoiceStatuses;
use App\Enums\ProductInvoiceTypes;
use App\Exceptions\ProductInvoiceApprovedException;
use App\Interfaces\ProductInvoiceRepositoryInterface;
use App\Models\ProductInvoice;

class ProductInvoiceRepository implements ProductInvoiceRepositoryInterface
{
    public function getAll()
    {
        return ProductInvoice::orderBy("id", "DESC")
            ->get();
    }

    public function getById(int $id)
    {
        return ProductInvoice::findOrFail($id);
    }

    public function create(ProductInvoiceTypes $type, array $data)
    {
        return ProductInvoice::create($data);
    }

    public function approve(int $id, array $data)
    {
        $invoice = ProductInvoice::findOrFail($id);
        $invoice->update($data);
        return $invoice;
    }


    public function delete(int $id)
    {

        $productInvoice = ProductInvoice::findOrFail($id);
        if ($productInvoice->status === ProductInvoiceStatuses::APPROVED->value) {
            throw new ProductInvoiceApprovedException();
        }
        $productInvoice->delete();

        return $productInvoice;
    }
}
