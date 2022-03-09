<?php
require 'database.php';


function getUniversite(){
		
																		// D'abord, on se connecte ?ySQL 
	global $pdo;
	global $conndb;
	$sql = "SELECT * FROM universite ORDER BY NOM ASC";
    $req = $pdo->query($sql);
	$rows = $req->fetch();
    //$row = $req->fetchAll();
	$tot_rows = count($rows);
    //echo $tot_rows;
	if($tot_rows > 0){
        do{
            /*$contact = explode(';', $rows['CONTACT']);
            //printf($contact[1]);
            if($contact[1] == ''){
                $contact[1] = "(237)";
            }
            if($contact[2] == ''){
                $contact[2] = "bouwou02@yahoo.fr";
            }*/
            ?>
            <tr id="trow_<?php echo $rows['UNIVERSITE_ID']; ?>">
                <td><strong><?php echo $rows['NOM']; ?></strong></td>
                <td><?php echo $rows['STATUT']; ?></td>
                <td><?php echo $rows['VILLE']; ?></td>
                <td><?php echo $rows['TYPE']; ?></td>
                <td></td>
                <td><?php echo $rows['CERTIFICATION']; ?></td>
                <td>
                    <button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Info" onclick="info_row(<?php echo $rows['UNIVERSITE_ID']; ?>)"><span class="fa fa-info"></span></button>
                    <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_univ(<?php echo $rows['UNIVERSITE_ID']; ?>)"><span class="fa fa-pencil"></span></button>
                    <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('trow_<?php echo $rows['UNIVERSITE_ID']; ?>');"><span class="fa fa-times"></span></button>
                </td>
            </tr>
            <?php
        }while($rows = $req->fetch());
        $req->closeCursor();
										}
}

function getUniversiteSelect($id){

    // D'abord, on se connecte ?ySQL
    global $pdo;
    global $conndb;
    $contact = array();
    $sql = "SELECT * FROM universite ORDER BY NOM ASC";
    $req = $pdo->query($sql);
    $rows = $req->fetch();
    //$row = $req->fetchAll();
    $tot_rows = count($rows);
    if($tot_rows > 0){
        do{

            ?>
            <option <?php if($rows['UNIVERSITE_ID']==$id) echo "selected=\"selected\""; ?> value="<?php echo $rows['UNIVERSITE_ID']; ?>" <?php getSticky(2,'srch_universite',$rows['UNIVERSITE_ID']) ?>><?php echo $rows['NOM']; ?></option>
        <?php
        }while ($rows = $req->fetch());
    }
    $req->closeCursor();
}

function getFaculteList(){

    // D'abord, on se connecte ?ySQL
    global $pdo;
    global $conndb;

    if(isset($_GET['srch_universite'])){
        $univ_id = $_GET['srch_universite'];
    }
    $sql = "SELECT * FROM departement WHERE UNIVERSITE_ID='".$univ_id."'";
    $req = $pdo->query($sql);
    $rows = $req->fetch();
    $sql1 = "SELECT * FROM departement WHERE UNIVERSITE_ID='".$univ_id."'";
    $req1 = $pdo->query($sql1);
    $row = $req1->fetchAll();
    $tot_rows = count($row);
    echo $tot_rows;
    if($tot_rows > 1){
        do{
            ?>
            <tr id="<?php echo  $rows['DEPARTEMENT_ID'] ?>">
                <td><strong><?php echo  $rows['NOM'] ?></strong></td>
                <td><?php echo  $rows['SIGLE'] ?></td>
                <td><?php echo  $rows['DESCRIPTION'] ?></td>
                <td>
                    <button class="btn btn-default btn-rounded btn-sm" onClick="update_row('<?php echo  $rows['DEPARTEMENT_ID'] ?>');"><span class="fa fa-pencil"></span></button>
                    <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('<?php echo  $rows['DEPARTEMENT_ID'] ?>');"><span class="fa fa-times"></span></button>
                    <button class="btn btn-info btn-rounded btn-sm" onClick="filiere_row('<?php echo  $rows['DEPARTEMENT_ID'] ?>');">Filières</button>
                </td>
            </tr>
        <?php
        }while ($rows = $req->fetch());
    }
    else{
        ?>
        <tr id="trow_<?php echo  $rows['DEPARTEMENT_ID'] ?>">
            <td><strong>Par défaut</strong></td>
            <td></td>
            <td>Cette faculté est créée de façon automatique à la créatio d'une université et ne disparait que dès lors qu'on ajoute une nouvelle faculté.<?php echo "\n" ?> Et si l'université en question n'est pas subdivisé en faculté comme tel est le cas pour beaucoup, il suffira de servir de celui-ci pour ajouter les filières présentent dans cette université. </td>
            <td>
                <button class="btn btn-info btn-rounded btn-sm" onClick="delete_row('trow_<?php echo  $rows['DEPARTEMENT_ID'] ?>');">Filières</button>
            </td>
        </tr>
    <?php
    }
    $req->closeCursor();
}

function getSticky($case,$par,$value="",$initial=""){
    switch($case){
        case 1: // text field
            if(isset($_GET[$par])&& $_GET[$par]!=""){
                echo stripslashes($_GET[$par]);
            }
            break;
        case 2: // select
            if(isset($_GET[$par])&& $_GET[$par]==$value){
                echo "selected=\"selected\"";
            }
            break;
        case 3: // checkbox group
            if(isset($_GET[$par])&& $_GET[$par]!=""){
                echo "checked=\"checked\"";
            }
            break;
        case 4: // radio buttons
            if(isset($_GET[$par])&& $_GET[$par]==$value){
                echo "checked=\"checked\"";
            } else {
                if($initial !=""){
                    echo "checked=\"checked\"";
                }
            }
            break;
    }
}




?>