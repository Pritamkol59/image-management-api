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
        return ImageManagement::all();
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $image = ImageManagement::create($request->all());

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
        return $imageManagement;
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
            'image_url' => 'url',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        
            $imageManagement->update($request->all());
        
            return response()->json($imageManagement, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image_management_table  $image_management_table
     * @return \Illuminate\Http\Response
     */
    public function destroy(image_management_table $image_management_table)
    {
        $imageManagement->delete();

    return response()->json(null, 204);
    }
}
