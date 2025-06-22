@extends('layouts.app')

@section('content')
<h2>Cadastro de Produtos</h2>
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Preço</label>
        <input type="number" name="price" class="form-control" step="0.01" required>
    </div>
    <div id="variations">
        <div class="variation mb-3">
            <input type="text" name="variations[0][name]" class="form-control mb-1" placeholder="Variação">
            <input type="number" name="variations[0][quantity]" class="form-control" placeholder="Quantidade">
        </div>
    </div>
    <button type="button" id="add-variation" class="btn btn-secondary">Adicionar Variação</button>
    <button type="submit" class="btn btn-primary">Salvar Produto</button>
</form>

<h3 class="mt-5">Produtos Cadastrados</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>Nome</th><th>Preço</th><th>Variações</th></tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
            <td>
                <ul>
                    @foreach($product->stocks as $stock)
                        <li>{{ $stock->variation }} - {{ $stock->quantity }} unidades</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
    let variationIndex = 1;
    $('#add-variation').click(function () {
        const html = `<div class="variation mb-3">
            <input type="text" name="variations[${variationIndex}][name]" class="form-control mb-1" placeholder="Variação">
            <input type="number" name="variations[${variationIndex}][quantity]" class="form-control" placeholder="Quantidade">
        </div>`;
        $('#variations').append(html);
        variationIndex++;
    });
</script>
@endsection