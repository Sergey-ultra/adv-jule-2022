<?php

namespace App\Models;

use Database\Factories\AdvFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'images'];

    protected $casts = [
        'images' => 'array'
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => json_decode($attributes['images'], true)[0] ?? null
        );
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AdvFactory::new();
    }
}
