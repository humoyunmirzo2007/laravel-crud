<?php

namespace App\Exceptions;

use Exception;

class ProductInvoiceApprovedException extends Exception
{
    public function __construct()
    {
        parent::__construct(t("cant_delete_approved_invoice"));
    }
}
