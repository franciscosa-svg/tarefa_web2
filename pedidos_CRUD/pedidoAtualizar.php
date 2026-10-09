<?php
require_once "../bd.php";

$id_pedido = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id_pedido) {
    header("Location: pedidosVisualizar.php");
    exit;
}

$conn = getConnection();

if (!$conn) {
    exit("Erro ao conectar ao banco de dados.");
}

try {
    $stmt = $conn->prepare(
        "SELECT * FROM pedido WHERE id_pedido = :id"
    );
    $stmt->execute(["id" => $id_pedido]);
    $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pedido) {
        exit("Pedido não encontrado.");
    }

    $stmt = $conn->query(
        "SELECT * FROM cliente ORDER BY nome_completo ASC"
    );
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conn->query(
        "SELECT * FROM produto ORDER BY nome ASC"
    );
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare(
        "SELECT id_produto FROM produto_pedido
         WHERE id_pedido = :id"
    );
    $stmt->execute(["id" => $id_pedido]);
    $selecionados = array_map(
        "intval",
        $stmt->fetchAll(PDO::FETCH_COLUMN)
    );

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_cliente = filter_input(
            INPUT_POST,
            "id_cliente",
            FILTER_VALIDATE_INT
        );

        $ids_produtos = $_POST["produtos"] ?? [];

        if (!$id_cliente || !is_array($ids_produtos)) {
            throw new Exception("Dados inválidos.");
        }

        $ids_produtos = array_values(array_unique(
            array_filter(
                array_map("intval", $ids_produtos),
                fn($id) => $id > 0
            )
        ));

        if (empty($ids_produtos)) {
            throw new Exception(
                "Selecione pelo menos um produto."
            );
        }

        $stmt = $conn->prepare(
            "SELECT id_cliente FROM cliente
             WHERE id_cliente = :id"
        );
        $stmt->execute(["id" => $id_cliente]);

        if (!$stmt->fetch()) {
            throw new Exception("Cliente não encontrado.");
        }

        $placeholders = implode(
            ",",
            array_fill(0, count($ids_produtos), "?")
        );

        $stmt = $conn->prepare(
            "SELECT id_produto FROM produto
             WHERE id_produto IN ($placeholders)"
        );
        $stmt->execute($ids_produtos);

        if (
            count($stmt->fetchAll(PDO::FETCH_COLUMN))
            !== count($ids_produtos)
        ) {
            throw new Exception("Produto não encontrado.");
        }

        $conn->beginTransaction();

        $stmt = $conn->prepare(
            "UPDATE pedido
             SET id_cliente = :cliente
             WHERE id_pedido = :pedido"
        );

        $stmt->execute([
            "cliente" => $id_cliente,
            "pedido" => $id_pedido
        ]);

        $stmt = $conn->prepare(
            "DELETE FROM produto_pedido
             WHERE id_pedido = :id"
        );
        $stmt->execute(["id" => $id_pedido]);

        $stmt = $conn->prepare(
            "INSERT INTO produto_pedido
             (id_pedido, id_produto)
             VALUES (:pedido, :produto)"
        );

        foreach ($ids_produtos as $id_produto) {
            $stmt->execute([
                "pedido" => $id_pedido,
                "produto" => $id_produto
            ]);
        }

        $conn->commit();

        echo '<link rel="stylesheet" href="../style.css">';
        echo '<h1 class="sucesso">Pedido atualizado com sucesso!</h1>';
        echo '<a href="pedidosVisualizar.php">
                <button class="botao" type="button">
                    Voltar aos pedidos
                </button>
              </a>';
        exit;
    }
} catch (Throwable $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }

    echo '<link rel="stylesheet" href="../style.css">';
    echo '<h1 class="erro">'
        . htmlspecialchars($e->getMessage(), ENT_QUOTES, "UTF-8")
        . '</h1>';
}
?>

<link rel="stylesheet" href="../style.css">

<h1 class="cabecario-cadastro">
    Editar pedido #<?= (int)$id_pedido ?>
</h1>

<form class="formulario"
      method="post"
      action="pedidoAtualizar.php?id=<?= (int)$id_pedido ?>">

    <label class="caixa-saida" for="id_cliente">
        Cliente
    </label>

    <select class="caixa-entrada"
            name="id_cliente"
            id="id_cliente"
            required>

        <?php foreach ($clientes as $cliente): ?>
            <option
                value="<?= (int)$cliente["id_cliente"] ?>"
                <?= (int)$cliente["id_cliente"] ===
                    (int)$pedido["id_cliente"]
                    ? "selected"
                    : "" ?>>

                <?= htmlspecialchars(
                    $cliente["nome_completo"],
                    ENT_QUOTES,
                    "UTF-8"
                ) ?>

            </option>
        <?php endforeach; ?>

    </select>

    <br>

    <label class="caixa-saida" for="produtos">
        Produtos
    </label>

    <select class="caixa-entrada"
            name="produtos[]"
            id="produtos"
            multiple
            required>

        <?php foreach ($produtos as $produto): ?>
            <option
                value="<?= (int)$produto["id_produto"] ?>"
                <?= in_array(
                    (int)$produto["id_produto"],
                    $selecionados,
                    true
                ) ? "selected" : "" ?>>

                <?= htmlspecialchars(
                    $produto["nome"] . " - " . $produto["sabor"],
                    ENT_QUOTES,
                    "UTF-8"
                ) ?>

            </option>
        <?php endforeach; ?>

    </select>

    <p>Segure Ctrl para selecionar vários produtos.</p>

    <button class="botao" type="submit">
        Salvar alterações
    </button>

    <a href="pedidosVisualizar.php">
        <button class="botao" type="button">Cancelar</button>
    </a>

</form>