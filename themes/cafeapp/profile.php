<?php $v->layout("_theme"); ?>

<div class="app_formbox app_widget">
    <form class="app_form" action="<?= url("/app/profile"); ?>" method="post">
        <input type="hidden" name="update" value="true"/>

        <div class="app_formbox_photo">
            <div class="rounded j_profile_image thumb" style="background-image: url('<?= $photo; ?>')"></div>
            <div><input data-image=".j_profile_image" type="file" class="radius"  name="photo"/></div>
        </div>

        <div class="label_group">
            <label>
                <span class="field icon-user">Nome:</span>
                <input class="radius" type="text" name="first_name" required
                       value="<?= $user->first_name; ?>"/>
            </label>

            <label>
                <span class="field icon-user-plus">Sobrenome:</span>
                <input class="radius" type="text" name="last_name" required
                       value="<?= $user->last_name; ?>"/>
            </label>
        </div>

        <label>
            <span class="field icon-briefcase">Genero:</span>
            <select name="genre" required>
                <option value="">Selecione</option>
                <option <?= ($user->genre == "male" ? "selected" : ""); ?> value="male">&ofcir; Masculino</option>
                <option <?= ($user->genre == "female" ? "selected" : ""); ?> value="female">&ofcir; Feminino</option>
                <option <?= ($user->genre == "other" ? "selected" : ""); ?> value="other">&ofcir; Outro</option>
            </select>
        </label>

        <div class="label_group">
            <label>
                <span class="field icon-user">Endereço:</span>
                <input class="radius" type="text" name="street" required
                       value="<?= $user->street; ?>"/>
            </label>

            <label>
                <span class="field icon-user">Número:</span>
                <input class="radius" type="text" name="number" required
                       value="<?= $user->number; ?>"/>
            </label>
        </div>

        <div class="label_group">
            <label>
                <span class="field icon-user">Complemento:</span>
                <input class="radius" type="text" name="complement" required
                       value="<?= $user->complement; ?>"/>
            </label>

            <label>
                <span class="field icon-user">Cidade:</span>
                <input class="radius" type="text" name="city" required
                       value="<?= $user->city; ?>"/>
            </label>
        </div>

        <div class="label_group">
            <label>
                <span class="field icon-user">Estado:</span>
                <input class="radius" type="text" name="state" required
                       value="<?= $user->state; ?>"/>
            </label>

            <label>
                <span class="field icon-user">CEP:</span>
                <input class="radius" type="text" name="zip" required
                       value="<?= $user->zip; ?>"/>
            </label>
        </div>


        <div class="label_group">
            <label>
                <span class="field icon-user">País:</span>
                <input class="radius" type="text" name="country" required
                       value="<?= $user->country; ?>"/>
            </label>

            <label>
                <span class="field icon-user">Telefone:</span>
                <input class="radius" type="text" name="phone" required
                       value="<?= $user->phone; ?>"/>
            </label>
        </div>

        <div class="label_group">
            <label>
                <span class="field icon-calendar">Nascimento:</span>
                <input class="radius mask-date" type="text" name="datebirth" placeholder="dd/mm/yyyy" required
                       value="<?= ($user->datebirth ? date_fmt($user->datebirth, "d/m/Y") : null); ?>"/>
            </label>

            <label>
                <span class="field icon-briefcase">CPF:</span>
                <input class="radius mask-doc" type="text" name="document" placeholder="Apenas números" required
                       value="<?= $user->document; ?>"/>
            </label>
        </div>

        <label>
            <span class="field icon-envelope">E-mail:</span>
            <input class="radius" type="email" name="email" placeholder="Seu e-mail de acesso" readonly
                   value="<?= $user->email; ?>"/>
        </label>

        <div class="label_group">
            <label>
                <span class="field icon-unlock-alt">Senha:</span>
                <input class="radius" type="password" name="password" placeholder="Sua senha de acesso"/>
            </label>

            <label>
                <span class="field icon-unlock-alt">Repetir Senha:</span>
                <input class="radius" type="password" name="password_re" placeholder="Sua senha de acesso"/>
            </label>
        </div>

        <div class="al-center">
            <div class="app_formbox_actions">
                <button class="btn btn_inline radius transition icon-pencil-square-o">Atualizar</button>
            </div>
        </div>
    </form>
</div>