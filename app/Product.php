<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [
    //   'name',
    //   'slug',
    //   'price' // izin veriyoruz ekleme güncelleme de kullanılacak diye
    // ];

    // protected $guarded = [
      // 'password'
    // ]; // eklenmesini yada güncellenmesini istenmiyorsa

    protected $guarded = []; // tüm kolonlara veri engelsiz eklenebilir ve güncellenebilir

    // protected $hidden = ['slug']; // çıktılarda gösterilmeyecek

    public function categories(){
      return $this->belongsToMany('App\Category', 'product_categories');
    }

}
