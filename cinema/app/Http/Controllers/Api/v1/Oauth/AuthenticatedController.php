<?php

namespace App\Http\Controllers\Api\v1\Oauth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class AuthenticatedController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = DB::table('oauth_clients')->where('password_client', 1)->first();

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|max:100',
        ]);

        $credentials = $request->only('password', 'email');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $request->request->add([
                'username' => $request->get('email'),
                'password' => $request->get('password'),
                'grant_type' => 'password',
                'client_id' => $this->client->id,
                'client_secret' => $this->client->secret,
                'scope' => '*'
            ]);

            $proxy = Request::create(
                'oauth/token',
                'POST'
            );

            $response = Route::dispatch($proxy);

            $data = json_decode($response->getContent(), true);
            $data['user_id'] = $user->id;
            $data['email'] = $user->email;

            return response()->json(['data' => $data]);
        } else
            return response()->json([
                'message' => 'check your credentials'
            ],404);
    }
}
