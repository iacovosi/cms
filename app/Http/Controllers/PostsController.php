<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts', Post::all()->sortBy('order'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function draglist()
    {
        $categories=Category::all();
        $cat=Array();
        foreach($categories as $category) {
            $cat[$category->id]=$category->name;
        }
        return view('admin.posts.draglist')->with('posts', Post::all()->sortBy('order'))->with('categories',$cat);
    }    

    public function updateOrder(Request $request)
    {
        //$posts = Post::all();

        foreach ($request->order as $order) {
            //echo $order['id']." - ".$order['position'].PHP_EOL;
            $post=Post::find($order['id']);
            $post->timestamps = false; // To disable update_at field updation
            $post->order= $order['position'];
            $post->save();
        }
        
        return response('Update Successfully.', 200);
    }


    public function updateStatus(Request $request)
    {
        //$posts = Post::all();
        foreach ($request->val as $val) {
            //echo $order['id']." - ".$order['position'].PHP_EOL;
            $post=Post::find($val['id']);
            $post->timestamps = false; // To disable update_at field updation
            if (!empty($val['status'])) {
                $post->status= 1;
                $post->save();
            }
            else {
                $post->status= 0;
                $post->save();                
            }
        }
        
        return response('Update Successfully.', 200);
    }    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        if($categories->count() == 0)
        {
            Session::flash('info', 'You must have some categories and tags before attempting to create a post.');

            return redirect()->back();
        }

        return view('admin.posts.create')->with('categories', $categories);
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
            'title' => 'required',
            'image' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $image = $request->image;

        $image_new_name = time().$image->getClientOriginalName();

        $image->move('uploads/posts', $image_new_name);

        if (!isset($request->status) || empty($request->status)) {
            $status=0; 
        }
        else {
            $status=1; 
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => 'uploads/posts/' . $image_new_name,
            'category_id' => $request->category_id,
            'status' =>$status,
            'user_id' => Auth::id()
        ]);


        Session::flash('success', 'Post created succesfully.');


        return redirect()->back();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.posts.edit')->with('post', $post)
                                      ->with('categories', Category::all());
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

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $post = Post::find($id);

        if($request->hasFile('image'))
        {
            $image = $request->image;

            $image_new_name = time() . $image->getClientOriginalName();

            $image->move('uploads/posts', $image_new_name);

            $post->image = 'uploads/posts/'.$image_new_name;
            
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        if (!isset($request->status) || empty($request->status)) {
            $post->status=0; 
        }
        else {
            $post->status=1; 
        }

        $post->save();

        Session::flash('success', 'Post updated successfully.');

        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        Session::flash('success', 'The post was just trashed.');

        return redirect()->back();
    }



}
