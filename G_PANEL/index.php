<?php



require_once "controladores/plantilla.controlador.php";

require_once "controladores/usuario.controlador.php";

require_once "controladores/vacancia.controlador.php";

require_once "controladores/rol.controlador.php";

require_once "controladores/producto.controlador.php";

require_once "controladores/ticket.controlador.php";

require_once "controladores/ticket.controladorcord.php";

require_once "controladores/cliente.controlador.php";

require_once "controladores/mantenimiento.controlador.php";



require_once "modelos/usuario.modelo.php";

require_once "modelos/vacancia.modelo.php";

require_once "modelos/rol.modelo.php";

require_once "modelos/producto.modelo.php";

require_once "modelos/ticket.modelo.php";

require_once "modelos/ticketcord.modelo.php";

require_once "modelos/cliente.modelo.php";

require_once "modelos/mantenimiento.modelo.php";



$plantilla = new ControladorPlantilla();

$plantilla -> ctrPlantilla();

