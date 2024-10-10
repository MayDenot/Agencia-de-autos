<?php
class Model {
    protected $db;

    function __construct() {
        $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    function deploy() {
        // Chequear si hay tablas
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
        if (count($tables) == 0) {
            // Si no hay crearlas
            $sql = <<<END
            --
            -- Base de datos: `db_agencia_autos`
            --

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `alquileres`
            --

            CREATE TABLE `alquileres` (
            `ID` int(11) NOT NULL,
            `ID_Vehiculo` int(11) NOT NULL,
            `Fecha_de_entrega` date NOT NULL,
            `Fecha_de_vencimiento` date NOT NULL,
            `Precio` double NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `alquileres`
            --

            INSERT INTO `alquileres` (`ID`, `ID_Vehiculo`, `Fecha_de_entrega`, `Fecha_de_vencimiento`, `Precio`) VALUES
            (5, 1, '2024-09-04', '2024-09-11', 6000),
            (7, 5, '2024-10-02', '2024-10-09', 4500),
            (9, 2, '2024-10-09', '2024-10-16', 9600),
            (10, 5, '2024-10-09', '2024-10-10', 15000),
            (13, 6, '2024-10-02', '2024-10-16', 3000);

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `usuarios`
            --

            CREATE TABLE `usuarios` (
            `ID_Usuario` int(11) NOT NULL,
            `Usuario` varchar(250) NOT NULL,
            `Contraseña` char(60) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `usuarios`
            --

            INSERT INTO `usuarios` (`ID_Usuario`, `Usuario`, `Contraseña`) VALUES
            (2, 'webadmin', '$2y$10$coasoo4/KT2t88RTP6WHEeYHQ1YFNRsEydcMIwsL.84TWMLaIaHmm');

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `vehiculos`
            --

            CREATE TABLE `vehiculos` (
            `ID_Vehiculo` int(11) NOT NULL,
            `Patente` varchar(45) NOT NULL,
            `Modelo` varchar(45) NOT NULL,
            `Marca` varchar(45) NOT NULL,
            `Año_de_Modelo` year(4) NOT NULL,
            `Color` varchar(40) NOT NULL,
            `Imagen` varchar(1000) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `vehiculos`
            --

            INSERT INTO `vehiculos` (`ID_Vehiculo`, `Patente`, `Modelo`, `Marca`, `Año_de_Modelo`, `Color`, `Imagen`) VALUES
            (1, 'WET784', 'Corsa', 'Chevrolet', '2011', 'Gris', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQD_I820zEB6Aju3Lde_is6WHtNVPHZtGnffA&s'),
            (2, 'AD652FG', 'Cronos', 'Fiat', '2022', 'Gris', 'https://cdn.motor1.com/images/mgl/gZjbE/s1/lanzamiento-fiat-cronos-s-design-ii-2022.jpg'),
            (5, 'AC-345-FP', 'Corolla', 'Toyota', '2015', 'Blanco', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOP88qtc-3oSLow_KfQmCEsG2SvhNVnd2bJg&s'),
            (6, 'AA-234-BB', 'Amarok', 'Volkswagen', '2017', 'Azul', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlfqqNm_agW2fTwSn9NQPeqTP9riPABJ4E1A&s');

            --
            -- Índices para tablas volcadas
            --

            --
            -- Indices de la tabla `alquileres`
            --
            ALTER TABLE `alquileres`
            ADD PRIMARY KEY (`ID`),
            ADD KEY `fk_id_vehiculo` (`ID_Vehiculo`),

            --
            -- Indices de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
            ADD PRIMARY KEY (`ID_Usuario`),
            ADD UNIQUE KEY `Usuario` (`Usuario`);

            --
            -- Indices de la tabla `vehiculos`
            --
            ALTER TABLE `vehiculos`
            ADD PRIMARY KEY (`ID_Vehiculo`),
            ADD KEY `ID_Vehiculo` (`ID_Vehiculo`);

            --
            -- AUTO_INCREMENT de las tablas volcadas
            --

            --
            -- AUTO_INCREMENT de la tabla `alquileres`
            --
            ALTER TABLE `alquileres`
            MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

            --
            -- AUTO_INCREMENT de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
            MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

            --
            -- AUTO_INCREMENT de la tabla `vehiculos`
            --
            ALTER TABLE `vehiculos`
            MODIFY `ID_Vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

            --
            -- Restricciones para tablas volcadas
            --

            --
            -- Filtros para la tabla `alquileres`
            --
            ALTER TABLE `alquileres`
            ADD CONSTRAINT `fk_id_vehiculo` FOREIGN KEY (`ID_Vehiculo`) REFERENCES `vehiculos` (`ID_Vehiculo`);
            COMMIT;
        END;
            $this->db->query($sql);
        }
    }
}