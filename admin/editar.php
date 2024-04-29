<?php

// Verificar a sessão:
session_start();
if (!isset($_SESSION['usuario'])) {
    // Voltar pro login:
    header("Location: index.php");
    die();
}

$erro = 0;

if (isset($_GET['id'])) {
    require_once('actions/classes/Categoria.class.php');
    $c = new Categoria();
    $lista_categorias = $c->Listar();
    
    require_once('actions/classes/Produto.class.php');
    $p = new Produto();
    $p->id = $_GET['id'];
    $resultado = $p->ListarPorID();
    if (count($resultado) == 1) {
        $resultado = $resultado[0];
        print_r($resultado);
    } else {
        $erro = 1;
    }
} else {
    $erro = 1;
}


$msg_sucesso = [
    "Contato cadastrado com sucesso!",
    "Contato removido com sucesso!",
    "Contato modificado com sucesso!"
];
$msg_falha = [
    "Falha ao cadastrar contato.",
    "Falha ao remover contato.",
    "Falha ao modificar contato."
];

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulário de Edição</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Formulário de Edição</h1>
        <form action="actions/editar_produto.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" value="<?= $resultado['nome'] ?>" class="form-control" id="nome" name="nome">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" value="<?= $resultado['descricao'] ?>" class="form-control" id="descricao" name="descricao">
            </div>
            <div class="form-group">
                <label for="estoque">Estoque:</label>
                <input type="number" value="<?= $resultado['estoque'] ?>" class="form-control" id="estoque" name="estoque">
            </div>
            <div class="form-group">
                <label for="nome_categoria">Nome da categoria:</label>
                <select class="form-control" id="categoriaProduto" name="id_categoria">
                    <option value=""> <?=$resultado['nome_categoria']?></option>
                    <?php foreach ($lista_categorias as $categoria) { ?>
                        <option value="<?= $categoria["id"] ?>"><?= $categoria["nome"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="number" value="<?= $resultado['preco'] ?>" class="form-control" id="preco" name="preco">
            </div>
            <div class="form-group">
                <input type="hidden" value="<?= $resultado['id'] ?>" class="form-control" id="id" name="id">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>
    <?php if (isset($_GET['sucesso']) and $_GET['sucesso'] < count($msg_sucesso)) { ?>
        <div class="alert alert-success" role="alert">
            <?= $msg_sucesso[$_GET['sucesso']]; ?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['falha']) and $_GET['falha'] < count($msg_sucesso)) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $msg_falha[$_GET['falha']]; ?>
        </div>
    <?php } ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>