<?php
require_once('database.php');
require_once('../Class/depense.php');

global $pdo;


$manager = new DepenseManager($pdo);

if (isset($_POST['id']))
    $id = $_POST['id'];

if (isset($_POST['id'])){
    $depense = $manager->getList($id);
    $total = 0;
    $i = 0;
    foreach ($depense as $k => $v) :
        $total = $total + ($v->quantite()*$v->prixUnitaire());
    $i++;
        echo
            "<tr class='ligne_charger' id='" . $v->id() . "' data='1000' \">
        <td class=''>
            " . $i . "
        </td>
        <td class=''>
            <strong>" . $v->designation() . "</strong>
        </td>
        <td class=''>
            " . $v->quantite() . "
        </td>
        <td class=''>
            " . $v->prixUnitaire() . "
        </td>
        <td class=''>
            " . ($v->quantite()*$v->prixUnitaire()) . "
        </td>
        <td>
            
        </td>
    </tr>";
    endforeach;
    echo '<tr>
                                                            <td colspan="4">Total</td>
                                                            <td colspan="2">
                                                                <span id="total_rapport_depense">'.$total.'</span>
                                                            </td>
                                                       </tr>';

}

?>