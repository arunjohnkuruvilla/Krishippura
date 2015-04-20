<?php 
  require_once('../workspace/config.php');
  require_once('../workspace/initialize_database.php');
  $i = 0;
  $arr = array();                           //Variable to hold the json array
  $get_primary = $mysqli->query("SELECT cat_id, cat_name FROM primary_category");
  //$arr['primary_count'] = $get_primary->num_rows;          
  
  while($get_primary_list = $get_primary->fetch_assoc()) {

    $primary_category_id = $get_primary_list['cat_id'];
    $primary_category_name = $get_primary_list['cat_name'];

    $options = array();

    $get_secondary = $mysqli->query("SELECT * FROM secondary_category WHERE primary_cat = '$primary_category_id'");
    //$secondary_category = array();

    //$category['secondary_count'] = $get_secondary->num_rows;

    

    while($get_secondary_list = $get_secondary->fetch_assoc()) {
      $sub_item = array();
      //array_push($sub_item, $get_secondary_list['sub_cat']);
      //array_push($sub_item, $get_secondary_list['cat_name']);
      $sub_item['id'] = $get_secondary_list['sub_cat'];
      $sub_item['name'] = $get_secondary_list['cat_name'];
      array_push($options, $sub_item);
    }

    //$category['options'] = $options;
    array_push($arr, $options);
  }
  $json = json_encode($arr);
  print_r($json);
?>    