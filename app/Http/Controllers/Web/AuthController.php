<?php

namespace App\Http\Controllers\Web;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //register
    public function register(){
        return view('register');
    }

    //login
    public function login(){
        return view('login');
    }

    public function index()
    {
        $books = Book::with('user','rating')->withCount('rating')->orderBy('created_at','desc')->get();
        return view('dashboard',compact('books'));
    }

}
