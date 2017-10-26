INSERT INTO `fx_users` (`id`, `username`, `password`, `email`, `role_id`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`)
VALUES
	(1, 'admin', '$P$B/NST6C0kpUCwag1xNg4SED9N6ksCE/', 'email@domain.com', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2016-04-28 22:02:23', '2016-03-30 14:13:16', '2016-04-28 22:02:23');


INSERT INTO `fx_account_details` (`id`, `user_id`, `fullname`, `company`, `city`, `country`, `locale`, `address`, `phone`, `mobile`, `skype`, `language`, `department`, `avatar`, `use_gravatar`, `as_company`, `allowed_modules`, `hourly_rate`)
VALUES
	(1, 1, 'Admin', '-', NULL, NULL, 'en_US', '-', '', NULL, NULL, 'english', NULL, 'default_avatar.jpg', 'N', 'false', NULL, 0.00);
