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
        jQuery('#SiteSetup').validationEngine('hide');
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
    echo $this->Form->create(null, array(
        'url' => array('controller' => 'siteSetup', 'action' => 'installsite'),'id'=>'SiteSetup'
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
                        'class'=>'form-control validate[required]'
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
            'class'=>'form-control validate[required]'

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
        <?php echo $this->Html->link(__d('croogo', 'Cancelar'), array('admin'=>false,'plugin'=>'install','controller'=>'install','action' => 'cancel'), array( 'class' => 'btn cancel')); ?>
    </div>

<?php
echo $this->Form->end();
?>
    <script>
$(document).ready(function(){
    // Se inicializa la lista con el codigo del pais
    $("#SiteCountryCode option[value='<?php echo $country_code; ?>']").attr('selected', 'selected');

   // $("#SiteName").addClass("validate[required]");
   // $("#SiteAlias").addClass("validate[required]");

    $("#SiteSetup").validationEngine({
        autoHidePrompt: true,
// Delay before auto-hide
        autoHideDelay: 6000,
// Fade out duration while hiding the validations
        fadeDuration: 0.3,

        'custom_error_messages' : {
            '#SiteName' : {
                'required': {
                    'message': "Se requiere un nombre de sitio."
                }
            },
            '#SiteAlias': {
                'required': {
                    'message': "Se requiere de un alias."
                }
            }
        }
    });
//jQuery("#formID").validationEngine('attach',{ isOverflown: true });
//jQuery("#formID").validationEngine('attach',{ relative: true });

    changeposition('bottomRight');

})


    </script>


