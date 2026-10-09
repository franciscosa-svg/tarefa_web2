<link rel="stylesheet" href="style.css">
<?php
include "bd.php";

$escolha = $_GET["escolha"] ?? "";

switch ($escolha) {
    case "cadastro":
        $clientes = getDados("cliente", null, [
            "parametro" => "nome_completo ASC"
        ]);

        $produtos = getDados("produto", null, [
            "parametro" => "nome ASC"
        ]);

        echo '<h1 class="cabecario-cadastro">Cadastro de pedido</h1>';

        echo '<form class="formulario"
                    action="pedido_CRUD/pedidoCadastro.php"
                    method="post">';

        echo '<label class="caixa-saida" for="id_cliente">
                Cliente
              </label>';

        echo '<select class="caixa-entrada"
                      name="id_cliente"
                      id="id_cliente"
                      required>';

        echo '<option value="">Selecione um cliente</option>';

        foreach ($clientes as $cliente) {
            $id = (int) $cliente["id_cliente"];
            $nome = htmlspecialchars(
                $cliente["nome_completo"],
                ENT_QUOTES,
                "UTF-8"
            );

            echo "<option value=\"$id\">$nome</option>";
        }

        echo '</select><br>';

        echo '<label class="caixa-saida" for="produtos">
                Produtos
              </label>';

        echo '<select class="caixa-entrada"
                      name="produtos[]"
                      id="produtos"
                      multiple
                      required>';

        foreach ($produtos as $produto) {
            $id = (int) $produto["id_produto"];

            $nome = htmlspecialchars(
                $produto["nome"],
                ENT_QUOTES,
                "UTF-8"
            );

            $sabor = htmlspecialchars(
                $produto["sabor"],
                ENT_QUOTES,
                "UTF-8"
            );

            echo "<option value=\"$id\">$nome - $sabor</option>";
        }

        echo '</select>';

        echo '<p>Segure Ctrl para selecionar vários produtos.</p>';

        echo '<button class="botao" type="submit">
                Cadastrar pedido
              </button>';

        echo '<a href="index.php">
                <button class="botao" type="button">Voltar</button>
              </a>';

        echo '</form>';
        break;

    case "mostrar":
        header("Location: pedido_CRUD/pedidosVisualizar.php");
        exit;

    default:
        echo '<h1 class="erro">Tipo de formulário inválido</h1>';
        echo '<a href="index.php">Voltar ao menu</a>';
        break;
}
?>