<?php

    $mensagem = '';
    if(isset($_GET['status'])) {
        switch($_GET['status']) {
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação esecutada com sucesso!</div>';
                break;
            
            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
                break;    
        }
    }

    $resultados = '';
    foreach($vagas as $vaga) {
        $resultados.= '<tr>
                            <td>'.$vaga->id.'</td>
                            <td>'.$vaga->title.'</td>
                            <td>'.$vaga->descripition.'</td>
                            <td>'.($vaga->acttive == 's' ? 'Ativo' : 'Inativo').'</td>
                            <td>'.date('d/m/y à\s H:i:s',strtotime($vaga->dia)).'</td>
                            <td>
                                <a href="editar.php?id='.$vaga->id.'"><button type="button" class="btn btn-primary">Editar</button></a>
                                <a href="excluir.php?id='.$vaga->id.'"><button type="button" class="btn btn-danger">Excluir</button></a>
                            </td>
                    </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : '<tr>

                                                            <td colspan="6" class="text-center">Nenhuma va encontrada</td>

                                                        </tr>';

    // Gets
    unset($_GET['status']);
    unset($_GET['pagina']);

    $gets = http_build_query($_GET);

    // Paginação
    $paginacao = '';
    $paginas = $obPagination->getPages();
    foreach($paginas as $key => $pagina) {
        $class = $pagina['atual'] ? 'btn-primary' : 'btn-light';
        $paginacao .= '<a href="?pagina='.$pagina['pagina'].'&'. $gets.'">
                            <button type="button" class="btn '.$class.'">'.$pagina['pagina'].'</button>
                        </a>';
    }                                        
?>

<main>

    <?=$mensagem?>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova vaga</button>
        </a>
    </section>

    <section>

        <form method="get">

            <div class="row my-4">

                <div class="col">

                    <label for="">Buscar por titulo</label>
                    <input type="text" name="search" class="form-control" value="<?=$busca?>">

                </div>

                <div class="col">
                    <label for="">Status</label>

                    <select name="filtroStatus" class="form-control">

                        <option value="">Ativa/Inativa</option>
                        <option value="s" <?=$filtroStatus == 's' ? 'selected' : ' '?>>Ativa</option>
                        <option value="n" <?=$filtroStatus == 'n' ? 'selected' : ' '?>>Inativa</option>

                    </select>

                </div>

                <div class="col d-flex align-items-end">

                    <button type="submit" class="btn btn-primary">Filtrar</button>

                </div>

            </div>

        </form>

    </section>

    <section>

        <table class="table bg-light mt-3">
            <thead>

                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>

            </thead>
                <?=$resultados?>
            <tbody>



            </tbody>
        </table>

    </section>

    <section>

        <?=$paginacao?>

    </section>

</main>