<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;



use App\Models\Category;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['name', 'price', 'category', 'image', 'images', 'discount', 'slug', 'short_desc', 'description', 'featured', 'status', 'stock'];

    /**
     * Get the product images path in json.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function images()
    {
        return new Attribute(
            [$this, 'getImages'],
            [$this, 'setImages']
        );
    }

    protected function getImages($value)
    {
        return json_decode($value, true);
    }

    protected function setImages($value)
    {
        return json_encode($value);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
