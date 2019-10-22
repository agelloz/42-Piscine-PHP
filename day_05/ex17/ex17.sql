SELECT COUNT(id_sub) AS `nb_abo`, FLOOR(AVG(price)) AS `moy_abo`, MOD(SUM(duration_sub), 42) AS `ft` 
FROM subscription;