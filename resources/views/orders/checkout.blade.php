@extends('layouts.app')

@section('content')
<h2>Checkout</h2>
<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>CEP</label>
        <input type="text" id="cep" name="cep" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Endereço</label>
        <input type="text" id="address" name="address" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>E-mail</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Cupom</label>
        <input type="text" name="coupon" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Confirmar Pedido</button>
</form>
@endsection

@section('scripts')
<script>
    $('#cep').on('blur', function () {
        let cep = $(this).val().replace(/\D/g, '');
        $.get(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
            $('#address').val(`${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`);
        });
    });
</script>
@endsection