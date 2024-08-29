<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Articale extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'text',
        'auther',
        'slug'
    ];


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}
