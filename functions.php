<?php
function text_to_link($text) {
    preg_match_all("/\[\[[a-zA-Z ]*\]\]/", $text, $output_array);
    foreach ($output_array[0] as &$value) {
        $len = strlen($value);
        $value_new = substr($value, 2, $len-4);
        $value_link = preg_replace("/[ ]/", "_", $value_new);
        $link = '<a href="articles/'.$value_link.'" class="true-link">'.$value_new.'</a>';
        $text = str_replace($value, $link, $text);
    }
    return $text;
}

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
?>