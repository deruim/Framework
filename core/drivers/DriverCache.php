<?php
namespace Driver;

class DriverCache
{
    public function __construct()
    {
        $this->VerificarCaches();
    }

    private function VerificarCaches()
    {
        $caminhos_de_caches = $_SESSION['config.json']['diretorios_cache'];
        foreach ($caminhos_de_caches as $caminho) {
            foreach (glob($caminho . '*') as $diretorio) {
                if (!is_dir($diretorio)) {
                    $arquivo_encontrado = explode($caminho, $diretorio)[1];
                    if (preg_match('/.cache/', $arquivo_encontrado)) {

                        /*
                         * PEGANDO DATAS ATUAIAS PARA COMPARAÇÃO
                         */

                        $dia_atual = date('d');
                        $mes_atual = date('m');
                        $ano_atual = date('Y');
                        $hora_atual = date('H');
                        $minuto_atual = date('i');

                        /*
                         * PEEGANDO DATAS DO CACHE PARA COMPARAÇÃO
                         */

                        $data_cache = date('d/m/Y-H:i', filectime($caminho . $arquivo_encontrado));

                        $dia_cache = explode('/', $data_cache)[0];
                        $mes_cache = explode('/', $data_cache)[1];
                        $ano_cache = explode('/', $data_cache)[2];
                        $ano_cache = explode('-', $ano_cache)[0];

                        $horarios_cache = explode('-', $data_cache)[1];
                        $horarios_cache = explode(':', $horarios_cache);

                        $hora_cache = $horarios_cache[0];
                        $minuto_cache = $horarios_cache[1];

                        if ($dia_cache == $dia_atual && $mes_cache == $mes_atual && $ano_cache == $ano_atual) {
                            if ($hora_atual > $hora_cache - ceil($_SESSION['config.json']['tempo_cache'])) {
                                unlink($caminho . $arquivo_encontrado);
                            } else {
                                //ESSE CACHE AINDA SE ENCONTRA VALIDO E PRONTO PRA USO.
                            }
                        }
                    }
                }
            }
        }
    }
}
