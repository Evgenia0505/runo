-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 31 2024 г., 06:49
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `runo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Adventure'),
(2, 'Travel'),
(3, 'Fashion'),
(4, 'Technology'),
(5, 'Branding');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `project_id`, `user_id`, `text`, `date`) VALUES
(1, 1, 11, 'kjfkkjf kkgjdlgjd lfslgjgld lllklgd', '2024-07-21 08:23:38'),
(2, 18, 11, 'kgdkfkfd kjdlkdg lkdkdglld', '2024-07-21 08:23:56'),
(3, 2, 12, 'Kfjddckcmkj uhdudhh jshddhj hfjjdlkf jjshiuhshf sjihs skfj. Hkjkkvlk kjdjdsk kjsksksdkjijsi kjjso uiryusj jcdicjl!', '2024-07-29 12:13:36'),
(4, 3, 13, 'Jokvlvfv dkfodmd lkokvdv lldkpokd ldkpodvmd lkfidjfdm kfdkfdv fkklddlld. Tkfkllmk dkfjdkd ldkdokd kokf, fkfkkdd kgfkdlf kfjfflfl!', '2024-07-29 12:16:08'),
(5, 17, 13, 'Skfvldkd lkodvkvk llkpodkd lkpd lkvpookv lllkpokd! Dmvkv ovj ovd kovkdv povvdvlvlk.', '2024-07-29 12:16:39'),
(6, 16, 13, 'Snkjvvkd kcokkd uoiu lkvpovk lkcspok! Rcmll kkjcosjc ckc lcolck kcssockc komkmc.', '2024-07-29 12:17:18'),
(7, 6, 9, 'Gkdvv kccc isuj llvovl lkoeujs kodksd, mvjovj kodkvmiv kkjiji jdijddj doosjkspooo doioo!', '2024-07-29 12:21:14'),
(8, 19, 9, 'Amkck dkfl kosk llkoss ksok skspf ;plllk lf kffkf pol pofk oodkkdl lfpfkpk fiokmf fkfok.', '2024-07-29 12:22:07'),
(9, 7, 8, 'Dkvkvks skfokl fsosoks kspks oosok lkpom psksl sfpss, sfoskf ffosff foi fjoijll djlk jok.', '2024-07-30 15:00:20'),
(10, 6, 8, 'Tkskkl ovvks lvksvls lslksoks skkfjs joiijfs lkokd vkpok kpskfkf.', '2024-07-30 15:03:52'),
(11, 6, 15, 'Khggh guygbjhh ftdfg gytdre uttuyfvj jjjgytfvg rtrcv hgyttf fytfvhj.', '2024-07-31 03:43:33');

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `email`, `text`, `date`) VALUES
(1, 'ku7@ru', 'Rjklldll kfkld kllf fkokf lkfk.', '2024-06-30 17:00:10'),
(2, 'kk@gg', 'Smmfllfk kfjfkf fkof lkfofk kof lfko fkfj kfkfl kfkl.', '2024-07-02 03:23:00'),
(3, 'ku@ru', 'Kijfij jifd fif ififn fif jfij fiij.', '2024-07-05 10:00:00'),
(4, 'kuz@com', 'Dffj kfjij fkf kookod okfkkf kkk dij kkjijj.', '2024-07-15 13:43:00'),
(5, 'ku9@ru', 'gfgsfsfs fhhsufsh fhsfgs hsgsfgs guuygdasd dgaygsy hgaygsas gygsyhhgs dgfsgfsu shgsysg gdgdg dgdgs twewygy gsgsdd sgugs dgjgudgaug  tpooiwfvbz guusgsbc hgsgdsuish', '2024-07-24 09:30:42');

-- --------------------------------------------------------

--
-- Структура таблицы `footer`
--

CREATE TABLE `footer` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `expl1` varchar(255) DEFAULT NULL,
  `expl2` varchar(255) DEFAULT NULL,
  `expl3` varchar(255) DEFAULT NULL,
  `expl4` varchar(255) DEFAULT NULL,
  `expl5` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `soc1` varchar(255) DEFAULT NULL,
  `soc2` varchar(255) DEFAULT NULL,
  `soc3` varchar(255) DEFAULT NULL,
  `soc4` varchar(255) DEFAULT NULL,
  `soc5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `footer`
--

INSERT INTO `footer` (`id`, `email`, `phone`, `expl1`, `expl2`, `expl3`, `expl4`, `expl5`, `address`, `soc1`, `soc2`, `soc3`, `soc4`, `soc5`) VALUES
(1, 'mike@runo.com', '+944 450 904 505', 'About', 'Partners', 'Job Opportunities', 'Advertise', 'Membership', '191 Middleville Road,<br>NY 1001, Sydney<br>Australia', 'f.png', 't.png', 'y.png', 'p.png', 'be.png');

-- --------------------------------------------------------

--
-- Структура таблицы `nav`
--

CREATE TABLE `nav` (
  `id` int(11) NOT NULL,
  `nav1` varchar(255) NOT NULL,
  `nav2` varchar(255) NOT NULL,
  `nav3` varchar(255) NOT NULL,
  `nav4` varchar(255) NOT NULL,
  `soc1` varchar(255) DEFAULT NULL,
  `soc2` varchar(255) DEFAULT NULL,
  `soc3` varchar(255) DEFAULT NULL,
  `soc4` varchar(255) DEFAULT NULL,
  `soc5` varchar(255) DEFAULT NULL,
  `search` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `nav`
--

INSERT INTO `nav` (`id`, `nav1`, `nav2`, `nav3`, `nav4`, `soc1`, `soc2`, `soc3`, `soc4`, `soc5`, `search`) VALUES
(1, 'Home', 'About', 'Articles', 'Contact Us', 'f.png', 't.png', 'y.png', 'p.png', 'be.png', 'search.png');

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `subtitle` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `text2` text NOT NULL,
  `date` date NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `glass` int(11) NOT NULL DEFAULT 0,
  `time` varchar(10) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `pick` int(11) NOT NULL DEFAULT 0,
  `check` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `title`, `subtitle`, `text`, `text2`, `date`, `likes`, `glass`, `time`, `image`, `image2`, `image3`, `user_id`, `category_id`, `pick`, `check`) VALUES
(1, 'Dream destinations to visit this year in Paris', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', ' Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios.\n<br><br>\n  Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. Text 1.', 'Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-01', 303, 502, '4', '1.png', '18279.png', NULL, 2, 1, 0, 1),
(2, 'Richird Norton photorealistic rendering as real photos', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. Text 2.', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-02', 250, 382, '3', '2.png', '223254.png', NULL, 3, 5, 0, 1),
(3, 'Dream destinations to visit this year in Paris', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. Text 3.', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-08', 205, 744, '5', '3.png', '3461.png', NULL, 4, 1, 0, 1),
(4, 'Dream destinations to visit this year in Paris', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships.Text 4.', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-01', 145, 286, '2', '4.png', '415642.png', NULL, 2, 1, 0, 1),
(5, 'Art of Seasons: 40+ Bright Illustrations by Nature', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', ' Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios.\n<br><br>\n  Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships.Text 5.', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-08', 99, 279, '3', '5.png', '529000.png', NULL, 5, 1, 0, 1),
(6, 'The Anatomy of a Web Page and Basic Elements', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', ' Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios.\n<br><br>\n  Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships.Text 6.', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-02', 50, 141, '5', '6.png', '628733.png', NULL, 2, 3, 0, 1),
(7, 'Types of Contrast in User Interface Design', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', ' Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios.\n<br><br>\n  Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships.Text 7.', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-01', 25, 144, '4', '7.png', '710274.png', NULL, 6, 1, 0, 1),
(8, 'Dream destinations to visit this year in Paris', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', ' Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios.\n<br><br>\n  Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships.Text 8.', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-08', 10, 88, '3', '8.png', '86549.png', NULL, 7, 2, 0, 1),
(9, 'Thins to know before visiting Cave in Germany', 'Progressively incentivize cooperative systems through technically sound functionalities. Credibly productivate seamless data with flexible schemas.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. Text Related Posts pick 1!', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-07', 0, 27, '2', 'post1.png', '922.png', NULL, 6, 1, 0, 1),
(10, 'Nina Smith vibrant work collab with Nike Dunk', 'Progressively incentivize cooperative systems through technically sound functionalities. Credibly productivate seamless data with flexible schemas.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. Text Related Posts pick 1!', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-07', 0, 41, '3', 'post2.png', '1018236.png', NULL, 7, 3, 0, 1),
(11, 'Richard Norton photorealistic rendering as real photos', 'Progressively incentivize cooperative systems through technically sound functionalities. Credibly productivate seamless data with flexible schemas.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. Text Related Posts pick 1!', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-07', 1, 140, '4', 'post3.png', '1129733.png', NULL, 5, 4, 0, 1),
(12, '25 quality collectors toys inspired by famous films', 'Progressively incentivize cooperative systems through technically sound functionalities. Credibly productivate seamless data with flexible schemas.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. Text Related Posts pick 1!', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-07', 0, 10, '3', 'post4.png', '126863.png', NULL, 7, 3, 0, 1),
(13, 'My first blog', 'Just subtitle', 'a lot of text a lot of text a lot of text a lot of text a lot of text ffff', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.mmm', '2024-07-11', 1, 1830, '1', '132031.jpg', '13341.jpg', NULL, 9, 5, 0, 0),
(14, 'Trend exploration', 'Simple the subtitle', 'A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text A lot of text', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2024-07-11', 3, 1571, '2', '14379.png', '149383.png', NULL, 10, 4, 0, 0),
(15, 'Richird Norton photorealistic rendering as real photos', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. ', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-07', 0, 116, '3', '9723549.png', '15649.png', NULL, 2, 3, 0, 1),
(16, 'Richird Norton photorealistic rendering as real photos', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. ', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-08', 314, 550, '3', '1619818.png', '162883.png', 'fon02.png', 3, 1, 1, 1),
(17, 'Richird Norton photorealistic rendering as real photos', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. ', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-08', 1, 93, '4', 'fon2.png', '171761.png', NULL, 6, 3, 2, 1),
(18, 'Richird Norton photorealistic rendering as real photos', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. ', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-01', 0, 62, '2', '9.png', '1824387.png', NULL, 4, 1, 3, 1),
(19, 'Richird Norton photorealistic rendering as real photos', 'Progressively incentivize cooperative systems through technically sound functionalities. The credibly productivate seamless data.', 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just in time customer service without real-time scenarios. <br><br>   Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. ', ' Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.', '2021-08-02', 0, 75, '5', '10.png', '197633.png', NULL, 5, 1, 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `subscribe`
--

INSERT INTO `subscribe` (`id`, `email`, `date`) VALUES
(1, 'kk@gg', '2024-07-01 10:13:51'),
(2, 'ku@ru', '2024-07-02 10:13:51'),
(3, 'ku7@ru', '2024-07-03 10:13:51'),
(4, 'kuz@com', '2024-07-04 10:13:51'),
(5, 'ku6@ru', '2024-07-07 10:13:51'),
(6, 'ku5@ru', '2024-07-08 10:13:51'),
(7, 'ku9@ru', '2024-07-25 04:57:34');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `text` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rights` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `pass`, `name`, `phone`, `email`, `text`, `image`, `rights`) VALUES
(1, 'author', '123', 'admin', 'phone', 'admin@ru', 'admin', '1893.png', 'admin'),
(2, 'author', '123', 'Jennifer Lawrence', '+7(777) 777-7777', 'ku1@ru', 'Thinker & Designer', 'author1.png\n', 'user'),
(3, 'author', '123', ' David Arthur', '+7(777) 777-7777', 'ku2@ru', 'Designer', 'author2.png\n', 'user'),
(4, 'author', '123', 'Sarah Lawrence', '+7(777) 777-7777', 'ku3@ru', 'Journalist', 'author3.png\n', 'user'),
(5, 'author', '123', 'David Tomas', '+7(777) 777-7777', 'ku4@ru', 'Thinkers', 'author4.png\n', 'user'),
(6, 'author', '123', 'Andrey Edison', '+7(777) 777-7777', 'ku5@ru', 'Thinker & Designer', 'author5.png\n', 'user'),
(7, 'author', '123', 'Sean Anderson', '+7(777) 777-7777', 'ku6@ru', 'Thinker & Designer', 'author6.png\n', 'user'),
(8, 'author', '123', 'Vasya', '', 'ku10@ru', NULL, '1722316735rodents.png', 'user'),
(9, 'author', '123', 'Bill Jonson', '+7(777) 777-7777', 'ku7@ru', 'Super designer5', '9711.jpg', 'user'),
(10, 'author', '123', 'Jane Jackson', '+77777777775', 'ku8@ru', 'Developer ', '101899.jpg', 'user'),
(11, '', '123', 'Xiomi', '', 'ku9@ru', NULL, NULL, 'user'),
(12, '', '123', 'Peter', '', 'ku11@ru', NULL, NULL, 'user'),
(13, '', '123', 'Anna', '', 'ku12@ru', NULL, NULL, 'user'),
(14, '', '123', 'Dan', '', 'ku13@ru', NULL, NULL, 'user'),
(15, '', '123', 'Lin', '', 'ku14@ru', NULL, NULL, 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT для таблицы `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nav`
--
ALTER TABLE `nav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT для таблицы `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
