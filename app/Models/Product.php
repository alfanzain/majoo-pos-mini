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
        'price',
        'category_id',
    ];

    protected $appends = [
        'category_name',
        'price_text'
    ];

    protected $with = [
        'category'
    ];

    protected function getPriceTextAttribute()
    {
        if (null !== $this->price)
            return number_format($this->price , 0 , '.' , ',' );
        else
            return '-';
    }

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
