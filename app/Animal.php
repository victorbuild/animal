<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Animal extends Model
{

    /**
     * 可以被批量賦值的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'name',
        'birthday',
        'area',
        'fix',
        'description',
        'personality',
    ];

    /**
     * 取得動物的分類
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    /**
     * 取得動物的刊登人
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * 多對多關聯animal與user
     */
    public function like()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * 計算年齡
     *
     * @param  string  $value
     * @return string
     */
    public function getAgeAttribute()
    {
        $diff = Carbon::now()->diff($this->birthday);
        return "{$diff->y}歲{$diff->m}月";
    }
}
