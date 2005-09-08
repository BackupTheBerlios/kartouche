# Table structure for Kartouche v0.2, 28 October 2003
# Only the Hall of Fame table needs to be created; the
# others are created on import of the pot files
#
# --------------------------------------------------------

#
# Table structure for table `admin_hallfame`
#

CREATE TABLE `admin_hallfame` (
  `id` int(3) unsigned NOT NULL auto_increment,
  `handle` varchar(100) default NULL,
  `file` varchar(50) NOT NULL default '',
  `string` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

