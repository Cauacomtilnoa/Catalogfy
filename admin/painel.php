<?php
session_start();
if(!isset($_SESSION['usuario'])){
    // Voltar
    header("Location: index.php");
    die();
}

// Puxar os produtos
require_once("actions/classes/Produto.class.php");
$p = new Produto;
$lista_produtos = $p->Listar();
// Puxar as categorias 
require_once("actions/classes/Categoria.class.php");
$c = new Categoria;
$lista_categorias = $c->Listar();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gerenciamento de Produtos</h1>
        <div class="row mb-3">
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-success mx-1" data-toggle="modal" data-target="#modalCadastro"><i class="bi bi-plus-circle"></i> Cadastrar Produto</button>
                <a class="btn btn-danger mx-1 text-white" href="actions/sair.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_produtos as $linha) { ?>
                <tr>
                    <td><?=$linha['id'];?></td>
                    <td><img src="<?="fotos/".$linha['foto']; ?>" alt="Produto<?=$linha['id'];?>"></td>
                    <td><?=$linha['nome'];?></td>
                    <td><?=$linha['descricao'];?></td>
                    <td><?=$linha['nome_categoria'];?></td>
                    <td><?=$linha['estoque'];?></td>
                    <td><?=$linha['preco'];?></td>
                    <td><a href="actions/excluir_produto.php?id=<?=$linha['id']?>">Excluir</a> | <a href="editar.php?id=<?=$linha['id']?>">Editar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <!-- Modal de Cadastro -->
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="actions/cadastrar_produto.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroLabel">Cadastro de Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="nomeProduto">Nome</label>
                            <input type="text" class="form-control" id="nomeProduto" name="nome" placeholder="Digite o nome do produto">
                        </div>
                        <div class="form-group">
                            <label for="fotoProduto">Foto</label>
                            <input type="file" class="form-control-file" id="fotoProduto" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="descricaoProduto">Descrição</label>
                            <textarea class="form-control" id="descricaoProduto" rows="3" name="descricao"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categoriaProduto">Categoria</label>
                            <select class="form-control" id="categoriaProduto" name="id_categoria">
                                <?php foreach($lista_categorias as $categoria)  { ?>
                                    <option value="<?= $categoria["id"]?>"><?= $categoria["nome"];?></option>
                                <?php } ?>
                            </select> <br>
                            <div class="row">
                                <div class="col d-flex justify-content-end">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAddCategoria">Adicionar Categoria</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estoqueProduto">Estoque</label>
                            <input type="number" class="form-control" id="estoqueProduto" placeholder="Digite a quantidade em estoque" name="estoque">
                        </div>
                        <div class="form-group">
                            <label for="precoProduto">Preço</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" class="form-control" id="precoProduto" placeholder="Digite o preço" name="preco">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal de Adicionar Categoria -->
    <div class="modal fade" id="modalAddCategoria" tabindex="-1" role="dialog" aria-labelledby="modalAddCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddCategoriaLabel">Adicionar Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="actions/cadastrar_categoria.php" method="post">
                        <div class="form-group">
                            <label for="nomeCategoria">Nome da Categoria</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome da categoria">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>