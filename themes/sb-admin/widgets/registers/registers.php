<?php $v->layout("_admin"); ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-pen-alt"></i>
            Gerenciar domínios do Cliente <?= $user->fullName() ?>
        </h1>
    </div>
<form>
<?php if (empty($domain)): ?>
    <div class="content content">
        <div class="empty_content">

            <h3 class="empty_content_title">Não há domínios Registrados para esse usuário!</h3>
            <p class="empty_content_desc">
                :)</p>
        </div>
    </div>
<?php else: ?>
    <section class="blog">
        <div class="blog_content container content">
            <header class="blog_header">
                <h4>Dominios</h4>
            </header>
            <p class="meta">

            </p>
            <div class="blog_articles">
                <?php foreach ($domain as $umdomain): ?>
                    <?php $v->insert("widgets/registers/register-list", ["umdomain" => $umdomain]); ?>

                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <button>criar novo</button>

</form>
