<?php
include_once('includes/config.inc.php');

$query="SELECT link.*,category.name as category_name FROM link LEFT JOIN category ON category.id=link.category_id WHERE active=1 ORDER BY category.name ASC, link.name ASC";
$result=mysql_query($query);
$category_name='';
if($result && mysql_num_rows($result)>0) {
    while($data=mysql_fetch_array($result)) {
        if(stristr($data['url'],'http')) {
        }
        else {
            $data['url']='http://'.$data['url'];
        }
        if($data['category_name']<>$category_name) {
            $category_name=$data['category_name'];
            $link_list.='<h2>'.$data['category_name'].'</h2>';
        }
        $link_list.='<p><strong><a href="'.$data['url'].'" target="_blank">'.$data['name'].'</a></strong><br />';
        $link_list.=$data['description'].'<br />';
        $link_list.='<i><small>'.$data['url'].'</small></i></p>';
    }
}
?>

<!--
Header here
-->

<?php echo $link_list;?>

<!--
Footer here
-->

