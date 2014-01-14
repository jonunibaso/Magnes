<?
function xml_entities($string) {
    return strtr(
        $string, 
        array(
            "<" => "&lt;",
            ">" => "&gt;",
            '"' => "&quot;",
            "'" => "&apos;",
            "&" => "&amp;",
        )
    );
}?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:admin="http://webns.net/mvcb/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title><?=$titulo?></title>
        <link><?=$feed_url?></link>
        <atom:link href="<?=$feed_url?>/feed" rel="self" type="application/rss+xml" />
        <description><?=$description?></description>
        <language>es-es</language>
        <pubDate><?=$pubdate?></pubDate>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>1</sy:updateFrequency>
        <lastBuildDate><?=$pubdate?></lastBuildDate>
        <docs>http://www.rssboard.org/rss-specification</docs>
        <generator>The Magnes RSS</generator>
        <managingEditor>info@themagnes.com</managingEditor>
        <webMaster>info@themagnes.com</webMaster>
        <?php foreach ($posts as $post): ?>
            <item>
                <title><? echo xml_entities($post->artist_name)." - ".xml_entities($post->title);
                if($post->label_name!=""){
                    echo " [".xml_entities($post->label_name)."]";
                }
                if($post->date!=""){
                    echo " (".xml_entities($post->date).")";
                }
                ?></title>
                <link><?=base_url('release/download/'.$post->slug)?></link>
                <description><![CDATA[<? 
                    echo xml_entities($post->artist_name)." - ".xml_entities($post->title);
                if($post->label_name!=""){
                    echo " [".xml_entities($post->label_name)."]";
                }
                if($post->date!=""){
                    echo " (".xml_entities($post->date).")";
                }
            ?>]]></description>
            <pubDate><?
        list($date, $time) = explode(' ', $post->insertedDate);
        list($year, $month, $day) = explode('-', $date);
        list($hour, $minute, $second) = explode(':', $time);
        
        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
        $fecha =  date('r', $timestamp);

        echo $fecha;
            ?></pubDate>
            <dc:creator>The Magnes</dc:creator>
            <category><![CDATA[<?=$post->genre?>]]></category>
            <guid isPermaLink="true"><?=base_url('release/download/'.$post->slug)?></guid>
            <content:encoded><![CDATA[<?
            echo xml_entities($post->artist_name)." - ".xml_entities($post->title);
                if($post->label_name!=""){
                    echo " [".xml_entities($post->label_name)."]";
                }
                if($post->date!=""){
                    echo " (".xml_entities($post->date).")";
                }
                echo " Tracklist: ".xml_entities($post->tracklist);
    $this->load->database();
    $this->db->from('link_group');
    $this->db->select('*, link_group.id as link_group_id');
    $this->db->join('link', 'link_group.id = link.link_group_id');
    $this->db->where('link_group.release_id', $post->release_id);
    $this->db->order_by("link_group.inactive", "asc");
    $query = $this->db->get();
    foreach ($query->result() as $row) {   
    echo "<br />Direct download from: ".$row->server.": ".$row->url;
}
?>]]></content:encoded>
</item>    
<?php endforeach;?>
</channel>
</rss>

