<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\Invoice_details;
use App\Models\invoices;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_details $invoice_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $details = Invoice_details::where('id_invoice','=',$id)->first();
        $attachments = invoice_attachments::where('id_invoice','=',$id)->first();
        return view('invoices.InvoicesDetails',['invoices'=>$invoices,'details'=>$details,'attachments'=>$attachments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_details $invoice_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice_details $invoice_details)
    {
        //
    }




// public function openFile($invoice_number, $file_name)
//     {
//         $path = "Attachments/$invoice_number/$file_name";
//         // return $path;
//         $fullPath = Storage::disk('public_uploads')->exists($path);
//         return response()->file($fullPath);
// }



public function showPdf($filaName,$invoice_number){
// Storage::disk('public');
$filePath = public_path('Attachments/' . $invoice_number . '/' .$filaName);
$contents = Storage::get($filePath);
return $contents;
// return view('attach',['contents'=>$contents]);
}

    public function notify($id,$noty){
        $invoices = invoices::findOrFail($id);
        DB::table('notifications')->where('id','=',$noty)->update(['read_at' => now()]);
        return view('invoices.invoiceNotification',['invoices'=>$invoices]);
    }

}

