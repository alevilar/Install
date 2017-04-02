<div class="install">
    <h2><?php echo $title_for_layout; ?></h2>
    <?php
    $check = true;

    // tmp is writable
    if (is_writable(TMP)) {
        echo '<div class="alert alert-success" role="alert">' . __d('croogo', 'Tu directorio temporal es escribible.') . '</div>';
    } else {
        $check = false;
        echo '<div class="alert alert-danger" role="alert">' . __d('croogo', 'Tu directorio temporal no es escribible.') . '</div>';
    }

    // config is writable
    if (is_writable(APP . 'Config')) {
        echo '<div class="alert alert-success" role="alert">' . __d('croogo', 'Tu directorio de configuración es escribible.') . '</div>';
    } else {
        $check = false;
        echo '<div class="alert alert-danger" role="alert">' . __d('croogo', 'Tu directorio de configuración no es escribible.') . '</div>';
    }

    // controller is writable
    if (is_writable(APP . 'Controller')) {
        echo '<div class="alert alert-success" role="alert">' . __d('croogo', 'Tu directorio principal de Controller es escribible.') . '</div>';
    } else {
        $check = false;
        echo '<div class="alert alert-danger" role="alert">' . __d('croogo', 'Tu directorio principal de Controller no es escribible.') . '</div>';
    }

    // config is writable
    if (is_writable(APP . 'Model')) {
        echo '<div class="alert alert-success" role="alert">' . __d('croogo', 'Tu directorio principal de Model es escribible.') . '</div>';
    } else {
        $check = false;
        echo '<div class="alert alert-danger" role="alert">' . __d('croogo', 'Tu directorio principal de Model no es escribible.') . '</div>';
    }

    // config is writable

    if (is_writable(APP . 'Tenants')) {
        echo '<div class="alert alert-success" role="alert">' . __d('croogo', 'Tu directorio principal de Tenants es escribible.') . '</div>';
    } else {
        $check = false;
        echo '<div class="alert alert-danger" role="alert">' . __d('croogo', 'Tu directorio principal de Tenants no es escribible.') . '</div>';
    }

    // php version
    $minPhpVersion = '5.3.10';
    $operator = '>=';
    if (version_compare(phpversion(), $minPhpVersion, $operator)) {
        echo '<div class="alert alert-success" role="alert">' . sprintf(__d('croogo', 'PHP version %s %s %s'), phpversion(), $operator, $minPhpVersion) . '</div>';
    } else {
        $check = false;
        echo '<div class="alert alert-danger" role="alert">' . sprintf(__d('croogo', 'PHP version %s < %s'), phpversion(), $minPhpVersion) . '</div>';
    }

    // cakephp version
    $minCakeVersion = '2.5.0';
    $cakeVersion = Configure::version();
    $operator = '>=';
    if (version_compare($cakeVersion, $minCakeVersion, $operator)) {
        echo '<div class="alert alert-success" role="alert">' . __d('croogo', 'CakePhp version %s %s %s', $cakeVersion, $operator, $minCakeVersion) . '</div>';
    } else {
        $check = false;
        echo '<div class="alert alert-danger" role="alert">' . __d('croogo', 'CakePHP version %s < %s', $cakeVersion, $minCakeVersion) . '</div>';
    }

    ?>
</div>
<?php
if ($check) {
    $out = $this->Html->link(__d('croogo', 'Instalar'), array(
        'action' => 'database',
    ), array(
        'class' => 'btn btn-success',
        'tooltip' => array(
            'data-title' => __d('croogo', 'Click aqui para continuar con la instalación'),
            'data-placement' => 'left',
        ),
    ));
} else {
    $out = '<div class="alert alert-danger" role="alert">' . __d('croogo', 'La instalación no puede continuar hasta que se logren los requisitos minimos.') . '</div>';
}

echo $this->Html->div('form-actions', $out);
?>
