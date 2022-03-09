<?php

  use \App\Session\Login;

  // Dodos do usuario logado
  $usuarioLogado = Login::getUsuarioLogado();

  // Detalhes do usuario
  $usuario = $usuarioLogado ?  $usuarioLogado['name'].' <a href="logout.php" class="text-light font-weight-bold ml-2">Sair</a>' :
  
  'Visitante <a href="login.php" class="text-light font-weight-bold ml-2">Entrar</a>';

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Vagas</title>
  </head>
  <body class="bg-dark text-light">

    <div class="container">

    <div class="container bg-danger">
        <h1>Web vagas</h1>
        <p>Exemplo crud Orientado a Objetos</p>

        <hr class="border-light">

        <div class="d-flex justify-content-start">
          <?=$usuario?>
        </div>
    </div>
    
    
