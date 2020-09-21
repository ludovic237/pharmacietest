<?php
require_once('database.php');

global $pdo;
global $conndb;

//On sélectionne tous les users dont le nom = Pierre
if (isset($_GET["motclef1"])) {
    $motclef = '%' . $_GET["motclef1"] . '%';
    $q = array('motclef' => $motclef . '%');
    $sth = $pdo->prepare("
              SELECT p.nom, r.quantite, r.reduction, p.reductionMax, r.prixAchat, r.prixVente, r.id as id, r.dateLivraison, p.id as idp 
              FROM produit p, en_rayon r
              WHERE p.nom like :motclef AND p.id = r.produit_id AND r.dateLivraison IN (select max(dateLivraison) from en_rayon e where r.produit_id = e.produit_id )
              
            ");
    $sth->execute($q);
    $count = $sth->rowCount();

    if ($count) {
        while ($result = $sth->fetch(PDO::FETCH_OBJ)) {
            echo "<tr id=\"R" . $result->idp . "\">
                                            <td class='nom'><strong>" . $result->nom . "</strong></td>

                                            <td>
                                                <button class=\"btn btn-primary \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"load_produit('" . $result->idp . "','" . $result->nom . "','" . $result->prixAchat . "','" . $result->prixVente . "')\"><span class=\"\">Charger</span></button>
                                            </td>
                                        </tr>";
            //echo "<li  style=\"background-color: #fff; list-style-type: none; margin: 0; padding: 0;\"><tr><a href=\"update/".$result->id."\" style=\"display:block; height: 25px; color: #000; text-decoration: none;\"><td>$result->nom</td></a><td>$result->stock</td><tr>$result->reductionMax</tr></li>";
        }
    } else {
        echo "Aucun résultat pour le mot : " . $_GET["motclef1"];
    }
}
