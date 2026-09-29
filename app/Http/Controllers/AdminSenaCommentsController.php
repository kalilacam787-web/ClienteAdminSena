<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class AdminSenaCommentsController extends Controller
{
    public function index()
    {
        $comments = collect();
        $apiError = false;

        try {
            $response = Http::acceptJson()
                ->timeout(5)
                ->get(rtrim(config('services.admin_sena_api.url'), '/').'/contacts');

            if ($response->successful() && is_array($response->json())) {
                $comments = collect($response->json())
                    ->sortByDesc('created_at')
                    ->values();
            } else {
                $apiError = true;
            }
        } catch (ConnectionException $exception) {
            $apiError = true;
        }

        return view('comentarios', compact('comments', 'apiError'));
    }
}