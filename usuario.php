<?php

Class Usuario
{
    private $pdo;
    public $msgErro = ""; //tudo ok

    public function conectar($nome, $host, $usuario, $senha)
    {   
            global $pdo $msgErro;
            try 
            {
                $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
            } catch (PDOException $e) {
                $msgErro = $e->getMessage();
            }

    }

    public function cadastrar($nome,   $num_telefone, $email, $senha, $data_nasc)
    {
            global $pdo;
            //Verificar se já existe o email cadastrado
            $sql = $pdo->prepare("SELECT id FROM usuario WHERE email = :e");
            $sql->bindValue(":e",$email);
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                return false; //ja está cadastrado
            }
            else
            {
                // caso não, Cadastrar
                $sql = $pdo->prepare("INSERT INTO usuario (nome,num_telefone,senha,email,data_nasc) VALUES (:n, :nt, :s, :e, :dn)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":nt",$num_telefone);
                $sql->bindValue(":s",md5($senha));
                $sql->bindValue(":e",$email);
                $sql->bindValue(":dn",$data_nasc);
                $sql->execute();
                return true;
            }
    }

    public function logar($nome,$senha)
    {
            global $pdo;
            //Verificar se o email e senha estão cadastrados se sim  
            $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e AND seha = :s");
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            if($sql->rowCount() > 0)
            {
            //entrar no sistema (sessao)
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true; //Logado com sucesso
            }
            else
            {
            return false; //Não foi possível logar
            }
    }
}

?>