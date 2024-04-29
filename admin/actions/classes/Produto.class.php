<?php 

require_once("Banco.class.php");

class Produto{
    public $id;
    public $nome;
    public $descricao;
    public $foto;
    public $preco;
    public $estoque;
    public $id_categoria;
    public $id_resp;

    public function CadastrarComFoto(){
        $sql = "INSERT INTO produtos (nome, descricao, foto, preco, estoque, id_categoria, id_resp) VALUES (?,?,?,?,?,?,?)";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);

        $comando->execute([$this->nome, $this->descricao, $this->foto, $this->preco, $this->estoque, $this->id_categoria, $this->id_resp]);
        $linhas = $comando->rowCount();
        Banco::desconectar();
        return $linhas;
    }
    public function CadastrarSemFoto(){
        $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, id_categoria, id_resp) 
        VALUES (?,?,?,?,?,?)";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);
        $comando->execute([$this->nome, $this->descricao, $this->preco, $this->estoque, $this->id_categoria, $this->id_resp]);
        $linhas = $comando->rowCount();
        Banco::desconectar();
        return $linhas;
    }
    public function Listar(){
        $sql = "SELECT * FROM view_produtos";

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
    public function ListarPorID(){
        $sql = "SELECT * FROM view_produtos WHERE id = ?";
    
            $conexao = Banco::conectar();
            $comando = $conexao->prepare($sql);
            $comando->execute([$this->id]);
    
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
    
            Banco::desconectar();
    
            return $resultado;
    }
    public function Apagar(){
        $sql = "DELETE FROM produtos WHERE id = ?";
    
            $conexao =  Banco::conectar();
    
            $comando = $conexao->prepare($sql);
    
            // Executa o comando
            $comando->execute([$this->id]);
            // Pegar quantidade de linhas
            $linhas = $comando->rowCount();
            Banco::desconectar();
            // Retornar a qtd de linhas removidadas:
            return $linhas;
    }
    public function Editar(){
        $sql = "UPDATE produtos SET nome = ?, descricao = ? ,id_categoria = ?, estoque = ?, preco = ? WHERE id = ?";
    
            $conexao =  Banco::conectar();
    
            $comando = $conexao->prepare($sql);
    
    
            // Executa o comando
            $comando->execute([$this->nome, $this->descricao, $this->id_categoria, $this->estoque, $this->preco, $this->id]);
            // Pegar quantidade de linhas
            $linhas = $comando->rowCount();
            Banco::desconectar();
            // Retornar a qtd de linhas removidadas:
            return $linhas;
    }
}
?>