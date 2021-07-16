<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "user";
    const roles = "admin,guest";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        "id",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function validaterule() {
        return [
            "name" => "required|unique:user",
            "display_name" => "required|string",
            // "role" => "required|in:" . join(",", array_keys((new \App\L\Role())->labels())),
            "role" => "required|in:" . self::roles,
            // "email" => "required|email:rfc",
            "password" => "required|min:8|confirmed",
            "last_datetime" => "nullable|datetime",
            "last_action" => "nullable|string",
            "last_user_id" => "nullable|integer",
        ];
    }

    public function saveProc($data)
    {
        $this->password = array_key_exists("password", $data) ? \Illuminate\Support\Facades\Hash::make($data['password']) : $this->password;
        $this->name = array_key_exists("name", $data) ? $data["name"] : $this->name;
        $this->display_name = array_key_exists("display_name", $data) ? $data["display_name"] : $this->display_name;
        $this->email = array_key_exists("email", $data) ? $data["email"] : $this->email;
        $this->role = array_key_exists("role", $data) ? $data["role"] : $this->role;
        $this->last_user_id = \Auth::user()["id"];
        $ret = $this->save();
        return $ret;
    }

    // *********************************************************************************
    // role
    // *********************************************************************************
    public function isRoles($roles)
    {
        $ret = in_array($this->role, $roles);
        return $ret;
    }

    public function isAdmin()
    {
        return $this->isRoles([\App\L\Role::ID_ADMIN]);
    }

    public static function isPub()
    {
        $user = \Auth::user();
        return !$user;
    }

    public static function isLogin()
    {
        $user = \Auth::user();
        return $user;
    }
    public static function isLoginRoles($roles)
    {
        $user = \Auth::user();
        if($user) {
            return $user->isRoles($roles);
        } else {
            // ログインしていない
            return false;
        }
    }
    // *********************************************************************************
    // static
    // *********************************************************************************

    // *********************************************************************************
    // load
    // *********************************************************************************
}
