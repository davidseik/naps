SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `NAPS` ;
CREATE SCHEMA IF NOT EXISTS `NAPS` ;
USE `NAPS` ;

-- -----------------------------------------------------
-- Table `NAPS`.`admin_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NAPS`.`admin_user` ;

CREATE TABLE IF NOT EXISTS `NAPS`.`admin_user` (
  `id_admin_user` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `last_name` VARCHAR(100) NULL,
  `category` INT NULL,
  `mail` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `last_log` DATETIME NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`id_admin_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NAPS`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NAPS`.`user` ;

CREATE TABLE IF NOT EXISTS `NAPS`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `mail` VARCHAR(255) NULL,
  `picture` VARCHAR(255) NULL,
  `presented` TINYINT NOT NULL DEFAULT 0,
  `active` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NAPS`.`topic`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NAPS`.`topic` ;

CREATE TABLE IF NOT EXISTS `NAPS`.`topic` (
  `id_topic` INT NOT NULL AUTO_INCREMENT,
  `topic_category` VARCHAR(255) NULL,
  `title` VARCHAR(255) NOT NULL,
  `active` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_topic`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NAPS`.`user_has_topic`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NAPS`.`user_has_topic` ;

CREATE TABLE IF NOT EXISTS `NAPS`.`user_has_topic` (
  `id_user_topic` INT NOT NULL AUTO_INCREMENT,
  `id_topic` INT NOT NULL COMMENT '	',
  `id_user` INT NOT NULL,
  `presented` TINYINT NULL DEFAULT 0,
  `active` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_user_topic`),
  INDEX `fk_user_has_topic_topic1_idx` (`id_topic` ASC),
  INDEX `fk_user_has_topic_user1_idx` (`id_user` ASC),
  CONSTRAINT `fk_user_has_topic_topic1`
    FOREIGN KEY (`id_topic`)
    REFERENCES `NAPS`.`topic` (`id_topic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_topic_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `NAPS`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NAPS`.`rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NAPS`.`rating` ;

CREATE TABLE IF NOT EXISTS `NAPS`.`rating` (
  `id_rating` INT NOT NULL AUTO_INCREMENT,
  `id_topic` INT NOT NULL,
  `score` INT NULL,
  `date` DATETIME NULL,
  `comment` TEXT NULL,
  PRIMARY KEY (`id_rating`),
  INDEX `fk_rating_topic1_idx` (`id_topic` ASC),
  CONSTRAINT `fk_rating_topic1`
    FOREIGN KEY (`id_topic`)
    REFERENCES `NAPS`.`topic` (`id_topic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NAPS`.`user_has_rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NAPS`.`user_has_rating` ;

CREATE TABLE IF NOT EXISTS `NAPS`.`user_has_rating` (
  `id_user_has_rating` INT NOT NULL,
  `id_rating` INT NOT NULL,
  `id_user` INT NOT NULL,
  PRIMARY KEY (`id_user_has_rating`),
  INDEX `fk_user_has_rating_rating1_idx` (`id_rating` ASC),
  INDEX `fk_user_has_rating_user1_idx` (`id_user` ASC),
  CONSTRAINT `fk_user_has_rating_rating1`
    FOREIGN KEY (`id_rating`)
    REFERENCES `NAPS`.`rating` (`id_rating`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_rating_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `NAPS`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NAPS`.`presentation_history`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NAPS`.`presentation_history` ;

CREATE TABLE IF NOT EXISTS `NAPS`.`presentation_history` (
  `id_presentation_history` INT NOT NULL,
  `id_user` INT NOT NULL,
  `id_topic` INT NOT NULL,
  `date` DATETIME NULL,
  `active` TINYINT NULL,
  PRIMARY KEY (`id_presentation_history`),
  INDEX `fk_rating_active_user1_idx` (`id_user` ASC),
  INDEX `fk_rating_active_topic1_idx` (`id_topic` ASC),
  CONSTRAINT `fk_rating_active_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `NAPS`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rating_active_topic1`
    FOREIGN KEY (`id_topic`)
    REFERENCES `NAPS`.`topic` (`id_topic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
