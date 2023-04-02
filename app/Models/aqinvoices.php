<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use section;

class aqinvoices extends Model
{
    use HasFactory,SoftDeletes;
    // protected $fillable = [
    //     'invoice_number',
    //     'invoice_Date',
    //     'Due_date',
    //     'product',
    //     'section_id',
    //     'Amount_collection',
    //     'Amount_Commission',
    //     'Discount',
    //     'Value_VAT',
    //     'Rate_VAT',
    //     'Total',
    //     'Status',
    //     'Value_Status',
    //     'note',
    //     'Payment_Date',
    // ];

    protected $guarded = [];









    public function section()
    {
    return $this->belongsTo('App\Models\sections');
    }

    public function products()
    {
    return $this->belongsTo('App\Models\products');
    }


    public function invoices_details()
    {
    return $this->belongsTo('App\Models\invoices_details');
    }

}
