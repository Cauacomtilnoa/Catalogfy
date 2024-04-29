<?php
 
require_once("Banco.class.php");
 
class Categoria{
 
    public $id;
    public $nome;
 
 
    public function Cadastrar() {
        $sql = "INSERT INTO categorias(nome) VALUES(?)";
 
 
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);
        $comando->execute([$this->nome]);
 
        $linhas = $comando->rowCount();
        Banco::desconectar();
 
        return $linhas;
    }
 
    public function Listar(){
        $sql = "SELECT * FROM categorias";
        $conexao = Banco::conectar();
        // Converter comando sql (string) em objeto:
        $comando = $conexao->prepare($sql);
        // Executando o comando
        $comando->execute();
 
        // Entregar o resultado para $resultado como um array associativo
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
 
 
        // Desconectar
        $conexao = Banco::desconectar();
 
        return $resultado;
    }
}
 
 
 
 
?>