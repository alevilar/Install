<?php
if(empty($this->request->data))
{
    echo $this->Form->create(null, array(
        'url' => array('controller' => 'siteSetup', 'action' => 'installsite'),
    ));
    ?>
    <div class="install">
        <h2><?php echo __d('croogo', 'Paso 4: Instalación del Sitio.'); ?></h2>

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


            <tr>
                <td>Nombre de Usuario</td>
                <td>
                    <?php
                    echo $this->Form->input('User.username', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Nombre de usuario'),

                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Password de Usuario</td>
                <td>
                    <?php
                    echo $this->Form->input('User.password', array(
                        'label' => false,
                        'placeholder' => __d('croogo', 'Password'),
                        'value' => '',

                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td>Re-ingrese Password</td>
                <td>
                    <?php
                    echo $this->Form->input('User.verify_password', array(
                        'type'=>'password',
                        'label' => false,
                        'placeholder' => __d('croogo', 'Password'),
                        'value' => '',

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

}
else
{
    ?>
    <?php echo $this->Html->link(__d('croogo', 'Ingresar'), array('admin'=>false,'plugin'=>false,'controller'=>'users','action' => 'login'), array( 'class' => 'btn btn-success')); ?>
<?php
}
?>