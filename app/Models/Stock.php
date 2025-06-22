<?
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['product_id', 'variation', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}