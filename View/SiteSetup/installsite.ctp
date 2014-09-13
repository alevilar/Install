<?php
    echo $this->Form->create(null, array(
        'url' => array('controller' => 'siteSetup', 'action' => 'installsite'),
    ));
    ?>
    <div class="install">
        <h2><?php echo __d('install', 'Crear Nuevo Comercio'); ?></h2>

        <table>
            <tr>
                <td>
                <?php
                echo $this->Form->input('Site.name', array(
                    'label' => __d('install', 'Nombre'),
                    'placeholder' => __d('install', 'Ej: Mc Burger'),

                ));

                echo $this->Form->input('Site.country_code', array(
                    'label' => __d('install','País'),
                    'options' => $countries,
                    'default' => $country_code
                ));
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
