<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

abstract class ExternalApiReadController extends Controller
{
    protected function fetchTable(string $table, string $title, array $columns)
    {
        $rows = collect();
        $error = null;

        try {
            $response = Http::acceptJson()
                ->timeout(5)
                ->get(rtrim(config('services.admin_sena_api.url'), '/').'/'.$table);

            if ($response->successful() && is_array($response->json())) {
                $rows = collect($response->json());
            } else {
                $error = 'La API no pudo entregar esta tabla.';
            }
        } catch (ConnectionException $exception) {
            $error = 'No fue posible conectar con la API.';
        }

        return view('api-table', compact('table', 'title', 'columns', 'rows', 'error'));
    }
}
