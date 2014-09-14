<?php
App::uses('VeterinariaAppController', 'Veterinaria.Controller');
App::uses('File', 'Utility');
App::uses('InstallManager', 'Install.Lib');
App::uses('Installer', 'Install.Utility');


class SiteSetupController extends VeterinariaAppController {



public function beforeFilter()
{
    parent::beforeFilter();
    $this->Auth->allow("*");
}


    protected function _check() {
        $InstallManager = new InstallManager();
        // Si esta instalado no habra necesidad de checkear permisos
        if ($InstallManager->checkAppInstalled()) {
            $this->Session->setFlash('La Aplicación Ristorantino ya esta instalada.');
            return $this->redirect('/users/login');
        }
        // Si no esta instalado y no se puede escribir en las pcarpetas volvera al inicio
        if (!$InstallManager->checkAppInstalled()&&!$InstallManager->checkPerms())
        {

            return $this->redirect('/install');
        }

    }

    public function installsite()
    {
        //debug($this->Session->read('Auth.User.id'));
        if($this->Session->read('Auth.User.id')==null)
        {
            // Si no esta autenticado hacer el chequeo
          //  $this->_check();
        }
        

        if( $this->request->is('post') )
        {

            $this->loadModel("MtSites.Site");

            $this->request->data['User']['id'] = $this->Session->read('Auth.User.id');
            $this->Site->create();
            if( $this->Site->saveAll( $this->request->data ) )
            {
                $this->Site->read();
                $site_slug = $this->Site->data['Site']['alias'];
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
                        MtSites::loadSessionData();

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
            
        $this->request->data['Site']['country_code'] = Installer::getCountryData( $this->request->clientIp() );
        
        $country_codes = Installer::countries();
        $this->set(compact('country_codes'));
    }




}
