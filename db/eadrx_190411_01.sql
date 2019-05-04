-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2019 at 06:00 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eadrx`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_book`
--

DROP TABLE IF EXISTS `app_book`;
CREATE TABLE IF NOT EXISTS `app_book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `lang_id` int(11) NOT NULL COMMENT 'Language, FK',
  `status_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Status',
  `book_title` varchar(200) NOT NULL COMMENT 'Title',
  `book_desc` mediumtext NOT NULL COMMENT 'Description',
  `book_image` char(150) NOT NULL COMMENT 'Image',
  `book_price` decimal(10,2) NOT NULL COMMENT 'Price',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`book_id`),
  KEY `lang_id` (`lang_id`),
  KEY `book_status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_book`
--

INSERT INTO `app_book` (`book_id`, `lang_id`, `status_id`, `book_title`, `book_desc`, `book_image`, `book_price`, `ins_datetime`) VALUES
(1, 2, 1, 'Sexual Imprint', '<p>Every person in this world in a distinctive imprint; i.e., they have their unique unmatched personality. This definitely means that there are serious disparities between the types of thinking of males and females in addition to qualitative biological differences between the two sexes. Males and females are different type each; they may be visual, auditory, kinesthetic or olfactory. However, it happens that some people might have more than one distinctive characteristic. Those are the people who are the most difficult to deal with. Everyone of them is a situated knower and has their innate distinctive characteristics that make them a unique entity.</p>', 'Sexual Imprint.jpg', '9.99', '2019-03-29 09:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `app_book_page`
--

DROP TABLE IF EXISTS `app_book_page`;
CREATE TABLE IF NOT EXISTS `app_book_page` (
  `bpage_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `book_id` int(11) NOT NULL COMMENT 'Book',
  `page_num` smallint(6) NOT NULL COMMENT 'Page Number',
  `page_image` varchar(200) DEFAULT NULL COMMENT 'Image',
  `page_text` text NOT NULL COMMENT 'Text',
  PRIMARY KEY (`bpage_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_book_page`
--

INSERT INTO `app_book_page` (`bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`) VALUES
(1, 1, 1, NULL, '<p>Order this book at (doctorxapp@gmail.com)</p>\r\n\r\n<p>&copy; Copyright 2018 DR.X.</p>\r\n\r\n<p>All rights reserved for the author. No part of this publication may be reproduced, sorted in retrieval system or transmitted, in any form or by any means, electronic, mechanical, photocopying, recording, or otherwise, without the written prior permission of the author.</p>\r\n\r\n<p><em><strong>All Rights Reserved For The Author</strong></em></p>'),
(2, 1, 2, NULL, '<p><strong>Introduction</strong></p>\r\n\r\n<p>Every person in this world in a distinctive imprint; i.e., they have their unique unmatched personality. This definitely means that there are serious disparities between the types of thinking of males and females in addition to qualitative biological differences between the two sexes. Males and females are different type each; they may be visual, auditory, kinesthetic or olfactory. However, it happens that some people might have more than one distinctive characteristic. Those are the people who are the most difficult to deal with. Everyone of them is a situated knower and has their innate distinctive characteristics that make them a unique entity.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>These disparities are not only social or cultural; they are cognitive and biological. That is why there are differences which might be sharp between males and females. There are even differences between males themselves and females themselves. They mainly centre round misunderstanding between the two sexes, having different ways of thinking, different behavior &hellip; etc. You must bear in mind, dear reader, that those disparities will result in a kind of diversity which manifests in acquiring knowledge, having different levels of sexual desire and even different sexual practice (<strong><em>situated sex</em></strong>), and reaching the very results in different ways. In other words, each sex has their own way of obtaining the very piece of knowledge, dealing with it, processing it, comprehending it or transferring it.</p>'),
(3, 1, 3, NULL, '<p style=\\\"text-align:justify\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">This is, in fact, the bless we have been endowed with. Has all mankind had the same way of thinking and the same tastes, everyone on earth would be no more than a replica of the other. </span></span></span></span></p><p style=\\\"text-align:justify\\\">&nbsp;</p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">Everyone has their own way of reaching the same point. That is true, but sometimes the person&rsquo;s own way may lead to a different result in non-general issues such as addition and mathematics due to the fact that different ways of thinking lead to different outcomes. This explains why human beings have different ideas, convictions and values, let alone the differences in evaluating others and respecting or violating their rights. This way also indicates the different kinds of interest people have. Some people highly concentrate on their body, others on ideas and some have interest in both; body and ideas, in different proportions. People, in general, do not have the same level of cognition because they are different &quot;<em>situated knowers</em>&quot;; thus, they have their own way of acquiring knowledge, as we already said.</span></span></span></span></p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">In the light of the abovementioned, we must think deeply and work hard to reach common grounds on which to build our understanding of one another whether we are males or females.</span></span></span></span></p>'),
(4, 1, 4, NULL, '<p style=\\\"text-align:center\\\"><strong><em><span style=\\\"font-size:22.0pt\\\"><span style=\\\"font-family:&quot;Monotype Corsiva&quot;\\\">Males and Females As </span></span></em></strong></p><p style=\\\"text-align:center\\\"><strong><em><span style=\\\"font-size:20.0pt\\\"><span style=\\\"font-family:&quot;Monotype Corsiva&quot;\\\">&ldquo;Situated Knowers&rdquo;</span></span></em></strong></p><p style=\\\"text-align:justify\\\">&nbsp;</p><p style=\\\"text-align:justify\\\">&nbsp;</p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">We are a mixture world combining male and female together. Do we not have both hormones; masculine and feminine, regardless of whether we are males or females? Is not the word &ldquo;androgen&rdquo; derived from &ldquo;pine&rdquo; which combines both; male and female genitals, and is self-pollinating? This means it can turn into a male and a female, and so is the hormone of androgen.</span></span></p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">Hence, we are males and females at the same time as far as our minds are concerned. The following example will help simplify this idea: Let us consider that a male embryo is XY (notice here that the chromosomal structure consists of a male Y and a female X) and let us suppose that it needs one unit of the male sex hormone to be able to make male sexual organs, and three units, for example, to be able to form the main masculine encephalic operating system. But, due to some reasons, the embryo does not receive the prerequisite amount; i.e., if the embryo needs four units and it only gets three, then one unit would be directed towards forming the sexual organs, and only two will be left to form the brain. </span></span></p>'),
(5, 1, 5, NULL, '<p style=\\\"text-align:justify\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">This means that the brain would be 2/3 masculine (and 1/3 feminine). This would result in a baby who would, later have a masculine mind, yet s/he will still enjoy feminine thinking and characteristics. (These are virtual proportions).</span></span></p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">The other possibility is that the embryo receives only two units of hormones; one of which would be dedicated to forming the testicles, but the brain would be under the effect of one unit; a process that would result in a genetically male baby with a femininely-formed brain,&nbsp; and basically feminine thinking. When this baby reaches the phase of puberty, there would be a possibility for him/her to become sexually abnormal. When the embryo is feminine, there would be a few or no male hormones in it. This means that the sexual organs are feminine and the main brain structure would maintain its feminine characteristics. The brain would continue to receive feminine hormones and would develop all the qualities necessary for building &quot;the nest&quot; and protecting it, in addition to building the centres necessary for deciphering verbal and non-verbal signals.</span></span></p>'),
(6, 1, 6, NULL, '<p style=\\\"text-align:justify\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">When this baby comes out to the world, its external appearance would be feminine as well as its behavior due to encephalic data. However, sometimes, in a way that has not previously been planned, the embryo may receive a sudden portion of male sex hormones. In this case, the baby will come out to the world with a clearly masculine appearance.</span></span></p><p style=\\\"text-align:justify\\\">&nbsp;</p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">It is believed that 80 &ndash; 85% of men basically have masculine encephalic data, and that 15&ndash;20 % of them have a feminine brain. Many men who belong to the second group would become sexually deviants in the phase of puberty. It worth mentioning that 15 &ndash; 20 % of men have a feminine brain, while only 10 % of women have a masculine brain.</span></span></p><p style=\\\"text-align:justify\\\">&nbsp;</p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">We have to bear in mind that the psychological conditions a pregnant woman goes through would allow for an increase or a shortage of masculine or feminine hormones in her body. These hormones, in turn, reach the embryo during mitosis and during the formation of its brain. This means that any malfunction would affect the embryo and the way of thinking s/he will have in the future.</span></span></p>'),
(7, 1, 7, NULL, '<p style=\\\"text-align:justify\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">When we talk about the female sex in this book, we are but confining ourselves to dealing with about 90% of females who are programmed by feminine patterns of behavior. The remaining 10% of females have a brain which has, in a way or another, different masculine abilities. This is due to the fact that between the sixth and the eighth weeks after fertilization, the embryo would receive a portion of male hormones.</span></span></p><p style=\\\"text-align:justify\\\">&nbsp;</p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">When we disagree with our peers, our cerebral and psychological, and consequently, our chemical conditions will be a major cause of the problems that arise between us.</span></span></span></span></p><p style=\\\"text-align:justify\\\">&nbsp;</p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">Certainly, we are not always responsible for our conflict nor are we responsible for our understanding of one another; simply because we are subject to our biological and hormonal cycles. When we are in a state of harmony with our partners, our cerebrums secrete two chemicals that evoke a number of feelings; </span></span><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">phenylethylamine</span></span><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\"> (PEA) and </span></span><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">noradrenalin.</span></span> </span></span></p><p style=\\\"text-align:justify\\\">&nbsp;</p><p style=\\\"text-align:justify\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">Phenylethylamine is a natural amphetamine </span></span><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">that betters one&#39;s temperament. Secretion of the PEA urges the secretion of dopamine which evokes the positive function of neuro-conductors between the two cerebral hemispheres; a case that will, inevitably, lead to comprehending each other and feeling one another. </span></span></span></span></p><p><span style=\\\"font-size:13.0pt\\\"><span style=\\\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\\\">PEA increases cell connectivity and explains the reasons behind our clear thinking in the early morning though we stayed late the night before talking to the one we love. Production of this substance prevents the masculine hemisphere from dominating our cerebrums and incites the right hemisphere to work. </span></span></p>'),
(8, 1, 8, NULL, '<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p>It should be noted that it is our right cerebrum that is responsible for the feelings of beauty, relaxation, love, under-&nbsp;standing and comprehension. This means that lack of production of this substance prevents us from listening to each other and prevents the feminine hemisphere from providing us with creative techniques to solve our problems of misunderstanding. It is worth mentioning here that there is a strong relation between the feeling of happiness and the PEA which is a chemical our bodies release in some cases such as eating a piece of chocolate.</p>\r\n\r\n<p>This substance, however, is a strong stimulant that has a completely opposite impact to its value on understanding. It is one of the reasons why we suffer from tension in the early weeks of any emotional relationship. We might suffer from stomach-ache or we might mistakenly think that we will be in a state of nausea upon seeing the person we love.</p>\r\n\r\n<p>The other chemical released by our cerebrums when we are in a state of understanding or love is the noradrenalin which is closely associated with the sense of contingency.</p>\r\n\r\n<p>It is one of the neuro-conductors that are responsible for palm sweating, raising blood pressure and heartbeat rate. It is also responsible for our sense of happiness and activity as well as our intensive concentration on the one we love. Therefore, it is used in the production of some medicines of anti-depression and anti-anxiety though this chemical is released during sharp fits of anxiety or rage.</p>\r\n\r\n<p>&nbsp;</p>'),
(9, 1, 9, NULL, '<p>&nbsp;</p>\r\n\r\n<p>When we fall in love or enjoy a state of harmony, there is another chemical secreted in the body but not much; it is the serotonin which is released in small amounts in the abovementioned cases and in cases of depression.&nbsp;&nbsp;</p>\r\n\r\n<p>There are some similarities between a person experiencing love and a person undergoing compulsory obsession. In this case, we have to realize that decrease of the serotonin levels is the cause of the state of lack of happiness that we feel; a state that is contrary to love, but this gives an explanation why love is accompanied with happiness and depression alike. Thus, we come to notice the neural, hormonal and psychological contradiction we all have and which indicates that we need phenylethylamine, noradrenalin and serotonin to be happier, more understanding and to be in good terms with those around us.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(10, 1, 10, NULL, '<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p>An infatuated lover speaking about the positive characteristics of his beloved is the best example of the low levels of the serotonin in particular which influences our concentration and coercive interest. This dysfunctions the frontal lobe that is responsible for sound judgement, and here arises the following question: Does our ability to have good judgment become dysfunctional when we love or quarrel? The answer manifests in the low serotonin levels that incapacitate the frontal lobe and the secretion of adrenaline during outrage.</p>\r\n\r\n<p>When we are in a state of love, our minds fall short of realizing the demerits of those we love. The natural abilities that we seek the help of to evaluate others within a social framework paralyze when we look at the person we love. What happens is that such neural circles are not charged; therefore, they stop working. Low serotonin levels give the reason behind the state of blindness that afflicts lovers, but it enhances their relationship since the part of the cerebrum that is responsible for passing judgments was disabled. Researches in this field indicate that low serotonin levels also give an explanation for our premonitions and our sense of insecurity.In a word, we are subject to the paradox of gaining the happiness of love, yet losing sound judgement which we also lose when we get angry or sad. Hence, it is up to us to choose love or anger and sadness!</p>\r\n\r\n<p>&nbsp;</p>'),
(11, 1, 11, NULL, '<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p><strong>Male and Female:</strong></p>\r\n\r\n<p><strong>Two Creatures &hellip; Two Worlds</strong></p>\r\n\r\n<p>&quot;You just do not understand&quot; is a phrase commonly used by parties in conflict. It is the most flagrant description of the disparity of two different creatures despite all the attempts made by Gender theoreticians to make society appear to be the reason behind all differences between males and females. In fact, that has not been approved by modern and contemporary scientific studies at all.</p>\r\n\r\n<p>&quot;You just don&#39;t understand&quot; is not a problem of dialogue between two different creatures; it is a problem of everything; a problem of body language, problem-voicing language, language of sympathy, language of hatred, language of communication &hellip; etc. In brief, male and female are only two creatures who accidentally met on a planet called &quot;Earth&quot;.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;\r\n			<p dir=\"\\\" style=\"text-align:center\"><em><span dir=\"\\\">Feminine mind instinctively thinks&nbsp;</span></em>&nbsp; &nbsp;</p>\r\n\r\n			<p dir=\"\\\" style=\"text-align:center\"><em><span dir=\"\\\">of unique ideas, consequently, you should</span></em>&nbsp;</p>\r\n\r\n			<p dir=\"\\\" style=\"text-align:center\"><em><span dir=\"\\\">not undervalue her crazy ideas since she inevitably has the emergence game inside</span></em>&nbsp; &nbsp;&nbsp;</p>\r\n\r\n			<p dir=\"\\\" style=\"text-align:center\"><em><span dir=\"\\\">&nbsp;her. She is not that crazy; she only diverges from your typical ideas. Her ideas are a rupture</span></em>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n\r\n			<p dir=\"\\\" style=\"text-align:center\"><em><span dir=\"\\\">&nbsp;of the current ideas.</span></em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"text-align:justify\">Those creatures produce &quot;androgen&quot;; the bisexual hormone that produces masculine and feminine hormones. Each one of them exists in the other and has the other inside them; i.e., everyone has masculine and feminine hemispheres in addition to the animus and anima. The animus is the masculine spirit that exists in the left hemisphere of the cerebrum, and the anima is the feminine spirit that exists in the right hemisphere.</p>\r\n\r\n<p>&nbsp;</p>'),
(12, 1, 12, NULL, '<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p>These two do actually create two worlds which unity needs a special craft. Here, the male has to exercise his right hemisphere to understand the female, and the female needs to exercise her left hemisphere to understand the male. Both, the male and female truly need to understand and comprehend the other so as to create links between their different worlds.</p>\r\n\r\n<p>D. Kimora (1989-1999; Butler 1988) believes that men and women share the very genetic material, except for the two sex chromosomes. The differences between men and women come as a result of the different hormones affecting the brain during its formation. Thus, sex differentiation begins.</p>\r\n\r\n<p>At the early stages of life, estrogen (the female sex hormone) and androgen, especially testosterone (the male sex hormone), work effectively ever since the embryonic phase where each living mammal, including humans, has the potential to be a male or female. If the embryo carries the chromosome Y, then the first step towards masculinization lies in the formation of the two masculine gonads (the testicles). Thus, secretion of male hormones begins. But, if the two gonads do not secrete male hormones or, for some reason, these hormones could not affect the tissue, then this human being will be a female.</p>\r\n\r\n<p>&nbsp;</p>'),
(13, 1, 13, NULL, '<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p>When the testicles are formed, they secrete two substances that lead to masculinity of the embryo in the uterus. Those two substances are the Testosterone and the Mullerian Regression Hormone (MRH).</p>\r\n\r\n<p>Kimora believes that male hormones not only cause the genitals to be male organs, but they are also responsible for regulating the masculine behavior at an early stage of life, and for determining the process of cognition of males and females.</p>\r\n\r\n<p>Kimora has inferred this fact by noticing that the cerebral spot responsible for regulation or what is called &quot;the hypothalamus&quot;, which is situated above the endocrine pituitary gland, is bigger in males&#39; brains than in females&#39;.</p>\r\n\r\n<p>Hence, Kimora believes that due to being exposed to sex hormones at early stages of life, cerebral changes that affect the human being for their whole life occur. She identifies the problem cognitively as a differentiation between both sexes ever since the formation moment in the uterus. This never changes by time or by being exposed to hormonal changes after parturition.</p>\r\n\r\n<p>&nbsp;</p>'),
(14, 1, 14, NULL, '<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p>Another study conducted by another scholar called Lofay from Salk Institute of Biological Studies reveals that the frontal part of the hypothalamus of males is bigger than that of females and it is smaller in homosexual men than in heterosexual men. This part exists in females and is similar to the part that homosexuals have. Therefore, the homosexual description has changed today into having a certain sexual situation; they have a biological reason.</p>\r\n\r\n<p>&nbsp;</p>'),
(15, 1, 15, NULL, '<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p><strong>Cognitive and Biological Differences between Males &amp; Females</strong></p>\r\n\r\n<p>Many prominent scientists (such as Kimora 1989-1999; Butler 1988; Berton and Levy 1989; McGinnis 1976; Ellen and Gorski 1991; Anki 1992; Driessen 1995; and Beckenberg and Johnson 1997) noticed the differences in the cerebrum size between males and females. hese disparities and structural differences could be the reason of the differences of behavior, growth and cognitive comprehension between males and females.</p>\r\n\r\n<p>Studies show that the cerebrum of males is 10-15% bigger than that of females and is 100g heavier (Anki 1992). Moreover, men have a billion neurons more in the cortex cerebri than women (Beckenberg &amp; Gonderson 1997).</p>\r\n\r\n<p>&nbsp;</p>'),
(16, 1, 16, NULL, '<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p>Other differences can be spotted in the subthalamus of females which contains smaller or bigger areas if compared to that of males. These areas are (INAH) and (SCN). The former plays a very important role in reproduction and the latter in the biological rhythms. Neuroanatomists and growth specialists have found out that during the early years of one&rsquo;s life up to the age of five, the rate of cerebrum growth differs within the very sex, whether male or female, and between the two sexes. This is the reason which some specialists attributed to the superiority of males in spatial tasks and the superiority of females in performing tasks related to language, speaking and reading in childhood. There are, definitely, other functional differences between males and females that we will deal with.</p>\r\n\r\n<p>In general, females surpass males in performing the following tasks and skills:</p>\r\n\r\n<ol>\r\n	<li><em>Skills of finger moving; moving fingers fast and harmoniously.</em></li>\r\n	<li><em>Math and computer tests.</em></li>\r\n	<li><em>Performing several tasks at a time. </em></li>\r\n	<li><em>Remembering places of things in a particular order.</em></li>\r\n	<li><em>Spelling.</em></li>\r\n	<li><em>Fluency at using words.</em></li>\r\n	<li><em>Tasks that need sensitivity towards external stimulants </em></li>\r\n</ol>\r\n\r\n<p><em>(except for visual females).</em></p>\r\n\r\n<ol start=\"\\\">\r\n	<li><em>Remembering signs all along the road.</em></li>\r\n	<li><em>Exercising verbal memory.</em></li>\r\n	<li><em>&nbsp;Depth estimation and quick perception.</em>&nbsp;</li>\r\n	<li><em>&nbsp;Understanding body language and facial expressions.</em></li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>'),
(17, 1, 17, NULL, '<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">Males, on the other hand, surpass females in performing the following tasks and skills:</p>\r\n\r\n<ol>\r\n	<li><em>Skills of shooting.</em></li>\r\n	<li><em>Using Vocabulary.</em>&nbsp;</li>\r\n	<li><em>Long-time concentrations.</em>&nbsp; &nbsp;</li>\r\n	<li><em>Mathematical thinking and problem solving.</em>&nbsp;&nbsp;</li>\r\n	<li><em>Navigation and good-consideration of the geometric features of&nbsp;&nbsp; places.</em></li>\r\n	<li><em>Verbal intelligence.</em>&nbsp;</li>\r\n	<li><em>Creating and persevering habits.</em>&nbsp;</li>\r\n	<li><em>Most spatial tasks.</em></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify\">Some other studies find out that there are girls who are more boyish and aggressive than their sisters. This is because they were exposed to large amounts of androgen during pregnancy. They also preferred boys&rsquo; games.</p>\r\n\r\n<p style=\"text-align:justify\">Thus, females who are exposed, while in their mother&#39;s uteruses, to higher androgen levels are deeply affected, especially as regards &ldquo;spatial performance&rdquo;.</p>\r\n\r\n<p>&nbsp;</p>'),
(18, 1, 18, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">But, the relation is not linear because spatial abilities do not increase with the increase of androgens. Kimora&#39;s study points out that men with low testosterone levels are superior to those with high-testosterone-levels in spatial tests. It also points out that women with high testosterone levels are better than those with low testosterone levels. These results reflect that there is an ideal level of androgens where spatial performance can be the best; the level lies within the minimum limits in the case of males. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">One would be dazzled whenever they hear males and females talking to each other. This makes us wonder about the way they talk; how one sex member asks about something and gets answers, from the opposite sex, that show complete irrelevance to what they are asking about. This clearly reflects the sharp differences between males and females; differences in cognition and biology though there are theories that insist on the idea that social experience can moderate biological differences between the two sexes since the latter; i.e., males and females, are supposed to be equal in their abilities and thinking in a way that biology cannot recognize.</span></span></span></span></p>'),
(19, 1, 19, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The male&rsquo;s way of expressing himself is structurally &ndash; not socially &ndash; different from that of the female. Some societies, for instance, prevent males from expressing their feelings and, sometimes, they make the language of males relatively void of any emotional expression. Such societies might not succeed in making all males clones of one another especially in the case of male artists, poets, and intuitionists whose nature manifests itself with no regard whatsoever to society. Parallelistically, such societies cannot teach the female how to express her needs indirectly since they only have this structural way of expression.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Approving the male&rsquo;s behavior, decisions and ambitions is the best way to his heart, for a male likes it when a spade is called a spade. He would, furthermore, like to enjoy serenity when accompanied by his female. Female, on the other hand, certainly likes the male who&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;expresses his feelings in a direct way. Yet, she does not prefer the direct way of expressing her own love and thoughts. She might do this every now and then especially if she is an auditory female because such a type listens and speaks at the same time, yet they prefer using symbols. Thus, males and females </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">simply think in two different ways because they use two different hemispheres.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There is another difference as far as their minds are concerned. Male&#39;s mind is competitive and it follows a hierarchy where there is always a head and followers, whereas a female thinks in a communicative circular way where there is no ultimate value for competition or for the top of the hierarchy.</span></span></p>'),
(20, 1, 20, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">What concerns the female is what goes beyond the achievement, and what effect the latter is going to have on her own and her male&#39;s feelings. In other words, she is not concerned with things themselves. She is, rather, concerned with how these things are going to affect her emotionally. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It should be noted that, socially-speaking, there are some women who would like to be liberated. Those find it convenient and satisfying to be described as men-like and that they have the ability to work and comprehend things like men do. Though this notion was intended to put an end to the prejudice and injustice practiced over women, it, however, enforced such prejudice due to referential comparison to men. Actually, such a case deprives the female from having her own entity. Therefore, conflicts arise between both sexes since females would try hard to prove their existence and independence. Not only this, they would also suffer from unstable relationship that may end in divorce, if they are married, or it may up in breaking up, if they are not, no matter how much they love one another.</span></span></p>'),
(21, 1, 21, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Situated Sex!</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Males and females do not only have biological differences; they also have different ways of accessing knowledge. This is associated to the differences of the sexual nature of either sex; i.e., as male or female.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The hormones a fetus gets at the mitosis phase, while in the uterus, lead to a difference in the nature of the two cerebral hemispheres that change the nature of the sexual act of the male and female. As the right and left cerebral hemispheres vary according to symmetrical and non-symmetrical fission mechanism that gives the cerebrum its unique imprint, the cornu ammonis (hippocampus) and hypothalamus determine the unique imprint nature of both sexes and the organ of each sex.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">According to some research conducted in this field, scientists say that women have a smaller size of hippocampus compared to men, and so do homosexual men have. They also have a smaller hippocampus than average men.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There are some preliminary studies that speak about the different measurements of hippocampus between a male and a male, and a female and a female. Those studies reveal the complexity of the mitosis phase and the complexities that afflict the cerebrum in consequence. This, in fact, gives every human being their unique and particular sexual imprint.</span></span></span></span></p>'),
(22, 1, 22, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The hypothalamus is the residence place of the (autonomic nervous system) while the hippocampus is the main part responsible for the formation of the special events and the linkage between these events and their contexts. The latter; i.e., the hippocampus, sends the receptors that enable it to respond to hormones. Lately, it has been noticed that it atrophies in case of undergoing sexual and psychological disorders, which clearly indicates its role in the sexual process. It imparts sentiments and affections on any piece of information acquired since it closely relates to the limpic nervous system which is responsible for sex and emotion. Thus, it controls everything that relates the sexual behavior;</span></span> <span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">a process that happens in cooperation with the amygdala.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">*&nbsp;&nbsp; *&nbsp;&nbsp; *&nbsp;&nbsp; *&nbsp;&nbsp; *&nbsp;&nbsp; *</span></span></span></span></p>'),
(23, 1, 23, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:16.0pt\"><span style=\"background-color:black\"><span style=\"font-family:&quot;Constantia&quot;,&quot;serif&quot;\"><span style=\"color:white\">Differences of Feelings</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There is no doubt whatsoever that there are qualitative differences in the feelings of males and females as far as desire and orgasm are concerned. In fact, this is the difference between male and female as situated sexes. It is worth mentioning that what gets a high importance in this regard is the qualitative differences between members of the same sex and the male and female sexual body map, or rather their erogenous zones. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">No male resembles the other as related to desire, sexual body map or the peak of orgasm. This explains the disharmony between partners; disharmony that might reach the extent of psychological and physical divorce. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Differences of bodies do not have to do only with sex which nature already differs between male and female. In other words, there are disparities between the biological, hormonal and anatomical natures between male and female. Nonetheless, this issue gets more complicated if we get into its details. Let us take the female as an example:</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">From the perspective of sexual anatomy, women are three categories: clitoral, vaginal and blended. This classification is not adequate if we are to determine the sexual nature of a female because the geography of pleasure or the sexual map of her body may reside in zones the male may not pay attention to due to his stereotypical behaviour with his female partner. </span></span></span></span></p>'),
(24, 1, 24, NULL, '<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">This means that pleasure can fix in several places of women&rsquo;s bodies else than the female genital organ. These zones can be: </span></span></p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">*Breasts (nipples&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&nbsp; in particular).</span></span></span></span></p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">*Neck.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">*Buttocks. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">*Anus.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">*Armpits.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">*Leg folds.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">These zones might be related to early sexual experiences a person might have undergone. Therefore, they appear to be conditioned. Nevertheless, this cannot determine the bodily sexual map or the geography of pleasure properly because the same experiences may not lead to the same conditioning or the same sexual pleasure in the case of those who underwent sexual experiences that had similar conditions. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We sometimes consider the geography of pleasure as having two factors; situated sex and the socio-sexual interactions. The first factor is a decisive one due to the unique cognitive and sexual cerebral nature of every human being. The second factor has to do with the way these interactions emerge in the life of every individual. </span></span></p>'),
(25, 1, 25, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">To put it differently, the consequences of sexual pleasure or sexual bruises that result from sexual experiences in one&rsquo;s early childhood always appear as binary associations (situated sex &ndash; experience). There will not be any similar consequences unless there is similarity in the situated sex. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In brief, symptoms and manifestations of psycho-sexual ailments are not the same. They are as different as people&rsquo;s feelings and desires are. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">* * * * *</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Back to speak about disparities. Some people might have the pleasure of looking, listening, touching, smelling or any other sense-related pleasure. Some of them might combine more than one kind. We cannot, however, regard this phenomenon as libidinous fixation, according to psycho-analysis, nor can we regard it as conditioning, according to behavioral psychology. This is, in fact, what we call situated sex&rdquo; which cannot be attributed to one reason (in a linear way); rather, it forms depending on the sexual nature of cerebrum, the experiences attributed to this nature and the positive and negative consequences of such experiences. </span></span></p>'),
(26, 1, 26, NULL, '<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Therefore, a healthy sexual meeting will be a meeting in which both parties have or almost have the very sexual nature, as situated sexes.</span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is good to know that an auditory female will not lead a healthy sexual life without having her sense of hearing enhanced. A visual female, on the other hand, will never like it to live in the dark with nothing to see. Similarly, if a kinesthetic female does not deal with her body and her partner&rsquo;s body in a proper active way, she will consider herself performing a social role when making love, no more, since it does not conform to her body nature and structure. So is the male, but with some differences.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>'),
(27, 1, 27, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In a nutshell, it is situated sex that uncovers the reality of life diversity. It is the best indicator of the richness of the lives of people. This, actually, raises a very crucial question: How could people coexist if the possibilities of meeting a partner, who has almost similar situated sex, are at a minimum? Indeed, this issue is like a game of dice for it raises a question about the identity of that human being who can adapt to another creature who has slight resemblance to, with a minimum probability.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Such questions require writing another book to be answered in full and to be given the proper attention. Be sure, dear reader, you are not going to wait for long to dive into the deep ocean of self-knowledge and pick the jewels you have always dreamt of obtaining. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">* * * * *</span></span></span></span></p>');
INSERT INTO `app_book_page` (`bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`) VALUES
(28, 1, 28, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Are Hormones and Conflicts Related?</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Although love and conflict have to do with affection, feelings and mind, we must always remember that there are chemical, physiological and hormonal factors which could be signs or indicators that might lead us to understand how human relationships work.&nbsp;&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Once we understand this chemical hormonal factor in human relationships, we can, at a later stage, use it to control our hormones so as to actually lay the bases for a better life. Such understanding would act as if it were a paved road or a ploughed land that would render abundance of fruits. In fact, understanding the role of this chemical hormonal factor will help create a different situation between male and female.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Understanding the conflict between male and female would help them drain, decrease or narrow this conflict down. This can certainly be a result of dealing with hormones either positively or negatively.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There is no direct linear relation between hormones and human behavior. However, if this relation is considered to be related to different factors, hormones, herein, play a vital role. We can, at least, deal with one factor; therefore, we can develop a more positive behavior between the male and female so as to make understanding the problem easier.&nbsp; </span></span></p>'),
(29, 1, 29, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">This gives the opportunity to deal with other factors such as the nature of thinking, feelings and convictions. It enables us, as well, to develop a positive relationship with the other. But, if we fail in dealing with them, the relationship will turn into a negative state.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In this regard, we can say that some specialized glands secrete those hormones which flow in our blood and act as lubricants, metaphorically speaking, or incentives for our lives.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Cholesterol and adrenaline, for instance, are hormones secreted by the suprarenal gland and they have extremely important functions. The Adrenaline, accompanied by cholesterol, provides the body with a high level of energy for raising the ability of self-defense. Thus, those hormones are released at moments of fury, fear, or facing awkward situations. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">As soon as cholesterol and adrenaline are produced, the body stops, delays or decreases the usual functions of some parts to a minimum. </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When we are scared, alert, angry, or ready to fight, we do not feel hungry, but this is not always good. Although those hormones help us face and adapt to a variety of difficult situations, they damage our immunity and digestion systems because they are not supposed to last forever, and so is love.</span></span></span></span></p>'),
(30, 1, 30, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Even when we undergo long periods of (psychological) pressure or when we come into collision with our partners, we find that the hormones which increased at the beginning to address the problem or tragedy soon decreased because their existence is illogical; i.e., the continuous secretion of such hormones is not reasonable at all, on the one hand. On the other hand, their existence in blood is likely to cause unbearable states that could be regarded as serious or excessive, such as tension, anxiety and high blood pressure. Such states lead to what we metaphorically call &quot;cocooning&quot; where one indulges themselves with their problems to the extent of addiction or danger. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;<span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Gradually the body starts to give up, for the glands cannot continue to produce such hormones if the problematic situation, the state of danger which a person is undergoing or the conflict between male and female continues.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We all know that hormones affect the sugar rates in blood and make them unstable. This also affects one&#39;s temperament that will often be mercurial. In such a case, there will be two different effects on both sexes due to the secretion of cholesterol and adrenaline. One of them manifests in the male&rsquo;s tendency to neglect his female. This will result in the subsidence of his emotional and sexual&nbsp; desire; a situation that makes the female start to get tired of those hormones, so she, or rather her body, tries to get rid of them as soon as possible. It should be noted that in the case of females, this process of hormone ridding takes a shorter time than in the case of males. But, in the course of time, the female gets overwhelmed by the feeling that the male does not care for her till she falls a victim for acute frustration. </span></span></span></span></p>'),
(31, 1, 31, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is noticeable that rise in the cholesterol rates soon shows on the female&#39;s body; it, very rapidly, accumulates fat in her body and she will clearly be overweight especially if she is suffering from tension or is in a state of disharmony with her partner. This state is quite similar to the state of the female who undergoes the menopause where she produces weak estrogen that comes to be stored as fat. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">As time goes by, the female&#39;s weight increases, she feels dissatisfied with her body and she soon gets into what could be called as &quot;<strong><em>a bad circle</em></strong>&quot;. Therefore, she begins to suffer from anxiety, on the one hand, and from her male&#39;s inattention, on the other hand. This accumulates more fat and aggravates her worry over her body that is no longer the body she used to have; a situation that gives her the feeling that she will not be accepted by her male anymore and will, again, have a negative impact on her.</span></span></span></span></p>\r\n\r\n<div style=\"border:double windowtext 4.5pt; padding:1.0pt 4.0pt 1.0pt 0in\">\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Tension&nbsp;&nbsp;&nbsp;&nbsp; &rarr;&nbsp;&nbsp;&nbsp;&nbsp; Anxiety&nbsp;&nbsp;&nbsp;&nbsp; &rarr;&nbsp;&nbsp;&nbsp;&nbsp; male&#39;s carelessness</span></strong></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&uarr;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></strong><strong><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&darr;</span></strong></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Cholesterol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &larr;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; obesity</span></strong></span></span></p>\r\n</div>'),
(32, 1, 32, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Adrenaline and cholesterol stir up the release of insulin which rouses the stomach to demand more food. In this case, we have either of two possibilities: either a rise in sugar rates which results in diabetes or gaining more weight. It is worth mentioning here that anxiety badly affects the body and leads to diabetes. There are other possibilities that manifest in having a range of ailments caused by the over-rise of cholesterol, adrenaline and insulin.&nbsp;&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The conflict between male and female leads to a number of health problems and their consequences such as indulging and enveloping oneself in a circle of conflicts, illnesses and hopeless cases. </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We have to learn that the conflict between the male and female lies in the fact that they have different body reactions when they experience the severe stings of conflict.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When in conflict, females&#39; bodies release quite big amounts of cholesterol while males&#39; bodies release much fewer amounts. Cholesterol rise in the female&#39;s body soon burns carbohydrates instead of fat, thus lactic acid results and makes the female feel tiredness and fatigue because muscles quickly get affected. This case is like what one feels when they do not practice sports continuously. So, production of lactic acid makes them feel extremely sore muscles. The female goes through the experience of producing lactic acid which renders dire consequences. This process gradually, yet quickly, destroys calcium in the body and results in osteoporosis. That is why 80&ndash;90% of those who suffer from osteoporosis are females.&nbsp;&nbsp; </span></span></span></span></p>'),
(33, 1, 33, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Contrariwise, when the testosterone levels go up in the male&#39;s body, he begins to regain his interest in the female who becomes happier and more serene, and she gets more attracted to her partner.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The equation, then, is that simple: in case of love and attraction, bodies of each of the male and female, secrete a special hormone which in turn motivates the hormone of the other. </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">At the beginning, testosterone stimulates </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">oxytocin in the female&#39;s body, and the oxytocin motivates the female to feel her femininity and her male&#39;s care. In response, the female sends the male a positive sensation of interaction, so testosterone levels increase in his body, and they both get into a positive circle. Anyhow, you have to bear in mind, dear reader, that it is the male who should take the initiative, in the first place.&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When conflict breaks out between male and female, testosterone levels go down in the male&#39;s body, thus he loses interest in his female. It is good to know that a male can actually show care for his female when he is in a state of high concentration on her or if he is not in a state of mental distraction. However, as soon as the female feels the male&#39;s care, she shows him similar care. In fact, both of them motivate the other&#39;s hormones.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp; </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When the male stops caring for his female because of business or nuisance resulting from conflict with her, he will have low testosterone levels and she will have low oxytocin levels. They will, consequently, get back to the bad (vicious) circle we have already talked about. </span></span></span></span></p>'),
(34, 1, 34, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When the female feels neglected, she starts to make life unpleasant as an expression of resentment which again decreases testosterone in her male&#39;s body. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Success in life, work, love, etc, increases the production of testosterone in the male&#39;s body, but as for those who did not achieve success in their lives, they suffer from low testosterone levels. That is why depressed men do not think of sex nor do women. In addition, they usually suffer from the lack of the masculinity hormone; i.e., testosterone. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We also notice that businessmen who orbit the world of money, those who work day and night, or those who work in politics do not, any longer, care for the female because the testosterone levels have decreased in their bodies.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>'),
(35, 1, 35, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Therefore, the male and female, definitely, need a weekly, perhaps a monthly, or, certainly, a yearly vacation in order to reproduce these hormones in a better and more positive way.&nbsp;&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is worth mentioning here that the hormone of masculinity increases at the beginning of the day. However, the male consumes it during daytime work. After sunset, the male feels he no longer has sufficient hormones to communicate love. In fact, this is the very time at which the female needs serious care and stimulation of oxytocin in her body.&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When the sexual intercourse comes in the evening after a hectic day, it will not match aspirations. Sometimes it seems to be routinous and it lacks the sufficient stimulation of oxytocin that adds splendor and beauty to this relationship as well as more estrogen in the male&#39;s body. Thus, routine, depression, boredom and monotony dominate lives of the male and female. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Low testosterone levels manifest in many cases like: fidgety, fury, fluctuating temperament, inattention and carelessness. The male feels that he needs attention to get motivated, therefore, he demands his female partner to care and look after him. He wants her to be his mother at this moment. The female, very often, refrains from giving him anything because she waits for him to start caring for her so as to return it (times doubled). Unfortunately, such a case makes conflict aggravates.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>'),
(36, 1, 36, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">What is worse is the negative interpretations the female raises concerning the above situation. She thinks her male is betraying her with another female and that he does not love her any more to the extent that hatred has started to penetrate his heart, or she no longer enjoys charming femininity that can attract or arouse him. Or, she might think she does not, any longer, occupies the top of his interests. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">All these facts will soon be converted into depression, anger, a desire to react against the male and extreme objection against his carelessness. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We should always remember that oxytocin is produced in the female&#39;s body in all emotional states; whether in the state of love or touch. In times of relaxation, rubbing or massage produces significant amounts of oxytocin in her body. In addition, oxytocin is produced when she breastfeeds her baby because this brings her closer to the new creature who came to fill her life. If the hormone of masculinity arouses energy, then this significant hormone &ndash; in her body &ndash; urges her relax and causes decrease of blood pressure. It also produces cholesterol reducers. This gradually makes the female go through a state of calm and tranquility. Nonetheless, this sometimes makes her feel afraid.&nbsp; </span></span></p>'),
(37, 1, 37, NULL, '<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Oxytocin is also produced in the male&#39;s body. Nevertheless, what incites more oxytocin efficiency in the female&#39;s body is the hormone of femininity, i.e. estrogen which improves oxytocin function and has a different </span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">mechanism for the interaction between testosterone and oxytocin in the male&#39;s body. While testosterone functions in a dissimilar way to what oxytocin produces, estrogen and testosterone interact positively, in a completely different way to the testosterone and oxytocin interaction. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">You have to bear in mind that production of oxytocin in the male&#39;s body negatively affects production of testosterone. This means when the male enjoys relaxation through massage done by his female, testosterone decreases in his body. However, massage and any other stimulus of oxytocin in the female&#39;s body interact positively with estrogen and arouse her desire and her emotional and sexual interaction with the male. Isn&#39;t it surprising?!</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The woman who suffers from hormonal malfunction produces really big amounts of testosterone - which is contrary to the nature of her body or does not get along with the general acceptance average among females, especially the aggressive ones - affects oxytocin in her body intensely and negatively. Therefore, we find that the female whose body produces testosterone is always prone to nervousness, agitation and outburst at any moment. This very situation afflicts a female when she nears the menstruation where she experiences a sharp decrease of estrogen and a relative increase of testosterone. </span></span></p>'),
(38, 1, 38, NULL, '<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">At this period of time, testosterone levels become actually higher than estrogen, hence, the female will not be able to enjoy a positive temper; rather, she will </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">be edgy and on the verge of agitation and outburst. In fact, a female is not very often positive at such a time.</span></span></p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">No matter how positive testosterone in the male&#39;s body is, it might soon turn a male into a state of aggressiveness. Likewise, if testosterone increases a little in a female&#39;s body, it arouses her sexual desire; however, if it rises a lot, it will negatively interact with oxytocin. Consequently, this affects the nature and performance of the female and both; the male and female, will get into a vicious circle again.</span></span></p>\r\n\r\n<p>&nbsp;</p>'),
(39, 1, 39, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The couple has to go together on vacation so as to escape work pressure. If they cannot, they can resort to fun, laughter, joking and positive activities such as: doing sports or watching comedy movies. They can also do some daily participational activities like playing cards, or they can visit friends (together or individually) for a couple of hours. This, beyond doubt, helps them get into a state of longing and wanting one another.&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The problem in the hormonal equation - between the male and female - lies in the fact that the testosterone levels in the male&#39;s body have to be high so as to start to care for the female. The female, on the other hand, needs the oxytocin stimulation as to return the male&rsquo;s care times doubled. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is strange enough to know that a stressed male tends to make love so as to lessen his tension which is accompanied by adrenaline, cholesterol and testosterone. In fact, he needs a sexual discharge to attain balance.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The female, on the other hand, cannot make love unless the oxytocin rate is high. In other words, she needs to feel she is a female and to be exposed to care and sexual arousal in order to practice love.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There is a type of women who can have sex even when they are stressed. These are the nymphomaniac women who I elaborated on in my book &quot;How a Female Thinks&quot;.</span></span></p>'),
(40, 1, 40, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We have to bear in mind the fact that the orgasm raises oxytocin, but it, temporarily, reduces the testosterone levels in the male&#39;s body. Therefore, a female would enjoy a temporary leave from desire, and she would rest after reaching the climax. BUT, her desire will not come to an end like the male. Nonetheless, there is a type of women who feel that whenever they reach the orgasm, they need more sex due to the high rates of testosterone in their bodies which rouse more desire and, consequently, more oxytocin which in turn reduces testosterone. Indeed, it is a highly complicated equation of interaction. This type of women, however, needs a special care and a special untraditional way of dealing. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">As for the male, whenever he reaches his climax, testosterone levels decrease and his body releases oxytocin; a case that urges him to go to sleep soon after the elapse of this moment of intimacy. This situation affects the female almost negatively because after reaching the orgasm, she feels she is more in need for her male who hastens to fly away seeking rest. This means that the male has to know his female&#39;s sexual nature. He should not make love with her unless she is nymphomaniac or one who demands having sex at any time, even in times of pressure.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">* * * * *</span></span></span></span></p>'),
(41, 1, 41, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Who Can Do What</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Women have a better memory than men with regard to the word they hear. The importance of this fact appears clearly through their heated arguments.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Rates of blood flow increase in certain places of cerebrum. Such places include those controlling language. This is one of the reasons researchers show as a conclusive proof of women having better capability of immediate recalling as well as instant and long distance recollection of the transmitted word.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Among other reasons that prove the sharpness of woman&#39;s memory is her higher rates of concentrated estrogen. Men also have estrogen but in small amounts. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Testosterone is an important element in the formation of estrogen. There is an enzyme called &quot;aromatase&quot; that changes testosterone into estrogen&nbsp;inside the cells. Paradoxwise, the highest rate of estrogen is found in the protoplasmic cell of the cerebrum of a male fetus, and is responsible for giving masculine qualities to his cerebrum. </span></span></p>'),
(42, 1, 42, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There is evidence that estrogen activates many neurons, increases blood flow to certain areas in the cerebrum and builds up complicated links between neurons. Moreover, high levels of estrogen are associated with the improvement of learning skills and memory. It could be the reason why women excel at such tasks.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It should be noted that estrogen is a key element in the recently discovered fact that says: &quot;Women better recall painful events than men.&quot;</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is worth mentioning here that women find it easy to communicate verbally. They have richness and abundance in using words and expressions. Most studies show that women outmatch men at using language, in addition to their ability to speak easily and fluently. Compared to men, women not only use more words but also more diverse words and more accurate and meaningful facial expressions.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">As far as seeing is concerned, males are better at seeing at a distance and estimating depths whereas females are better at side vision. Males can see better in bright light whereas females are more efficient at seeing at night. Females are also more sensitive towards ranges of the red colour than males. They also enjoy a better visual memory and better perception of the meanings of facial expressions and context, let alone that they show&nbsp;more capability at recognizing faces and remembering names.</span></span></p>'),
(43, 1, 43, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The centre of the ability to estimate places reveals serious differences between males and females. The ability of estimating distances is located in the frontal right part of the cerebrum, but this centre is not well- recognized in the case of women. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Professor Ruben Gur, a neurophysiologist from the USA, Pennsylvania, has proved that the electric currents in men&#39;s brains decrease to 70% in the state of relaxation, and 90% in the case of women experiencing the same state. This is because women receive information from the environment and analyze it continuously.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">One of the major reasons for the abovementioned is that there are 130 million needle-like cells called &quot;vision receptors&quot;, and 7 million pin-like cells. However, females&#39; eyes are different from males&#39; eyes. Women can see in a more obtuse angle than men. The more the eyes receive estrogen during the formulation of the eye while being an&nbsp;embryo, the wider the peripheral vision becomes. That is why the female cannot deal with spatial dimensions in the same way a male does, but she can see everything as regards details or things she is indirectly looking at. So, the eye and brain nature which were formed when she was an embryo makes her relation with space completely different from that of the male. </span></span></p>'),
(44, 1, 44, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In other words, women cannot deal with spatial dimensions the same way men can, but they can see the very details of everything or things that are not in the exact direction of sight. The eye and the embryonic nature of the cerebrum make the relationship with place a completely different one.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There is strong evidence that men and women deal with issues related to place in different ways. For instance, Dr. Maraianne Legato says that they have examined the way by which men and women can find their way accurately through an experiment conducted in Canada. They used a real labyrinth. Men and women not only activated completely diffident parts of the brain to deal with problems of place, but they used different strategies to find a way out. Women made use of the outstanding features of the place to know the right way&nbsp;</span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">while men used &quot;the Euclidean information&quot;; i.e., trying to imagine their places inside the design to get out of it.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Researchers found out that if any of the two sexes followed the strategies of the other to find their way out, both of them would do that inefficiently. Researchers concluded that there were real differences between the two sexes when it came to dealing with spatial issues.</span></span></span></span></p>'),
(45, 1, 45, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is important to note that both men and women activate a section from the right part of the cerebrum. Men also get the aid of a section from the left part of the cerebrum to solve spatial problems whereas women do not. For example, unlike women, men have a better ability to imagine the shape of a thing in a two or three-dimensional space. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp; </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Karren Christian and Rainer Kinsman; professors at Hamburg University, Germany, said that the high levels of testosterone in men were related to their excellence at spatial problems. However, those levels were related to their low ability in verbal expression which women excelled at.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>'),
(46, 1, 46, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">According to Alan and Barbra Pease, there is true evidence that the place-analysis ability inside the brain since birth results from a peculiar hormone for both sexes that is secreted during growing up. Little girls who have excessive secretion of the suprarenal gland suffer from high levels of male hormones. Those girls look manlike, even when born to the extent that their genitals are mistakenly thought to be male&#39;s genitals. They prefer tough games and they are possibly sexually attracted to women more than those who do not have this disorder. They also have a better ability to deal with spatial problems.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The evidence is better clarified by studies of Alan and Barbra Pease in an appreciated way. It also meets our vision and analysis of the mechanism of the activity of the two hemispheres of the cerebrum. It was proved that in the case of boy-girl twins, the girl benefited from the extra dose of testosterone from her brother. For instance, she had a high ability to imagine the three dimensions when compared to her non-twin sisters.&nbsp; That could explain her notable use of the left part of the cerebrum. She and girls of the like were sometimes seen driving in a way similar to the way of men as far as spatial recognition was concerned.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Alan and Barbra Pease say that Dr. Camilla Benbtow; a professor of psychology in Urea University, USA,</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">scanned images for the brain of more than a million boy and girl so as to study the mechanism of spatial visualization. She </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">discovered that differences between sexes were very clear starting from the age of four. </span></span></p>'),
(47, 1, 47, NULL, '<p>Girls&nbsp;<span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">could understand the two dimensional pictures in an excellent way, while boys could do that in addition to recognizing the third dimension or the depth. Using video, the test showed that boys outmatched girls four times. It was not surprising that the worst boys excelled the best girls. This characteristic is located in many places in the brain. It is located in four places at least, in the frontal side of the right part. Women do not have special locations for this characteristic, so they have fewer skills in this regard. That is why they do not like jobs that need this skill and they do not have hobbies related to place image, unlike men who choose jobs and sports where the </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">place skill is a must.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The right hemispheres of boys&#39; cerebrums grow more rapidly than the left ones. The neurological connections in the right parts are ready </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">before those going to the left parts and they are bigger in number. Girls&#39; cerebral hemispheres, on the other hand, grow at the same rates. That is why they have more skills than boys. They have more neurological connections between the two hemispheres. This means that the corpus callosum is thicker. Because of this, we find more right and left-handed girls at the same time than boys, but those girls have a difficulty in distinguishing between the </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">two hands instantly. Testosterone hampers the growth of the left part of males&#39; cerebrum, but it helps the right part grow in a faster and better way. This makes the ability of comprehending space develop strongly.</span></span></p>'),
(48, 1, 48, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Studies conducted on boys and girls between five and eighteen showed that the boys were much more able to hit a target or to point to a beam of light and to redraw an ornament depending on memory as if they followed the lines they had in their imagination. They also had a better ability to join separate parts in three-dimensional groups and to solve math problems. All those skills, in 80% of males, were located in the right hemisphere of the cerebrum, according to the studies.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The American scientist Dr. D. Wechsler developed a group of IQ (intelligence quotient) tests in which he avoided fields where excellence was related to sex. The study was conducted on people from different levels of education, including primitive societies. He could reach the same result reached by some other independent researchers. Dr. D. Wechsler said that the IQ of women was 3% higher than men despite the fact that women&#39;s brains were a bit smaller. But, when labyrinth was the test, men, regardless of their education, got 92% of the correct answers; women got the remaining 8%. </span></span></span></span></p>');
INSERT INTO `app_book_page` (`bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`) VALUES
(49, 1, 49, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Know Your Partner&rsquo;s Representative System &hellip; Deal Accordingly</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">If you want to know how to deal with a partner, you ought to discover their system first. A person may be visual, auditory, olfactory or kinesthetic. There are special characteristics and attributes of each type. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A visual person</span></span></em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> speaks fast and loudly and breathes quickly. They are always active and energetic and their decisions are based on what they personally see or visualize. Thus, their use of language would be specific. They use photographic language such as: &ldquo;I am in the picture now&rdquo; or &ldquo;Let us envision the whole issue&rdquo;. They use utterances like: &ldquo;I see&rdquo;,&rdquo; I notice&rdquo;, &ldquo;clear&rdquo;, &ldquo;imagine&rdquo;, &ldquo;landscape&rdquo;, &ldquo;shape&rdquo;&hellip;etc. They, through their life experiences, show more interest in views and sceneries than in sounds or sensations. When they stand, they go a bit backward with their head and shoulders upward. And if they want to recall something from the memory, they look over their eye level.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">You can also detect a person&rsquo;s modality through his/her eyes and expressions. Hence, when a visual person answers a question which answer is ready in their memory, their eyes will move upward then leftward to remember the piece of information required. </span></span></p>'),
(50, 1, 50, NULL, '<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When you </span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">ask them what colour their car is, their eyes will move upward then leftward. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">However, when you ask them a question that requires some thinking, you will see their eyes moving upward then rightward to visualize the image. For instance, when you ask a visual person to visualize a winged dog, they will form an image of it since this piece of information does not exist in their memory. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A visual person talking to themselves; i.e., having an internal monologue, does not move their eyes at all. They may be looking in your direction but not looking at you. They will be searching for an internal image (either by visualizing it or recalling it).</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">An auditory person</span></span></em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> uses different sound pitches in one conversation. They breathe comfortably and they have great ability of communicating with others without interrupting them. They show more interest in sounds than in sights and sensations of an experience or incident. Their decisions are made according to what they hear and according to their own analysis of the situation. They say things as: &ldquo;I listen to what you say&rdquo;, &ldquo;these words sound </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">good&rdquo; and &ldquo;I hear&rdquo;. They also use such concepts as &ldquo;rhythm&rdquo;, &ldquo;music&rdquo;, &ldquo;silence&rdquo;, &ldquo;accent&rdquo;, &ldquo;sound&rdquo;... etc. When they stand, they lean a bit forward with their head rightward or leftward and their shoulders back. However, when they want to recall something, they look straight ahead towards the horizon. </span></span></span></span></p>'),
(51, 1, 51, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When you ask an auditory person who already has an answer for your question, their eyes will move leftward then forward on the ear level, and then they remember the sound. Thus, when asking an auditory girl to talk about her favorite song, her eyes stay in the same level but they move leftward. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Upon asking an auditory person about something they do not have a ready answer for, their eyes stay at the same level but move rightward to imagine and create new sounds. When you say to your auditory friend that their car sounds like barking, they will create auditory images since this piece of information is not available in their memory. Their eyesight will stay at the same level but move rightward.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">An auditory person talking to themselves will look downward then leftward. If your auditory friend wants to quit their job and are thinking of a way of doing that, their eyes will move downward then leftward.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A kinesthetic person, however, is usually quiet and speaks in a low voice. They breathe slowly and give more attention to feelings and sensations than sounds or images. Therefore, we notice that their decisions are sensation-based. Others can affect their sensations, consequently, their decisions. They stand with their head forward and shoulders downward. And when they use their imagination, they look down their neck. They use words and phrases such as: &ldquo;We are about to catch the thread that will lead to solving the problem&rdquo;, things are&nbsp;moving smoothly&rdquo;, &ldquo;I feel&rdquo;, &ldquo;I touch&rdquo;, &ldquo;I sense&rdquo;, &ldquo;cold&rdquo;, &ldquo;comfortable&rdquo;, &ldquo;quiet&rdquo;, soft&rdquo;&hellip;etc.</span></span></p>'),
(52, 1, 52, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When you ask a kinesthetic person how they feel when they fall in love with a person, their eyes move downward, then rightward while they are trying to recall this sentiment.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is worth mentioning that recalling is always on the left side and visualization on the right one.&nbsp;</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Having noticed the representative system of others and their linguistic evidence and eye gestures, you realize how they build information in their minds. Hence, you can communicate with them on the same level. This helps you become almost skillful in communicating and helping them solve their problems via hypnosis.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When we come to know that our partner is an auditory person, we realize that speaking is their distinctive means of communication. If they are visual, then seeing is a priority. Therefore, they have to be looked at especially if your partner is a female. The male&#39;s appearance has to be well-approved; i.e., he should not look repugnant. As for a kinesthetic person, touching&nbsp;</span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">their body every now and then triggers their sense of communication. </span></span></span></span></p>'),
(53, 1, 53, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">An olfactory person would like to be hugged, for hugging would make them feel connected. Hugging, then, is a way of communication since it helps an olfactory person communicate through their nose.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Olfactory people have their own chemical-like equations that should be noticed and taken into consideration. There is a reality that cannot be underestimated: &quot;We get attracted to others through our sense of smell.&quot; Hence, different odours have a different impact on us. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Lavender helps us calm and to sleep while pine provides us with energy. But a</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">s regards human odours, recent experiments show that the odour of the husband&#39;s armpit may end his wife&#39;s tension</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> (though this may not be attractive over time). Anyway, females are known that they have a better sense of smell than males, probably because of their high rates of Estrogen.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In fact, every person has their own distinctive odour which acts like a fingerprint. According to some recent studies, newborn babies can distinguish the males from females through their odour; a case that scientists call &quot;odour type&quot;. Thus odours play an effective role in the life of those whom we get attracted to.</span></span></span></span></p>'),
(54, 1, 54, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The abovementioned modalities are interrelated. A person may be all of them. This is determined by the type a person is as a <em>&ldquo;situated knower&rdquo;</em>, i.e. according to the formation of their cerebrum at the mitosis stage. We have to remember that one of the modes of communication with a person, especially a female, is <em>&ldquo;smelling&rdquo;</em> which can even be more important than any other sense. The sense of smell is often related to the kinesthetic type.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">However, all types (visual, auditory, olfactory and kinesthetic) have something in common; they all need to compliment their appearance. To know how to deal with your partner, you can also know about their personality form the colour of clothes they like to wear because every colour has significant effects on people&rsquo;s psychology.</span></span></span></span></p>'),
(55, 1, 55, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">The Polemic State between </span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Males and Females</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">No matter what difficulties we; males and females, face, they aggravate dramatically when we argue. During an argument, the amygdale; the part that controls emotions, is highly activated whereas the frontal cortex, which is the part of the brain responsible for rational thinking and problem solving, is less active at that time. This is the reason why it is difficult to maintain focus on targeted points or talk in a coherent manner. This also applies for women with previous unpleasant experiences similar to the current situation they are undergoing. Women&rsquo;s memories of those situations and arguments are clearer and more detailed in comparison to those of men.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When you are angry, your brain is in a state that is remarkably similar to that of an orgasm (the climax of sexual excitement). That is why people say things that they regret saying after a warm embrace. In both situations, our minds act against our own interests. To put it differently, our emotions at that point are exaggerated and the centre of logical thinking is stalled.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In a state of excessive fury, the brain releases more hormones into the blood stream. One of the differences between males and females is that these levels of hormones return to their normal proportions very slowly&nbsp;as far as females are concerned. </span></span></p>'),
(56, 1, 56, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">While a male calms down quickly, a female finds it difficult to do so. This explains why the male mistakenly thinks the problem has come to an end only to find out that his female has returned to the fighting square with new creative reasons for arguing.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Researcher J. Carter believes that when a person is tense (whether the reason of this tension is psychological or organic, as in the case of injury or illness), the body secretes a number of hormones. For instance, our bodies produce <em>&ldquo;adrenaline&rdquo;</em>; the attack-and-retreat hormone, that affects our perception, therefore we feel estranged from our surrounding circumstances. To us, everything seems to happen at a slow pace. At the same time, when blood pressure increases to the utmost level, we feel strong heartbeats within the chest followed by shallow and rapid breathing, and then our senses become sharper. This explains why when we are exposed to a distinctive smell or provoking colour, our brain displays a mental image of a previous experience that we had when we were very tense.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Our bodies also produce a hormone called <em>&ldquo;cortisol&rdquo;</em>, known to everyone by the name: <em>&ldquo;tension hormone&rdquo;</em>. One of the basic functions of cortisol is to regulate blood sugar. </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When secreted at the times of tension, it stimulates the body to pump more energy into the blood stream. At the same time, it stimulates the cells to consume the minimal amount of it. This clearly indicates what important role the cortisol plays in regulating blood sugar rates in certain&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">While a male calms down quickly, a female finds it difficult to do so. This explains why the male mistakenly thinks the problem has come to an end only to find out that his female has returned to the fighting square with new creative reasons for arguing.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Researcher J. Carter believes that when a person is tense (whether the reason of this tension is psychological or organic, as in the case of injury or illness), the body secretes a number of hormones. For instance, our bodies produce <em>&ldquo;adrenaline&rdquo;</em>; the attack-and-retreat hormone, that affects our perception, therefore we feel estranged from our surrounding circumstances. To us, everything seems to happen at a slow pace. At the same time, when blood pressure increases to the utmost level, we feel strong heartbeats within the chest followed by shallow and rapid breathing, and then our senses become sharper. This explains why when we are exposed to a distinctive smell or provoking colour, our brain displays a mental image of a previous experience that we had when we were very tense.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Our bodies also produce a hormone called <em>&ldquo;cortisol&rdquo;</em>, known to everyone by the name: <em>&ldquo;tension hormone&rdquo;</em>. One of the basic functions of cortisol is to regulate blood sugar. </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When secreted at the times of tension, it stimulates the body to pump more energy into the blood stream. At the same time, it stimulates the cells to consume the minimal amount of it. This clearly indicates what important role the cortisol plays in regulating blood sugar rates in certain </span></span></p>'),
(57, 1, 57, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Researcher J. Carter noticed that low rates of cortisol are very useful for the body since they help increase the body&rsquo;s efficiency in facing the danger of the tension causes. However, high rates of cortisol secreted when exposed to constant tension have a devastating effect on the cells of the immune system because the high rates hinder cells from effectively performing their functions, weaken the immune system in general and make our bodies more vulnerable to contagious diseases. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&quot;Ohio State&quot; University researchers have found out that the causes of tension such as approach of exam time can cause a delay in the healing process of the wounds that appear on the mouths of students. As for the women who undergo a relative suffering from Alzheimer, they do not recover from an illness as quickly as women of the same age and who have never gone through the same experience.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The fact that we are more vulnerable to diseases when we shoulder a heavier burden than we can handle is not something illusionary because our exhausted immune system fails to take on the additional task of fighting a virus or contagious disease.</span></span></span></span></p>'),
(58, 1, 58, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Tonsilla cerebelli controls the secretion of adrenaline, cortisol and all the other chemical elements released by the cerebrum under the influence of tension. It is one of the old systems that exist in the cerebrum, and that are necessary for our survival. It is a part of the cerebrum that consists of a cluster of nut-shaped cells located at the bottom of the cerebrum. It helps us in the process of storing emotionally-charged experiences in order to become part of the memory so that we can take a decision of escaping or defending ourselves in a proper way when the same accident happens once again. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> cornu anmonis; <em>&ldquo;hippocampus&rdquo;,</em></span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> organizes a system composed of a number of nerve cells, thus forming a closed circuit that contains memories of an experience within our minds. In other words, the tonsilla cerebelli helps us perform a complex series of calculations that determine whether we feel frightened or not and what we should do in case of fear.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Women&#39;s bodies produce higher levels of cortisol than men&rsquo;s bodies when subjected to tension which may last for long periods. Progesterone does not allow cortisol to stop carrying out tasks. Since cortisol helps to enhance the process of learning and memory formation, its high levels mean that women are not only affected very deeply by unpleasant events, but also remember them vividly. Contrarywise, the testosterone; hormone of masculinity, hinders the effect of cortisol.</span></span></p>'),
(59, 1, 59, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Cortisol is a catalyst in the formation of unpleasant events memory. Tonsilla cerebelli is the other factor responsible for this formation because it is the centre that controls the feelings of fear. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Researchers have come up with an interesting dissimilarity between the two sexes. During the formation of the emotionally charged memories, men use only the right section of their tonsilla cerebelli whereas women use the left section of it. Each of the two sexes uses different areas of the tonsilla cerebelli to affect the memory.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Women exercise the areas connected to other centres of the cerebrum such as the optical subthalamus and the brain stem. The brain stem controls the respiratory system and the rate of heartbeat. Therefore, this regular movement in particular can explain why women are more responsive to emotionally charged memories. Men, on the other hand, exercise an area of the tonsilla cerebelli connected to recognition centres that are found in the upper parts of the </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">cerebrum</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">. This means that men can substantiate for more <em>&quot;rational&quot;</em> responses which depend on finding a solution to the challenge they face.</span></span></span></span></p>'),
(60, 1, 60, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Despite the fact that women are the most vulnerable to tension which can lead to depression, they are far better than men when it comes to gaining back their psychological health after tension. This may be attributed to the fact that women are relatively stronger than men as far as enduring tension or anxiety is concerned because their frontal lobe contains a high percentage of gray matter in their</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> cerebrum</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> compared to men. This gives women an extra &ldquo;cushion&rdquo; or &ldquo;pillow&rdquo; of cells to protect them. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Moreover, estrogen functions as a neutral factor that reduces the harmful effect of a large number of tension causes on the nerve cells. That may help us know why illnesses such as schizophrenia begin to develop at a late stage of women&rsquo;s life compared to men, why women&rsquo;s response to low doses of antidepressant drugs is faster than men&#39;s, and why the side effects of these drugs are different. Perhaps this also explains why women retain most of their mental functions and capabilities with age.</span></span></span></span></p>'),
(61, 1, 61, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Women make use of completely different mechanisms to cope with tension. It is well known that men &quot;isolate themselves from others&quot; and, as a result, they suffer from a higher percentage of disorders that accompany tension like high blood pressure and addiction to alcohol or drugs. In contrast, women respond to tension by trying to communicate with others, especially with other women, hence, they make relationships through which they can talk about the problems they face and seek help. Such a response not only helps them cope with direct threats, but also</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> protects them from the harmful effects of tension in general.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A recent research by Dr. Laura Cousin Klein and her colleague Dr. Shelly Taylor from the University of California, Los Angeles indicates that when tensed, women tend to eliminate their disputes, and initiate conversations with other women whereas men tend to isolate themselves from others. On the other hand, when men find themselves facing danger, they &ldquo;inject&rdquo; their nervous system with all the chemical compounds they need to engage in or escape from a battle (adrenaline, noradrenalin and cortisol). The result is that the pupils of their eyes widen, the rates of respiration increase and blood moves from the digestive system to the arms and legs in case they want to escape. Moreover, the speed of their reflex responses increases, but their sense of pain decreases.</span></span></span></span></p>'),
(62, 1, 62, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Women share men all these responses, but they do not tend to use them. When a woman is subject to tension, the rates of oxytocin increase. This does not only help soothing her, but also motivating her to seek help which takes the form of starting a relationship with others, especially other women where she will have better opportunities in protecting her young child if she can take care of him/her, or if she can get support and assistance in case of violent confrontations. Since it is well-known that testosterone resists the effect of oxytocin, we come to know why men and women have different responses when they encounter a danger or threat. </span></span></span></span></p>'),
(63, 1, 63, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Woman</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">As Situated Sex and Psychology</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Women and Depression</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&nbsp;J. Carter mentions that a statistical study conducted in Britain showed that 7-12 % of men and 20-25 % of women suffer from pathologically diagnosed depression. A second study indicates that out of the nineteen million Americans suffering from depression, twelve million are women. Both Dr. Angst and Dr. Weismann, independently, say that the tendency of women to suffer from depression us a real thing and has a biological basis. Women are also subject to experiencing depression in a totally different manner; they feel depressed at a young age, suffer from tension and complain of many physical symptoms such as exhaustion, loss of appetite and sleep disorders.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Depression Drives</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:left\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">According to the biological, unilateral and reductive method of G. Carter, there is evidence that depression can be attributed to genetic factors. Dr. Casby and his colleagues at &quot;King&quot; University, London publicized the&nbsp;</span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">discovery they arrived at. The discovery shows there is a certain gene that has two different forms; &quot;long&quot; and &quot;short&quot;. Persons who hold the short form are the most susceptible to depression. Dr. George. S. Zubenko and his colleagues from the University of Pittsburgh, Pennsylvania note that there are at least nine locations within our chromosomes that affect our susceptibility to depression. Many of them are related to the likelihood of women to have depression more than men.</span></span></span></span></p>'),
(64, 1, 64, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The genes responsible for granting us our distinctive sex control the release of hormones that continue to give us the sexual characteristics of the sex we belong to throughout our lives whether we are males or females. For example, chromosome &quot;y&quot; that exists only in males, &quot;orders&quot; the body to form the testicles which in turn produce the testosterone and the other masculine hormones, then the fetus changes into a small boy.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Fluctuation of the rates of hormones may be the key to find out the reasons behind the widespread depression cases that inflict on women compared to men. There are convincing evidences that link depression to the hormone rate fluctuation. When we observe women at certain times of their life, we notice that they are more susceptible to depression shortly before menstruation and after giving birth.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Because the fluctuation of hormone levels is a special nature of females, depression is common among females unlike males whose hormone levels are semi-stable in most times of their lives.</span></span></span></span></p>'),
(65, 1, 65, NULL, '<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Pre-Menstrual Syndrome</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">J. Carter notes that one outcome of this monthly periodic continual pattern (the menstruation) is the occurrence of pre-menstrual syndrome. Shortly before menstruation, the estrogen concentration is at its lowest levels, and the levels of serotonin</span></span><a href=\"#_ftn1\" name=\"_ftnref1\" title=\"\"><span style=\"font-size:13.0pt\"><span style=\"font-family:Symbol\">*</span></span></a><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> in the cerebrum are also low. It should be noted that the low levels of both estrogen and serotonin are related to depression.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Many women (almost 75%) suffer from a number of undesired psychological, physiological and behavioral symptoms in the days preceding menstruation. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Severe symptoms that affect a small percentage of women (ranging between 2% - 8%) are classified by the psychiatrists&rsquo; reference: <em>&quot;Diagnostic and Statistical Manual of Mental Disorder&quot;</em>, 4<sup>th</sup> edition, as having a real psychological disorder called Premenstrual Dysphoric Disorder or (PMDD). Women who suffer from (PMDD) are more likely to suffer from depression throughout their lives and are even more vulnerable to the risk of post-natal depression. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Many women especially those who are expectant mothers might get surprised of the emotional setbacks they undergo during pregnancy. Hormones certainly play a significant role in the depression that accompanies pregnancy. The first and the last three months of pregnancy are the periods in which women are more vulnerable to depression and are also the periods in which the hormone levels become unstable. </span></span></p>\r\n\r\n<div>&nbsp;\r\n<hr />\r\n<div id=\"ftn1\">\r\n<p style=\"text-align:left\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><a href=\"#_ftnref1\" name=\"_ftn1\" title=\"\"><span style=\"font-family:Symbol\">*</span></a> . Serorotnin is one neuro-conductor that helps stabilize the mood.</span></span></p>\r\n</div>\r\n</div>'),
(66, 1, 66, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In the first three months of pregnancy, we notice some symptoms that include: sleep disorders, loss of appetite, mood swings, excessive sense of fatigue, and frigidity in addition to anxiety over the changes that will take place in a woman&rsquo;s life. All these things may play a role in increasing the sense of anxiety and depression. In the last three months of pregnancy, many women begin to feel seriously worried of the long-awaited birth process and of the difficulties that accompany it. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Natal Depression</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">J. Carter states that extreme changes of the hormone levels occur at this particular time; i.e., after birth. In the first week after birth, the estrogen levels reduce severely. Since estrogen is the hormone responsible for organizing the tasks of the neuro-conductors in the cerebrum, it may cause a sudden drop in the accomplishment of this task that is responsible for the psychological state control. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In severe cases of post-natal depression, the mother that has recently given birth to a child may suffer from psychosis and is twenty times more at risk of undergoing&nbsp;</span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">depression in the first month after giving birth than at any other time of her life. </span></span></span></span></p>'),
(67, 1, 67, NULL, '<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Menopause</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">At this stage of a woman&rsquo;s life, hormones also play an active role. During the period preceding the actual cease of the menstruation, a woman is subject to periods of sharp rise and fall in the levels of hormones which make the regular ovulation process become unstable or irregular. This increases the levels of estrogen and progesterone. In other months, the pituitary gland secretes the ovulation stimulant hormone several times, however, this does not lead to ovulation and the hormones levels drop once again. </span></span></p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Since estrogen closely relates to the </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">efficiency </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">of the </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">cerebrum </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">in performing its functions, any decrease in its levels will surely lead to a serious effect. During menopause, some female patients&rsquo; thinking ability weakens evidently. One of them calls that <em>&quot;the perplexed mind&quot;</em>. They are so perplexed to the extent that they are convinced they are on their way to lose their minds. </span></span></p>');
INSERT INTO `app_book_page` (`bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`) VALUES
(68, 1, 68, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">They wonder whether it is necessary to have a medical checkup to be reassured that they are not affected by Alzheimer. In this period, they may lose their car keys, glasses or any other thing that does not belong to them and it seems they are not likely to remember names of places or people they have known all their life. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Genes and hormones cause a real difference in the chemistry of the cerebrum of both males and females. They can play an important role in woman&rsquo;s vulnerability to depression. For example, the bodies of men produce serotonin which induces optimism 52% more than women and their blood contains higher levels of serotonin compared to women. This may at least be part of the reason why women get more depressed than men. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Feminine Jealousy</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Jealousy is certainly a subjective act which one projects on him/her self. In fact, it is an act that interrelates to one&#39;s self-estimation or self-image that is preserved in the consciousness and subconscious of both males and females. Jealousy is peculiarly a feminine privilege. It relates to the identity of the female who considers herself as the optimum value of existence and the most important being on earth since she is Eve (Elle). Therefore, she is never lenient when it comes to her identity</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>'),
(69, 1, 69, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In this respect, a female says</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">:</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">&quot;</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">For me, jealousy is the most painful feeling not because I am different from others, but because it seethes none but me. This issue is very critical because I tend to classify jealousy into different categories, yet they all fall under jealousy. I often classify jealousy into positive and negative in order to pacify its impact on me. Nevertheless, I believe I actually deceive myself by such classification since jealousy is nothing else but jealousy. &quot;Whenever I am emotionally attracted to someone, my selfishness erupts. I will, indirectly, strive to become the centre of his attention and to take over his mind so as to guarantee that he is mine; only mine, and no one else will share him with me</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">&quot;.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Unlike jealousy of the masochist female who enjoys her jealousy as a means of self- torture, jealousy, from a psychological point of view, is a representation of an inferiority complex and intense self-disparagement. She expresses that either by silence which will consequently end up with self-decay and self-consumption, or by emotional outrage up to the point of physical violence like breaking dishes, throwing food or self-injury. The aim behind such acts is to vociferously draw the attention to her excessive suffering. Furthermore, some females would resort to verbal violence like lashing insults and undermining their selves or the partner&#39;s self with demeaning words. In such a situation, the female claims she is unable of controlling herself. This is only partly true but still it is inaccurate. It is true that she outbursts emotionally but she deliberately exaggerates these emotions in order to show how great her suffering is. </span></span></p>'),
(70, 1, 70, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">She makes others part of this suffering by extremely hurting them</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Jealousy has a touch of narcissism. Thus, a jealous person has a narcissistic wound. In the case of the female, her own self has transformed from the state of a &quot;master&quot; to that of a &quot;slave&quot;, so she combines the ambivalence of <em>&ldquo;master-slave&rdquo;</em>. And because her narcissism has been badly affected, she has no concerns ever for the feelings of others at the moment of her jealousy outburst</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">To understand the narcissistic aspect of jealousy, we would present it as follows</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">:</span></span></span></span></p>\r\n\r\n<p style=\"text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Narcissism</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&ldquo;Narcissism&rdquo;</span></span></em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> means <em>&ldquo;self-love&rdquo;</em>. The word originates from Narcissus; the well-known flower. It also has roots in Greek mythology which tells about a nymph named <em>&ldquo;Echo&rdquo;</em> who fell in love with young Narcissus and became ill out of her love to him until she withered and died. Her death irritated the Goddess Nemesis, so she punished him by making him fall in love with his own reflection on water. He became totally obsessed with his reflection until he was mentally and psychologically worn out. Then, one day he went into the water to embrace his reflection and got drowned. On the spot of his death, a narcissus flower grew and kept appearing each spring on the water</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">. </span></span></span></span></p>'),
(71, 1, 71, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A narcissist is someone who is emotionally immature. When we are young, we begin with loving ourselves, however, as we grow older, we start to love others and have objective interests other than our own subjective needs and pleasures. But, an immature individual is the one who is psychologically fixated at the primary phase of childhood. His/her activity remains restricted to themselves and consequently their cognitive horizon narrows and that makes them subject to failure and inadequacy. In order to avert such feelings, they disclaim any responsibility, live for themselves and exaggerate their self-estimation so as to compensate their feeling of inadequacy since they are inexperienced and self-centered</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&ldquo;Narcissism&rdquo;</span></span></em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> is different from <em>&quot;egoism&quot;</em>. Egoism is the estimation of people and objects with regard to the value, importance and interest they serve an egocentric person whereas narcissism is self-love. It is even referred to as self-adoration. It should be noted that the sexual element is frequently one of the meanings of narcissism. Krafft Ebing, for example, reports that some patients are not able of masturbating unless they look at themselves in the mirror</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&ldquo;Narcissism&rdquo;</span></span></em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">, however, is different from <em>&quot;egotism&quot;</em> in that the latter is a form of excessive self-estimation and admiration to the extent of bragging and pretentiousness, as it is the case with schizophrenic patients who deify themselves. To put it differently, such people are in love with themselves to the point of idolizing themselves, surrounding their words and deeds with an aura of sacredness and rejecting any kind of criticism or discussion. This is the very meaning of <em>&quot;egotheism&quot;</em> or <em>&ldquo;self-idolization&rdquo;</em>.&nbsp; All of the aforementioned can be embodied in what is called a <em>&quot;narcissistic character&quot;</em>.</span></span></span></span></p>'),
(72, 1, 72, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Narcissists are very much in love with their selves and are extremely self-assured. They are unconsciously deluded by their self-value and superiority. They consider it their right to obtain privileges and to get yet not give. Their philosophy in life is based on the presumption that their desire of something is their justified means to posses it. Moreover, they believe that people are no more than a means that will let them reach their longed-for ends</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> The narcissist female behaves with all the members of her family as if she were their master. She wants them to be exactly the same as any object she possesses.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In making sex, such a female only takes but doesn&#39;t give. She demands her own pleasure but not the pleasure of her partner, thus, rarely does the partner reach his orgasm. Her sexual intercourse with her partner is infrequent because she barely allows herself to reach orgasm. If she desires him, she fulfills her desires regardless of his. Their sexual intercourse lasts to as long as <em>she</em> wants. However, if she tries to let him reach orgasm, it will be only because she wants to prove her sexual superiority and to keep hold of him as part of her own property. Moreover, she only chooses a handsome partner and tries to make him the most elegant man of all because she intends to boast about him. In most cases, narcissists do not enjoy successful marriages</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>'),
(73, 1, 73, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Narcissists also suffer from what is called a narcissistic self-observation; she enjoys exposing her nakedness in public as well as opposite a mirror. In other words, she loves her nakedness to be observed by her and by others. However, this tendency of self-exposition grows within her and later becomes an inclination to observe other&#39;s nakedness.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Psychological blindness is the foremost characteristic of the jealous female regardless of how high her education is. When it comes to those whom a female is in love with, she acts like any of those who are mentally retarded</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A female says that jealousy is her trait. She adds: &quot;When I feel jealous, I never think; all my senses paralyze, any logical thinking just blurs and fades away, and then I am no longer able of understanding or comprehending anything. Nothing concerns me as the moment when my partner is with another woman. I find myself fancying him telling her whatever he would tell me and do with her whatever he would do with me</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">&quot;.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Going through the previous words, we come to realize that this woman confirms the actual paralysis of any logical thinking whatsoever. This can be attributed to the fact that when a female of a narcissistic character is provoked by jealousy, her testosterone level increases. That actually explains her hostility. Testosterone, in turn, decreases her level of serotonin, thus causing dysfunction of the frontal lobe that controls, as we know, the process of sound judgments. That is why a jealous female loses her wisdom</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>'),
(74, 1, 74, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A jealous female is an alienating being for both herself and others. She is psychologically blind and she drives her partner to loathe her. She is psychologically immature and she does not have that self-understanding so as to acknowledge her responsibilities, duties or the rights of others. The most dangerous consequence of such a manner is her partner being reluctant and averse of her.&nbsp; Clinics are the best indication of such cases since they have witnessed a variety of cases of men suffering from sexual impotence due to their partner&#39;s jealousy over them</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A jealous female cannot shoulder responsibility. Therefore, she adopts a mechanism of projection. She projects responsibility on others accusing them of torturing and distressing her because she does not respond to them or to their authority. She often figures out something that would make her look like she has been &quot;victimized&quot;. The female, very often, holds the other person responsible of her hardships</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Discussion with a jealous female is <em>&ldquo;mission impossible&rdquo;</em>. The male, in this case in particular, should not be deluded by the fact that discussion is possible or even valuable. The frontal lobe, at this point, is deactivated and only the ego of the right cerebral hemisphere is now at work craving to dominate with the same dictatorial mechanism of the left hemisphere. Here lies the paradox. As the right cerebral hemisphere tries to apprehend, the neuroconductors of the left one exchange roles with it and urge it to behave in a way that contradict its function especially that the part controlling judgments in the frontal lobe is in a state of deactivation</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>'),
(75, 1, 75, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In the case of a jealous female, the reasons of jealousy are often illusionary. They are the result of the way she adopts in interpreting her partner&#39;s behavior in accordance to her own skeptical nature</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">.</span></span> <span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The psychological path of a jealous female goes in one direction, for she always craves for more and more giving that has no limits whatsoever.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">All desires of a jealous female should be fulfilled by having her partner ready to own her, and by binding him to a life that conforms to her own standards; the standards that would relieve her from jealousy. Thus, she would be asking him not to have any external life. This is, undoubtedly, impossible because she cannot but feel jealous. Moreover, as a narcissist, she would feel that she; only she, must be idolized. All attention has to be directed towards her and she must have all affection. However, if her demands are not met, she feels that her femininity is insulted and that the other person does not love her. This explains why a jealous female often says: &quot;you do not love me, that is why I do not love you and I do not want you</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">&quot;.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Mistrust and feeling threatened are two concomitant traits of the jealous female. She suspects all those around her, observes them carefully, and perceives their conduct as a tremendous danger as well as a genuine desire to plot conspiracies against her. Also, she does not trust any male; neither does she trust any female. She suffers from a pathological skepticism to the extent that even the slightest insignificant details would provoke her to an aggressive hostile attitude</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp; </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A jealous female suffers from two major fears in her life; the fear of competition and the possibility of losing her lover. Her narcissism is somewhat associated with <em>&ldquo;the castration complex&rdquo;</em> (metaphorically speaking) that arouses her fears over losing her lover</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>'),
(76, 1, 76, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Psychologically speaking, jealousy is a state of neurosis and a severe sense of inferiority often mixed with competition, envy, possessiveness and skepticism. <em>&ldquo;Competition&rdquo;</em> is a healthy positive state as long as its motivation is the accomplishment of a better situation and a distinguished position in life. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&ldquo;Possessiveness&rdquo;</span></span></em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> is similar to jealousy except for the existence of a third party. It is a state in which the female demands her partner&#39;s full attention and consideration, not out of fear of losing him but because she believes that her self would be insignificant without his love. Consequently, if such a female is to be left alone, she becomes overwhelmed with feelings of isolation and estrangement and she would even reflex to an infantile state. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Jealousy and possessiveness crisscross at the excessive need to be loved and appreciated. Nonetheless, possessiveness comes out to surface when the female feels valuable and that happens only when she is loved by her partner. However, in the case of <em>&ldquo;envy&rdquo;</em>, there is a tendency to defeat the other woman as long as she has whatever the envious woman does not. Envy is an extremely aggressive, negative and defeating feeling whereas skepticism involves <em>&ldquo;scrupulosity&rdquo;</em></span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>'),
(77, 1, 77, NULL, '<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Females and Pregnancy</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Contrary to the fact that pregnancy is a feeling that is almost the same among people, its sensations are deep inside and are far from being coped with the details of or perceived by a man. Nothing will more clarify this than the words of a female in a letter about her first day of pregnancy even though she was firmly rejecting it at the beginning due to her desire to live freely: </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&ldquo;I didn&rsquo;t expect my first day. I never had the chance to imagine what it is like (to be pregnant) nor what it is going to be like after pregnancy. It would be more logical that my first day should be as normal as the day before and almost as any other day of the week. I am leading a seven-day life. Each day has a program that is being repeated almost identically week after the other. What happened was totally different. I could not but give up any routine ever since I saw the two pink lines in the middle of the home pregnancy test tube.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">I laughed whole heartedly and I called my mother and husband with a voice playing a new note. I recalled all what I have read, heard and watched about the first day of pregnancy as I was tenderly rubbing my belly. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It was a sudden, unexpected and rather undesirable result. However, still joy grew inside me as it was tickling places that nothing could ever reach before. It was a deep joy&hellip;brand-new joy. It was fresh, nice and interestingly getting larger and larger.</span></span></span></span></p>'),
(78, 1, 78, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">For two weeks or so, I have been suffering from a pain at the bottom of my back which I attributed to the extra work I have been doing lately. I had a very bad headache that couldn&rsquo;t be stopped by four Panadol tablets a day. Once I had to swallow two tablets of Setacodayine Extra to save myself the strong headache pains which I first ascribed to the approaching of the period, and I thought that staying up late and fatigue were the reasons for its delay along with my backache. I thought diet was behind my nausea though I didn&rsquo;t lose any one gram.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">I did not expect at all, not even for a second, that pregnancy was the reason behind all this. I didn&rsquo;t know why I excluded such a reason this time in particular. I would not have thought that I would be that happy to hear such news. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">This embryo which is in my belly now&hellip; somewhere inside me&hellip;.was not something or somebody I was waiting for. When I think about it, I would feel I am on cloud nine out of motherly joy. Here lies a small mass of meat growing inside me and soon it will turn to be a fetus&hellip;a baby of my own. Would it mean anything to you if I say that being pregnant made me feel I am a perfect female and that my femininity has really become complete?!!!</span></span></span></span></p>'),
(79, 1, 79, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">That day - in the evening - I lay on my back in the clinic to confirm pregnancy after describing symptoms. My eyes were fully attached to the magical screen while the doctor&rsquo;s hands were brilliantly moving a device on the bottom of my belly. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">You would not imagine my laugh when I saw that small mass on the lining of the uterus. My husband was asking me to calm down and the doctor was astounded by the fit of laugh I had. Two weeks ago I told my husband that I did not want to conceive a baby; it was not the suitable time then. Now, I am really afraid of the painkiller tablets that I have had a lot recently. However, the doctor assured me they would not harm my to-be-fetus. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">So far, my embryo is four weeks old or more. I didn&rsquo;t expect myself to approve my conception with such happiness.&rdquo; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&nbsp;Such a text indicates a critical issue as far as females are concerned. It is the issue of the female&rsquo;s reaching full femininity by being pregnant. It is not a normal feeling </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">that moves from one generation to the other nor is it the result of social considerations. </span></span></span></span></p>'),
(80, 1, 80, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">The Changing Image of Motherhood</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Andreas Bartels and <span style=\"color:black\">Semir Zeki </span>have found out that there are some real resemblances in the activities taking place in the cerebrum cerebration when we look at our lovers&rsquo; photos. The round frontal cerebral cortex which is located just above the eyes becomes active when mothers look at the photos of their newborn babies. This part of brain is often known as <em>&quot;the emotional brain&quot;</em>. It is also responsible for recalling the preferable touches or the preferable smells and even the undesirable smells in addition to the face charm. The disorders occurring in this part of the brain are related to <em>&quot;post-natal depression&quot;</em>. The harm inflicting on the emotional brain may affect the natural sentimental connection between the mother and baby. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Perhaps the most important thing of all is the effect of the <em>&quot;pleasure sensing centres&quot;</em> when we look at our children&#39;s photos or when we look at people with whom we have a sentimental relationship. Feelings of love, whether for our life partners or for a four- year old child have a wonderful impact. In fact, the two sentiments provoke the same centres of pleasure-sensing which manifest themselves when we taste a piece of chocolate or get a financial reward at work. This explains why cocaine addicts find it so hard that they cannot quit it.</span></span></span></span></p>'),
(81, 1, 81, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A contemporary woman says women nowadays can live without a husband since the latter&rsquo;s role as a breadwinner has decreased in the current societies. This is because women today have jobs which enable them to be economically independent and they have health and old age security. Moreover, man&#39;s sexual role can be compensated for, but, a woman cannot live without a child of her own. The woman who becomes thirty years old and does not get pregnant tends to be very aggressive and envious. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Another woman wanders: &quot;How can a female reconcile her daily needs as a female and her passion for love, femininity and life especially if we take into consideration that her concept of continuity is not the same as that of the man who achieves it through breeding? A woman does not seek to preserve her kind. Her behaviour and motives clearly show that she only seeks sentiment or the fulfillment of a sentiment she creates by herself through having a baby. She will be connected to that baby through a mutual relationship of a special nature. In this relationship, the woman practices creation and containment in the way that best represents her physiological structure. If she ever has a sense of continuity through containment, it would be a continuation of her self-centered narcissism. She depicts herself in her baby, then in her child&quot;. </span></span></span></span></p>'),
(82, 1, 82, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Some researchers tend to say that a mother&rsquo;s love to her child is no more than a continuation of her selfishness or self-love. Those researchers stress, along with Edward Hartmann, that a mother&rsquo;s love to her child is a way of preserving her kind since there is no separation between her body and that of her baby. However, it is noticed that even before the baby is born, the mother sees it as a separate distinct entity. The evidence to this is the normal fears that a mother develops about the possibilities of miscarry. No matter what such a &quot;physiological and biological union&quot; between the mother and her fetus throughout the period of pregnancy is, nothing would justify the claims that motherhood is merely a means of preserving the kind. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">During pregnancy, some mothers may have the feeling of an amazing magical mixing with their to-be-born babies as if their selves melted completely in their babies&rsquo;. It is, certainly, a fake feeling caused by the integration of the organic processes which control the needs of both the mother and her baby. This feeling is not enough when it comes to the fact that the two entities of the baby and mother have become one.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">If narcissist mothers would often make <em>&quot;motherhood&quot;</em> a mere manifestation of <em>&quot;self-adoration&quot;</em>, still the proper motherhood is when a mother loves her baby for its own self not hers. Such motherhood involves considering the baby as an independent entity, not a satellite of the mother&#39;s entity. </span></span></span></span></p>'),
(83, 1, 83, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Some psychologists claim that the sentiment of love (or the love relation) is just the opposite of motherhood (mother-baby relation) because love is unification of two separate persons whereas motherhood requires a separation of two persons who were already unified. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Motherhood often seems laborious for some women because it involves many conflicts; a conflict between self needs and preservation of the kind, a conflict between the mother&rsquo;s tendency towards maintaining union with her baby and the baby&#39;s aspiration of liberation and independence, and a conflict between the mother&#39;s narcissism and the necessity of sacrifice for the baby. Finally, it is a conflict between the woman&rsquo;s love of herself and love for her baby as a separate entity. That&#39;s why when a mother&#39;s love is proper, it oppresses the mere animalistic instinct and focuses on the baby who is considered to be an independent entity that tends to get out of the darkness of the organic life and gradually reaches the light of consciousness or feeling. Thereby, mother&#39;s love will be just like any other love as it sees the baby as an end to be reached &quot;terminus ad quem&quot; rather than &quot;a starting point&quot; or &quot;terminus a quo&quot;; i.e., what the instinct implies. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There are some theories that explain motherhood as &quot;a mere affectionate mixing&quot; between mothers, on the one hand, and the baby&#39;s organic needs, motives and desires, on the second hand. Supporters of this view tend to say that a mother is not present but through her awareness of the instinctive factors that control her relationship with her baby. </span></span></span></span></p>'),
(84, 1, 84, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">If we only take those factors into consideration, we would be committing a deadly mistake especially if we imagine that the actions a mother does while taking care of her children are the result of direct experience. Throughout this experience, the mother lives the biological needs and changing conditions of the baby according to the baby&rsquo;s expressions that she infers. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A similar adaptation can also be presented in the idea of ecstasy which a mother enjoys when she breastfeeds her baby and that of the baby when s/he is breastfed by the mother. This means there is a parallelism between breastfeeding and the baby&#39;s hunger. Such parallelism leads the mother to perceive her baby&#39;s hunger &ndash; in his/her consecutive phases - through direct intuition. Therefore, the mother is very often capable of diagnosing her baby&#39;s diseases in an intuitively lucky way that might astonish the baby&#39;s doctor. That is why mother&#39;s love is ever considered as a <strong>&ldquo;<em>unique love&rdquo;.</em></strong> It is love that can never be compensated irrespective of the financial benefits. Giving birth to a child&ndash; as Scheller says &ndash; requires a separation of the mother and baby&rsquo;s bodies. But this separation - at least after birth &ndash; does not involve a complete rupture or a breakdown of the &quot;prior-to-feeling&quot; psychological and biological union.</span></span></span></span></p>'),
(85, 1, 85, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">This mother-baby union is still maintained without relying only on the mother&#39;s interpretation of the biological aspects through getting help of a set of <em>&quot;physical signs&quot;</em>. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Love is not a merely negative emotional state or purely affectionate affectedness. Rather, it is a positive and active state in which affection relates to activity. So, it is not surprising to find a mother who really loves and dedicates herself for her baby, and shoulders the full responsibility of sustaining and bringing him/her up. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is not a coincidence that the word <em>&ldquo;responsibility&rdquo;</em> in English or <em>&ldquo;resposibilite&#39;&rdquo;</em> in French is derived from the word <em>&ldquo;response&rdquo;</em> or <em>&ldquo;response&rdquo;</em> which means <em>&ldquo;answer&rdquo;</em> or <em>&ldquo;response&rdquo;</em>. This means that a responsible person is the one who answers a question when asked and responds when needed or referred to because they have deep interest in what they love and because they know it is their duty to care for it. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In essence, motherhood is a psychological function assigned to a woman as she shoulders the responsibility for upbringing and taking care of the baby. Nevertheless, this is not enough. A mother should not only protect and take care of her child; she should also provide her baby with all the reasons to love life and hold to it.</span></span></p>');
INSERT INTO `app_book_page` (`bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`) VALUES
(86, 1, 86, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The Torah has described <em>&quot;the promised land&quot;</em> as a <em>&quot;land of milk and honey&quot;</em>. We can similarly say that a real mother is the one who would provide her baby with milk and honey. By <em>&ldquo;milk&rdquo;</em> we mean protection and caring, while by <em>&ldquo;honey&rdquo;</em> we mean love of life and enjoying existence. Hence, if we are to precisely describe a motherly love, we could say that it is an unconditioned love which is based on giving rather than getting. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The word that denotes God&#39;s love to human beings and love among human beings themselves in the holy books is <em>&ldquo;rachamim&rdquo;</em> which is derived from the word <em>&quot;rechem&quot;</em> that means <em>&quot;womb&quot;</em>. This indicates nothing but that the motherly love is the sublime example of love. Motherly love is unconditioned because it centres on the &quot;existence&quot; not the &quot;behavior&quot; of the baby, whereas the fatherly love is determined by some traits of the baby. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A mother would feel that the baby is <em>&quot;HER BABY&quot;</em>, and this is the first tendency that leads her to automatically cling to her baby even before its birth. That the baby is hers is a purely feminine feeling &ndash;&ndash; something that a man would never have a match for. Therefore, a woman&#39;s tendency to give birth to children is essential and instinctive, but as for the man, it is a mere &quot;desire&quot; that needs to be justified or reasoned. It does not have the real tendency that a woman has. </span></span></span></span></p>'),
(87, 1, 87, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">As we mentioned earlier, the main feature that distinguishes the fatherly love from motherly love is that </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">the first is restricted and conditional, while the second is unrestrained or unconditional. A mother loves her baby because it comes out of her belly &ndash; without fulfilling any conditions whatsoever. It seems that &quot;unconditional love&quot; satisfies a hidden need of human beings in general, not only of a baby. This is because each one of us wants themselves to be loved for their own self, not for any characteristic they might enjoy. This might be what Pascal meant by saying: &quot;If somebody loves me for the traits or characteristics I enjoy, then they do not love me myself; rather, they love my traits&rdquo;. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When you feel that others love you out of admiration or because you could satisfy them, then you would feel, deeply in the inside, that you could not gain their love because you were only a means that would help them achieve their goals. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We all; children and adults, long for <em>&quot;the unconditional love&quot;</em> through which others would love us for &quot;ourselves&quot; not for &quot;themselves&quot;. Although the majority of children enjoys such kind of love, many adults would face a difficulty in attaining it. </span></span></span></span></p>'),
(88, 1, 88, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">While the mother is likened to the nature, soil and land from which a baby comes out or in which s/he is brought up, the father does not represent any image of natural environment or habitat for the baby whatsoever. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The baby does not absorb or mingle father and mother into his/her super ego, as Freud suggests. Rather, the baby constructs two different consciences; one based on mother&#39;s law of love and the other on the father&#39;s law of reason and mind. It should be noted that the different psychological illnesses are no more than a manifestation of the adult&#39;s inability to strike a balance between the two consciences.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The baby is the mother&#39;s dearest creature ever because s/he is her own baby. Therefore, &ldquo;<em>adopting a child&rdquo;</em> may not fulfill the motherly needs of a woman since what is important for a narcissist is not the baby as much as the <em>&quot;kindred&quot;</em>. In fact, there is a big difference between the concepts of &ldquo;baby&rdquo; and &quot;my baby&quot; for such women. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Since the case is thus, we have to share Max Scheller his view in that motherhood is totally independent from woman&#39;s experience about babies because the sentiment of motherhood already exists in women who have never given birth and who might not have the least idea about it. Sometimes, they might not have any idea whatsoever about pregnancy itself. Hence, motherhood, as Helen Deutsch claims, is experienced by women who have never borne a baby and have never had a baby.</span></span></p>'),
(89, 1, 89, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We should admit that when a mother brings up her baby, she enlarges the circle of her existence and doubles the meaning of her life. Perhaps, one of the biggest secrets of motherhood is that the woman is given the chance to sacrifice her selfishness without losing her individuality. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The mother abandons her narcissism to gain a multiple personal life as she lives in the conscience of her children, but still she goes back to herself to enrich her life. It goes beyond doubt that when a mother responds to the call of real motherhood, she is then bringing her children up for &quot;themselves&quot; not for &quot;herself&quot;. </span></span></p>'),
(90, 1, 90, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The changes that affect the female throughout pregnancy give an impression about the level of creation done by her in her wholeness. The following text expresses what a female says in her early days of pregnancy about delivering (innovating) a creature out of her. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&ldquo;I look more beautiful with the additional kilograms that I have recently gained. My eyes are, like others&rsquo; eyes, exhausted and they fully express what kind of life I am leading. The paradox lies in that this situation does not take away my happiness about my to-be-born baby or even my longing to hold it tight to my chest in my arms. I am totally distracted and pitiable!!</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Perhaps, though I hate confession, the alternating hormones have beaten me. I am crying without a reason. This might seem to be romantic-like; however, the fact is that I am crying out of being touched. But, when I start, I cannot stop. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">I feel sad because I have lost control. To stop crying, I try to define a cause for it. I have thousands of reasons not to cry (Note: What is working here is the right cerebral hemisphere). I feel as if I were under the influence of magic or an anesthetic. Part of my consciousness is aware of what&#39;s happening to me (That is the left cerebral hemisphere), but it cannot help me find a way out or at least control a single detail (The right cerebral hemisphere).</span></span></p>'),
(91, 1, 91, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">I am not alienating myself from anybody, but I think I am not a useful friend to any one at this particular time. I am drowning more and more without a single solution to ease me or pick me out, and I am getting weaker at resisting circumstances. Problems are accumulating. I am no longer able of tackling them whether separately or as a full package. Problems at work as such have never occurred to me not even in dreams&hellip;My academic duties are very bad. Headache is always accompanied with nausea or the feeling of enfeeblement... let alone the lack of sleep that adds fuel to fire. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">I wanted to cry and complain, but does anyone really need such a woman in his life? What am I crying for? &hellip;Nausea and vomitting&hellip; endless problems at work&hellip;more and more illusions. I am full of anger because my baby will receive a share of such negative feelings. I am so sad that I gave it this rotten dose, but I cannot stop it. I laugh at times and tell jokes joyfully at other times; however, one silly thing would get anger back to the peak. I cannot tackle issues alone&hellip; Am I disgusting enough? This text is highly significant if we want to access the internal world of the female during pregnancy. In short, for a female, pregnancy is a real cosmic experience.&nbsp; </span></span></span></span></p>'),
(92, 1, 92, NULL, '<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Nasty Women</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&ldquo;Nasty women&rdquo; cannot be regarded as a pure feminine phenomenon, for this entails the fact that there is another phenomenon called &ldquo;nasty men&rdquo;. This is a pathological phenomenon as will be explained. However, some later syndromes could apply to men likewise.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A nasty woman is one who exercises control, punishment, or exploitation. However, a nastier woman is one whose conduct is immoral and who causes misery to people around her. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\">* * * * *</span></span></span></span></p>'),
(93, 1, 93, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Types Of Nasty Women </span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">(As A Situated Psychology)</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><em>&nbsp;</em></strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><u><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The temperamental</span></span></u><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">: A woman you can never expect which side of her character she will show in her personal relationships.</span></span></span></span></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><u><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The bully</span></span></u><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">: A woman whose reaction cannot be predicted. You will never be able to know when she will explode nor why she is fuming in such a way. She will shake the whole sentimental stability at home or at work.</span></span></span></span></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><u><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The ferocious</span></span></u><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">: She follows the course of the bully woman, but she feeds verbally and sentimentally on the victim that constitutes a subject for her.</span></span></span></span></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><u><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The beneficial</span></span></u><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">: A woman who establishes her relation with the male on the basis of getting benefit. She does not do that because she has the intention of harming others, but simply because her interest requires this act or that.</span></span></span></span></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><u><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The female living with the scum of society</span></span></u><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">: She loiters with unsuccessful people. She could be </span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">wonderful with a nasty man but will not give such a chance to a polite man. She does not have enough self-satisfaction.</span></span></span></span></p>'),
(94, 1, 94, NULL, '<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><u><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The female living on the surface level with others</span></span></u><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">: This woman loiters with people on the surface. She would abandon her husband and search for another from the surface if he begins to degrade and sink. She knows how to seize opportunities well. She would bluff even her dearest friends and take her husband to possess him for herself. Love and truth are merely meaningless words to her.</span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><u><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The dependent</span></span></u><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">: This woman holds to people she depends on and never abandons them. She cannot be an independent person.</span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><u><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The masculine-like worker</span></span></u><span style=\"font-size:1.0pt\"><span style=\"font-family:ZWAdobeF\">U</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">: She always abides by rules. She is not attractive and working under her supervision is not enjoyable. People had better meet her expectations or she will stealthily harbor deep hostility for them. She is never contended with anything and will not appreciate anybody whosoever. She does not use the word &ldquo;encouragement&rdquo; at any time.</span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Some women use these techniques because they have either experienced them or witnessed their mothers practicing them on their fathers. Some of these women are selfish and like deceiving and exploiting others for personal interests. Some of such women have no conscience, or only have the least of it.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">This category of women enjoys some of the following characteristics. These women may:</span></span></span></span></p>'),
(95, 1, 95, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">1. love to possess.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">2. be prevailing and may often have the penis-envy complex.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">3. be sentimentally unstable.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">4. have been misunderstood by others.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">5. be indifferent to others.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">6. be narcissistic.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">7. be self-dependant.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">8. be conscienceless.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">9. feel deeply within that she is better than others.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Maybe in the past these women were:</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">1. sexually abused. This could have caused deformation and resulted in a self-regard complex.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">2. emotionally hurt, whether regularly or during critical situations of their life. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">3.&nbsp;sexually assaulted. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">4. neglected.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">5. exposed to shocks.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">6. badly brought up.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">7. accustomed to acting this way believing that it was appropriate to show their potential and responses.</span></span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\">&nbsp;</p>'),
(96, 1, 96, NULL, '<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Nagging: Situated Demanding </span></span></span></span></strong><strong><em>&nbsp;</em></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There is no doubt that criticism is essential to people&#39;s lives. It is a constant correction of shortages of anything in the universe. That is why compliant relations (in which one submits totally to the authority of the other) are incorrect. There is, however, a difference between criticism and nagging which goes even far beyond complaining.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Truly, some people cannot distinguish between criticism and offense. The language of criticism used by both males and females is often risky and is on the verge of giving the impression that it is the other that is targetted not their behavior or point of view. Normally, people do not differentiate between personality and ideas or behavior. Consequently, any criticism would be taken on a personal level by some people. We often notice that the person who undergoes criticism tends to be very defensive, and sometimes aggressive, defending their opinions and behavior as if defending their own selves. Moreover, they consider the one criticizing them as aiming to attack them personally and jeopardize their identity gradually. Soon, the criticized person counterattacks their critic to diminish them. Then, the two parties enter a non-stop cycle of criticism and counter criticism that would only aggravate small arguments into unsolvable ones.</span></span></span></span></p>'),
(97, 1, 97, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A typical female does not generally exercise violent forms of criticism in romantic situations, for she will mostly be preoccupied with her right half (her emotions) which explains why the <em>&quot;the loving soul cannot find fault</em>,<em>&quot;</em> and why <em>&quot;love is blind&quot;</em>. However, nagging and complaining are among the typical characteristics attributed to the female without differentiating between this type of verbal performance and the concept of positive criticism that seeks reformation and perfection. Hence, nagging is the female&#39;s means of reminding the others that she, along with her feelings, needs to be the centre of attention in a way that would satisfy her ego as a female. This is neither faultfinding nor perfection seeking.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Interestingly enough, <em>&quot;Nag&quot;</em> is a feminine English noun that does not have a masculine equivalent. This means that there is a long-term accordance among most peoples to associate this noun with females. Moreover, British and American laws in the 19<sup>th</sup> century considered nagging as an act that requires punishment. The ugly punishment was to tie the nagging woman to a chair with movable arms and then drown her several times matching the times of her nagging and the number of her previous <em>&quot;crimes&quot;</em>. That was the famous procedure used in Britain and the United States to punish witches and prostitutes as well. </span></span></span></span></p>'),
(98, 1, 98, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The aforementioned exaggerated punishment &ndash; certainly &ndash; did not take into consideration, according to the main stream of knowledge at that time and even at ours, how much injustice was bestowed upon the female by associating her constant complaining and endless nagging with crimes. They did not take into account her specific personal as well as biological aspects as a situated knower that had special private biological and psychological features.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The male tends to nag when the repetitiveness of discontent becomes the female&rsquo;s only way to subjugate him and make him go through a vicious circle of complaining. Hence, he gets out of control and logs into this &quot;bad circle&quot;. The female believes that repetition will achieve a miracle that would make the other person respond to her feeling that she has all the right to express her annoyance of him. To this, he responds with more neglect. Eventually, this becomes a constant conflict where both parties are right; the female believes that the ultimate right lies in the male taking into consideration all the feelings and the small details related to these feelings. The male, on the other hand, considers this to be an intervention with his being, a violation of his uniqueness, and an illogical behavior against his individuality. </span></span></span></span></p>'),
(99, 1, 99, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In fact, at this very moment, we come to see the most expressive contrast between the two hemispheres: the woman&#39;s right and man&#39;s left. They both identify with only one half; that is why they have two different languages.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The best evidence that they have two different languages lies in the fact that the right half of the cerebrum is programmed to do more than one task at the same time. This explains the many non-stopping issues raised by women, at a time when the man is completely lost listening to his woman talking and shifting from one subject to another, no matter whether she is tackling one violently repeated subject or several subjects at a time, or referring to something she fears in many different ways&hellip;</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">This type of nagging aims at making the other feel guilty just as equally to the internal feeling of deprivation of something important. In other words, all that matters the right half as regards feeling, evaluation, intuition, beauty and communication may overshadow all that matters the left half; i.e., senses and logic.</span></span></span></span></p>'),
(100, 1, 100, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The most serious aspect about nagging is that it goes on and on in a vicious circle and soon transforms from the circular motion into a spiral whirl dragging the woman to further anger, despair and rejection.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In most cases, complaining, and consequently nagging, does not occur for trivial reasons; it is a kind of demanding recognition of gratitude because the female, as a person who is constantly demanding communication, would always like to receive permanent approval and appreciation to recharge her giving ability and enhance her self-esteem especially if she feels that her life has become a mixture of trivial things that do not go along with her humane prestige. </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Though the female thrives to graciously give those around her, she believes that few words of appreciation or attention is something she really deserves, and is a way of recognition of the importance of what she dedicates herself to. The more her complaining is met with carelessness, the more her nagging will be. This will result in seeking solitude, exploding (as a way of escape), getting frustrated or undergoing depression.</span></span></span></span></p>'),
(101, 1, 101, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Complaining that leads to nagging is a proof of the interrupted communication between the male and female. Thus, the only solution lies in all types of communication and the consideration of all the &quot;hidden&quot; requirements that arouse complaining. This needs exerting strenuous efforts on the part of men since they cannot guess what their females want and mean by their shower of words. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Very often, what the female focuses on through her words is not the real reason behind her outburst; it is her feeling of disconnection and all symbolic forms of emotional deprivation. The solution a male could find might be simpler than just drowning into the female&rsquo;s ocean of words and issues. For example, offering his female a bunch of flowers, compliments, appreciation, and expressing how special and exceptional she is will be </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">some simple solutions the male can resort to instead of wasting time going through details; and, as you know, the devil always lies in details. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The riskiest of all as far as complaining and then nagging, are concerned is that the parties involved become enemies in no time. When a female nags, the male recalls the deep-rooted unconscious remarks of his mother. Hence, he would as if there were someone who wanted to get him back to the past and underestimate him as an adult. The result would be that he fiercely defends himself, thus, he loses connection and the situation aggravates. There will be a state of outrage and escalation. Hence, communication interrupts and eventually the two sides would more likely prefer to escape.</span></span></span></span></p>'),
(102, 1, 102, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Here, we are not talking about pathologic personalities and &quot;nasty&quot; women. Rather, we are talking about the typical ones. This does not mean that pathologic personalities cannot be dealt with. The key to how to deal with the female, whether pathologic or healthy, is the same; attention and communication. Even masochist females find satisfaction in &quot;negative&quot; communication; what matters most for a female is to be profoundly understood and her demands fully realized.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Exaggeration</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Since males utilize their left cerebral hemisphere more than the right one, which is the opposite case with females, the differences between both sexes in the degree of exaggeration stem from the fact that they are biologically different.&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Once, my office manager burst into my office in tears. When I asked about the reason, she said: &quot;I feel I would not pass my exams and would never graduate. As long as I failed two subjects, I will never succeed &hellip; This is the first academic failure I have ever experienced in my life&quot;.&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Analyzing such a situation, exploiting my left cerebral hemisphere and relying on my experience in psychology, I thought it was an exaggeration that resulted from lack of confidence, due to her home discipline that reposed on abashment, and her feeling that her female colleagues were more privileged than her as far as males are concerned. This was the result of a failing relationship that started with marriage and soon ended in divorce.&nbsp; </span></span></p>'),
(103, 1, 103, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">That analysis could possibly be accurate and precise if I were dealing with a male. But after I rested myself for a while to shake off the impacts of thrusting herself into my office, I began to think using my right cerebral hemisphere. So, I began to consult the feminine mind and the anima inside me which we; males, do not identify ourselves with, therefore, we lose every possible attempt to understand females. Even when we want to treat them, we utilize our masculine minds flagrantly.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<table style=\"border:undefined; width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div>\r\n			<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Do not consider a female&#39;s anger as offending your manliness.&nbsp; Separate between the action and its background.</span></em></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">There is no doubt that science depends entirely on the logic laid by masculine mind and that treatment should have a logical context. Nevertheless, understanding feminine cases should be based on the feminine mind.</span></span></p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">As soon as I began to think femininely; i.e., using my right cerebrum, I could realize that she; my office manager, was not suffering that much from an inferiority complex. She only wanted me to know how much worried she was. She wanted to indulge me in her psychological suffering which she reflected by resorting to the highest degree of emotional exaggeration. She wanted me to help her trust herself as much as she wanted to have emotional communication with her feelings and premonitions. </span></span></p>'),
(104, 1, 104, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In that a case, I had to rely on my left cerebrum to have good analysis and to attain the details and way through my right cerebrum. Shortly, it was not, typically speaking, an inferiority complex. Rather, it was an emotional exaggeration.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">WOMEN</span></span></em></strong><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> usually exaggerate when it is a matter of emotional estimation. They also make too much of things when it relates to intuition. However, when it comes to position and materialistic numeral issues, it will be <strong><em>MEN</em></strong> who tend to exaggerate.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Rarely does a female exaggerate over position or money</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> unless she seeks to get a feedback that enhances her emotional side and feminine status. The same applies to males who do not tend to exaggerate but in cases of love or hatred, which are two feminine cases since it is the responsibility of the right cerebrum to deal with them. Males usually exaggerate over their job ranks, income, status, luxurious cars, achievements and the number of women they had relations with.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Such kind of emotional exaggeration appears clearly in those male and female artists, poets and actors. However, </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">in cases of disconnection, we find that the female uses the highest degree of exaggeration to let her male realize how important her emotions are.</span></span></p>');
INSERT INTO `app_book_page` (`bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`) VALUES
(105, 1, 105, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In an argument between a male and female on why she did not do the house chores, the female might say &ldquo;I was busy&rdquo;. This sentence might be captured by the male who might directly ask about what was engaging her, then he would go back to what annoyed him at the beginning of the argument paying no attention to the exaggeration that she expressed in relation to her feelings. This is the very nature of the male&rsquo;s cerebrum which tackles the last word said then goes back to what irritated him in the first place through a flash back technique. One mechanism looks for materialistic details and the other resorts to emotional pyramiding. The male may start collecting evidence to logically confute his female while the female keeps her exaggeration going on. Thus, they will go into a vicious circle of exaggeration.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When a male exaggerates over his own characteristics, good deeds or status, other males view him as a liar and a silly person. However, when a female overstates her feelings, her female peers approve and blindly accept since it is a natural feminine act. What is remarkable is that when females meet males who overstate their traits (females&rsquo; traits), they, get fascinated - at first - because they like fabulous appearances. But, they immediately and intuitionally get to know the reality behind this situation. Females contempt males of the like, nonetheless, they do not show the same contempt males show. They pass this over out of their own free will as openly and consciously. </span></span></span></span></p>'),
(106, 1, 106, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Overstating affections and promises is part of the female&rsquo;s need which she resorts to when she feels she is neglected or emotionally depreciated. What matters to females most is &ldquo;communication&rdquo;.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Exaggerations are not a masculine mind preference since it deals with facts, figures and logical and literal interpretation of words. Therefore, males would deal on the basis of awareness that conforms to reality. All that does not match reality means it does not interest the male because it does not belong to the left cerebral hemisphere. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The language females use is a language of connectivity and friendliness, while language of males is that of social status, prominence and independence. So, we can say that cultural communication between males and females is a kind of communication between two opposing cultures. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">If we are to translate the language of each sex into the other, we will not be in need of a </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&ldquo;translation&rdquo;; rather &ldquo;compiling&rdquo; which means the transition from an abstract language into a simple direct one, so to speak, as it is the case with computers where there is a transition from the analogous language to the digital one. This means both sexes speak two completely different languages.</span></span></span></span></p>'),
(107, 1, 107, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">According to some socio-psychological studies conducted on males and females, it has been discovered that job or self boasting is never a feminine characteristic; rather, a masculine one par excellence even if it pops up in some females. According to those studies, females do not boast their status (except for the esthetical feminine preference) nor do they give instructions. They set forth suggestions if they want to tell others what they prefer or like. They express that in a non-instructive language, i.e., a language of teamwork. They use such expressions as: </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&ldquo;let us&rdquo;, &ldquo;what about&rdquo;, &ldquo;why don&rsquo;t we&hellip;&rdquo; etc. However, when it comes to beauty, they sing a different tune. They might use expressions like: &ldquo;I am better and more beautiful&rdquo;, &ldquo;my beauty needs &hellip;&rdquo;, &ldquo;I deserve &hellip;&rdquo;, &ldquo;it suits me well that &hellip;&rdquo;, &ldquo;fancy: a female like me with such bad luck&rdquo;.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The way female uses to deal with others does not reach the point of exaggeration and direct opposition or challenge unless it touches her femininity. This especially happens when jealousy invades and overwhelms her. Recent studies conducted on males state that a male does not try to soothe conflicts nor does he keep harmonious social relations. Hence, exaggerating the role of the hero, leader, pillar or even Rasputin or Don Juan is nothing but a masculine characteristic.</span></span></span></span></p>'),
(108, 1, 108, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When a female falls ill, her emotional exaggeration gets more apparent. This is because she wants the other to feel how great her suffering is, on the one hand, and to </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">enhance her feeling that her male is still in touch with her. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Both, males and females, need to use a proper language when dealing with the exaggerations of their partner; a language that entails positive and mutual understanding according to the following tips:</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Wingdings 2&quot;\"></span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> No party whosoever should say it openly that the other is exaggerating. The female should not show contempt for the male when he highly estimates himself or exaggerates over his uniqueness. The female should know that the need of the male to fulfill his virtual or exaggerated status (through understanding and absorbing) is the only way to sneak into him. She has to avail form this point and does not shatter it on the shore of reality since it is part of his masculine character and personal balance. The male, as well, should not decipher the codes of the female exaggerations literally. He has to view them as emotional expressions about something completely different; something he has to look for or, at least, early get and comprehend before he communicates it. </span></span></p>'),
(109, 1, 109, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Wingdings 2&quot;\"></span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> The way into a female&#39;s heart is by sympathizing with her and her emotions. Therefore, using expressions like the following ones is very important for a female: &quot;I feel you&quot;, &quot;I agree with you&quot;, &quot;I sympathize with you&quot;, &quot;I appreciate your emotions&quot;, &quot;thank you for indulging me in what you feel&quot;, &quot;you are much more important&quot;, &quot;I will ever be with you and beside you&quot; and the like. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<table style=\"border:undefined; width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div>\r\n			<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Receiving lovely words and feelings are a priority in her life on condition that she is not deceived. The feeling of being deceived will arouse a feeling of inferiority. This can only be avoided by joining words and actions.</span></span></em></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Wingdings 2&quot;\"></span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> The way into dealing with a male&#39;s exaggerations can be through the use of some phrases like: &quot;you deserve more&quot;, &quot;what you gained is only part of what you deserve&quot;, &quot;I am sorry that it took me a long time to realize how important your ideas are&quot;, &quot;thank you because you always do what makes me proud of you&quot;, &quot;you are always great&quot;, &quot;when I see your greatness, I feel I do exist&quot;...</span></span></p>\r\n\r\n<p>&nbsp;</p>'),
(110, 1, 110, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Situated &hellip; But &hellip; Will Meet</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Chemistry of Love among Human Beings</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">A research conducted by Dr. Donatella Marazziti, shows that the testosterone rates become almost the same for men and women when engaged in a love affair. Dr. Marazziti points out that although those people may go on in the same relationship, the testosterone rates return to their normal levels. This might explain the decline of the sentimental feeling of love among people after living it for a while; that is to say after living it as a normal life. Hence, our first love remains as vivid in our memories just because we have not experienced it before and because the first feeling it creates cannot be repeated but by another first love (in its early stages). </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">The first experience is accompanied, along with the aforementioned signs, with lack of the chemicals (dopamine, </span></span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">phenylethylamine<span style=\"color:black\">, and noradrenalin) that characterize the period of getting infatuated with the partner. This period is also accompanied with an increase in some other chemicals that enhance the relationship and create the feeling of reassurance between the two partners.</span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>'),
(111, 1, 111, NULL, '<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Endorphin &quot;The Magic Hormone&quot; </span></span></span></span></strong><strong><em>&nbsp;</em></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">According to Legato, Donatella </span></span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Marazziti<span style=\"color:black\"> realized that after having a sexual intercourse, the endorphin which is also known as a natural painkiller, remains for a while. When engaged in a long love relationship, our brain produces the same chemicals that enable a marathon runner to get to the end line in the hardest circumstances. Endorphins enhance our feeling of happiness and affect profoundly our moods. Our bodies produce them at times of laughter too. This explains the laughter-based therapy and why females are more attracted to men who have a sense of humor. When rates of endorphin increase, we become sociable and friendly and we get a feeling of relaxation. This hormone is also produced at the peak of orgasm. Both, endorphin and oxytocin share the responsibility of giving a feeling of happiness after having a hot sexual relationship.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span>&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:13.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Oxytocin &quot;The Cuddle and Romance Hormone </span></span></span></span></strong><strong><em>&nbsp;</em></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">Oxytocin is a hormone that stimulates the sexual arousal among both males and females. The body produces larger amounts of this hormone during the sexual intercourse and after reaching the thrill. Oxytocin appears through a number of functions that do not apparently look related to each other. Historically speaking, the word <em>oxytocin </em>is derived from a Greek word means <em>&quot;quick birth&quot;</em>. It is related to muscle easy contraction at birth time and it stimulates the uncontrollable flow of milk for breastfeeding mothers. It should be noted that oxytocin is not only produced at times of happiness, but at times of tension, too.</span></span></span></span></span></p>'),
(112, 1, 112, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">The relationship among these different cases may be summed up by saying that all of them involve engagement facilitated by oxytocin. Researchers believe that the relation between the flow of milk and oxytocin strengthens the relationship between the mother and her baby. This might explain the low number of post partum depression cases among women who breastfeed their babies in comparison with those who do not. </span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<table style=\"border:undefined; width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div>\r\n			<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Males overcome their nervousness when they have sex while females overcome it by being noticed, cared for and listened to.</span></span></em></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">Like endorphin,</span></span></span> <span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">the hormone of oxytocin leads to a better mood. That is why researchers call it <em>&quot;the cuddle hormone&quot;</em>. Negative ideas reduce this hormone levels in the body whereas some massage may help increase it. This is the reason why some people get addicted to massage and find it a way to love and have sex. Nevertheless, it is a way that leads to relaxation. It stimulates feelings of tenderness, kindness and communication. The secretion of oxytocin increases 20% during a massage session for the hands, neck and back. This means that touching is not necessarily an expression of a desire to change a person&#39;s mood to the better.&nbsp; </span></span></span></span></span></p>'),
(113, 1, 113, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">It is evident, then, that women who do not feel happy in their intimate sexual relationships with their partners are those who have lower oxytocin rates. </span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">Kathleen Light; a professor of Psychological Medicine from North Carolina University, carried out studies on oxytocin rates in women. From her research, we come to know that &quot;holding their partners&#39; hands, having eye contact with and sleeping together, help women raise oxytocin rates in their bodies&quot;. This explains the charm of touching among lovers who spend long hours holding each other&#39;s hands. It also explains the secret of love by having mutual eye contact.</span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp; </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">Researchers discovered that women who had happy intimate sexual relationships had higher oxytocin rates. Continuous researches show that some people have a natural genetic aptitude to develop higher oxytocin rates. They are the ones who can easily fall in love or get sexually aroused. Such people are unable of showing much resistance. </span></span></span>&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">Researchers in Karolinska hospital in Sweden studied the effects of injecting oxytocin into the body and found out that a daily dose of this &quot;cuddle and romance hormone&quot; would reduce blood pressure and would stimulate a feeling of comfort and relaxation. That urged other researchers to believe that the intimate relationship may help people who have high blood pressure to get better or to be cured from some blood diseases such as leukemia.&nbsp; </span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(114, 1, 114, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"color:black\">Dr. Legato finds a research supporting this vision made by David Wix; a psychiatrist at Edinburgh Royal Hospital. This researcher has found that spouses who have a sexual intercourse three times a week at least look 10 years younger than those who have it less. That can be </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"color:black\">noticed on the faces of two lovers after having a romantic meeting where glamour and beauty that show on their faces are caused by this and other hormones.&nbsp; </span></span>&nbsp;&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"background-color:#0c0c0c\"><span style=\"color:white\">Is Oxytocin Secretion the Same for Males and Females? </span></span></strong><strong><em>&nbsp;</em></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"color:black\">When the intimate sexual intercourse is over and satisfaction is realized, the cerebrum secretes oxytocin into the blood streams of both men and women equally, but as soon as the oxytocin meets the sex hormones there, its effects become extremely different, and it leads to completely different results. The estrogen in woman&#39;s blood enhances the effect of the oxytocin, reducing, thus, the blood pressure. She would feel happy and relaxed, and would develop a great desire to continue this connection by means of hugging, touching and talking. That is why she asks her partner to hug her and not to leave her after ejaculation. </span></span></span></span></p>\r\n\r\n<table style=\"border:undefined; width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div>\r\n			<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em>Separate yourself from the criticism addressed to you and bear in mind that humor is the own secret of the permanent understanding you aspire to have.</em></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"color:black\">The testosterone in the male&#39;s bloodstream, on the other hand, which becomes higher during the sexual activity, neutralizes the oxytocin effect and reduces the desire to hug the female. This explains the male&#39;s desire, in most cases, to move away from his partner, and explains, in turn, her violent reaction to it as she thinks that he has got what he wants from her and then despised her!</span></span></span></span></p>'),
(115, 1, 115, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">While a woman wants to stay for a longer time with her partner to enhance the connection that has just happened, the man does not have a similar motive and is ready to move to anything else. This vision is enhanced by a study conducted by Dr. Light in the University of North Carolina on the oxytocin effects on blood pressure. There were no signs that men had higher oxytocin rates after massage. This might be attributed to the testosterone neutralizing effect of the oxytocin.&nbsp; </span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Love and Accompanying Signs of Sadness </span></span></span></span></strong><strong><em>&nbsp;</em></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">Every one of us has probably realized that most great love affairs are characterized of pain and suffering, yet their heroes do not give up. </span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">On the same issue, a research clarifies that parts of our minds paralyze when we love and that we feel distressed. This is, definitely, not a typical situation to take crucial decisions of change. </span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">Our brains produce more dopamine to help us remain in high spirits in the face of crises. This is useful, but the feeling of serenity it creates might be fake. Now, we come to know the reason behind the calmness that follows cases of great sadness. </span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"><span style=\"color:black\">When this situation is over, the </span></span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">suprarenal gland<span style=\"color:black\"> &quot;operates&quot; the pituitary gland, which is the &quot;factory&quot; whereby all the hormones we need to survive a threat are made. The production of stimulating hormones like epinephrine and cortisol increases. This might be particularly harmful when the feeling of sadness remains for a very long time.</span></span></span></span></span></p>'),
(116, 1, 116, NULL, '<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We realize what has just been mentioned when a love affair comes to an end. The result is that we will develop feelings of loneliness and terror similar to those we experienced when we were taken away from our mothers at a very early age. It is regaining of the pains of weaning and separation from those people whom we got familiar with the hormones of.</span></span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">These views, which are presented in the light of the cogtive function of the masculine half, can, to some extent, explain the biological side of love; the feminine side, to be more accurate.&nbsp; However, they will not be sufficient when it comes to considering femininity as love. We present such views reservedly because we are really convinced that they only provide a one-side explanation which is, nevertheless, important. This, certainly, helps us understand the mechanism according to which cerebrum of the female works. It, consequently, helps us understand the female herself. </span></span></span></span></p>\r\n\r\n<table style=\"border:undefined; width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div>\r\n			<p dir=\"RTL\" style=\"text-align:center\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><em><strong><span dir=\"LTR\" lang=\"EN-GB\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Love and Understanding Will Not Last Forever</span></span></strong></em></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Happiness that accompanies love is temporary, hormonally speaking, for there is no logic whatsoever in the constant secretion of phenylethylamine and noradrenalin. No matter how high our levels of hormones are especially in the first months or years of love, our bodies still demand balance, therefore, those hormone levels will, eventually, decrease.&nbsp; In the end, we will find ourselves surrendering to some acts that might give a completely different image from our reality. Yet, the question that arises in this context is: &quot;Are we supposed to be under the control of our hormones that push us to be different? The answer might be <em><strong><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&quot;YES&quot;</span></strong></em>.&nbsp; This is the secret behind the wisdom that says: &quot;<em><strong><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We cannot live happily forever</span></strong></em>&quot;</span></span></span></span></p>'),
(117, 1, 117, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The treatment that leads to production of the stimuli inducing to cerebral communication and helps us have more understanding through using both hemispheres can simply start with one of the following means such as: laughing, exposing ourselves to sunshine, waking up early, going on holiday, changing routine, communicating with others, drinking alcohol, going dancing or even making love. All this will, definitely, help us pass over the traps set by our hormones since the latter cannot keep pushing us towards happiness all the time.&nbsp;&nbsp;&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; * * * * *&nbsp;</p>'),
(118, 1, 118, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:22.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Situated Behaviour</span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:15.0pt\"><span style=\"background-color:#0c0c0c\"><span style=\"font-family:&quot;Imprint MT Shadow&quot;\"><span style=\"color:white\">Different Change Strategies</span></span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The feminine mind deals with variables of life in a special way. We should note that a female has an inclination towards slow change. It is true that she tries to see the past off with deep consent, but she does not live it. This departure allows her to adopt a mechanism of slowness when heading towards new beginnings</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Her frequent slow actions are no more than a means of expressing the hesitation which actually characterizes the emotional aspect of her mental structure</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> As for the new starts, she tends to talk about them instead of going into them. She would visualize new things before turning them into real practice. However, this does not mean she does not enjoy affectionate flexibility towards the future. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">She would stumble and sometimes she would get preoccupied in pre-thinking of alternatives. She would also like to have detailed images of the future before getting into it. Nonetheless, as soon as she starts the process of change, she will view the new facts from a completely unimaginable perspective to the extent that she might come up with innovative and unprecedented thoughts.</span></span></span></span></p>'),
(119, 1, 119, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is the nature of the feminine mind to be constantly based on emergence of ideas; i.e., thinking of what has never been thought of before on condition that such a change would give her the feeling of being secure.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">What most characterizes the right cerebral hemisphere is coming up with genuine thoughts since it is in charge of all that is creative and qualitative in human life. Truly, we could have not achieved the innovative and creative ideas and works if intellectuals and inventors had not made use of the right cerebral hemisphere. In brief, without our feminine part, all humanity could have stayed in the stone ages</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp; </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The invention of the wheel, the Pyramids, building in dome style, discovery of the steam engine and feminine intuition altogether led to the emergence of Einstein&rsquo;s <em>&ldquo;Theory of Relativity&rdquo;</em>, thanks to the feminine mind of the masculine and feminine brains.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;</span></span></p>\r\n\r\n<p><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The male cannot understand the female&rsquo;s hesitation towards new circumstances before such circumstances turn to be realities. He tends to wrongly explain this situation by accusing the female of procrastination, inflexibility, and of being emotional and rash. Therefore, the occurrence of a tragic or disastrous event in the life of the female will assume changing stances because she does not follow the mechanism a male would follow in dealing with new situations. Thus, she needs time to forget and leave the past which occupies quite a large space of her right cerebral hemisphere.</span></span> <span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">If the female, generally speaking, happens to be extremely talkative, she would need time to talk about that past and about the losses that event (change) has caused. However, the most important point is that as soon as change starts, it would be easier for a female to act creatively in the very process of change.</span></span></p>'),
(120, 1, 120, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">When a male is under pressure, he will get to his mind, as a turtle would go inside its shell when it feels threatened. He would concentrate on solving the problem personally. Hence, he would choose the most persisting and most difficult problem of all and would concentrate on solving this problem only to the degree that he will temporarily be unaware of anything else. All other problems and responsibilities will be postponed; he </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">is unilateral in dealing with changes. His full consciousness will not be present when dealing with all facts; he is more indulged in crises and changeable circumstances.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">He keeps thinking and rethinking of his problem, which seems to have obsessed him, with the hope of finding a solution. In such a case, he will not be that competent in paying attention or considering feelings properly. He is entirely preoccupied with change and is not concerned but in accomplishing what he is working on. If he is unable of finding a solution to his problem, he will remain stuck whereas the female prefers to solve her problems via branching; i.e., sharing the problem with others so as to find a solution. She would go deep into the problem, see the pros and cons once and all over again. But, in the end, she will only do what she deems it right; she will act in accordance with her own viewpoint</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">!</span></span></span></span></p>'),
(121, 1, 121, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Again, we are in the course of discussing the purely feminine mind of a typical female or a few males whose feminine thinking has distinctively developed. The latter are not only those who are called <em>&ldquo;sissy&rdquo;</em>, for there are others included.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Sometimes, during the formation process, the embryo could be subject to two high dosages of estrogen and testosterone at the same time which will result in the formation of an extraordinary masculine-feminine mind for the same person whether male or female. In fact, such people who possess such minds are the ones who are exceptionally creative</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">!!!!!!</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We should bear in mind that dissimilarities in the change strategies of males and females are partly derived from the affectionate masculine responses centralized in the right lobe while, in the case of females, they spread over the two lobes.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is worth mentioning here that throughout the tension periods females undergo in their life, their bodies secrete the hormone of oxytocin which interacts with estrogen, thus,&nbsp; giving them the ability of social interaction and providing them with the possibility of being more involved in the process of change than males who start this process before females. However, during the tension periods which males undergo, they adopt a polarizing attitude; i.e., the attitude of (either&hellip;or) due to the hormone of testosterone which stimulates aggressive or defensive acts instead of digging up for compromising solutions. </span></span></span></span></p>'),
(122, 1, 122, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The male is faster in launching change while the female is more capable of adapting herself to the hard times of the process of change. Hence, finding outlets at critical moments is a characteristic of the feminine mind, therefore, in such cases, males should listen to the female they bear inside or to their partner since she is the most competent of dealing with the strategies of change with deeper insight. Probably, a lot of males cannot soon comprehend that they really need the female&#39;s remarks. They need much time to realize how important such remarks are, but this is often realized when it is too late.</span></span> </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">In actual reality, men violently and dually manage the change process of (either&hellip;or). Sometimes, women resist change hard, but the reasons behind such resistance are completely different from men&rsquo;s resistance which takes place at the very beginning. Women resist change due to hesitation and affectionate rejection to change while men resist due to their desire to remain attached to all what is static. That is to say, women resist out of fondness, intimate relatedness to a place and affectionate connection to the minute details about individuals while men resist out of fear of dealing with the unknown or fear of losing the determinants that allow control facts of the daily life</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span> </span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Because the female makes use of the right cerebral hemisphere, she exercises affection, containment, multiplicity and cooperation; she is more capable of adapting to variables as regards the family affairs than the male. She is highly competent in finding alternatives as to provide her family members with care and patronage. Hence, we would not be telling a secret if we say that it has been proved that women who work outside the house; i.e., they have jobs that help them earn their living, and are fully in charge of all the chores and requirements of the house are the most capable of shouldering and carrying out such a doubled responsibility.</span></span></span></span></p>');
INSERT INTO `app_book_page` (`bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`) VALUES
(123, 1, 123, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">If the woman happens to be away from home and the man is left alone with the children or left to do the house chores, he would not be able to perform this task. In such societies, the absence of the husband will be problematic regarding the financial requirements or being the higher authority inside the house. However, the woman can work outside and shoulder the children&rsquo;s responsibility all along with carrying out the house requirements. She would do all this in a tremendously distinguished way if compared to the man who would feel confused if he is to have those very responsibilities (when he loses his wife for a reason or another). That is to say, the man will suffer from loss or inability to fulfill all tasks. He will not be as competent when communicating with his children as a woman does.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">We focused, from the very beginning, on the female&#39;s capability of multiplicity, diversity, understanding and containment. The symbol of the female is <em>&ldquo;the womb&rdquo;</em>, </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">i.e. containment, or rather, the warm containment that preserves life. Because she is the mother of male and female, she is capable of understanding, comprehending, containing and anticipating the behaviour of both of them, let alone her ability to get to know all that is going on inside each of them. The father, on the other hand, can only provide advice and get involved in work. However, he can provide his children with tenderness and compassion every now and then; nevertheless, he will turn later to be leader of the house and the higher authority</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>'),
(124, 1, 124, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The woman can reconcile working while assisting her elderly parents whereas the man tends to hire somebody to take care of them preferring to be overloaded with work in order to pay the costs of this service</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The masculine mind has an inclination to confront the change himself. The feminine mind, however, tends to involve others in this change especially when it comes to health changes. At this point, those who enjoy a masculine mind are not usually in favor of revealing their suffering as regards the change of their health condition whereas those enjoying a feminine mind would not apprehend confronting the change. Those with a feminine mind prefer to reveal their suffering and would like to share it with others especially those whom a female believes to sympathize with her, such as her beloved or her sons and daughters</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>'),
(125, 1, 125, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">During the change process, the feminine mind adopts the principle of <em>&ldquo;exploration of the choices available&rdquo;</em>,&nbsp;and <em>&ldquo;the maneuver technique&rdquo;</em> away from huge losses. The feminine mind accepts the principle of <em>&ldquo;negotiation&rdquo;</em> and, to some extent, <em>&ldquo;bargains and concessions&rdquo;</em> with the purpose of avoiding any negative dramatic results.&nbsp; The male&#39;s strategy, on the other hand, is different. A male would adopt the technique of controlling and holding mechanisms, with the intention of evading enormous losses, but the excessive implementation of this strategy will probably lead to worse consequences due to lack of flexibility</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Since following the <em>&quot;necessity of choice&quot;</em> principle while running the process of change is a characteristic of the feminine mind, we come to know that the prominent leaders of the world who succeeded in managing grave crises were not those having strong will, firmness and good tactics because of the masculine mind they enjoyed. </span></span></p>'),
(126, 1, 126, NULL, '<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Going back to history, we realize that the losing leaders were those who confined their attitudes to the dichotomy of: (To be or not to be). The winners, however, were those who subjugated circumstances to their own will. They adapted themselves to incidents and did not deal with them from their own perspectives. They dealt with possibilities to be able to reach the appropriate time to attack their enemies. The most momentous historic stage was when men were able to achieve peace of the brave, i.e. the peace which cannot be achieved by the masculine mentality of &quot;either&hellip;or&quot;; rather, by utilizing the feminine mind</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span> <span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Within the strategies of change, the feminine mind does not confine itself to one or (maximum) two options. It searches for the best of a diversity of options, thus, <em>&ldquo;the necessity of choice&rdquo;</em> imposes itself as a feminine feature at a dramatic moment</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">To recapitulate, the mechanisms of change confrontation of a male manifest in quick action while, in the case of a female, they manifest in deep thinking, looking for details and consultation. Therefore, the masculine change technique is successful only when a prompt and instantaneous action is required. However, if </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">the change results are not clear and there is time to think deeply and thoroughly of a miscellany of options, the feminine approach will be more successful</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span> <span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Hesitation and contemplation will not be characteristics of change if the female is not attached to the past. In other words, when the female&rsquo;s evaluation of the current situation or the past is negative, the best way to convince her of the new circumstances; <em>&quot;variables&quot;</em>, will be through spotting the negative points of the past; a mechanism that destroys her typical mechanism; i.e. <em>&ldquo;nostalgia&rdquo;</em>.</span></span></span></span></p>'),
(127, 1, 127, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">It is wise to keep the female involved in the past since it is her nature to feel nostalgic. However, she should not be left to indulge and drown herself completely in that past because this will make her abstain from change. Her partner has to give her a hand when she is in such a situation by spotting the positive points of the coming change or future that resembles what she feels nostalgic for. But, he has to bear in mind that his aid should not appear as a kind of sympathy with that nostalgia. The first step towards acceptance of changes is embodied in the process of preparing her to acknowledge the sentimental losses resulting from the conditions of change. This cannot be attained unless the new conditions are not in conflict with her type of feeling</span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The most important stage that confirms the female&rsquo;s access into change is the attempt to step over the transitional stages; i.e., between nostalgia to the past and the new condition. This undoubtedly means <em>the necessity of reaching that stage as soon as possible</em></span></span><span dir=\"RTL\" lang=\"AR-SA\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">.</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\"> It is a period of moving from the old to the new. It is critical and uncomfortable, and is characterized by the possibility of deterioration. Attempting to control such a period seems to be quite difficult, therefore, in order not to regress to the past, the female has to quit it as quickly as possible.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">*&nbsp; *&nbsp; *&nbsp; *&nbsp; *&nbsp; *</span></span></span></span></p>'),
(128, 1, 128, NULL, '<p dir=\"LTR\" style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:24.0pt\"><span style=\"font-family:&quot;Script MT Bold&quot;\">Better Your Life &hellip;</span></span></strong></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:center\">&nbsp;</p>\r\n\r\n<ol>\r\n	<li dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Stop criticism.</span></span></span></span></li>\r\n</ol>\r\n\r\n<ol start=\"2\">\r\n	<li dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Learn to accept each other.</span></span></span></span></li>\r\n</ol>\r\n\r\n<ol start=\"4\">\r\n	<li dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Do not give negative interpretations for the motives behind what your partner says or does.</span></span></span></span></li>\r\n</ol>\r\n\r\n<ol start=\"5\">\r\n	<li dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Bear in mind that you are not always on the side of angels. The truth is the one which opposite is a truth as well. Truths are our convictions; they are not objects or absolutes. </span></span></span></span></li>\r\n</ol>\r\n\r\n<ol start=\"6\">\r\n	<li dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Stop holding to your belief that you are better and more knowledgeable than your partner. If you are a real man-of-knowledge, try to share this knowledge with others not to play the role of the instructor.</span></span></span></span></li>\r\n</ol>\r\n\r\n<ol start=\"7\">\r\n	<li dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Act justly all the time.</span></span></span></span></li>\r\n</ol>\r\n\r\n<ol start=\"8\">\r\n	<li dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Do not apply the rule of &quot;wrestling of wills&quot;. Substitute it with &quot;sharing of wills&quot;.</span></span></span></span></li>\r\n</ol>\r\n\r\n<ol start=\"9\">\r\n	<li dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Remember that life means &quot;taking and giving&quot;; however, it will be far better if you change the order to be &quot;giving and taking&quot;. </span></span></span></span></li>\r\n</ol>\r\n\r\n<ol start=\"10\">\r\n	<li dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Avoid having a narcissistic character.</span></span></span></span></li>\r\n</ol>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\">&nbsp;</p>'),
(129, 1, 129, NULL, '<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">11. You have to recall that imposing your opinion upon your partner means that the latter is going to either impose their opinion publicly (this will result in a direct collision between you), or they are going to impose it secretly which means (your separation).</span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">12. Do not count on miracles to sweep your problems away. Fast solutions do only exist in myths. Therefore, you have to bear in mind that you are dealing with a human being; not with an illusion. </span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">13. Do not think you can change anyone. Human beings have already been formed the way they are. You cannot replace their way of living with one you yourself make because you will project your own personality and the rest will be made by life.</span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">14. Do not consider the partner&#39;s attempts to change you as a threat. Just have self-confidence and tell yourself that those (already failing) attempts are a sign of love and a desire to be together forever. Your partner&#39;s attempts are demands you have to take into consideration so as to get what is positive and appropriate.</span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">15. Enjoy tranquility which is far more important than calm. Do not be rash or impatient because life does not approve such edgy people.</span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">16. No one whosoever can be a god. You are not perfect.</span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">17. Do not make openness to the other a chance to insult your partner.</span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">18. Stop arguing over irresolvable problems or problems you do not have the key to solve. If the other party insists on talking about them, listen carefully without agitation. Show real interest by sympathizing with your partner and calmly admitting that you cannot (now) find a way out but you promise you will (even if this seems to be almost impossible).</span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">19. Disparities and diversities in the minds and moods of people are part and parcel of nature. Therefore, it is good to feel the grace of disparity. </span></span></span></p>\r\n\r\n<p dir=\"LTR\" style=\"text-align:center\">&nbsp;</p>'),
(130, 1, 130, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">20. Read the hidden intents lying behind all the thoughts or accusations addressed by the other. However, do not act like a detective or a susceptible obsessive person. Only try to uncover the real reason through deep thinking and understanding the motives and reasons. Such actions might be motivated by love, foil, a desire to have further communication (through negative expressions) or a desire to achieve a special position that is already threatened.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">21. Do not get into quarrels over trivialities; such trivialities reveal the deeply-hidden things in our psychology.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">22. Change the course of the dialogue with your partner from the beginning and try not to forget yourself in the dialogue problems.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">23. Learn to use expressions like: &quot;I am sorry. I will try to have a better consideration of the issue next time&quot;.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">24. Use the position of the upper pyramid by putting your hands in this situation in front of your chest because they will prevent the other from exceeding the limits or offending you.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">25. Help the other party mitigate the impact of a hot debate between you.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">26. Mitigate your internal agitation and bear in mind that it occurs due to biological, physiological or hormonal reasons that have nothing to do with the issue of discussion.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">27. Abdominal breathing is recommended, but try not allow your chest expand more than your belly while discussions.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">28. Watch your thoughts; i.e., think of your own thinking.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">29. If you feel you have high blood pressure, stop talking immediately because you are not up to hold a sound or healthy discussion neither healthily nor mentally.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">30. Do not end the discussion you are having with your partner; only ask for postponing it. Do not give direct answers. Try to maneuver. In this way, you give yourself and the other party the opportunity to have deep positive thinking.</span></span></span></span></p>'),
(131, 1, 131, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">31. Do not allow a third party to interfere in any of you and your partner&#39;s discussions or conflicts because this will lead to triplet emotional and polemic discussions which will, in turn, aggravate the problems.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">32. Renounce the language of dissatisfaction. Use a language of forgiveness and remission and remember that <strong><em>to forgive</em></strong> means to let a situation or the word go for a while, but you restore it later on because it has a deep internal effect. <strong><em>To remit</em></strong>, however, means to turn the page of past actions with no impact left whatsoever. Anyway, both of you should exempt the other. If it is not the case, be the one who takes the initiative.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">33. Stop ruminating the past because you are currently living in the present and tomorrow is the future. In addition, there is no connection between past, present and future but in your own mind. If you are the type who restores the past that heavily, try to make this recur at a minimum and learn to put an end to such a recall at the end of the day.&nbsp; </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">34. Put an end to dialogue inhibitors which lie in the excessive expectations pinned on the other. Bear in mind &hellip; No provocative conversations &hellip; No urgent demands &hellip; No frowning &hellip; No tension &hellip; No high stern tone used &hellip; No underestimation of the feelings of the other &hellip; No contempt &hellip; No reiteration of childish, patriarchal or instructive words or comments &hellip; No passing of quick rash judgments &hellip; No partial listening nor listening superficially without getting the gist &hellip; Let your smile be your first step towards the other.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">35. Quit double standards and the idea that you are entitled to do what others are not entitled to.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">36. Do not take obsessive attitudes.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">37. Reproach lovingly. Do not do reproach out of defending yourself or attacking the other. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">38. Instill confidence in your partner.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">39. Raise the compliment dose and remember that since &quot;compliment&quot; and &quot;complete&quot; have the same root, they come to mean that both parties complete each other and are in need of one another.</span></span> </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">40. Boost the dreams and aspirations of your partner at least by words if you were not able to achieve them by actions.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>'),
(132, 1, 132, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">41. Your partner is not your rival. Therefore, always give them a loving and passionate look. This is highly recommended. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">42. Dignity should have no place in your relationship with your partner if you want to have an elegant and permanent relationship. </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Be sure that the other is not &quot;<strong><em>The Hell</em></strong>&quot;.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">43. The other is not a subject or a piece of dough that can be changed easily. The other is an individual who has been formed in their time and their own society and have had their own experiences. Your relationship with the other is nothing but exchange of experiences and interaction between your own individualities.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">44. Never ever think that your partner is the worst when they outburst. There might be a worse partner whom you have not met yet. Bear in mind that you have a good partner with bad circumstances. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">45. While reacting to your partner&#39;s complaints, avoid reminding them of your favors and how much you have offered. They are quite aware of this. Maybe they want more, or they want something qualitative at that very moment.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">46. Any trouble in the world is caused by two not one person. Therefore, you have to ask yourself about your very acts that caused that problem.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">47. The male has his own language, so does the female. Hence, the moment you feel that your partner does not understand you, be sure that you are using your own subjective language not his or hers. If you immediately use or switch to their language, you will be surprised at the results you will have</span></span><a href=\"#_ftn1\" name=\"_ftnref1\" title=\"\"><span dir=\"RTL\" lang=\"AR-SY\" style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">*</span></span></a><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">48. Avoid correcting your partner while they are talking. Do not say: &quot;Yes, but&hellip;&quot; because it will not give the results you aspire to have. Instead, you can say: &quot;Yes, I am convinced that you are well-aware of so and so&quot;. Your partner might not be aware of what you are saying, but once you say such words, you will urge them to have a sense of their own selves and superego; something which will, definitely, lead to a mutual understanding between you both.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">49. A male has to understand the motives of the female&#39;s outburst before and during her menstrual period. Premenstrual syndromes (PMS) come out of a severe drop of estrogen </span></span></span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">accompanied with pain, impatience and quick outburst. A has to know that those very symptoms create life; thus, they are a prerogative of the female. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">50. Learn how to have a language that involves &quot;<strong>a common vision</strong>&quot;, not the language of &quot;imposition&quot;. The common vision makes your partner a party, not just a mere passer-by.</span></span></span></span></p>\r\n\r\n<div>&nbsp;\r\n<hr />\r\n<div id=\"ftn1\">\r\n<p style=\"text-align:left\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><a href=\"#_ftnref1\" name=\"_ftn1\" title=\"\">*</a> &nbsp;See &quot;How a Female Thinks&quot; to understand the language of the female and differentiate it from that of the male.</span></span></p>\r\n</div>\r\n</div>'),
(133, 1, 133, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">51. Be careful not to make your partner feel that your mutual life might end up coincidentally just as it began. You should make use of the language of (forever) which makes both partners feel secure.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">52. Do not ever warn your partner, for you are not a policeman.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">53. Try to change your negative attitude towards your partner&#39;s behavior. Use a means of a positive transfer. For example, you can consider your partner&#39;s jealousy as something irritating and restricting; however, you can see it as an evidence of great love. The former view is destructive while the latter is constructive.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">54. Express your ideas accurately. No one would ever figure out what is going on in your mind. However, a male has to know that it is hard for a female to express her own ideas simply because she wants her male to understand her right away and from the first sign. Only this will prove his love towards her.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">55. Step over trivialities. Do not be like an archeologist excavating disturbing details.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">56. Allow your partner some freedom. Do not let them feel they are monitored or they have no will.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">57. Do not ever embarrass your partner in front of others. If you do so, you will drive them to think of getting rid of you because their image has been deformed. Your partner does not live only with you; they live with others and nourish their being from their image which is depicted in people&#39;s minds.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">58. Let tranquility overwhelm you and remember that it is tranquility that makes you relax, live in peace and take right decisions. Only people of tranquility can enjoy a peaceful life. They are a special kind of leaders, quoted everywhere.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">59. Do not make of a problem a major one. Apply your circuit on a parallel basis where if you have a failure somewhere, your life does not break down completely. Do not let your partner shoulder the burden of your problems and do not consider that one problem with them is the devil itself. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">60. When you feel your partner is embittering your life, try to please them. Only those who feel happy can impart happiness on others.</span></span></span></span></p>'),
(134, 1, 134, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">61. Put your work trouble aside the moment you step into your house as if you were taking off your clothes. No one inside the house is responsible for what is outside but you.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">62. Stop using the language of (internal/external) and do not be skeptical about the motives. You will never get into the depths. The other is not a conspirator. They are probably not.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">63. Do not expect the other to meet your ultimate demands. Expect on the basis of what they are expected to do.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">64. Accept apology with love and modesty, not with superiority and triumph.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">65. Odd behavior might look like insanity or genius. View them as genius, for they can bestow happiness upon your life.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">66. When you doubt the other&hellip;. wait! </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">67. For a relationship to survive, there should be no conditions. Make your relationship a grant without conditions, for a relationship based on conditions is almost a contract that can be annulled. Relationship without any conditions whatever is an everlasting contract of love.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">68.&nbsp;</span></span></span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Do not compare your partner neither implicitly nor explicitly, and neither before them nor before others. No one is perfect. No one can be a god. The demerits of the one you do not know are much more than your partner&#39;s. Hence, it is better not to venture the unknown.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">69. Be proud of your partner. At least, remember that you have chosen them out of millions of people. You must have hit the bull&#39;s eye.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">70. Make use of your intuition not your premonition. Learn that intuition and feeling are highly interrelated.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>'),
(135, 1, 135, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">71. Do not say &quot;No.&quot; Learn to say it in a way that does not make the other feel rejected.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">72. Do not feel guilty and do not make your partner feel guilty, either.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">73. Pay attention to the other to make them calm down. Never ignore them.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">74. The female has to give the male the chance to stay in his cave as long as he wishes. She does not have to urge him to communicate or ask him a lot of questions.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">75. Partners do not have to compete to obtain the approval of one another.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">76. Maintain mutual trust.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">77. Avoid telling lies because they constitute the way that leads to mistrust accumulation. It could be a one-way ticket.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">78. A post-conflict kiss can stop conflict recurrence.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">79. Never feel you are a victim. This feeling kills you both.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">80. Do not compare your work and responsibilities to those of your partner&#39;s. Each should act according to their own abilities. No one has to be like the other.</span></span> </span></span></p>');
INSERT INTO `app_book_page` (`bpage_id`, `book_id`, `page_num`, `page_image`, `page_text`) VALUES
(136, 1, 136, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">81. Compliment the female for whatever work she does no matter how simple it is. This has two implications. This first is that the female feels better when praised and the second is that her capability of giving increases endlessly whenever she is verbally boosted.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">82. Support your words with deeds, and remember that the female is an auditory creature. She is extremely sensitive and very cautious lest she is deceived.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">83.&nbsp;</span></span></span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">After a hard day of work, a female would adapt to the Animus, for daily work often needs utilizing the left cerebral hemisphere. Therefore, she needs time and effort as to regain herself and her feminine. The access can be through sentiments and feelings</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">84. Everything the female asks the male to do or bring will lose value. Things get value only when the male gets his female what she does not ask for; i.e., when he estimates what she is in need of. The female would not approve requesting the male at all, for this will be a real admission of the male&#39;s ingratitude which her femininity never accepts. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">85. It is not necessary that every negatively answered question by a female means &quot;No&quot;, for this could be an attempt to urge you raise further questions, to protest against being not cared for, to tell her that you understand her without verbal expression, or to take action without her requesting you. In all cases, she says &quot;yes&quot; and protests by &quot;No&quot;. Remember that when a female says &quot;No&quot;, she means &quot;perhaps&quot;, and when she says &quot;perhaps&quot;, she means &quot;yes&quot;, but when she says &quot;yes&quot;, this means she is <strong><em>NOT</em></strong> a female. </span></span></span></span></p>'),
(137, 1, 137, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">86. You should avoid the direct questions of a female when she is provoked. She is in a state of catharsis or discharging negative energy, so do not let her escalate. Let her continue raising questions and reply her briefly or listen carefully. Be careful not to maneuver or use her indirect way of talking. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">87. The female&#39;s mind is formulated in such a way as to receive which is a starting point to giving. She is extremely concerned about details and she adores gifts whatever their value is. She is so keen on communication and feeling the other&#39;s caring for her. Bringing her a valuable gift once in a while is fine; however, bringing her gifts every now and then even if they are not very precious will please her. The measure here is based on quality not quantity</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">88. Be aware of dealing with a female while she is in the regular period. The lower rates of estrogen imply an increase of testosterone. This stimulates extreme aggressiveness, and means having illogical discussions. It arises in her sexual desire, but it causes her depression. Do not argue with her in such a period. She lies on the opposite side to her nature. The male inside her (testosterone) is higher than the female (estrogen). Her body and mind are turned upside down. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">89. The female is in need of full support in order to keep in touch with the feminine side which has decreased with the decrease of estrogen. Such a situation will unconsciously recall the feminine side of the male (tenderness, warmth, love, weakness&hellip;.etc). Even though, it is important not to exaggerate in playing the female&#39;s role after that because women do not favor weak men. They love those who encompass them with tenderness at this specific time of the regular period.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">90. Most artists and poets are distinguished with their exceptional </span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">right cerebral hemisphere</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">. Thus, their exaggeration of their feminine needs is so prominent. They are most capable of drawing the attention to their beauty. At the beginning, the female will be enchanted since they fulfill part of her femininity. But, realizing femininity happens only with fully masculine men. Therefore, you have to be careful when you have that flow of feminine sentiments. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>'),
(138, 1, 138, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">91. Be careful not to request the female to be your mother, sister, girlfriend and beloved. She only has one job, and she will never ever be your mother. She will not respect that male who holds to his mother. You might assume that your love to your mother will complement her love and that she will appreciate it and consider it as a guarantee to her love. This does not work. She thinks in a completely different way. She does not respect the man who has not been weaned yet. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">92. The balance you strike between your masculinity and femininity will urge her to respect and love you.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">93. When the female is not in harmony with her very nature as a female; i.e., when she does excessive masculine work or when she undergoes sharp decrease of estrogen, she tries to have many biological practices so as to balance her psychological situation. In such a case, the male should not blame her for this tendency. He should bring her back to the field of femininity through sentimental practices and through indulging her in feminine affiliations along with sharing part of her burden. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">94. The female, who is indulged in the masculine life, requests the male to be gentler and more delicate when dealing with her. In fact, she is demanding herself of that through him. Therefore, do not be harsh with her; assist her through containing and sympathizing with her to help her reveal her femininity, softness and delicacy. Beware of being looked at as a female, and at the same time do not be harsh and offensive.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">95. The female&#39;s misery is a result of being indulged. She indulges in emotional interaction with several issues all at once, which confuse her. So, do not blame her. She is not biologically prepared to deal with issues separately. She deals with things collectively not individually. You have to remember that females do not feel at ease when they perform masculine activities. Hence, their only way of expressing that is through their non-stop and constant narration of their problems until they release what is in their inside.</span></span></span></span></p>'),
(139, 1, 139, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">96. A female has a tendency towards looking as oppressed. She has an unconscious belief that she will not obtain sympathy unless the others feel she is made unjust and is badly treated. Do not forget this when you deal with her exaggeration of being a victim of the feeling of injustice. However, when she finds nobody to listen to her complaint, she will shrink and launch self &ndash;destructive actions such as self-torment self-impeachment, and making ultimate judgments against herself. In this case, she aims at punishing the other throughout punishing herself. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">97. It is a natural characteristic of a female that she does not ask for help; however, she gets upset when the male does not offer that help. Therefore, you ought to examine and guess what her needs, and then act in response to her undeclared demands.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">98. Notice that the female gives constantly, nevertheless, she waits for your giving in order to recharge hers. The biggest mistake a male would commit is when he imagines that he is dealing with a god who gives persistently and silently because this god does not want the giving of others. So, avoid the explosion of those who silently give and you do not even think of rewarding.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">99. When a female does not make use of women&#39;s language, do not imagine that she is satisfied with this masculine image, no matter how much self assurance and satisfaction she expresses for competing men and occupying a prominent position in males&#39; world. She is living in contrast to her identity. No matter how much satisfaction her position brings her; she has nostalgia to be the centre of males&#39; care and love unlike some women who undergo confusions in their sexual identity due to hormonal causes. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">100.&nbsp;</span></span></span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Every female is a unique creature from her point of view. Her narcissism does not give the chance for anyone to compare her to any other female in the whole universe. Be careful not to compare her to any female; do not ask her to be a copy of any other model. The most dangerous of all is when you demand her to be a duplicate of an ex-female you have met in your life.</span></span></span></span></p>'),
(140, 1, 140, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">101. The more you praise her personal characteristics, the more you enhance those attributes. Do not persist on criticizing her negative aspects. Overlook her negative sides by enhancing and occasionally exaggerating her positive sides. This is the key to dealing with the inherent negative aspects of her structure and character.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">102. Do not raise her jealousy unless she is a masochist. The masochist female is fond of the male who ignores her and insults her femininity through jealousy or betrayal. It is a part of self-torturing mechanism. A non-masochist female is narcissistic and is concerned about her femininity as previously mentioned. However, some phallic women; women experiencing castration complex, occasionally exaggerate their feminine reaction against jealousy or betrayal through excessive verbal violence or excessive hostility under the title of &quot;dignity&quot;. Females commonly feel tranquility with those who afford them reassurance and appreciate their femininity.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">103. Do not prevent female from crying. She releases her tension by crying. You have to know that the female who has excessive fits of crying is the most feminine. This type is contrary to the masculine female who does not prefer to cry in order not to be accused of weakness. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">104.&nbsp;</span></span></span></span><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Sexual interaction is not favorable and inappropriate at her extreme anger or emotion unless she is a masochist. A non-masochist female does not like having sex if she is irritated. Never interrupt her desire through discussing any other issue that necessitates thinking nor blame her for any behavior. Do not insult her femininity because this will instantly bring her desire to a halt.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">105. The female is constantly in need of those who elevate her feeling of eternal youth and everlasting beauty. Bearing in mind that there is no ugly woman on earth; each woman has her own particular beauty in a specific aspect. The beauty of woman could not be perfect excluding very rare cases, thus, boost her feeling of her own beauty, get her assured and point to her beauty persistently. This will help her put an end to any feeling related to her identity crisis. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>'),
(141, 1, 141, NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">106. All fashions promote the female&rsquo;s tendency to nakedness through the binary opposition of &ldquo;exterior-interior&rdquo;; i.e., disclosing part of the body while concealing another part which incites seduction. This is part of the female&rsquo;s natural choice of clothes; however, this is accompanied with a paradox: the female desires to expose her full or semi nakedness, but she will be uncomfortable if she does not feel her male&rsquo;s jealousy over her. She herself makes it for public in her own way and to whoever she decides. She wants to show it, but not to sell it. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">107. You should recognize the tremendous care a female allots to her skin. Her skin equals her; it is her identity and the front fa&ccedil;ade. The skin is what body of the female wears. It is not merely a mirror to her emotions. It is the wall that protects her internal depth. Hence, incessant mutual touching is a way of reviving her relation with her body.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">108. Accusing a female of having an inclination towards deceiving is true and untrue at the same time. She resorts to the technique of maneuver and gets away from the yes/no or either/or techniques. She revolves around her issues, thus, she looks like a deceiver. Beware of being convinced that she is really deceitful. She is mysterious because of her feminine structure. So, try to read what she refuses to declare; behave accordingly. </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">109. Every female; deep in her unconscious, considers herself as symbol of the utmost femininity. Therefore, when she falls in love, she would yearn to embalm her beloved to keep him for herself only. She would surround him and would even wish not to allow him meet or deal with any other female. </span></span></span></span></p>'),
(142, 1, 142, NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:25.0pt\"><span style=\"font-family:&quot;Monotype Corsiva&quot;\">Index</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Introduction &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.&hellip;&hellip;&hellip;..</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Males and Females As &ldquo;Situated Knowers&rdquo; &hellip;&hellip;&hellip;</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Male and Female: Two Creatures .. Two Worlds </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Cognitive and Biological Differences between Males </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&amp; Females </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;....&hellip;&hellip;..&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Situated Sex &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Are Hormones and Conflicts Related? &hellip;&hellip;&hellip;&hellip;&hellip;</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Who Can Do What &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Know Your Partner&rsquo;s Representative System - Deal </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Accordingly </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&hellip;&hellip;.&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The Polemic State between Males and Females </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Woman A Situated Sex and Psychology </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Women and Depression</span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Pre-Menstrual Syndrome&nbsp; </span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Natal Depression</span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Menopause </span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Feminine Jealousy</span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Narcissism</span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Females and Pregnancy </span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">The Changing Image of Motherhood </span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Nasty Women </span></span></em></span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Types Of Nasty Women (As A Situated Psychology) </span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Nagging: Situated Demanding</span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Exaggeration</span></span></em></span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Situated &hellip; But &hellip; Will Meet &hellip;&hellip;&hellip;&hellip;&hellip;.&hellip;.&hellip;&hellip;.</span></span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Chemistry of Love among Human Beings</span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Endorphin &quot;The Magic Hormone&quot;</span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Oxytocin &quot;The Cuddle and Romance </span></span></em></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:120px; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp; Hormone </span></span></em></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Is Oxytocin Secretion the Same for Males </span></span></em></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:120px; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp; and Females</span></span></em></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Love and Accompanying Signs of Sadness </span></span></em></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Love and Understanding Will Not Last </span></span></em></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:120px; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp; Forever</span></span></em></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Situated Behaviour &hellip;&hellip;&hellip;&hellip;.&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">Different Change Strategies</span></span></em></span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Garamond&quot;,&quot;serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Better Your Life &hellip; &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</span></span></span></span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `app_consultation`
--

DROP TABLE IF EXISTS `app_consultation`;
CREATE TABLE IF NOT EXISTS `app_consultation` (
  `cons_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Consultation Question Id',
  `user_id` int(11) NOT NULL COMMENT 'Consultation price',
  `cat_id` int(11) NOT NULL COMMENT 'Category',
  `cstatus_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Status, FK',
  `cons_amount` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Consultation Selected Price',
  `cons_message` mediumtext NOT NULL COMMENT 'Request Message',
  `cons_file` varchar(200) DEFAULT NULL COMMENT 'Attached File',
  `cons_audio` varchar(200) DEFAULT NULL COMMENT 'Attached Audio',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`cons_id`),
  KEY `status_id` (`cstatus_id`),
  KEY `user_id` (`user_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_consultation`
--

INSERT INTO `app_consultation` (`cons_id`, `user_id`, `cat_id`, `cstatus_id`, `cons_amount`, `cons_message`, `cons_file`, `cons_audio`, `ins_datetime`) VALUES
(1, 2, 1, 1, '0.00', 'النجدةةةةةةةةةةةةةةةةةةةةةة', NULL, NULL, '2019-03-13 17:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `app_consultation_category`
--

DROP TABLE IF EXISTS `app_consultation_category`;
CREATE TABLE IF NOT EXISTS `app_consultation_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL COMMENT 'Status',
  `cat_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Order',
  `cat_name` varchar(200) NOT NULL COMMENT 'Name',
  `cat_Price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Price',
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_consultation_category`
--

INSERT INTO `app_consultation_category` (`cat_id`, `status_id`, `cat_order`, `cat_name`, `cat_Price`) VALUES
(1, 1, 0, 'Free', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `app_consultation_category_name`
--

DROP TABLE IF EXISTS `app_consultation_category_name`;
CREATE TABLE IF NOT EXISTS `app_consultation_category_name` (
  `ncat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `cat_id` int(11) NOT NULL COMMENT 'Category, FK',
  `lang_id` int(11) NOT NULL COMMENT 'Language, FK',
  `cat_name` varchar(200) NOT NULL COMMENT 'Name',
  `cat_desc` text,
  PRIMARY KEY (`ncat_id`),
  UNIQUE KEY `cat_lang` (`cat_id`,`lang_id`),
  KEY `cat_id` (`cat_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_consultation_category_name`
--

INSERT INTO `app_consultation_category_name` (`ncat_id`, `cat_id`, `lang_id`, `cat_name`, `cat_desc`) VALUES
(1, 1, 2, 'Free', 'Free'),
(2, 1, 1, 'مجاني', 'مجاني');

-- --------------------------------------------------------

--
-- Table structure for table `app_consultation_status`
--

DROP TABLE IF EXISTS `app_consultation_status`;
CREATE TABLE IF NOT EXISTS `app_consultation_status` (
  `cstatus_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `cstatus_name` varchar(200) NOT NULL DEFAULT '' COMMENT 'Status Name',
  PRIMARY KEY (`cstatus_id`),
  UNIQUE KEY `cstatus_name` (`cstatus_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_consultation_status`
--

INSERT INTO `app_consultation_status` (`cstatus_id`, `cstatus_name`) VALUES
(3, 'Done'),
(1, 'New'),
(2, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `app_consult_answer`
--

DROP TABLE IF EXISTS `app_consult_answer`;
CREATE TABLE IF NOT EXISTS `app_consult_answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User Id, FK',
  `cons_id` int(11) NOT NULL COMMENT 'Consultation Id, FK',
  `answer_text` mediumtext NOT NULL COMMENT 'Answer Message',
  `answer_file` varchar(200) DEFAULT NULL COMMENT 'Attached File',
  `answer_audio` varchar(200) DEFAULT NULL COMMENT 'Attached Audio',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`answer_id`),
  KEY `user_id` (`user_id`),
  KEY `cons_id` (`cons_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_consult_answer`
--

INSERT INTO `app_consult_answer` (`answer_id`, `user_id`, `cons_id`, `answer_text`, `answer_file`, `answer_audio`, `ins_datetime`) VALUES
(1, 2, 1, 'ىورةىءؤرءؤرىلانؤرولازؤر', NULL, NULL, '2019-03-13 17:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `app_consult_assign`
--

DROP TABLE IF EXISTS `app_consult_assign`;
CREATE TABLE IF NOT EXISTS `app_consult_assign` (
  `assign_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Consultation Question Id',
  `user_id` int(11) NOT NULL COMMENT 'User Id, FK',
  `cons_id` int(11) NOT NULL COMMENT 'Consultation, FK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`assign_id`),
  KEY `user_id` (`user_id`),
  KEY `cons_id` (`cons_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_consult_assign`
--

INSERT INTO `app_consult_assign` (`assign_id`, `user_id`, `cons_id`, `status_id`, `ins_datetime`) VALUES
(1, 1, 1, 1, '2019-03-13 17:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `app_notification`
--

DROP TABLE IF EXISTS `app_notification`;
CREATE TABLE IF NOT EXISTS `app_notification` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `for_id` tinyint(4) NOT NULL COMMENT 'For FK',
  `lang_id` int(11) NOT NULL COMMENT 'Language',
  `nstatus_id` tinyint(4) NOT NULL COMMENT 'Status',
  `notif_title` varchar(200) NOT NULL COMMENT 'Title',
  `notif_text` text NOT NULL COMMENT 'Text',
  `ins_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Inserted Datetime',
  `upd_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated Datetime',
  PRIMARY KEY (`notif_id`),
  KEY `for_id` (`for_id`),
  KEY `lang_id` (`lang_id`),
  KEY `nstatus_id` (`nstatus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_notification`
--

INSERT INTO `app_notification` (`notif_id`, `for_id`, `lang_id`, `nstatus_id`, `notif_title`, `notif_text`, `ins_datetime`, `upd_datetime`) VALUES
(1, 0, 2, 1, 'Test', 'Test Test Test Test Test Test Test Test Test Test Test', '2019-04-10 23:08:16', '2019-04-10 23:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `app_notification_for`
--

DROP TABLE IF EXISTS `app_notification_for`;
CREATE TABLE IF NOT EXISTS `app_notification_for` (
  `nfor_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `notif_id` int(11) NOT NULL COMMENT 'Notification',
  `user_id` int(11) NOT NULL COMMENT 'Member',
  `nstatus_id` tinyint(4) NOT NULL COMMENT 'Status',
  PRIMARY KEY (`nfor_id`),
  KEY `notif_id` (`notif_id`),
  KEY `user_id` (`user_id`),
  KEY `nstatus_id` (`nstatus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_notification_for`
--

INSERT INTO `app_notification_for` (`nfor_id`, `notif_id`, `user_id`, `nstatus_id`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_notification_status`
--

DROP TABLE IF EXISTS `app_notification_status`;
CREATE TABLE IF NOT EXISTS `app_notification_status` (
  `snotif_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `notif_id` int(11) NOT NULL COMMENT 'Notification',
  `user_id` int(11) NOT NULL COMMENT 'Member',
  `nstatus_id` tinyint(4) NOT NULL COMMENT 'Status',
  `notif_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`snotif_id`),
  KEY `notif_id` (`notif_id`),
  KEY `seen_id` (`nstatus_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_notification_status`
--

INSERT INTO `app_notification_status` (`snotif_id`, `notif_id`, `user_id`, `nstatus_id`, `notif_datetime`) VALUES
(1, 1, 2, 3, '2019-04-10 23:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `app_notif_for`
--

DROP TABLE IF EXISTS `app_notif_for`;
CREATE TABLE IF NOT EXISTS `app_notif_for` (
  `for_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `for_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`for_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_notif_for`
--

INSERT INTO `app_notif_for` (`for_id`, `for_name`) VALUES
(0, 'ALL'),
(1, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `app_notif_status`
--

DROP TABLE IF EXISTS `app_notif_status`;
CREATE TABLE IF NOT EXISTS `app_notif_status` (
  `nstatus_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `nstatus_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`nstatus_id`),
  UNIQUE KEY `nstatus_name` (`nstatus_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_notif_status`
--

INSERT INTO `app_notif_status` (`nstatus_id`, `nstatus_name`) VALUES
(1, 'New'),
(3, 'Received'),
(4, 'Seen'),
(2, 'Sent');

-- --------------------------------------------------------

--
-- Table structure for table `app_test`
--

DROP TABLE IF EXISTS `app_test`;
CREATE TABLE IF NOT EXISTS `app_test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `test_num` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Number',
  `test_iname` varchar(200) NOT NULL COMMENT 'Name',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `test_price` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Price',
  `test_image` varchar(50) DEFAULT NULL COMMENT 'Image',
  PRIMARY KEY (`test_id`),
  UNIQUE KEY `test_num` (`test_num`),
  UNIQUE KEY `test_iname` (`test_iname`),
  KEY `test_status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_test`
--

INSERT INTO `app_test` (`test_id`, `test_num`, `test_iname`, `status_id`, `test_price`, `test_image`) VALUES
(0, 0, 'No Test', 2, '0.00', 't.jpg'),
(1, 1, 'Emotional Intelligence (EQ)', 1, '0.00', 't1.jpg'),
(2, 2, 'Femininity And Masculinity Of The Brain (FM)', 1, '0.00', 't2.jpg'),
(3, 3, 'Situated Emotion (SE)', 1, '20.00', 't3.jpg'),
(4, 4, 'Sexual Imprint (SI)', 1, '50.00', 't4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `app_test_evaluate`
--

DROP TABLE IF EXISTS `app_test_evaluate`;
CREATE TABLE IF NOT EXISTS `app_test_evaluate` (
  `eval_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `test_id` int(11) NOT NULL COMMENT 'Test, FK',
  `lang_id` int(11) NOT NULL COMMENT 'Language FK',
  `gend_id` tinyint(4) NOT NULL COMMENT 'Gender, FK',
  `eval_from` decimal(10,0) NOT NULL DEFAULT '0' COMMENT 'Total Result From',
  `eval_to` decimal(10,0) NOT NULL DEFAULT '99999' COMMENT 'Total Result To',
  `eval_text` text NOT NULL COMMENT 'Evaluation',
  PRIMARY KEY (`eval_id`),
  UNIQUE KEY `test_id_2` (`test_id`,`lang_id`,`gend_id`,`eval_from`,`eval_to`),
  KEY `test_id` (`test_id`),
  KEY `lang_id` (`lang_id`),
  KEY `gend_id` (`gend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_test_evaluate`
--

INSERT INTO `app_test_evaluate` (`eval_id`, `test_id`, `lang_id`, `gend_id`, `eval_from`, `eval_to`, `eval_text`) VALUES
(94, 1, 1, 1, '-100', '50', 'أنت شخص تتمتع بذكاء وجداني منخفض، و لذلك ستصادف صعوبات في إنشاء علاقات ناجحة مع محيطك المهني أو الاجتماعي. أنت بحاجة إلى اتباع دورات خاصة ترفع من نسبة ذكائك الوجداني و تجعلك أكثر قدرة على التكيف مع الظروف و التأقلم مع الأشخاص. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(95, 1, 1, 1, '51', '100', 'أنت شخص ذو ذكاء وجداني متوسط وهذا يعني أن علاقاتك لا تنجح بسرعة وتحتاج إلى المزيد من التدريبات لدى اختصاصين لكي تتمكن من اتباع أساليب جديدة في التعامل مع الآخرين ولكي تحقق النجاح في حياتك. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(96, 1, 1, 1, '101', '130', 'نسبة ذكائك الوجداني جيدة عموما وتستطيع التكيف بشكل جيد جدا مع محيطك لكنك أحيانا تفقد القدرة على التحكم بمجريات الأمور. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(97, 1, 1, 1, '131', '150', 'أنت من أكثر الأشخاص قدرة على التكيف مع الآخرين على المستوى الإنساني و تستطيع التأقلم مع الظروف المحيطة بشكل لافت. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(98, 1, 1, 1, '151', '200', 'ممتاز، أنت شخص تتمتع بذكاء وجداني لا يضاهى وتستطيع أن تقيم علاقات ناجحة لأنك تتمتع بقدرة متميزة على التكيف مع المجتمع و في علاقاتك الإنسانية. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(99, 1, 1, 2, '-100', '50', 'أنت شخص تتمتع بذكاء وجداني منخفض، و لذلك ستصادف صعوبات في إنشاء علاقات ناجحة مع محيطك المهني أو الاجتماعي. أنت بحاجة إلى اتباع دورات خاصة ترفع من نسبة ذكائك الوجداني و تجعلك أكثر قدرة على التكيف مع الظروف و التأقلم مع الأشخاص. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(100, 1, 1, 2, '51', '100', 'أنت شخص ذو ذكاء وجداني متوسط وهذا يعني أن علاقاتك لا تنجح بسرعة وتحتاج إلى المزيد من التدريبات لدى اختصاصين لكي تتمكن من اتباع أساليب جديدة في التعامل مع الآخرين ولكي تحقق النجاح في حياتك. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(101, 1, 1, 2, '101', '130', 'نسبة ذكائك الوجداني جيدة عموما وتستطيع التكيف بشكل جيد جدا مع محيطك لكنك أحيانا تفقد القدرة على التحكم بمجريات الأمور. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(102, 1, 1, 2, '131', '150', 'أنت من أكثر الأشخاص قدرة على التكيف مع الآخرين على المستوى الإنساني و تستطيع التأقلم مع الظروف المحيطة بشكل لافت. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(103, 1, 1, 2, '151', '200', 'ممتاز، أنت شخص تتمتع بذكاء وجداني لا يضاهى وتستطيع أن تقيم علاقات ناجحة لأنك تتمتع بقدرة متميزة على التكيف مع المجتمع و في علاقاتك الإنسانية. لكننا لا نضمن توافقك مع الطرف الآخر دون إجراء الإختبارات المكملة الواردة في التطبيق.'),
(104, 1, 2, 1, '-100', '50', 'You enjoy a very low EQ. Therefore, you find difficulty establishing successful relations with your colleagues or in your social environment. We strongly recommend that you join special EQ courses to help you adapt with conditions and people in a better way. However, we do not make sure that you are going to be compatible with the partner without submitting the complementary tests in our Application.'),
(105, 1, 2, 1, '51', '100', 'You enjoy a medium EQ. This means you do not achieve success in your relations very quickly. You need more exercises at the hand of experts to be able to adopt new techniques in dealing with others to achieve success in life. However, we do not make sure that you are going to be compatible with the partner without submitting the complementary tests in our Application.'),
(106, 1, 2, 1, '101', '130', 'good'),
(107, 1, 2, 1, '131', '150', 'very good'),
(108, 1, 2, 1, '151', '200', 'excellent'),
(109, 1, 2, 2, '-100', '50', 'You enjoy a very low EQ. Therefore, you find difficulty establishing successful relations with your colleagues or in your social environment. We strongly recommend that you join special EQ courses to help you adapt with conditions and people in a better way. However, we do not make sure that you are going to be compatible with the partner without submitting the complementary tests in our Application.'),
(110, 1, 2, 2, '51', '100', 'You enjoy a medium EQ. This means you do not achieve success in your relations very quickly. You need more exercises at the hand of experts to be able to adopt new techniques in dealing with others to achieve success in life. However, we do not make sure that you are going to be compatible with the partner without submitting the complementary tests in our Application.'),
(111, 1, 2, 2, '101', '130', 'good'),
(112, 1, 2, 2, '131', '150', 'very good'),
(113, 1, 2, 2, '151', '200', 'excellent'),
(114, 2, 1, 1, '-999', '0', 'دماغك ذو ذكورة مفرطة، وهنا تكون المضغة قد تعرضت في طور تشكّلها الباكر لكمية كبيرة من هرمون التستوسترون وأنت لا تصلح لعلاقة من النساء بالمطلق والأفضل أن تعيش بعيداً من العلاقات مع الإناث لأنك غير مؤهل لها.وأنت غاية في التفكير الدوغمائي المتصلب والمتعنت ومن الصعب أن تقبل رأياً آخر. وتميلون للعنف الجسدي المفرط إلى حد السادية.'),
(115, 2, 1, 1, '1', '50', 'دماغك أكثر ذكورة من المعتاد ومستوى التستوسترون في الجسم أعلى.أنت من الأشخاص يتّسمون عادة بالعقلانية والحزم والقدرة على التحليل وصياغة الكلام، ويميلون إلى السلوك الانضباطي والمنظم جيداً والمُحافظ. وقدرتك على التدبير المالي وعلى القيام بالإحصائيات عالية، بينما تلعب المشاعر عندهم دوراً ضئيلاً أو ليس لها دور على الإطلاق. وتميلون للعنف الجسدي الأقرب إلى السادية.'),
(116, 2, 1, 1, '51', '150', 'أنتم من ذوي السمات الذكرية المنطقية الكلاسيكية والنمطية والمحافظة في التفكير إلى حد ما. يمكنك التكيّف نسيباً مع إمرأة مطواعة ونمطية ولا تمارس التفكير كثيراً أو النقد وهن نساء قليلات في الحياة.'),
(117, 2, 1, 1, '151', '180', 'أنتم من ذوي السمات الذكرية المنطقية الكلاسيكية والنمطية والمحافظة في التفكير إلى حد ما. يمكنك التكيّف نسيباً مع إمرأة مطواعة ونمطية ولا تمارس التفكير كثيراً أو النقد وهن نساء قليلات في الحياة.'),
(118, 2, 1, 1, '181', '200', 'أنتم ذوو صفات (الأنثوية) العالية للدماغ وهنا إمكانية المواهب الإبداعية، الفنية و الموسيقية، أكبر لديكم. و يتخذ هؤلاء الأشخاص قراراتهم بشكل عفوي معتمدين على حدسهم. وهم يستشعرون بعض المشاكل التي لا يتنبّه إليها الآخرون، ويستطيعون حلّها بشكل خلاق وبمقدرة كبيرة على تفّهم الآخرين.'),
(119, 2, 1, 1, '201', '999', 'إمكانية الميل المثلي جنسياً أكبر لديكم، وأنت من النوع ذي التفكير الأنثوي وهنالك حالة ندعوها عدم الانسجام بين هويتك الجنسية وهويتك العقلية ومن الصعب أن تقيم علاقة عاطفية أو جنسية مع النساء إلا كما لو أنها علاقة سُحاقية.'),
(120, 2, 1, 2, '-999', '70', 'أنت من النوع الذكري المحض. ويبدو أن جسدك جسد أنثى وعقلك عقل رجل. وبالتالي فإنك تعانين من اختلاف في الهوية؛ فهويتك الجسدية أنثى بينما هويتك العقلية والجنسية ذكر'),
(121, 2, 1, 2, '71', '130', 'إمكانية ميولك المثلية كبيرة وميلك لممارسة الجنس كما لو أنك ذكر. وعقلك مُنظم بطريقة عالية ونمطية ومحافظة جداً كما لو أنك ذكر. لا ميول خلاقة لديك. أنت تحبين السيطرة على الذكور ولديك ميول للقيادة وأحياناً للبخل'),
(122, 2, 1, 2, '131', '150', 'أنت من النوع الذي يدعي بالعقل المزدوج الأنثوي- الذكري لكنك أميل إلى الذكورة ومن الممكن بناء علاقة مع الذكور ولكن بصعوبة لأنك من النوع المنافس والذي لا يستسيغ قيادة الرجال.'),
(123, 2, 1, 2, '151', '180', 'أنتم من النوع ذي الازدواجية الجنسية في التفكير وأنتم أفضل الناس في الذكاء الانفعالي (الوجداني).أنتم لا تُظهرون ما يسمى بطريقة تفكير ذكرية صرفة أو أنثوية صرفة وإنما تتمتعون بتفكير ليّن له أهمية بالغة ضمن المجموعة التي تبحث عن حل للمشاكل. ويكون لدى هؤلاء الأشخاص موهبة طبيعية لعقد صداقات مع الجنسين. ولا مشكلة لديكم بالتكيف مع الآخرين ولكن تحتاجون من الجنس الآخر من يُقدّر مواهبهم العالية'),
(124, 2, 1, 2, '181', '240', 'أنت من النساء النمطيات والعاديات في الميول العاطفية والجنسية، ويمكنكم التعايش مع الذكور النمطيين بصورة معقولة وحياتكم ستكون عادية جداً.'),
(125, 2, 1, 2, '241', '300', 'أنت من النساء عاليات الأنوثة في التفكير وفي الحاجات الجنسية، تحتاجون إلى من يهتم بكن كثيراً، وحدسكم يسيركن، وتحبنّ الرجل القوي المسيطر إلى حدّ ما. وتميلن إلى من يسيطر عليكن ولكن لا يأسر حريتكن. والعواطف تشغل مكانة كبيرة في حياتكن. والجنس لديكم لا يكون مقبولاً لديكم بصورته التقليدية، لأنكم تحتاجونه بشكل فانتازي غير عادي. ولديكم ميول مازوشية واحياناً ليزبيانية.'),
(126, 2, 1, 2, '301', '999', 'أنت من النساء اللواتي يعتبرن بالغات الأنوثة في التفكير من حيث الحدس والشعور والعواطف هي مركز اهتمامكن ولا تفكرن بشكل منطقي إطلاقاً إنما بالحدس والغرائز المطلقة. ورغبتكن الجنسية عالية جداً جداً إلى حدّ غير عادي فأنتن من الشبقات جنسياً ولا تستطيعن العيش بلا جنس دائم وفانتازي وغير عادي بل مُبالغ في فانتازيته.ولديكم ميول ليزبيانية ومازوشية مفرطة أحياناً.'),
(127, 2, 2, 1, '-999', '0', 'You have hyper-masculine mind. In the early weeks of your formation as a fetus in your mother\'s womb, you received a high dose of testosterone; therefore, you can never have a relation with women and it is better if you stay out of relationships as you are not eligible for this. You enjoy a very intransigent dogmatic thinking. It is difficult for you to accept other opinions and tend to be excessively violent to the degree of sadism.'),
(128, 2, 2, 1, '1', '50', 'You are more masculine than usual with higher testosterone levels in your body. You have traits that make you rational, decisive, disciplined, well-organized, reserved and have the ability of analysis and wording. You are able to make financial management and handle big statistics. Emotions play a little role in your life or it might not have a role at all. You tend to have physical violence that is closer to sadism.'),
(129, 2, 2, 1, '51', '150', 'you enjoy typical, classical, logical masculine traits and mental reservation. You do well with a typical and submissive woman who does not tend to depend on thinking a lot and does not criticize, though such kind of women hardly exits.'),
(130, 2, 2, 1, '151', '180', 'you enjoy typical, classical, logical masculine traits and mental reservation. You do well with a typical and submissive woman who does not tend to depend on thinking a lot and does not criticize, though such kind of women hardly exits.'),
(131, 2, 2, 1, '181', '200', 'Your brain enjoys feminine traits, which means you enjoy more creative musical or artistic talents than others. You take your decisions spontaneously depending on your intuition. You can sense the presence of problems that others cannot see. You can solve problems creatively and you can show great understanding of others.'),
(132, 2, 2, 1, '201', '999', 'It is a big probability to develop homosexuality. You think femininely but you have disharmony between your sexual and mental identity. Therefore, it is hard to make an emotional or sexual relationship with women, and you make sex in a lesbian manner.'),
(133, 2, 2, 2, '-999', '70', 'You are merely masculine. You are suffering from a ID confusion. You have a female body but a masculine mind and sex orientation'),
(134, 2, 2, 2, '71', '130', 'It is a big probability to develop homosexuality, and you practise sex as if you were a female. You have a typical and highly-organised mind. You are very reserved as if you were a male. You don\'t have creativity, but you like dominate men. You tend to like driving and sometimes you tend to be stingy.'),
(135, 2, 2, 2, '131', '150', 'You tend to think masculinely and femininely but you are more a masculine brain. You can hardly make relations with men because are the competing type which men don\'t favor.'),
(136, 2, 2, 2, '151', '180', 'You enjoy the masculine and feminine thinking at the same time. Your EQ is quite high. You don\'t show mere masculine or feminine thinking. You show resilience in your pursuit for solutions. You are naturally gifted in making friendships with both sexes. You can easily adapt but you are still in need of the opposite sex to appreciate your great talents.'),
(137, 2, 2, 2, '181', '240', 'You have ordinary and typical emotional and sexual disposition. You can considerably accommodate with typical males, and your life will not be unusual.'),
(138, 2, 2, 2, '241', '300', 'You are highly feminine as regards your way of thinking and sexual needs. You need who really cares for you. You rely on intuition a lot and like the powerful and somewhat domineering man. You like the one who has control over you but doesn\'t restrain you. Feelings occupy a great part of your life. You cannot accept traditional love-making; you tend to like sexual fantasies. You have masochist and sometimes lesbian dispositions.'),
(139, 2, 2, 2, '301', '999', 'You are extremely feminine in thinking as regards intuition and feelings. Emotions are the focus of your interests. You never think logically, rather, instinctively and intuitively. Your sexual needs are very high that you can be considered concupiscent that you cannot live without fantasy sex and sometimes hyper-fantasy sex. You have excessive lesbian and masochist dispositions.'),
(140, 3, 1, 1, '0', '25', ''),
(141, 3, 1, 1, '26', '50', ''),
(142, 3, 1, 1, '51', '75', ''),
(143, 3, 1, 1, '76', '100', ''),
(144, 3, 1, 2, '0', '25', ''),
(145, 3, 1, 2, '26', '50', ''),
(146, 3, 1, 2, '51', '75', ''),
(147, 3, 1, 2, '76', '100', ''),
(148, 3, 2, 1, '0', '25', ''),
(149, 3, 2, 1, '26', '50', ''),
(150, 3, 2, 1, '51', '75', ''),
(151, 3, 2, 1, '76', '100', ''),
(152, 3, 2, 2, '0', '25', ''),
(153, 3, 2, 2, '26', '50', ''),
(154, 3, 2, 2, '51', '75', ''),
(155, 3, 2, 2, '76', '100', ''),
(156, 4, 1, 1, '0', '26', ''),
(157, 4, 1, 1, '26', '51', ''),
(158, 4, 1, 1, '51', '76', ''),
(159, 4, 1, 1, '76', '100', ''),
(160, 4, 1, 2, '0', '26', ''),
(161, 4, 1, 2, '26', '51', ''),
(162, 4, 1, 2, '51', '76', ''),
(163, 4, 1, 2, '76', '100', ''),
(164, 4, 2, 1, '0', '26', ''),
(165, 4, 2, 1, '26', '51', ''),
(166, 4, 2, 1, '51', '76', ''),
(167, 4, 2, 1, '76', '100', ''),
(168, 4, 2, 2, '0', '26', ''),
(169, 4, 2, 2, '26', '51', ''),
(170, 4, 2, 2, '51', '76', ''),
(171, 4, 2, 2, '76', '100', '');

-- --------------------------------------------------------

--
-- Table structure for table `app_test_name`
--

DROP TABLE IF EXISTS `app_test_name`;
CREATE TABLE IF NOT EXISTS `app_test_name` (
  `ntest_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `test_id` int(11) NOT NULL COMMENT 'Test, FK',
  `lang_id` int(11) NOT NULL COMMENT 'Language, FK',
  `test_name` varchar(200) NOT NULL COMMENT 'Name',
  `test_desc` text,
  PRIMARY KEY (`ntest_id`),
  UNIQUE KEY `test_lang` (`test_id`,`lang_id`),
  KEY `test_id` (`test_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_test_name`
--

INSERT INTO `app_test_name` (`ntest_id`, `test_id`, `lang_id`, `test_name`, `test_desc`) VALUES
(11, 1, 1, 'الذكاء الوجداني', '<p dir=\"rtl\" style=\"text-align:justify\">اختبار يبين مدى الذكاء في التعامل مع الآخرين بإيجابية وفي كيفية الاستجابة للأوضاع المستجدة. يعكس قدرة الشخص على التحكم بعواطفه التأقلم مع البيئة الاجتماعية المحيطة الأشخاص الذين يحصلون على نتائج عالية في اختبار الذكاء العاطفي أو الوجداني يتمتعون بصحة عقلية أكبر من غيرهم وأداء وظيفي أكثر تميزاً كما أنهم يمتلكون مهارات قيادية جيدة</p>'),
(12, 1, 2, 'Emotional Intelligence (EQ)', '<p style=\"text-align:justify\">EQ is a test that measures the aptitude to deal with others positively and respond to the difficult emerging conditions. It reveals the ability to monitor one\\\'s emotions and use emotional information to adapt to the social environment People with high scores of EQ are said to enjoy greater mental health, have distinguished job performance and more potent leadership skills</p>'),
(21, 2, 1, 'الذكورة والأنوثة في المخ', '<p dir=\"rtl\" style=\"text-align:justify\">هو اختبار يبين نسبة استخدام المرء لنصفي مخه علماً أن النصف الأيمن الأنثوي (anima) هو المسؤول عن الحب والحدس والشعور والجمال والإبداع في حين أن النصف الأيسر الذكوري (animus) هو المسؤول عن المنطق والحواس. إذاً كل منا يستخدم نصفي مخه معاً ولكن بدرجات متفاوتة لكل منهما ويعود ذلك لتركيبة مخه، وهذا ما سيكشفه الاختبار.</p>'),
(22, 2, 2, 'Femininity And Masculinity Of The Brain (FM)', '<p style=\"text-align:justify\">This is a test that measures to what extent a person uses their right or left cerebral hemispheres taking into consideration that the right cerebrum (anima) is responsible for love, intuition, feelings, beauty and creativity whereas the left cerebrum (animus) is responsible for logic and the senses. Hence, taking the FM test will reveal the masculinity of femininity of one\'s brain.</p>'),
(31, 3, 1, 'البصمة العاطفية', '<p dir=\"rtl\" style=\"text-align:justify\">اختبار مبتكر لتبيان البصمة المخية في المشاعر والحب والانفعالات</p>'),
(32, 3, 2, 'Situated Emotion (SE)', '<p style=\"text-align:justify\">This is an innovative test that uncovers the emotional imprint of a person as regards feelings, love and emotions.</p>'),
(41, 4, 1, 'البصمة الجنسية', '<p dir=\"rtl\" style=\"text-align:justify\">اختبار خلاق يبين الخارطة الجنسية أي البصمة الجنسية لكل إنسان والتي تأتيه بالولادة جراء عملية الانقسام الخيطي في بطن الأم والتي تحدد منطقتين مسؤولتين عن الجنس في المخ وهما قرن آمون ومنطقة ما تحت المهاد البصري ولهذا فكل إنسان له طبيعة جنسية خاصة.</p>'),
(42, 4, 2, 'Sexual Imprint (SI)', '<p style=\"text-align:justify\">This is a creative test that shows the sexual map or sexual imprint of a person which they get ever since the mitosis phase that takes place in the uterus. This phase defines the two areas responsible for sexual inclination in the brain; i.e., the hippocampus and hypothalamus, and endow a person with their specific sexual nature.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `app_test_question`
--

DROP TABLE IF EXISTS `app_test_question`;
CREATE TABLE IF NOT EXISTS `app_test_question` (
  `qstn_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `test_id` int(11) NOT NULL COMMENT 'Test, FK',
  `lang_id` int(11) NOT NULL COMMENT 'Language, FK',
  `gend_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Gender',
  `qstn_num` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Number',
  `qstn_text` varchar(500) NOT NULL COMMENT 'Question',
  `qstn_ansr1` varchar(500) NOT NULL COMMENT 'Answer 1',
  `qstn_ansr2` varchar(500) NOT NULL COMMENT 'Answer 2',
  `qstn_ansr3` varchar(500) DEFAULT NULL COMMENT 'Answer 3',
  `qstn_ansr4` varchar(500) DEFAULT NULL COMMENT 'Answer 4',
  `qstn_rep1` varchar(500) NOT NULL COMMENT 'Reply 1',
  `qstn_rep2` varchar(500) NOT NULL COMMENT 'Reply 2',
  `qstn_rep3` varchar(500) DEFAULT NULL COMMENT 'Reply 3',
  `qstn_rep4` varchar(500) DEFAULT NULL COMMENT 'Reply 4',
  `qstn_val1` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Degree 1',
  `qstn_val2` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Degree 2',
  `qstn_val3` decimal(6,2) DEFAULT '0.00' COMMENT 'Degree 3',
  `qstn_val4` decimal(6,2) DEFAULT '0.00' COMMENT 'Degree 4',
  PRIMARY KEY (`qstn_id`),
  UNIQUE KEY `test_Uuk` (`test_id`,`lang_id`,`gend_id`,`qstn_num`),
  KEY `test_id` (`test_id`),
  KEY `gend_id` (`gend_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=475 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_test_question`
--

INSERT INTO `app_test_question` (`qstn_id`, `test_id`, `lang_id`, `gend_id`, `qstn_num`, `qstn_text`, `qstn_ansr1`, `qstn_ansr2`, `qstn_ansr3`, `qstn_ansr4`, `qstn_rep1`, `qstn_rep2`, `qstn_rep3`, `qstn_rep4`, `qstn_val1`, `qstn_val2`, `qstn_val3`, `qstn_val4`) VALUES
(103, 1, 1, 1, 1, 'إذا كنت في ملعب كرة قدم تشاهد مباراة ولاحظت هرجاً و مرجاً حولك و اضطراباً على وجوه الناس. ماذا تفعل؟', 'تستمر في متابعة المباراة ولا تنتبه كثيرا لما يجري', 'تراقب الأمر بهدوء وسكينة وحذر', 'قليل من الجوابين السابقين', 'لا أعرف', '', '', '', '', '20.00', '20.00', '20.00', '0.00'),
(104, 1, 1, 1, 2, 'ذهبت مع عدة أصدقاء إلى ملعب ولكن حاول بعضهم استبعادك من اللعب. ماذا تفعل؟', 'تتصرف بشكل طبيعي', 'تحاول أن تقنع الرافض لك بقبولك', 'لا تكترث للأمر كثيراً', 'تحاول تشتيت انتباهك لتنسى أنك منبوذ', '', '', '', '', '0.00', '20.00', '0.00', '0.00'),
(105, 1, 1, 1, 3, 'تصور نفسك طالباً وتقدمت إلى الامتحان ولكنك وجدت أنك رسبت في إحدى المواد. ماذا تفعل؟', 'تقول لنفسك إنك ستعدّ خطة لتحسين وضعك بها من خلال دراسة منهجية قاسية', 'تقرر أن تتحسن في المستقبل وتترك الأمر', 'تقول لنفسك إن هذا المقرر ليس له قيمة كبيرة وتركز بدلا منه على مقررات أخرى', 'تذهب إلى مدرس المادة وتطلب منه أن يجعلك تجتاز الامتحان أو تدفع له رشوة لكي تنجح', '', '', '', '', '20.00', '0.00', '0.00', '0.00'),
(106, 1, 1, 1, 4, 'تصور نفسك تعمل في العلاقات العامة لأول مرة. طرقت أبواباً كثيرة و كلها رفضتك مما جعلك تشعر بالتخاذل. ماذا تفعل؟', 'تقول لنفسك ربما كان حظي أفضل غدا', 'تراجع أسلوبك لتكتشف إذا كان فيه ما يقلل من كفاءتك بالعمل', 'تجرب شيئا جديدا في عملك القادم وتبتكر ما ليس مفكراً به', 'تجرب عملا جديدا غير العلاقات العامة', '', '', '', '', '0.00', '0.00', '20.00', '0.00'),
(107, 1, 1, 1, 5, 'أنت مسؤول عن جماعة ما وسمعت أحد العاملين يقول نكتة عن شخص آخر في المجموعة. ماذا تفعل؟', 'تتجاهله', 'تستدعي قائل النكتة وتوبخه وتعاقبه فوراً', 'تواجهه فورا أن هذه النكتة غير مناسبة وغير مقبولة في مجموعة ذات بُعدٍ إنساني', 'تقترح على قائل النكتة أن يلتحق ببرنامج للتدرب على التسامح', '', '', '', '', '0.00', '0.00', '20.00', '0.00'),
(108, 1, 1, 1, 6, 'تجلس مع صديق في مقهى. يمر بجواركما سائق ويكاد أن يخترق المقهى ويقتلكما، فيستشيط صديقك غضباً. ماذا تفعل؟', 'تتناسى الموضوع ما دمت لم تصب بسوء وتقول إن المسألة بسيطة', 'تحاول أن تشتت انتباهه بقصة.', 'تؤيد كل ما يقوله عن السائق الآخر كي تشعره بتفهمك وتعاطفك', 'تختلق له واقعة مشابهة حدثت لك وأنك كنت تشعر بما يشعر هو به وأنه أثناء شدة انفعالك رأيت السائق يرتكب حادثاً مشابهاً ويخرج من نافذة السيارة ويصاب إصابة بالغة.', '', '', '', '', '0.00', '5.00', '5.00', '20.00'),
(109, 1, 1, 1, 7, 'تتناقش أنت وزوجتك أو حبيبتك ولكن يتصاعد النقاش ويتطور إلى صياح ويصبح كلاكما في حالة غضب لدرجة أنكما تشتمان بعضكما. ما افضل شيء يمكن أن تفعله؟', 'تأخذ استراحة لمدة عشرين دقيقة ثم تعاود النقاش بهدوء.', 'تنهي السجال وتلتزم الصمت بصرف النظر عما تقوله شريكتك', 'تعتذر وتطلب منها أن تعتذر أيضا', 'تتوقف برهة وتعيد ترتيب أفكارك وتعرضها بدقة بقدر الإمكان وتتابع الحوار', '', '', '', '', '20.00', '0.00', '0.00', '0.00'),
(110, 1, 1, 1, 8, 'أسندت إليك رئاسة لجنة مهمتها حل مشكلة في العمل بصورة جديدة لا نمطية ومبدعة لأن العمل وصل إلى طريق مسدود بالنموذج السائد. ما أفضل أسلوب تقوم به؟', 'تكتب جدولاً زمنياً لمناقشة كل جوانب المشكلة وهكذا تحسن استخدام الوقت', 'تتيح الوقت لأعضاء اللجنة ليتعرفوا على بعضهم البعض بشكل أفضل', ' تطلب من كل عضو في اللجنة أن يقدم ما لديه من أفكار لحل المشكلة', 'تبدأ بجلسة عصف ذهني وتشجع كل عضو في اللجنة أن يقول ما يخطر بباله مهما كان ولكن بشكل جماعي', '', '', '', '', '0.00', '20.00', '0.00', '20.00'),
(111, 1, 1, 1, 9, 'لديك قريب صغير في السن. لاحظت أنه منذ ولادته خجول جداً وحساس للغاية ويخاف من الأشخاص الجدد. ماذا تفعل؟', 'تتقبله كما هو وتفكر في كيفية حمايته من المواقف التي تسبب إزعاجه', 'تعرضه على اختصاصي نفسي ليساعده', 'تتعمد أن تعرضه لمواقف جديدة وأشخاص لا يعرفهم حتى يتغلب على مخاوفه', 'تعمل على إشراكه في سلسلة من الخبرات التي تتحداه ولكن في حدود قدراته حتى يتعلم انه قادر على التصرف في المواقف الجديدة', '', '', '', '', '0.00', '5.00', '0.00', '20.00'),
(112, 1, 1, 1, 10, 'تريد أن تتعلم لغة غير لغتك الرسمية رغم أنك فشلت في تعلمها منذ سنين والآن أتيحت لك الفرصة لتبدأ وأنت تريد تحقيق أكبر استفادة من الوقت. ماذا تفعل؟', 'تصنع لنفسك برنامجاً صارماً للتعلم يومياً وخاصة القواعد وحفظ الكلمات', 'تختار قصصاً بهذه اللغة لكي تشجعك على تعلم هذه اللغة', 'تتعلم بمزاجك أي فقط حين تشعر في الرغبة في التعليم ', 'تختار نصاً صعباً بهذه اللغة وتحاول تعلمها بمزيد من الجهد', '', '', '', '', '0.00', '20.00', '0.00', '0.00'),
(113, 1, 1, 2, 1, 'إذا كنت في ملعب كرة قدم تشاهد مباراة ولاحظت هرجاً و مرجاً حولك و اضطراباً على وجوه الناس. ماذا تفعل؟', 'تستمر في متابعة المباراة ولا تنتبه كثيرا لما يجري', 'تراقب الأمر بهدوء وسكينة وحذر', 'قليل من الجوابين السابقين', 'لا أعرف', '', '', '', '', '20.00', '20.00', '20.00', '0.00'),
(114, 1, 1, 2, 2, 'ذهبت مع عدة أصدقاء إلى ملعب ولكن حاول بعضهم استبعادك من اللعب. ماذا تفعل؟', 'تتصرف بشكل طبيعي', 'تحاول أن تقنع الرافض لك بقبولك', 'لا تكترث للأمر كثيراً', 'تحاول تشتيت انتباهك لتنسى أنك منبوذ', '', '', '', '', '0.00', '20.00', '0.00', '0.00'),
(115, 1, 1, 2, 3, 'تصور نفسك طالباً وتقدمت إلى الامتحان ولكنك وجدت أنك رسبت في إحدى المواد. ماذا تفعل؟', 'تقول لنفسك إنك ستعدّ خطة لتحسين وضعك بها من خلال دراسة منهجية قاسية', 'تقرر أن تتحسن في المستقبل وتترك الأمر', 'تقول لنفسك إن هذا المقرر ليس له قيمة كبيرة وتركز بدلا منه على مقررات أخرى', 'تذهب إلى مدرس المادة وتطلب منه أن يجعلك تجتاز الامتحان أو تدفع له رشوة لكي تنجح', '', '', '', '', '20.00', '0.00', '0.00', '0.00'),
(116, 1, 1, 2, 4, 'تصور نفسك تعمل في العلاقات العامة لأول مرة. طرقت أبواباً كثيرة و كلها رفضتك مما جعلك تشعر بالتخاذل. ماذا تفعل؟', 'تقول لنفسك ربما كان حظي أفضل غدا', 'تراجع أسلوبك لتكتشف إذا كان فيه ما يقلل من كفاءتك بالعمل', 'تجرب شيئا جديدا في عملك القادم وتبتكر ما ليس مفكراً به', 'تجرب عملا جديدا غير العلاقات العامة', '', '', '', '', '0.00', '0.00', '20.00', '0.00'),
(117, 1, 1, 2, 5, 'أنت مسؤول عن جماعة ما وسمعت أحد العاملين يقول نكتة عن شخص آخر في المجموعة. ماذا تفعل؟', 'تتجاهله', 'تستدعي قائل النكتة وتوبخه وتعاقبه فوراً', 'تواجهه فورا أن هذه النكتة غير مناسبة وغير مقبولة في مجموعة ذات بُعدٍ إنساني', 'تقترح على قائل النكتة أن يلتحق ببرنامج للتدرب على التسامح', '', '', '', '', '0.00', '0.00', '20.00', '0.00'),
(118, 1, 1, 2, 6, 'تجلس مع صديق في مقهى. يمر بجواركما سائق ويكاد أن يخترق المقهى ويقتلكما، فيستشيط صديقك غضباً. ماذا تفعل؟', 'تتناسى الموضوع ما دمت لم تصب بسوء وتقول إن المسألة بسيطة', 'تحاول أن تشتت انتباهه بقصة.', 'تؤيد كل ما يقوله عن السائق الآخر كي تشعره بتفهمك وتعاطفك', 'تختلق له واقعة مشابهة حدثت لك وأنك كنت تشعر بما يشعر هو به وأنه أثناء شدة انفعالك رأيت السائق يرتكب حادثاً مشابهاً ويخرج من نافذة السيارة ويصاب إصابة بالغة.', '', '', '', '', '0.00', '5.00', '5.00', '20.00'),
(119, 1, 1, 2, 7, 'تتناقش أنت وزوجتك أو حبيبتك ولكن يتصاعد النقاش ويتطور إلى صياح ويصبح كلاكما في حالة غضب لدرجة أنكما تشتمان بعضكما. ما افضل شيء يمكن أن تفعله؟', 'تأخذ استراحة لمدة عشرين دقيقة ثم تعاود النقاش بهدوء.', 'تنهي السجال وتلتزم الصمت بصرف النظر عما تقوله شريكتك', 'تعتذر وتطلب منها أن تعتذر أيضا', 'تتوقف برهة وتعيد ترتيب أفكارك وتعرضها بدقة بقدر الإمكان وتتابع الحوار', '', '', '', '', '20.00', '0.00', '0.00', '0.00'),
(120, 1, 1, 2, 8, 'أسندت إليك رئاسة لجنة مهمتها حل مشكلة في العمل بصورة جديدة لا نمطية ومبدعة لأن العمل وصل إلى طريق مسدود بالنموذج السائد. ما أفضل أسلوب تقوم به؟', 'تكتب جدولاً زمنياً لمناقشة كل جوانب المشكلة وهكذا تحسن استخدام الوقت', 'تتيح الوقت لأعضاء اللجنة ليتعرفوا على بعضهم البعض بشكل أفضل', ' تطلب من كل عضو في اللجنة أن يقدم ما لديه من أفكار لحل المشكلة', 'تبدأ بجلسة عصف ذهني وتشجع كل عضو في اللجنة أن يقول ما يخطر بباله مهما كان ولكن بشكل جماعي', '', '', '', '', '0.00', '20.00', '0.00', '20.00'),
(121, 1, 1, 2, 9, 'لديك قريب صغير في السن. لاحظت أنه منذ ولادته خجول جداً وحساس للغاية ويخاف من الأشخاص الجدد. ماذا تفعل؟', 'تتقبله كما هو وتفكر في كيفية حمايته من المواقف التي تسبب إزعاجه', 'تعرضه على اختصاصي نفسي ليساعده', 'تتعمد أن تعرضه لمواقف جديدة وأشخاص لا يعرفهم حتى يتغلب على مخاوفه', 'تعمل على إشراكه في سلسلة من الخبرات التي تتحداه ولكن في حدود قدراته حتى يتعلم انه قادر على التصرف في المواقف الجديدة', '', '', '', '', '0.00', '5.00', '0.00', '20.00'),
(122, 1, 1, 2, 10, 'تريد أن تتعلم لغة غير لغتك الرسمية رغم أنك فشلت في تعلمها منذ سنين والآن أتيحت لك الفرصة لتبدأ وأنت تريد تحقيق أكبر استفادة من الوقت. ماذا تفعل؟', 'تصنع لنفسك برنامجاً صارماً للتعلم يومياً وخاصة القواعد وحفظ الكلمات', 'تختار قصصاً بهذه اللغة لكي تشجعك على تعلم هذه اللغة', 'تتعلم بمزاجك أي فقط حين تشعر في الرغبة في التعليم ', 'تختار نصاً صعباً بهذه اللغة وتحاول تعلمها بمزيد من الجهد', '', '', '', '', '0.00', '20.00', '0.00', '0.00'),
(123, 1, 2, 1, 1, 'If you were watching a football match on the playground and found that some hustle and bustle began to rise and people looked disturbed, what would you do?', 'You go on watching the match and do not care for what is going on.', 'You watch calmly and cautiously.', 'Parts of A and B. ', 'I don\'t know.', '', '', '', '', '20.00', '20.00', '20.00', '0.00'),
(124, 1, 2, 1, 2, 'You went with some friends to the playground, and someone tried to drive you out and prevent you from playing. What would you do?', 'You act normally. ', 'You try to persuade the one who excluded you to re-involve you. ', 'You do not care that much. ', 'You try to engage yourself in an activity to forget that you are excluded. ', '', '', '', '', '0.00', '20.00', '0.00', '0.00'),
(125, 1, 2, 1, 3, 'Imagine you were a student and had submitted an exam. When the results came out, you found that you failed a subject, what would you do?', 'You tell yourself you are going to set a plan to improve yourself through rigorous and systematic study. ', 'You decide to improve yourself in the future not now.', 'You tell yourself that this subject is not of much importance and that there are other subjects you had better concentrate on.', 'You ask the teacher to change your mark or you bribe them to let you pass the exam of that subject. ', '', '', '', '', '20.00', '0.00', '0.00', '0.00'),
(126, 1, 2, 1, 4, 'Imagine you were working in the PR Department for the first time. You exerted much effort to promote your company but all was in vain. What would you do?', 'You say things will go better tomorrow. ', 'You review your way lest it has flaws that may undermine your competence. ', 'You try something new next time and come up with something never thought of before. ', 'You try another job than Public Relations. ', '', '', '', '', '0.00', '0.00', '20.00', '0.00'),
(127, 1, 2, 1, 5, 'You are responsible for a group, and one day you heard an employee cracking a joke about someone in the group. What would you do?', 'You ignore them.', 'You call the joke teller and reproach them. ', 'Tell the joke teller directly the joke is improper and unaccepted within a group with human dimensions. ', 'You propose that the joke teller should follow a program on tolerance. ', '', '', '', '', '0.00', '0.00', '20.00', '0.00'),
(128, 1, 2, 1, 6, 'You are sitting with a friend in a cafe. A car passes by and runs into the cafe and almost kills you. Your friend gets furious. How would you react?', 'You forget about it as long as no harm has been done. ', 'You start speaking to them as a way to divert their attention. ', 'You try to agree with every word they say about the driver to let them feel your sympathy. ', 'You make up a story about a similar incident in which you had the same feelings of outrage. You tell them how you could see that driver a few minutes later having a similar incident and how they get out of the car window and get seriously injured.', '', '', '', '', '0.00', '5.00', '5.00', '20.00'),
(129, 1, 2, 1, 7, 'You are having a discussion with your spouse or partner. Discussion heats and you both get angry and begin yelling at each other. What would you do? ', 'You take a 20-minute break before you calmly resume your discussion. ', 'You end the polemic and commit to silence regardless of what your spouse/partner says. ', 'You apologize to them and ask them to apologize. ', 'You stop for a moment and try to reorganize your ideas to be able to present them as accurately as possible.', '', '', '', '', '20.00', '0.00', '0.00', '0.00'),
(130, 1, 2, 1, 8, 'You have been appointed as head of a committee that is assigned to solve work problems in an atypical innovative way because the available work style has proven to be futile. What is the best method you follow to achieve that?', 'You put a time table to discuss all aspects of the problems occurring, making better use of time in the meanwhile. ', 'You give the committee members enough time to know each other in a better way. ', 'You ask every member to present the ideas they have in mind that help solve the problem. ', 'You start a brain storming session and encourage every member to participate and say what they think. ', '', '', '', '', '0.00', '20.00', '0.00', '20.00'),
(131, 1, 2, 1, 9, 'You notice that a young relative of yours is shy and very sensitive, and they have fears of new people ever since they were born. What would you do?', 'You accept them as they are and think of how to protect them against situations that may cause them annoyance. ', 'You take them to a psychological counselor to help them overcome the problem. ', 'You intentionally expose them to situations where they meet new people and new situations to help them overcome their fears. ', 'You involve them in new experiences within their ability limits that challenge them but teach them how be able to respond to new circumstances. ', '', '', '', '', '0.00', '5.00', '0.00', '20.00'),
(132, 1, 2, 1, 10, 'You long to learn a language you started learning years ago. Now, you have the chance. You want to have the optimum use of time. What would you do?', 'You follow a daily rigorous program of study focusing on learning the grammar rules and memorizing words. ', 'You choose to read stories in that language to help you learn it. ', 'You learn when you are in mood and feel motivated. ', 'You choose a difficult text in that language and try to learn it with much effort. ', '', '', '', '', '0.00', '20.00', '0.00', '0.00'),
(133, 1, 2, 2, 1, 'If you were watching a football match on the playground and found that some hustle and bustle began to rise and people looked disturbed, what would you do?', 'You go on watching the match and do not care for what is going on.', 'You watch calmly and cautiously.', 'Parts of A and B. ', 'I don\'t know.', '', '', '', '', '20.00', '20.00', '20.00', '0.00'),
(134, 1, 2, 2, 2, 'You went with some friends to the playground, and someone tried to drive you out and prevent you from playing. What would you do?', 'You act normally. ', 'You try to persuade the one who excluded you to re-involve you. ', 'You do not care that much. ', 'You try to engage yourself in an activity to forget that you are excluded. ', '', '', '', '', '0.00', '20.00', '0.00', '0.00'),
(135, 1, 2, 2, 3, 'Imagine you were a student and had submitted an exam. When the results came out, you found that you failed a subject, what would you do?', 'You tell yourself you are going to set a plan to improve yourself through rigorous and systematic study. ', 'You decide to improve yourself in the future not now.', 'You tell yourself that this subject is not of much importance and that there are other subjects you had better concentrate on.', 'You ask the teacher to change your mark or you bribe them to let you pass the exam of that subject. ', '', '', '', '', '20.00', '0.00', '0.00', '0.00'),
(136, 1, 2, 2, 4, 'Imagine you were working in the PR Department for the first time. You exerted much effort to promote your company but all was in vain. What would you do?', 'You say things will go better tomorrow. ', 'You review your way lest it has flaws that may undermine your competence. ', 'You try something new next time and come up with something never thought of before. ', 'You try another job than Public Relations. ', '', '', '', '', '0.00', '0.00', '20.00', '0.00'),
(137, 1, 2, 2, 5, 'You are responsible for a group, and one day you heard an employee cracking a joke about someone in the group. What would you do?', 'You ignore them.', 'You call the joke teller and reproach them. ', 'Tell the joke teller directly the joke is improper and unaccepted within a group with human dimensions. ', 'You propose that the joke teller should follow a program on tolerance. ', '', '', '', '', '0.00', '0.00', '20.00', '0.00'),
(138, 1, 2, 2, 6, 'You are sitting with a friend in a cafe. A car passes by and runs into the cafe and almost kills you. Your friend gets furious. How would you react?', 'You forget about it as long as no harm has been done. ', 'You start speaking to them as a way to divert their attention. ', 'You try to agree with every word they say about the driver to let them feel your sympathy. ', 'You make up a story about a similar incident in which you had the same feelings of outrage. You tell them how you could see that driver a few minutes later having a similar incident and how they get out of the car window and get seriously injured.', '', '', '', '', '0.00', '5.00', '5.00', '20.00'),
(139, 1, 2, 2, 7, 'You are having a discussion with your spouse or partner. Discussion heats and you both get angry and begin yelling at each other. What would you do? ', 'You take a 20-minute break before you calmly resume your discussion. ', 'You end the polemic and commit to silence regardless of what your spouse/partner says. ', 'You apologize to them and ask them to apologize. ', 'You stop for a moment and try to reorganize your ideas to be able to present them as accurately as possible.', '', '', '', '', '20.00', '0.00', '0.00', '0.00'),
(140, 1, 2, 2, 8, 'You have been appointed as head of a committee that is assigned to solve work problems in an atypical innovative way because the available work style has proven to be futile. What is the best method you follow to achieve that?', 'You put a time table to discuss all aspects of the problems occurring, making better use of time in the meanwhile. ', 'You give the committee members enough time to know each other in a better way. ', 'You ask every member to present the ideas they have in mind that help solve the problem. ', 'You start a brain storming session and encourage every member to participate and say what they think. ', '', '', '', '', '0.00', '20.00', '0.00', '20.00'),
(141, 1, 2, 2, 9, 'You notice that a young relative of yours is shy and very sensitive, and they have fears of new people ever since they were born. What would you do?', 'You accept them as they are and think of how to protect them against situations that may cause them annoyance. ', 'You take them to a psychological counselor to help them overcome the problem. ', 'You intentionally expose them to situations where they meet new people and new situations to help them overcome their fears. ', 'You involve them in new experiences within their ability limits that challenge them but teach them how be able to respond to new circumstances. ', '', '', '', '', '0.00', '5.00', '0.00', '20.00'),
(142, 1, 2, 2, 10, 'You long to learn a language you started learning years ago. Now, you have the chance. You want to have the optimum use of time. What would you do?', 'You follow a daily rigorous program of study focusing on learning the grammar rules and memorizing words. ', 'You choose to read stories in that language to help you learn it. ', 'You learn when you are in mood and feel motivated. ', 'You choose a difficult text in that language and try to learn it with much effort. ', '', '', '', '', '0.00', '20.00', '0.00', '0.00'),
(143, 2, 1, 1, 1, 'إذا سافرتم برحلة إلى مكان لا تعرفونه وكان عليكم استخدام خريطة لتحرككم، كيف تتصرفون؟ ', 'لا أطيق استخدام الخرائط وسأكون فاشلاً سلفاً في معرفة الاتجاه.', ' أوجه المخطط لأجعل اتجاهه نحو الشمال كما أراه وأحدد جهة سفري بعد جهد ليس بالهيّن. ', 'أستطيع قراءة المخططات كما لو أنني أقرأ أي كتاب. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(144, 2, 1, 1, 2, 'أنت تجرب عملاً هاماً يحتاج إلى تركيز، بينما في نفس الوقت يعمل التلفزيون هنا يرن الهاتف . كيف تكون ردة فعلكم؟ ', 'أتكلّم على الهاتف وأستمر في العمل ويسعدني صوت المذياع بنفس الوقت.', ' أتحدث بالهاتف بينما أواصل العمل.ولكنني أغلق الراديو كي لا يشوّش عليّ.', 'اعتذر بمن يتصل هاتفياً ريثما أنتهي من العمل، لاتصل به عندما يكون كلُّ شيٍ هادئاً تماما حولي.', 'ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(145, 2, 1, 1, 3, 'ماذا تفضلون أن تعملوا في نهاية يوم عمل طويل؟ ', 'أتحدث مع من هم حولي عم جرى لي وانفعالاتي مع الأحداث بالذات.', ' أنصت إلى الآخرين وهم يتحدثون عن تفاصيل يومهم. ', 'أسترخي أو أشاهد التلفزيون عوضاً عن اهتمامي بالحديث. ', 'كل ما سبق أحياناً', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(146, 2, 1, 1, 4, 'إذا اختلفت مع شخص ماذا يغيظك أكثر في اختلافكما؟ ', 'عندما يسكت ويبدو كتمثال الشمع بلا أي ملامح أو ردة فعل. ', ' عندما لا يتفهمني ولا يصغي لأفكاري ومشاعري. ', 'عندما يتحدث بمنطق غير مقبول. ', 'عندما لا يحدث تواصل لا بالمشاعر ولا بالأفكار.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(147, 2, 1, 1, 5, 'شاهدت فيلماً سينمائي، ماذا تفعل بعد ذلك؟ ', 'تدور انطباعات بصرية ومشاهد منه في مخيلتي وأحلم بها. ', ' أتحدث عن مشاهد مؤثرة وأفيض في سرد الحوارات التي تمت.', 'أتحدث عن أفكار وجمل مرت في الفيلم. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(148, 2, 1, 1, 6, 'تدخلون قاعة دراسية ، أين تجلسون عندما تواجهون المنصة؟ ', 'في الناحية اليمنى للصالة مقابل المنصة. ', ' أختار الوسط دائماً ولكن إن جلست إلى اليمين أو اليسار لا أنزعج.', 'في الناحية اليسرى للصالة. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(149, 2, 1, 1, 7, 'أنتم موجودون في غرفة تسمعون فجأة من يناديكم .', 'أستطيع دون تردد أن أحدد الاتجاه الذي يأتي منه الصوت. ', ' سأستطيع أن أحدد الاتجاه الذي يأتي منه الصوت ولكن يجب إلا يتكلم احد من حولي.', 'يتعذّر عليّ أن أتعرف من أين يأتي الصوت.', ' لا يهمني من أي اتجاه أتى .', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(150, 2, 1, 1, 8, 'تقابلكم مشكلة تسبب إحباطاً، كيف تتعاملون معها؟ ', 'أقول لا مشكلة وسأتواءم مع القادم. ', ' أكون لطيفاً مع من سبب المشكلة وأحتفظ باستقلالي الشخصي في الوقت نفسه. ', 'أعيش معها طوال الوقت ولا تبارحني المشكلة إطلاقاً.', 'تارة أكون لامبالياً وتارة أكون مشغولاً بالمشكلة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(151, 2, 1, 1, 9, 'تعرّفت إلى زملاء جدد وأمضيتم ربع ساعة تتحدثون إليهم وتبادلتم أرقام الهواتف. إذا ما اتصل بكم هاتفياً بعد شهر، هل ستتعرف إلى الصوت؟ ', 'فوراً. ', ' إمكانية تعرّفي على الصوت تصل إلى نسبة 50%. ', 'يصعب أن أتعرف على الصوت والشخص. ', 'أحياناً ولكن الأمر لا يزعجني إن لم أستطع.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(152, 2, 1, 1, 10, 'تعرّفتم على أشخاص جدد. كيف يكون الأمر بعد شهرين عندما تلتقي بعضاً منهم؟ ', 'أتذكر كل وجه من الوجوه. ', ' أتذكر هذا الوجه مع اسمه، لكنني لا أتذكر الآخر. ', 'أتذكر غالبية الأسماء أكثر من تذكّري للوجوه.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(153, 2, 1, 1, 11, 'سمعتم للتو أغنيةً جديدة أعجبتكم؟ ', 'أستطيع أن أكرر جزءاً من الأغنية من غير صعوبة. ', ' أستطيع أن أكرر جزءاً من الأغنية شرط أن تكون بسيطة فعلاً. ', 'لا أتذكر اللحن لكنني أحفظ فوراً الكلمات.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(154, 2, 1, 1, 12, 'تجري أحداث جسام حولكم كيف تتعاملون مع احتمالاتها المستقبلية؟ ', 'حدسي دليلي فقط. و أتوقع كل ما ليس بالحسبان وغير المألوف.', ' أستخدم المعلومات المتوافرة لدي ليكون حدسي قائماً عليها.. ', 'لا مكان عندي إلا للمنطق وللاستقراء والقياس على أحداث سابقة.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(155, 2, 1, 1, 13, 'أية كتب تفضلون قراءتها؟ ', 'كتب تسلية، وسِيَر حياة بعض المشاهير، أو مجلات أزياء أو ما يريح رأسك من التفكير بعده', ' مجلات وجرائد. ', 'كتب اختصاصية أو سياسية، أو فكرية عميقة.', 'لا أحب القراءة كثيراً ولكن إن قررت القراءة لافرق.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(156, 2, 1, 1, 14, 'تعطل التلفزيون عند صديق لك ماذا تفعل؟ ', 'أعبر عن تعاطفي مع هذا الصديق . أو لا أكترث من أساسه للأمر.', ' أنصح بصاحب خبرة تصليح تعرفه. ', 'تحاول إصلاح العطل بنفسك رغم أنك لست مختصاً.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(157, 2, 1, 1, 15, 'سافرتم إلى مدينة لا تعرفون عنها شيئاً، يستوقفكم شخص بالطريق يطلب مساعدته للوصول إلى دار الأوبرا.', 'أعتذر لأنني غريب وأعترف بجهلي.. ', ' أعبّر عن ظني عن جهة ما تقود إليها. ', 'أدله دون أن أتردد رغم جهلي ورغم أنني قد أضلله.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(158, 2, 1, 1, 16, 'تختلف مع من تحب على قضاء سهرة في مكان ما في الطبيعة أو في فندق كيف ستحاول إقناعه بأن خياركم هو الأفضل؟ ', 'أحاول إقناعه وبكلمات عذبة ذاكراً له كم تحب ذلك المكان وكم كنت سعيدا هانئاً معه عندما ذهبتما إليه. ', ' أطلب منه أن اختار هذه المرة ما أرغب على أن أرد له المرة القادمة بأن أذهب إلى المكان الذي يُحب. ', 'سأثبت موقفي بالمنطق أن ما اخترته هو الأفضل. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(159, 2, 1, 1, 17, 'تريدون وضع اسفين في ثقب محفور بالحائط.', 'يتعذّر عليّ إيجاد المقاس المناسب للإسفين بسهولة. ', ' أحاول وضع الإسفين المناسب ولكن بعد حذر وتردد. ', 'أختار الاسفين المناسب نفسه وبالمقاس نفسه من أول مرة .', ' ولا أي من الإجابات السابقة. ', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(160, 2, 1, 1, 18, 'تستمعون إلى موسيقا راقصة كيف تكون حالتكم معها؟ ', 'تندمجون بشكل كامل و تدمدمونها ويتحرك جسدكم معها طوال الوقت. ', ' تتحركون بين الفينة والفينة معها ثم تتوقفون. ', 'لا أستطيع اللحاق بالموسيقا وتبدو لي عابرة في جلستي . ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(161, 2, 1, 1, 19, 'هل تكتشف الآخرين وخداعهم أو صدقهم بسهولة؟ ', 'أكشف ذلك سريعاً. ', ' تصل نسبة إمكانية الاكتشاف 50%. ', 'على الأرجح لن ألاحظ ذلك على الإطلاق. ', 'يضطرب الأمر لدي فلا أعرف وأحيانا أعرف ولكن لا انتظام بالأمر.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(162, 2, 1, 1, 20, 'يرنّ جرس الباب وتسمع أصواتاً قادمة من ورائه، بينما أنتم منهمكون بمشاهدة التلفزيون ومن حولك يتحدثون، كيف تكون ردة فعلكم؟ ', 'أفتح الباب بشكل عادي وأتحدث مع من أتي وأترك التلفزيون يعمل. ', ' أخفض صوت التلفزيون وأفتح الباب. ', 'أغلق التلفزيون، وأطلب من الجميع الهدوء، ثم أذهب لفتح الباب.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(163, 2, 1, 1, 21, 'كيف تفضلون طريقة العمل إذا ما كان لكم أن تختاروا؟ ', 'ضمن مجموعة وبعمل جماعي يحقق لك ولهم سعادة العمل الجماعي. ', ' مع الآخرين ولكن مع الحفاظ على مكانتي وتميّزي. ', 'العمل الحرّ وبحيث لا أخالط أحداً وأريح رأسي من تنوع أمزجتهم.', 'أحب أي عمل بأي صيغة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(164, 2, 1, 1, 22, 'أضعتم شيئاً ما كيف تتصرفون لتذكر أين وضعتموه؟ ', 'ألهي نفسي وأستمتع إلى أن أتذكر بشكل مفاجيء ودون سابق تفكير. ', ' أشغل نفسي بأمور أخرى ولكني أحاول في الوقت نفسه أن أتذكر أين وضعته. ', 'أحاول أن أراجع في رأسي أفعالي خطوة بخطوة بشكل متسلسل إلى أن أتذكر أين تركتها.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(165, 2, 1, 1, 23, 'ما هو سلوككم أثناء التسوّق عندما تمتلكون مالاً وفيراً؟ ', 'أشتري بجنون دون الالتفات للأسعار', ' أعرف تقريباً ماذا أحب أن أشتري ولكني أتابع أيضاً عروض البيع الخاصة. ', 'أقرأ ما هو مكتوب على السلعة وأقارن الأسعار واشتري الأرخص. ', 'أشتري الذي يناسبني باعتدال ولا أدقق إلا بمتطلباتي المعتدلة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(166, 2, 1, 1, 24, 'هل تتبعون نظاماً معيناً فيما يخص ليلتكم', 'أعمل بما يمليه علي مزاجي.', ' لديّ نظام عام ولكنني أستطيع أن أتكيّف. ', 'لديّ نظام صارم بمواعيد النوم. ', 'لا أستطيع أن أحدد.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(167, 2, 1, 1, 25, 'يمر بجانبك متسول واضح عليه الفقر ماذا تتصرف؟ ', 'أتعاطف معه وأقدم له المال وقد أساعده على إيجاد عمل ومأوى له.', ' أتعاطف ولكنني أحذر أن يكون مُخادعاً.', 'لا أتعاطف وأنشغل بأموري فكل شخص لديه همومه.', ' أحياناً أتعاطف لكنني غالباً ما أكون بارداً تجاهه.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(168, 2, 1, 1, 26, 'لديك فكرة خلاّقة وتود عرضها على صديق ترغب بأن يقتنع بها؟ ', ' تشرحها بورقة وقلم بالتفاصيل المكتوبة. ', ' تشرح بالكلام وأؤكد عليه بإشارات يدك. ', 'أشرح ذلك بالكلام المنطقي وباختصار شديد.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(169, 2, 1, 1, 27, 'كيف كان مستواكم في الإملاء والرسم أثناء سني الدراسة؟ ', 'كانتا مادتين سهلتين بالنسبة إليّ. ', ' كان الأول جيداً أما الثاني فسيء إلى حد الكراهية. ', 'كانتا مادتين صعبتين بالنسبة إليّ.', 'كان الإملاء صعباً لكن الرسم سهل جداً ولكنني كنت متكيّفاً معهما. ', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(170, 2, 1, 1, 28, 'صديق في ورطة، جاء إليكم طالباً النصيحة، كيف يكون ردة فعلكم؟ ', 'أعبر عن تعاطفي ولكنني لا أسدي له النصيحة لأنني لست هو.', ' أحاول أن أخفف عنه بأنه يضخم الأمر وهو أبسط. ', 'أقدّم نصائح موضوعية منطقية مستمدة من تجربتي ومن خبرة الآخرين. ', 'لا أكترث بالأمر.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(171, 2, 1, 1, 29, 'ما هي مهارتكم في تمييز وتقليد أصوات الآخرين؟ ', 'جيدة جداً', ' جيدة نسبياً. ', 'لا أستطيع إطلاقا. ', 'لا يعنيني الأمر', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(172, 2, 1, 1, 30, 'تود إقامة حفلة ما في مكان غير معروف كثيراً كيف ستدعو من اخترت للقدوم؟ ', 'سترسل لهم بطاقة ترسم فيها مخططاً واضحاً لكيفية الوصول.', ' تتصل بهم وتسألهم عما إذا كانوا يعرفون نقاطاً علاّم قرب مكان الدعوة. ', 'تشرح لهم بشكل شفهي الطريق إلى المكان المنشود من خلال مسار الطريق من لحظة خروجهم للبيت إلى لحظة وصولهم. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(173, 2, 1, 2, 1, 'إذا سافرتم برحلة إلى مكان لا تعرفونه وكان عليكم استخدام خريطة لتحرككم، كيف تتصرفون؟ ', 'لا أطيق استخدام الخرائط وسأكون فاشلاً سلفاً في معرفة الاتجاه.', ' أوجه المخطط لأجعل اتجاهه نحو الشمال كما أراه وأحدد جهة سفري بعد جهد ليس بالهيّن. ', 'أستطيع قراءة المخططات كما لو أنني أقرأ أي كتاب. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(174, 2, 1, 2, 2, 'أنت تجرب عملاً هاماً يحتاج إلى تركيز، بينما في نفس الوقت يعمل التلفزيون هنا يرن الهاتف . كيف تكون ردة فعلكم؟ ', 'أتكلّم على الهاتف وأستمر في العمل ويسعدني صوت المذياع بنفس الوقت.', ' أتحدث بالهاتف بينما أواصل العمل.ولكنني أغلق الراديو كي لا يشوّش عليّ.', 'اعتذر بمن يتصل هاتفياً ريثما أنتهي من العمل، لاتصل به عندما يكون كلُّ شيٍ هادئاً تماما حولي.', 'ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(175, 2, 1, 2, 3, 'ماذا تفضلون أن تعملوا في نهاية يوم عمل طويل؟ ', 'أتحدث مع من هم حولي عم جرى لي وانفعالاتي مع الأحداث بالذات.', ' أنصت إلى الآخرين وهم يتحدثون عن تفاصيل يومهم. ', 'أسترخي أو أشاهد التلفزيون عوضاً عن اهتمامي بالحديث. ', 'كل ما سبق أحياناً', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(176, 2, 1, 2, 4, 'إذا اختلفت مع شخص ماذا يغيظك أكثر في اختلافكما؟ ', 'عندما يسكت ويبدو كتمثال الشمع بلا أي ملامح أو ردة فعل. ', ' عندما لا يتفهمني ولا يصغي لأفكاري ومشاعري. ', 'عندما يتحدث بمنطق غير مقبول. ', 'عندما لا يحدث تواصل لا بالمشاعر ولا بالأفكار.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(177, 2, 1, 2, 5, 'شاهدت فيلماً سينمائي، ماذا تفعل بعد ذلك؟ ', 'تدور انطباعات بصرية ومشاهد منه في مخيلتي وأحلم بها. ', ' أتحدث عن مشاهد مؤثرة وأفيض في سرد الحوارات التي تمت.', 'أتحدث عن أفكار وجمل مرت في الفيلم. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(178, 2, 1, 2, 6, 'تدخلون قاعة دراسية ، أين تجلسون عندما تواجهون المنصة؟ ', 'في الناحية اليمنى للصالة مقابل المنصة. ', ' أختار الوسط دائماً ولكن إن جلست إلى اليمين أو اليسار لا أنزعج.', 'في الناحية اليسرى للصالة. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(179, 2, 1, 2, 7, 'أنتم موجودون في غرفة تسمعون فجأة من يناديكم . ', 'أستطيع دون تردد أن أحدد الاتجاه الذي يأتي منه الصوت. ', ' سأستطيع أن أحدد الاتجاه الذي يأتي منه الصوت ولكن يجب إلا يتكلم احد من حولي.', 'يتعذّر عليّ أن أتعرف من أين يأتي الصوت.', ' لا يهمني من أي اتجاه أتى .', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(180, 2, 1, 2, 8, 'تقابلكم مشكلة تسبب إحباطاً، كيف تتعاملون معها؟ ', 'أقول لا مشكلة وسأتواءم مع القادم. ', ' أكون لطيفاً مع من سبب المشكلة وأحتفظ باستقلالي الشخصي في الوقت نفسه. ', 'أعيش معها طوال الوقت ولا تبارحني المشكلة إطلاقاً.', 'تارة أكون لامبالياً وتارة أكون مشغولاً بالمشكلة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(181, 2, 1, 2, 9, 'تعرّفت إلى زملاء جدد وأمضيتم ربع ساعة تتحدثون إليهم وتبادلتم أرقام الهواتف. إذا ما اتصل بكم هاتفياً بعد شهر، هل ستتعرف إلى الصوت؟ ', 'فوراً. ', ' إمكانية تعرّفي على الصوت تصل إلى نسبة 50%. ', 'يصعب أن أتعرف على الصوت والشخص. ', 'أحياناً ولكن الأمر لا يزعجني إن لم أستطع.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(182, 2, 1, 2, 10, 'تعرّفتم على أشخاص جدد. كيف يكون الأمر بعد شهرين عندما تلتقي بعضاً منهم؟ ', 'أتذكر كل وجه من الوجوه. ', ' أتذكر هذا الوجه مع اسمه، لكنني لا أتذكر الآخر. ', 'أتذكر غالبية الأسماء أكثر من تذكّري للوجوه.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(183, 2, 1, 2, 11, 'سمعتم للتو أغنيةً جديدة أعجبتكم؟ ', 'أستطيع أن أكرر جزءاً من الأغنية من غير صعوبة. ', ' أستطيع أن أكرر جزءاً من الأغنية شرط أن تكون بسيطة فعلاً. ', 'لا أتذكر اللحن لكنني أحفظ فوراً الكلمات.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(184, 2, 1, 2, 12, 'تجري أحداث جسام حولكم كيف تتعاملون مع احتمالاتها المستقبلية؟ ', 'حدسي دليلي فقط. و أتوقع كل ما ليس بالحسبان وغير المألوف.', ' أستخدم المعلومات المتوافرة لدي ليكون حدسي قائماً عليها.. ', 'لا مكان عندي إلا للمنطق وللاستقراء والقياس على أحداث سابقة.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(185, 2, 1, 2, 13, 'أية كتب تفضلون قراءتها؟ ', 'كتب تسلية، وسِيَر حياة بعض المشاهير، أو مجلات أزياء أو ما يريح رأسك من التفكير بعده', ' مجلات وجرائد. ', 'كتب اختصاصية أو سياسية، أو فكرية عميقة.', 'لا أحب القراءة كثيراً ولكن إن قررت القراءة لافرق.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(186, 2, 1, 2, 14, 'تعطل التلفزيون عند صديق لك ماذا تفعل؟ ', 'أعبر عن تعاطفي مع هذا الصديق . أو لا أكترث من أساسه للأمر.', ' أنصح بصاحب خبرة تصليح تعرفه. ', 'تحاول إصلاح العطل بنفسك رغم أنك لست مختصاً.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(187, 2, 1, 2, 15, 'سافرتم إلى مدينة لا تعرفون عنها شيئاً، يستوقفكم شخص بالطريق يطلب مساعدته للوصول إلى دار الأوبرا.', 'أعتذر لأنني غريب وأعترف بجهلي.. ', ' أعبّر عن ظني عن جهة ما تقود إليها. ', 'أدله دون أن أتردد رغم جهلي ورغم أنني قد أضلله.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(188, 2, 1, 2, 16, 'تختلف مع من تحب على قضاء سهرة في مكان ما في الطبيعة أو في فندق كيف ستحاول إقناعه بأن خياركم هو الأفضل؟ ', 'أحاول إقناعه وبكلمات عذبة ذاكراً له كم تحب ذلك المكان وكم كنت سعيدا هانئاً معه عندما ذهبتما إليه. ', ' أطلب منه أن اختار هذه المرة ما أرغب على أن أرد له المرة القادمة بأن أذهب إلى المكان الذي يُحب. ', 'سأثبت موقفي بالمنطق أن ما اخترته هو الأفضل. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(189, 2, 1, 2, 17, 'تريدون وضع اسفين في ثقب محفور بالحائط.', 'يتعذّر عليّ إيجاد المقاس المناسب للإسفين بسهولة. ', ' أحاول وضع الإسفين المناسب ولكن بعد حذر وتردد. ', 'أختار الاسفين المناسب نفسه وبالمقاس نفسه من أول مرة .', ' ولا أي من الإجابات السابقة. ', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(190, 2, 1, 2, 18, 'تستمعون إلى موسيقا راقصة كيف تكون حالتكم معها؟ ', 'تندمجون بشكل كامل و تدمدمونها ويتحرك جسدكم معها طوال الوقت. ', ' تتحركون بين الفينة والفينة معها ثم تتوقفون. ', 'لا أستطيع اللحاق بالموسيقا وتبدو لي عابرة في جلستي . ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(191, 2, 1, 2, 19, 'هل تكتشف الآخرين وخداعهم أو صدقهم بسهولة؟ ', 'أكشف ذلك سريعاً. ', ' تصل نسبة إمكانية الاكتشاف 50%. ', 'على الأرجح لن ألاحظ ذلك على الإطلاق. ', 'يضطرب الأمر لدي فلا أعرف وأحيانا أعرف ولكن لا انتظام بالأمر.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(192, 2, 1, 2, 20, 'يرنّ جرس الباب وتسمع أصواتاً قادمة من ورائه، بينما أنتم منهمكون بمشاهدة التلفزيون ومن حولك يتحدثون، كيف تكون ردة فعلكم؟ ', 'أفتح الباب بشكل عادي وأتحدث مع من أتي وأترك التلفزيون يعمل. ', ' أخفض صوت التلفزيون وأفتح الباب. ', 'أغلق التلفزيون، وأطلب من الجميع الهدوء، ثم أذهب لفتح الباب.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(193, 2, 1, 2, 21, 'كيف تفضلون طريقة العمل إذا ما كان لكم أن تختاروا؟ ', 'ضمن مجموعة وبعمل جماعي يحقق لك ولهم سعادة العمل الجماعي. ', ' مع الآخرين ولكن مع الحفاظ على مكانتي وتميّزي. ', 'العمل الحرّ وبحيث لا أخالط أحداً وأريح رأسي من تنوع أمزجتهم.', 'أحب أي عمل بأي صيغة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(194, 2, 1, 2, 22, 'أضعتم شيئاً ما كيف تتصرفون لتذكر أين وضعتموه؟ ', 'ألهي نفسي وأستمتع إلى أن أتذكر بشكل مفاجيء ودون سابق تفكير. ', ' أشغل نفسي بأمور أخرى ولكني أحاول في الوقت نفسه أن أتذكر أين وضعته. ', 'أحاول أن أراجع في رأسي أفعالي خطوة بخطوة بشكل متسلسل إلى أن أتذكر أين تركتها.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(195, 2, 1, 2, 23, 'ما هو سلوككم أثناء التسوّق عندما تمتلكون مالاً وفيراً؟ ', 'أشتري بجنون دون الالتفات للأسعار', ' أعرف تقريباً ماذا أحب أن أشتري ولكني أتابع أيضاً عروض البيع الخاصة. ', 'أقرأ ما هو مكتوب على السلعة وأقارن الأسعار واشتري الأرخص. ', 'أشتري الذي يناسبني باعتدال ولا أدقق إلا بمتطلباتي المعتدلة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(196, 2, 1, 2, 24, 'هل تتبعون نظاماً معيناً فيما يخص ليلتكم', 'أعمل بما يمليه علي مزاجي.', ' لديّ نظام عام ولكنني أستطيع أن أتكيّف. ', 'لديّ نظام صارم بمواعيد النوم. ', 'لا أستطيع أن أحدد.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(197, 2, 1, 2, 25, 'يمر بجانبك متسول واضح عليه الفقر ماذا تتصرف؟ ', 'أتعاطف معه وأقدم له المال وقد أساعده على إيجاد عمل ومأوى له.', ' أتعاطف ولكنني أحذر أن يكون مُخادعاً.', 'لا أتعاطف وأنشغل بأموري فكل شخص لديه همومه.', ' أحياناً أتعاطف لكنني غالباً ما أكون بارداً تجاهه.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(198, 2, 1, 2, 26, 'لديك فكرة خلاّقة وتود عرضها على صديق ترغب بأن يقتنع بها؟ ', ' تشرحها بورقة وقلم بالتفاصيل المكتوبة. ', ' تشرح بالكلام وأؤكد عليه بإشارات يدك. ', 'أشرح ذلك بالكلام المنطقي وباختصار شديد.', ' ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(199, 2, 1, 2, 27, 'كيف كان مستواكم في الإملاء والرسم أثناء سني الدراسة؟ ', 'كانتا مادتين سهلتين بالنسبة إليّ. ', ' كان الأول جيداً أما الثاني فسيء إلى حد الكراهية. ', 'كانتا مادتين صعبتين بالنسبة إليّ.', 'كان الإملاء صعباً لكن الرسم سهل جداً ولكنني كنت متكيّفاً معهما. ', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(200, 2, 1, 2, 28, 'صديق في ورطة، جاء إليكم طالباً النصيحة، كيف يكون ردة فعلكم؟ ', 'أعبر عن تعاطفي ولكنني لا أسدي له النصيحة لأنني لست هو.', ' أحاول أن أخفف عنه بأنه يضخم الأمر وهو أبسط. ', 'أقدّم نصائح موضوعية منطقية مستمدة من تجربتي ومن خبرة الآخرين. ', 'لا أكترث بالأمر.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(201, 2, 1, 2, 29, 'ما هي مهارتكم في تمييز وتقليد أصوات الآخرين؟ ', 'جيدة جداً', ' جيدة نسبياً. ', 'لا أستطيع إطلاقا. ', 'لا يعنيني الأمر', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(202, 2, 1, 2, 30, 'تود إقامة حفلة ما في مكان غير معروف كثيراً كيف ستدعو من اخترت للقدوم؟ ', 'سترسل لهم بطاقة ترسم فيها مخططاً واضحاً لكيفية الوصول.', ' تتصل بهم وتسألهم عما إذا كانوا يعرفون نقاطاً علاّم قرب مكان الدعوة. ', 'تشرح لهم بشكل شفهي الطريق إلى المكان المنشود من خلال مسار الطريق من لحظة خروجهم للبيت إلى لحظة وصولهم. ', 'ولا أي من الإجابات السابقة.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(203, 2, 2, 1, 1, 'When you read a map, what do you do? ', 'I often have trouble reading maps and defining places.', 'I put the map in the direction of the route to define where to go after exerting considerable effort.', 'It is a piece of cake.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(204, 2, 2, 1, 2, 'While you are performing a new task that needs concentration, the radio is on but the telephone rings. How would you react?', 'I keep working and leave the radio on while talking on the phone.', ' I turn the radio off and keep working while talking.', 'I tell the person on the phone that I would call them later.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(205, 2, 2, 1, 3, 'What do you prefer to do at the end of a long workday?', 'I talk to my friends/family about the details of my day and how I reacted.', ' I listen to others talking about their day.', 'I relax or watch TV instead of talking.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(206, 2, 2, 1, 4, 'If an argument erupted between you and another person, what would upset you most?', ' When the other person keeps silent and does not show any reaction whatsoever.', ' When they do not try to understand my viewpoints or feelings.', ' When they have inacceptable and illogical views. ', 'When no emotional or intellectual communication exists.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(207, 2, 2, 1, 5, 'What do you usually do after watching a good movie?', ' I recall some scenes to my mind and begin dreaming about them.', 'I talk about impressive scenes and elaborate on the dialogues.', ' I talk mainly about some ideas raised and sentences said.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(208, 2, 2, 1, 6, 'When you get into class, where do you sit?', ' I sit to the right.', ' I usually choose to sit in the middle but I don\'t mind the right or the left.', ' I sit to the left.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(209, 2, 2, 1, 7, 'While you are in your room, you hear someone calling you:', ' I can unhesitatingly tell where the sound comes from.', ' I can tell where the sound comes from if I concentrate', ' I cannot tell. ', 'I do not care.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(210, 2, 2, 1, 8, 'When you encounter a disappointing issue, how do you respond?', ' No problem. I try to adapt.', ' I act gently to the problem raiser but I don\'t respond. ', ' I keep thinking of the problem all the time.', 'Sometime I am interested and sometimes careless.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(211, 2, 2, 1, 9, 'You meet new colleagues and you spend 15 minutes talking and exchanging phone numbers. If one of them calls after a month, do recognize their voice?', ' Certainly.', ' Maybe.', ' It is hard to recognize the person or the voice.', 'Sometimes, but I don\'t worry if I cannot.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(212, 2, 2, 1, 10, 'You met new people. After two months, …', ' I remember all the faces.', ' I remember some people\'s faces and names.', ' I mostly remember the names more than the faces.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(213, 2, 2, 1, 11, 'You have just listened to a song by your favorite singer…', ' I can repeat part of the song easily.', ' I can repeat part of it only if it is quite simple.', ' I find it hard to recall the tune though I can memorize part of the lyric immediately.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(214, 2, 2, 1, 12, 'Something is seriously taking place. How do you deal with the prospective implications?', ' I only depend on my intuition. I can expect the unfamiliar and unexpected.', ' I use both the available information and my intuition.', ' I only depend on facts, statistics, information, etc.', 'None of the above. ', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(215, 2, 2, 1, 13, 'What books do you prefer to read?', ' Entertainment books, biographies of celebrities, fashion magazines. ', ' Newspapers and magazines.', ' Political, intellectual or specialized books.', 'I don\'t like reading a lot, but when I read, I don\'t have a specific preference.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(216, 2, 2, 1, 14, 'Your friend has a technical problem. What would you do?', ' I would feel sorry for them or I don\'t care.', ' I recommend a good technician to solve the problem.', ' I would try to fix the problem myself even though I am not an expert.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(217, 2, 2, 1, 15, 'When someone asks you for directions in a new place, what would you do?', ' I admit that I do not know.', ' I tell what I think the right direction is reservedly.', ' I tell them about the direction without batting an eye even though this maybe incorrect or misleading. ', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(218, 2, 2, 1, 16, 'You want to spend a night out with your partner. Do you prefer to spend it somewhere in nature or in a hotel? How do you convince them that your choice is the best?', ' I try to convince them nicely expressing how much I like the place and how happy I was when we went there the last time.', ' I tell them I will be grateful if they accept my choice and that next time we will go where they like.', ' I use evidence to prove my choice is the best. ', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(219, 2, 2, 1, 17, 'You want to insert a wedge in a hole in the wall.', ' It is quite difficult for me to find the suitable wedge.', ' I try to put the right wedge carefully and hesitantly.', ' I choose the right wedge of the right size from the first time. ', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(220, 2, 2, 1, 18, 'How good are you at dancing?', ' I feel completely interested that my body moves with the music.', ' I master some movements well, but I find others difficult.', ' I cannot follow the tunes.', 'None of the above. ', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(221, 2, 2, 1, 19, 'Can you detect other people\'s deception or honesty easily?', ' Certainly. I discover it at once.', ' Probably (50%) .', ' Most probably I won\'t be able to detect it.', 'It is unsteady. Sometimes I can and sometimes I cannot. ', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(222, 2, 2, 1, 20, 'The doorbell rings while you are watching TV. How would you react?', ' I open the door, talk to the visitor while the TV is on.', ' I turn down the volume, then I open the door.', ' I turn the TV off and ask all to keep silent, and then open the door.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(223, 2, 2, 1, 21, 'What is your ideal work style?', ' I like to work in a team with colleagues sharing similar objectives.', ' With others, but maintaining my personal respect and distinction .', ' Freelance work away from people and their mood swings.', 'Any kind of work is ok.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(224, 2, 2, 1, 22, 'You cannot find your car keys. What would you do?', ' I would run other errands to give myself enough time to remember where I put them.', ' I would do other things while I try to remember where I put them.', ' I would try to review my actions step-by-step till I remember where I put them.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(225, 2, 2, 1, 23, 'What do you do when you go shopping with more than enough money?', ' I become crazy buying things without even knowing how much they cost.', ' I almost know what I want to buy, but I also see if there are special offers.', ' I read the price tags and compare to buy the cheapest. ', 'I consider my needs and then I buy what I need moderately. ', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(226, 2, 2, 1, 24, 'Do you follow a certain routine in your life?', ' I behave according to my mood.', ' I follow a routine, but I can adapt to new situations.', ' I have a strict routine.', 'I cannot decide.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(227, 2, 2, 1, 25, 'A beggar with signs of poverty asks you for some money. What do you do?', ' I sympathize and offer some money, and I might help them find a job or shelter.', ' I sympathize but I try to be careful of deception. ', ' I don\'t show sympathy. I have my own agonies.', 'I sometimes show sympathy but usually I act indifferently.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(228, 2, 2, 1, 26, 'You have an extraordinary idea which you want to convince your friend of?', ' I use a pencil and paper to show details.', ' I explain orally aided with gestures.', ' I explain logically and briefly.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(229, 2, 2, 1, 27, 'How good were you in dictation and drawing in school?', ' They were very easy.', ' The first was easy, but drawing was terribly hard.', ' They were both hard for me.', 'Dictation was difficult but drawing was easy. I could adapt, however.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(230, 2, 2, 1, 28, 'A friend of yours is in trouble. They ask for advice. How do you react?', ' I show sympathy but don\'t give advice. I am not in their shoes.', ' I try to calm them down and tell them they are amplifying things.', ' I give objectively logical advice based on my own and other people\'s experience.', 'I don\'t care.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(231, 2, 2, 1, 29, 'How good are you at recognizing and imitating sounds?', ' Very good.', ' Relatively good.', ' No way.', 'I don\'t care.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(232, 2, 2, 1, 30, 'You want to have a party in a not-well-known place. How would you tell your friends about the new place?', ' I send them a card with a map of the given place.', ' I would ask them about the places they know in that neighborhood and then tell them the way accordingly', ' I would explain verbally what routes they have to follow from where they live to where the party is.', 'None of the above.', '', '', '', '', '15.00', '5.00', '-5.00', '5.00'),
(233, 2, 2, 2, 1, 'When you read a map, what do you do? ', 'I often have trouble reading maps and defining places.', 'I put the map in the direction of the route to define where to go after exerting considerable effort.', 'It is a piece of cake.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(234, 2, 2, 2, 2, 'While you are performing a new task that needs concentration, the radio is on but the telephone rings. How would you react?', 'I keep working and leave the radio on while talking on the phone.', 'I turn the radio off and keep working while talking.', 'I tell the person on the phone that I would call them later.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00');
INSERT INTO `app_test_question` (`qstn_id`, `test_id`, `lang_id`, `gend_id`, `qstn_num`, `qstn_text`, `qstn_ansr1`, `qstn_ansr2`, `qstn_ansr3`, `qstn_ansr4`, `qstn_rep1`, `qstn_rep2`, `qstn_rep3`, `qstn_rep4`, `qstn_val1`, `qstn_val2`, `qstn_val3`, `qstn_val4`) VALUES
(235, 2, 2, 2, 3, 'What do you prefer to do at the end of a long workday?', 'I talk to my friends/family about the details of my day and how I reacted.', ' I listen to others talking about their day.', 'I relax or watch TV instead of talking.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(236, 2, 2, 2, 4, 'If an argument erupted between you and another person, what would upset you most?', ' When the other person keeps silent and does not show any reaction whatsoever.', ' When they do not try to understand my viewpoints or feelings.', ' When they have inacceptable and illogical views. ', 'When no emotional or intellectual communication exists.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(237, 2, 2, 2, 5, 'What do you usually do after watching a good movie?', ' I recall some scenes to my mind and begin dreaming about them.', 'I talk about impressive scenes and elaborate on the dialogues.', ' I talk mainly about some ideas raised and sentences said.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(238, 2, 2, 2, 6, 'When you get into class, where do you sit?', ' I sit to the right.', ' I usually choose to sit in the middle but I don\'t mind the right or the left.', ' I sit to the left.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(239, 2, 2, 2, 7, 'While you are in your room, you hear someone calling you:', ' I can unhesitatingly tell where the sound comes from.', ' I can tell where the sound comes from if I concentrate', ' I cannot tell. ', 'I do not care.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(240, 2, 2, 2, 8, 'When you encounter a disappointing issue, how do you respond?', ' No problem. I try to adapt.', ' I act gently to the problem raiser but I don\'t respond. ', ' I keep thinking of the problem all the time.', 'Sometime I am interested and sometimes careless.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(241, 2, 2, 2, 9, 'You meet new colleagues and you spend 15 minutes talking and exchanging phone numbers. If one of them calls after a month, do recognize their voice?', ' Certainly.', ' Maybe.', ' It is hard to recognize the person or the voice.', 'Sometimes, but I don\'t worry if I cannot.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(242, 2, 2, 2, 10, 'You met new people. After two months, …', ' I remember all the faces.', ' I remember some people\'s faces and names.', ' I mostly remember the names more than the faces.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(243, 2, 2, 2, 11, 'You have just listened to a song by your favorite singer…', ' I can repeat part of the song easily.', ' I can repeat part of it only if it is quite simple.', ' I find it hard to recall the tune though I can memorize part of the lyric immediately.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(244, 2, 2, 2, 12, 'Something is seriously taking place. How do you deal with the prospective implications?', ' I only depend on my intuition. I can expect the unfamiliar and unexpected.', ' I use both the available information and my intuition.', ' I only depend on facts, statistics, information, etc.', 'None of the above. ', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(245, 2, 2, 2, 13, 'What books do you prefer to read?', ' Entertainment books, biographies of celebrities, fashion magazines. ', ' Newspapers and magazines.', ' Political, intellectual or specialized books.', 'I don\'t like reading a lot, but when I read, I don\'t have a specific preference.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(246, 2, 2, 2, 14, 'Your friend has a technical problem. What would you do?', ' I would feel sorry for them or I don\'t care.', ' I recommend a good technician to solve the problem.', ' I would try to fix the problem myself even though I am not an expert.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(247, 2, 2, 2, 15, 'When someone asks you for directions in a new place, what would you do?', ' I admit that I do not know.', ' I tell what I think the right direction is reservedly.', ' I tell them about the direction without batting an eye even though this maybe incorrect or misleading. ', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(248, 2, 2, 2, 16, 'You want to spend a night out with your partner. Do you prefer to spend it somewhere in nature or in a hotel? How do you convince them that your choice is the best?', ' I try to convince them nicely expressing how much I like the place and how happy I was when we went there the last time.', ' I tell them I will be grateful if they accept my choice and that next time we will go where they like.', ' I use evidence to prove my choice is the best. ', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(249, 2, 2, 2, 17, 'You want to insert a wedge in a hole in the wall.', ' It is quite difficult for me to find the suitable wedge.', ' I try to put the right wedge carefully and hesitantly.', ' I choose the right wedge of the right size from the first time. ', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(250, 2, 2, 2, 18, 'How good are you at dancing?', ' I feel completely interested that my body moves with the music.', ' I master some movements well, but I find others difficult.', ' I cannot follow the tunes.', 'None of the above. ', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(251, 2, 2, 2, 19, 'Can you detect other people\'s deception or honesty easily?', ' Certainly. I discover it at once.', ' Probably (50%) .', ' Most probably I won\'t be able to detect it.', 'It is unsteady. Sometimes I can and sometimes I cannot. ', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(252, 2, 2, 2, 20, 'The doorbell rings while you are watching TV. How would you react?', ' I open the door, talk to the visitor while the TV is on.', ' I turn down the volume, then I open the door.', ' I turn the TV off and ask all to keep silent, and then open the door.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(253, 2, 2, 2, 21, 'What is your ideal work style?', ' I like to work in a team with colleagues sharing similar objectives.', ' With others, but maintaining my personal respect and distinction .', ' Freelance work away from people and their mood swings.', 'Any kind of work is ok.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(254, 2, 2, 2, 22, 'You cannot find your car keys. What would you do?', ' I would run other errands to give myself enough time to remember where I put them.', ' I would do other things while I try to remember where I put them.', ' I would try to review my actions step-by-step till I remember where I put them.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(255, 2, 2, 2, 23, 'What do you do when you go shopping with more than enough money?', ' I become crazy buying things without even knowing how much they cost.', ' I almost know what I want to buy, but I also see if there are special offers.', ' I read the price tags and compare to buy the cheapest. ', 'I consider my needs and then I buy what I need moderately. ', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(256, 2, 2, 2, 24, 'Do you follow a certain routine in your life?', ' I behave according to my mood.', ' I follow a routine, but I can adapt to new situations.', ' I have a strict routine.', 'I cannot decide.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(257, 2, 2, 2, 25, 'A beggar with signs of poverty asks you for some money. What do you do?', ' I sympathize and offer some money, and I might help them find a job or shelter.', ' I sympathize but I try to be careful of deception. ', ' I don\'t show sympathy. I have my own agonies.', 'I sometimes show sympathy but usually I act indifferently.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(258, 2, 2, 2, 26, 'You have an extraordinary idea which you want to convince your friend of?', ' I use a pencil and paper to show details.', ' I explain orally aided with gestures.', ' I explain logically and briefly.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(259, 2, 2, 2, 27, 'How good were you in dictation and drawing in school?', ' They were very easy.', ' The first was easy, but drawing was terribly hard.', ' They were both hard for me.', 'Dictation was difficult but drawing was easy. I could adapt, however.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(260, 2, 2, 2, 28, 'A friend of yours is in trouble. They ask for advice. How do you react?', ' I show sympathy but don\'t give advice. I am not in their shoes.', ' I try to calm them down and tell them they are amplifying things.', ' I give objectively logical advice based on my own and other people\'s experience.', 'I don\'t care.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(261, 2, 2, 2, 29, 'How good are you at recognizing and imitating sounds?', ' Very good.', ' Relatively good.', ' No way.', 'I don\'t care.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(262, 2, 2, 2, 30, 'You want to have a party in a not-well-known place. How would you tell your friends about the new place?', ' I send them a card with a map of the given place.', ' I would ask them about the places they know in that neighborhood and then tell them the way accordingly', ' I would explain verbally what routes they have to follow from where they live to where the party is.', 'None of the above.', '', '', '', '', '10.00', '5.00', '-5.00', '5.00'),
(263, 3, 1, 1, 1, 'هل تميل إلى الأجواء التي فيها شموع وأضواء خافتة وتشعر أنها الأقرب إلى مزاجك؟', 'نعم', 'لا', '', '', 'أنت من النوع الرومانسي الحالم تعيش في أحلامك ولا تحب العلاقات العاطفية الجسدية المباشرة دون مقدمات وتميل إلى المقدمات الطويلة في العمل الجنسي. فالحب عندك ليس مجرد اكتشاف ولكنه دخول في الحميمية', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(264, 3, 1, 1, 2, 'هل تميل إلى الاستماع إلى الموسيقى كثيراً والسفر كثيراً؟', 'نعم', 'لا', '', '', 'أنت من النوع الحساس والفنان بنفس الوقت وقد يتجلى لديك الفن (بالكلمة) أو (بالموسيقى). ولهذا فإن الحب لديك هو رحلة نحو الخيال والطبيعة والسكينة', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(265, 3, 1, 1, 3, 'هل أنت من مواليد (8) أو (17) أو (26) من أي شهر أو هل أنت من مواليد ما بين (21 كانون الأول) إلى (21 كانون الثاني)؟', 'نعم', 'لا', '', '', 'أنت لست من النوع العاطفي بالعلن. تفضل عادة ألا تستعمل عواطفك كثيراً رغم أنك قد تكون بالعمق عاطفياً. فأنت عملي جداً ومادي ومباشر لا تعتمد الوسائل الانفعالية سبيلاً للتفاهم مع من تحب بل تفضل المنطق والصيرورة والتسلسلية في المواقف', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(266, 3, 1, 1, 4, 'هل أنت من مواليد شهر (2) أو(11) أو (20) من أي شهر من أشهر السنة؟ أو هل أنت من مواليد ما بين (18 شباط) - (21 آذار) أو ما يبن (20 حزيران) - (21 تموز)؟', 'نعم', 'لا', '', '', 'أنت من النوع الحساس جداً والعاطفي جداً. لديك خيال عاطفي جامح وتحب الرومانسية إلى أبعد حد، وقد تصل إلى حد المرض العاطفي عندما تشعر بغياب الحب', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(267, 3, 1, 1, 5, 'هل أنت من مواليد (6) أو (15) أو (24) من أي شهر من أشهر السنة؟ أو هل أنت من مواليد ما بين (21 أيلول) إلى (23) تشرين الأول؟', 'نعم', 'لا', '', '', 'أنت تتجاوز الرومانسية إلى الخيال العارم وتحب الفانتازيا في العلاقة العاطفية ولكنك عنيد بعض الشيء وبنفس الوقت ديبلوماسي فأنت في العناد مفرط وفي اللطف أستاذ', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(268, 3, 1, 1, 6, 'هل أنت من مواليد (4) أو (13) أو (22) من أي شهر من أشهر السنة أو هل أنت من مواليد ما بين (21 كانون الثاني) و(18 شباط)؟', 'نعم', 'لا', '', '', 'أنت من النوع العملي ولا يرضيك شريك واحد وتحب التعددية في العلاقات العاطفية، فأنت غير مستقر انفعالياً وتحتاج إلى اكتشاف أكثر من شخص في الحياة العاطفية. وسرعان ما تمل من الشريك وتبحث عمن يثير في داخلك الشعور بالتجديد وتجاوز الملل', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(269, 3, 1, 1, 7, 'هل أنت من مواليد (7) أو (16) أو (25) من أي شهر أو هل أنت من مواليد الفترة الممتدة ما بين (21 تشرين الأول) إلى (21 تشرين الثاني)؟', 'نعم', 'لا', '', '', 'أنت من النوع الحسي ولا تعبر عن عواطفك بالكلام إنما بالجسد وحدسك أهم من كلامك، فأنت لست من النوع الذي يتكلم في الحب إنما ترسل إشارات جسدية بلغة الجسد بشكل أساسي', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(270, 3, 1, 1, 8, 'هل أنت من النوع المتعلق بأمه ويتذكر حنانها بلهفة ويتمنى أن يستعيده في حبيبة؟', 'نعم', 'لا', '', '', 'أنت أقرب إلى عقدة أوديب ولديك نكوص إلى المرحلة الثديية في الترتيب (النضوج – الجنس – العاطفة) وتحتاج إلى شريكة تستطيع ممارسة دور الحبيبة والأم معاً', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(271, 3, 1, 1, 9, 'هل أنت من مواليد (5) أو (14) أو (23) من أي شهر أو من الفترة الممتدة ما بين (21 نيسان) إلى (21 أيار)؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي يعتمد عقله في اختيار من يحب وغالباً ما تكون العاطفة في الدرجة الثانية بالنسبة لخياراتك. فأنت تنجذب إلى الذين يشبهون عقلك ويقبلون نقدك وتأففك من كثير من العيوب التي في الناس والمجتمع', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(272, 3, 1, 1, 10, 'هل أنت من مواليد (1) أو (10) أو (19) من أي شهر أو من مواليد ما بين (21 تموز) إلى (21 آب)؟', 'نعم', 'لا', '', '', 'أنت من النوع المتسلط عاطفياً وتحب فرض قوتك وسيطرتك على الشريك وتمارس نوعاً من الدور الذكري المفرط في علاقتك بالشخص الآخر', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(273, 3, 1, 1, 11, 'هل أنت مباشر في التعبير عن عواطفك ولا تتردد؟', 'نعم', 'لا', '', '', 'أنت من النموذج الذي يعتز بنفسه كثيراً ويحب الصراحة ويكره اللف والدوران', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(274, 3, 1, 1, 12, 'هل أنت من النوع الذي يلف ويدور حتى يعبر عن عواطفه؟', 'نعم', 'لا', '', '', 'أنت تتبع أسلوب الحوام في التعبير عن عواطفك. يبدو أنك تخشى الصدق من الشريك فتفضل جس النبض والتحرك العاطفي تباعاً', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(275, 3, 1, 2, 1, 'هل تميلين إلى الأجواء التي فيها شموع وأضواء خافتة وتشعر أنها الأقرب إلى مزاجك؟', 'نعم', 'لا', '', '', 'أنت من النوع الرومانسي الحالم تعيش في أحلامك ولا تحب العلاقات العاطفية الجسدية المباشرة دون مقدمات وتميل إلى المقدمات الطويلة في العمل الجنسي. فالحب عندك ليس مجرد اكتشاف ولكنه دخول في الحميمية', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(276, 3, 1, 2, 2, 'هل تميلين إلى الاستماع إلى الموسيقى كثيراً والسفر كثيراً؟', 'نعم', 'لا', '', '', 'أنت من النوع الحساس والفنان بنفس الوقت وقد يتجلى لديك الفن (بالكلمة) أو (بالموسيقى). ولهذا فإن الحب لديك هو رحلة نحو الخيال والطبيعة والسكينة', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(277, 3, 1, 2, 3, 'هل أنت من مواليد (8) أو (17) أو (26) من أي شهر أو هل أنت من مواليد ما بين (21 كانون الأول) إلى (21 كانون الثاني)؟', 'نعم', 'لا', '', '', 'أنت لست من النوع العاطفي بالعلن. تفضلين عادة ألا تستعملين عواطفك كثيراً رغم أنك قد تكونين بالعمق عاطفيةً. فأنت عملية جداً ومادية ومباشرة لا تعتمدين الوسائل الانفعالية سبيلاً للتفاهم مع من تحبين بل تفضلين المنطق والصيرورة التسلسلية في المواقف', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(278, 3, 1, 2, 4, 'هل أنت من مواليد شهر (2) أو(11) أو (20) من أي شهر من أشهر السنة؟ أو هل أنت من مواليد ما بين (18 شباط)-(21 آذار) أو ما يبن (20 حزيران) - (21 تموز)؟', 'نعم', 'لا', '', '', 'أنت من النوع الحساس جداً والعاطفي جداً. لديك خيال عاطفي جامح وتحبين الرومانسية إلى أبعد حد، وقد تصل إلى حد المرض العاطفي عندما تشعرين بغياب الحب', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(279, 3, 1, 2, 5, 'هل أنت من مواليد (6) أو (15) أو (24) من أي شهر من أشهر السنة؟ أو هل أنت من مواليد ما بين (21 أيلول) إلى (23) تشرين الأول؟', 'نعم', 'لا', '', '', 'أنت تتجاوزين الرومانسية إلى الخيال العارم وتحبين الفانتازيا في العلاقة العاطفية ولكنك عنيدة بعض الشيء وبنفس الوقت ديبلوماسي فأنت في العناد مفرط وفي اللطف أستاذة', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(280, 3, 1, 2, 6, 'هل أنت من مواليد (4) أو (13) أو (22) من أي شهر من أشهر السنة أو هل أنت من مواليد ما بين (21 كانون الثاني) و(18 شباط)؟', 'نعم', 'لا', '', '', 'أنت من النوع العملي ولا يرضيك شريك واحد وتحب التعددية في العلاقات العاطفية، فأنت غير مستقر انفعالياً وتحتاج إلى اكتشاف أكثر من شخص في الحياة العاطفية. وسرعان ما تمل من الشريك وتبحث عمن يثير في داخلك الشعور بالتجديد وتجاوز الملل', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(281, 3, 1, 2, 7, 'هل أنت من مواليد (7) أو (16) أو (25) من أي شهر أو هل أنت من مواليد الفترة الممتدة ما بين (21 تشرين الأول) إلى (21 تشرين الثاني)؟', 'نعم', 'لا', '', '', 'أنت من النوع الحسي ولا تعبر عن عواطفك بالكلام إنما بالجسد وحدسك أهم من كلامك، فأنت لست من النوع الذي يتكلم في الحب إنما ترسلين إشارات جسدية بلغة الجسد بشكل أساسي', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(282, 3, 1, 2, 8, 'هل أنت من النوع الحنون جداً والمعطاء جداً بالحب والحنان في أي علاقة عاطفية وتعتقدين أنك إذا أحببت فستتعاملين مع شريكك كما لو أنه ابنك؟', 'نعم', 'لا', '', '', 'أنت أقرب إلى الشخصيات المعطاء الحساسة الأمومية ولهذا فإنك تحتاجين إلى شخص يركن معك كما لو أنك أمه فتفيضين عليه عطاءاً', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(283, 3, 1, 2, 9, 'هل أنت من مواليد (5) أو (14) أو (23) من أي شهر أو من الفترة الممتدة ما بين (21 نيسان) إلى (21 أيار)؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي يعتمد عقله في اختيار من يحب وغالباً ما تكون العاطفة في الدرجة الثانية بالنسبة لخياراتك. فأنت تنجذبين إلى الذين يشبهون عقلك ويقبلون نقدك وتأففك من كثير من العيوب التي في الناس والمجتمع', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(284, 3, 1, 2, 10, 'هل أنت من مواليد (1) أو (10) أو (19) من أي شهر أو من مواليد ما بين (21 تموز) إلى (21 آب)؟', 'نعم', 'لا', '', '', 'أنت من النوع المتسلط عاطفياً وتحبين فرض قوتك وسيطرتك على الشريك وتمارسين نوعاً من الدور الذكري المفرط في علاقتك بالشخص الآخر، ولكنك تقعين في تناقض بين أنوثة بالتكوين وتسلط كالذكور، ما يجذب إليك الرجال الضعفاء وهذا ما لا تستسيغينه', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(285, 3, 1, 2, 11, 'هل أنت مباشرة في التعبير عن عواطفك ولا تترددين؟', 'نعم', 'لا', '', '', 'أنت من النموذج الذي يعتز بنفسه كثيراً وتحبين الصراحة وتكرهين اللف والدوران', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(286, 3, 1, 2, 12, 'هل أنت من النوع الذي يلف ويدور حتى يعبر عن عواطفه؟', 'نعم', 'لا', '', '', 'أنت تتبع أسلوب الحوام في التعبير عن عواطفك. يبدو أنك تخشى الصدق من الشريك فتفضل جس النبض والتحرك العاطفي تباعاً', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(287, 3, 2, 1, 1, 'Do you feel attracted to atmospheres of dimmed lights and candles, as they are the closest to your mood? ', 'Yes', 'No', '', '', 'You are a romantic dreamer who lives in his dreams. You don\'t like the direct physical emotional interaction without foreplay. You tend to have long foreplay before the sexual activity starts. For you, love does not come out of a sudden. It means intimacy', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(288, 3, 2, 1, 2, 'Do you enjoy listening to music and travelling?', 'Yes', 'No', '', '', 'You are a sensitive person and an artist at the same time. Art can manifest in a word or musical note. Therefore, love is considered to be a journey into nature, imagination and tranquility', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(289, 3, 2, 1, 3, 'Were you born on the 8th, 17th or 26th of any month, or were you born in the period between December 21st and January 21st?', 'Yes', 'No', '', '', 'You don\'t seem to be an emotional person in publics as you prefer not to use emotions a lot. However, you might be emotional in depth. You are direct and very pragmatic. You don\'t use emotional means as a way of communicating with others. You prefer using logic, process, and serial positions', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(290, 3, 2, 1, 4, 'Were you born on the 2nd, 11th or 20th of any month, or were you born in the period between (February 18th) and (march 21st) or (June 20th) and (July 21st)?', 'Yes', 'No', '', '', 'You are very sensitive and very emotional. You enjoy unbridled emotional imagination/fanatsy and love romanticism to a great extent that you might suffer from emotional illness if you feel the absence of love', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(291, 3, 2, 1, 5, 'Were you born on the 6th, 15th or 24th of any month, or were you born in the period between (September 21st) and (October 23rd)?', 'Yes', 'No', '', '', 'You have moved from romanticism to overwhelming imagination. You are like fantasy in love relationships. You are somewhat stubborn but diplomatic. You can be described as excessively stubborn and extremely gentle', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(292, 3, 2, 1, 6, 'Were you born on the 4th, 13th or 22nd of any month, or were you born in the period between (January 21st) and (February 18th)?', 'Yes', 'No', '', '', 'You are a practical person but cannot be satisfied with one partner. You like multiplicity of relationships. Therefore, you are emotionally unstable and need to get to know more than one person. It is quite apparent that you get bored with your partner that you look for renewing your life', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(293, 3, 2, 1, 7, 'Were you born on the 7th, 16th or 25th of any month, or were you born in the period between (October 21st) and (November 21st)?', 'Yes', 'No', '', '', 'You are a physical person who doesn\'t express his feelings with words; rather, through the body. Your intuition is more important than words. You don\'t like to talk love, but you mainly send physical signals through body language', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(294, 3, 2, 1, 8, 'Are you closely connected to your mother and you eagerly recall her tenderness? Do you wish to have a beloved of the same characteristics?', 'Yes', 'No', '', '', 'You tend to suffer from the Oedipus Complex, and you have regress to the mammary stage; maturity – sexuality – emotion. You need a partner who can act like a beloved and a mother at the same time', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(295, 3, 2, 1, 9, 'Were you born on the 5th, 14th or 23rd of any month, or were you born in the period between (April 21st) and (May 21st)?', 'Yes', 'No', '', '', 'You are a person who logically chooses the one they love. Usually, your emotions come in the second position. You get attracted to people with whom you have intellectual resemblance. Thus, they are more likely to accept your criticism and complaint about the imperfection of people and society', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(296, 3, 2, 1, 10, 'Were you born on the 1st, 10th, or 19th of any month, or were you born in the period between (July 21st) and (August 21st)?', 'Yes', 'No', '', '', 'You are an emotional domineering person who likes to impose their control on their partner. You like to excessively assume a (masculine) role in your relationship', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(297, 3, 2, 1, 11, 'Do you express your feelings directly and unhesitatingly? ', 'Yes', 'No', '', '', 'You don\'t like to maneuver. You take pride in yourself and speak frankly', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(298, 3, 2, 1, 12, 'Are you someone who does not express his emotions directly?', 'Yes', 'No', '', '', 'You hover around when you express your feelings. It seems you are afraid of being rejected by your partner. That is why you tend to express yourself indirectly to act accordingly', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(299, 3, 2, 2, 1, 'Do you feel attracted to ambiances of dimmed lights and candles, as they are the closest to your mood? ', 'Yes', 'No', '', '', 'You are a romantic dreamer kind who lives in their dreams. You don\'t like the direct physical emotional interaction without foreplay. You tend to have long foreplay before the sexual activity starts. For you, love does not come out of a sudden. It means intimacy', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(300, 3, 2, 2, 2, 'Do you enjoy listening to music and travelling?', 'Yes', 'No', '', '', 'You are a sensitive person and an artist at the same time. Art can manifest in a word or musical note. Therefore, love is considered to be a journey into nature, imagination and tranquility', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(301, 3, 2, 2, 3, 'Were you born on the 8th, 17th or 26th of any month, or were you born in the period between December 21st and January 21st?', 'Yes', 'No', '', '', 'You don\'t seem to be an emotional person in publics as you prefer not to use emotions a lot. However, you might be emotional in depth. You are direct and very pragmatic. You don\'t use emotional means as a way of communicating with others. You prefer using logic, process, and serial positions', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(302, 3, 2, 2, 4, 'Were you born on the 2nd, 11th or 20th of any month, or were you born in the period between (February 18th) and (March 21st) or (June 20th) and (July 21st)?', 'Yes', 'No', '', '', 'You are very sensitive and very emotional. You enjoy unbridled emotional imagination/fanatsy and love romanticism to a great extent that you might suffer from emotional illness if you feel the absence of love', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(303, 3, 2, 2, 5, 'Were you born on the 6th, 15th or 24th of any month, or were you born in the period between (September 21st) and (October 23rd)?', 'Yes', 'No', '', '', 'You moved from romanticism to overwhelming imagination. You love fantasy in love relationships. You are somewhat stubborn but diplomatic. You can be described as excessively stubborn and extremely gentle', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(304, 3, 2, 2, 6, 'Were you born on the 4th, 13th or 22nd of any month, or were you born in the period between (January 21st) and (February 18th)?', 'Yes', 'No', '', '', 'You are a practical person but cannot be satisfied with one partner. You like multiplicity of relationships. Therefore, you are emotionally unstable and need to get to know more than one person. It is quite apparent that you get bored with your partner that you look for renewing your life', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(305, 3, 2, 2, 7, 'Were you born on the 7th, 16th or 25th of any month, or were you born in the period between (October 21st) and (November 21st)?', 'Yes', 'No', '', '', 'You are a physical person who doesn\'t express her feelings with words; rather, through the body. Your intuition is more important than words. You don\'t like to talk love, but you mainly send physical signals through body language', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(306, 3, 2, 2, 8, 'Are you very tender and giving in love relationships? Do you think that if you love, you will be dealing with your partner as if he were your child?', 'Yes', 'No', '', '', 'You are a sensitive and (maternal) giving personality. You need a partner with whom you can act like a mother to overwhelm him with your love and giving', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(307, 3, 2, 2, 9, 'Were you born on the 5th, 14th or 23rd of any month, or were you born in the period between (April 21st) and (May 21st)?', 'Yes', 'No', '', '', 'You are a person who logically chooses the one they love. Usually, your emotions come in the second position. You get attracted to people with whom you have intellectual resemblance. Thus, they are more likely to accept your criticism and complaint about the imperfection of people and society', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(308, 3, 2, 2, 10, 'Were you born on the 1st, 10th, or 19th of any month, or were you born in the period between (July 21st) and (August 21st)?', 'Yes', 'No', '', '', 'You are an emotional domineering person who likes to impose her control on her partner. You like to excessively assume a (masculine) role in your relationship, but you fall into a contradiction between being a female by nature and being domineering like males. This makes you attract weak men, which you never like', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(309, 3, 2, 2, 11, 'Do you express your feelings directly and unhesitatingly? ', 'Yes', 'No', '', '', 'You don\'t like to maneuver. You take pride in yourself and speak frankly', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(310, 3, 2, 2, 12, 'Are you someone who does not express her emotions directly?', 'Yes', 'No', '', '', 'You hover around when you express your feelings. It seems you are afraid of being rejected by your partner. That is why you tend to express yourself indirectly to act accordingly', '', '', '', '6.66', '0.00', '0.00', '0.00'),
(311, 4, 1, 1, 1, 'هل تستمتع بالنظر إلى المرأة وجسدها إلى حد أنك يمكن أن تصل للذورة (الرعشة) بالنظر؟', 'نعم', 'لا', '', '', 'أنت من النوع البصري في الاستمتاع. لا بد لك من شريكه تحب الاستعراض ومستعدة للبس ألبسة داخلية مثيرة وغير تقليدية.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(312, 4, 1, 1, 2, 'هل يمتعك الاهتمام بأجزاء من جسد المرأة كأصابع قدميها أو يديها أو أجزاء من ثيابها كالأحذية أو الألبسة الداخلية؟', 'نعم', 'لا', '', '', 'أنت من النوع (الفيتشي) الذي يستمتع بالأجزاء من جسد شريكتك. وهذا ميل مرضي إن كنت لا تصل للرعشة إلا بهذه الطريقة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(313, 4, 1, 1, 3, 'هل تحب الكلام الجنسي أثناء الممارسة الجنسية؟', 'نعم', 'لا', '', '', 'أنت من النوع السمعي ويمكن أن تتركز اللذة بالكلام أو السمع وهنا يحتاج الأمر إلى علاج. وننصحك بالكلام الجنسي فقط أثناء الممارسة وفي إذن شريكك اليسرى.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(314, 4, 1, 1, 4, 'هل أنتم من النوع الذي إذا تكلم استخدم يديه بشكل كبير للتواصل؟', 'نعم', 'لا', '', '', 'أنت من النوع الحسي وتحتاج إلى شريكة من النوع نفسه وتحب تفاصيل الجسد. تميل إلى المساجات والتمتع بلمسات شريكتك على جسدك أو لمساتك على جسدها.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(315, 4, 1, 1, 5, 'هل أنت من النوع الذي يعتبر أن المؤخرة هي الأكثر إثارة بالنسبة لك من باقي جسد المرأة ويشتهيها وبشكل مبالغ به أحياناً؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي يحب الممارسة عبر المؤخرة (Anal partialism) وتحتاج إلى امرأة لديها تثبت ليبيدي بالمرحلة الشرجية (anus position) ولكن يجب الحذر من الاقتصار على هذه الطريقة لأسباب صحية (الأمراض) ولأنها توسع الحلقة الشرجية لدى المرأة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(316, 4, 1, 1, 6, 'هل تميل لممارسة العنف الجسدي على جسد شريكتك للوصول إلى الرعشة؟', 'نعم', 'لا', '', '', 'أنت من النوع السادي الذي يحب تعذيب الشريكة. ولكن حاذر من المبالغة بهذا السلوك. أنت تحتاج إلى امرأة مازوشية من برج الحوت أو امرأة طالعها الحوت.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(317, 4, 1, 1, 7, 'في حال ممارستك للعنف هل تصل الممارسة إلى حد حب إيذاء شريكتك أو رؤية الدم ينفر من جسدها؟', 'نعم', 'لا', '', '', 'نحن لا نستطيع مساعدتك بخصوص المبالغة في العنف على جسد شريكتك وننصحك بمراجعة معالج نفسي (psychiatrist) فأنت سادي مرضياً.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(318, 4, 1, 1, 8, 'هل تشعر أنك لا تشبع من الجنس وتريده في اليوم عدة مرات؟', 'نعم', 'لا', '', '', 'أنت من النوع الضَوَر (Bulimia) الذي لديه فرط شهية للجنس وتحتاج إلى قرين مشابه ومن النوع الذي لديه حالة (nymphomania) أي الشبق الجنسي. فأنت لديك حجم منطقة خاصة جداً في الهيباتلاموس وحاجتك الجنسية فوق الجيدة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(319, 4, 1, 1, 9, 'هل أنت من النوع الذي لم يحلم أي حلم جنسي في حياته؟', 'نعم', 'لا', '', '', 'أنت من النوع المكبوت جنسياً بسبب التربية ولا بد لك من شريك يساعدك على تجاوز هذا الكبت ويخرج حاجاتك الجنسية للعلن.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(320, 4, 1, 1, 10, 'هل تمارس العادة السرية بكثافة وأحياناً تتركز المتعة فيها؟', 'نعم', 'لا', '', '', 'الميل لديك لممارسة العادة السرية بكثافة يعكس الشبق الجنسي. وربما في حالة تركز المتعة بها نرجسية جنسية وستصيبك حالة سرعة القذف فينعكس الأمر على عدم كفاية شريكتك.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(321, 4, 1, 1, 11, 'هل تمارس العادة السرية رغم أن لديك شريكاً؟', 'نعم', 'لا', '', '', 'واضح أن لا توافق جنسياً بينك وبين شريكك.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(322, 4, 1, 1, 12, 'هل تفضل متعة العادة السرية رغم أن لديك شريكاً؟', 'نعم', 'لا', '', '', 'أنت أقرب إلى النرجسية الجنسية أو أنك اعتدت تشريطياً على العادة السرية.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(323, 4, 1, 1, 13, 'هل تميل إلى الاستمتاع بالنظر إلى المرأة وهي تمارس العادة السرية؟', 'نعم', 'لا', '', '', 'أنت لديك حالة ندعوها في علم النفس (voyeurism or scatophilia) وهي حالة تستدعي وجود شريك مناسب وعدم الاكتفاء بها وإلا فأنت تحتاج إلى علاج.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(324, 4, 1, 1, 14, 'هل (تتركّز) متعتك بالقضيب وتعامل المرأة معه فقط؟', 'نعم', 'لا', '', '', 'أنت لديك تثبت ليبيدي باللذة في المرحلة القضيبية وتحب أن تكون موضع دلال جنسي واعتناء خاص.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(325, 4, 1, 1, 15, 'هل لديك ميل للعض على الشفتين أثناء القبل بشكل مفرط؟', 'نعم', 'لا', '', '', 'أنت مصاب بالسادية الفمية (oral sadism).', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(326, 4, 1, 1, 16, 'هل أنت من النوع الذي يحب الشم كثيراً أثناء ممارسة الجنس؟', 'نعم', 'لا', '', '', 'أنت من النوع الشمي الذي يعيش القبلة بالتشمم أنت من النوع الذي يُدعى (sniff kiss) وتحتاج إلى قرينة تستخدم الروائح الجميلة. ', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(327, 4, 1, 1, 17, 'هل أنت من النوع الذي يعتبر عنيداً وبخيلاً جداً وتتحذلق، أي تفرط في التدقيق والنظام والترتيب معاً؟', 'نعم', 'لا', '', '', 'أنت مصاب بما يسمى (الثلاثي الشرجيAnal Triad) وهو من الدلالات على أن اللذة لديك متمحورة في الشرج ولكنها مقموعة اجتماعياً.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(328, 4, 1, 1, 18, 'هل لديك إفراط في كره الأوساخ والتلوث وإفراط في حب النظافة إلى حد الهوس؟', 'نعم', 'لا', '', '', 'أنت مصاب برهاب الوساخة (Mysophobia) ورهبة التلوث (Molysmophobia) وهذا يعني أن اللذة تتركز لديك في الشرج، لكنها مخفية وغير ظاهرة. وهي أقرب للوسواس القهري.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(329, 4, 1, 1, 19, 'هل أنت من النوع الذي يستخدم لسانه كثيراً في العمل الجنسي ويتعشق ذلك إلى أبعد حد ويأخذ وقتاً طويلاً في ذلك؟', 'نعم', 'لا', '', '', 'أنت من الرجال الذين تتركز اللذة لديهم في اللسان (tongue partialist) وتحتاج إلى امرأة بظرية تتناسب مع طبيعة اهتماماتك.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(330, 4, 1, 1, 20, 'هل أنت من النوع الذي يهتم بشكل مفرط بثدي المرأة وإلى حد التركيز على الثدي أكثر من أي منطقة أخرى في جسد المرأة؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي لديه حسد الثدي (breast envy) ) وتحتاج إلى امرأة لديها تثبت في اللذة بالثدي.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(331, 4, 1, 1, 21, 'هل أنت مفرط الاهتمام بالملابس الداخلية للمرأة إلى حد العشق؟', 'نعم', 'لا', '', '', 'أنت من النوع الفيتشي، وهذا يستدعي العلاج.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(332, 4, 1, 1, 22, 'هل تحب الاستعراض بقضيبك؟ ', 'نعم', 'لا', '', '', 'أنت من النوع الاستعراضي الفيتشي في التعامل مع قضيبك ولديك الزهو القضيبي (phallic pride)، ولا بد لك من شريكة لديها (penis envy)، أي حسد القضيب ولكن إذا كنت تبالغ بالأمر لا بد من علاجك نفسياً.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(333, 4, 1, 1, 23, 'هل أنت متعلق بأمك أو تريد امرأة تشبه أمك وتحب أن تخضع لها وترغب بها بقوة جداً؟', 'نعم', 'لا', '', '', 'أنت أقرب إلى عقدة أوديب وتميل إلى النساء القويات وتشعر أنهن يعوضنك على غياب أمك وتشعر بالضعف إزاءهن. ويمكن أن يصل الأمر بك إلى حد المازوشية.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(334, 4, 1, 1, 24, 'هل تتطلع إلى نفسك بالمرآة وأنت عارٍ وتتلذذ برؤية أعضائك التناسلية؟', 'نعم', 'لا', '', '', 'أنت من النوع النرجسي الذاتي (narcissistic self-peeping) وإذا كنت تصل للرعشة (orgasm) من رؤية نفسك فأنت مصاب بمرض (voyeurism) وتحتاج إلى علاج.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(335, 4, 1, 1, 25, 'هل تستخدم أثناء الفعل الجنسي كلمات فيها البراز أو تميل إلى مشاهدة البراز لدى الشريك؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي يسمى (coprophilia) وهو من النوع القهري من أسباب ما أنت فيه من ميول مشاهدة البراز هو الميول الشرجية. وهو من الأعراض السادية – العدوانية. ويسمى بـ (Gillesdelatourette syndrome) وهو نكوص (regress) إلى المرحلة الشرجية في النمو الجنسي منذ الطفولة، وتحتاج إلى علاج.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(336, 4, 1, 1, 26, 'هل أنت مولع بالروائح إلى حد كبير وتقوم بالشمشمة بكثرة قبل وأثناء الممارسة الجنسية وتقوم بذلك أيضاً للأعضاء التناسلية وتجد لذة في ذلك؟', 'نعم', 'لا', '', '', 'أنت لديك تعشق الروائح (osphresiophilia) التي يمكن أن تصل إلى غلمة الروائح (osphresiolagnia).', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(337, 4, 1, 1, 27, 'هل تميل إلى العجائز أكثر ممن هم في سنك أو أصغر منك سناً، أي بفارق 30-50 سنة؟', 'نعم', 'لا', '', '', 'أنت أقرب إلى عقدة أوديب ولديك ما ندعوه (Gerontophilia) أي تعشق العجائز وهو ميل جراء عقدة أوديب.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(338, 4, 1, 1, 28, 'هل أنت من النوع سريع القذف؟', 'نعم', 'لا', '', '', 'سرعة القذف لديك ستسبب مشكلة لشريكتك إذا كانت من النوع البظري أو الحسي. لا بد من الاستشارة النفسية حرصاً على تمديد فترة الدخول.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(339, 4, 1, 1, 29, 'هل تحب أن تلعق شريكتك قضيبك أكثر من أن تمارس أنت معها الجنس، أي أن لذتك متركزة في لعقها لقضيبك؟', 'نعم', 'لا', '', '', 'لديك في العمق ميول أنثوية كامنة بمعنى أنك تريد من شريكتك أن تكون هي الفاعل وأنت المفعول به أو أن تقوم هي بدور الذكر وأنت بدور الأنثى، وهو ميل خفي لديك وغير معلن.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(340, 4, 1, 1, 30, 'هل أنت من النوع الذي يهيجه الاستماع إلى قصص وروايات الجنس وتشعر أثناء الممارسة أنها تزيد من شعورك بالمتعة؟', 'نعم', 'لا', '', '', 'أنت من النوع المتعشق للروايات الجنسية (narratophilia) لأن أذناك من المناطق الشهوية التي يزيد أو يتركز فيها الشبق الجنسي. وتحتاج إلى شريكة تسمعك هذه القصص.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(341, 4, 1, 1, 31, 'هل تتركز المتعة لديك في ممارسة الجنس بوضعية تكون فيها أنت دائماً أعلى الشريكة ؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي يحب السيطرة في العمل الجنسي ولكنك تقليدي أحياناً بوضع أعلى الشريكة (face-to-face position).', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(342, 4, 1, 1, 32, 'هل أنت من النوع الذي يحب الصور وممارسة العادة السرية عليها بالذات؟', 'نعم', 'لا', '', '', 'أنت لديك غلمة الصور (Iconolagnia) وهي جزء من شهوة التفحص (inspection). وهنا اللذة الشبقية لديك متركزة في النظر وهو تعشق للصورة الجنسية (pictophilia)، فالبصر عندك تتركز فيه الرغبة الجنسية.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(343, 4, 1, 1, 33, 'هل تحب النساء القذرات أو تحب ممارسة الجنس مع الخادمات والقبيحات؟', 'نعم', 'لا', '', '', 'أنت مصاب بتعشق التلوث (Mysophilia) وهذا بسبب شعورك بقذارة الجنس من خلال تربية خاطئة وهو ما يجعلك تفكر بالنساء القذرات أو الخادمات أو القبيحات. وقد تكون أول تجربة جنسية لك مع امرأة قذرة ما شرط (condition) متعتك على القذارة. ', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(344, 4, 1, 1, 34, 'هل تميل إلى أن تكون أنثى بسلوكك أو بالجنس؟', 'نعم', 'لا', '', '', 'أنت مصاب إما بعقدة الأنوثة (Femininity Complex) لأسباب تربوية خشية الخصاء في الطفولة كما رأيت أمك أو أختك بلا قضيب وأنت صغير أو قد تكون تشريحياً لدين قرن أمون في مخك من النوع الصغير ولهذا يكون سلوكك أنثوياً.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(345, 4, 1, 1, 35, 'هل لديك ميل إلى الأطفال بين سن 4-10 سنوات بشكل خاص؟ ', 'نعم', 'لا', '', '', 'أنت مصاب بتعشق الصغار (pedophilia) وهو جراء كونك تخشى الصد وغالباً تكون شخصيتك شبه فصامية وإذا كنت أكبر من 70 سنة فأنت أقرب إلى الذهانيين وتتسم شخصيتك بعدم الاستقرار الانفعالي وقد يصاحب هذا الشذوذ (paraphilias) ولديك مرض تصلب الشرايين. ', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(346, 4, 1, 1, 36, 'هل أنت تميل إلى عدم القذف في رحم من تمارس معها الجنس بشكل دائم وتفضل الاحتفاظ بالمنى لديك دون قذف أبداً؟', 'نعم', 'لا', '', '', 'أنت مصاب بالأونانية (onanism) أو العُنان وهو الجماع المتقطع (coitus interruptus) وهو جماع متحفظ (coitus reservatus) حيث لا تترك نفسك على طبيعتها وتكون ضنيناً بمنيك على المرأة ما يعكس شخصية بخيلة وقد يتحول الأمر إلى عنّة موقتة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(347, 4, 1, 1, 37, 'هل أنت مثلي الجنس ومن النوع المأبون فقط، أي مفعول به حصراً في الفعل الجنسي مع نفسك؟', 'نعم', 'لا', '', '', 'أنت من نوع الإبانة (Inversion) الجنسية وطبيعتك هذه بسبب صغر قرن آمون في المخ، مما يجعلك من النوع الذي هو أقرب إلى الإناث في الممارسة الجنسية.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(348, 4, 1, 1, 38, 'هل أنت من النوع الذي لا يحب الممارسة إلا مع الرجال ومن موقع الفاعل جنسياً؟', 'نعم', 'لا', '', '', 'أنت من النوع اللواطي (sodomy) وهذا يعتبر بمثابة اضطراب نفسي جنسي عميق. وتحتاج إلى استشارة نفسية.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(349, 4, 1, 1, 39, 'هل أنت من النوع الذي يحب أن يمارس الجنس مع شريكته بحضور عشيقها؟', 'نعم', 'لا', '', '', 'أنت من النوع (Latent Bisexual) الرمزي فأنت ترمز لرغباتك بجعل هذا الرجل يمارس الجنس مع شريكتك وفقاً لحالة ندعوها بعلم النفس (ménage a trois) لأنك تتذكر بشكل لا واعٍ والدتك.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(350, 4, 1, 1, 40, 'هل تتركز لديك المتعة في ممارسة الجنس بالوضع الفرنسي؟', 'نعم', 'لا', '', '', 'أنت من النوع الامتطائي (coitus a tergo) الذي يحب دور الفارس في الممارسة الجنسية. وتحب السيطرة والقوة مع المرأة وتحتاج لامرأة ضعيفة ولينة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(351, 4, 1, 1, 41, 'هل تتركز لديك المتعة في ممارسة الجنس بوضعية تكون فيها أنت (دائماً) أعلى الشريكة وهي مستلقية؟', 'نعم', 'لا', '', '', '', '', '', '', '0.00', '0.00', '0.00', '0.00'),
(352, 4, 1, 2, 1, 'هل تميلين للاستعراض والتعري أمام رجلك وأمام المرآة؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي يميل إلى الاستمتاع عبر إثارة الرجل بالاستعراضات الجنسية، ولا بد لك من شريك يحب الاستمتاع بالنظر، وممارسة العادة السرية على منظرك من حين آخر لإملاء شعورك بأنك استثناء.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(353, 4, 1, 2, 2, 'هل تميلين للاستمتاع بأصابع قدم الرجل وأصابع يديه؟', 'نعم', 'لا', '', '', 'أنت من النوع (الفيتشي) الذي يستمتع بالأجزاء من جسد شريكك، وتحتاجين إلى شريك من النوع الفانتازي غير التقليدي.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(354, 4, 1, 2, 3, 'هل تحبين الاستمتاع بالكلام الجنسي أثناء الممارسة؟', 'نعم', 'لا', '', '', 'أنت من النوع السمعي الذي يزيد من متعته الجنسية بالكلام الجنسي. لا بد لك من أن يكون شريكك يجيد الكلام وليس من نوع آخر كالنوع الحسي المحض وأن يعرف كيف ومتى يتكلم الكلام الجنسي.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(355, 4, 1, 2, 4, 'هل تميلين إلى لمس من تتكلمين معه؟', 'نعم', 'لا', '', '', 'أنت من النوع الحسي وتحتاجين إلى شريك من هذا النوع الذي يعرف قيمة جسدك والتعامل معه جيداً ويداعبك ويتركك تداعبين جسده لفترة طويلة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(356, 4, 1, 2, 5, 'هل تشعرين بالمتعة من منطقة الشرج حصراً وأكثر من أي منطقة أخرى في جسمك؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي لديه تثبت ليبيدي في المرحلة الشرجية (anus postion) وتعشق شرجي (anal eroticism ). تشعرين بالمتعة عبر الشرج وتحتاجين إلى شريك يحب الممارسة من الشرج (penis-anus position) ولكن احذري من الأمراض ومن توسع الحلقة الشرجية. لذا يجب استخدامها بفترات متباعدة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(357, 4, 1, 2, 6, 'هل تحبين أن يمارس عليك العنف الجسدي أو الاغتصاب حتى تصلي إلى الرعشة؟', 'نعم', 'لا', '', '', 'أنت من النوع المازوشي وتحتاجين إلى شريك يحب العنف. ولكن حاذري من المبالغة بهذا السلوك.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(358, 4, 1, 2, 7, 'في حال حبك لممارسة العنف على جسدك أثناء الممارسة هل تصلين إلى حد أنك لا تستمتعين إلا بالأذى وظهور الدماء على جسدك؟', 'نعم', 'لا', '', '', 'نحن لا نستطيع مساعدتك بخصوص رغباتك الجنسية المازوشية وتحتاجين لمراجعة أخصائي نفسي فأنت مازوشية مرضياً وليس في الحدود الطبيعية.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(359, 4, 1, 2, 8, 'هل تشعرين أنك من النوع الذي لا يشبع من الممارسة اليومية ولعدة مرات؟', 'نعم', 'لا', '', '', 'أنت من النوع الضَوَر (Bulimia) الذي لديه شهية مفرطة للجنس وتحتاجين إلى قرين مشابه ومن النوع الذي لديه حالة (nimophomanic) أي الشبق الجنسي. فأنت لديك حجم منطقة خاصة جداً في الهيباتلاموس وحاجتك الجنسية فوق الممتازة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(360, 4, 1, 2, 9, 'هل أنت من النوع الذي لم يحلم أي حلم جنسي في حياتك كلها؟', 'نعم', 'لا', '', '', 'أنت من النوع المكبوت جنسياً بسبب التربية ولا بد لك من شريك يساعدك على تجاوز هذا الكبت.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(361, 4, 1, 2, 10, 'هل تمارسين العادة السرية بكثافة؟', 'نعم', 'لا', '', '', 'أنت من النوع الشبق ولديك نرجسية جنسية. احذري من بقائها أساساً في لذتك الجنسية وإلا فقدتِ المتعة مع الآخر.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(362, 4, 1, 2, 11, 'هل تمارسين العادة السرية رغم أنك متزوجة أو لديك شريك؟', 'نعم', 'لا', '', '', 'واضح أن لا توافق جنسياً بينك وبين شريكك.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(363, 4, 1, 2, 12, 'هل تفضلين متعة العادة السرية رغم أن لديك شريكاً؟', 'نعم', 'لا', '', '', 'أنت أقرب إلى النرجسية الجنسية أو أنك قد اعتدت على العادة الجنسية تشريطياً، أو أنك من النوع البظري أو الأناني جنسياً. فحاذري لأن هذا سيبعدك عن عالم الجنس المتبادل.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(364, 4, 1, 2, 13, 'هل تميلين إلى الاستمتاع بالرجل وهو يمارس العادة السرية على منظرك؟', 'نعم', 'لا', '', '', 'أنت من النوع البصري في المتعة وتحتاجين من يقدر استعراضك. ولكن حاذري من أن تكون هي طريقتك فقط في المتعة وإلا فالحالة بحاجة إلى علاج.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(365, 4, 1, 2, 14, 'هل تتركز متعتك بقضيب الرجل والتعامل معه لفترة طويلة؟', 'نعم', 'لا', '', '', 'أنت لديك تثبت باللذة في الطور الفموي (oral stage) وأنت شخصية فمية (oral personality) ولديك ما يشبه عقدة حسد القضيب. وإذا لم يتوافر رجل قد تستعيضين عن ذلك بمص الإصبع أو شرب السجائر أو الأركيلة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(366, 4, 1, 2, 15, 'هل تشعرين بمتعة العض على الشفتين أثناء القبل بشكل مفرط؟', 'نعم', 'لا', '', '', 'أنت مصابة بالمازوشية في مناطق اللذة وتحبين الرجل القوي لتشعري بضعفك. ', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(367, 4, 1, 2, 16, 'هل أنت مولعة بوضع البارفانات؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي يهتم بالشم، ولا بد لك من قرين له رائحة جسد مناسبة لك (فيرمونياً) ويضع البارفانات المناسبة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(368, 4, 1, 2, 17, 'هل أنت من النوع الذي يعتبر عنيداً وبخيلاً جداً وتتحذلقين، أي تفرطين في التدقيق والنظام والترتيب معاً؟', 'نعم', 'لا', '', '', 'أنت مصابة بالثلاثي الشرجي (Anal Triad) وهو من دلالات تثبت اللذة في الشرج لديك لكنك تعانين من كبت المجتمع والتقاليد والأفكار لهذا الشعور لديك.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(369, 4, 1, 2, 18, 'هل لديك إفراط في كره الأوساخ والتلوث والمبالغة في حب النظافة إلى حد الهوس؟', 'نعم', 'لا', '', '', 'أنت مصاب برهاب الوساخة (Mysophobia) ورهبة التلوث (Molysmophobia) وهذا يعني أن اللذة تتركز لديك في الشرج وأنت لا تعرفين، لكنها مخفية وغير ظاهرة. وهي أقرب للوسواس القهري.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(370, 4, 1, 2, 19, 'هل أنت من النوع الذي تتثبت اللذة لديه في البظر دون المهبل أو لا تشعرين بنفس الشعور في المهبل منه في البظر؟', 'نعم', 'لا', '', '', 'أن من النساء اللواتي يُدعَين بظريات حيث تكون أنسجة اللذة متركزة في البظر وتحتاجين إلى رجل (Oral Partialist)، كما أنك من الذين يسمون بالمرأة الفالوسية (phallic phase) ويمكن أن تكوني مهووسة البظر (clitromaniac).', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(371, 4, 1, 2, 20, 'هل تشعرين أنك يمكن أن تصلي للرعشة (orgasm) من خلال الثدي أو الحلمتين بشكل أكثر من باقي أجزاء الجسم؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي يُدعى متثبت اللذة بالثديthe breast partialist وتحتاجين إلى رجل لديه فانتازيا حسد الثدي.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(372, 4, 1, 2, 21, 'هل أنت من النوع الذي يتعشق ألبسة الرجل الداخلية وشمها أو حتى لبسها؟', 'نعم', 'لا', '', '', 'أنت من النوع الفيتشي في العلاقة مع أجزاء وبقايا ما يتركه الرجل من ثيابه. ولكن إذا كانت اللذة لديك فقط في هذه الأجزاء فيجب اللجوء للعلاج.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(373, 4, 1, 2, 22, 'هل أنت مولعة بمنظر أو التعامل مع القضيب؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي عنده عقدة القضيب (penis envy) أو (phallicism) وتحتاجين إلى شريك من نوع خاص يحب الاعتناء والتعامل مع قضيبه بشكل خاص.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(374, 4, 1, 2, 23, 'هل أنت متسلطة وتميلين للسيطرة على الرجل وتحبين أن تكوني الأقوى وتبادرين أنت بممارسة الجنس وتفضلين السيطرة الجنسية؟', 'نعم', 'لا', '', '', 'أنت من النوع النرجسي الذاتي (narcissistic self-peeping) وإذا كنت تصل للرعشة (orgasm) من رؤية نفسك فأنت مصاب بمرض (voyeurism) وتحتاج إلى علاج.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(375, 4, 1, 2, 24, 'هل تتطلعين إلى نفسك بالمرآة وأنت عارية وتتلذذين برؤية أعضائك التناسلية؟', 'نعم', 'لا', '', '', 'أنت من النوع النرجسي الذاتي (narcissistic self-peeping) وإذا كنتِ تصلين للرعشة (orgasm) من رؤية نفسك فأنت مصابة بمرض (voyeurism) وتحتاجين إلى العلاج إن كانت هذه هي طريقتك المفضلة للمتعة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(376, 4, 1, 2, 25, 'هل تحبين أن يستخدم أو تستخدمين أنت كلاماً فيه ذكر للبراز أو تحبين أن يبول أو يتغوط الشريك عليك؟', 'نعم', 'لا', '', '', 'أنت من النوع المازوشي الذي يسمى (coprolalia) وفيه تميلين إلى الاستمتاع بالإذلال حتى عبر الكلمات المعبرة عن القذارة. وهو نكوص إلى عرض (Gilledelatourette)، ويحتاج إلى علاج للتخفيف منه.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(377, 4, 1, 2, 26, 'هل أنت مولعة بالروائح إلى حد كبير وتقومين بالشمشمة بكثرة قبل وأثناء الممارسة الجنسية وتقومين بذلك أيضاً للأعضاء التناسلية وتجدين لذة في ذلك؟', 'نعم', 'لا', '', '', 'أنت لديك تعشق الروائح (osphresiophelia) التي يمكن أن تصل إلى غلمة الروائح (osphresiolagnia)، أي تركز المتعة بها. وهذا يحتاج إلى شريك مناسب كذلك.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(378, 4, 1, 2, 27, 'هل تميلين إلى العجائز من الرجال أكثر ممن هم في سنك أو أكبر قليلاً أي بفارق 30-50 سنة؟', 'نعم', 'لا', '', '', 'أنت أقرب إلى عقدة إلكترا ولديك ما ندعوه (Gerophilia) وهو تثبت طفولي على كبار السن ويدعى عقدة الجد (Grandfather complex) وقد يكون جراء كبر سن الأب وتجاوزه للأربعين حين ميلادك.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(379, 4, 1, 2, 28, 'هل أنت من النوع سريع الوصول إلى الرعشة وتحبين الممارسات الجنسية السريعة والمباغتة؟', 'نعم', 'لا', '', '', 'أنت شرهة جنسياً وتحتاجين إلى شريك من النوع الذي يساعدك على الفانتازيا الجنسية وعدم الاكتفاء بالسلوك التقليدي للممارسة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(380, 4, 1, 2, 29, 'هل تحبين فقط ونؤكد على كلمة (فقط) مص القضيب كمتعة أساسية ووحيدة لك في الممارسة الجنسية؟', 'نعم', 'لا', '', '', 'لديك عقدة فقدان القضيب ولديك هنا بالذات ميول ذكرية تسلطية ولكن رقتك الأنثوية لا تجعلك تمارسين دور الذكر في الممارسة. ', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(381, 4, 1, 2, 30, 'هل تشعرين أن القصص الجنسية تثيرك قبل الممارسة وتزيد من شعورك بالإثارة والمتعة أثناء الممارسة الجنسية؟', 'نعم', 'لا', '', '', 'أنت من المتعشقات للاستماع (narratophilia) ولذتك تتركز في السمع عبر الأذن وهي أحد مراكز اللذة الجنسية. وتحتاجين إلى شريك سمعي لديه هذه المخيلة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(382, 4, 1, 2, 31, 'هل تتركز لديك المتعة في ممارسة الجنس بوضعية تكونين أنت فيها في أسفل الرجل وتحته تماماً؟', 'نعم', 'لا', '', '', 'أنت من النوع المتلقي جنسياً ووديعة تحبين قوة الرجل وسيطرته عليك ويمتعك شعورك أنك تحته لكي تشعري برجولته وأنك منقادة له تماماً.', '', '', '', '2.00', '0.00', '0.00', '0.00');
INSERT INTO `app_test_question` (`qstn_id`, `test_id`, `lang_id`, `gend_id`, `qstn_num`, `qstn_text`, `qstn_ansr1`, `qstn_ansr2`, `qstn_ansr3`, `qstn_ansr4`, `qstn_rep1`, `qstn_rep2`, `qstn_rep3`, `qstn_rep4`, `qstn_val1`, `qstn_val2`, `qstn_val3`, `qstn_val4`) VALUES
(383, 4, 1, 2, 32, 'هل تحبين الأشجار كثيراً وتحبين معانقتها ومولعة حتى بأن تمارسي الجنس بالاحتكاك بها إلى أن تصلي للرعشة؟', 'نعم', 'لا', '', '', 'أنت مصابة بتعشق الأشجار (dendrophilia) وفي أصوله أن الأشجار هي رمز للقضيب وأنت بالأصل مصابة بعقدة فقدان القضيب. وتعشق الشجر هو بمعنى ما تعويض عن تعشق القضيب. ولا بد من علاقة جنسية لا يكون فيها الشريك سريع القذف.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(384, 4, 1, 2, 33, 'هل تحبين أن تكوني في موقع الذكر في الممارسة الجنسية وتمارسين العدوانية والسيطرة على الرجل؟', 'نعم', 'لا', '', '', 'أنت مصابة بعقدة الذكورة (masculinity complex) وهذا إما لأن قرن آمون في المخ لديك أكبر من باقي النساء أو لأن التربية في بيت أهلك قد ركزت على الذكور أكثر من إعطائك الفرصة لتكوين أنثى إلى درجة أنك أصبحت من نوع المرأة الرجل (woman-man) ولهذا تميلين للرجال الضعفاء. وقد تكونين مصابة بعقدة ليليت وتحتاجين إلى استشارة نفسية.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(385, 4, 1, 2, 34, 'هل لديك ميل للحيوانات (كلاب وقطط وغيرها) أكثر من الإنسان في الفعل الجنسي؟', 'نعم', 'لا', '', '', 'أنت مصابة بتعشق الحيوانات (zoophilia) وهو ضرب من الشذوذ الجنسي خاصة إذا كانت علاقتك بالحيوانات أهم من العلاقة بالإنسان. وهذا يحتاج إلى استشارة نفسية جنسية.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(386, 4, 1, 2, 35, 'هل أنت من النوع الذي لا يحب الممارسة إلا مع النساء حصراً؟', 'نعم', 'لا', '', '', 'أنت من مجموعة المثليات جنسياً (daughters of sapho- female homosexuals) وأمثالكن عرضة للقلق والاكتئاب أكثر من غيركن وعلى الأغلب سبب ذلك إما تشريحي أو وراثي. وهذا الميل من النوع الواضح (imprint) الذي لا يعالج.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(387, 4, 1, 2, 36, 'هل أنت من النوع الذي يحب لعق فرجها أكثر من الممارسة الجنسية بكثير؟', 'نعم', 'لا', '', '', 'أنت من النوع الذي لديه ميول ذكورية كامنة وتريدين أن تستخدمي بظرك استخدام الرجل لقضيبه كنوع من أنواع عقدة فقدان القضيب (penis envy).', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(388, 4, 1, 2, 37, 'هل أنت من النوع الذي يحب أن يمارس الجنس مع شريكك بوجود امرأة أخرى؟', 'نعم', 'لا', '', '', 'أنت من النوع (latent bisexual) والذي يخفي رغبته الجنسية المثلية أو يرمزها من خلال علاقة بوجود امرأة أخرى (ménage a trois).', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(389, 4, 1, 2, 38, 'هل ترفضين بالمطلق الممارسة الجنسية إلا وأنت بوضعية تكونين فيها فوق الشريك؟', 'نعم', 'لا', '', '', 'لديك ميول تسلطية (ذكرية) تجعلك تحبين الممارسة الجنسية من فوق الرجل ولكنها لم تصل بعد إلى حد الميول الذكرية الكاملة.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(390, 4, 1, 2, 39, 'هل أنت من النوع الذي يحب أن يمارس الجنس مع شريكها بحضور امرأة أخرى؟', 'نعم', 'لا', '', '', 'أنت من النوع المازوشي بجعل شريكك يمارس الجنس مع امرأة أخرى لأن الإثارة لديك تأتي من الإذلال الجنسي لأنك تتذكرين بشكل لا واعٍ والدك في وضعية جنسية مع امرأة أخرى.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(391, 4, 1, 2, 40, 'هل تتركز لديك المتعة في ممارسة الجنس مع الشريك وأنت في وضعية الكلب؟', 'نعم', 'لا', '', '', 'أنت تستشعرين اللذة في وضعية إذلالية وتريدين للقضيب أن يصل إلى بوابة الرحم.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(392, 4, 1, 2, 41, 'هل تتركز لديك المتعة في ممارسة الجنس بوضعية تكونين أنت فيها أسفل الرجل وتحته تماماً وأنت مستلقية؟', 'نعم', 'لا', '', '', '', '', '', '', '0.00', '0.00', '0.00', '0.00'),
(393, 4, 2, 1, 1, 'Do you enjoy looking at a female\'s body that you could reach orgasm just at seeing?', 'Yes', 'No', '', '', 'You tend to have visual pleasure. You need a partner who likes to make shows and ready to have sexy and unconventional lingerie.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(394, 4, 2, 1, 2, 'Do you feel interested in special parts of a woman\'s body (fingers – toes)? Do you have interest in her lingerie or shoes?', 'Yes', 'No', '', '', 'You are a fetishist who enjoys special parts of your partner\'s body (partialism). It could be pathological if you only reach orgasm by this.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(395, 4, 2, 1, 3, 'Do you like to talk sex during the sexual intercourse?', 'Yes', 'No', '', '', 'You are an auditory type. Pleasure could be reached by talking or listening, but this needs treatment. You are advised to talk sex only during the coitus right into the left ear of your partner.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(396, 4, 2, 1, 4, 'Do you use your hands a lot to communicate with others while talking?', 'Yes', 'No', '', '', 'You are a kinesthetic person and need a partner of the same type. You likes bodily details and massages. You enjoy the touches of your partner on your body or your touches on her body.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(397, 4, 2, 1, 5, 'Do you consider the buttock the most erotic part of a woman\'s body that you have excessive desire in an exaggerated way to insert into it?', 'Yes', 'No', '', '', 'You tend to have anal partialism and need a woman with libidinal fixation in the anal position. But, you have to beware using this position only for pathological reasons and because such a position could lead to expansion of your female\'s anus.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(398, 4, 2, 1, 6, 'Do you tend to practise violence with your partner to reach orgasm?', 'Yes', 'No', '', '', 'You are a sadist who likes to torture your partner. Beware exaggerating using this way. You need a masochist woman whose zodiac sign is a Pisces.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(399, 4, 2, 1, 7, 'Does practising physical violence with your partner reach the case of harming or bloodying her?', 'Yes', 'No', '', '', 'Sorry. We cannot help with such a kind of physical violence. We advise you to see a psychiatrist because you are a pathological sadist.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(400, 4, 2, 1, 8, 'Are you a sex addict that you need it many times a day?', 'Yes', 'No', '', '', 'You have Sex Bulimia, excessive appetite/desire for sex. You need a partner of the same type who is nymphomaniac. This is attributed to the special size of the hypothalamus which makes your sexual desire really good.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(401, 4, 2, 1, 9, 'Haven\'t you ever had a sexual dream in your life?', 'Yes', 'No', '', '', 'You suffer from sexual repression due to your upbringing. You need a partner who can give you a hand to overcome such a case and help you feel your sexual desires more.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(402, 4, 2, 1, 10, 'Do you masturbate a lot that you feel it essential for your pleasure?', 'Yes', 'No', '', '', 'Excessive masturbation is an indication of nymphomania. If you are nymphomaniac, then you have a sexual narcissism, which will lead to premature ejaculation. Thus, you will not be able to satisfy your female partner.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(403, 4, 2, 1, 11, 'Do you masturbate even if you have a partner? ', 'Yes', 'No', '', '', 'Apparently, there is no sexual compatibility between you and your partner.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(404, 4, 2, 1, 12, 'Do you favour the pleasure you get from masturbation to that of your partner?', 'Yes', 'No', '', '', 'You are mostly a sexual narcissist or conditionally accustomed to masturbation.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(405, 4, 2, 1, 13, 'Do you get turned on upon watching a woman masturbating?', 'Yes', 'No', '', '', 'You are one who has voyeurism or Scatophilia. This case requires having a compatible partner and not sticking to that case only, or you need counseling.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(406, 4, 2, 1, 14, 'Do you only feel pleasure when a female touches and deals with your male organ? ', 'Yes', 'No', '', '', 'You have libidinal fixation in the phallic stage, and like to be sexually cared for to a great extent.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(407, 4, 2, 1, 15, 'Do you tend to excessively bite lips while kissing?', 'Yes', 'No', '', '', 'You have oral sadism.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(408, 4, 2, 1, 16, 'Do like to sniff a lot during the sexual intercourse?', 'Yes', 'No', '', '', 'You are an olfactory person who enjoys sniff kissing. You need a partner who wears nice odours.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(409, 4, 2, 1, 17, 'Are you stubborn, mean and pedantic ? Do you exaggerate in maintaining order, or arranging or organizing things? ', 'Yes', 'No', '', '', 'You have the Anal Triad, which is an indication that your libido is centred in the anus but it is socially repressed.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(410, 4, 2, 1, 18, 'Do you have excessive aversion of dirt and filthiness and excessively-obsessive cleanliness?', 'Yes', 'No', '', '', 'You have mysophobia and molysmophia, which means your pleasure centres in the anus but unapparently. This could almost be considered an OCD.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(411, 4, 2, 1, 19, 'Does your tongue play a vital role in sizzling up the sexual intercourse that you forget yourself licking for quite a long time?', 'Yes', 'No', '', '', 'Your libido centres in the mouth, which indicates you have tongue partialism. You need a clitoral woman who tends to suit your interests.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(412, 4, 2, 1, 20, 'Do you feel excessively stimulated by a woman\'s breasts that you concentrate more on them than on any other part of her body?', 'Yes', 'No', '', '', 'You have breast envy. Thus, you need a woman with libidinal fixation in the breast.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(413, 4, 2, 1, 21, 'Do you adore a woman\'s lingerie?', 'Yes', 'No', '', '', 'You are a fetishist, and this needs counseling. ', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(414, 4, 2, 1, 22, 'Do you like to make shows with your phallus? ', 'Yes', 'No', '', '', 'You like fetishist shows when you deal with your phallus. As you have phallic pride, you should have a partner with penis envy. But if you have exaggerations in such an issue, you have to seek counseling.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(415, 4, 2, 1, 23, 'Are you closely connected to your mother? Do you want a woman who resembles your mum and you like to be submissive to her? ', 'Yes', 'No', '', '', 'You have the Oedipus Complex and you feel attracted to strong women as they can most probably compensate for your mother\'s absence. You feel weak and have no ability to resist them to the extent of masochism.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(416, 4, 2, 1, 24, 'Do you like seeing yourself in a mirror and feel gratification at looking at your sexual organ?', 'Yes', 'No', '', '', 'You are a self-peeping narcissist. However, if you reach orgasm just at watching yourself, then you are a voyeur and need counseling.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(417, 4, 2, 1, 25, 'During the sexual intercourse, do you tend to use words of (excrement)? Do you tend to see excrement of your partner?', 'Yes', 'No', '', '', 'You have obsessive coprophilia. Such tendencies towards seeing excrement is a result of the anal inclination. It is one of the aggressive-sadist symptoms that are called (the Gilles de la Tourette Syndrome), which is a regress to the anal stage during the sexual growth in childhood. You need counseling.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(418, 4, 2, 1, 26, 'Are you fond of odours that you tend to smell your partner a lot before and during the intercourse? Do you smell the sexual organs and find pleasure in doing so?', 'Yes', 'No', '', '', 'You have osphresiophilia that can intensify to reach the degree of osphresiolagnia.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(419, 4, 2, 1, 27, 'Do you feel more attracted to the elderly (30-50 years older) than to people of your age or a little younger? ', 'Yes', 'No', '', '', 'You have Oedipus Complex and what is called (Gerontophilia) that results from the Oedipus Complex.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(420, 4, 2, 1, 28, 'Do you have premature ejaculation?', 'Yes', 'No', '', '', 'This premature ejaculation will cause a problem to your female partner especially if she is clitoral or kinesthetic. Thus, you should have some counseling to lengthen the insertion time.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(421, 4, 2, 1, 29, 'Do you like fellatio more than having sex with your partner? In other words, is your pleasure centred on the act of fellatio?', 'Yes', 'No', '', '', 'You have in-depth feminine tendencies, you want your female partner to be the doer and you are the acted-upon, or she takes the role of the male and you assume the female\'s. This is a hidden tendency.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(422, 4, 2, 1, 30, 'Does listening to sex or obscene stories arouse you that you feel they can increase your pleasure during the sexual intercourse?', 'Yes', 'No', '', '', 'You have narratophilia, i.e., love of sexual narrations. Your ears are the erotic zones in which sexual concupiscence centres. You need a partner who would tell of such stories.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(423, 4, 2, 1, 31, 'Do you have excessive pleasure when you have the man-on-top position?', 'Yes', 'No', '', '', 'You like to be the powerful in the sexual intercourse, but you sometimes resort to traditional sex positions.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(424, 4, 2, 1, 32, 'Do you like looking at sex photos and masturbating?', 'Yes', 'No', '', '', 'You have iconolagnia which is part of the pleasure of inspection. Nymphomaniac sexual pleasure lies in the sight, which is called pictophilia.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(425, 4, 2, 1, 33, 'Do you like to have sex with dirty women or ugly maids?', 'Yes', 'No', '', '', 'You have mysophilia. Due to your early childhood education, you feel the filthiness of sex, what makes you think of dirty women or ugly maids. Maybe your first sexual practice was with a dirty woman, thus, you came to have filthiness-conditioned pleasure.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(426, 4, 2, 1, 34, 'Do you tend to be a female in your behavior or during sexual intercourse?', 'Yes', 'No', '', '', 'You either have the Femininity Complex that is attributed to your early upbringing (fear of castration as your mother and sister are penisless) or because your hippocampus is smaller than normal size in males. Therefore, you tend to have a feminine conduct.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(427, 4, 2, 1, 35, 'Do you have an inclination towards children (4-10) in particular?', 'Yes', 'No', '', '', 'You suffer from pedophilia because you have fears of rejection. You are probably schizophrenic. If you are almost 70, you are more a psychotic and you do not enjoy emotional stability. This kind of paraphilia can be accompanied with sclerosis.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(428, 4, 2, 1, 36, 'Do you refrain from ejaculating in a woman\'s uterus and prefer keeping your semen without being ejaculated (pull-out method)? ', 'Yes', 'No', '', '', 'You suffer from onanism or coitus interruptus. This is coitus reservatus as you do not act naturally. This may indicate a miserly personality and the case may turn to be temporary impotence. ', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(429, 4, 2, 1, 37, 'Are you a bisexual and an invert i.e., you tend to be an acted-upon person in the sexual activity?', 'Yes', 'No', '', '', 'You have sexual inversion. This nature is attributed to the small size of the hippocampus, which makes you more a female during the sexual intercourse.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(430, 4, 2, 1, 38, 'Do you only like to practice sex with men as a doer not receiver of action?', 'Yes', 'No', '', '', 'You suffer from sodomy, which is considered to be a deeply sexual psychological disorder. You need psychological counseling.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(431, 4, 2, 1, 39, 'Do you like to have sex with your partner in the presence of her boyfriend?', 'Yes', 'No', '', '', 'You are a latent bisexual. You symbolize your desire by allowing a man to have sex with your partner. This is a case called (ménage a trios) in psychology and indicates that you unconsciously remember your mother.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(432, 4, 2, 1, 40, 'Do you have libidinal pleasure when you are in the French position (Lordosis)?', 'Yes', 'No', '', '', 'You like the Coitus a Tergo. You like to act a knight during the sexual intercourse. Therefore, you need a weak and lenient woman.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(433, 4, 2, 1, 41, 'Do you have libidinal pleasure when you are always in a man-on-top position and your female lying on her back?', 'Yes', 'No', '', '', '', '', '', '', '0.00', '0.00', '0.00', '0.00'),
(434, 4, 2, 2, 1, 'Do you like to make shows and strip in front of the mirror or your man?', 'Yes', 'No', '', '', 'You tend to have excitement by turning man on with sexual shows. Thus, you need a visual partner. You also have to masturbate from time to time to saturate your feeling that you are an exception', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(435, 4, 2, 2, 2, 'Do you feel attracted to man\'s toes or fingers?', 'Yes', 'No', '', '', 'You are a fetishist who enjoys special parts of your partner\'s body (partialism). You need an unconventional partner who loves fantasy.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(436, 4, 2, 2, 3, 'Do you enjoy talking sex during the sexual intercourse?', 'Yes', 'No', '', '', 'You are an auditory type who increases her sexual enjoyment by talking sex. You should have an eloquent partner – not merely kinesthetic – who knows how and when to talk sex.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(437, 4, 2, 2, 4, 'Do like touching the person you are talking to?', 'Yes', 'No', '', '', 'You are a kinesthetic person and need a partner who knows the value of your body and how to deal with it, and caresses you and lets you caress his body for a long time.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(438, 4, 2, 2, 5, 'Do feel more sexual eroticism in the anal position than any other part in your body?', 'Yes', 'No', '', '', 'You have libidinal fixation in the anus position and anal eroticism . As you feel your pleasure comes through the anus, you need a partner who likes penis-anus position. But you have to be aware. Just do it at intervals as it could lead to anus expansion and result in some illnesses.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(439, 4, 2, 2, 6, 'Do you tend to accept physical violence or be raped as a way to reach orgasm?', 'Yes', 'No', '', '', 'You are a masochist and need a partner who likes bodily violence, but you have to beware exaggerating such a conduct.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(440, 4, 2, 2, 7, 'In case of physical violence, do you feel pleasure only when you see blood on your body or get physically harmed?', 'Yes', 'No', '', '', 'Sorry. We cannot help with such a kind of masochist sexual desires. We advise you to see a psychiatrist because you are a pathological masochist.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(441, 4, 2, 2, 8, 'Are you sex addict who is not satisfied with once-a-day sexual intercourse?', 'Yes', 'No', '', '', 'You have Sex Bulimia. You have excessive appetite/desire for sex and need a partner of the same nature, one who is nymphomaniac. This is attributed to the special size of the hypothalamus which makes your sexual desire very high.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(442, 4, 2, 2, 9, 'Haven\'t you ever had a sexual dream in your life?', 'Yes', 'No', '', '', 'You suffer from sexual repression due to your upbringing. You need a partner who can give you a hand to overcome such a case.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(443, 4, 2, 2, 10, 'Do you masturbate a lot?', 'Yes', 'No', '', '', 'You are nymphomaniac with a sexual narcissism. Don\'t make masturbation the most essential part of your pleasure or you are risking the pleasure with a partner.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(444, 4, 2, 2, 11, 'Do you masturbate even though you have a partner or married?', 'Yes', 'No', '', '', 'Apparently, there is no sexual compatibility between you and your partner.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(445, 4, 2, 2, 12, ' Do you favour the pleasure you get from masturbation to that of your partner?', 'Yes', 'No', '', '', 'You are mostly a sexual narcissist or conditionally accustomed to masturbation. Or maybe you are a clitoral person or sexually selfish. Be careful, this might distance you from the world of sexual partnerships.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(446, 4, 2, 2, 13, 'Do you enjoy it when a man masturbates upon seeing you?', 'Yes', 'No', '', '', 'You have visual gratification and need someone who can appreciate your shows, but you have to be careful of making this your own way of getting pleasure or you will be in need of counseling.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(447, 4, 2, 2, 14, 'Do you have excessive pleasure with a man\'s phallus and focusing on it for a long time?', 'Yes', 'No', '', '', 'You have pleasure fixation in the oral stage as you are an oral personality. You are likely to have penis envy. Therefore, if you don\'t have a partner, you might smoke cigarettes or the hubble-bubble.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(448, 4, 2, 2, 15, 'Do you feel excessive pleasure at having your lips bitten while kissing?', 'Yes', 'No', '', '', 'You have masochism in the pleasure zones, and you like the strong partner to feel your own weakness.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(449, 4, 2, 2, 16, 'Do you adore perfumes?', 'Yes', 'No', '', '', 'You are an olfactory person. You should have a partner who is phermonally compatible and who wears perfumes that suit you.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(450, 4, 2, 2, 17, 'Are you stubborn, mean and pedantic ? Do you exaggerate in maintaining order, or arranging or organizing things? ', 'Yes', 'No', '', '', 'You have Anal Triad, which is an indication of libidinal fixation in the anus, but you suffer from restraints of traditions and society repression.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(451, 4, 2, 2, 18, 'Do you have excessive aversion of dirt and filthiness and excessively-obsessive cleanliness?', 'Yes', 'No', '', '', 'You have mysophobia and molysmophia, which means, not to your knowledge, your pleasure centres in the anus but unapparently. This could almost be considered an OCD.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(452, 4, 2, 2, 19, 'Does your pleasure centre more in the clitoris than in the vagina? In other words, the pleasure you get in the vagina is not equal to the one you get in the clitoris, is it?', 'Yes', 'No', '', '', 'You have clitoral stimulation as the pleasure tissues centre in the clitoris, thus, you need an oral partialist. You are a phallic woman and may be clitromaniac.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(453, 4, 2, 2, 20, 'Do you reach orgasm through your breasts or nipples more than any other part of your body?', 'Yes', 'No', '', '', 'You have libidinal fixation in the breasts, i.e., a breast partialist, thus you are in need of a partner with the fantasy of (Breast Envy).', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(454, 4, 2, 2, 21, 'Do you adore men\'s underwear clothes that you like smelling or even wearing them?', 'Yes', 'No', '', '', 'You are a fetishist, as you feel interested in the clothes your man leaves. But if pleasure centres only in such parts, you have to seek counseling. ', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(455, 4, 2, 2, 22, 'Do you like watching or dealing with the penis?', 'Yes', 'No', '', '', 'You have penis envy or phallicism. Your partner should enjoy a special nature that goes along with yours, and pays much care for his male organ.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(456, 4, 2, 2, 23, 'Are you an authoritative woman who tends to control men? Do you like to be the most powerful and have the initiative in the sexual practice? Do you like to be the one with sexual control?', 'Yes', 'No', '', '', 'You are a phallic woman and your sexual behavior is closer to be a compensation for the Castration Complex and Penis Envy.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(457, 4, 2, 2, 24, 'Do you like seeing yourself in a mirror and feel gratification at looking at your sexual organs?', 'Yes', 'No', '', '', 'You are a self-peeping narcissist. However, if you reach orgasm just at watching yourself, then you are a voyeur, and you need counseling especially if this is your favourite way of reaching pleasure.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(458, 4, 2, 2, 25, 'During the sexual intercourse, do you tend to use words of (excrement or do like your partner to urinate or defecate on you?', 'Yes', 'No', '', '', 'You are a masochist who has coprophilia. You tend to like being humiliated even by the use of filthy words. This is a regression to the Gille de la Tourette Syndrome. This case needs counseling to lessen the impacts.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(459, 4, 2, 2, 26, 'Are you fond of odours that you tend to smell your partner a lot before and during the intercourse? Do you smell the sexual organs and find pleasure in doing so?', 'Yes', 'No', '', '', 'You adore scents to the extent that this can intensify to reach the degree of osphresiolagnia. This means you need a special partner.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(460, 4, 2, 2, 27, 'Do you feel more attracted to the elderly (30-50 years older) than to people of your age or a little younger? ', 'Yes', 'No', '', '', 'You have the Electra Complex and what is called (Gerontophilia), which is a childish fixation on the elderly. This case is called the Grandfather Complex and may be the result of having a father who was at least forty at your birth.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(461, 4, 2, 2, 28, 'Are you quick at reaching orgasm and like abrupt and swift sexual activities?', 'Yes', 'No', '', '', 'You are sexually concupiscent. You need a partner who could help in the sexual fantasy but not sticking to the traditional type of intercourse.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(462, 4, 2, 2, 29, 'Do you like fellatio as the one and only pleasure in the sexual activity?', 'Yes', 'No', '', '', 'You have penis envy and you tend to have authoritative masculine inclination. However, you feminine delicacy prevents you from assuming the role of the male in the sexual activity.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(463, 4, 2, 2, 30, 'Do you feel listening to sex stories can arouse you before the intercourse and increase your pleasure during it?', 'Yes', 'No', '', '', 'You have narratophilia, a case in which sexual pleasure centres in the ears. You need an auditory partner who has such an imagination.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(464, 4, 2, 2, 31, 'Do you have excessive pleasure when you are in a lower position to your man during the sexual intercourse?', 'Yes', 'No', '', '', 'You are a sexual recipient. You are meek and like the power and control of man. You enjoy being under him to feel his manliness and how obedient you are.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(465, 4, 2, 2, 32, 'Do you like trees and like hugging them? Are fond of rubbing your body with trees to reach orgasm?', 'Yes', 'No', '', '', 'You have dendrophilia, and as a tree is a symbol of the phallus, you suffer from penis envy. Thus, dendrophilia is a kind of compensation for penis envy. Therefore, you need to get into a relationship and have a partner who does not suffer from premature ejaculation.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(466, 4, 2, 2, 33, 'Do you like to assume the role of a male in the sexual activity and like to be aggressive and dominant?', 'Yes', 'No', '', '', 'You have masculinity complex because the hippocampus is bigger than normal size in females or because your familial education focuses more on males than females that you liked to be a (woman-man). This explains being attracted to weak men. Or maybe you suffer from the Lilith Complex, thus, you are in need of psychological counseling.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(467, 4, 2, 2, 34, 'Do you like to have sex with animals more than with humans?', 'Yes', 'No', '', '', 'You have zoophilia, which is considered a kind of sexual abnormality especially if you favour relation to animals than to humans. This seriously needs a psychological sexual counseling.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(468, 4, 2, 2, 35, 'Are you someone who only likes to have sex with females?', 'Yes', 'No', '', '', 'You are one of the saphos (daughters of female homosexuals). You are likely to develop anxiety and depression more than other females. The reason is mostly either genetic or anatomic. Apparently, it is incurable.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(469, 4, 2, 2, 36, 'Do you like to have cunnilingus more than having a sexual intercourse?', 'Yes', 'No', '', '', 'You tend to have potential masculine inclination. You would like to use your clitoris the way a man uses his phallus. This is one kind of penis envy.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(470, 4, 2, 2, 37, 'Do like to practice sex in the presence of another female?', 'Yes', 'No', '', '', 'You are a latent bisexual. You tend to conceal your bisexuality or symbolize it by the presence of another female (ménage a trios).', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(471, 4, 2, 2, 38, 'Do you refuse to have a sexual intercourse unless you are on top of your partner?', 'Yes', 'No', '', '', 'You have masculine authoritative tendencies that make you like the top position, but they are not completely masculine tendencies yet. ', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(472, 4, 2, 2, 39, 'Do you like to have sex with your partner in the presence of another female?', 'Yes', 'No', '', '', 'You are a masochist because you let your partner have sex with another woman because you get aroused through sexual humiliation, and because you unconsciously remember your father making sex with another woman.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(473, 4, 2, 2, 40, 'Do you have sexual pleasure when you are in the doggy position?', 'Yes', 'No', '', '', 'You like to be in a humble position with the penis reaching the edges of your uterus.', '', '', '', '2.00', '0.00', '0.00', '0.00'),
(474, 4, 2, 2, 41, 'Do you have libidinal pleasure when your man is on top and you lie just beneath him?', 'Yes', 'No', '', '', '', '', '', '', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `app_test_results`
--

DROP TABLE IF EXISTS `app_test_results`;
CREATE TABLE IF NOT EXISTS `app_test_results` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User, FK',
  `test_id` int(11) NOT NULL COMMENT 'Test, FK',
  `res_request` mediumtext NOT NULL COMMENT 'JSON sent to Main site web service',
  `res_result` mediumtext NOT NULL COMMENT 'Result received from Main site web service',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`res_id`),
  KEY `test_id` (`test_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_tips`
--

DROP TABLE IF EXISTS `app_tips`;
CREATE TABLE IF NOT EXISTS `app_tips` (
  `tips_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `tcat_id` int(11) NOT NULL COMMENT 'Category',
  `lang_id` int(11) NOT NULL COMMENT 'Language',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `tips_text` mediumtext NOT NULL COMMENT 'Tips Text in Language',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`tips_id`),
  KEY `tcat_id` (`tcat_id`),
  KEY `lang_id` (`lang_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=521 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_tips`
--

INSERT INTO `app_tips` (`tips_id`, `tcat_id`, `lang_id`, `status_id`, `tips_text`, `ins_datetime`) VALUES
(1, 2, 1, 1, 'في حالات الحب ينتج الجسد الإندروفينات التي تقوي الجهاز المناعي وتطرد الزكام، وحين يتم تبادل القبلات يقوم المخ بمجموعة من العمليات الكيميائية الهرمونية التي تساعد الجهاز المناعي لدى كل من الطرفين ويكون الرجل هو الأكثر استفادة من هذه العمليات الكيميائية لأنه يكون قادراً على إنتاج الإندروفينات بكثافة أكثر من المرأة.', '2019-03-13 16:42:02'),
(2, 2, 1, 1, 'ينخفض مستوى التستسترون ببطء عند الرجل في العمر المتقدم في العمر وبموازاة ذلك يضعف دافعه الحميمي (الجنسي)، وعلى العكس يشتد الدافع الحميمي (الجنسي) عند المرأة العادية تدريجياً ويصل إلى ذروته ما بين عمر 36-38. وهذا ما يفسر متلازمة الحبيب الشاب لدى الكثير من النساء في هذا العمر. واللافت أن الشباب يستشعرون قدرات المرأة الناضجة في هذه الحالة. ', '2019-03-13 16:42:02'),
(3, 2, 1, 1, 'تطلق التجربة الفيزيولوجية للنشوة الجنسية عند المرأة مواد كيميائية عصبية مثل الأوكسيتوسينوالدوبامينوالنورأدرينالين في الدماغ الأنثوي الذي يمكنه تنشيط مجموعة من العواطف القوية غير المتوقعة، كالبكاء.', '2019-03-13 16:42:02'),
(4, 2, 1, 1, 'يمكن لامرأة شابة لم تتجاوز العشرين من  العمر أن تبدي اهتماماً شديداً بالجنس بسبب التأثير المتبادل بين الجنس والحب غير أنها لا تستشعر سوى رغبة ضعيفة فيه. ', '2019-03-13 16:42:02'),
(5, 2, 1, 1, 'من أسرار الحب والعلاقات الرومانسية بين الجنسين مشروب الشمبانيا حتى وإن كان بدون كحول، فهناك أنواع من الشمبانيا لا يوجد فيها كحول، والأهم أن مادة الشمبانيا توجد فيها مادة كيميائية ترفع من مستوى التستسترون في الجسم، ما يؤدي بهذه النسب البسيطة إلى تلك الحميمية التي تبديها المرأة تجاه الرجل. وهذا من أسرار الحفلات التي تكون فيها الشمبانيا أساسية في التداول بين الأطراف. (النص الانكليزي نزيل تماماً موضوع الكحول من النص)', '2019-03-13 16:42:02'),
(6, 2, 1, 1, 'إذا كان الجنس أو التفكير في الجنس يجعل المرأة تشعر بأنها عاطفية زيادة عن اللزوم أو أنها تشعر بالوهن فإن عليها مراجعة معالج نفسي جنسي بهذا الشأن.', '2019-03-13 16:42:02'),
(7, 2, 1, 1, 'عندما تجالس امرأة رجلاً وتراها رغم كونها تلبس تنورة أو فستاناً تفتح ما بين رجليها باسترخاء فإنها تتوق إلى علاقة مع ذلك الرجل بلا قيود.', '2019-03-13 16:42:02'),
(8, 2, 1, 1, 'عندما تضع امرأة خاتماً في السبابة اليسرى وآخر في الوسطى اليمنى فهو فضلاً عن دهائها الشديد يخفي التنكيد والتنفير من العلاقة الجسدية والتسلط في الرأي.', '2019-03-13 16:42:02'),
(9, 2, 1, 1, 'إذا لاحظت المرأة أو شريكها أن لديهما تغيراً واضحاً في الرائحة المهبلية أو الإفرازات، فعليها مراجعة الطبيب لاستبعاد أي شبهة مرضية.', '2019-03-13 16:42:02'),
(10, 2, 1, 1, 'غالباً ما يترافق السأم أو الملل الجنسي لدى الطرفين مع بعض التغيرات التناسلية؛ أي عند بلوغ سن ما بعد الطمث لدى النساء وسن الأياس عند الرجال. لذلك على الطرفين أن يراعوا العمر الذي يبلغانه ولا يأخذا الأمر على محمل شخصي واستفزازي.', '2019-03-13 16:42:02'),
(11, 2, 1, 1, 'قد يشعر الرجل عند بلوغه مرحلة الأياس، )علماً أن لدى الرجل أيضاً دورة ولكنه لا يحيض) بالعجز الجنسي ويسهل عليه أن يقول إن الملل هو السبب كي لا يفقد شخصيته  وربما يكون السبب وراء سأمه اكتئاب نفسي.', '2019-03-13 16:42:02'),
(12, 2, 1, 1, 'بعض أنواع الملل الجنسي سببه عدم إفراز الحموض الأمينية المناسبة كالكارنيتينوالأرغينين. وننصح بتناولهما كأقراص. كما أن عشبة الإمبيديوم (epimedium) يساهم في زيادة الأحاسيس الحسية الجنسية ولا يجب التسرع باستخدام الفياغرا.', '2019-03-13 16:42:02'),
(13, 2, 1, 1, 'بعض حالات الفشل في الحياة العملية يكون السبب وراءها جوع عاطفي أو جنسي، الأمر الذي يجعل الأفراد يتصرفون بعدوانية تجاه الآخرين وتجاه أنفسهم. ولهذا يجب على المرء أن يجرب حياة عاطفية وجنسية لتأمين التوازن في الحياة العملية.', '2019-03-13 16:42:02'),
(14, 2, 1, 1, 'يوجد نوعان من الدوار: أحدهما عضوي ناتج عن خلل كالتهاب الأذن الداخلية والآخر نفسي وهو ناتج عن حاجات جسدية مكبوتة يأتي على مظهر استجابة للقلق. ولأعراضه معان رمزية تتصل بالصراعات النفسية الداخلية. وهذا مرده كبت الحاجات الجنسية لدى شخصية ذات ميول جنسية مفرطة.', '2019-03-13 16:42:02'),
(15, 2, 1, 1, 'من الأفضل أن تتحدث المرأة مع طبيبها عن أي نزيف متكرر في مرحلة ما بعد ممارسة الجنس. فغالباً ما يكون النزف بعد الممارسة أو نزيف ما بعد المخاض، كما يطلق عليه طبياً، علامة على أمر غير طبيعي قد يكون إصابة بالبوليبات أو الورم أو سرطان عنق الرحم.', '2019-03-13 16:42:02'),
(16, 2, 1, 1, 'يجب التمييز بين القصور والشذوذ الجنسي. فالقصور هو عجز عن تحصيل الإشباع الجنسي، أي عدم الشبع الجنسي، أما ما يسمى بـ (الشذوذ) فهو انحراف بالفعل الجنسي عن غايته. ولكن علم النفس يعتبر أن الشذوذ هو أن يمارس المرء ما هو عكس طبيعته الجنسية.', '2019-03-13 16:42:02'),
(17, 2, 1, 1, 'لعلاج العنة (قلة الانتصاب) نرى أنه من الضروري تتبع حياة المريض من الماضي إلى الحاضر لمعالجة ما إن كان هناك اكتئاب أو صدمة؛ وهذا مؤقت ويمكن الشفاء منه. كما يمكن مراجعة استشاري جنسي نفسي لهذا الغرض.', '2019-03-13 16:42:02'),
(18, 2, 1, 1, 'إذا لم تكن علاقتك بالشريك جيدة، فعليك التوجه إلى الاستشاري الجنسي بأسئلة من قبيل: ما هي الطريقة الأسلم للعودة لممارسة الجنس، وما هو الحل إن كان  الجنس مؤلماً، أو كيف التغلب على عدم الرغبة، أو ما هو التصرف المناسب في حال أصيب الشريك بالإحباط. فالاستشاري الجنسي هو الأقدر على تقديم  المساعدة في هذه الحال.', '2019-03-13 16:42:02'),
(19, 2, 1, 1, 'لمعالجة القذف المبكر عند الرجال يجب التعود على المداعبة لفترة طويلة للقضيب سواء بشكل ذاتي أو مع الشريكة دون الوصول للقذف. والأمر يحتاج إلى صبر ذاتي ومن الشريكة إن توافرت.', '2019-03-13 16:42:02'),
(20, 2, 1, 1, 'لعلاج القذف المبكر ننصح بالانتصاب والمداعبة مع تجنب لمس رأس القضيب لأنه الأكثر حساسية. وهذا أفضل من استخدام مؤخرات القذف التي قد تسبب العنة والانفصال عن الشريك والإحساس به في بعض الحالات.', '2019-03-13 16:42:02'),
(21, 2, 1, 1, 'على المرأة أن تكون منفتحة مع شريكها حول ما تشعر به ويؤلمها وما تحبه وما لا تحبه بالجنس. فإذا لم تنجح هذه الطريقة، فعليها أن تفكر برؤية معالج أو مستشار جنسي مع شريكها.', '2019-03-13 16:42:02'),
(22, 2, 1, 1, 'أغلب حالات البرود الجنسي عند النساء مصدرها مخاوف جنسية نتيجة تجارب فاشلة أو صادمة وخاصة في الطفولة. واللجوء إلى الاستشاري الجنسي – النفسي يساعدها بالتأكيد.', '2019-03-13 16:42:02'),
(23, 2, 1, 1, 'بعض حالات البرود الجنسي ونسبتها 2.5% سببها عضوي ولا يمكن علاجها، ولكن تشخيص هذا يحتاج إلى اللجوء لاستشاري جنسي – نفسي متمكن.', '2019-03-13 16:42:02'),
(24, 2, 1, 1, 'على المرأة التي تعاني من عدم السعادة الجنسية مع شريكها أن تجرب أوضاعاً جنسية مختلفة إلى أن تجد الوضعية التي تناسبها. كما بإمكانها أن تستكشف خيارات أخرى غير الجنس المهبلي، كالتحفيز الكلامي أو اليدوي.', '2019-03-13 16:42:02'),
(25, 2, 1, 1, 'قد تلعب الشريكة في بعض الأحيان دوراً أساسياً في إصابة الرجل بالعنة.  فقد تكون من النوع المسيطر العدواني سيلط اللسان، وقد يكره الزوج منها ذلك فيعاف الجنس. وقد تكون أكثر تطلباً جنسياً بالتكوين الخلقي منه، مما يشعره بالخصاء أو الضعف أمامها.', '2019-03-13 16:42:02'),
(26, 2, 1, 1, 'العنانية هي الجنس غير الكامل، الذي يتم القذف فيه من خارج المهبل. وهذا يضر الرجل والمرأة على حد سواء. فقد يترتب عليها اضطرابات جنسية تحول بين المرأة وبلوغ الرعشة. كما أن عدم امتصاص المهبل للمني لا يساعد على بلوغ السكينة، فضلاً عن انه مفيد جداً للوقاية من سرطان الرحم.', '2019-03-13 16:42:02'),
(27, 2, 1, 1, 'عندما تمارس المرأة الجنس عليها ألا تتعجل وإنما أن تمنح نفسها الوقت للإثارة؛ فهذا هو الأساس في الفعل الجنسي.', '2019-03-13 16:42:02'),
(28, 2, 1, 1, 'يجب عدم الاستهانة بالجنس كعملية غريزية وشعورية. فهي التي تجعل الأشخاص يصابون بالعدوانية نتيجة عدم التفريغ الكامل لحاجاتهم تحت عناوين وذرائع لا معنى لها.', '2019-03-13 16:42:02'),
(29, 2, 1, 1, 'لعلاج القذف المبكر ينصح باتخاذ وضعية معينة وهي أن تكون الشريكة فوق الرجل الذي يكون مستلقيا،وذلك لسببين: الأول هو أن هذه الوضعية تجعل المرأة تصل إلى الرعشة بسرعة أكبر لتماس القضيب مع منطقة ال G-Spot، والثاني هو أن الرجل في هذه الوضعية لا يكون في أتم حالاته من الاحتكاك برأس القضيب، فتطول الممارسة الجنسية.', '2019-03-13 16:42:02'),
(30, 2, 1, 1, 'قد يؤدي انقطاع الطمث إلى جفاف أنسجة المهبل ويجعل من العملية الجنسية أكثر إيلاماً للمرأة. لذلك لا بد من استخدام الملينات أثناء الممارسة.', '2019-03-13 16:42:02'),
(31, 2, 1, 1, 'تتركز اللذة لدى بعض النساء في البظر أو المهبل أو الشرج أو الرقبة أو في كل هذه المناطق مجتمعة. لذلك على الرجل تقصي تلك المناطق بلا إحراجات وعدم الاكتفاء بالتسرع بالإيلاج بالمهبل، فهذا قد لا يشبع حاجات المرأة.', '2019-03-13 16:42:02'),
(32, 2, 1, 1, 'على الرجل إدراك أن ثمة تنوع نسائي يستوجب عدم تنميطهن. فهناك من تحب ممارسة الجنس في الماء وهناك من تحبه في الهواء الطلق أو في الطبيعة. على الرجل إدراك هذه الفوارق لإرضاء هذه الحاجات. ومهما كانت صعبة التحقق يمكن اختلاق أجواء منزلية تحاكي تلك الأماكن تساعد على تلبية احتياجات الشريكة.', '2019-03-13 16:42:02'),
(33, 2, 1, 1, 'الأعصاب التي يتم تحفيزها أثناء الممارسة الجنسية موجودة في عنق الرحم. وعليه، فإن استخدام أدوات جنسية جارحة قد يؤدي إلى تقطع هذه الأعصاب، مما قد يفقد المرأة القدرة على الوصول إلى الرعشة الجنسية.', '2019-03-13 16:42:02'),
(34, 2, 1, 1, 'من غير المعروف بين البشر أن لكل شخص طاقة جنسية خاصة به ويجب أن تتوافق مع الشريك ليكون بينهما توافق تام. كما يجب الاتفاق والتفاهم والمصارحة على هذه النقاط قبل الزواج. فإذا لم يكن الطرفان بنفس السوية من مستوى الحاجات أو النوعية في الأداء الجنسي يُفضل ألا يتورطا بالعلاقة الدائمة.', '2019-03-13 16:42:02'),
(35, 2, 1, 1, 'على الرجل أن يعرف أن المرأة لا تشبهه. فهي لا تلجأ للجنس مثله أثناء الضغوطات، بل إنها تبتعد عنه إلى أن تزول الضغوطات التي تعاني منها، بخلاف بعض النساء الشبقات والمازوشيات اللواتي يمارسن الجنس أثناء الانفعال، وهذا يريحهن، لكن لا تتجاوز نسبتهن 5%.', '2019-03-13 16:42:02'),
(36, 2, 1, 1, 'بعد عملية إزالة المبيضين لدى المرأة تضعف رغبتها في ممارسة الجنس لأن المبيضين هما اللذان ينتجان هرمون التستسترون المسؤول عن الرغبة الجنسية لدى الجنسين.', '2019-03-13 16:42:02'),
(37, 2, 1, 1, 'يجب ألا نكون أنانيين في الممارسة الجنسية، فهي قمة الشعور الذي يجب أن نعطيه قبل أن نحصل عليه، وذلك من أجل حياة سوية مع الطرف الآخر. باختصار، الجنس عطاء قبل الأخذ.', '2019-03-13 16:42:02'),
(38, 2, 1, 1, 'على الرجل أن يتجنب إشعار الشريكة أنه يحبها فقط وقت حاجاته الجنسية لأن ذلك يشعرها بالانزعاج والضغط النفسي والإهانة. ', '2019-03-13 16:42:02'),
(39, 2, 1, 1, 'تؤدي عملية استئصال الرحم لدى المرأة إلى توقف الحياة الجنسية لديها لبضعة أسابيع فقط، لذلك ليس عليها أن تنهي حياتها الجنسية، ذلك أنه وفقاً لدراسات في هذا المجال فقد استمرت الحياة الجنسية لمعظم النساء كما كانت أو تحسنت قليلاً بعد إجراء العملية. ', '2019-03-13 16:42:02'),
(40, 2, 1, 1, 'يجب عدم التباهي طيلة الوقت بالماضي الجنسي مع الشريكة ومقارنته بالحاضر، إذ ليس من الصحي مطلقاً إخبار الشريكة بالمغامرات الجنسية السابقة لأن ذلك سيخلق حالة دائمة من المقارنة بين الماضي والحاضر، ما قد يولد الإحباط والشعور بالنقص.', '2019-03-13 16:42:02'),
(41, 2, 1, 1, 'من المفيد أن يدرك الرجال التوقيت الذي يمكن أن يطلبوا به الممارسة الجنسية وذلك من خلال قراءة تلميحات المرأة. فهي تستخدم تعابير الجسد واللباس كمؤشرات على مطالبها.', '2019-03-13 16:42:02'),
(42, 2, 1, 1, 'بعد أي عملية جراحية للرحم يجب أن تختفي الآثار الجانبية المرتبطة بها وتلتئم الجروح خلال شهرين. لذلك توصي الكلية الأمريكية لأطباء التوليد وأمراض النساء، ووزارة الصحة، والخدمات الإنسانية الأمريكية، بعدم إدخال أي شيء في المهبل وخاصة في الأسابيع الستة الأولى بعد الجراحة؛ وعلى الأخص الممارسة الجنسية.', '2019-03-13 16:42:02'),
(43, 2, 1, 1, 'رائحة الفم الكريهة لدى الطرفين منفرة جنسياً، لذلك على الطرفين أن تكون رائحة فمهما عطرة قبيل الشروع في التقبيل.', '2019-03-13 16:42:02'),
(44, 2, 1, 1, 'الانتباه إلى مرحلة ما بعد العملية الجنسية أمر مهم. فالمرأة تكره أن تترك مباشرة بعد الممارسة الجنسية ويشعرها ذلك بالمذلة. فهي تفضل أن يستمر الحب بعد الممارسة. كما أن جسدها بحاجة للتلامس بعد الانتهاء من أجل إنتاج الأندورفينوالإكسيتوسين الضروريين نفسياً وجسدياً.', '2019-03-13 16:42:02'),
(45, 2, 1, 1, 'استئصال الرحم هو عملية جراحية يزال الرحم بموجبها وذلك للتخفيف من الألم وأعراض وحالات أخرى كالأورام الليفية أو أمراض بطانة الرحم. وبالنسبة لسرطان الرحم أو سرطان عنق الرحم فإن استئصال الرحم لن يؤثر على العملية الجنسية أبداً.', '2019-03-13 16:42:02'),
(46, 2, 1, 1, 'من المهم أن يدرك الرجل والمرأة خلال العملية الجنسية أنهما يخرجان عن الواقع والمنطق وأنهما يتحولان إلى كائنين شعوريين غريزيين فقط، وأن الأمور تعود إلى حالها بعد الممارسة. لذلك لا يجب أن يلوم أي طرف الطرف الآخر أو يشك به بسبب إطلاق ما بداخله من رغبات.', '2019-03-13 16:42:02'),
(47, 2, 1, 1, 'من الضروري أن يداعب الرجل شريكته قبيل الشروع بالعملية الجنسية سواء بالكلام الرقيق أو القبل أو مديح المظهر لأن ذلك يساعدها في الاستعداد للعملية ومن ثم تأتي المداعبة الجسدية.', '2019-03-13 16:42:02'),
(48, 2, 1, 1, 'إن لم يكن ثمة ارتياح في ممارسة شيء معين خلال العملية الجنسية كممارسة الجنس الفموي، فليس على الشريك إبقاء مخاوفه لنفسه؛ بل عليه مناقشتها مع شريكه الجنسي ٍلأن تلك المخاوف قد تكون نابعة من أفكار مسبقة عن الجنس ليس إلا.', '2019-03-13 16:42:02'),
(49, 2, 1, 1, 'تعتبر جلسات المساج أمرأً له لذة خاصة لكل من الرجل والمرأة، فهي تحرض مناطق اللذة لدى كل منهما.', '2019-03-13 16:42:02'),
(50, 2, 1, 1, 'يجب عدم القيام بأمور جديدة في العملية الجنسية دون علم الشريكة أو دون تمهيد لأن ذلك يشعرها بأنها مسلوبة الإرادة باستثناء بعض الحالات المازوشية. من المهم أن تكون العملية ضمن الأطر المتفق عليها بشكل مسبق.', '2019-03-13 16:42:02'),
(51, 2, 1, 1, 'يمكن أن تنتقل مجموعة من الفيروسات عبر الممارسة الجنسية كما هي الحال مع فيروس الورم الحليمي (HPV) الشائع جداً والمعدي والذي يمكن أن يتسبب في ظهور البثور التناسلية ويزيد من خطر الإصابة بسرطان عنق الرحم.', '2019-03-13 16:42:02'),
(52, 2, 1, 1, 'إذا كان الشريك من النوع السمعي فمن الضروري استثارته سمعياً عبر امتداحه وكونه مثيراً من الناحية الجنسية.', '2019-03-13 16:42:02'),
(53, 2, 1, 1, 'إذا لم يكن شريكك الجنسي من النوع السمعي فيفضل أن يكون الفعل الجنسي صامتاً، ولكن إذا كان أحد الشريكين سمعياً والآخر غير سمعي فالعلاقة بينهما مهددة بالفشل.', '2019-03-13 16:42:02'),
(54, 2, 1, 1, 'تظل بعض الأمراض التي تنتقل بالاتصال الجنسي عرضاً لسنوات عديدة. فالكلاميديا على سبيل المثال هي عبارة عن جراثيم تنتقل بصمت عبر الاتصال الجنسي دون أن تفصح عن نفسها، وتؤدي في النهاية إلى العقم.', '2019-03-13 16:42:02'),
(55, 2, 1, 1, 'ست وتسعون بالمائة من آلام الظهر لدى النساء مصدرها نفسي وليس عضوي. وتترافق هذه الآلام مع سوء التوافق في العلاقة الجسدية مع الشريك. ويتمثل علاج هذه الحالة بتفريغ المرأة لكل ما تعاني منه ويزعجها أثناء العملية الجنسية وغيرها بدلاً من الكبت ومفاقمة الأمور.', '2019-03-13 16:42:02'),
(56, 2, 1, 1, 'يمكن أن تعزى قلة الرغبة الجنسية عند المرأة إلى عدة أسباب منها مشاكل تتعلق بجفاف المهبل، أو مشاكل نفسية في أعقاب صدمة ما، أو تغييرات هرمونية في مرحلة انقطاع الطمث مثلاً.', '2019-03-13 16:42:02'),
(57, 2, 1, 1, 'على المرأة أن تزور طبيب النسائية الخاص بها بشكل دوري وذلك للتأكد من خلوها من الأمراض المعدية والمنقولة بالاتصال الجنسي، كفيروس نقص المناعة مثلاً. كما عليها القيام بمسحة عنق الرحم للكشف المبكر عن سرطان عنق الرحم.', '2019-03-13 16:42:02'),
(58, 2, 1, 1, 'بالنسبة للناس العاديين (غير مفرطي الشهوة) فإن ممارسة الجنس مرتين في الأسبوع على الأقل تساعد في الحصول على مزيد من الهدوء وتجنب الشريكين الشعور بالتوتر الناجم عن الحياة العملية،  وهذا بحد ذاته طريقة تتيح لهم فرصة أكبر في التفكير الهادئ وحل المشاكل التي تعترضهم.', '2019-03-13 16:42:02'),
(59, 2, 1, 1, 'ثمة شخصيات تحتاج إلى ممارسة الجنس بشكل مكثف ولكن لا تتاح لها الفرصة لذلك، وهذا ما يؤدي إلى ضعف في الذاكرة أو التشتت.', '2019-03-13 16:42:02'),
(60, 2, 1, 1, 'على المرأة أن تكون ممتنة لأن الفرج والمهبل لديها قادران على منحها المتعة التي تحتاجها. لذلك على أولئك النسوة اللواتي يفكرن بإجراء جراحات لتحسين مظهر الأعضاء التناسلية فهم أن الجراحة نفسها قد تسبب ضرراً أكبر وتؤدي إلى تندب مفرط للأنسجة وتخفف من الإحساس بالمتعة الجنسية.', '2019-03-13 16:42:02'),
(61, 2, 1, 1, 'الإدمان على الجنس المرئي، عبر مشاهدة الصور والأفلام، هو حالة خاصة من الشهوة البصرية، حيث تسيطر على المرء الرغبة بمشاهدة المشاهد المثيرة للغريزة. بعض هذه الشخصيات تكون محض بصرية ولا تهتم بالحس المباشر.', '2019-03-13 16:42:02'),
(62, 2, 1, 1, 'أسباب الضعف الجنسي عديدة منها الإصابة بأمراض عضوية من قبيل مرض السكري أو أمراض الدم، وكذلك التقدم في العمر، أو الاضطرابات الهرمونية مثل كسل الغدة الدرقية أو ارتفاع تركيز هرمون الحليب أو نقص الأندروجينات التي تسبب أمراض الخصيتين. إلا أن ثمة أدوية يستخدمها المرء في علاج بعض الأمراض هي التي تكون سبباً وراء الضعف الجنسي.', '2019-03-13 16:42:02'),
(63, 2, 1, 1, 'يمكن أن تكون الشفرتان في فرج المرأة متناظرتين أو غير متناظرتين وتتراوحان في الحجم وتتنوعان في الملمس واللون، فقد يتأرجح لونهما بين مجموعة من الألوان من اللون الوردي إلى اللون البني.', '2019-03-13 16:42:02'),
(64, 2, 1, 1, 'عندما يترافق الجنس مع الحب فإن ذلك يرفع من مستوى هرمونات السعادة كالأوكسيتوسينوالأندورفينوالسيروتونين، وهو ما يجعل الإحساس بالجنس مختلفاً ونهاية العملية الجنسية مختلفة.', '2019-03-13 16:42:02'),
(65, 2, 1, 1, 'للانفعالات النفسية والجنسية دور هام في تكوين المشاعر الجنسية لدى الأنثى. ومن الضروري معرفة أنها لا تنمو بالشكل السليم إلا بالتعليم الجنسي السليم والنشأة في بيئة متوازنة وأسرة خالية من العقد.', '2019-03-13 16:42:02'),
(66, 2, 1, 1, 'لتحقيق النشوة الجنسية لدى كثير من النساء البظريات على الرجل أن يلجأ إلى تحفيز البظر من أجل بلوغ الرضى الجنسي الكامل. وهذا أمر غير مخجل طالما أنهن من النوع الذي تتركز لديه اللذة في هذا المكان.', '2019-03-13 16:42:02'),
(67, 2, 1, 1, 'هناك قلق يصيب الذكور في الطور القضيبي الطفولي يسمى بقلق الخصاء بسبب تهديدات الأهل بقطع قضيبه إن ضبطوه يدلكه أو يلعب به. وهذا القلق قد يتطور في المستقبل ليصل إلى حد العجز الجنسي.', '2019-03-13 16:42:02'),
(68, 2, 1, 1, 'في التحليل النفسي هنالك عدة مراحل يمر بها الشخص منذ ولادته تبدأ بالطور الفمي ثم الطور الشرجي وبعدها يأتي الطور القضيبي تليه فترة الكمون. وتجدر الإشارة إلى أنه من الضروري عدم كبت الطفل وتسريع مرور كل طور لأن ذلك قد يشكل له عقداً حينما يكبر. فقد يشكل الفطام المبكر للطفل الذكر تثبتاً باللذة في المرحلة الفمية عندما يكبر.', '2019-03-13 16:42:02'),
(69, 2, 1, 1, 'وفقاً لبعض الدراسات فهناك نسبة من النساء تبلغ 71% لم تشعر أبداً بالنشوة الجنسية أثناء ممارسة الجنس. والحقيقة أن هذا يعود لكونهن من النوع الضعيف بنيوياً في الاستمتاع الجنسي أو لكون شريكهن يعاني من سرعة في القذف أو أنه لا يعرف كيفية إثارتهن لعدم معرفته بمناطق اللذة لديهن. أو قد يعود الأمر لسبب آخر مختلف وهو أنهن لا يجرؤون على التعبير عما يسعدهن ويحقق لهن اللذة المطلوبة.', '2019-03-13 16:42:02'),
(70, 2, 1, 1, 'السبب الواضح لتراجع الرغبة الجنسية لدى الرجل هو انخفاض معدلات هرمون التستسترون أو انخفاض في إنتاج الحموض الأمينية، وهو ما يمكن تشخيصه من خلال فحص الدم ومراجعة استشاري لوصف العلاج الأنجع.', '2019-03-13 16:42:02'),
(71, 2, 1, 1, 'قد تتسبب أطعمة فيها هرمونات كالدجاج أو الخضار البلاستيكية بالسرطانات أو قد تؤدي العجز الجنسي لدى الرجال وانخفاض في معدلات الذكورة. وهذه الهرمونات التي تدخل الجسم عبر تلك الأطعمة هي هرمونات أنثوية في الغالب تضر المرأة أيضاً كما الرجل. لذلك ينصح بالابتعاد عنها تجنباً لأضرارها.', '2019-03-13 16:42:02'),
(72, 2, 1, 1, 'يمكن لقلة من الشركاء أن يجربوا تنسيق هزات الجماع مع بعض أثناء ممارسة الجنس. وهذا ما أكدته أبحاث معهد كينزي لأبحاث الجنس والاستنساخ، حيث أن 29% فقط من الشركاء – وفقاً لاستبيانات المعهد – استطاعوا الوصول إلى تنسيق في هزات الجماع.', '2019-03-13 16:42:02'),
(73, 2, 1, 1, 'تراجع عمل الخصيتين عند الذكر قبل البلوغ له تأثيرات مباشرة على الصفات الجنسية للذكر. لذلك يميل إلى التشبه بالإناث في الشكل، فيكون صوته رقيقاً وأردافه وأثداؤه ممتلئة.', '2019-03-13 16:42:02'),
(74, 2, 1, 1, 'للتمييز بين العجز العضوي والعجز النفسي يتم اختبار قوة انتصاب العضو الذكري باستخدام الحقن الموضعية وقياس الانتصاب الليلي والمبكر. كما أن ثمة فحوصات عدة تجري لتشخيص العجز، منها الفحص الطبي الشامل وقياس مستوى السكر في الدم.', '2019-03-13 16:42:02'),
(75, 2, 1, 1, 'لا يمر المخاض أو الولادة دون إحداث تغييرات في المهبل. فعند الولادة يتمدد المهبل لحين خروج الطفل ويعود لحالته الطبيعية وتشفى جميع الأنسجة الرحمية بعد ذلك بسبب طبيعة المهبل المرنة. وهذا من حسن حظ النساء.', '2019-03-13 16:42:02'),
(76, 2, 1, 1, 'أضرار الفياغرا كثيرة ومنها الدوار واحمرار الوجه واضطرابات المعدة وآلام العضلات والظهر وعسر الهضم والطفح الجلدي وتسرع القلب. لذلك ينبغي الحذر في استخدامه ولا يتم ذلك إلا وفقاً لتعليمات الطبيب المختص.', '2019-03-13 16:42:02'),
(77, 2, 1, 1, 'لفصول السنة تأثيرات نفسية غير مباشرة على الطاقة الجنسية للبشر. فعلى سبيل المثال، ثمة علاقة بين مناخ البحر الأبيض المتوسط وحالة الشبق لدى رجال ونساء البلدان الواقعة على البحر، حيث يكثر تناول الأسماك والبحريات. وينطبق الأمر ذاته على نساء ورجال المناطق الحارة.', '2019-03-13 16:42:02'),
(78, 2, 1, 1, 'إذا كان لدى المرأة ألم أثناء الجماع وتعاني من إفرازات مهبلية أو تشنجات الحيض الشديدة أو عدم راحة أثناء التبول، فعليها برؤية الطبيب المختص لاستبعاد احتمال الإصابة بمرض في عنق الرحم أو بطانة الرحم الهاجرة أو التهاب المثانة الخلالي.', '2019-03-13 16:42:02'),
(79, 2, 1, 1, 'اليوم الرابع عشر من الدورة الشهرية هو أفضل يوم لإكمال العملية الجنسية بالحمل، إذ تكون البويضة في هذا  اليوم على أتم الاستعداد لاحتضان النطاف. وفي هذا اليوم تكون شهية المرأة الجنسية عالية جداً.', '2019-03-13 16:42:02'),
(80, 2, 1, 1, 'تزداد شهية المرأة للجنس قبيل الدورة الشهرية وأثناءها لانخفاض الأستروجين وارتفاع معدلات التستسترون لديها.', '2019-03-13 16:42:02'),
(81, 2, 1, 1, 'تعاني العديد من النساء من الألم في مراكز معينة فقط أثناء ممارسة الجنس، وفي أوقات معينة من الدورة الشهرية، وهذا أمر طبيعي رغم أنه من الواجب إعلام الطبيب المختص إن كان الألم شديداً أو مستمراً.', '2019-03-13 16:42:02'),
(82, 2, 1, 1, 'يعد التوافق الشعوري من أهم عوامل تحقيق التوافق الجنسي مع الشريكة. فقدرة الرجل على امتلاك شعورها تعني قدرته على تحصيل الأقصى وزيادة المتعة في العلاقة الجنسية.', '2019-03-13 16:42:02'),
(83, 2, 1, 1, 'على الشريكين تجنب الثبات في أسلوب الممارسة الجنسية لأن عدم التغيير في الوضعيات قد يؤدي إلى الملل وقد يصل في بعض الحالات إلى البرود الجنسي.', '2019-03-13 16:42:02'),
(84, 2, 1, 1, 'يختلف مهبل كل امرأة عن الأخرى، وهو غير متماثل لدى النساء. لذلك ليس هناك شكل عام أو نمطي للمهبل وعلى الرجل أن يفهم الاختلافات بين النساء في هذا الشأن.', '2019-03-13 16:42:02'),
(85, 2, 1, 1, 'تحب بعض النساء الاستعراضيات أن يمارس شريكهن العادة السرية على منظرهن. فهذا يشعرهن بأنهن يمتلكن مكثف الأنوثة.', '2019-03-13 16:42:02'),
(86, 2, 1, 1, 'لا تعد ممارسة العادة السرية انحرافاً سلوكياً نفسياً على الإطلاق، ففي غياب شريك جنسي تعتبر وسيلة جيدة للتفريغ وإمتاع النفس وتخفيف التوتر، كما أنها تساعد على تحسين النوم.', '2019-03-13 16:42:02'),
(87, 2, 1, 1, 'نظراً لوجود الأعضاء التناسلية الأنثوية (كالرحم والمبيضين والمهبل) على مقربة من الكولون فإن احتمالية إطلاق الغازات المحبوسة لدى المرأة أمر طبيعي جداً وذلك بسبب أي حركة يمكن أن تحدث لهذه الأعضاء بسبب الجماع والوضعيات المختلفة. وهذا أمر لا يستوجب الخجل.', '2019-03-13 16:42:02'),
(88, 2, 1, 1, 'إذا كانت لدى المرأة رغبة في ممارسة العلاقة الجنسية أثناء فترة الطمث فلا بأس في ذلك إذا كان لدى شريكها نفس الرغبة، فدم الطمث هو دم شرياني نظيف وغير مؤذ على الإطلاق شرط استخدام الواقيالذكري.', '2019-03-13 16:42:02'),
(89, 2, 1, 1, 'من المهم جداً مراعاة الفروق التي يحدثها السن في الممارسة الجنسية، حيث أن دورت الاستجابة الجنسية تبدأ بالتهيج ثم تصل إلى ذروة التهيج (peak) فالرعشة وأخيراً الارتخاء. ونتيجة للتقدم في السن يتأخر التهيج لبضعة دقائق على عكس الاستجابة السريعة لدى الشباب.', '2019-03-13 16:42:02'),
(90, 2, 1, 1, 'إذا كانت المرأة من النوع الذي يعاني من التقلصات المستمرة بعد الجماع فمن الأفضل لها أن تقوم بزيارة لطبيبها الخاص للتأكد من عدم إصابتها بالأورام الليفية أو التهاب المسالك البولية أو أمراض تصيب بطانة الرحم.', '2019-03-13 16:42:02'),
(91, 2, 1, 1, 'وصول المرأة متوسطة الشهوة إلى الرعشة الجنسية يحتاج إلى فترة أطول من الرجل الذي عليه أن يحاول المقاربة بين وصوله وقذفه ورعشتها، وذلك باللجوء إلى مداعبتها قبل عملية الإيلاج.', '2019-03-13 16:42:02'),
(92, 2, 1, 1, 'إذا كان شريكك من أصحاب الخيال الجنسي (الفانتازيا) فقد يتطلب الأمر منك القيام بأدوار متعددة (طبيب، مومس، رجل إطفاء ...). مجاراتك للشريك سيزيد من إثارته والوصول إلى متعة أكبر. وشرط ذلك التوافق في الميل الفانتازي.', '2019-03-13 16:42:02'),
(93, 2, 1, 1, 'قد يكون الإحساس بالتشنج عند المرأة بعد أو أثناء الممارسة الجنسية ناجماً عن عدم الراحة في المثانة أو المسالك البولية، لذلك تنصح المرأة بتفريغ المثانة قبل وبعد الممارسة.', '2019-03-13 16:42:02'),
(94, 2, 1, 1, 'ممارسة الجنس من الشرج بشكل دائم قد يؤدي إلى أضرار منها توسع الحلقة الشرجية، وهو ما سيضر بالمرأة بشكل كبير. لذا يجب توخي الحذر.', '2019-03-13 16:42:02'),
(95, 2, 1, 1, 'الممارسة الجنسية المصحوبة باستخدام الكلمات الجنسية البذيئة مقبولة فقط أثناء الممارسة، وخاصة إن كان الشريك من النوع المازوشي الذي يجد لذة في الألم والتعذيب.', '2019-03-13 16:42:02'),
(96, 2, 1, 1, 'يمكن أن يكون التشنج بعد الجماع أمراً طبيعياً ذلك أن الجزء السفلي من الرحم المسمى بعنق الرحم قد تعرض للتهيج أثناء الممارسة أو بسبب تماسه مع القضيب أو الأصابع.', '2019-03-13 16:42:02'),
(97, 2, 1, 1, 'ممارسة المرأة للعادة السرية أمام الرجل يمكن أن يتم في حال كان الشريك من النوع البصري. فذلك سيرضي ميله للنظر الجنسي.', '2019-03-13 16:42:02'),
(98, 2, 1, 1, 'ينبغي عدم استخدام الفازلين كوسيلة مساعدة لعملية الإيلاج في المهبل لأن هذه المادة تشكل طبقة عازلة وتؤدي إلى خفض اللذة.', '2019-03-13 16:42:02'),
(99, 2, 1, 1, 'عندما تلاحظ المراهقات أو النساء الحوامل أي نزيف خفيف فليس عليهن القلق الشديد لأن ذلك يعود لتغييرات طبيعية في عنق الرحم. ومع ذلك ينبغي عليهن زيارة الطبيب لاستبعاد أي مشاكل قد تكون غير ظاهرة.', '2019-03-13 16:42:02'),
(100, 2, 1, 1, 'على الرجل تجنب عدم القذف لأن ذلك سيؤدي به إلى مشاكل في البروستات.', '2019-03-13 16:42:02'),
(101, 2, 1, 1, 'إذا كنت ممن يجدون متعة ولذة في إلحاق الأذى بالشريك أثناء ممارسة العلاقة الجنسية فهذا دليل على أنك شخص سادي. وقد تكون هذه السادية من طبيعتك أو جراء عقدة (انحراف سلوكي) والتمييز بين السببين يحتاج إلى محلل نفسي والأمر يحتاج إلى استشارة جنسية.', '2019-03-13 16:42:02'),
(102, 2, 1, 1, 'عندما تجالس امرأة رجلاً فتراها تلاعب قلماً بين أيديها وتضعه في فمها بين الحين والآخر فهي تبدي رغبة حميمية تجاه هذا الرجل. ', '2019-03-13 16:42:02'),
(103, 2, 1, 1, 'على المرأة مصارحة شريكها بأماكن الحساسية الجنسية لديها، فقد لا يستطيع الرجل معرفتها بنفسها، وذلك ليداعبها قبيل العملية الجنسية وأثناء فتتحقق لهما المتعة واللذة.', '2019-03-13 16:42:02'),
(104, 2, 1, 1, 'إصابة المرأة بالبرود الجنسي يعود إلى أسباب عديدة، كطبيعة المرأة (فقد تكون ذات حاجات جنسية منخفضة)، أو نتيجة لصدمة نفسية (وهذا يحتاج إلى علاج لدى مختص نفسي وإلى استشارة نفسية جنسية)، أو قد يعود السبب إلى انخفاض في الحموض الأمينية.', '2019-03-13 16:42:02'),
(105, 2, 1, 1, 'يبلغ الدافع الجنسي لدى الرجل أوجه في عمر 19 ولكن اهتمامه بالجنس وإقباله عليه يحافظ عليه طوال حياته. فالاهتمام بالجنس لدى رجل في الستين يماثل اهتمامه عندما كان في الثلاثين لكن كفاءته الجسدية تتراجع. ', '2019-03-13 16:42:02'),
(106, 2, 1, 1, 'من الوضعيات التي تساعد الذكر على القذف بشكل كامل هو أن تكون المرأة تحته أو في وضعية القطة أو الحصان.', '2019-03-13 16:42:02'),
(107, 2, 1, 1, 'أثناء ممارسة الجنس الفموي من الأفضل عدم القذف في الفم لأن ذلك يؤثر سلباً على الرجل ويؤدي إلى سحب طاقته.', '2019-03-13 16:42:02'),
(108, 2, 1, 1, 'الرغبة في ممارسة الجنس مع الصغار هي تعبير عن إشكالية في السلوك ويجب في هذه الحالة اللجوء إلى مختص نفسي للعلاج وتلقي استشارات عاجلة.', '2019-03-13 16:42:02'),
(109, 2, 1, 1, 'لا بد من معرفة طبيعة الشريك الجنسية (سمعي أو بصري أو حسي أو شمي) مع الأخذ بعين الاعتبار أنه قد يجمع كل هذه الصفات أو بعض منها، وهذا أمر مهم جداً للوصول إلى العلاقة المثلى مع الشريك. لذلك لا بد من إجراء اختبار البصمة الجنسية المرفقة مع هذا التطبيق.', '2019-03-13 16:42:02'),
(110, 2, 1, 1, 'لا يمكن اعتبار العادة السرية عند المراهقين خصوصاً والبالغين عموماً انحرافاً، بل هي مصدر من مصادر اللذة. كما أن للعادة السرية عند المتزوجين نكهة خاصة شرط ألا تكون بديلاً عن الممارسة مع الشريك.', '2019-03-13 16:42:02'),
(111, 2, 1, 1, 'تعتبر المرأة نفسها ابنة للطبيعة بامتياز، لذلك فهي لن تنسى أبداً الممارسات الجنسية التي تكون في الطبيعة أو في الماء لأنها أماكن غير متوقعة وتولد إحساسات متميزة وتكون نوعاً من الامتزاج بالطبيعة.', '2019-03-13 16:42:02'),
(112, 2, 1, 1, 'ليس المجتمع هو المعيار الذي يحدد ما هو سوي أو غير سوي جنسياً. فما قد يراه المجتمع غير سوي ليس صحيحاً على الإطلاق لأن ذلك قد يكون مرتبطاً بطبيعة تكوين الشخص حينما كان جنيناً في رحم أمه وتلقى جرعات هرمونية متفاوتة شكلت بصمته المخية الخاصة به. (يمكن معرفة هذه البصمة عن طريق إجراء الاختبار النفسي الموجود في هذا التطبيق)', '2019-03-13 16:42:02'),
(113, 2, 1, 1, 'أفضل شريك جنسي للشخصية المازوشية هو الشريك السادي (الذي يحب تعذيب الآخرين). فالشخص المازوشي يصل إلى قمة النشوة الجنسية حينما يهان أو يذل نفسياً (بالكلام) أو جسدياً (بالضرب) ويكون هو المفعول به. أما السادي فيصل إلى الذروة حينما يكون هو الفاعل ويقوم بإذلال الآخرين ويكون هو القائد في الفعل الجنسي.', '2019-03-13 16:42:02'),
(114, 2, 1, 1, 'إن لم تكن الانحرافات الجنسية التي يعاني منها الرجال والنساء البالغين بنيوية فهي ناتجة عن خبرات مردها تجارب في مرحلة المراهقة وما قبلها، لذلك لا بد من تعريف المراهقين بالأمور الجنسية وتقديم التربية الجنسية في هذه المرحلة بالذات.', '2019-03-13 16:42:02'),
(115, 2, 1, 1, 'النظر الجنسي لدى الذكور أقوى من الإناث وهم يفضلون الرؤية في الممارسة بينما تبرع الإناث في حاستي اللمس والسمع، لذلك على الشريكين مراعاة الخصوصية التكوينية لكل منهما.', '2019-03-13 16:42:02'),
(116, 2, 1, 1, 'قدرة المرأة على الرؤية في الظلام أكبر من الرجل لذلك فهي تحب الممارسة الجنسية تحت أضواء خافتة فيما عين الرجل غير قادرة على الرؤية مثلها ولأنه بصري فهو يفضل الممارسة في الضوء. وهذا يخلق تناقضاً بينهما لا بد من حله. ويمكن التفاهم عليه أو اللجوء لاستشاري جنسي.', '2019-03-13 16:42:02'),
(117, 2, 1, 1, 'غيرة الرجل على شريكته واتهامه لها بإقامة علاقة جنسية مع غيره غالباً ما يعود سببها لعجزه الجنسي وشعوره بالنقص، فيسقط هذا العجز على شريكته. لذلك يفضل مراجعة طبيب نفسي أو استشاري نفسي جنسي لهذا الغرض.', '2019-03-13 16:42:02'),
(118, 2, 1, 1, 'لم يحدث في التاريخ وأن اتبع شعب من الشعوب أو حضارة نفس السلوك الجنسي، لذلك لا يمكن أن ننعت شخصاً ما بالانحراف الجنسي لأن النمط الجنسي عنده مختلف عن الأنماط المتعارف عليها.', '2019-03-13 16:42:02'),
(119, 2, 1, 1, 'عند الحديث مع المراهقين ينبغي توخي كامل الحذر وعدم استخدام ألفاظ جنسية لها مدلولات قد ترسخ في ذهنه فيتصرف بمقتضاها. لذلك لا يجب القول له بأنه لوطي مثلاً لأن عقله سيتصرف وفقاً لهذه الكلمة وليس بشكل معاكس لها.', '2019-03-13 16:42:02'),
(120, 2, 1, 1, 'لا ينبغي إطلاق لقب (فيتشي) على شخص لمجرد أنه يتعشق أثراً نسائياً معيناً، فالفيتشية تعني أن الشخص يصرف طاقته الجنسية في مجال واحد. وللعلم فإن لبعض الأشخاص طيف واسع من الفيتشية أو درجة منخفضة منها، بحسب تكوينه. وللاستفسار عن ذلك يمكن مراجعة الاستشاري الجنسي.', '2019-03-13 16:42:02'),
(121, 2, 1, 1, 'ينصح الشريكان بأن يقوما بتعزيز السلوك الجنسي الذي يحقق استجابة عالية بينهما مع مراعاة عدم الاقتصار على سلوك معين أو نمط جنسي واحد.', '2019-03-13 16:42:02'),
(122, 2, 1, 1, 'على الشريك أن يتقبل عزوف المرأة عن الجماع بعد انقطاع الحيض وذلك لأن غشاء المهبل يرق ويضمر وتتعرى حشفة البظر وتؤلمها الملامسة والاحتكاك، فيتعذر إلى حد ما الجماع. ولكن قد يكون سبب عزوفها نفسي، وهنا لا بد من مراجعة الاستشاري النفسي الجنسي.', '2019-03-13 16:42:02'),
(123, 2, 1, 1, 'يفضل أن يقوم الشريكان بالتجديد المستمر في طريقة الجماع وفي نمط الفعل الجنسي ونمط الحياة والمواقف اليومية بينهما لأن البعض يصيبهم الملل نتيجة العلاقة الجنسية الروتينية التي تؤدي إلى نوع من الشيخوخة الجنسية المبكرة.', '2019-03-13 16:42:02'),
(124, 2, 1, 1, 'على الشريكة ألا تطلب من شريكها الطاعن في السن أن يقذف في كل جماع كما اعتادت منه في الأحوال العادية، فهو قد يمارس الجنس في هذا العمر دون أن يحتاج إلى القذف، فيوفر طاقته المنائية لجماع آخر. وهذا الفهم هو السر في استمرار القدرة الجنسية حتى سن متأخر.', '2019-03-13 16:42:02'),
(125, 2, 1, 1, 'يفضل أن تمارس المرأة الجنس بانتظام مرة أو مرتين في الأسبوع إذا كانت طبيعتها التكوينية تسمح بذلك، لأنه عندما ينقطع الحيض يحميها هذا الاستمرار من أي تدهور جنسي. فالممارسة المنتظمة تكون بمثابة تدريب للمهبل والرحم ضد أي تدهور جنسي مستقبلي.', '2019-03-13 16:42:02'),
(126, 2, 1, 1, 'يفضل أن يقوم شريك المرأةالبظرية أن يداعبها أولاً من البظر حتى تقارب الرعشة ومن ثم يقوم بالإيلاج، أو أن يجعلها تصل للرعشة بالمداعبة ثم يقوم بإيلاج قضيبه.', '2019-03-13 16:42:02'),
(127, 2, 1, 1, 'على الأب عدم تهديد الابن عند ممارسة العادة السرية بقطع قضيبه لأن ذلك يولد عنده قعدة الخصاء، مما يدفعه لأن يميل بسلوكه إلى السلبية ويتصرف كالإناث.', '2019-03-13 16:42:02'),
(128, 2, 1, 1, 'يسبب القذف المبكر المتكرر لدى الرجل نوعاً من العجز عن الوصول للرعشة لدى المرأة لأنها تشعر وكأنها استخدمت كأداة لإشباع رغبات الرجل دون أدنى انتباه لرغباتها هي.', '2019-03-13 16:42:02'),
(129, 2, 1, 1, 'يصل غالبية الذكور قبل الإناث إلى الرعشة الجنسية، لذلك على الشريك أن يبدأ أولاً بمداعبة شريكته حتى يصلا إلى الرعشة مع بعضهما. وهذا ما يحقق نوعاً من الرضى عند الشريكين وخاصة المرأة.', '2019-03-13 16:42:02'),
(130, 2, 1, 1, 'إذا ولد الذكر أو الأنثى لوالدين بينهما فارق سن كبير، ينشآ ولديهما تثبت في الشعور بالحب تجاه كبار السن وتنشأ لديهما رغبات أوديبية تبقى تعمل لا شعورياً وتوجه سلوكهما الجنسي، كالرغبة بممارسة الفعل الجنسي مع من يكبرهما سناً.', '2019-03-13 16:42:02'),
(131, 2, 1, 1, 'أفضل شريك للمرأة المسترجلة (ذات الطبيعة الذكورية) هو الرجل الذي يميل إلى الطبيعة الأنثوية لأنه يشبع فيها استرجالها ويرضي فيها الدور القيادي، لكنها لن تحترمه في العمق.', '2019-03-13 16:42:02'),
(132, 2, 1, 1, 'إذا كان الأب يغلو في شروط ومطالب تزويج ابنته، فهو غالباً ما يكون من الأشخاص الذين يعانون من عقدة (جريزلدا) والتي تعني أن الأب يتعلق بابنته تعلقاً جنسياً خفياً نتيجة عدم تخلصه من المواقفالأوديبية.', '2019-03-13 16:42:02'),
(133, 2, 1, 1, 'الشريك الذي يأخذ ولا يعطي في الممارسة الجنسية ويطلب ما يسعده ويحقق له اللذة دون أن يراعي ما يسعد شريكه هو شريك نرجسي يعتقد بأن العالم متمحور حوله وعلى الآخرين السعي لإرضائه. وهذا بالطبع يستدعي اللجوء إلى الاستشاري الجنسي النفسي.', '2019-03-13 16:42:02'),
(134, 2, 1, 1, 'ممارسة الجنس بشكل منتظم يساعد المرأة على الاستقرار الجنسي مع التقدم في العمر وبعد انقطاع الطمث، فهذا يحافظ على جدار المهبل وعلى إفراز السوائل المرطبة داخله. أما الرجل فيساعده ذلك على المحافظة على عمل الخصيتين ويحميه من سرطان المثانة وسرطان البروستات.', '2019-03-13 16:42:02'),
(135, 2, 1, 1, 'العادة السرية عند الرجل والمرأة هي طريقة من طرق إشباع الرغبات والوصول إلى اللذة. وهي صحية ويجب عدم الشعور بالذنب والخوف من ممارستها. فلها فوائد على الصحة الجنسية ولكن ينصح بعدم الإكثار منها لدرجة الإدمان لأن اللذة تصبح متركزة فيها ويتحول ذلك إلى مرض.', '2019-03-13 16:42:02'),
(136, 2, 1, 1, 'المرأة التي تحب الاستعراض وتباهي بجسدها وأنوثتها تستمتع وتصل إلى اللذة وهي تشاهد الرجل يقوم بالعادة السرية بالنظر إليها. فذلك يعني لها بأنه يقدر جاذبيتها وأنوثتها الطاغية.', '2019-03-13 16:42:02'),
(137, 2, 1, 1, 'في العلاقة الجنسية يجب التعامل مع المرأة على أنها شريكة وتحترم لذاتها وليس على أنها أداة أو سلعة للذة. فهذا سيشعرها بالإهانة. ', '2019-03-13 16:42:02'),
(138, 2, 1, 1, 'عندما تمارس المرأة الجماع مع شريكها فهي لا تفعل ذلك من أجل الجنس وحده لأنها لا تستمتع بالعلاقة وتصل إلى اللذة إلا إذا استطاع الشريك أن يشعرها بالأمان والعاطفة. فالجنس بالنسبة لها يعني الأمان والعاطفة أولاً.', '2019-03-13 16:42:02'),
(139, 2, 1, 1, 'للممارسة الجنسية في الطبيعة طعم آخر لدى المرأة لأن ذلك يشعرها بجمالها وأنوثتها وتحقق هي نوعاً من الاتصال الجسدي بالطبيعة.', '2019-03-13 16:42:02'),
(140, 2, 1, 1, 'النساء أنواع متعددة من حيث الوصول إلى اللذة وأماكن تمركزها. فهي لا تتركز في منطقة واحدة، وهناك نساء يجمعن بين منطقتين أو أكثر ويتداخل ذلك مع طبيعتهن السمعية أو البصرية أو الحسية. لذلك على الشريك معرفة طبيعة شريكته جيداً وتضاريس اللذة لديها ليستطيع أن يشبع حاجاتها الجنسية. وهذا صعب دون مصارحة أو حتى استشارة خبير جنسي.', '2019-03-13 16:42:02'),
(141, 2, 1, 1, 'إن كنت غير ناضج جنسياً وعاطفياً وتبحث عن العطف والحنان والمحبة على شاكلة أمك في العلاقة الجنسية في فتاة تكبرك سناً، فهذا يعني أنك تعاني من عقدة نفسية منذ الصغر تسمى بعقدة أوديب؛ أي عقدة التعلق بالأم. وفي هذه الحالة يستحسن استشارة مختص نفسي جنسي ليقدم لك المساعدة.', '2019-03-13 16:42:02'),
(142, 2, 1, 1, 'في نهاية العملية الجنسية يفرز الجسم الأوكسيتوسين بنفس الكمية لدى الجنسين. وهذا الهرمون هو هرمون العناق والرومانسية لكن تفاعله مع الهرمون الخاص بكل جنس مختلف. فعند الرجل يؤدي إلى النفور والابتعاد وإنهاء العناق وعند المرأة يزيد الاسترخاء والرومانسية والرغبة في الاستمرار في العناق. لهذا على كل من الشريكين تفهم طبيعة الآخر وتقديم بعض التنازل لتحقيق اللذة للطرفين.', '2019-03-13 16:42:02'),
(143, 2, 1, 1, 'أهم ما في العلاقة الجنسية بين الرجل والمرأة هو أن تكون إيجابية، أي تقوم على الأخذ والعطاء، لا أن يكون الشركاء أنانيين يأخذون ما يحتاجون إليه للوصول إلى اللذة ولا يهتمون بتلبية حاجات الشريك.', '2019-03-13 16:42:02'),
(144, 2, 1, 1, 'على المرأة الانتباه خلال فترة الحمل من جميع الانفعالات لأنها تغير مستوى إفراز الهرمونات في جسمها، والجنين يتلقى منها الغذاء وكذلك الانفعال، ما يؤثر على تكوين البصمة الجنسية لديه.', '2019-03-13 16:42:02'),
(145, 2, 1, 1, 'العلاقة الجنسية الناجحة هي العلاقة المتكاملةبدءاً من الكلام والمداعبة والجماع والعناق. ويجب إعطاء كل مرحلة حقها لأن لكل منها لذة خاصة عند الشريكين، وخاصة عند المرأة.', '2019-03-13 16:42:02'),
(146, 2, 1, 1, 'القبلة هي بداية التلامس الجسدي والإثارة لدى الجنسين وهي أفضل وسيلة لبدء العلاقة الجنسية لأنها تولد السيروتونينوالأوكسيتوسين، وهما هرمونا الرومانسية والنشاط. كما أنها تساعد على تفعيل وإشباع المرحلة الفموية، وهي مرحلة أساسية في التكوين النفسي الجنسي للشخص.', '2019-03-13 16:42:02'),
(147, 2, 1, 1, 'إن كنت من النوع الحسي أنت وشريكك، فللقبلة إذن على الفم وباقي الجسد أثر كبير في تحقيق التواصل الحسي بينكما ووصولكما إلى النشوة. ', '2019-03-13 16:42:02'),
(148, 2, 1, 1, 'صحيح أن الرجل والمرأة يختلفان عن بعضهما تكوينياً إلا أن وسيلة التواصل بينهما هي الجنس. لذلك على كل منهما البحث عن شريك يتوافق جنسياً معه، وذلك بمعرفة البصمة الجنسية الخاصة به.', '2019-03-13 16:42:02'),
(149, 2, 1, 1, 'على الرجل معرفة نقاط الشهوة والإثارة لدى شريكته لكي يستطيع أن يحقق لها أكبر قد من اللذة، مما يعود عليه باللذة أيضاً. وهذا يحتاج منه إلى تقصٍ وصراحة وإشعار المرأة بحقها في التعبير عن مواطن اللذة والنشوة لديها.', '2019-03-13 16:42:02'),
(150, 2, 1, 1, 'أكثر المناطق حساسية للجماع لدى المرأة البظرية هي البظر والشفرتين وإمتدادهما إلى المهبل. ومهمة إثارة هذه المناطق للوصول إلى النشوة تقع على الرجل.', '2019-03-13 16:42:02'),
(151, 2, 1, 1, 'على الرجل أن يعرف أنه من الخطأ التعامل مع المناطق التناسلية على أنها هي فقط نقاط الإثارة في جسد المرأة. فجسد المرأة كله قابل للاستثارة وكل امرأة تختلف في مناطق لذتها واستثارتها. لذلك على الرجل استكشاف تلك المناطق والتعامل معها بالطريقة الصحيحة التي تجعل من العلاقة الجنسية أكثر دواماً وتحقق أقصى حد من اللذة لدى الطرفين.', '2019-03-13 16:42:02'),
(152, 2, 1, 1, 'إذا كان شريكك من النوع البصري فأكثر ما يثيره كرجل هو الاستعراض بجميع أشكاله، من رقص وألبسة داخلية وممارسة أمام المرآة وغير ذلك. ويمكن معرفة الشريك البصري بسؤاله عن لون شيء يخصه هو، فإن اتجه بصره إلى أعلى فهو بصري حقاً. كما يمكن إجراء الاختبار الجنسي المرفق بهذا التطبيق لمعرفة عمق طبيعته.', '2019-03-13 16:42:02'),
(153, 2, 1, 1, 'تؤثر الهرمونات على الكفاءة المكانية لدى الأنثى. فوفقاً لدراسة قامت بها جامعة أونتاريو حول العلاقة بين كفاءة المرأة المكانية ومستوى الهرمونات تبين أن هرمون التستسترون المنخفض لديها يؤثر سلباً على مخيلتها المكانية في حين أن ارتفاع معدلات الأستروجين يؤثر إيجابياً على قدرتها على التعبير وعلى مهاراتها الحركية الدقيقة.', '2019-03-13 16:42:02'),
(154, 2, 1, 1, 'بسبب ارتفاع التستسترون في الأيام الأولى للدورة الشهرية فإن المرأة تفتقد القدرة على استخدام المفردات في تعنيف رجل أزعجها ولكنها مستعدة لأن تمارس فعلاً فيه شيئاً من العدوانية تجاهه ذلك بسبب ارتفاع هذا الهرمون الذكري (التستسترون) في هذه الفترة والمسؤول عن العدوانية.', '2019-03-13 16:42:02'),
(155, 2, 1, 1, 'قبل أسبوع من بداية الطمث لدى المرأة ينخفض الأستروجين لديها بشكل كبير مما يثير لديها الشعور بالحرمان والحزن والكآبة. وهذا كله يؤدي بها إلى تقلبات تزعج الرجل كثيراً ولا يستطيع تفسيرها ما لم يكن على علم بتأثيرات انخفاض هذا  الهرمون.', '2019-03-13 16:42:02'),
(156, 2, 1, 1, 'لأن الهرمونات الأنثوية تؤدي إلى الطمأنينة والسكينة فإن بعض البلدان المتقدمة تحقن بعض الأشخاص العدوانيين بالهرمونات الأنثوية وذلك لأن هذه الدول تدرك أن هؤلاء الأشخاص يحتاجون إلى هذا الهرمون أو أنهم لا ينتجونه بشكل جيد ولكن لا بد من الاعتراف بتأثيراته السلبية في حالات الحقن على المستوى الطبي.', '2019-03-13 16:42:02'),
(157, 2, 1, 1, 'بعض حبوب منع الحمل تحتوي على كمية من التستسترون الذكري، مما يجعل المرأة عدوانية وبمزاج متكدر وبحالة (ضوجان) وكدر، وتكثر انفعالاتها وتكسيرها للصحون والأدوات المنزلية أثناء تنظيفها. ', '2019-03-13 16:42:02'),
(158, 2, 1, 1, 'يدفع هرمون التستسترون الموجود بكميات كبيرة لدى الذكر إلى سلوك عدواني يدوي أو لفظي، وإلى الاهتمام بأفلام العنف والمصارعة وإلى قيادة السيارات بجنون ومغامرة، وإلى أعمال تصل إلى حد الجريمة. بينما تبين الدراسات أن النساء اللواتي يفعلن هذا يكن ممن يتمتعن بنسبة عالية من الهرمون الذكري.', '2019-03-13 16:42:02'),
(159, 2, 1, 1, 'المرأة المزاجية يتغير مزاجها بشكل مفاجئ جداً وأحياناً يقدر الرجل تقديراً غير دقيق بأنها غير سعيدة وهو مسؤول عن عدم سعادتها، وفي الواقع فإن عدم سعادتها وتغير مزاجها قد يعود لأسباب هرمونية لا علاقة له بها ولكن عليه أن يهتم بها أكثر.', '2019-03-13 16:42:02'),
(160, 2, 1, 1, 'هرمون التستسترون هو هرمون النجاح والقدرة على المنافسة والأداء الأعلى، ولكنه لدى الذكور قنابل موقوتة فهو يؤدي إلى كثير من العدوانية. لذلك فإن الذكور غالباً ما يكونوا عدوانيين بقدر ما تكون طاقة التستسترون عالية. وهذا ما يجب على الأنثى أن تدركه لأن الأمر خارج عن إرادة الذكور كما أن الدورة الشهرية خارجة عن إرادة النساء وعلى الطرفين أن يتحملا بعضهما.', '2019-03-13 16:42:02'),
(161, 2, 1, 1, 'بين21-28 من آخر طمث لدى الأنثى ينخفض مستوى الهرمون الأنثوي لديها بشكل كبير وأحياناً مفاجئ مما يثير لديها شعوراً بالحرمان الشديد. وهذا ما يسمى بمتلازمة ما قبل الطمث، ويتولد عن ذلك مشاعر كالفتور والحزن والكآبة وأحياناً يصل إلى الميول الانتحارية. ', '2019-03-13 16:42:02'),
(162, 2, 1, 1, 'ثبت أن تراجع الهرمونات الأنثوية جراء اقتراب الطمث هو الذي يسبب العدوانية، ولهذا فهناك توجهات لدى بعض المصحات الغربية لاستخدام الهرمونات الأنثوية لتهدئة الأشخاص العدوانيين حتى وإن كانوا من النوع الذكوري. ', '2019-03-13 16:42:02'),
(163, 2, 1, 1, 'في دراسة جرت مؤخراً في كندا في جامعة ولاية جورجيا تبين أن النساء اللواتي يتمتعن بمستوى عالٍ من التستسترون (هرمون الذكورة) هن اللواتي يشتغلن في الأعمال التي تحتاج إلى طاقة كبيرة وأحياناً إلى شيء من المبادرة الهجومية كالمحاميات، وإلى شيء من القدرة على التعامل مع الآخرين بجلد كمديرات المبيعات. وبالتالي، فهذا الهرمون يرفع الكفاءة والأعمال والإنجازات ويزيد من القدرة على الفعل الإيجابي. ', '2019-03-13 16:42:02'),
(164, 2, 1, 1, 'أثبتت دراسة جيمس دابس من جامعة ولاية كاليفورنيا أن المتفوقين من النساء والرجال يكون مستوى التستسترون لديهم أعلى من الكوادر العادية. وهذا ما يؤكد على أهمية الهرمون الذكري في طاقة المتفوقين. ', '2019-03-13 16:42:02'),
(165, 2, 1, 1, 'في بحث عن تعدد مراحل الشخصية في جامعة مينيسوتا على مدى ثلاثين عاماً تبين أن الإناث اللواتي اتصف سلوكهن بالمشاكسة والعدائية الشديدة يصل احتمال خطر الوفاة المفاجئة والمبكرة إلى أربعة أضعاف بسبب كون هرمون التستسترون لديهن أعلى من نظيراتهن من الإناث.', '2019-03-13 16:42:02'),
(166, 2, 1, 1, 'قالت الدراسات العلمية إن الهرمون الجنسي الأنثوي الأستروجين يحث الخلايا العصبية على إنتاج المزيد من الاتصالات بين نصفي المخ، وهذا ما يؤكد طلاقة اللسان لدى الأنثى وقدراتها على استخدام نصفي المخ بصورة فعالة وإيجابية.لكن حينما تمر الأنثى بحالات الشعور المنفعل فإن عمليات التواصل بين النصفين تتوقف، ولهذا فإن الشعور يتغلب على المنطق.', '2019-03-13 16:42:02'),
(167, 2, 1, 1, 'رنة صوت المرأة الطفولية تعني ارتفاعاً كبيراً في هرمون الأستروجين الأنثوي وهو دلالة على التعاطف وعلى رغبتها في الرجل الذي أمامها ورغبة في تواصل إيجابي للغاية معه.', '2019-03-13 16:42:02'),
(168, 2, 1, 1, 'هرمون الأستروجين هو الهرمون الجنسي الأنثوي الذي يمنح المرأة الرضا والتوازن النفسي. وبسبب تأثيراته هذه نجد أنه يعطى للأشخاص العدوانيين ليمنحهم التوازن والرضا.', '2019-03-13 16:42:02'),
(169, 2, 1, 1, 'عندما يتراجع هرمون الأستروجين بسبب دخول المرأة في مرحلة الإياس (سن اليأس) تتأثر الذاكرة لأن الأستروجين يدعم الذاكرة ويؤثر على الحالة النفسية عموماً. ولكن مع تراجعه بسبب مرحلة الإياس لا تعود المرأة تشعر بالراحة وتكون في حالة قلق شديد.', '2019-03-13 16:42:02'),
(170, 2, 1, 1, 'بعد اليوم الواحد والعشرين إلى الثامن والعشرين من بداية الطمث السابق ينخفض مستوى هرمون الأستروجين لدى المرأة بشكل مفاجئ مما يستثير مظاهر تتسم بالفتور والحزن والكآبة وصولاً لدى بعض النساء الاستثنائيات إلى الميول الانتحارية. فكل امرأة من أصل 25 تعاني من هذه التقلبات الهرمونية الشديدة التي تبدل الشخصية بكل معنى الكلمة.', '2019-03-13 16:42:02'),
(171, 2, 1, 1, 'يمكنك معرفة ما إذا كان شريكك حسياً بسؤاله سؤالاً ما، فإذا رأيت نظره يتجه إلى الأسفل فهو حسي بلا شك. ولمعرفة طبيعة شريكك يمكنك إجراء الاختبار الجنسي المرفق مع هذا التطبيق.', '2019-03-13 16:42:02'),
(172, 2, 1, 1, 'إذا كان شريكك من النوع السمعي فأهم ما يثيره هو الاستماع للأصوات المثيرة والكلام قبل وأثناء وبعد العلاقة وكذلك التكلم. ويمكن استخدام بعض الكلمات البذيئة بشرط أن يكون ذلك فقط أثناء الممارسة وفي الأذن اليسرى للمرأة بشكل حصري.', '2019-03-13 16:42:02'),
(173, 2, 1, 1, 'إذا كنت من النوع الأناني في العلاقة الجنسية؛ أي الشخص الذي يأخذ دون أن يعطي وتحب أن تشعر هو باللذة دون إدخال رغبات شريكك في الاعتبار فأنت شخص نرجسي وعليك طلب استشارة جنسية ونفسية لمعرفة الشريك المناسب لك.', '2019-03-13 16:42:02'),
(174, 2, 1, 1, 'إذا كنت من النوع الذي يصل إلى اللذة الجنسية عن طريق إيلام الغير بالضرب أو الشتم أو التعذيب فأنت من النوع السادي المسيطر، وأفضل شريك لك هو المازوشي الذي يحب ويصل إلى النشوة بالإهانة وإشعاره بأنه عبد مسيطر عليه.', '2019-03-13 16:42:02'),
(175, 2, 1, 1, 'إذا كنت من النوع الذي يصل إلى اللذة الجنسية عن طريق تحمل الألم والإهانة والعقاب فأنت من النوع المازوشي، وأفضل شريك لك هو السادي الذي يحب أن يعذب ويهين ويشتم ويسيطر على الآخر بالقوة. لمزيد من المعلومات يمكنك مراجعة الاستشاري الجنسي النفسي في هذا التطبيق.', '2019-03-13 16:42:02'),
(176, 2, 1, 1, 'إذا كان للشريكين أطفال، يجب عليهما الانتباه إلى عدم مشاهدة الطفل أو سماعه أي شيء يخص العلاقة الجنسية بينهما لأن ذلك قد يؤدي إلى نشوء عقد نفسية وجنسية لديهم تؤثر في توجههم الجنسي حينما يكبرون.', '2019-03-13 16:42:02'),
(177, 2, 1, 1, 'تهديد الأب بقص قضيب ولده، ولو على سبيل المزاح، له آثار نفسية وجنسية سيئة على الطفل لأنه يؤدي إلى عقدة الخصاء ويؤثر على توجهه الجنسي عند البلوغ.', '2019-03-13 16:42:02'),
(178, 2, 1, 1, 'أحلام اليقظة هي أحد وسائل التفريغ الجنسي لدى الرجل أو المرأة وخاصة الجنس الذي يكون المجتمع غير راض عنه ويصعب على الشخص ممارسته. ', '2019-03-13 16:42:02'),
(179, 2, 1, 1, 'الأشخاص الذين يملكون طاقة جنسية عالية يكونون مفرطين في ممارستهم للجنس، وهذا أمر طبيعي لأنه من عمق طبيعتهم. ', '2019-03-13 16:42:02'),
(180, 2, 1, 1, 'يلجأ بعض الأشخاص للإفراط في ممارسة الجنس لإثبات قدراته ووجوده والتعويض عن أي نقص لديه. وهنا يكون الإفراط مرضاً نفسياً يوجب استشارة مختص نفسي جنسي للمساعدة في التخلص منه. وفي هذا التطبيق ما قد يفيد في طرح استشاراتكم وتلقي إجابات عنها.', '2019-03-13 16:42:02'),
(181, 2, 1, 1, 'عندما تكثر امرأة من حك مؤخرتها فهذا دلالة على إحساسها بالقلق. ', '2019-03-13 16:42:02'),
(182, 2, 1, 1, 'الطريقة التي تحبذها المرأة المازوشية (وهي التي تميل إلى الإذلال النفسي والجسدي أثناء الممارسة) لفض بكارتها أو لممارسة الجنس معها هي الاغتصاب من قبل الشريك. وهذا مرض نفسي يحتاج إلى متابعة من الاستشاري الجنسي.', '2019-03-13 16:42:02'),
(183, 2, 1, 1, 'يصاب بعض الرجال في ليلة الزفاف بالعنة الجنسية؛ أي عدم القدرة على الانتصاب أو المحافظة على الانتصاب طيلة فترة الممارسة. وغالباً ما يعود سبب ذلك إلى التوتر والخوف من الفشل في الأداء الجنسي. كما أن المتزوجين قد يصابون بالعنة نتيجة الانفعال النفسي. وهنا لا بد من استشارة الخبير الجنسي النفسي أو استشارة خبيرنا عبر هذا التطبيق.', '2019-03-13 16:42:02'),
(184, 2, 1, 1, 'قد يقدم بعض الرجال على إخراج القضيب قبل القذف وهذا الفعل قد يضر بالرجل والمرأة على حد سواء. فقد يترتب عليه اضطرابات جنسية قد تحول بين المرأة وبلوغ الرعشة، وخاصة المرأة المهبلية. أما عند الرجل فإن إخراج القضيب قبل القذف قد يؤدي إلى مشكلات عديدة. ولا بد في هذه الحالة من استشارة الخبير الجنسي. ويمكنكم استشارة خبيرنا الموجود في هذا التطبيق.', '2019-03-13 16:42:02'),
(185, 2, 1, 1, 'يتمتع كل شخص بقدرة جنسية معينة تتأتى له بالتكوين وبها تتعين البصمة الجنسية. لذلك لا بد من مراعاة البصمة الجنسية عند اختيار الشريك والتي يمكن معرفتها بإجراء الاختبار الجنسي الموجود في هذا التطبيق.', '2019-03-13 16:42:02'),
(186, 2, 1, 1, 'ممارسة الجنس بانتظام وبشكل دوري صحي للرجل والمرأة ويسبب الاستقرار النفسي والهرموني.', '2019-03-13 16:42:02'),
(187, 2, 1, 1, 'قد يلجأ البعض إلى الإفراط الجنسي ليعوض به عن حالة نقص في شخصيته ويوفر لنفسه احتراماً لا يستطيع أن يتحصل عليه إلا بهذه الطريقة. وهذا لا يكون من طبيعة هذا الشخص، لذلك يتوجب عليه استشارة الخبير الجنسي.', '2019-03-13 16:42:02'),
(188, 2, 1, 1, 'يعاني بعض الأشخاص من السلبية الجنسية سواء أكان ذكراً أو أنثى. والمقصود بالسلبية الاعتماد على الطرف الآخر في العملية الجنسية. لذلك يرغب في أن يكون هو المفعول به وليس الفاعل في الممارسة، وهو ما يوجب متابعة من الاستشاري الجنسي.', '2019-03-13 16:42:02'),
(189, 2, 1, 1, 'الإفراط الجنسي الذي يعاني منه بعض الرجال والنساء ليس له أصل بنيوي وليس علامة صحة نفسية لأن الشخص يعاني غالباً من الغلمة والتي تعني ظمأ جنسياً لا يرتوي أبداً ولا يُشبع. وهذا يحتاج إلى متابعة من الاستشاري الجنسي.', '2019-03-13 16:42:02'),
(190, 2, 1, 1, 'على الزوجين تجنيب أطفالهما رؤيتهم عند الممارسة الجنسية مهما كان السن مبكراً، فقد يسبب لهم ذلك عقداً نفسية وجنسية تتحكم في سلوكهم. فقد يسمع الطفل تأوه أمه أثناء الممارسة ويفسره على أنه ألم، فترتبط لديه اللذة الجنسية تشريطياً بالألم.', '2019-03-13 16:42:02'),
(191, 2, 1, 1, 'النشوة عند المرأة هي شعور خاص بها يختلف من أنثى إلى أخرى من حيث كيفية الوصول والشعور الناتج عنه. فهناك نساء تصل إلى النشوة دفعة واحدة وهناك نساء تأتيها النشوة بالتدرج صعوداً ثم تصل إلى الخمول ومنهن نساء تصل النشوة صعوداً ثم تخمل مرات متتالية. لذلك لا يمكن معرفة أو حصر المرأة بنوع واحد للوصول الجنسي وتكون  مهمة الرجل معرفة طرق إشباعها أو يمكنه الاستعانة بمختص جنسي.', '2019-03-13 16:42:02'),
(192, 2, 1, 1, 'إن كانت شريكتك من النوع الشبق المحب للجنس، فلا بد أن مركز النشوة لديها يتركز في المهبل. وهو ما يوجب عليك التركيز على طرق إشباعها وتحقيق اللذة لديها، والابتعاد عن القذف المبكر.', '2019-03-13 16:42:02'),
(193, 2, 1, 1, 'اللسان هو وسيلة الاستمتاع لدى كثير من النساء والرجال. لذلك فإن المرأة البظرية، أي تلك التي تتركز لديها المتعة في البظر، تحب المداعبة باللسان وتصل إلى الرعشة من مداعبة الشريك.', '2019-03-13 16:42:02'),
(194, 2, 1, 1, 'أثناء الدورة الشهرية تمر المرأة بتغييرات هرمونية تؤثر عليها وقد تزيد من رغبتها الجنسية. لذلك تكون حساسة للغاية والممارسة معها تساعد على استقرارها وتخفيف آلام الحيض لديها.', '2019-03-13 16:42:02'),
(195, 2, 1, 1, 'إذا كنت من الرجال الذين يمتنعون عن إنزال السائل المنوي كاملاً أو محاولة التوقف أو الاحتفاظ به، فاعلم أن هذا مؤذ جداً لك وقد يؤدي إلى إضعاف قدراتك الجنسية ويتسبب بأمراض خطيرة في الخصيتين.', '2019-03-13 16:42:02'),
(196, 2, 1, 1, 'أحد طرق تلذذ الرجل هو أن تقوم شريكته بمص قضيبه وأن يقذف داخل فمها ويطالب شريكته ببلعه. قد يمتعه هذا ولكنه قد يسبب له ضعفاً في المستقبل وبعض الأمراض لأنه لا يخرج السائل المنوي بالكامل بهذه الطريقة.', '2019-03-13 16:42:02'),
(197, 2, 1, 1, 'ينصح الرجل بعد القذف والانتهاء من العملية الجنسية بالتبول لأن ذلك يساعده على استخراج من تبقى من السائل المنوي ويمنع عودته إلى الداخل ويحمي من الأمراض الناتجة عن ذلك.', '2019-03-13 16:42:02'),
(198, 2, 1, 1, 'أحياناً لقاضم أظافره تاريخ طويل في العادة السرية، وهو يعاني من القلق الجنسي الذي لم يُشبع. لذلك، غالباً ما يكون ممارسوه من المراهقين، ويجب تفهم حالتهم. وحل القلق بممارسة الفعل الجنسي أو عدم الخجل من العادة السرية وانتزاع الأوهام الاجتماعية حولها.', '2019-03-13 16:42:02'),
(199, 2, 1, 1, 'إذا كان المهبل لدى شريكتك هو منطقة (G-spot) فهي تتمتع بحساسية عالية فيها، لذلك ستكون وضعية المرأة فوق الرجل الوضعية الأنسب لها مع بعض الحركات إلى الأمام والخلف من أجل ضمان الوصول إلى الرعشة بطريقة أفضل.', '2019-03-13 16:42:02'),
(200, 2, 1, 1, 'النهم أي الإكثار من تناول الطعام هو دليل على رغبات جنسية لم يتم إشباعها، لذلك يلجأ الشخص إلى تناول الطعام بكثرة كنوع من الترميز لغياب الاكتفاء الجنسي.', '2019-03-13 16:42:02'),
(201, 2, 1, 1, 'يمكن أن تلجأ المرأة إلى توجيه شريكها للمناطق التي ترغب بأن يداعبها فيها، كأن تمسك يده وتضعها على تلك المناطق. فتصل المتعة إلى مستويات أعلى ويكون الإشباع الجنسي أكبر.', '2019-03-13 16:42:02'),
(202, 2, 1, 1, 'من المهم محاولة عدم كبت الرغبات والحاجات الجنسية تجنباً لأية أمراض عصابية أو نفسية جنسية.', '2019-03-13 16:42:02'),
(203, 2, 1, 1, 'إذا كنتم ممن يجدون متعة في الممارسة الشرجية عليكم الحذر من الممارسة من المهبل بعد الممارسة من الشرج وذلك تجنباً لنقل الجراثيم على أن يتم ذلك باستخدام للواقي الذكري.', '2019-03-13 16:42:02');
INSERT INTO `app_tips` (`tips_id`, `tcat_id`, `lang_id`, `status_id`, `tips_text`, `ins_datetime`) VALUES
(204, 2, 1, 1, 'إن كنت ممن يلجأ للعض كوسيلة للتواصل الجنسي، فعليك أن تعرف أن هناك نوعان للعض؛ العض لمجرد الدغدغة والعض الذي يحدث ألماً. اعتمادك على أي منهما يرجع إلى طبيعة الشريك ولا يجوز فرض ذلك على الشريك غير المتوافق مع هذا الأسلوب.', '2019-03-13 16:42:02'),
(205, 2, 1, 1, 'لزيادة تحفيز المرأة في العلاقة الجنسية على الرجل أن يحرص على مداعبتها في أماكن حساسيتها الجنسية التي عليه أن يتقصاها جيداً، فذلك سيزيد المتعة للطرفين.', '2019-03-13 16:42:02'),
(206, 2, 1, 1, 'على الرجل تجنب ممارسة العادة السرية أمام شريكته، فهذا قد يسبب انزعاجها والغيرة على أنوثتها، وقد تنفر من الممارسة معه إلا في بعض الحالات حينما تكون المرأة استعراضية.', '2019-03-13 16:42:02'),
(207, 2, 1, 1, 'لممارسة العادة السرية نفس مفعول إقامة العلاقة الجنسية، فهي تساعد على إنتاج الإندورفين الذي يساعد بدوره في تخفيف الآلام، وفي إنتاج الدوبامين الذي يساعد على الاسترخاء، لكن يجب معرفة أن الاكتفاء بالعادة السرية غير ممكن ويجب استبدالها بالعلاقة مع شريك.', '2019-03-13 16:42:02'),
(208, 2, 1, 1, 'يتوجب على الشخص المصاب بأمراض القلب أو انخفاض ضغط الدم أو الذي أصيب عضوه الذكري بجرح أو مرض ما ألا يستخدم الفياغرا بتاتاً.', '2019-03-13 16:42:02'),
(209, 2, 1, 1, 'يجب أن يكون للشريكين نفس الفيرمون الذي يطلقه جلديهما لكي ينجذبا إلى بعضهما. لذلك فاختلاف الفيرمونات يفسر الانجذاب أو عدم الانجذاب للدور الكبير الذي تلعبه في الانجذاب الجنسي.', '2019-03-13 16:42:02'),
(210, 2, 1, 1, 'قد يشعر الرجل بألم في الخصيتين نتيجة لعدم التصريف الجنسي. ويأتي هذا الألم على شكل توتر عضلي في منطقة العجان، ويخف بالقذف. ويمكن أن تشعر المرأة بهذا الألم إذا طالت مدة التهيج الجنسي دون الوصول إلى النشوة.', '2019-03-13 16:42:02'),
(211, 2, 1, 1, 'الفتاة التي تتثبت باللذة على البظر قد تطلب من شريكها باستمرار التركيز على المداعبة على هذه النقطة أولاً حتى تصل إلى الرعشة. وقد تلجأ إلى العادة السرية وتقوم بتدليك البظر حتى ولو كانت متزوجة، وهذا ليس أمراً مستغرباً لأن طبيعتها بظرية.', '2019-03-13 16:42:02'),
(212, 2, 1, 1, 'الشخص اللواطي بالتكوين هو شخص يستشعر لذة كبيرة بتدليك ثدييه، وحساسيته بالثديين تشبه حساسية النساء. وكل هذا يعود للبصمة الجنسية لديه في مرحلة التخلق وفي عملية الانقسام الخيطي، فحصل على كمية عالية من الأستروجين وأصبح مثلياً.', '2019-03-13 16:42:02'),
(213, 2, 1, 1, 'عندما تمارس المرأة الجنس مع رجل لا تحبه فمن النادر أن تصل إلى مرحلة الإشباع الجنسي وكذلك الرجل، لذلك يجب ألا يتم إغفال دور الحب في العلاقة الجنسية لتكون علاقة صحية وسليمة.', '2019-03-13 16:42:02'),
(214, 2, 1, 1, 'ممارسة الجنسية أكثر فاعلية في تسكين الألم من الأدوية. فقد تسكن الأدوية الألم بشكل مؤقت وتكون لها آثار جانبية في حين أن ممارسة الجنس لا أضرار لها ولا آثار جانبية.', '2019-03-13 16:42:02'),
(215, 2, 1, 1, 'يرتبط انخفاض الرغبة الجنسية بشكل عام بنوعية العلاقة بين الشريكين، كمشاكل الاتصال الجنسي أو الضغوطات النفسية أو الخلافات أو مطالبات الشريك بما لا يستطيعه أو ليس مؤهلاً بطبيعته له. وحل المشكلة يكون بحل مسبباتها.', '2019-03-13 16:42:02'),
(216, 2, 1, 1, 'من الأخطاء الشائعة أن يُعتقد أن الأمراض التناسلية تنتقل فقط عبر الجماع. لكن الحقيقة أن الاتصال الجنسي لا يعني فقط الجماع وإنما يتضمن أيضاً التقبيل أو اللعق أو المص. لذلك فإن الفحص الدوري واجب للطرفين.', '2019-03-13 16:42:02'),
(217, 2, 1, 1, 'من الضروري تجنب الإزعاجات الخارجية أثناء الممارسة الجنسية لأن هذا يؤثر على الأنثى. لذلك يستحسن أن يتم إغلاق الهواتف أو أجهزة التلفزيون.', '2019-03-13 16:42:02'),
(218, 2, 1, 1, 'على الرجل أن يعرف أن هناك عدة مناطق في جسد المرأة والتي قد تسبب لها الاستثارة، لذلك عليه ألا يركز في منطقة معينة دون غيرها وأن يحاول استكشاف المناطق الأكثر تحريضاً للذة لديها.', '2019-03-13 16:42:02'),
(219, 2, 1, 1, 'يحتاج الرجل بشكل عام بعد القذف إلى الراحة والابتعاد. وهذا أمر طبيعي لديه لكنه غير مرغوب بالنسبة للمرأة. لذلك لا بد من تفاهم بينهما حول هذا الأمر أو أن يقوما بإجراء مشترك، بحيث لا يبتعد كثيراً ولا تعتبر هي ابتعاده موقفاً شخصياً باعتبار أن كليهما له طبيعة مختلفة كلياً عن الآخر.', '2019-03-13 16:42:02'),
(220, 2, 1, 1, 'في أغلب الأحيان تكون حاسة الشم عند المرأة قوية. هنا، يفترض في الشريك أن يكون نظيفاً ورائحة جسده وفمه عطرة من أجل العملية الجنسية. فهذا يعني للمرأة الكثير.', '2019-03-13 16:42:02'),
(221, 2, 1, 1, 'يعتقد بعض الرجال أن أي تماس يجب أن يؤدي إلى الجنس في نهاية الأمر، لكن قد نتفاجأ حين نعرف بأن هذا ليس صحيحاً في جميع الحالات. فهناك نساء يرغبن فقط بالتماس العاطفي في فترات معينة، لذلك لا يجب إكراههن على ما لا يردن.', '2019-03-13 16:42:02'),
(222, 2, 1, 1, 'لتجاوز الهموم يلجأ الرجل إلى أحد أمرين؛ إما الطعام أو الجنس، وهو ما يعدل مزاجه بالكامل. لذلك على المرأة أن تعرف هذه الحقائق وأنها من الطبيعة الخاصة للمخ الذكري.', '2019-03-13 16:42:02'),
(223, 2, 1, 1, 'من أكبر الأخطاء التي ترتكبها بعض النساء هو القيام بعمليات تجميلية كتكبير الثديين أو تصغير فتحة المهبل لأنه في كثير من الحالات تنخفض اللذة الجنسية إلى درجة كبيرة جداً بعد إجراء هذه العمليات.', '2019-03-13 16:42:02'),
(224, 2, 1, 1, 'منطقة الجي سبوت (G-spott) هي المنطقة الأكثر حساسية. لذلك يجب على الرجل أن يعرف أن لكل امرأة نقاط استثارة خاصة بها ويعمل على إشباعها بالكامل.', '2019-03-13 16:42:02'),
(225, 2, 1, 1, 'قد ينصح بالاستمناء (العادة السرية) كعلاج للمساعدة على استحداث تغييرات في التوجهات الجنسية عن طريق ما ندعوه في علم النفس بالتشريط، أو كعلاج للقذف المبكر ولبعض حالات البرود الجنسي عن النساء.', '2019-03-13 16:42:02'),
(226, 2, 1, 1, 'المرأة التي تصل للرعشة عدة مرات بالعادة السرية أو بالممارسة الجنسية هي امرأة استثنائية وتشكل نسبة وجودها بالحياة 2.5% من نسبة نساء العالم. فلا يجب أن تشعر بأنها مريضة، بل على العكس فهي تحتاج إلى شريك خاص.', '2019-03-13 16:42:02'),
(227, 2, 1, 1, 'قد ينسب الرجل الذي لا ينتصب قضيبه بحالات خاصة (لديه عنه مؤقتة) شفاءه إلى تعاطيه للمقويات أو لممارسة الرياضة أو إلى الراحة والاسترخاء. والواقع أن شفاءه يتحقق إذا استطاع أن يخرج من الأزمة الانفعالية التي يمر بها وأن يستبصر المشكلة الأساسية التي سببت مخاوفه. ويمكن اللجوء إلى استشاري جنسي.', '2019-03-13 16:42:02'),
(228, 2, 1, 1, 'العملية الجنسية هي متكاملة، لذا يجب الانتباه إلى ما يحب الطرف الآخر. فقد يكون فانتازياً وشريكه غير فانتازي في العملية الجنسية، لذلك لن تتحقق مراعاة متطلبات الطرف المقابل. وهذا ما يوجب على الشريكين أن يختبرا بعضهما قبل الارتباط النهائي ولو كان اختباراً معرفياً بشكل صريح.', '2019-03-13 16:42:02'),
(229, 2, 1, 1, 'لكل منا حاجات وقدرات جنسية تختلف عن الآخرين وكما أن للبعض قدرات محدودة وطاقات منخفضة للبعض أيضاً طاقات عالية واحتياجات شبقية كهذه المرأة تماماً وفقط الأخصائيون يمكنهم تفهم طبيعتها الخاصة واحتياجاتها الجنسية جيداً.', '2019-03-13 16:42:02'),
(230, 2, 1, 1, 'بعض النساء تفتعل معك المشاكل لتغمرها باهتمامك وتلفت أنظارك لها وربما لكي تحاول إرضائها من خلال الجنس. وهذه النساء تكون من النوع المازوشي ومن النوع الشبق جنسياً، لكن هذا الأمر لا ينطبق على جميع النساء.', '2019-03-13 16:42:02'),
(231, 2, 1, 1, 'ثمة ثقافات تركز في التربية على العضو الذكري، لكن لذلك دلالات نفسية أحدها هو تعزيز البعد القضيبي والتفاخر به كرمز للقوة ومحاولة لتجاوز عقدة أوديب.', '2019-03-13 16:42:02'),
(232, 2, 1, 1, 'الجنس (sex) هو مانراه خارجياً أما النوع أو الهوية (gender) فهو مايشعر به الإنسان داخلياً؛ بأنه ذكر أو أنثى. والتلاؤم بين الاثنين ضروري كي يعيش الإنسان حياة جنسية طبيعية.', '2019-03-13 16:42:02'),
(233, 2, 1, 1, 'تترافق معظم الاضطرابات النفسية باضطراب في الرغبة أو القدرة الجنسية، وكذلكإذا لم تعالج معظم الاضطرابات الجنسية فقد تكون مصدراً وسبباً باضطرابات النفسية.', '2019-03-13 16:42:02'),
(234, 2, 1, 1, 'في حال عدم بلوغ المرأة النشوة ننصحها باكتشاف جسدها ومواطن الإثارة لديها. فالتدريب والمران يساعدانها على تخطي الحالة مع أخذ العلم بأن المرأة قد تكون بظرية أو مهبلية أو شرجية أو تجمع نوعين معاً أو كل الأنواع سوية.', '2019-03-13 16:42:02'),
(235, 2, 1, 1, 'تأتي أغلب حالات البرود الجنسي نتيجة لصدمة أو تجربة فاشلة. لذلك ينصح من يعاني من البرود الجنسي مراجعة الأخصائي النفسي بعد انتفاء الأسباب العضوية. فهذا من صلب اختصاص الأخصائي النفسي.', '2019-03-13 16:42:02'),
(236, 2, 1, 1, 'ينصح من يعاني من سرعة في القذف أن يقوم بالتمرن والتدرب على إطالة فترة الانتصاب، فيطلب من شريكته التوقف كلما اقترب من القذف. ويكرر هذه العملية ثلاث إلى أربع مرات. كما بإمكانه اختيار وضعيات للجماع تتناسب وهذه الحالة وتقلل حساسية القضيب، كوضعية المرأة الفارسة.', '2019-03-13 16:42:02'),
(237, 2, 1, 1, 'تهيئ الحالة النفسية الجيدة للمرأة الحامل الجنين لكي ينمو نمواً صحياً من ناحية التكوين الجنسي. لذا تنصح المرأة الحامل بمراعاة هذه النقطة وأخذها بعين الاعتبار.', '2019-03-13 16:42:02'),
(238, 2, 1, 1, 'من الضروري احترام الرغبة الجنسية لدى الشريك واعتبارها ومطالبه حاجة طبيعية.', '2019-03-13 16:42:02'),
(239, 2, 1, 1, 'ينصح الآباء بالحرص على ألا يشاهد أطفالهم أو يسمعوا أصواتهم أثناء الممارسة الجنسية حتى ولو كان الأطفال في المهد وذلك كي يحيوا حياة جنسية سليمة في المستقبل.', '2019-03-13 16:42:02'),
(240, 2, 1, 1, 'على الشريكين التكلم بصراحة بخصوص مشاعر الذنب بينهما أو مشاعر الإحباط أو الخجل والأهم الرغبات الجنسية لكي لا تكبت وتتحول إلى أزمة جنسية حقيقية بينهما.', '2019-03-13 16:42:02'),
(241, 2, 1, 1, 'ينصح الأزواج بالافتراق عن بعضهما البعض لفترة قصيرة وذلك لمعالجة فتور العلاقة الجنسية وبرودها. ولكن يمكن التخلص من مسألة الفتور بخلق أجواء جديدة بعيداً من الروتين اليومي أيضاً.', '2019-03-13 16:42:02'),
(242, 2, 1, 1, 'لا يجب تتبع المراهق ومحاولة إمساكه متلبساً وهو يمارس العادة السرية مثلاً لأنه يجب احترام خصوصية الحياة الجنسية لديه كما لدى أي شخص آخر.', '2019-03-13 16:42:02'),
(243, 2, 1, 1, 'من الضروري تقديم الشرح العلمي الذي يتناسب وعمر الطفل للقضايا الجنسية حتى ينمو نمواً جنسياً سليماً، فعلى سبيل المثال، يظل الطفل يعتقد أن الحمل يتم عن طريق الفم وينمو معه هذا الاعتقاد ما لم يتم تصحيحه بطرق تناسب عقله وتفكيره وعمره.', '2019-03-13 16:42:02'),
(244, 2, 1, 1, 'لن يكون للتزمت في تربية الطفل جنسياً أي عواقب محمودة، بل إنه سيؤدي إلى أمراض جنسية ونفسية خطيرة تجعل من الضروري الاستعانة بخبير أو استشاري جنسي نفسي.', '2019-03-13 16:42:02'),
(245, 2, 1, 1, 'ليست كل النساء سواء من ناحية عدد مرات الوصول إلى الرعشة أو طريقة حدوث النشوة. لذلك ننصح كل شريك بتفهم احتياجات شريكه وعدم مقارنته بشخص آخر أو بتجارب سابقة مر بها.', '2019-03-13 16:42:02'),
(246, 2, 1, 1, 'الاهتمام بالنظافة شرط أساسي من شروط العملية الجنسية، إذ لا يجوز مقاربة القضيب من الشرج ومن ثم إدخاله في المهبل لأن هذا يضر بالشريكة من الناحية الصحية.', '2019-03-13 16:42:02'),
(247, 2, 1, 1, 'يعود القصور الجنسي في أغلب الأحوال لأسباب نفسية، لذلك ليس عيباً اللجوء إلى استشاري نفسي جنسي لحل هذه المشكلة.', '2019-03-13 16:42:02'),
(248, 2, 1, 1, 'أحد أسباب الحالات السادومازوشية هو ارتباط الحب بالعقاب تشريطياً، لذلك على الآباء الانتباه إلى هذه النقطة حين التعامل مع أبنائهم.', '2019-03-13 16:42:02'),
(249, 2, 1, 1, 'ينصح بعدم ضرب الأطفال على المؤخرة لعدم تحريك الميول المثلية لديهم لأن هذا الفعل قد يزيد من الحساسية الجنسية في هذه المنطقة.', '2019-03-13 16:42:02'),
(250, 2, 1, 1, 'لا بد من توجيه الأطفال من الجنسين إلى تقبل اختلافاتهم الجسدية عن الآخرين، والإشارة إلى هذه الاختلافات دون تمييز أو مفاضلة بينهما في عمر باكر.', '2019-03-13 16:42:02'),
(251, 2, 1, 1, 'لا بد منه فهم البنية التشريحية للجهاز التناسلي لدى كل من الذكر والأنثى بشكل علمي قبل ممارسة الجنس لأن هذا يقي من الأوهام.', '2019-03-13 16:42:02'),
(252, 2, 1, 1, 'عند عدم القدرة على التأقلم مع الشريك في العلاقة الجنسية لوجود متطلبات خاصة به، فعلى الطرف الآخر إما تقبل الحال كما هو أو تغيير العلاقة بأكملها.', '2019-03-13 16:42:02'),
(253, 2, 1, 1, 'لا تنتهي العلاقة الجنسية بالنسبة للمرأة بمجرد الوصول إلى النشوة، لذا لا بد للرجل من مراعاة ذلك من خلال الاحتضان والملاطفة.', '2019-03-13 16:42:02'),
(254, 2, 1, 1, 'عند الممارسة الجنسية لا بد من تغيير الوضعيات بين الحين والآخر وعدم الاكتفاء بالوضعيات التقليدية لكي لا يصيب الملل العلاقة بينهما.', '2019-03-13 16:42:02'),
(255, 2, 1, 1, 'ننصح بأن تمر فترة اكتشاف الذات وبخاصة الأعضاء التناسلية لدى الأطفال بشكل طبيعي بلا صدامات أو تنبيهات سلبية لهم لكي نساعد على نشوئهم بشكل سليم من الناحية الجنسية.', '2019-03-13 16:42:02'),
(256, 2, 1, 1, 'لعلاج حالات الضعف الجنسي عند الذكر يجب أولاً التخلص من كافة الضغوط النفسية والبحث عن حلول سريعة وجادة لأن استمرار الضغوط من شأنها أن تؤدي إلى ضعف في الانتصاب. ', '2019-03-13 16:42:02'),
(257, 2, 1, 1, 'الإكثار من ممارسة الجنس غير ضار على الإطلاق، بل إنه أمر صحي ومفيد في إطالة الحياة.', '2019-03-13 16:42:02'),
(258, 2, 1, 1, 'من الضروري تصحيح المفاهيم الخاطئة والمسبقة عن العلاقة الجنسية وعدم ربطها بالكرامة أو إهانة المرأة.', '2019-03-13 16:42:02'),
(259, 2, 1, 1, 'أن يكون للشريك نمط جنسي معين يحقق به اللذة، فهذا لا يعد في الغالب انحرافاً سلوكياً لأنه يرجع إلى بصمته (طبيعته) الجنسية فقط، باستثناء بعض الحالات. ويمكنك معرفة نمطك الجنسي الخاص من خلال إجراء الاختبار الجنسي الموجود في هذا التطبيق.', '2019-03-13 16:42:02'),
(260, 2, 1, 1, 'من الأخطاء الشائعة أن اللذة والوصول إلى الرعشة أثناء الممارسة الجنسية لدى النساء يكون عبر المهبل فقط، لكن في الحقيقة هذا الأمر يعود لطبيعة المرأة ومناطق اللذة الجنسية لديها. ومن الضروري عدم تعميم طريقة واحدة على جميع النساء.', '2019-03-13 16:42:02'),
(261, 2, 2, 1, 'In love, your body secretes endorphins which have the ability to fortify the immune system and overcome flue. With kissing, the mind tends to have a number of hormonal-chemical operations that help the immune system of both partners. However, a man benefits more of this as he is able to produce more endorphins than a woman.', '2019-03-13 16:42:02'),
(262, 2, 2, 1, 'The testosterone levels decline slowly in an old man; that is why his sexual impetus weakens. On the contrary, in an average woman, the sexual impetus increases gradually and reaches its peak between 36-38. This explains why women love to have a young lover. It should be noted that young men can feel the mature capabilities of women at this age.', '2019-03-13 16:42:02'),
(263, 2, 2, 1, 'The physical intercourse helps a woman secrete some neuro-chemicals, such as oxytocin, dopamine, and noradrenalin. Those chemicals could generate some strong emotions that could be unexpected sometimes, like crying.', '2019-03-13 16:42:02'),
(264, 2, 2, 1, 'Any young woman who is about twenty can show great interest in sex due to the mutual influence of love and sex; however, she cannot feel but a very little desire in it.', '2019-03-13 16:42:02'),
(265, 2, 2, 1, 'Champagne is one of the great secrets of love and romance, for it contains a chemical substance that raises the levels of testosterone in the body, leading, thus, to the intimacy that a woman shows to man. That is why in parties, champagne is an essential indispensibledrink.', '2019-03-13 16:42:02'),
(266, 2, 2, 1, 'If sex or thinking of it makes a woman she is too emotional or too weak, she has to see a sexo-psychologist urgently.', '2019-03-13 16:42:02'),
(267, 2, 2, 1, 'When a woman wearing a skirt or dress opens her legs comfortably, this is an indication that she longs to have a free unrestrained relationship with the man sitting in front of her.', '2019-03-13 16:42:02'),
(268, 2, 2, 1, 'If a woman wears a ring in her left index and another one in her middle right finger, this means she is not only highly cunning, but a woman who has a big capability to make a person avoid any physical relation with her, let alone beingfractious and domineering (especially in opinions).', '2019-03-13 16:42:02'),
(269, 2, 2, 1, 'If a woman – or even her partner – finds out that she has a difference in the vaginal smell or the secretions smell, she has to see a doctor for preventive purposes.', '2019-03-13 16:42:02'),
(270, 2, 2, 1, 'Sexual boredom is often associated with some genital changes. This happens is when a man or woman reaches the menopause, therefore, men or women should consider each other\'s age and should not take any issue personally.', '2019-03-13 16:42:02'),
(271, 2, 2, 1, 'A man has a period like a woman but he does not menstruate. Therefore, when he reaches the menopause, he could suffer from ED (erectile dysfunction). That is why he prefers to say it is boredom that he is suffering from in order not to be offended. Sometimes, the reason behind his real boredom can be depression.', '2019-03-13 16:42:02'),
(272, 2, 2, 1, 'Some kinds of sexual boredom are attributed to the lack of secretion of the appropriate amino acids like carnitine and arginine, which we recommend to be taken as tablets. A herb called \"Epimedium\" is also recommended as it helps increase the sensual-sexual feelings. That is why people are advised to slow down before choosing to take Viagra.', '2019-03-13 16:42:02'),
(273, 2, 2, 1, 'In some cases, the cause behind failure in practical life could possibly be emotional or sexual hunger. This makes individuals act aggressively with others and even be aggressive with themselves. Therefore, a person has to try to live an emotional and sexual life to bring balance to their practical life.', '2019-03-13 16:42:02'),
(274, 2, 2, 1, 'There are two kinds of dizziness; one is organic (such as the internal otitis) and the other is psychological which comes as a result of repressbodily needs and manifests as a reaction to anxiety. The symptoms have symbolic interpretations that relate to the internal psychological conflicts, which are – again – a result of repressed sexual needs in a person with excessive sexual tendencies.', '2019-03-13 16:42:02'),
(275, 2, 2, 1, 'A woman is advised to see a doctor if she suffers from recurrent bleeding after the coitus, for this bleeding (or postpartum hemorrhage as it is medically called) may be a sign of abnormality. It may be resultant of having polyps, tumors or cervical cancer.', '2019-03-13 16:42:02'),
(276, 2, 2, 1, 'There should be a differentiation between sexual hypofunction and sexual anomaly. Sexual hypofunction is the inability to attain sexual satisfaction while sexual anomaly is a deviation from the right goal of the sexual act. However, psychology considers that sexual anomaly is no more than acting opposite to one\'s own sexual nature.', '2019-03-13 16:42:02'),
(277, 2, 2, 1, 'To treat erectile dysfunction, it is necessary to trace the patient\'s life to detect whether they are/were suffering from melancholy or shock. This is temporary and asexpert counseling could be sought for such a purpose.', '2019-03-13 16:42:02'),
(278, 2, 2, 1, 'If you do not enjoy a good relationship with your partner, you could ask a sexologist all the questions you have in mind and could be of help, such as:what is the best way to get back our normal sexual life, how can I avoid painful intercourse, or what can I do in case my partner got disappointed. Only the sexpert can help you in such crucial cases, so do not hesitate consulting one.', '2019-03-13 16:42:02'),
(279, 2, 2, 1, 'To treat premature ejaculation, it is necessary to get used to caressing the penis for a long time, either by themselves or by a partner on condition that ejaculation is not reached. It requires a man to be really patient or requires his female to be so.', '2019-03-13 16:42:02'),
(280, 2, 2, 1, 'To treat premature ejaculation, it is recommended to reach erection and keep caressing the penis but without touching the glans as they are the most sensitive parts. However, this is better than using ejaculation delay gels which may lead to impotence and separation with the partner or stopping to feel your partner in some cases.', '2019-03-13 16:42:02'),
(281, 2, 2, 1, 'A woman has to be open with her partner about what she feels, likes, or does not like in sex. If she does not think this way, she must see a consultant or a sexologist with her partner.', '2019-03-13 16:42:02'),
(282, 2, 2, 1, 'Most cases of sexual frigidity in women are attributed to sexual fears that came as a result of unsuccessful or shocking experiences in the past, especially in childhood. Getting counseling of a psycho-sexologist could do a lot of help.', '2019-03-13 16:42:02'),
(283, 2, 2, 1, 'Some cases of sexual frigidity in women (2.5%) is organic and cannot be treated. However, to diagnose the case of frigidity, it is a must to see a psycho-sexologist.', '2019-03-13 16:42:02'),
(284, 2, 2, 1, 'If a woman does not lead a happy sexual life with her partner, she has to try different positions till she finds something satisfying. She could also attempt at finding other pleasures than the vaginal one, such as being verbally stimulated, for example.', '2019-03-13 16:42:02'),
(285, 2, 2, 1, 'A female partner may play a role sometimes in the impotence of man, especially if she is of the authoritative lippy kind. This makes the man hate making love. Or, she might be naturally a more sexually-demanding person than him, which makes him feel castrated or weak, so he avoids the love making process.', '2019-03-13 16:42:02'),
(286, 2, 2, 1, 'Onanism means coitus interruptus in which there is penis withdrawal from the vagina prior to ejaculation. It can have bad effects on both, man and woman. It might lead to some sexual confusions that prevent a woman from reaching orgasm. It also stands in the way of reaching serenity by woman as the semen is not spilled into the vagina taking into consideration that wetting the vagina with man\'s semen can protect against cervical cancer. ', '2019-03-13 16:42:02'),
(287, 2, 2, 1, 'When a woman starts the sexual intercourse, she does not have to think of when it finishes. She has to give herself the sufficient time to get her pleasure as this is the essence of the sexual intercourse.', '2019-03-13 16:42:02'),
(288, 2, 2, 1, 'The sexual intercourse should not be underestimated as an instinctive and emotional activity, for it has the ability to make people aggressive when their needs are not fully satisfied though this might come under different meaningless pretexts. ', '2019-03-13 16:42:02'),
(289, 2, 2, 1, 'To treat premature ejaculation, partners are advised to take a special position where the female gets over the lying-on-his-back man. This is for two reasons: this position helps a woman to reach orgasm faster as there is greater touch of the penis with the woman\'s G-spot. Add to that, in such a position, a man\'s glans would be in the least contact, which will prolong the sexual intercourse.', '2019-03-13 16:42:02'),
(290, 2, 2, 1, 'The menopause leads to dryness of the vagina and makes the sexual intercourse very painful. That is why a woman should ask her doctor to prescribe some safe vaginal lubricants.', '2019-03-13 16:42:02'),
(291, 2, 2, 1, 'Pleasure in some females may concentrate in the vagina, anus, neck, clitoris or in all these zones. Therefore, a man should investigate his woman\'s pleasure zones accurately to know how to satisfy her needs without hastening to insert in the vagina.', '2019-03-13 16:42:02'),
(292, 2, 2, 1, 'A man should take into consideration the wide range of diversification in woman, which necessitates non-generalization or stereotyping. Some women like to have sex in the water, in the open air, or in nature. Knowing such details will help a man satisfy his woman\'s needs fully. Though it might seem difficult to satisfy such needs in the way a woman likes, still there is a possibility to create similar ambiances at home.', '2019-03-13 16:42:02'),
(293, 2, 2, 1, 'Some nerves in the cervix get stimulated during the sexual intercourse. Therefore, ifsome harmful sexual tools are used, they might lead to cuts in those nerves, which would prevent a woman from reaching orgasm.', '2019-03-13 16:42:02'),
(294, 2, 2, 1, 'Most people do not really know that every person has their own sexual power which differs from others. If the sexual powers of partners are almost the same level, it will lead to compatibility between them. Therefore, being honest about this issue before getting married will help make their partnership more sustainable. Knowing each other\'s needs and sexual performance is a necessity before getting involved in an eternal-bond relationship.', '2019-03-13 16:42:02'),
(295, 2, 2, 1, 'A man should know that a woman is not like him as regards sex. She does not resort to sex when she suffers from hardships like him, unless she is a masochist or a concupiscent person. Such a woman resorts to sex under pressure as it relieves them; however, they do not exceed 5% of all women.', '2019-03-13 16:42:02'),
(296, 2, 2, 1, 'After the  surgery ofovariectomy, the sexual desire attenuates in a woman due to the fact that the ovaries are the organs produce the hormone responsible for the sexual desire in both sexes; i.e. testosterone.', '2019-03-13 16:42:02'),
(297, 2, 2, 1, 'Partnersshould not be selfish in theirsexualrelationship. This practice indicates optimum feelings that should be given before being taken. Love-making is primarily giving to be able to lead a balanced sexual life with your partner.', '2019-03-13 16:42:02'),
(298, 2, 2, 1, 'If a female feels that her man only loves her only to satisfy his sexual needs, she will be upset and feel she is really offended.  ', '2019-03-13 16:42:02'),
(299, 2, 2, 1, 'Hysterectomy leads to a pause in the sexual life of a woman, only for a few weeks. A woman; however, should not end her sexual life, for according to studies in the field, many women continued their life normally or even better, sexually speaking.', '2019-03-13 16:42:02'),
(300, 2, 2, 1, 'It is not healthy at all to boast about the sexual and emotional past of a man and compare it to the present. It is not recommended at all to tell your female partner about your sexual adventures as this may lead to depression and create a feeling of inferiority.', '2019-03-13 16:42:02'),
(301, 2, 2, 1, 'A man should know when to invite his partner to love-making. He should read her suggestions and decipher her bodily codes and clothes which can be considered as indicators of her demands.', '2019-03-13 16:42:02'),
(302, 2, 2, 1, 'Any side effects and wounds should heal within two months after any surgery of the uterus. Therefore, the American Gynecologist and obstetrician College, Ministry of Health, and American Human Services recommend not inserting anything into the vagina during the first six weeks after the surgery; the sexual intercourse comes on top.', '2019-03-13 16:42:02'),
(303, 2, 2, 1, 'Bad breath is sexually repellent. That is why partners should use special mouth odors before starting kissing.', '2019-03-13 16:42:02'),
(304, 2, 2, 1, 'Noticing the requirements of a woman after the sexual intercourse is very important. Therefore, a man should not neglect her as this may let her feel offended. She prefers to have continuous love even after the love-making is over through touches. Her body needs those touches to produce the needed endorphins and oxytocin.', '2019-03-13 16:42:02'),
(305, 2, 2, 1, 'The hysterectomy is a surgical operation that is intended to relieve the pain of different endometrial diseases or fibroids. However, the sexual life of a woman will not be affected if she needs hysterectomy due to suffering of endometrial carcinoma or cervical cancers.', '2019-03-13 16:42:02'),
(306, 2, 2, 1, 'Partners should understand that during the love making process, they are no longer abiding by reality or logic. At that moment, they turn into merely instinctive and emotional creatures, but everything will go back to normal after they finish. Therefore, no one should blame the other for anything they utter during theintercourse.', '2019-03-13 16:42:02'),
(307, 2, 2, 1, 'Foreplay is very important for a female, be it through saying soft words, kissing, or complimenting her outlook, then come the physical caresses.', '2019-03-13 16:42:02'),
(308, 2, 2, 1, 'If there is discomfort in the sexual intercourse, one should not keep their fears or premonitions for themselves. They should share them with their partner. Some may have a negative attitude towards a special kind of sex, such as oral sex, but this may only be a result of preconceptions about sex, no more no less.', '2019-03-13 16:42:02'),
(309, 2, 2, 1, 'Massage sessions should be well-taken into consideration, for they could have the ability to stimulate the pleasure zones of both; males and females.', '2019-03-13 16:42:02'),
(310, 2, 2, 1, 'New things should not be tried in the sexual process at all without getting the consent of the female or without paving the way to that, for this makes her feel she is deprived of her own free will unless she is a masochist. Therefore, it is necessary to act according to the previously agreed issues.', '2019-03-13 16:42:02'),
(311, 2, 2, 1, 'A number of diseases or viruses can be transmitted through the sexual intercourse, such as the HPV virus, which is very common and highly infectious. It may cause genital warts and increase the risk of cervical cancer.', '2019-03-13 16:42:02'),
(312, 2, 2, 1, 'If your partner is the auditory type, it is necessary to turn them on by something auditory, such as talking to them; complimenting them or indicating the sex appeal they have.', '2019-03-13 16:42:02'),
(313, 2, 2, 1, 'If your partner is not an auditory person, it is preferable that your sexual meeting be silent. However, if one of the partners is auditory and the other is not, their relationship is almost doomed to failure.', '2019-03-13 16:42:02'),
(314, 2, 2, 1, 'Some diseases that are transmitted through the sexual intercourse can remain symptomatic for several years, like the Chlamydia, which is a silent virus that can infect silently without any indications and can lead to infertility.', '2019-03-13 16:42:02'),
(315, 2, 2, 1, 'Ninety-six percent of back pain in women is psychological not organic, and it usually associated with incompatibility in the sexual relationship with the partner. The treatment of such a case could be by letting a female make a clean breast of what she is suffering from during the sexual intercourse instead of keeping it inside and aggravate the situation.', '2019-03-13 16:42:02'),
(316, 2, 2, 1, 'Lack of sexual desire in a woman can be attributed to various reasons, such as vaginadryness (colpoxerosis), post-shock psychological problems, or hormonal changes (menopause, for example).', '2019-03-13 16:42:02'),
(317, 2, 2, 1, 'All women should pay regular visits to their gynecologist to check they are free from sexually transmitted diseases, such as the HIV. They also have to do a cervical smear to check for early cervical  cancers, if any.', '2019-03-13 16:42:02'),
(318, 2, 2, 1, 'Average people who do not have excessive sex desire, making love twice a week helps them be more calm and alleviates the tension they get from their daily life. It also gives partners a bigger ability to ponder problems.', '2019-03-13 16:42:02'),
(319, 2, 2, 1, 'ٍSome people need to have sex intensively, but they are not offered the opportunity to do so, therefore, they suffer from cases of poor memory (hypomnesis) or dispersion.', '2019-03-13 16:42:02'),
(320, 2, 2, 1, 'A woman has to be thankful as her vagina and clitoris can afford her the sexual pleasure she needs. Therefore, those women, who resort to surgeries to improve the appearance of their genitals, have to understand that such surgeries can be more harmful than they think. They could cause them big damages and scars in their genital tissues, let alone that they could reduce their feeling of the sexual pleasure.', '2019-03-13 16:42:02'),
(321, 2, 2, 1, 'Being addicted to visual sex, by looking at sex photos and watching sex movies, is a special kind of optical desire.in such a case, a person will have excessive desire to watch sexually arousing scenes. Such people are merely the visual type who do not care for the direct sensation. ', '2019-03-13 16:42:02'),
(322, 2, 2, 1, ' Sexual malfunction can be attributed to different reasons, such as suffering from an organic disease (diabetes, blood diseases), aging, concentration of lactose, or hormonal changes that could be a cause of testicular diseases. However, there are certain medicines that a person usually takes but could be a reason for sexual malfunction.', '2019-03-13 16:42:02'),
(323, 2, 2, 1, 'The glans clitoridis in a woman\'s vagina may be symmetrical or asymmetrical; they could be vary from woman to woman in size, touch and colour that may range between brown and roseate.', '2019-03-13 16:42:02'),
(324, 2, 2, 1, 'When love is a basis for sex, this will help increase the rates of oxytocin, serotonin and endorphins; happiness hormones. This inevitably makes sensations different and so is the end of the sexual practice.', '2019-03-13 16:42:02'),
(325, 2, 2, 1, 'Psychological and sexual emotions play a vital role in formulating the sexual feelings of a female. Therefore, it is important to know that such feelings do not grow healthily unless a girl is brought up in a balanced, complex-free environment and is well-educated, sexually speaking.', '2019-03-13 16:42:02'),
(326, 2, 2, 1, 'To achieve this sexual pleasure and reach orgasm, a clitoral woman needs her clitoris be stimulated first. This is not shameful since their sexual pleasure concentrates there. This is a task a man has to undertake to make his female reach the ultimate satisfaction.', '2019-03-13 16:42:02'),
(327, 2, 2, 1, 'Little male children can have a special anxiety called (castration) in the early phallic phase when they are threatened by their parents to have the penis cut off if they are caught rubbing or playing with it.', '2019-03-13 16:42:02'),
(328, 2, 2, 1, 'In psychoanalysis, there are different phases any person will pass through from their early childhood. The phases start with the oral, anal then phallic phase. A period of latency follows. But, it should be noted that it is necessary not to repress any child and try to make every phase pass as quickly as possible lest the child suffers from complexes when he grows up. For example, if a child is weaned so early, s/he will suffer from libidinal fixation in the oral position when they grow up.', '2019-03-13 16:42:02'),
(329, 2, 2, 1, 'According to some studies, 71% of women have never felt orgasm during the intercourse. This may be attributed to their weak nature which does not make them structurally eligible to reach sexual pleasure;i.e orgasm. Maybe it is their partner who does not know how to stimulate them as he does not have the least knowledge about their pleasure zones, or because he suffers from premature ejaculation. However, the reason may be the woman herself as she does not dare to state openly what pleases her and what not.', '2019-03-13 16:42:02'),
(330, 2, 2, 1, 'Lack of sexual desire in man can obviously be attributed to a decrease in testosterone rates or in production of amino acids. This can be diagnosed through blood tests followed by seeing a consultant to give the most effective treatment.', '2019-03-13 16:42:02'),
(331, 2, 2, 1, 'Some hormone-incorporated foods such as chicken or greenhouseveggies may cause cancers or may lead to malfunction in men or lower masculinity rates. Those hormones are often feminine, but they do not only affect men negatively, they also affect women. That is why it is highly recommended to avoid eating them.', '2019-03-13 16:42:02'),
(332, 2, 2, 1, 'Only some partners can coordinate reaching orgasm together. This was proved through some surveys conducted by Kenzi Institute for Sexology and Cloning. According to those surveys, only 29% of partners can synchronize reaching orgasm during the coitus.', '2019-03-13 16:42:02'),
(333, 2, 2, 1, 'The malfunction of testicles has direct effects on the masculine characteristics of a male before puberty. That is why he tends to look like females, thin voice and almost full breasts.', '2019-03-13 16:42:02'),
(334, 2, 2, 1, 'To differentiate between physical or psychological reasons behind sexual malfunction, it is recommended to test the male organ erection by use of some local injections; night and early-morning erections. It is also recommended to do some tests to diagnose this dysfunction through having an overall medical test and measuring the sugar rates in blood.', '2019-03-13 16:42:02'),
(335, 2, 2, 1, 'Labour or delivery cannot but lead to changes in the vagina. During this period, the vagina expands to allow the baby be delivered, but it gets back to normal after a while due to its flexible nature. It should be noted that after delivery also all uterine tissues heal, and this is for women\'s good luck.', '2019-03-13 16:42:02'),
(336, 2, 2, 1, 'Using Viagra can have various harms and can manifest in dizziness, red cheeks, stomach pain, muscle pain, back pain, dyspepsia (indigestion), rashes, or tachycardia. Therefore, it should be taken with caution and according to  doctor\'s instructions. ', '2019-03-13 16:42:02'),
(337, 2, 2, 1, 'Seasons can affect the sexual ability of people. A good example of this could be people living by the Mediterranean. Due to having seafood, they acquire a powerful sexual ability that makes them concupiscent; both men and women. The same applies to people living in hot areas.', '2019-03-13 16:42:02'),
(338, 2, 2, 1, 'If a woman suffers from pain during the coitus, vaginal discharge, severe menstrual cramps or urinal discomfort, she has to see a specialized doctor to make sure she has no infection in the cervix, endometrium, or interstitial cystitis.', '2019-03-13 16:42:02'),
(339, 2, 2, 1, 'The fourteenth day of the period is the best day for conception. On this day, the feminine egg would be quite ready to receive her partner\'s sperm. Also, her sexual desire would be at its highest levels.', '2019-03-13 16:42:02'),
(340, 2, 2, 1, 'A woman\'s sexual desire increases prior to the period and during it due to the low estrogen and high testosterone levels.', '2019-03-13 16:42:02'),
(341, 2, 2, 1, 'A lot of women suffer from pain in certain spots during sex, and at certain times during the period. This is quite natural, but if pain is severe or constant, they should see a gynecologist.', '2019-03-13 16:42:02'),
(342, 2, 2, 1, 'To reach sexual compatibility, there should be emotional compatibility in the first place. A man\'s ability to understand a woman\'s emotion in full means his ability to attain the utmost pleasure in their physical relationship.', '2019-03-13 16:42:02'),
(343, 2, 2, 1, 'Partners have to avoid using the same positions all the time, for this fixed type would lead to boredom, and in some cases, sexual frigidity.', '2019-03-13 16:42:02'),
(344, 2, 2, 1, 'Every woman has a different vagina, i.e., there is not a typical shape or size. Therefore, a man has to know that this is the reason behind the differences in the pleasure and positions every woman likes.', '2019-03-13 16:42:02'),
(345, 2, 2, 1, 'Some women who like shows like to see their partnersmasturbating upon seeing them as this would make them feel they have top femininity.', '2019-03-13 16:42:02'),
(346, 2, 2, 1, 'Masturbation is not a psycho-behavioral deviation at all. It is a good means of discharging and amusing oneself. It also helps lessen tension and better sleep.', '2019-03-13 16:42:02'),
(347, 2, 2, 1, 'The nearness of the sexual genitals of a woman to the colon makes it possible for the gases in the colon to be released as a result of the movement of those genitals (uterus, ovaries, vagina) during the sexual intercourse and the different positions partners can take. However, this is very natural and must not make a woman ashamed.', '2019-03-13 16:42:02'),
(348, 2, 2, 1, 'If a woman likes to have sex during the period, nothing can stand in the way, especially if her partner has the same desire and uses a condom.', '2019-03-13 16:42:02'),
(349, 2, 2, 1, 'It is important to consider age when having sex because the sexual responses differ with aging and there will be a delay in arousal, erection, ejaculation and consequently pleasure.', '2019-03-13 16:42:02'),
(350, 2, 2, 1, 'If a woman suffers from post-sex constant cramps, she had better, then, see her gynecologist to be sure she has no fibroids, urinary tract infections or any diseases in the endometrium.', '2019-03-13 16:42:02'),
(351, 2, 2, 1, 'A woman of medium desire needs a longer time than man to reach orgasm. That is why he has to make the time between her orgasm and his ejaculation close. This can be attained by resorting to the foreplay.', '2019-03-13 16:42:02'),
(352, 2, 2, 1, 'If your partner has sexual fantasies, you need to act according to his nature and play different roles, as this will please them on condition that you are compatible in that fantasy.', '2019-03-13 16:42:02'),
(353, 2, 2, 1, 'The cramps affecting a woman during and after sex may be a result of discomfort in the bladder or urinary tract. Therefore, a woman is advised to empty the bladder before having a sexual intercourse.', '2019-03-13 16:42:02'),
(354, 2, 2, 1, 'Annal sex may lead to various harms if it is practised constantly as it leads to expansion of the anal opening. This will greatly affect a woman, that is why it should practised with caution.', '2019-03-13 16:42:02'),
(355, 2, 2, 1, 'Sexual intercourse accompanied with the use of obscene sexual words is only acceptable during the intercourse unless your partner is a masochist who finds pleasure in getting pain and humiliation.', '2019-03-13 16:42:02'),
(356, 2, 2, 1, 'Post-sexual cramps can be very natural as the lower part of the uterus or cervix gets irritated during the coitus, or due to the touch of with the penis or fingers.', '2019-03-13 16:42:02'),
(357, 2, 2, 1, 'If a man is visual, then it is very pleasing for him to see his woman masturbating as this will satisfy his sexual visual pleasure.', '2019-03-13 16:42:02'),
(358, 2, 2, 1, 'Vaseline should not be used as a means to facilitate vaginal insertion because this substance forms an insulating layer that prevents from having full pleasure.', '2019-03-13 16:42:02'),
(359, 2, 2, 1, 'When female teenagers or pregnant women suffer from mild bleeding, they do not have to worry much as this may be a result of natural changes in the cervix. However, this should not make them abstain from seeing a doctor to dismiss any possibility for any potential infection.', '2019-03-13 16:42:02'),
(360, 2, 2, 1, 'A man has to be cautious and know that if he does not ejaculate, he will suffer from prostate problems in the future.', '2019-03-13 16:42:02'),
(361, 2, 2, 1, 'If you like to harm your sexual partner, this indicates you are a sadist person. This sadism could be built-in or a result of behavioral deviation. The distinction between both types needs a psychoanalyst and the whole matter needs a sexologist.', '2019-03-13 16:42:02'),
(362, 2, 2, 1, 'A woman sitting with a man and playing with her pen with her hands or putting it in her mouth every now and then is a woman with a very great desire to have a intimate relationship with that man.', '2019-03-13 16:42:02'),
(363, 2, 2, 1, 'A female has to be honest with her partner and lead him to her pleasure zones, for he may not be able to detect them. By making a foreplay to such zones, she will have the pleasure and ecstasy, which will reflect on her partner, too.', '2019-03-13 16:42:02'),
(364, 2, 2, 1, 'A woman\'s sexual frigidity may be attributed to different reasons, such as having low sexual needs, which needs a sexologist or psychologist counseling. It may also be attributed to low amino acids.', '2019-03-13 16:42:02'),
(365, 2, 2, 1, 'The sexual impetus in a man is very powerful at the age of 19, however, he maintains his interest and desire to have sexual relations all his life. Thus, a man in his sixties has the same interest in sex as when he was thirty, but unfortunately, with declining physical abilities.', '2019-03-13 16:42:02'),
(366, 2, 2, 1, 'One of the most effective positions for a man that help him ejaculate easily is to have his woman lying under him or to take the cat or horse position..', '2019-03-13 16:42:02'),
(367, 2, 2, 1, 'During oral sex, it is better not to ejaculate in the mouth as this would bring a man negative energy or draw away all his energy.', '2019-03-13 16:42:02'),
(368, 2, 2, 1, 'Pedophilia or sex with children is an indication of a behavioral disorder, which necessitates seeing a psychologist to give some immediate consultations.', '2019-03-13 16:42:02'),
(369, 2, 2, 1, 'You have to know they nature of your partner; auditory, visual, kinesthetic or olfactory, taking into consideration that they might combine all these types or some of them. This is very important to consider if you want to have an optimum relationship with your partner.', '2019-03-13 16:42:02'),
(370, 2, 2, 1, 'Masturbation cannot be considered as a deviation in teenagers in particular and grown-ups in general. It is only a source of pleasure, and has a specific taste for married people on condition that it is not a substitute for the sexual relation with the partner.', '2019-03-13 16:42:02'),
(371, 2, 2, 1, 'A woman is considered the best daughter of nature. That is why she is closely connected to it and would never forget any sexual practice in nature or in the water. Such choices will be engraved in her mind as they take place in unfamiliar and unexpected places, let alone the idea that they generate distinctive sensations.', '2019-03-13 16:42:02'),
(372, 2, 2, 1, 'It is not society which determines how sexually normal or abnormal this person is. This is not true as this issue relates to a person\'s nature that they got while they in their mother\'s wombs and got different hormonal potions. This made their sexual imprint and made them what they are, sexuallyspeaking. (You can take the tests in this application to know about your imprint).', '2019-03-13 16:42:02'),
(373, 2, 2, 1, 'The best sexual partner for a masochist is the sadist person who enjoys torturing others. A masochist reaches orgasm when they are humiliated psychologically (by words) or physically (by torture). On the other hand, a sadist reaches orgasm when they are the doers of the action taking the leader role and humiliate others during the sexual practice.', '2019-03-13 16:42:02'),
(374, 2, 2, 1, 'If sexual deviations of men and women are not structural; i.e., built-in, this means they could be resulting from experiences during teenage or maybe before. That is why it is necessary to educate teenagers sexually lest they go to unfamiliar deviated practices.', '2019-03-13 16:42:02'),
(375, 2, 2, 1, 'Sexual sight of men is stronger than women. Men like to see while they are in the middle of the sexual practice while women like to touch and hear. Therefore, partners have to consider the type of each other to be able to satisfy them.', '2019-03-13 16:42:02'),
(376, 2, 2, 1, 'A woman has a better ability to see in the dark than a man. That is why she likes to make love in fading lights, unlike her partner. He does not enjoy her sight features, and because he is a visual person, he likes the love making process to be under high lights, which makes a big difference between them. This should be overcome and an understanding should be reached or a sexologist should be sought.', '2019-03-13 16:42:02'),
(377, 2, 2, 1, 'A man\'s jealousy over his partner and accusing her of being involved in a sexual relationship with another man is attributed to his feeling of impotence and inferiority. That is why he projects this inferiority on his female. But this necessitates seeing a psychiatrist or a sexo-psychologist to find a solution to this problem.', '2019-03-13 16:42:02'),
(378, 2, 2, 1, 'There is no evidence in history about a people or a civilization whichhad the same sexual behavior. That is why, we cannot describe a person as a sexually deviant because their sexual type is different from our type or the familiar types.', '2019-03-13 16:42:02'),
(379, 2, 2, 1, 'One should be so cautious when talking to a teenager as words can affect them to a great extentand can have a long-term influence on their life. Thus, when you describe a teen as a homosexual, their mind would act according to this characteristic, not according to its opposite implication.', '2019-03-13 16:42:02'),
(380, 2, 2, 1, 'You should never call a person (a fetishist) if they love a special womanly preference. Fetishism means that a person spends their sexual power over one part only. You should take into consideration that fetishism takes a wide range in some people or a low degree only. This goes back to their genetic nature. To detect if it is fetishism or not, you can consult a sexpert.', '2019-03-13 16:42:02'),
(381, 2, 2, 1, 'Partners are advised to enhance the sexual practice or behavior that renders a high response and compatibility between them taking into consideration that their mutual relation should take only one sexual form or restricts to one sexual behavior.', '2019-03-13 16:42:02'),
(382, 2, 2, 1, 'A man has to understand his woman\'s reluctance from having a coitus intercourse after her period. This happens due to a thinning in the vaginal membrane and exposure of the clitoris glans, which causes her pain upon touching. But, sometimes, her reluctance may be psychological, which entails seeing a sexo-psychologist. ', '2019-03-13 16:42:02'),
(383, 2, 2, 1, 'It is preferable that partners always use different positions during their sexual intercourse and use different ways of cuddling. This also applies to their everyday life. If they adopt the same behavior and actions, they will get bored in their intimate life, and this will, consequently, lead to early sexual aging.', '2019-03-13 16:42:02'),
(384, 2, 2, 1, 'A female partner should not ask her man who is really old to ejaculate in every meeting they have, for he might have sex at this age without ejaculation, preserving, thus, his semen for another time. If she really understands this, they will enjoy a sexual ability till an old age.', '2019-03-13 16:42:02'),
(385, 2, 2, 1, 'It is recommended that a woman regularly has sex, once or twice a week if she is physically able to. This will help her in the future when she approaches the menopause as it would stop any sexual deterioration. The regular practice will be a good training for the womb and vagina against any deterioration.', '2019-03-13 16:42:02'),
(386, 2, 2, 1, 'A partner of a clitoral woman should concentrate his foreplay on the clitoris till her orgasm nears, then he can insert his penis, or he has to make her actually reach orgasm then he can insert.', '2019-03-13 16:42:02'),
(387, 2, 2, 1, 'A father has to be careful not to threaten his son of cutting off his penis if he catches him masturbating because this will make the son tend to actfemininely and have negative behavior.', '2019-03-13 16:42:02'),
(388, 2, 2, 1, 'Due to recurrent early ejaculation of man, his female may suffer from a kind of inability to reach orgasm as she feels she has been used as a tool to satisfy his needs without any consideration to hers.', '2019-03-13 16:42:02'),
(389, 2, 2, 1, 'Most males reach orgasm before females. Therefore, men have to start the foreplay  with their women to synchronize their orgasms. This will make them both satisfied.', '2019-03-13 16:42:02');
INSERT INTO `app_tips` (`tips_id`, `tcat_id`, `lang_id`, `status_id`, `tips_text`, `ins_datetime`) VALUES
(390, 2, 2, 1, 'If there is a big difference between your father and mother in age, and you feel you are attracted to the oldies, and you will have some oedipal desires that function unconsciously and orient your sexual behavior, such as the desire to make love with who is older than you.', '2019-03-13 16:42:02'),
(391, 2, 2, 1, 'The best partner for a man-like woman – a woman who enjoys a masculine nature – is the man who tends to have a feminine nature as he will satisfy her masculine tendencies and the leading role she enjoys. Though he satisfies her, she will never feel any respect for him.', '2019-03-13 16:42:02'),
(392, 2, 2, 1, 'If a father is increasing the marriage demands of his daughter, this means he suffers from the Griselda Complex. This complex reflects the father\'s holding to his daughter in a sexually concealed way due to his inability to get rid of the oedipal positions.', '2019-03-13 16:42:02'),
(393, 2, 2, 1, 'A narcissist partner is the one who insists on taking during the intercourse and seeking their own pleasure and ecstasy without considering their partner\'s desires. They think the world only revolves around them, therefore, others have to crave to satisfy them. This person – beyond doubt – has to see a sexo-psychiatrist.', '2019-03-13 16:42:02'),
(394, 2, 2, 1, 'Having sex regularly helps a woman be sexually stable as she gets older and when she gets into the menopause. This helps the vagina secrete the liquids wetting its interior. As for man,this regular practice will help the testicles to function well, and protect a man from cancers of prostate and bladder.', '2019-03-13 16:42:02'),
(395, 2, 2, 1, 'Masturbation is a way of sexual satisfaction that leads to pleasure of man or woman. It is a healthy way, therefore, no one should feel guilty or afraid of resorting to it. However, it should not be practised a lot to the extent of addiction because pleasure will fix on it, turning the practice, thus, into real sickness.', '2019-03-13 16:42:02'),
(396, 2, 2, 1, 'A woman who likes to make shows with her body to show her femininity, and reaches orgasm upon seeing a man masturbating at her sight, feels extreme ecstasy and pleasure. To her, this means her man appreciates her overwhelming femininity and sex appeal.', '2019-03-13 16:42:02'),
(397, 2, 2, 1, 'In a sexual relationship, a man should deal with a woman as a partner and respect her for her own self not look at her as a tool of satisfaction. This will make her feel offended and insulted.', '2019-03-13 16:42:02'),
(398, 2, 2, 1, 'When a woman has sex, she does not have it for the sake of sex only. She has it because she does not get pleased and reach orgasm unless her partner could make her feel secure and overwhelm her with emotion. For her, sex means emotions first then security. ', '2019-03-13 16:42:02'),
(399, 2, 2, 1, 'Having an intercourse in nature would have a different taste for a woman. This would make her feel her own beauty and femininity as she is surrounded by nature itself.', '2019-03-13 16:42:02'),
(400, 2, 2, 1, 'Women are different types as far as pleasure and pleasure zones are concerned. Pleasure does not concentrate in one zone. Some women have two pleasure zones, others may have more. This also intersect with their nature; visual, auditory or kinesthetic. That makes it necessary for anyone to know what their partner\'s type and her pleasure zones to know how to satisfy her sexual needs. This is difficult of course if there is no frankness between partners or even asking the help of a sexpert.', '2019-03-13 16:42:02'),
(401, 2, 2, 1, 'If you are emotionally and sexually immature and looking for love, sympathy and tenderness like those of a mother in your sexual relationship, just bear in mind that you are suffering from the Oedipus Complex; i.e., being attached to the mother figure. In this case, it is better if you see a sexo-psychologist to offer you some needed help.', '2019-03-13 16:42:02'),
(402, 2, 2, 1, 'The same rates of oxytocin are secreted in the bodies of man and woman at the end of the sexual intercourse. However, how this hormone functions differs from man to woman. In a man, it leads to aversion and finish cuddling, while in a woman, it leads to relaxation, increases her romance and desire of more cuddling. That necessitates the understanding of each other and making some concessions to make pleasure achieved mutually.', '2019-03-13 16:42:02'),
(403, 2, 2, 1, 'The most import thing in a sexual relation between man and woman is its being positive, and based on giving and taking. In other words, partners should not selfish and only get what they want to reach their ecstasy without any consideration of their partner\'s needs and desires.', '2019-03-13 16:42:02'),
(404, 2, 2, 1, 'A women has to take good care during her pregnancy of not being subject to negative  motions as they have the ability to change the rates of hormones in her body and consequently embryo\'s body. Being irritated or getting angry may affect the sexual imprint of the embryo at an early age.', '2019-03-13 16:42:02'),
(405, 2, 2, 1, 'The successful sexual relationship is the one that is comprehensive. In other words, it contains all theessential factors; nice words, foreplay, cuddling, coitus, and hugging. Each stage should be given its sufficient timeas it conveys a special pleasure to both partners.', '2019-03-13 16:42:02'),
(406, 2, 2, 1, 'A kiss is the starting point for physical touch and excitement of partners. It leads to production of serotonin and oxytocin; the romance and activity hormones. It also helps activating and satisfying the oral stage which is an important stage in the sexual and psychological formation of a person.', '2019-03-13 16:42:02'),
(407, 2, 2, 1, 'If you and your partner are kinesthetic, then a kiss on the mouth and kisses on other parts of the body would have a great effect and would satisfy your physical contact and reach orgasm. ', '2019-03-13 16:42:02'),
(408, 2, 2, 1, 'It is true that man and woman are structurally different, however they can come close to each other by the means of sex. It is the best means of communication between them. Therefore, each one should look for a sexually-compatible partner. This can be reached by knowing the sexual imprint of the person you are attached to .', '2019-03-13 16:42:02'),
(409, 2, 2, 1, 'A man has to know which are his female\'s points of ecstasy and pleasure to be able to satisfy her needs best. This will also has its positive influence on him. He has to let his female know that it is her right to express herself and tell about her needs and pleasures.', '2019-03-13 16:42:02'),
(410, 2, 2, 1, 'For a clitoral woman, the most sensitive parts are the clitoris, glans and their extension to the vagina. Therefore, it is her partner\'s duty to make her reach orgasm as long as he knows these facts quite well.', '2019-03-13 16:42:02'),
(411, 2, 2, 1, 'A man has to know that the sexual organs are not the only zones that cause arousal in their partner. A female\'s body can be aroused as a whole, but this differs from a woman to another woman. Therefore, a man has to detect those pleasure spots in his woman and deal with her in the right way to make his relationship more sustainable and achieve the ultimate pleasure for both of them.', '2019-03-13 16:42:02'),
(412, 2, 2, 1, 'If your partner is the visual type, then they can be aroused by seeing everything that has a visual nature, such as shows, stripteases, dancing, lingeries, masturbating in front of the mirror, etc. You can know if your partner is visual by asking them a question. If you see their eyes go up, then they have a visual nature. To know more, you can take our Sexual Imprint Test in this application. ', '2019-03-13 16:42:02'),
(413, 2, 2, 1, 'Hormones have a great impact on the spatial capability of a female. This is proved by a study conducted in the University of Ontario on the relation between the spatial capability of a woman and the rates of testosterone. It was evident that the low rates of the masculine hormone would affect her capability negatively, while the rise of the feminine hormone (estrogen) would increase her ability of verbal expression and accuracy of motor skills.', '2019-03-13 16:42:02'),
(414, 2, 2, 1, 'Due to the high rates of testosterone in the first few days of the menstruation, a woman would lose her ability to use words to stop a man from abusing her. However, she is ready to act violently or aggressively against him, if it is necessary.', '2019-03-13 16:42:02'),
(415, 2, 2, 1, 'A week prior to the menstruation, a female would suffer from low rates of estrogen, which make her distressed, or melancholic. Therefore, if a man does not have some hormonal education, he would never be able to understand the change in her attitude and would feel upset.  ', '2019-03-13 16:42:02'),
(416, 2, 2, 1, 'Some of the developed countries tend to inject aggressive people with the feminine hormone of estrogen due to its reassuring effects and because their bodies do not produce it. However, when resorting to this act, the hormone should be given with caution and its negative impacts should be taken into medical consideration. ', '2019-03-13 16:42:02'),
(417, 2, 2, 1, 'Somecontraceptive pills could contain testosterone. Therefore, a womanwould tend to be aggressive, feel confused and distressed, and wouldbreak a lot of house appliances and dishes while cleaning.', '2019-03-13 16:42:02'),
(418, 2, 2, 1, 'The high rates of testosterone in a man can easily lead to violence, be it verbal or physical. They also make him very interested in watching action movies, wrestling, car racing, adventures and even being involved in violent actions that could end in crimes. It should be noted that women who have the same tendencies are the ones whose bodies secrete big amounts of this masculine hormone.', '2019-03-13 16:42:02'),
(419, 2, 2, 1, 'A moody woman is the one who has sudden mood swings. when her man notices this, he might think she is not leading a happy life with him and that he is the one responsible. But, in fact, her distress and mood swings can simply be attributed to hormonal changes that he has nothing to do with or be responsible for.', '2019-03-13 16:42:02'),
(420, 2, 2, 1, 'the testosterone is known to be the competition and success hormone. it is also the hormone the pushes a person to have a high performance. however, it could be a time bomb in males as it leads to aggression. this explains why males are often aggressive when they have high rates of testosterone. a female has to be aware that this is out of a man\'s control, exactly like her PMS, which necessitates understanding and bearing one another.', '2019-03-13 16:42:02'),
(421, 2, 2, 1, 'Between the 21-28 days of the menstruation, a female would have a sharp and sometimes sudden decline of estrogen, which makes her feel severe deprivation. This is called the PMS (Pre-Menstrual Syndrome). This situation would mostly result in developing some feelings like, distress, depression, languor, and in some special cases a female may tend to commit a suicide.', '2019-03-13 16:42:02'),
(422, 2, 2, 1, 'It is the decline of the feminine hormone prior to the period that causes a female to be aggressive. This led some sanitariums in the west to inject aggressive people with estrogen even if they were men. ', '2019-03-13 16:42:02'),
(423, 2, 2, 1, 'A study conducted in the University of Georgia showed that women who have high rates of the masculine hormone (testosterone) are the ones who work in jobs that need massive energy, and sometimes jobs that need offensive initiatives such as lawyers. Such women can also work in the fields that need patience, such as working as sales managers. Therefore, this hormone has the ability to raise the levels of competence and achievements, and it increases the ability to act positively.', '2019-03-13 16:42:02'),
(424, 2, 2, 1, 'A study conducted in the University of California proved that outstanding people would have higher rates of testosterone than average people. This stresses the importance of the power of the masculine hormone in the energy the outstanding have.', '2019-03-13 16:42:02'),
(425, 2, 2, 1, 'A study was conducted in the University of Minnesota on the different stages a personality would have, it was evident that females who were characterized of being naughty and aggressive, might suffer from a greater risk of sudden and early deaths that could be four times doubled than others due to the high rates of testosterone in their bodies.', '2019-03-13 16:42:02'),
(426, 2, 2, 1, 'According to some scientific studies, the feminine hormone of estrogen stimulates the neurons to produce more connections between the right and left cerebrums. The abundance of this hormone can explains the fluency a female has and her ability to utilize both cerebrums effectively and positively.However, if a female is undergoing an emotional state, communication between cerebrum halts, and her emotion can take over logic.', '2019-03-13 16:42:02'),
(427, 2, 2, 1, 'The babyish voice resonance in a woman means a big rise in the estrogen rates in her body. This is also an indication of empathy, and a desire in and to have a positive communication with the man she is talking to, if there is any. ', '2019-03-13 16:42:02'),
(428, 2, 2, 1, 'Estrogen is the feminine sexual hormone in women that offers them satisfaction, and psychological balance. It is for those effects that there is a tendency to inject aggressive people with it to make them able to restore their balance.', '2019-03-13 16:42:02'),
(429, 2, 2, 1, 'When estrogen rates decrease due to menopause, the memory of a woman gets affected because this hormone in particular boosts her memory, and affects her psychological situation in general. However, with its decrease, a woman would no more feel comfortable and she would suffer from fits of anxiety.', '2019-03-13 16:42:02'),
(430, 2, 2, 1, 'From the twenty-first to the twenty-eighth days of the start of the period, a woman would have a sudden decline in the estrogen rates in her body. This makes her feel languor, sadness and depression. However, this might aggravate in some exceptional cases that women might have suicidal tendencies. Remarkably enough, a woman out of twenty-five suffer from those sharp hormonal swings that can change their whole personality, in the literal sense of the word.', '2019-03-13 16:42:02'),
(431, 2, 2, 1, 'If you want to know what type of partner you have, you can ask them a question. If their eyes go down, then they are kinesthetic beyond doubt. However, if you want to know more and how compatible you are, you can take the sexual imprint test in this application.', '2019-03-13 16:42:02'),
(432, 2, 2, 1, 'If a man is auditory, he would be attracted to the sex sighs and moans prior and during the intercourse. He would also like to speak and use some bad words. This is possible on condition that they are only used during the intercourse and spoken directly in the left ear of his woman.', '2019-03-13 16:42:02'),
(433, 2, 2, 1, 'If you are a selfish partner in your relationship; i.e., you would like to take and feel pleasure without any consideration of your partner, then you are a narcissist who should consult a sexo-psychologist to find you a compatible partner.', '2019-03-13 16:42:02'),
(434, 2, 2, 1, 'If you reach your orgasm by insulting, humiliating or torturing others, then you are a sadist who likes to be a master. The best partner for you is the masochist as they are the type who likes to be humiliated and treated like a slave.', '2019-03-13 16:42:02'),
(435, 2, 2, 1, 'If you reach your orgasm by enduring pain, punishment and humiliation, then you are a masochist. The best partner for you would be a sadist who likes to control others by humiliation and insulting. For more information, you can contact any of the sexperts in our application.', '2019-03-13 16:42:02'),
(436, 2, 2, 1, 'If partners have kids, they have to be very cautious in their intimate life lest their children hear or see something that might affect them negatively when they grow up or may cause them psychological complexes.', '2019-03-13 16:42:02'),
(437, 2, 2, 1, 'A father\'s threat of cutting off his son\'s penis, even if it is just for kidding, will have bad psychological and sexual effects on the son and on his sexual orientation when he reaches puberty.', '2019-03-13 16:42:02'),
(438, 2, 2, 1, 'Daydreams are a way of sexual discharge for men and women alike. This happens especially if a person is living in a community that bans some sexual practices and makes it very difficult for a person to practice.', '2019-03-13 16:42:02'),
(439, 2, 2, 1, 'People with high sexual energy make a lot of sex that they may have excessive practices. But, this is quite normal as it is part of nature.', '2019-03-13 16:42:02'),
(440, 2, 2, 1, 'Some people may have excessive sex to prove they have sexual abilities and compensate for their shortages. However, such an excessive practice is an indication of a psychological ailment that needs a sexo-psychologist\'s consultation. You can see our sexperts to tell you more and help you get answers.', '2019-03-13 16:42:02'),
(441, 2, 2, 1, 'When a woman scratches her buttocks a lot, this is an indication of the state of worry she is undergoing.', '2019-03-13 16:42:02'),
(442, 2, 2, 1, 'The way preferred by a masochist female for defloration or having an intercourse is raping, as she is apt to psychological and physical humiliation during sex. This is a psychological ailment that needs follow-up of a sexpert.', '2019-03-13 16:42:02'),
(443, 2, 2, 1, 'Some men may suffer from impotency on their wedding day, which means inability to achieve a (prolonged) sexual erection during the intercourse. This may be attributed to fear of failure in sexual performance. Even married couples can have this due to psychological pressures. Therefore, if such a case occurs, couples should see a doctor, or they can contact our sexologist here in the application.', '2019-03-13 16:42:02'),
(444, 2, 2, 1, 'Some men may tend to withdraw their penis before ejaculation. This may affect a man or woman negatively, for it may cause some sexual disorders that could stand in the way of a woman for reaching orgasm, especially the vaginal type of woman. As for a man,withdrawing his penis before ejaculation could also lead to different problems he should not have. That is why he should see a sexologist, or our sexpert in this application.', '2019-03-13 16:42:02'),
(445, 2, 2, 1, 'Every person has a special sexual capability determined by their sexual imprint that comes by birth. This entails that every person should consider their partner\'s sexual imprint (SI). This could be known by submitting the SI Test in our application.', '2019-03-13 16:42:02'),
(446, 2, 2, 1, 'Having regular intercourse helps  man and woman to enjoy a sexually and hormonally stable life.', '2019-03-13 16:42:02'),
(447, 2, 2, 1, 'Some people exaggerate in having sex to compensate for an inferiority in their own personality and obtain a kind of respect they cannot obtain but through this method. This is usually not part of a person\'s nature, that is why they should see a sexologist.', '2019-03-13 16:42:02'),
(448, 2, 2, 1, 'Some people are sexually inactive or negative in the sense that they depend on the other in the sexual intercourse. They would like to be the obedient not the doer of action. This necessitates seeing a sexologist to end this situation.', '2019-03-13 16:42:02'),
(449, 2, 2, 1, 'Excessive sex, in men or women, has not structural reason and it is not an indication of psychological health, for in this case the person suffers from (nymphomania/excessive lust) that can never be satisfied. In fact, such a person needs to see a sexologist.', '2019-03-13 16:42:02'),
(450, 2, 2, 1, 'Husband and wife should not let their children see them having a sexual intercourse no matter how young the kids are, for this will cause them some psychological as well as sexual complexes that could govern their conduct. The child may hear their mother moaning and s/he may interpret it as pain, which will lead to sexual pleasure conditioned with pain.', '2019-03-13 16:42:02'),
(451, 2, 2, 1, 'Pleasure in a woman is a distinctive feeling which differs from female to another as concerns reaching orgasm and the ultimate feeling resulting. Some women may have gradual ascending pleasure while others may have ultimate pleasure which gets idle several times. Hence, you cannot tell of one type of reaching orgasm, but what is important is knowing the special fact about a woman in order for her man to be able to satisfy her. If he can\'t, he could seek the help of a sexpert.', '2019-03-13 16:42:02'),
(452, 2, 2, 1, 'If your female partner were sexually concupiscent, she must be a vaginal person and the pleasure concentrates in this zone. Therefore, you have to satisfy her and make her reach the ultimate pleasure taking into consideration that you should avoid the early ejaculation.', '2019-03-13 16:42:02'),
(453, 2, 2, 1, 'Tongue is a good pleasing organ for a lot of men and women. Therefore, a clitoral woman would love to have cunnilingus and may reach orgasm by this only.', '2019-03-13 16:42:02'),
(454, 2, 2, 1, 'During the menstruation, some hormonal changes affect a woman that they increase her sexual desire. She may be very sensitive during this period, but surely, the sexual intercourse would help stabilize her and alleviate her pains.', '2019-03-13 16:42:02'),
(455, 2, 2, 1, 'Some men may tend not to ejaculate completely, keeping, thus, some of the semen inside. They should take into consideration that this is really harmful and may lead to dysfunction of their sexual power or some diseases affecting the testicles.', '2019-03-13 16:42:02'),
(456, 2, 2, 1, 'One way a man finds pleasure in is his partner\'s sucking of his penis, ejaculating in her mouth and asking her to swallow his semen. This may enjoy him but it may also cause him weakness in the future as well as some illnesses because his semen does not get out completely.', '2019-03-13 16:42:02'),
(457, 2, 2, 1, 'After the sexual intercourse, a man is advised to pee as this helps him rid of the remaining semen and prevents it from getting inside, which will be a great help to avoid all the resultant illnesses.', '2019-03-13 16:42:02'),
(458, 2, 2, 1, 'A person suffering from onychophagia (nail biting) has a long history with masturbation and is a person suffering from unsatisfied sexual needs, which lead to sexual anxiety. Very often, such people are teenagers who should be thoroughly considered. The solution to this problem is the sexual practice itself or masturbation without feeling ashamed. All social illusions about masturbation should be removed or put aside.', '2019-03-13 16:42:02'),
(459, 2, 2, 1, 'If your partner\'s G-spot is the vagina, this means she has a high sensitivity in that area. Therefore, the bet position for her is lying on the man with having some movements forward and backward to ensure reaching orgasm in the best way possible.', '2019-03-13 16:42:02'),
(460, 2, 2, 1, 'Binge eating is an indication of unsatisfied sexual needs which a person resorts to as a symbolization of the absence of sexual satisfaction.', '2019-03-13 16:42:02'),
(461, 2, 2, 1, 'To increase pleasure, a woman can guide her partner to her pleasure zones indirectly by putting his hand there and alluding to him to caress them. This will inevitably make them reach greater sexual satisfaction.', '2019-03-13 16:42:02'),
(462, 2, 2, 1, 'Avoiding repressing sexual needs and desires is the way to avoid any psycho-sexual or neural diseases.', '2019-03-13 16:42:02'),
(463, 2, 2, 1, 'If you like anal sex, you have to be careful not to have vaginal sex after it as this may help transfer viruses from the anus to the vagina. The solution is by using a condom in the anus.', '2019-03-13 16:42:02'),
(464, 2, 2, 1, 'If you like biting and consider it as a sexual means of fondling, you have to know that there are two kinds of biting; biting for the sake of fondling and painful biting. Resorting to either kind depends on the nature of your partner, but you have to know you cannot force your partner to accept biting if it is not their nature.', '2019-03-13 16:42:02'),
(465, 2, 2, 1, 'To increase a woman\'s stimulation in a sexual relationship, her partner has to stroke her pleasure zones which he previously explored. This will increase the pleasure of both parties.', '2019-03-13 16:42:02'),
(466, 2, 2, 1, 'A man must not masturbate in front of his female partner, for this may upset her and offend her femininity. This might reach the extent of refusing to make love unless this woman is the type that likes shows.', '2019-03-13 16:42:02'),
(467, 2, 2, 1, 'Masturbation has the same effect as the sexual relationship as it helps produce endorphins that help alleviate pain. It also produces dopamine which helps a person relax. It should be noted; however, that resorting to masturbation only is improbable and it should be substituted with a real relationship with a partner.', '2019-03-13 16:42:02'),
(468, 2, 2, 1, 'A man who suffers from cardio diseases or low blood pressure, or whose male organ is hurt, must not use Viagra at all. ', '2019-03-13 16:42:02'),
(469, 2, 2, 1, 'For two people to be sexually attracted to each other, they should have the same pheromones which their bodies secrete as those pheromones are responsible for sexual attraction or non-attraction.', '2019-03-13 16:42:02'),
(470, 2, 2, 1, 'Sometimes a man may suffer from testicular  pain as a result of lack of sexual discharge. This pain comes in the form of muscular tension in the perineum, but it decreases after ejaculation. A woman may also feel this pain if she has long arousal without reaching orgasm.', '2019-03-13 16:42:02'),
(471, 2, 2, 1, 'A female who has pleasure connected with the clitoris may ask for foreplay centred on this part to reach orgasm. When she has masturbation, she would rub her clitoris even if she were married. This is not strange at all as she has a clitoral pleasure.', '2019-03-13 16:42:02'),
(472, 2, 2, 1, 'A homosexual person can almost have the same sensations of women when rubbing his breast. This is attributed to the sexual imprint that he gets at the mitosis stage when he got a high dosage of estrogen that led to this homosexuality.', '2019-03-13 16:42:02'),
(473, 2, 2, 1, 'Rare does a woman reach orgasm when she has sex with a man she does not love, so is a man. Therefore, love plays a very important role in any sexual relationship and make it sound and healthy.', '2019-03-13 16:42:02'),
(474, 2, 2, 1, 'Love making is far more alleviating than a lot of pain killers which lead to temporary alleviation sometimes and have a lot of side effects. Love making, on the other hand, is safe, a good pain killer, and has no side effects at all.', '2019-03-13 16:42:02'),
(475, 2, 2, 1, 'Lack of sexual desire can generally be associated with the type of relationship between partners. It may relate to psychological pressures, conflicts, partner\'s exaggerated demands which the other cannot meet or not eligible to meet, or problems connected with the sexual intercourse itself. ', '2019-03-13 16:42:02'),
(476, 2, 2, 1, 'Venereal diseases are wrongly believed to be transmitted through sexual intercourse only. However, the sexual intercourse is not about insertion only; it includes other activities, such as kissing, or cunnilingus, which makes it a must to have a periodical check for both partners.', '2019-03-13 16:42:02'),
(477, 2, 2, 1, 'It is necessary to turn everything off before starting any love making, such as TV, mobile, etc, as it may have bad effect on the female during the process.', '2019-03-13 16:42:02'),
(478, 2, 2, 1, 'A man should know that there are different pleasure zones in a female that need to be discovered thoroughly. Therefore, he should not focus on a special point, he should search for the points that bring his female the ultimate ecstasy.', '2019-03-13 16:42:02'),
(479, 2, 2, 1, 'After ejaculation, a man needs to rest and withdraw; this is quite natural for him but inacceptable by a woman. Therefore, there should be a full understanding of this issue and a prior agreement on reaching a compromise. He does not withdraw completely and she does not take it personally. ', '2019-03-13 16:42:02'),
(480, 2, 2, 1, 'As most females have a powerful sense of smelling, their partner has to be clean all over, and the smell of his body and breath should be fragrant before they go into any sexual practice, for this means a lot for a female.', '2019-03-13 16:42:02'),
(481, 2, 2, 1, 'Some men might think that every touch should lead to having sex at the end, but this is entirely untrue, for some women like to have emotional touches at special periods. Therefore, they should not feel forced to do what they do not want.', '2019-03-13 16:42:02'),
(482, 2, 2, 1, 'To relieve himself from pressures, a man resorts to food or love-making, as this has the ability to balance his mood. His partner has to know this fact and act accordingly as it is part of his masculine brain nature.', '2019-03-13 16:42:02'),
(483, 2, 2, 1, 'Some of the mistakes women commit could manifest in the plastic surgeries they undergo with the aim of augmentation mammoplasty (breast augmentation) or reduction of vagina opening. This is because, in most cases, the sexual pleasure declines to a great extent after such surgeries.', '2019-03-13 16:42:02'),
(484, 2, 2, 1, 'A man should take into consideration that every woman has a special G-spot in a different part of her body. This makes it necessary for him to know this spot in his female to be able to satisfy all her needs.', '2019-03-13 16:42:02'),
(485, 2, 2, 1, 'Masturbation is recommended as a helping factor in attaining changes in a person\'s sexual tendency through what psychology calls (conditioning), or as a treatment of premature ejaculation and some cases of sexual frigidity in females.', '2019-03-13 16:42:02'),
(486, 2, 2, 1, 'A female reaching a number of orgasms in a sexual intercourse or during masturbation is an exceptional one. Such females comprise 2.5% of all women in the world. She should not feel she is a patient. She only needs a particular type of partners.', '2019-03-13 16:42:02'),
(487, 2, 2, 1, 'A man who suffers from lack of erection at special cases (temporary impotence) may believe his cure of this situation could be attributed to taking pushing pills (aphrodisiac), exercise or relaxation. In fact, if he could overcome the emotional crisis he is undergoing and could see into his problem and know the essence that caused his premonitions, he could easily recover. Consulting a sexpert (sexologist) is also another good choice.', '2019-03-13 16:42:02'),
(488, 2, 2, 1, 'The sexual intercourse should be a comprehensive process, which entails caring for what the partner likes. One partner may have sexual fantasies whereas the other may not. This makes it necessary for partners to test their compatibility before they decide to be really engaged even though such testing can be cognitive and openly frank.', '2019-03-13 16:42:02'),
(489, 2, 2, 1, 'Every person has their distinctive sexual needs and nature which differ from others. Some people have limited sexual potential while others can enjoy quite a massive energy and have, consequently, concupiscent needs. Therefore, only sexperts can fully understand her nature and her sexual needs, as well.', '2019-03-13 16:42:02'),
(490, 2, 2, 1, 'Some woman make up problems with their partners to attract their attention and get their caring. Or this may be a reason to be daddled and pampered by making love with them. This kind of women is not only masochist but also sexually concupiscent; however, this does not apply to all women.', '2019-03-13 16:42:02'),
(491, 2, 2, 1, 'Some cultures concentrate on the male organ all through the upbringing process. This, however, has a lot of psychological indications, one of which is considering the male organ as a symbol of power. This is, in fact, nothing but an attempt to overcome the Oedipus complex but still it bears other deep psychological indications.', '2019-03-13 16:42:02'),
(492, 2, 2, 1, '(Sex) is what we all see externally, but (gender) is what a person feels deep inside; i.e., if they are a male or female. Matching between (sex) and (gender) is very important for anyone to be able to enjoy a normal sexual life.', '2019-03-13 16:42:02'),
(493, 2, 2, 1, 'Most psychological disorders are accompanied with lack of sexual desire or ability. Similarly, if sexual disorders are not treated, they may be a reason for psychological disorders.', '2019-03-13 16:42:02'),
(494, 2, 2, 1, 'If a woman cannot reach orgasm, she should discover the pleasure zones of her own body. This comes by practice, so she could try to discover whether she is clitoral, vaginal or anal, or combines two kinds or all of them.', '2019-03-13 16:42:02'),
(495, 2, 2, 1, 'Most cases of sexual frigidity come as a result of a shock or a failing relationship. Therefore, those who suffer from sexual frigidity are advised to see a sexo-psychologist after negating all organic reasons, as this is part and parcel of such an expert\'s job.', '2019-03-13 16:42:02'),
(496, 2, 2, 1, 'Those who suffer from premature ejaculation are advised to train on lengthening the period of erection. This can be achieved by asking the female to stop any action when he nears ejaculation, and to repeat this three or four times. He can also choose some suitable positions that could lessen the sensitivity of the male organ, such as the woman-on-top position.', '2019-03-13 16:42:02'),
(497, 2, 2, 1, 'The psychological condition of a pregnant woman will help her to-be-born child grow sexually healthy. That is why she is highly recommended to consider this point.', '2019-03-13 16:42:02'),
(498, 2, 2, 1, 'It is necessary to respect each other\'s sexual desires and consider your partner\'s demands as a natural need that should be met.', '2019-03-13 16:42:02'),
(499, 2, 2, 1, 'Parents have to protect their children\'s future sexual life by ensuring that they do not see their parents or hear them during the sexual intercourse, for this might affect them psychologically.', '2019-03-13 16:42:02'),
(500, 2, 2, 1, 'Partners have to talk openly about the sense of guilt, disappointment or shyness. More importantly, they have to talk about their sexual desires lest they are repressed and turn to be a real sexual crisis between them.', '2019-03-13 16:42:02'),
(501, 2, 2, 1, 'Partners are advised to part for a short while as a way to treat the sexual frigidity they are suffering from. However, this can be overcome also by creating new ambiances away from any daily routine.', '2019-03-13 16:42:02'),
(502, 2, 2, 1, 'You should not follow your teen to catch them masturbating because they have their own sexual privacy which they like not to be violated, like anyone else.', '2019-03-13 16:42:02'),
(503, 2, 2, 1, 'It is necessary to give the scientific sexual explanation that is most appropriate for your child\'s  age if you want them to grow sexually healthy. A child, for example, may still think ', '2019-03-13 16:42:02'),
(504, 2, 2, 1, 'Being sexually conservative when raising a child up will not have any good results; it will only lead to sexual and psychological illnesses that makes it necessary to get the help of a sexo-psychologist.', '2019-03-13 16:42:02'),
(505, 2, 2, 1, 'Not all women are alike in the number of orgasms they reach or in the way they reach orgasm. That is why we advise every person to understand their partner\'s needs and never compare them to anyone else or to any experience they had before.', '2019-03-13 16:42:02'),
(506, 2, 2, 1, 'Caring for hygiene is an important factor in the sexual intercourse. Therefore, a man should not withdraw his penis from the anus to insert it in his female\'s vagina, for this harms herhealth-wise.', '2019-03-13 16:42:02'),
(507, 2, 2, 1, 'The sexual hypofunction can mostly be attributed to psychological reasons, therefore, it is not shameful to seek the help of a sexo-psychologist to solve this problem.', '2019-03-13 16:42:02'),
(508, 2, 2, 1, 'One reason for sadomasochism is the conditional link between love and punishment. Therefore, parents have to pay much attention to this point when they deal with their sons and daughters.', '2019-03-13 16:42:02'),
(509, 2, 2, 1, 'It is advised not to hit children on their derrieres lest hitting on this area stimulates homosexualtendencies as this act can increase the sexual sensitivity in this area.', '2019-03-13 16:42:02'),
(510, 2, 2, 1, 'Children of either gender should be oriented towards accepting the physical differences between them and showing those differences at an early age but without any bias or preference to one gender.', '2019-03-13 16:42:02'),
(511, 2, 2, 1, 'The anatomical structure of the reproductivesystem of males and females scientifically before having a sexual intercourse, as this may protect them both from any illusion.', '2019-03-13 16:42:02'),
(512, 2, 2, 1, 'The inability to cope with the sexual relationship due to special demands of your partner, the other has either to accept the relationship as it is or abandon it entirely.', '2019-03-13 16:42:02'),
(513, 2, 2, 1, 'A sexual intercourse does not end with a woman\'s reaching orgasm; therefore, a man has to consider that and follow the sexual intercourse with hugging and caressing.', '2019-03-13 16:42:02'),
(514, 2, 2, 1, 'During a sexual intercourse, it is necessary to change positions and not be restricted to traditional positions in order not to let boredom penetrate this relationship. ', '2019-03-13 16:42:02'),
(515, 2, 2, 1, 'We, grown-ups, have to let our children discover their own selves, their reproductive organs in particular, without clashes or negative advice, if we really care to let them grow sexually healthy.', '2019-03-13 16:42:02'),
(516, 2, 2, 1, 'To treat sexual malfunction, a man has to try to release all psychological pressures by reaching swift and serious solution as such pressures have the ability to lead to ED; erectile dysfunction.', '2019-03-13 16:42:02'),
(517, 2, 2, 1, 'Excessive sexual practices is not harmful at all. Rather, it is very healthy and helps prolong one\'s life.', '2019-03-13 16:42:02'),
(518, 2, 2, 1, 'It is necessary to correct all misunderstood preconceptions about a sexual relationship and not connecting it to dignity or insulting a woman.', '2019-03-13 16:42:02'),
(519, 2, 2, 1, 'If your partner has a special sexual type they follow to reach orgasm, this does not mean they have behavioral deviation as this issue is attributed to the sexual imprint of this person, which you could know by taking the sexual test in our application.', '2019-03-13 16:42:02'),
(520, 2, 2, 1, 'It is a common mistake among people that pleasure and reaching orgasm – for a woman – during the sexual intercourse can only go through her vagina. This, in fact, depends on her pleasure zones, which differ from one woman to another. That is why generalization is a big mistake.', '2019-03-13 16:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `app_tips_category`
--

DROP TABLE IF EXISTS `app_tips_category`;
CREATE TABLE IF NOT EXISTS `app_tips_category` (
  `tcat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `tcat_name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Name',
  PRIMARY KEY (`tcat_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_tips_category`
--

INSERT INTO `app_tips_category` (`tcat_id`, `status_id`, `tcat_name`) VALUES
(1, 1, 'Free'),
(2, 1, 'Paid');

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_vbook`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `app_vbook`;
CREATE TABLE IF NOT EXISTS `app_vbook` (
`book_id` int(11)
,`lang_id` int(11)
,`status_id` tinyint(4)
,`book_title` varchar(200)
,`book_desc` mediumtext
,`book_image` char(150)
,`book_price` decimal(10,2)
,`ins_datetime` timestamp
,`bpage_id` int(11)
,`page_num` smallint(6)
,`page_image` varchar(200)
,`page_text` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_vcons_cat`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `app_vcons_cat`;
CREATE TABLE IF NOT EXISTS `app_vcons_cat` (
`cat_id` int(11)
,`cat_order` tinyint(4)
,`cat_iname` varchar(200)
,`status_id` tinyint(4)
,`cat_price` decimal(10,2)
,`ncat_id` int(11)
,`lang_id` int(11)
,`cat_name` varchar(200)
,`cat_desc` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_vtest`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `app_vtest`;
CREATE TABLE IF NOT EXISTS `app_vtest` (
`test_id` int(11)
,`test_num` tinyint(4)
,`test_iname` varchar(200)
,`status_id` tinyint(4)
,`test_price` decimal(6,2)
,`test_image` varchar(50)
,`ntest_id` int(11)
,`lang_id` int(11)
,`test_name` varchar(200)
,`test_desc` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_vtest_evaluate`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `app_vtest_evaluate`;
CREATE TABLE IF NOT EXISTS `app_vtest_evaluate` (
`test_id` int(11)
,`test_num` tinyint(4)
,`test_iname` varchar(200)
,`status_id` tinyint(4)
,`test_price` decimal(6,2)
,`test_image` varchar(50)
,`ntest_id` int(11)
,`lang_id` int(11)
,`test_name` varchar(200)
,`test_desc` text
,`eval_id` int(11)
,`gend_id` tinyint(4)
,`eval_from` decimal(10,0)
,`eval_to` decimal(10,0)
,`eval_text` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_vtest_question`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `app_vtest_question`;
CREATE TABLE IF NOT EXISTS `app_vtest_question` (
`test_id` int(11)
,`test_num` tinyint(4)
,`test_iname` varchar(200)
,`status_id` tinyint(4)
,`test_price` decimal(6,2)
,`test_image` varchar(50)
,`ntest_id` int(11)
,`lang_id` int(11)
,`test_name` varchar(200)
,`test_desc` text
,`qstn_id` int(11)
,`gend_id` tinyint(4)
,`qstn_num` tinyint(4)
,`qstn_text` varchar(500)
,`qstn_ansr1` varchar(500)
,`qstn_ansr2` varchar(500)
,`qstn_ansr3` varchar(500)
,`qstn_ansr4` varchar(500)
,`qstn_rep1` varchar(500)
,`qstn_rep2` varchar(500)
,`qstn_rep3` varchar(500)
,`qstn_rep4` varchar(500)
,`qstn_val1` decimal(6,2)
,`qstn_val2` decimal(6,2)
,`qstn_val3` decimal(6,2)
,`qstn_val4` decimal(6,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_ads`
--

DROP TABLE IF EXISTS `cpy_ads`;
CREATE TABLE IF NOT EXISTS `cpy_ads` (
  `ads_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Status',
  `repeat_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Repeat',
  `every_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Every',
  `ads_title` varchar(200) NOT NULL COMMENT 'Title',
  `ads_desc` varchar(200) NOT NULL COMMENT 'Description',
  `ads_text` mediumtext COMMENT 'Text',
  `ads_image` varchar(200) DEFAULT NULL COMMENT 'Image',
  `ads_sdate` date NOT NULL COMMENT 'Start Date',
  `ads_edate` date NOT NULL COMMENT 'End Date',
  `hour_sid` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Start Hour',
  `hour_eid` tinyint(4) NOT NULL DEFAULT '23' COMMENT 'End Hour',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`ads_id`),
  KEY `repeat_id` (`repeat_id`),
  KEY `every_id` (`every_id`),
  KEY `ads_status` (`status_id`),
  KEY `ads_shour` (`hour_sid`),
  KEY `ads_ehour` (`hour_eid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_ads`
--

INSERT INTO `cpy_ads` (`ads_id`, `status_id`, `repeat_id`, `every_id`, `ads_title`, `ads_desc`, `ads_text`, `ads_image`, `ads_sdate`, `ads_edate`, `hour_sid`, `hour_eid`, `ins_datetime`) VALUES
(1, 1, 2, 1, 'Test Ads', 'Bla Bla Bla Bla Bla Bla Bla Bla', 'Bla Bla Bla Bla Bla Bla Bla Bla', 'img01.jpg', '2019-01-01', '2025-12-31', 24, 23, '2019-03-23 15:07:07'),
(2, 1, 2, 1, 'Test Ads', 'Bla Bla Bla Bla Bla Bla Bla Bla', 'Bla Bla Bla Bla Bla Bla Bla Bla', 'img02.jpg', '2019-01-01', '2025-12-31', 24, 23, '2019-03-23 15:07:07'),
(3, 1, 2, 1, 'Test Ads', 'Bla Bla Bla Bla Bla Bla Bla Bla', 'Bla Bla Bla Bla Bla Bla Bla BlaBla Bla Bla Bla Bla Bla Bla Bla', 'img03.jpg', '2019-01-01', '2025-12-31', 24, 23, '2019-03-23 15:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_faq`
--

DROP TABLE IF EXISTS `cpy_faq`;
CREATE TABLE IF NOT EXISTS `cpy_faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `fcat_id` int(11) NOT NULL COMMENT 'Category',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `lang_id` int(11) NOT NULL COMMENT 'Language',
  `color_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Color',
  `faq_order` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Order',
  `faq_title` varchar(200) NOT NULL COMMENT 'Title',
  `faq_text` text NOT NULL COMMENT 'Text',
  PRIMARY KEY (`faq_id`),
  UNIQUE KEY `fcat_id_2` (`fcat_id`,`lang_id`,`faq_title`),
  KEY `fcat_id` (`fcat_id`),
  KEY `color_id` (`color_id`),
  KEY `lang_id` (`lang_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_faq`
--

INSERT INTO `cpy_faq` (`faq_id`, `fcat_id`, `status_id`, `lang_id`, `color_id`, `faq_order`, `faq_title`, `faq_text`) VALUES
(1, 1, 1, 2, 0, 1, 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? ', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS. '),
(2, 1, 1, 2, 0, 2, 'Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? ', 'Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS. '),
(3, 1, 1, 2, 0, 3, 'Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? ', '3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et '),
(4, 2, 1, 1, 0, 0, 'مابعرف شو', '<p>ملامبيستالمباليبلامبتل</p>\r\n\r\n<p>بتنلامسبتلم</p>\r\n\r\n<p>تنامنتالمسب</p>\r\n\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_faq_category`
--

DROP TABLE IF EXISTS `cpy_faq_category`;
CREATE TABLE IF NOT EXISTS `cpy_faq_category` (
  `fcat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `fcat_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Order',
  `fcat_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`fcat_id`),
  UNIQUE KEY `fcat_name` (`fcat_name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_faq_category`
--

INSERT INTO `cpy_faq_category` (`fcat_id`, `status_id`, `fcat_order`, `fcat_name`) VALUES
(1, 1, 1, 'General'),
(2, 1, 2, 'Membership'),
(3, 1, 3, 'Terms Of Service'),
(4, 1, 4, 'License Terms'),
(5, 1, 5, 'Payment Rules');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_news`
--

DROP TABLE IF EXISTS `cpy_news`;
CREATE TABLE IF NOT EXISTS `cpy_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `news_date` date NOT NULL COMMENT 'News Date',
  `news_image` varchar(200) NOT NULL COMMENT 'News Cover Image',
  `news_title` varchar(200) NOT NULL COMMENT 'News Title',
  `news_stext` text COMMENT 'Search Text',
  `news_text` text COMMENT 'Text',
  PRIMARY KEY (`news_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cpy_news_images`
--

DROP TABLE IF EXISTS `cpy_news_images`;
CREATE TABLE IF NOT EXISTS `cpy_news_images` (
  `nimg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `news_id` int(11) NOT NULL COMMENT 'Parent',
  `nimg_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Image Order',
  `nimg_photo` varchar(200) NOT NULL COMMENT 'Image',
  PRIMARY KEY (`nimg_id`),
  KEY `news_id` (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cpy_page`
--

DROP TABLE IF EXISTS `cpy_page`;
CREATE TABLE IF NOT EXISTS `cpy_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `slid_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Slider FK',
  `page_name` varchar(200) NOT NULL COMMENT 'Name',
  `page_stext` text COMMENT 'Search Text',
  `page_desc` text COMMENT 'Description',
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `page_name` (`page_name`),
  KEY `slid_id` (`slid_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_page`
--

INSERT INTO `cpy_page` (`page_id`, `status_id`, `slid_id`, `page_name`, `page_stext`, `page_desc`) VALUES
(0, 1, 0, 'No Page', 'No Page', '<p>No Page</p>'),
(1, 1, 1, 'Home Page', 'Home Page', 'Home Page'),
(2, 1, 0, 'About Page', 'About Page', '<p>About Page</p>'),
(3, 1, 0, 'Get Application', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_page_row`
--

DROP TABLE IF EXISTS `cpy_page_row`;
CREATE TABLE IF NOT EXISTS `cpy_page_row` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `page_id` int(11) NOT NULL COMMENT 'Page FK',
  `lang_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Language FK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `color_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Background Color',
  `slid_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Slider',
  `row_order` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Order',
  `row_name` varchar(200) NOT NULL COMMENT 'Name',
  `row_stext` text COMMENT 'Search Text',
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `page_id_2` (`page_id`,`lang_id`,`row_name`),
  KEY `status_id` (`status_id`),
  KEY `color_id` (`color_id`),
  KEY `slid_id` (`slid_id`),
  KEY `lang_id` (`lang_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_page_row`
--

INSERT INTO `cpy_page_row` (`row_id`, `page_id`, `lang_id`, `status_id`, `color_id`, `slid_id`, `row_order`, `row_name`, `row_stext`) VALUES
(0, 1, 2, 1, 0, 0, 2, 'Tip of the day', NULL),
(1, 1, 2, 1, 0, 0, 1, 'Describe Services', NULL),
(2, 1, 2, 1, 0, 2, 3, 'Our Services', NULL),
(3, 2, 2, 1, 0, 0, 1, 'English - About Us', NULL),
(4, 2, 2, 1, 0, 0, 2, 'English - About Us Details', NULL),
(5, 2, 1, 1, 0, 0, 3, 'Arabic - About Us', NULL),
(6, 2, 1, 1, 0, 0, 4, 'Arabic - About Us Details', NULL),
(7, 3, 2, 1, 0, 0, 1, 'Get Application 01', NULL),
(8, 3, 1, 1, 0, 0, 1, 'Get Application 01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_page_row_block`
--

DROP TABLE IF EXISTS `cpy_page_row_block`;
CREATE TABLE IF NOT EXISTS `cpy_page_row_block` (
  `blk_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `row_id` int(11) NOT NULL COMMENT 'Row FK',
  `type_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Type',
  `slid_id` int(11) NOT NULL COMMENT 'Slider',
  `video_id` int(11) NOT NULL COMMENT 'Video',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `cols_id` tinyint(4) NOT NULL DEFAULT '12' COMMENT 'Columns',
  `blk_order` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Order',
  `blk_name` varchar(200) NOT NULL COMMENT 'Name',
  `blk_header` varchar(200) DEFAULT NULL COMMENT 'Header',
  `blk_image` varchar(200) DEFAULT NULL COMMENT 'Image',
  `blk_text` text COMMENT 'Text',
  `blk_stext` text COMMENT 'Search Text',
  PRIMARY KEY (`blk_id`),
  UNIQUE KEY `blk_name` (`row_id`,`blk_name`),
  KEY `type_id` (`type_id`),
  KEY `status_id` (`status_id`),
  KEY `col_id` (`cols_id`),
  KEY `slid_id` (`slid_id`),
  KEY `video_id` (`video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_page_row_block`
--

INSERT INTO `cpy_page_row_block` (`blk_id`, `row_id`, `type_id`, `slid_id`, `video_id`, `status_id`, `cols_id`, `blk_order`, `blk_name`, `blk_header`, `blk_image`, `blk_text`, `blk_stext`) VALUES
(3, 1, 1, 2, 0, 1, 3, 2, 'Why Eve and Adam (Sexual Imprint)?', 'Why Eve and Adam', NULL, 'Eve and Adam is the first sexual dating site that aims at introducing potential partners to one another based on our latest scientific, psychological and sexual research. With our site, you can take the Sexual Imprint Test (SI). It is our distinctive test which distinguishes us from others and reveals the sexual nature which people already have.', NULL),
(4, 1, 1, 0, 0, 1, 3, 3, 'How to Get Our Distinguished Services', 'Our Distinguished Services', NULL, 'The site offers subscribers a range of services which include sexual counseling, daily tips and books for sale. As for sexual counseling, any subscriber can ask for a sexual advice after logging in, clicking on (services). Our counselors are going to receive requests and send a reply. They are available 24/7 and would respond soon.', NULL),
(5, 1, 1, 0, 0, 1, 3, 4, 'Our distinctive Test:', 'Our distinctive Test', NULL, 'Our distinctive test is the Sexual Imprint Test (SI Test) which identifies the sexual nature attributed to the subthalamus and the hippocampus. We do not want to engage subscribers in the scientific part but we will allow them the access to our miscellaneous questions.', NULL),
(6, 1, 1, 0, 0, 1, 3, 5, 'How to Get the Perfect Match:', 'How to Get the Perfect Match', NULL, 'Subscribers of Eve & Adam (Sexual Imprint) can take the main test of the site (SI), which determines their sexual nature. the results of this test can be the base upon which we find them the perfect sexual match. We display a number of potential partners from whom a subscriber can choose.', NULL),
(8, 0, 6, 2, 0, 1, 12, 0, 'Tip of the day', 'Tip of the day', NULL, '<p>Tips</p>', NULL),
(10, 3, 1, 2, 0, 1, 8, 1, 'About US', NULL, NULL, '<div class=\"col-12\" style=\"text-align: left\"><h1>About US</h1></div>', NULL),
(13, 4, 1, 2, 0, 1, 9, 1, 'About US Details', NULL, NULL, '<div class=\"col-12\" style=\"text-align: left\"><p>\r\n                We are a scientific and psychological institution that offers dating services in a distinguished way based on the latest studies and research in the respective fields.\r\n                <br>\r\n                <br>\r\n                We offer to find our subscribers the right match in a systematic way, following deliberate methods based on emotional and sexual compatibility. Subscribers could reach this end by taking our innovative tests specially conducted for this purpose.\r\n                <br>\r\n                <br>\r\n                Our distinctive tests show the masculinity or femininity of the brain, and reveal the emotional and sexual natures of our subscribers. An EQ test is offered for free for all; registered visitors who could be potential subscribers, or real subscribers.\r\n                <br>\r\n                <br>\r\n                We aim at finding our subscribers the appropriate match to help them lead a happy emotional and sexual life.\r\n                <br>\r\n                The Eve & Adam Team\r\n              </p>\r\n</div>', NULL),
(14, 4, 9, 2, 0, 1, 3, 2, 'About US Video', 'Our Contacts', NULL, NULL, NULL),
(15, 5, 1, 0, 0, 1, 12, 1, 'About US', NULL, NULL, '<div class=\"col-12\" dir=\"rtl\" style=\"text-align:right\">\r\n<h1 style=\"text-align:justify\">من نحن</h1>\r\n</div>', NULL),
(16, 6, 7, 0, 2, 1, 3, 2, 'About US Video', NULL, NULL, NULL, NULL),
(17, 6, 1, 0, 0, 1, 9, 1, 'About US', NULL, NULL, '<div class=\"ae-about\">\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:20px\"><span style=\"font-family:times new roman,times,serif\">نحن مؤسسة علمية نفسية تقدم خدمات التعارف بين الأشخاص الراغبين بذلك، ولكن بأسلوب متميز عن غيرنا. فنحن نعرف المشتركين على من يناسبهم من الأشخاص بناء على أسس علمية ونفسية بالاستناد إلى التوافقات العاطفية (والجنسية) بينهم، وذلك عن طريق الاختبارات الابتكارية التي نقدمها بشكل متفرد والتي تتمثل باختبار ذكورة أو أنوثة المخ، واختبار الطبيعة العاطفية (واختبار الطبيعة الجنسية)، إضافة إلى اختبار الذكاء الوجداني المجاني.&nbsp;هدفنا هو إيجاد توافقات مدروسة للوصول إلى علاقات هانئة ودائمة.</span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:20px\"><span style=\"font-family:times new roman,times,serif\">فريق موقع حواء وآدم</span></span></p>\r\n</div>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>', NULL),
(18, 7, 1, 0, 0, 1, 12, 1, 'Get Application 01', 'Get Application', NULL, '<br/><br/><br/><br/><br/>', NULL),
(19, 2, 3, 2, 0, 1, 12, 1, 'Our services', NULL, NULL, NULL, NULL),
(20, 7, 10, 0, 0, 1, 4, 2, 'Get Application 02', 'Web Application', NULL, NULL, NULL),
(22, 7, 10, 0, 0, 1, 4, 3, 'Get Application 03', 'Android App', NULL, NULL, NULL),
(23, 7, 10, 0, 0, 1, 4, 4, 'Get Application 04', 'Apple App', NULL, NULL, NULL),
(24, 8, 1, 0, 0, 1, 12, 1, 'Get Application 01', 'Get Application', NULL, '<br/><br/><br/><br/><br/>', NULL),
(25, 8, 10, 0, 0, 1, 4, 2, 'Get Application 02', 'Web Application', NULL, NULL, NULL),
(26, 8, 10, 0, 0, 1, 4, 3, 'Get Application 03', 'Android App', NULL, NULL, NULL),
(27, 8, 10, 0, 0, 1, 4, 4, 'Get Application 04', 'Apple App', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_pgroup`
--

DROP TABLE IF EXISTS `cpy_pgroup`;
CREATE TABLE IF NOT EXISTS `cpy_pgroup` (
  `pgrp_id` int(10) NOT NULL COMMENT 'PK',
  `pgrp_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`pgrp_id`),
  UNIQUE KEY `pgrp_name` (`pgrp_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_pgroup`
--

INSERT INTO `cpy_pgroup` (`pgrp_id`, `pgrp_name`) VALUES
(-1, 'Administrators'),
(0, 'Consultant'),
(1, 'Members');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_slider_mst`
--

DROP TABLE IF EXISTS `cpy_slider_mst`;
CREATE TABLE IF NOT EXISTS `cpy_slider_mst` (
  `slid_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `slid_name` varchar(200) NOT NULL COMMENT 'Slider Name',
  `slid_rem` varchar(200) DEFAULT NULL COMMENT 'Slider Remark',
  `stype_id` tinyint(4) NOT NULL DEFAULT '1',
  `scols_id` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`slid_id`),
  KEY `scols_id` (`scols_id`),
  KEY `stype_id` (`stype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_slider_mst`
--

INSERT INTO `cpy_slider_mst` (`slid_id`, `slid_name`, `slid_rem`, `stype_id`, `scols_id`) VALUES
(0, 'No Slider', 'No Slider', 1, 1),
(1, 'Main Slider', 'Main Slider', 1, 1),
(2, 'Services Slider', 'Services Slider', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_slider_trn`
--

DROP TABLE IF EXISTS `cpy_slider_trn`;
CREATE TABLE IF NOT EXISTS `cpy_slider_trn` (
  `tslid_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `slid_id` int(11) NOT NULL COMMENT 'Parent',
  `slid_order` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Slide Order',
  `slid_header` varchar(200) DEFAULT NULL COMMENT 'Header',
  `slid_link` varchar(200) DEFAULT NULL COMMENT 'Link',
  `slid_label` varchar(200) DEFAULT NULL COMMENT 'Link Label',
  `slid_text` text COMMENT 'Text',
  `slid_photo` varchar(200) NOT NULL COMMENT 'Image',
  PRIMARY KEY (`tslid_id`),
  KEY `slid_id` (`slid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_slider_trn`
--

INSERT INTO `cpy_slider_trn` (`tslid_id`, `slid_id`, `slid_order`, `slid_header`, `slid_link`, `slid_label`, `slid_text`, `slid_photo`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, 'bg05.jpg'),
(2, 1, 2, NULL, NULL, NULL, NULL, 'bg06.jpg'),
(3, 1, 3, NULL, NULL, NULL, NULL, 'bg07.jpg'),
(4, 2, 1, 'Project 1', 'm=101', NULL, '<p>Name of Project</p>', 'img1.jpg'),
(5, 2, 2, 'Project 2', 'm=102', NULL, '<p>Name of Project</p>', 'img2.jpg'),
(6, 2, 3, 'Project 3', 'm=103', NULL, '<p>Name of Project</p>', 'img3.jpg'),
(7, 2, 4, 'Project 4', 'm=104', NULL, '<p>Name of Project</p>', 'img4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_team`
--

DROP TABLE IF EXISTS `cpy_team`;
CREATE TABLE IF NOT EXISTS `cpy_team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_iname` varchar(100) NOT NULL,
  `team_order` smallint(6) NOT NULL DEFAULT '0',
  `team_photo` varchar(255) NOT NULL,
  PRIMARY KEY (`team_id`),
  UNIQUE KEY `team_iname` (`team_iname`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_team`
--

INSERT INTO `cpy_team` (`team_id`, `team_iname`, `team_order`, `team_photo`) VALUES
(1, 'Haytham Mahmoud', 1, 'Haytham.jpg'),
(2, 'Nart Jatkar', 2, 'Nart.jpg'),
(3, 'Ahed Hafez', 3, 'Ahed.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_team_names`
--

DROP TABLE IF EXISTS `cpy_team_names`;
CREATE TABLE IF NOT EXISTS `cpy_team_names` (
  `teamn_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `team_title` varchar(10) NOT NULL,
  `team_position` varchar(50) NOT NULL,
  `team_text` text,
  PRIMARY KEY (`teamn_id`),
  UNIQUE KEY `team_uk` (`team_id`,`lang_id`),
  KEY `team_id` (`team_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_team_names`
--

INSERT INTO `cpy_team_names` (`teamn_id`, `team_id`, `lang_id`, `team_name`, `team_title`, `team_position`, `team_text`) VALUES
(1, 1, 1, 'هيثم محمود', '.', 'مؤسس، محلل نظم', NULL),
(2, 1, 2, 'Haytham Mahmoud', '.', 'Founder, System Analyzer', NULL),
(3, 2, 1, 'نارت جتكر', '.', 'مؤسس، المدير التنفيذي', NULL),
(4, 2, 2, 'Nart Jatkar', '.', 'Co-Founder, CEO', NULL),
(5, 3, 1, 'عهد حافظ', '.', 'مدير الدعم الفني', NULL),
(6, 3, 2, 'Ahed Hafez', '.', 'Support Manager', NULL),
(7, 4, 1, 'البروز أباظة', '.', 'مصمم', NULL),
(8, 4, 2, 'Elbrus Abaza', '.', 'Designer', NULL),
(9, 5, 1, 'ساوزر أمين', '.', 'مصمم واجهات تخاطب', NULL),
(10, 5, 2, 'Saozar Ameen', '.', 'UI/UX Designer', NULL),
(11, 6, 1, 'جانتي محمود', '.', 'الدعم الفني', NULL),
(12, 6, 2, 'Janty Mahmoud', '.', 'Support Team', NULL),
(13, 7, 1, 'سلوى شتوقة', '.', 'مصمم', NULL),
(14, 7, 2, 'Salwa Shatoka', '.', 'Graphic Designer', NULL),
(15, 8, 1, 'محمد صبحي حاج شحود', '.', 'مطور', NULL),
(16, 8, 2, 'Mhmd Subhy HajShahoud', '.', 'Developer', NULL),
(17, 10, 1, 'أمجد الورع', '.', 'مطور', NULL),
(18, 10, 2, 'Amjad Alwareh', '.', 'Developer', NULL),
(19, 9, 1, 'سعيد سليمان', '.', 'مصمم واجهات تخاطب', NULL),
(20, 9, 2, 'Saied Suliman', '.', 'UI/UX Designer', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_user`
--

DROP TABLE IF EXISTS `cpy_user`;
CREATE TABLE IF NOT EXISTS `cpy_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `cntry_id` int(11) NOT NULL COMMENT 'Country',
  `lang_id` int(11) NOT NULL COMMENT 'Language',
  `pgrp_id` int(11) NOT NULL DEFAULT '1' COMMENT ' Type',
  `status_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Status',
  `gend_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Gender',
  `user_name` varchar(200) NOT NULL COMMENT 'Name',
  `user_email` varchar(200) NOT NULL COMMENT 'Email, Logon Name, UK',
  `user_password` varchar(200) NOT NULL COMMENT 'Passowrd',
  `user_mobile` varchar(200) DEFAULT NULL COMMENT 'Mobile Number',
  `user_token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `ins_datetime` timestamp NULL DEFAULT NULL COMMENT 'Created datetime',
  `upd_datetime` timestamp NULL DEFAULT NULL COMMENT 'Last Updated Datetime',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_token` (`user_token`),
  KEY `cntry_id` (`cntry_id`),
  KEY `lang_id` (`lang_id`),
  KEY `user_type` (`pgrp_id`),
  KEY `user_Status` (`status_id`),
  KEY `user_gender` (`gend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_user`
--

INSERT INTO `cpy_user` (`user_id`, `cntry_id`, `lang_id`, `pgrp_id`, `status_id`, `gend_id`, `user_name`, `user_email`, `user_password`, `user_mobile`, `user_token`, `ins_datetime`, `upd_datetime`) VALUES
(1, 213, 2, -1, 1, 1, 'Administrator', 'admin@doctorx.cc', '123456', NULL, NULL, '2018-12-22 15:48:37', NULL),
(2, 213, 2, 0, 1, 2, 'Dr Hala', 'hala@doctorx.cc', '123456', NULL, NULL, '2018-12-22 15:50:30', '2018-12-22 15:51:35'),
(3, 213, 2, -1, 1, 2, 'Dr Hala', 'smart.hala@doctorx.cc', '123456', NULL, NULL, '2018-12-22 15:50:30', '2018-12-22 15:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_video`
--

DROP TABLE IF EXISTS `cpy_video`;
CREATE TABLE IF NOT EXISTS `cpy_video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `video_name` varchar(200) NOT NULL COMMENT 'Name',
  `video_URL` varchar(512) NOT NULL COMMENT 'Video URL',
  PRIMARY KEY (`video_id`),
  UNIQUE KEY `video_name` (`video_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_video`
--

INSERT INTO `cpy_video` (`video_id`, `video_name`, `video_URL`) VALUES
(0, 'No Video', '#'),
(2, 'Dr.X', 'assets/pages/img/video/DR.X.mp4');

-- --------------------------------------------------------

--
-- Stand-in structure for view `cpy_vteam`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `cpy_vteam`;
CREATE TABLE IF NOT EXISTS `cpy_vteam` (
`team_id` int(11)
,`team_iname` varchar(100)
,`team_order` smallint(6)
,`team_photo` varchar(255)
,`teamn_id` int(11)
,`lang_id` int(11)
,`team_name` varchar(100)
,`team_title` varchar(10)
,`team_position` varchar(50)
,`team_text` text
);

-- --------------------------------------------------------

--
-- Table structure for table `phs_block_type`
--

DROP TABLE IF EXISTS `phs_block_type`;
CREATE TABLE IF NOT EXISTS `phs_block_type` (
  `type_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `type_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_block_type`
--

INSERT INTO `phs_block_type` (`type_id`, `type_name`) VALUES
(4, 'Image'),
(10, 'Key Full'),
(9, 'Key Text'),
(8, 'Key Value'),
(5, 'News'),
(3, 'OWL Slider'),
(2, 'Slider'),
(1, 'Text'),
(6, 'Tips'),
(7, 'Video');

-- --------------------------------------------------------

--
-- Table structure for table `phs_color`
--

DROP TABLE IF EXISTS `phs_color`;
CREATE TABLE IF NOT EXISTS `phs_color` (
  `color_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `color_name` varchar(200) NOT NULL COMMENT 'Name',
  `color_fcolor` varchar(25) NOT NULL COMMENT 'Color Code',
  `color_bcolor` varchar(25) NOT NULL COMMENT 'Background Color Code',
  PRIMARY KEY (`color_id`),
  UNIQUE KEY `color_name` (`color_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_color`
--

INSERT INTO `phs_color` (`color_id`, `color_name`, `color_fcolor`, `color_bcolor`) VALUES
(0, 'Transparent', '', ''),
(1, 'White', '#FFFFFF', '#000000'),
(2, 'Dark', '#333333', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `phs_cols`
--

DROP TABLE IF EXISTS `phs_cols`;
CREATE TABLE IF NOT EXISTS `phs_cols` (
  `cols_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `cols_name` varchar(200) NOT NULL COMMENT 'Name',
  `cols_value` varchar(200) NOT NULL,
  PRIMARY KEY (`cols_id`),
  UNIQUE KEY `cols_name` (`cols_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_cols`
--

INSERT INTO `phs_cols` (`cols_id`, `cols_name`, `cols_value`) VALUES
(1, '1', 'col-12 col-sm-1'),
(2, '2', 'col-12 col-sm-2'),
(3, '3', 'col-12 col-sm-3'),
(4, '4', 'col-12 col-sm-4'),
(5, '5', 'col-12 col-sm-5'),
(6, '6', 'col-12 col-sm-6'),
(7, '7', 'col-12 col-sm-7'),
(8, '8', 'col-12 col-sm-8'),
(9, '9', 'col-12 col-sm-9'),
(10, '10', 'col-12 col-sm-10'),
(11, '11', 'col-12 col-sm-11'),
(12, '12', 'col-12 col-sm-12');

-- --------------------------------------------------------

--
-- Table structure for table `phs_country`
--

DROP TABLE IF EXISTS `phs_country`;
CREATE TABLE IF NOT EXISTS `phs_country` (
  `cntry_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL COMMENT 'Status',
  `cntry_code` varchar(2) NOT NULL DEFAULT '' COMMENT 'Country Code',
  `cntry_name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Country Name',
  PRIMARY KEY (`cntry_id`),
  UNIQUE KEY `cntry_name` (`cntry_name`),
  UNIQUE KEY `cntry_code` (`cntry_code`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_country`
--

INSERT INTO `phs_country` (`cntry_id`, `status_id`, `cntry_code`, `cntry_name`) VALUES
(1, 1, 'AF', 'Afghanistan'),
(2, 1, 'AL', 'Albania'),
(3, 1, 'DZ', 'Algeria'),
(4, 1, 'DS', 'American Samoa'),
(5, 1, 'AD', 'Andorra'),
(6, 1, 'AO', 'Angola'),
(7, 1, 'AI', 'Anguilla'),
(8, 1, 'AQ', 'Antarctica'),
(9, 1, 'AG', 'Antigua and Barbuda'),
(10, 1, 'AR', 'Argentina'),
(11, 1, 'AM', 'Armenia'),
(12, 1, 'AW', 'Aruba'),
(13, 1, 'AU', 'Australia'),
(14, 1, 'AT', 'Austria'),
(15, 1, 'AZ', 'Azerbaijan'),
(16, 1, 'BS', 'Bahamas'),
(17, 1, 'BH', 'Bahrain'),
(18, 1, 'BD', 'Bangladesh'),
(19, 1, 'BB', 'Barbados'),
(20, 1, 'BY', 'Belarus'),
(21, 1, 'BE', 'Belgium'),
(22, 1, 'BZ', 'Belize'),
(23, 1, 'BJ', 'Benin'),
(24, 1, 'BM', 'Bermuda'),
(25, 1, 'BT', 'Bhutan'),
(26, 1, 'BO', 'Bolivia'),
(27, 1, 'BA', 'Bosnia and Herzegovina'),
(28, 1, 'BW', 'Botswana'),
(29, 1, 'BV', 'Bouvet Island'),
(30, 1, 'BR', 'Brazil'),
(31, 1, 'IO', 'British Indian Ocean Territory'),
(32, 1, 'BN', 'Brunei Darussalam'),
(33, 1, 'BG', 'Bulgaria'),
(34, 1, 'BF', 'Burkina Faso'),
(35, 1, 'BI', 'Burundi'),
(36, 1, 'KH', 'Cambodia'),
(37, 1, 'CM', 'Cameroon'),
(38, 1, 'CA', 'Canada'),
(39, 1, 'CV', 'Cape Verde'),
(40, 1, 'KY', 'Cayman Islands'),
(41, 1, 'CF', 'Central African Republic'),
(42, 1, 'TD', 'Chad'),
(43, 1, 'CL', 'Chile'),
(44, 1, 'CN', 'China'),
(45, 1, 'CX', 'Christmas Island'),
(46, 1, 'CC', 'Cocos (Keeling) Islands'),
(47, 1, 'CO', 'Colombia'),
(48, 1, 'KM', 'Comoros'),
(49, 1, 'CG', 'Congo'),
(50, 1, 'CK', 'Cook Islands'),
(51, 1, 'CR', 'Costa Rica'),
(52, 1, 'HR', 'Croatia (Hrvatska)'),
(53, 1, 'CU', 'Cuba'),
(54, 1, 'CY', 'Cyprus'),
(55, 1, 'CZ', 'Czech Republic'),
(56, 1, 'DK', 'Denmark'),
(57, 1, 'DJ', 'Djibouti'),
(58, 1, 'DM', 'Dominica'),
(59, 1, 'DO', 'Dominican Republic'),
(60, 1, 'TP', 'East Timor'),
(61, 1, 'EC', 'Ecuador'),
(62, 1, 'EG', 'Egypt'),
(63, 1, 'SV', 'El Salvador'),
(64, 1, 'GQ', 'Equatorial Guinea'),
(65, 1, 'ER', 'Eritrea'),
(66, 1, 'EE', 'Estonia'),
(67, 1, 'ET', 'Ethiopia'),
(68, 1, 'FK', 'Falkland Islands (Malvinas)'),
(69, 1, 'FO', 'Faroe Islands'),
(70, 1, 'FJ', 'Fiji'),
(71, 1, 'FI', 'Finland'),
(72, 1, 'FR', 'France'),
(73, 1, 'FX', 'France, Metropolitan'),
(74, 1, 'GF', 'French Guiana'),
(75, 1, 'PF', 'French Polynesia'),
(76, 1, 'TF', 'French Southern Territories'),
(77, 1, 'GA', 'Gabon'),
(78, 1, 'GM', 'Gambia'),
(79, 1, 'GE', 'Georgia'),
(80, 1, 'DE', 'Germany'),
(81, 1, 'GH', 'Ghana'),
(82, 1, 'GI', 'Gibraltar'),
(83, 1, 'GK', 'Guernsey'),
(84, 1, 'GR', 'Greece'),
(85, 1, 'GL', 'Greenland'),
(86, 1, 'GD', 'Grenada'),
(87, 1, 'GP', 'Guadeloupe'),
(88, 1, 'GU', 'Guam'),
(89, 1, 'GT', 'Guatemala'),
(90, 1, 'GN', 'Guinea'),
(91, 1, 'GW', 'Guinea-Bissau'),
(92, 1, 'GY', 'Guyana'),
(93, 1, 'HT', 'Haiti'),
(94, 1, 'HM', 'Heard and Mc Donald Islands'),
(95, 1, 'HN', 'Honduras'),
(96, 1, 'HK', 'Hong Kong'),
(97, 1, 'HU', 'Hungary'),
(98, 1, 'IS', 'Iceland'),
(99, 1, 'IN', 'India'),
(100, 1, 'IM', 'Isle of Man'),
(101, 1, 'ID', 'Indonesia'),
(102, 1, 'IR', 'Iran (Islamic Republic of)'),
(103, 1, 'IQ', 'Iraq'),
(104, 1, 'IE', 'Ireland'),
(105, 1, 'IL', 'Israel'),
(106, 1, 'IT', 'Italy'),
(107, 1, 'CI', 'Ivory Coast'),
(108, 1, 'JE', 'Jersey'),
(109, 1, 'JM', 'Jamaica'),
(110, 1, 'JP', 'Japan'),
(111, 1, 'JO', 'Jordan'),
(112, 1, 'KZ', 'Kazakhstan'),
(113, 1, 'KE', 'Kenya'),
(114, 1, 'KI', 'Kiribati'),
(115, 1, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 1, 'KR', 'Korea, Republic of'),
(117, 1, 'XK', 'Kosovo'),
(118, 1, 'KW', 'Kuwait'),
(119, 1, 'KG', 'Kyrgyzstan'),
(120, 1, 'LA', 'Lao People\'s Democratic Republic'),
(121, 1, 'LV', 'Latvia'),
(122, 1, 'LB', 'Lebanon'),
(123, 1, 'LS', 'Lesotho'),
(124, 1, 'LR', 'Liberia'),
(125, 1, 'LY', 'Libyan Arab Jamahiriya'),
(126, 1, 'LI', 'Liechtenstein'),
(127, 1, 'LT', 'Lithuania'),
(128, 1, 'LU', 'Luxembourg'),
(129, 1, 'MO', 'Macau'),
(130, 1, 'MK', 'Macedonia'),
(131, 1, 'MG', 'Madagascar'),
(132, 1, 'MW', 'Malawi'),
(133, 1, 'MY', 'Malaysia'),
(134, 1, 'MV', 'Maldives'),
(135, 1, 'ML', 'Mali'),
(136, 1, 'MT', 'Malta'),
(137, 1, 'MH', 'Marshall Islands'),
(138, 1, 'MQ', 'Martinique'),
(139, 1, 'MR', 'Mauritania'),
(140, 1, 'MU', 'Mauritius'),
(141, 1, 'TY', 'Mayotte'),
(142, 1, 'MX', 'Mexico'),
(143, 1, 'FM', 'Micronesia, Federated States of'),
(144, 1, 'MD', 'Moldova, Republic of'),
(145, 1, 'MC', 'Monaco'),
(146, 1, 'MN', 'Mongolia'),
(147, 1, 'ME', 'Montenegro'),
(148, 1, 'MS', 'Montserrat'),
(149, 1, 'MA', 'Morocco'),
(150, 1, 'MZ', 'Mozambique'),
(151, 1, 'MM', 'Myanmar'),
(152, 1, 'NA', 'Namibia'),
(153, 1, 'NR', 'Nauru'),
(154, 1, 'NP', 'Nepal'),
(155, 1, 'NL', 'Netherlands'),
(156, 1, 'AN', 'Netherlands Antilles'),
(157, 1, 'NC', 'New Caledonia'),
(158, 1, 'NZ', 'New Zealand'),
(159, 1, 'NI', 'Nicaragua'),
(160, 1, 'NE', 'Niger'),
(161, 1, 'NG', 'Nigeria'),
(162, 1, 'NU', 'Niue'),
(163, 1, 'NF', 'Norfolk Island'),
(164, 1, 'MP', 'Northern Mariana Islands'),
(165, 1, 'NO', 'Norway'),
(166, 1, 'OM', 'Oman'),
(167, 1, 'PK', 'Pakistan'),
(168, 1, 'PW', 'Palau'),
(169, 1, 'PS', 'Palestine'),
(170, 1, 'PA', 'Panama'),
(171, 1, 'PG', 'Papua New Guinea'),
(172, 1, 'PY', 'Paraguay'),
(173, 1, 'PE', 'Peru'),
(174, 1, 'PH', 'Philippines'),
(175, 1, 'PN', 'Pitcairn'),
(176, 1, 'PL', 'Poland'),
(177, 1, 'PT', 'Portugal'),
(178, 1, 'PR', 'Puerto Rico'),
(179, 1, 'QA', 'Qatar'),
(180, 1, 'RE', 'Reunion'),
(181, 1, 'RO', 'Romania'),
(182, 1, 'RU', 'Russian Federation'),
(183, 1, 'RW', 'Rwanda'),
(184, 1, 'KN', 'Saint Kitts and Nevis'),
(185, 1, 'LC', 'Saint Lucia'),
(186, 1, 'VC', 'Saint Vincent and the Grenadines'),
(187, 1, 'WS', 'Samoa'),
(188, 1, 'SM', 'San Marino'),
(189, 1, 'ST', 'Sao Tome and Principe'),
(190, 1, 'SA', 'Saudi Arabia'),
(191, 1, 'SN', 'Senegal'),
(192, 1, 'RS', 'Serbia'),
(193, 1, 'SC', 'Seychelles'),
(194, 1, 'SL', 'Sierra Leone'),
(195, 1, 'SG', 'Singapore'),
(196, 1, 'SK', 'Slovakia'),
(197, 1, 'SI', 'Slovenia'),
(198, 1, 'SB', 'Solomon Islands'),
(199, 1, 'SO', 'Somalia'),
(200, 1, 'ZA', 'South Africa'),
(201, 1, 'GS', 'South Georgia South Sandwich Islands'),
(202, 1, 'SS', 'South Sudan'),
(203, 1, 'ES', 'Spain'),
(204, 1, 'LK', 'Sri Lanka'),
(205, 1, 'SH', 'St. Helena'),
(206, 1, 'PM', 'St. Pierre and Miquelon'),
(207, 1, 'SD', 'Sudan'),
(208, 1, 'SR', 'Suriname'),
(209, 1, 'SJ', 'Svalbard and Jan Mayen Islands'),
(210, 1, 'SZ', 'Swaziland'),
(211, 1, 'SE', 'Sweden'),
(212, 1, 'CH', 'Switzerland'),
(213, 1, 'SY', 'Syrian Arab Republic'),
(214, 1, 'TW', 'Taiwan'),
(215, 1, 'TJ', 'Tajikistan'),
(216, 1, 'TZ', 'Tanzania, United Republic of'),
(217, 1, 'TH', 'Thailand'),
(218, 1, 'TG', 'Togo'),
(219, 1, 'TK', 'Tokelau'),
(220, 1, 'TO', 'Tonga'),
(221, 1, 'TT', 'Trinidad and Tobago'),
(222, 1, 'TN', 'Tunisia'),
(223, 1, 'TR', 'Turkey'),
(224, 1, 'TM', 'Turkmenistan'),
(225, 1, 'TC', 'Turks and Caicos Islands'),
(226, 1, 'TV', 'Tuvalu'),
(227, 1, 'UG', 'Uganda'),
(228, 1, 'UA', 'Ukraine'),
(229, 1, 'AE', 'United Arab Emirates'),
(230, 1, 'GB', 'United Kingdom'),
(231, 1, 'US', 'United States'),
(232, 1, 'UM', 'United States minor outlying islands'),
(233, 1, 'UY', 'Uruguay'),
(234, 1, 'UZ', 'Uzbekistan'),
(235, 1, 'VU', 'Vanuatu'),
(236, 1, 'VA', 'Vatican City State'),
(237, 1, 'VE', 'Venezuela'),
(238, 1, 'VN', 'Vietnam'),
(239, 1, 'VG', 'Virgin Islands (British)'),
(240, 1, 'VI', 'Virgin Islands (U.S.)'),
(241, 1, 'WF', 'Wallis and Futuna Islands'),
(242, 1, 'EH', 'Western Sahara'),
(243, 1, 'YE', 'Yemen'),
(244, 1, 'ZR', 'Zaire'),
(245, 1, 'ZM', 'Zambia'),
(246, 1, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `phs_every`
--

DROP TABLE IF EXISTS `phs_every`;
CREATE TABLE IF NOT EXISTS `phs_every` (
  `every_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `every_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`every_id`),
  UNIQUE KEY `every_name` (`every_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_every`
--

INSERT INTO `phs_every` (`every_id`, `every_name`) VALUES
(3, 'Day'),
(1, 'Every Time'),
(2, 'Hour'),
(5, 'Month'),
(4, 'Week'),
(6, 'Year');

-- --------------------------------------------------------

--
-- Table structure for table `phs_gender`
--

DROP TABLE IF EXISTS `phs_gender`;
CREATE TABLE IF NOT EXISTS `phs_gender` (
  `gend_id` tinyint(4) NOT NULL COMMENT 'PK',
  `gend_name` varchar(100) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`gend_id`),
  UNIQUE KEY `gend_name` (`gend_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_gender`
--

INSERT INTO `phs_gender` (`gend_id`, `gend_name`) VALUES
(2, 'Female'),
(1, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `phs_hour`
--

DROP TABLE IF EXISTS `phs_hour`;
CREATE TABLE IF NOT EXISTS `phs_hour` (
  `hour_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `houd_hour` varchar(100) NOT NULL,
  PRIMARY KEY (`hour_id`),
  UNIQUE KEY `houd_hour` (`houd_hour`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_hour`
--

INSERT INTO `phs_hour` (`hour_id`, `houd_hour`) VALUES
(24, '0'),
(1, '1'),
(10, '10'),
(11, '11'),
(12, '12'),
(13, '13'),
(14, '14'),
(15, '15'),
(16, '16'),
(17, '17'),
(18, '18'),
(19, '19'),
(2, '2'),
(20, '20'),
(21, '21'),
(22, '22'),
(23, '23'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9');

-- --------------------------------------------------------

--
-- Table structure for table `phs_keys`
--

DROP TABLE IF EXISTS `phs_keys`;
CREATE TABLE IF NOT EXISTS `phs_keys` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `key_name` varchar(100) NOT NULL COMMENT 'Status',
  `key_defvalue` varchar(100) NOT NULL COMMENT 'Default Value',
  PRIMARY KEY (`key_id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1323 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_keys`
--

INSERT INTO `phs_keys` (`key_id`, `key_name`, `key_defvalue`) VALUES
(1128, 'Info', 'Info'),
(1129, 'Info Mail', 'Info Mail'),
(1130, 'Phone No', '+1 2345 6789'),
(1131, 'about', 'about'),
(1155, 'home', 'home'),
(1157, 'language', 'language'),
(1170, 'notes', 'notes'),
(1234, 'ALL Rights Reserved.', 'ALL Rights Reserved.'),
(1246, 'Site-Name', 'PhSoft'),
(1247, 'Agent', 'Agent'),
(1248, 'Agents', 'Agents'),
(1249, 'Services', 'Services'),
(1250, 'Team', 'Team'),
(1251, 'Contact', 'Contact'),
(1252, 'About us', 'About us'),
(1253, 'Sign In', 'Sign In'),
(1254, 'Talk About US', 'Talk About US'),
(1255, 'Contact Us', 'Contact Us'),
(1256, 'Address', 'Address'),
(1257, 'Phone', 'Phone'),
(1258, 'Email', 'Email'),
(1259, 'Website', 'Website'),
(1260, 'Name', 'Name'),
(1261, 'Email Address', 'Email Address'),
(1262, 'Subject', 'Subject'),
(1263, 'Enter your message', 'Enter your message'),
(1264, 'Send Now', 'Send Now'),
(1265, 'mail-form-status-message', 'mail-form-status-message'),
(1266, 'Start Now', 'Start Now'),
(1267, 'Clients', 'Clients'),
(1268, 'Subscribe', 'Subscribe'),
(1269, 'CRM', 'CRM'),
(1270, 'Fax', 'Fax'),
(1271, 'Sale', 'Sale'),
(1272, 'Rent', 'Rent'),
(1273, 'none', 'none'),
(1309, 'Log In', 'Log In'),
(1310, 'Registration', 'Registration'),
(1311, 'Powered by:', 'Powered By: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">PhSoft Team</a></p>'),
(1312, 'Get Application', 'Get Application'),
(1313, 'Our Contacts', 'Our Contacts'),
(1314, 'Web Application', 'Web Application'),
(1315, 'Sexual Imprint', 'Sexual Imprint'),
(1316, 'Book Language', 'Book Language'),
(1317, 'Book Price', 'Book Price'),
(1318, 'Price', 'Price'),
(1319, 'Book Name', 'Book Name'),
(1320, 'Password', 'Password'),
(1321, 'Male', 'Male'),
(1322, 'Female', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `phs_keyvalues`
--

DROP TABLE IF EXISTS `phs_keyvalues`;
CREATE TABLE IF NOT EXISTS `phs_keyvalues` (
  `kval_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `key_id` int(11) NOT NULL COMMENT 'Key FK',
  `lang_id` int(11) NOT NULL COMMENT 'Language FK',
  `key_value` varchar(250) NOT NULL COMMENT 'Value',
  `key_rvalue` varchar(250) NOT NULL COMMENT 'Related Value',
  `key_text` text COMMENT 'Text',
  PRIMARY KEY (`kval_id`),
  UNIQUE KEY `keyLang` (`key_id`,`lang_id`),
  KEY `key_value` (`key_value`),
  KEY `key_rvalue` (`key_rvalue`),
  KEY `key_id` (`key_id`),
  KEY `lang_id_2` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1438 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_keyvalues`
--

INSERT INTO `phs_keyvalues` (`kval_id`, `key_id`, `lang_id`, `key_value`, `key_rvalue`, `key_text`) VALUES
(5, 0, 1, 'none', 'no value', NULL),
(989, 1131, 2, 'About', 'About', '<h1>We are a scientific and psychological institution that offers dating services in a distinguished way based on the latest studies and research in the respective fields.<br />\r\n<br />\r\nWe offer to find our subscribers the right match in a systematic way, following deliberate methods based on emotional and sexual compatibility. Subscribers could reach this end by taking our innovative tests specially conducted for this purpose.</h1>'),
(1013, 1155, 2, 'Home', '', NULL),
(1015, 1157, 2, 'Language', '', NULL),
(1028, 1170, 2, 'Notes', '', NULL),
(1053, 1131, 1, 'حول', 'حول', '<div class=\"ae-about\">\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:20px\"><span style=\"font-family:times new roman,times,serif\">نحن مؤسسة علمية نفسية تقدم خدمات التعارف بين الأشخاص الراغبين بذلك، ولكن بأسلوب متميز عن غيرنا. فنحن نعرف المشتركين على من يناسبهم من الأشخاص بناء على أسس علمية ونفسية بالاستناد إلى التوافقات العاطفية (والجنسية) بينهم، وذلك عن طريق الاختبارات الابتكارية التي نقدمها بشكل متفرد والتي تتمثل باختبار ذكورة أو أنوثة المخ، واختبار الطبيعة العاطفية (واختبار الطبيعة الجنسية)، إضافة إلى اختبار الذكاء الوجداني المجاني.&nbsp;هدفنا هو إيجاد توافقات مدروسة للوصول إلى علاقات هانئة ودائمة.</span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:20px\"><span style=\"font-family:times new roman,times,serif\">فريق موقع حواء وآدم</span></span></p>\r\n</div>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(1077, 1155, 1, 'الرئيسية', '', NULL),
(1079, 1157, 1, 'اللغة', '', NULL),
(1092, 1170, 1, 'ملاحظات', '', NULL),
(1323, 1234, 1, 'جميع الحقوق محفوظة', '', NULL),
(1352, 1246, 1, 'PhSoft', '', NULL),
(1353, 1246, 2, 'PhSoft', '', NULL),
(1354, 1247, 1, 'وكيل', 'وكيل', NULL),
(1355, 1247, 2, 'Agent', 'Agent', NULL),
(1356, 1248, 1, 'وكلاؤنا', 'وكلاؤنا', NULL),
(1357, 1248, 2, 'Agents', 'Agents', NULL),
(1360, 1249, 1, 'خدماتنا', 'خدماتنا', NULL),
(1361, 1249, 2, 'Services', 'Services', NULL),
(1362, 1250, 1, 'فريقنا', 'فريقنا', NULL),
(1363, 1250, 2, 'Team', 'Team', NULL),
(1364, 1252, 1, 'من نحن', 'من نحن', '<div class=\"ae-about\">\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:20px\"><span style=\"font-family:times new roman,times,serif\">نحن مؤسسة علمية نفسية تقدم خدمات التعارف بين الأشخاص الراغبين بذلك، ولكن بأسلوب متميز عن غيرنا. فنحن نعرف المشتركين على من يناسبهم من الأشخاص بناء على أسس علمية ونفسية بالاستناد إلى التوافقات العاطفية (والجنسية) بينهم، وذلك عن طريق الاختبارات الابتكارية التي نقدمها بشكل متفرد والتي تتمثل باختبار ذكورة أو أنوثة المخ، واختبار الطبيعة العاطفية (واختبار الطبيعة الجنسية)، إضافة إلى اختبار الذكاء الوجداني المجاني.&nbsp;هدفنا هو إيجاد توافقات مدروسة للوصول إلى علاقات هانئة ودائمة.</span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:20px\"><span style=\"font-family:times new roman,times,serif\">فريق موقع حواء وآدم</span></span></p>\r\n</div>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(1365, 1252, 2, 'About us', 'About us', '<p>We are a scientific and psychological institution that offers dating services in a distinguished way based on the latest studies and research in the respective fields.<br />\r\n<br />\r\nWe offer to find our subscribers the right match in a systematic way, following deliberate methods based on emotional and sexual compatibility. Subscribers could reach this end by taking our innovative tests specially conducted for this purpose.</p>'),
(1366, 1251, 1, 'اتصل', 'اتصل', NULL),
(1367, 1251, 2, 'Contact', 'Contact', NULL),
(1368, 1253, 1, 'دخول', 'دخول', NULL),
(1369, 1253, 2, 'Sign In', 'Sign In', NULL),
(1370, 1254, 1, 'قالوا فينا', 'قالوا فينا', NULL),
(1371, 1254, 2, 'Talk About US', 'Talk About US', NULL),
(1372, 1255, 1, 'اتصل بنا', 'اتصل بنا', NULL),
(1373, 1255, 2, 'Contact Us', 'Contact Us', NULL),
(1374, 1256, 1, 'العنوان', 'العنوان', NULL),
(1376, 1256, 2, 'Address', 'Address', NULL),
(1377, 1257, 1, 'الهاتف', 'الهاتف', NULL),
(1378, 1257, 2, 'Phone', 'Phone', NULL),
(1379, 1259, 1, 'الموقع الالكتروني', 'الموقع الالكتروني', NULL),
(1380, 1259, 2, 'Website', 'Website', NULL),
(1381, 1258, 1, 'بريد الكتروني', 'بريد الكتروني', NULL),
(1382, 1258, 2, 'Email', 'Email', NULL),
(1383, 1263, 1, 'ادخل رسالتك', 'ادخل رسالتك', NULL),
(1384, 1263, 2, 'Enter your message', 'Enter your message', NULL),
(1385, 1262, 1, 'الموضوع', 'الموضوع', NULL),
(1386, 1262, 2, 'Subject', 'Subject', NULL),
(1387, 1260, 1, 'الاسم', 'الاسم', NULL),
(1388, 1260, 2, 'Name', 'Name', NULL),
(1389, 1261, 1, 'البريد الالكتروني', 'البريد الالكتروني', NULL),
(1390, 1261, 2, 'Email Address', 'Email Address', NULL),
(1391, 1264, 1, 'ارسال', 'ارسال', NULL),
(1392, 1264, 2, 'Send Now', 'Send Now', NULL),
(1393, 1265, 1, 'شكرا لاتصالك بنا. سيحاول فريقنا الرد عليك في أقرب وقت ممكن', 'شكرا لاتصالك بنا. سيحاول فريقنا الرد عليك في أقرب وقت ممكن', NULL),
(1394, 1265, 2, 'Thank you for contact us. As early as possible we will contact you', 'Thank you for contact us. As early as possible we will contact you', NULL),
(1395, 1266, 1, 'ابدأ الآن', 'ابدأ الآن', NULL),
(1396, 1266, 2, 'Start Now', 'Start Now', NULL),
(1397, 1267, 1, 'زبائننا', 'زبائننا', NULL),
(1398, 1267, 2, 'Clients', 'Clients', NULL),
(1399, 1268, 1, 'اشترك معنا', 'اشترك معنا', NULL),
(1400, 1268, 2, 'Subscribe', 'Subscribe', NULL),
(1401, 1269, 1, 'خدمة الزبائن', 'خدمة الزبائن', NULL),
(1402, 1269, 2, 'CRM', 'CRM', NULL),
(1403, 1270, 1, 'فاكس', 'فاكس', NULL),
(1404, 1270, 2, 'Fax', 'Fax', NULL),
(1405, 1271, 1, 'مبيع', 'مبيع', NULL),
(1406, 1272, 1, 'إيجار', 'إيجار', NULL),
(1407, 1271, 2, 'Sale', 'Sale', NULL),
(1408, 1272, 2, 'Rent', 'Rent', NULL),
(1409, 1130, 1, '+1 2345 6789', '+1 2345 6789', NULL),
(1410, 1130, 2, '+1 2345 6789', '+1 2345 6789', NULL),
(1411, 1129, 1, 'info', 'doctorxapp@gmail.com', NULL),
(1412, 1128, 1, 'بريد', '', NULL),
(1413, 1309, 1, 'دخول', '', NULL),
(1414, 1310, 1, 'تسجيل', '', NULL),
(1418, 1311, 1, 'تطوير: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">فريق PhSoft</a></p>', 'تطوير: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">فريق PhSoft</a></p>', NULL),
(1419, 1311, 2, 'Powered By: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">PhSoft Team</a></p>', 'Powered By: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">PhSoft Team</a></p>', NULL),
(1420, 1129, 2, 'info', 'doctorxapp@gmail.com', NULL),
(1421, 1312, 1, 'الحصول على التطبيق', 'الحصول على التطبيق', NULL),
(1422, 1313, 2, 'Our Contacts', 'Our Contacts', '<address class=\"margin-bottom-40\">\r\n                Jay Le Monde<br>\r\n                Abu Dhabi, Cornish Street,<br>\r\n                old ADNIF Building to Sea Shell, 10th Floor<br>\r\n                Phone: +971 2 62 7777 0<br>\r\n                Fax  : +971 2 62 7777 1<br>\r\n                Email: <a href=\"mailto:doctorxapp@gmail.com\">doctorxapp@gmail.com</a><br>\r\n              </address>'),
(1423, 1313, 1, 'اتصل بنا', 'اتصل بنا', '<address class=\"margin-bottom-40\">\r\n                Jay Le Monde<br>\r\n                Abu Dhabi, Cornish Street,<br>\r\n                old ADNIF Building to Sea Shell, 10th Floor<br>\r\n                Phone: +971 2 62 7777 0<br>\r\n                Fax  : +971 2 62 7777 1<br>\r\n                Email: <a href=\"mailto:doctorxapp@gmail.com\">doctorxapp@gmail.com</a><br>\r\n              </address>'),
(1424, 1314, 2, 'Web Application', 'Web Application', '<p><span style=\"font-size:16px\">you can launch out web application from <a href=\"http://localhost:8080/eadrx/app\" target=\"_blank\">here</a></span></p>'),
(1425, 1314, 1, 'استخدام التطبيق على النت', 'استخدام التطبيق على النت', '<p><span style=\"font-size:16px\">يمكنك استخدام التطبيق على الانترنت من خلال <a href=\"http://localhost:8080/eadrx/app\" target=\"_blank\">الرابط التالي</a></span></p>'),
(1426, 1315, 1, 'البصمة الجنسية', 'البصمة الجنسية', NULL),
(1427, 1315, 2, 'Sexual Imprint', 'Sexual Imprint', NULL),
(1428, 1316, 2, 'Book Language', 'Book Language', NULL),
(1429, 1316, 1, 'لغة الكتاب', 'لغة الكتاب', NULL),
(1430, 1317, 2, 'Book Price', 'Book Price', NULL),
(1431, 1317, 1, 'سعر الكتاب', 'سعر الكتاب', NULL),
(1432, 1318, 2, 'Price', 'Price', NULL),
(1433, 1318, 1, 'السعر', 'السعر', NULL),
(1434, 1319, 1, 'اسم الكتاب', 'اسم الكتاب', NULL),
(1435, 1320, 1, 'كلمة المرور', 'كلمة المرور', NULL),
(1436, 1321, 1, 'ذكر', 'ذكر', NULL),
(1437, 1322, 1, 'أنثى', 'أنثى', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phs_language`
--

DROP TABLE IF EXISTS `phs_language`;
CREATE TABLE IF NOT EXISTS `phs_language` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `lang_code` varchar(10) NOT NULL DEFAULT '' COMMENT 'Language Code',
  `lang_dir` varchar(10) NOT NULL DEFAULT '' COMMENT 'Language Direction',
  `lang_name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Language Name',
  `lang_dname` varchar(200) DEFAULT NULL COMMENT 'Display Name',
  `lang_ccode` varchar(5) DEFAULT NULL COMMENT 'Country Code',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `lang_code` (`lang_code`),
  UNIQUE KEY `lang_name` (`lang_name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_language`
--

INSERT INTO `phs_language` (`lang_id`, `status_id`, `lang_code`, `lang_dir`, `lang_name`, `lang_dname`, `lang_ccode`) VALUES
(1, 1, 'ar', 'rtl', 'Arabic', 'العربية', 'sa'),
(2, 1, 'en', 'ltr', 'English', 'English', 'gb'),
(3, 2, 'fr', 'ltr', 'Français', 'Éve et Adam', 'fr'),
(4, 2, 'es', 'ltr', 'Español', 'Adán y Eva', 'es'),
(5, 2, 'de', 'ltr', 'Deutsch', 'Eva und Adam', 'de'),
(7, 2, 'ru', 'ltr', 'русский', 'Ева и Адам', NULL),
(8, 2, 'en5', 'ltr', 'Dansk', 'Eva og Adam', NULL),
(9, 2, 'en6', 'ltr', 'Türk', 'Havva ve Adem', NULL),
(10, 2, 'en7', 'ltr', '中国', '亚当和夏娃', NULL),
(11, 2, 'en8', 'ltr', 'Italiano', 'Adamo ed Eva', NULL),
(12, 2, 'en9', 'rtl', 'فارسي', 'حوا و آدم', NULL),
(13, 2, 'en0', 'ltr', 'Kiswahili', 'Hawa na Adamu', NULL),
(14, 2, 'en11', 'ltr', 'Հայերեն', 'Ադամն ու Եվան', NULL),
(15, 2, 'en12', 'ltr', 'Bosanski', 'Adam i Eva', NULL),
(16, 2, 'en13', 'ltr', 'Nederlands', 'Eva en Adam', NULL),
(17, 2, 'en14', 'ltr', 'Filebenah', 'Sina Adan at Eba', NULL),
(18, 2, 'en15', 'ltr', 'Suomi', 'Eeva ja Aatami', NULL),
(19, 2, 'en16', 'ltr', 'ქართული ენის', 'ადამი და ევა', NULL),
(20, 2, 'en17', 'ltr', 'Ελληνικά', 'Αδάμ και Εύα', NULL),
(21, 2, 'en18', 'ltr', 'हिंदी', 'आदम और हव्वा', NULL),
(22, 2, 'en19', 'ltr', 'magyar', 'Ádám és Éva', NULL),
(23, 2, 'en20', 'ltr', 'bahasa Indonesia', 'Adam dan Hawa', NULL),
(24, 2, 'en21', 'ltr', '日本人', 'アダムとイヴ', NULL),
(25, 2, 'en22', 'ltr', '한국의', '아담과 이브', NULL),
(26, 2, 'en23', 'ltr', 'नेपाली भाषा', 'आदम र हव्वाले', NULL),
(27, 2, 'en24', 'ltr', 'português', 'Adão e Eva', NULL),
(28, 2, 'en25', 'ltr', 'limba română', 'Adam și Eva', NULL),
(29, 2, 'en26', 'ltr', 'svenska', 'Adam och Eva', NULL),
(30, 2, 'en27', 'ltr', 'ภาษาไทย', 'อาดัมและอีฟ', NULL),
(31, 2, 'en28', 'ltr', 'українська мова', 'Адам і Єва', NULL),
(32, 2, 'en29', 'ltr', 'tiếng Việt', 'Adam và Eve', NULL),
(33, 2, 'tr', 'ltr', 'Turkey', NULL, 'tr'),
(34, 2, 'sw', 'ltr', 'Sweden', NULL, 'se'),
(35, 2, 'be', 'ltr', 'Belgium', NULL, 'be');

-- --------------------------------------------------------

--
-- Table structure for table `phs_menu`
--

DROP TABLE IF EXISTS `phs_menu`;
CREATE TABLE IF NOT EXISTS `phs_menu` (
  `menu_id` int(10) NOT NULL COMMENT 'PK',
  `menu_pid` int(11) NOT NULL COMMENT 'Parent Menu',
  `page_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Dynamic Page',
  `test_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Test',
  `type_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Type',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `menu_order` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Order to display menu',
  `menu_name` varchar(200) NOT NULL COMMENT 'Name',
  `menu_icon` varchar(50) DEFAULT NULL COMMENT 'Icon',
  `menu_href` varchar(200) DEFAULT NULL COMMENT 'Link',
  `menu_target` varchar(50) DEFAULT NULL,
  `menu_page` varchar(50) DEFAULT NULL COMMENT 'Page file name',
  PRIMARY KEY (`menu_id`),
  KEY `menu_type` (`type_id`),
  KEY `menu_status` (`status_id`),
  KEY `menu_pid` (`menu_pid`),
  KEY `page_id` (`page_id`),
  KEY `test_id` (`test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_menu`
--

INSERT INTO `phs_menu` (`menu_id`, `menu_pid`, `page_id`, `test_id`, `type_id`, `status_id`, `menu_order`, `menu_name`, `menu_icon`, `menu_href`, `menu_target`, `menu_page`) VALUES
(-1, -1, 0, 0, 0, 1, 0, 'Menu', NULL, NULL, NULL, NULL),
(0, 0, 0, 0, 0, 1, 0, 'Main Menu', NULL, NULL, NULL, NULL),
(1, -1, 0, 0, 1, 1, 0, 'Top Left Menu', NULL, NULL, NULL, NULL),
(2, -1, 0, 0, 2, 1, 0, 'Top Right Menu', NULL, NULL, NULL, NULL),
(3, -1, 0, 0, 0, 1, 0, 'Left Navigation Menu', NULL, NULL, NULL, NULL),
(4, -1, 0, 0, 0, 1, 0, 'Right Navigation Menu', NULL, NULL, NULL, NULL),
(10, 0, 0, 0, 10, 1, 0, 'Home', 'fas fa-home', NULL, NULL, 'page-main.php'),
(11, 0, 0, 0, 12, 1, 1, 'Tests', NULL, NULL, NULL, NULL),
(12, 0, 0, 0, 12, 1, 1, 'Services', NULL, NULL, NULL, NULL),
(13, 0, 0, 0, 12, 1, 1, 'About', NULL, NULL, NULL, NULL),
(31, 1, 0, 0, 10, 1, 0, 'Phone No', 'fab fa-whatsapp', NULL, NULL, NULL),
(32, 1, 0, 0, 10, 1, 0, 'Info', 'far fa-envelope', 'mailto:info@site.com', NULL, NULL),
(50, 2, 3, 0, 10, 1, 0, 'App', 'fas fa-bullseye', NULL, NULL, NULL),
(51, 2, 0, 0, 10, 2, 0, 'Log In', 'far fa-user', NULL, NULL, 'page-user-login.php'),
(52, 2, 0, 0, 10, 2, 0, 'Registration', 'far fa-user-plus', NULL, NULL, 'page-user-reg.php'),
(101, 11, 1, 0, 12, 1, 1, 'Emotional Intelligence', NULL, NULL, NULL, NULL),
(102, 11, 0, 0, 12, 1, 2, 'Femininity and Masculinity', NULL, NULL, NULL, NULL),
(103, 11, 0, 0, 12, 1, 3, 'Situated Emotion', NULL, NULL, NULL, NULL),
(104, 11, 0, 0, 12, 1, 4, 'Sexual Imprint', NULL, NULL, NULL, NULL),
(121, 12, 0, 0, 12, 1, 1, 'Consultations', NULL, NULL, NULL, 'page-services.php'),
(122, 12, 0, 0, 12, 1, 2, 'Daily Tips', NULL, NULL, NULL, 'page-prices.php'),
(123, 12, 0, 0, 12, 1, 3, 'Books', NULL, NULL, NULL, 'page-gallery.php'),
(131, 13, 2, 0, 12, 1, 1, 'About us', NULL, NULL, NULL, NULL),
(132, 13, 0, 0, 12, 2, 2, 'Contacts', NULL, NULL, NULL, 'page-contacts.php'),
(133, 13, 0, 0, 12, 1, 3, 'FAQs', NULL, NULL, NULL, 'page-faq.php'),
(3101, 3, 0, 0, 0, 1, 1, 'Home', 'fas fa-home', NULL, NULL, NULL),
(3200, 3, 0, 0, 0, 1, 2, 'our Tests', 'far fa-check-square', NULL, NULL, 'app-tests.php'),
(3300, 3, 0, 0, 0, 1, 3, 'Consultations', 'far fa-heart', NULL, NULL, NULL),
(3400, 3, 0, 0, 0, 1, 4, 'Books', 'fas fa-book', NULL, NULL, 'app-books.php'),
(3401, -1, 0, 0, 0, 1, 4, 'Book', 'fas fa-book', NULL, NULL, NULL),
(3500, 3, 0, 0, 0, 1, 5, 'Tips', 'far fa-comment', NULL, NULL, 'app-tips.php'),
(3800, 3, 0, 0, 0, 1, 8, 'Notifications', 'far fa-bell', NULL, NULL, NULL),
(3900, 3, 0, 0, 0, 1, 9, 'Contact', 'far fa-envelope', NULL, NULL, 'app-contact.php'),
(4101, 4, 0, 0, 0, 2, 1, 'Call US', 'fas fa-phone', NULL, '_BLANK', NULL),
(4102, 4, 0, 0, 0, 2, 2, 'Text US', 'far fa-comments', NULL, '_BLANK', NULL),
(4103, 4, 0, 0, 0, 2, 3, 'Mail US', 'far fa-envelope', NULL, '_BLANK', NULL),
(4104, 4, 0, 0, 0, 1, 4, 'Facebook', 'fab fa-facebook', 'https://www.facebook.com/DRX-268165804045453', '_BLANK', NULL),
(4105, 4, 0, 0, 0, 1, 5, 'Twitter', 'fab fa-twitter', 'https://twitter.com/Docteur_xxx', '_BLANK', NULL),
(4106, 4, 0, 0, 0, 2, 6, 'Google', 'fab fa-google-plus', NULL, '_BLANK', NULL),
(4107, 4, 0, 0, 0, 1, 7, 'LinkedIn', 'fab fa-linkedin', NULL, '_BLANK', NULL),
(4108, 4, 0, 0, 0, 1, 8, 'Instagram', 'fab fa-instagram', 'https://www.instagram.com/p/BrUfewbHaWQ/', '_BLANK', NULL),
(4109, 4, 0, 0, 0, 2, 9, 'Pinterest', 'fab fa-pinterest', NULL, '_BLANK', NULL),
(4110, 4, 0, 0, 0, 2, 10, 'YouTube', 'fab fa-youtube', NULL, '_BLANK', NULL),
(4111, 4, 0, 0, 0, 2, 11, 'Skype', 'fab fa-skype', NULL, '_BLANK', NULL),
(4112, 4, 0, 0, 0, 1, 12, 'Telegram', 'fab fa-telegram', 'https://t.me/Doctorxconsult\"', '_BLANK', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phs_menu_type`
--

DROP TABLE IF EXISTS `phs_menu_type`;
CREATE TABLE IF NOT EXISTS `phs_menu_type` (
  `type_id` tinyint(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `type_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_menu_type`
--

INSERT INTO `phs_menu_type` (`type_id`, `type_name`) VALUES
(12, 'Dropdown'),
(10, 'Link'),
(11, 'Mega Menu'),
(0, 'Menu'),
(1, 'Top Left Menu'),
(2, 'Top Right Menu');

-- --------------------------------------------------------

--
-- Table structure for table `phs_metta`
--

DROP TABLE IF EXISTS `phs_metta`;
CREATE TABLE IF NOT EXISTS `phs_metta` (
  `mtta_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `metta_type` varchar(50) NOT NULL DEFAULT 'name' COMMENT 'Type',
  `metta_name` varchar(200) NOT NULL COMMENT 'Name',
  `metta_value` text NOT NULL COMMENT 'Value',
  PRIMARY KEY (`mtta_id`),
  UNIQUE KEY `metta_name` (`metta_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_metta`
--

INSERT INTO `phs_metta` (`mtta_id`, `metta_type`, `metta_name`, `metta_value`) VALUES
(0, 'http-equiv', 'X-UA-Compatible', 'IE=edge,chrome=1'),
(1, 'name', 'autor', 'PhSoft'),
(3, 'name', 'keywords', 'Software, PhSoft, Software house, ERP, ORACLE, JAVA, PHP'),
(4, 'name', 'description', 'PhSoft is a famous Software house in the middle east'),
(5, 'name', 'viewport', 'width=device-width, initial-scale=1.0'),
(7, 'property', 'og:site_name', 'PhSoft'),
(8, 'property', 'og:title', 'PhSoft'),
(9, 'property', 'og:description', 'PhSoft is a famous Software house in the middle east'),
(10, 'property', 'og:type', 'website'),
(11, 'property', 'og:image', 'http://www.phsoft.biz/images/phsoft.png'),
(12, 'property', 'og:url', 'http://www.phsoft.biz');

-- --------------------------------------------------------

--
-- Table structure for table `phs_perms`
--

DROP TABLE IF EXISTS `phs_perms`;
CREATE TABLE IF NOT EXISTS `phs_perms` (
  `perm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `pgrp_id` int(11) NOT NULL COMMENT 'Permission Group',
  `perm_table` varchar(255) NOT NULL COMMENT 'Table Name',
  `perm_perm` int(11) NOT NULL COMMENT 'Permission',
  PRIMARY KEY (`perm_id`),
  KEY `pgrp_id` (`pgrp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_perms`
--

INSERT INTO `phs_perms` (`perm_id`, `pgrp_id`, `perm_table`, `perm_perm`) VALUES
(1, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_news', 0),
(2, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_news_images', 0),
(3, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_book', 0),
(4, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_book_page', 0),
(5, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_consultation', 0),
(6, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_consult_assign', 0),
(7, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_consult_answer', 0),
(8, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_consultation_status', 0),
(9, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_tips', 0),
(10, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_tips_category', 0),
(11, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_ads', 0),
(12, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_faq', 0),
(13, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_faq_category', 0),
(14, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_page', 0),
(15, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_page_row', 0),
(16, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_page_row_block', 0),
(17, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_pgroup', 0),
(18, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_slider_mst', 0),
(19, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_slider_trn', 0),
(20, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_team', 0),
(21, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_team_names', 0),
(22, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_user', 0),
(23, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_video', 0),
(24, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_vteam', 0),
(25, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_block_type', 0),
(26, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_color', 0),
(27, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_cols', 0),
(28, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_country', 0),
(29, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_every', 0),
(30, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_gender', 0),
(31, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_keys', 0),
(32, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_keyvalues', 0),
(33, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_language', 0),
(34, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_menu', 0),
(35, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_menu_type', 0),
(36, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_metta', 0),
(37, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_perms', 0),
(38, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_pgroup', 0),
(39, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_repeat', 0),
(40, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_setting', 0),
(41, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_slider_cols', 0),
(42, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_slider_type', 0),
(43, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_status', 0),
(44, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_users', 0),
(45, -2, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_vkeys', 0),
(46, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_news', 0),
(47, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_news_images', 0),
(48, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_book', 0),
(49, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_book_page', 0),
(50, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_consultation', 0),
(51, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_consult_assign', 0),
(52, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_consult_answer', 0),
(53, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_consultation_status', 0),
(54, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_tips', 0),
(55, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}app_tips_category', 0),
(56, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_ads', 0),
(57, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_faq', 0),
(58, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_faq_category', 0),
(59, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_page', 0),
(60, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_page_row', 0),
(61, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_page_row_block', 0),
(62, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_pgroup', 0),
(63, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_slider_mst', 0),
(64, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_slider_trn', 0),
(65, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_team', 0),
(66, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_team_names', 0),
(67, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_user', 0),
(68, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_video', 0),
(69, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}cpy_vteam', 0),
(70, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_block_type', 0),
(71, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_color', 0),
(72, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_cols', 0),
(73, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_country', 0),
(74, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_every', 0),
(75, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_gender', 0),
(76, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_keys', 0),
(77, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_keyvalues', 0),
(78, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_language', 0),
(79, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_menu', 0),
(80, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_menu_type', 0),
(81, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_metta', 0),
(82, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_perms', 0),
(83, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_pgroup', 0),
(84, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_repeat', 0),
(85, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_setting', 0),
(86, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_slider_cols', 0),
(87, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_slider_type', 0),
(88, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_status', 0),
(89, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_users', 0),
(90, 0, '{6A1D0879-AF8C-4AB3-A7EA-4259112CB8B2}phs_vkeys', 0);

-- --------------------------------------------------------

--
-- Table structure for table `phs_pgroup`
--

DROP TABLE IF EXISTS `phs_pgroup`;
CREATE TABLE IF NOT EXISTS `phs_pgroup` (
  `pgrp_id` int(11) NOT NULL COMMENT 'PK',
  `pgrp_name` varchar(255) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`pgrp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_pgroup`
--

INSERT INTO `phs_pgroup` (`pgrp_id`, `pgrp_name`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `phs_repeat`
--

DROP TABLE IF EXISTS `phs_repeat`;
CREATE TABLE IF NOT EXISTS `phs_repeat` (
  `repeat_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `repeat_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`repeat_id`),
  UNIQUE KEY `repeat_name` (`repeat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_repeat`
--

INSERT INTO `phs_repeat` (`repeat_id`, `repeat_name`) VALUES
(1, 'No Repeat'),
(2, 'Repeat');

-- --------------------------------------------------------

--
-- Table structure for table `phs_setting`
--

DROP TABLE IF EXISTS `phs_setting`;
CREATE TABLE IF NOT EXISTS `phs_setting` (
  `set_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `set_name` varchar(100) NOT NULL COMMENT 'Name',
  `set_val` varchar(255) NOT NULL DEFAULT 'none' COMMENT 'Value',
  PRIMARY KEY (`set_id`),
  UNIQUE KEY `set_name` (`set_name`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_setting`
--

INSERT INTO `phs_setting` (`set_id`, `set_name`, `set_val`) VALUES
(7, 'Disp-Header', '1'),
(8, 'Disp-Footer', '1'),
(10, 'Search-Result-Lines', '3'),
(27, 'Main-Menu', '0'),
(29, 'Site-Name', 'Eve Adam Online'),
(30, 'Disp-Facebook', '1'),
(31, 'URL-facebook', 'https://www.facebook.com/PageRef'),
(32, 'Disp-Search', '1'),
(34, 'Default-Slider', 'Main Slider'),
(35, 'Top-Right-Menu', '2'),
(36, 'Top-Left-Menu', '1'),
(37, 'Disp-Top-Right-Menu', '1'),
(38, 'Disp-Top-Left-Menu', '1'),
(39, 'Disp-Slider', '1'),
(40, 'Disp-PreHeader', '1'),
(41, 'Disp-Menu-Search', '1'),
(42, 'Disp-PreFooter', '1'),
(43, 'Home-Menu', '10'),
(44, 'Disp-Langs', '1'),
(45, 'App-Web-URL', 'http://localhost:8080/eadrx/app'),
(46, 'App-Android-URL', 'http://localhost:8080/eadrx/downloads/androida.apk'),
(47, 'Nav-Left-Menu', '3'),
(48, 'Nav-Right-Menu', '4'),
(49, 'TIPS-FREE', '1'),
(50, 'TIPS-PAID', '2'),
(51, 'APP-DISP-ADS', '0'),
(52, 'APP-DISP-FreeTips', '1'),
(53, 'Currency-Sign', '$'),
(54, 'Path-Ads-Images', 'assets/img/adsImages/'),
(55, 'Path-Book-Images', 'assets/img/bookImages/'),
(56, 'Path-Test-Images', 'assets/img/testImages/'),
(57, 'App-Menu-Book', '3401'),
(60, 'App-Mode-Login', '0'),
(61, 'App-Mode-Register', '-1'),
(62, 'App-Page-Login', 'app-login.php'),
(63, 'App-Page-Book-Subscribe', 'app-book-subscribe.php'),
(64, 'App-Page-Main', 'app-main.php'),
(65, 'App-Menu-Test', '3201'),
(66, 'App-Menu-Take-Test', '3209'),
(67, 'App-Menu-Book-Subscribe', '3409'),
(68, 'App-Page-Book', 'app-book.php'),
(69, 'App-Page-Take-Test', 'app-test-take.php'),
(70, 'App-Page-Register', 'app-register.php');

-- --------------------------------------------------------

--
-- Table structure for table `phs_slider_cols`
--

DROP TABLE IF EXISTS `phs_slider_cols`;
CREATE TABLE IF NOT EXISTS `phs_slider_cols` (
  `scols_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK ',
  `scols_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`scols_id`),
  UNIQUE KEY `scols_name` (`scols_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_slider_cols`
--

INSERT INTO `phs_slider_cols` (`scols_id`, `scols_name`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6');

-- --------------------------------------------------------

--
-- Table structure for table `phs_slider_type`
--

DROP TABLE IF EXISTS `phs_slider_type`;
CREATE TABLE IF NOT EXISTS `phs_slider_type` (
  `stype_jd` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK ',
  `stype_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`stype_jd`),
  UNIQUE KEY `stype_name` (`stype_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_slider_type`
--

INSERT INTO `phs_slider_type` (`stype_jd`, `stype_name`) VALUES
(1, 'Carousel'),
(2, 'OWL');

-- --------------------------------------------------------

--
-- Table structure for table `phs_status`
--

DROP TABLE IF EXISTS `phs_status`;
CREATE TABLE IF NOT EXISTS `phs_status` (
  `status_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `status_name` (`status_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_status`
--

INSERT INTO `phs_status` (`status_id`, `status_name`) VALUES
(1, 'Active'),
(2, 'Not Active');

-- --------------------------------------------------------

--
-- Table structure for table `phs_users`
--

DROP TABLE IF EXISTS `phs_users`;
CREATE TABLE IF NOT EXISTS `phs_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `pgrp_id` int(11) DEFAULT NULL COMMENT 'Permission Group',
  `user_logon` varchar(100) NOT NULL COMMENT 'Logon Name',
  `user_password` varchar(100) NOT NULL COMMENT 'Password',
  `user_email` varchar(100) NOT NULL COMMENT 'Email',
  PRIMARY KEY (`user_id`),
  KEY `pgrp_id` (`pgrp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_users`
--

INSERT INTO `phs_users` (`user_id`, `pgrp_id`, `user_logon`, `user_password`, `user_email`) VALUES
(3, -1, 'haytham', '964dfe818a21e507d424ac718218fbf0', 'h.phsoft@gmail.com'),
(4, -1, 'admin', 'eb0a191797624dd3a48fa681d3061212', 'site_admin@eveadamonline.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `phs_vkeys`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `phs_vkeys`;
CREATE TABLE IF NOT EXISTS `phs_vkeys` (
`key_id` int(11)
,`key_name` varchar(100)
,`key_defvalue` varchar(100)
,`lang_id` int(11)
,`lang_name` varchar(100)
,`lang_dir` varchar(10)
,`status_id` tinyint(4)
,`lang_code` varchar(10)
,`kval_id` int(11)
,`key_value` varchar(250)
,`key_rvalue` varchar(250)
,`key_text` text
);

-- --------------------------------------------------------

--
-- Structure for view `app_vbook`
--
DROP TABLE IF EXISTS `app_vbook`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_vbook`  AS  select `b`.`book_id` AS `book_id`,`b`.`lang_id` AS `lang_id`,`b`.`status_id` AS `status_id`,`b`.`book_title` AS `book_title`,`b`.`book_desc` AS `book_desc`,`b`.`book_image` AS `book_image`,`b`.`book_price` AS `book_price`,`b`.`ins_datetime` AS `ins_datetime`,`p`.`bpage_id` AS `bpage_id`,`p`.`page_num` AS `page_num`,`p`.`page_image` AS `page_image`,`p`.`page_text` AS `page_text` from (`app_book` `b` join `app_book_page` `p`) where (`p`.`book_id` = `b`.`book_id`) ;

-- --------------------------------------------------------

--
-- Structure for view `app_vcons_cat`
--
DROP TABLE IF EXISTS `app_vcons_cat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_vcons_cat`  AS  select `t`.`cat_id` AS `cat_id`,`t`.`cat_order` AS `cat_order`,`t`.`cat_name` AS `cat_iname`,`t`.`status_id` AS `status_id`,`t`.`cat_Price` AS `cat_price`,`n`.`ncat_id` AS `ncat_id`,`n`.`lang_id` AS `lang_id`,`n`.`cat_name` AS `cat_name`,`n`.`cat_desc` AS `cat_desc` from (`app_consultation_category` `t` join `app_consultation_category_name` `n`) where (`n`.`cat_id` = `t`.`cat_id`) ;

-- --------------------------------------------------------

--
-- Structure for view `app_vtest`
--
DROP TABLE IF EXISTS `app_vtest`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_vtest`  AS  select `t`.`test_id` AS `test_id`,`t`.`test_num` AS `test_num`,`t`.`test_iname` AS `test_iname`,`t`.`status_id` AS `status_id`,`t`.`test_price` AS `test_price`,`t`.`test_image` AS `test_image`,`n`.`ntest_id` AS `ntest_id`,`n`.`lang_id` AS `lang_id`,`n`.`test_name` AS `test_name`,`n`.`test_desc` AS `test_desc` from (`app_test` `t` join `app_test_name` `n`) where (`n`.`test_id` = `t`.`test_id`) ;

-- --------------------------------------------------------

--
-- Structure for view `app_vtest_evaluate`
--
DROP TABLE IF EXISTS `app_vtest_evaluate`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_vtest_evaluate`  AS  select `v`.`test_id` AS `test_id`,`v`.`test_num` AS `test_num`,`v`.`test_iname` AS `test_iname`,`v`.`status_id` AS `status_id`,`v`.`test_price` AS `test_price`,`v`.`test_image` AS `test_image`,`v`.`ntest_id` AS `ntest_id`,`v`.`lang_id` AS `lang_id`,`v`.`test_name` AS `test_name`,`v`.`test_desc` AS `test_desc`,`e`.`eval_id` AS `eval_id`,`e`.`gend_id` AS `gend_id`,`e`.`eval_from` AS `eval_from`,`e`.`eval_to` AS `eval_to`,`e`.`eval_text` AS `eval_text` from (`app_vtest` `v` join `app_test_evaluate` `e`) where ((`e`.`test_id` = `v`.`test_id`) and (`e`.`lang_id` = `v`.`lang_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `app_vtest_question`
--
DROP TABLE IF EXISTS `app_vtest_question`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_vtest_question`  AS  select `v`.`test_id` AS `test_id`,`v`.`test_num` AS `test_num`,`v`.`test_iname` AS `test_iname`,`v`.`status_id` AS `status_id`,`v`.`test_price` AS `test_price`,`v`.`test_image` AS `test_image`,`v`.`ntest_id` AS `ntest_id`,`v`.`lang_id` AS `lang_id`,`v`.`test_name` AS `test_name`,`v`.`test_desc` AS `test_desc`,`q`.`qstn_id` AS `qstn_id`,`q`.`gend_id` AS `gend_id`,`q`.`qstn_num` AS `qstn_num`,`q`.`qstn_text` AS `qstn_text`,`q`.`qstn_ansr1` AS `qstn_ansr1`,`q`.`qstn_ansr2` AS `qstn_ansr2`,`q`.`qstn_ansr3` AS `qstn_ansr3`,`q`.`qstn_ansr4` AS `qstn_ansr4`,`q`.`qstn_rep1` AS `qstn_rep1`,`q`.`qstn_rep2` AS `qstn_rep2`,`q`.`qstn_rep3` AS `qstn_rep3`,`q`.`qstn_rep4` AS `qstn_rep4`,`q`.`qstn_val1` AS `qstn_val1`,`q`.`qstn_val2` AS `qstn_val2`,`q`.`qstn_val3` AS `qstn_val3`,`q`.`qstn_val4` AS `qstn_val4` from (`app_vtest` `v` join `app_test_question` `q`) where ((`q`.`test_id` = `v`.`test_id`) and (`q`.`lang_id` = `v`.`lang_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `cpy_vteam`
--
DROP TABLE IF EXISTS `cpy_vteam`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cpy_vteam`  AS  select `m`.`team_id` AS `team_id`,`m`.`team_iname` AS `team_iname`,`m`.`team_order` AS `team_order`,`m`.`team_photo` AS `team_photo`,`t`.`teamn_id` AS `teamn_id`,`t`.`lang_id` AS `lang_id`,`t`.`team_name` AS `team_name`,`t`.`team_title` AS `team_title`,`t`.`team_position` AS `team_position`,`t`.`team_text` AS `team_text` from (`cpy_team` `m` join `cpy_team_names` `t`) where (`t`.`team_id` = `m`.`team_id`) ;

-- --------------------------------------------------------

--
-- Structure for view `phs_vkeys`
--
DROP TABLE IF EXISTS `phs_vkeys`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `phs_vkeys`  AS  select `k`.`key_id` AS `key_id`,`k`.`key_name` AS `key_name`,`k`.`key_defvalue` AS `key_defvalue`,`l`.`lang_id` AS `lang_id`,`l`.`lang_name` AS `lang_name`,`l`.`lang_dir` AS `lang_dir`,`l`.`status_id` AS `status_id`,`l`.`lang_code` AS `lang_code`,`v`.`kval_id` AS `kval_id`,`v`.`key_value` AS `key_value`,`v`.`key_rvalue` AS `key_rvalue`,`v`.`key_text` AS `key_text` from ((`phs_keys` `k` join `phs_language` `l`) join `phs_keyvalues` `v`) where ((`v`.`key_id` = `k`.`key_id`) and (`v`.`lang_id` = `l`.`lang_id`)) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_book`
--
ALTER TABLE `app_book`
  ADD CONSTRAINT `app_book_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`),
  ADD CONSTRAINT `app_book_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `app_book_page`
--
ALTER TABLE `app_book_page`
  ADD CONSTRAINT `app_book_page_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `app_book` (`book_id`);

--
-- Constraints for table `app_consultation`
--
ALTER TABLE `app_consultation`
  ADD CONSTRAINT `app_consultation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`),
  ADD CONSTRAINT `app_consultation_ibfk_2` FOREIGN KEY (`cstatus_id`) REFERENCES `app_consultation_status` (`cstatus_id`),
  ADD CONSTRAINT `app_consultation_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `app_consultation_category` (`cat_id`);

--
-- Constraints for table `app_consultation_category`
--
ALTER TABLE `app_consultation_category`
  ADD CONSTRAINT `app_consultation_category_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `app_consultation_category_name`
--
ALTER TABLE `app_consultation_category_name`
  ADD CONSTRAINT `app_consultation_category_name_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `app_consultation_category` (`cat_id`),
  ADD CONSTRAINT `app_consultation_category_name_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`);

--
-- Constraints for table `app_consult_answer`
--
ALTER TABLE `app_consult_answer`
  ADD CONSTRAINT `app_consult_answer_ibfk_1` FOREIGN KEY (`cons_id`) REFERENCES `app_consultation` (`cons_id`),
  ADD CONSTRAINT `app_consult_answer_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

--
-- Constraints for table `app_consult_assign`
--
ALTER TABLE `app_consult_assign`
  ADD CONSTRAINT `app_consult_assign_ibfk_1` FOREIGN KEY (`cons_id`) REFERENCES `app_consultation` (`cons_id`),
  ADD CONSTRAINT `app_consult_assign_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`),
  ADD CONSTRAINT `app_consult_assign_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

--
-- Constraints for table `app_notification`
--
ALTER TABLE `app_notification`
  ADD CONSTRAINT `app_notification_ibfk_1` FOREIGN KEY (`for_id`) REFERENCES `app_notif_for` (`for_id`),
  ADD CONSTRAINT `app_notification_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`);

--
-- Constraints for table `app_notification_for`
--
ALTER TABLE `app_notification_for`
  ADD CONSTRAINT `app_notification_for_ibfk_1` FOREIGN KEY (`notif_id`) REFERENCES `app_notification` (`notif_id`),
  ADD CONSTRAINT `app_notification_for_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`),
  ADD CONSTRAINT `app_notification_for_ibfk_3` FOREIGN KEY (`nstatus_id`) REFERENCES `app_notif_status` (`nstatus_id`);

--
-- Constraints for table `app_notification_status`
--
ALTER TABLE `app_notification_status`
  ADD CONSTRAINT `app_notification_status_ibfk_1` FOREIGN KEY (`notif_id`) REFERENCES `app_notification` (`notif_id`),
  ADD CONSTRAINT `app_notification_status_ibfk_2` FOREIGN KEY (`nstatus_id`) REFERENCES `app_notif_status` (`nstatus_id`),
  ADD CONSTRAINT `app_notification_status_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

--
-- Constraints for table `app_test`
--
ALTER TABLE `app_test`
  ADD CONSTRAINT `app_test_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `app_test_evaluate`
--
ALTER TABLE `app_test_evaluate`
  ADD CONSTRAINT `app_test_evaluate_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `app_test` (`test_id`);

--
-- Constraints for table `app_test_name`
--
ALTER TABLE `app_test_name`
  ADD CONSTRAINT `app_test_name_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`),
  ADD CONSTRAINT `app_test_name_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `app_test` (`test_id`);

--
-- Constraints for table `app_test_question`
--
ALTER TABLE `app_test_question`
  ADD CONSTRAINT `app_test_question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `app_test` (`test_id`),
  ADD CONSTRAINT `app_test_question_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`),
  ADD CONSTRAINT `app_test_question_ibfk_3` FOREIGN KEY (`gend_id`) REFERENCES `phs_gender` (`gend_id`);

--
-- Constraints for table `app_test_results`
--
ALTER TABLE `app_test_results`
  ADD CONSTRAINT `app_test_results_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `app_test` (`test_id`),
  ADD CONSTRAINT `app_test_results_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

--
-- Constraints for table `app_tips`
--
ALTER TABLE `app_tips`
  ADD CONSTRAINT `app_tips_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`),
  ADD CONSTRAINT `app_tips_ibfk_2` FOREIGN KEY (`tcat_id`) REFERENCES `app_tips_category` (`tcat_id`),
  ADD CONSTRAINT `app_tips_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `app_tips_category`
--
ALTER TABLE `app_tips_category`
  ADD CONSTRAINT `app_tips_category_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `cpy_ads`
--
ALTER TABLE `cpy_ads`
  ADD CONSTRAINT `cpy_ads_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`),
  ADD CONSTRAINT `cpy_ads_ibfk_2` FOREIGN KEY (`repeat_id`) REFERENCES `phs_repeat` (`repeat_id`),
  ADD CONSTRAINT `cpy_ads_ibfk_3` FOREIGN KEY (`every_id`) REFERENCES `phs_every` (`every_id`),
  ADD CONSTRAINT `cpy_ads_ibfk_4` FOREIGN KEY (`hour_sid`) REFERENCES `phs_hour` (`hour_id`),
  ADD CONSTRAINT `cpy_ads_ibfk_5` FOREIGN KEY (`hour_eid`) REFERENCES `phs_hour` (`hour_id`);

--
-- Constraints for table `cpy_faq`
--
ALTER TABLE `cpy_faq`
  ADD CONSTRAINT `cpy_faq_ibfk_1` FOREIGN KEY (`fcat_id`) REFERENCES `cpy_faq_category` (`fcat_id`),
  ADD CONSTRAINT `cpy_faq_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`),
  ADD CONSTRAINT `cpy_faq_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`),
  ADD CONSTRAINT `cpy_faq_ibfk_4` FOREIGN KEY (`color_id`) REFERENCES `phs_color` (`color_id`);

--
-- Constraints for table `cpy_faq_category`
--
ALTER TABLE `cpy_faq_category`
  ADD CONSTRAINT `cpy_faq_category_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `cpy_news`
--
ALTER TABLE `cpy_news`
  ADD CONSTRAINT `cpy_news_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `cpy_news_images`
--
ALTER TABLE `cpy_news_images`
  ADD CONSTRAINT `cpy_news_images_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `cpy_news` (`news_id`);

--
-- Constraints for table `cpy_page`
--
ALTER TABLE `cpy_page`
  ADD CONSTRAINT `cpy_page_ibfk_1` FOREIGN KEY (`slid_id`) REFERENCES `cpy_slider_mst` (`slid_id`),
  ADD CONSTRAINT `cpy_page_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `cpy_page_row`
--
ALTER TABLE `cpy_page_row`
  ADD CONSTRAINT `cpy_page_row_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `cpy_page` (`page_id`),
  ADD CONSTRAINT `cpy_page_row_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`),
  ADD CONSTRAINT `cpy_page_row_ibfk_4` FOREIGN KEY (`color_id`) REFERENCES `phs_color` (`color_id`),
  ADD CONSTRAINT `cpy_page_row_ibfk_5` FOREIGN KEY (`slid_id`) REFERENCES `cpy_slider_mst` (`slid_id`),
  ADD CONSTRAINT `cpy_page_row_ibfk_6` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`);

--
-- Constraints for table `cpy_page_row_block`
--
ALTER TABLE `cpy_page_row_block`
  ADD CONSTRAINT `cpy_page_row_block_ibfk_1` FOREIGN KEY (`row_id`) REFERENCES `cpy_page_row` (`row_id`),
  ADD CONSTRAINT `cpy_page_row_block_ibfk_2` FOREIGN KEY (`cols_id`) REFERENCES `phs_cols` (`cols_id`),
  ADD CONSTRAINT `cpy_page_row_block_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`),
  ADD CONSTRAINT `cpy_page_row_block_ibfk_5` FOREIGN KEY (`slid_id`) REFERENCES `cpy_slider_mst` (`slid_id`),
  ADD CONSTRAINT `cpy_page_row_block_ibfk_6` FOREIGN KEY (`video_id`) REFERENCES `cpy_video` (`video_id`),
  ADD CONSTRAINT `cpy_page_row_block_ibfk_7` FOREIGN KEY (`type_id`) REFERENCES `phs_block_type` (`type_id`);

--
-- Constraints for table `cpy_slider_mst`
--
ALTER TABLE `cpy_slider_mst`
  ADD CONSTRAINT `cpy_slider_mst_ibfk_1` FOREIGN KEY (`scols_id`) REFERENCES `phs_slider_cols` (`scols_id`),
  ADD CONSTRAINT `cpy_slider_mst_ibfk_2` FOREIGN KEY (`stype_id`) REFERENCES `phs_slider_type` (`stype_jd`);

--
-- Constraints for table `cpy_slider_trn`
--
ALTER TABLE `cpy_slider_trn`
  ADD CONSTRAINT `cpy_slider_trn_ibfk_1` FOREIGN KEY (`slid_id`) REFERENCES `cpy_slider_mst` (`slid_id`);

--
-- Constraints for table `cpy_user`
--
ALTER TABLE `cpy_user`
  ADD CONSTRAINT `cpy_user_ibfk_1` FOREIGN KEY (`cntry_id`) REFERENCES `phs_country` (`cntry_id`),
  ADD CONSTRAINT `cpy_user_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`),
  ADD CONSTRAINT `cpy_user_ibfk_3` FOREIGN KEY (`gend_id`) REFERENCES `phs_gender` (`gend_id`),
  ADD CONSTRAINT `cpy_user_ibfk_4` FOREIGN KEY (`pgrp_id`) REFERENCES `cpy_pgroup` (`pgrp_id`);

--
-- Constraints for table `phs_country`
--
ALTER TABLE `phs_country`
  ADD CONSTRAINT `phs_country_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `phs_language`
--
ALTER TABLE `phs_language`
  ADD CONSTRAINT `phs_language_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `phs_menu`
--
ALTER TABLE `phs_menu`
  ADD CONSTRAINT `phs_menu_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`),
  ADD CONSTRAINT `phs_menu_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `phs_menu_type` (`type_id`),
  ADD CONSTRAINT `phs_menu_ibfk_3` FOREIGN KEY (`menu_pid`) REFERENCES `phs_menu` (`menu_id`),
  ADD CONSTRAINT `phs_menu_ibfk_4` FOREIGN KEY (`page_id`) REFERENCES `cpy_page` (`page_id`),
  ADD CONSTRAINT `phs_menu_ibfk_5` FOREIGN KEY (`test_id`) REFERENCES `app_test` (`test_id`);

--
-- Constraints for table `phs_perms`
--
ALTER TABLE `phs_perms`
  ADD CONSTRAINT `phs_perms_ibfk_1` FOREIGN KEY (`pgrp_id`) REFERENCES `phs_pgroup` (`pgrp_id`);

--
-- Constraints for table `phs_users`
--
ALTER TABLE `phs_users`
  ADD CONSTRAINT `phs_users_ibfk_1` FOREIGN KEY (`pgrp_id`) REFERENCES `phs_pgroup` (`pgrp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
