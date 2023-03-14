<?php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
class User extends Model implements AuthenticatableContract
{
use HasFactory;
use Authenticatable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'userName',
        'email',
        'password',
        'emailVerify',
        'rememberToken'
    ];
}
