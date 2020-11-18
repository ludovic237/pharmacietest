<?php

$title_for_layout = ' Admin -' . 'Catalogue';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter une produit' : 'Modifier un produit';


if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action; 
}
$position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    nom: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    reference: {
                        required: false,
                    },
                    stockmin: {
                        required: true
                    },
                    stockmax: {
                        required: true,
                    },
                    stock: {
                        required: true,
                    },
                    reduction: {
                        required: true
                    },
                    ean13: {
                        required: false
                    }

                }
            });

        </script>';
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">

            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_produit('<?php echo $position; ?>',
             '<?php if ($position == 'Modifier')  echo $produit->id;
                else echo ""; ?>');">
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Informations générales</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">ean13:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ean13" id="ean13" value="<?php if ($position == 'Modifier') echo $produit->ean13; ?>" placeholder="" />
                            <span class="help-block">exemple: ean13 - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Référence:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="reference" id="reference" value="<?php if ($position == 'Modifier') echo $produit->reference; ?>" placeholder="" />
                            <span class="help-block">exemple: AXA - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Code Laborex:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="laborex" id="laborex" value="<?php if ($position == 'Modifier') echo $produit->codeLaborex; ?>" placeholder="" />
                            <span class="help-block">exemple: LAB 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Code Ubiform:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ubipharm" id="ubipharm" value="<?php if ($position == 'Modifier') echo $produit->codeUbipharm; ?>" placeholder="" />
                            <span class="help-block">exemple: UBI 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-9">
                            <input type="text" onfocusout="charger_select_produit()" class="form-control" value="<?php if ($position == 'Modifier') echo $produit->nom; ?>" name="nom" id="nom" placeholder="" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                </div>
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Stock</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Quantité en stock:</label>
                        <div class="col-md-9">
                            <input type="number" disabled class="form-control" name="stock" id="stock" value="<?php if ($position == 'Modifier') echo $produit->stock; else echo '0'; ?>" placeholder="" />
                            <span class="help-block">exemple: 23 - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Quantité max en stock:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="stockmax" id="stockmax" value="<?php if ($position == 'Modifier') echo $produit->stockMax; ?>" placeholder="" />
                            <span class="help-block">exemple: 40 - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Quantité min en stock:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" value="<?php if ($position == 'Modifier') echo $produit->stockMin; ?>" name="stockmin" id="stockmin" placeholder="" />
                            <span class="help-block">Champ requis - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Réduction Max Appliquable:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" value="<?php if ($position == 'Modifier') echo $produit->reductionMax;
                                                                                else echo 0; ?>" name="reduction" id="reduction" placeholder="" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contenu detail:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" value="<?php if ($position == 'Modifier') echo $produit->contenuDetail; ?>" name="contenu" id="contenu" placeholder="" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="col-md-3 control-label">Date de péremption:</label>
                        <div class="col-md-9 col-xs-12">
                            <div class="input-group ">
                                <input type="text" id="dp-3" class="form-control" value="<?php /* if($position != 'Modifier') echo date('d-m-Y'); else {if($produit->datePeremption != null) {$date = DateTime::createFromFormat('Y-m-d H:i:s', $produit->datePeremption);echo $date->format('d-m-Y');}} */ ?>" data-date="<?php /*if($position != 'Modifier') echo date('d-m-Y'); else {if($produit->datePeremption != null) {$date = DateTime::createFromFormat('Y-m-d H:i:s', $produit->datePeremption);echo $date->format('d-m-Y');}} */ ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Date de commande:</label>
                        <div class="col-md-9"> 
                            <div class="input-group ">
                                <input type="text" id="dp-3" class="form-control" value="<?php /* if($position != 'Modifier') echo date('d-m-Y'); else {if($produit->dateCmd != null) {$date = DateTime::createFromFormat('Y-m-d H:i:s', $produit->dateCmd);echo $date->format('d-m-Y');}} */ ?>" data-date="<?php /*if($position != 'Modifier') echo date('d-m-Y'); else {if($produit->dateCmd != null) {$date = DateTime::createFromFormat('Y-m-d H:i:s', $produit->dateCmd);echo $date->format('d-m-Y');}} */ ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                 <span class="input-group-addon datepicker">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>-->
                </div>
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Géo</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Catégorie:</label>
                        <div class="col-md-9">
                            <select class="selectpicker form-control input-xlarge " name="catproduit" id="catproduit">
                                <?php
                                foreach ($categorie as $k => $v) : ?>
                                    <option <?php if ($position == 'Modifier') if ($v->id == $produit->categorie_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Rayon:</label>
                        <div class="col-md-9">
                            <select class="selectpicker form-control input-xlarge " name="rayonproduit" id="rayonproduit">
                                <?php
                                foreach ($rayon as $k => $v) : ?>
                                    <option <?php if ($position == 'Modifier') if ($v->id == $produit->rayon_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Etagère:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="etagere" id="etagere" value="<?php if ($position == 'Modifier') echo $produit->etagere; ?>" placeholder="" />
                            <span class="help-block">exemple: 23 - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Magasin:</label>
                        <div class="col-md-9">
                            <select class="selectpicker form-control input-xlarge " name="magproduit" id="magproduit">
                                <?php
                                foreach ($magasin as $k => $v) : ?>
                                    <option <?php if ($position == 'Modifier') if ($v->id == $produit->magasin_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Forme:</label>
                        <div class="col-md-9">
                            <select class="selectpicker form-control input-xlarge " name="formeproduit" id="formeproduit">
                                <?php
                                foreach ($forme as $k => $v) : ?>
                                    <option <?php if ($position == 'Modifier') if ($v->id == $produit->forme_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fabriquant:</label>
                        <div class="col-md-9">
                            <select class="selectpicker form-control input-xlarge " name="fabproduit" id="fabproduit">
                                <?php
                                foreach ($fabriquant as $k => $v) : ?>
                                    <option <?php if ($position == 'Modifier') if ($v->id == $produit->fabriquant_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                    <h4 style="background-color: #2d3945;color: white;">Détail produit </h4>
                    <!--<span>
                        <input type="checkbox" id="check_compo-1">
                    </span>-->
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Produit:</label>
                        <!-- 
                        <?php
                        $text = $produit->grossiste_id;
                        echo $text;
                        $texto  = explode('-', $text);
                        print_r($texto);
                        if (in_array("Python", $langages)) {
                            echo "Python a été trouvé dans les langages.";
                        }
                        ?> -->

                        <div class="col-md-9">
                            <select multiple class="selectpicker form-control input-xlarge " name="produits" id="produits">
                                <option value="0">Choisir:</option>
                                <?php if (isset($produits))
                                    foreach ($produits as $k => $v) : ?>
                                    <option <?php if ($position == 'Modifier')

                                                if (in_array($v->id, $texto)) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?>
                                    </option>
                                <?php
                                    endforeach;
                                ?>
                            </select>
                            <span class="help-block">Choix multiple</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Prix detail:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" value="<?php if ($position == 'Modifier') echo $produit->prixDetail;
                                                                                else echo 0; ?>" name="prixDetail" id="prixDetail" placeholder="" />

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Etat:</label>
                        <div class="col-md-9">
                            <select class="selectpicker form-control input-xlarge " name="etat" id="pdt_etat">
                                <option <?php if ($position == 'Modifier') if ($produit->etat == 'Utile') echo "selected=\"selected\""; ?> value="Utile">Utile</option>
                                <option <?php if ($position == 'Modifier') if ($produit->etat == 'Non utile') echo "selected=\"selected\""; ?> value="Non utile">Non utile</option>
                            </select>
                        </div>
                    </div>

                    <div class="btn-group pull-right">
                        <?php if ($position == 'Modifier') { ?> <a class="btn btn-primary" href="<?php echo Router::url('bouwou/catalogue/produitdetail/'.$produit->id); ?>" style="margin-right: 20px">Detail</a> <?php } ?>
                        <a class="btn btn-primary" style="margin-right: 20px" href="<?php echo Router::url('bouwou/catalogue/produit'); ?>">Annuler</a>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>