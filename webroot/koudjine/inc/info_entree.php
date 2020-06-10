<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/fournisseur1.php');
require_once('../Class/en_rayon.php');

$id;
global $pdo;
global $conndb;
$managerProduit = new ProduitManager($pdo);
$managerFournisseur = new FournisseurManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);


//echo "passe";
if (isset($_POST['id'])||isset($_GET['id'])){
    if (isset($_POST['id']))
        $id=$_POST['id'];
    if (isset($_GET['id']))
        $id=$_GET['id'];


    if($managerEnRayon->existsId($id)){
        $enrayon = $managerEnRayon->get($id);
        $fournisseur = $managerFournisseur->get($enrayon->fournisseur_id());
        $produit = $managerProduit->get($enrayon->produit_id());
        $datelivraison = $enrayon->dateLivraison();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
        $datel = $date->format('d-m-Y');
        $dateperemption = $enrayon->datePeremption();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateperemption);
        $datep = $date->format('d-m-Y');

    }

    //echo "passe";
    $code_barre = $produit->reference().$fournisseur->nom().$datep.$datel;
    //$code = cb($code_barre);




    $donnees = array('nomP' => $produit->nom(), 'nomF' => $fournisseur->nom(), 'code' => $fournisseur->code(), 'datel' => $datel, 'datep' => $datep, 'prixa' =>  $enrayon->prixAchat(), 'prixv' =>  $enrayon->prixVente(), 'quantite' =>  $enrayon->quantite(), 'quantiter' =>  $enrayon->quantiteRestante(), 'reduction' => $enrayon->reduction(),'codebarre' =>$code_barre);
    if (isset($_POST['id']))
        echo json_encode($donnees);



}

//voici la fonction que j'ai écrite. Elle génére un code barre en svg avec $str la valeur de la chaine que vous voulez convertir . proportionnez le viewBox du svg par rapport au nombre de caractère de votre code (ici pour 8)
function cb($str){
    $CODE["0"] = array(1,1,1,3,3,1,3,1,1,1);
    $CODE["1"] = array(3,1,1,3,1,1,1,1,3,1);
    $CODE["2"] = array(1,1,3,3,1,1,1,1,3,1);
    $CODE["3"] = array(3,1,3,3,1,1,1,1,1,1);
    $CODE["4"] = array(1,1,1,3,3,1,1,1,3,1);
    $CODE["5"] = array(3,1,1,3,3,1,1,1,1,1);
    $CODE["6"] = array(1,1,3,3,3,1,1,1,1,1);
    $CODE["7"] = array(1,1,1,3,1,1,3,1,3,1);
    $CODE["8"] = array(3,1,1,3,1,1,3,1,1,1);
    $CODE["9"] = array(1,1,3,3,1,1,3,1,1,1);
    $CODE["A"] = array(3,1,1,1,1,3,1,1,3,1);
    $CODE["B"] = array(1,1,3,1,1,3,1,1,3,1);
    $CODE["C"] = array(3,1,3,1,1,3,1,1,1,1);
    $CODE["D"] = array(1,1,1,1,3,3,1,1,3,1);
    $CODE["E"] = array(3,1,1,1,3,3,1,1,1,1);
    $CODE["F"] = array(1,1,3,1,3,3,1,1,1,1);
    $CODE["G"] = array(1,1,1,1,1,3,3,1,3,1);
    $CODE["H"] = array(3,1,1,1,1,3,3,1,1,1);
    $CODE["I"] = array(1,1,3,1,1,3,3,1,1,1);
    $CODE["J"] = array(1,1,1,1,3,3,3,1,1,1);
    $CODE["K"] = array(3,1,1,1,1,1,1,3,3,1);
    $CODE["L"] = array(1,1,3,1,1,1,1,3,3,1);
    $CODE["M"] = array(3,1,3,1,1,1,1,3,1,1);
    $CODE["N"] = array(1,1,1,1,3,1,1,3,3,1);
    $CODE["O"] = array(3,1,1,1,3,1,1,3,1,1);
    $CODE["P"] = array(1,1,3,1,3,1,1,3,1,1);
    $CODE["Q"] = array(1,1,1,1,1,1,3,3,3,1);
    $CODE["R"] = array(3,1,1,1,1,1,3,3,1,1);
    $CODE["S"] = array(1,1,3,1,1,1,3,3,1,1);
    $CODE["T"] = array(1,1,1,1,3,1,3,3,1,1);
    $CODE["U"] = array(3,3,1,1,1,1,1,1,3,1);
    $CODE["V"] = array(1,3,3,1,1,1,1,1,3,1);
    $CODE["W"] = array(3,3,3,1,1,1,1,1,1,1);
    $CODE["X"] = array(1,3,1,1,3,1,1,1,3,1);
    $CODE["Y"] = array(3,3,1,1,3,1,1,1,1,1);
    $CODE["Z"] = array(1,3,3,1,3,1,1,1,1,1);
    $CODE["_"] = array(1,3,1,1,1,1,3,1,3,1);
    $CODE["."] = array(3,3,1,1,1,1,3,1,1,1);
    $CODE[" "] = array(1,3,3,1,1,1,3,1,1,1);
    $CODE["$"] = array(1,3,1,3,1,3,1,1,1,1);
    $CODE["/"] = array(1,3,1,3,1,1,1,3,1,1);
    $CODE["+"] = array(1,3,1,1,1,3,1,3,1,1);
    $CODE["%"] = array(1,1,1,3,1,3,1,3,1,1);
    $CODE["*"] = array(1,3,1,1,3,1,3,1,1,1);
    $str = "*" . $str . "*";
    echo "<svg width='100%' height='100%' viewBox='0 0 320 100'>";
    $o = 2;
    $c = "n";
    for($i=0;isset($str[$i]);$i++){
        $b = $str[$i];
        foreach($CODE[$b] as $l){
            $l = $l*2;
            if($c == "n"){
                $o = $o + ($l/2);
                echo "<path stroke='black' stroke-width='" . $l . "' d='M " . $o . " 0 l 0 100' />";
                $c = "b";
                $o = $o + ($l/2);
            }
            else{
                $o = $o + $l;
                $c = "n";
            }
        }
    }
    echo "</svg>";
}




?>

