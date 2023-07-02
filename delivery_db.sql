

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) primary key,
  `name` varchar(180)  NOT NULL unique,
  `image` varchar(255)  default NULL,
  `route` varchar(255) default NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP
);
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) primary key ,
  `email` varchar(255) NOT NULL unique,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255)NOT NULL,
  `phone` varchar(80)  NOT NULL unique,
  `image` varchar(255)  DEFAULT NULL,
  `password` varchar(255)  NOT NULL,
  `is_available` tinyint(1) DEFAULT NULL,
  `session_token` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);



DROP TABLE IF EXISTS `user_has_roles`;
CREATE TABLE IF NOT EXISTS `user_has_roles` (
  `id_user` int(11) NOT NULL,
  `id_rol`  int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  foreign key(id_user) references  users(id) on update cascade on delete cascade,
  foreign key(id_rol) references  roles(id) on update cascade on delete cascade,
  PRIMARY KEY (`id_user`,`id_rol`)
) ;

