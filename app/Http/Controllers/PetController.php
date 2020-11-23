<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    // Create
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
        ], 200);
    }

    // Show All
    public function showAll(Request $request) {

        $typeQuery = $request->query('type');

        $pets = Pet::where('user_id', '=', $request->user()->id)->get();

        if ($typeQuery) {
            $pets = Pet::where('user_id', '=', $request->user()->id)->where('type', '=', $typeQuery)->get();
        }

        return response()->json([
            'pets' => $pets,
            'pet_quantity' => sizeof($pets)
        ], 200);
    }

    // Show detail
    public function showDetail($id)
    {
        $pet = Pet::where('id', '=', $id)->select('*')->first();
        return response()->json([
            'pet' => $pet
        ], 200);
    }

    // Update
    public function update(Request $request, $id) {
        $pet = Pet::find($id);
        $pet->update($request->all());
        $pet->save();

        return response()->json([
            'message' => 'Successfully updated the record!',
            'record' => $pet
        ], 200);
    }

    // Delete
    public function delete($id)
    {
        $pet = Pet::find($id);

        $pet->delete();
        
        return response()->json([
            'message' => 'Successfully deleted the record!',
            'record' => $pet
        ], 200);
    }
}
