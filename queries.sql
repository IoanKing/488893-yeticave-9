/* Добавление новых пользователей */
/* логин: ivan.ivanov@mail.ru, пароль: 12345*/
INSERT INTO users (name, email, password, avatar, contact, date_registration) VALUES
('Иван', 'ioankingisepp@yandex.ru', '$2y$10$/xb2OUrB4T9aMjspKvHj1./v..T1E8hUfq5tRnPF2pDxzdgX7Y5Xq', 'avatar.jpg', '8(999) 876-54-32', '2018-06-12 05:30'),
('Константин', 'ioankingisepp@mail.ru', '$2y$10$/xb2OUrB4T9aMjspKvHj1./v..T1E8hUfq5tRnPF2pDxzdgX7Y5Xq', 'avatar.jpg', '8(654)123-55-33', '2019-04-03 11:24');

/* Добавление лотов */
INSERT INTO lots (title, description, picture, start_price, staf_step, user_id, category_id, create_date, end_date, winner_id) VALUES
(
    '2014 Rossignol District Snowboard',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur varius accumsan ante sodales vulputate. Donec ornare orci eu aliquet molestie. Vivamus vestibulum porttitor rhoncus. Integer ultricies pharetra pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lobortis in quam eget elementum. Integer quis nibh vel metus fermentum finibus. Nulla facilisi. Etiam nulla velit, maximus id facilisis nec, ornare sit amet turpis. Phasellus placerat condimentum sapien vitae semper. Pellentesque a diam cursus, luctus nunc eget, consequat odio. Ut consectetur risus sit amet commodo interdum. Nullam scelerisque volutpat nunc ut ultrices.',
    'lot-1.jpg',
    10999,
    12000,
    2,
    1,
    DATE_SUB(CURDATE(), INTERVAL 1 DAY),
    DATE_ADD(CURDATE(), INTERVAL 1 DAY),
    NULL
),
(
    'DC Ply Mens 2016/2017 Snowboard',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur varius accumsan ante sodales vulputate. Donec ornare orci eu aliquet molestie. Vivamus vestibulum porttitor rhoncus. Integer ultricies pharetra pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lobortis in quam eget elementum. Integer quis nibh vel metus fermentum finibus. Nulla facilisi. Etiam nulla velit, maximus id facilisis nec, ornare sit amet turpis. Phasellus placerat condimentum sapien vitae semper. Pellentesque a diam cursus, luctus nunc eget, consequat odio. Ut consectetur risus sit amet commodo interdum. Nullam scelerisque volutpat nunc ut ultrices.',
    'lot-2.jpg',
    159999,
    50000,
    1,
    1,
    DATE_SUB(CURDATE(), INTERVAL 2 DAY),
    DATE_ADD(CURDATE(), INTERVAL 1 DAY),
    NULL
),
(
    'Крепления Union Contact Pro 2015 года размер L/XL',
    'Donec ornare orci eu aliquet molestie. Vivamus vestibulum porttitor rhoncus. Integer ultricies pharetra pulvinar.',
    'lot-3.jpg',
    8000,
    1000,
    1,
    2,
    DATE_SUB(CURDATE(), INTERVAL 1 DAY),
    DATE_ADD(CURDATE(), INTERVAL 1 DAY),
    NULL
),
(
    'Ботинки для сноуборда DC Mutiny Charocal',
    'Mauris sed egestas quam. Phasellus sed purus condimentum, pretium justo sed, fermentum est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec feugiat orci sit amet facilisis cursus.',
    'lot-4.jpg',
    10999,
    2000,
    2,
    3,
    DATE_SUB(CURDATE(), INTERVAL 4 DAY),
    DATE_ADD(CURDATE(), INTERVAL 2 DAY),
    NULL
),
(
    'Куртка для сноуборда DC Mutiny Charocal',
    'Praesent ac ultricies nulla, non tristique sapien. Donec imperdiet nisl blandit magna bibendum, eget ornare neque pellentesque. Nulla sagittis tristique ultri',
    'lot-5.jpg',
    7500,
    2500,
    2,
    4,
    DATE_SUB(CURDATE(), INTERVAL 4 DAY),
    DATE_SUB(CURDATE(), INTERVAL 1 DAY),
    NULL
),
(
    'Маска Oakley Canopy',
    'Donec vel laoreet nibh, quis viverra sem. In hac habitasse platea dictumst. Maecenas ac urna tellus. Aenean diam metus, rutrum et dignissim quis, pharetra non lacus. Aenean a leo neque. Pellentesque eros metus, cursus id placerat vel, interdum sed libero. Nunc tincidunt porta metus, quis tristique ex. Nulla feugiat et lectus vel dignissim. Vestibulum rutrum nulla laoreet urna pulvinar, nec hendrerit eros iaculis.',
    'lot-6.jpg',
    5400,
    1500,
    2,
    6,
    DATE_SUB(CURDATE(), INTERVAL 5 DAY),
    DATE_SUB(CURDATE(), INTERVAL 3 DAY),
    NULL
),
(
    '2019 Rossignol District Snowboard',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur varius accumsan ante sodales vulputate. Donec ornare orci eu aliquet molestie. Vivamus vestibulum porttitor rhoncus. Integer ultricies pharetra pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lobortis in quam eget elementum. Integer quis nibh vel metus fermentum finibus. Nulla facilisi. Etiam nulla velit, maximus id facilisis nec, ornare sit amet turpis. Phasellus placerat condimentum sapien vitae semper. Pellentesque a diam cursus, luctus nunc eget, consequat odio. Ut consectetur risus sit amet commodo interdum. Nullam scelerisque volutpat nunc ut ultrices.',
    'lot-1.jpg',
    10999,
    12000,
    2,
    1,
    DATE_SUB(CURDATE(), INTERVAL 1 DAY),
    DATE_ADD(CURDATE(), INTERVAL 1 DAY),
    NULL
),
(
    'DC Ply Mens 2018/2019 Snowboard',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur varius accumsan ante sodales vulputate. Donec ornare orci eu aliquet molestie. Vivamus vestibulum porttitor rhoncus. Integer ultricies pharetra pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lobortis in quam eget elementum. Integer quis nibh vel metus fermentum finibus. Nulla facilisi. Etiam nulla velit, maximus id facilisis nec, ornare sit amet turpis. Phasellus placerat condimentum sapien vitae semper. Pellentesque a diam cursus, luctus nunc eget, consequat odio. Ut consectetur risus sit amet commodo interdum. Nullam scelerisque volutpat nunc ut ultrices.',
    'lot-2.jpg',
    159999,
    50000,
    1,
    1,
    DATE_SUB(CURDATE(), INTERVAL 2 DAY),
    DATE_ADD(CURDATE(), INTERVAL 1 DAY),
    NULL
),
(
    'Крепления Union Contact Pro 2019 года размер S/M',
    'Donec ornare orci eu aliquet molestie. Vivamus vestibulum porttitor rhoncus. Integer ultricies pharetra pulvinar.',
    'lot-3.jpg',
    8000,
    1000,
    1,
    2,
    DATE_SUB(CURDATE(), INTERVAL 1 DAY),
    DATE_ADD(CURDATE(), INTERVAL 1 DAY),
    NULL
),
(
    'Ботинки для сноуборда DC Mutiny Charocal 2019',
    'Mauris sed egestas quam. Phasellus sed purus condimentum, pretium justo sed, fermentum est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec feugiat orci sit amet facilisis cursus.',
    'lot-4.jpg',
    10999,
    2000,
    1,
    3,
    DATE_SUB(CURDATE(), INTERVAL 4 DAY),
    DATE_ADD(CURDATE(), INTERVAL 2 DAY),
    NULL
),
(
    'Куртка для сноуборда DC Mutiny Charocal 2019',
    'Praesent ac ultricies nulla, non tristique sapien. Donec imperdiet nisl blandit magna bibendum, eget ornare neque pellentesque. Nulla sagittis tristique ultri',
    'lot-5.jpg',
    7500,
    2500,
    2,
    4,
    DATE_SUB(CURDATE(), INTERVAL 4 DAY),
    DATE_SUB(CURDATE(), INTERVAL 1 DAY),
    NULL
);

/* Добавление ставок для лотов */
INSERT INTO user_staf (lot_id, user_id, amount, staf_date) VALUES
(1, 1, 12500, DATE_SUB(NOW(), INTERVAL "0 05:25" DAY_MINUTE)),
(1, 2, 14000, DATE_SUB(NOW(), INTERVAL "0 10:15" DAY_MINUTE)),
(1, 1, 13000, DATE_SUB(NOW(), INTERVAL "0 01:25" DAY_MINUTE)),
(1, 2, 13400, DATE_SUB(NOW(), INTERVAL "0 04:05" DAY_MINUTE)),
(1, 1, 12200, DATE_SUB(NOW(), INTERVAL "0 23:55" DAY_MINUTE)),
(1, 2, 15000, DATE_SUB(NOW(), INTERVAL "0 02:00" DAY_MINUTE)),
(1, 1, 12600, DATE_SUB(NOW(), INTERVAL "0 14:24" DAY_MINUTE)),
(1, 2, 17000, DATE_SUB(NOW(), INTERVAL "0 05:55" DAY_MINUTE)),
(1, 1, 12400, DATE_SUB(NOW(), INTERVAL "0 03:45" DAY_MINUTE)),
(2, 1, 12500, DATE_SUB(NOW(), INTERVAL "0 05:25" DAY_MINUTE)),
(3, 2, 14000, DATE_SUB(NOW(), INTERVAL "0 10:15" DAY_MINUTE)),
(4, 1, 13000, DATE_SUB(NOW(), INTERVAL "0 01:25" DAY_MINUTE)),
(4, 2, 13400, DATE_SUB(NOW(), INTERVAL "0 04:05" DAY_MINUTE)),
(6, 1, 14000, DATE_SUB(NOW(), INTERVAL "3 10:15" DAY_MINUTE)),
(6, 2, 13000, DATE_SUB(NOW(), INTERVAL "4 01:25" DAY_MINUTE)),
(6, 1, 13400, DATE_SUB(NOW(), INTERVAL "4 04:05" DAY_MINUTE)),
(5, 1, 14000, DATE_SUB(NOW(), INTERVAL "3 10:15" DAY_MINUTE)),
(5, 2, 13000, DATE_SUB(NOW(), INTERVAL "4 01:25" DAY_MINUTE)),
(5, 1, 13400, DATE_SUB(NOW(), INTERVAL "4 04:05" DAY_MINUTE)),
(4, 2, 12200, DATE_SUB(NOW(), INTERVAL "0 23:55" DAY_MINUTE));

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