<?php 

require_once('Banco.class.php');

class Usuario {
    public $id;
    public $nome;
    public $email;
    public $senha;

    public function Logar(){
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    
            $conexao = Banco::conectar();
            $comando = $conexao->prepare($sql);
            $hash = hash("sha256", $this->senha);
            $comando->execute([$this->email, $hash]);
    
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
    
            Banco::desconectar();
    
            return $resultado;
    }
    public function Cadastrar(){
        $sql = "INSERT INTO usuarios (nome,email,senha) VALUES (?,?,?)";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);

        $hash = hash("sha256", $this->senha);

        $comando->execute([$this->nome, $this->email, $hash]);
        $linhas = $comando->rowCount();
        Banco::desconectar();
        return $linhas;
    }

}