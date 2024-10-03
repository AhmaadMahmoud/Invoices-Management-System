<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\Invoice_details;
use App\Models\invoices;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use App\Notifications\Add_invoice;
use App\Notifications\AddInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices',['invoices'=>$invoices]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
         return view('invoices.add_invoice',['sections'=>$sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->Amount_collection,
            'amount_Commission' => $request->Amount_Commission,
            'discount' => $request->Discount,
            'value_VAT' => $request->Value_VAT,
            'rate_VAT' => $request->Rate_VAT,
            'total' => $request->Total,
            'status' => "غير مدفوعه",
            'value_Status' => 2,
            'note' => $request->note,
        ]);
        $invoice_id = invoices::latest()->first()->id;
        Invoice_details::create(
            [
            'id_invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => "غير مدفوعه",
            'value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
            ]
            );
            if($request->hasFile('pic')){
            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->created_by = Auth::user()->name;
            $attachments->id_invoice = $invoice_id;
            $attachments->save();

                        // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        $user = User::first();
        Notification::send($user,new AddInvoice($invoice_id));

        $user = User::get();
        $invoice_id = invoices::latest()->first();
        Notification::send($user, new Add_invoice($invoice_id));
        session()->flash('success', 'تم اضافة الفاتورة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editInvoice = invoices::findOrFail($id);
        $sections = Section::all();

        return view('invoices.statusUpdate',['editInvoice'=>$editInvoice,'sections'=>$sections]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices,$id)
    {
        $invoicesAccordingId = invoices::findOrFail($id);

        // dd($invoicesAccordingId);
        // echo $request->status;
        // echo "<br>";


        if ( $invoicesAccordingId->status === "غير مدفوعه")
        {
            // echo 'yess';
            $invoicesAccordingId->update([
                'value_Status' => 1,
                'status' => $request->status,
                'payment_Date' => $request->payment_Date,
            ]);
            }
            if($invoicesAccordingId->status === "مدفوعة")
        {
            $invoicesAccordingId->update([
                'value_Status' => 3,
                'status' => $request->status,
                'payment_Date' => $request->payment_Date,
            ]);
        }
            if($invoicesAccordingId->status === "مدفوعة جزئيا")
        {
            $invoicesAccordingId->update([
                'value_Status' => 1,
                'status' => $request->status,
                'payment_Date' => $request->payment_Date,
            ]);

        }


        session()->flash('success','تم');
        return redirect(route('invoice.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoices = invoices::findOrFail($id);
        $invoices->delete();
        return back();
    }
    public function getProduct($id)
    {
        $products = DB::table('products')->where('section_id',$id)->pluck('product_name','id');
        return $products;
    }

    public function paid(){
        $paids = invoices::where('status','=',"مدفوعة")->get();
        $sections = Section::all();
        return view('invoices.paid_invoices',['paids'=>$paids,'sections'=>$sections]);
    }
    public function unpaid(){
        $unpaids = invoices::where('status','=',"غير مدفوعه")->get();
        $sections = Section::all();
        return view('invoices.unpaid_invoices',['unpaids'=>$unpaids,'sections'=>$sections]);
    }
    public function partial(){
        $partials = invoices::where('status','=',"مدفوعة جزئيا")->get();
        $sections = Section::all();
        return view('invoices.partial_invoices',['partials'=>$partials,'sections'=>$sections]);
    }


    public function print($id){
        $printInvoice = invoices::findOrFail($id);
         return view('invoice',['printInvoice'=>$printInvoice]);
    }


    public function readAll(Request $request){
        $userUnReadNotifications = auth()->user()->unreadNotifications;
        if($userUnReadNotifications){
            $userUnReadNotifications->markAsRead();
            return back();
        }
    }

    public function readOne($id){

    }
}
