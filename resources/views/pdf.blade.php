<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatorio de itens</title>
</head>

<body>
    <H1>Itens cadastrados</H1>
    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #adb5bd">
                <th style="border: 1px solid #ccc">Código</th>
                <th style="border: 1px solid #ccc">Nome</th>
                <th style="border: 1px solid #ccc">Descrição</th>
                <th style="border: 1px solid #ccc">Categoria</th>
                <th style="border: 1px solid #ccc">Preço</th>
                <th style="border: 1px solid #ccc">Quantidade de Unidades</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($itens as $item)
            <tr>
            <td style="border: 1px solid #aeadad; border-top: none">{{$item->codigo}}</td>
            <td style="border: 1px solid #aeadad; border-top: none">{{$item->nome}}</td>
            <td style="border: 1px solid #aeadad; border-top: none">{{$item->descricao}}</td>
            <td style="border: 1px solid #aeadad; border-top: none">{{$item->categoria}}</td>
            <td style="border: 1px solid #aeadad; border-top: none">{{$item->preco}}</td>
            <td style="border: 1px solid #aeadad; border-top: none">{{$item->qtdunitaria}}</td>
            </tr>

            @empty
            <td colspan="4">Nenhum item cadastrado</td>
            @endforelse
        </tbody>
</body>

</html>
