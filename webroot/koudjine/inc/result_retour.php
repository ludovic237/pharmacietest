<?php
require_once('database.php');

global $pdo;
global $conndb;

//On sélectionne tous les users dont le nom = Pierre
if (isset($_POST["motclef"])) {
    $motclef = $_POST["motclef"];
    //$q = array('motclef' => $motclef . '%');
    $sth = $pdo->prepare("
              SELECT p.nom, c.quantite, c.prixUnit, c.reduction, v.id as idv, c.id as idc
              FROM concerner c, vente v, en_rayon r, produit p
              WHERE c.vente_id = v.id AND v.reference = '".$motclef."' AND c.en_rayon_id = r.id AND p.id = r.produit_id 
              
            ");
    $sth->execute();
    $count = $sth->rowCount();

    if ($count) {
        while ($result = $sth->fetch(PDO::FETCH_OBJ)) {
            echo "<tr data='".$result->idv."' id=\"R".$result->idc."\">
                                            <td class='nom'><strong>".$result->nom."</strong></td>
                                            <td class='prix'>
                                                ".$result->prixUnit."
                                            </td>
                                            <td class='stock'>
                                                ".$result->quantite."
                                            </td>
                                             <td class='reduction'>
                                                ".$result->reduction."
                                            </td>
                                            <td>
                                                <button class=\"btn btn-primary \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"load_produit_retour('".$result->idc."','".$result->idv."')\"><span class=\"\">Charger</span></button>
                                            </td>
                                        </tr>";
            //echo "<li  style=\"background-color: #fff; list-style-type: none; margin: 0; padding: 0;\"><tr><a href=\"update/".$result->id."\" style=\"display:block; height: 25px; color: #000; text-decoration: none;\"><td>$result->nom</td></a><td>$result->stock</td><tr>$result->reductionMax</tr></li>";
        }
    }
    else{
        echo "Aucun résultat pour le mot : ".$_POST["motclef"];
    }


}

?>