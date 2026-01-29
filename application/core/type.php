<?php

function check_type(&$value, $type){
  $flag = array('flags' => FILTER_NULL_ON_FAILURE);
  switch ($type) {
    case 'INT':
        $value = filter_var($value, FILTER_VALIDATE_INT, $flag);
        if ($value === 0) $value="0";
        break;
    case 'FLOAT':
        $value = filter_var($value, FILTER_VALIDATE_FLOAT, $flag);
        break;
    case 'EMAIL':
        $value = filter_var($value, FILTER_VALIDATE_EMAIL, $flag);
        break;
    case 'DATE':
        $value = validateDate($value);
        break;
    case 'DATETIME':
        $value = validateDateTime($value);
        break;
    case 'STRING':
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        break;
    default:
      return false;
  }
  return $value !== null;
}

function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return ($d && $d->format($format) === $date) ? $date : null;
}

function validateDateTime($date, $format = DateTimeInterface::ISO8601){
    $d = DateTime::createFromFormat($format, $date);
    return ($d && $d->format($format) === $date) ? $date : null;
}
?>
