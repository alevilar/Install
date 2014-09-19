<?php
App::uses('AppNoModelController', 'Controller');
App::uses('File', 'Utility');
App::uses('Installer', 'Install.Utility');


class SiteSetupController extends AppNoModelController {

    public $layout = 'Risto.default';
    public $uses = array("MtSites.Site");

    public function installsite()
    {

        if( $this->request->is('post') )
        {

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
                    $mk_dir = Installer::createTenantsDir($site_slug);
                    if($mk_dir)
                    {
                        $r = Installer::copySettingFile($site_slug,$this->request->data);
                        if($r)
                        {
                            // Dump del tenant
                            $dumptenant = Installer::createDumpTenantDB($site_slug,$this->request->data);

                            Installer::createResumeFile();

                            // recargar datos del usuario con el nuevo sitio
                            App::uses('MtSites','MtSites.Utility');
                            MtSites::loadSessionData( $site_slug );

                            $this->Session->setFlash(__d('install',"¡¡Bienvenido a tu Nuevo Comercio!!"), 'Risto.flash_success');
                            $this->redirect("/".$this->request->data['Site']['alias']);
                        }
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




}
