<?php

namespace App\Exports;

use App\Models\aqinvoices;
use Maatwebsite\Excel\Concerns\FromCollection;

class invoiceExcel implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return aqinvoices::all();
        //لو بدي انزل عمدة معينة
        //return invoices::select('invoice_number', 'invoice_Date', 'Due_date','Section', 'product', 'Amount_collection','Amount_Commission', 'Rate_VAT', 'Value_VAT','Total', 'Status', 'Payment_Date','note')->get();

    }
}

