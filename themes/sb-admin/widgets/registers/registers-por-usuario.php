<div class="container-fluid">
    <tr>
        <th scope="row">

    <a href="<?= url("/admin/registers/register/{$umdomain->user_id}/{$umdomain->id}");?>">
        <?= $umdomain->register_name; ?>
    </a>
        </th>
        <td>
            <?=$umdomain->status;?>
        </td>

        <td>
            <?=date('d/m/Y', strtotime(($umdomain->expiration)));?>

        </td>
    </tr>

</div>
