<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Auth\SessionGuard\user;
use Illuminate\Contracts\Session\Session;
use App\Models\User;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Sections::all();
        return view('sections.sections',compact('sections'));
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
        $input =$request->all();

        $validated = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجى ادخال اسم القسم',
            'section_name.unique' =>'القسم موجود بالفعل',
            'description.required' =>'يرجى ادخال اسم البيانات',

            ]

    );

    sections::create([
        'section_name' => $request->section_name,
        'description' => $request->description,
        'Created_by' =>  (Auth::user()->name),
    ]);

    session()->flash('Add', 'تم اضافة القسم بنجاح ');
    return redirect('/sections');

        // $exists =sections::where('section_name','=',$input['section_name'])->exists();//بتاكد انه يلي دخله غير موجود

        // if($exists)
        // {

        //     session()->flash('Error', 'خطأ القسم مسجل مسبقا');
        //     return redirect()->route('sections.index');
        // }
        // else {
        //     sections::create([
        //         'section_name'=>$request->section_name,
        //         'description'=>$request->description,
        //         // 'Created_by' =>auth()->user()->name
        //          'Created_by' =>"ahmed"
        //         //  'Created_by' =>auth::class()->user()->name



        //     ]);
        //     session()->flash('Add', 'تم اضافة قسم بنجاح');
        //     return redirect()->route('sections.index');



        }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id =$request->id;

        // $this->validate($request,[
        //     'section_name' => 'required|unique:sections|max:255'.$id,
        //     'description' => 'required',
        // ],[

        //     'section_name.required' =>'يرجى ادخال اسم القسم',
        //     'section_name.unique' =>'القسم موجود بالفعل',
        //     'description.required' =>'يرجى ادخال اسم البيانات',

        // ]);

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);


            $sections = sections::find($id);

            $sections->update([

                'section_name' =>$request->section_name,
                'description' =>$request->description,
            ]);

            session()->flash('edit','تم التعديل بنجاح');
            return redirect()->back();




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id =$request->id;
        $sections=sections::find($id)->delete();


        if ($sections != null) {
            $sections->delete();
            return redirect()->back()->session()->flash('delete','تم حذف القسم بنجاح');
        }

        return redirect()->back()-> session()->flash('delete','فشل حذف القسم ');



    }

}
