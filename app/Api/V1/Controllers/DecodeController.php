<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use Zimosworld\SSLTools\SSLTools;

/**
 * Class DecodeController
 * @package App\Api\V1\Controllers
 */
class DecodeController extends BaseController
{
    /**
     * @param Request $request
     * @param SSLTools $sslTools
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function decodeCertificate(Request $request, SSLTools $sslTools)
    {
        $this->validate($request, [
            'certificate' => 'required',
        ]);

        $result = $sslTools->decodeCertificate($request->input('certificate'));

        return $this->response->array($result->toArray());
    }

    /**
     * @param Request $request
     * @param SSLTools $sslTools
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function decodeCertificateRequest(Request $request, SSLTools $sslTools)
    {
        $this->validate($request, [
            'certificateRequest' => 'required',
        ]);

        $result = $sslTools->decodeCertificateRequest($request->input('certificateRequest'));

        return $this->response->array($result->toArray());
    }
}
