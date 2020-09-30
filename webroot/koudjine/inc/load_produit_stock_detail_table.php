<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');

$id;
$vente;
$produit;
$enrayon;
$concerner;

global $pdo;
global $conndb;

$managerProduit = new ProduitManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];

$enrayon = $managerEnRayon->getList($id);
$produit = $managerProduit->get($id);
$nom = $produit->nom();


echo "passe";
if (isset($_POST['id']) || isset($_GET['id'])) {



    foreach ($enrayon as $k => $e) :
        $enrayonid = $e->id();
        echo
            "<tr \">
                        <td class='prix'>
                            " . $nom . "
                        </td>
                        <td class='prix'>
                        " . $e->fournisseur_id() . "
                        </td>
                        <td class='prix'>
                        " . $e->dateLivraison() . "
                        </td>
                        <td class='prix'>
                        " . $e->datePeremption() . "
                        </td>
                        <td class='prix'>
                        " . $e->prixAchat() . "
                        </td>
                        <td class='prix'>
                        " . $e->prixVente() . "
                        </td>
                        <td class='prix'>
                        " . $e->quantiteRestante() . "
                        </td>
                    </tr>";
    endforeach;

    //$js_code = json_encode($concerner, JSON_HEX_TAG);

}
