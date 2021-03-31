<?php
/*$hostname = "localhost";
$database = "conseil_d_orientation";
$username = "root";
$password  = "";
$conndb = mysql_pconnect($hostname,$username,$password) or trigger_error(mysql_error());*/

$pdo = new PDO('mysql:host=localhost;dbname=pharmanet1', 'root', '', array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

function genererID(){
    $id = date('YmdHis');
    //echo gettype($id);
    //$idall = floatval($id);
    if($id[0] == 0){
        $id[0] = 4;
    }
    return $id;
}
function genererCodebarreID(){
    $id = date('ymdHis');
    return $id;
}
function genererreference($num){
    //DEBUT PROGRAMME - CREATION REFERENCE EN AUTOMATIQUE - DEBUT PROGRAMME

// Ici je souhaite créer la référence
// La première étape consiste à me donner accès à la base de données

    //$Acces_Registre_RefPDP = $Bdd -> query('SELECT * FROM MaTable');

// Je veux créer une référence
// Cette dernière commence par la date
// Je regarde dans un premier temps si aucune référence n'a été fait ce jour

// Je récupère la date du jour et la découpe en AA MM et JJ

    $Date_Du_Jour = date("y-m-d");

    $Annee = substr($Date_Du_Jour, 0, 2);
    $Mois = substr($Date_Du_Jour, 3,2);
    $Jour = substr($Date_Du_Jour, 6,2);

    $Numero_Reg_Big = $num;

// Je regarde désormais dans ma table dans l'ordre suivant Si AA => MM => JJ
// Pour cela je parcours toute ma table avec un while


    $Numero_Reg_Big = $Numero_Reg_Big + 1;

    // NOus allons maintenant faire en sorte de toujours avoir 4 numéros pour notre
    // Numero_Reg_Big

    if ($Numero_Reg_Big < 10)
    {
        $Numero_Reg_Big = '00' . $Numero_Reg_Big;
    }
    elseif ($Numero_Reg_Big <100)
    {
        $Numero_Reg_Big = '0' . $Numero_Reg_Big;
    }
    else
    {
        $Numero_Reg_Big = $Numero_Reg_Big;
    }

    return "ALS".$Annee.$Mois.$Jour."-".$Numero_Reg_Big;

    // FIN PROGRAMME - CREATION REFERENCE EN AUTOMATIQUE - FIN PROGRAMME

}
function genererreferenceCommande($num){
    //DEBUT PROGRAMME - CREATION REFERENCE EN AUTOMATIQUE - DEBUT PROGRAMME

// Ici je souhaite créer la référence
// La première étape consiste à me donner accès à la base de données

    //$Acces_Registre_RefPDP = $Bdd -> query('SELECT * FROM MaTable');

// Je veux créer une référence
// Cette dernière commence par la date
// Je regarde dans un premier temps si aucune référence n'a été fait ce jour

// Je récupère la date du jour et la découpe en AA MM et JJ

    $Date_Du_Jour = date("Y-m-d");

    $Annee = substr($Date_Du_Jour, 0, 4);
    $Mois = substr($Date_Du_Jour, 5,2);
    $Jour = substr($Date_Du_Jour, 8,2);

    $Numero_Reg_Big = $num;

// Je regarde désormais dans ma table dans l'ordre suivant Si AA => MM => JJ
// Pour cela je parcours toute ma table avec un while


    $Numero_Reg_Big = $Numero_Reg_Big + 1;

    // NOus allons maintenant faire en sorte de toujours avoir 4 numéros pour notre
    // Numero_Reg_Big

    if ($Numero_Reg_Big < 10)
    {
        $Numero_Reg_Big = '00' . $Numero_Reg_Big;
    }
    elseif ($Numero_Reg_Big <100)
    {
        $Numero_Reg_Big = '0' . $Numero_Reg_Big;
    }
    else
    {
        $Numero_Reg_Big = $Numero_Reg_Big;
    }

    return "ALS".$Annee.$Mois."COM".$Numero_Reg_Big;

    // FIN PROGRAMME - CREATION REFERENCE EN AUTOMATIQUE - FIN PROGRAMME

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

function generercodefournisseur($num){
    //DEBUT PROGRAMME - CREATION REFERENCE EN AUTOMATIQUE - DEBUT PROGRAMME

    $Numero_Reg_Big = $num;

    $Numero_Reg_Big = $Numero_Reg_Big + 1;

    // NOus allons maintenant faire en sorte de toujours avoir 4 numéros pour notre
    // Numero_Reg_Big

    if ($Numero_Reg_Big < 10)
    {
        $Numero_Reg_Big = '0' . $Numero_Reg_Big;
    }
    else
    {
        $Numero_Reg_Big = $Numero_Reg_Big;
    }

    return $Numero_Reg_Big;

    // FIN PROGRAMME - CREATION REFERENCE EN AUTOMATIQUE - FIN PROGRAMME

}
?>
