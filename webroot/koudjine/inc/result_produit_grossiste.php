<?php
require_once('database.php');

global $pdo;
global $conndb;

//On sélectionne tous les users dont le nom = Pierre
if (isset($_GET["motclef1"])) {
    $motclef = '%' . $_GET["motclef1"] . '%';
    $q = array('motclef' => $motclef . '%');
    $sth = $pdo->prepare("
              SELECT * 
              FROM produit p
              WHERE p.nom like :motclef AND p.supprimer = 0
              
            ");
    $sth->execute($q);
    $count = $sth->rowCount();

    if ($count) {
        while ($result = $sth->fetch(PDO::FETCH_OBJ)) {
            echo "<tr id=\"D" . $result->id . "\">
                                            <td class='nom'><strong>" . $result->nom . "</strong></td>
                                            <td class='contenu'>" . $result->contenuDetail . "</td>
                                            <td>
                                                <button class=\"btn btn-primary load_grossiste\" data-toggle='tooltip' data-placement='top'    onclick=\"load_grossiste('" . $result->id . "', '" . $result->nom . "', '" . $result->contenuDetail . "', event)\" \"><span>Charger</span></button>
                                            </td>
                                        </tr>";
            //echo "<li  style=\"background-color: #fff; list-style-type: none; margin: 0; padding: 0;\"><tr><a href=\"update/".$result->id."\" style=\"display:block; height: 25px; color: #000; text-decoration: none;\"><td>$result->nom</td></a><td>$result->stock</td><tr>$result->reductionMax</tr></li>";
        }
    } else {
        echo "Aucun résultat pour le mot : " . $_GET["motclef1"];
    }
}
