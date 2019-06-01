<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Comment;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','view']);
    }

    public function index()
    {

    	$data = Post::orderBy('id','desc')->paginate(5);

    	return view('posts/index',[
    		'data' => $data
    	]);
    }

    public function view($id)
    {
    	$post = Post::find($id);

        return view('posts/view',[
            'post' => $post
        ]);
    }

    public function add(){
        $categories = Category::all();

        return view('posts/add',[
            'categories'=> $categories
        ]);
    }

    public function create(){

        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required"
        ]);

        if($validator->fails()){
            return redirect ('/posts/add')->withErrors($validator);
        }

        $post = new Post;
        $post->title= request()->title;// $_POST('title')
        $post->body= request()->body;
        $post->category_id= request()->category_id;
        $post->save();

        return redirect('/posts');
    }

    public function edit($id)
    {
        $post=Post::find($id);
        if($post->user_id== auth()->user()->id){
        return view('posts/edit',['post'=>$post]);
        }
        return back()->with('info','unauthorize to edit');
    }

    public function update($id){

        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required"
        ]);

        if($validator->fails()){
            return redirect ("/posts/edit/$id")->withErrors($validator);
        }

        $post = Post::find($id);
        $post->title= request()->title;// $_POST('title')
        $post->body= request()->body;
        $post->category_id= request()->category_id;
        $post->save();

        return redirect("/posts/view/$id");
    }


    public function delete($id)
    {
        $post = Post::find($id);

        if($post->user_id== auth()->user()->id){ 
        $post->delete();
        return redirect('/posts')->with('info','A Post Deleted');
        }
        return back()->with('info','unauthorize to delete');
    }

    public function comment()
    {
        $comment = new Comment;
        $comment->comment = request()->comment;
        $comment->post_id = request()->post_id;
        $comment->save();

        return back();
    }

}
