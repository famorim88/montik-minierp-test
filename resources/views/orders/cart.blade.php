@extends('layouts.app')

@section('content')
<h2>Carrinho</h2>
<table class="table">
    <thead>
        <tr><th>Produto</th><th>Preço</th><th>Quantidade</th></tr>
    </thead>
    <tbody>
        @foreach($cart as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
            <td>{{ $item['quantity'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p>Subtotal: R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
<p>Frete: R$ {{ number_format($freight, 2, ',', '.') }}</p>
<a href="{{ route('checkout') }}" class="btn btn-success">Finalizar Pedido</a>
@endsection