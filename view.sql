create definer = root@localhost view pharma_vente_view as
select `ven`.`id`           AS `venteId`,
       `ven`.`prixTotal`    AS `prixTotal`,
       `emp`.`identifiant`  AS `identifiant`,
       `ven`.`prixPercu`    AS `prixPercu`,
       `ven`.`reference`    AS `reference`,
       `ven`.`reduction`    AS `reduction`,
       `ven`.`nouveau_info` AS `nouveau_info`,
       `ven`.`commentaire`  AS `commentaire`,
       `ven`.`etat`         AS `etat`,
       `cai`.`session`      AS `session`,
       `cai`.`id`           AS `caisseId`,
       `cai`.`user_id`      AS `caisseUserId`,
       `ven`.`dateVente`    AS `dateVente`
from ((`pharmanet1`.`vente` `ven` join `pharmanet1`.`employe` `emp` on (`ven`.`employe_id` = `emp`.`id`))
         join `pharmanet1`.`caisse` `cai` on (`ven`.`caisse_id` = `cai`.`id`));


create definer = root@localhost view pharma_en_rayon_without_cmd_view as
select `en_r`.`prixAchat`        AS `prixAchat`,
       `en_r`.`prixVente`        AS `prixVente`,
       `en_r`.`dateLivraison`    AS `dateLivraison`,
       `en_r`.`datePeremption`   AS `datePeremption`,
       `en_r`.`quantite`         AS `quantite`,
       `en_r`.`quantiteRestante` AS `quantiteRestante`,
       `en_r`.`id`               AS `enRayonId`,
       `pd`.`id`                 AS `produitId`,
       `four`.`nom`              AS `fourNom`,
       `pd`.`nom`                AS `nom`
from ((`pharmanet1`.`en_rayon` `en_r` join `pharmanet1`.`produit` `pd` on (`en_r`.`produit_id` = `pd`.`id`))
         join `pharmanet1`.`fournisseur` `four` on (`four`.`id` = `en_r`.`fournisseur_id`));


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

create definer = root@localhost view pharma_concerner_view as
select `ven`.`id`                AS `venteId`,
       `conc`.`id`               AS `concernerId`,
       `conc`.`quantite`         AS `concernerQuantite`,
       `conc`.`prixUnit`         AS `concernerPrixUnit`,
       `conc`.`reduction`        AS `concernerReduction`,
       `ven`.`reference`         AS `venteReference`,
       `ven`.`prixPercu`         AS `ventePrixPercu`,
       `ven`.`prixTotal`         AS `ventePrixTotal`,
       `en_r`.`prixAchat`        AS `enrayPrixAchat`,
       `en_r`.`prixVente`        AS `enrayPrixVente`,
       `en_r`.`dateLivraison`    AS `enrayDateLivraison`,
       `en_r`.`datePeremption`   AS `enrayDatePeremption`,
       `en_r`.`quantite`         AS `enrayQuantiteRayon`,
       `en_r`.`quantiteRestante` AS `enrayQuantiteRestante`,
       `pdt`.`nom`               AS `nom`,
       `pdt`.`id`                AS `produitId`,
       `ven`.`dateVente`         AS `venteDateVente`
from (((`pharmanet1`.`concerner` `conc` join `pharmanet1`.`vente` `ven` on (`conc`.`vente_id` = `ven`.`id`)) join `pharmanet1`.`en_rayon` `en_r` on (`conc`.`en_rayon_id` = `en_r`.`id`))
         join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `en_r`.`produit_id`));



create definer = root@localhost view pharma_concerner_without_return_view as
select `ven`.`id`                AS `venteId`,
       `conc`.`id`               AS `concernerId`,
       `conc`.`quantite`         AS `quantite`,
       `conc`.`prixUnit`         AS `prixUnit`,
       `conc`.`reduction`        AS `reduction`,
       `ven`.`reference`         AS `reference`,
       `ven`.`prixPercu`         AS `prixPercu`,
       `ven`.`prixTotal`         AS `prixTotal`,
       `en_r`.`prixAchat`        AS `prixAchat`,
       `en_r`.`prixVente`        AS `prixVente`,
       `en_r`.`dateLivraison`    AS `dateLivraison`,
       `en_r`.`id`               AS `rayonId`,
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


/*create or replace definer = root@localhost view pharma_produit_commande_view as
select GROUP_CONCAT(`pdt`.`nom`)          AS `nom`,
       `pdt`.`ean13`                      AS `ean13`,
       GROUP_CONCAT(`pdt_cmd`.`puCmd`)    AS `puCmd`,
       GROUP_CONCAT(`pdt_cmd`.`ptCmd`)    AS `ptCmd`,
       GROUP_CONCAT(`pdt_cmd`.`qtiteCmd`) AS `qtiteCmd`,
       GROUP_CONCAT(`pdt_cmd`.`etat`)     AS `etat`,
       `cmd`.`ref`                        AS `ref`,
       `four`.`nom`                       AS `fournisseurName`,
       GROUP_CONCAT(`cmd`.`montantCmd`)   AS `montantCmd`,
       GROUP_CONCAT(`cmd`.`montantRecu`)  AS `montantRecu`,
       `cmd`.`dateCreation`               AS `dateCreation`,
       `cmd`.`dateLivraison`              AS `dateLivraison`
from (((`pharmanet1`.`produit_cmd` `pdt_cmd` join `pharmanet1`.`commande` `cmd` on (`pdt_cmd`.`commande_id` = `cmd`.`id`)) join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `pdt_cmd`.`produit_id`))
    join `pharmanet1`.`fournisseur` `four` on (`four`.`id` = `cmd`.`fournisseur_id`))
         INNER JOIN commande as d ON d.ref = cmd.ref
GROUP BY d.ref;*/
create definer = root@localhost view pharma_produit_commande_view as
select `pdt`.`nom`            AS `nom`,
       `pdt`.`id`             AS `produitId`,
       `pdt`.`ean13`          AS `ean13`,
       `pdt_cmd`.`id`         AS `produitCmdId`,
       `pdt_cmd`.`puCmd`      AS `produitCmdPuCmd`,
       `pdt_cmd`.`prixPublic` AS `produitCmdPrixPublic`,
       `pdt_cmd`.`qtiteCmd`   AS `produitCmdQtiteCmd`,
       `pdt_cmd`.`qtiteRecu`  AS `produitCmdQtiteRecu`,
       `pdt_cmd`.`etat`       AS `produitCmdEtat`,
       `cmd`.`ref`            AS `ref`,
       `four`.`nom`           AS `fournisseurName`,
       `cmd`.`id`             AS `commandeId`,
       `cmd`.`montantCmd`     AS `montantCmd`,
       `cmd`.`montantRecu`    AS `montantRecu`,
       `cmd`.`qtiteCmd`       AS `qtiteCmd`,
       `cmd`.`qtiteRecu`      AS `qtiteRecu`,
       `cmd`.`dateCreation`   AS `dateCreation`,
       `cmd`.`dateLivraison`  AS `dateLivraison`
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

create definer = root@localhost view pharma_produit_en_rayon_view as
select distinct `pdt`.`id`                 AS `id`,
                `pdt`.`nom`                AS `nom`,
                `pdt`.`ean13`              AS `ean13`,
                `four`.`id`                AS `fourId`,
                `four`.`nom`               AS `fourName`,
                `four`.`statut`            AS `fourStatut`,
                `enray`.`id`               AS `id_rayon`,
                `enray`.`prixVente`        AS `prixVente`,
                `enray`.`prixAchat`        AS `prixAchat`,
                `enray`.`quantiteRestante` AS `quantiteRestante`,
                `enray`.`quantite`         AS `quantite`,
                `enray`.`reduction`        AS `reduction`,
                `enray`.`datePeremption`   AS `datePeremption`
from ((`pharmanet1`.`en_rayon` `enray` left join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `enray`.`produit_id`))
         left join `pharmanet1`.`fournisseur` `four` on (`four`.`id` = `enray`.`fournisseur_id`))
where `enray`.`datePeremption` in (select max(`enray`.`datePeremption`))
group by `pdt`.`id`
order by `pdt`.`id`;

create definer = root@localhost view pharma_produit_en_rayon_all_view as
select `pdt`.`id`                 AS `id`,
       `pdt`.`nom`                AS `nom`,
       `pdt`.`ean13`              AS `ean13`,
       `four`.`id`                AS `fourId`,
       `four`.`nom`               AS `fourName`,
       `enray`.`id`               AS `rayonId`,
       `enray`.`prixVente`        AS `rayonPrixVente`,
       `enray`.`prixAchat`        AS `rayonPrixAchat`,
       `enray`.`quantiteRestante` AS `rayonQuantiteRestante`,
       `enray`.`quantite`         AS `rayonQuantite`,
       `enray`.`reduction`        AS `rayonReduction`,
       `pdt`.`stock`              AS `produitStock`,
       `enray`.`dateLivraison`    AS `rayonDateLivraison`,
       `enray`.`datePeremption`   AS `rayonDatePeremption`
from ((`pharmanet1`.`en_rayon` `enray` left join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `enray`.`produit_id`))
         left join `pharmanet1`.`fournisseur` `four` on (`four`.`id` = `enray`.`fournisseur_id`));



create view pharma_produit_sortie_view as
select `pdt`.`id`                 AS `id`,
       `pdt`.`nom`                AS `nom`,
       `pdt`.`ean13`              AS `ean13`,
       `sort`.`id`                AS `sortieId`,
       `sort`.`dateSortie`        AS `sortieDate`,
       `enray`.`id`               AS `id_rayon`,
       `sort`.`quantite`          AS `sortieQuantite`,
       `enray`.`prixAchat`        AS `enRayonPrixAchat`,
       `enray`.`quantiteRestante` AS `quantiteRestante`,
       `enray`.`quantite`         AS `quantite`,
       `pdt`.`stock`              AS `stock`,
       `enray`.`dateLivraison`    AS `dateLivraison`,
       `enray`.`datePeremption`   AS `datePeremption`
from ((`pharmanet1`.`sortie_stock` `sort` left join `pharmanet1`.`en_rayon` `enray` on (`sort`.`en_rayon_id` = `enray`.`id`))
         left join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `enray`.`produit_id`));


/*
create definer = root@localhost view pharma_produit_en_rayon_view as
select distinct `pdt`.`id`                 AS `id`,
                `pdt`.`nom`                AS `nom`,
                `pdt`.`ean13`              AS `ean13`,
                `four`.`id`                AS `fourId`,
                `four`.`nom`               AS `fourName`,
                `four`.`statut`            AS `fourStatut`,
                `enray`.`id`               AS `id_rayon`,
                `enray`.`prixVente`        AS `prixVente`,
                `enray`.`prixAchat`        AS `prixAchat`,
                `enray`.`quantiteRestante` AS `quantiteRestante`,
                `enray`.`quantite`         AS `quantite`,
                `enray`.`reduction`        AS `reduction`,
                `pdt`.`stock`              AS `stock`,
                `enray`.`dateLivraison`    AS `dateLivraison`,
                `enray`.`datePeremption`   AS `datePeremption`
from ((`pharmanet1`.`en_rayon` `enray` left join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `enray`.`produit_id`))
         left join `pharmanet1`.`fournisseur` `four` on (`four`.`id` = `enray`.`fournisseur_id`));

*/

create definer = root@localhost view pharma_commande_produit_view as
select distinct `p`.`id`                          AS `idp`,
                `e`.`prixAchat`                   AS `prixAchat`,
                `p`.`stock`                       AS `stock`,
                `p`.`reductionMax`                AS `reductionMax`,
                `v`.`dateVente`                   AS `dateVente`,
                `e`.`datePeremption`              AS `datePeremption`,
                `e`.`id`                          AS `id_rayon`,
                `f`.`id`                          AS `fourId`,
                `p`.`nom`                         AS `nom`,
                `f`.`nom`                         AS `fourNom`,
                cast(`e`.`dateLivraison` as date) AS `dateLivraison`
from ((((`pharmanet1`.`produit` `p` join `pharmanet1`.`en_rayon` `e`) join `pharmanet1`.`concerner` `c`) join `pharmanet1`.`vente` `v`)
         join `pharmanet1`.`fournisseur` `f`)
where `v`.`id` = `c`.`vente_id`
  and `c`.`en_rayon_id` = `e`.`id`
  and `e`.`fournisseur_id` = `f`.`id`
  and `p`.`id` = `e`.`produit_id`
  and current_timestamp()
  and `e`.`dateLivraison` in
      (select max(`r`.`dateLivraison`) from `pharmanet1`.`en_rayon` `r` where `r`.`produit_id` = `e`.`produit_id`);


create view pharma_commande_view as
select `c`.`id`             AS `id`,
       `c`.`dateCreation`   AS `dateCreation`,
       `c`.`dateLivraison`  AS `dateLivraison`,
       `f`.`nom`            AS `nom`,
       `c`.`fournisseur_id` AS `fournisseur_id`,
       `c`.`qtiteCmd`       AS `qtiteCmd`,
       `c`.`qtiteRecu`      AS `qtiteRecu`,
       `c`.`uniteGratuite`  AS `uniteGratuite`,
       `c`.`montantCmd`     AS `montantCmd`,
       `c`.`montantRecu`    AS `montantRecu`,
       `c`.`etat`           AS `etat`,
       `c`.`ref`            AS `ref`,
       `c`.`note`           AS `note`
from `pharmanet1`.`commande` `c`
         join `pharmanet1`.`fournisseur` `f`
where `c`.`fournisseur_id` = `f`.`id`
  and `c`.`supprimer` = 0
  and `f`.`supprimer` = 0
  and `c`.`etat` <> 'Livré';


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


create definer = root@localhost view pharma_produit_max_livraison_view as
select `p`.`nom`              AS `productNom`,
       `p`.`stock`            AS `productStock`,
       `r`.`reduction`        AS `rayonReduction`,
       `p`.`reductionMax`     AS `productReductionMax`,
       `r`.`prixAchat`        AS `rayonPrixAchat`,
       `r`.`prixVente`        AS `rayonPrixVente`,
       `r`.`id`               AS `rayonId`,
       `r`.`quantite`         AS `rayonQuantite`,
       `r`.`quantiteRestante` AS `rayonQuantiteRestante`,
       `r`.`dateLivraison`    AS `rayonDateLivraison`,
       `p`.`id`               AS `productId`
from `pharmanet1`.`produit` `p`
         join `pharmanet1`.`en_rayon` `r`
where `p`.`id` = `r`.`produit_id`
  and `p`.`supprimer` = 0
  and `r`.`dateLivraison` in
      (select max(`e`.`dateLivraison`) from `pharmanet1`.`en_rayon` `e` where `r`.`produit_id` = `e`.`produit_id`);


update commande
set etat='Commandé'
where montantRecu IS NULL
  and qtiteRecu is null;
update commande
set etat='Livré'
where montantRecu > 0
  and qtiteRecu > 0;

create definer = root@localhost view pharma_produit_cmd_view as
select `pd_cm`.`puCmd`         AS `puCmd`,
       `pd_cm`.`ptCmd`         AS `ptCmd`,
       `pd_cm`.`qtiteCmd`      AS `qtiteCmd`,
       `pd_cm`.`etat`          AS `etat`,
       `pd_cm`.`prixPublic`    AS `prixPublic`,
       `pd_cm`.`uniteGratuite` AS `uniteGratuite`,
       `pd_cm`.`id`            AS `produitCmdId`,
       `pd`.`nom`              AS `nom`,
       `pd`.`id`               AS `produitId`,
       `cmd`.`ref`             AS `ref`,
       `cmd`.`dateCreation`    AS `dateCreationCommande`,
       `cmd`.`dateLivraison`   AS `dateLivraisonCommande`,
       `cmd`.`fournisseur_id`  AS `fournisseurId`,
       `four`.`nom`            AS `fournisseurNom`
from (((`pharmanet1`.`produit_cmd` `pd_cm` join `pharmanet1`.`produit` `pd` on (`pd_cm`.`produit_id` = `pd`.`id`)) join `pharmanet1`.`commande` `cmd` on (`pd_cm`.`commande_id` = `cmd`.`id`))
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

create definer = root@localhost view pharma_sortie_stock_view as
select `sort`.`quantite`         AS `sortQuantite`,
       `sort`.`dateSortie`       AS `sortDateSortie`,
       `sort`.`detail_id`        AS `sortDetail_id`,
       `tp`.`nom`                AS `tpNom`,
       `tp`.`description`        AS `tpDescription`,
       `en_r`.`prixAchat`        AS `prixAchat`,
       `en_r`.`prixVente`        AS `prixVente`,
       `en_r`.`dateLivraison`    AS `dateLivraison`,
       `en_r`.`datePeremption`   AS `datePeremption`,
       `en_r`.`quantite`         AS `quantite_rayon`,
       `en_r`.`quantiteRestante` AS `quantiteRestante`,
       `pdt`.`id`                AS `produitId`,
       `pdt`.`nom`               AS `nom`
from (((`pharmanet1`.`sortie_stock` `sort`
    join `pharmanet1`.`en_rayon` `en_r` on (`sort`.`en_rayon_id` = `en_r`.`id`)
    join `pharmanet1`.`produit` `pdt` on (`pdt`.`id` = `en_r`.`produit_id`))
    join `pharmanet1`.`type_sortie` `tp` on (`tp`.`id` = `sort`.`type_sortie_id`))
         join `pharmanet1`.`forme` `form` on (`pdt`.`forme_id` = `form`.`id`));
