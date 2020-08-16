<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $offset = $request->has('offset') ? $request->query('offset') : 0;
      $limit  = $request->has('limit') ? $request->query('limit') : 10; // istekte bir limit değeri gelirse o değeri alsın eğer gelmezse 10 u alsın

      $qb = User::query();
      if ($request->has('q'))  // istek içerisinde q harfiyle ilgili bir değer var ise
        $qb->where('name', 'like', '%' . $request->query('q') . '%');

      if ($request->has('sortBy'))  // sıralama
        $qb->orderBy($request->query('sortBy'), $request->query('sort', 'DESC'));

      $data = $qb->offset($offset)->limit($limit)->get();

      // // burada normalde olmayan bir kolon ismi oluşturuyoruz ve daha önceden var olan first_name ve last_name kolonlarından full_name adında bir kolon oluşturuyoruz.      
      $data->each->setAppends(['full_name']); // model de tanımlayabiliriz ama o zaman o modelle yaptığımız tüm işlemleri etkileyeceğimiz için burada tanımlıyoruz

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
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();


      return response([
        'data' => $user,
        'message' => 'User created broo'
      ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $user->name = $request->name;
      $user->email = $request->email;
      $user->save();


      return response([
        'data' => $user,
        'message' => 'User updated broo'
      ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      $user->delete();
      return response([
        'message' => 'User deleted bro'
      ], 200);
    }
}
