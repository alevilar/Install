

CREATE TABLE `account_cierres` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `account_clasificaciones` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `account_egresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(10,2) DEFAULT '0.00' NOT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `file` varchar(300) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `tipo_de_pago_id` int(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `account_egresos_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) NOT NULL,
  `egreso_id` int(11) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `account_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cierre_id` int(4) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `clasificacion_id` int(11) DEFAULT NULL,
  `tipo_factura_id` int(11) DEFAULT NULL,
  `factura_nro` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `fecha` date NOT NULL,
  `importe_neto` decimal(10,2) DEFAULT '0.00' NOT NULL,
  `importe_total` decimal(10,2) DEFAULT '0.00' NOT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `file` varchar(300) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `account_gastos_tipo_impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) NOT NULL,
  `tipo_impuesto_id` int(11) NOT NULL,
  `importe` float DEFAULT 0 NOT NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_bin,
  ENGINE=InnoDB;

CREATE TABLE `account_impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) NOT NULL,
  `tipo_impuesto_id` int(11) NOT NULL,
  `neto` decimal(10,2) DEFAULT '0.00',
  `importe` decimal(10,2) DEFAULT '0.00', PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `account_proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cuit` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `domicilio` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `account_tipo_impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `porcentaje` decimal(6,2) NOT NULL,
  `tiene_neto` tinyint(1) DEFAULT '1' NOT NULL,
  `tiene_impuesto` tinyint(1) DEFAULT '1' NOT NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `afip_facturas` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mesa_id` int(11) NOT NULL,
  `punto_de_venta` int(11) NOT NULL,
  `comprobante_nro` int(11) NOT NULL,
  `cae` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `importe_total` decimal(10,2) NOT NULL,
  `importe_neto` decimal(10,2) NOT NULL,
  `importe_iva` decimal(10,2) NOT NULL,
  `json_data` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=latin1,
  COLLATE=latin1_swedish_ci,
  ENGINE=InnoDB;

CREATE TABLE `cash_arqueos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caja_id` int(10) UNSIGNED NOT NULL,
  `importe_inicial` decimal(11,2) DEFAULT '0.00',
  `ingreso` decimal(11,2) DEFAULT '0.00',
  `egreso` decimal(11,2) DEFAULT '0.00',
  `otros_ingresos` decimal(11,2) DEFAULT '0.00',
  `otros_egresos` decimal(11,2) DEFAULT '0.00',
  `importe_final` decimal(11,2) DEFAULT '0.00',
  `saldo` decimal(11,2) DEFAULT '0.00',
  `datetime` datetime NOT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `cash_cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(124) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `computa_ingresos` tinyint(1) DEFAULT '1' NOT NULL,
  `computa_egresos` tinyint(1) DEFAULT '1' NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `cash_zetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arqueo_id` int(10) UNSIGNED DEFAULT NULL,
  `total_ventas` decimal(11,2) DEFAULT '0.00' NOT NULL,
  `numero_comprobante` int(11) DEFAULT NULL,
  `monto_iva` decimal(11,2) DEFAULT '0.00' NOT NULL,
  `monto_neto` decimal(11,2) DEFAULT '0.00' NOT NULL,
  `nota_credito_iva` decimal(11,2) DEFAULT '0.00' NOT NULL,
  `nota_credito_neto` decimal(11,2) DEFAULT '0.00' NOT NULL,
  `observacion_comprobante_tarjeta` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `lft` int(10) UNSIGNED DEFAULT NULL,
  `rght` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `media_id` int(10) UNSIGNED DEFAULT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`),
  KEY `parent` (`parent_id`))   DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mail` varchar(110) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `telefono` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `descuento_id` int(10) UNSIGNED DEFAULT 0,
  `nombre` varchar(110) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nrodocumento` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `domicilio` varchar(110) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `iva_responsabilidad_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `comandas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mesa_id` int(11) NOT NULL,
  `prioridad` int(4) NOT NULL,
  `impresa` timestamp NULL,
  `created` timestamp NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`),
  KEY `mesa_id` (`mesa_id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `comensales` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cant_mayores` int(4) NOT NULL,
  `cant_menores` int(4) NOT NULL,
  `cant_bebes` int(4) NOT NULL,
  `mesa_id` int(10) UNSIGNED NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `config_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `configs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `config_category_id` int(10) UNSIGNED NOT NULL,
  `key` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `descuentos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `porcentaje` float NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `detalle_comandas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `cant` float NOT NULL,
  `cant_eliminada` float DEFAULT 0 NOT NULL,
  `comanda_id` int(11) UNSIGNED NOT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,
  `es_entrada` int(4) DEFAULT 0,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`),
  KEY `mesa_id_2` (`comanda_id`),
  KEY `producto_id` (`producto_id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `detalle_sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detalle_comanda_id` int(11) NOT NULL,
  `sabor_id` int(11) NOT NULL,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `estados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `color` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `grupo_sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seleccion_de_sabor_obligatorio` tinyint(1) NOT NULL,
  `tipo_de_seleccion` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `grupo_sabores_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `grupo_sabor_id` int(11) NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `historico_precios` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `precio` float NOT NULL,
  `producto_id` int(11) NOT NULL,
  `created` timestamp NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `impfiscales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `path` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `inventory_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `inventory_counts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `count` float DEFAULT 0 NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `inventory_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created` timestamp NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `iva_responsabilidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_fiscal` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tipo_factura_id` int(11) NOT NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `type` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `size` int(6) NOT NULL,
  `name` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `file` blob NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `mesas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mozo_id` int(10) UNSIGNED NOT NULL,
  `subtotal` decimal(10,2) DEFAULT '0.00' NOT NULL,
  `total` decimal(10,2) DEFAULT '0.00',
  `cliente_id` int(10) UNSIGNED DEFAULT 0,
  `descuento_id` int(11) DEFAULT NULL,
  `menu` int(4) DEFAULT 0 NOT NULL COMMENT 'es para cuando un cliente quiere imprimir el importe como MENU sin que se vea lo que consumio',
  `cant_comensales` int(11) DEFAULT 0,
  `estado_id` int(4) DEFAULT 0 NOT NULL,
  `observation` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `checkin` datetime DEFAULT NULL,
  `checkout` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL,
  `time_cerro` datetime DEFAULT NULL,
  `time_cobro` datetime DEFAULT NULL,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`),
  KEY `time_cerro` (`time_cerro`, `time_cobro`),
  KEY `mozo_id` (`mozo_id`),
  KEY `checkin` (`checkin`),
  KEY `checkout` (`checkout`),
  KEY `numero` (`numero`),
  KEY `time_cobro` (`time_cobro`),
  KEY `created` (`time_cerro`, `mozo_id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `mozos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `apellido` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `media_id` int(10) UNSIGNED DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '0' NOT NULL,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`),
  KEY `numero` (`numero`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `observacion_comandas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `observaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `pagos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mesa_id` int(10) UNSIGNED NOT NULL,
  `tipo_de_pago_id` int(10) UNSIGNED DEFAULT NULL,
  `valor` float NOT NULL COMMENT 'por ahora este campo vale cuando el tipo de pago es mixto, entonces se pone la cantidad de efectivo que pagó. Para poder hacer el arqueo.',
  `created` timestamp NULL,
  `modified` timestamp NULL,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `pquery_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `pquery_queries` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(78) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `query` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ver_online` tinyint(1) DEFAULT '0' NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,
  `category_id` int(11) DEFAULT 0 NOT NULL,
  `expiration_time` timestamp NULL,
  `columns` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `printers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alias` varchar(124) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `driver` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `driver_model` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `output` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `abrev` varchar(28) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `precio` float(10,2) NOT NULL,
  `printer_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  `created` timestamp NULL,
  `modified` timestamp NULL,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `productos_precios_futuros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `precio` float NOT NULL,  PRIMARY KEY  (`id`),
  UNIQUE KEY `producto_id` (`producto_id`))   DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `productos_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `restaurantes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `machin_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `roles_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rol_id` int(11) NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`, `rol_id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `grupo_sabor_id` int(11) DEFAULT NULL,
  `precio` float NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,
  `deleted_date` timestamp NULL,
  `deleted` int(4) DEFAULT 0 NOT NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `tipo_de_pagos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(110) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `media_id` int(10) UNSIGNED DEFAULT NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `tipo_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_fiscal` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, PRIMARY KEY  (`id`))  DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `tipo_facturas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `codename` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created` timestamp NULL,
  `modified` timestamp NULL,  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`))   DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

