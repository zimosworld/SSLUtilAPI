<?php

/**
 * Match Certificate and CSR/private key endpoint tests
 *
 * Class MatchTest
 */
class MatchTest extends TestCase
{

    /**
     * Test certificate key match
     */
    public function testCertificateKeyMatch()
    {
        $request = [
            'certificate' => $this->getCertificate(),
            'privateKey'  => $this->getPrivateKey()
        ];

        $this->post('api/certificateKeyMatch', $request)
             ->seeJsonEquals(
                 [
                     'certificate_hash'         => '571d1d5b1dcd8ecf8a4ef975a9ef3916bf2c5777ea2ed8698ad4479d1d1461a3',
                     'certificate_request_hash' => null,
                     'match'                    => true,
                     'private_key_hash'         => '571d1d5b1dcd8ecf8a4ef975a9ef3916bf2c5777ea2ed8698ad4479d1d1461a3'
                 ]

             );
    }

    /**
     * Test certificate key match with missing data
     */
    public function testMissingCertificateKey()
    {
        $this->post('api/certificateKeyMatch', ['certificate' => $this->getCertificate()])
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => '422 Unprocessable Entity',
                         'errors'      => [
                             'privateKey' => [
                                 'The private key field is required.'
                             ]
                         ],
                         'status_code' => 422
                     ]
                 ]

             );

        $this->post('api/certificateKeyMatch', ['privateKey' => $this->getPrivateKey()])
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => '422 Unprocessable Entity',
                         'errors'      => [
                             'certificate' => [
                                 'The certificate field is required.'
                             ]
                         ],
                         'status_code' => 422
                     ]
                 ]

             );

        $this->post('api/certificateKeyMatch', [])
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => '422 Unprocessable Entity',
                         'errors'      => [
                             'certificate' => [
                                 'The certificate field is required.'
                             ],
                             'privateKey'  => [
                                 'The private key field is required.'
                             ]
                         ],
                         'status_code' => 422
                     ]
                 ]

             );
    }

    /**
     * Test invalid certificate key
     */
    public function testInvalidCertificateKey()
    {
        $request = [
            'certificate' => $this->getCertificate(),
            'privateKey'  => 'invalidKey'
        ];

        $this->post('api/certificateKeyMatch', $request)
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => 'Private Key parse failed',
                         'status_code' => 500
                     ]
                 ]

             );

        $request = [
            'certificate' => 'invalidCertificate',
            'privateKey'  => $this->getPrivateKey()
        ];

        $this->post('api/certificateKeyMatch', $request)
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => 'Certificate parse failed',
                         'status_code' => 500
                     ]
                 ]

             );
    }


    /**
     * Test certificate csr match
     */
    public function testCertificateCSRMatch()
    {
        $request = [
            'certificate' => $this->getCertificate(),
            'csr'         => $this->getCertificateRequest()
        ];

        $this->post('api/certificateCsrMatch', $request)
             ->seeJsonEquals(
                 [
                     'certificate_hash'         => '571d1d5b1dcd8ecf8a4ef975a9ef3916bf2c5777ea2ed8698ad4479d1d1461a3',
                     'certificate_request_hash' => '571d1d5b1dcd8ecf8a4ef975a9ef3916bf2c5777ea2ed8698ad4479d1d1461a3',
                     'match'                    => true,
                     'private_key_hash'         => null
                 ]

             );
    }

    /**
     * Test certificate csr match with missing data
     */
    public function testMissingCertificateCsr()
    {
        $this->post('api/certificateCsrMatch', ['certificate' => $this->getCertificate()])
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => '422 Unprocessable Entity',
                         'errors'      => [
                             'csr' => [
                                 'The csr field is required.'
                             ]
                         ],
                         'status_code' => 422
                     ]
                 ]

             );

        $this->post('api/certificateCsrMatch', ['csr' => $this->getCertificateRequest()])
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => '422 Unprocessable Entity',
                         'errors'      => [
                             'certificate' => [
                                 'The certificate field is required.'
                             ]
                         ],
                         'status_code' => 422
                     ]
                 ]

             );

        $this->post('api/certificateCsrMatch', [])
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => '422 Unprocessable Entity',
                         'errors'      => [
                             'certificate' => [
                                 'The certificate field is required.'
                             ],
                             'csr'         => [
                                 'The csr field is required.'
                             ]
                         ],
                         'status_code' => 422
                     ]
                 ]

             );
    }

    /**
     * Test invalid certificate csr
     */
    public function testInvalidCertificateCsr()
    {
        $request = [
            'certificate' => $this->getCertificate(),
            'csr'         => 'invalidKey'
        ];

        $this->post('api/certificateCsrMatch', $request)
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => 'Certificate Request (CSR) parse failed',
                         'status_code' => 500
                     ]
                 ]

             );

        $request = [
            'certificate' => 'invalidCertificate',
            'csr'         => $this->getCertificateRequest()
        ];

        $this->post('api/certificateCsrMatch', $request)
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => 'Certificate parse failed',
                         'status_code' => 500
                     ]
                 ]

             );
    }
}
