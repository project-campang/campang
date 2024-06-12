<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityType extends Model
{
    public $timestamps = false; // 시간 필드를 사용하지 않음.

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'name',
    ];

    // guarded 블랙리스트
    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

        /**
     * 
     */

    //  protected function serializeDate(\DateTimeInterface $date)
    //  {
    //      return $date->format('Y-m-d H:i:s');
    //  }

    // public function users() {
    //     return $this->belongsTo(User::class);
    // }
}
