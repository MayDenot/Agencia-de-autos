
# Agencia de autos

## DER

![DER-ParteDos](https://github.com/user-attachments/assets/ab55e2a3-322b-42f0-8595-49e5081364c8)

## Integrantes:
- Ferrante, Tomas Abel (44048410)
- Denot, Mayra Andrea (45539846)

## Descripción
Sistema para gestionar alquileres de autos. La tabla alquileres tiene un ID (Foreign key) que se encuentra vinculada con el ID_Vehiculo (Primary key) de la tabla Vehiculos.


## Deployment

Para desplegar este sitio se debe tener instalado:
- [Xampp - Apache](https://www.apachefriends.org/download.html)

Una vez instalado, al ejecutarlo saldrá un panel como el siguiente:

![Xampp-Apache](https://www.mclibre.org/consultar/php/img/xampp/xampp-control-panel-firewall-01.png)

Pasos a seguir:
1. Presionar "Start" al módulo de Apache y MySQL.
2. Entrar en Explorer (ubicada en la columna derecha).
3. Dirigirse a la carpeta htdocs.
4. Clonar este mismo repositorio dentro de htdocs.

### Descargar base de datos

Pasos:
1. Presionar "Admin" al módulo de MySQL.
2. Importar la base de datos que se encuentra en la carpeta /database (antes de importarla tendrá que crear una base de datos llamada db_agencia_autos, igual que la importada).

### Navegador
Abrir su navegador e ingresar la URL:  
http://localhost/Agencia-de-autos/  
**Tenga en cuenta que puede variar el nombre de la carpeta clonada.**

## Permisos de administrador
Para poder modificar los items y categorías debe iniciar sesión con los siguientes datos:

**Usuario**: webadmin  
**Constraseña**: admin

