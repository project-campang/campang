<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityType extends Model
{
    /**
     * Indicates if the model should be timestamped.
     * 타임스탬프 자동 관리 비활성화
     * 
     * @var bool
     */
    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        'type',
        'name',
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
