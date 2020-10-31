<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price',
    ];
    public function offer(){
        return $this->hasOne('App\Offer', 'product_name', 'name');
    }

}
