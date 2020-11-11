<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    // create
    public function create(Request $request) {

        // Have not validated yet !!!

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

    // Update
    public function update(Request $request, $id) {
        $pet = Pet::find($id);

        if ($request->input('avatar')) {
            $pet->avatar = $request->input('avatar');
        }
        if ($request->input('name')) {
            $pet->name = $request->input('name');
        }
        if ($request->input('age')) {
            $pet->age = $request->input('age');
        }
        if ($request->input('gender')) {
            $pet->gender = $request->input('gender');
        }
        if ($request->input('type_delivery')) {
            $pet->type_delivery = $request->input('type_delivery');
        }
        if ($request->input('type')) {
            $pet->type = $request->input('type');
        }
        if ($request->input('breed')) {
            $pet->breed = $request->input('breed');
        }
        if ($request->input('color')) {
            $pet->color = $request->input('color');
        }
        if ($request->input('status')) {
            $pet->status = $request->input('status');
        }
        if ($request->input('description')) {
            $pet->description = $request->input('description');
        }

        $pet->save();

        return response()->json([
            'message' => 'Successfully updated the record!',
            'record' => $pet
        ], 201);
    }
}
