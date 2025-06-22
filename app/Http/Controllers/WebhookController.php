<?
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $order = Order::find($request->id);
        if (!$order) return response('Not Found', 404);

        if ($request->status === 'cancelled') {
            $order->delete();
        } else {
            $order->update(['status' => $request->status]);
        }

        return response('OK', 200);
    }
}
