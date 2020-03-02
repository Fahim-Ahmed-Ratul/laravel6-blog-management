<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
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
        return view('index',compact('category'));


    }

    public function index3()
    {
        //
        //$post=DB::table('posts')->join('categories','posts.category_id','categories.id')->select('posts.*','categories.name','categories.slug')->get();

        $post=DB::table('posts')->join('categories','posts.category_id','categories.id')->select('posts.*','categories.name','categories.slug')->paginate(3);
        return view('welcomemain',compact('post'));




    }

    public function index2()
    {
        //
        //$post=DB::table('posts')->get();
        $post=DB::table('posts')->join('categories','posts.category_id','categories.id')->select('posts.*','categories.name')->get();
        //return response()->json($post);
        return view('allpost',compact('post'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('index');
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
        $validatedData = $request->validate([
        'title' => 'required|max:200',
        'details' => 'required|max:400',
        'image' => 'required|mimes:jpeg,jpg,png|max:1000',
        ]);

        $data=array();
        $data['title']=$request->title;
        $data['category_id']=$request->category_id;
        $data['details']=$request->details;

        $image=$request->file('image');

        if($image)
        {
          $image_name=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $image_full_name=$image_name.'.'.$ext;
          $upload_path='public/frontend/image/';
          $image_url=$upload_path.$image_full_name;
          $success=$image->move($upload_path,$image_full_name);
          $data['image']=$image_url;
          DB::table('posts')->insert($data);
          return Redirect()->back();
        }else{
          DB::table('posts')->insert($data);
          return Redirect()->back();
        }

        //$category=DB::table('categories')->insert($data);

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
        $post=DB::table('posts')->join('categories','posts.category_id','categories.id')->select('posts.*','categories.name')->where('posts.id',$id)->first();
        //return response()->json($post);
        return view('viewpost',compact('post'));
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
        $category=DB::table('categories')->get();
        $post=DB::table('posts')->where('id',$id)->first();

        return view('editpost',compact('category','post'));
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
        'title' => 'required|max:200',
        'details' => 'required|max:400',
        'image' => 'mimes:jpeg,jpg,png|max:1000',
        ]);

        $data=array();
        $data['title']=$request->title;
        $data['category_id']=$request->category_id;
        $data['details']=$request->details;

        $image=$request->file('image');

        if($image)
        {
          $image_name=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $image_full_name=$image_name.'.'.$ext;
          $upload_path='public/frontend/image/';
          $image_url=$upload_path.$image_full_name;
          $success=$image->move($upload_path,$image_full_name);
          $data['image']=$image_url;
          unlink($request->old_photo);
          DB::table('posts')->where('id',$id)->update($data);
          return Redirect()->back();
        }else{
          $data['image']=$request->old_photo;
          DB::table('posts')->where('id',$id)->update($data);
          return Redirect()->back();
        }

        //$category=DB::table('categories')->insert($data);

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
        $post=DB::table('posts')->where('id',$id)->first();
        $image=$post->image;
        $delete=DB::table('posts')->where('id',$id)->delete();
        if($delete){
          unlink($image);
          return Redirect()->back();
        }else{

        }
    }
}
