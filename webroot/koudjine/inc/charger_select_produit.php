<?php
require_once('database.php');

global $pdo;
global $conndb;

//On sélectionne tous les users dont le nom = Pierre
$nom = $_POST["nom"];
if (isset($_POST["nom"])) {
    $list = explode(' ', trim($nom));
    $motclef = '%' . $list[0] . '%';
    $q = array('motclef' => $motclef );
    $sth = $pdo->prepare("
              SELECT *
              FROM produit
              WHERE nom like :motclef AND supprimer = 0 
              
            ");
    $sth->execute($q);
    $count = $sth->rowCount();

    if ($count) {
        $i = 1;
        while ($result = $sth->fetch(PDO::FETCH_OBJ)) {

            //echo "<option value='".$result->id."'>".$result->nom."</option>";
            echo '<li data-original-index="'.$i.'"><a tabindex="'.$i.'" class="" style="" data-tokens="null"><span class="text">'.$result->nom.'</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>';
            //echo "<li  style=\"background-color: #fff; list-style-type: none; margin: 0; padding: 0;\"><tr><a href=\"update/".$result->id."\" style=\"display:block; height: 25px; color: #000; text-decoration: none;\"><td>$result->nom</td></a><td>$result->stock</td><tr>$result->reductionMax</tr></li>";
            $i++;
        }
    } else {
        echo "Aucun résultat pour le mot : " . $_GET["motclef1"];
    }
}
