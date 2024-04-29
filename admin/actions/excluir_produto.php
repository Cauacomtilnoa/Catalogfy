<?php 
    // Verificar sessão 
    session_start();
    if(!isset($_SESSION['usuario'])){
      // Voltar pro login:
      header("Location: ../login.php");
      die();
    }

    if(isset($_GET['id'])){
        require_once('classes/Produto.class.php');
        $p = new Produto();
        $p->id = $_GET['id'];
        if($p->Apagar()){
            header("Location: ../painel.php");
        }

    }else{
        echo "O ID deve ser informado na url";
    }
?>