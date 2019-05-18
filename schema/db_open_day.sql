-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema sge
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `sge` ;

-- -----------------------------------------------------
-- Schema sge
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sge` DEFAULT CHARACTER SET utf8 ;
USE `sge` ;

-- -----------------------------------------------------
-- Table `sge`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sge`.`Usuario` ;

CREATE TABLE IF NOT EXISTS `sge`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `nome` VARCHAR(150) NOT NULL,
  `instituicao` VARCHAR(100) NOT NULL,
  `curso` VARCHAR(70) NOT NULL,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sge`.`ResponsavelGeral`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sge`.`ResponsavelGeral` ;

CREATE TABLE IF NOT EXISTS `sge`.`ResponsavelGeral` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarioID` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  CONSTRAINT `usuarioIDRG`
    FOREIGN KEY (`usuarioID`)
    REFERENCES `sge`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sge`.`Administrador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sge`.`Administrador` ;

CREATE TABLE IF NOT EXISTS `sge`.`Administrador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarioID` INT NOT NULL,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  INDEX `usuarioID_idx` (`usuarioID` ASC) VISIBLE,
  CONSTRAINT `usuarioIDAdm`
    FOREIGN KEY (`usuarioID`)
    REFERENCES `sge`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sge`.`Evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sge`.`Evento` ;

CREATE TABLE IF NOT EXISTS `sge`.`Evento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(120) NOT NULL,
  `diaInicio` INT NOT NULL,
  `mesInicio` INT NOT NULL,
  `anoInicio` INT NOT NULL,
  `dataFim` DATE NOT NULL,
  `local` VARCHAR(180) NOT NULL,
  `descricao` VARCHAR(255) NULL,
  `respGeralID` INT NOT NULL,
  `administradorId` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `respGeralID_idx` (`respGeralID` ASC) VISIBLE,
  INDEX `administradorID_idx` (`admnistradorID` ASC) VISIBLE,
  CONSTRAINT `respGeralID`
    FOREIGN KEY (`respGeralID`)
    REFERENCES `sge`.`ResponsavelGeral` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `administradorID`
    FOREIGN KEY (`admnistradorID`)
    REFERENCES `sge`.`Administrador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sge`.`ResponsavelAtividade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sge`.`ResponsavelAtividade` ;

CREATE TABLE IF NOT EXISTS `sge`.`ResponsavelAtividade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarioID` INT NOT NULL,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `usuarioIDRA`
    FOREIGN KEY (`usuarioID`)
    REFERENCES `sge`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sge`.`Atividade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sge`.`Atividade` ;

CREATE TABLE IF NOT EXISTS `sge`.`Atividade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(60) NOT NULL,
  `tema` VARCHAR(180) NOT NULL,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `duracao` TIME NOT NULL,
  `local` VARCHAR(120) NOT NULL,
  `pontospex` INT NOT NULL,
  `vagasminimas` INT NOT NULL,
  `vagasmaximas` INT NOT NULL,
  `descricao` VARCHAR(255) NULL,
  `eventoID` INT NOT NULL,
  `respAtividadeID` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `eventoID_idx` (`eventoID` ASC) VISIBLE,
  CONSTRAINT `eventoID`
    FOREIGN KEY (`eventoID`)
    REFERENCES `sge`.`Evento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `respAtividadeID`
    FOREIGN KEY (`respAtividadeID`)
    REFERENCES `sge`.`ResponsavelAtividade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sge`.`InscricaoEvento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sge`.`InscricaoEvento` ;

CREATE TABLE IF NOT EXISTS `sge`.`InscricaoEvento` (
  `usuarioID` INT NOT NULL,
  `eventoID` INT NOT NULL,
  INDEX `usuarioID_idx` (`usuarioID` ASC) VISIBLE,
  INDEX `eventoID_idx` (`eventoID` ASC) VISIBLE,
  CONSTRAINT `usuarioIDIE`
    FOREIGN KEY (`usuarioID`)
    REFERENCES `sge`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `eventoIDInsc`
    FOREIGN KEY (`eventoID`)
    REFERENCES `sge`.`Evento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sge`.`Organizador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sge`.`Organizador` ;

CREATE TABLE IF NOT EXISTS `sge`.`Organizador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarioID` INT NOT NULL,
  `atividadeID` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `usuarioID_idx` (`usuarioID` ASC) VISIBLE,
  INDEX `atividadeID_idx` (`atividadeID` ASC) VISIBLE,
  CONSTRAINT `usuarioIDOrg`
    FOREIGN KEY (`usuarioID`)
    REFERENCES `sge`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `atividadeID`
    FOREIGN KEY (`atividadeID`)
    REFERENCES `sge`.`Atividade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sge`.`InscricaoAtividade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sge`.`InscricaoAtividade` ;

CREATE TABLE IF NOT EXISTS `sge`.`InscricaoAtividade` (
  `usuarioID` INT NOT NULL,
  `atividadeID` INT NOT NULL,
  INDEX `usuarioID_idx` (`usuarioID` ASC) VISIBLE,
  INDEX `atividadeID_idx` (`atividadeID` ASC) VISIBLE,
  CONSTRAINT `usuarioIDIA`
    FOREIGN KEY (`usuarioID`)
    REFERENCES `sge`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `atividadeIDInsc`
    FOREIGN KEY (`atividadeID`)
    REFERENCES `sge`.`Atividade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
