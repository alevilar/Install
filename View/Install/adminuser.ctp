<?php
if(empty($this->request->data))
{


echo $this->Form->create(null, array(
	'url' => array('controller' => 'install', 'action' => 'adminuser'),
	));
?>


    <div class="install">
        <?php echo __d('croogo', 'Nota: Por defecto se creo el usuario admin con contraseña admin, sin embargo usted puede crear otro usuario personalizado.'); ?>

        <h2><?php echo __d('croogo', 'Paso 3: Crear un Usuario Admin.'); ?></h2>

        <table>

            <tr>
                <td>Host</td>
                <td>
                    <?
                    echo $this->Form->input('User.username', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Nombre de Usuario'),
                        'value' => '',

                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td>
                    <?php
                    echo $this->Form->input('User.password', array(
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
                    <?
                    echo $this->Form->input('User.verify_password', array(
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
	<?php echo $this->Html->link(__d('croogo', 'Cancelar'), array('action' => 'index'), array( 'class' => 'btn btn-danger')); ?>
</div>
<?php
	echo $this->Form->end();

}
else
{
 ?>
    <?php echo $this->Html->link(__d('croogo', 'Ingresar'), array('admin'=>false,'plugin'=>false,'controller'=>'users','action' => 'login'), array( 'class' => 'success')); ?>
<?php
}
    ?>