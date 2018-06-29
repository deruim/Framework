<?php
namespace Core;

/*
 * O CORE SE INICIA CHECANDO AS CONECXOES COM OS WEBSERVICES
 * E SALVANDO UM PROXY EM SESSAO PARA FUTURA UTILIZAÇAO
 * INICIANDO GERAÇÃO DE PROXY EM SESSAO;
 */

class Core
{
    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
        session_start();
        if (!isset($_SESSION['config.json'])) {
            $this->configurar_aplicacao();
        } else {
            //APLICACAO JA CONFIGURADA E SESSAO VALIDA
            echo '<pre>';
            //print_r($_SESSION);
        }
    }
    private function configurar_aplicacao()
    {
        $configuracoes = json_decode(file_get_contents('../config.json'), 1);
        $_SESSION['config.json'] = $configuracoes;
        $proxy = $this->configurar_proxy();
        if (!empty($proxy)) {
            $_SESSION['config.json']['proxy_configuracoes']['proxy_acesso'] = $proxy;
        }
    }
    private function configurar_proxy()
    {
        $pais_proxy = $_SESSION['config.json']['proxy_configuracoes']['pais'];
        $porta_proxy = $_SESSION['config.json']['proxy_configuracoes']['porta'];
        $ninja_proxy = curl_init();
        curl_setopt($ninja_proxy, CURLOPT_URL, "https://gimmeproxy.com/api/getProxy?port=$porta_proxy&maxCheckPeriod=600&country=$pais_proxy");
        curl_setopt($ninja_proxy, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ninja_proxy, CURLOPT_CONNECTTIMEOUT, 5);
        $proxy_array = curl_exec($ninja_proxy);
        curl_close($ninja_proxy);
        $verifica_proxy = json_decode($proxy_array, 1);
        $conteudo_externo = file_get_contents('http://checkip.dyndns.com/');
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $conteudo_externo, $ip_externo);
        $ip_externo = $ip_externo[1];
        $proxy_array_reserva = array(
            'ip' => $ip_externo,
            'port' => '80',
        );
        if (array_key_exists('status_code', $verifica_proxy)) {
            $proxy_array = $proxy_array_reserva;
        } elseif (array_key_exists('status_message', $verifica_proxy)) {
            $proxy_array = $proxy_array_reserva;
        } else {
            $proxy_array = json_decode($proxy_array, 1);
        }
        $proxy_ip = $proxy_array['ip'];
        $proxy_porta = $proxy_array['port'];
        $proxy = "$proxy_ip:$proxy_porta";
        return $proxy;
    }
}
