<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status'
    ];

    protected function status(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ['todo', 'doing', 'done'][$value],
            set: fn ($value) => array_search($value, ['todo', 'doing', 'done'])
        );
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function rules()
    {
        return [
            'title'       => ['required', 'max:80'],
            'description' => ['max:255'],
        ];
    }

    public function feedbacks()
    {
        return [
            'title'       => [
                'required' => 'O título da tarefa é obrigatório.',
                'max'      => 'O título da tarefa deve ter no máximo :max caracteres.'
            ],
            'description' => ['max' => 'A descrição da tarefa deve ter no máximo :max caracteres.'],
        ];
    }

    /**
     * Retorna apenas as regras de validação dos campos recebidos no request
     * 
     * @param array $request_fields
     * @return array
     */
    public function getRulesForPatchUpdate(array $request_fields)
    {
        $rules = $this->rules();

        foreach ($rules as $field => $field_rules) {
            if (!in_array($field, $request_fields)) {
                unset($rules[$field]);
            }
        }

        return $rules;
    }
    
    /**
     * Retorna apenas os feedbacks das regras de validação dos campos recebidos no request
     * 
     * @param array $request_fields
     * @return array
     */
    public function getFeedbacksForPatchUpdate(array $request_fields)
    {
        $feedbacks = $this->feedbacks();

        foreach ($feedbacks as $field => $rules_feedbacks) {
            if (!in_array($field, $request_fields)) {
                unset($feedbacks[$field]);
            }
        }

        return $feedbacks;
    }
}
