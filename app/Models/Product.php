<?php
  
namespace App\Models;
   
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
  
class Product extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'name', 'price', 'description', 'image'
    ];
    public function orderItem(){
        return $this->belongsTo(OrderItem::class);
    }
}
