<?php

    require_once __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;
    use \App\Session\Login;


    // Obriga o usuario a não estar logado
    Login::requireLogout();

    // Mensagem de alerta nos formularios
    $alertaLogin = '';
    $alertaCadastro = '';

    // Validação do POST
    if(isset($_POST['acao'])){

        switch($_POST['acao']){
            case 'logar':

                // Busca o usuario por email
                $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);

                // Valida a instancia e a senha
                if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'], $obUsuario->senha)) {
                    $alertaLogin = 'E-mail ou senhas invalidos';
                    break;
                }
               
                // Loga o usuario
                Login::login($obUsuario);

                break;
            
            case 'cadastrar':
                
                // Validação dos campos obrigatórios
                if(isset($_POST['name'],$_POST['senha'],$_POST['email'])){
                   
                    // Busca o usuario por email
                    $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
                    if($obUsuario instanceof Usuario) {
                        $alertaCadastro = 'O email digitado já está em uso';
                        break;
                    }

                    // Novo usuario

                    $obUsuario = new Usuario();
                    $obUsuario->nome = $_POST['name'];
                    $obUsuario->email = $_POST['email'];
                    $obUsuario->senha = password_hash( $_POST['senha'], PASSWORD_DEFAULT);
                    $obUsuario->cadastrar();
                   
                     // Loga o usuario
                    Login::login($obUsuario);

                }

                break;    
        }
    }

   

    include __DIR__ .'/includes/header.php';
    include __DIR__.'/includes/formulario-login.php';
    include __DIR__ .'/includes/footer.php';