<?php
require_once('database.php');
require_once('../Class/commande.php');

global $pdo;
global $conndb;

$manager = new CommandeManager($pdo);
//On sélectionne tous les users dont le nom = Pierre
if (isset($_GET["motclef1"])) {
    $motclef = '%' . $_GET["motclef1"] . '%';
    $idf = $_GET["idf"];
    $q = array('motclef' => $motclef . '%');
    $sth = $pdo->prepare("
              SELECT p.nom, p.ean13, r.quantite, r.reduction, p.reductionMax, r.prixAchat, p.reference, r.prixVente, r.id as id, r.dateLivraison, p.id as idp 
              FROM produit p, en_rayon r
              WHERE p.nom like :motclef AND p.grossiste_id = '' AND p.id = r.produit_id AND p.supprimer = 0 AND r.dateLivraison IN (select max(dateLivraison) from en_rayon e where r.produit_id = e.produit_id )
              
            ");
    $sth->execute($q);
    $count = $sth->rowCount();

    if ($count) {
        while ($result = $sth->fetch(PDO::FETCH_OBJ)) {
            $nbre_cmd = $manager->countNbreProduitParJour($result->idp, $idf);
            echo "<tr id=\"R" . $result->idp . "\">
                                            <td class='nom'><strong>" . $result->nom . "</strong></td>

                                            <td>
                                                <button class=\"btn btn-primary \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"load_produit('" . $result->idp . "','" . $result->reference . "','" . $result->nom . "','" . $result->prixAchat . "','" . $result->prixVente . "','" . $result->reductionMax . "', '" . $nbre_cmd . "', '" . $result->ean13 . "')\"><span class=\"\">Charger</span></button>
                                            </td>
                                        </tr>";
            //echo "<li  style=\"background-color: #fff; list-style-type: none; margin: 0; padding: 0;\"><tr><a href=\"update/".$result->id."\" style=\"display:block; height: 25px; color: #000; text-decoration: none;\"><td>$result->nom</td></a><td>$result->stock</td><tr>$result->reductionMax</tr></li>";
        }
    } else {
        echo "Aucun résultat pour le mot : " . $_GET["motclef1"];
    }
}
