-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 20 2024 г., 09:49
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `stroitel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback_requests`
--

CREATE TABLE `feedback_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `feedback_requests`
--

INSERT INTO `feedback_requests` (`id`, `name`, `email`, `phone`, `comment`, `file_path`, `created_at`, `updated_at`) VALUES
(32, 'Артем-Оглы', 'yourihelo1971@gmail.com', '+7 (566) 549-53-42', 'авпвпавпа', 'feedback_files/pLe0r26vS4.docx', '2024-03-18 11:49:51', '2024-03-18 11:49:51');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_11_27_205903_create_users_table', 1),
(11, '2024_02_23_210510_create_partnership_requests_table', 1),
(12, '2024_02_26_182456_create_reviews_table', 1),
(13, '2024_02_29_232821_create_feedback_requests_table', 2),
(16, '2024_03_18_150026_create_products_table', 3),
(17, '2024_03_18_150033_create_product_compositions_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `partnership_requests`
--

CREATE TABLE `partnership_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `article` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `article`, `name`, `price`, `description`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 3761745607, 'Утеплитель Роквул Лайт Баттс СКАНДИК 800x600x100', '1210', 'Утеплитель RockWool Лайт Баттс СКАНДИК 800x600x100 представляет собой минеральные плиты, обладающие рядом уникальных свойств. Эти гидрофобизированные и кашированные плиты обеспечивают негорючую теплоизоляцию, защищая конструкции от воздействия влаги и сырости. Кроме того, они обладают превосходными шумопоглощающими и шумоподавляющими свойствами, создавая комфортную и тихую обстановку внутри помещений. Утеплитель обладает высокой пожароустойчивостью и высокой температурой плавления, предоставляя надежную защиту от возгорания и тепловых воздействий. Благодаря использованию каменной ваты в своем составе, утеплитель обладает долговечностью и надежностью.', 'c4fCJTpXxf8BqES1PitkPvod9rkvTvLXHPOqaMUm.jpg', '2024-03-18 15:09:50', '2024-03-18 15:09:50'),
(2, 3683625765, 'Асфальт холодный фр 5-10 (25кг)', '420', 'Холодный асфальт в мешках по 25 кг Фракция-5-10, мм Объем упаковки 0,02 м3 Расход- Яма (1м х1м х 1см (глубина)) -1 мешок (25 кг). В составе холодного асфальта -щебень и специальное битумно-минеральное вяжущее. Для лучшего обволакивания при производстве холодного асфальта используются специальные виды битума, характеризующиеся очень высокой текучестью, эластичностью и специальные адгезионные добавки. Ремонт можно производить в любую погоду при температуре от –20°С до +40°С, в том числе при наличии осадков. Сразу после укладки холодного асфальта по нему может двигаться автотранспорт.', '79zptVM1UHAUO442t2hxL9NoIqAoPeiRehE8yqf0.png', '2024-03-18 15:13:23', '2024-03-18 15:13:23'),
(3, 9213781957, 'Утеплитель Ursa GEO M-11 [2] 10000x1200x50', '2280', 'Утеплитель Ursa Geo — высококачественный материал, используемый для тепло- и звукоизоляции в частном домостроении. Урса Гео негорюч, обладает отличной упругостью и влагостойкостью.', 'noyxUuq2bjV6IskKQ1OU8K27kUgztXqiVvmbHsbc.png', '2024-03-18 15:17:54', '2024-03-18 15:17:54'),
(4, 5069408355, 'Колодец фильтрационный конический 1,5 м. с люком', '5490', 'Конические фильтрационные колодцы без дна предназначены для приема дренажных или бытовых вод. Колодец накапливает и постепенно выпускает воду в грунт через дно и перфорацию в стенках колодца. Фильтрационные колодцы применяются для доочистки вод после септика, в качестве коллекторов для сточных вод из бани или летней кухни, так же как дренажные коллекторы или накопительные колодцы. Постепенно просачивающаяся из колодца вода проходит естественную фильтрацию через грунт перед тем как попасть в грунтовые воды. Ровный верх стандартного диаметра 60 см подходит для люка-крышки, который предотвращает распространение неприятного запаха. Колодцы выпускаются различной высоты (от 1,0 до 2,5 м) и, соответственно, рабочего объема', 'vdHCOLpv9XDTVn1RcShGSf0XzHnS3HHYsNXh20HP.jpg', '2024-03-18 16:15:11', '2024-03-18 16:15:11');

-- --------------------------------------------------------

--
-- Структура таблицы `product_compositions`
--

CREATE TABLE `product_compositions` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `property_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_compositions`
--

INSERT INTO `product_compositions` (`id`, `product_id`, `property_name`, `property_value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Объекты применения', 'для балкона, для дома, для пола, для стен, мансарды, перегородки, перекрытия', '2024-03-18 15:09:50', '2024-03-18 15:09:50'),
(2, 1, 'Производитель', 'Утеплитель RockWool', '2024-03-18 15:09:50', '2024-03-18 15:09:50'),
(3, 1, 'Объем, м3', '0.28', '2024-03-18 15:09:50', '2024-03-18 15:09:50'),
(4, 2, 'Вес мешка', '25кг', '2024-03-18 15:13:23', '2024-03-18 15:13:23'),
(5, 3, 'Теплопроводность λ10', '0,045Вт/мК', '2024-03-18 15:17:54', '2024-03-18 15:17:54'),
(6, 3, 'Теплопроводность λ25', '0,044 Вт/мК', '2024-03-18 15:17:54', '2024-03-18 15:17:54'),
(7, 3, 'Теплопроводность λD', '0,041 Вт/мК', '2024-03-18 15:17:54', '2024-03-18 15:17:54'),
(8, 3, 'Горючесть', 'НГ', '2024-03-18 15:17:54', '2024-03-18 15:17:54'),
(9, 3, 'Класс пожарной опасности', 'КМ0', '2024-03-18 15:17:54', '2024-03-18 15:17:54'),
(10, 4, 'Перфорация', 'С перфорацией', '2024-03-18 16:15:11', '2024-03-18 16:15:11'),
(11, 4, 'Высота', '1500мм', '2024-03-18 16:15:11', '2024-03-18 16:15:11');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `email`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Вячеслав', 'yourihelo1971@gmail.com', 'Хороший ассортимент, цены нормальные. Оперативная работа менеджеров. Несмотря на большое количество машин на погрузку, работники склада отработали на отлично! Вежливые, учтивые работники, очень приятно. Теперь за стройматериалами, только сюда.', 5, 1, '2024-02-28 13:37:46', '2024-02-29 15:56:43'),
(7, 'Алексей', 'yourihelo1971@gmail.com', 'Нет прямых доказательств что он причастен к этому, мамонт сам мог перекинуть на другие кошельки, как увидел что его взломали, будут пруфы более убедительные пишите в лс, или обжалование в разделе жалобы', 5, 1, '2024-02-29 16:20:49', '2024-02-29 16:21:39');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('ADMIN','USER') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USER',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'alexygarnov', 'Thomas', 'yourihelo1971@gmail.com', '$2y$12$qh1uboNW/XT1fLwsh5KHgORfZmtBJy3kzB/lzdoFEWUPQTmfaP4e.', 'ADMIN', '2024-02-28 13:49:22', '2024-02-28 13:49:22');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback_requests`
--
ALTER TABLE `feedback_requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `partnership_requests`
--
ALTER TABLE `partnership_requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_article_unique` (`article`);

--
-- Индексы таблицы `product_compositions`
--
ALTER TABLE `product_compositions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_compositions_product_id_foreign` (`product_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback_requests`
--
ALTER TABLE `feedback_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `partnership_requests`
--
ALTER TABLE `partnership_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `product_compositions`
--
ALTER TABLE `product_compositions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `product_compositions`
--
ALTER TABLE `product_compositions`
  ADD CONSTRAINT `product_compositions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
