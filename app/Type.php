<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * 可以被批量賦值的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sort'
    ];
    /**
     * 取得類別的動物
     */
    public function animals()
    {
        return $this->hasMany('App\Animal', 'type_id', 'id');
    }
}
