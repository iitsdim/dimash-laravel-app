<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $authors = Author::all(['id', 'name'])->toArray();
        return view('authors', ['authors' => $authors]);
    }


    public static function getAllJson()
    {
        $authors = Author::all(['id', 'name'])->toArray();
        return $authors;
    }

    public function get(int $id)
    {
        $author = Author::find($id);
        if($author) {
            $author = $author->toArray();
            unset($author['created_at']);
            unset($author['updated_at']);
            return view('authors', ['authors' => [$author]]);
        } else{
            return view('authors', ['authors' => []]);
        }

    }

    public function save(Request $request, int $id = null)
    {
        $fields = $request->toArray();
        if(isset($fields['_token']))
            unset($fields['_token']);
        if($id === null){
            Author::factory()->create($fields);
        }
        else{
            $author = Author::find($id);
            if($author === null)
                return Redirect::back()->withErrors(['msg' => 'Author not found.']);
            foreach ($fields as $key => $val){
                $author->$key = $val;
            }
            $author->save();
        }
        return redirect()->action([AuthorController::class, 'index']);
    }

    public function delete(int $id)
    {
        $author = Author::find($id);

        if($author === null)  {
            return Redirect::back()->withErrors(['msg' => 'Author not found.']);
        }

        if($author->books()->count() > 0){
            return Redirect::back()->withErrors(['msg' => 'The author has some books and cannot be deleted.']);
        }

        $author->books()->delete();
        $author->delete();

        return redirect()->action([AuthorController::class, 'index']);
    }

    public function edit(int $id)
    {
        $author = Author::find($id);
        if($author === null)
            return Redirect::back()->withErrors(['msg' => 'Author not found.']);
        return view('edit_author', ['id' => $id, 'name' => $author->name]);
    }

}
