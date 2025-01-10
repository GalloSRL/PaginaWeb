<?php
class Conexion{
	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=gallosrl_web",
                        "root",
                        "");
		/*$link = new PDO("mysql:host=localhost;dbname=gallo_panel",
                        "root",
                        "");*/
		$link->exec("set names utf8");
		return $link;
	}
}