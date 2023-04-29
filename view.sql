create definer = root@localhost view wms_vente_view as
select `ven`.`id`          AS `venteId`,
       `ven`.`prixTotal`   AS `prixTotal`,
       `emp`.`identifiant` AS `identifiant`,
       `ven`.`prixPercu`   AS `prixPercu`,
       `ven`.`reference`   AS `reference`,
       `cai`.`session`     AS `session`,
       `ven`.`dateVente`   AS `dateVente`
from ((`pharmanet1`.`vente` `ven` join `pharmanet1`.`employe` `emp` on (`ven`.`employe_id` = `emp`.`id`))
         join `pharmanet1`.`caisse` `cai` on (`ven`.`caisse_id` = `cai`.`id`));


create definer = root@localhost view pharma_produit_cmd_view as
select `pd_cm`.`puCmd`    AS `puCmd`,
       `pd_cm`.`ptCmd`    AS `ptCmd`,
       `pd_cm`.`qtiteCmd` AS `qtiteCmd`,
       `pd_cm`.`etat`     AS `etat`,
       `pd`.`nom`         AS `nom`,
       `cmd`.`ref`        AS `ref`
from ((`pharmanet1`.`produit_cmd` `pd_cm` join `pharmanet1`.`produit` `pd` on (`pd_cm`.`produit_id` = `pd`.`id`))
         join `pharmanet1`.`commande` `cmd` on (`pd_cm`.`commande_id` = `cmd`.`id`));


create definer = root@localhost view pharma_en_rayon_without_cmd_view as
select `en_r`.`prixAchat`        AS `prixAchat`,
       `en_r`.`prixVente`        AS `prixVente`,
       `en_r`.`dateLivraison`    AS `dateLivraison`,
       `en_r`.`datePeremption`   AS `datePeremption`,
       `en_r`.`quantite`         AS `quantite`,
       `en_r`.`quantiteRestante` AS `quantiteRestante`,
       `pd`.`nom`                AS `nom`
from (`pharmanet1`.`en_rayon` `en_r`
         join `pharmanet1`.`produit` `pd` on (`en_r`.`produit_id` = `pd`.`id`));

create definer = root@localhost view pharma_en_rayon_with_cmd_view as
select `en_r`.`prixAchat`        AS `prixAchat`,
       `en_r`.`prixVente`        AS `prixVente`,
       `en_r`.`dateLivraison`    AS `dateLivraison`,
       `en_r`.`datePeremption`   AS `datePeremption`,
       `en_r`.`quantite`         AS `quantite`,
       `en_r`.`quantiteRestante` AS `quantiteRestante`,
       `pd`.`nom`                AS `nom`,
       `cmd`.`ref`               AS `ref`
from ((`pharmanet1`.`en_rayon` `en_r` join `pharmanet1`.`produit` `pd` on (`en_r`.`produit_id` = `pd`.`id`))
         join `pharmanet1`.`commande` `cmd` on (`en_r`.`commande_id` = `cmd`.`id`));


create view pharma_concerner_view as
select `ven`.`id`                AS `venteId`,
       `conc`.`quantite`         AS `quantite`,
       `conc`.`prixUnit`         AS `prixUnit`,
       `conc`.`reduction`        AS `reduction`,
       `ven`.`reference`         AS `reference`,
       `ven`.`prixPercu`         AS `prixPercu`,
       `ven`.`prixTotal`         AS `prixTotal`,
       `en_r`.`prixAchat`        AS `prixAchat`,
       `en_r`.`prixVente`        AS `prixVente`,
       `en_r`.`dateLivraison`    AS `dateLivraison`,
       `en_r`.`datePeremption`   AS `datePeremption`,
       `en_r`.`quantite`         AS `quantiteRayon`,
       `en_r`.`quantiteRestante` AS `quantiteRestante`,
       `pdt`.`nom`               AS `nom`,
       `ven`.`dateVente`         AS `dateVente`
from (((`pharmanet1`.`concerner` `conc` join `pharmanet1`.`vente` `ven` on (`conc`.`vente_id` = `ven`.`id`)) join `pharmanet1`.`en_rayon` `en_r` on (`conc`.`en_rayon_id` = `en_r`.`id`))
         join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `en_r`.`produit_id`));

create view pharma_concerner_without_return_view as
select `ven`.`id`                AS `venteId`,
       `conc`.`quantite`         AS `quantite`,
       `conc`.`prixUnit`         AS `prixUnit`,
       `conc`.`reduction`        AS `reduction`,
       `ven`.`reference`         AS `reference`,
       `ven`.`prixPercu`         AS `prixPercu`,
       `ven`.`prixTotal`         AS `prixTotal`,
       `en_r`.`prixAchat`        AS `prixAchat`,
       `en_r`.`prixVente`        AS `prixVente`,
       `en_r`.`dateLivraison`    AS `dateLivraison`,
       `en_r`.`datePeremption`   AS `datePeremption`,
       `en_r`.`quantite`         AS `quantiteRayon`,
       `en_r`.`quantiteRestante` AS `quantiteRestante`,
       `pdt`.`nom`               AS `nom`,
       `ven`.`dateVente`         AS `dateVente`
from (((`pharmanet1`.`concerner` `conc` join `pharmanet1`.`vente` `ven` on (`conc`.`vente_id` = `ven`.`id`)) join `pharmanet1`.`en_rayon` `en_r` on (`conc`.`en_rayon_id` = `en_r`.`id`))
         join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `en_r`.`produit_id`))
where !(`conc`.`vente_id` in (select `pharmanet1`.`retour_produit`.`vente_id` from `pharmanet1`.`retour_produit`));



create definer = root@localhost view pharma_concerner_without_vente_view as
select `conc`.`quantite`         AS `quantite`,
       `conc`.`prixUnit`         AS `prixUnit`,
       `conc`.`reduction`        AS `reduction`,
       `en_r`.`prixAchat`        AS `prixAchat`,
       `en_r`.`prixVente`        AS `prixVente`,
       `en_r`.`dateLivraison`    AS `dateLivraison`,
       `en_r`.`datePeremption`   AS `datePeremption`,
       `en_r`.`quantite`         AS `quantite_rayon`,
       `en_r`.`quantiteRestante` AS `quantiteRestante`,
       `pdt`.`nom`               AS `nom`
from (`pharmanet1`.`concerner` `conc`
         join `pharmanet1`.`en_rayon` `en_r` on (`conc`.`en_rayon_id` = `en_r`.`id`)
         join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `en_r`.`produit_id`));


create definer = root@localhost view pharma_produit_view as
select `pdt`.`id`    AS `id`,
       `pdt`.`nom`   AS `nom`,
       `pdt`.`ean13` AS `ean13`,
       `cat`.`nom`   AS `nom_categorie`,
       `fab`.`nom`   AS `nom_fabriquant`,
       `ray`.`nom`   AS `nom_rayon`,
       `form`.`nom`  AS `nom_formee`
from ((((`pharmanet1`.`produit` `pdt`
    join `pharmanet1`.`categorie` `cat` on (`pdt`.`categorie_id` = `cat`.`id`))
    join pharmanet1.fabriquant fab on (fab.id = pdt.fabriquant_id))
    join pharmanet1.rayon ray on (ray.id = pdt.rayon_id))
         join pharmanet1.forme form on (form.id = pdt.forme_id));


create definer = root@localhost view pharma_produit_commande_view as
select `pdt`.`nom`           AS `nom`,
       `pdt`.`ean13`         AS `ean13`,
       `pdt_cmd`.`puCmd`     AS `puCmd`,
       `pdt_cmd`.`ptCmd`     AS `ptCmd`,
       `pdt_cmd`.`qtiteCmd`  AS `qtiteCmd`,
       `pdt_cmd`.`etat`      AS `etat`,
       `cmd`.`ref`           AS `ref`,
       `four`.`nom`          AS `fournisseurName`,
       `cmd`.`montantCmd`    AS `montantCmd`,
       `cmd`.`montantRecu`   AS `montantRecu`,
       `cmd`.`dateCreation`  AS `dateCreation`,
       `cmd`.`dateLivraison` AS `dateLivraison`
from (((`pharmanet1`.`produit_cmd` `pdt_cmd` join `pharmanet1`.`commande` `cmd` on (`pdt_cmd`.`commande_id` = `cmd`.`id`)) join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `pdt_cmd`.`produit_id`))
         join `pharmanet1`.`fournisseur` `four` on (`four`.`id` = `cmd`.`fournisseur_id`));

create definer = root@localhost view pharma_produit_en_rayon_view as
select distinct `pdt`.`id`                 AS `id`,
                `pdt`.`nom`                AS `nom`,
                `pdt`.`ean13`              AS `ean13`,
                `enray`.`prixVente`        AS `prixVente`,
                `enray`.`prixAchat`        AS `prixAchat`,
                `enray`.`quantiteRestante` AS `quantiteRestante`,
                `enray`.`reduction`        AS `reduction`,
                `enray`.`datePeremption`   AS `datePeremption`
from (`pharmanet1`.`produit` `pdt`
         join `pharmanet1`.`en_rayon` `enray` on (`pdt`.`id` = `enray`.`produit_id`))
where `enray`.`datePeremption` in (select max(`enray`.`datePeremption`))
group by `pdt`.`id`
order by `pdt`.`id`;
