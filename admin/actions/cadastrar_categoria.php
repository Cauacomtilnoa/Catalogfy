<?php

// Validar a sessão
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location ../index.php");
    die();
}

// Verificar se a página está sendo validada por post
if($_SERVER['REQUEST_METHOD'] === "POST"){
    // Importar o arquivo da classe:
    require_once("classes/Categoria.class.php");
    // Criar o objeto do tipo "Categoria"
    $c = new Categoria();
    $c->nome =  strip_tags($_POST['nome']);
    // Cadastrar:
    if (strlen($c->nome) > 1){
        if($c->Cadastrar() == 1){
            // Deu certo o cadastro !
            // Retornar 
            header("Location: ../painel.php");
            die();
        }else{
            echo "Falha ao cadastrar a categoria !";
        }
    }else{
        echo "Nome da categoria muito pequeno";
    }

}else{
    echo "Essa página deve ser carregada por POST";
}   