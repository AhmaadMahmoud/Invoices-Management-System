<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {   $sections = Section::all();
    {   $products = Product::all();
        return view('products.product',['sections'=>$sections,'products'=>$products]);
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'product_name' => 'required|unique:products|string',
                'description'=>'required',
                'section_id'=>'required'
            ],[
                'product_name.required' => 'يرجي ادخال اسم المنج',
                'product_name.unique' => 'تم اضافه اسم المنتج من قبل',
                'description.required' => 'يرجي ادخال املاحظات',
                'section_id.required'=>'يرجي اختيار القسم'
            ]
        );
            Product::create([
        'product_name' => $request->product_name,
        'description'=>$request->description,
        'section_id' =>$request->section_id
            ]);
            Session::flash('success','تم اضافه المنتج بنجاح');
            return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id)
    {
    $id = Section::where('section_name', $request->section_name)->first()->id;

    $Products = Product::findOrFail($request->pro_id);

       $data = $Products->update([
       'product_name' => $request->product_name,
       'description' => $request->description,
       'section_id' => $id,
       ]);


       session()->flash('Edit', 'تم تعديل المنتج بنجاح');
       return back() ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,$id)
    {
        $idDeleteBtn = Product::findOrFail($id);
        $idDeleteBtn->delete();
        session()->flash('success', 'تم مسح القسم');
        return redirect()->back();
    }
}
