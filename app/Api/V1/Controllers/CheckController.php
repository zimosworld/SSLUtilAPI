<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use Zimosworld\SSLTools\SSLTools;

/**
 * Class CheckController
 * @package App\Api\V1\Controllers
 */
class CheckController extends BaseController
{
    /**
     * @param Request $request
     * @param SSLTools $sslTools
     * @return mixed
     */
    public function checkSSL(Request $request, SSLTools $sslTools)
    {
        $this->validate($request, [
            'hostname' => 'required',
        ]);

        $result = $sslTools->checkInstalledCertificate($request->input('hostname'));

        return $this->response->array($result->toArray());
    }

}