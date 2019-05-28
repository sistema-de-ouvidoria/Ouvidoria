<?php
namespace Ouvidoria\controller;

use Ouvidoria\model\manager\AnexoManager;
use Ouvidoria\model\manager\HistoricoManager;
use Ouvidoria\model\manager\ManifestacaoManager;
use Ouvidoria\model\manager\OrgaoPublicoManager;
use Ouvidoria\model\manager\TipoManifestacaoManager;
use Ouvidoria\model\manager\TipoUsuarioManager;
use Ouvidoria\model\manager\UsuarioManager;


class UsuarioControle extends AbstractControle
{
    public function __construct()
    {
        $this->manifestacaoManager = new ManifestacaoManager();
        $this->anexoManager = new Anexomanager();
        $this->tipoManager = new TipoManifestacaoManager();
        $this->tipoUserManager = new TipoUsuarioManager();
        $this->usuarioManager = new UsuarioManager();
        $this->orgaoManager = new OrgaoPublicoManager();
        $this->historicoManager = new HistoricoManager();
        $this->inicializador();

    }

    public function inicializador()
    {
        $f = isset($_GET['function']) ? $_GET['function'] : "default";

        session_start();
        switch ($f) {
            case 'fazerLogin':
                $this->fazerLogin();
                break;
            case 'cadastrarUsuario':
                $this->cadastrarUsuario();
                break;
            case 'cadastrarUsuarioAcao':
                $this->cadastrarUsuarioAcao();
                break;
            case 'loginAcao':
                $this->loginAcao();
                break;
            case 'deslogar':
                unset($_SESSION['usuario']);
                session_destroy();
                $this->inicio();
                break;
            case 'alteraDadosAcao':
                $this->alteraDadosAcao();
                break;
            case 'alterarDados':
                $this->alterarDados();
                break;
            case 'detalharUsuario':
                $this->detalharUsuario();
                break;
            case 'usuarioDetalhe':
                $this->usuarioDetalhe();
                break;
            case 'inicial':
                $this->inicial();
                break;
            case 'listarUsuarios':
                $this->listarUsuarios();
                break;
            default:
                $this->inicio();
                break;
        }
        session_write_close();
    }

    public function inicial()
    {
        require('view/telaInicial.php');
    }

    public function alteraDadosAcao()
    {
        $usuario = $this->usuarioManager->buscaInfoUsuario($_SESSION['usuario']['cpf']);

        require('view/alterarDados.php');
    }

    public function alteraDadosAcao2(string $erro)
    {
        $usuario = $this->usuarioManager->buscaInfoUsuario($_SESSION['usuario']['cpf']);
        if ($erro == 1) {
            $emailUnico = false;
        } elseif ($erro == 2) {
            $senhaIgual = false;
        } elseif ($erro == 3) {
            $cpfExiste = false;
        } elseif ($erro == 4) {
            $senhaDiferenteBanco = false;
        }
        require('view/alterarDados.php');
    }

    public function inicio()
    {
        require('view/telaInicial.php');
    }

    public function cadastrarUsuarioAcao()
    {
        require('view/cadastrarUsuario.php');
    }

    public function loginAcao()
    {
        require('view/fazerLogin.php');
    }

    public function cadastrarUsuario()
    {
        if (isset($_POST['enviado'])) {

            $nomeCadastro = $_POST['nomeCadastro'];
            $cpfCadastro = $_POST['cpfCadastro'];
            $cpfValidado = $this->checaCPF($cpfCadastro);
            $enderecoCadastro = $_POST['enderecoCadastro'];
            $telefoneCadastro = $_POST['telefoneCadastro'];
            $emailCadastro = $_POST['emailCadastro'];
            $senha1 = $_POST['senhaCadastro'];
            $senha2 = $_POST['senhaConfirmacaoCadastro'];
            $senhaValidada = $this->comparaSenhas($senha1, $senha2);
            $tipo_usuario = 1;
            if ($cpfValidado) {//Verifica se o CPF existe
                if ($senhaValidada) {//Verifica se as senhas são iguais
                    $emailUnico = $this->checaEmailUnico($emailCadastro);
                    if ($emailUnico) {//Verifica se o email já foi cadastrado
                        try {
                            $this->usuarioManager->registrarUsuario($cpfCadastro, $nomeCadastro, $enderecoCadastro, $telefoneCadastro, $emailCadastro, $senha1, $tipo_usuario);
                            include 'view/cadastrarUsuario.php';
                        } catch (Exception $e) {
                            $msg = $e->getMessage();
                        }
                    } else {
                        $erro = 1;//Email existe
                        $this->errosTelaCadastro($nomeCadastro, $cpfCadastro, $enderecoCadastro, $telefoneCadastro, $emailCadastro, $senha1, $senha2, $erro);
                    }
                } else {
                    $erro = 2;//Senha não confere
                    $this->errosTelaCadastro($nomeCadastro, $cpfCadastro, $enderecoCadastro, $telefoneCadastro, $emailCadastro, $senha1, $senha2, $erro);
                }
            } else {
                $erro = 3;//CPF já existe
                $this->errosTelaCadastro($nomeCadastro, $cpfCadastro, $enderecoCadastro, $telefoneCadastro, $emailCadastro, $senha1, $senha2, $erro);
            }
        }
        header('Location: view/cadastrarUsuario.php');
    }

    public function checaEmailUnico(string $emailUnico)
    {
        return $this->usuarioManager->checaEmail($emailUnico);
    }

    public function checaCPF(string $cpf)
    {
        return $this->usuarioManager->checaCPF($cpf);
    }

    public function errosTelaCadastro(string $nomeCadastro, string $cpfCadstro, string $enderecoCadstro, string $telefoneCadastro, string $emailCadastro, string $senha1, string $senha2, string $erro)
    {
        if ($erro == 1) {
            $emailUnico = false;
        } elseif ($erro == 2) {
            $senhaIgual = false;
        } elseif ($erro == 3) {
            $cpfExiste = false;
        } elseif ($erro == 4) {
            $senhaDiferenteBanco = false;
        }
        include('view/cadastrarUsuario.php');
    }

    public function errosTelaAlterarDados(string $nomeCadastro, string $cpfCadstro, string $enderecoCadstro, string $telefoneCadastro, string $emailCadastro, string $senha1, string $senha2, string $erro)
    {
        if ($erro == 1) {
            $emailUnico = false;
        } elseif ($erro == 2) {
            $senhaIgual = false;
        } elseif ($erro == 3) {
            $cpfExiste = false;
        } elseif ($erro == 4) {
            $senhaDiferenteBanco = false;
        }
        $this->alteraDadosAcao2($erro);
    }

    public function alterarDados()
    {
        if (isset($_POST['enviado'])) {
            $senhaAntigaConfirmacao = ($_POST['senhaAntigaAlteraDados']);
            $cpfAlterado = $_POST['cpfAlteraDados'];
            $nomeAlterado = $_POST['nomeAlteraDados'];
            $enderecoAlterado = $_POST['enderecoAlteraDados'];
            $telefoneAlterado = $_POST['telefoneAlteraDados'];

            $emailAlterado = $_POST['emailAlteraDados'];
            $senha1 = $_POST['senhaNovaAlteraDados'];
            $senha2 = $_POST['senhaNovaConfirmacaoAlteraDados'];
            $id = $_SESSION['usuario']['id_tipo_usuario'];
            $emailBuscado = $this->usuarioManager->selecionarEmail($cpfAlterado);
            if ($emailAlterado == $emailBuscado['email']) {
                $emailUnico = true;
            } else {
                $emailUnico = $this->checaEmailUnico($emailAlterado);
            }
            if ($emailUnico) {
                if ($this->usuarioManager->verificaSenhaAntiga($senhaAntigaConfirmacao, $cpfAlterado)) {
                    $teste = "teste";
                    if (isset($senha1) && isset($senha2) && $this->comparaSenhas($senha1, $senha2)) {
                        try {
                            if ($senha1 == "") {
                                $senha1 = $senhaAntigaConfirmacao;
                            }
                            $sucesso = $this->usuarioManager->alteraUsuario($cpfAlterado, $nomeAlterado, $enderecoAlterado, $telefoneAlterado, $emailAlterado, $senha1, $id);
                            $this->alteraDadosAcao();
                        } catch (Exception $e) {
                            $msg = $e->getMessage();
                        }
                    } else {
                        $erro = 2;//Senha não confere
                        $this->errosTelaAlterarDados($nomeAlterado, $cpfAlterado, $enderecoAlterado, $telefoneAlterado, $emailAlterado, $senha1, $senha2, $erro);
                    }
                } else {
                    $erro = 4;//Senha não confere com a salva no banco de dados
                    $this->errosTelaAlterarDados($nomeAlterado, $cpfAlterado, $enderecoAlterado, $telefoneAlterado, $emailAlterado, $senha1, $senha2, $erro);
                }

                //header('Location: view/alterarDados.php');
            } else {
                $erro = 1;//Email existe
                $this->errosTelaAlterarDados($nomeAlterado, $cpfAlterado, $enderecoAlterado, $telefoneAlterado, $emailAlterado, $senha1, $senha2, $erro);
            }
        }
    }

    public function comparaSenhas($senha1, $senha2)
    {
        if ($senha1 == $senha2)
            return true;
        else
            return false;
    }

    public function fazerLogin()
    {
        $cpf = isset($_POST["cpf"]) ? addslashes(trim($_POST["cpf"])) : FALSE;
        $senha = isset($_POST["senha"]) ? $_POST["senha"] : FALSE;

        if (!$cpf || !$senha) {
            echo 'Você não tem permissão para acessar essa página.';
        } else {


            $usuario = $this->usuarioManager->validaUsuario($cpf, $senha);

            $_SESSION['usuario'] = $usuario;

            // Usuario Cidadao
            if ($_SESSION['usuario']['id_tipo_usuario'] == 1) {
                $listaTipos = $this->tipoManager->listaTipos();
                require('view/criarManifestacao.php');

            } // Usuario Ouvidor
            else if ($_SESSION['usuario']['id_tipo_usuario'] == 2) {
                $this->listar();
            } // Usuario Administrador Publico
            else if ($_SESSION['usuario']['id_tipo_usuario'] == 3)
                $this->listar();

            //Usuario Administrador Sistema
            else if ($_SESSION['usuario']['id_tipo_usuario'] == 4) {
                $this->listarUsuarios();
            }
            else if ($_SESSION['usuario']['id_tipo_usuario'] == 5) {
                echo "<script type=\"text/javascript\">alert('Usuário desativado! Por favor entre em contato com o suporte e solicite acesso.');</script>";
                $this->loginAcao();
            }
            else {
                $msgLogin = false;
                require('view/fazerLogin.php');
            }
            session_write_close();
        }
    }

    public function listar()
    {
        $nvlAcesso = isset($_SESSION['usuario']['id_tipo_usuario']) ? $_SESSION['usuario']['id_tipo_usuario'] : null;

        if (!is_null($nvlAcesso)) {
            $dados = $this->manifestacaoManager->listaManifestacoes($nvlAcesso);
            require ('view/listarManifestacoes.php');
        } else {
            echo 'Você não tem permissão para acessar essa página.';
            exit();
        }
    }

    public function listarUsuarios()
    {
        $nvlAcesso = isset($_SESSION['usuario']['id_tipo_usuario']) ? $_SESSION['usuario']['id_tipo_usuario'] : null;

        if (!is_null($nvlAcesso)) {
            $dados = $this->usuarioManager->listaUsuarios();
            require ('view/listarUsuarios.php');
        } else {
            echo 'Você não tem permissão para acessar essa página.';
            exit();
        }
    }

    public function detalharUsuario(){
        $tipos = $this->tipoUserManager->listaTipos();
        $usuario = $this->usuarioManager->buscaInfoUsuario($_GET['cpf']);
        require('view/detalheUsuario.php');
    }

    public function usuarioDetalhe(){
        if($_POST['acao'] == "Desativar"){
            $this->usuarioManager->desativaUsuario($_POST['cpf']);
        }
        elseif ($_POST['acao'] == "Alterar") {
            $nomeAlterado = $_POST['nome'];
            $enderecoAlterado = $_POST['endereco'];
            $telefoneAlterado = $_POST['telefone'];
            $emailAlterado = $_POST['email'];
            $cpfAlterado = $_POST['cpf'];

            $this->usuarioManager->alteraDados($cpfAlterado, $nomeAlterado, $enderecoAlterado, $telefoneAlterado, $emailAlterado);
        }
        elseif ($_POST['acao'] == "Salvar") {

        }
        $this->listarUsuarios();
    }

}