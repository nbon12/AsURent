<?php

namespace App\Repositories;

use App\Contract;
use App\User;
use App\Invoice;

class InvoiceRepository
{
    public function forContract(Contract $contract)
    {
        return $contract->invoices()->get();
    }
}