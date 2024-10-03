<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\DeadCodeDetectionNotSupportedException;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.section',['sections'=>$sections]);
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
        $input = $request->all();
        $b_exists = Section::where('section_name','=',$input['section_name'])->exists();
        if($b_exists){
            Session::flash('Error','خطأ القسم موجود سابقا');
            return redirect(route('section.index'));
        }else{

            $request->validate([
                'section_name' => 'required|unique:sections|string',
                'description'=>'required',
            ],[
                'section_name.required' => 'يرجي ادخال اسم القسم',
                'section_name.unique' =>    'اسم القسم مسجل مسبقا',
                'description.required' => 'يرجي ادخال املاحظات'
            ]

        );
            Section::create([
                'section_name' => $request->section_name,
                'description'=>$request->description,
                'created_by' => auth()->user()->name,
            ]);
            Session::flash('success','تم اضافه القسم بنجاح');
            return redirect(route('section.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section,$id)
    {
        $id = Section::findOrFail($id);
        $All = Session::all();
        view('sections.section',['All' => $All]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    // public function update($id , Request $request)
    // {
    //     $idUpdatedData = Section::findOrFail($id);
    //     $idUpdatedData->update(
    //         [
    //             'section_name' => $request->section_name,
    //             'description'=>$request->description,
    //             'created_by' => auth()->user()->name,
    //         ]
    //         );
    //         Session::flash('success','تم تعديل القسم بنجاح');
    //         return redirect(route('section.index'));
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idDeleteBtn = Section::findOrFail($id);
        $idDeleteBtn->delete();
        session()->flash('success', 'تم مسح القسم');
        return redirect()->back();
    }
}
