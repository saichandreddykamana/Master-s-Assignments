CREATE DATABASE `feedback application`;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `candidates` (
  `candidate_id` int(11) NOT NULL,
  `candidate_name` varchar(200) NOT NULL,
  `candidate_mail` varchar(200) NOT NULL,
  `candidate_company` varchar(50) NOT NULL,
  `candidate_position` varchar(50) NOT NULL,
  `candidate_resume` blob NOT NULL,
  `candidate_status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `candidates` (`candidate_id`, `candidate_name`, `candidate_mail`, `candidate_company`, `candidate_position`, `candidate_resume`, `candidate_status`) VALUES
(1, 'Demo Candidate', 'democandidate@gmail.com', '', 'Demo Vacancy Position ', 0x536169204368616e64205265646479204b616d616e6120526573756d652e706466, 'Pending');



CREATE TABLE `generated_feedbacks` (
  `user_id` int(5) NOT NULL,
  `generated_feedback_id` int(5) NOT NULL,
  `template_id` int(5) NOT NULL,
  `candidate_mail_id` varchar(200) NOT NULL,
  `feedback_document` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `interviewer` (
  `interviewer_id` int(5) NOT NULL,
  `interviewer_name` varchar(150) NOT NULL,
  `interviewer_mail_id` varchar(150) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `interviewer` (`interviewer_id`, `interviewer_name`, `interviewer_mail_id`, `user_id`) VALUES
(1, 'Admin Happy Tech-Manager', 'admin@happytech.com', 1);


CREATE TABLE `position` (
  `position_id` int(5) NOT NULL,
  `company_name` varchar(200) NOT NULL DEFAULT 'Happy Tech',
  `position_name` varchar(100) NOT NULL,
  `number_of_positions` int(200) NOT NULL DEFAULT 5,
  `user_id` int(5) NOT NULL,
  `position_description` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `position` (`position_id`, `company_name`, `position_name`, `number_of_positions`, `user_id`, `position_description`) VALUES
(1, 'Happy Tech', 'Demo Vacancy Position ', 1, 1, '<p><strong>Required Skills</strong></p>\r\n\r\n<ol>\r\n	<li>This is the demo template to show how the position works.</li>\r\n</ol>\r\n');


CREATE TABLE `roles` (
  `role_id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `roles` (`role_id`, `name`) VALUES
(1, 'Reviewer'),
(2, 'Admin'),
(3, 'Employee');



CREATE TABLE `role_users` (
  `role_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `role_users` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 1),
(3, 1);



CREATE TABLE `template` (
  `template_id` int(5) NOT NULL,
  `template_name` varchar(250) NOT NULL,
  `user_id` int(5) NOT NULL,
  `interviewer_id` int(5) NOT NULL,
  `position_id` int(5) NOT NULL,
  `feedback_sections` varchar(8000) DEFAULT '[]',
  `candidate_mail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `template` (`template_id`, `template_name`, `user_id`, `interviewer_id`, `position_id`, `feedback_sections`, `candidate_mail`) VALUES
(1, 'Demo Template', 1, 1, 1, '[\"Demo Feedback Comment 1\",\"Demo Feedback Comment 2\",\"Demo Feedback Comment 3\",\"Demo Feedback Comment 4\",\"Demo Feedback Comment 5\"]', 'demoCandidateMail@example.com');


CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email_id` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `company` varchar(100) DEFAULT 'Happy Tech',
  `login_attempts` int(11) NOT NULL DEFAULT 3,
  `account_disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `company`, `login_attempts`, `account_disabled`) VALUES
(1, 'Admin', 'Happy Tech-Manager', 'admin@happytech.com', '$2y$10$JxQrnT6YXRIxUAyo2AwX4.s3NcN9uD5y40h0EMe5E7uEgz1rVNCBO', 'Happy Tech', 3, 0);


ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidate_id`);


ALTER TABLE `generated_feedbacks`
  ADD PRIMARY KEY (`generated_feedback_id`),
  ADD KEY `gn_t_id` (`template_id`);


ALTER TABLE `interviewer`
  ADD PRIMARY KEY (`interviewer_id`),
  ADD UNIQUE KEY `interviewer_mail_id` (`interviewer_mail_id`);


ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);


ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);


ALTER TABLE `role_users`
  ADD UNIQUE KEY `role_user` (`role_id`,`user_id`),
  ADD KEY `r_u_id` (`user_id`);


ALTER TABLE `template`
  ADD PRIMARY KEY (`template_id`),
  ADD KEY `te_u_id` (`user_id`),
  ADD KEY `te_p_id` (`position_id`),
  ADD KEY `te_i_id` (`interviewer_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail_id` (`email_id`);


ALTER TABLE `candidates`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;


ALTER TABLE `generated_feedbacks`
  MODIFY `generated_feedback_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;


ALTER TABLE `interviewer`
  MODIFY `interviewer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `position`
  MODIFY `position_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `roles`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `template`
  MODIFY `template_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;


ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;



ALTER TABLE `generated_feedbacks`
  ADD CONSTRAINT `gn_t_id` FOREIGN KEY (`template_id`) REFERENCES `template` (`template_id`);


ALTER TABLE `role_users`
  ADD CONSTRAINT `r_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `r_u_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);


ALTER TABLE `template`
  ADD CONSTRAINT `te_i_id` FOREIGN KEY (`interviewer_id`) REFERENCES `interviewer` (`interviewer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `te_p_id` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `te_u_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

