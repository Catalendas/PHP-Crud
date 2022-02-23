<main>

    <section>
        <a href="index.php">
            <button class="btn btn-success">voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="post">

        <div class="form-group">
            <label>Titulo</label>
            <input type="text" class="form-control" name="title" value="<?=$obVaga->title?>">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descripition" class="form-control" rows="5"><?=$obVaga->descripition?></textarea>
        </div>

        <div class="form-group">
            <label>Status</label>

            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="acttive" value="s" checked>Ativo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="acttive" value="n" <?=$obVaga->acttive == 'n' ? 'checked' : ''?>>Inativo
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
        

    </form>

</main>