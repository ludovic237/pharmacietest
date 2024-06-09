-- creation de la colonne detail_id dans la table prodduit
ALTER TABLE `produit`
ADD `detail_id` int NULL AFTER `grossiste_id`;

-- creation de la table produit_detail
DROP TABLE IF EXISTS `produit_detail`;
CREATE TABLE `produit_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(32) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `stockMax` int(11) NOT NULL,
  `stockMin` int(11) NOT NULL,
  `reductionMax` int(11) NOT NULL DEFAULT '0',
  `prix` int(11) NOT NULL,
  `grossiste_list` varchar(100) NOT NULL,
  `supprimer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;