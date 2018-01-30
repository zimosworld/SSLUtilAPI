<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use Zimosworld\SSLTools\SSLTools;

/**
 * Class MatchController
 * @package App\Api\V1\Controllers
 */
class MatchController extends BaseController
{
    /**
     * Match Certificate with Private Key
     *
     * @param Request $request
     * @param SSLTools $sslTools
     *
     * @return mixed
     * @throws \Exception
     */
    public function certificateKeyMatch(Request $request, SSLTools $sslTools)
    {
        $this->validate($request, [
            'certificate' => 'required',
            'privateKey'  => 'required'
        ]);

        $result = $sslTools->matchWithPrivateKey($request->get('privateKey'), $request->get('certificate'));

        return $this->response->array($result->toArray());
    }

    /**
     * Match Certificate with CSR
     *
     * @param Request $request
     * @param SSLTools $sslTools
     *
     * @return mixed
     * @throws \Exception
     */
    public function certificateCsrMatch(Request $request, SSLTools $sslTools)
    {
        $this->validate($request, [
            'certificate' => 'required',
            'csr'         => 'required'
        ]);

        $result = $sslTools->matchWithCSR($request->get('csr'), $request->get('certificate'));

        return $this->response->array($result->toArray());
    }


}