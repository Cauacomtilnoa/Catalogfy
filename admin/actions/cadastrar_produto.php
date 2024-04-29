<?php

// Validar sessão:
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location ../index.php");
    die();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Verificar se os valores estão "chegando":
    
    // print_r($_POST);
    // echo "<br>";
    // print_r($_FILES['foto']);
    // echo "<br>";
    // print_r($_SESSION['usuario']);
    
    require_once("classes/Produto.class.php");
    $p = new Produto();
    $p->nome = strip_tags($_POST['nome']);
    $p->descricao = strip_tags($_POST['descricao']);
    $p->preco = strip_tags($_POST['preco']);
    $p->estoque = strip_tags($_POST['estoque']);
    $p->id_categoria = strip_tags($_POST['id_categoria']);
    $p->id_resp = $_SESSION['usuario']['id'];

    // Verificar se existe ou não uma foto setado input['foto']:
    if($_FILES['foto']['size'] == 0){
        // não tem foto!
        // Cadastrar no banco:
        if($p->CadastrarSemFoto() == 1){
            // Deu certo o cadastro!
            header("Location: ../painel.php");
            die();
        }else{
            echo "Falha ao cadastrar produto!";
        }
    }else{
        // Se houver foto no input:
        $ext = pathinfo($_FILES['foto']['name'] ,PATHINFO_EXTENSION);
        $novo_nome = hash_file('md5', $_FILES['foto']['tmp_name']).".".$ext;
        //echo $novo_nome;
        $pasta = "../fotos/";

        // array com tipos de arquivos validos:
        $validos = ['jpg', 'png', 'webm', 'jpeg'];

        if(in_array($ext, $validos)){
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $pasta . $novo_nome)){
                // Se der certo o upload:
                $p->foto = $novo_nome;
                // Cadastrar:
                if($p->CadastrarComFoto() == 1){
                    // Deu certo!
                    header("Location: ../painel.php");
                    die();
                }else{
                    echo "Falha ao cadastrar produto (foto).";
                }
            }else{
                // se der errado :(
                    echo "Falha ao mover imagem";
            }
        }else{
            echo "Formato de imagem inválido!";
        }

       
    }
}else{
    echo "Essa página deve ser carregada por POST!";
}

?>