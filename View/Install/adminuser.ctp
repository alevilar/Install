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
        jQuery('#AdminUser').validationEngine('hide');
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
if(empty($this->request->data))
{


echo $this->Form->create(null, array(
	'url' => array('controller' => 'install', 'action' => 'adminuser'),'id'=>'AdminUser'
	));
?>


    <div class="install">
        <?php echo __d('croogo', 'Nota: Por defecto se creo el usuario admin con contraseña admin, sin embargo usted puede crear otro usuario personalizado.'); ?>

        <h2><?php echo __d('croogo', 'Paso 3: Crear un Usuario Admin.'); ?></h2>

        <table>

            <tr>
                <td>Usuario</td>
                <td>
                    <?php
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
                    <?php
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
	<?php echo $this->Html->link(__d('croogo', 'Cancelar'), array('admin'=>false,'plugin'=>'install','controller'=>'install','action' => 'cancel'), array( 'class' => 'btn btn-danger', 'div' => false)); ?>
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

<script>

    function notEqualPass(field){



        if(field.val() != $('#UserPassword').val()){
            return "* Los campos Contraseña y Verificar Contraseña deben de ser iguales.";
        }
    }

    $(document).ready(function(){
      $("#UserVerifyPassword").addClass("validate[required,funcCall[notEqualPass]]");
      $("#UserPassword").addClass("validate[required]");
      $("#UserUsername").addClass("validate[required]");
      $("#AdminUser").validationEngine({
            autoHidePrompt: true,
            // Delay before auto-hide
            autoHideDelay: 6000,
            // Fade out duration while hiding the validations
            fadeDuration: 0.3,

            'custom_error_messages' : {
                '#UserUsername' : {
                    'required': {
                        'message': "Se requiere un nombre de usuario."
                    }
                },
                '#UserPassword': {
                    'required': {
                        'message': "Se requiere de un password."
                    }
                },
                '#UserVerifyPassword': {
                    'required': {
                        'message': "Se requiere verificar el password."
                    }
                }
            }
        });
        //jQuery("#formID").validationEngine('attach',{ isOverflown: true });
        //jQuery("#formID").validationEngine('attach',{ relative: true });

        changeposition('bottomRight');

    })
</script>