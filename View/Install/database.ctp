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
                <td>Tipo de Base de Datos</td>
                <td>
                    <?php
                    echo $this->Form->input('Install.datasource', array(
                        'default' => 'Database/Mysql',
                        'label'=>false,
                        'options' => array(
                            'Database/Mysql' => 'mysql',
                            'Database/Sqlite' => 'sqlite',
                            'Database/Postgres' => 'postgres',
                            'Database/Sqlserver' => 'mssql',
                        ),
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Host</td>
                <td>
                    <?php
                    echo $this->Form->input('Install.host', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Host'),
                        'value' => ''
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Usuario</td>
                <td>
                    <?php
                    echo $this->Form->input('Install.login', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Usuario de Base de datos'),
                    ));
                    ?>
                </td>

            </tr>
            <tr>
                <td>Contraseña</td>
                <td>
                    <?php
                    echo $this->Form->input('Install.password', array(
                        'label' => false,
                        'type'=>'password',
                        'placeholder' => __d('croogo', 'Contraseña de Base de datos'),
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Base de Datos</td>
                <td>
                    <?php
                    echo $this->Form->input('Install.database', array(
                        'placeholder' => __d('croogo', 'Base de Datos'),
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
                    echo $this->Form->input('Install.prefix', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Prefijo'),
                        'value' => '',
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Puerto</td>
                <td>
                    <?php
                    echo $this->Form->input('Install.port', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Prefijo'),
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