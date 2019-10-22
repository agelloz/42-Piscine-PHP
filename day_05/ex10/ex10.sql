SELECT film.title AS `Title`, film.summary as `Summary`, film.prod_year 
FROM film INNER JOIN genre 
ON film.id_genre = genre.id_genre AND genre.name = 'erotic' 
ORDER BY film.prod_year DESC;