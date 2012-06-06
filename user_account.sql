ALTER TABLE  `m_transaction` CHANGE  `id_code_customer`  `id_transaction` INT( 11 ) NOT NULL AUTO_INCREMENT;
ALTER TABLE  `user_account` ADD  `code_customer` VARCHAR( 100 ) NOT NULL;