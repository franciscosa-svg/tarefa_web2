<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";

    $tabela = "cliente";
    $opcao = $_GET["resposta"] ?? "";
    $id = intval($_GET["id"] ?? "0");
    
    switch ($opcao) {
        case "sim":

            $filtro = [
                "parametro" => "id_cliente",
                "valor" => $id
            ];
            try {
                $valor = deleteValor($tabela, $filtro);
                if($valor){
                    echo "<h1 class=\"sucesso\">Retornando para a pagina de visualizar, produto deletado com sucesso</h1>";
                }
                else{
                    echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";
                }
                               
            } catch (Throwable $th) {
                echo "<h1 class=\"erro\">Retornando a pagina de edição, falha na deleção</h1>";
            }
                
            echo "<meta http-equiv=\"refresh\" content=\"5;url=clientesVisualizar.php\">"; 
            exit;
        case "nao":
            echo "<h1 class=\"sucesso\">Retornando para a pagina de visualizar</h1>";
                
            echo "<meta http-equiv=\"refresh\" content=\"5;url=clientesVisualizar.php\">"; 
            exit;
        default:
            echo "
            <div class=\"menu-deletar\">
                <h1 class=\"menu-deletar-titulo\">Deseja deletar esse cliente?</h1>
                <a href=\"clienteDeletar.php?resposta=sim&id={$id}\"><button class=\"botao botao-deletar deletar-confirmar\" method=\"get\">Sim</button></a>
                <a href=\"clienteDeletar.php?resposta=nao\"><button class=\"botao botao-deletar deletar-confirmar\" method=\"get\">Não</button></a>
            </div>
            ";
            break;
    }

?>