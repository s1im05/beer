<?php
class Home_Controller extends Controller {
    
    protected $_sTemplate   = 'home.php';
    protected $_sLayout     = 'index.php';
    

    public function indexAction(){
        $oUser   = new User_Model($this->options);
        if (!$oUser->isLogged()){
            $this->request->go('/');
        }
        
        if (isset($_POST['save'])){
            $this->_save();
        }
        
        if (isset($_POST['view_type'])){
            $sType  = $_POST['view_type'] == 'list' ? 'list':'thumb';
            setcookie('vt', $sType, strtotime('+30 days'), '/', '', false, true);
            $this->view->assign('sViewType', $sType);
        } else {
            $this->view->assign('sViewType', isset($_COOKIE['vt'])?($_COOKIE['vt']=='list' ? 'list':'thumb'):'thumb');
        }
        
        $this->setTitle('Домашняя страница');
    }
    
    public function getCommentAction($iPage){
        
        $oUser   = new User_Model($this->options);
        if (!$oUser->isLogged()){
            return;
        }
        
        $iLimit = (int)$this->config->project->postsppage;
        
        $aComments  = $this->db->selectPage($iCnt,"SELECT
                                                    c.*,
                                                    p.title,
                                                    p.thumb
                                                FROM
                                                    ?_comments c,
                                                    ?_posts p
                                                WHERE
                                                    p.id        = c.post_id AND
                                                    c.user_id   = ?d
                                                ORDER BY
                                                    c.cdate DESC
                                                LIMIT ?d, ?d",
                                                $oUser->id,
                                                $iPage*$iLimit,
                                                $iLimit);
                                                
        $this->setLayout('ajax_template.php');
        $this->setTemplate('home_list_comments.php');
        
        $this->view->assign('aCommentList',     $aComments);
        $this->view->assign('iPage',            $iPage);
        $this->view->assign('bAllLoaded',       ($iPage+1)*$iLimit >= $iCnt);
    }
    
    public function getLikeAction($iPage){
        
        $oUser   = new User_Model($this->options);
        if (!$oUser->isLogged()){
            return;
        }
        
        $iLimit = (int)$this->config->project->postsppage;
        
        $aLikes = $this->db->selectPage($iCnt,"SELECT
                                                    p.*,
                                                    c.title AS chapter_title,
                                                    c.class AS chapter_name,
                                                    pl.cdate AS like_date,
                                                    true AS like_state
                                                FROM
                                                    ?_posts p,
                                                    ?_chapters c,
                                                    ?_posts__likes pl
                                                WHERE
                                                    p.id        = pl.post_id AND
                                                    c.id        = p.chapter_id AND
                                                    pl.user_id  = ?d AND
                                                    pl.state    = 1
                                                ORDER BY
                                                    pl.cdate DESC
                                                LIMIT ?d, ?d",
                                                $oUser->id,
                                                $iPage*$iLimit,
                                                $iLimit);
                                                
        $this->setLayout('ajax_template.php');
        $this->setTemplate('home_list_likes.php');
                                                
        $this->view->assign('aPostList',    $aLikes);
        $this->view->assign('iPage',        $iPage);
        $this->view->assign('bAllLoaded',   ($iPage+1)*$iLimit >= $iCnt);
        $this->view->assign('sViewType', isset($_COOKIE['vt'])?($_COOKIE['vt']=='list' ? 'list':'thumb'):'thumb');
    }
    
    private function _save(){
        $sNickname  = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
        if ($sNickname){
            $_SESSION['user']['nickname'] = $sNickname;
        } else {
            $this->view->assign('sError', 'Ошибка сохранения поля "Никнейм"');
            return;
        }
        
        $cGender    = isset($_POST['gender'])?$_POST['gender']:'U';
        if (in_array($_POST['gender'], array('M','F','U'))){
            $_SESSION['user']['gender'] = $cGender;
        } else {
            $this->view->assign('sError', 'Ошибка сохранения поля "Пол"');
            return;
        }
        
        $this->db->query("UPDATE LOW_PRIORITY ?_users SET nickname = ?, gender = ? WHERE id = ?d LIMIT 1;", $sNickname, $cGender, $_SESSION['user']['id']);
        $this->view->assign('sSuccess', 'Успешно сохранено');
    }
}