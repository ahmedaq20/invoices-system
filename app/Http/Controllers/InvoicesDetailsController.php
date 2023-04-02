<?php

namespace App\Http\Controllers;
use App\Models\aqinvoices;
use App\Models\invoices_details;
use App\Models\invoice_attachments;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;
use File;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //  $invoices=aqinvoices::where('id', $id)->first();
        //  $invoicesdetails = invoices_details::where('id_Invoice', $id)->get();
        // $attachments=invoice_attachments::where('invoice_id', $id)->get();
        // return view('invoices.InvoicesDetails',compact('invoices','attachments'),compact('invoicesdetails'));



        $invoices = aqinvoices::where('id',$id)->first();
        $details  = invoices_details::where('id_Invoice',$id)->get();
        $attachments  = invoice_attachments::where('invoice_id',$id)->get();

        return view('invoices.InvoicesDetails',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deleteAttachment = invoice_attachments::findOrFail($request->id_file);
        $deleteAttachment->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete','تم حذف المنتج بنجاح');
        return back();
    }

    public function open_file($invoice_number , $file_name)
    {

        // $files = Storage::disk('public_uploade')->getDriver()->getAdapter()->applyPathPrefix( $invoice_number.'/'.$file_name);
        // return response()->file($files);


        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);

    }


    public function get_file($invoice_number , $file_name)
    {

        $content = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download($content);

    }

}
