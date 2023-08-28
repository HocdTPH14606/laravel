<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' 
    ];
    // 1 attribute thuộc nhiều attributeValue
    public function attributeValue(){
        return $this->hasMany(attributeValue::class, 'attribute_id', 'id');
    } 
}
