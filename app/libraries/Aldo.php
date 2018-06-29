<?php
namespace Distribuidor;

class Aldo
{
    public function __construct()
    {

    }

    public function StartDownload()
    {
        $aldo_curl = curl_init();
        curl_setopt($aldo_curl, CURLOPT_HEADER, 0);
        curl_setopt($aldo_curl, CURLOPT_VERBOSE, 0);
        curl_setopt($aldo_curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($aldo_curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($aldo_curl, CURLOPT_URL, 'http://webservice.aldo.com.br/asp.net/ferramentas/integracao.ashx?u=42496&p=1nf0m1');
        $produtos_xml = curl_exec($aldo_curl);
        curl_close($aldo_curl);

        $aldo_cache = fopen($_SESSION['config.json']['diretorios_cache']['1'] . 'produtos_aldo.cache', 'w');
        $escreve = fwrite($aldo_cache, $produtos_xml);
        fclose($aldo_cache);

    }

    private function StartSecurity()
    {

    }
    private function DownloadXml()
    {

    }
}
