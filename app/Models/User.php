<?php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
class User extends Model implements AuthenticatableContract
{
use HasFactory;
use Authenticatable;
    protected $table = 'users';

    protected $fillable = [
        'userName',
        'email',
        'password',
        'emailVerify',
        'rememberToken'
    ];
}
