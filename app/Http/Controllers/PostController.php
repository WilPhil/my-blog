<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Rules\Striptags;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth::user()->is_admin) {
            $posts = post::latest();
        } else {
            $posts = post::where('author_id', auth::user()->id)->latest();
        }

        if (request('search')) {
            $posts->where(function ($q) {
                $q->where('title', 'like', '%'.request('search').'%')
                    ->orwherehas('category', fn (builder $query) => $query->where('name', 'like', '%'.request('search').'%'))
                    ->orwherehas('author', fn (builder $query) => $query->where('name', 'like', '%'.request('search').'%'));
            });
        }

        return view('dashboard.index', ['posts' => $posts->paginate(5)->withquerystring()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'category_id' => 'required',
        //     'body' => 'required',
        // ]);

        Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'category_id' => 'required',
            'body' => ['required', new Striptags],
        ], [], [
            'category_id' => 'category',
        ])->validate();

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'body' => $request->body,
        ]);

        return redirect(route('dashboard.index'))->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'body' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'body' => $request->body,
        ]);

        return redirect(route('dashboard.index'))->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('dashboard.index'))->with('success', 'Post deleted successfully.');
    }
}
