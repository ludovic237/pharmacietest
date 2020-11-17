<?php
require_once('database.php');
require_once('../Class/depense.php');

global $pdo;


$manager = new DepenseManager($pdo);
$type = null;
$id = $_POST['id'];
$type = $_POST['type'];
$datas;

if (isset($_POST['id'])){
    $id=$_POST['id'];
}
if (isset($_POST['type'])){
    $type=$_POST['type'];
}
if (isset($_POST['depense_type'])){
    $depense_type=$_POST['depense_type'];
}
if (isset($_POST['depense_quantite'])){
    $depense_quantite=$_POST['depense_quantite'];
}
if (isset($_POST['depense_prixunitaire'])){
    $depense_prixunitaire=$_POST['depense_prixunitaire'];
}
if (isset($_POST['depense_objet'])){
    $depense_objet=$_POST['depense_objet'];
}
if (isset($_POST['depense_remis'])){
    $depense_remis=$_POST['depense_remis'];
}  
if (isset($_POST['depense_lieu'])){
    $depense_lieu=$_POST['depense_lieu'];
}
if (isset($_POST['depense_societe'])){
    $depense_societe=$_POST['depense_societe'];
}  
if (isset($_POST['depense_datedepense'])){
    $depense_datedepense=$_POST['depense_datedepense'];
}
if (isset($_POST['depense_date'])){
    $depense_date=$_POST['depense_date'];
} 
if (isset($_POST['depense_cni'])){
    $depense_cni=$_POST['depense_cni'];
}  


if ($type == "modify") {
    $depense = $manager->get($id);
    $datas = array(
        "depense_type" => $depense->typeDepense(),
        "depense_quantite" => $depense->quantite(),
        "depense_prixunitaire" => $depense->prixUnitaire(),
        "depense_objet" => $depense->designation(),
        "depense_remis" => $depense->beneficiaire(),
        "depense_lieu" => $depense->lieuDelivrance(),
        "depense_societe" => $depense->societe(),
        "depense_datedepense" => $depense->dateDelivrance(),
        "depense_date" => $depense->dateDepense(),
        "depense_cni" => $depense->numeroCni(),

    );
} else {

    if ($new_id < 0) {

        $depense = new Depense(array(
            'typeDepense' => $depense_type,
            'societe' => $depense_societe,
            'lieuDelivrance' => $depense_lieu,
            'dateDelivrance' => $depense_date,
            'numeroCni' => $depense_cni,
            'beneficiaire' => $depense_remis,
            'prixUnitaire' => $depense_prixunitaire,
        ));
        $manager->add($depense);
    } else {

        $depense = $manager->get($new_id);
        $depense->settypeDepense($depense_objet);
        $depense->setsociete($depense_societe);
        $depense->setlieuDelivrance($depense_lieu);
        $depense->setdateDelivrance($depense_date);
        $depense->setnumeroCni($depense_cni);
        $depense->setbeneficiaire($depense_remis);
        $depense->setprixUnitaire($depense_prixunitaire);
        $manager->update($depense);
    }
}

if ($datas == null) {
    //$donnees = array('data' => []);
    echo json_encode($datas);
} else {
    //$donnees = array('data' => $datas);
    echo json_encode($datas);
}
