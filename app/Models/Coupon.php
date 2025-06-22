<?
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'discount', 'min_cart_value', 'expires_at'
    ];

    protected $dates = ['expires_at'];
}