<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     * @table customers
     *
     * @property int $id
     * @property unsignedBigInteger $user_id
     * @property string $fname
     * @property string $lname
     * @property string $email
     * @property string $contact
     *
     */

    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'email',
        'contact'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function getAllCustomersForFilter (Request $request)
    {
        return Customer::where(function ($query) use ($request) {
                if($request->searchCustomer != null) {
                    $query->where('fname', 'like', '%' . $request->searchCustomer . '%')
                          ->orWhere('lname', 'like', '%' . $request->searchCustomer . '%');
                }
                if($request->searchEmail != null) {
                    $query->Where('email', 'like', '%' . $request->searchEmail . '%');
                }
                if($request->searchContact != null) {
                    $query->Where('contact',  'like', '%' . $request->searchContact . '%');
                }
            })
            ->get();
    }
}
