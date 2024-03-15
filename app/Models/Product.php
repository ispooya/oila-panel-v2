<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'img',
        'ingredients',
        'description',
        'category_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function uses()
    {
        return $this->belongsToMany(ProductUses::class,'product_uses_rels','product_id','uses_id');
    }

    public function fpps()
    {
        return $this->belongsToMany(Fpp::class,'product_fpps','product_id');
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_products','product_id');
    }

}
