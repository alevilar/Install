<!-- Js para la validadcion -->
<script src="/install/js/validation/js/jquery.validationEngine-en.js"></script>
<script src="/install/js/validation/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">

</script>

<!-- Css para validacion -->

<link rel="stylesheet" href="/install/js/validation/css/validationEngine.jquery.css" type="text/css"/>

<!-- Fin css -->

<!-- Fin js validacion -->
<script>
    //$.validationEngine.defaults.scroll = false;
    /**
     *
     * @param {jqObject} the field where the validation applies
     * @param {Array[String]} validation rules for this field
     * @param {int} rule index
     * @param {Map} form options
     * @return an error string if validation failed
     */
    function checkHELLO(field, rules, i, options){
        if (field.val() != "HELLO") {
            // this allows to use i18 for the error msgs
            return options.allrules.validate2fields.alertText;
        }
    }
    function changeposition(wo) {
        jQuery('#Database').validationEngine('hide');
        jQuery('input').attr('data-prompt-position',wo);
        jQuery('input').data('promptPosition',wo);
        jQuery('textarea').attr('data-prompt-position',wo);
        jQuery('textarea').data('promptPosition',wo);
        jQuery('select').attr('data-prompt-position',wo);
        jQuery('select').data('promptPosition',wo);
    }
    function changemethod(welche) {
        jQuery('#formID').validationEngine('hide');
        jQuery("#formID").validationEngine('detach');
        jQuery("#formID").validationEngine('attach');
    }
</script>

<!-- Fin js -->

<?php
echo $this->Form->create(false, array(
	'url' => array(
		'plugin' => 'install',
		'controller' => 'install',
		'action' => 'database'
	),
    'id'=>'Database'
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
                        'value' => ''

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
<script>
    $(document).ready(function(){

        $("#host").addClass("validate[required]");

        $("#login").addClass("validate[required]");

        $("#database").addClass("validate[required]");

        $("#Database").validationEngine({
            autoHidePrompt: true,
            // Delay before auto-hide
            autoHideDelay: 6000,
            // Fade out duration while hiding the validations
            fadeDuration: 0.3,

            'custom_error_messages' : {
                '#host' : {
                    'required': {
                        'message': "Se requiere un host."
                    }
                },
                '#login': {
                    'required': {
                        'message': "Se requiere de un nombre de usuario."
                    }
                },
                '#database': {
                    'required': {
                        'message': "Se requiere de una base de datos."
                    }
                }
            }
        });
        //jQuery("#formID").validationEngine('attach',{ isOverflown: true });
        //jQuery("#formID").validationEngine('attach',{ relative: true });

        changeposition('bottomRight');

    })
</script>