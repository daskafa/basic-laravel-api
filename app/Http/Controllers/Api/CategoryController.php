<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Category::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $category = new Category;
      $category->name = $request->name;
      $category->slug = Str::slug($request->name);
      $category->save();


      return response([
        'data' => $category,
        'message' => 'Category created broo'
      ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
      // $category = Category::find($id);
      // if ($category) {
      //   return response($category, 200);
      // }else {
      //   return response(['message' => 'Category not found bro'], 404);
      // }
      return $category;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
      $category->name = $request->name;
      $category->slug = Str::slug($request->name);
      $category->save();


      return response([
        'data' => $category,
        'message' => 'Category updated broo'
      ], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
      $category->delete();
      return response([
        'message' => 'Category deleted bro'
      ], 200);

    }

    public function custom1(){
      // return Category::pluck('id');
      // return Category::pluck('id', 'name');
      return Category::pluck('name', 'id');
    }

    public function report1(){
      return DB::table('product_categories as pc')
      ->selectRaw('c.name, COUNT(*) as total')
      ->join('categories as c', 'c.id', '=', 'pc.category_id')
      ->join('products as p', 'p.id', '=', 'pc.product_id')
      ->groupBy('c.name')
      ->orderByRaw('COUNT(*) DESC')
      ->get();
    }



}
