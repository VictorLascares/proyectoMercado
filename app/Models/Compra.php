<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad','pago','ticket','calificacion','estado','mercado','ganancia','user_id', 'vendedor', 'product_id'];

    public function scopeSearch($query,$product_id){
        return $query->where('product_id',$product_id);
    }
    public function scopeSearchu($query,$user_id){
        return $query->where('user_id',$user_id);
    }

    public function scopePago($query){
        return $query->whereNotIn('pago',['false']);
    }
    public function scopeNopago($query){
        return $query->where('pago',['false']);
    }
    public function scopeComprado($query){
        return $query->where('estado','Comprado');
    }
}
