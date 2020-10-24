<?php $v->layout("_theme"); ?>
<article class="app_signature radius">
    <header class="app_signature_header">
        <h2>Olá <?= "{$user->first_name}"; ?></h2><br>
        <h2>Informações gerais da conta:</h2><br>
        <p>Nome Completo: <?= "{$user->first_name} {$user->last_name}"; ?><br>
            Endereço: <?= "{$user->street}, {$user->number} {$user->complement}"; ?><br>
            Cidade: <?= "{$user->city}, {$user->state}"; ?><br>
            CEP: <?= "{$user->zip}"; ?><br>
            País: <?= "{$user->country}"; ?><br><br>
            Email para notificação: <?= "{$user->email}"; ?><br>
            Telefone para contato: <?= "{$user->phone}"; ?><br/><br/>
            <h2>Meus Registros</h2>
    </header>

    
        
    <?php if ($register) : ?>
        <?php foreach ($register as $umregister) : ?>
            <div class="app_formbox app_widget">
            <h4> Domínio (<?= $umregister->register_name ?>) </h4><br/>
            Período:  <?= date("d/m/Y", strtotime($umregister->creation)) ?>
             a  <?= date("d/m/Y", strtotime($umregister->expiration)) ?>
             <br/><br/>
             <hr width="75%" />
            <br/>            
            <br/>  <?php echo $umregister->notes ? html_entity_decode($umregister->notes) : ''; ?><br/>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    
</article>