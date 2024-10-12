<?php
if(!function_exists('get_field')) {
    return '';
}

$pack_params = get_field('pack_params', 'options');
$packages    = get_field('s_packages', 'options');

foreach ($packages as &$package) {
    $params = [];

    foreach ($package['params'] as $index => $param) {
        $params[$param['pack_param']] = $param['value'];
    }

    $package['params'] = $params;

    unset($package);
}
?>
<div class="s-packages-wrapper">
    <table class="">
        <thead>
<!--            <tr>-->
<!--                <td>УСЛУГА</td>-->
<!--                <td colspan="4">ПАКЕТЫ УСЛУГ</td>-->
<!---->
<!--            </tr>-->
            <tr>
                <td></td>
                <?php foreach ($packages as $package): ?>
                    <td><?= $package['name'] ?: '' ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($pack_params as $pack_param): ?>
            <tr>
                <td>
                    <span class="text-m-d" data-desktop="<?= $pack_param['name_pc']?>" data-mobile="<?= $pack_param['name_mobile'] ?>"></span>
                    <?php if(!empty($pack_param['description'])): ?>
                        <span class="fa fa-question-circle-o" data-tooltip-html="<?= $pack_param['description'] ?>"></span>
                    <?php endif; ?>
                </td>
                <?php foreach ($packages as $package): ?>
                    <td>
                        <?php if(!empty($package['params'][$pack_param['slug']])): ?>
                        <?= $package['params'][$pack_param['slug']] ?>
                        <?php else: ?>
                        <span class="fa fa-close"></span>
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>