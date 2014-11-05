<?php
App::uses('AppNoModelController', 'Controller');
App::uses('Installer', 'Install.Utility');

class SiteSetupController extends AppNoModelController {

    public $layout = 'Risto.default';
    public $uses = array("MtSites.Site");



    public function beforeFilter() {
        $this->Auth->allow(array('installsite'));
    }


    public function installsite()
    {

        if( $this->request->is('post') )
        {
           $codigo= explode("_",$this->request->data['Site']['country_code']);
            $this->request->data['Site']['country_code'] = $codigo[1];
            $this->request->data['Config']['timezone'] = $codigo[0];
            $this->request->data['User']['id'] = $this->Session->read('Auth.User.id');
            $this->Site->create();
            $this->Site->set($this->request->data);
            if($this->Site->validates())
            {
                if( $this->Site->saveAll( $this->request->data ) )
                {
                    $this->Site->read();
                    $site_slug = $this->Site->data['Site']['alias'];
                    $this->request->data['Site']['alias'] = $site_slug;
                  //  $this->request->data = $this->Site->read();
                   try
                    {
                        Installer::createTenantsDir($site_slug);
                        Installer::copySettingFile($site_slug,$this->request->data);
                        Installer::createDumpTenantDB($site_slug,$this->request->data);
                        // Dump del tenant
                        // recargar datos del usuario con el nuevo sitio
                        App::uses('MtSites','MtSites.Utility');
                        MtSites::loadSessionData( $site_slug );
                        $this->Session->setFlash(__d('install',"¡¡Bienvenido a tu Nuevo Comercio!!"), 'Risto.flash_success');
                        $this->redirect("/".$this->request->data['Site']['alias']);

                    } catch (CakeException $e)
                    {

                        $this->Session->setFlash("No se pudo crear el Sitio debido a:".$e->getMessage()."", 'Risto.flash_error');
                        Installer::deleteSite($site_slug);
                        $this->redirect("/");
                    }
                }
                else
                {
                    $this->Session->setFlash("No se pudo crear el Sitio.", 'Risto.flash_error');
                }
            }
            else
            {
                $this->Session->setFlash("Verifique los datos.","Risto.flash_error");
            }

        }
        $ip = env('HTTP_X_FORWARDED_FOR');
        if ( empty($ip) ) {
            $ip = $this->request->clientIp();
        }
        $this->request->data['Site']['country_code'] = Installer::getCountryData( $ip );
        $country_codes = Installer::countries();
        $this->set(compact('country_codes'));
    }

    public function deletesite($alias = null) {

        if($alias==null)
        {
            throw new NotFoundException('Debe especificar un sitio.');
        }

        $this->loadModel("MtSites.Site");
        $site = $this->Site->findByAlias($alias);
        if(!isset($site['Site']['alias']))
        {
            throw new NotFoundException('No se encontro ningun sitio con el nombre '.$alias.'.');
        }
        else
        {
            try
            {
                Installer::deleteSite($alias);
                $this->Session->setFlash("El sitio ".$alias." se elimino de forma correcta.");
                $this->redirect("/");
            }
            catch (CakeException $e)
            {
                $this->Session->setFlash("No se pudo eliminar el sitio ".$alias." de forma correcta.");

            }

        }


    }
}
