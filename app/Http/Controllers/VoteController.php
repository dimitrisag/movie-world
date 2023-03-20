<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $movie = Movie::findOrFail($request->movie_id);
        if ($movie->user_id ==$request->user_id) {
            return response()->json('You cannot vote for a movie you posted');
        }
        $vote = Vote::where('user_id', $request->user_id)
                    ->where('movie_id', $request->movie_id)
                    ->first();

        if ($vote) {
            $vote->liked = $request->liked;
            $vote->save();
        } else {
            $like = Vote::create([
                'user_id' => $request->user_id,
                'movie_id' => $request->movie_id,
                'liked' => $request->liked
            ]);
        }
        return;
    }
}
