<?php
require_once('database.php');
require_once('../Class/commande.php');

global $pdo;
global $conndb;

$manager = new CommandeManager($pdo);

//On sélectionne tous les users dont le nom = Pierre
if (isset($_POST["motclef"])) {
    $motclef = $_POST["motclef"];
    $idf = $_POST["idf"];

    $sth = $pdo->prepare("
              SELECT p.nom,p.reference, r.quantite, r.reduction, p.reductionMax, r.prixAchat, r.prixVente, r.id as id, r.dateLivraison, p.id as idp 
              FROM produit p, en_rayon r
              WHERE p.ean13 = :motclef AND p.id = r.produit_id AND p.supprimer = 0 AND r.dateLivraison IN (select max(dateLivraison) from en_rayon e where r.produit_id = e.produit_id )
               ");
    //echo $sth;
    $sth->bindValue('motclef', $motclef);
    $sth->execute();
    $count = $sth->rowCount();
    if ($count) {
        while ($result = $sth->fetch(PDO::FETCH_OBJ)) {
            $nbre_cmd = $manager->countNbreProduitParJour($result->idp, $idf);
            $donnees = array('erreur' =>'non', 'find' => 'oui','id' => $result->idp,'reference' => $result->reference, 'nom' => $result->nom, 'prixV' => $result->prixVente, 'prixA' => $result->prixAchat, 'reduction' => $result->reductionMax, 'nbre_cmd' => $nbre_cmd);
            echo json_encode($donnees);
        }

    } else {
        $donnees = array('erreur' =>"Aucun résultat pour l'id: ".$motclef);
        echo json_encode($donnees);
    }
}
