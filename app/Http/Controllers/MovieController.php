<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addGenre(Request $request, Movie $movie)
    {
        $genre = Genre::find($request->genre_id);
        $movie->genres()->attach($genre);
        return response()->json(['message' => 'Genre added successfully'], 201);
    }

    public function addActor(Request $request, Movie $movie)
    {
        $actor = Actor::find($request->actor_id);
        $movie->actors()->attach($actor);
        return response()->json(['message' => 'Actor added successfully'], 201);
    }

    public function index()
    {
        try {
            return response()->json(Movie::all(), 200);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movieData = $request->all();

        $movie = Movie::create($movieData);

        if (isset($movieData['actors'])) {
            $movie->actors()->attach($movieData['actors']);
        }

        if (isset($movieData['genres'])) {
            $movie->genres()->attach($movieData['genres']);
        }

        return response()->json(['message' => 'Movie created successfully'], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
            try {
                $movieWithRelations = Movie::with('actors', 'genres')->find($movie->id);

                return response()->json($movieWithRelations, 200);
            } catch (Exception $exception) {
                return response()->json(['error' => $exception], 500);
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        try {
            $movie->update($request->all());
            return response()->json($movie, 200);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        try {
            $movie->actors()->detach();
            $movie->genres()->detach();
            $movie->delete();
            return response()->json(['message' => 'Deleted'], 205);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
