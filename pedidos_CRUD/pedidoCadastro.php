
<?php
require_once "../bd.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../pedido.php?escolha=cadastro");
    exit;
}

$id_cliente = filter_input(
    INPUT_POST,
    "id_cliente",
    FILTER_VALIDATE_INT
);

$produtos = $_POST["produtos"] ?? [];

if (!$id_cliente || !is_array($produtos) || empty($produtos)) {
    exit("Erro: selecione um cliente e pelo menos um produto.");
}

$produtos = array_unique(
    array_filter(
        array_map("intval", $produtos),
        fn($id) => $id > 0
    )
);

$conn = getConnection();

if (!$conn) {
    exit("Não foi possível conectar ao banco de dados.");
}

try {
    // Confirma que o cliente existe.
    $stmt = $conn->prepare(
        "SELECT id_cliente FROM cliente WHERE id_cliente = :id"
    );
    $stmt->execute(["id" => $id_cliente]);

    if (!$stmt->fetch()) {
        throw new Exception("Cliente não encontrado.");
    }

    // Confirma que todos os produtos existem.
    $placeholders = implode(
        ",",
        array_fill(0, count($produtos), "?")
    );

    $stmt = $conn->prepare(
        "SELECT id_produto FROM produto
         WHERE id_produto IN ($placeholders)"
    );
    $stmt->execute(array_values($produtos));

    if ($stmt->rowCount() !== count($produtos)) {
        throw new Exception("Um ou mais produtos não existem.");
    }

    $conn->beginTransaction();

    // Cria o pedido e recupera seu ID.
    $stmt = $conn->prepare(
        "INSERT INTO pedido (id_cliente)
         VALUES (:id_cliente)
         RETURNING id_pedido"
    );

    $stmt->execute(["id_cliente" => $id_cliente]);

    $id_pedido = $stmt->fetchColumn();

    // Vincula cada produto ao pedido.
    $stmtProduto = $conn->prepare(
        "INSERT INTO produto_pedido
         (id_pedido, id_produto)
         VALUES (:id_pedido, :id_produto)"
    );

    foreach ($produtos as $id_produto) {
        $stmtProduto->execute([
            "id_pedido" => $id_pedido,
            "id_produto" => $id_produto
        ]);
    }

    $conn->commit();

    echo '<link rel="stylesheet" href="../style.css">';
    echo '<h1 class="sucesso">Pedido cadastrado com sucesso!</h1>';
    echo '<a href="pedidosVisualizar.php">
            <button class="botao" type="button">
                Ver pedidos
            </button>
          </a>';
    echo '<a href="../index.php">
            <button class="botao" type="button">
                Voltar ao menu
            </button>
          </a>';

} catch (Throwable $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }

    http_response_code(400);
    echo '<link rel="stylesheet" href="../style.css">';
    echo '<h1 class="erro">Não foi possível cadastrar o pedido.</h1>';
    echo '<p>Verifique os dados e tente novamente.</p>';
    echo '<a href="../pedido.php?escolha=cadastro">Voltar</a>';
}
?>