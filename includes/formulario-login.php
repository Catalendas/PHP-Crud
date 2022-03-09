<?php

$alertaLogin = strlen($alertaLogin) ? '<div class="alert alert-danger">'.$alertaLogin.'</div>' : '';
$alertaCadastro = strlen($alertaCadastro) ? '<div class="alert alert-danger">'.$alertaCadastro.'</div>' : '';

?>

<div class="container text-dark bg-light py-4">

    <div class="row">

        <div class="col">

            <form method="post">

                <h2>Login</h2>

                <?=$alertaLogin?>

                <div class="form-group">

                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>

                </div>

                <div class="form-group">

                    <label for="">Senha</label>
                    <input type="password" name="senha" class="form-control" required>

                </div>

                <div class="form-group mt-3">

                    <button type="submit" name="acao" value="logar" class="btn btn-primary">Entrar</button>

                </div>

            </form>

        </div>

        <div class="col">
            
            <form method="post">

            <h2>Cadastrar</h2>

            <?=$alertaCadastro?>

            <div class="form-group ">

                <label class="form-label">Nome</label>
                <input type="text" name="name"    class="form-control" required>

            </div>

            <div class="form-group ">

                <label class="form-label">Email</label>
                <input type="email" name="email"    class="form-control" required>

            </div>

            <div class="form-group">

                <label for="">Senha</label>
                <input type="password" name="senha" class="form-control" required>

            </div>

            <div class="form-group mt-3">

                <button type="submit" name="acao" value="cadastrar" class="btn btn-primary">Cadastrar</button>

            </div>

            </form>

        </div>

    </div>

</div>