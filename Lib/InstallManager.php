<?php

class InstallManager {

/**
 * Mark installation as complete
 *
 * @return bool true when successful
 */
	public function installCompleted() {
		$Setting = ClassRegistry::init('Settings.Setting');
		$Setting->Behaviors->disable('Cached');
		return $Setting->write('Croogo.installed', 1);
	}

    public function checkPerms()
    {
        $res = true;

        if (!is_writable(TMP)) {
            $res = false;
        }

        if (!is_writable(APP . 'Config')) {
            $res = false;
        }

        if (!is_writable(APP . 'Controller')) {
            $res = false;
        }

        if (!is_writable(APP . 'Model')) {
            $res = false;
        }

        if (!is_writable(APP . 'Tenants')) {
            $res = false;
        }

    return $res;

    }

    public function checkAppInstalled()
    {
        $res = true;
        if(
            file_exists(APP . 'Config' . DS . 'database.php')==false
            ||file_exists(APP . 'Config' . DS . 'core.php')==false
            ||file_exists(APP . 'Config' . DS . 'resume.php')==false
        )
        {
            $res = false;

        }

        return $res;
    }

    public function cancelInstall()
    {
        $resume = new File(APP . 'Config' . DS . 'resume.php');
        if($resume->exists())
        {
            if($resume->delete())
            {
                return true;
            }
            else
            {
                return __d('croogo','No se puede borrar el archivo resume.php. Corrobore los permisos de escritura.');
            }
        }
        else
        {
            return true;
        }
        $database = new File(APP . 'Config' . DS . 'database.php');
        if($database->exists())
        {
            // Si existe la base de datos, entoncs debemos de elimanr todas las tablas
            try {
                $db = ConnectionManager::getDataSource('default');
                $tables = $db->listSources();
                if(!empty($tables))
                {
                    foreach($tables as $index => $tablename)
                    {
                        $db->query("DROP TABLE IF EXISTS ".$tablename.";");
                    }
                }
            }
            catch (MissingConnectionException $e) {
                return __d('croogo', 'No se pude conectar al abase de datos: ') . $e->getMessage();
            }
            if($database->delete())
            {
                return true;
            }
            else
            {
                return __d('croogo','No se puede borrar el database.php, corrobore los permisos de escritura sobre este archivo.');
            }
        }
        else
        {
            return true;
        }
    }
}