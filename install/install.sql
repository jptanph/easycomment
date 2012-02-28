CREATE TABLE `easycomment_contents` (
  `idx` int(100) NOT NULL AUTO_INCREMENT,
  `seq` int(100) NOT NULL,
  `url_idx` int(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `visitor_name` varchar(100) NOT NULL,
  `visitor_comment` longtext NOT NULL,
  `password` varchar(100) NOT NULL,
  `comment_date` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=605 DEFAULT CHARSET=latin1;


CREATE TABLE `easycomment_settings` (
  `idx` int(100) NOT NULL AUTO_INCREMENT,
  `comment_limit` int(100) NOT NULL,
  `unauthorized_word` longtext NOT NULL,
  `background_color` varchar(100) NOT NULL,
  `text_color` varchar(100) NOT NULL,
  `header_color` varchar(100) NOT NULL,
  `header_text_color` varchar(100) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

CREATE TABLE `easycomment_url` (
  `idx` int(90) NOT NULL AUTO_INCREMENT,
  `url` longtext NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
