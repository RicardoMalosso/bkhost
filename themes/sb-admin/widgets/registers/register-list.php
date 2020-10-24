<?php $v->layout("_admin"); ?>

<div class="container-fluid">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-pen-alt"></i>
            Gerenciar domínios para o usuário <?= $user->fullName() ?>
        </h1>
    </div>
    <div class="form-group col-md-6">
                        <a href="<?= url("/admin/registers/register/{$user->id}/new"); ?>" class="button">
                            <button class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                                <span class="text">Criar novo Registro</span>
                            </button>
                        </a>
                    </div>
    <?php if (empty($domain)) : ?>
        <div class="content content">
            <div class="empty_content">

                <h3 class="empty_content_title">Não há domínios Registrados para esse usuário!</h3>
                <p class="empty_content_desc">
                    :)</p>
            </div>
        </div>
    <?php else : ?>
        <section class="blog">
            <div class="blog_content container content">
                <div class="blog_articles">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nome do Registro</th>
                                <th scope="col">Status</th>
                                <th scope="col">Data de expiração</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($domain as $umdomain) : ?>
                                <?php $v->insert("widgets/registers/registers-por-usuario", ["umdomain" => $umdomain]); ?>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>