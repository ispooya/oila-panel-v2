<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'shortContent',
        'image',
        'time'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $appends = array('ShamsiDate');

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,);
    }

    public function getShamsiDateAttribute()
    {
        $v = new verta($this->created_at);
        return ($v->format('Y/n/j - H:i:s'));
    }
}
