<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzaria do Bitela</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="divisoria">
        <div id="titulo">
            <h1>A Pizzaria do Bitela</h1>
            <h2>Faça seu cadastro e seu pedido</h2>
        </div>
        <div id="entrada-menu">
            <p>Opções de acesso</p>

            <div class="sub-divisoria" id="cadastro">
                <a href="cliente.php?escolha=cadastro"><button class="botao" type="button" method="get">Cadastro do Cliente</button></a>
                <a href="pedido.php?escolha=cadastro"><button class="botao" type="button" method="get">Cadastro do Pedido</button></a>
                <a href="produto.php?escolha=cadastro"><button class="botao" type="button" method="get">Cadastro do Produto</button></a>
            </div>
            <div class="sub-divisoria" id="visualizar">
                <a href="cliente.php?escolha=mostrar"><button class="botao" type="button" method="get">Mostrar Clientes</button></a>
                <a href="pedido.php?escolha=mostrar"><button class="botao" type="button" method="get">Mostrar Pedidos</button></a>
                <a href="produto.php?escolha=mostrar"><button class="botao" type="button" method="get">Mostrar Produtos</button></a>
            </div>
        </div>
    </div>
</body>
</html>