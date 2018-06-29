<?php
namespace Distribuidor;

class Hayamax
{
    public function __construct()
    {

    }
    public function StartDownload()
    {
        $hayamax_curl = curl_init();
        curl_setopt($hayamax_curl, CURLOPT_HEADER, 0);
        curl_setopt($hayamax_curl, CURLOPT_VERBOSE, 0);
        curl_setopt($hayamax_curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($hayamax_curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($hayamax_curl, CURLOPT_URL, 'http://webmax.hayamax.com.br/crossdock/servlet/CrossDockingServlet.class.php?action=crossDockingPrice&customerId=' . $_SESSION['config.json']['distribuidores']['hayamax']['usuario'] . '&compress=' . $_SESSION['config.json']['distribuidores']['hayamax']['senha'] . '&canal=' . $_SESSION['config.json']['distribuidores']['hayamax']['canal']);
        $produtos_xml = curl_exec($hayamax_curl);
        curl_close($hayamax_curl);

        $hayamax_cache = fopen($_SESSION['config.json']['diretorios_cache']['1'] . 'produtos_hayamax.cache', 'w');
        $escreve = fwrite($hayamax_cache, $produtos_xml);
        fclose($hayamax_cache);
    }
}
