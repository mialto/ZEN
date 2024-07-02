/**para la modificacion de roles**/ hecho => 17/05/2022
CREATE TABLE `espaal`.`users_roles` ( `id` INT NOT NULL AUTO_INCREMENT , `id_user` INT NOT NULL , `id_rol` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

/**para la creacion de los corredores**/ => hecho 7/6/2022
INSERT INTO `roles` (`id`, `nombre_rol`) VALUES (NULL, 'corredor');
CREATE TABLE `espaal`.`empresas_integradoras` ( `id` INT NOT NULL AUTO_INCREMENT , `nombre_empresa` VARCHAR(200) NOT NULL , `mail` VARCHAR(200) NOT NULL , `telefono` VARCHAR(15) NOT NULL , `provincia` VARCHAR(100) NOT NULL , `poblacion` VARCHAR(120) NOT NULL , `created_at` VARCHAR(20) NOT NULL , `updated_at` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
CREATE TABLE `espaal`.`mataderos` ( `id` INT NOT NULL AUTO_INCREMENT , `nombre_matadero` VARCHAR(200) NOT NULL , `provincia` VARCHAR(100) NOT NULL , `poblacion` VARCHAR(100) NOT NULL , `mail` VARCHAR(200) NOT NULL , `telefono` VARCHAR(20) NOT NULL , `direccion` VARCHAR(200) NOT NULL , `created_at` VARCHAR(20) NOT NULL , `updated_at` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
CREATE TABLE `espaal`.`explotaciones` ( `id` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(200) NOT NULL , `provincia` VARCHAR(100) NOT NULL , `poblacion` VARCHAR(100) NOT NULL , `mail` VARCHAR(200) NOT NULL , `telefono` VARCHAR(100) NOT NULL , `id_empresa_integradora` INT NOT NULL , `created_at` INT NOT NULL , `updated_at` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `explotaciones` CHANGE `created_at` `created_at` VARCHAR(20) NOT NULL; 
ALTER TABLE `explotaciones` CHANGE `updated_at` `updated_at` VARCHAR(20) NOT NULL; 
CREATE TABLE `espaal`.`camiones` ( `id` INT NOT NULL AUTO_INCREMENT , `matricula` VARCHAR(15) NOT NULL , `id_empresa_integradora` INT NOT NULL , `created_at` VARCHAR(20) NOT NULL , `updated_at` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
CREATE TABLE `espaal`.`camioneros` ( `id` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(100) NOT NULL , `apellidos` VARCHAR(200) NOT NULL , `dni` VARCHAR(10) NOT NULL , `mail` VARCHAR(100) NOT NULL , `movil` VARCHAR(100) NOT NULL , `id_empresa_integradora` INT NOT NULL , `created_at` VARCHAR(20) NOT NULL , `updated_at` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
CREATE TABLE `espaal`.`cargas` ( `id` INT NOT NULL AUTO_INCREMENT , `fecha` VARCHAR(20) NOT NULL , `provincia` VARCHAR(100) NOT NULL , `poblacion` VARCHAR(100) NOT NULL , `lugar_de_carga` VARCHAR(250) NOT NULL , `num_animales` INT NOT NULL , `ticket` VARCHAR(250) NOT NULL , `raza` VARCHAR(100) NOT NULL , `guia` VARCHAR(100) NOT NULL , `peso_medio` FLOAT NOT NULL , `id_matadero` INT NOT NULL , `id_empresa_integradora` INT NOT NULL , `id_explotacion` INT NOT NULL , `id_camion` INT NOT NULL , `id_camionero` INT NOT NULL , `id_corredor` INT NOT NULL , `created_at` VARCHAR(20) NOT NULL , `updated_at` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
ALTER TABLE `empresas_integradoras` ADD `direccion` VARCHAR(250) NOT NULL AFTER `poblacion`; 
ALTER TABLE `explotaciones` ADD `direccion` VARCHAR(250) NOT NULL AFTER `telefono`; 
CREATE TABLE `espaal`.`empresa_transportes` ( `id` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(100) NOT NULL , `telefono` VARCHAR(20) NOT NULL , `mail` VARCHAR(250) NOT NULL , `provincia` VARCHAR(250) NOT NULL , `poblacion` VARCHAR(250) NOT NULL , `created_at` VARCHAR(20) NOT NULL , `updated_at` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
ALTER TABLE `camioneros` CHANGE `id_empresa_integradora` `id_empresa_transportes` INT(11) NOT NULL; 
ALTER TABLE `camiones` CHANGE `id_empresa_integradora` `id_empresa_transportes` INT(11) NOT NULL; 
ALTER TABLE `empresa_transportes` ADD `direccion` VARCHAR(250) NOT NULL AFTER `poblacion`; 

/**agenda**/ => hecho 7/6/2022
CREATE TABLE `espaal`.`agenda_cargas` ( `id` INT NOT NULL AUTO_INCREMENT , `fecha` VARCHAR(20) NOT NULL , `proveedor` VARCHAR(100) NOT NULL , `anotaciones` INT NOT NULL , `matadero` INT NOT NULL , `created_at` INT NOT NULL , `updated_at` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
ALTER TABLE `agenda_cargas` CHANGE `anotaciones` `anotaciones` VARCHAR(250) NOT NULL; 

/**para los lotes**/ => hecho 7/6/2022
CREATE TABLE `espaal`.`lotes` ( `id` INT NOT NULL AUTO_INCREMENT , `numero` VARCHAR(5) NOT NULL , `fecha_entrada` VARCHAR(20) NOT NULL , `fecha_despiece` VARCHAR(20) NOT NULL , `id_carga` INT NOT NULL , `created_at` VARCHAR(20) NOT NULL , `updated_at` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

/**modificaciones en agenfa**/ => hecho el 9/06/2022 
ALTER TABLE `agenda_cargas` ADD `activo` INT(1) NOT NULL AFTER `matadero`; 

/**modificaciones de cargas**/ => hecho 6/07/2022
ALTER TABLE `cargas` ADD `id_empresa_transportes` INT NOT NULL AFTER `id_explotacion`; 
ALTER TABLE `cargas` ADD `peso_tara` DECIMAL NOT NULL AFTER `raza`, ADD `peso_con_animales` DECIMAL NOT NULL AFTER `peso_tara`; 
ALTER TABLE `cargas` ADD `modificado_por` INT NOT NULL AFTER `id_corredor`; 

/*modificaciones en la agenda de cargas*/ => hecho el 19/07/2022
ALTER TABLE `agenda_cargas` ADD `transportes` INT NOT NULL AFTER `matadero`; 
ALTER TABLE `agenda_cargas` CHANGE `created_at` `created_at` VARCHAR(30) NOT NULL; 
ALTER TABLE `agenda_cargas` CHANGE `updated_at` `updated_at` VARCHAR(30) NOT NULL; 

/*introduccion del código REGA*/ => hecho 20/07/2022
ALTER TABLE `explotaciones` ADD `codigoREGA` VARCHAR(100) NOT NULL AFTER `direccion`; 

/*modificar tabla de lotes*/ => hecho 30/07/2022
ALTER TABLE `lotes` ADD `tipo` VARCHAR(10) NOT NULL AFTER `id_carga`, 
ADD `num_animales` INT NOT NULL AFTER `tipo`, 
ADD `rega_cliente` VARCHAR(30) NOT NULL AFTER `num_animales`, 
ADD `propietario_consignatario` VARCHAR(100) NOT NULL AFTER `rega_cliente`, 
ADD `bajas_transporte` INT NOT NULL AFTER `propietario_consignatario`, 
ADD `entidad_inspeccion` VARCHAR(50) NOT NULL AFTER `bajas_transporte`, 
ADD `num_certificado` VARCHAR(50) NOT NULL AFTER `entidad_inspeccion`, 
ADD `alimentacion` VARCHAR(20) NOT NULL AFTER `num_certificado`, 
ADD `raza` VARCHAR(30) NOT NULL AFTER `alimentacion`, 
ADD `edad` VARCHAR(15) NOT NULL AFTER `raza`, 
ADD `fecha_muerte` VARCHAR(50) NOT NULL AFTER `edad`, 
ADD `idcerdos_cod_explo` VARCHAR(50) NOT NULL AFTER `fecha_muerte`, 
ADD `denominacion_origen` VARCHAR(20) NOT NULL AFTER `idcerdos_cod_explo`, 
ADD `num_corrales` INT NOT NULL AFTER `denominacion_origen`, 
ADD `corrales` INT NOT NULL AFTER `num_corrales`, 
ADD `identificacion_animal` VARCHAR(50) NOT NULL AFTER `corrales`, 
ADD `num_animales_inspeccionados` INT NOT NULL AFTER `identificacion_animal`, 
ADD `id_matadero` INT NOT NULL AFTER `num_animales_inspeccionados`, 
ADD `entrega_en` VARCHAR(150) NOT NULL AFTER `id_matadero`, 
ADD `albaran` VARCHAR(50) NOT NULL AFTER `entrega_en`, 
ADD `albaran_archivo` VARCHAR(200) NOT NULL AFTER `albaran`, 
ADD `id_user_created` INT NOT NULL AFTER `albaran_archivo`, 
ADD `id_user_updated` INT NOT NULL AFTER `id_user_created`; 

ALTER TABLE `lotes` ADD `procedencia` VARCHAR(10) NOT NULL AFTER `tipo`; 

ALTER TABLE `cargas` ADD `categoria` VARCHAR(20) NOT NULL AFTER `guia`, ADD `alimentacion` VARCHAR(20) NOT NULL AFTER `categoria`; 

/*modificacion de los lotes*/ => hecho el 25/08/2022
ALTER TABLE `lotes`
  DROP `num_animales`,
  DROP `alimentacion`,
  DROP `raza`; 

ALTER TABLE `lotes` ADD `rt` VARCHAR(8) NOT NULL AFTER `num_animales_inspeccionados`; 
ALTER TABLE `lotes` CHANGE `corrales` `corrales` VARCHAR(50) NOT NULL; 

/*lotes v1.1*/ => hecho el 25/08/2022
ALTER TABLE `lotes` ADD `guia` VARCHAR(50) NOT NULL AFTER `num_certificado`; 

/**cambio de normas*/=> hecho el 7/10/2022
ALTER TABLE `cargas` CHANGE `categoria` `categoria` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL; 

/*creacion de subcargas*/=> hecho el 7/10/2022
CREATE TABLE `espaal`.`subcargas` ( `id` INT NOT NULL AUTO_INCREMENT , `ticket` VARCHAR(250) NOT NULL , `guia` VARCHAR(250) NOT NULL , `id_explotacion` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `subcargas` ADD `id_carga` INT(10) NOT NULL AFTER `id`; 

/*cracion de los decomisos*/ => hecho el 21/10/2022
CREATE TABLE `espaal`.`decomisos` ( `id` INT NOT NULL AUTO_INCREMENT , `id_lote` INT NOT NULL , `decomiso` TEXT NOT NULL , `usuario` INT NOT NULL , `created_at` VARCHAR(50) NOT NULL , `updated_at` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 