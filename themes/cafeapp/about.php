<?php $v->layout("_theme"); ?>

    <section class="faq">
        <div class="faq_content content container">
            <header class="faq_header">
                <h3>Perguntas frequentes: (Faq´s)</h3>
                <p>Confira as principais dúvidas e repostas sobre os serviços da BKhost.</p>
            </header>
            <div class="faq_asks">
                <?php foreach ($faq as $question): ?>
                    <article class="faq_ask j_collapse">
                        <h4 class="j_collapse_icon icon-plus"><?= $question->question; ?></h4>
                        <div class="faq_ask_coll j_collapse_box"><?= $question->response; ?></div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
