<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category=DB::table('categories')->get();
        //return response()->json($category);
        return view('allcategory',compact('category'));
        //return view('allcategory')->with('cat',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('addcategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //quer builder use kortesi

        $validatedData = $request->validate([
        'name' => 'required|unique:categories|max:25|min:4',
        'slug' => 'required|unique:categories|max:25|min:4',
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['slug']=$request->slug;

        $category=DB::table('categories')->insert($data);

        //if($category){
          //$notification=array(
            //'message'=>'Succesfully Category Inserted',
            //'alert-type'=>'success'
          //);
          //return Redirect()->route('add.category')-with($notification);
        //}else{
          //$notification=array(
            //'message'=>'Something went wrong',
            //'alert-type'=>'error'
        //  );
          //return Redirect()->route('add.category')-with($notification);
        //}

        return view('addcategory');
        //return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //echo $id;
        $category=DB::table('categories')->where('id',$id)->first();
        //return response()->json($category);
        return view('categoryview',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category=DB::table('categories')->where('id',$id)->first();

        return view('editcategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
        'name' => 'required|max:25|min:4',
        'slug' => 'required|max:25|min:4',
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['slug']=$request->slug;

        $category=DB::table('categories')->where('id',$id)->update($data);

        return Redirect()->back();
        //return view('addcategory');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category=DB::table('categories')->where('id',$id)->delete();

        //return view('allcategory'); problem ase eita te
        //return Redirect()->route('all.category');
        return Redirect()->back();
    }
}
