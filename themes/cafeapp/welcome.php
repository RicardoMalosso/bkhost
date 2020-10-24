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

    
        

        <?php foreach ($register as $umregister) : ?>
            <div class="app_formbox app_widget">
            <h4> Informações do registro <?= $umregister->register_name ?></h4><br/>
            Data de cadastramento inicial do domínio:  <?= date("d/m/Y", strtotime($umregister->creation)) ?><br/>
            Data de expiração do registro do domínio:  <?= date("d/m/Y", strtotime($umregister->expiration)) ?><br/>
            <br/>
            Contato do Administrador:  <?= $umregister->contact_admin ?><br/>
            Contato Técnico:  <?= $umregister->contact_technical ?><br/>
            Contato Financeiro:  <?= $umregister->contact_financial ?><br/>
            DNS 1:  <?= $umregister->dns_1 ?><br/>
            DNS 2:  <?= $umregister->dns_2 ?><br/>
            DNS 3:  <?= $umregister->dns_3 ?><br/>
            <br/>
            Notas do registro:
            <br/>  <?= $umregister->notes ?><br/>
            </div>
        <?php endforeach; ?>

    
</article>