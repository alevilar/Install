<?php
echo $this->Form->create('Install', array(
	'url' => array(
		'plugin' => 'install',
		'controller' => 'install',
		'action' => 'database'
	),
    'id'=>'Database',
    'novalidate'=>'true'
));
?>
    <div class="install">
        <h2><?php echo __d('croogo', 'Paso 1: Base de datos.'); ?></h2>
        <table>
            <tr>
                <td>La Base de Datos debe ser</td>
                <td>
                    <span class="text-danger">MySql</span>
                    <?php 
                    echo $this->Form->hidden('datasource', array(
                            'value' => Configure::read('Risto.dataSourceType') 
                            )); ?>
                </td>
            </tr>
            <tr>
                <td>Host</td>
                <td>
                    <?php
                    echo $this->Form->input('host', array(
                        'label' => false,
                        'placeholder' => __d('install', 'Host'),
                        'default' => 'localhost',
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Usuario</td>
                <td>
                    <?php
                    echo $this->Form->input('login', array(
                        'label' => false,
                        'placeholder' => __d('install', 'Usuario de Base de datos'),
                    ));
                    ?>
                </td>

            </tr>
            <tr>
                <td>Contraseña</td>
                <td>
                    <?php
                    echo $this->Form->input('password', array(
                        'label' => false,
                        'type'=>'password',
                        'placeholder' => __d('install', 'Contraseña de Base de datos'),
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Base de Datos</td>
                <td>
                    <?php
                    echo $this->Form->input('database', array(
                        'placeholder' => __d('instal', 'Base de Datos'),
                        'label' => false,
                        'value' => '',
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Prefijo</td>
                <td>
                    <?php
                    echo $this->Form->input('prefix', array(
                        'label' => false,
                        'placeholder' => __d('install', 'Prefijo'),
                        'value' => '',
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Puerto</td>
                <td>
                    <?php
                    echo $this->Form->input('port', array(
                        'label' => false,
                        'placeholder' => __d('install', 'Puerto'),
                        'value' => '',
                    ));
                    ?>
                </td>
            </tr>

        </table>
    </div>

<div class="form-actions">
	<?php echo $this->Form->submit('Continuar', array('button' => 'success', 'div' => false, 'class'=>'btn btn-success')); ?>
    <?php echo $this->Html->link(__d('croogo', 'Cancelar'), array('admin'=>false,'plugin'=>'install','controller'=>'install','action' => 'cancel'), array( 'class' => 'btn btn-danger')); ?>
</div>
<?php echo $this->Form->end(); ?>