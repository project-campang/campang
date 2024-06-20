<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampSiteType extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     * 타임스탬프 자동 관리 비활성화
     * 
     * @var bool
     */
    public $timestamps = false;
}
