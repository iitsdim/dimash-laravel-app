<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $books = Book::all(['id', 'name', 'pages', 'author_id'])->toArray();

        foreach ($books as &$book){
            unset($book['author_id']);
            $book['author_name'] = $book['author']['name'];
            unset($book['author']);
        }

        return view('books', ['books' => $books]);
    }

    public function get(int $id)
    {
        $book = Book::find($id);
        if($book) {
            $book = $book->toArray();
            unset($book['author_id']);
            $book['author_name'] = $book['author']['name'];
            unset($book['author']);
            unset($book['created_at']);
            unset($book['updated_at']);
            return view('books', ['books' => [$book]]);
        } else{
            return view('books', ['books' => []]);
        }
    }

    public function save(Request $request, int $id = null)
    {
        $fields = $request->toArray();
        if(isset($fields['_token'])){
            unset($fields['_token']);
        }

        if($id === null){
            Book::factory()->create($fields);
        } else{
            $book = Book::find($id);
            if( !($book === null)){
                foreach ($fields as $key => $val){
                    $book->$key = $val;
                }
                $book->save();
            }
        }

        return redirect()->action([BookController::class, 'index']);
    }

    public function delete(int $id)
    {
        $book = Book::find($id);

        if($book === null)
            return null;

        $book->delete();

        return redirect()->action([BookController::class, 'index']);
    }

    public function edit(int $id)
    {
        $book = Book::find($id);
        if($book === null)
            return Redirect::back()->withErrors(['msg' => 'Book not found.']);
        $authors = AuthorController::getAllJson();
        return view('edit_book', ['id' => $id, 'name' => $book->name, 'pages' => $book->pages, 'author_id' => $book->author_id, 'authors' => $authors]);
    }

}
