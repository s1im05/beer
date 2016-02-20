<?php
namespace SSCE;

class Application extends Base {
    
    protected $_oConfig;
    protected $_oDb;
    protected $_oView;
    protected $_oRequest;
    protected $_oDirector;

    private $_sConfigFile;

    public function __construct($sConfigFile){
        $this->_sConfigFile         = $sConfigFile;
        $this->_boot();
    }
    
    private function _boot(){
        session_start();
        ob_start();
        
        $this->_oConfig = new Config($this->_sConfigFile);
        setlocale(LC_ALL , $this->config->project->locale);
        $this->_oView   = new View($this->config->templates->path);
        
        require_once $_SERVER['DOCUMENT_ROOT'].$this->config->db->path.'/Generic.php';
        require_once $_SERVER['DOCUMENT_ROOT'].$this->config->db->path.'/Mysql.php';
        $this->_oDb = \DbSimple_Generic::connect("mysql://".$this->config->db->user.($this->config->db->password ? ":".$this->config->db->password:'' )."@".$this->config->db->host."/".$this->config->db->database);
        $this->db->setIdentPrefix($this->config->db->table_prefix);
        $this->db->query("SET NAMES utf8");

        $oRoutesConfig  = new Config($_SERVER['DOCUMENT_ROOT'].$this->config->router->path);
        
        $this->_oRequest    = new Request($oRoutesConfig->routes);
        $this->_oDirector   = new Director($this->options);
        $this->_oDirector->bootstrap()->runCurrent();
    }
}