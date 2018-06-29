<?php
namespace Distribuidor;

class Evolusom
{
    public function __construct()
    {
        
    }

    public function StartDownload()
    {
        if ($this->StartSecurity()) {
            $this->DownloadXml();
        }

    }

    private function StartSecurity()
    {
        if (!empty($_SESSION['config.json']['distribuidores'])) {
            if (!empty($_SESSION['config.json']['distribuidores']['evolusom'])) {
                $credenciais = $_SESSION['config.json']['distribuidores'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    private function DownloadXml()
    {
        /*
         * INICIANDO DOWNLOAD DE NIVEL 1 SEM PROXY..
         */
        $ninja = curl_init();
        $arquivo = fopen($_SESSION['config.json']['diretorios_cache']['1'] . 'produtos_evolusom.cache', 'w');
        curl_setopt($ninja, CURLOPT_URL, $_SESSION['config.json']['distribuidores']['evolusom']['ftp']);
        curl_setopt($ninja, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ninja, CURLOPT_FILE, $arquivo);
        curl_setopt($ninja, CURLOPT_USERPWD, $_SESSION['config.json']['distribuidores']['evolusom']['usuario'] . ':' . $_SESSION['config.json']['distribuidores']['evolusom']['senha']);
        curl_setopt($ninja, CURLOPT_PROXYTYPE, $_SESSION['config.json']['proxy_configuracoes']['proxy_acesso']);
        curl_exec($ninja);
        curl_close($ninja);
        fclose($arquivo);
        if (file_exists($_SESSION['config.json']['diretorios_cache']['1'] . 'produtos_evolusom.cache')) {
            echo 'SUCESSO AO GERAR CACHE DA EVOLUSOM SEM PROXY<br>';
        } else {
            echo 'ERRO AO GERAR CACHE DA EVOLUSOM SEM PROXY!!!<br>';
            $ninja = curl_init();
            $arquivo = fopen($_SESSION['config.json']['diretorios_cache']['1'] . 'produtos_evolusom.cache', 'w');
            curl_setopt($ninja, CURLOPT_URL, $_SESSION['config.json']['distribuidores']['evolusom']['ftp']);
            curl_setopt($ninja, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ninja, CURLOPT_FILE, $arquivo);
            curl_setopt($ninja, CURLOPT_USERPWD, $_SESSION['config.json']['distribuidores']['evolusom']['usuario'] . ':' . $_SESSION['config.json']['distribuidores']['evolusom']['senha']);
            curl_setopt($ninja, CURLOPT_PROXYTYPE, $_SESSION['config.json']['proxy_configuracoes']['proxy_acesso']);
            curl_exec($ninja);
            curl_close($ninja);
            fclose($arquivo);
            if (file_exists($_SESSION['config.json']['diretorios_cache']['1'] . 'produtos_evolusom.cache')) {
                echo 'SUCESSO AO GERAR CACHE DA EVOLUSOM COM PROXY<br>';
            } else {
                echo 'ERRO AO GERAR CACHE DA EVOLUSOM COM PROXY<br>';
            }
        }
    }
}
