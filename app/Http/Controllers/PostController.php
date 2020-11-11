<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Pet;

class PostController extends Controller
{
    // Create
    public function create(Request $request) {

        $pet = Pet::where('id', '=', $request->input('pet_id'))->select('*')->first();

        if ($pet) {
            $post = new Post;

            $post->pet_id = $request->input('pet_id');
            $post->price = $request->input('price');
            $post->user_id = $request->user()->id;
            $post->save();

            return response()->json([
                'message' => 'Successfully created the record!',
                'record' => $post
            ], 201);
        }
        return response()->json([
            'message' => 'Opp!!! The pet does not exist.'
        ], 201);
    }
}
