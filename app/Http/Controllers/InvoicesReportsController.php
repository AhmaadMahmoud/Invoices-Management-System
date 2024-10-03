<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\Section;
use Illuminate\Http\Request;

class InvoicesReportsController extends Controller
{
    public function index(){
        return view('reports.invoices_report');
    }
    public function show(){
        $sections = Section::all();
        return view('reports.customers_report',['sections'=>$sections]);
        // return $sections;
    }

    public function search(Request $request){
            if($request->radio == 1){
                $start = $request->start;
                $end = $request->end;
                echo $request->type;
                if(empty($start) && empty($end) && $request->type){
                    $invoices = invoices::where('status','=',$request->type)->get();
                    return view('reports.invoices_report',['invoices'=>$invoices]);
                }else{
                    $invoices = invoices::whereBetween('invoice_Date',[$start,$end])->where('status','=',$request->type)->get();
                    return view('reports.invoices_report',['invoices'=>$invoices]);
                }
            }if ($request->radio == 2){
                $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
                return view('reports.invoices_report',['invoices'=>$invoices]);
            }else{
                return 'not exist';
            }
        }

        public function customers(Request $request){
        $start = $request->start;
        $end = $request->end;
            if($request->Section && empty($start) && empty($end)){
                $sections = Section::all();
                $invoices = invoices::select('*')->where('section_id','=',$request->Section)->get();
                return view('reports.customers_report',['invoices'=>$invoices,'sections'=>$sections]);
            }else{
            $invoices = invoices::whereBetween('invoice_Date',[$start,$end])->where('section_id','=',$request->Section)->get();
            return view('reports.customers_report',['invoices'=>$invoices]);
            }
        }
    }


