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
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    protected $appends = [
        'category_name'
    ];

    protected $with = [
        'category'
    ];

    protected function getCategoryNameAttribute()
    {
        if (null !== $this->category)
            return $this->category->name;
        else
            return '-';
    }

    /**
     * Get the category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
