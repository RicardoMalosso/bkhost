<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
        <meta name="mit" content="2019-12-30T08:07:00-03:00+50889">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

<!--    <link rel="icon" type="image/png" href="--><?//= theme("/assets/images/favicon.png"); ?><!--"/>-->
    <link rel="stylesheet" href="<?= theme("/assets/style.css"); ?>"/>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<!--CONTENT-->
<main class="main_content">
    <?= $v->section("content"); ?>
</main>

<script src="<?= theme("/assets/scripts.js"); ?>"></script>
<?= $v->section("scripts"); ?>

</body>
</html>