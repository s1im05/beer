<?php
namespace SSCE\Controllers;

class AdminBeer extends Admin {
    
    protected $_sTemplate   = 'admin_beer.php';
    
    public function indexAction(){
        parent::indexAction();
        
        if (isset($_GET['sort'])){
            if ($aData  = $this->db->selectRow("SELECT * FROM ?_sort WHERE id = ?d LIMIT 1;", $_GET['sort'])){
                $aData['date_e']    = $aData['date_e'] == '0000-00-00' ? '' : date('d.m.Y', strtotime($aData['date_e']));
            }

            $this->setLayout('ajax_layout_json.php');
            $this->view->assign('mRequest', $aData);
            return;
        }
        
        if (isset($_POST['pos']) && isset($_POST['id'])){
            $this->db->query("UPDATE LOW_PRIORITY ?_sort SET `sort`   = ?d WHERE id = ?d LIMIT 1;", $_POST['pos'], $_POST['id']);
            
            $this->setLayout('ajax_layout_json.php');
            $this->view->assign('mRequest', 'true');
            return;
        }
        
        if (isset($_POST['show']) && isset($_POST['id'])){
            $this->db->query("UPDATE LOW_PRIORITY ?_sort SET `show`   = ?d WHERE id = ?d LIMIT 1;", $_POST['show'], $_POST['id']);
            
            $this->setLayout('ajax_layout_json.php');
            $this->view->assign('mRequest', 'true');
            return;
        }
        
        $sImage = $this->_uploadImage('image');
        
        if (isset($_POST['id']) && !$_POST['id']){ // add beer
            if ($iId    = $this->db->query("INSERT INTO
                                ?_sort
                            SET
                                title   = ?,
                                title_sub    = ?,
                                text    = ?,
                                date_e  = ?,
                                color   = ?,
                                image   = ?,
                                type    = ?,
                                og      = ?,
                                abv     = ?,
                                ibu     = ?,
                                available   = ?d",
                            trim($_POST['title']),
                            trim($_POST['title_sub']),
                            trim($_POST['text']),
                            $_POST['date_e'] ? date('Y-m-d', strtotime($_POST['date_e'])) : '',
                            trim($_POST['color']),
                            $sImage ? $sImage : '',
                            $_POST['type'],
                            trim($_POST['og']),
                            trim($_POST['abv']),
                            trim($_POST['ibu']),
                            $_POST['available'])){
                $this->view->assign('sSuccess', 'Успешно добавлено');
            } else {
                $this->view->assign('sError', 'Ошибка при добавлении, проверьте правильность ввода');
            }
        } elseif (isset($_POST['id']) && $_POST['id']){ // edit beer
            $this->db->query("UPDATE LOW_PRIORITY
                                            ?_sort
                                        SET
                                            title   = ?,
                                            title_sub    = ?,
                                            text    = ?,
                                            date_e  = ?,
                                            color   = ?,
                                            type    = ?,
                                            og      = ?,
                                            abv     = ?,
                                            ibu     = ?,
                                            ".($sImage?"image   = '{$sImage}',":'')."
                                            available   = ?d
                                        WHERE
                                            id  = ?d
                                        LIMIT 1;",
                                        trim($_POST['title']),
                                        trim($_POST['title_sub']),
                                        trim($_POST['text']),
                                        $_POST['date_e'] ? date('Y-m-d', strtotime($_POST['date_e'])) : '',
                                        trim($_POST['color']),
                                        $_POST['type'],
                                        trim($_POST['og']),
                                        trim($_POST['abv']),
                                        trim($_POST['ibu']),
                                        $_POST['available'],
                                        $_POST['id']);
            $this->view->assign('sSuccess', 'Изменения сохранены');
        }
        
        $aData  = $this->db->select("SELECT * FROM ?_sort ORDER BY `sort` ASC;");
        
        $this->view->assign('sMenuActive',  'beer');
        $this->view->assign('aData',        $aData);
    }
    
    private function _uploadImage($sName){
        if (isset($_FILES[$sName]) && $_FILES[$sName]['error'] == 0){
            require_once ROOT.'/lib/Zebra_Image.php';
            $oZebra =   new \Zebra_Image();
            $sImage =   $this->config->templates->path.'/img/u/'.$_FILES[$sName]['name'];
            
            $oZebra->preserve_aspect_ratio   = false;
            $oZebra->source_path    = $_FILES[$sName]['tmp_name'];
            $oZebra->target_path    = ROOT.$sImage;
            $oZebra->resize($this->config->image->width, $this->config->image->height, ZEBRA_IMAGE_BOXED);

            return $sImage;
        } else {
            return false;
        }
    }
    
    
}