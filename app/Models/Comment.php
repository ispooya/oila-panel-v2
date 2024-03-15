<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable =[
        'post_id',
        'name',
        'email',
        'comment',
        'status',
    ];

    public function getStatus()
    {
        switch ($this->status) {
            case 0:
                return 'در انتظار تایید';
                break;
            case 1:
                return 'پذیرفته شده';
                break;
            case 2:
                return 'رد شده';
                break;
        }
    }

    public function Created_at()
    {
        $v = new verta($this->created_at);
        return ($v->format('H:i:s - Y/n/j'));
    }


    public function Updated_at()
    {
        $v = new verta($this->updated_at);
        return ($v->format('H:i:s - Y/n/j'));
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
