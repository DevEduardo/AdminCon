<?php  

function mil($num)
{
	$num = number_format($num, 2, ',', '.');

	return 'Bs '.$num;
}

function share($share)
{
	if ($share == 1) {
		return 'No comun';
	}elseif ($share == 2) {
		return 'Extra';
	}elseif ($share == 0){
		return 'Gastos generales';
	}elseif ($share == 3){
    return 'Fondo';
  }elseif ($share == 4){
    return 'Gastos administrativos';
  }
}

function generarCodigo($longitud) {
  $key = '';
  $pattern = '1234567890';
  $max = strlen($pattern)-1;
  for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
  return $key;
}

function number(){
	$serial = generarCodigo(3);
	$data = date('d-m');
	$data = explode('-',$data);
	$numero = $data[1].''.$serial;

	return $numero;
}

function available($var){
	if($var == 1){ 
        return 'SI'; 
    }else{ 
        return 'NO'; 
    }
}

function date_format_sql($date){
	$date = explode('/', $date);
	$date_Sql = $date[2].'-'.$date[1].'-'.$date[0]; 
	date_create($date_Sql);
	return $date_Sql;
}

  function month($months){

    switch ($months) {

      case '01':
        return 'Enero';
        break;

      case '02':
        return 'Febrero';
        break;

      case '03':
        return 'Marzo';
        break;

      case '04':
        return 'Abril';
        break;

      case '05':
        return 'Mayo';
        break;

      case '06':
        return 'Junio';
        break;

      case '07':
        return 'Julio';
        break;

      case '08':
        return 'Agosto';
        break;

      case '09':
        return 'Septiembre';
        break;

      case '10':
        return 'Octubre';
        break;

      case '11':
        return 'Noviembre';
        break;

      case '12':
        return 'Diciembre';
        break;

      default:
        # code...
        break;
    }

  }

  function monthDue($monthDue){
    $date = explode('/', $monthDue);
    switch ($date[0]) {

      case '01':
        return '01';       
        break;

      case '02':
        return '02';
        break;

      case '03':
        return '03';
        break;

      case '04':
        return '04';
        break;

      case '05':
        return '05';
        break;

      case '06':
        return '06';
        break;

      case '07':
        return '07';
        break;

      case '08':
        return '08';
        break;

      case '09':
        return '09';
        break;

      case '10':
        return '10';
        break;

      case '11':
        return '11';
        break;

      case '12':
        return '12';
        break;

      default:
        # code...
        break;
    }

  }

  function monthYear($monthYear){
    $date = explode('-', $monthYear);
    switch ($date[0]) {

      case '01':
        return 'Enero '.$date[1];
        break;

      case '02':
        return 'Febrero '.$date[1];
        break;

      case '03':
        return 'Marzo '.$date[1];
        break;

      case '04':
        return 'Abril '.$date[1];
        break;

      case '05':
        return 'Mayo '.$date[1];
        break;

      case '06':
        return 'Junio '.$date[1];
        break;

      case '07':
        return 'Julio '.$date[1];
        break;

      case '08':
        return 'Agosto '.$date[1];
        break;

      case '09':
        return 'Septiembre '.$date[1];
        break;

      case '10':
        return 'Octubre '.$date[1];
        break;

      case '11':
        return 'Noviembre '.$date[1];
        break;

      case '12':
        return 'Diciembre '.$date[1];
        break;

      default:
        # code...
        break;
    }

  }

  function generatePassword()
  {
    $key = '';
    $pattern = '1234567890abcdefghijklmnyqw';
    $max = strlen($pattern)-1;
    for($i=0;$i < 9;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
  }

  function participation($amount, $aliquot){
    $share = $amount * $aliquot;
    return mil($share);
  }
  
  function calculation($value){
    switch ($value) {
      case '1':
        return '% Sobre gastos comunes';
        break;
      case '2':
        return '% Sobre gastos comunes + reservas';
        break;
      case '3':
        return 'Aliguota general';
        break;
      case '4':
        return 'Aliguota extra';
        break;
      case '5':
        return 'Aliguota gas';
        break;
      case '6':
        return 'Aliguota luz';
        break;
      case '7':
        return 'Aliguota agua';
        break;
      case '8':
        return 'Manual';
      case '9':
        return '% Sobre honorarios profecionales';
        break;
    }
  }