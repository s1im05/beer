<?php
namespace SSCE\Controllers;

class Index extends Base {
    
    protected $_sTemplate   = 'index.tpl.php';
    
    public function indexAction(){
        $aData  = $this->db->select("SELECT * FROM ?_sort WHERE `show` = 1 ORDER BY `sort` ASC;");
        $this->view->assign('aData', $aData);
    }
    
    public function locationsAction(){
        $this->indexAction();
        $this->setTemplate('locations.tpl.php');
        
        $aPlaces    = $this->db->select("SELECT * FROM ?_places ORDER BY `sort` ASC;");
        $this->view->assign('aPlaces', $aPlaces);
    }
    
    public function sendAction(){
        require_once ROOT.$this->config->mailer->path.'/PHPMailerAutoload.php';
        
        $sText  = "<ul>\n";
        foreach ($_POST['beer'] as $aVal) {
            $sText  .= "<li>".htmlspecialchars(trim($aVal['title'])).", кол-во: ".intval(trim($aVal['count']))." бут.</li>\n";
        }
        $sText  .= "</ul>\n";
        
        $oMail = new \PHPMailer;
        $oMail->setFrom('noreply@'.$_SERVER['HTTP_HOST'], 'robot (noreply)');
        $oMail->addAddress('serg.brauwelt@yandex.ru', 'Serg Brauwelt');
        $oMail->Subject = 'Заявка с сайта';
        $oMail->CharSet = 'utf-8';
        $oMail->msgHTML('
    <p>Дата формирования заявки: '.date('H:i, d.m.Y').'</p>
    <p>Имя отправителя: '.htmlspecialchars($_REQUEST['name']).'</p>
    <p>Содержание заявки: '.$sText.'</p>
    <p>Контактная информация: '.nl2br(htmlspecialchars($_REQUEST['contact'])).'</p>');

        if (!$oMail->send()) {
            die('false');
        } else {
            die('true');
        }  
    }
}