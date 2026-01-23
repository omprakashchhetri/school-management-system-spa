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
        $header = $request->getHeaderLine('Authorization');

        // 🔑 Fallback to cookie for browser loads
        if (!$header) {
            $tokenFromCookie = $request->getCookie('authToken');
            if ($tokenFromCookie) {
                $header = 'Bearer ' . $tokenFromCookie;
            }
        }

        $uri = service('uri');
        $segment1 = $uri->getSegment(1); // Gets 'pre-login' from '/index.php/pre-login/'
        
        // Define routes to skip
        $skipRoutes = ['api', 'pre-login', 'login'];
        
        if (in_array($segment1, $skipRoutes)) {
            return; // Skip JWT validation
        }
        
        if (!$header) {
            return service('response')->setJSON([
                'status' => 'error',
                'message' => 'Authorization header missing'
            ])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        if (strpos($header, 'Bearer ') !== 0) {
            return service('response')->setJSON([
                'status' => 'error',
                'message' => 'Invalid Authorization header format'
            ])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
        $token = substr($header, 7);

        try {
            $secretKey = getenv('JWT_SECRET');
            $decoded   = JWT::decode($token, new Key($secretKey, 'HS256'));
            $decodedData = $decoded->data;
            // Make sure loginType is included
            if (empty($decodedData->loginType) || empty($decodedData->id)) {
                return service('response')->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid token payload: missing loginType or id'
                ])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            }

            // Decide which model to load based on loginType
            switch (strtolower($decodedData->loginType)) {
                case 'employee':
                    $model = model('EmployeesModel');
                    break;
                case 'student':
                    $model = model('StudentsModel');
                    break;
                default:
                    return service('response')->setJSON([
                        'status' => 'error',
                        'message' => 'Unknown loginType in token'
                    ])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            }

            // Fetch user by ID
            $user = $model->where('id', $decodedData->id)->where('issued_jwt_token', $token)->first();

            if (!$user) {
                return service('response')->setJSON([
                    'status' => 'error',
                    'message' => 'User not found'
                ])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            }

            // Optionally check active status
            if (isset($user['deleted_at']) && $user['deleted_at'] !== null) {
                return service('response')->setJSON([
                    'status' => 'error',
                    'message' => 'Account inactive'
                ])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            }

            // Attach user + token payload to request
            $request->user = (object)[
                'data'   => $decoded,
                'record' => $user
            ];

        } catch (\Exception $e) {
            // Browser request → redirect
            if ($request->isAJAX() === false) {
                return redirect()->to('/pre-login')->with('error', 'Session expired. Please login again.');
            }
            
            return service('response')->setJSON([
                'status' => 'error',
                'message' => 'Invalid or expired token',
                'error'   => $e->getMessage()
            ])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do here
    }
}
