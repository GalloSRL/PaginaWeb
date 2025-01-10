<?php
class Conexion{
	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=gallosrl_web",
                        "gallosrl_jportillo",
                        "vjd+PjZON?~w");
		$link->exec("set names utf8");
		return $link;
	}
}