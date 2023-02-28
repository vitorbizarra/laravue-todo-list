<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static function rules()
    {
        return [
            'name'                   => ['required'],
            'email'                  => ['required', 'email'],
            'password'               => ['required', 'min:3'],
            'password_confirmation'  => ['same:password'],
        ];
    }

    public static function feedbacks()
    {
        return [
            'name'  => ['required' => 'O nome é obrigatório'],
            'email' => [
                'required' => 'O email é obrigatório',
                'email'    => 'Formato de email inválido'
            ],
            'password' => [
                'required' => 'A senha é obrigatória',
                'min'      => 'A senha deve ter no mínimo 3 caracteres'
            ],
            'password_confirmation' => [
                'same' => 'As senhas não conferem'
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
