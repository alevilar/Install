<?php

echo $this->Form->create('User', array(
	'url' => array('controller' => 'install', 'action' => 'adminuser'),'id'=>'AdminUser'
	));
?>
    <div class="install">
        <h2><?php echo __d('croogo', 'Paso 3: Crear un Usuario Admin.'); ?></h2>
        <table>
            <tr>
                <td>Usuario</td>
                <td>
                    <?php
                    echo $this->Form->input('email', array(
                    'label' => __d('users', 'E-mail (used as login)'),
                    'error' => array('isValid' => __d('users', 'Must be a valid email address'),
                    'isUnique' => __d('users', 'An account with that email already exists'))));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td>
                    <?php
                    echo $this->Form->input('password', array(
                        'label' => false,
                        'type' => 'password',
                        'placeholder' => __d('croogo', 'Contraseña de Usuario'),
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Verificar Contraseña</td>
                <td>
                    <?php
                    echo $this->Form->input('verify_password', array(
                        'label' => false,
                        'type' => 'password',
                        'placeholder' => __d('croogo', 'Verificar Contraseña de Base de datos'),

                    ));
                    ?>
                </td>
            </tr>
        </table>
    </div>
<div class="form-actions">
	<?php echo $this->Form->submit(__d('croogo', 'Guardar'), array('class' => 'btn btn-success', 'div' => false)); ?>
	<?php echo $this->Html->link(__d('croogo', 'Cancelar'), array('admin'=>false,'plugin'=>'install','controller'=>'install','action' => 'cancel'), array( 'class' => 'btn btn-danger', 'div' => false)); ?>
</div>
<?php
	echo $this->Form->end();
