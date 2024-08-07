<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=User::query()->latest('id')->get();
        return response()->json(['data'=>$data,'message'=>'lấy dữ liệu thành công'],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        // die;
        User::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->pass,
            'image'=>Storage::put('public/image',$request->image)

        ]);
        return response()->json([
            "message"=>"thêm dữ liệu thành công"
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       $find= User::query()->select(['name','email','password'])->where('id',$id)->first();
        return response()->json(['user'=>$find],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->except($request->input('_token'));
       User::query()->where("id",$id)->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,

       ]

    );
    return response()->json(['message'=>"sửa thành công"],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::query()->where('id',$id)->delete();
        return response()->json(['message'=>'xóa thành công'],200);
    }
}
