<?php

    require_once __DIR__.'/vendor/autoload.php';

    use \App\Entity\Vaga;

    use \App\Db\Pagination;

    use \App\Session\Login;

    // Obriga o usuario a estar logado
    Login::requireLogin();

    // Busca
    $busca = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

     // filtro status
     $filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
     $filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';
    

    // COndicoes SQL
    $condicoes = [

        strlen($busca) ? 'title LIKE "%'.str_replace(' ', '%',$busca).'%"' : null,
        strlen($filtroStatus) ? 'acttive = "'.$filtroStatus.'"' : null

    ];

    // Remove posições vazias
    $condicoes = array_filter($condicoes);
    
    //Clausula where
    $where = implode(' AND ',$condicoes);

    // Quantidade todal de vagas
    $quantidadeVagas = Vaga::getQuantidadeVagas($where);
   

    // // Paginação
     $obPagination = new Pagination($quantidadeVagas, $_GET['pagina'] ?? 1, 5);
     

    // Obtem as vagas
    $vagas = Vaga::getVagas($where, null, $obPagination->getLimit());
    

    include __DIR__ .'/includes/header.php';
    include __DIR__.'/includes/listagem.php';
    include __DIR__ .'/includes/footer.php';