<?php
/*
 * INICIANDO CORE, KERNEL E DRIVERS DO SISTEMA,
 * AO UNICIAR O CORRE JÁ INICIO MINHAS SESSOES DE BASE
 * DECLARADAS NO ARQUIVO CONFIG.JSON
 *
 * AO INICIAR OS DRIVER'S INICIO MEUS AUXILIARES DE CACHE,
 * LIMPO OS MESMOS APOS TEMPO ESTABELECIDO DE VENCIMENTO
 * CONFIGURADO NO CONFIG.JSON
 */

use Core\Core;
use Core\Routes;
use Driver\DriverCache;
use Driver\DriverLog;

/*
 * INICIANDO SISTEMA DE LIBRARIS, BAIXANDO XML OU ARQUIVO
 * DO DISTREIBUIDOR, INICIANDO CURLS E CRAWLERS PARA DOWNLOAD
 * DO ARQUIVO, PARA ESTAÇÃO DE TRATAMENTO (BOX).
 */
echo '<pre>';
$core = new Core();
$driver_cache = new DriverCache();
$driver_log = new DriverLog();
