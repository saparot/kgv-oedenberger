DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`
(
    `id`        int(11)                                            NOT NULL AUTO_INCREMENT,
    `user_name` varchar(180) COLLATE utf8mb4_unicode_ci            NOT NULL,
    `roles`     longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    `password`  varchar(255) COLLATE utf8mb4_unicode_ci            NOT NULL,
    `email`     varchar(255) COLLATE utf8mb4_unicode_ci            NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `UNIQ_8D93D64924A232CF` (`user_name`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `user`
VALUES (1, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$oTSt0raFRSIlreZVW77FFOUURmLkD1GNYFaFQtmGLdDwU6XI60rcq', 'admin@example.com');
#password is "password" here

DROP TABLE IF EXISTS `doctrine_migration_versions`;

CREATE TABLE `doctrine_migration_versions`
(
    `version`        varchar(191) COLLATE utf8_unicode_ci NOT NULL,
    `executed_at`    datetime DEFAULT NULL,
    `execution_time` int(11)  DEFAULT NULL,
    PRIMARY KEY (`version`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

DROP TABLE IF EXISTS `download_file`;

CREATE TABLE `download_file`
(
    `id`           int(11)                                 NOT NULL AUTO_INCREMENT,
    `name`         varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description`  varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `file_name`    varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `time_updated` datetime                                NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `download_file`
VALUES (1, 'Antrag Lauben/Inventarversicherung', 'Antrag Lauben/Inventarversicherung, Merkblatt dazu kann auf https://www.l-b-k.de/materialien.html abgerufen werden.',
        '62ca79d1b6432_Anmeldevordruck GBV FED UV.pdf', '2022-07-10 09:03:45');


DROP TABLE IF EXISTS `executive`;
CREATE TABLE `executive`
(
    `id`       int(11)                                 NOT NULL AUTO_INCREMENT,
    `name`     varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `sort`     int(11)                                 NOT NULL,
    `email`    varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `phone`    varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `executive`
VALUES (1, 'Erste Musterfrau', '1. Vorsitzende', 1, 'mail@example.com', NULL),
       (2, 'Zweiter Mustermann', '2. Vorsitzender', 2, 'mail@example.com', NULL),
       (3, 'Dritter Mustermann', 'Kassier', 3, 'mail@example.com', NULL),
       (4, 'Vierte Musterfrau', 'Schriftführerin', 4, 'mail@example.com', NULL);

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`
(
    `id`           int(11)                                 NOT NULL AUTO_INCREMENT,
    `title`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description`  longtext COLLATE utf8mb4_unicode_ci     NOT NULL,
    `time_created` datetime                                NOT NULL,
    `time_updated` datetime                                NOT NULL,
    `time_publish` date                                    NOT NULL,
    `is_published` tinyint(1)                              NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 13
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `news`
VALUES (1, 'Umfrage der Universität für Kleingärtner',
        '<p>Liebe Kleing&auml;rtner,</p>\r\n\r\n<p>das Institut f&uuml;r Geographie der Universit&auml;t f&uuml;hrt in Zusammenarbeit<br />\r\nmit dem <a href=\"https://kleingaertner-nuernberg.de/\" target=\"_blank\"><strong>Stadtverband der Kleing&auml;rtner</strong></a>&nbsp;aktuell eine Befragung der Kleing&auml;rtner durch.</p>\r\n\r\n<p>Es w&auml;re sch&ouml;n wenn Sie einige Minuten aufbringen k&ouml;nnten, um daran teilzunehmen.&nbsp;Die Teilnahme ist m&ouml;glich vom&nbsp;25. Juni bis 29. August 2021. Das komplette Schreiben mit Hintergrundinformationen ist hier zu finden:</p>\r\n\r\n<p>Der Stadtverband der Kleing&auml;rtner w&uuml;rde sich freuen, wenn m&ouml;glichst viele Mitglieder an der Befragung teilnehmen und ihre Erfahrungen und Einsch&auml;tzungen zum Zusammenleben in Kleing&auml;rten teilen.</p>\r\n\r\n<p>Hier geht es direkt zur <strong>anonymen Umfrage</strong>:&nbsp;<a href=\"https://bit.ly/3gN2Beg\" target=\"_blank\">https://bit.ly/3gN2Beg</a>&nbsp;&nbsp;</p>',
        '2021-07-27 00:10:27', '2022-03-07 11:39:38', '2021-07-27', 0),
       (2, 'Jahreshauptversammlung 2021',
        '<p>Liebe Gartenfreundin, lieber Gartenfreund,</p>\r\n\r\n<p>hier das Schreiben vom 08.02.2021 zur Jahreshauptversammlung.&nbsp;</p>\r\n\r\n<p>aufgrund der aktuellen Situation k&ouml;nnen&nbsp;wir die Jahreshauptversammlung nicht wie gewohnt im 1. Quartal 2021 durchf&uuml;hren.&nbsp;</p>\r\n\r\n<p>Die Kleingartenvereine, die dem Stadtverband N&uuml;rnberg angeh&ouml;ren, wurden gebeten, die Mitgliederversamlung erst durchzuf&uuml;hren, wenn die f&uuml;r 2020 geplante Versammlung des Stadtverbandes N&uuml;rnberg mit der dazugeh&ouml;rigen Wahl nachgeholt wurde.&nbsp;</p>\r\n\r\n<p>Da unser 2. Vorstand zum 31.12.2020 von seinem Amt zur&uuml;ckgetreten ist, werden wird bei unserer n&auml;chsten Jahreshauptversammlung die Zuwahl eines neuen 2. Vorstands durchf&uuml;hren. Bis dahin &uuml;bernimmt Herr Max Mustermann kommissarisch die Aufgaben des 2. Vorstands.</p>\r\n\r\n<p>Sobald wir neue Informationen haben, bzw. eine Jahreshauptversammlung anberaumen k&ouml;nnen, werden wir Sie entsprechend informieren.</p>\r\n\r\n<p>Mit freundlichen Gr&uuml;&szlig;en,</p>\r\n\r\n<p>Der Vorstand</p>',
        '2021-07-28 09:00:28', '2021-07-28 09:04:02', '2021-07-28', 0),
       (3, 'Wasserschließung',
        '<h2>am Samstag, 23. Oktober 2021</h2>\r\n\r\n<p>wird ab 8.00 Uhr das Wasser abgesperrt und von uns im&nbsp;eingebauten Zustand abgelesen.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bitte stellen Sie sicher, dass</p>\r\n\r\n<p><span class=\"kgv-news-entity__highlight\">dass&nbsp;das Gartent&uuml;rchen offen steht&nbsp; und&nbsp;der Wasserschachtdeckel ge&ouml;ffnet ist.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><span class=\"kgv-news-entity__text kgv-news-entity__text--important\">Bitte beachten Sie den Ablauf:</span></h3>\r\n\r\n<ul>\r\n	<li>Im Rahmen der Wasserschlie&szlig;ung &uuml;berpr&uuml;fen die Wasserwarte, ob die Plomben noch unbesch&auml;digt sind.</li>\r\n	<li>Bei Patronenz&auml;hlern lockern sie die Ringmutter der Messpatronenverschraubung.</li>\r\n	<li>Ab 15.00 Uhr k&ouml;nnen Sie Ihre Wasseruhr ausbauen, bitte bewahren Sie diese <strong>frostsicher</strong> auf!</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Vielen Dank f&uuml;r Ihre Mithilfe!</p>\r\n\r\n<p><br />\r\nIhr Vorstand</p>',
        '2021-10-02 08:12:30', '2022-03-07 11:38:55', '2021-10-02', 0),
       (4, 'Gemeinschaftsarbeit für Gartenpächter/Innen  im Oktober/ November 2021',
        '<h2>Samstag den 09.10.21</h2>\r\n\r\n<p>Garten Nr. 10,&nbsp; 18, 29, 34, 45, 47, 56</p>\r\n\r\n<h2><br />\r\nSamstag den 16.10.21</h2>\r\n\r\n<p>Garten Nr. 89, 90, 92, 103, 105, 115, 159</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Samstag den 23.10.21</h2>\r\n\r\n<p>Garten Nr. 66, 112, 126, 127, 128, 136, 144</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Samstag den 30.10.21</h2>\r\n\r\n<p>Garten Nr. 15, 17, 19, 20, 23, 24, 32, 36</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Samstag den 06.11.21</h2>\r\n\r\n<p>Garten Nr. 12, 13, 31, 38, 50, 60, 80</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Die Arbeitszeit geht von 9.00 &ndash; 12.00 Uhr.</h1>\r\n\r\n<p>Treffpunkt ist um 8:45 Uhr am Vereinsheim.<br />\r\nBitte bringen Sie Rechen, Schaufeln, Astscheren mit!<br />\r\n<br />\r\nIhre Vorstandschaft</p>',
        '2021-10-02 08:14:54', '2022-03-07 11:38:44', '2021-10-02', 0),
       (5, 'Wasseröffnung',
        '<h1>am Samstag, 09.04.2022</h1>\r\n\r\n<p>wird das <strong>Wasser</strong> wieder <strong>ge&ouml;ffnet</strong>.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span class=\"kgv-news-entity__highlight\"><strong><span class=\"kgv-news-entity__text kgv-news-entity__text--important\">Ab 8:00 Uhr</span></strong> m&uuml;ssen Gartent&uuml;rchen und<br />\r\nSchacht offen sein und der Haupthahn<br />\r\nim Schacht muss zugedreht sein. (<em><u>sonst werden 10 &euro; Bearbeitungsgeb&uuml;hr erhoben!</u></em>)</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Einbau der Wasseruhr erst <span class=\"kgv-news-entity__text kgv-news-entity__text--important\">ab 15.00 Uhr</span>!<br />\r\n&nbsp;</h2>\r\n\r\n<p><strong>Der korrekte Einbau obliegt dem Kleingartenp&auml;chter!</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Vielen Dank f&uuml;r Ihre Mitarbeit!&nbsp;</p>\r\n\r\n<p>Ihre Vorstandschaft</p>',
        '2022-03-07 11:30:41', '2022-03-07 11:54:55', '2022-03-07', 1),
       (6, 'Ausgabe Wasseruhren + Satzung / Gartenordung',
        '<p><span class=\"kgv-news-entity__text kgv-news-entity__text--important\">am Samstag, 09. April 2022 von 9-11 Uhr im Vereinsgeb&auml;ude</span></p>\r\n\r\n<p>Preis Patrone: 19,40 &euro;</p>\r\n\r\n<p>Preis Wasseruhr komplett: 49,50 &euro;</p>\r\n\r\n<p>Bitte passend zahlen!&nbsp;</p>\r\n\r\n<p>Ihr Vorstand</p>',
        '2022-03-23 10:20:54', '2022-03-23 10:21:50', '2022-03-23', 1),
       (7, 'Verplombung am 23.04.2022',
        '<p>Das ist zu tun:&nbsp;</p>\r\n\r\n<p><span class=\"kgv-news-entity__text kgv-news-entity__text--important\">ab 8.00 Uhr </span>m&uuml;ssen</p>\r\n\r\n<ul>\r\n	<li>Gartent&uuml;rchen und Schacht offen sein,</li>\r\n	<li>die Wasseruhr muss dicht sein, sonst erfolgt keine Verplombung!</li>\r\n	<li>Bei Nichtbeachtung werden 10 &euro; Bearbeitungsgeb&uuml;hr erhoben</li>\r\n</ul>',
        '2022-03-23 10:24:30', '2022-03-23 10:24:36', '2022-03-23', 1),
       (8, 'Aktuelles im Juni/ Juli',
        '<ul>\r\n	<li>&nbsp;Begehung der Kleingartenanlage durch den Vorstand am 04.07.2022</li>\r\n	<li>Jeder P&auml;chter:in wird gebeten, die Gartennummer gut lesbar am Gartentor anzubringen/ aufzumalen</li>\r\n	<li>Wir suchen P&auml;chter:innen, die eine Motors&auml;geschein haben und im Oktober beim R&uuml;ckschnitt der B&auml;ume mithelfen k&ouml;nnen</li>\r\n</ul>',
        '2022-07-02 08:01:48', '2022-07-02 08:01:48', '2022-07-02', 1),
       (9, 'Gemeinschaftsdienst 2022',
        '<p>Der Gemeinschaftsdienst findet wie folgt statt:<br />\r\n&nbsp;</p>\r\n\r\n<p>Garten <strong>26-50</strong>: Samstag, 23.07.2022</p>\r\n\r\n<p>Garten <strong>51-75</strong>: Samstag, 27.08.2022</p>\r\n\r\n<p>Garten <strong>76-100</strong>: Samstag, 10.09.2022</p>\r\n\r\n<p>Garten <strong>101-125</strong>: Samstag, 24.09.2022</p>\r\n\r\n<p>Garten <strong>126-150</strong>: Samstag, 08.10.2022</p>\r\n\r\n<p>Garten <strong>151-162</strong>: Samstag, 15.10.2022</p>\r\n\r\n<p><strong>Die Arbeitszeit geht von 8:30 &ndash; 12:30 Uhr.</strong></p>\r\n\r\n<ul>\r\n	<li>Treffpunkt ist um 8:30 Uhr am Vereinsheim.</li>\r\n	<li>Bitte bringen Sie entsprechende Arbeitsger&auml;te mit.</li>\r\n	<li>&nbsp;</li>\r\n</ul>\r\n\r\n<p><span class=\"kgv-news-entity__text kgv-news-entity__text--important\">Der Gemeinschaftsdienst darf aus versicherungsrechtlichen Gr&uuml;nden nur von aktiven bzw. passiven Mitgliedern ausgef&uuml;hrt werden. Familienangeh&ouml;rige, die kein Mitglied sind, d&uuml;rfen &ndash; auch ersatzweise &ndash; nicht teilnehmen.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ihre Vorstandschaft</p>',
        '2022-07-02 08:03:53', '2022-07-02 08:06:14', '2022-07-02', 1),
       (10, 'Wasserschließung',
        '<h2>am Samstag, 15. Oktober 2022</h2>\r\n\r\n<p>wird ab 8.00 Uhr das Wasser abgesperrt und von uns im&nbsp;eingebauten Zustand abgelesen.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bitte stellen Sie sicher, dass</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span class=\"kgv-news-entity__highlight\">dass&nbsp;das Gartent&uuml;rchen offen steht&nbsp; und&nbsp;der Wasserschachtdeckel ge&ouml;ffnet ist.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><span class=\"kgv-news-entity__text kgv-news-entity__text--important\">Bitte beachten Sie den Ablauf:</span></h3>\r\n\r\n<ul>\r\n	<li>Im Rahmen der Wasserschlie&szlig;ung &uuml;berpr&uuml;fen die Wasserwarte, ob die Plomben noch unbesch&auml;digt sind.</li>\r\n	<li>Bei Patronenz&auml;hlern lockern sie die Ringmutter der Messpatronenverschraubung.</li>\r\n	<li>Ab 15.00 Uhr k&ouml;nnen Sie Ihre Wasseruhr ausbauen, bitte bewahren Sie diese <strong>frostsicher</strong> auf!</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Vielen Dank f&uuml;r Ihre Mithilfe!</p>\r\n\r\n<p><br />\r\nIhr Vorstand</p>',
        '2022-10-09 10:27:09', '2022-10-09 10:28:19', '2022-10-09', 1),
       (11, 'Infos zum Saisonstart 2023',
        '<h4 class=\"kgv-headline--4\">Mitgliederversammlung</h4>\r\n\r\n<p>Die Mitgliederversammlung wird voraussichtlich im April stattfinden.</p>\r\n\r\n<h4 class=\"kgv-headline--4\"><br />\r\nPr&auml;mierungen</h4>\r\n\r\n<p>Im Jahr 2022 hat der Stadtverband die G&auml;rten Nr. 69 und Nr. 107 pr&auml;miert.</p>\r\n\r\n<h4 class=\"kgv-headline--4\"><br />\r\nGemeinschaftsdienst</h4>\r\n\r\n<p>Es wird wieder mehrere Termine &uuml;ber das Jahr verteilt geben. Bitte beachten Sie die<br />\r\nentsprechenden Aush&auml;nge dazu.</p>\r\n\r\n<h4 class=\"kgv-headline--4\"><br />\r\nWasser&ouml;ffnung</h4>\r\n\r\n<p>In diesem Jahr wird durch die Stadt ein neuer Hauptwasserschacht gebaut, sodass<br />\r\ndie beiden vorhandenen Sch&auml;chte stillgelegt werden k&ouml;nnen. Den genauen Termin<br />\r\nhierf&uuml;r kennen wir noch nicht. Der Termin f&uuml;r die Wasser&ouml;ffnung wird abh&auml;ngig von<br />\r\nden Bauma&szlig;nahmen und der Witterung festgelegt.</p>\r\n\r\n<p>Die Erneuerung der Absperrschieber in den einzelnen G&auml;rten wird voraussichtlich<br />\r\nerst im Herbst erfolgen.</p>\r\n\r\n<h4 class=\"kgv-headline--4\"><br />\r\nAusgabe der Wasseruhren</h4>\r\n\r\n<p>Die Ausgabe der Wasseruhren/ Patronen erfolgt am Tag der Wasser&ouml;ffnung im<br />\r\nVereinsgeb&auml;ude.</p>\r\n\r\n<h4 class=\"kgv-headline--4\"><br />\r\nSprechstunden</h4>\r\n\r\n<p><br />\r\nDie Sprechstunden finden nur telefonisch statt. Sie erreichen uns<br />\r\n<br />\r\n<span class=\"kgv-news-entity__text kgv-news-entity__text--important\">Samstags von 10-11 Uhr (0123/ 4567890), alternativ per Mail</span></p>\r\n\r\n<h3><br />\r\nWir w&uuml;nschen Ihnen ein ertragreiches und erholsames Gartenjahr!<br />\r\n<br />\r\nIhr Vorstand</h3>',
        '2023-01-21 08:39:32', '2023-01-21 08:40:20', '2023-01-21', 1),
       (12, 'Ist Ihre Wasseruhr abgelaufen?',
        '<h3>Liebe Gartenfreundin, lieber Gartenfreund!</h3>\r\n\r\n<p>Ist Ihre Wasseruhr abgelaufen?<br />\r\n<br />\r\nBrauchen Sie noch eine neue Wasseruhr?<br />\r\n<br />\r\nSie k&ouml;nnen diese gerne bis zum <span class=\"kgv-news-entity__text kgv-news-entity__text--important\">28.02.2023</span> &uuml;ber uns<br />\r\nbestellen und erhalten diese dann am Tag der<br />\r\nWasser&ouml;ffnung!<br />\r\n<br />\r\nBestellung &uuml;ber Email oder in unseren Briefkasten werfen!<br />\r\n(Name, Gartennummer, komplette Wasseruhr oder nur die<br />\r\nPatrone?)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Mit freundlichen Gr&uuml;&szlig;en<br />\r\nIhre Vorstandschaft</p>',
        '2023-01-21 08:41:37', '2023-01-21 08:41:45', '2023-01-21', 1);
