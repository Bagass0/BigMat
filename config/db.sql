-- Adminer 4.8.1 MySQL 5.5.5-10.3.39-MariaDB-0+deb10u1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ACTIVITES`;
CREATE TABLE `ACTIVITES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `THEME` text NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATE` date NOT NULL,
  `HEURE` text NOT NULL,
  `SALLE` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `ACTIVITES` (`ID`, `EVENT_ID`, `THEME`, `DESCRIPTION`, `DATE`, `HEURE`, `SALLE`) VALUES
(1,	1,	'National Museum of Scotland',	'Différentes sections: Automobile, sciences naturelles, art, mode, histoire de l\'Ecosse,…<br><br>\r\n*Point d\'intérêt: Au dernier étage accessible par ascenseur se trouve une terrasse offrant une vue à 360 degrés sur Edimbourg',	'0000-00-00',	'10h00 - 17h00',	'Chambers St, Edinburgh EH1 1JF'),
(2,	1,	'Scottish National Portrait Gallery',	'Collection de tableaux<br><br>\r\n*Point d\'intérêt: Le hall d\'entrée est sublime avec des fresques murales impressionnantes',	'0000-00-00',	'10h00 - 17h00',	'2 Queen St, Edinburgh EH2 1JD'),
(3,	1,	'National Gallery of Scotland',	'Collection de tableaux, dessins & Sculptures',	'0000-00-00',	'10h00 - 17h00',	'The Mound, Edinburgh EH2 2EL'),
(4,	1,	'Scottish National Gallery of Modern&nbsp;Art',	'Collection d\'art contemporain',	'0000-00-00',	'10h00 - 17h00',	'76 Belford Rd, Edinburgh EH4 3DS'),
(5,	2,	'Scottish Textiles Showcase',	'Cachemire / Laine / Plaid Créateur & artisans écossais',	'0000-00-00',	'Lundi - Samedi: 10h00 - 18h00<br>Dimanche: 11h00 - 18h00',	'44-46 Victoria St, Edinburgh EH1 2JP'),
(6,	2,	'Tron Kirk Market',	'Créateur & artisans locaux Bijoux, décoration, textile,…',	'0000-00-00',	'Lundi - Dimanche: 10h00 - 18h00',	'122 High St, Edinburgh EH1 1SG'),
(7,	2,	'Scottish Design Exchange',	'Créateur & artisans locaux Bijoux, décoration, textile,…',	'0000-00-00',	'Lundi: 11h00 - 17h00<br>Mardi - Samedi: 11h00 - 18h00<br>Dimanche: 11h00 - 17h30',	'117-119 George St, Edinburgh EH2 4JN'),
(8,	2,	'Mackenzie Leather',	'Accessoires en cuir faits main',	'0000-00-00',	'Lundi - Samedi: 10h00 - 18h00',	'17 St Mary\'s St, Edinburgh EH1 1TA'),
(9,	2,	'I.J Mellis Cheesemonger Victoria Street',	'Fromages',	'0000-00-00',	'Lundi - Vendredi: 10h00 - 18h00<br>Dimanche: 11h00 - 18h00',	'A, 30 Victoria St, Edinburgh EH1 2JW'),
(10,	2,	'Cadenhead\'s Whisky Shop',	'Whisky',	'0000-00-00',	'Lundi - Samedi: 10h30 - 17h30',	'189 Canongate, Edinburgh EH8 8BN'),
(11,	2,	'Royal Mile Whiskies',	'Whisky',	'0000-00-00',	'Lundi - Dimanche: 10h00 - 18h00',	'379 High St, Edinburgh EH1 1PW'),
(12,	2,	'Fudge House',	'Fudge - Caramel écossais',	'0000-00-00',	'Lundi - Vendredi: 10h00 - 16h30<br>Samedi: 10h00 - 17h00',	'197 Canongate, Edinburgh EH8 8BN'),
(13,	2,	'Harvey Nichols<br>\n(Au 4ème étage - Étage du haut)',	'Poduits locaux type: Shortbread, chutney, marmelade, fugde…',	'0000-00-00',	'Lundi - Mercredi: 10h00 - 18h00<br>Vendredi - Samedi: 10h00 - 19h00<br>Dimanche: 11h00 - 18h00',	'30-34 St Andrew Square, Edinburgh EH2 2LL'),
(14,	2,	'Isle of Skye Candles',	'Bougies fabriquées sur l\'île de Skye',	'0000-00-00',	'Lundi - Dimanche: 09h30 - 18h30',	'93 W Bow, Edinburgh EH1 2JP'),
(15,	3,	'Walker Slater Femme',	'Vêtements en tweed',	'0000-00-00',	'Lundi - Samedi: 10h00 - 18h00<br>Dimanche: 11h00 - 18h00',	'44-46 Victoria St, Edinburgh EH1 2JP'),
(16,	3,	'Walker Slater Homme',	'Vêtements en tweed',	'0000-00-00',	'Lundi - Vendredi: 10h00 - 18h00<br>Dimanche: 11h00 - 18h00',	'16-20 Victoria St, Edinburgh EH1 2HG'),
(17,	3,	'Hawico Scotland',	'Cachemire / Laine',	'0000-00-00',	'Lundi - Samedi: 10h00 - 18h00',	'71 Grassmarket, Edinburgh EH1 2HJ'),
(18,	3,	'Brora Edinburgh',	'Cachemire / Laine',	'0000-00-00',	'Lundi - Samedi: 10h00 - 17h00',	'48 Frederick St, Edinburgh EH2 1EX'),
(19,	3,	'House of Edinburgh',	'Cachemire / Laine / Echarpe /\nPull',	'0000-00-00',	'Lundi - Dimanche: 10h00 - 19h00',	'2 St Giles\' St, Edinburgh EH1 1PT'),
(20,	3,	'Kiltane of Scotland',	'Cachemire / Laine / Echarpe /\nPull',	'0000-00-00',	'Lundi - Dimanche: 10h30 - 19h00',	'336-340 Lawnmarket, Edinburgh EH1 2PH'),
(21,	4,	'Whiski Bar & Restaurant',	'Live Music tous les soirs Pub traditionnel Sur la Royal Mile',	'0000-00-00',	'Lundi - Dimanche: 12h00 - 01h00',	'119 High St, Edinburgh EH1 1SG'),
(22,	4,	'The Bow Bar',	'Pub traditionnel Sur Victoria Street',	'0000-00-00',	'Lundi - Dimanche: 12h00 - 00h00',	'80 W Bow, Edinburgh EH1 2HH'),
(23,	4,	'Maggie Dicksons',	'Pub\nSur Grassmarket',	'0000-00-00',	'Lundi - Dimanche: 12h00 - 01h00',	'92 Grassmarket, Edinburgh EH1 2JR'),
(24,	4,	'The White Hart Inn',	'Pub traditionnel Sur Grassmarket',	'0000-00-00',	'Dimanche - Jeudi: 12h00 - 00h00<br>Vendredi - Samedi: 12h00 - 01h00',	'32 Grassmarket, Edinburgh EH1 2JU'),
(25,	4,	'Cold Town House',	'Bar avec rooftop vu sur le château Sur Grassmarket',	'0000-00-00',	'Lundi - Mercredi: 12h00 - 23h00<br>Vendredi: 12h00 - 00h00<br>Samedi: 11h00 - 01h00<br>\r\nDimanche: 11h00 - 23h00',	'4 Grassmarket, Edinburgh EH1 2JU'),
(26,	4,	'Salt Horse Beer Shop,<br>Bar & Kitchen',	'Bar spécialisé dans les bières',	'0000-00-00',	'Lundi - Mardi: 16h00 - 00h00<br>Jeudi - Dimanche: 12h00 - 00h00',	'57-61 Blackfriars St, Edinburgh EH1 1NB'),
(27,	4,	'The Holyrood 9A',	'Pub\nSur Cowgate',	'0000-00-00',	'Lundi - Vendredi: 10h00 - 00h00<br>Samedi - Dimanche: 10h00 - 01h00',	'9a Holyrood Rd, Edinburgh EH8 8AE'),
(28,	4,	'The Hanging Bat',	'Bar à bière Sur Lothian Road',	'0000-00-00',	'Dimanche - Jeudi: 12h00 - 00h00<br>Vendredi - Samedi: 12h00 - 01h00',	'133 Lothian Rd, Edinburgh EH3 9AB'),
(29,	5,	'The Stramash',	'Live music tous les soirs / Styles différents Pub\nSur Cowgate',	'0000-00-00',	'Lundi - Dimanche: 17h00 - 03h00',	'207 Cowgate, Edinburgh EH1 1JQ'),
(30,	5,	'Tigerlily',	'Bar Trendy Dans la New Town',	'0000-00-00',	'Lundi - Dimanche: 08h00 - 01h00',	'125 George St, Edinburgh EH2 4JN'),
(31,	5,	'Ghillie Dhu',	'Pub avec Live music Dans la New Town',	'0000-00-00',	'Vendredi - Dimanche: 12h00 - 03h00',	'2, Rutland Place, Edinburgh EH1 2AD'),
(32,	5,	'Kitty O\'Shea\'s Edinburgh',	'Pub/Club Dans la New Town',	'0000-00-00',	'Lundi - Jeudi: 17h00 - 03h00<br>Vendredi: 15h00 - 03h00<br>Samedi - Dimanche: 12h00 - 03h00',	'43B Frederick St, Edinburgh EH2 1EP'),
(33,	5,	'The Queens Arms',	'Pub traditionnel Dans la New Town',	'0000-00-00',	'Lundi - Jeudi: 12h00 - 23h00<br>Vendredi: 12h00 - 01h00<br>Samedi: 11h00 - 01h00<br>Dimanche: 11h00 - 00h00',	'49 Frederick St, Edinburgh EH2 1EP'),
(34,	5,	'Elios Edinburgh',	'Bar à cocktail Dans la New Town',	'0000-00-00',	'Dimanche - Jeudi: 15h00 - 03h00<br>Vendredi: 14h00 - 03h00<br>Samedi: 12h00 - 03h00',	'38, 38A George St, Edinburgh EH2 2LE'),
(35,	5,	'Dirty Dick\'s Pub',	'Pub traditionnel',	'0000-00-00',	'Lundi - Dimanche: 12h00 - 01h00',	'159 Rose St, Edinburgh EH2 4LS'),
(36,	5,	'The Black Cat Bar',	'Live music chaque dimanche après-midi de 16h à 19h00<br>\nChaque Lundi, Mercredi & Jeudi soir de 21h30 à 00h30<br>\nPub',	'0000-00-00',	'Lundi - Dimanche: 11h00 - 01h00',	'168 Rose St, Edinburgh EH2 4BA'),
(37,	5,	'The Auld Hundred',	'Pub',	'0000-00-00',	'Lundi - Jeudi: 12h00 - 00h00<br>Vendredi: 12h00 - 01h00<br>Samedi: 11h00 - 01h00<br>Dimanche: 11h00 - 00h00',	'100 Rose St, Edinburgh EH2 2NN'),
(38,	5,	'Fierce Beer',	'Pub spécialisé dans les bières',	'0000-00-00',	'Lundi - Mardi: 14h00 - 22h00<br>Mercredi - Vendredi: 14h00 - 00h00<br>Samedi: 12h00 - 00h00<br>Dimanche: 13h00–22h00',	'167 Rose St, Edinburgh EH2 4LS'),
(39,	6,	'LULU',	'Club sous le bar Tigerlily Dans la New Town',	'0000-00-00',	'Jeudi - Dimanche: 22h30 - 03h00',	'125b George St, Edinburgh EH2 4JN'),
(40,	6,	'Why Not Nightclub',	'Club\nDans la New Town',	'0000-00-00',	'Lundi & Mercredi: 22h30 - 03h00<br>Vendredi & Samedi: 22h30 - 03h00',	'14 George St, Edinburgh EH2 2PF');

DROP TABLE IF EXISTS `EVENTS`;
CREATE TABLE `EVENTS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CREATION` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PAR` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPTION` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATE_IN` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATE_OUT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `OPT_ACCUEIL` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_ACTUALITES` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_PROGRAMME` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_HEBERGEMENT` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_INFOSPRATIQUES` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_PRESSE` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_CONTACT` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_INSCRIPTION` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_ACTIVITES` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_HEBERGEMENT2` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_TRANSPORT` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `EVENTS` (`ID`, `NOM`, `CREATION`, `PAR`, `DESCRIPTION`, `DATE_IN`, `DATE_OUT`, `OPT_ACCUEIL`, `OPT_ACTUALITES`, `OPT_PROGRAMME`, `OPT_HEBERGEMENT`, `OPT_INFOSPRATIQUES`, `OPT_PRESSE`, `OPT_CONTACT`, `OPT_INSCRIPTION`, `OPT_ACTIVITES`, `OPT_HEBERGEMENT2`, `OPT_TRANSPORT`) VALUES
(1,	'Voyage courtage national',	'22/03/2022 - 14h05',	'2',	'',	'2022-06-07',	'2022-06-12',	1,	0,	1,	0,	1,	1,	1,	1,	0,	0,	0);

DROP TABLE IF EXISTS `HOTELS`;
CREATE TABLE `HOTELS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `NOM` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ADRESSE1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ADRESSE2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CP` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `VILLE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TEL` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `STOCK_SGL` int(11) NOT NULL DEFAULT 0,
  `STOCK_DBL` int(11) NOT NULL DEFAULT 0,
  `STOCK_TWIN` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `PROFILS`;
CREATE TABLE `PROFILS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `MATRICULE` int(11) NOT NULL,
  `PASSWORD` text NOT NULL,
  `PARTICIPATION` tinyint(1) NOT NULL,
  `ISVALID` tinyint(1) NOT NULL,
  `ISPRIVILEGIE` tinyint(1) NOT NULL,
  `CIVILITE` text NOT NULL,
  `NOM` text NOT NULL,
  `PRENOM` text NOT NULL,
  `FONCTION` text NOT NULL,
  `SOCIETE_ID` int(11) NOT NULL,
  `TYPE_SOC` text NOT NULL,
  `SECTEUR` text NOT NULL,
  `NUM_TVA` text NOT NULL,
  `CA` int(11) NOT NULL,
  `A_PAYER` int(11) NOT NULL,
  `CGV` tinyint(1) NOT NULL,
  `REF_COURRIER` text NOT NULL,
  `ADRESSE` text NOT NULL,
  `ADRESSE2` text NOT NULL,
  `CP` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `VILLE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAYS` text NOT NULL,
  `TEL` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `EMAIL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MOBILE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `REMARQUES` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ENREGISTREMENT` text NOT NULL,
  `CONNEXION` text NOT NULL,
  `DROIT` int(11) NOT NULL DEFAULT 0,
  `DATE_IN` date NOT NULL,
  `DATE_OUT` date NOT NULL,
  `HOTEL_ID` int(11) NOT NULL,
  `TRANSPORT_ALLER1_ID` int(11) DEFAULT NULL,
  `TRANSPORT_ALLER2_ID` int(11) NOT NULL,
  `TRANSPORT_RETOUR_1_ID` int(11) NOT NULL,
  `TRANSPORT_RETOUR_2_ID` int(11) NOT NULL,
  `DEJEUNER` text NOT NULL,
  `DINER` text NOT NULL,
  `ATELIER1_ID` int(11) NOT NULL,
  `ATELIER2_ID` int(11) NOT NULL,
  `ATELIER3_ID` int(11) NOT NULL,
  `ATELIER4_ID` int(11) NOT NULL,
  `ATELIER5_ID` int(11) NOT NULL,
  `DAY1` tinyint(1) DEFAULT 0,
  `DAY2` tinyint(1) DEFAULT 0,
  `NIGHT1` tinyint(1) DEFAULT 0,
  `NIGHT2` tinyint(1) DEFAULT 0,
  `NB_TICKETS` tinyint(1) DEFAULT 0,
  `CADEAU` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `ROOM`;
CREATE TABLE `ROOM` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `HOTELS_ID` int(11) NOT NULL,
  `ROOM_TYPE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `SITE_ACCUEIL`;
CREATE TABLE `SITE_ACCUEIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_ACCUEIL` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_ACCUEIL_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_ACCUEIL_T_EDITO` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_ACCUEIL_EDITO` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_BLOCS` int(11) NOT NULL,
  `NB_SLIDES` int(11) NOT NULL,
  `TITRE_BLOCS` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `SITE_ACTUS`;
CREATE TABLE `SITE_ACTUS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_ACTUALITE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_ACTUALITE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_ACTUALITE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_ACTUS` int(11) NOT NULL,
  `TITRE_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `SITE_CONTACT`;
CREATE TABLE `SITE_CONTACT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_CONTACT` text NOT NULL,
  `TXT_CONTACT_ST` text NOT NULL,
  `MAIL_CONTACT` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `SITE_CONTACT` (`ID`, `EVENT_ID`, `PIC_CONTACT`, `TXT_CONTACT_ST`, `MAIL_CONTACT`) VALUES
(3,	1,	'',	'ALL',	'courtage@voyages-abeille-assurances.fr');

DROP TABLE IF EXISTS `SITE_HEBERGEMENT`;
CREATE TABLE `SITE_HEBERGEMENT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_HEBERGEMENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_HEBERGEMENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H1_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC1_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC2_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC3_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MAP_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H2_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC1_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC2_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC3_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MAP_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H3_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC1_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC2_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC3_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MAP_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `SITE_INFOS_PRAT`;
CREATE TABLE `SITE_INFOS_PRAT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_INFOS` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_INFOS` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P1_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P2_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P3_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P4_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P5_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P6_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_CONTACT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_CONTACT_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `SITE_INSCRIPTION`;
CREATE TABLE `SITE_INSCRIPTION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `BANNIERE` text NOT NULL,
  `SOUS_TITRE` text NOT NULL,
  `CIVILITE` int(11) NOT NULL DEFAULT 0,
  `NOM` int(11) NOT NULL DEFAULT 0,
  `PRENOM` int(11) NOT NULL DEFAULT 0,
  `EMAIL` int(11) NOT NULL DEFAULT 0,
  `MOBILE` int(11) NOT NULL DEFAULT 0,
  `SOCIETE` int(11) NOT NULL DEFAULT 0,
  `FONCTION` int(11) NOT NULL DEFAULT 0,
  `ADRESSE` int(11) NOT NULL DEFAULT 0,
  `CODE_POSTAL` int(11) NOT NULL DEFAULT 0,
  `VILLE` int(11) NOT NULL DEFAULT 0,
  `COMMENTAIRES` int(11) NOT NULL DEFAULT 0,
  `HEBERGEMENT` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `SITE_PRESSE`;
CREATE TABLE `SITE_PRESSE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_PRESSE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PRESSE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_PRESSE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_PRESSE` int(11) NOT NULL,
  `TITRE_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `SITE_PROGRAMME`;
CREATE TABLE `SITE_PROGRAMME` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_PROGRAMME` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_PROGRAMME` int(11) NOT NULL DEFAULT 0,
  `TXT_PROGRAMME_J1_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J2_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J3_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J4_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J5_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J6_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J7_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J8_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J9_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `SOCIETE`;
CREATE TABLE `SOCIETE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) NOT NULL,
  `ADRESSE1` varchar(255) DEFAULT NULL,
  `ADRESSE2` varchar(255) DEFAULT NULL,
  `ADRESSE3` varchar(255) DEFAULT NULL,
  `CP` varchar(255) DEFAULT NULL,
  `VILLE` varchar(255) DEFAULT NULL,
  `PAYS` varchar(255) DEFAULT NULL,
  `TEL` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `TVA` varchar(255) DEFAULT NULL,
  `CA` varchar(255) DEFAULT NULL,
  `A_PAYE` int(11) DEFAULT 0,
  `CGV` tinyint(1) DEFAULT 0,
  `AGENCES` text DEFAULT NULL,
  `METIER` text DEFAULT NULL,
  `SOUS_METIER` text DEFAULT NULL,
  `LOGO` text DEFAULT NULL,
  `REFUS` text DEFAULT NULL,
  `VALIDE` int(11) NOT NULL DEFAULT 0,
  `SITE_INTERNET` text DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `ID_2` (`ID`),
  UNIQUE KEY `ID_3` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `SOCIETE` (`ID`, `NOM`, `ADRESSE1`, `ADRESSE2`, `ADRESSE3`, `CP`, `VILLE`, `PAYS`, `TEL`, `EMAIL`, `TVA`, `CA`, `A_PAYE`, `CGV`, `AGENCES`, `METIER`, `SOUS_METIER`, `LOGO`, `REFUS`, `VALIDE`, `SITE_INTERNET`) VALUES
(194,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	NULL,	NULL,	'',	'',	'',	'',	NULL,	1,	'');

DROP TABLE IF EXISTS `TRANSPORTS`;
CREATE TABLE `TRANSPORTS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT_ID` int(11) DEFAULT NULL,
  `TYPE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MOYEN` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NOM` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `NUMERO` text NOT NULL,
  `DE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `A` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DATE_DEPART` text NOT NULL,
  `HEURE_DEPART` text NOT NULL,
  `DATE_ARRIVEE` text NOT NULL,
  `HEURE_ARRIVEE` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `USERS`;
CREATE TABLE `USERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PASSWORD` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PARTICIPATION` tinyint(4) DEFAULT NULL,
  `CIVILITE` text DEFAULT NULL,
  `NOM` text NOT NULL,
  `PRENOM` text NOT NULL,
  `SOCIETE_ID` int(11) NOT NULL DEFAULT 194,
  `FONCTION` text DEFAULT NULL,
  `ADRESSE1` text DEFAULT NULL,
  `DATE_NAISS` text DEFAULT NULL,
  `LIEU_NAISS` text DEFAULT NULL,
  `TEL` text DEFAULT NULL,
  `NATIONALITE` text DEFAULT NULL,
  `EMAIL` text NOT NULL,
  `MATRICULE` text DEFAULT NULL,
  `HOTEL_ID` text DEFAULT NULL,
  `ENREGISTREMENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CONNEXION` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `GROUPE` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '1',
  `FIRST_CO` int(11) DEFAULT 0,
  `DROIT` int(11) DEFAULT 0,
  `TYPE_CHAMBRE` text DEFAULT NULL,
  `IS_VALID` tinyint(4) DEFAULT 1,
  `GROUPE_VOYAGE` tinyint(4) DEFAULT NULL,
  `ADRESSE2` text DEFAULT NULL,
  `NUM_PASSPORT` text DEFAULT NULL,
  `DATE_EMISSION` text DEFAULT NULL,
  `LIEU_EMISSION` text DEFAULT NULL,
  `DATE_EXPIRATION` text DEFAULT NULL,
  `AGENCE` text DEFAULT NULL,
  `SINGLE` text DEFAULT NULL,
  `CIVILITE_ACC` text DEFAULT NULL,
  `NOM_ACC` text DEFAULT NULL,
  `PRENOM_ACC` text DEFAULT NULL,
  `MAIL_ACC` text DEFAULT NULL,
  `TEL_ACC` text DEFAULT NULL,
  `DATE_NAISS_ACC` text DEFAULT NULL,
  `LIEU_NAISS_ACC` text DEFAULT NULL,
  `NATIONALITE_ACC` text DEFAULT NULL,
  `NUM_PASSPORT_ACC` text DEFAULT NULL,
  `DATE_EMISSION_ACC` text DEFAULT NULL,
  `LIEU_EMISSION_ACC` text DEFAULT NULL,
  `DATE_EXPIRATION_ACC` text DEFAULT NULL,
  `INFO_6` text DEFAULT NULL,
  `INFO_7` text DEFAULT NULL,
  `INFO_8` text DEFAULT NULL,
  `INFO_9` text DEFAULT NULL,
  `INFO_10` text DEFAULT NULL,
  `INFO_11` text DEFAULT NULL,
  `INFO_12` text DEFAULT NULL,
  `STATUT` varchar(255) DEFAULT NULL,
  `SOUS_METIER` text DEFAULT NULL,
  `IS_PRIVILEGIE` tinyint(4) DEFAULT 1,
  `REMARQUES` text DEFAULT NULL,
  `REMARQUES_ACC` text DEFAULT NULL,
  `CONDITIONS` text DEFAULT NULL,
  `CONDITIONS_ACC` text DEFAULT NULL,
  `MOYEN` text DEFAULT NULL,
  `VOYAGE` text DEFAULT NULL,
  `UPLOAD_PHOTO` text DEFAULT NULL,
  `UPLOAD_PASSPORT` text DEFAULT NULL,
  `UPLOAD_PHOTO_ACC` text DEFAULT NULL,
  `UPLOAD_PASSPORT_ACC` text DEFAULT NULL,
  `ACCOMPAGNEMENT` text DEFAULT NULL,
  `REMARQUES_ALI` text DEFAULT NULL,
  `REMARQUES_ALI_ACC` text DEFAULT NULL,
  `LAST_SAVE` text DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `ID_2` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `USERS` (`ID`, `PASSWORD`, `PARTICIPATION`, `CIVILITE`, `NOM`, `PRENOM`, `SOCIETE_ID`, `FONCTION`, `ADRESSE1`, `DATE_NAISS`, `LIEU_NAISS`, `TEL`, `NATIONALITE`, `EMAIL`, `MATRICULE`, `HOTEL_ID`, `ENREGISTREMENT`, `CONNEXION`, `GROUPE`, `FIRST_CO`, `DROIT`, `TYPE_CHAMBRE`, `IS_VALID`, `GROUPE_VOYAGE`, `ADRESSE2`, `NUM_PASSPORT`, `DATE_EMISSION`, `LIEU_EMISSION`, `DATE_EXPIRATION`, `AGENCE`, `SINGLE`, `CIVILITE_ACC`, `NOM_ACC`, `PRENOM_ACC`, `MAIL_ACC`, `TEL_ACC`, `DATE_NAISS_ACC`, `LIEU_NAISS_ACC`, `NATIONALITE_ACC`, `NUM_PASSPORT_ACC`, `DATE_EMISSION_ACC`, `LIEU_EMISSION_ACC`, `DATE_EXPIRATION_ACC`, `INFO_6`, `INFO_7`, `INFO_8`, `INFO_9`, `INFO_10`, `INFO_11`, `INFO_12`, `STATUT`, `SOUS_METIER`, `IS_PRIVILEGIE`, `REMARQUES`, `REMARQUES_ACC`, `CONDITIONS`, `CONDITIONS_ACC`, `MOYEN`, `VOYAGE`, `UPLOAD_PHOTO`, `UPLOAD_PASSPORT`, `UPLOAD_PHOTO_ACC`, `UPLOAD_PASSPORT_ACC`, `ACCOMPAGNEMENT`, `REMARQUES_ALI`, `REMARQUES_ALI_ACC`, `LAST_SAVE`) VALUES
(1,	'$kTINCD3n+BYal0kU84ue4g$a0Lq3nSsw0UJRjwL9Dj154nJOQ8h1FD1WqIpLwAPtyM',	0,	'Mr',	'Gabsi',	'Théo',	194,	NULL,	NULL,	'2023-05-10',	'uytrez',	'0',	'azertyui',	't.gabsi@agence-arep.com',	NULL,	NULL,	NULL,	'22-06-2023 15:59',	'1',	1,	0,	'Double',	1,	1,	NULL,	'iuytrez',	'2023-05-17',	'iuytrez',	'2023-05-09',	'gftrhtr',	'Non',	'Mr',	'uytreza',	'ytreza',	'yhgfd@gmail.com',	'0606060606',	'2023-05-10',	'kujyhtgrf',	'tgfds',	'htgrfedzs',	'2023-05-26',	'yhtgrfedz',	'2023-05-16',	'',	NULL,	NULL,	NULL,	NULL,	'',	'',	NULL,	NULL,	1,	'',	'tghtrh',	'1',	'1',	NULL,	NULL,	'théo-gabsi-trombinoscope-1.jpg',	'théo-gabsi-1.png',	'théo-gabsi-trombinoscope-acc-1.png',	'théo-gabsi-acc-1.png',	'0',	'a',	'g',	'2023-05-16 14:02:02'),
(5,	'$lmayP+YQJo6qb5x89XnO2Q$bFHt0RQiKuk00qr47h9FCZfZC7eNJnK6gwODVc/CTVs',	NULL,	'Mr',	'SUDAKA',	'Fabrice',	194,	NULL,	NULL,	'',	'',	'',	'',	'f.sudaka@agence-arep.com',	NULL,	NULL,	NULL,	'14-02-2023 09:14',	'1',	0,	0,	'',	1,	1,	NULL,	'',	'',	'',	'',	'',	'Non',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	'',	'',	NULL,	NULL,	1,	'',	'',	'',	NULL,	NULL,	NULL,	'',	'',	'',	'',	'',	'',	'',	''),
(9,	'$ckWbnnHe2q0AhiVgQNrhsQ$kpoHkteorI1eeW2HDemg6uEAbuLE2lWeIaAjm0QnDtg',	0,	'',	'Assurances',	'Abeille',	194,	NULL,	NULL,	'',	'',	'',	'',	'admin',	NULL,	NULL,	NULL,	'13-06-2023 18:02',	'ADMIN',	1,	1,	'',	1,	NULL,	NULL,	'',	'',	'',	'',	'',	'Non',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	'',	'',	NULL,	NULL,	1,	'',	'',	'0',	NULL,	NULL,	NULL,	'',	'',	'',	'',	'',	'',	'',	'');

-- 2023-08-01 12:36:14
