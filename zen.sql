-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2024 a las 08:46:32
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambiar_pass`
--

CREATE TABLE `cambiar_pass` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `modificado` int(11) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cambiar_pass`
--

INSERT INTO `cambiar_pass` (`id`, `email`, `token`, `modificado`, `created_at`, `updated_at`) VALUES
(1, 'miguel.a.torralba@gmail.com', 'a21d5f793253a3e4e122cada661de696c5648e1b1da7664eb1f9de5336a69803', 1, '2022', '2022-04-22 12:33'),
(2, 'miguel.a.torralba@gmail.com', '00bd2369fd0b7d2861232bad3315e7232515b22b221942cf30aca27e328f5042', 1, '2022-03-23 10:54', '2022-04-22 12:33'),
(3, 'miguel.a.torralba@gmail.com', 'd41cb0ecb5a5fc543470a45ef986bb4e694187b47e046b56d5311d051df2e217', 1, '2022-03-25 11:43', '2022-04-22 12:33'),
(4, 'miguel.a.torralba@gmail.com', 'f0bff799f612e32f37680ae481e1864efb76742a78ae4f6bf2fba9e95d892e0f', 1, '2022-04-05 13:15', '2022-04-22 12:33'),
(5, 'miguel.a.torralba@gmail.com', 'c967bd08e2d7e629111f0392cc4577b18596e88f354965ebdf60ad4844a19dd1', 1, '2022-04-05 21:51', '2022-04-22 12:33'),
(6, 'photonomad21@gmail.com', '7b96f00ee03215486a554ecec156b87d8a153089dcd1fdbb0c64a5083d1b45f9', 1, '2022-04-22 12:32', '2022-04-22 12:33'),
(7, 'pepe@pepito.es', 'f3994016ef2e43474032e95d12e006b304abd489e09e34b26344bf0de7df3a72', 0, '2022-04-28 11:38', ''),
(8, 'antonio@anto.es', '3f871b363d3a43595fbb8e47e38a2b5cbd6054d73ee75bae73f8257a89171d00', 0, '2022-04-28 12:17', ''),
(9, 'supercarnes@supercarnes.es', 'b2672f4dbdefb94c5a6977c92dbffcf558bfc57fdcbf2866c1ce01596fae1fab', 0, '2022-04-30 12:48', ''),
(10, 'hola@supercarnes.es', '50e872d5d67a7a03d55d5e66e4875ef173b8294d32382b6f41aff013be36d558', 0, '2022-04-30 12:50', ''),
(11, 'ytry@sefe.es', '937ad29838843e72365bb3169d05d1cd81bbae620d1945cec7b07e87fe0e85ce', 0, '2022-04-30 12:54', ''),
(12, 'ytrty@sefe.es', 'ed53f18bf01140e312ce8e20bf9fa27c832b1656a4ee7a49700748126d5bd51f', 0, '2022-04-30 12:55', ''),
(13, 'jyhgjyh@rsderv.ed', '69e258919a7b4f20903da836f41e916854d52ddfa8bf915b4d3b87631e312e3e', 0, '2022-04-30 12:56', ''),
(14, 'hhh@hh.es', '6f839080331d87e5e833aab7dcd46c800c9fa4ae570960cf8be1abe399e3992f', 0, '2022-04-30 12:58', ''),
(15, 'hhh@hh.esh', 'b744de3a5d0f118e8d4a1e40dcf9cc3bcd9d38e42c3c98e8bb66106ab5f3af62', 0, '2022-04-30 13:00', ''),
(16, 'test@testclientes.es', 'b74348bee6494fbe07442d5feeae9a99edf87dc4f4c0873b9291a7f15840b0a3', 0, '2022-04-30 13:06', ''),
(17, 'sdfef@seef.es', '562ded4df286604bab2b844a12cd0170bb01f0b515dd26ec828c5b69a50357cd', 0, '2022-05-10 11:47', ''),
(18, 'antonio@pito.es', '7dfd78ac794016379dd7d6baff9f59a5cc767f26b45ede47b5c66bba9d886807', 0, '2022-05-12 13:05', ''),
(19, 'cliente@cliente.es', '78a2e14b6a54e457099e2cee0578326549b87025db34d899fbf0657bc280f5a9', 0, '2022-05-12 13:13', ''),
(20, 'admin@todosdatos.com', 'f281130f0bf466cdbeb0fd1343230340b365e43e34b2b79d2447a584272984af', 0, '2022-05-12 13:16', ''),
(21, 'alvarez@canervmfd.es', '9d8393894c3f03c9943bcd814fd6c6fa88db41db71ea5efd8169600b8052f6d3', 0, '2022-05-16 11:47', ''),
(22, 'miguel.a.torralba@gmail.com', 'c0b43960a7bab648c0abcb76654766e89bb63f42a4ea7bf9c362960a385708fb', 0, '2022-05-16 11:51', ''),
(23, 'maria@maria.xyz', '4641e3fc40427a4c54e291b0329a6a9a42a2f2c67a1b61a60ff5786df547f9f2', 0, '2022-06-02 10:06', ''),
(24, 'violeta.arandaa@gmail.com', '27ff7e52dab2e956a8bd41de83ff15d02007b3fac0dd648d09027eac00124ef4', 0, '2022-06-26 13:07', ''),
(25, 'violeta.arandaa@gmail.com', '3d22ffb6a1b6a26dd95e0833236c1d9af35db55d438c10705c4a204b561e2821', 0, '2022-06-26 13:11', ''),
(26, 'bbbb@ggg.es', '8bc7336a1a86f78612a7641049317155a7e71ebdac80e81ff8f8c0f74ab3ba86', 0, '2022-07-28 14:15', ''),
(27, 'miguel2@gmail.com', '253827096e7ddbd1099b73010f53e9bf8bc0e976d40b7065d9737a5022efcea7', 0, '2022-07-28 14:27', ''),
(28, 'maria@maria.com', '1faf7b5ded1e403887471b7560cd0cc220fa8939046919a4085bb6a0b011dec3', 0, '2024-02-14 06:41', ''),
(29, 'maria@maria.com', '0945686019bec7a582422e0802e3265f2bec09ca7598c4bb10799a8026523661', 0, '2024-02-14 06:42', ''),
(30, 'nacho@nacho.com', '455e02549dedd16ecdf5c2dc7d6e2e6c1d88bbd15b9ace46724d9d78caee58eb', 0, '2024-02-14 07:16', ''),
(31, 'manu@manu.com', 'd89a1812682875e4d65105a9179b98414a68bd9ab5e12904837c5016738c3bf2', 0, '2024-02-14 07:31', ''),
(32, 'marta@marta.es', '7e46d631186d09961a5c7288be4dd3616e45efc2ef00252f97bf08a324ee3771', 0, '2024-03-05 06:58', ''),
(33, 'antonio@antonio.es', 'e9eb5e599891b8a7c5864a9815c99ce3ed51deafa7ca07657653bbb42b680d3c', 0, '2024-03-05 07:00', ''),
(34, 'dalealplay@dalealplay.com', '37e20bec2eccc94ad4902206c6f5607f56e26ac8ce5eb0b0be7bc07233043cea', 0, '2024-03-22 06:33', ''),
(35, 'mary@mary.com', '5668ee7784a079617ae24f4a6ba74df9fc0cb584c40fdde9775a8029afbe9d49', 0, '2024-03-22 06:52', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_clientes`
--

CREATE TABLE `datos_clientes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `poblacion` varchar(100) NOT NULL,
  `cp` varchar(20) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `cif` varchar(20) NOT NULL,
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_clientes`
--

INSERT INTO `datos_clientes` (`id`, `id_user`, `pais`, `provincia`, `poblacion`, `cp`, `direccion`, `cif`, `created_at`, `updated_at`) VALUES
(2, 26, 'España', 'Córdoba', 'Córrdoba_', '14004', 'Historiador manuel salcines 24', '30954328F', '2024-02-14 06:42', '2024-07-02 08:15'),
(3, 27, 'España', 'barcelona', 'barcelona', '1230', 'Historiador manuel salcines 24', '123456k', '2024-02-14 07:16', ''),
(4, 28, 'España', 'Córdoba', 'cordoba', '14004', 'Historiador manuel salcines 2', '32156867c', '2024-02-14 07:31', '2024-02-14 07:45'),
(5, 29, 'España', 'Córdoba', 'cordoba', '14004', 'Historiador manuel salcines 2', '12s3456k', '2024-03-05 06:58', '2024-03-22 07:12'),
(6, 30, 'España', 'Córdoba', 'cordoba', '14004', 'Historiador manuel salcines 2', 'wewqe', '2024-03-05 07:00', '2024-04-08 05:36'),
(7, 31, '', '', '', '', '', '', '2024-03-22 06:33', ''),
(8, 32, 'España', 'Córdoba', 'cordoba', '14004', 'Historiador manuel salcines 2', '30954322F', '2024-03-22 06:52', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios`
--

CREATE TABLE `formularios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formularios`
--

INSERT INTO `formularios` (`id`, `nombre`) VALUES
(1, 'Información');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre_rol`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos_clientes`
--

CREATE TABLE `telefonos_clientes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `telefonos_clientes`
--

INSERT INTO `telefonos_clientes` (`id`, `id_user`, `telefono`) VALUES
(3, 27, '+34634590930'),
(4, 27, '456234576'),
(6, 28, '+34634590930'),
(7, 28, '22222222'),
(17, 32, '634590930'),
(18, 32, '634590930'),
(19, 29, '634590930'),
(24, 30, '634590930'),
(28, 26, '444444444'),
(29, 26, '3333333');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `activo` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `email`, `clave`, `activo`, `id_rol`, `created_at`, `updated_at`) VALUES
(1, 'miguel angel', 'miguel.a.torralba@gmail.com', 'MTIzNDU=', 1, 1, '0', '2022-06-02 10:46'),
(26, 'Maria', 'maria@maria.com', 'UTcybG90b21f', 1, 0, '2024-02-14 06:42', '2024-03-20 06:53'),
(27, 'nacho', 'nacho@nacho.com', 'MXFhel9fMG9rTQ==', 1, 0, '2024-02-14 07:16', ''),
(28, 'manuel', 'manu@manu.com', 'MXFhel9fMG9rTQ==', 1, 0, '2024-02-14 07:31', '2024-02-14 07:45'),
(29, 'marta', 'gerencia@appsur.com', 'UTcybG90b21f', 1, 0, '2024-03-05 06:58', '2024-03-22 07:12'),
(30, 'antonio', 'gerencia@appsur.com', 'QW50b25pbzFf', 0, 0, '2024-03-05 07:00', '2024-04-08 05:36'),
(31, 'Dale al Play', 'dalealplay@dalealplay.com', 'RGFsUDIwMjRf', 1, 0, '2024-03-22 06:33', ''),
(32, 'mary', 'mary@mary.com', 'RGFsUDIwMjRf', 1, 0, '2024-03-22 06:52', '2024-04-08 08:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_roles`
--

CREATE TABLE `users_roles` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users_roles`
--

INSERT INTO `users_roles` (`id`, `id_user`, `id_rol`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(7, 27, 3),
(9, 28, 3),
(15, 26, 3),
(16, 31, 2),
(17, 32, 3),
(18, 29, 3),
(19, 30, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cambiar_pass`
--
ALTER TABLE `cambiar_pass`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_clientes`
--
ALTER TABLE `datos_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `telefonos_clientes`
--
ALTER TABLE `telefonos_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cambiar_pass`
--
ALTER TABLE `cambiar_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `datos_clientes`
--
ALTER TABLE `datos_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `formularios`
--
ALTER TABLE `formularios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `telefonos_clientes`
--
ALTER TABLE `telefonos_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
