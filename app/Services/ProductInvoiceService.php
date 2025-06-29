<?php

namespace App\Services;

use App\Enums\ProductInvoiceStatuses;
use App\Enums\ProductInvoiceTypes;
use App\Exceptions\ProductInvoiceApprovedException;
use App\Interfaces\ProductInvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductInvoiceService
{
    protected $productInvoiceRepository;

    public function __construct(ProductInvoiceRepositoryInterface $productInvoiceRepository)
    {
        $this->productInvoiceRepository = $productInvoiceRepository;
    }

    public function getAll()
    {
        return $this->productInvoiceRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->productInvoiceRepository->getById($id);
    }

    public function create(ProductInvoiceTypes $type, array $data)
    {
        return DB::transaction(function () use ($type, $data) {
            $userId = $data["user_id"];
            $status = ProductInvoiceStatuses::CREATED->value;

            $productInvoice = $this->productInvoiceRepository->create($type, [
                "user_id" => $userId,
                "type" => $type->value,
                "status" => $status,
            ]);

            foreach ($data["products"] as $product) {
                $productInvoice->products()->create([
                    "user_id" => auth()->id(),
                    "product_id" => $product["product_id"],
                    "quantity" => $product["quantity"],
                    "date" => now(),
                ]);
            }

            return $productInvoice;
        });
    }


    public function approve(int $id)
    {

        return $this->productInvoiceRepository->approve($id, [
            'status' => ProductInvoiceStatuses::APPROVED->value,
        ]);
    }


    public function delete(int $id)
    {
        $productInvoice = $this->productInvoiceRepository->getById($id);

        if ($productInvoice->status === ProductInvoiceStatuses::APPROVED->value) {
            throw new ProductInvoiceApprovedException();
        }

        return $this->productInvoiceRepository->delete($id);
    }
}
