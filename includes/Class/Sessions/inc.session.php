<?php
//inc.session.php

class Session implements SessionHandlerInterface
{
    private $db;
    public $lifeTime;
    //private $db;
    
    public function start_session($session_name, $secure) {
       // Make sure the session cookie is not accessible via javascript.
      $httponly = true;
        
       // Hash algorithm to use for the session. (use hash_algos() to get a list of available hashes.)
      $session_hash = 'sha512';
        
       // Check if hash is available
      if (in_array($session_hash, hash_algos())) {
        // Set the has function.
        ini_set('session.hash_function', $session_hash);
      }
      // How many bits per character of the hash.
      // The possible values are '4' (0-9, a-f), '5' (0-9, a-v), and '6' (0-9, a-z, A-Z, "-", ",").
      ini_set('session.hash_bits_per_character', 5);
        
      // Force the session to only use cookies, not URL variables.
      ini_set('session.use_only_cookies', 1);
        
      // Get session cookie parameters 
      $cookieParams = session_get_cookie_params(); 
      // Set the parameters
      session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
      // Change the session name 
      session_name($session_name);
      // Now we cat start the session
      session_start();
      // This line regenerates the session and delete the old one. 
      // It also generates a new encryption key in the database. 
      //session_regenerate_id(true); 
    }

    public function open($savePath, $sessionName)
    {
        // get session-lifetime
        $this->lifeTime = get_cfg_var("session.gc_maxlifetime");
        //Open Database Connection
        $db = new mysqli("localhost","root","","pncrtg");
        if($db){
            $this->db = $db;
            return true;
        }else{
            return false;
        }

    }
    public function close()
    {
        //Close sessions
        $this->gc(ini_get('session.gc_maxlifetime'));
        mysqli_close($this->db);
        return true;
    }
    public function read($id)
    {
        //Read sessions from database
        $result = $this->db->query("SELECT Session_Data FROM session_management WHERE Session_Id = '$id'");
        $row = mysqli_fetch_assoc($result);
        $data = $this->session_hashes($row['Session_Data'], 'decrypt'); //Decrypt Sessions Data from Database
        if(mysqli_num_rows($result)>0){
            return $data;
        }else{
            return "";
        }
    }
    public function write($id, $data)
    {
        $newExp = time() + $this->lifeTime;
        //echo "<script>alert('{$newExp}')</script>";
        $data = $this->session_hashes($data, 'encrypt'); //Encrypt Sessions Data
        $result = $this->db->query("SELECT Session_Data FROM session_management WHERE Session_Id = '$id'");

        if (mysqli_num_rows($result)>0) {
            //UPDATE Sessions in Database if session is exists
           $this->db->query("UPDATE session_management SET Session_Id='$id', Session_Expires='$newExp', Session_Data='$data' WHERE Session_Id='$id'");
            return true;
        }else{
            //iNSERT Sessions in Database if session is not exists
            $this->db->query("INSERT INTO session_management(Session_Id,Session_Expires,Session_Data)VALUES('$id','$newExp','$data')");
            return true;
        }
    }
    public function destroy($id)
    {
        //DALETE Sessions in Database if session_destroy()
        $result = $this->db->query("DELETE FROM session_management WHERE Session_Id ='$id'");
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function gc($maxlifetime)
    {
        // delete old sessions in Database
        $time = time();
        $result = $this->db->query("DELETE FROM session_management WHERE Session_Expires < {$time}");
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function session_hashes($data, $method) {
        $salt = substr(hash('sha256', md5('hashes')), 0, 32); // salt
        $secret_key = md5($salt); //define private key
        $secret_iv = substr(hash('sha256', $salt.$secret_key.$salt), 0, 32); //secret_iv
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB); //iv_size
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND); //create method for iv_size

        if ($method == 'encrypt') { 
            $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $secret_iv, ($data), MCRYPT_MODE_ECB, $iv));
        }elseif ($method == 'decrypt') {
            $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $secret_iv, base64_decode($data), MCRYPT_MODE_ECB, $iv);
            $output = rtrim($output, "\0");
        }else{
            $output = $data; //return to not encrypted/decrypted
        }
        return $output;
    }
}
$handler = new Session();
session_set_save_handler($handler, true);
register_shutdown_function('session_write_close');
?>