<link rel="stylesheet" href="../style.css">

<?php
require_once "../bd.php";

$conn = getConnection();

if (!$conn) {
    exit("Erro ao conectar ao banco de dados.");
}

try {
    $sql = "
        SELECT
            p.id_pedido,
            c.nome_completo,
            c.n_mesa,
            COALESCE(
                STRING_AGG(
                    pr.nome || ' - ' || pr.sabor,
                    ', ' ORDER BY pr.nome
                ),
                'Sem produtos'
            ) AS produtos
        FROM pedido p
        INNER JOIN cliente c
            ON p.id_cliente = c.id_cliente
        LEFT JOIN produto_pedido pp
            ON p.id_pedido = pp.id_pedido
        LEFT JOIN produto pr
            ON pp.id_produto = pr.id_produto
        GROUP BY
            p.id_pedido,
            c.nome_completo,
            c.n_mesa
        ORDER BY p.id_pedido ASC
    ";

    $stmt = $conn->query($sql);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Throwable $e) {
    exit("Erro ao consultar os pedidos.");
}
?>

<h1 class="cabecario">Tabela de pedidos</h1>

<a href="../pedido.php?escolha=cadastro">
    <button class="botao" type="button">
        Novo pedido
    </button>
</a>

<a href="../index.php">
    <button class="botao" type="button">
        Voltar ao menu
    </button>
</a>

<table class="tabela">

    <thead>
        <tr class="tabela-linha">
            <td class="caixa-valor valor-id">ID</td>
            <td class="caixa-valor valor-normal">Cliente</td>
            <td class="caixa-valor valor-normal">Mesa</td>
            <td class="caixa-valor valor-normal">Produtos</td>
            <td class="caixa-valor valor-normal">Editar</td>
            <td class="caixa-valor valor-normal">Excluir</td>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($pedidos as $pedido): ?>

            <tr class="tabela-linha">

                <td class="caixa-valor valor-saida">
                    <?= (int)$pedido["id_pedido"] ?>
                </td>

                <td class="caixa-valor valor-saida">
                    <?= htmlspecialchars(
                        $pedido["nome_completo"],
                        ENT_QUOTES,
                        "UTF-8"
                    ) ?>
                </td>

                <td class="caixa-valor valor-saida">
                    <?= (int)$pedido["n_mesa"] ?>
                </td>

                <td class="caixa-valor valor-saida">
                    <?= htmlspecialchars(
                        $pedido["produtos"],
                        ENT_QUOTES,
                        "UTF-8"
                    ) ?>
                </td>

                <td class="caixa-valor">
                    <a href="pedidoAtualizar.php?id=<?= (int)$pedido["id_pedido"] ?>">
                        <button class="botao botao-editar" type="button">
                            Editar
                        </button>
                    </a>
                </td>

                <td class="caixa-valor">
                    <a href="pedidoDeletar.php?id=<?= (int)$pedido["id_pedido"] ?>">
                        <button class="botao botao-excluir" type="button">
                            Deletar
                        </button>
                    </a>
                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>