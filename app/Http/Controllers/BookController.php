<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //
    public function index()
    {
        $books = Book::select('books.*','ratings.rating as rating','ratings.review as review')
        ->Join('ratings', 'books.id', 'ratings.book_id')
        ->orderBy('ratings.rating', 'DESC')
        ->distinct('books.id')
        ->get();
    return response()->json(['books' => $books]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'author' => 'required',
        ]);

        $user = Auth::user();
        $book = new Book;
        $book->title = $request->title;
        $book->content = $request->content;
        $book->author = $request->author;

        $user->book()->save($book);
        return response()->json(['message' => 'Book Added', 'book' => $book]);
    }

    public function show($id){
     $book = Book::select('books.*','ratings.rating as rating','ratings.review as review')
        ->Join('ratings', 'books.id', 'ratings.book_id')
        ->orderBy('ratings.rating', 'DESC')
        ->distinct('books.id')
        ->first();
        return response()->json(['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        if (auth()->user()->id !== $book->user_id) {
            return response()->json(['message' => 'Action Forbidden']);
        }
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'author' => 'required',
        ]);

        $book->title = $request->title;
        $book->content = $request->content;
        $book->author = $request->author;
        $book->update();

        return response()->json(['message' => 'Book Updated', 'product' => $book]);
    }


    public function destroy(Book $book)
    {
        if (auth()->user()->id !== $book->user_id) {
            return response()->json(['message' => 'Action Forbidden']);
        }
        $book->delete();
        return response()->json(null, 204);
    }

}
