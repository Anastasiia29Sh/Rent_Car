--
-- Скрипт сгенерирован Devart dbForge Studio 2019 for MySQL, Версия 8.1.22.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 15.05.2022 16:15:28
-- Версия сервера: 5.7.25
-- Версия клиента: 4.1
--

-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

--
-- Удалить функцию `user_year`
--
DROP FUNCTION IF EXISTS user_year;

--
-- Удалить таблицу `ips`
--
DROP TABLE IF EXISTS ips;

--
-- Удалить таблицу `visits`
--
DROP TABLE IF EXISTS visits;

--
-- Удалить процедуру `add_services`
--
DROP PROCEDURE IF EXISTS add_services;

--
-- Удалить процедуру `delete_rent`
--
DROP PROCEDURE IF EXISTS delete_rent;

--
-- Удалить функцию `summa`
--
DROP FUNCTION IF EXISTS summa;

--
-- Удалить таблицу `list_services`
--
DROP TABLE IF EXISTS list_services;

--
-- Удалить таблицу `services`
--
DROP TABLE IF EXISTS services;

--
-- Удалить представление `all_drivers`
--
DROP VIEW IF EXISTS all_drivers CASCADE;

--
-- Удалить процедуру `add_contract`
--
DROP PROCEDURE IF EXISTS add_contract;

--
-- Удалить функцию `is_login`
--
DROP FUNCTION IF EXISTS is_login;

--
-- Удалить функцию `is_password`
--
DROP FUNCTION IF EXISTS is_password;

--
-- Удалить представление `all_users`
--
DROP VIEW IF EXISTS all_users CASCADE;

--
-- Удалить процедуру `add_driver`
--
DROP PROCEDURE IF EXISTS add_driver;

--
-- Удалить процедуру `add_user`
--
DROP PROCEDURE IF EXISTS add_user;

--
-- Удалить процедуру `delete_driver`
--
DROP PROCEDURE IF EXISTS delete_driver;

--
-- Удалить таблицу `authorization`
--
DROP TABLE IF EXISTS authorization;

--
-- Удалить представление `all_black`
--
DROP VIEW IF EXISTS all_black CASCADE;

--
-- Удалить таблицу `black_list`
--
DROP TABLE IF EXISTS black_list;

--
-- Удалить функцию `is_free_car`
--
DROP FUNCTION IF EXISTS is_free_car;

--
-- Удалить функцию `is_free_drivers`
--
DROP FUNCTION IF EXISTS is_free_drivers;

--
-- Удалить представление `all_rent`
--
DROP VIEW IF EXISTS all_rent CASCADE;

--
-- Удалить процедуру `add_rent`
--
DROP PROCEDURE IF EXISTS add_rent;

--
-- Удалить таблицу `rent`
--
DROP TABLE IF EXISTS rent;

--
-- Удалить процедуру `delete_car`
--
DROP PROCEDURE IF EXISTS delete_car;

--
-- Удалить таблицу `contract`
--
DROP TABLE IF EXISTS contract;

--
-- Удалить процедуру `edit_driver`
--
DROP PROCEDURE IF EXISTS edit_driver;

--
-- Удалить таблицу `drivers`
--
DROP TABLE IF EXISTS drivers;

--
-- Удалить таблицу `user`
--
DROP TABLE IF EXISTS user;

--
-- Удалить таблицу `payment`
--
DROP TABLE IF EXISTS payment;

--
-- Удалить таблицу `stock`
--
DROP TABLE IF EXISTS stock;

--
-- Удалить процедуру `info_all_cars`
--
DROP PROCEDURE IF EXISTS info_all_cars;

--
-- Удалить представление `all_cars`
--
DROP VIEW IF EXISTS all_cars CASCADE;

--
-- Удалить процедуру `add_car`
--
DROP PROCEDURE IF EXISTS add_car;

--
-- Удалить процедуру `edit_car`
--
DROP PROCEDURE IF EXISTS edit_car;

--
-- Удалить таблицу `cars`
--
DROP TABLE IF EXISTS cars;

--
-- Удалить таблицу `class`
--
DROP TABLE IF EXISTS class;

--
-- Удалить функцию `is_color`
--
DROP FUNCTION IF EXISTS is_color;

--
-- Удалить таблицу `color`
--
DROP TABLE IF EXISTS color;

--
-- Удалить функцию `is_model`
--
DROP FUNCTION IF EXISTS is_model;

--
-- Удалить таблицу `model`
--
DROP TABLE IF EXISTS model;

--
-- Удалить функцию `is_brand`
--
DROP FUNCTION IF EXISTS is_brand;

--
-- Удалить таблицу `brand`
--
DROP TABLE IF EXISTS brand;

--
-- Создать таблицу `brand`
--
CREATE TABLE brand (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 32,
AVG_ROW_LENGTH = 1170,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `title` для объекта типа таблица `brand`
--
ALTER TABLE brand
ADD UNIQUE INDEX title (title);

DELIMITER $$

--
-- Создать функцию `is_brand`
--
CREATE FUNCTION is_brand (brandd varchar(255))
RETURNS int(11)
BEGIN
  DECLARE result int;
  SELECT
    COUNT(*) INTO result
  FROM brand b
  WHERE b.title LIKE brandd;
  RETURN result;
END
$$

DELIMITER ;

--
-- Создать таблицу `model`
--
CREATE TABLE model (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  id_brand int(11) NOT NULL,
  engine_power varchar(255) NOT NULL,
  engine_volume varchar(255) NOT NULL,
  fuel_consumption varchar(255) NOT NULL,
  count_places varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 43,
AVG_ROW_LENGTH = 712,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `title` для объекта типа таблица `model`
--
ALTER TABLE model
ADD UNIQUE INDEX title (title);

--
-- Создать внешний ключ
--
ALTER TABLE model
ADD CONSTRAINT FK_model_brand_id FOREIGN KEY (id_brand)
REFERENCES brand (id) ON DELETE NO ACTION ON UPDATE CASCADE;

DELIMITER $$

--
-- Создать функцию `is_model`
--
CREATE FUNCTION is_model (modell varchar(255))
RETURNS int(11)
BEGIN
  DECLARE result int;
  SELECT
    COUNT(*) INTO result
  FROM model m
  WHERE m.title LIKE modell;
  RETURN result;
END
$$

DELIMITER ;

--
-- Создать таблицу `color`
--
CREATE TABLE color (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 26,
AVG_ROW_LENGTH = 1260,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `title` для объекта типа таблица `color`
--
ALTER TABLE color
ADD UNIQUE INDEX title (title);

DELIMITER $$

--
-- Создать функцию `is_color`
--
CREATE FUNCTION is_color (colorr varchar(255))
RETURNS int(11)
BEGIN
  DECLARE result int;
  SELECT
    COUNT(*) INTO result
  FROM color c
  WHERE c.title LIKE colorr;
  RETURN result;
END
$$

DELIMITER ;

--
-- Создать таблицу `class`
--
CREATE TABLE class (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 6,
AVG_ROW_LENGTH = 3276,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `title` для объекта типа таблица `class`
--
ALTER TABLE class
ADD UNIQUE INDEX title (title);

--
-- Создать таблицу `cars`
--
CREATE TABLE cars (
  id int(11) NOT NULL AUTO_INCREMENT,
  win_number varchar(17) NOT NULL,
  id_model int(11) NOT NULL,
  id_class int(11) NOT NULL,
  id_color int(11) NOT NULL,
  year_start varchar(4) NOT NULL,
  insurance tinyint(1) NOT NULL,
  price_day double NOT NULL,
  prepayment double NOT NULL,
  src_img varchar(255) DEFAULT NULL,
  status varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 30,
AVG_ROW_LENGTH = 712,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `win_number` для объекта типа таблица `cars`
--
ALTER TABLE cars
ADD UNIQUE INDEX win_number (win_number);

--
-- Создать внешний ключ
--
ALTER TABLE cars
ADD CONSTRAINT FK_cars FOREIGN KEY (id_class)
REFERENCES class (id) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE cars
ADD CONSTRAINT FK_cars_color_id FOREIGN KEY (id_color)
REFERENCES color (id) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE cars
ADD CONSTRAINT FK_cars_model_id FOREIGN KEY (id_model)
REFERENCES model (id) ON DELETE NO ACTION ON UPDATE CASCADE;

DELIMITER $$

--
-- Создать процедуру `edit_car`
--
CREATE PROCEDURE edit_car (IN id_car int(11), win_number varchar(17), modell varchar(255), brandd varchar(255), year_start varchar(4), engine_power varchar(255),
engine_volume varchar(255), fuel_consumption varchar(255), count_places varchar(255), colorr varchar(255), classs varchar(255), insurance tinyint(1),
price_day double, prepayment double, photo_car varchar(255))
BEGIN
  DECLARE id_brand int;
  DECLARE id_color int;
  DECLARE id_class int;
  DECLARE id_modell int;

  INSERT INTO color (title)
    SELECT
      colorr
    FROM dual
    WHERE NOT EXISTS (SELECT
        1
      FROM color
      WHERE title = colorr);

  SELECT
    id INTO id_color
  FROM color c
  WHERE c.title LIKE colorr;
  SELECT
    id INTO id_class
  FROM class cl
  WHERE cl.title LIKE classs;
  SELECT
    id_model INTO id_modell
  FROM cars c
  WHERE c.id = id_car;

  UPDATE cars c
  SET c.win_number = win_number,
      c.id_class = id_class,
      c.id_color = id_color,
      c.id_model = id_modell,
      c.year_start = year_start,
      c.insurance = insurance,
      c.price_day = price_day,
      c.prepayment = prepayment,
      c.status = 'free'
  WHERE c.id = id_car;

  UPDATE cars c
  SET c.src_img = photo_car
  WHERE c.id = id_car
  AND photo_car != "";


  UPDATE model m
  SET m.title = modell,
      m.engine_power = engine_power,
      m.engine_volume = engine_volume,
      m.fuel_consumption = fuel_consumption,
      m.count_places = count_places
  WHERE m.id = id_modell;

END
$$

--
-- Создать процедуру `add_car`
--
CREATE PROCEDURE add_car (IN win_number varchar(17), modell varchar(255), brandd varchar(255), year_start varchar(4), engine_power varchar(255),
engine_volume varchar(255), fuel_consumption varchar(255), count_places varchar(255), colorr varchar(255), classs varchar(255), insurance tinyint(1),
price_day double, prepayment double, photo_car varchar(255))
BEGIN
  DECLARE id_brand int;
  DECLARE id_color int;
  DECLARE id_class int;
  DECLARE id_model int;

  INSERT INTO color (title)
    SELECT
      colorr
    FROM dual
    WHERE NOT EXISTS (SELECT
        1
      FROM color
      WHERE title = colorr);
  INSERT INTO brand (title)
    SELECT
      brandd
    FROM dual
    WHERE NOT EXISTS (SELECT
        1
      FROM brand
      WHERE title = brandd);


  SELECT
    id INTO id_brand
  FROM brand b
  WHERE b.title LIKE brandd;
  SELECT
    id INTO id_color
  FROM color c
  WHERE c.title LIKE colorr;
  SELECT
    id INTO id_class
  FROM class cl
  WHERE cl.title LIKE classs;
  INSERT model (title, id_brand, engine_power, engine_volume, fuel_consumption, count_places)
    VALUES (modell, id_brand, engine_power, engine_volume, fuel_consumption, count_places);

  SELECT
    id INTO id_model
  FROM model m
  WHERE m.title LIKE modell;

  INSERT cars (win_number, id_model, id_class, id_color, year_start, insurance, price_day, prepayment, src_img, status)
    VALUES (win_number, id_model, id_class, id_color, year_start, insurance, price_day, prepayment, photo_car, 'free');

END
$$

DELIMITER ;

--
-- Создать представление `all_cars`
--
CREATE
VIEW all_cars
AS
SELECT
  `c`.`id` AS `id`,
  `c`.`win_number` AS `win_number`,
  `c`.`year_start` AS `year_start`,
  `c`.`insurance` AS `insurance`,
  `c`.`price_day` AS `price_day`,
  `c`.`prepayment` AS `prepayment`,
  `c`.`src_img` AS `src_img`,
  `m`.`title` AS `model`,
  `m`.`engine_power` AS `engine_power`,
  `m`.`engine_volume` AS `engine_volume`,
  `m`.`fuel_consumption` AS `fuel_consumption`,
  `m`.`count_places` AS `count_places`,
  `b`.`title` AS `brand`,
  `c1`.`title` AS `class`,
  `c2`.`title` AS `color`,
  `c`.`status` AS `status`
FROM ((((`cars` `c`
  JOIN `model` `m`
    ON ((`c`.`id_model` = `m`.`id`)))
  JOIN `brand` `b`
    ON ((`m`.`id_brand` = `b`.`id`)))
  JOIN `class` `c1`
    ON ((`c`.`id_class` = `c1`.`id`)))
  JOIN `color` `c2`
    ON ((`c`.`id_color` = `c2`.`id`)));

DELIMITER $$

--
-- Создать процедуру `info_all_cars`
--
CREATE PROCEDURE info_all_cars ()
BEGIN
  SELECT
    *
  FROM all_cars;
END
$$

DELIMITER ;

--
-- Создать таблицу `stock`
--
CREATE TABLE stock (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  discount double NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 4,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `title` для объекта типа таблица `stock`
--
ALTER TABLE stock
ADD UNIQUE INDEX title (title);

--
-- Создать таблицу `payment`
--
CREATE TABLE payment (
  id int(11) NOT NULL AUTO_INCREMENT,
  type_pay varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 3,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `type_pay` для объекта типа таблица `payment`
--
ALTER TABLE payment
ADD UNIQUE INDEX type_pay (type_pay);

--
-- Создать таблицу `user`
--
CREATE TABLE user (
  id int(11) NOT NULL AUTO_INCREMENT,
  passport varchar(10) NOT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  patronymic varchar(255) DEFAULT NULL,
  driver_license varchar(255) NOT NULL,
  date_birth date NOT NULL,
  email varchar(255) NOT NULL,
  tel varchar(11) NOT NULL,
  status varchar(255) NOT NULL,
  time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 20,
AVG_ROW_LENGTH = 1489,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `email` для объекта типа таблица `user`
--
ALTER TABLE user
ADD UNIQUE INDEX email (email);

--
-- Создать индекс `passport` для объекта типа таблица `user`
--
ALTER TABLE user
ADD UNIQUE INDEX passport (passport);

--
-- Создать таблицу `drivers`
--
CREATE TABLE drivers (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_employees int(11) NOT NULL,
  experience varchar(255) NOT NULL,
  price_day double NOT NULL,
  status_dr varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 3,
AVG_ROW_LENGTH = 5461,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `id_employees` для объекта типа таблица `drivers`
--
ALTER TABLE drivers
ADD UNIQUE INDEX id_employees (id_employees);

--
-- Создать внешний ключ
--
ALTER TABLE drivers
ADD CONSTRAINT FK_drivers_user_id FOREIGN KEY (id_employees)
REFERENCES user (id) ON DELETE NO ACTION ON UPDATE CASCADE;

DELIMITER $$

--
-- Создать процедуру `edit_driver`
--
CREATE PROCEDURE edit_driver (IN id_dr int(11), IN passport varchar(10), IN first_name varchar(255), IN last_name varchar(255), IN patronymic varchar(255),
IN driver_license varchar(255), IN date_birth date, IN email varchar(255), IN tel varchar(11), IN statuss varchar(255), IN password varchar(255),
IN experience varchar(255), IN price_day double)
BEGIN
  DECLARE id_u int;

  SELECT
    d.id_employees INTO id_u
  FROM drivers d
  WHERE d.id = id_dr;

  UPDATE user u
  SET u.passport = passport,
      u.first_name = first_name,
      u.last_name = last_name,
      u.patronymic = patronymic,
      u.driver_license = driver_license,
      u.date_birth = date_birth,
      u.email = email,
      u.tel = tel,
      u.status = statuss
  WHERE u.id = id_u;

  UPDATE drivers d
  SET d.experience = experience,
      d.price_day = price_day
  WHERE d.id = id_dr;

END
$$

DELIMITER ;

--
-- Создать таблицу `contract`
--
CREATE TABLE contract (
  id int(11) NOT NULL AUTO_INCREMENT,
  num_contract varchar(25) NOT NULL,
  passport_cl varchar(10) NOT NULL,
  win_number varchar(17) NOT NULL,
  date_start date NOT NULL,
  id_stock int(11) NOT NULL,
  id_payment int(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 69,
AVG_ROW_LENGTH = 2048,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `num_contract` для объекта типа таблица `contract`
--
ALTER TABLE contract
ADD UNIQUE INDEX num_contract (num_contract);

--
-- Создать внешний ключ
--
ALTER TABLE contract
ADD CONSTRAINT FK_contract FOREIGN KEY (id_stock)
REFERENCES stock (id) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE contract
ADD CONSTRAINT FK_contract_cars_win_number FOREIGN KEY (win_number)
REFERENCES cars (win_number) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE contract
ADD CONSTRAINT FK_contract_customer_passport FOREIGN KEY (passport_cl)
REFERENCES user (passport) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE contract
ADD CONSTRAINT FK_contract_payment_id FOREIGN KEY (id_payment)
REFERENCES payment (id) ON DELETE NO ACTION ON UPDATE CASCADE;

DELIMITER $$

--
-- Создать процедуру `delete_car`
--
CREATE PROCEDURE delete_car (id_car int(11))
BEGIN
  DECLARE id_modell int;
  DECLARE id_contract int;
  DECLARE win_num varchar(17);

  SELECT
    id_model INTO id_modell
  FROM cars c
  WHERE c.id = id_car;
  SELECT
    win_number INTO win_num
  FROM cars c
  WHERE c.id = id_car;

  DELETE
    FROM cars
  WHERE id = id_car
    AND NOT EXISTS (SELECT
        1
      FROM contract c1
      WHERE c1.win_number = win_num);

  UPDATE cars c
  SET c.status = "delete"
  WHERE id = id_car
  AND EXISTS (SELECT
      1
    FROM contract c1
    WHERE c1.win_number = win_num);

  DELETE
    FROM model
  WHERE id = id_modell
    AND NOT EXISTS (SELECT
        1
      FROM contract c1
      WHERE c1.win_number = win_num);

END
$$

DELIMITER ;

--
-- Создать таблицу `rent`
--
CREATE TABLE rent (
  id int(11) NOT NULL AUTO_INCREMENT,
  num_contract varchar(25) NOT NULL,
  date_start date NOT NULL,
  date_end date NOT NULL,
  id_driver int(11) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 63,
AVG_ROW_LENGTH = 2340,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `num_contract` для объекта типа таблица `rent`
--
ALTER TABLE rent
ADD UNIQUE INDEX num_contract (num_contract);

--
-- Создать внешний ключ
--
ALTER TABLE rent
ADD CONSTRAINT FK_rent_contract_num_contract FOREIGN KEY (num_contract)
REFERENCES contract (num_contract) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE rent
ADD CONSTRAINT FK_rent_drivers_id FOREIGN KEY (id_driver)
REFERENCES drivers (id) ON DELETE NO ACTION ON UPDATE CASCADE;

DELIMITER $$

--
-- Создать процедуру `add_rent`
--
CREATE PROCEDURE add_rent (num_contractt varchar(25), date_start date, date_end date, id_dr int(11))
BEGIN
  INSERT rent (num_contract, date_start, date_end, id_driver)
    SELECT
      num_contractt,
      date_start,
      date_end,
      id_dr
    FROM dual;


END
$$

DELIMITER ;

--
-- Создать представление `all_rent`
--
CREATE
VIEW all_rent
AS
SELECT
  `c`.`num_contract` AS `num_contract`,
  `c`.`passport_cl` AS `passport_cl`,
  `c`.`win_number` AS `win_number`,
  `c`.`date_start` AS `data_contract`,
  `r`.`date_start` AS `date_start`,
  `r`.`date_end` AS `date_end`,
  `r`.`id_driver` AS `id_driver`,
  `c1`.`id` AS `id_car`,
  `p`.`type_pay` AS `type_pay`,
  `s`.`title` AS `title_stock`,
  `s`.`discount` AS `discount`,
  `m`.`title` AS `model`,
  `u`.`first_name` AS `first_name`,
  `u`.`last_name` AS `last_name`,
  `u`.`patronymic` AS `patronymic`,
  `u`.`email` AS `email`
FROM ((((((`contract` `c`
  JOIN `rent` `r`
    ON ((`r`.`num_contract` = `c`.`num_contract`)))
  JOIN `cars` `c1`
    ON ((`c`.`win_number` = `c1`.`win_number`)))
  JOIN `payment` `p`
    ON ((`c`.`id_payment` = `p`.`id`)))
  JOIN `stock` `s`
    ON ((`c`.`id_stock` = `s`.`id`)))
  JOIN `model` `m`
    ON ((`c1`.`id_model` = `m`.`id`)))
  JOIN `user` `u`
    ON ((`c`.`passport_cl` = `u`.`passport`)));

DELIMITER $$

--
-- Создать функцию `is_free_drivers`
--
CREATE FUNCTION is_free_drivers (id_dr int(11), date_start date, date_end date)
RETURNS int(11)
BEGIN
  DECLARE res int;

  SELECT
    COUNT(*) INTO res
  FROM all_rent ar
  WHERE (ar.id_driver = id_dr
  AND ((date_start >= ar.date_start
  AND date_start <= ar.date_end)
  OR (date_end >= ar.date_start
  AND date_end <= ar.date_end)
  OR (ar.date_start >= date_start
  AND ar.date_start <= date_end)
  OR (ar.date_end >= date_start
  AND ar.date_end <= date_end)));

  RETURN res;
END
$$

--
-- Создать функцию `is_free_car`
--
CREATE FUNCTION is_free_car (id_c int(11), date_start date, date_end date)
RETURNS int(11)
BEGIN
  DECLARE res int;

  SELECT
    COUNT(*) INTO res
  FROM all_rent ar
  WHERE (ar.id_car = id_c
  AND ((date_start >= ar.date_start
  AND date_start <= ar.date_end)
  OR (date_end >= ar.date_start
  AND date_end <= ar.date_end)
  OR (ar.date_start >= date_start
  AND ar.date_start <= date_end)
  OR (ar.date_end >= date_start
  AND ar.date_end <= date_end)));

  RETURN res;
END
$$

DELIMITER ;

--
-- Создать таблицу `black_list`
--
CREATE TABLE black_list (
  id int(11) NOT NULL AUTO_INCREMENT,
  passport varchar(10) NOT NULL,
  cause varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 2,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `passport` для объекта типа таблица `black_list`
--
ALTER TABLE black_list
ADD UNIQUE INDEX passport (passport);

--
-- Создать внешний ключ
--
ALTER TABLE black_list
ADD CONSTRAINT FK_black_list_customer_passport FOREIGN KEY (passport)
REFERENCES user (passport) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Создать представление `all_black`
--
CREATE
VIEW all_black
AS
SELECT
  `u`.`id` AS `id`,
  `u`.`passport` AS `passport`,
  `bl`.`cause` AS `cause`,
  `u`.`email` AS `email`
FROM (`user` `u`
  JOIN `black_list` `bl`
    ON ((`u`.`passport` = `bl`.`passport`)));

--
-- Создать таблицу `authorization`
--
CREATE TABLE authorization (
  id int(11) NOT NULL AUTO_INCREMENT,
  login varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  status varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 19,
AVG_ROW_LENGTH = 5461,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `login` для объекта типа таблица `authorization`
--
ALTER TABLE authorization
ADD UNIQUE INDEX login (login);

--
-- Создать внешний ключ
--
ALTER TABLE authorization
ADD CONSTRAINT FK_authorization_user_email FOREIGN KEY (login)
REFERENCES user (email) ON DELETE NO ACTION ON UPDATE CASCADE;

DELIMITER $$

--
-- Создать процедуру `delete_driver`
--
CREATE PROCEDURE delete_driver (IN id_dr int(11))
BEGIN
  DECLARE id_u int;
  DECLARE id_aut int;

  SELECT
    d.id_employees INTO id_u
  FROM drivers d
  WHERE d.id = id_dr;
  SELECT
    a.id INTO id_aut
  FROM authorization a
    JOIN user u
      ON a.login = u.email
  WHERE u.id = id_u;

  UPDATE user u
  SET u.status = 'user'
  WHERE u.id = id_u;
  UPDATE authorization a
  SET a.status = 'user'
  WHERE a.id = id_aut;

  DELETE
    FROM drivers
  WHERE id = id_dr
    AND NOT EXISTS (SELECT
        1
      FROM rent r
      WHERE r.id_driver = id_dr);

  UPDATE drivers d
  SET d.status_dr = 'delete'
  WHERE d.id = id_dr
  AND EXISTS (SELECT
      1
    FROM rent r
    WHERE r.id_driver = id_dr);

END
$$

--
-- Создать процедуру `add_user`
--
CREATE PROCEDURE add_user (IN passport varchar(10), first_name varchar(255), last_name varchar(255), patronymic varchar(255),
driver_license varchar(255), date_birth date, email varchar(255), tel varchar(11), status varchar(255), password varchar(255))
BEGIN

  INSERT INTO user (first_name, last_name, patronymic, date_birth, driver_license, email, tel, passport, status, time)
    VALUES (first_name, last_name, patronymic, date_birth, driver_license, email, tel, passport, status, NOW());

  INSERT INTO authorization (login, password, status)
    VALUES (email, password, status);

END
$$

--
-- Создать процедуру `add_driver`
--
CREATE PROCEDURE add_driver (IN passport varchar(10), IN first_name varchar(255), IN last_name varchar(255), IN patronymic varchar(255), IN driver_license varchar(255), IN date_birth date, IN email varchar(255), IN tel varchar(11), IN status varchar(255), IN password varchar(255), IN experience varchar(255), IN price_day double)
BEGIN
  DECLARE id_u int;

  INSERT INTO user (passport, first_name, last_name, patronymic, driver_license, date_birth, email, tel, status, time)
    VALUES (passport, first_name, last_name, patronymic, driver_license, date_birth, email, tel, status, NOW());

  INSERT INTO authorization (login, password, status)
    VALUES (email, password, status);

  SELECT
    u.id INTO id_u
  FROM user u
  WHERE u.email = email;

  INSERT INTO drivers (id_employees, experience, price_day, status_dr)
    VALUES (id_u, experience, price_day, 'free');

END
$$

DELIMITER ;

--
-- Создать представление `all_users`
--
CREATE
VIEW all_users
AS
SELECT
  `u`.`id` AS `id`,
  `u`.`passport` AS `passport`,
  `u`.`first_name` AS `first_name`,
  `u`.`last_name` AS `last_name`,
  `u`.`patronymic` AS `patronymic`,
  `u`.`driver_license` AS `driver_license`,
  `u`.`date_birth` AS `date_birth`,
  `u`.`email` AS `email`,
  `u`.`tel` AS `tel`,
  `u`.`status` AS `status`,
  `a`.`password` AS `password`
FROM (`user` `u`
  JOIN `authorization` `a`
    ON ((`u`.`email` = `a`.`login`)));

DELIMITER $$

--
-- Создать функцию `is_password`
--
CREATE FUNCTION is_password (passwordd varchar(255))
RETURNS int(11)
BEGIN
  DECLARE result int;
  SELECT
    COUNT(*) INTO result
  FROM all_users u
  WHERE u.password LIKE passwordd;
  RETURN result;
END
$$

--
-- Создать функцию `is_login`
--
CREATE FUNCTION is_login (login varchar(255))
RETURNS int(11)
BEGIN
  DECLARE result int;
  SELECT
    COUNT(*) INTO result
  FROM all_users u
  WHERE u.email LIKE login;
  RETURN result;
END
$$

--
-- Создать процедуру `add_contract`
--
CREATE PROCEDURE add_contract (id_car int(11), num_contractt varchar(25), id_cl int(11), payment varchar(255))
BEGIN
  DECLARE w_number varchar(17);
  DECLARE passport_cl varchar(10);
  DECLARE id_stock int(11);
  DECLARE id_pay int(11);

  SELECT
    ac.win_number INTO w_number
  FROM all_cars ac
  WHERE ac.id = id_car;
  SELECT
    au.passport INTO passport_cl
  FROM all_users au
  WHERE au.id = id_cl;

  SELECT
    CASE WHEN (SELECT
            COUNT(*)
          FROM all_rent ar
          WHERE ar.passport_cl = passport_cl) >= 10 THEN (SELECT
              st.id
            FROM stock st
            WHERE st.title = 'Постоянный клиент') WHEN (SELECT
            DATE_FORMAT(au.date_birth, '%m-%d')
          FROM all_users au
          WHERE au.passport = passport_cl) = DATE_FORMAT(CURDATE(), '%m-%d') THEN (SELECT
              st.id
            FROM stock st
            WHERE st.title = 'Скидка в День Рождения') WHEN ((SELECT
            COUNT(*)
          FROM all_rent ar
          WHERE ar.passport_cl = passport_cl) >= 10 AND
        (SELECT
            DATE_FORMAT(au.date_birth, '%m-%d')
          FROM all_users au
          WHERE au.passport = passport_cl) = DATE_FORMAT(CURDATE(), '%m-%d')) THEN (SELECT
              st.id
            FROM stock st
            WHERE st.title = 'Постоянный клиент') ELSE (SELECT
            st.id
          FROM stock st
          WHERE st.title = 'нет') END INTO id_stock
  FROM dual;

  SELECT
    p.id INTO id_pay
  FROM payment p
  WHERE p.type_pay LIKE payment;

  INSERT contract (num_contract, passport_cl, win_number, date_start, id_stock, id_payment)
    VALUES (num_contractt, passport_cl, w_number, CURDATE(), id_stock, id_pay);

END
$$

DELIMITER ;

--
-- Создать представление `all_drivers`
--
CREATE
VIEW all_drivers
AS
SELECT
  `d`.`id` AS `id`,
  `u`.`passport` AS `passport`,
  `u`.`first_name` AS `first_name`,
  `u`.`last_name` AS `last_name`,
  `u`.`patronymic` AS `patronymic`,
  `u`.`driver_license` AS `driver_license`,
  `u`.`date_birth` AS `date_birth`,
  `u`.`email` AS `email`,
  `u`.`tel` AS `tel`,
  `d`.`experience` AS `experience`,
  `d`.`price_day` AS `price_day`,
  `a`.`password` AS `password`,
  `u`.`status` AS `status`,
  `d`.`status_dr` AS `status_dr`
FROM ((`user` `u`
  JOIN `drivers` `d`
    ON ((`u`.`id` = `d`.`id_employees`)))
  JOIN `authorization` `a`
    ON ((`a`.`login` LIKE `u`.`email`)));

--
-- Создать таблицу `services`
--
CREATE TABLE services (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  price_services double NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 7,
AVG_ROW_LENGTH = 4096,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `title` для объекта типа таблица `services`
--
ALTER TABLE services
ADD UNIQUE INDEX title (title);

--
-- Создать таблицу `list_services`
--
CREATE TABLE list_services (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_services int(11) NOT NULL,
  id_contract int(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 41,
AVG_ROW_LENGTH = 1820,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать внешний ключ
--
ALTER TABLE list_services
ADD CONSTRAINT FK_list_services_contract_id FOREIGN KEY (id_contract)
REFERENCES contract (id) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE list_services
ADD CONSTRAINT FK_list_services_services_id FOREIGN KEY (id_services)
REFERENCES services (id) ON DELETE NO ACTION ON UPDATE CASCADE;

DELIMITER $$

--
-- Создать функцию `summa`
--
CREATE FUNCTION summa (num_contractt varchar(25))
RETURNS int(11)
BEGIN
  DECLARE res double;

  DECLARE id_car int(11);
  DECLARE price_car double;
  DECLARE prepayment_car double;
  DECLARE start date;
  DECLARE end date;
  DECLARE discount double;
  DECLARE stock double;
  DECLARE prise_serv double;
  DECLARE prise_dr double;
  DECLARE col_day double;

  SELECT
    ar.id_car INTO id_car
  FROM all_rent ar
  WHERE ar.num_contract = num_contractt;
  SELECT
    ac.price_day INTO price_car
  FROM all_cars ac
  WHERE ac.id = id_car;
  SELECT
    ac.prepayment INTO prepayment_car
  FROM all_cars ac
  WHERE ac.id = id_car;
  SELECT
    ar.date_start INTO start
  FROM all_rent ar
  WHERE ar.num_contract = num_contractt;
  SELECT
    ar.date_end INTO end
  FROM all_rent ar
  WHERE ar.num_contract = num_contractt;

  SELECT
    CASE WHEN (SELECT
            1
          FROM dual
          WHERE WEEKDAY(start) IN (4, 5, 6)
          AND WEEKDAY(end) IN (5, 6, 0)
          AND TIMESTAMPDIFF(DAY, start, end) <= 3) = 1 THEN 115 WHEN TIMESTAMPDIFF(DAY, start, end) IN (1, 2) THEN 100 WHEN TIMESTAMPDIFF(DAY, start, end) IN (3, 4, 5, 6) THEN 90 WHEN TIMESTAMPDIFF(DAY, start, end) IN (7, 8, 9, 10, 11, 12, 13, 14) THEN 80 WHEN TIMESTAMPDIFF(DAY, start, end) >= 15 AND
        TIMESTAMPDIFF(DAY, start, end) <= 30 THEN 70 ELSE 60 END INTO discount;

  SELECT
    100 - ar.discount INTO stock
  FROM all_rent ar
  WHERE ar.num_contract = num_contractt;

  SELECT
    CASE WHEN SUM(s.price_services) IS NULL THEN 0 ELSE SUM(s.price_services) END INTO prise_serv
  FROM list_services ls
    JOIN contract c
      ON ls.id_contract = c.id
    JOIN services s
      ON ls.id_services = s.id
  WHERE c.num_contract = num_contractt;

  SELECT
    CASE WHEN r.id_driver IS NOT NULL THEN (SELECT
              d.price_day
            FROM drivers d
            WHERE d.id = r.id_driver) ELSE 0 END INTO prise_dr
  FROM rent r
  WHERE r.num_contract = num_contractt;

  SELECT
    TIMESTAMPDIFF(DAY, start, end) INTO col_day
  FROM dual;

  SET res = ((price_car * discount * col_day) / 100 + prise_serv + (prise_dr * col_day)) * stock / 100 + prepayment_car;

  RETURN res;
END
$$

--
-- Создать процедуру `delete_rent`
--
CREATE PROCEDURE delete_rent (IN num_contractt varchar(25))
BEGIN
  DECLARE id_cont int;

  SELECT
    c.id INTO id_cont
  FROM contract c
  WHERE c.num_contract = num_contractt;

  DELETE
    FROM rent
  WHERE num_contract = num_contractt;
  DELETE
    FROM list_services
  WHERE id_contract = id_cont;
  DELETE
    FROM contract
  WHERE num_contract = num_contractt;


END
$$

--
-- Создать процедуру `add_services`
--
CREATE PROCEDURE add_services (IN num_contractt varchar(25), IN title_serv varchar(255))
BEGIN
  DECLARE id_serv int(11);
  DECLARE id_cont int(11);

  SELECT
    s.id INTO id_serv
  FROM services s
  WHERE s.title LIKE title_serv;
  SELECT
    c.id INTO id_cont
  FROM contract c
  WHERE c.num_contract = num_contractt;

  INSERT list_services (id_services, id_contract)
    VALUES (id_serv, id_cont);

END
$$

DELIMITER ;

--
-- Создать таблицу `visits`
--
CREATE TABLE visits (
  id int(11) NOT NULL AUTO_INCREMENT,
  date date NOT NULL,
  hosts double NOT NULL,
  views double NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 4,
AVG_ROW_LENGTH = 16384,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать таблицу `ips`
--
CREATE TABLE ips (
  id int(11) NOT NULL AUTO_INCREMENT,
  ip_address varchar(50) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 6,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

DELIMITER $$

--
-- Создать функцию `user_year`
--
CREATE FUNCTION user_year (a date)
RETURNS int(11)
BEGIN
  DECLARE result int;
  SET result = TIMESTAMPDIFF(year, DATE_FORMAT(a, '%Y-%m-%d'), CURDATE());
  RETURN result;
END
$$

DELIMITER ;

-- 
-- Вывод данных для таблицы brand
--
INSERT INTO brand VALUES
(1, 'Audi'),
(2, 'BMW'),
(15, 'Ferrari'),
(9, 'Ford'),
(31, 'Kaa'),
(16, 'Kia'),
(8, 'Lada'),
(3, 'Mercedes'),
(18, 'MITSUBISHI'),
(4, 'Nissan'),
(7, 'Renault'),
(6, 'Skoda'),
(5, 'Toyota'),
(30, 'tun'),
(17, 'Volkswagen');

-- 
-- Вывод данных для таблицы model
--
INSERT INTO model VALUES
(1, 'Volkswagen Polo', 17, '110 л.с.', '1.6', '7.0', '5'),
(2, 'Skoda Rapid', 6, '110 л.с.', '1.6', '7.0', '5'),
(3, 'Renault Arkana', 7, '144 л.с.', '2.0', '7.7', '5'),
(4, 'Audi A3 NEW', 1, '150 л.с.', '1.4', '4,8', '5'),
(5, 'Nissan Qashqai', 4, '144 л.с.', '2.0', '9.0', '5'),
(6, 'Toyota Camry V55', 5, '150 л.с.', '2.0', '8.5', '5'),
(7, 'Lada Vesta', 8, '106 л.с.', '1.6', '6.9', '5'),
(8, 'Mercedes E-class', 3, '197 л.с.', '2.0', '7.2', '5'),
(9, 'BMW 5-er', 2, '249 л.с.', '2.0', '6.7', '5'),
(10, 'Kia Rio III', 16, '107 л.с.', '1.4', '5.9', '5'),
(11, 'Volkswagen Jetta', 17, '105 л.с.', '1.6', '12.4', '5'),
(12, 'Ferrari California', 15, '560 л.с.', '3.9', '13.1', '4'),
(13, 'MITSUBISHI ASX', 18, '117 л.с.', '1.6', '5,0', '5'),
(14, 'KIA SPORTAGE', 16, '150 л.с.', '2.0', '7.9', '5'),
(15, 'LADA VESTA CROSS', 8, '106 л.с.', '1.6', '7.7', '5'),
(16, 'RENAULT LOGAN', 7, '82 л.с.', '1,6', '7,1', '5'),
(17, 'NISSAN TERRANO', 4, '114 л.с.', '1.6', '6.3', '5'),
(18, 'VOLKSWAGEN PASSAT', 17, '150 л.с.', '1.4', '6.5', '5'),
(19, 'Ford Tourneo Custom', 9, '125 л.с.', '2.2', '8.1', '9'),
(20, 'Mercedes-Benz', 3, '190 л.с. ', '2.1', '7.8', '9'),
(42, 'renu', 2, '102', '22', '154', '5');

-- 
-- Вывод данных для таблицы color
--
INSERT INTO color VALUES
(3, 'Белый'),
(1, 'Белый металлик '),
(25, 'голубой'),
(11, 'Золотисто-коричневый '),
(8, 'Серебристо-серо-графитовый'),
(2, 'Серебристо-чёрный'),
(9, 'Серебристо-ярко-синий'),
(5, 'Серый серебристый'),
(7, 'Синий'),
(12, 'Темно-синий'),
(6, 'Чёрный, двойная эмаль'),
(10, 'Ярко-жёлтый'),
(4, 'Ярко-красный');

-- 
-- Вывод данных для таблицы class
--
INSERT INTO class VALUES
(3, 'Бизнес'),
(5, 'Внедорожники'),
(2, 'Комфорт'),
(4, 'Микроавтобус'),
(1, 'Эконом');

-- 
-- Вывод данных для таблицы user
--
INSERT INTO user VALUES
(1, '4548963123', 'Вероника', 'Важенина', 'Сергеевна', '9036456215', '1990-05-11', 'NikaVa@mail.ru', '89130481677', 'user', '2022-04-19 21:39:54'),
(2, '8956452369', 'Дмитрий', 'Хрумков', 'Эдуардович', '1052458978', '1993-10-22', 'DimaXrum@yandex.ru', '89125631845', 'user', '2022-03-13 21:39:54'),
(6, '8965413588', 'Татьяна', 'Харлова', 'Ивановна', '7894896546', '1998-05-08', 'TataXarl@mail.ru', '89154789638', 'user', '2022-05-10 21:39:54'),
(9, '8889455788', 'Владимир', 'Смирнов', 'Петрович', '7000450012', '1985-05-15', 'smirnov7@mail.ru', '89120554878', 'user', '2021-05-13 21:39:54'),
(10, '7712500123', 'Анастасия', 'Смит', 'Александровна', '7800560041', '1993-09-20', 'AnSmit93@yandex.ru', '89190551860', 'admin', '2021-06-13 21:39:54'),
(11, '2200115478', 'Сергей', 'Усов', 'Анатольевич', '0000123345', '1984-08-24', 'ser2409@gmail.com', '89195631218', 'driver', '2022-01-05 21:39:54'),
(12, '7896541236', 'Иван', 'Третьеков', 'Александрович', '7899665554', '1987-04-28', 'tret_78@mail.ru', '89126154878', 'user', '2022-02-14 21:39:54'),
(13, '4563211456', 'Иван', 'Воронин', 'Сергеевич', '1125478965', '1987-08-29', 'IvanV78@yandex.ru', '89120547819', 'driver', '2021-09-13 21:39:54'),
(14, '4555221147', 'Анатолий', 'Иванов', 'Анатольевич', '2223564187', '1987-06-11', 'AnIvanov@.email.ru', '89124567813', 'driver', '2021-12-25 21:39:54'),
(17, '7854123695', 'Игорь', 'Важенин', 'Николаевич', '1112223655', '1975-08-08', 'VaI080875@mail.ru', '89125896313', 'user', '2022-03-18 21:39:54'),
(18, '1122113311', 'Петр', 'Крылов', 'Иванович', '4554547896', '1980-05-19', 'krPetr@mail.ru', '89120474778', 'user', '2022-03-08 21:39:54'),
(19, '7777888542', 'Сергей', 'Тыктык', 'Николаевич', '1111222233', '1987-05-16', 'ts1987@yandex.ru', '89456874778', 'user', '2022-05-07 21:49:27');

-- 
-- Вывод данных для таблицы stock
--
INSERT INTO stock VALUES
(1, 'Скидка в День Рождения', 10),
(2, 'Постоянный клиент', 15),
(3, 'нет', 0);

-- 
-- Вывод данных для таблицы payment
--
INSERT INTO payment VALUES
(2, 'Безналичные'),
(1, 'Наличные');

-- 
-- Вывод данных для таблицы cars
--
INSERT INTO cars VALUES
(1, 'WVWZZZ3BZ4E037957', 1, 1, 3, '2020', 1, 2600, 5000, 'volkswagen-polo-sedan.png', 'free'),
(2, '5TFUM5F18AX024476', 11, 1, 2, '2018', 1, 2300, 5000, 'car2.jpg', 'free'),
(3, 'JH4KB16546C069808', 2, 1, 1, '2020', 0, 2600, 4500, 'shkoda-rapid-2020-300x195.jpg', 'free'),
(4, '5XXGM4A71FG438801', 3, 1, 4, '2020', 1, 3200, 5000, 'car3.png', 'free'),
(5, '2G4WB55K921276269', 4, 2, 5, '2018', 1, 3500, 4500, 'car4.jpg', 'free'),
(6, 'JHMGE8H33DC054134', 5, 5, 5, '2020', 1, 4200, 5000, 'car1-0-2-1.png', 'free'),
(7, 'JF2SHABC0BH704879', 6, 1, 6, '2018', 1, 4910, 8000, 'car5.png', 'free'),
(8, '3GNAL3EKXES594367', 7, 1, 7, '2017', 0, 2000, 4500, 'vesta-sw-000-1024x548.jpg', 'free'),
(9, 'KM8SC13EX4U692436', 8, 3, 8, '2018', 1, 8000, 10000, '6ea390261f29e8c3bde8e7a2b0ba8d6e.png', 'free'),
(10, '2C4RC1BG3CR106872', 9, 3, 9, '2018', 1, 8900, 10000, 'car9.webp', 'free'),
(11, '5XXGM4A79CG045768', 10, 2, 3, '2017', 1, 4100, 5000, 'kia-rio-iii.png', 'free'),
(12, 'JTHBA30G345061208', 12, 3, 10, '2014', 1, 15000, 30000, 'car10.webp', 'free'),
(13, '1N4BA41EX5C882832', 13, 5, 6, '2020', 1, 14300, 25000, '7ec1176544f49a836424bb641e773428-base.png.webp', 'free'),
(14, '2GCEK13M371542986', 14, 5, 9, '2021', 1, 17000, 30000, 'car11.webp', 'free'),
(15, '1FMYU03142KA62077', 15, 2, 5, '2019', 1, 4900, 7000, '7b20dd56fb67b1643975e110c9918847-base.png.webp', 'free'),
(16, '1GCEC14W91Z262842', 16, 2, 11, '2018', 1, 4500, 7000, '0fdc9b4ee4dbcd3f687d8b102895ec73-base.png.webp', 'free'),
(17, '1FAFP56S1YA131820', 17, 5, 3, '2017', 1, 8900, 15000, '907572c69c336645fcc25736fd7c3e98-base.png.webp', 'free'),
(18, '1HGCT1B7XEA099577', 18, 2, 12, '2020', 1, 6800, 9000, 'b694fefbfca9546e6e91043e016c5618-base.png', 'free'),
(19, 'KNAGM4A70D5303064', 19, 4, 11, '2021', 1, 20500, 35000, 'tourneo-custom.jpg', 'free'),
(20, '2HGFA16579H354298', 20, 4, 12, '2017', 1, 27300, 35000, 'car12.webp', 'free'),
(29, '2GCEC19T111211195', 42, 1, 25, '2015', 1, 4910, 5000, '', 'delete');

-- 
-- Вывод данных для таблицы drivers
--
INSERT INTO drivers VALUES
(1, 11, '13', 1400, 'free'),
(2, 13, '7', 3000, 'free');

-- 
-- Вывод данных для таблицы services
--
INSERT INTO services VALUES
(1, 'Детское кресло', 500),
(3, 'Животные', 1000),
(4, 'Навигатор', 300),
(5, 'Свадьба', 5000),
(6, 'Водитель', 800);

-- 
-- Вывод данных для таблицы contract
--
INSERT INTO contract VALUES
(7, '778852', '7854123695', 'JH4KB16546C069808', '2022-06-15', 3, 2),
(8, '789456', '4548963123', 'WVWZZZ3BZ4E037957', '2022-06-01', 3, 1),
(9, '487892', '7712500123', 'WVWZZZ3BZ4E037957', '2022-05-11', 3, 2),
(62, '506220', '4548963123', 'WVWZZZ3BZ4E037957', '2022-05-12', 3, 2),
(63, '648481', '4548963123', 'KM8SC13EX4U692436', '2022-05-12', 3, 2),
(64, '158753', '4548963123', 'KM8SC13EX4U692436', '2022-05-12', 3, 1),
(67, '684340', '4548963123', 'WVWZZZ3BZ4E037957', '2022-05-12', 3, 2),
(68, '173874', '4548963123', '1FAFP56S1YA131820', '2022-05-12', 3, 2);

-- 
-- Вывод данных для таблицы visits
--
INSERT INTO visits VALUES
(2, '2022-05-13', 3, 23),
(3, '2022-05-14', 1, 19);

-- 
-- Вывод данных для таблицы rent
--
INSERT INTO rent VALUES
(3, '778852', '2022-05-25', '2022-06-02', 1),
(4, '789456', '2022-06-09', '2022-06-11', NULL),
(5, '487892', '2022-06-01', '2022-06-05', 2),
(56, '506220', '2022-05-27', '2022-05-28', NULL),
(57, '648481', '2022-05-28', '2022-05-31', 1),
(58, '158753', '2022-05-17', '2022-05-22', 2),
(61, '684340', '2022-06-27', '2022-06-30', NULL),
(62, '173874', '2022-06-16', '2022-06-23', NULL);

-- 
-- Вывод данных для таблицы list_services
--
INSERT INTO list_services VALUES
(7, 1, 9),
(8, 6, 9),
(9, 6, 7),
(31, 3, 63),
(32, 4, 63),
(33, 6, 63),
(34, 3, 64),
(35, 4, 64),
(36, 6, 64),
(40, 5, 68);

-- 
-- Вывод данных для таблицы ips
--
INSERT INTO ips VALUES
(5, '::1');

-- 
-- Вывод данных для таблицы black_list
--
INSERT INTO black_list VALUES
(1, '8956452369', 'авария');

-- 
-- Вывод данных для таблицы authorization
--
INSERT INTO authorization VALUES
(7, 'NikaVa@mail.ru', 'niva171718', 'user'),
(8, 'DimaXrum@yandex.ru', 'xrum151548', 'user'),
(9, 'TataXarl@mail.ru', 'tata452316', 'user'),
(10, 'smirnov7@mail.ru', 'smirno7879', 'user'),
(11, 'AnSmit93@yandex.ru', 'An939358', 'admin'),
(12, 'ser2409@gmail.com', 'ser898556', 'user'),
(13, 'tret_78@mail.ru', 'TI123456789', 'user'),
(14, 'IvanV78@yandex.ru', 'Iv123456789', 'user'),
(16, 'VaI080875@mail.ru', 'VaI123456', 'user'),
(17, 'krPetr@mail.ru', 'KP19801905', 'user'),
(18, 'ts1987@yandex.ru', 'ts16051987', 'user');

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;