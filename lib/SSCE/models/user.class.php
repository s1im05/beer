<?php
namespace SSCE\Models;

class User extends Base {
    
    public static $cookieName   = 'u_h';
    
    public static function isLogged(){
        return isset($_SESSION['user']);
    }
    
    public function __get($sKey){
        $mGet   = parent::__get($sKey);
        if ($mGet !== null) {
            return $mGet;
        }
        if (isset($_SESSION['user'][$sKey])){
            return $_SESSION['user'][$sKey];
        } else {
            return null;
        }
    }
    
    public static function logout(){
        unset($_SESSION['user']);
        unset($_COOKIE[User::$cookieName]);
        setcookie(User::$cookieName, '', time(), '/');
        header("Location: {$_SERVER['HTTP_REFERER']}");
        die();
    }
    
    public function getLoginzaUrl($sToken){
        $sUrl   = $this->config->loginza->url."?token={$sToken}";
        
        if ($this->config->loginza->id && $this->config->loginza->sec){
            $sUrl   .= "&id=".$this->config->loginza->id."&sig=".md5($sToken.$this->config->loginza->sec);
        }
        
        return $sUrl;
    }
    
    public function loginLoginza($sToken){
        if (!$sToken){
            return $this;
        }

        if (($oData   = json_decode(file_get_contents($this->getLoginzaUrl($sToken)))) && !isset($oData->error_type)){
            if (!($_SESSION['user']    = $this->db->selectRow("SELECT * FROM ?_users WHERE identity = ? LIMIT 1;", $oData->identity))){
                if ($this->db->query("INSERT INTO
                                                ?_users
                                            SET
                                                `identity`      = ?,
                                                `nickname`      = ?,
                                                `last_name`     = ?,
                                                `first_name`    = ?,
                                                `email`         = ?,
                                                `dob`           = ?,
                                                `gender`        = ?,
                                                `web`           = ?,
                                                `photo`         = ?",
                                                $oData->identity,
                                                isset($oData->nickname)&&($oData->nickname!='')?$oData->nickname:(isset($oData->name->last_name)||isset($oData->name->first_name)?$oData->name->first_name.' '.$oData->name->last_name:''),
                                                isset($oData->name->last_name)?$oData->name->last_name:'',
                                                isset($oData->name->first_name)?$oData->name->first_name:'',
                                                isset($oData->email)?$oData->email:'',
                                                isset($oData->dob)?$oData->dob:'0000-00-00',
                                                isset($oData->gender)?$oData->gender:'U',
                                                isset($oData->web->default)?$oData->web->default:'',
                                                isset($oData->photo)?$oData->photo:'')){
                    $_SESSION['user']   = $this->db->selectRow("SELECT * FROM ?_users WHERE identity = ? LIMIT 1;", $oData->identity);
                }
            } else {
                $_SESSION['user']['photo']  = isset($oData->photo)?$oData->photo:'';
            }

            $sSec   = md5(mt_rand());
            $sKey   = md5($_SESSION['user']['identity'].'__'.$_SERVER['REMOTE_ADDR'].'__'.$sSec);
            $this->db->query("UPDATE LOW_PRIORITY ?_users SET sec = ?, ldate = NOW(), photo = ? WHERE id = ?d LIMIT 1;", $sSec, $_SESSION['user']['photo'], $_SESSION['user']['id']);
            setcookie(User::$cookieName, $_SESSION['user']['id'].'_'.$sKey.'_'.$sToken, strtotime('+30 days') , '/', '', false, true);
        }
        return $this;
    }
    
    public function loginCookie(){
        if (!isset($_COOKIE[User::$cookieName])){
            return;
        }
        $aValue = explode('_', $_COOKIE[User::$cookieName]);
        if (sizeof($aValue) >= 2){
            $aUser  = $this->db->selectRow("SELECT * FROM ?_users WHERE id = ?d LIMIT 1;", $aValue[0]);
            if ($aValue[1] ===  md5($aUser['identity'].'__'.$_SERVER['REMOTE_ADDR'].'__'.$aUser['sec'])){
                $_SESSION['user']   = $aUser;
                $this->db->query("UPDATE LOW_PRIORITY ?_users SET ldate = NOW() WHERE id = ?d LIMIT 1;", $_SESSION['user']['id']);
            } else {
                setcookie(User::$cookieName, '');
                unset($_COOKIE[User::$cookieName]);
            }
        }
    }
}