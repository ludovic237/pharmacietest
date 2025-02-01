<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/produit_detail.php');
require_once('../Class/en_rayon.php');

$id;
$fournisseur;
$produit;
global $pdo;
global $conndb;
$managerProduit = new ProduitManager($pdo);
$managerProduitDet = new Produit_detailManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];
if (!isset($_POST['option'])) {
    $produit = $managerProduit->get($id);
    if ($produit->grossiste_id() != '') {
        $enrayon = $managerEnRayon->getListDetail($id);
    } else {
        $enrayon = $managerEnRayon->getList($id);
    }


    $datas = [];


    if (isset($_POST['id']) || isset($_GET['id'])) {


        foreach ($enrayon as $k => $v) :
            $dateActuelle = new DateTime();
            $statut = "";
            $perime = new DateTime($v->datePeremption());
            $interval = $dateActuelle->diff($perime);

            $datelivraison = $v->dateLivraison();
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
            $datel = $date->format('d-m-Y');
            if ($v->reduction() > $produit->reductionMax()) $reduction = $produit->reductionMax();
            else $reduction = $v->reduction();
            if ($v->quantiteRestante() <= $produit->stockMin()) $action = 'style="background: #ff18008a;color: #fff"';
            else $action = '';

            if ($dateActuelle > $perime) {
                // Si la date de péremption est passée
                $statut = '<span class="badge badge-danger badge-pill ml-2 perime" style="font-size:90%">Périmé depuis ' . $interval->days . ' jour(s)</span>';
            } elseif ($interval->days <= 90 && $dateActuelle < $perime) {
                // Si la date de péremption est dans 1 mois ou moins
                $statut = '<span class="badge badge-warning badge-pill ml-2" style="font-size:90%">Périmé dans ' . $interval->days . ' jour(s)</span>';
            } else {
                // Si la date de péremption est encore dans le futur (plus d'un mois)
                $statut = '<span class="badge badge-success badge-pill ml-2" style="font-size:90%">Encore valide</span>';
            }
            $datas[] = array(
                "DT_RowId" => $v->id(),
                'nom' => "<span ><strong class='nom'>" . $produit->nom() . " " . $statut . "</strong></span>",
                //'nom' => "<span ><strong class='nom'>" . $produit->nom() . "</strong></span>",
                'prix' => $v->prixVente(),
                'quantiteRestante' => "<p class='qterest'>
         " . $v->quantiteRestante() . "
     </p>",
                'stockg' => "<p class='stock'>
         " . $produit->stock() . "
     </p>",
                'reduction' => "<p class='reduction'>
         " . $reduction . "
     </p>",
                'datel' => "
         <p class='datel'>
                                                 " . $datel . "
                                             </p>
         ",
                'peremption' => "
         <p class='datePeremption'>
                                                 " . $v->datePeremption() . "
                                             </p>
         ",
                'action' => "<button class=\"btn btn-success \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"addProductInventaireCaractere('" . $v->id() . "')\"><span class=\"\">Ajouté</span></button>"
            );
        endforeach;
    }
} else {
    $produitdet = $managerProduitDet->get($id);


    $datas = [];


    if (isset($_POST['id']) || isset($_GET['id'])) {


        if ($produitdet->stock() <= $produitdet->stockMin()) $action = 'style="background: #ff18008a;color: #fff"';
        else $action = '';

        $datas[] = array(
            "DT_RowId" => $produitdet->id(),
            'nom' => "<span ><strong class='nom'>" . $produitdet->nom() . "</strong></span>",
            //'nom' => "<span ><strong class='nom'>" . $produit->nom() . "</strong></span>",
            'prix' => $produitdet->prix(),
            'quantiteRestante' => "<p class='qterest'>
         " . $produitdet->stock() . "
     </p>",
            'quantiteRestante' => "<p class='stock'>
         " . $produitdet->stock() . "
     </p>",
            'reduction' => "<p class='reduction'>
         " . $produitdet->reductionMax() . "
     </p>",
            'datel' => "
         <p class='datel'>
                                                 
                                             </p>
         ",
            'peremption' => "
         <p class='datePeremption'>
                                                 
                                             </p>
         ",

            'action' => "<button class=\"btn btn-success \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"addProductInventaireCaractere('" . $produitdet->id() . "')\"><span class=\"\">Ajouté</span></button>"
        );
    }
}


if ($datas == null) {
    $donnees = array('data' => []);
    echo json_encode($donnees);
} else {
    $donnees = array('data' => $datas);
    echo json_encode($donnees);
}
