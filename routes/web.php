<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\comment;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::view('/login','auth.login')->middleware('guest');

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::view('/','admin.home')->name('home');

    Route::view('/user/register', 'admin.users.user_register')->name('user.register');
    Route::post('/users/register','Admin\User@register_users')->name('users.register');

    Route::get('/user','Admin\User@admin_user')->name('user');
    Route::view('/users','admin.users.users')->name('users');

    Route::get('/users/update/{id}',function($id){
        return view('admin.users.user_update',compact('id'));
    })->name('user.update');
    Route::post('/users/update','Admin\User@update_users')->name('user.updated');

    Route::post('/users','Admin\User@search')->name('users.search');
    Route::get('/users/delete/{id}','Admin\User@delete_users')->name('user.delete');


    Route::get('/books/create','Admin\Book@admin_book_create_view')->name('books.create');
    Route::view('/book/create', 'admin.book.book_create')->name('book.create');
    Route::post('/books/create','Admin\Book@create_books')->name('books.create');

    Route::get('/book','Admin\Book@admin_book')->name('book');
    Route::view('/books','admin.book.books')->name('books');

    Route::get('/books/update/{id}','Admin\Book@admin_book_update_view')->name('book.update');
    Route::post('/books/update','Admin\Book@update_books')->name('book.updated');

    Route::post('/books','Admin\book@search')->name('books.search');
    Route::get('/books/delete/{id}','Admin\Book@delete_books')->name('book.delete');

    // Route::get('/authors/create','Admin\author@admin_author_create_view')->name('authors.create');
    Route::view('/author/create', 'admin.author.author_create')->name('author.create');
    Route::post('/authors/create','Admin\Author@create_authors')->name('authors.create');

    Route::get('/author','Admin\Author@admin_author')->name('author');
    Route::view('/authors','admin.author.authors')->name('authors');

    Route::get('/authors/update/{id}',function($id){
        return view('admin.author.author_update',compact('id'));
    })->name('author.update');
    Route::post('/authors/update','Admin\author@update_authors')->name('author.updated');

    Route::post('/authors','Admin\Author@search')->name('authors.search');
    Route::get('/authors/delete/{id}','Admin\Author@delete_authors')->name('author.delete');


    Route::get('contact','Admin\Contact@admin_contact')->name('contact');
    Route::view('/contacts','admin.contacts')->name('contacts');
    Route::post('/contact/search','Admin\Contact@contact_search')->name('contact.search');
    Route::get('/contact/delete/{id}','Admin\Contact@contact_delete')->name('contact.delete');



});;



Route::get('download/{filename}', function($filename)
{
    $file_path = public_path() .'/files/books/'. $filename;
    // dd($file_path);
    if (file_exists($file_path))
    {
        return response()->download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        exit('Հայցված ֆայլը գոյություն չունի մեր սերվերում!');
    }
})->name('download');


Route::get('/', function () {
    session()->put('authors',Author::latest()->paginate(3));
    session()->put('books',Book::latest()->paginate(3));
    return view('index');
})->name('main');

Route::get('/author/{id}', function ($id) {
    $author = Author::find($id);
    session()->put('authors',Author::latest()->paginate(3));
    session()->put('author',$author);
    return view('author');
})->name('author');

Route::get('/authors', function () {
    session()->put('authors',Author::latest()->get());
    return view('authors');
})->name('authors');

Route::get('/authors/search','AuthorController@authors_search')->name('authors_scearch');

Route::get('/book/{id}', function ($id) {
    $book = Book::find($id);
    session()->put('books',Book::latest()->paginate(3));
    session()->put('book',$book);
    session()->put('comments',comment::latest()->get());
    return view('book');
})->name('book');

Route::get('/books', function () {
    session()->put('books' , Book::latest()->get());
    return view('books');
})->name('books');

Route::get('/books/search','BookController@books_search')->name('books_scearch');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/post','ContactController@store')->name('contact.save');

Route::post('/comment/post','CommentController@store')->name('comment.save')->middleware('auth');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/aa','Admin\User@aa');
