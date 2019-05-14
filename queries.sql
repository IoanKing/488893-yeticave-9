/* Запрос на получение всех категорий*/
SELECT * FROM cathegory;

/*
    Запрос на получение самых новых, открытых лотов (без даты окончания).
    В результате запроса выводятся: название, стартовая цена, ссылка на изображение, текущая цена, название категории
*/
SELECT title, start_price, picture, IFNULL(MAX(s1.amount),start_price) price, c.name FROM lots l
    JOIN cathegory c ON l.category_id = c.id
    LEFT JOIN user_staf s1 ON s1.lot_id = l.id
    WHERE end_date IS NULL
    GROUP BY title, start_price, picture, c.name, create_date
    ORDER BY create_date DESC
    LIMIT 5;

/* Запрос лота по его id. Также выводиться название категории, к которой принадлежит лот*/
SELECT title, description, picture, start_price, staf_step, c.name cathegory FROM lots l
    JOIN cathegory c ON l.category_id = c.id
    WHERE l.id = 4;

/* Обновление наименования лота по его id */
UPDATE lots SET title = 'Новое наименование лота'
    WHERE id = 4;

/* Запрос на получение списока самых свежих ставок для лота по его идентификатору */
SELECT u.name, amount staff, staf_date FROM lots l
    JOIN user_staf s ON l.id = s.lot_id
    JOIN users u ON s.user_id = u.id
    WHERE l.id = 1
    ORDER BY staf_date DESC
    LIMIT 5;

/* Запрос на выборку ставок пользователя */
SELECT l.id as lot_id, picture, title, u.contact as contact, c.name AS cathegory, end_date, winner_id, s1.amount AS rate, MAX(s1.staf_date) AS staf_date
    FROM lots AS l
    JOIN cathegory AS c ON l.category_id = c.id
    LEFT JOIN user_staf s1 ON s1.lot_id = l.id
    LEFT JOIN users u ON l.user_id = u.id
    WHERE s1.user_id = 7
    GROUP BY lot_id, title, contact, staf_date, picture, cathegory, end_date, description, rate, winner_id
    ORDER BY end_date DESC;

/* Количество возможных результатов поиска */
SELECT COUNT(*)
    FROM lots
    WHERE MATCH(title, description) AGAINST('Lorem');

/* Результаты поиска */
SELECT l.id, title, description, picture, start_price, staf_step, c.name AS cathegory, end_date
    FROM lots AS l
    JOIN cathegory AS c ON l.category_id = c.id
    WHERE MATCH(title, description) AGAINST('Lorem')
    LIMIT 3 OFFSET 1;