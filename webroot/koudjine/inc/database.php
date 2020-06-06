<?php
/*$hostname = "localhost";
$database = "conseil_d_orientation";
$username = "root";
$password  = "";
$conndb = mysql_pconnect($hostname,$username,$password) or trigger_error(mysql_error());*/

$pdo = new PDO('mysql:host=localhost;dbname=pharmanet', 'root', '', array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

function genererID(){
    $id = date('ymdHis');
    //echo gettype($id);
    //$idall = floatval($id);
    if($id[0] == 0){
        $id[0] = 4;
    }
    return $id;
}
function wd_remove_accents($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;
}
function genererSlug($str){
    if( strstr($str, '\'')) {
        list($part1, $part2) = explode("'", $str);
        $part1 = substr($part1,0,-1);
        $part1 = str_replace(' - ','-',$part1);
        $part2 = str_replace(' - ','-',$part2);
        $part1 = str_replace(' ','-',$part1);
        $part2 = str_replace(' ','-',$part2);
        $part1 = wd_remove_accents($part1);
        $part2 = wd_remove_accents($part2);
        $part1 = strtolower($part1);
        $part2 = strtolower($part2);
        return $part1.$part2;
    }else{
        $str = wd_remove_accents($str);
        $str = str_replace(' - ','-',$str);
        $str = str_replace(' ','-',$str);
        $str = strtolower($str);
        return $str;
    }

}
?>
