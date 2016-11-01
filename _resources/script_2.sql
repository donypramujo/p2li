CREATE TABLE `breeders` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `breeders_name_unique` (`name`)
);
	
 teaaaa
ALTER TABLE `contestants`
	ADD COLUMN `breeder_id` INT UNSIGNED NULL AFTER `updated_at`,
	ADD INDEX `contestants_breeder_id_foreign` (`breeder_id`),
	ADD FOREIGN KEY (`breeder_id`) REFERENCES `breeders` (`id`);

CREATE VIEW `live_scores` AS select `c`.`contest_id` AS `contest_id`,`c`.`breeder_id` AS `breeder_id`,`c`.`id` AS `id`,`c`.`id` AS `contestant_id`,`c`.`title_id` AS `title_id`,`c`.`subcategory_id` AS `subcategory_id`,`c`.`tank_number` AS `tank_number`,`c`.`team_id` AS `team_id`,sum(if((`s`.`valid` = 1),`s`.`score_final`,0)) AS `score` from (`contestants` `c` left join `scores` `s` on((`c`.`id` = `s`.`contestant_id`))) where (`c`.`nomination` = 1) group by `c`.`id` order by sum(if((`s`.`valid` = 1),`s`.`score_final`,0)) desc

CREATE  VIEW `live_breeder_scores` AS select sum(`live_scores`.`score`) AS `score`,`live_scores`.`contest_id` AS `contest_id`,`live_scores`.`breeder_id` AS `breeder_id` from `live_scores` where (`live_scores`.`breeder_id` is not null) group by `live_scores`.`breeder_id`,`live_scores`.`contest_id` order by sum(`live_scores`.`score`) desc
