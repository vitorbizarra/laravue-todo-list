<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rules\Password;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
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

    public function tasks()
    {
        return $this->hasMany(\App\Models\Task::class);
    }

    public function rules()
    {
        return [
            'first_name'             => ['required'],
            'last_name'              => ['required'],
            'email'                  => ['required', 'email', 'unique:users'],
            'password'               => ['required', Password::min(8)->letters()->numbers()->mixedCase()->symbols()],
            'password_confirmation'  => ['required', 'same:password'],
        ];
    }

    public function feedbacks()
    {
        return [
            'first_name' => ['required' => 'O nome é obrigatório.'],
            'last_name'  => ['required' => 'O sobrenome é obrigatório.'],
            'email' => [
                'required' => 'O email é obrigatório.',
                'email'    => 'Formato de email inválido.',
                'unique'   => 'O email informado já está sendo utilizado.'
            ],
            'password' => [
                'required'   => 'A senha é obrigatória.',
                'min'        => 'A senha deve ter ao menos 8 caracteres.',
                'letters'    => 'A senha deve ter ao menos uma letra.',
                'numbers'    => 'A senha deve ter ao menos um número.',
                'mixed_case' => 'A senha deve ter ao menos uma letra maiúscula e uma minúscula.',
                'symbols'    => 'A senha deve ter ao menos um caractere especial.',
            ],
            'password_confirmation' => [
                'required' => 'Confirme as senhas.',
                'same'     => 'As senhas não conferem.'
            ]
        ];
    }

    public function loginRules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
    }

    public function loginFeedbacks()
    {
        return [
            'email' => [
                'required' => 'O email é obrigatório.',
                'email' => 'O formato do email informado é inválido.'
            ],
            'password' => ['required' => 'A senha é obrigatória.']
        ];
    }
}
