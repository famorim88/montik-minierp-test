<?
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class OrderController extends Controller
{
    public function cart()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $freight = $subtotal > 200 ? 0 : ($subtotal >= 52 && $subtotal <= 166.59 ? 15 : 20);
        return view('orders.cart', compact('cart', 'subtotal', 'freight'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session('cart', []);
        $cart[] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
        ];
        session(['cart' => $cart]);
        return redirect()->route('cart');
    }

    public function checkout()
    {
        return view('orders.checkout');
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $freight = $subtotal > 200 ? 0 : ($subtotal >= 52 && $subtotal <= 166.59 ? 15 : 20);
        $coupon = Coupon::where('code', $request->coupon)->where('expires_at', '>=', now())->first();

        if ($coupon && $subtotal >= $coupon->min_cart_value) {
            $subtotal -= $coupon->discount;
        }

        $order = Order::create([
            'items' => json_encode($cart),
            'subtotal' => $subtotal,
            'freight' => $freight,
            'total' => $subtotal + $freight,
            'cep' => $request->cep,
            'address' => $request->address,
            'status' => 'confirmed',
        ]);

        Mail::to($request->email)->send(new OrderConfirmation($order));

        session()->forget('cart');

        return redirect('/')->with('success', 'Pedido realizado com sucesso!');
    }
}