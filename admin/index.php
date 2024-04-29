<?php
// tela de login do site

?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            background-color: #F4D03F;
            background-image: linear-gradient(132deg, #F4D03F 0%, #16A085 100%);
            background-attachment: fixed;
            background-size: cover;
        }

        .conteudo {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
        }

        #formCadastro {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-4">
                <h1 class="display-4 text-white" id="titulo">Login</h1>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-4 conteudo">
                <form id="formLogin"  action="actions/validar_usuario.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                        <div id="emailHelp" class="form-text">Seu e-mail cadastrado no sistema.</div>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnEntrar" class="form-control btn btn-primary rounded submit px-3">Entrar</button>
                    </div>
                    <div class="mb-3 mt-3">
                        <p class="text-center">Não possui conta no sistema? <a href="#" id="btnCadastroToggle">Cadastre-se</a></p>
                    </div>
                </form>
                <!-- Formulário de cadastro -->
                <form id="formCadastro" action="actions/cadastrar_usuario.php" method="POST">
                    <div class="mb-3">
                        <label for="nomeCad" class="form-label">Nome Completo:</label>
                        <input type="text" class="form-control" id="nomeCad" aria-describedby="nomeCadHelp" name="nome">
                        <div id="nomeCadHelp" class="form-text">Como você deseja ser chamado(a).</div>
                    </div>
                    <div class="mb-3">
                        <label for="emailCad" class="form-label">Email</label>
                        <input type="text" class="form-control" id="emailCad" aria-describedby="emailCadHelp" name="email">
                        <div id="emailCadHelp" class="form-text">E-mail que será utilizado para acessar o sistema.</div>
                    </div>
                    <div class="mb-3">
                        <label for="senhaCad" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senhaCad" name="senha">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3" id="btnCadastrar">Cadastrar</button>
                    </div>
                    <div class="mb-3 mt-3">
                        <p class="text-center">Já possui conta? <a href="#" id="btnLoginToggle">Entrar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Alternar entre formulários login x cadastro:
        $("#btnCadastroToggle").click(function() {
            $("#formLogin").hide();
            $("#formCadastro").fadeIn();
            $("#titulo").text('Cadastro');
        });
        $("#btnLoginToggle").click(function() {
            $("#formCadastro").hide();
            $("#formLogin").fadeIn();
            $("#titulo").text('Login');
        });
    </script>
</body>

</html>