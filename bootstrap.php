<?php
/*
 * A APLICACAO SE INICIAR RODANDO SEU KERNEL PARA
 * COMPOSICAO DO CORE E DRIVE.
 */
require_once 'vendor/autoload.php';
require_once 'core/kernel.php';

/*
 * INICIANDO SISTEMA DE LIBRARIS, BAIXANDO XML OU ARQUIVO
 * DO DISTREIBUIDOR, INICIANDO CURLS E CRAWLERS PARA DOWNLOAD
 * DO ARQUIVO, PARA ESTAÇÃO DE TRATAMENTO (BOX).
 */

use Distribuidor\Evolusom;
use Distribuidor\Hayonik;

$evolusom = new Evolusom();
//$evolusom->StartDownload();

$hayonik = new Hayonik();
//$hayonik->StartDownload();
