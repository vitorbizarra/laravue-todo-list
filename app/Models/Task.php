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
}
