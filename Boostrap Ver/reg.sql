
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `user_user` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User Name',
  `user_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Password',
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Real Name',
  `user_sex` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Sex',
  `user_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Phone',
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'E-mail',
  `user_skills` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Skills',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user_account` (`user_user`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO user VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '0', 'Male', '0', '0', '0');