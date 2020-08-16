<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'date'
    ];

    // burada normalde olmayan bir kolon ismi oluşturuyoruz ve daha önceden var olan first_name ve last_name kolonlarından full_name adında bir kolon oluşturuyoruz.
    // protected $appends = ['full_name']; // ama burada oluşturduğumuz da bu model ile yapılan tüm işlemlerde geçerli olacağı için ilgili controller a yazmak daha sağlıklı.

    public function getFullNameAttribute(){ // üstte verdiğimiz ismi camelcase tanımlıyoruz
      return $this->first_name . " " . $this->last_name;
    }
}
