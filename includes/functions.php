<?php

/*************************
 * Funções do aplicativo *
 ************************* 
 * Este arquivo contém diversas funções de uso geral no aplicativo.
 * A maior parte dessas funções pode ser usada em outras aplicações.
 * Guarde-as com cuidado e acessíveis no seu GitHub.com.
 **/

/**
 * Facilita o DEBUG dos códigos:
 * Referências: 
 *  • https://www.w3schools.com/php/php_functions.asp
 *  • https://www.w3schools.com/php/func_var_var_dump.asp
 *  • https://www.w3schools.com/php/func_var_print_r.asp
 *  • https://www.w3schools.com/php/func_misc_exit.asp
 **/
function debug($var, $exit = true, $dump = false)
{
    echo '<pre>';
    if ($dump) var_dump($var);
    else print_r($var);
    echo '</pre>';
    if ($exit) exit();
}

/**
 * Função que conver datas DD/MM/AAAA para AAAA-MM-DD
 * e DD/MM/AAAA HH:II:SS para AAAA-MM-DD HH:II:SS:
 */
function datesys($mydate)
{
    $p1 = explode(' ', $mydate);
    $p2 = explode('/', $p1[0]);
    $d = "{$p2[2]}-{$p2[1]}-{$p2[0]}";
    if (isset($p1[1])) $d .= " {$p1[1]}";
    return $d;
}
