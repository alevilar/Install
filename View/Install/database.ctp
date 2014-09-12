<?php
echo $this->Form->create(false, array(
	'url' => array(
		'plugin' => 'install',
		'controller' => 'install',
		'action' => 'database'
	),
));
?>
    <div class="install">
        <h2><?php echo __d('croogo', 'Paso 1: Base de datos.'); ?></h2>

        <table>
            <tr>
                <td>Tipo de Base de Datos</td>
                <td>
                    <?php
                    echo $this->Form->input('datasource', array(
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
                    echo $this->Form->input('host', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Host'),
                        'value' => '',

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
                        'placeholder' => __d('croogo', 'Usuario de Base de datos'),
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
                        'placeholder' => __d('croogo', 'Contraseña de Base de datos'),

                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Base de Datos</td>
                <td>
                    <?php
                    echo $this->Form->input('database', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Base de Datos'),
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
                        'type'=>'text',
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
                    echo $this->Form->input('port', array(
                        'type'=>'text',
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