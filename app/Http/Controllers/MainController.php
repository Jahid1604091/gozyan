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
            "old_price"=>'required',
            "current_price"=>'required',
            "facilities"=>'required',
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
            "sub_location" => $req->sub_location,
            "description" => $req->description,
            "old_price" => $req->old_price,
            "current_price" => $req->current_price,
            "facilities" => $req->facilities,
            "discount" => $req->discount,
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


    //show all properties
    public function getAllProperty()
    {
        $data =  Property::all();

        return response()->json($data);
    }

    //show all location
    public function getLocations()
    {
        $data =  Property::select('location')->get();

        return response()->json($data);
    }

    //search
    public function searchProperty($key)
    {
        $data =  Property::with(['room_details'])->where('name','like','%'.$key.'%')
                        ->orWhere('location','like','%'.$key.'%')->get();

        return response()->json($data);
    }

}
