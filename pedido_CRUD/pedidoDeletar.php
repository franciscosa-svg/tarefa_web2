<link rel="stylesheet" href="../style.css">

<?php
require_once "../bd.php";

$id_pedido = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$resposta = $_GET["resposta"] ?? "";

if (!$id_pedido) {
    echo '<h1 class="erro">ID de pedido inválido.</h1>';
    echo '<a href="pedidosVisualizar.php">Voltar</a>';
    exit;
}

$conn = getConnection();

if (!$conn) {
    exit("Erro ao conectar ao banco de dados.");
}

if ($resposta === "sim") {
    try {
        $conn->beginTransaction();

        $stmt = $conn->prepare(
            "DELETE FROM produto_pedido
             WHERE id_pedido = :id"
        );
        $stmt->execute(["id" => $id_pedido]);

        $stmt = $conn->prepare(
            "DELETE FROM pedido
             WHERE id_pedido = :id"
        );
        $stmt->execute(["id" => $id_pedido]);

        if ($stmt->rowCount() === 0) {
            throw new Exception("Pedido não encontrado.");
        }

        $conn->commit();

        echo '<h1 class="sucesso">
                Pedido excluído com sucesso!
              </h1>';

    } catch (Throwable $e) {
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }

        echo '<h1 class="erro">'
            . htmlspecialchars($e->getMessage(), ENT_QUOTES, "UTF-8")
            . '</h1>';
    }

    echo '<a href="pedidosVisualizar.php">
            <button class="botao" type="button">
                Voltar aos pedidos
            </button>
          </a>';

    exit;
}

if ($resposta === "nao") {
    header("Location: pedidosVisualizar.php");
    exit;
}

$stmt = $conn->prepare(
    "SELECT id_pedido FROM pedido
     WHERE id_pedido = :id"
);
$stmt->execute(["id" => $id_pedido]);

if (!$stmt->fetch()) {
    echo '<h1 class="erro">Pedido não encontrado.</h1>';
    echo '<a href="pedidosVisualizar.php">Voltar</a>';
    exit;
}
?>

<div class="menu-deletar">

    <h1 class="menu-deletar-titulo">
        Deseja excluir o pedido #<?= (int)$id_pedido ?>?
    </h1>

    <a href="pedidoDeletar.php?resposta=sim&id=<?= (int)$id_pedido ?>">
        <button class="botao" type="button">Sim</button>
    </a>

    <a href="pedidoDeletar.php?resposta=nao&id=<?= (int)$id_pedido ?>">
        <button class="botao" type="button">Não</button>
    </a>

</div>