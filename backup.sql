-- BACKUP COMPLETO (ESTRUTURA E DADOS)

-- Estrutura da tabela cliente
CREATE TABLE cliente (
    id_cliente serial NOT NULL,
    cpf text NOT NULL,
    n_mesa int NOT NULL,
    nome_completo text NOT NULL,

    primary key(id_cliente)
);

-- Dados da tabela cliente


-- Estrutura da tabela pedido
CREATE TABLE pedido (
    id_pedido serial NOT NULL ,
    id_cliente int NOT NULL

    primary key(id_pedido),
    foreign key(id_cliente) references cliente(id_cliente)
);

-- Dados da tabela pedido

--------------------------------------------------

-- Estrutura da tabela produto_pedido
CREATE TABLE produto_pedido (
    id_produto int NOT NULL,
    id_pedido int NOT NULL,

    primary key(id_pedido, id_produto),
    foreign key(id_pedido) references pedido(id_pedido),
    foreign key(id_produto) references produto(id_produto)
);

-- Dados da tabela produto_pedido

--------------------------------------------------

-- Estrutura da tabela produto
CREATE TABLE produto (
    id_produto serial NOT NULL,
    sabor text NOT NULL,
    nome text NOT NULL,

    primary key(id_produto),    
);

-- Dados da tabela produto

--------------------------------------------------
