<?php
    echo $this->Form->create(null, array(
        'url' => array('controller' => 'siteSetup', 'action' => 'installsite'),
    ));
    ?>
    <div class="install">
        <h2><?php echo __d('croogo', 'Crear Nuevo Sitio.'); ?></h2>

        <table>
            <tr>
                <td>Nombre del Sitio</td>
                <td>
                    <?php
                    echo $this->Form->input('Site.name', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Nombre del Sitio'),

                    ));
                    ?>
                </td>
        </tr>
            <tr>
                <td>Alias del Sitio</td>
                <td>
           <?php
        echo $this->Form->input('Site.alias', array(
            'label' => false,
            'placeholder' => __d('croogo', 'Alias del Sitio'),
            'value' => '',

        ));
           ?>
                    </td>
                </tr>
            <tr>
                <td>Codigo del País</td>
                <td>
                    <?php
        echo $this->Form->input('Site.country_code', array(
            'label' => false,
            'options' => $countries,
        ));
        ?>
            </td>

            </tr>


        </table>
    </div>
    <div class="form-actions">
        <?php echo $this->Form->submit(__d('croogo', 'Guardar'), array('class' => 'btn btn-success', 'div' => false)); ?>
        <?php echo $this->Html->link(__d('croogo', 'Cancelar'), array('action' => 'index'), array( 'class' => 'btn cancel')); ?>
    </div>
    <?php
    echo $this->Form->end();

