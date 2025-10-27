<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory,HasSlug;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'isActive',
    ];

    public function getSlugOptions(): SlugOptions
    {
       return SlugOptions::create()
           ->generateSlugsFrom('name')
           ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
      return 'slug';
    }

    public function articles(): HasMany{
        return $this->hasMany(Article::class, 'category_id','id')
            ->where('isActive',true);
    }
}
