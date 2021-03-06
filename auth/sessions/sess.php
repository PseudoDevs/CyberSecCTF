CREATE TABLE `ws_sessions` (
  `session_id` varchar(255) binary NOT NULL default '',
  `session_expires` int(10) unsigned NOT NULL default '0',
  `session_data` text,
  PRIMARY KEY  (`session_id`)
) TYPE=InnoDB;

<?php
class session {
    // session-lifetime
    var $lifeTime;
    // mysql-handle
    var $dbHandle;
    function open($savePath, $sessName) {
       // get session-lifetime
       $this->lifeTime = get_cfg_var("session.gc_maxlifetime");
       // open database-connection
       $dbHandle = @mysql_connect("server","user","password");
       $dbSel = @mysql_select_db("database",$dbHandle);
       // return success
       if(!$dbHandle || !$dbSel)
           return false;
       $this->dbHandle = $dbHandle;
       return true;
    }
    function close() {
        $this->gc(ini_get('session.gc_maxlifetime'));
        // close database-connection
        return @mysql_close($this->dbHandle);
    }
    function read($sessID) {
        // fetch session-data
        $res = mysql_query("SELECT session_data AS d FROM ws_sessions
                            WHERE session_id = '$sessID'
                            AND session_expires > ".time(),$this->dbHandle);
        // return data or an empty string at failure
        if($row = mysql_fetch_assoc($res))
            return $row['d'];
        return "";
    }
    function write($sessID,$sessData) {
        // new session-expire-time
        $newExp = time() + $this->lifeTime;
        // is a session with this id in the database?
        $res = mysql_query("SELECT * FROM ws_sessions
                            WHERE session_id = '$sessID'",$this->dbHandle);
        // if yes,
        if(mysql_num_rows($res)) {
            // ...update session-data
            mysql_query("UPDATE ws_sessions
                         SET session_expires = '$newExp',
                         session_data = '$sessData'
                         WHERE session_id = '$sessID'",$this->dbHandle);
            // if something happened, return true
            if(mysql_affected_rows($this->dbHandle))
                return true;
        }
        // if no session-data was found,
        else {
            // create a new row
            mysql_query("INSERT INTO ws_sessions (
                         session_id,
                         session_expires,
                         session_data)
                         VALUES(
                         '$sessID',
                         '$newExp',
                         '$sessData')",$this->dbHandle);
            // if row was created, return true
            if(mysql_affected_rows($this->dbHandle))
                return true;
        }
        // an unknown error occured
        return false;
    }
    function destroy($sessID) {
        // delete session-data
        mysql_query("DELETE FROM ws_sessions WHERE session_id = '$sessID'",$this->dbHandle);
        // if session was deleted, return true,
        if(mysql_affected_rows($this->dbHandle))
            return true;
        // ...else return false
        return false;
    }
    function gc($sessMaxLifeTime) {
        // delete old sessions
        mysql_query("DELETE FROM ws_sessions WHERE session_expires < ".time(),$this->dbHandle);
        // return affected rows
        return mysql_affected_rows($this->dbHandle);
    }
}
$session = new session();
session_set_save_handler(array($session,"open"),
                         array($session,"close"),
                         array($session,"read"),
                         array($session,"write"),
                         array($session,"destroy"),
                         array($session,"gc"));
session_start();
// etc...
?>
<?php
    $db = mysqli_connect("localhost", "phpuser", "alm65z", "phpdb");

    function sess_open($sess_path, $sess_name){
        return true;
    }
    function sess_close() {
        return true;
    }

    function sess_read($sess_id) {
      GLOBAL $db;

      $result = mysqli_query($db, "SELECT Data FROM sessions WHERE SessionID = '$sess_id';");
      if (!mysqli_num_rows($result)) {
        $CurrentTime = time();
        mysqli_query($db, "INSERT INTO sessions (SessionID, DateTouched) VALUES ('$sess_id', $CurrentTime);");
        return '';
      } else {
        extract(mysqli_fetch_array($result), EXTR_PREFIX_ALL, 'sess');
        mysqli_query($db, "UPDATE sessions SET DateTouched = $CurrentTime WHERE SessionID = '$sess_id';");
        return $sess_Data;
      }
    }

    function sess_write($sess_id, $data) {
        GLOBAL $db;

        $CurrentTime = time();
        mysqli_query($db, "UPDATE sessions SET Data = '$data', DateTouched = $CurrentTime WHERE SessionID = '$sess_id';");
        return true;
    }

    function sess_destroy($sess_id) {
        GLOBAL $db;
        mysqli_query($db, "DELETE FROM sessions WHERE SessionID = '$sess_id';");
        return true;
    }

    function sess_gc($sess_maxlifetime) {
        GLOBAL $db;
        $CurrentTime = date('YmdHis');
        mysqli_query($db, "DELETE FROM sessions WHERE `timestamp` < $CurrentTime;");
        return true;
    }

    session_set_save_handler("sess_open", "sess_close", "sess_read", "sess_write", "sess_destroy", "sess_gc");
    session_start();
?>