<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $data = Movie::withCount([
            'votes as likes_count' => function ($query) {
                $query->where('liked', true);
            },
            'votes as dislikes_count' => function ($query) {
                $query->where('liked', false);
            }
        ])->with('user:id,name');
        if ($request->orderBy && $request->order) {
            $data = $data->orderBy($request->orderBy , $request->order);
        }
        
        return response()->json($data->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:movies,title',
            'description' => 'required|string|max:255'
        ]);
        $movie = Movie::create([
            'title' =>$request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
