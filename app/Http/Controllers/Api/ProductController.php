<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Product::all();
        // return response()->json(Product::all(), 200); // 200 durum kodu ile gönderiliyor
        // return response(Product::all(), 200);
        // return response(Product::paginate(10), 200);

        $offset = $request->has('offset') ? $request->query('offset') : 0;
        $limit  = $request->has('limit') ? $request->query('limit') : 10; // istekte bir limit değeri gelirse o değeri alsın eğer gelmezse 10 u alsın

        $qb = Product::query();
        if ($request->has('q'))  // istek içerisinde q harfiyle ilgili bir değer var ise
          $qb->where('name', 'like', '%' . $request->query('q') . '%');

        if ($request->has('sortBy'))  // sıralama
          $qb->orderBy($request->query('sortBy'), $request->query('sort', 'DESC'));

        $data = $qb->offset($offset)->limit($limit)->get();
        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();
        // $product = Product::create($input); // db  ye kayıt ekliyoruz


        // nesneyi kendimiz de oluşturabiliriz
        $product = new Product;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->save();


        return response([
          'data' => $product,
          'message' => 'Product created broo'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
          return response($product, 200);
        }else {
          return response(['message' => 'Product not found bro'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
      // model binding gibi birşey olduğu için (Product $product), direk  ->update kullanabiliyormuşsuz öyle bir rivayet var :D

      // $input = $request->all();
      // $product->update($input);

      $product->name = $request->name;
      $product->slug = Str::slug($request->name);
      $product->price = $request->price;
      $product->save();


      return response([
        'data' => $product,
        'message' => 'Product updated broo'
      ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response([
          'message' => 'Product deleted bro'
        ], 200);
    }
}
