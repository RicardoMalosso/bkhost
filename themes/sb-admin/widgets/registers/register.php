<?php $v->layout("_admin"); ?>
<div class="container-fluid">,
    <?php if (!$register) : ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-pen-alt"></i>
                Novo Domínio de <?= $user->fullName(); ?>
            </h1>
        </div>
        
        <form action="<?= url("/admin/registers/register"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create" />
            <input type="hidden" name="user_id" id="user_id" value="<?= $user->id ?>"/>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="register_name">Nome do Novo Domínio</label>
                    <input type="text" name="register_name" id="register_name" placeholder="Nome do Domínio" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="creation">Data de Criação</label>
                    <input type="text" name="creation" id="creation" placeholder="dd/mm/yyyy" class="mask-date form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="expiration">Data que Expira</label>
                    <input type="text" name="expiration" id="expiration" placeholder="dd/mm/yyyy" class="mask-date form-control">
                </div>
            </div>

<!--             <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="contact_admin">Id do Administrador</label>
                    <input type="text" name="contact_admin" id="contact_admin" placeholder="Id do Administrador" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="contact_technical">Id do Técnico</label>
                    <input type="text" name="contact_technical" id="contact_technical" placeholder="Id do Técnico" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="contact_financial">Id do Financeiro</label>
                    <input type="text" name="contact_financial" id="contact_financial" placeholder="Id do Financeiro" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="dns_1">DNS 1</label>
                    <input type="text" name="dns_1" id="dns_1" placeholder="DNS 1" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="dns_2">DNS 2</label>
                    <input type="text" name="dns_2" id="dns_2" placeholder="DNS 2" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="dns_3">DNS 3</label>
                    <input type="text" name="dns_3" id="dns_3" placeholder="DNS 3" class="form-control">
                </div>
            </div> -->

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active">Ativo</option>
                        <option value="inactive">Inativo</option>
                        <option value="published">Publicado</option>
                        <option value="Aguardando Publicação">Aguardando Publicação</option>
                        <option value="congelado">Congelado</option>
                        <option value="aguardando congelamento">Aguardando Congelamento</option>
                        <option value="congelado por ordem judicial">Congelado por ordem judicial</option>
                        <option value="processo de liberação">Processo de liberação</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="notes">Notas do registro (Logins, Senhas, outras informações úteis)</label>
                    <textarea class="mce" name="notes" id="notes" rows="5" ><?php echo $register?$register->notes:''; ?></textarea>
                </div>
            </div>

            <div class="form-group text-right">
                <button class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Cadastrar</span>
                </button>
            </div>
        </form>

    <?php else : ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-pen-alt"></i>
                Atualizando domínio de <?= $user->fullName(); ?>
            </h1>
        </div>

        <form action="<?= url("/admin/registers/register/{$register->user_id}/{$register->id}"); ?>" method="post">

            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="update" />


            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="register_name">Nome do Domínio</label>
                    <input type="text" name="register_name" id="register_name" value="<?= $register->register_name; ?>" placeholder="Nome do Domínio" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="creation">Data de Criação</label>
                    <input type="text" name="creation" id="creation" value="<?= date_fmt($register->creation, "d/m/Y"); ?>" placeholder="dd/mm/yyyy" class="mask-date form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="expiration">Data que Expira</label>
                    <input type="text" name="expiration" id="expiration" value="<?= date_fmt($register->expiration, "d/m/Y"); ?>" placeholder="dd/mm/yyyy" class="mask-date form-control">

                </div>
            </div>
<!-- 
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="contact_admin">Id do Administrador</label>
                    <input type="text" name="contact_admin" id="contact_admin" value="<?= $register->contact_admin; ?>" placeholder="Id do Administrador" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="contact_technical">Id do Técnico</label>
                    <input type="text" name="contact_technical" id="contact_technical" value="<?= $register->contact_technical; ?>" placeholder="Id do Técnico" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="contact_financial">Id do Financeiro</label>
                    <input type="text" name="contact_financial" id="contact_financial" value="<?= $register->contact_financial; ?>" placeholder="Id do Financeiro" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="dns_1">DNS 1</label>
                    <input type="text" name="dns_1" id="dns_1" value="<?= $register->dns_1; ?>" placeholder="DNS 1" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="dns_2">DNS 2</label>
                    <input type="text" name="dns_2" id="dns_2" value="<?= $register->dns_2; ?>" placeholder="DNS 2" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="dns_3">DNS 3</label>
                    <input type="text" name="dns_3" id="dns_3" value="<?= $register->dns_3; ?>" placeholder="DNS 3" class="form-control">
                </div>
            </div> -->

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <?php
                        $status = $user->status;
                        $select = function ($value) use ($status) {
                            return ($status == $value ? "selected" : "");
                        };
                        ?>
                        <option value="active">Ativo</option>
                        <option value="inactive">Inativo</option>
                        <option value="published">Publicado</option>
                        <option value="Aguardando Publicação">Aguardando Publicação</option>
                        <option value="congelado">Congelado</option>
                        <option value="aguardando congelamento">Aguardando Congelamento</option>
                        <option value="congelado por ordem judicial">Congelado por ordem judicial</option>
                        <option value="processo de liberação">Processo de liberação</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="notes">Notas do registro (Logins, Senhas, outras informações úteis)</label>
                    <textarea class="mce" name="notes" id="notes" rows="5" ><?php echo $register?$register->notes:''; ?></textarea>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <a href="#" class="btn btn-danger btn-icon-split" data-post="<?= url("/admin/registers/register/{$register->user_id}/{$register->id}"); ?>" data-action="delete" data-confirm="ATENÇÃO: Tem certeza que deseja excluir o Registro e todos os dados relacionados a ele? Essa ação não pode ser feita!" data-user_id="<?= $user->id; ?>">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Excluir</span>
                    </a>
                </div>
                <div class="form-group col-md-6 text-right">
                    <button type="submit" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Atualizar o registro</span>
                    </button>
                </div>
            </div>
        </form>
    <?php endif; ?>

</div>