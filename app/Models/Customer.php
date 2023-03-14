<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
class Customer extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * @var array
     */
    protected $fillable = [
        'customerName',
        'email',
        'password',
        'emailVerify',
        'rememberToken'
    ];
}
