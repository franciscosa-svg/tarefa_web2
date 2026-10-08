<link rel="stylesheet" href="../style.css">
<?php
    $tabela = "produto";
    $filtro = $_GET["filtro"] ?? "";
    include "../bd.php";
    switch ($filtro) {
        case "":
            
            $dados = getDados($tabela, null);
            echo "
                <form class=\"formulario\" action=\"produtosVisualizar.php\" method=\"get\">
                    <label for=\"filtro\" class=\"caixa-saida\">Filtro</label>
                    <label for=\"entrada\" class=\"caixa-saida\">Entrada</label><br>

                    <select name=\"filtro\" id=\"lista\" class=\"lista-filtro\">
                        <option value=\"\">--Filtro--</option>
                        <option value=\"id_produto\">ID</option>
                    </select>
                    <input type=\"text\" name=\"valor\" class=\"caixa-entrada\" id=\"valor\" placeholder=\"filtro\">
                    <button class=\"butao\" type=\"submit\">Filtrar</button>
                </form>
                <a href=\"../index.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>";
            
            echo "
            <h1 class=\"cabecario\">Tabela de produtos</h1>

            <table class=\"tabela\">
                <thead>
                    <tr class=\"tabela-linha\">
                    <td class=\"caixa-valor valor-id\">ID</td>
                    <td class=\"caixa-valor valor-normal\">Nome</td>
                    <td class=\"caixa-valor valor-normal\">Sabor</td>
                    <td class=\"caixa-valor valor-normal\">Editar</td>
                    <td class=\"caixa-valor valor-normal\">Excluir</td>
                    </tr>
                </thead>
                <tbody>
                ";
            foreach ($dados as $dado) {
                echo "<tr class=\"tabela-linha\">";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["id_produto"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["nome"]."</td>";
                echo "  <td class=\"caixa-valor valor-saida\">".$dado["sabor"]."</td>";
                echo "  <td class=\"caixa-valor\"><a href=\"produtoAtualizar.php?id=".$dado["id_produto"]."\"><button class=\"butao botao-editar\" type=\"button\">Editar</button></a></td>";
                echo "  <td class=\"caixa-valor\"><a href=\"produtoDeletar.php?id=".$dado["id_produto"]."\"><button class=\"butao botao-excluir\" type=\"button\">Deletar</button></a></td>
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
                $dados = getDados($tabela, $filtragem);
            }
            else{
                $dados = getDados($tabela, null);
            }
            
            echo "
                <form class=\"formulario\" action=\"produtosVisualizar.php\" method=\"get\">
                    <label for=\"filtro\" class=\"caixa-saida\">Filtro</label>
                    <label for=\"entrada\" class=\"caixa-saida\">Entrada</label><br>

                    <select name=\"filtro\" id=\"lista\" class=\"lista-filtro\">
                        <option value=\"\">--Filtro--</option>
                        <option value=\"id_produto\">ID</option>
                    </select>
                    <input type=\"text\" name=\"valor\" class=\"caixa-entrada\" id=\"valor\" placeholder=\"filtro\">
                    <button class=\"butao\" type=\"submit\">Filtrar</button>
                </form>
                <a href=\"../index.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>";
            
            echo "
            <h1 class=\"cabecario\">Tabela de produtos</h1>

            <table>
                <thead>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Sabor</td>
                    <td>Editar</td>
                    <td>Exlcuir</td>
                </thead>
                ";
            foreach ($dados as $dado) {
                echo "<tbody>";
                echo "  <td>".$dado["id_produto"]."</td>";
                echo "  <td>".$dado["nome"]."</td>";
                echo "  <td>".$dado["sabor"]."</td>";
                echo "  <td><a href=\"produtoAtualizar.php?id=".$dado["id_produto"]."\"><button class=\"butao butao-editar\" type=\"button\">Editar</button></a></td>";
                echo "  <td><a href=\"produtoDeletar.php?id=".$dado["id_produto"]."\"><button class=\"butao butao-editar\" type=\"button\">Deleta</button></a></td>
                      </tbody>";
            }
            break;
    }
?>
