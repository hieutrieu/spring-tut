<?php
/**
 * Hieutrieu
 */
namespace App\Libraries\Auth;

use Framework\Config;
use Framework\DB\DB;
use Framework\Session\Session;

/**
 * App/Libraries\Auth
 */
class Auth
{
    private $db = null;
    private $tableName = null;

    public function __construct()
    {
        $this->db = DB::connection(Config::get('database.default'));
        $this->tableName = 'user';
    }

    public function check($credentials)
    {
        $password = md5($credentials['password']);
        $sql = "SELECT * FROM {$this->tableName}
                WHERE email = '{$credentials['email']}' AND password='{$password}'
                LIMIT 1 OFFSET 0
            ";
        $user = $this->db->select($sql);
        if (count($user)) {
            $session = Session::getInstance();
            $session->register(3600); // Register for 24 hours.
            $session->set('telephone_auth', $user[0]);

            //cookie
            $data = array(
                'username' => $user[0]["username"],
                'password' => $password,
                'decode' => false
            );
            setcookie("login", base64_encode(json_encode($data)), time() + (86400 * 30), "/");

            return true;
        }
        return false;
    }
}
