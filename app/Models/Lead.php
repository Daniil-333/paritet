<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;

class Lead extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
        'created_at'
    ];

    public static function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required|integer'
        ];
    }

    public static function messages(): array
    {
        return [
            'required' => 'Поле :attribute обязательно к заполнению.',
            'integer' => 'Поле :attribute может содержать только цифры',
        ];
    }

    public static function attributeNames(): array
    {
        return [
            'name' => '"Ваше имя"',
            'phone' => '"Номер телефона"',
        ];
    }

}
