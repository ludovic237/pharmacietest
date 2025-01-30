# ajouter concerner quantite


ALTER TABLE `commande`
ADD `employe_id` int NULL AFTER `id`;

# ajout de la colonne dateEncaissement dans la table Vente

ALTER TABLE `vente`
ADD `dateEncaissement` datetime NULL AFTER `dateVente`;

# selection des ID en_rayon avec _ 

select * from en_rayon where id like '%\_%'

update en_rayon set supprimer=1 where id like '%\_%'