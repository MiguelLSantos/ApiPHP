<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatorio de itens</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <figure>
        <blockquote class="blockquote">
            <h1>Relatorio de itens</h1>
        </blockquote>
        <figcaption class="blockquote-footer">
            Total de {{ count($itens) }} itens cadastrados
        </figcaption>
    </figure>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="row">Código</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Quantidade de Unidades</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($itens as $item)
                <tr>
                    <td>{{ $item->codigo }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->categoria }}</td>
                    <td>{{ $item->preco }}</td>
                    <td>{{ $item->qtdunitaria }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhum item cadastrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
