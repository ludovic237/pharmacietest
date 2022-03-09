<?php
require_once('database.php');
require_once('../Class/bon_caisse.php');

global $pdo;


$manager = new BonCaisseManager($pdo);

if (isset($_POST['id']))
    $id = $_POST['id'];

if (isset($_POST['id'])){
    $generer = $manager->getListBonGenerer($id);
    $encaisser = $manager->getListBonEncaisser($id);
    $total_depenser = 0;
    $total_entree = 0;
    foreach ($generer as $k => $v) :
        $total_depenser = $total_depenser + $v->montant();
        echo
            "<tr id='" . $v->id() . "'>
                <td class=''>
                    <strong>" . $v->nom_client() . "</strong>
                </td>
                <td class=''>
                    " . $v->montant() . "
                </td>
                <td class=''>
                    " . $v->type() . "
                </td>
            </tr>";
    endforeach;
    foreach ($encaisser as $k => $v) :
        $total_entree = $total_entree + $v->montant();
        echo
            "<tr id='" . $v->id() . "'>
                <td class=''>
                    <strong>" . $v->nom_client() . "</strong>
                </td>
                <td class=''>
                    " . $v->montant() . "
                </td>
                <td class=''>
                    " . $v->type() . "
                </td>
            </tr>";
    endforeach;
    echo '<tr>
                                                            <td colspan="2">Total Entrée</td>
                                                            <td colspan="1">
                                                                 <span id="total_entree_rapport_bon">' . $total_entree . '</span>
                                                            </td>
                                                       </tr>
                                                       <tr>
                                                           <td colspan="2">Total Sortie</td>
                                                           <td colspan="1">
                                                               <span id="total_sortie_rapport_bon">' . $total_depenser . '</span>
                                                           </td>
                                                       </tr>';

}

?>