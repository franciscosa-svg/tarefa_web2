<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";

    $opcao = $_GET["resposta"] ?? "";
    $id = intval($_GET["id"] ?? "0");
    
    switch ($opcao) {
        case "sim":

            $filtro = [
                "parametro" => "id_pedido",
                "valor" => $id
            ];
            try {
                $valor = deleteValor("produto_pedido", $filtro) && deleteValor("pedido", $filtro);
                if($valor){
                    echo "<h1 class=\"sucesso\">Retornando para a pagina de visualizar, produto deletado com sucesso</h1>";
                }
                else{
                    echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";
                }
                               
            } catch (Throwable $th) {
                echo "<h1 class=\"erro\">Retornando a pagina de edição, falha na deleção</h1>";
            }
                
            echo "<meta http-equiv=\"refresh\" content=\"5;url=pedidosVisualizar.php\">"; 
            exit;
        case "nao":
            echo "<h1 class=\"sucesso\">Retornando para a pagina de visualizar</h1>";
                
            echo "<meta http-equiv=\"refresh\" content=\"5;url=pedidosVisualizar.php\">"; 
            exit;
        default:
            echo "
            <div class=\"menu-deletar\">
                <h1 class=\"menu-deletar-titulo\">Deseja deletar esse cliente?</h1><br>
                <div class=\"botoes-deletar\">
                    <a class=\"link-deletar-negar\" href=\"pedidoDeletar.php?resposta=nao\"><button class=\"botao botao-deletar deletar-negar\" method=\"get\">Não</button></a>
                    <a class=\"link-deletar-confirmar\" href=\"pedidoDeletar.php?resposta=sim&id={$id}\"><button class=\"botao botao-deletar deletar-confirmar\" method=\"get\">Sim</button></a>
                </div>
            </div>
            ";
            break;
    }

?>