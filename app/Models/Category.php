<?php

namespace App\Models;

use App\Models\Field;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\CategoryField;
use App\Models\MembershipPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = ['title', 'slug', 'meta_title', 'meta_keyword', 'meta_description', 'image', 'is_active'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->title);
            $category->meta_title = $category->title . ' - Buy & Sell | Mr.Ads.lk';
            $category->meta_keyword = implode(', ', explode(' ', strtolower($category->title)));
            $category->meta_description = 'Discover various ' . strtolower($category->title) . ' available for sale on Mr.Ads.lk. Find the best deals now!';
        });
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function membershipPlans()
    {
        return $this->hasMany(MembershipPlan::class, 'category_id');
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class, 'category_field', 'category_id', 'field_id');
    }

    public function categoryFields()
    {
        return $this->hasMany(CategoryField::class, 'category_id');
    }
}
