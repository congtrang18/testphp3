<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Product::query()->with([
            'Category',
            'Galleries',
            'Tag'
        ])->latest('id')->paginate(2);
        // dd($data->toArray());
        return response()->json([
            'succcess' => 'lấy dữ liệu thành công',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            // $product = "";
            // DB::transaction(function () use ($request) {
                $product = Product::query()->create([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'category_id' => $request->input('dm')

                ]);
                // dd($product);
                $product->Tag()->attach($request->tag);

                // foreach ($request->tag as $key => $tag) {
                // }
                foreach ($request->gallery as  $gallery) {
                    // $path = Storage::put('public/image', $gallery);
                    Gallery::query()->create([
                        'product_id' => $product->id,
                        'image_path' => $gallery
                    ]);
                }
               
                return response()->json([
                    'success' => 'thêm dữ liệu thành công',
                    'data' =>$product ,
                ], 200);
            // });
            

            
           
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
