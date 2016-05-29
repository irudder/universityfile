-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 07 月 30 日 17:12
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `epay`
--

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) DEFAULT NULL,
  `turename` varchar(20) DEFAULT NULL,
  `pwd` varchar(16) DEFAULT NULL,
  `sex` char(4) DEFAULT NULL,
  `birthday` varchar(20) DEFAULT NULL,
  `idcard` char(18) DEFAULT NULL,
  `email` varchar(16) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `reday` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`id`, `cname`, `turename`, `pwd`, `sex`, `birthday`, `idcard`, `email`, `mobile`, `address`, `reday`) VALUES
(1, 'rudder', 'rudder', '123456', '男', '', '', '', 0, '', '2015-07-19 10:48:47'),
(2, 'hello', 'hh', '123', NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-19 11:56:01'),
(3, 'hello', 'hh', '123', NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-19 11:56:03'),
(4, 'hello', 'hh', '123', NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-19 11:56:04'),
(5, 'hello', 'hh', '123', NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-19 11:56:05'),
(9, 'hello', 'hh', '123', NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-19 11:56:09'),
(10, 'hello', 'hh', '123', NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-19 11:56:09'),
(11, 'rudder12', '你猜', '123', NULL, NULL, NULL, '123@qq.com', 135, NULL, '1991-10-17'),
(12, 'rudder12', '你猜', '123', NULL, NULL, NULL, '123@qq.com', 135, NULL, '1991-10-17'),
(13, 'rudder12', '你猜', '123', NULL, NULL, NULL, '123@qq.com', 135, NULL, '1991-10-17'),
(14, 'rudder2', '你猜2', '1234', NULL, NULL, NULL, '1234@qq.com', 136, NULL, '1994-10-17'),
(15, 'rudder2', '你猜2', '1234', NULL, NULL, NULL, '1234@qq.com', 136, NULL, '1994-10-17'),
(16, 'rudder2', '你猜2', '1234', NULL, NULL, NULL, '1234@qq.com', 136, NULL, '1994-10-17'),
(17, 'rudder2', '你猜2', '1234', NULL, NULL, NULL, '1234@qq.com', 136, NULL, '1994-10-17'),
(18, 'ru', '你猜啦', '345', NULL, NULL, NULL, '123@qq.com', 136, NULL, '1997-10-17'),
(19, 'ru', '你猜啦', '345', NULL, NULL, NULL, '123@qq.com', 136, NULL, '1997-10-17'),
(20, 'ru', '你猜啦', '345', NULL, NULL, NULL, '123@qq.com', 136, NULL, '1997-10-17'),
(21, 'ru', '你猜啦', '345', NULL, NULL, NULL, '123@qq.com', 136, NULL, '1997-10-17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
