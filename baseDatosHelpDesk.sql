-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema helpdesk
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema helpdesk
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `helpdesk` DEFAULT CHARACTER SET utf8mb4 ;
USE `helpdesk` ;

-- -----------------------------------------------------
-- Table `helpdesk`.`t_persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`t_persona` (
  `id_persona` INT(11) NOT NULL AUTO_INCREMENT,
  `paterno` VARCHAR(245) NOT NULL,
  `materno` VARCHAR(245) NULL DEFAULT NULL,
  `nombre` VARCHAR(245) NOT NULL,
  `fecha_nacimiento` VARCHAR(245) NOT NULL,
  `sexo` VARCHAR(2) NULL DEFAULT NULL,
  `telefono` VARCHAR(45) NULL DEFAULT NULL,
  `correo` VARCHAR(245) NULL DEFAULT NULL,
  `fechaInsert` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id_persona`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `helpdesk`.`t_cat_equipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`t_cat_equipo` (
  `id_equipo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(245) NOT NULL,
  `descripcion` VARCHAR(245) NULL DEFAULT NULL,
  PRIMARY KEY (`id_equipo`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `helpdesk`.`t_asignacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`t_asignacion` (
  `id_asignacion` INT(11) NOT NULL AUTO_INCREMENT,
  `id_persona` INT(11) NOT NULL,
  `id_equipo` INT(11) NOT NULL,
  `marca` VARCHAR(245) NULL DEFAULT NULL,
  `modelo` VARCHAR(245) NULL DEFAULT NULL,
  `color` VARCHAR(245) NULL DEFAULT NULL,
  `descripcion` VARCHAR(245) NULL DEFAULT NULL,
  `memoria` VARCHAR(245) NULL DEFAULT NULL,
  `disco_duro` VARCHAR(245) NULL DEFAULT NULL,
  `procesador` VARCHAR(245) NULL DEFAULT NULL,
  PRIMARY KEY (`id_asignacion`),
  INDEX `fkPersona_idx` (`id_persona` ASC) VISIBLE,
  INDEX `fkPersonaAsignacion_idx` (`id_persona` ASC) VISIBLE,
  INDEX `fkequipoAsignacion_idx` (`id_equipo` ASC) VISIBLE,
  CONSTRAINT `fkPersonaAsignacion`
    FOREIGN KEY (`id_persona`)
    REFERENCES `helpdesk`.`t_persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkequipoAsignacion`
    FOREIGN KEY (`id_equipo`)
    REFERENCES `helpdesk`.`t_cat_equipo` (`id_equipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `helpdesk`.`t_cat_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`t_cat_roles` (
  `id_rol` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(245) NOT NULL,
  `descripcion` VARCHAR(245) NULL DEFAULT NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `helpdesk`.`t_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`t_usuarios` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `id_rol` INT(11) NOT NULL,
  `id_persona` INT(11) NOT NULL,
  `usuario` VARCHAR(245) NOT NULL,
  `password` VARCHAR(245) NOT NULL,
  `ubicacion` TEXT NULL DEFAULT NULL,
  `activo` INT(11) NOT NULL DEFAULT 1,
  `fecha_insert` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fkPersona_idx` (`id_persona` ASC) VISIBLE,
  INDEX `fkRoles_idx` (`id_rol` ASC) VISIBLE,
  CONSTRAINT `fkPersona`
    FOREIGN KEY (`id_persona`)
    REFERENCES `helpdesk`.`t_persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkRoles`
    FOREIGN KEY (`id_rol`)
    REFERENCES `helpdesk`.`t_cat_roles` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `helpdesk`.`t_reportes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`t_reportes` (
  `id_reporte` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  `id_equipo` INT(11) NOT NULL,
  `id_usuario_tecnico` INT(11) NULL DEFAULT NULL,
  `descripcion_problema` TEXT NOT NULL,
  `solucion_problema` TEXT NULL DEFAULT NULL,
  `estatus` INT(11) NOT NULL DEFAULT 1,
  `leido` INT(11) NOT NULL DEFAULT 0,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id_reporte`),
  INDEX `fkUsuarioReporte_idx` (`id_usuario` ASC) VISIBLE,
  INDEX `fkEquipoReporte_idx` (`id_equipo` ASC) VISIBLE,
  INDEX `fk_tecnico_asignado` (`id_usuario_tecnico` ASC) VISIBLE,
  CONSTRAINT `fkEquipoReporte`
    FOREIGN KEY (`id_equipo`)
    REFERENCES `helpdesk`.`t_cat_equipo` (`id_equipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkUsuarioReporte`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `helpdesk`.`t_usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_reportado`
    FOREIGN KEY (`id_equipo`)
    REFERENCES `helpdesk`.`t_cat_equipo` (`id_equipo`),
  CONSTRAINT `fk_tecnico_asignado`
    FOREIGN KEY (`id_usuario_tecnico`)
    REFERENCES `helpdesk`.`t_usuarios` (`id_usuario`),
  CONSTRAINT `fk_usuario_cliente`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `helpdesk`.`t_usuarios` (`id_usuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
