/* Добавление категорий */
INSERT INTO cathegory (name, code) VALUES
    ('Доски и лыжи', 'boards'),
    ('Крепления', 'attachment'),
    ('Ботинки', 'boots'),
    ('Одежда', 'clothing'),
    ('Инструменты', 'tools'),
    ('Разное', 'other');

/* Добавление новых пользователей */
INSERT INTO users (name, email, password, avatar, contact, date_registration) VALUES
    ('Иван', 'ivanov.ivan@mail.ru', 'u9AO#91#l6', 'avatar.jpg', 'Телефон: 8(999) 876-54-32', '2018-06-12 05:30'),
    ('Константин', 'petrov.konstantine@gmail.com', '&75ixo0)xM(q', 'avatar.jpg', 'Телефон: 8(654)123-55-33', '2019-04-03 11:24'),
    ('Семён', 'sidorov85@rambler.ru', 'Ns2&UBC8#7%q', 'avatar.jpg', 'Телефон: 8(333) 457-12-34', '2019-01-01 01:00'),
    ('Евгений', 'kirjacov76@rambler.ru', 'b&5B)t9*rOoi&UBC8#7%q', 'avatar.jpg', 'Телефон: 8(444) 444-44-44', '2019-01-01 01:00'),
    ('Игорь', 'igor1976@mail.ru', 'Ns2&6i1c*%S&FZmQ#7%q', 'avatar.jpg', 'Телефон: 8(555) 555-55-55', '2019-04-01 16:05'),
    ('Енакентий', 'hanter1234@gmail.com', '%A33xm*E*G9N&UBC8#7%q', 'avatar.jpg', 'Телефон: 8(666) 666-66-66', '2017-06-23 15:55');

/* Добавление лотов */
INSERT INTO lots (title, description, picture, start_price, staf_step, user_id, category_id, create_date) VALUES
    (
         '2014 Rossignol District Snowboard',
         'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur varius accumsan ante sodales vulputate. Donec ornare orci eu aliquet molestie. Vivamus vestibulum porttitor rhoncus. Integer ultricies pharetra pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lobortis in quam eget elementum. Integer quis nibh vel metus fermentum finibus. Nulla facilisi. Etiam nulla velit, maximus id facilisis nec, ornare sit amet turpis. Phasellus placerat condimentum sapien vitae semper. Pellentesque a diam cursus, luctus nunc eget, consequat odio. Ut consectetur risus sit amet commodo interdum. Nullam scelerisque volutpat nunc ut ultrices.',
         'lot-1.jpg',
         10999,
         12000,
         2,
         1,
         DATE_SUB(NOW(), INTERVAL 16 HOUR)
     ),
    (
        'DC Ply Mens 2016/2017 Snowboard',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur varius accumsan ante sodales vulputate. Donec ornare orci eu aliquet molestie. Vivamus vestibulum porttitor rhoncus. Integer ultricies pharetra pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lobortis in quam eget elementum. Integer quis nibh vel metus fermentum finibus. Nulla facilisi. Etiam nulla velit, maximus id facilisis nec, ornare sit amet turpis. Phasellus placerat condimentum sapien vitae semper. Pellentesque a diam cursus, luctus nunc eget, consequat odio. Ut consectetur risus sit amet commodo interdum. Nullam scelerisque volutpat nunc ut ultrices.',
        'lot-2.jpg',
        159999,
        50000,
        1,
        1,
        DATE_SUB(NOW(), INTERVAL 54 MINUTE)
    ),
    (
        'Крепления Union Contact Pro 2015 года размер L/XL',
        'Donec ornare orci eu aliquet molestie. Vivamus vestibulum porttitor rhoncus. Integer ultricies pharetra pulvinar.',
        'lot-3.jpg',
        8000,
        1000,
        1,
        2,
        DATE_SUB(NOW(), INTERVAL 10 HOUR)
    ),
    (
        'Ботинки для сноуборда DC Mutiny Charocal',
        'Mauris sed egestas quam. Phasellus sed purus condimentum, pretium justo sed, fermentum est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec feugiat orci sit amet facilisis cursus.',
        'lot-4.jpg',
        10999,
        2000,
        3,
        3,
        DATE_SUB(NOW(), INTERVAL 12 MINUTE)
    ),
    (
        'Куртка для сноуборда DC Mutiny Charocal',
        'Praesent ac ultricies nulla, non tristique sapien. Donec imperdiet nisl blandit magna bibendum, eget ornare neque pellentesque. Nulla sagittis tristique ultri',
        'lot-5.jpg',
        7500,
        2500,
        2,
        4,
        DATE_SUB(NOW(), INTERVAL 2 DAY)
    ),
    (
        'Маска Oakley Canopy',
        'Donec vel laoreet nibh, quis viverra sem. In hac habitasse platea dictumst. Maecenas ac urna tellus. Aenean diam metus, rutrum et dignissim quis, pharetra non lacus. Aenean a leo neque. Pellentesque eros metus, cursus id placerat vel, interdum sed libero. Nunc tincidunt porta metus, quis tristique ex. Nulla feugiat et lectus vel dignissim. Vestibulum rutrum nulla laoreet urna pulvinar, nec hendrerit eros iaculis.',
        'lot-6.jpg',
        5400,
        1500,
        2,
        6,
        DATE_SUB(NOW(), INTERVAL 7 HOUR)
    );

/* Добавление ставок для лотов */
INSERT INTO user_staf (lot_id, user_id, amount, staf_date) VALUES
    (1, 1, 12500, '2019-04-20 10:40'),
    (1, 2, 14000, '2019-04-20 10:25'),
    (1, 3, 13000, '2019-04-20 09:45'),
    (1, 4, 13400, '2019-03-19 08:21'),
    (1, 5, 12200, '2019-03-19 13:20'),
    (1, 6, 15000, '2019-03-19 12:20'),
    (1, 3, 12600, '2019-03-19 14:20'),
    (1, 4, 17000, '2019-03-19 14:25'),
    (1, 5, 12400, '2019-03-19 10:02');

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
