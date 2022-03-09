<?php

    require_once __DIR__.'/vendor/autoload.php';

    define('TITLE','Editar vaga');

    use \App\Entity\Vaga;
    use \App\Session\Login;

    // Obriga o usuario a estar logado
    Login::requireLogin();

    // Validação do ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
        header('location: index.php?status=error');
        exit;
    }

    // Consulta vaga
    $obVaga = Vaga::getVaga($_GET['id']);
    
    // Validação a vaga
    if(!$obVaga instanceof Vaga ) {
        header('Location: index.php?status=error');
        exit;
    }

    // Validation 
    if(isset($_POST['title'],$_POST['descripition'], $_POST['acttive'])) {

        $obVaga->title         = $_POST['title'];
        $obVaga->descripition   = $_POST['descripition'];
        $obVaga->acttive       = $_POST['acttive'];
         $obVaga->atuliazar();

        header('Location: index.php?status=success');
        exit;
    }

    include __DIR__ .'/includes/header.php';
    include __DIR__.'/includes/formulario.php';
    include __DIR__ .'/includes/footer.php';