<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'attribute_id',
        'value'
    ];
    public function Attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    } 
}
