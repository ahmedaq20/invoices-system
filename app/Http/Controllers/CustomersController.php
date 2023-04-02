<?php

namespace App\Http\Controllers;

use App\Models\sections;
use App\Models\products;
use App\Models\aqinvoices;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
  public function index(){




    $sections =sections::all();
    $product=products::all();
    return view('reports.customers_report',compact('sections','product'));
  }

  public function Search_Customers(REQUEST $request){



    if ($request->Section && $request->product && $request->start_at =='' && $request->end_at==''){

    $invoices=aqinvoices::select('*')->where('section_id','=',$request->Section )->where('product','=',$request->product)->get();
    $sections =sections::all();
    return view('reports.customers_report',compact('sections'))->withDetails($invoices);
    }
    else{
        $start_at=date($request->start_at);
        $end_at=date($request->end_at);
        $sections =sections::all();
        $invoices= aqinvoices::wherebetween('invoice_Date',[$start_at,$end_at])->where('section_id','=',$request->Section )->where('product','=',$request->product)->get();
  return view('reports.customers_report',compact('sections'))->withDetails($invoices);



    }


}
}
