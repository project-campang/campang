<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'main_img',
        'other_img2',
        'other_img3',
        'other_img4',
        'other_img5',
        'views',
        'created_at',
        'updated_at',
    ];

        /**
     * 
     */

     protected function serializeDate(\DateTimeInterface $date)
     {
         return $date->format('Y-m-d H:i:s');
     }

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
