<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/posts', function () {
    // Eager Load
    // $posts = Post::with('author', 'category')->latest()->get();

    $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString();

    $title = 'All Articles.';

    if (request('category')) {
        $category = Category::firstWhere('slug', request('category'));
        $title = $posts->total().' '.$category->name.' articles.';
    }

    if (request('author')) {
        $author = User::firstWhere('username', request('author'));
        $title = $posts->total().' '.$author->name.' articles.';
    }

    return view('posts', ['title' => $title, 'posts' => $posts]);
});

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
