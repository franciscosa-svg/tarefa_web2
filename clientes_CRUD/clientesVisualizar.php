<link rel="stylesheet" href="../style.css">
<?php
    $tabela = "cliente";
    $filtro = $_GET["filtro"] ?? "";
    include "../bd.php";

    $ordernar = [
        "parametro" => "id_cliente ASC"
    ];
    switch ($filtro) {
        case "":
            
            $dados = getDados($tabela, null, $ordernar);
            echo "
                <form class=\"formulario\" action=\"clientesVisualizar.php\" method=\"get\">
                    <label for=\"filtro\" class=\"caixa-saida\">Filtro</label>
                    <label for=\"entrada\" class=\"caixa-saida\">Entrada</label><br>

                    <select name=\"filtro\" id=\"lista\" class=\"lista-filtro\">
                        <option value=\"\">--Filtro--</option>
                        <option value=\"id_produto\">ID</option>
                        <option value=\"cpf\">CPF</option>
                    </select>
                    <input type=\"text\" name=\"valor\" class=\"caixa-entrada\" id=\"valor\" placeholder=\"filtro\">
                    <button class=\"butao\" type=\"submit\">Filtrar</button>
                </form>
                <a href=\"../index.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>";
            
            echo "
            <h1 class=\"cabecario\">Tabela de clientes</h1>

            <table class=\"tabela\">
                <thead>
                    <tr class=\"tabela-linha\">
                    <td class=\"caixa-valor valor-id\">ID</td>
                    <td class=\"caixa-valor valor-normal\">Nome Completo</td>
                    <td class=\"caixa-valor valor-normal\">CPF</td>
                    <td class=\"caixa-valor valor-normal\">Número da mesa</td>
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
                echo "  <td class=\"caixa-valor\"><a href=\"clienteAtualizar.php?id=".$dado["id_cliente"]."\"><button class=\"butao botao-editar\" type=\"button\">Editar</button></a></td>";
                echo "  <td class=\"caixa-valor\"><a href=\"clienteDeletar.php?id=".$dado["id_cliente"]."\"><button class=\"butao botao-excluir\" type=\"button\">Deletar</button></a></td>
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
                $dados = getDados($tabela, $filtragem, $ordernar);
            }
            else{
                $dados = getDados($tabela, null, $ordernar);
            }
            
            echo "
                <form class=\"formulario\" action=\"clientesVisualizar.php\" method=\"get\">
                    <label for=\"filtro\" class=\"caixa-saida\">Filtro</label>
                    <label for=\"entrada\" class=\"caixa-saida\">Entrada</label><br>

                    <select name=\"filtro\" id=\"lista\" class=\"lista-filtro\">
                        <option value=\"\">--Filtro--</option>
                        <option value=\"id_produto\">ID</option>
                        <option value=\"cpf\">CPF</option>
                    </select>
                    <input type=\"text\" name=\"valor\" class=\"caixa-entrada\" id=\"valor\" placeholder=\"filtro\">
                    <button class=\"butao\" type=\"submit\">Filtrar</button>
                </form>
                <a href=\"../index.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>";
            
            echo "
            <h1 class=\"cabecario\">Tabela de clientes</h1>

            <table class=\"tabela\">
                <thead>
                    <tr class=\"tabela-linha\">
                    <td class=\"caixa-valor valor-id\">ID</td>
                    <td class=\"caixa-valor valor-normal\">Nome Completo</td>
                    <td class=\"caixa-valor valor-normal\">CPF</td>
                    <td class=\"caixa-valor valor-normal\">Número da mesa</td>
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
                echo "  <td class=\"caixa-valor\"><a href=\"clienteAtualizar.php?id=".$dado["id_cliente"]."\"><button class=\"butao botao-editar\" type=\"button\">Editar</button></a></td>";
                echo "  <td class=\"caixa-valor\"><a href=\"clienteDeletar.php?id=".$dado["id_cliente"]."\"><button class=\"butao botao-excluir\" type=\"button\">Deletar</button></a></td>
                    </tr>  ";
            }
            echo "</tbody>";
            break;
    }
?>
