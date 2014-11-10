<?php

namespace PrimerServer\Services\WHM;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Administrador;

class WHMFunctions {

    //Constructs the objects and uses IoC automatically to call xmlApi
    public function __construct(\XmlApi $xmlapi)
    {
        $this->xmlapi = $xmlapi;
        $this->xmlapi->set_host(\Config::get('whm.host'));
        $this->xmlapi->set_user(\Config::get('whm.username'));
        $this->xmlapi->set_hash(\Config::get('whm.hash'));
        $this->xmlapi->set_output('json');
        //$this->plan   = $plan;
    }

    /*
     * Add subdomains to server
     * requires: 
     * $nameserver: realname of the hosted server account
     * $domain: The domain name of the addon domain you wish to create. (For example, domain.sub.example.com).
     * $subdomain: The domain name of the addon domain you wish to create. (For example, sub.example.com).
     * $password: password used for the ftp
     * 
     */

    public function addSubDomain($nameserver = null, $domain = null, $subdomain = null, $password = null)
    {
        if (!isset($nameserver) || !isset($domain) || !isset($subdomain) || !isset($password))
        {
            \Session::flash('error', trans('frontend.domain.store.no_data'));
            return false;
        }
        $response = $this->xmlapi->api2_query($nameserver, "AddonDomain", "addaddondomain", array('newdomain' => $domain, 'dir' => "public_html/" . $domain, 'subdomain' => $subdomain, 'pass' => $password));

        $resultado = json_decode($response, true);
        if ($resultado['cpanelresult']['data'][0]['result'] == 1)
        {
            return true;
        }
        else
        {
            \Log::error('WHMFunciones. addSubDomain ' . $resultado['cpanelresult']['data'][0]['reason']);
            \Session::flash("error", trans('frontend.messages.domain.store.server_error', array('error' => $resultado['cpanelresult']['data'][0]['reason'])));
            return false;
        }
    }

    /*
     * Add subdomains to server
     * requires: 
     * $nameserver: real name of the hosted server account
     * $domain: The addon domain you wish to delete.
     * $subdomain: This value should contain the addon domain's username followed by an underscore (_), then the addon domain's main domain 
     */

    public function delSubDomain($nameserver, $domain, $subdomain)
    {

        if (!isset($nameserver) || !isset($domain) || !isset($subdomain))
        {
            \Session::flash('error', trans('frontend.domain.store.no_data'));
            return false;
        }

        $response  = $this->xmlapi->api2_query($nameserver, 'AddonDomain', 'deladdondomain', array('domain' => $domain, 'subdomain' => $subdomain));
        $resultado = json_decode($response, true);
        if ($resultado['cpanelresult']['data'][0]['result'] == 1)
        {
            return true;
        }
        else
        {
            \Log::error('WHMFunciones. delSubDomain ' . $resultado['cpanelresult']['data'][0]['reason']);
            \Session::flash("error", trans('frontend.messages.domain.store.server_error', array('error' => $resultado['cpanelresult']['data'][0]['reason'])));
            return false;
        }
    }

    /*
     * FTP
     */

    /*
     * Add an FTP Account to the server
     * user (string)	The username portion of the new FTP account, without the domain.When you log in with this name, remember to append the main domain to the end (for example, user@example.com).
     * pass (string)	The password for the new FTP account.
     * quota (integer)	The new FTP account's quota. 0 indicates that the account will not use a quota. This parameter defaults to 0.
     * homedir (string)	The path to the FTP account's root directory. This value should be relative to the account's home directory. */

    public function addFTP($nameserver, $user, $pass, $quota, $homedir)
    {

        if (!isset($nameserver) || !isset($user) || !isset($pass) || !isset($quota) || !isset($homedir))
        {
            \Session::flash('error', trans('frontend.ftp.store.no_data'));
            return false;
        }

        $response = $this->xmlapi->api2_query($nameserver, "Ftp", "addftp", array('pass' => $pass, 'user' => $user, 'quota' => $quota, 'homedir' => $homedir));
        $resultado = json_decode($response, true);
        if ($resultado['cpanelresult']['data'][0]['result'] == 1)
        {
            return true;
        }
        else
        {
            \Log::error('WHMFunciones. addFTP ' . $resultado['cpanelresult']['data'][0]['reason']);
            \Session::flash("error", trans('frontend.messages.domain.store.server_error', array('error' => $resultado['cpanelresult']['data'][0]['reason'])));
            return false;
        }

    }

    /*
     * Agregar Correos al servidor
     */

    public function agregarCorreoServidor($domain, $email, $password)
    {

        if (!isset($domain) || !isset($email) || !isset($password))
        {
            Log::error('WHMFunciones. AgregarCorreoServidor, Faltan datos en la funcion');
            return false;
        }
        else
        {
            $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'addpop', array('domain' => $domain, 'email' => $email, 'password' => $password, 'quota' => $this->plan->quota_correos));

            $resultado = json_decode($response, true);
            if ($resultado['cpanelresult']['data'][0]['result'] == 1)
            {
                return true;
            }
            else
            {
                Log::error('WHMFunciones. AgregarCorreoServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                return false;
            }
        }
    }

    /*
     * Agregar Forwarder al servidor;
     */

    public function agregarForwardServidor($domain, $email, $redireccion)
    {

        if (!isset($domain) || !isset($email) || !isset($redireccion))
        {
            Log::error('WHMFunciones. AgregarForwardServidor, Faltan datos en la funcion');
            return false;
        }
        else
        {
            $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'addforward', array('domain' => $domain, 'email' => $email, 'fwdopt' => 'fwd', 'fwdemail' => $redireccion));

            $resultado = json_decode($response, true);
            Log::error($resultado);
            if (!isset($resultado['cpanelresult']['error']))
            {
                return true;
            }
            else
            {
                Log::error('WHMFunciones. AgregarForwarderServidor ' . $resultado['cpanelresult']);
                return false;
            }
        }
    }

    /*
     * Funcion para agregar un dominio/addon al servidor 
     */

    public function agregarFtpServidor($user_name, $home_dir, $pass)
    {
        if (!isset($user_name) || !isset($pass) || !isset($home_dir))
        {
            Log::error('WHMFunciones. AgregarFTPServidor, Faltan datos en la funcion ' . $user_name . ' ' . $home_dir . ' ' . $pass);
            return false;
        }
        else
        {

            $response = $this->xmlapi->api2_query($this->plan->name_server, "Ftp", "addftp", array('pass' => $pass, 'user' => $user_name, 'quota' => $this->plan->quota_ftps, 'homedir' => $home_dir));

            $resultado = json_decode($response, true);


            if ($resultado['cpanelresult']['data'][0]['result'] == 1)
            {
                return true;
            }
            else
            {
                $data = array('respuesta' => $resultado['cpanelresult']['data'][0]['reason']);
                Mail::queue('email.error_agregar_dominio', $data, function($message) {
                    $message->to('carlos.juarez@t7marketing.com', "Administrador")->subject('Error al agregar el dominio');
                });
                Log::error('WHMFunciones. AgregarFtpServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                return false;
            }
        }
    }

    /*
     * Funcion para agregar un dominio/addon al servidor 
     */

    public function agregarDbServidor($username, $password, $dbname)
    {
        if (!isset($username) || !isset($password) || !isset($dbname))
        {
            Log::error('WHMFunciones. AgregarDbServidor, Faltan datos en la funcion ' . $username . ' ' . $password . ' ' . $dbname);
            return false;
        }


        $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "adduser", array($username, $password));

        if ($response != false)
        {
            $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "adddb", array($dbname));
            if ($response != false)
            {
                $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "adduserdb", array($dbname, $username, 'all'));
                if ($response != false)
                {
                    return true;
                }
                else
                {
                    Log::error('WHMFunciones. agregarDbServidor Error al agregar la base de datos');
                    return false;
                }
            }
        }

        $resultado = json_decode($response, true);
        if ($resultado['cpanelresult']['data'][0]['result'] == 1)
        {
            return true;
        }
        else
        {
            Log::error('WHMFunciones. AgregarDbServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
            return false;
        }
    }

    /*
      |-----------------------------------------------
      |    Seccion para editar elementos del servidor
      |-----------------------------------------------
     */

    /*
     * Funciones para editar el password del servidor
     */

    public function editarPasswordCorreoServidor($domain, $email, $password)
    {

        if (!isset($domain) || !isset($email) || !isset($password))
        {
            Session::flash('error', 'falta un argumento');
            return false;
        }
        else
        {
            $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'passwdpop', array('domain' => $domain, 'email' => $email, 'password' => $password));

            $resultado = json_decode($response, true);
            if ($resultado['cpanelresult']['data'][0]['result'] == 1)
            {
                return true;
            }
            else
            {
                Log::error('WHMFunciones. AgregarPasswordCorreoServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                return false;
            }
        }
    }

    /*
     * Funciones para editar el password del servidor
     */

    public function editarPasswordFtpServidor($user, $pass)
    {

        if (!isset($user) || !isset($pass))
        {
            Session::flash('error', 'falta un argumento');
            return false;
        }
        else
        {
            $response = $this->xmlapi->api2_query($this->plan->name_server, 'Ftp', 'passwd', array('user' => $user, 'pass' => $pass));

            $resultado = json_decode($response, true);
            if ($resultado['cpanelresult']['data'][0]['result'] == 1)
            {
                return true;
            }
            else
            {
                Log::error('WHMFunciones. editarPasswordFtpServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                return false;
            }
        }
    }

    /*
      |---------------------------------------------------
      |    Seccion para eliminar del servidor
      |---------------------------------------------------
     */



    /*
     * Funcion para eliminar un correo del servidor
     */

    public function eliminarCorreoServidor($domain, $username)
    {
        if (!isset($domain) || !isset($username))
        {
            Session::flash('error', 'falta un argumento');
            return false;
        }
        else
        {
            $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'delpop', array('domain' => $domain, 'email' => $username,));

            $resultado = json_decode($response, true);
            if ($resultado['cpanelresult']['data'][0]['result'] == 1)
            {
                return true;
            }
            else
            {
                Log::error('WHMFunciones. EliminarCorreoServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                return false;
            }
        }
    }

    /*
     * Funcion para eliminar forwarders del servidor
     */

    public function eliminarFwdServidor($email, $forward)
    {
        if (!isset($email) || !isset($forward))
        {
            Session::flash('error', 'falta un argumento');
            return false;
        }
        else
        {
            $this->xmlapi->api1_query($this->plan->name_server, 'Email', 'delforward', array($email . '=' . $forward));
            return true;
        }
    }

    /*
     * Funcion para eliminar un correo del servidor
     */

    public function eliminarFtpServidor($user, $borrar)
    {
        if (!isset($user) || !isset($borrar))
        {
            Log::error('WHMFunciones. AgregarFTPServidor, Faltan datos en la funcion');
            return false;
        }
        else
        {
            $response = $this->xmlapi->api2_query($this->plan->name_server, 'Ftp', 'delftp', array('user' => $user, 'destroy' => $borrar));

            $resultado = json_decode($response, true);
            if ($resultado['cpanelresult']['data'][0]['result'] == 1)
            {
                return true;
            }
            else
            {
                Log::error('WHMFunciones. EliminarFTPServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                return false;
            }
        }
    }

    /*
     * Funcion para eliminar un correo del servidor
     */

    public function eliminarDbServidor($username, $dbname)
    {
        if (!isset($username) || !isset($dbname))
        {
            Log::error('WHMFunciones. AgregarDbServidor, Faltan datos en la funcion');
            return false;
        }


        $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "deluserdb", array($dbname, $username));

        if ($response != false)
        {

            $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "deluser", array($username));
            if ($response != false)
            {
                $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "deldb", array($dbname));
                if ($response != false)
                {
                    return true;
                }
                else
                {
                    Log::error('WHMFunciones. EliminarDBServidor Error al eliminar la base de datos');
                    return false;
                }
            }
            else
            {
                Log::error('WHMFunciones. EliminarDBServidor Error al eliminar el usuario');
                return false;
            }
        }
        else
        {
            Log::error('WHMFunciones. EliminarDBServidor Error al eliminar el usuario de la base de datos');
            return false;
        }
    }

    /*
      |--------------------------------
      | Obtener quotas
      |--------------------------------
     */

    public function obtenerQuotaCorreoServidor($username, $domain)
    {
        $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'getdiskusage', array('user' => $username, 'domain' => $domain));

        $resultado = json_decode($response, true);
        return $resultado['cpanelresult']['data']['0']['diskused'];
    }

    public function obtenerQuotaCorreosServidor($domain)
    {
        $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'listpopswithdisk', array('domain' => $domain));

        $resultado = json_decode($response, true);
        $quotas    = array();
        if ($resultado['cpanelresult']['data'] != null)
        {
            foreach ($resultado['cpanelresult']['data'] as $result) {
                $correo                   = array('diskquota' => $result['diskquota'], 'diskused' => $result['diskused']);
                $quotas[$result['login']] = $correo;
            }
            return $quotas;
        }
        else
        {
            return null;
        }
    }

    public function obtenerQuotaDBServidor($dbname)
    {

        if (!isset($dbname))
        {
            Log::error('WHMFunciones: obtenerQuotaDBServidor: Error no especifico nombre de base de datos');
            return false;
        }

        $response = $this->xmlapi->api2_query($this->plan->name_server, 'MysqlFE', 'listdbs', array('regex' => $dbname));

        $resultado = json_decode($response, true);
        if (isset($resultado['cpanelresult']['data'][0]['db']))
        {
            $database = $resultado['cpanelresult']['data'];
            return $database;
        }
        else
        {
            Log::error('WHMFunciones. EliminarFTPServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
            return false;
        }
    }

}
