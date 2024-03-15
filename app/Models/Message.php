<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'email',
        'phone',
        'status',
        'message'
    ];

    public function Created_at()
    {
        $v = new verta($this->created_at);
        return ($v->format('H:i:s - Y/n/j'));
    }
}
