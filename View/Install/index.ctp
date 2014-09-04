<div class="install">
    <h2><?php echo $title_for_layout; ?></h2>
    <?php
    $check = true;

    // tmp is writable
    if (is_writable(TMP)) {
        echo '<p class="success">' . __d('croogo', 'Tu directorio temporal es escribible.') . '</p>';
    } else {
        $check = false;
        echo '<p class="error">' . __d('croogo', 'Tu directorio temporal no es escribible.') . '</p>';
    }

    // config is writable
    if (is_writable(APP . 'Config')) {
        echo '<p class="success">' . __d('croogo', 'Tu directorio de configuración es escribible.') . '</p>';
    } else {
        $check = false;
        echo '<p class="error">' . __d('croogo', 'Tu directorio de configuración no es escribible.') . '</p>';
    }

    // config is writable
    if (is_writable(APP . 'Controller')) {
        echo '<p class="success">' . __d('croogo', 'Tu directorio principal de Controller es escribible.') . '</p>';
    } else {
        $check = false;
        echo '<p class="error">' . __d('croogo', 'Tu directorio principal de Controller no es escribible.') . '</p>';
    }

    // config is writable
    if (is_writable(APP . 'Model')) {
        echo '<p class="success">' . __d('croogo', 'Tu directorio principal de Model es escribible.') . '</p>';
    } else {
        $check = false;
        echo '<p class="error">' . __d('croogo', 'Tu directorio principal de Model no es escribible.') . '</p>';
    }

    // php version
    $minPhpVersion = '5.3.10';
    $operator = '>=';
    if (version_compare(phpversion(), $minPhpVersion, $operator)) {
        echo '<p class="success">' . sprintf(__d('croogo', 'PHP version %s %s %s'), phpversion(), $operator, $minPhpVersion) . '</p>';
    } else {
        $check = false;
        echo '<p class="error">' . sprintf(__d('croogo', 'PHP version %s < %s'), phpversion(), $minPhpVersion) . '</p>';
    }

    // cakephp version
    $minCakeVersion = '2.5.0';
    $cakeVersion = Configure::version();
    $operator = '>=';
    if (version_compare($cakeVersion, $minCakeVersion, $operator)) {
        echo '<p class="success">' . __d('croogo', 'CakePhp version %s %s %s', $cakeVersion, $operator, $minCakeVersion) . '</p>';
    } else {
        $check = false;
        echo '<p class="error">' . __d('croogo', 'CakePHP version %s < %s', $cakeVersion, $minCakeVersion) . '</p>';
    }

    ?>
</div>
<?php
if ($check) {
    $out = $this->Html->link(__d('croogo', 'Instalar'), array(
        'action' => 'database',
    ), array(
        'button' => 'success',
        'tooltip' => array(
            'data-title' => __d('croogo', 'Click aqui para continuar con la instalación'),
            'data-placement' => 'left',
        ),
    ));
} else {
    $out = '<p>' . __d('croogo', 'La instalación no puede continuar hasta que se logren los requisitos minimos.') . '</p>';
}
echo $this->Html->div('form-actions', $out);
?>
