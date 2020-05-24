<?php
function debug($var){

   if(Conf::$debug>0){
       $debug = (debug_backtrace());
       echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].' </strong> l.'.$debug[0]['line'].'</a></p>';
       echo '<ol style="display: none;">';
       foreach($debug as $k=>$v){if($k>0){
           echo'<li><strong>'.$v['file'].' </strong> l.'.$v['line'].'</li>';
       }}
       echo '</ol>';
       echo '<pre>';
       print_r($var);
       echo '</pre>';
   }

}
function dateFrancais($arg){
    $NomDuJour = array ("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    $NomDuMois = array ("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
    $lejour = date("d",$arg);
    $lemois = date("m",$arg);


    $ladatefr=$NomDuJour[ date('w',$arg) ]." ";

    if($lejour==01){$ladatefr.=" 1er "; }
    else if($lejour<10){$ladatefr.=" $lejour[1] "; }
    else { $ladatefr.=date (" d ",$arg); }

    $ladatefr.=$NomDuMois[ date($lemois - 1) ]." ".date('Y',$arg);

    return $ladatefr;

}

function dateJourFrancais($arg){
    $NomDuJour = array ("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    $NomDuMois = array ("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
    $lejour = date("d",$arg);
    $lemois = date("m",$arg);


    $ladatefr=$NomDuJour[ date('w',$arg) ]." ";

    if($lejour==01){$ladatefr.=" 1er "; }
    else if($lejour<10){$ladatefr.=" $lejour[1] "; }
    else { $ladatefr.=date (" d ",$arg); }

    return $ladatefr;

}
function heure($duree){

    $min = $duree%60;
    $heure =  ($duree-$min)/60;
    if($min <= 9)
        return "0".$heure."h0".$min;
    else
        return "0".$heure."h".$min;

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
        //$str = wd_remove_accents($str);
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
        //$str=preg_replace('/\s/', '', $str); supprime les doubles espaces
        $str = str_replace(' - ','-',$str);
        $str = str_replace(' ','',$str);
        $str = strtolower($str);
        return $str;
    }

}