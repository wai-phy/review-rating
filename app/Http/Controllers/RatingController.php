<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    
    public function store(Request $request, Book $book )
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
        ]);
          
            $rating = new Rating;
            $rating->review = $request->review;
            $rating->rating = $request->rating;
            $rating->user_id = Auth::user()->id;

            $book->rating()->save($rating);
            return response()->json(['message' => 'Review Added', 'review' => $rating]);
      
    }

    public function update(Request $request, Book $book, Rating $rating)
    {
        if (Auth::user()->id !== $rating->user_id) {
            return response()->json(['message' => 'Action Forbidden']);
        }
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        $rating->review = $request->review;
        $rating->rating = $request->rating;
        $rating->save();

        return response()->json(['message' => 'Review Updated', 'review' => $rating]);
    }

    public function destroy(Book $book, Rating $rating)
    {
        if (Auth::user()->id !== $rating->user_id) {
            return response()->json(['message' => 'Action Forbidden']);
        }
        $rating->delete();
        return response()->json(null, 204);
    }
}
