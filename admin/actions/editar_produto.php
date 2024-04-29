<?php
// Verificar a sessão:
    session_start();
    if(!isset($_SESSION['usuario'])){
      // Voltar pro login:
      header("Location: ../login.php");
      die();
    }

if($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once("classes/Produto.class.php");
    $p = new Produto();
 
    $p->nome = strip_tags($_POST['nome']);
    $p->descricao = strip_tags($_POST['descricao']);
    $p->estoque = strip_tags($_POST['estoque']);
    $p->preco = strip_tags($_POST['preco']);
    $p->id_categoria = strip_tags($_POST['id_categoria']);
    $p->id = strip_tags($_POST['id']);  
    
 
    if($p->Editar() == 1){
        // Redirecionar de volta à index.php:
        header('Location: ../painel.php');
    }else{
        echo "Falha ao cadastrar";
    }
 
}else {
    echo "ERRO";
}
 

?>