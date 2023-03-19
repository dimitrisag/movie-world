<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index(Request $request)
    {
        $likes = Vote::where('movie_id', $request->movie_id)
            ->where('liked', true)
            ->count();
            
        $hates = Vote::where('movie_id', $request->movie_id)
            ->where('liked', false)
            ->count();

        $result = [
            'likes' => $likes,
            'hates' => $hates,
        ];
        return response()->json($result);
    }

    public function store(Request $request)
    {

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
