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
        $saver= image_management_table::all();

        return response()->json($saver,201);

        
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

        $finaln= "storage/user_img/". $ffname;

        $image = image_management_table::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image_url'=>$finaln

        ]);

        return response()->json($image, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\image_management_table  $image_management_table
     * @return \Illuminate\Http\Response
     */
    public function show($image_management_table)
    {
        if($saver= image_management_table::where(['id'=>$image_management_table])->first()){

            return response()->json($saver,201);

        }

        else{
            return response()->json("no img found", 400);

        }
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
    public function update(Request $request ,image_management_table  $image_management_table)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'id' => 'required|string',
            'description' => 'string',
            'img' => 'required|mimes:jpg,jpeg,png',
        ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
         
           

                if($saver= image_management_table::where(['id'=>$request->id])->first()){

                
                    unlink($saver->image_url);

                    $ffname = $request->file('img')->getClientOriginalName();

        $fpath = $request->img->move(('storage/user_img'), $ffname);

        $finaln= "storage/user_img/". $ffname;

       
        $saver->title=$request->title;
        $saver->description=$request->description;
        $saver->image_url=$finaln;

        $saver->save();
        return response()->json($saver, 200);

                }

                else{

                    

                    
        
                    return response()->json("no img found", 400);

                }
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image_management_table  $image_management_table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $image_management_table)
    {
        if($saver= image_management_table::where(['id'=>$image_management_table])->first()){

            $saver->delete();
            return response()->json("Img delet Successfull", 204);
        }
        else{

            return response()->json("No img Found for Delete", 400);
        }


       
       
    }
}
