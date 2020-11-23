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
            ], 200);
        }
        return response()->json([
            'message' => 'Opp!!! The pet does not exist.'
        ], 200);
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
        ], 200);
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
            ], 200);
        }

        return response()->json([
            'message' => 'Opp!!! The post does not exist.'
        ], 200);
    }

    // Update
    public function update(Request $request, $id) {
        $post = Post::find($id);

        if ($request->input('price')) {
            $post->price = $request->input('price');
        }

        $pet = Pet::where('id', '=', $request->input('pet_id'))->select('*')->first();

        if ($pet && $request->input('pet_id')) {
            $post->pet_id = $request->input('pet_id');
        }

        $post->save();

        return response()->json([
            'message' => 'Successfully updated the record!',
            'record' => $post
        ], 200);
    }

    // Delete
    public function delete($id)
    {
        $post = Post::find($id);

        $post->delete();
        
        return response()->json([
            'message' => 'Successfully deleted the record!',
            'record' => $post
        ], 200);
    }
}
