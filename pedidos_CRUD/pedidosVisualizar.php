<link rel="stylesheet" href="../style.css">
<?php

    $filtro = $_GET["filtro"] ?? "";
    include "../bd.php";
    $sqlBruto = "SELECT c.id_cliente as id_cliente, c.nome_completo as nome_completo, c.cpf as cpf, c.n_mesa as n_mesa, 
                    pe.id_pedido as id_pedido,  
                    pr.id_produto as id_produto, pr.nome as nome, pr.sabor as sabor,
                    pp.quantidade as quantidade
                from cliente as c,
                    pedido as pe,
                    produto as pr,
                    produto_pedido as pp
                where pe.id_cliente = c.id_cliente and
                        pe.id_pedido = pp.id_pedido and
                        pr.id_produto = pp.id_produto
    
    ";  

    $dados = bruteSqlSelect($sqlBruto);

    switch ($filtro) {
        case "":
            
            
            echo "
                <form class=\"formulario formulario-filtro\" action=\"pedidosVisualizar.php\" method=\"get\">
                    <label for=\"entrada\" class=\"caixa-saida-filtro\">Lista de filtro</label>
                    <label for=\"filtro\" class=\"caixa-saida-filtro\">Entrada</label>

                    <select name=\"filtro\" id=\"lista\" class=\"lista-filtro\">
                        <option value=\"\">--Filtro--</option>
                        <option value=\"pr.id_produto\">ID do Produto</option>
                        <option value=\"pe.id_pedido\">ID do pedido</option>
                        <option value=\"c.id_cliente\">ID do cliente</option>
                        <option value=\"c.cpf\">CPF</option>
                    </select>
                    <input type=\"text\" name=\"valor\" class=\"caixa-entrada-filtro\" id=\"valor\" placeholder=\"filtro\">
                    <button class=\"botao botao-filtro\" type=\"submit\">Filtrar</button>
                </form>
                <a href=\"../index.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>";
            
            echo "
            <h1 class=\"cabecario\">Tabela de clientes</h1>

            <table class=\"tabela\">
                <thead>
                    <tr class=\"tabela-linha\">
                    <td class=\"caixa-valor valor-normal\">ID do cliente</td>
                    <td class=\"caixa-valor valor-normal\">Nome Completo</td>
                    <td class=\"caixa-valor valor-normal\">CPF</td>
                    <td class=\"caixa-valor valor-normal\">Número da mesa</td>
                    <td class=\"caixa-valor valor-normal\">ID do pedido</td>
                    <td class=\"caixa-valor valor-normal\">ID do produto</td>
                    <td class=\"caixa-valor valor-normal\">Nome do produto</td>
                    <td class=\"caixa-valor valor-normal\">Sabor do produto</td>
                    <td class=\"caixa-valor valor-normal\">Quantidade</td>
                    <td class=\"caixa-valor valor-normal\">Editar</td>
                    <td class=\"caixa-valor valor-normal\">Excluir</td>
                    </tr>
                </thead>
                <tbody>
                ";
            foreach ($dados as $dado) {
                echo "<tr class=\"tabela-linha\">";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["id_cliente"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["nome_completo"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["cpf"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["n_mesa"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["id_pedido"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["id_produto"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["nome"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["sabor"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["quantidade"]."</td>";
                echo "  <td class=\"caixa-valor\"><a href=\"pedidoAtualizar.php?id=".$dado["id_pedido"]."\"><button class=\"butao botao-editar\" type=\"button\">Editar</button></a></td>";
                echo "  <td class=\"caixa-valor\"><a href=\"pedidoDeletar.php?id=".$dado["id_pedido"]."\"><button class=\"butao botao-excluir\" type=\"button\">Deletar</button></a></td>
                    </tr>  ";
            }
            echo "</tbody>";


            echo "
            </table>";
            
            break;
        default:
            $filtragem = [
                "parametro" => $filtro,
                "valor" => $_GET["valor"] ?? ""
            ];
            
            $dados = Array();

            if($filtragem["valor"] != "" ){
                $sqlBruto = "SELECT c.id_cliente as id_cliente, c.nome_completo as nome_completo, c.cpf as cpf, c.n_mesa as n_mesa, 
                    pe.id_pedido as id_pedido,  
                    pr.id_produto as id_produto, pr.nome as nome, pr.sabor as sabor,
                    pp.quantidade as quantidade
                from cliente as c,
                    pedido as pe,
                    produto as pr,
                    produto_pedido as pp
                where pe.id_cliente = c.id_cliente and
                        pe.id_pedido = pp.id_pedido and
                        pr.id_produto = pp.id_produto and
                        {$filtragem["parametro"]}={$filtragem["valor"]}
                ";  
                $dados = bruteSqlSelect($sqlBruto);
            }
            else{
                $sqlBruto = "SELECT c.id_cliente as id_cliente, c.nome_completo as nome_completo, c.cpf as cpf, c.n_mesa as n_mesa, 
                                pe.id_pedido as id_pedido,  
                                pr.id_produto as id_produto, pr.nome as nome, pr.sabor as sabor,
                                pp.quantidade as quantidade
                            from cliente as c,
                                pedido as pe,
                                produto as pr,
                                produto_pedido as pp
                            where pe.id_cliente = c.id_cliente and
                                    pe.id_pedido = pp.id_pedido and
                                    pr.id_produto = pp.id_produto
                ";
                $dados = bruteSqlSelect($sqlBruto);  
            }
            
            echo "
                <form class=\"formulario formulario-filtro\" action=\"pedidosVisualizar.php\" method=\"get\">
                    <label for=\"entrada\" class=\"caixa-saida-filtro\">Lista de filtro</label>
                    <label for=\"filtro\" class=\"caixa-saida-filtro\">Entrada</label>

                    <select name=\"filtro\" id=\"lista\" class=\"lista-filtro\">
                        <option value=\"\">--Filtro--</option>
                        <option value=\"pr.id_produto\">ID do Produto</option>
                        <option value=\"pe.id_pedido\">ID do pedido</option>
                        <option value=\"c.id_cliente\">ID do cliente</option>
                        <option value=\"c.cpf\">CPF</option>
                    </select>
                    <input type=\"text\" name=\"valor\" class=\"caixa-entrada-filtro\" id=\"valor\" placeholder=\"filtro\">
                    <button class=\"botao botao-filtro\" type=\"submit\">Filtrar</button>
                </form>
                <a href=\"../index.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>";
                
            echo "
            <h1 class=\"cabecario\">Tabela dos pedidos</h1>

            <table class=\"tabela\">
                <thead>
                    <tr class=\"tabela-linha\">
                    <td class=\"caixa-valor valor-normal\">ID do cliente</td>
                    <td class=\"caixa-valor valor-normal\">Nome Completo</td>
                    <td class=\"caixa-valor valor-normal\">CPF</td>
                    <td class=\"caixa-valor valor-normal\">Número da mesa</td>
                    <td class=\"caixa-valor valor-normal\">ID do pedido</td>
                    <td class=\"caixa-valor valor-normal\">ID do produto</td>
                    <td class=\"caixa-valor valor-normal\">Nome do produto</td>
                    <td class=\"caixa-valor valor-normal\">Sabor do produto</td>
                    <td class=\"caixa-valor valor-normal\">Quantidade</td>
                    <td class=\"caixa-valor valor-normal\">Editar</td>
                    <td class=\"caixa-valor valor-normal\">Excluir</td>
                    </tr>
                </thead>
                <tbody>
                ";
            foreach ($dados as $dado) {
                echo "<tr class=\"tabela-linha\">";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["id_cliente"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["nome_completo"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["cpf"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["n_mesa"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["id_pedido"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["id_produto"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["nome"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["sabor"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["quantidade"]."</td>";
                echo "  <td class=\"caixa-valor\"><a href=\"pedidoAtualizar.php?id=".$dado["id_pedido"]."\"><button class=\"butao botao-editar\" type=\"button\">Editar</button></a></td>";
                echo "  <td class=\"caixa-valor\"><a href=\"pedidoDeletar.php?id=".$dado["id_pedido"]."\"><button class=\"butao botao-excluir\" type=\"button\">Deletar</button></a></td>
                    </tr>  ";
            }
            echo "</tbody>";


            echo "
            </table>";
            break;
    }
?>
