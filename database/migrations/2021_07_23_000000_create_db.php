<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "

CREATE TABLE IF NOT EXISTS `discount` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hotel_id` int NOT NULL,
  `percent` float NOT NULL,
  `value` float NOT NULL,
  `min_days` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `min_days` (`min_days`),
  KEY `hotel_id_2` (`hotel_id`,`min_days`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `discount`
--

INSERT INTO `discount` (`id`, `hotel_id`, `percent`, `value`, `min_days`) VALUES(1, 1, 5, 0, 5);
INSERT INTO `discount` (`id`, `hotel_id`, `percent`, `value`, `min_days`) VALUES(2, 1, 0, 1000, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hotel_id` int NOT NULL,
  `date_from` date NOT NULL,
  `date_till` date NOT NULL,
  `qty` int NOT NULL,
  `cost` float NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `hotel_id`, `date_from`, `date_till`, `qty`, `cost`, `updated_at`, `created_at`) VALUES(1, 1, '2021-07-23', '2021-07-31', 2, 22800, '2021-07-23 07:10:59', '2021-07-23 11:10:59');
INSERT INTO `orders` (`id`, `hotel_id`, `date_from`, `date_till`, `qty`, `cost`, `updated_at`, `created_at`) VALUES(2, 1, '2021-07-23', '2021-07-25', 2, 7000, '2021-07-23 07:11:17', '2021-07-23 11:11:17');
INSERT INTO `orders` (`id`, `hotel_id`, `date_from`, `date_till`, `qty`, `cost`, `updated_at`, `created_at`) VALUES(3, 1, '2021-07-23', '2021-07-25', 2, 7000, '2021-07-23 07:12:37', '2021-07-23 11:12:37');
INSERT INTO `orders` (`id`, `hotel_id`, `date_from`, `date_till`, `qty`, `cost`, `updated_at`, `created_at`) VALUES(4, 1, '2021-07-23', '2021-07-25', 6, 9000, '2021-07-23 07:12:43', '2021-07-23 11:12:43');

-- --------------------------------------------------------

--
-- Структура таблицы `price_base`
--

CREATE TABLE IF NOT EXISTS `price_base` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hotel_id` int NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hotel_id` (`hotel_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `price_base`
--

INSERT INTO `price_base` (`id`, `hotel_id`, `value`) VALUES(1, 1, 2000);

-- --------------------------------------------------------

--
-- Структура таблицы `price_season`
--

CREATE TABLE IF NOT EXISTS `price_season` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hotel_id` int NOT NULL,
  `date_from` date NOT NULL,
  `date_till` date NOT NULL,
  `value` float NOT NULL,
  `add_value_per_human` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `date_from` (`date_from`,`date_till`,`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `price_season`
--

INSERT INTO `price_season` (`id`, `hotel_id`, `date_from`, `date_till`, `value`, `add_value_per_human`) VALUES(1, 1, '2021-07-25', '2021-07-30', 2500, 500);
        ";


        \DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount');
        Schema::dropIfExists('orders ');
        Schema::dropIfExists('price_base');
        Schema::dropIfExists('price_season');
    }
}
