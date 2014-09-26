
--
-- Volcar la base de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`parent_id`, `lft`, `rght`, `name`, `description`, `media_id`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
( NULL, 1, 8, '/', '', NULL, '2012-11-28 22:57:10', '2012-11-28 22:57:10', NULL, 0),
( 1, 2, 3, 'Dobles', '', NULL, '2013-05-17 13:49:56', '2013-05-17 13:46:57', NULL, 0),
( 1, 4, 5, 'Singles', '', NULL, '2014-04-02 06:49:47', '2014-04-02 06:49:47', NULL, 0),
( 1, 6, 7, 'Bufette', '', NULL, '2014-04-02 06:53:54', '2014-04-02 06:53:54', NULL, 0);
-- --------------------------------------------------------

INSERT INTO `clientes` (`id`, `codigo`, `mail`, `telefono`, `descuento_id`, `nombre`, `nrodocumento`, `tipo_documento_id`, `domicilio`, `iva_responsabilidad_id`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, 0, 'EXAMPLE Google Arg. SRL', '33709585229', 1, NULL, 1, '2013-05-17 13:52:17', '2013-05-17 13:52:17');

--
-- Volcar la base de datos para la tabla `clientes`
--

--
-- Volcar la base de datos para la tabla `comandas`
--

INSERT INTO `comandas` (`id`, `mesa_id`, `prioridad`, `impresa`, `created`, `observacion`) VALUES
(1, 1, 0, NULL, '2012-11-28 23:07:32', '');





INSERT INTO  `printers` ( `id` , `name` ,`alias` ,`driver` ,`driver_model` ,`output` ,`created` ,`modified`) 
VALUES ( NULL ,  'comanderacocina',  'comanderacocina',  'Receipt',  'Bematech',  'Database', NULL , NULL );




--
-- Volcar la base de datos para la tabla `descuentos`
--

--
-- Volcar la base de datos para la tabla `detalle_comandas`
--

INSERT INTO `detalle_comandas` (`id`, `producto_id`, `cant`, `cant_eliminada`, `comanda_id`, `observacion`, `created`, `modified`, `es_entrada`) VALUES
(1, 1, 1, 0, 1, '', '2012-11-28 23:07:32', '2012-11-28 23:07:32', 0);



--
-- Volcar la base de datos para la tabla `iva_responsabilidades`
--

INSERT INTO `iva_responsabilidades` (`id`, `codigo_fiscal`, `name`, `tipo_factura_id`) VALUES
(1, 'I', 'Resp. Inscripto', 1),
(2, 'E', 'Exento', 2),
(3, 'A', 'No Responsable', 2),
(4, 'C', 'Consumidor Final', 2),
(5, 'T', 'No Categorizado', 2);

-- --------------------------------------------------------


--
-- Volcar la base de datos para la tabla `mozos`
--

INSERT INTO `mozos` ( `numero`, `nombre`, `apellido` ,`activo`, `deleted_date`, `deleted`) VALUES
(100, "Habitacion", "Norte", 1, NULL, 0),
(201, "Sala", "sur", 1, NULL, 0);

-- --------------------------------------------------------


--
-- Volcar la base de datos para la tabla `observacion_comandas`
--

--
-- Volcar la base de datos para la tabla `productos`
--


INSERT INTO `productos` (`id`, `name`, `abrev`, `description`, `categoria_id`, `precio`, `printer_id`, `order`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
(1, 'Simple y al patio', 'single', '', 1, 100.00, 1, NULL, '2012-11-28 23:11:57', '2012-11-28 23:11:57', NULL, 0),
(2, 'Suite', 'doble', '', 2, 12.00, 1, 2, '2013-05-17 13:50:34', '2013-05-17 13:50:34', NULL, 0),
(3, 'Simple', 'single', '', 2, 33.00, 1, NULL, '2013-05-17 13:50:46', '2013-05-17 13:50:46', NULL, 0),
(4, 'Doble vista al mar', 'doble', '', 2, 21.00, 1, 2, '2013-05-17 13:51:09', '2013-05-17 13:51:09', NULL, 0),
(5, 'PResidencial Super', 'la del presi', '', 3, 20.00, 1, NULL, '2014-04-02 06:52:34', '2014-04-02 06:52:34', NULL, 0),
(6, 'Imperial en Suite', 'imperial', '', 4, 40.00, 1, 2, '2014-04-02 06:56:37', '2014-04-02 06:56:37', NULL, 0),
(7, 'Hamburguesa', 'pollo', '', 4, 33.00, 1, NULL, '2014-04-02 06:57:03', '2014-04-02 06:57:03', NULL, 0);

-- --------------------------------------------------------



-- --------------------------------------------------------


--
-- Volcar la base de datos para la tabla `sabores`
--

--
-- Volcar la base de datos para la tabla `tipo_de_pagos`
--

INSERT INTO `tipo_de_pagos` ( `name`, `media_id`) VALUES
( 'Efectivo', NULL),
( 'No Paga', NULL),
( 'Tarjeta Amex', NULL),
( 'Tarjeta Visa', NULL),
( 'Tarjeta Master Card', NULL),
( 'Tarjeta Visa Debito', NULL),
( 'Tarjeta Maestro', NULL);

--
-- Volcar la base de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id`, `codigo_fiscal`, `name`) VALUES
(1, 'C', 'CUIT'),
(2, 'L', 'CUIL'),
(3, '0', 'Libreta de Enrolamiento'),
(4, '1', 'Libreta Cívica'),
(5, '2', 'DNI'),
(6, '3', 'Pasaporte'),
(7, '4', 'Cédula de Identidad'),
(8, '-', 'Sin identificar');

-- --------------------------------------------------------

--
-- Volcar la base de datos para la tabla `tipo_facturas`
--

INSERT INTO `tipo_facturas` (`id`, `name`, `created`, `modified`) VALUES
(1, '"A"', '2010-03-27 20:04:20', '2010-03-27 20:04:20'),
(2, '"B"', '2010-03-27 20:04:27', '2010-03-27 20:04:27'),
(3, '"X"', '2010-03-27 20:04:36', '2010-03-27 20:04:36'),
(4, '"M"', '2010-03-27 20:04:42', '2010-03-27 20:04:42'),
(5, '"C"', '2010-03-27 20:04:48', '2010-03-27 20:04:48'),
(6, 'Vale', '2010-03-27 20:04:54', '2010-03-27 20:04:54'),
(7, 'Otros', '2010-03-27 20:05:18', '2010-03-27 20:05:18');



INSERT INTO `roles` (`name`, `machin_name`) VALUES
('Administrador', 'administrador'),
('Recepcionista', 'mozo'),
('Encargado', 'adicionista');


INSERT INTO `estados` (`name`, `color`) VALUES
('Abierta', 'btn-info'),
('Facturada', 'btn-warning'),
('Cobrada', 'btn-default');




INSERT INTO `cash_cajas` (`id`, `name`, `computa_ingresos`, `computa_egresos`, `created`, `modified`) VALUES
(1, 'Caja Ventas', 1, 1, '2014-09-09 14:20:21', '2014-09-09 14:20:21');


