CREATE TABLE IF NOT EXISTS /*_*/thicc_threads (
  `th_thread_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `th_page_id` int(10) unsigned NOT NULL,
  `th_title` varbinary(255) NOT NULL,
  PRIMARY KEY (`th_thread_id`),
  UNIQUE KEY (`th_page_id`)
) /*$wgDBTableOptions*/;