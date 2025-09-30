<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     * @table users
     *
     * @property int $id
     * @property string $fname
     * @property string $lname
     * @property string $email
     * @property string $password
     * @property boolean $status
     *
     */

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getAllUsersForFilter(Request $request)
    {
        return User::where(function ($query) use ($request) {
            if ($request->searchUser != null) {
                $query->where('fname', 'like', '%' . $request->searchUser . '%')
                    ->orWhere('lname', 'like', '%' . $request->searchUser . '%');
            }
            if ($request->searchEmail != null) {
                $query->Where('email', 'like', '%' . $request->searchEmail . '%');
            }
            if ($request->searchStatus != null) {
                $query->Where('status', $request->searchStatus);
            }
        })
            ->get();
    }
}
