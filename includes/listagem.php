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

                                                        </tr>'
?>

<main>

    <?=$mensagem?>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova vaga</button>
        </a>
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

</main>