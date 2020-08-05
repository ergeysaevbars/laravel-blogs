<?php

namespace App\Http\Controllers;

use App\Events\BlogsViewsIncrement;
use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter)
    {
        $blogs = new Blog();
        $user = Auth::user();
        if ($filter == 'my'){
            if (!$user)
                return redirect('/');
            else {
                $blogs = $blogs->where('user_id', $user->id);
                $order = 'created_at';
            }
        }
        elseif($filter == 'new') {
            $order = 'created_at';
        }elseif($filter == 'popular'){
            $order = 'views';
        }
        $blogs = $blogs->orderBy($order, 'desc')->get();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $cover = $request->file('cover');
        if ($cover) {
            $cover_name = "cover_" . microtime(true) . "." . $cover->extension();
            $cover->storeAs('covers', $cover_name);
            $request->cover = "covers/" . $cover_name;
        }
        $user_id = Auth::user()->id;
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'user_id' => $user_id,
            'cover' => $request->cover
        ]);
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        event(new BlogsViewsIncrement($blog));
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }

    public function lastBlogs()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->limit(10)->get();
        return view('index', compact('blogs'));
    }
}
