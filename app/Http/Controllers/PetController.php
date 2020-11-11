<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    // create
    public function create(Request $request) {
        // Validate

        // Create
        $pet = new Pet;
        $pet->avatar = $request->input('avatar');
        $pet->name = $request->input('name');
        $pet->age = $request->input('age');
        $pet->gender = $request->input('gender');
        $pet->type_delivery = $request->input('type_delivery');
        $pet->type = $request->input('type');
        $pet->breed = $request->input('breed');
        $pet->color = $request->input('color');
        $pet->status = $request->input('status');
        $pet->description = $request->input('description');
        $pet->user_id = $request->user()->id;
        $pet->save();

        return response()->json([
            'message' => 'Successfully created the record!',
            'record' => $pet
        ], 201);
    }

    // showAll
    public function showAll(Request $request) {

        $typeQuery = $request->query('type');

        $pets = Pet::where('user_id', '=', $request->user()->id)->get();

        if ($typeQuery) {
            $pets = Pet::where('user_id', '=', $request->user()->id)->where('type', '=', $typeQuery)->get();
        }

        return response()->json([
            'pets' => $pets,
            'pet_quantity' => sizeof($pets)
        ], 201);
    }
}
