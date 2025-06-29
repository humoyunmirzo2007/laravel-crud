<?php

namespace App\Http\Controllers;

use App\Enums\ProductInvoiceTypes;
use App\Http\Helpers\Response;
use App\Http\Requests\StoreProductInvoiceRequest;
use App\Services\ProductInvoiceService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductInvoiceController extends Controller
{
    protected $productInvoiceService;

    public function __construct(ProductInvoiceService $productInvoiceService)
    {
        $this->productInvoiceService = $productInvoiceService;
    }

    public function getAll()
    {
        return Response::success(data: $this->productInvoiceService->getAll());
    }

    public function getById($id)
    {
        try {
            $productInvoice = $this->productInvoiceService->getById($id);
            return Response::success(data: $productInvoice);
        } catch (ModelNotFoundException) {
            return Response::notFoundError("product_invoice");
        }
    }


    public function create(StoreProductInvoiceRequest $request)
    {
        $validated = $request->validated();

        $typeString = $validated['type'];
        $type = ProductInvoiceTypes::from($typeString);

        $productInvoice = $this->productInvoiceService->create($type, $validated);

        return Response::success(
            t("created_success", $type === ProductInvoiceTypes::INPUT ? "product_invoice_input" : "product_invoice_output"),
            $productInvoice,
            201
        );
    }


    public function approve($id)
    {
        try {
            $productInvoice = $this->productInvoiceService->approve($id);

            $type = $productInvoice->type === ProductInvoiceTypes::INPUT->value
                ? "product_invoice_input"
                : "product_invoice_output";

            return Response::success(
                t(
                    "approved_success",
                    $type
                ),
                $productInvoice,
            );
        } catch (ModelNotFoundException) {
            return Response::notFoundError("product_invoice");
        }
    }

    public function delete($id)
    {
        try {
            $productInvoice = $this->productInvoiceService->delete($id);
            $type = $productInvoice->type === ProductInvoiceTypes::INPUT->value
                ? "product_invoice_input"
                : "product_invoice_output";

            return Response::success(
                message: t("deleted_success", $type)
            );
        } catch (ModelNotFoundException) {
            return Response::notFoundError("product_invoice");
        }
    }
}
