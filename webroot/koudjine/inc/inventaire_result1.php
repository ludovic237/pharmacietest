<?php
require_once('database.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;
global $conndb;
$managerEnRayon = new En_rayonManager($pdo);
$managerProduit = new ProduitManager($pdo);

    if (isset($_GET["motclef"])) {
        $motclef = $_GET["motclef"];
        //echo $motclef;

        $sth = $pdo->prepare("
              SELECT *
              FROM en_rayon, produit
              WHERE produit.id = en_rayon.produit_id AND en_rayon.id = :motclef AND produit.supprimer = 0
            ");
        //echo $sth;
        $sth->bindValue('motclef', $motclef);
        $sth->execute();
        $count = $sth->rowCount();

        if ($count) {
            while ($result = $sth->fetch(PDO::FETCH_OBJ)) {
                $datelivraison = $result->dateLivraison;
                $dateActuelle = new DateTime();
                $perime = new DateTime($result->datePeremption);
                if ($dateActuelle > $perime) {
                    $statut_perime = "oui";
                }else{
                    $statut_perime = "non";
                }
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
                $datel = $date->format('d-m-Y');
                $enRayon = $managerEnRayon->get($motclef);
                if (!empty($enRayon) || $enRayon!=null || $enRayon!=false){
                    $type = "en rayon";
                }
                else {
                    $type = "detail";
                }

                $dateActuelle = new DateTime();
                $statut = "";
                $perime = new DateTime($enRayon->datePeremption());
                $interval = $dateActuelle->diff($perime);

                if ($dateActuelle > $perime) {
                    // Si la date de péremption est passée
                    $statut = '<span class="badge badge-danger badge-pill ml-2 perime" style="font-size:90%">Périmé</span>';
                } elseif ($interval->days <= 30 && $dateActuelle < $perime) {
                    // Si la date de péremption est dans 1 mois ou moins
                    $statut = '<span class="badge badge-warning badge-pill ml-2" style="font-size:90%">Expire dans ' . $interval->days . ' jour(s)</span>';
                } else {
                    // Si la date de péremption est encore dans le futur (plus d'un mois)
                    $statut = '<span class="badge badge-success badge-pill ml-2" style="font-size:90%">Encore valide</span>';
                }
                $donnees = array('erreur' =>'non', 'statut_perime' => $statut_perime, 'find' => 'oui',
                    'nom' => "<span ><strong class='nom'>" . $result->nom . " " . $statut . "</strong></span>",
                    'prix' => $result->prixVente, 'reduction' => $result->reduction, 'datel' => $datel, 'stock' => $result->stock-1, 'quantiteRestante' => $result->quantiteRestante, 'type' => $type);
                    echo json_encode($donnees);
            }
        }
        else{
            //echo "Aucun résultat pour l'id: ".$motclef;
            $sth = $pdo->prepare("
              SELECT *
              FROM produit
              WHERE ean13 = :motclef AND supprimer = 0
            ");
            //echo $sth;
            $sth->bindValue('motclef', $motclef);
            $sth->execute();
            $count = $sth->rowCount();
            if ($count) {
                while ($result = $sth->fetch(PDO::FETCH_OBJ)) {

                    $donnees = array('erreur' =>"Aucun résultat pour l'id: ".$motclef, 'find' => 'non', 'id' => $result->id);
                    echo json_encode($donnees);
                }
            }

        }


    }

        ?>