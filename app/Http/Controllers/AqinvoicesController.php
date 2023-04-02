<?php

namespace App\Http\Controllers;

use App\Models\aqinvoices;
use App\Models\sections;
use App\Models\invoices_details;
use App\Models\products;
use App\Models\User;
use App\Models\invoice_attachments;
use Dotenv\Parser\Value;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\getClientOriginalName;
use Illuminate\Support\Facades\Storage;
use Facade\FlareClient\View;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\InvoicesNotification;
use Illuminate\Support\Facades\Notification;


//for Excel
use App\Exports\invoiceExcel;
use Maatwebsite\Excel\Facades\Excel;






class AqinvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aqinvoices = aqinvoices::all();
        return view('invoices.invoices', compact('aqinvoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()


    {
        $sections = sections::all();
        $products = products::all()->where('section_id', '=', 'id');
        return view('invoices.add_invoice', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        aqinvoices::create([

            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوع',
            'Value_Status' => 2,
            'Payment_Date' => $request->Payment_Date,
            'note' => $request->note,
        ]);

        $Invoice_id = aqinvoices::latest()->first()->id;
        invoices_details::create([

            'id_Invoice' => $Invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوع',
            'Value_Status' => 5,
            'Payment_Date' => $request->Payment_Date,
            'note' => $request->note,
            'user' => (Auth::user()->name),

        ]);

        // if ($request->hasFile('pic')){
        //  $Invoice_id=aqinvoices::latest()->first()->id;
        //  $image=$request->file('pic');
        //  $file_name=$image->getClientOriginalName();
        //  $invoice_number=$request->invoice_number;

        //  $attachments = new invoice_attachments();
        //  $attachments->file_name=$file_name;
        //  $attachments->invoice_number=$invoice_number;
        //  $attachments->Created_by=Auth::user()->name;
        //  $attachments->invoice_id=$Invoice_id;
        //  $attachments->save();


        //move pic /تخزين المرفق في السيرفر
        // $imageName=$request->pic->getClientOriginalName();
        // $request->pic->move('Attachments/' . $invoice_number . '/' . $imageName);
        if ($request->hasFile('pic')) {

            $invoice_id = aqinvoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        // $user = User::first();


        $Invoice = aqinvoices::latest()->first();
        $user = User::get();
        // $user->notify(new InvoicesNotification($Invoice));
        Notification::send($user, new \App\Notifications\InvoicesNotification($Invoice));


        session()->flash('Add', 'تم رفع الفاتورة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\aqinvoices  $aqinvoices
     * @return \Illuminate\Http\Response
     */
    public function show(aqinvoices $aqinvoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\aqinvoices  $aqinvoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $invoiceEdits = aqinvoices::where('id', $id)->first();
        $sections = sections::all();
        return view('invoices.invoiceEdit', compact('invoiceEdits', 'sections'));

        // return view('invoices.invoiceEdit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\aqinvoices  $aqinvoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $id = $request->id;
        $aqinvoices = aqinvoices::findOrFail($id);
        $aqinvoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);


        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return redirect()->route('invoices.index')->with('edit', 'تم تعديل الفاتورة بنجاح');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\aqinvoices  $aqinvoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = aqinvoices::where('id', $id)->first();
        $attachments = invoice_attachments::where('invoice_id', $id)->first();

        if (!$request->Transfer == 2) {
            if (!empty($attachments->file_name)) {

                Storage::disk('public_uploads')->deleteDirectory($attachments->invoice_number);
            }

            $invoices->forceDelete();
            session()->flash('deleteinvoices');
            return redirect()->route('invoices.index');
        } else {

            $invoices->delete();
            session()->flash('softDeletes');
            return redirect()->route('invoices.index');
        }
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }

    // public function softDelete($id)
    // {
    //     // $product=Product::find($id)->delete();
    //     // return redirect()->route('products.index')
    //     // ->with('success','product deleted successfully');
    // }


    public function change(Request $request, $id)
    {

        // return $request;


        $invoiceChange = aqinvoices::where('id', $id)->first();
        $sections = sections::all();
        return view('invoices.invoiceChange', compact('invoiceChange', 'sections'));
    }

    public function updateChange(Request $request)
    {




        $invoicesChange = aqinvoices::findOrFail($request->id);


        if ($request->Status == 'مدفوعة') {
            $invoicesChange->update([
                'Status' => $request->Status,
                'Value_Status' => 1,
                'Payment_Date' => $request->Payment_Date,
            ]);




            invoices_details::create([
                'id_Invoice' => $request->id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'Payment_Date' => $request->Payment_Date,
                'invoice_Date' => $request->invoice_Date,
                'note' => $request->note,
                'user' => (Auth::user()->name),
            ]);
        } else {

            $invoicesChange->update([
                'Status' => $request->Status,
                'Value_Status' => 3,
                'Payment_Date' => $request->Payment_Date,
            ]);


            invoices_details::create([
                'id_Invoice' => $request->id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'invoice_Date' => $request->invoice_Date,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'Payment_Date' => $request->Payment_Date,
                'note' => $request->note,
                'user' => (Auth::user()->name),

            ]);
        }
        session()->flash('change');
        return redirect()->route('invoices.index');
    }



    // public function invoicesPaid(){
    //     $invoices =aqinvoices::where('Value_Status',1)->get();
    //     return view('invoices.invoicesPaid', compact('invoices'));

    // }


    public function invoicesPaid()
    {
        $invoices = aqinvoices::where('Value_Status', 1)->get();
        return view('invoices.invoicesPaid', compact('invoices'));
    }

    public function invoicesUnpaid()
    {
        $invoices = aqinvoices::where('Value_Status', 2)->get();
        return view('invoices.invoicesUnpaid', compact('invoices'));
    }

    public function invoicesPaidPartiel()
    {
        $invoices = aqinvoices::where('Value_Status', 3)->get();
        return view('invoices.invoicesPaidPartiel', compact('invoices'));
    }


    public function printinvoive($id)
    {

        $invoices = aqinvoices::where('id', $id)->first();
        return view('invoices.printinvoive', compact('invoices'));
    }

    // for Excel
    public function export()
    {
        return Excel::download(new invoiceExcel, 'invoice.xlsx');
    }


    public function MarkAsRead_all()
    {


        $User_unreadNotifivation = auth()->user()->unreadNotifications;

        if ($User_unreadNotifivation) {

            $User_unreadNotifivation->MarkAsRead();
            return back();
        }
    }



    public function profile(){

        $user = User::first();
        return view('profile.profile',compact('user'));


    }
}
