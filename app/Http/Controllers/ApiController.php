<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Rental;

class ApiController extends Controller
{
    public function Filmek()
    {
        return Movie::all();
    }
    public function FilmKereses($query)
    {
        return Movie::where('title', 'like', "%{$query}%")
                    ->orWhere('director', 'like', "%{$query}%")
                    ->get();
    }
    function Kolcsonzes(Request $request)
    {
        $rental = new Rental();
        $rental->movie_id = $request->movie_id;
        $rental->borrower_name = $request->borrower_name;
        $rental->save();
        $movie = Movie::findOrFail($rental->movie_id);
        if ($movie->available_copies > 0) {
            $movie->available_copies--;
            $movie->save();
        } else {
            return response()->json([
                'error' => 'Nem lehet kolcsonzni, nincsen a raktáron'
            ], 400);
        }
        return $rental;
    }
    function Visszavitel(Request $request)
    {
        $rental = Rental::findOrFail($request->id);
        $rental->returned_at = now();
        $rental->save();
        $movie = Movie::findOrFail($rental->movie_id);
        $movie->available_copies++;
        $movie->save();
        return $rental;
    }
    function Kolcsonzesek()
    {
        return Rental::all();
    }
}
