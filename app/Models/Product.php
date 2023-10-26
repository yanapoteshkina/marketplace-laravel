<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'like',
        'dislike',
        'count',
        'img',
        'category',
    ];

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }


}
