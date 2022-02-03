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


    public function index(Request $request)
    {
        $sort_by = $request->input('sort_by', 'id');
        $order = $request->input('order', 'ASC');
        $paginate = $request->input('paginate', 5);
        $authors = Author::orderBy($sort_by, $order)->paginate($paginate);

        return view('authors', ['authors' => $authors, 'keys' => ['id', 'name']]);
    }


    public static function getAll()
    {
        return Author::all(['id', 'name'])->toArray();
    }

    public function get(int $id)
    {
        $author = Author::with(['books'])->findOrFail($id);
        return view('author_details', ['author' => $author]);
    }

    public function save(Request $request, int $id = null)
    {
        $fields = $request->toArray();
        if (isset($fields['_token'])) {
            unset($fields['_token']);
        }
        if ($id === null) {
            $author = Author::factory()->create($fields);
        } else {
            $author = Author::findOrFail($id);
            foreach ($fields as $key => $val) {
                $author->$key = $val;
            }
            $author->save();
        }

        return redirect()->action(
            [AuthorController::class, 'get'], ['id' => $author->id]
        );
    }

    public function delete(int $id)
    {
        $author = Author::findOrFail($id);

        if ($author->books()->count() > 0) {
            return Redirect::back()->withErrors(['msg' => 'The author has some books and cannot be deleted.']);
        }

        $author->delete();

        return redirect()->action([AuthorController::class, 'index']);
    }

    public function edit(int $id)
    {
        $author = Author::findOrFail($id);
        return view('edit_author', ['id' => $id, 'name' => $author->name]);
    }

    public function loadAuthor()
    {
        return view('load_author');
    }

}
