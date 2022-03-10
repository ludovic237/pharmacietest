<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');

$id;
$produit;
global $pdo;
global $conndb;
$managerProduit = new ProduitManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

if (isset($_POST['id'])){
    $id=$_POST['id'];
    $qte=$_POST['qte'];
}

$enrayon = $managerEnRayon->get($id);
$produit = $managerProduit->get($enrayon->produit_id());


//echo "passe";
if (isset($_POST['id'])||isset($_GET['id'])){

    $datelivraison = $enrayon->dateLivraison();
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
    $datel = $date->format('Y-m-d');
    $donnees = array('erreur' =>'non', 'find' => 'oui','nom' => $produit->nom(), 'datel' => $datel, 'contenu' => $produit->contenuDetail(), 'stock' => $produit->stock()-1);
    echo json_encode($donnees);
    /*echo "<tr id=\"".$enrayon->id()."\">
                                            <td ><strong class='nom'>".$produit->nom()."</strong></td>
                                            <td class=''>
                                                ".$qte."
                                            </td>
                                            <td class=''>
                                                ".$produit->contenuDetail()."
                                            </td>
                                            <td class='qterest'>
                                                ".($enrayon->quantiteRestante()-$qte)."
                                            </td>
                                            <td class='datel'>
                                                ".$datel."
                                            </td>
                                            <td class='datel'>
                                               <button class=\"btn btn-danger btn-rounded btn-sm\" onClick=\"delete_row_vente('".$enrayon->id()."');\"><span class=\"fa fa-times\"></span></button>
                                            </td>
                                        </tr>";*/
}else{
    //echo "Aucun résultat pour l'id: ".$motclef;
    $donnees = array('erreur' =>"Pas de grossiste trouvé pour l'id: ".$id, 'find' => 'non');
    echo json_encode($donnees);

}



?>

