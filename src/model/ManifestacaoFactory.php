<?php
namespace Ouvidoria\model\factory;

require("Conexao.php");

require_once("Manifestacao.php");

class ManifestacaoFactory
{


    public function __construct()
    {

    }

    /**
     * Persiste objetos Contato no banco de dados.
     * @param Contato $obj - Objeto Contato a ser persistido.
     * @return boolean - se conseguiu salvar ou não.
     */

    public function salvarManifestacao($obj)
    {
        global $conexao;
        $manifestacao = $obj;

        try {
            $query = "INSERT INTO manifestacao (id_tipo_manifestacao, cidadao_cpf, assunto, mensagem, sigilo, id_situacao, id_anexo, data_manifestacao) VALUES ('"
                . $manifestacao->getId_tipo_manifestacao() . "','"
                . $manifestacao->getCidadao_cpf() . "','"
                . $manifestacao->getAssunto() . "','"
                . $manifestacao->getMensagem() . "','"
                . (int)$manifestacao->getSigilo() . "','"
                . $manifestacao->getId_situacao() . "','"
                . $manifestacao->getIdAnexo() . "','"
                . $manifestacao->getDataManifestacao() . "')";

            if (mysqli_query($conexao, $query)) {
                $idGerado = mysqli_insert_id($conexao);
                //$resultado = true;
            } else {
                $resultado = false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
        return $idGerado;
    }
    public function listarMinhasManifestacoes(string $cpf)
    {
        global $conexao;
        $manifestacoes = array();


        $query = "SELECT id_manifestacao, assunto, data_manifestacao, nome_tipo_manifestacao, nome_situacao, mensagem 
            from manifestacao m INNER JOIN tipomanifestacao t ON m.id_tipo_manifestacao = t.id_tipo_manifestacao
            INNER JOIN situacao s ON s.id_situacao = m.id_situacao 
            WHERE m.cidadao_cpf = " . $cpf . ";";

        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $manifestacoes = mysqli_fetch_all($resultado);

                return $manifestacoes;
            } else
                return NULL;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }

    public function listarManifestacoes(string $acesso)
    {
        global $conexao;
        $manifestacoes = array();

        if ($acesso == 1) {
            $query = "SELECT id_manifestacao, assunto, data_manifestacao, nome_tipo_manifestacao, nome_situacao, mensagem 
            from manifestacao m INNER JOIN tipomanifestacao t ON m.id_tipo_manifestacao = t.id_tipo_manifestacao
            INNER JOIN situacao s ON s.id_situacao = m.id_situacao 
            WHERE s.id_situacao = 1 and m.sigilo = 0;";
        }
        else if ($acesso == 2) {
            $query = "SELECT id_manifestacao, assunto, data_manifestacao, nome_tipo_manifestacao, nome_situacao, mensagem 
            from manifestacao m INNER JOIN tipomanifestacao t ON m.id_tipo_manifestacao = t.id_tipo_manifestacao
            INNER JOIN situacao s ON s.id_situacao = m.id_situacao 
            WHERE s.id_situacao = 1;";
        }
        elseif ($acesso == 3) {
            $query = "SELECT id_manifestacao, assunto, data_manifestacao, nome_tipo_manifestacao, nome_situacao, mensagem
            from manifestacao m INNER JOIN tipomanifestacao t ON m.id_tipo_manifestacao = t.id_tipo_manifestacao
            INNER JOIN situacao s ON s.id_situacao = m.id_situacao 
            WHERE s.id_situacao = 2;";
        }
        elseif ($acesso == 4) {
            $query = "SELECT id_manifestacao, assunto, data_manifestacao, nome_tipo_manifestacao, nome_situacao, mensagem
            from manifestacao m INNER JOIN tipomanifestacao t ON m.id_tipo_manifestacao = t.id_tipo_manifestacao
            INNER JOIN situacao s ON s.id_situacao = m.id_situacao;";
        }

        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $manifestacoes = mysqli_fetch_all($resultado);

                return $manifestacoes;
            } else
                return NULL;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }

    public function selecionarManifestacaoCidadao(string $id)
    {
        global $conexao;

        $manifestacao = array();
        $query = "SELECT id_situacao from manifestacao where id_manifestacao = ".$id.";";
        $sql = mysqli_query($conexao,$query);
        $situacao = mysqli_fetch_array($sql);
        $query = "SELECT resposta from manifestacao where id_manifestacao = ".$id.";";
        $sql = mysqli_query($conexao,$query);
        $checarResposta = mysqli_fetch_assoc($sql);

        if($checarResposta['resposta'] == null){
            if($situacao['id_situacao'] == 2){
                $query = "SELECT id_manifestacao, data_manifestacao, assunto, nome, nome_situacao, mensagem, nome_orgao_publico, id_anexo
                from manifestacao m INNER JOIN usuario u ON  m.cidadao_cpf = u.cpf
                INNER JOIN historico h ON h.manifestacao = m.id_manifestacao
                INNER JOIN orgaopublico o ON h.orgao_publico = o.id_orgao_publico
                INNER JOIN situacao s ON s.id_situacao = m.id_situacao
                WHERE id_manifestacao = " . $id . ";";
            }else {
                $query = "SELECT id_manifestacao, data_manifestacao, assunto, nome, nome_situacao, mensagem 
        from manifestacao m INNER JOIN usuario u ON  m.cidadao_cpf = u.cpf
        INNER JOIN situacao s ON s.id_situacao = m.id_situacao
        WHERE id_manifestacao = " . $id . ";";
                
            }
        }else {
            $query = "SELECT id_manifestacao, data_manifestacao, assunto, nome, nome_situacao, mensagem, nome_orgao_publico,resposta 
                from manifestacao m INNER JOIN usuario u ON  m.cidadao_cpf = u.cpf
                INNER JOIN historico h ON h.manifestacao = m.id_manifestacao
                INNER JOIN orgaopublico o ON h.orgao_publico = o.id_orgao_publico
                INNER JOIN situacao s ON s.id_situacao = m.id_situacao
                WHERE id_manifestacao = " . $id . ";";
        }

        $resultado = mysqli_query($conexao, $query);
        if ($resultado) {
            $manifestacao = mysqli_fetch_object($resultado);

            return $manifestacao;
        } else {
            return "Nenhum tipo encontrado";
        }
    }

    public function selecionarManifestacaoAdmPublico(string $id)
    {
        global $conexao;

        $manifestacao = array();

        $query = "SELECT id_manifestacao, data_manifestacao, assunto, nome, nome_situacao, mensagem, 
        nome_orgao_publico, resposta, id_anexo FROM manifestacao m INNER JOIN usuario u ON  m.cidadao_cpf = u.cpf
        INNER JOIN historico h ON h.manifestacao = m.id_manifestacao
        INNER JOIN orgaopublico o ON h.orgao_publico = o.id_orgao_publico
        INNER JOIN situacao s ON s.id_situacao = m.id_situacao
        WHERE id_manifestacao = " . $id . ";";

        $resultado = mysqli_query($conexao, $query);

        if ($resultado) {
            $manifestacao = mysqli_fetch_object($resultado);

            return $manifestacao;
        } else {
            return "Nenhum tipo encontrado";
        }
    }

    public function selecionarManifestacaoOuvidor(string $id)
    {
        global $conexao;

        $manifestacao = array();

        $query = "SELECT id_manifestacao, data_manifestacao, assunto, nome, nome_situacao, mensagem, id_anexo 
        from manifestacao m INNER JOIN usuario u ON  m.cidadao_cpf = u.cpf
        INNER JOIN situacao s ON s.id_situacao = m.id_situacao
        WHERE id_manifestacao = " . $id . ";";

        $resultado = mysqli_query($conexao, $query);

        if ($resultado) {
            $manifestacao = mysqli_fetch_object($resultado);

            return $manifestacao;
        } else {
            return "Nenhum tipo encontrado";
        }
    }


    public function alterarManifestacaoOuvidor($id)
    {
        global $conexao;

        $query = "UPDATE manifestacao SET id_situacao = 2 WHERE id_manifestacao = " . $id . ";";

        if (mysqli_query($conexao, $query))
            return true;
        else
            return false;
    }

    public function alterarManifestacaoAdmPublico($id, $resposta)
    {
        global $conexao;

        $query = "UPDATE manifestacao SET resposta = '" . $resposta . "', id_situacao= 3 WHERE id_manifestacao = " . $id . ";";

        if (mysqli_query($conexao, $query))
            return true;
        else
            return false;
    }

    public function recusaManifestacao(String $id)
    {
        global $conexao;
        $query = "UPDATE manifestacao SET id_situacao = '1' where id_manifestacao = " . $id . ";";
        
        if (mysqli_query($conexao, $query))
            return true;
        else
            return false;
    }

    public function manifestarInteresse(string $idManifestacao,string $idUsuario){
        global $conexao;
        $query = "insert into interesse (idManifestacao,idUsuario) values ('"
            .$idManifestacao."','".$idUsuario."')";
        if(mysqli_query($conexao,$query))
            return true;
        else
            return false;

    }

    public function checaInteresse(string $idManifestacao,string $idUsuario){
        global $conexao;
        $query = "select idUsuario from interesse where idManifestacao = " . $idManifestacao . " and idUsuario = " . $idUsuario . ";";
        $sql = mysqli_query($conexao,$query);
        $checar = mysqli_fetch_assoc($sql);
        if($checar){
            return 1;
        }
        else
            return 0;

    }

    public function removerInteresse(string $idManifestacao,string $idUsuario){
        global $conexao;
        $query = "DELETE FROM interesse where idManifestacao = " . $idManifestacao . " and idusuario = " . $idUsuario . ";";
        if(mysqli_query($conexao,$query)){
            return true;
        }else
            return false;
    }

    public function selecionaOuvidor(string $cpfOuvidor){
        global $conexao;
        $query = "select nome from usuario where cpf = " . $cpfOuvidor . ";";
        $resultado = mysqli_query($conexao,$query);
        $checar = mysqli_fetch_assoc($resultado);
        if($checar){
            return $checar;
        }
        else
            return false;
    }
    public function selecionaOrgao(string $id_orgao_publico){
        global $conexao;
        $query = "select nome_orgao_publico from orgaopublico where id_orgao_publico = " . $id_orgao_publico . ";";

        $resultado = mysqli_query($conexao,$query);
        $checar = mysqli_fetch_assoc($resultado);
        if($checar){
            return $checar;
        }
        else
            return false;
    }
    public function selecionaEmailInteressados(string $idManifestacao){
        global $conexao;
        $email = array();
        $listaCpf = array();

        $query1 = "select idUsuario from interesse where idManifestacao = " . $idManifestacao . ";";

        $sql1 = mysqli_query($conexao,$query1);
        while($row=mysqli_fetch_array($sql1)){
            array_push($listaCpf, $row['idUsuario']);
        };
        foreach ($listaCpf as $cpfs => $cpf) {
            $query2 = "select email from usuario where cpf = " . $cpf . ";";
            $sql2 = mysqli_query($conexao,$query2);
            $sql2 = mysqli_fetch_assoc($sql2);
            array_push($email, $sql2['email']);
        }
        return $email;
    }

    public function selecionaNomeAdmin(string $cpfAdminPublico){
        global $conexao;
        $query = "select nome from usuario where cpf = " . $cpfAdminPublico . ";";

        $sql = mysqli_query($conexao,$query);
        $sql = mysqli_fetch_array($sql);
        return $sql['nome'];
    }

    public function selecionaNomeOrgao(string $idManifestacao){
        global $conexao;
        $query = "SELECT o.nome_orgao_publico 
        from manifestacao m 
        INNER JOIN historico h ON h.manifestacao = m.id_manifestacao
        INNER JOIN orgaopublico o ON h.orgao_publico = o.id_orgao_publico
        WHERE id_manifestacao = " . $idManifestacao . ";";
        $res = mysqli_query($conexao,$query);
        $sql = mysqli_fetch_array($res);
        return $sql['nome_orgao_publico'];
    }

    public function listaAcompanharManifestacao(){
        global $conexao;

        $query = "SELECT id_manifestacao, assunto, data_manifestacao, nome_tipo_manifestacao, nome_situacao, mensagem
            from manifestacao m INNER JOIN tipomanifestacao t ON m.id_tipo_manifestacao = t.id_tipo_manifestacao
            INNER JOIN situacao s ON s.id_situacao = m.id_situacao 
            WHERE m.sigilo = 0;";

            try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $manifestacoes = mysqli_fetch_all($resultado);

                return $manifestacoes;
            } else
                return NULL;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }
}
