<?php 
/*require_once("./workspace/config.php");
require_once("./workspace/initialize_database.php"); 

echo "INSERT INTO `prototype`.`category` (`cat_id`, `primary_cat`, `sub_cat`, `cat_name`) VALUES ('2', '1', 'B', 'Flowers');";
echo "<br/>INSERT INTO `prototype`.`category` (`cat_id`, `primary_cat`, `sub_cat`, `cat_name`) VALUES ('3', '1', 'C', 'Leaves');";
echo "<br/>INSERT INTO `prototype`.`category` (`cat_id`, `primary_cat`, `sub_cat`, `cat_name`) VALUES ('4', '1', 'D', 'Roots');";
echo "<br/>INSERT INTO `prototype`.`category` (`cat_id`, `primary_cat`, `sub_cat`, `cat_name`) VALUES ('5', '2', 'A', 'Alappuzha');";
echo "<br/>INSERT INTO `prototype`.`category` (`cat_id`, `primary_cat`, `sub_cat`, `cat_name`) VALUES ('6', '2', 'B', 'Ernakulam');";
echo "<br/>INSERT INTO `prototype`.`category` (`cat_id`, `primary_cat`, `sub_cat`, `cat_name`) VALUES ('7', '2', 'C', 'Idukki');";
echo "<br/>INSERT INTO `prototype`.`category` (`cat_id`, `primary_cat`, `sub_cat`, `cat_name`) VALUES ('8', '2', 'D', 'Kannur');";

$text = "Lorem ipsum dolor sit amet, consectetur [[Fish]] adipisicing elit, sed do eiusmod [[Harry Potter]]";
//echo $text;
//echo "<br/>";
function verify_internal_link($link) {
    global $mysqli;
    $title_query = $mysqli->query("SELECT page_title FROM page WHERE page_title='$link'");
    if($title_query->num_rows == 0) return FALSE;
    else return TRUE;
}
function text_to_link($text) {
    preg_match_all("/\[\[[a-zA-Z ]*\]\]/", $text, $output_array);
    foreach ($output_array[0] as &$value) {
        $len = strlen($value);
        $value_new = substr($value, 2, $len-4);
        if(verify_internal_link($value_new)) {
            $value_link = preg_replace("/[ ]/", "_", $value_new);
            $link = '<a href="articles/'.$value_link.'" class="true-link">'.$value_new.'</a>';
            $text = str_replace($value, $link, $text);
        }
        else {
            $value_link = preg_replace("/[ ]/", "_", $value_new);
            $link = '<a href="#" class="false-link" style="color:red">'.$value_new.'</a>';
            $text = str_replace($value, $link, $text);
        }
        
    }
    return $text;
}
$text = text_to_link($text);
//echo $text;
//echo "<br/>";   
/*
function link_to_text($text) {
    preg_match_all("/\<a href=\"[a-zA-Z_\/]*\" class=\"[a-zA-Z-]*\">[a-zA-Z ]*<\/a>/", $text, $output_array);

    foreach ($output_array[0] as &$value) {
        preg_match("/>[a-zA-Z ]*</", $value, $output_value);
        $len = strlen($output_value[0]);
        $value_new = substr($output_value[0], 1, $len-2);
        $value_new = '[['.$value_new.']]';
        $text = str_replace($value, $value_new, $text);
    }    
    return $text;
}


$text = text_to_link($text);
echo $text;
echo "<br/>";

$text = link_to_text($text);
echo $text;*/

$var = "Once upon a time in a dense forest Superman lived greatly ever after forever evermore --http://www.example.com++Link title--";
    $word = preg_quote("Superman");
    $text = preg_match("/--[a-zA-Z\+\.:\/ ]*--/", $var, $matches);
    echo count($matches[0]);
?>
