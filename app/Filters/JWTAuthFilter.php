<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $token = null;

        /* -------------------------------------------------
           1. PRIMARY: Authorization Header
           (AJAX, SPA, Cordova)
        ------------------------------------------------- */
        $authHeader = $request->getHeaderLine('Authorization');
        
        if ($authHeader && stripos($authHeader, 'Bearer ') === 0) {
            $token = trim(substr($authHeader, 7));
        }

        /* -------------------------------------------------
           2. FALLBACK: Cookie
           (Browser page load only)
        ------------------------------------------------- */
        if (!$token) {
            $cookieToken = $request->getCookie('authToken');
            if ($cookieToken) {
                $token = $cookieToken;
            }
        }

        /* -------------------------------------------------
           3. Skip routes (public)
        ------------------------------------------------- */
        $uri = service('uri');
        $segment1 = $uri->getSegment(1);

        $skipRoutes = ['api', 'pre-login', 'login'];
        if (in_array($segment1, $skipRoutes, true)) {
            return;
        }

        /* -------------------------------------------------
           4. No token → reject
        ------------------------------------------------- */
        if (!$token) {
            if ($request->isAJAX()) {
                return service('response')
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'Authentication required'
                    ])
                    ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            }

            return redirect()->to('/pre-login');
        }

        /* -------------------------------------------------
           5. Decode & Validate JWT
        ------------------------------------------------- */
        try {
            $decoded = JWT::decode(
                $token,
                new Key(getenv('JWT_SECRET'), 'HS256')
            );

            if (
                empty($decoded->data->id) ||
                empty($decoded->data->loginType)
            ) {
                throw new \Exception('Invalid token payload');
            }

            $userId    = (int) $decoded->data->id;
            $loginType = strtolower($decoded->data->loginType);

            /* -------------------------------------------------
               6. Resolve model
            ------------------------------------------------- */
            switch ($loginType) {
                case 'employee':
                    $model = model('EmployeesModel');
                    break;

                case 'student':
                    $model = model('StudentsModel');
                    break;

                default:
                    throw new \Exception('Invalid login type');
            }

            /* -------------------------------------------------
               7. Validate user + issued token
            ------------------------------------------------- */
            $user = $model
                ->where('id', $userId)
                ->where('issued_jwt_token', $token)
                ->where('deleted_at', null)
                ->first();

            if (!$user) {
                throw new \Exception('User not found or token revoked');
            }

            /* -------------------------------------------------
               8. Attach authenticated user to request
               (THIS is the only auth state controllers use)
            ------------------------------------------------- */
            $request->user = (object)[
                'id'        => $userId,
                'loginType' => $loginType,
                'token'     => $token,
                'record'    => $user
            ];

        } catch (\Throwable $e) {

            // AJAX → JSON
            if ($request->isAJAX()) {
                return service('response')
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'Invalid or expired session'
                    ])
                    ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            }

            // Browser → redirect
            return redirect()
                ->to('/pre-login')
                ->with('error', 'Session expired. Please login again.');
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Nothing to do
    }
}
