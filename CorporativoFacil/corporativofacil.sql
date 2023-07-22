-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 09:10 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corporativofacil`
--
CREATE DATABASE IF NOT EXISTS `corporativofacil` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `corporativofacil`;

-- --------------------------------------------------------

--
-- Table structure for table `acessos`
--

CREATE TABLE IF NOT EXISTS `acessos` (
  `online_id` int(11) NOT NULL AUTO_INCREMENT,
  `online_session` varchar(70) DEFAULT NULL,
  `viewstart_moment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `viewend_moment` datetime NOT NULL,
  `online_ip` varchar(75) NOT NULL,
  `online_url` varchar(175) DEFAULT NULL,
  `online_agent` varchar(115) DEFAULT NULL,
  PRIMARY KEY (`online_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `acessos`
--

TRUNCATE TABLE `acessos`;
--
-- Dumping data for table `acessos`
--

INSERT INTO `acessos` (`online_id`, `online_session`, `viewstart_moment`, `viewend_moment`, `online_ip`, `online_url`, `online_agent`) VALUES
(1, 'hk1e5p23tfq63kv7p630mi6ntr', '2020-09-06 03:54:09', '2020-09-06 01:14:09', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(2, 'hk1e5p23tfq63kv7p630mi6ntr', '2020-09-06 03:54:09', '2020-09-06 01:14:09', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(3, 't17uvnedv0sbppusiidjki351q', '2020-09-06 18:34:45', '2020-09-06 15:54:45', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Outros navegadores'),
(4, 't17uvnedv0sbppusiidjki351q', '2020-09-06 18:34:45', '2020-09-06 15:54:45', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(5, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:06:02', '2020-09-06 16:26:02', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(6, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:06:02', '2020-09-06 16:26:02', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(7, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:06:37', '2020-09-06 16:26:37', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(8, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:06:38', '2020-09-06 16:26:38', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(9, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:09:50', '2020-09-06 16:29:50', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(10, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:09:50', '2020-09-06 16:29:50', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(11, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:09:58', '2020-09-06 16:29:59', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(12, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:09:59', '2020-09-06 16:29:59', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(13, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:31:57', '2020-09-06 16:51:58', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(14, 't17uvnedv0sbppusiidjki351q', '2020-09-06 19:31:58', '2020-09-06 16:51:58', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(15, 'mt2bjbnjs22gua9ungtjvq0guh', '2020-09-07 20:52:44', '2020-09-07 18:12:44', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Outros navegadores'),
(16, 'mt2bjbnjs22gua9ungtjvq0guh', '2020-09-07 20:52:45', '2020-09-07 18:12:45', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(17, 'mt2bjbnjs22gua9ungtjvq0guh', '2020-09-08 02:00:54', '2020-09-07 23:20:54', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(18, 'mt2bjbnjs22gua9ungtjvq0guh', '2020-09-08 02:00:54', '2020-09-07 23:20:55', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(19, '3fln3s98nlma8cj1vmdcqtoi94', '2020-09-08 19:19:07', '2020-09-08 16:39:07', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Outros navegadores'),
(20, '3fln3s98nlma8cj1vmdcqtoi94', '2020-09-08 19:19:07', '2020-09-08 16:39:07', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(21, '3fln3s98nlma8cj1vmdcqtoi94', '2020-09-08 19:19:23', '2020-09-08 16:39:23', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(22, '3fln3s98nlma8cj1vmdcqtoi94', '2020-09-08 19:19:23', '2020-09-08 16:39:23', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(23, '3fln3s98nlma8cj1vmdcqtoi94', '2020-09-08 19:19:31', '2020-09-08 16:39:31', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(24, '3fln3s98nlma8cj1vmdcqtoi94', '2020-09-08 19:19:32', '2020-09-08 16:39:32', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(25, 'c2ghfha8piao1tv2tl01ohi59f', '2020-09-15 20:49:50', '2020-09-15 18:09:50', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Outros navegadores'),
(26, 'c2ghfha8piao1tv2tl01ohi59f', '2020-09-15 20:49:50', '2020-09-15 18:09:50', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(27, 'c2ghfha8piao1tv2tl01ohi59f', '2020-09-15 20:50:20', '2020-09-15 18:10:20', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(28, 'c2ghfha8piao1tv2tl01ohi59f', '2020-09-15 20:50:20', '2020-09-15 18:10:20', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(29, 'm6n050m7okg89oej1lkggjaev7', '2020-09-16 20:43:46', '2020-09-16 18:03:46', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Outros navegadores'),
(30, 'm6n050m7okg89oej1lkggjaev7', '2020-09-16 20:43:47', '2020-09-16 18:03:47', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(31, 'm6n050m7okg89oej1lkggjaev7', '2020-09-16 23:11:33', '2020-09-16 20:31:33', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(32, 'm6n050m7okg89oej1lkggjaev7', '2020-09-16 23:11:34', '2020-09-16 20:31:34', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(33, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:48:33', '2020-09-17 15:08:33', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Outros navegadores'),
(34, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:48:34', '2020-09-17 15:08:34', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(35, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:48:49', '2020-09-17 15:08:49', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(36, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:48:50', '2020-09-17 15:08:50', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(37, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:49:53', '2020-09-17 15:09:53', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(38, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:49:53', '2020-09-17 15:09:54', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(39, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:51:47', '2020-09-17 15:11:47', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(40, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:51:47', '2020-09-17 15:11:48', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(41, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:53:59', '2020-09-17 15:13:59', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(42, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:53:59', '2020-09-17 15:13:59', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(43, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:54:20', '2020-09-17 15:14:21', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(44, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:54:21', '2020-09-17 15:14:21', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(45, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:55:57', '2020-09-17 15:15:57', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(46, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:55:57', '2020-09-17 15:15:58', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(47, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:56:31', '2020-09-17 15:16:31', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(48, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:56:31', '2020-09-17 15:16:31', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(49, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:57:33', '2020-09-17 15:17:34', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(50, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:57:34', '2020-09-17 15:17:34', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(51, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:57:54', '2020-09-17 15:17:54', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(52, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:57:55', '2020-09-17 15:17:55', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(53, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:58:06', '2020-09-17 15:18:07', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(54, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:58:07', '2020-09-17 15:18:07', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(55, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:59:12', '2020-09-17 15:19:12', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(56, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:59:12', '2020-09-17 15:19:12', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(57, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:59:30', '2020-09-17 15:19:30', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(58, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 17:59:30', '2020-09-17 15:19:30', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(59, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:00:13', '2020-09-17 15:20:13', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(60, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:00:13', '2020-09-17 15:20:13', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(61, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:00:31', '2020-09-17 15:20:31', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(62, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:00:31', '2020-09-17 15:20:31', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(63, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:00:42', '2020-09-17 15:20:42', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(64, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:00:42', '2020-09-17 15:20:42', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(65, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:03:57', '2020-09-17 15:23:57', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(66, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:03:57', '2020-09-17 15:23:57', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(67, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:28:21', '2020-09-17 15:48:21', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(68, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:28:21', '2020-09-17 15:48:21', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(69, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:30:12', '2020-09-17 15:50:12', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(70, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:30:12', '2020-09-17 15:50:12', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(71, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:30:32', '2020-09-17 15:50:32', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(72, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:30:32', '2020-09-17 15:50:32', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(73, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:36:04', '2020-09-17 15:56:04', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(74, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:36:04', '2020-09-17 15:56:04', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(75, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:36:42', '2020-09-17 15:56:43', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(76, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:36:43', '2020-09-17 15:56:43', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(77, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:37:50', '2020-09-17 15:57:50', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(78, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 18:37:51', '2020-09-17 15:57:51', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(79, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:25:38', '2020-09-17 16:45:39', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(80, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:25:39', '2020-09-17 16:45:39', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(81, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:27:29', '2020-09-17 16:47:29', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(82, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:27:29', '2020-09-17 16:47:29', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(83, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:29:46', '2020-09-17 16:49:46', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(84, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:29:47', '2020-09-17 16:49:47', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(85, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:30:36', '2020-09-17 16:50:37', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(86, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:30:37', '2020-09-17 16:50:37', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(87, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:33:59', '2020-09-17 16:53:59', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome'),
(88, 'ruj4ed5v5sa2lk8uago804mrff', '2020-09-17 19:33:59', '2020-09-17 16:53:59', '::1', '/CorporativoFacil/index/painel/escolha/cadastrar_publicacao.php', 'Chrome');

-- --------------------------------------------------------

--
-- Table structure for table `acesso_por_navegador`
--

CREATE TABLE IF NOT EXISTS `acesso_por_navegador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `online_agent` varchar(115) DEFAULT NULL,
  `agent_views` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `acesso_por_navegador`
--

TRUNCATE TABLE `acesso_por_navegador`;
--
-- Dumping data for table `acesso_por_navegador`
--

INSERT INTO `acesso_por_navegador` (`id`, `online_agent`, `agent_views`) VALUES
(1, 'Outros navegadores', 7);

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(115) DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `usuario` varchar(75) NOT NULL,
  `senha` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `autor`
--

TRUNCATE TABLE `autor`;
--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`id`, `nome`, `email`, `telefone`, `usuario`, `senha`) VALUES
(1, 'Matheus Martins', 'martins.matheus88@gmail.com', '61981383188', 'math', 'vaidarcerto,disgrama'),
(2, 'Roger Magno', 'magnorog@gmail.com', '(61)99951-4057', 'roger', 'vaidarcertologo');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `conteudo` text NOT NULL,
  `data_hoje` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `categorias`
--

TRUNCATE TABLE `categorias`;
--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `titulo`, `conteudo`, `data_hoje`) VALUES
(1, 'Jogos', 'Novidades/notícias sobre jogos', '2020-08-30 11:51:00'),
(6, 'Metal', 'Informações sobre o mundo do metal!', '2020-08-30 11:51:00'),
(17, 'Quarentena', 'A quarentena vai durar mais tempo.', '2020-08-30 11:50:00'),
(21, 'Cicero', 'O Cícero vai conseguir ATENDIMENTOS ANTES DE DEZEMBRO, MESMO EM MEIO À QUARENTENA', '2020-09-30 12:41:00'),
(38, 'Vai-dar-certo', 'vai logo!', '2020-08-12 11:59:00'),
(41, 'Relacionamentos', 'Jess e eu...', '2020-08-12 11:25:00'),
(47, 'Vida', 'vai dar certo!', '2020-08-14 11:46:00'),
(50, 'Comida', 'carne moída com cebola, vitamina de banana e panquecas.', '2020-08-15 11:55:00'),
(53, 'Heavy-Metal-thrash-metal', 'Drunken Wisdom(1988) - Overkill', '2020-09-18 12:05:00'),
(55, 'Cicero-1', 'O cicero vai sair dessa, vitorioso', '2020-09-16 12:56:00'),
(56, 'Musica-1', 'FPG- my way(COVER)', '2020-09-16 12:44:00'),
(57, 'Amor', 'Miro.', '2020-09-22 12:59:00'),
(58, 'emprego', 'Vida profissional', '2020-10-30 18:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `contatos_recebidos`
--

CREATE TABLE IF NOT EXISTS `contatos_recebidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(56) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `contatos_recebidos`
--

TRUNCATE TABLE `contatos_recebidos`;
-- --------------------------------------------------------

--
-- Table structure for table `datas`
--

CREATE TABLE IF NOT EXISTS `datas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_original` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `datas`
--

TRUNCATE TABLE `datas`;
-- --------------------------------------------------------

--
-- Table structure for table `galerias`
--

CREATE TABLE IF NOT EXISTS `galerias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_imagem` varchar(255) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `data_galeria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `galerias`
--

TRUNCATE TABLE `galerias`;
-- --------------------------------------------------------

--
-- Table structure for table `publicacao`
--

CREATE TABLE IF NOT EXISTS `publicacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) NOT NULL,
  `conteudo` varchar(450) DEFAULT NULL,
  `autor` varchar(75) NOT NULL,
  `visualizacoes` bigint(20) DEFAULT NULL,
  `data_da_publicacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_categoria` int(11) NOT NULL,
  `imagem` varchar(175) DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_autor` (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `publicacao`
--

TRUNCATE TABLE `publicacao`;
--
-- Dumping data for table `publicacao`
--

INSERT INTO `publicacao` (`id`, `descricao`, `conteudo`, `autor`, `visualizacoes`, `data_da_publicacao`, `id_categoria`, `imagem`, `id_autor`) VALUES
(1, 'Playstation-5', 'PS5 será lançado em novembro deste ano! O preço em Reais, ainda estamos aguardando.', 'Marcos Daniel Martins', 25, '2020-10-19 19:26:20', 1, NULL, 2),
(24, 'Situação atual', 'vai dar certo, caceta!', '', 99, '2020-10-19 23:18:58', 47, NULL, 3),
(25, 'Em qual música você está pensando?', 'Testament - Musical Death(A Dirge)', 'Marcos Daniel Martins', NULL, '2020-10-24 01:06:46', 53, NULL, 2),
(42, 'agradecimento', 'obrigado pelo dia de hoje!', 'Matheus Martins', 101, '2020-10-20 15:41:03', 47, NULL, 2),
(44, 'vai', 'vai', 'Matheus Martins', NULL, '2020-10-19 19:26:33', 38, NULL, 3),
(50, 'je avoir besoin de programmé', 'ça va!', '', 25, '2020-10-19 19:26:36', 38, NULL, 1),
(53, 'Situação profissional', 'Continuarei na ORBENK o tempo que precisar e terminarei esse Sistema neste ano.', 'Marcos Daniel Martins', NULL, '2020-10-20 17:15:06', 38, NULL, 2),
(58, 'Dinheiro', 'vou conseguir dinheiro para comprar aquele jogo; vou conseguir dinheiro para ir à viagem; vou conseguir dinheiiro para o que eu quiser', 'Marcos Daniel Martins', NULL, '2020-10-19 19:26:45', 47, NULL, 2),
(82, 'DFC-O-mal-que-vem-para-pior', 'Existência ignóbil.', 'Marcos Daniel', NULL, '2020-10-19 19:26:48', 6, 'img/2020/09/O-Mal-Que-Vem-Para-Pior-1600402622.jpg', 2),
(116, 'Vai', 'vai', '', NULL, '2020-10-19 19:27:59', 47, 'img/2020/09/MzYwLDYwMCxBQUFBQUNBRE5RVTEtNA2-1600469684.jpg', 4),
(120, 'Um-belo-casal', 'Jess e Marcos vão dar muito certo juntos', '', NULL, '2020-10-19 19:27:02', 41, NULL, 3),
(121, 'Forçando para dar certo', 'Persistindo até conseguir, mesmo num ritmo devagar', '', NULL, '2020-10-19 22:25:21', 47, NULL, 4),
(122, 'Forçando pra dar certo', 'Persistindo até conseguir, mesmo num ritmo devagar', '', NULL, '2020-10-24 20:54:12', 47, NULL, 2),
(124, 'Forcando-para-dar-certo', 'Persistindo até conseguir, mesmo num ritmo devagar', '', NULL, '2020-10-19 19:28:41', 47, 'img/2020/10/Front-1602875046.JPG', 1),
(180, 'vai-dar-certo', 'Vou comprar um xbox em dezembro. Vou conseguir ir à Campinas, pegar todas as coisas e conseguir volta pelo Buser sem empecilhos.', '', NULL, '2020-10-26 22:10:29', 47, 'imagens/2020/10/vai-dar-certo.png', 3),
(181, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste.jpg', 2),
(182, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603915544.jpg', 2),
(184, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603915633.jpg', 2),
(186, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste.jpg', 2),
(187, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603917115.jpg', 2),
(188, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603919439.jpg', 2),
(189, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603919531.jpg', 2),
(190, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603919551.jpg', 2),
(191, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603920384.jpg', 2),
(192, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603920478.jpg', 2),
(193, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603920487.jpg', 2),
(196, 'teste', 'teste', '', NULL, '2020-10-28 19:06:03', 47, 'imagens/2020/10/teste-1603921082.jpg', 2),
(198, 'teste', 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing', '', NULL, '2020-10-28 21:38:58', 47, 'imagens/2020/10/teste.jpeg', 2),
(200, 'miro', '<p><strong>VAI DAR CERTO, </strong><em>caramba</em></p>', '', NULL, '2020-10-29 20:22:00', 47, 'imagens/2020/10/miro-1604006150.jpeg', 2),
(201, 'miro', '<p><strong>VAI DAR CERTO, </strong><em>caramba</em></p>', '', NULL, '2020-10-29 20:22:00', 47, 'imagens/2020/10/miro-1604006303.jpeg', 2),
(202, 'miro', '<p><strong>VAI DAR CERTO, </strong><em>caramba</em></p>', '', NULL, '2020-10-29 20:22:00', 47, 'imagens/2020/10/miro.jpeg', 2),
(203, 'miro', '<p><strong>VAI DAR CERTO, </strong><em>caramba</em></p>', '', NULL, '2020-10-29 20:22:00', 47, 'imagens/2020/10/miro-1604008786.jpeg', 2),
(204, 'miro', '<p><strong>VAI DAR CERTO, </strong><em>caramba</em></p>', '', NULL, '2020-10-29 20:22:00', 47, 'imagens/2020/10/miro-1604009421.jpeg', 2),
(205, 'miro', '<p><strong>VAI DAR CERTO, </strong><em>caramba</em></p>', '', NULL, '2020-10-29 20:22:00', 47, 'imagens/2020/10/miro-1604009443.jpeg', 2),
(206, 'miro', '<p><strong>VAI DAR CERTO, </strong><em>caramba</em></p>', '', NULL, '2020-10-29 22:10:43', 47, 'imagens/2020/10/miro-1604009549.jpeg', 2),
(207, 'miro', '<p><strong>VAI DAR CERTO, </strong><em>caramba</em></p>', '', NULL, '2020-10-29 22:10:43', 47, 'imagens/2020/10/miro-1604009656.jpeg', 2),
(208, 'vai-dar-certo', '<p><em>Vou deslanchar profissionalmente</em></p>', '', NULL, '2020-10-30 18:33:40', 58, 'imagens/2020/10/vai-dar-certo.png', 2),
(209, 'vai-dar-certo', '<p><em>Vou deslanchar profissionalmente e vou receber uma bolada dessa demissão! Estou com fé nisso</em></p>', '', NULL, '2020-11-09 06:32:29', 58, NULL, 2),
(210, 'cadeira-e-afins', '<p style=\"text-align: center;\">erfergregergre egwrr34ft56y6hy</p>', '', NULL, '2020-11-01 19:11:25', 38, 'imagens/2020/11/cadeira-e-afins.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `trafego`
--

CREATE TABLE IF NOT EXISTS `trafego` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_visualizacao` date DEFAULT NULL,
  `usuarios` int(11) DEFAULT NULL,
  `visualizacoes` int(11) DEFAULT NULL,
  `paginas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `trafego`
--

TRUNCATE TABLE `trafego`;
--
-- Dumping data for table `trafego`
--

INSERT INTO `trafego` (`id`, `data_visualizacao`, `usuarios`, `visualizacoes`, `paginas`) VALUES
(1, '2020-09-05', 1, 9, 44),
(2, '2020-09-05', 1, 9, 44),
(3, '2020-09-05', 1, 9, 44),
(4, '2020-09-06', 1, 1, 12),
(5, '2020-09-07', 1, 1, 4),
(6, '2020-09-08', 1, 1, 6),
(7, '2020-09-15', 1, 1, 4),
(8, '2020-09-16', 1, 1, 4),
(9, '2020-09-17', 1, 1, 57);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(32) NOT NULL,
  `telefone` varchar(40) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `usuario` varchar(28) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `usuarios`
--

TRUNCATE TABLE `usuarios`;
--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `telefone`, `senha`, `usuario`, `nivel`) VALUES
(1, 'Cícero Miguel', 'contatociceromiguel@gmail.com', '(19)9.9980-2727', 'vaidarcerto', 'Cicero', 3),
(2, 'Marcos Daniel', 'marcdmartins@gmail.com', '(19)9.9963-9339', 'vaidarcerto', 'marco', 3),
(3, 'Matheus Martins', 'martins.matheus88@gmail.com', '(61)9.8138-3118', 'nosvamostodosterMUITOdinheiro', 'math', 1),
(4, 'Roger Magno', 'magnorog@gmail.com', '(61)9.9951-4057', 'vaidarcertologo', 'roger', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galerias`
--
ALTER TABLE `galerias`
  ADD CONSTRAINT `galerias_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `publicacao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publicacao`
--
ALTER TABLE `publicacao`
  ADD CONSTRAINT `publicacao_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publicacao_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
