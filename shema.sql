CREATE DATABASE yaticave_488893
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE yaticave_488893;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_registration TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    email CHAR(128) NOT NULL UNIQUE,
    name CHAR(128) NOT NULL,
    password CHAR(64) NOT NULL,
    avatar CHAR(255),
    contact TEXT(560)
);

CREATE INDEX u_name ON users(name);

CREATE TABLE lots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    title CHAR(255) NOT NULL,
    description TEXT(1200),
    picture CHAR(255),
    start_price INT(10) NOT NULL,
    end_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    staf_step INT(3) NOT NULL,
    user_id INT NOT NULL,
    winner_id INT,
    category_id INT
);

CREATE INDEX l_title ON lots(title);
CREATE FULLTEXT INDEX lot_search ON lots(title, description);

CREATE TABLE cathegory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(255) NOT NULL UNIQUE,
    code CHAR(128) NOT NULL UNIQUE
);

CREATE INDEX c_name ON cathegory(name);

CREATE TABLE user_staf (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staf_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    amount INT(10) NOT NULL,
    user_id INT,
    lot_id INT
);

/* Добавление категорий */
INSERT INTO cathegory (name, code) VALUES
('Доски и лыжи', 'boards'),
('Крепления', 'attachment'),
('Ботинки', 'boots'),
('Одежда', 'clothing'),
('Инструменты', 'tools'),
('Разное', 'other');

/* Добавление новых пользователей */
/* логин: ivan.ivanov@mail.ru, пароль: 12345*/
INSERT INTO users (name, email, password, avatar, contact, date_registration) VALUES
('Иван', 'ivan.ivanov@mail.ru', '$2y$10$/xb2OUrB4T9aMjspKvHj1./v..T1E8hUfq5tRnPF2pDxzdgX7Y5Xq', 'avatar.jpg', '8(999) 876-54-32', '2018-06-12 05:30'),
('Константин', 'konstantine.petrov@gmail.com', '$2y$10$/xb2OUrB4T9aMjspKvHj1./v..T1E8hUfq5tRnPF2pDxzdgX7Y5Xq', 'avatar.jpg', '8(654)123-55-33', '2019-04-03 11:24'),
('Семён', 'sidorov85@rambler.ru', '$2y$10$/xb2OUrB4T9aMjspKvHj1./v..T1E8hUfq5tRnPF2pDxzdgX7Y5Xq', 'avatar.jpg', '8(333) 457-12-34', '2019-01-01 01:00'),
('Евгений', 'kirjacov76@rambler.ru', '$2y$10$/xb2OUrB4T9aMjspKvHj1./v..T1E8hUfq5tRnPF2pDxzdgX7Y5Xq', 'avatar.jpg', '8(444) 444-44-44', '2019-01-01 01:00'),
('Игорь', 'igor1976@mail.ru', '$2y$10$/xb2OUrB4T9aMjspKvHj1./v..T1E8hUfq5tRnPF2pDxzdgX7Y5Xq', 'avatar.jpg', '8(555) 555-55-55', '2019-04-01 16:05'),
('Енакентий', 'hanter1234@gmail.com', '$2y$10$/xb2OUrB4T9aMjspKvHj1./v..T1E8hUfq5tRnPF2pDxzdgX7Y5Xq', 'avatar.jpg', '8(666) 666-66-66', '2017-06-23 15:55');

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
    3,
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
    3,
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
(1, 3, 13000, DATE_SUB(NOW(), INTERVAL "0 01:25" DAY_MINUTE)),
(1, 4, 13400, DATE_SUB(NOW(), INTERVAL "0 04:05" DAY_MINUTE)),
(1, 5, 12200, DATE_SUB(NOW(), INTERVAL "0 23:55" DAY_MINUTE)),
(1, 6, 15000, DATE_SUB(NOW(), INTERVAL "0 02:00" DAY_MINUTE)),
(1, 3, 12600, DATE_SUB(NOW(), INTERVAL "0 14:24" DAY_MINUTE)),
(1, 4, 17000, DATE_SUB(NOW(), INTERVAL "0 05:55" DAY_MINUTE)),
(1, 5, 12400, DATE_SUB(NOW(), INTERVAL "0 03:45" DAY_MINUTE)),
(2, 1, 12500, DATE_SUB(NOW(), INTERVAL "0 05:25" DAY_MINUTE)),
(3, 2, 14000, DATE_SUB(NOW(), INTERVAL "0 10:15" DAY_MINUTE)),
(4, 3, 13000, DATE_SUB(NOW(), INTERVAL "0 01:25" DAY_MINUTE)),
(4, 4, 13400, DATE_SUB(NOW(), INTERVAL "0 04:05" DAY_MINUTE)),
(6, 1, 14000, DATE_SUB(NOW(), INTERVAL "3 10:15" DAY_MINUTE)),
(6, 3, 13000, DATE_SUB(NOW(), INTERVAL "4 01:25" DAY_MINUTE)),
(6, 4, 13400, DATE_SUB(NOW(), INTERVAL "4 04:05" DAY_MINUTE)),
(5, 1, 14000, DATE_SUB(NOW(), INTERVAL "3 10:15" DAY_MINUTE)),
(5, 3, 13000, DATE_SUB(NOW(), INTERVAL "4 01:25" DAY_MINUTE)),
(5, 4, 13400, DATE_SUB(NOW(), INTERVAL "4 04:05" DAY_MINUTE)),
(4, 5, 12200, DATE_SUB(NOW(), INTERVAL "0 23:55" DAY_MINUTE));
