<?php

namespace App\Http\Controllers;

use App\Models\image_management_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageManagementTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return image_management_table::all();
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
        $url= url()->previous();

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $ffname = $request->file('img')->getClientOriginalName();

        $fpath = $request->img->move(('storage/user_img'), $ffname);

        $finaln= "/storage/user_img/". $ffname;

        $image = image_management_table::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image_url'=>$request->$finaln

        ]);

        return response()->json($image, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\image_management_table  $image_management_table
     * @return \Illuminate\Http\Response
     */
    public function show(image_management_table $image_management_table)
    {
        return $image_management_table;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\image_management_table  $image_management_table
     * @return \Illuminate\Http\Response
     */
    public function edit(image_management_table $image_management_table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\image_management_table  $image_management_table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, image_management_table $image_management_table)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'string|max:255',
            'description' => 'string',
            'img' => 'required|mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        
            $image_management_table->update($request->all());
        
            return response()->json($image_management_table, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image_management_table  $image_management_table
     * @return \Illuminate\Http\Response
     */
    public function destroy(image_management_table $image_management_table)
    {
        $image_management_table->delete();

    return response()->json(null, 204);
    }
}
