
--
-- Table structure for table `gateways`
--

CREATE TABLE IF NOT EXISTS `gateways` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `account` varchar(200) DEFAULT NULL,
  `allow_deposits` varchar(10) DEFAULT NULL,
  `allow_withdrawals` varchar(10) DEFAULT NULL,
  `allow_upgrade` varchar(10) DEFAULT NULL,
  `withdraw_fee` varchar(11) DEFAULT NULL,
  `withdraw_fee_fixed` decimal(11,3) NOT NULL DEFAULT '0.000',
  `currency` varchar(10) DEFAULT NULL,
  `option1` varchar(200) DEFAULT NULL,
  `option2` varchar(200) DEFAULT NULL,
  `option3` varchar(200) DEFAULT NULL,
  `option4` varchar(200) DEFAULT NULL,
  `option5` varchar(200) DEFAULT NULL,
  `option6` varchar(255) DEFAULT NULL,
  `min_deposit` decimal(11,2) NOT NULL DEFAULT '0.00',
  `total_withdraw` decimal(11,2) NOT NULL DEFAULT '0.00',
  `total_deposit` decimal(11,2) NOT NULL DEFAULT '0.00',
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=503 ;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `name`, `account`, `allow_deposits`, `allow_withdrawals`, `allow_upgrade`, `withdraw_fee`, `withdraw_fee_fixed`, `currency`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `min_deposit`, `total_withdraw`, `total_deposit`, `status`) VALUES
(502, 'زیبال', '', 'yes', 'yes', 'yes', '0', '0.000', 'USD', '', '', '', '', '', NULL, '0.00', '0.00', '0.00', 'Active');
