<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use App\Models\sections;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $sections = sections::all();
       $products = products::all();
      return view('products.products',compact('sections'),compact('products'));

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
        $this->validate($request, [
            'Product_name'=>'required|max:255',
            'section_id'=>'required|max:255',
            'description'=>'required|max:255',


        ]);

        products::create([
            'Product_name'=>$request->Product_name,
            'section_id'=>$request->section_id,
            'description'=>$request->description,
        ]);

        session()->flash('Add','تم اضافة المنتج بنجاح');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = sections::where('section_name', '=', $request->section_name)->first()->id;

        $products = Products::findOrFail($request->pro_id);
        $products->update([
            'Product_name'=>$request->Product_name,
            'section_id'=>$id,
            'description'=>$request->description,

        ]);
        session()->flash('Edit', 'تم تعديل المنتج بنجاح');
        return redirect()->back();



    }

    // public function update(Request $request)
    // {

    //    $id = sections::where('section_name', $request->section_name)->first()->id;

    //    $Products = Products::findOrFail($request->pro_id);

    //    $Products->update([
    //    'Product_name' => $request->Product_name,
    //    'description' => $request->description,
    //    'section_id' => $id,
    //    ]);

    //    session()->flash('Edit', 'تم تعديل المنتج بنجاح');
    //    return back();

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id =$request->pro_id;
        $Products=Products::find($id)->delete();

        session()->flash('Delete', 'تم حدف المنتج بنجاح');
        return redirect()->back();
    }
}
