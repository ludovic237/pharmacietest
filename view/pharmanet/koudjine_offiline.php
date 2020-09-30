<!-- <?php

        $title_for_layout = ' ALSAS -' . 'Universités';
        $page_for_layout = 'Liste vente';
        $action_for_layout = 'Ajouter';

        if ($this->request->action == "index") {
            $position = "Tout";
        } else {
            $position = $this->request->action;
        }
        $position_for_layout = '<li><a href="#">Concours</a></li><li class="active">' . $position . '</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
        ?> -->



<!-- START RESPONSIVE TABLES -->
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="portlet box blue" style="padding: 20px;background-color: white;">
                <div class="portlet-title" style="padding: 20px;background-color: #2d3945;font-size: 20px;color: white;">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Information Propre de l'Officine
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="space25">
                    </div>
                    <!-- BEGIN FORM-->
                    <form action="{{path('setconfig')}}" method="post">
                        <div class="note note-info">
                            <h3 class="block">Contacts</h3>
                            <p>
                                Veillez entrer le nom, le téléphone, l'adresse, le slogan ainsi que le code postal de votre offcine
                                <br> Ces informations apparaitront sur le BL et la facture de votre client
                            </p>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-icon">
                                <i class="fa fa-address"></i>
                                <input type="text" class="form-control" placeholder="Numero Contribuable" name="con" value="{{phar.contribuable}}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-icon">
                                <i class="fa fa-check"></i>
                                <input type="text" class="form-control" placeholder="Nom" name="nom" value="{{phar.nom}}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-icon">
                                <i class="fa fa-phone"></i>
                                <input type="tel" class="form-control" placeholder="Téléphone" name="tel" value="{{phar.telephone}}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-icon">
                                <i class="fa fa-home"></i>
                                <input type="text" class="form-control" placeholder="Adresse" name="adr" value="{{phar.adresse}}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-icon">
                                <i class="fa fa-codepen"></i>
                                <input type="text" class="form-control" placeholder="Slogan" name="slog" value="{{phar.slogan}}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-icon">
                                <i class="fa fa-ban"></i>
                                <input type="text" class="form-control" placeholder="Nom du pharmacien (Dr)" name="dr" value="{{phar.docteur}}">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label col-md-6">Code Postal <span class="required">
                                    * </span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" name="cp">
                                    {% for cod in code %}
                                    <option value="{{ cod.id }}" {%="" if="" cod.id="=" phar.codepostal.id="" %}selected{%="" endif="" %}="">{{ cod.nom}} - {{cod.ville.nom}}</option>
                                    {% endfor %}
                                </select>
                            </div>
                            <br>
                        </div>
                        <div class="form-actions">
                            <input type="submit" class="btn blue" value="Enregistrer">
                            <input type="reset" class="btn default" value="Reinitialiser">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END RESPONSIVE TABLES -->