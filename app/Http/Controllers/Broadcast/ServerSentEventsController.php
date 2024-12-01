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
                if (ob_get_level() == 0) {
                    ob_start();
                }

                while (true) {
                    if (connection_aborted() || now() >= $finish) {
                        break;
                    }

                    $data = Cache::pull("sse:$userId", []);

                    if (!empty($data)) {
                        echo "\n\ndata: " . json_encode($data) . "\n\n";
                    } else {
                        echo "~";
                    }

                    if (ob_get_length()) {
                        ob_flush();
                    }
                    flush();

                    sleep(2);
                }

                if (ob_get_level() > 0) {
                    ob_end_flush();
                }
            });

            // Headers necessários para SSE
            $response->headers->set('Content-Type', 'text/event-stream');
            $response->headers->set('Cache-Control', 'no-cache');
            $response->headers->set('Connection', 'keep-alive');
            $response->headers->set('Access-Control-Allow-Origin', env('ALLOWED_ORIGINS'));
            $response->headers->set('X-Accel-Buffering', 'no');

            return $response;
        } catch (\Exception $exception) {
            logger()->error($exception);
        }

        return null;
    }
}
