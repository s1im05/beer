<?="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";?>
<rss
    version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <atom:link href="http://<?=$_SERVER['HTTP_HOST']?>/rss" rel="self" type="application/rss+xml" />
        <title><![CDATA[<?=$aRss['title']?>]]></title>
        <link>http://<?=$_SERVER['HTTP_HOST']?>/rss</link>
        <description><![CDATA[<?=$aRss['description']?>]]></description>
        <pubDate><?=date('r')?></pubDate>
        <lastBuildDate><?=date('r')?></lastBuildDate>
        <managingEditor>me@vsul.ru (Vadim Suleimanov)</managingEditor>
        <webMaster>me@vsul.ru (Vadim Suleimanov)</webMaster>
        <copyright><?=$_SERVER['HTTP_HOST']?></copyright>
        <image>
            <url>http://<?=$_SERVER['HTTP_HOST']?>/templates/default/img/tyampuru.png</url>
            <title><![CDATA[<?=$aRss['title']?>]]></title>
            <link>http://<?=$_SERVER['HTTP_HOST']?>/rss</link>
        </image>
        <generator>S.S.C.E.</generator>
        <language>ru</language>
        <docs>http://blogs.law.harvard.edu/tech/rss</docs>
        <?foreach ($aRss['items'] as $aItem) :?>
        <item>
            <title><![CDATA[<?=$aItem['title']?>]]></title>
            <link>http://<?=$_SERVER['HTTP_HOST']?>/post/<?=$aItem['id']?></link>
            <guid>http://<?=$_SERVER['HTTP_HOST']?>/post/<?=$aItem['id']?></guid>
            <description><![CDATA[
                <?=$aItem['description']?> 
                <p><a href="http://<?=$_SERVER['HTTP_HOST']?>/post/<?=$aItem['id']?>">Смотреть целиком</a></p>
                <? if ($aItem['tags']) :?>
                <div class="b-post__tags h-clear">
                    <? foreach ($aItem['tags'] as $aTag) :?>
                        <a style="color:#000;padding:.5em 1em;margin-right:1em;border-radius:4px;background:#ccc;text-decoration:none;" href="/tag/<?=$aTag[0]?>">#<?=$aTag[1]?></a>
                    <? endforeach;?>
                </div>
                <? endif;?>
            ]]></description>
            <content:encoded><![CDATA[
                <?=$aItem['description']?> 
                <p><a href="http://<?=$_SERVER['HTTP_HOST']?>/post/<?=$aItem['id']?>">Смотреть целиком</a></p>
                <? if ($aItem['tags']) :?>
                <div class="b-post__tags h-clear">
                    <? foreach ($aItem['tags'] as $aTag) :?>
                        <a style="color:#000;padding:.5em 1em;margin-right:1em;border-radius:4px;background:#ccc;text-decoration:none;" href="/tag/<?=$aTag[0]?>">#<?=$aTag[1]?></a>
                    <? endforeach;?>
                </div>
                <? endif;?>
            ]]></content:encoded>
            <pubDate><?=date('r', strtotime($aItem['date']))?></pubDate>
            <source url="http://<?=$_SERVER['HTTP_HOST']?>/post/<?=$aItem['id']?>"><?=$aRss['title']?></source>
        </item>
        <? endforeach;?>
    </channel>
</rss>