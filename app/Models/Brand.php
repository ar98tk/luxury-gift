<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Brand extends Model
{
    protected $fillable = ['name_en', 'name_ar'];
    use HasFactory, HasSlug;
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_en')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(190);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
