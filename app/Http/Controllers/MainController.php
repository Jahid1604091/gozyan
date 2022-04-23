<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\RoomDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{

    //create property
    public function createProperty(Request $req)
    {
        $rules = [
            'name' => 'required',
            'img_url' => 'required',
            'location' => 'required',
            'rating' => 'required',
            'type' => 'required',

        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create
        $property = Property::create([
            "name" => $req->name,
            "location" => $req->location,
            "img_url" => $req->img_url,
            "type" => $req->type,
            "rating" => $req->rating,
        ]);


        return response()->json([
            "data" => $property,

        ]);
    }


    //create room details
    public function createRoom(Request $req)
    {
     
        $rules = [
            "status" => "required",
            "aminity" => "required",
            "facility" => "required",
            "fare" => "required",
            "property_id" => "required",
            "photo_url" => "required",

        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create
        $room_details = RoomDetail::create([
            "status" => $req->status,
            "aminity" => $req->aminity,
            "facility" => $req->facility,
            "fare" => $req->fare,
            "discount" => $req->discount,
            "property_id" => $req->property_id,
            "photo_url" => $req->photo_url
        ]);


        return response()->json([
            "data" => $room_details,

        ]);
    }
}
