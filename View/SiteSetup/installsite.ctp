<?php
    echo $this->Form->create('Site', array(
        'url' => array('controller' => 'site_setup', 'action' => 'installsite'),'id'=>'SiteSetup'
    ));
    ?>
    <div class="install">
        <h2><?php echo __d('install', 'Crear Nuevo Comercio'); ?></h2>

        <table>
            <tr>
                <td>
                <?php
                echo $this->Form->input('name', array(
                    'label' => __d('install', 'Nombre'),
                    'placeholder' => __d('install', 'Ej: Mc Burger'),

                ));

                echo $this->Form->input('country_code', array(
                    'label' => __d('install','País'),
                    'options' => $country_codes,
                ));
                ?>
            </td>

            </tr>

        <tr>
            <td>
                <?php
                $options = array(
                    'restaurante' => 'Restaurante',
                    'hotel' => 'Hotel',
                    'generic' => 'Generic'
                );

                $attributes = array(
                    'legend' => false,
                    'value' => ""
                );

                echo $this->Form->radio('type', $options, $attributes);
                ?>
            </td>
        </tr>
        </table>
    </div>
    <div class="form-actions">
        <?php echo $this->Form->submit(__d('install', 'Guardar'), array('class' => 'btn btn-success', 'div' => false)); ?>
        <?php echo $this->Html->link(__d('install', 'Cancelar'), '/', array( 'class' => 'btn cancel')); ?>
    </div>

<?php
echo $this->Form->end();
?>