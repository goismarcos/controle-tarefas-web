<?php

/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 05/08/2017
 * Time: 09:52
 */
require_once 'conexao.php';
class Pegasus
{
    private $conexao;
    private $descricao;
    private $onde;
    private $idMissao;
    private $idUsuarioConcluir;
    private $solucao;

    //METODO CONSTRUTOR PARA INSTANCIAR AS CLASSES
    public function __construct()
    {
        $this->conexao = new conexao;
    }
    //descricao
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    //onde
    public function setOnde($onde)
    {
        $this->onde = $onde;
    }
    public function getOnde()
    {
        return $this->onde;
    }
    //id usuario que postou
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    //id usuario que fez
    public function setIdUsuarioConcluir($idUsuarioConcluir)
    {
        $this->idUsuarioConcluir = $idUsuarioConcluir;
    }
    public function getIdUsuarioConcluir()
    {
        return $this->idUsuarioConcluir;
    }
    //id MISSAO
    public function setIdMissao($idMissao)
    {
        $this->idMissao = $idMissao;
    }
    public function getIdMissao()
    {
        return $this->idMissao;
    }
        //id MISSAO
    public function setSolucao($solucao)
    {
        $this->solucao = $solucao;
    }
    public function getSolucao()
    {
        return $this->solucao;
    }


    //inserir publicacao
    public function publicacao()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("INSERT INTO tbmissao (onde,descricao,id_usuario) VALUES (?,?,?)");
            $resposta->bindValue(1, $this->getOnde(), PDO::PARAM_STR);
            $resposta->bindValue(2, $this->getDescricao(), PDO::PARAM_STR);
            $resposta->bindValue(3, $this->getidUsuario(), PDO::PARAM_STR);
            //$resposta->bindValue(3, $this->getData(), PDO::PARAM_STR);
            if($resposta->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim do enserir publicacao

    //mostrar publicacao
    public function publicacaoMostrar()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare(" SELECT id_missao, onde, data,(SELECT usuario FROM tbusuario "
                    . "                                       WHERE tbmissao.id_usuario = tbusuario.id_usuario) AS id_usuario, status,descricao FROM tbmissao WHERE status = '0'");
            if($resposta->execute())
            {
                return $resposta->fetchAll();
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim do enserir publicacao
    
    //mostrar publicacao concluida
    public function publicacaoMostrarConclusao()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare(" SELECT id_missao, onde, data,(SELECT usuario FROM tbusuario "
                    . "                                       WHERE tbmissao.id_usuario = tbusuario.id_usuario) AS id_usuario,(SELECT usuario FROM tbusuario "
                    . "                                       WHERE tbmissao.id_usuario_concluir = tbusuario.id_usuario) AS id_usuario_concluir, status,descricao, data_conclusao, conclusao "
                    . "                                       FROM tbmissao WHERE status = '1'");
            if($resposta->execute())
            {
                return $resposta->fetchAll();
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim do enserir publicacao concluida
    
    //concluir publicacao
    public function publicacaoConcluir()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("UPDATE tbmissao SET id_usuario_concluir = ?, data_conclusao = NOW(), status = 1, conclusao = ? "
                    . "                                      WHERE id_missao = ?");
            $resposta->bindValue(1, $this->getIdUsuarioConcluir(), PDO::PARAM_STR);
            $resposta->bindValue(2, $this->getSolucao(), PDO::PARAM_STR);
            $resposta->bindValue(3, $this->getIdMissao(), PDO::PARAM_STR);
            //$resposta->bindValue(3, $this->getData(), PDO::PARAM_STR);
            if($resposta->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim do concluir publicacao
    
    //reabrir publicacao
    public function publicacaoReabrir()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("UPDATE tbmissao SET id_usuario_concluir = null, data_conclusao = null, status = 0, data = NOW(), conclusao = null"
                    . "                                      WHERE id_missao = ?");
            $resposta->bindValue(1, $this->getIdMissao(), PDO::PARAM_STR);
            //$resposta->bindValue(3, $this->getData(), PDO::PARAM_STR);
            if($resposta->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim do reabrir publicacao
    
    //contar quantas missao foi feita nos ultimos 30 dias
    public function missaoUltimosTrintaDiasRealizadas()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("SELECT * FROM tbmissao "
                    . "                                         WHERE data BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() "
                    . "                                             AND status = '1'");
            if($resposta->execute())
            {
                return $resposta->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim 
    
    public function missaoUltimosSeteDiasRealizadas()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("SELECT * FROM tbmissao "
                    . "                                         WHERE data BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() "
                    . "                                             AND status = '1'");
            if($resposta->execute())
            {
                return $resposta->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim
    
        public function totalRealizadas()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("SELECT * FROM tbmissao "
                    . "                                         WHERE status = '1'");
            if($resposta->execute())
            {
                return $resposta->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim
    
    public function todas()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("SELECT * FROM tbmissao ");
            if($resposta->execute())
            {
                return $resposta->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim
}