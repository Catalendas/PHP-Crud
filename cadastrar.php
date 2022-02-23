<?php

    require_once __DIR__.'/vendor/autoload.php';

    define('TITLE','Cadastrar vaga');
    use \App\Entity\Vaga;
    $obVaga = new Vaga;

    // Validation 
    if(isset($_POST['title'],$_POST['descripition'], $_POST['acttive'])) {

        $obVaga->title         = $_POST['title'];
        $obVaga->descripition   = $_POST['descripition'];
        $obVaga->acttive       = $_POST['acttive'];
        $obVaga->cadastrar();

        header('Location: index.php?status=success');
        exit;
    }

    include __DIR__ .'/includes/header.php';
    include __DIR__.'/includes/formulario.php';
    include __DIR__ .'/includes/footer.php';