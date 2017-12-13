-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 12 月 12 日 01:53
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `school`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(32) DEFAULT '123654',
  `mobile` varchar(11) NOT NULL,
  `account` varchar(11) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123655 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`aid`, `name`, `password`, `mobile`, `account`) VALUES
(1, 'admin', '733d7be2196ff70efaf6913fc8bdcabf', '13556614415', 'admin'),
(3, '柏柏', '733d7be2196ff70efaf6913fc8bdcabf', '13555614412', '吴三桂'),
(201, '俊厅', '733d7be2196ff70efaf6913fc8bdcabf', '13555614412', 'baiiab');

-- --------------------------------------------------------

--
-- 表的结构 `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` varchar(20) NOT NULL,
  `majors` varchar(20) DEFAULT NULL,
  `year` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `class`
--

INSERT INTO `class` (`id`, `cid`, `majors`, `year`) VALUES
(5, '16届02班', '', '2016'),
(2, '16届01班', '', '2016'),
(3, '16届03班', '', '2016'),
(4, '15届02班', '', '2015'),
(6, '15届01班', '', '2015'),
(7, '15届03班', NULL, '2015'),
(8, '14届02班', NULL, '2014'),
(9, '14届01班', NULL, '2014'),
(1, '14届03班', NULL, '2014'),
(13, '16届04班', NULL, '2016');

-- --------------------------------------------------------

--
-- 表的结构 `evection`
--

CREATE TABLE IF NOT EXISTS `evection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(11) NOT NULL,
  `asktime` varchar(20) NOT NULL,
  `holidaytime` varchar(25) NOT NULL,
  `place` varchar(30) NOT NULL,
  `purpose` varchar(30) NOT NULL,
  `tutor` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `evection`
--

INSERT INTO `evection` (`id`, `tid`, `asktime`, `holidaytime`, `place`, `purpose`, `tutor`) VALUES
(12, '13556614412', '1512471822', '1509879060-1509879060', '南海', '学习习习', '好人'),
(11, '13556614412', '1512470994', '1509965340-1510224540', '北京', '学习习', '折老师');

-- --------------------------------------------------------

--
-- 表的结构 `guardian`
--

CREATE TABLE IF NOT EXISTS `guardian` (
  `gid` varchar(11) NOT NULL,
  `headimg` varchar(100) NOT NULL DEFAULT '',
  `gname` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT '123654',
  `gender` varchar(4) DEFAULT '男',
  `mobile` varchar(11) DEFAULT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `guardian`
--

INSERT INTO `guardian` (`gid`, `headimg`, `gname`, `password`, `gender`, `mobile`, `num`) VALUES
('13556614412', '/uploads/20171130\\73126d7e78b9d1959a41f2f393040013.jpg', '李老师', '733d7be2196ff70efaf6913fc8bdcabf', '男', '13556614412', 12),
('13556614414', '', '白老师', '123654', '男', '13556614416', 0),
('13556614416', '', '王老师', '123654', '男', '13556614416', 2),
('13556614418', '', '大老师', '123654', '男', '13556614416', 0),
('13556614419', '', '王老师', '123654', '男', '13556614416', 0),
('13556614420', '', '白老师', '123654', '男', '13556614416', 0),
('13556614421', '', '王老师', '123654', '男', '13556614416', 0),
('13556614422', '', '白老师', '7ae7778c9ae86d2ded133e891995dc9e', '女', '13556614422', 3),
('13556614423', '', '白老师', '654321', '女', '13556614416', 0),
('13556614424', '', '白老师', '123654', '男', '13556614416', 0),
('13556614426', '', '大老师', '123654', '男', '13556614416', 0),
('13556614427', '', '王老师', '123654', '男', '13556614416', 0),
('13556614428', '', '白老师', '123654', '男', '13556614416', 0),
('13556614429', '', '王老师', '123654', '男', '13556614416', 0),
('13556614431', '', '白老师', '123654', '男', '13556614416', 0),
('12212', '', '小厂村', '733d7be2196ff70efaf6913fc8bdcabf', '男', '13556614455', 0);

-- --------------------------------------------------------

--
-- 表的结构 `holiday`
--

CREATE TABLE IF NOT EXISTS `holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(11) NOT NULL,
  `asktime` varchar(20) NOT NULL,
  `holidaytime` varchar(25) NOT NULL,
  `reason` varchar(30) NOT NULL,
  `tutor` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `holiday`
--

INSERT INTO `holiday` (`id`, `tid`, `asktime`, `holidaytime`, `reason`, `tutor`) VALUES
(1, '13556614413', '1510657693', '1510657693-1511176220', '去玩玩', '13556614412'),
(2, '13556614412', '1512471058', '1510051740-1510224540', '去荡荡', '析老师'),
(3, '13556614412', '1512472348', '1512645120-1512817920', '在声明中 ', '不爱了');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `tid` varchar(11) NOT NULL,
  `gid` varchar(11) NOT NULL,
  `sendtime` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `sid`, `tid`, `gid`, `sendtime`) VALUES
(68, 13, '13556614412', '', '1512735723'),
(66, 9, '13556614412', '13556614416', '1512733463'),
(28, 1, '13556614412', '13556614412', '1510917863'),
(32, 7, '13556614412', '13556614417', '1510917863'),
(3, 2, '13556614412', '13556614412', '1510298926'),
(0, 5, '13556614412', '13556614412', '1510298926'),
(65, 3, '13556614412', '13556614416', '1512733463'),
(6, 4, '13556614412', '13556614412', '1510298926'),
(29, 8, '13556614412', '13556614417', '1510917863'),
(30, 6, '13556614412', '13556614417', '1510917863');

-- --------------------------------------------------------

--
-- 表的结构 `signed`
--

CREATE TABLE IF NOT EXISTS `signed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(11) NOT NULL,
  `signtime` varchar(20) NOT NULL,
  `position` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `signed`
--

INSERT INTO `signed` (`id`, `tid`, `signtime`, `position`) VALUES
(1, '13556614414', '1510208204', '广州'),
(2, '13556614416', '1510208004', '广东'),
(3, '13556614413', '1510208304', '江门');

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `headimg` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL,
  `cid` varchar(20) DEFAULT NULL,
  `sex` varchar(4) DEFAULT '男',
  `tid` varchar(11) NOT NULL,
  `detid` varchar(11) NOT NULL,
  `year` decimal(4,0) NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3242343 ;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`sid`, `headimg`, `name`, `cid`, `sex`, `tid`, `detid`, `year`) VALUES
(1, '', '小红', '16届01班', '男', '13556614412', '13556614416', '2016'),
(2, '', '小折', '14届01班', '男', '13556614412', '13556614416', '2014'),
(5, '', '夲晨', '14届01班', '女', '13556614412', '13556614416', '2014'),
(4, '', '小鬼', '14届01班', '男', '13556614412', '13556614416', '2014'),
(6, '', 'test1', '16届01班', '男', '13556614412', '13556614416', '2016'),
(3, '', 'test', '16届01班', '女', '13556614412', '13556614416', '2016'),
(8, '', '小国', '16届01班', '男', '13556614412', '13556614416', '2014'),
(9, '', '只要有右', '16届01班', '男', '13556614412', '13556614416', '2016'),
(11, '', '小军', '14届01班', '男', '13556614412', '13556614416', '2014'),
(10, '', '阿布', '16届02班', '女', '13556614412', '13556614416', '2016'),
(12, '', '监督局', '16届02班', '男', '13556614422', '13556614416', '2016'),
(13, '', '小国', '16届02班', '男', '13556614412', '13556614416', '2016'),
(7, '', '方叶', '16届02班', '女', '13556614412', '13556614416', '2016'),
(14, '/uploads/20171121\\d6390016c26eebe3c9c8d7ee32599d83.jpg', '白白', '16届02班', '男', '13556614422', '13556614414', '2016'),
(15, '/uploads/20171121\\117ced4a83866b58311967843c42320a.jpg', '黑黑', '16届02班', '男', '13556614422', '13556614412', '2016'),
(16, '/uploads/20171201\\5aef21d2342d25e88d4496a48c3b1522.png', '你是谁呀', '16届02班', '女', '13556614413', '13556614416', '2016');

-- --------------------------------------------------------

--
-- 表的结构 `studentgroup`
--

CREATE TABLE IF NOT EXISTS `studentgroup` (
  `sgid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `sids` varchar(1000) DEFAULT NULL,
  `tid` varchar(11) NOT NULL,
  PRIMARY KEY (`sgid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `studentgroup`
--

INSERT INTO `studentgroup` (`sgid`, `name`, `sids`, `tid`) VALUES
(1, '艺术班', '9,19,1,2,3,4', '13556614412'),
(3, '体育班', '6,3,1,2', '13556614412');

-- --------------------------------------------------------

--
-- 表的结构 `systemnews`
--

CREATE TABLE IF NOT EXISTS `systemnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sendtime` varchar(20) NOT NULL,
  `content` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL COMMENT '0代表教师消息，1监护人消息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `systemnews`
--

INSERT INTO `systemnews` (`id`, `sendtime`, `content`, `status`) VALUES
(1, '1510208204', '明天放假', '13556614412'),
(2, '1510208204', '明天放假', '1'),
(3, '1510208204', '明天放假', '1'),
(4, '1510208204', '明天放假', '13556614422'),
(5, '1510208204', '明天放假明天放大假明天放大假明天放大假明天放大假', '1'),
(6, '1510209803', '明天放大假明天放大假明天放大假明天放大假明天放大天放大假', '13556614412'),
(7, '1510208204', '明天放假', '0'),
(8, '1510208204', '明天放假', '0'),
(9, '1510208204', '明天放假', '0'),
(10, '1510209899', '明天放大假', '13556614422'),
(11, '1510208204', '明天放假', '0'),
(12, '1510726115', '后天也放假', '0'),
(13, '1510727001', '大后天也放假', '0'),
(14, '1510802036', '天天放假', '1'),
(15, '1510814898', '4534', '0'),
(16, '1510822473', '我想早点走哦', '1'),
(17, '1510825315', '324', '13556614412'),
(18, '1511018627', '我是管理员', '1');

-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `tid` varchar(11) NOT NULL,
  `headimg` varchar(100) NOT NULL DEFAULT '',
  `tname` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT '123654',
  `gender` varchar(4) DEFAULT '男',
  `mobile` varchar(11) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  `position` varchar(20) NOT NULL DEFAULT '',
  `cid` varchar(200) NOT NULL,
  `year` decimal(4,0) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher`
--

INSERT INTO `teacher` (`tid`, `headimg`, `tname`, `password`, `gender`, `mobile`, `course`, `position`, `cid`, `year`) VALUES
('13556614413', '', '析老师', '733d7be2196ff70efaf6913fc8bdcabf', '男', '13556614412', '大数据', '班主任', '14届01班,14届02班', '2014'),
('13556614416', '', '王老师', '123654', '女', '13556614416', '计算机', '级主任', '142', '2015'),
('13556614414', '', '白老师', '123654', '男', '13556614417', '高等代数', '系主任', '142', '2014'),
('13556614417', '', '析老师', '123654', '女', '13556614413', '大数据', '副校长', '142', NULL),
('13556614418', '', '白老师', '123654', '男', '13556614415', '高等代数', '校长', '142', NULL),
('13556614419', '', '柏柏柏', '123654', '男', '13556614497', '高等代数', '', '142', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `transinfo`
--

CREATE TABLE IF NOT EXISTS `transinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `tid` varchar(11) NOT NULL,
  `gid` varchar(11) NOT NULL,
  `reason` varchar(30) DEFAULT NULL,
  `sendtime` varchar(20) NOT NULL,
  `backtime` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2' COMMENT '0代表课程异常，1代表驳回，2是正常接收',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=143 ;

--
-- 转存表中的数据 `transinfo`
--

INSERT INTO `transinfo` (`id`, `sid`, `tid`, `gid`, `reason`, `sendtime`, `backtime`, `status`) VALUES
(142, 11, '13556614412', '13556614412', NULL, '1512734980', '1512735038', 2),
(141, 3, '13556614412', '13556614412', '4564', '1510299546', '1512727335', 1);

-- --------------------------------------------------------

--
-- 表的结构 `transinfodata`
--

CREATE TABLE IF NOT EXISTS `transinfodata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT NULL,
  `headimg` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `sendtime` varchar(20) NOT NULL,
  `backtime` varchar(20) NOT NULL,
  `reason` varchar(30) DEFAULT NULL,
  `gender` varchar(4) NOT NULL,
  `cid` varchar(20) NOT NULL,
  `tname` varchar(20) NOT NULL,
  `gname` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2' COMMENT '0课程异常，1驳回，2正常',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- 转存表中的数据 `transinfodata`
--

INSERT INTO `transinfodata` (`id`, `sid`, `headimg`, `name`, `sendtime`, `backtime`, `reason`, `gender`, `cid`, `tname`, `gname`, `mobile`, `status`) VALUES
(83, 5, '', '夲晨', '1510298926', '1512633695', '不认真', '女', '142', '析老师', '析老师', '13556614412', 0),
(81, 1, '', '小国', '1510917863', '1512633500', '不可爱', '男', '143', '析老师', '析老师', '13556614412', 1),
(79, 4, '', '小鬼', '1510298926', '1512633374', '不认真', '男', '143', '析老师', '析老师', '13556614412', 0),
(82, 2, '', '小折', '1510298926', '1512633695', '不听话', '男', '143', '析老师', '析老师', '13556614412', 0),
(80, 2, '', '小折', '1510298926', '1512633374', NULL, '男', '143', '析老师', '析老师', '13556614412', 2),
(84, 4, '', '小鬼', '1510298926', '1512633705', '不可爱', '男', '143', '析老师', '析老师', '13556614412', 1),
(85, 3, '', 'test', '1510299546', '1512645601', '大跃进要', '女', '143', '析老师', '李老师', '13556614412', 1),
(86, 9, '', '只要有右', '1512698183', '1512698264', '只厅', '男', '143', '析老师', '李老师', '13556614412', 1),
(87, 4, '', '小鬼', '1512698945', '1512699263', '第二次驳回', '男', '143', '析老师', '李老师', '13556614412', 1),
(88, 9, '', '只要有右', '1512698945', '1512699531', '延续二次', '男', '143', '析老师', '李老师', '13556614412', 1),
(89, 1, '', '小国', '1510917863', '1512700050', '协', '男', '143', '析老师', '李老师', '13556614412', 1),
(90, 3, '', 'test', '1510299546', '1512727335', '4564', '女', '143', '析老师', '析老师', '13556614412', 1),
(91, 11, '', '小军', '1512734980', '1512735038', NULL, '男', '143', '析老师', '析老师', '13556614412', 2);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `tokensession` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
