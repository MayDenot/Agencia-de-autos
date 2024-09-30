<?php
class Model {
    protected $db;

    function __construct() {
        $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    function deploy() {
        // Chequear si hay tablas
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
        if(count($tables)==0) {
            // Si no hay crearlas
            $sql =<<<END
            --
        -- Estructura de tabla para la tabla `vehiculos`
        --

        CREATE TABLE `vehiculos` (
        `ID_Vehiculo` int(11) NOT NULL,
        `Patente` varchar(45) NOT NULL,
        `Modelo` varchar(45) NOT NULL,
        `Marca` varchar(45) NOT NULL,
        `Año_de_Modelo` year(4) NOT NULL,
        `Color` varchar(40) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        --
        -- Volcado de datos para la tabla `vehiculos`
        --

        INSERT INTO `vehiculos` (`ID_Vehiculo`, `Patente`, `Modelo`, `Marca`, `Año_de_Modelo`, `Color`) VALUES
        (1, 'WET784', 'Corsa', 'Chevrolet', '2011', 'Blanco'),
        (2, 'AD652FG', 'Cronos', 'Fiat', '2022', 'Gris'),
        (5, 'AC-345-FP', 'Corolla', 'Toyota', '2015', 'Negro');

        --
        -- Índices para tablas volcadas
        --

        --
        -- Indices de la tabla `alquileres`
        --
        ALTER TABLE `alquileres`
        ADD PRIMARY KEY (`ID`),
        ADD KEY `fk_id_vehiculo` (`ID_Vehiculo`);

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
        MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

        --
        -- AUTO_INCREMENT de la tabla `vehiculos`
        --
        ALTER TABLE `vehiculos`
        MODIFY `ID_Vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
        