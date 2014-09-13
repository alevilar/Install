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
?>
    <script>
        $(document).ready(function(){

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
                }
            });
        //jQuery("#formID").validationEngine('attach',{ isOverflown: true });
        //jQuery("#formID").validationEngine('attach',{ relative: true });

            changeposition('bottomRight');

        })


    </script>

