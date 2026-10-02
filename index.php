<?php
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzaria do Bitela</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
    <h1>Pizzaria do Bitela!</h1>
    <h2>Faça seu cadastro e seu pedido</h2>
    <p>Opções de acesso:</p>

    <div class="Sub-div">
        <a class="Botoes" href="cliente.php?escolha=cadastro"><button type="button">Cadastro do Cliente</button></a>
        <a class="Botoes" href="pedido.php?escolha=cadastro"><button type="button">Cadastro do Pedido</button></a>
        <a class="Botoes" href="produto.php?escolha=cadastro"><button type="button">Cadastro do Produto</button></a>
    </div>
    <div class="Sub-div">
        <a class="Botoes" href="cliente.php?escolha=mostrar"><button type="button">Mostrar Clientes</button></a>
        <a class="Botoes" href="pedido.php?escolha=mostrar"><button type="button">Mostrar Pedidos</button></a>
        <a class="Botoes" href="produto.php?escolha=mostrar"><button type="button">Mostrar Produtos</button></a>
    </div>
    </div>
</body>
</html>