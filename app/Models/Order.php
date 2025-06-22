<?
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'items',
        'subtotal',
        'freight',
        'total',
        'status',
        'cep',
        'address',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
