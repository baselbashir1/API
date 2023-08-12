<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Technical extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'technicians';
    protected $guard = 'technical';
    protected $fillable = ['name', 'email', 'password'];
}
