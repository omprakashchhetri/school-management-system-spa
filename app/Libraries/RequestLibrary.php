<?php

namespace App\Libraries;

use CodeIgniter\HTTP\RequestInterface;

class RequestLibrary
{
    public $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }
}