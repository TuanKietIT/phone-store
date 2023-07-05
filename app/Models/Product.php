<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'price',
        'number',
        'description',
        'status',
        'choose',
        'description',
        'image1',
        'image2',
        'image3',
        'image4',
        'user_id',
        'category_id',
        'location_id',
        'color',
        'capacity',
        'accessory_id',
        'phone_id',
        'laptop_id'
    ];
    public function accessory(){
        return $this->belongsTo(Accessory::class,'accessory_id');
    }
    public function phone(){
        return $this->belongsTo(Phone::class,'phone_id');
    }
    public function laptop(){
        return $this->belongsTo(Laptop::class,'laptop_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function location(){
        return $this->belongsTo(Location::class,'location_id');
    }
}
