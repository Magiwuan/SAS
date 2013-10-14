<?php
class PHPPaging {
	var $porPagina = 20;
	var $paginasAntes = 4;
	var $paginasDespues = 4;
	var $linkClase;
	var $linkSeparador = "&nbsp;";
	var $linkSeparadorEspecial = "&nbsp;";
	var $linkAgregar;
	var $linkTitulo = true;
	var $mostrarPrimera = "|<";
	var $mostrarUltima = ">|";
	var $mostrarAnterior = "<";
	var $mostrarSiguiente = ">";
	var $mostrarAdyacentes = "{n}";
	var $mostrarActual = "<span class=\"navthis\">{n}</span>";
	var $nombreVariable = "pagina";
	var $linkEstructura;
	var $mantenerURLVar = array();
	var $quitarURLVar = array();
	var $modo = 'reporte';
	var $estilo;
	var $numTotalPaginas;
	var $numEstaPagina;	
	var $numPrimerRegistro;	
	var $numUltimoRegistro;	
	var $numTotalRegistros;	
	var $numTotalRegistros_actual;	
	var $data = false;	
	var $ejecutard = array();	
	var $sql = false;	
	var $conn;	
	var $done;	
	var $error = null;	
	var $mostre_error = false;	
	var $paginasAntesEspecial = array();	
	var $paginasDespuesEspecial = array();	
	var $verPost = array();
	
	
	function __construct ($conn = null) {
		$this->conn = $conn;
	}
	
	function modo($modo) {
		$modos = array('publicacion', 'reporte', 'desarrollo');
		$modo = trim($modo);
		$modo = strtolower($modo);
		if(in_array($modo, $modos)) $this->modo = $modo;
		else return $this->error(true, "No se pudo cambiar el modo de ejecución pues ingresó uno que no existe o que es inválido.");
		return true;
	}

	function verPost($boolean = true) {
		$this->verPost = $boolean == true;
		return true;
	}

	function agregarArray ($input) {
		if (!is_array($input)) return $this->error(true, "El arreglo de datos ingresado no es válido. Recuerde que debe indicar una variable de tipo array.");
		$this->data = (array)$input;
		return true;
	}
	
	function agregarConsulta ($sql) {
		if (empty($sql)) return $this->error(true, "La consulta SQL que está indicando está vacía.");
		$this->sql = $sql;
		return true;
	}
	
	
	function porPagina ($num) {
		if (is_numeric($num) and $num >= 1 and $num !== true) $this->porPagina = intval($num);
		else return $this->error(true, "El número de elementos por página indicado es inválido. Sólo puede poner números enteros mayores o iguales a 1.");
		return true;
	}

	function nombreVariable ($var) {
		if(!is_string($var) or empty($var)) return $this->error(true, "El nombre de variable indicado está vacío o es inválido.");
		if(!ereg("(^[a-zA-Z0-9]+)$",$var)) return $this->error(true, "El nombre de la variable indicado contiene caracteres no válidos");
		$this->nombreVariable = (string)$var; 
		return true;
	}
	
	function paginasAntes () { // Función modificada version 2.0
		$n = func_get_args();
		$num = array_shift($n);
		if (is_numeric($num) and $num >= 1 and $num !== true) $this->paginasAntes = intval($num);
		elseif($num === false or $num === '' or $num === 0 or $num === '0' or $num === null) $this->paginasAntes = false; // version 2.0
		else return $this->error(true, "El número indicado en el método paginasAntes() es inválido");
		if(count($n) > 0) {
			foreach($n as $numero) {
				if(is_numeric($numero) and $numero > 0) $this->paginasAntesEspecial[] = intval($numero);
				elseif($this->modo == 'desarrollo') return $this->error(true, "Los parámetros del método paginasAntes() deben ser todos números");
			}
		}
		return true;
	}
	
	function paginasDespues () { // Función modificada version 2.0
		$n = func_get_args();
		$num = array_shift($n);
		if (is_numeric($num) and $num >= 1 and $num !== true) $this->paginasDespues = intval($num);
		elseif($num === false or $num === '' or $num === 0 or $num === '0' or $num === null) $this->paginasDespues = false; // version 2.0
		else return $this->error(true, "El número indicado en el método paginasDespues() es inválido");
		if(count($n) > 0) {
			foreach($n as $numero) {
				if(is_numeric($numero) and $numero > 0) $this->paginasDespuesEspecial[] = intval($numero);
				elseif($this->modo == 'desarrollo') return $this->error(true, "Los parámetros del método paginasDespues() deben ser todos números");
			}
		}
		return true;
	}
  
	function linkSeparador ($separador = '', $convertir = false) {
		if($separador === false or $separador === null or $separador === '') $this->linkSeparador = '';
		if($separador === true) $this->linkSeparador = 1;
		if($separador === 0 or $separador === '0') $this->linkSeparador = (string)'0'; // Arreglado v2.1 (Gracias a Cuauhtémoc)
		else $this->linkSeparador = ($convertir == true) ? htmlentities((string)$separador, ENT_QUOTES) : (string)$separador;
	}
 
	function linkSeparadorEspecial ($separador = '', $convertir = false) {
		if($separador === false) $this->linkSeparadorEspecial = false;
		if($separador === true) $this->linkSeparadorEspecial = 1;
		if($separador === 0 or $separador === '0') $this->linkSeparadorEspecial = (string)'0';
		else $this->linkSeparadorEspecial = ($convertir == true) ? htmlentities((string)$separador, ENT_QUOTES) : (string)$separador;
	}
  
	function mostrarPrimera ($str, $convertir = false) {
		if($str === false or $str === null or $str === '') $this->mostrarPrimera = false;
		elseif($str === 0 or $str === '0') $this->mostrarPrimera = '0';
		elseif(!empty($str) and $str !== true) $this->mostrarPrimera = ($convertir == true) ? htmlentities((string)$str, ENT_QUOTES) : (string)$str;
		else return $this->error(true, "El valor indicado en el método mostrarPrimera() es inválido");
		return true;
	}
  
	function mostrarUltima ($str, $convertir = false) {
		if($str === false or $str === null or $str === '') $this->mostrarUltima = false;
		elseif($str === 0 or $str === '0') $this->mostrarUltima = '0';
		elseif(!empty($str) and $str !== true) $this->mostrarUltima = ($convertir == true) ? htmlentities((string)$str, ENT_QUOTES) : (string)$str;
		else return $this->error(true, "El valor indicado en el método mostrarUltima() es inválido");
		return true;
	}
  
	function mostrarAnterior ($str, $convertir = false) {
		if($str === false or $str === null or $str === '') $this->mostrarAnterior = false;
		elseif($str === 0 or $str === '0') $this->mostrarAnterior = '0';
		elseif(!empty($str) and $str !== true) $this->mostrarAnterior = ($convertir == true) ? htmlentities((string)$str, ENT_QUOTES) : (string)$str;
		else return $this->error(true, "El valor indicado en el método mostrarAnterior() es inválido");
		return true;
	}
  
	function mostrarSiguiente ($str, $convertir = false) {
		if($str === false or $str === null or $str === '') $this->mostrarSiguiente = false;
		elseif($str === 0 or $str === '0') $this->mostrarSiguiente = '0';
		elseif(!empty($str) and $str !== true) $this->mostrarSiguiente = ($convertir == true) ? htmlentities((string)$str, ENT_QUOTES) : (string)$str;
		else return $this->error(true, "El valor indicado en el método mostrarSiguiente() es inválido");
		return true;
	}
  
	function mostrarAdyacentes ($str, $convertir = false) {
		if($str === 0 or $str === '0') $this->mostrarAdyacentes = '0';
		elseif(!empty($str) and $str !== true) $this->mostrarAdyacentes = ($convertir == true) ? htmlentities((string)$str, ENT_QUOTES) : (string)$str;
		else return $this->error(true, "El valor indicado en el método mostrarAdyacentes() es inválido");
		return true;
	}
  
	function mostrarIntermedias ($str, $convertir = false) {
		return $this->mostrarAdyacentes($str, $convertir);
	}
  
	function mostrarActual ($str, $convertir = false) {
		if($str === false or $str === null or $str === '') $this->mostrarActual = false;
		elseif($str === 0 or $str === '0') $this->mostrarActual = (string)'0';
		elseif(!empty($str) and $str !== true) $this->mostrarActual = ($convertir == true) ? htmlentities((string)$str, ENT_QUOTES) : (string)$str;
		else return $this->error(true, "El valor indicado en el método mostrarActual() es inválido");
		return true;
	}
	
	function linkAgregar ($agr) {
		if(empty($agr)) return $this->error(true, "El valor indicado en el método linkClase() está vacío");
		$this->linkAgregar = $agr;
		return true;
	}

	function div($div) {
		if(empty($div)) return $this->error(true, "El valor indicado en el método linkClase() está vacío");
		$this->div = $div;
		return true;
	}

	function linkClase ($id) {
		if(empty($id)) return $this->error(true, "El valor indicado en el método linkClase() está vacío");
		if(!ereg("(^[a-zA-Z0-9_ ]+)$",$id) or $id === true) return $this->error(true, "El nombre indicado en el método linkClase() es inválido");
		$this->linkClase = $id;
		return true;
	}
	
	function linkTitulo ($str, $convertir = true) {
		if($str === true) $this->linkTitulo = true;
		elseif($str === false or $str === null or $str === '') $this->linkTitulo = false;
		elseif($str === 0 or $str === '0') $this->linkTitulo = (string)'0';
		elseif(!empty($str)) $this->linkTitulo = ($convertir == true) ? htmlentities((string)$str, ENT_QUOTES) : (string)$str;
		else return $this->error(true, "El valor indicado en el método linkTitulo() está vacío");
		return true;
	}
	
	
	function linkEstructura ($estructura) {
		if($estructura === 0 or $estructura === '0') $this->linkEstructura = (string)'0';
		elseif($estructura === false) $this->linkEstructura = false;
		elseif(!empty($estructura) and $estructura !== true) $this->linkEstructura = (string)$estructura;
		else return $this->error(true, "El valor indicado en el método linkEstructura() está vacío");
		return true;
	}
	
	function mantenerVar () {
		$args = func_get_args();
		return $this->mantenerURLVar = array_merge($this->mantenerURLVar, $args);
	}

	function quitarVar () {
		$args = func_get_args();
		return $this->quitarURLVar = array_merge($this->quitarURLVar, $args);
	}
	
	function numTotalPaginas () {
		if($this->done != true) return $this->error(true, "No se puede mostrar el número total de páginas pues no se ha realizado ninguna paginación");
		return $this->numTotalPaginas;
	}
	
	function numEstaPagina () {
		if($this->done != true) return $this->error(true, "No se puede mostrar el número de página actual pues no se ha realizado ninguna paginación");
		return $this->numEstaPagina;
	}

	function numPrimerRegistro () {
		if($this->done != true) return $this->error(true, "No se puede mostrar el número del primer registro mostrado pues no se ha realizado ninguna paginación");
		return $this->numPrimerRegistro;
	}

	function numUltimoRegistro () {
		if($this->done != true) return $this->error(true, "No se puede mostrar el número del último registro mostrado pues no se ha realizado ninguna paginación");
		return $this->numUltimoRegistro;
	}

	function numTotalRegistros () {
		if($this->done != true) return $this->error(true, "No se puede generar la barra de navegación pues no se ha realizado ninguna paginación");
		return $this->numTotalRegistros;
	}

	function numRegistrosMostrados () {
		if($this->done != true) return $this->error(true, "No se puede obtener el número de registros mostrados en la página actual pues no se ha realizado ninguna paginación");
		return $this->numTotalRegistros_actual;
	}
	
	function superArray () {
		if($this->done != true) return $this->error(true, "No se puede mostrar la información de la paginación pues no se ha realizado ninguna paginación");
		return array("numPrimerRegistro"=>$this->numPrimerRegistro, "numUltimoRegistro"=>$this->numUltimoRegistro, "numTotalRegistros"=>$this->numTotalRegistros, "porPagina"=>$this->porPagina, "numRegistrosMostrados"=>$this->numTotalRegistros_actual, "nombreVariable"=>$this->nombreVariable, "linkAgregar"=>$this->linkAgregar, "linkClase"=>$this->linkClase, "linkSeparador"=>$this->linkSeparador, "linkSeparadorEspecial"=>$this->linkSeparadorEspecial, "numEstaPagina"=>$this->numEstaPagina, "numTotalPaginas"=>$this->numTotalPaginas, "paginasAntes"=>$this->paginasAntes, "paginasDespues"=>$this->paginasDespues, "mostrarPrimera"=>$this->mostrarPrimera, "mostrarUltima"=>$this->mostrarUltima, "mostrarAnterior"=>$this->mostrarAnterior, "mostrarSiguiente"=>$this->mostrarSiguiente, "mostrarAdyacentes"=>$this->mostrarAdyacentes, "mostrarActual"=>$this->mostrarActual, "linkEstructura"=>$this->linkEstructura);
	}
	
	function fetchResultado () {
		if($this->done != true) return $this->error(false, "No se puede mostrar los resultados porque no se ha realizado la paginación.");
		if(is_array($this->ejecutard)) {
			if(list($key, $row) = each($this->ejecutard)) return $row;
		} elseif($row = @mysql_fetch_array($this->ejecutard)) {
			return $row;
		}
		else return false;
	}
	
	function fetchTodo () {
		if($this->done != true) return $this->error(false, "No se puede mostrar los resultados porque no se ha realizado la paginación.");
		if(is_array($this->ejecutard))
			return (count($this->ejecutard) > 0) ? $this->ejecutard : null;		
		$r = array();
		while($f = $this->fetchResultado()) {
			$r[] = $f;
		}
		return (count($r) > 0) ? $r : null; 
	}

	function fetchNavegacion () {
		if($this->done != true) return $this->error(false, "No se puede generar la barra de navegación pues no se ha realizado ninguna paginación"); // version 2.0
		if(empty($this->linkEstructura)) {
			$i = array();
			if(count($this->mantenerURLVar) > 0) define ('MANTENERURLVARS',1); // version 2.0
			elseif(count($this->quitarURLVar) > 0) define ('QUITARURLVARS',1); // version 2.0
			$vars = $_GET;
			if($this->verPost == true) $vars = array_merge($vars, $_POST); // version 2.0
			foreach($vars as $key=>$val) {
				if($key != $this->nombreVariable) {
					if(defined('MANTENERURLVARS') and !in_array($key, $this->mantenerURLVar) or defined('QUITARURLVARS') and in_array($key, $this->quitarURLVar)) continue;
					
					$i[] = "$key".(empty($val) ? '' : "=".urlencode($val)); // Modificado version 2.0
				}
			}
			$i[] = $this->nombreVariable.'={n}';
			$this->query_string = implode('&amp;',$i); // Modificado version 2.0
			$this->linkEstructura = 'http://'.trim($_SERVER['HTTP_HOST'], '/').'/'.ltrim($_SERVER['PHP_SELF'], '/').'?'.$this->query_string;
		}
		$this->estilo = ' class="nav"';
		$before = $this->paginasAntes;
		$after = $this->paginasDespues;
		$pthis = $this->numEstaPagina;
		$ptotal = $this->numTotalPaginas;
		$before = (($pthis - $before) < 1) ? 1 : ($pthis - $before);
		$after = (($pthis + $after) > $ptotal) ? $ptotal : ($pthis + $after);
		$link_string1 = array(); // version 2.0
		$link_string2 = array(); // version 2.0
		$link_string3 = array(); // version 2.0
		$link_string4 = array(); // version 2.0
		$link_string5 = array(); // version 2.0
		if($this->mostrarPrimera !== false and $pthis > $this->paginasAntes+1) { // Modificado version 2.0
			$link_string1[] = $this->do_link(1,$this->addlinkmsg(1,1,$this->porPagina,1),$this->mostrarPrimera);
		}
		if($this->mostrarAnterior !== false and $pthis > 1) { // Modificado version 2.0
			$link_string1[] = $this->do_link(($pthis-1),$this->addlinkmsg(($pthis-1),(($this->porPagina*($pthis-2))+1),($this->porPagina*($pthis-1)),2),$this->mostrarAnterior);
		}
		if(count($this->paginasAntesEspecial) > 0) { // version 2.0
			$this->paginasAntesEspecial = array_unique($this->paginasAntesEspecial);
			rsort($this->paginasAntesEspecial);
			foreach($this->paginasAntesEspecial as $n) {
				$page = $before-$n;
				if($page < 1 or $page == 1 and $this->mostrarPrimera !== false) continue;
				$link_string2[] = $this->do_link($page,$this->addlinkmsg($page,(($this->porPagina*($page-1))+1),($this->porPagina*$page),3),str_replace("{n}", $page, $this->mostrarAdyacentes));
			}
		}
		$i = 0;
		while($before <= $after) { // Ciclo modificado version 2.0
			if($this->mostrarAdyacentes !== false and $pthis <> $before) {
				$link_string3[] = $this->do_link($before,$this->addlinkmsg($before,(($this->porPagina*($before-1))+1),($this->porPagina*($before)),3),str_replace("{n}", $before, $this->mostrarAdyacentes));
			} elseif($this->mostrarActual != false and $pthis == $before) {
				$link_string3[] = str_replace("{n}", $before, $this->mostrarActual);
			}
			$before++;
		}
		if(count($this->paginasDespuesEspecial) > 0) { // version 2.0
			$this->paginasDespuesEspecial = array_unique($this->paginasDespuesEspecial);
			sort($this->paginasDespuesEspecial);
			foreach($this->paginasDespuesEspecial as $n) {
				$page = $after+$n;
				if($page > $ptotal or $page == $ptotal and $this->mostrarUltima !== false) continue;
				$link_string4[] = $this->do_link($page,$this->addlinkmsg($page,(($this->porPagina*($page-1))+1),($this->porPagina*$page),3),str_replace("{n}", $page, $this->mostrarAdyacentes));
			}
		}
		if($this->mostrarSiguiente !== false and $pthis < $ptotal) { // Modificado version 2.0
			$link_string5[] = $this->do_link($pthis+1,$this->addlinkmsg(($pthis+1),(($this->porPagina*$pthis)+1),($this->porPagina*($pthis+1)),4),$this->mostrarSiguiente);
		}
		if($this->mostrarUltima !== false and $pthis < ($ptotal-$this->paginasDespues)) { // Modificado version 2.0
			$link_string5[] = $this->do_link($ptotal,$this->addlinkmsg($ptotal,(($this->porPagina*($ptotal-1))+1),$this->numTotalRegistros,5),$this->mostrarUltima);
		}
		$link_string = null;
		if(!empty($link_string1)) $link_string .= implode($this->linkSeparador,$link_string1).$this->linkSeparador;
		if(!empty($link_string2)) $link_string .= implode($this->linkSeparadorEspecial,$link_string2).$this->linkSeparadorEspecial;
		if(!empty($link_string3)) $link_string .= implode($this->linkSeparador,$link_string3);
		if(!empty($link_string4)) $link_string .= $this->linkSeparadorEspecial.implode($this->linkSeparadorEspecial,$link_string4);
		if(!empty($link_string5)) $link_string .= $this->linkSeparador.implode($this->linkSeparador,$link_string5);
		
		return $link_string;
	}

	function addlinkmsg ($tp,$rs,$rt,$type = null) {
		$total = $this->numTotalRegistros;
		$rt = ($rt > $total) ? $total : $rt;
		if($this->linkTitulo === true) {
			switch($type) {
				case 1: return "Primera p&aacute;gina. Resultados del $rs al $rt de $total"; break;
				case 2: return "P&aacute;gina anterior: Resultados del $rs al $rt de $total"; break;
				case 3: return "P&aacute;gina $tp: Resultados del $rs al $rt de $total"; break; // Corregido version 2.0
				case 4: return "P&aacute;gina siguiente. Resultados del $rs al $rt de $total"; break;
				case 5: return "&Uacute;ltima p&aacute;gina. Resultados del $rs al $rt de $total"; break;
				default: return $this->addlinkmsg($tp,$rs,$rt,3);
			}
		} elseif($this->linkTitulo === false or $this->linkTitulo === '' or $this->linkTitulo === null) {
			return false;
		} else {
			return sprintf((string)$this->linkTitulo,$tp,$rs,$rt,$this->numTotalRegistros,$this->numTotalPaginas);
		}
	}
		
	function check_vars () { // Función modificada version 2.0
		$modo = $this->modo;
		$this->modo = 'publicacion';
		if(!$this->porPagina($this->porPagina)) $this->porPagina = 5;
		if(!$this->mostrarPrimera($this->mostrarPrimera)) $this->mostrarPrimera = "&laquo; Primera";
		if(!$this->mostrarAnterior($this->mostrarAnterior)) $this->mostrarAnterior = "&lt; Anterior";
		if(!$this->mostrarSiguiente($this->mostrarSiguiente)) $this->mostrarSiguiente = "Siguiente &gt;";
		if(!$this->mostrarUltima($this->mostrarUltima)) $this->mostrarUltima = "&Uacute;ltima &raquo;";
		if(!$this->mostrarAdyacentes($this->mostrarAdyacentes)) $this->mostrarAdyacentes = "{n}";
		if(!$this->mostrarActual($this->mostrarActual)) $this->mostrarActual = "{n}";
		if(!$this->paginasAntes($this->paginasAntes)) $this->paginasAntes =  3;
		if(!$this->paginasDespues($this->paginasDespues)) $this->paginasDespues = 3;
		if(!$this->nombreVariable($this->nombreVariable)) $this->nombreVariable = "page"; 
		if($this->linkSeparador === false or $this->linkSeparador === null or $this->linkSeparador === '') $this->linkSeparador = '';
		elseif($this->linkSeparador === 0 or $this->linkSeparador === '0') $this->linkSeparador = (string)'0';
		elseif($this->linkSeparador === true) $this->linkSeparador = 1;
		if($this->linkSeparadorEspecial === false) $this->linkSeparadorEspecial = $this->linkSeparador;
		elseif($this->linkSeparadorEspecial === 0 or $this->linkSeparadorEspecial === '0') $this->linkSeparador = (string)'0';
		elseif($this->linkSeparadorEspecial === true) $this->linkSeparadorEspecial = 1;
		$this->modo = $modo;
		return true;
	}
	
	function do_link ($page, $title = false,$content) { // Función modificada version 2.0
		$href = str_replace('{n}', $page, $this->linkEstructura);
		if(!empty($this->linkAgregar)) $href.= $this->linkAgregar;
		$estilo = $this->estilo;
		$title = $title === false ? '' : " title=\"$title\"";
		$div = $this->div;
		return "<a href=\"javascript: fn_paginar('$div', '$href');\"$title$estilo>$content</a>";
	}
  
	function ejecutar () {
		$this->check_vars();
		if($this->sql === false and $this->data === false) return $this->error(false, "No se ha definido los datos ni la consulta SQL para realizar la paginación"); // version 2.0
		$vars = $_GET;
		if($this->verPost == true) $vars = array_merge($vars, $_POST); // version 2.0
		$numEstaPagina = (isset($vars[$this->nombreVariable]) and is_numeric($vars[$this->nombreVariable]) and $vars[$this->nombreVariable] >= 1) ? intval($vars[$this->nombreVariable]) : 1; // Modificado version 2.0
		$this->numEstaPagina = &$numEstaPagina;
		$numPrimerRegistro = ($numEstaPagina - 1) * $this->porPagina;
		if(!empty($this->sql)) {
			$result = (isset($this->conn)) ? @mysql_query($this->sql,$this->conn) : @mysql_query($this->sql);
			if(!$result) return $this->error(false, @mysql_error(), $this->sql); // version 2.0
			$this->numTotalRegistros = @mysql_num_rows($result);
		} else {
			$data = array_values($this->data);
			$data_keys = array_keys($this->data);
			$this->numTotalRegistros = count($data);
		}
		if($this->numTotalRegistros < $numPrimerRegistro) {
			$numPrimerRegistro = 0;
			$numEstaPagina = 1;
		}
		$this->numTotalPaginas = ceil($this->numTotalRegistros / $this->porPagina);
		if($this->numTotalRegistros >= 1) {
			$this->numPrimerRegistro = $numPrimerRegistro + 1;
			$pdata = array();
			if(!empty($this->sql)) {
				$sql = $this->sql." LIMIT $numPrimerRegistro, {$this->porPagina}"; //Separada version 2.0
				$result = (isset($this->conn)) ? @mysql_query($sql, $this->conn) : @mysql_query($sql);
				if(!$result) return $this->error(false, @mysql_error(), $sql, ereg("limit[ ]+[0-9]+(,[ ]*[0-9]+)?", strtolower($sql))); // version 2.0
				$this->ejecutard = $result;
				$this->numTotalRegistros_actual = mysql_num_rows($result);
			} else {
				$numUltimoRegistro = $numPrimerRegistro + $this->porPagina - 1;
				while($numPrimerRegistro <= $numUltimoRegistro) {
					if(isset($data[$numPrimerRegistro])) {
						$key = (isset($data_keys[$numPrimerRegistro])) ? $data_keys[$numPrimerRegistro] : rand()."_".$numPrimerRegistro;
						$pdata[$key] = $data[$numPrimerRegistro];
						$numPrimerRegistro++;
					} else {
						break;
					}
				}
				$this->ejecutard = $pdata;
				$this->numTotalRegistros_actual = count($pdata);
			}
			$this->numUltimoRegistro = $this->numPrimerRegistro + $this->numTotalRegistros_actual - 1;
		} else {
			$this->numPrimerRegistro = 0;
			$numEstaPagina = 0;
			$this->numTotalRegistros_actual = 0;
			$this->numUltimoRegistro = 0;
			$this->ejecutard = array();
		}
		$this->done = true;
		return true;
	}
	function error($desarrollo = true, $msg, $query = false, $limit_error = null) {
		return false;
	}
}
?>