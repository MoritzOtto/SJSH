#
# Table structure for table 'tx_sjshljemadmin_aks'
#
CREATE TABLE tx_sjshljemadmin_aks (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	sort tinytext,
	u tinytext,
	jahrgang tinytext,
	jahrgang2 tinytext,
	runden tinytext,
	modus tinytext,
	staffel tinytext,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_sjshljemadmin_ergebnisse'
#
CREATE TABLE tx_sjshljemadmin_ergebnisse (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	klasse tinytext,
	runde tinytext,
	tisch tinytext,
	id1 tinytext,
	id2 tinytext,
	erg1 tinytext,
	erg2 tinytext,
	flag tinytext,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_sjshljemadmin_spieler'
#
CREATE TABLE tx_sjshljemadmin_spieler (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	name tinytext,
	attr tinytext,
	elo tinytext,
	dwz tinytext,
	verein tinytext,
	jahr tinytext,
	foto tinytext,
	rang tinytext,
	punkte tinytext,
	punktebuch tinytext,
	buch tinytext,
	soberg tinytext,
	buchsum tinytext,
	s tinytext,
	r tinytext,
	v tinytext,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);