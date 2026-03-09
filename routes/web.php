<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Eager Load
    // $posts = Post::with('author', 'category')->latest()->get();

    $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString();

    $title = 'All Posts.';

    if (request('category')) {
        $category = Category::firstWhere('slug', request('category'));
        $title = $posts->total().' '.$category->name.' posts.';
    }

    if (request('author')) {
        $author = User::firstWhere('username', request('author'));
        $title = $posts->total().' '.$author->name.' posts.';
    }

    return view('posts', ['title' => $title, 'posts' => $posts]);
})->name('home');

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Create
    Route::post('/dashboard', [PostController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/create', [PostController::class, 'create'])->name('dashboard.create');

    // Delete
    Route::delete('/dashboard/{post:slug}', [PostController::class, 'destroy'])->name('dashboard.destroy');

    // Update
    Route::get('/dashboard/{post:slug}/edit', [PostController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard/{post:slug}', [PostController::class, 'update'])->name('dashboard.update');

    // Read
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/{post:slug}', [PostController::class, 'show'])->name('dashboard.show');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::patch('/category/{category:slug}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category:slug}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Avatar profile upload
    Route::post('/upload', [ProfileController::class, 'upload']);
});

require __DIR__.'/auth.php';
