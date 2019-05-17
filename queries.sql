/* Выборка списка категорий */
SELECT id, name, code
    FROM cathegory;

/* Определение именени категории по его id */
SELECT name
    FROM cathegory
    WHERE id = 1;

/* Выборка списка активных лотов */
SELECT l.id, title, description, picture, start_price, staf_step, c.name AS cathegory, end_date
    FROM lots AS l
    JOIN cathegory AS c ON l.category_id = c.id
    WHERE end_date > NOW() OR end_date IS NULL
    ORDER BY create_date DESC;

/* Выборка списка лотов по категории */
SELECT l.id, title, description, picture, start_price, staf_step, c.name AS cathegory, end_date
    FROM lots AS l
    JOIN cathegory AS c ON l.category_id = c.id
    WHERE c.id = 1
    ORDER BY create_date DESC
    LIMIT 9 OFFSET 0;

/* Определение количества лотов по категории */
SELECT COUNT(*) AS count
    FROM lots
    WHERE category_id = 1;

/* Выборка полных данных конкретного лота по его id */
SELECT l.id, title, start_price, picture, IFNULL(MAX(s1.amount), start_price) AS price, staf_step, c.name AS cathegory, end_date, description
    FROM lots AS l
    JOIN cathegory AS c ON l.category_id = c.id
    LEFT JOIN user_staf s1 ON s1.lot_id = l.id
    WHERE l.id = 1
    GROUP BY id, title, start_price, staf_step, picture, c.name, end_date, description
    ORDER BY create_date DESC;

/* Выборка данных лота по его id */
SELECT title, description, picture, start_price, staf_step, c.name AS cathegory
    FROM lots AS l
    JOIN cathegory AS c ON l.category_id = c.id
    WHERE l.id = 1;

/* Получение писка последних 10 ставок по лоту */
SELECT u.name, amount, staf_date
    FROM lots AS l
    JOIN user_staf s ON l.id = s.lot_id
    JOIN users u ON s.user_id = u.id
    WHERE l.id = 1
    ORDER BY staf_date DESC
    LIMIT 10;

/* Получение писка ставок пользователя */
SELECT l.id as lot_id, picture, title, u.contact as contact, c.name AS cathegory, end_date, winner_id, s1.amount AS rate, s1.staf_date AS staf_date
    FROM lots AS l
    JOIN cathegory AS c ON l.category_id = c.id
    LEFT JOIN user_staf s1 ON s1.lot_id = l.id
    LEFT JOIN users u ON l.user_id = u.id
    WHERE s1.user_id = 1 AND s1.amount = (SELECT MAX(s2.amount) FROM user_staf AS s2 WHERE s2.user_id = s1.user_id AND s2.lot_id = l.id)
    GROUP BY lot_id, title, contact, staf_date, picture, cathegory, end_date, description, rate, winner_id
    ORDER BY s1.staf_date DESC;

/* Получение e-mail пользователя по его id */
SELECT id
    FROM users
    WHERE email = "ivan.ivanov@mail.ru";

/* Получение пользователя сделавшего последнюю ставку для лота */
SELECT user_id AS id
    FROM user_staf
    WHERE lot_id = 1
    ORDER BY staf_date DESC
    LIMIT 1;

/* Получение количества результатов поиска */
SELECT COUNT(*) AS count
    FROM lots
    WHERE MATCH(title, description) AGAINST('lorem');

/* Получение результатов поиска */
SELECT l.id, title, description, picture, start_price, staf_step, c.name AS cathegory, end_date
    FROM lots AS l
    JOIN cathegory AS c ON l.category_id = c.id
    WHERE MATCH(title, description) AGAINST('lorem')
    LIMIT 1 OFFSET 0;

/* Получение списка победителей */
SELECT l.id AS id, s1.user_id AS user, l.title
    FROM lots AS l
    LEFT JOIN user_staf AS s1 ON s1.lot_id = l.id
    WHERE s1.amount = (
        SELECT MAX(s2.amount)
        FROM user_staf AS s2
        WHERE s2.lot_id = l.id
    ) AND l.winner_id IS NULL AND end_date > NOW();


/* регистрация нового лота */
INSERT
    INTO lots
    (title, description, picture, start_price, staf_step, user_id, category_id, create_date, end_date) VALUES
    (
         'Новый лот',
         'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris porta faucibus erat, in convallis velit maximus at. Morbi tempor nulla vel magna vestibulum, ut commodo magna condimentum. Donec ac tristique massa. Curabitur lectus est, tincidunt a congue id, luctus quis nunc. Donec id ultricies magna. Ut pellentesque, nibh eget auctor accumsan, mi eros accumsan massa, quis porta turpis orci quis ipsum. Mauris purus sapien, sodales et est non, elementum rutrum velit. ',
         '',
         10000,
         1000,
         1,
         1,
         NOW(),
         DATE_ADD(NOW(), INTERVAL 1 DAY)
     );

/* регистрация нового пользователя */
INSERT
    INTO users
    (name, email, password, avatar, contact, date_registration) VALUES
    ('Ivan', 'ivan.ivanov2@mail.ru', '$2y$10$/xb2OUrB4T9aMjspKvHj1./v..T1E8hUfq5tRnPF2pDxzdgX7Y5Xq', '', '555-555-555', NOW());

/* регистрация новой ставка */
INSERT
    INTO user_staf
    (lot_id, user_id, amount, staf_date) VALUES
    (1, 1, 30000, NOW());

/* Обновление победителя лота */
UPDATE lots
    SET winner_id = NULL
    WHERE id = 1;

/* Обновление даты окончания торгов для лота */
update lots
    SET end_date = DATE_ADD(NOW(), INTERVAL 1 SECOND)
    WHERE id = 3;