<?php

    require_once __DIR__.'/vendor/autoload.php';

    use \App\Entity\Vaga;

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
    if(isset($_POST['excluir'])) {

    
         $obVaga->excluir();

        header('Location: index.php?status=success');
        exit;
    }

    include __DIR__ .'/includes/header.php';
    include __DIR__.'/includes/confirmar-exclusao.php';
    include __DIR__ .'/includes/footer.php';