<h2>Pedido Confirmado</h2>
<p>Obrigado por seu pedido. Resumo:</p>
<ul>
@foreach(json_decode($order->items) as $item)
    <li>{{ $item->name }} - Quantidade: {{ $item->quantity }}</li>
@endforeach
</ul>
<p>Total: R$ {{ number_format($order->total, 2, ',', '.') }}</p>