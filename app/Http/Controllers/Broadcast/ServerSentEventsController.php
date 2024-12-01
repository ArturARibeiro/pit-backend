<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ServerSentEventsController extends Controller
{
    public function sse(Request $request): StreamedResponse|null
    {
        try {
            $userId = $request->user()->id;
            $finish = now()->addMinutes(15); // Tempo máximo de conexão

            $response = new StreamedResponse(function () use ($userId, $finish) {
                // Garantir que o buffer de saída esteja ativo
                if (ob_get_level() == 0) {
                    ob_start();
                }

                while (true) {
                    // Finalizar conexão se o cliente desconectar ou o tempo máximo for atingido
                    if (connection_aborted() || now() >= $finish) {
                        break;
                    }

                    // Recuperar dados do cache para o usuário
                    $data = Cache::pull("sse:$userId", []);

                    if (!empty($data)) {
                        echo "data: " . json_encode($data) . "\n\n";
                    } else {
                        echo ": keep-alive\n\n"; // Keep-alive para manter a conexão ativa
                    }

                    // Descarregar o buffer e enviar os dados
                    if (ob_get_length()) {
                        ob_flush();
                    }
                    flush();

                    // Aguardar 2 segundos antes de enviar o próximo evento
                    sleep(2);
                }

                // Finalizar o buffer ao sair do loop
                if (ob_get_level() > 0) {
                    ob_end_flush();
                }
            });

            // Headers necessários para SSE
            $response->headers->set('Content-Type', 'text/event-stream');
            $response->headers->set('Cache-Control', 'no-cache');
            $response->headers->set('Connection', 'keep-alive');
            $response->headers->set('Access-Control-Allow-Origin', env('ALLOWED_ORIGINS'));
            $response->headers->set('X-Accel-Buffering', 'no'); // Para desativar buffering no Nginx, se aplicável

            return $response;
        } catch (\Exception $exception) {
            logger()->error($exception);
        }

        return null;
    }
}
