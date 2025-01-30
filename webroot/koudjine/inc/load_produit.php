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
            if ($produit->grossiste_id() != '')
                $bouton = "
                            <button class=\"btn btn-primary \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"gerer_detail('" . $v->id() . "')\"><span class=\"\">Augmenter quantité</span></button>
                           ";
            else $bouton = "";

            if ($dateActuelle > $perime) {
                // Si la date de péremption est passée
                $statut = '<span class="badge badge-danger badge-pill ml-2" style="font-size:90%">Périmé</span>';
            } elseif ($interval->days <= 30 && $dateActuelle < $perime) {
                // Si la date de péremption est dans 1 mois ou moins
                $statut = '<span class="badge badge-warning badge-pill ml-2" style="font-size:90%">Expire dans ' . $interval->days . ' jour(s)</span>';
            } else {
                // Si la date de péremption est encore dans le futur (plus d'un mois)
                $statut = '<span class="badge badge-success badge-pill ml-2" style="font-size:90%">Encore valide</span>';
            }
            $datas[] = array(
                "DT_RowId" => $v->id(),
                'nom' => "<span ><strong class='nom'>" . $produit->nom() . " " . $statut . "</strong></span>",
                //'nom' => "<span ><strong class='nom'>" . $produit->nom() . "</strong></span>",
                'prixUnitaire' => "<p class='prix'>
                                                
         <p></p>
         <div class='input-group' style='width:100px;'>
             <span class='input-group-btn'>
                 <button type='button' class='btn btn-default btn-number moins'
                         onclick=\"change_input('moins','inputPrixV" . $v->id() . "')\"
                         style='padding: 4px;'>
                     <span class='glyphicon glyphicon-minus'></span>
                 </button>
             </span>
             <input type='text' name='quant[1]' class='form-control input-number prixv'
             id=\"inputPrixV" . $v->id() . "\"
             value='" . $v->prixVente() . "' style='width: 80px;'>
             <span class='input-group-btn'>
                 <button type='button' class='btn btn-default btn-number plus'
                         onclick=\"change_input('plus','inputPrixV" . $v->id() . "')\"
                         style='padding: 4px;'>
                     <span class='glyphicon glyphicon-plus'></span>
                 </button>
             </span>
         </div>
         <p></p>
     </p>",
                'quantite' => "<p class=''>
         <p></p>
         <div class='input-group' style='width:100px;'>
             <span class='input-group-btn'>
                 <button type='button' class='btn btn-default btn-number moins'
                         onclick=\"change_input_vente('moins','inputQte" . $v->id() . "'," . $v->quantiteRestante() . ")\"
                         style='padding: 4px;'>
                     <span class='glyphicon glyphicon-minus'></span>
                 </button>
             </span>
             <input type='text' name='quant[1]' class='form-control input-number qte'
             id=\"inputQte" . $v->id() . "\"
             value='0' style='width: 80px;'>
             <span class='input-group-btn'>
                 <button type='button' class='btn btn-default btn-number plus'
                         onclick=\"change_input_vente('plus','inputQte" . $v->id() . "'," . $v->quantiteRestante() . ")\"
                         style='padding: 4px;'>
                     <span class='glyphicon glyphicon-plus'></span>
                 </button>
             </span>
         </div>
         <p></p>

     </p>",
                'stockq' => "<p class='qterest'>
         " . $v->quantiteRestante() . "
     </p>",
                'stockg' => "<p class='stock'>
         " . $produit->stock() . "
     </p>",
                'reduction' => "<p class='reduction'>
         " . $reduction . "
     </p>",
                'date' => "
         <p class='datel'>
                                                 " . $datel . "
                                             </p>
         ",
                'peremption' => "
         <p class='datePeremption'>
                                                 " . $v->datePeremption() . "
                                             </p>
         ",
                'action' => $bouton
            );
        endforeach;
    }
} else {
    $produitdet = $managerProduitDet->get($id);


    $datas = [];


    if (isset($_POST['id']) || isset($_GET['id'])) {


        if ($produitdet->stock() <= $produitdet->stockMin()) $action = 'style="background: #ff18008a;color: #fff"';
        else $action = '';
        $bouton = "
                                             <button class=\"btn btn-primary \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"gerer_detail('" . $produitdet->id() . "')\"><span class=\"\">Augmenter quantité</span></button>
                                        ";
        $datas[] = array(
            "DT_RowId" => $produitdet->id(),
            'nom' => "<span ><strong class='nom'>" . $produitdet->nom() . "</strong></span>",
            //'nom' => "<span ><strong class='nom'>" . $produit->nom() . "</strong></span>",
            'prixUnitaire' => "<p class='prix'>
                                                
         <p></p>
         <div class='input-group' style='width:100px;'>
             <span class='input-group-btn'>
                 <button type='button' class='btn btn-default btn-number moins'
                         onclick=\"change_input('moins','inputPrixV" . $produitdet->id() . "')\"
                         style='padding: 4px;'>
                     <span class='glyphicon glyphicon-minus'></span>
                 </button>
             </span>
             <input type='text' name='quant[1]' class='form-control input-number prixv'
             id=\"inputPrixV" . $produitdet->id() . "\"
             value='" . $produitdet->prix() . "' style='width: 80px;'>
             <span class='input-group-btn'>
                 <button type='button' class='btn btn-default btn-number plus'
                         onclick=\"change_input('plus','inputPrixV" . $produitdet->id() . "')\"
                         style='padding: 4px;'>
                     <span class='glyphicon glyphicon-plus'></span>
                 </button>
             </span>
         </div>
         <p></p>
     </p>",
            'quantite' => "<p class=''>
         <p></p>
         <div class='input-group' style='width:100px;'>
             <span class='input-group-btn'>
                 <button type='button' class='btn btn-default btn-number moins'
                         onclick=\"change_input_vente('moins','inputQte" . $produitdet->id() . "'," . $produitdet->stock() . ")\"
                         style='padding: 4px;'>
                     <span class='glyphicon glyphicon-minus'></span>
                 </button>
             </span>
             <input type='text' name='quant[1]' class='form-control input-number qte'
             id=\"inputQte" . $produitdet->id() . "\"
             value='0' style='width: 80px;'>
             <span class='input-group-btn'>
                 <button type='button' class='btn btn-default btn-number plus'
                         onclick=\"change_input_vente('plus','inputQte" . $produitdet->id() . "'," . $produitdet->stock() . ")\"
                         style='padding: 4px;'>
                     <span class='glyphicon glyphicon-plus'></span>
                 </button>
             </span>
         </div>
         <p></p>

     </p>",
            'stockq' => "<p class='qterest'>
         " . $produitdet->stock() . "
     </p>",
            'stockg' => "<p class='stock'>
         " . $produitdet->stock() . "
     </p>",
            'reduction' => "<p class='reduction'>
         " . $produitdet->reductionMax() . "
     </p>",
            'date' => "
         <p class='datel'>
                                                 
                                             </p>
         ",
            'peremption' => "
         <p class='datePeremption'>
                                                 
                                             </p>
         ",

            'action' => $bouton
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
