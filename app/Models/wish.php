<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wish extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'camp_id',
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

}
