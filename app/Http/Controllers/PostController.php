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

    // Show All
    public function showAll(Request $request) {

        $posts = Post::where('user_id', '=', $request->user()->id)->get();

        if($posts->count() > 0)
        {
            foreach($posts as $post)
            {
                $pet = Pet::where('id', '=', $post->pet_id)->select('*')->first();
                $post->pet = $pet;
                unset($post->pet_id);
            }
        }
        
        return response()->json([
            'posts' => $posts,
            'post_quantity' => sizeof($posts)
        ], 201);
    }

    // Show detail
    public function showDetail($id)
    {
        $post = Post::where('id', '=', $id)->select('*')->first();
        if ($post) {
            $pet = Pet::where('id', '=', $post->pet_id)->select('*')->first();
            $post->pet = $pet;
            unset($post->pet_id);
            return response()->json([
                'post' => $post
            ], 201);
        }

        return response()->json([
            'message' => 'Opp!!! The post does not exist.'
        ], 201);
    }
}
