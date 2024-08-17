<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
        // dd($data);
        return view('index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $tag = Tag::query()->get();
        $ct = Category::query()->get();
        return view('create', compact('tag', 'ct'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
            'dm'=>"required",
            'description'=>"required",
            'price'=>"required",
            'tag'=>'required|array',
            'gallery'=>'required|array',
            // 'gallery.*'=>'required'
            
        ]);
        try {
            
            DB::transaction(function () use ($request) {
                $product = Product::query()->create([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'category_id' => $request->input('dm')

                ]);
                $product->Tag()->attach($request->tag);

                // foreach ($request->tag as $key => $tag) {
                // }
                foreach ($request->gallery as  $gallery) {
                    $path = Storage::put('public/image', $gallery);
                    Gallery::query()->create([
                        'product_id' => $product->id,
                        'image_path' => $path
                    ]);
                }
            });
            return redirect()->route('product.index');
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Product::query()->findOrFail($id)->load([
            'Category',
            'Galleries',
            'Tag'
        ]);

        // dd($data);
        $tag = Tag::query()->pluck('name', 'id');
        // dd($tag);
        $ct = Category::query()->get();

        return view('edit', compact('data', 'ct', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // dd($request->all());
        $url = "";
        $product = Product::query()->findOrFail($id)->load(['Tag']);
        Product::query()->where('id', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('dm')

        ]);
        $product->Tag()->sync($request->tag);
        foreach ($request->gallery as $key => $value) {
            $url = Storage::put('public/image', $value);
            Gallery::query()->where('id', $key)->update([
                'product_id' => $product->id,
                'image_path' => $url
            ]);
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::query()->findOrFail($id);


        $product->Tag()->sync([]);

        foreach ($product->Galleries as $key => $value) {
            // dd($value);
            Storage::delete($value->image_path);
        }
        $product->Galleries()->delete();
        $product->delete();
        return back();
    }
}
