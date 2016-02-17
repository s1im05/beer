<?php
class Rss_Controller extends Controller {
    
    protected $_sLayout     = 'rss.php';


    public function rssAction(){
        $aRss   = array(
            'title'         => 'Тямпуру! Все только самое отборное и интересное!',
            'description'   => '',
            'items'         => $this->db->select("SELECT
                                                            p.id,
                                                            p.title,
                                                            p.announce AS description,
                                                            p.cdate AS date,
                                                            p.tags
                                                        FROM
                                                            ?_posts p
                                                        WHERE
                                                            p.cdate < NOW()
                                                        ORDER BY
                                                            p.id DESC
                                                        LIMIT 50;"));
        if ( !empty( $aRss['items'] ) ) {
            foreach ( $aRss['items'] as $iKey => $aVal ) {
                $aRss['items'][$iKey]['description']    = str_replace( '<img','<img style="max-width: 570px;"', $aVal['description']);
                $aRss['items'][$iKey]['tags']           = prepareTags($aVal['tags']);
            }
        }
        $this->view->assign('aRss', $aRss);
    }

}