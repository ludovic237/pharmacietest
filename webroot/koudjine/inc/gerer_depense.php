<?php
require_once('database.php');
require_once('../Class/depense.php');

global $pdo;


$manager = new DepenseManager($pdo);

if (isset($_POST['id']))
$id = $_POST['id'];
$type = $_POST['type'];


if ($type == "modify") {
    if (isset($_POST['id'])){
        $depense = $manager->getList($id);
        foreach ($depense as $k => $v) :
            echo
                "<tr id='" . $v->id() . "' data='1000'>
            <td class=''>
                <input class='designation' type=\"text\" value='" . $v->designation() . "'>
            </td>
            <td class=''>
                <input class='qte' type=\"text\" value='" . $v->quantite() . "'>
            </td>
            <td class=''>
                <input class='prix' type=\"text\" value='" . $v->prixUnitaire() . "'>
            </td>
            <td class=''>
                <input class='total' type=\"text\" value='" . ($v->quantite()*$v->prixUnitaire()) . "'>
            </td>
        </tr>";
        endforeach;
    
    }
    else{
        $new_id = $_POST['new_id'];
        $caisse_id = $_POST['caisse_id'];
        $designation = $_POST['designation'];
        $qte = $_POST['qte'];
        $prix = $_POST['prix'];
    
        if($new_id < 0){
            $depense = new Depense(array(
                'designation' => $designation,
                'caisse_id' => $caisse_id,
                'quantite' => $qte,
                'prixUnitaire' => $prix,
            ));
            $manager->add($depense);
        }else{
            $depense = $manager->get($new_id);
            $depense->setdesignation($designation);
            $depense->setquantite($qte);
            $depense->setprixUnitaire($prix);
            $manager->update($depense);
        }
    
    
    
    }
    
} else {
    if (isset($_POST['id'])){
        $depense = $manager->getList($id);
        foreach ($depense as $k => $v) :
            echo
            "<tr id='" . $v->id() . "' data='1000'>
            <td class='' style='background: #F8FAFC;'>
                <input readonly='readonly' style='border: none;padding: 7px;background: #F8FAFC;' class='designation' type=\"text\" value='" . $v->designation() . "'>
            </td>
            <td class='' style='background: #F8FAFC;'>
                <input readonly='readonly' style='border: none;padding: 7px;background: #F8FAFC;' class='qte' type=\"text\" value='" . $v->quantite() . "'>
            </td>
            <td class='' style='background: #F8FAFC;'>
                <input readonly='readonly' style='border: none;padding: 7px;background: #F8FAFC;' class='prix' type=\"text\" value='" . $v->prixUnitaire() . "'>
            </td>
            <td class='' style='background: #F8FAFC;'>
                <input readonly='readonly' style='border: none;padding: 7px;background: #F8FAFC;' class='total' type=\"text\" value='" . ($v->quantite()*$v->prixUnitaire()) . "'>
            </td>
        </tr>";
        endforeach;
    
    }
    else{
        $new_id = $_POST['new_id'];
        $caisse_id = $_POST['caisse_id'];
        $designation = $_POST['designation'];
        $qte = $_POST['qte'];
        $prix = $_POST['prix'];
    
        if($new_id < 0){
            $depense = new Depense(array(
                'designation' => $designation,
                'caisse_id' => $caisse_id,
                'quantite' => $qte,
                'prixUnitaire' => $prix,
            ));
            $manager->add($depense);
        }else{
            $depense = $manager->get($new_id);
            $depense->setdesignation($designation);
            $depense->setquantite($qte);
            $depense->setprixUnitaire($prix);
            $manager->update($depense);
        }
    
    
    
    }
    
}
