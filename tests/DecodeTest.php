<?php

/**
 * Decode Certificate/Certificate endpoint tests
 *
 * Class DecodeTest
 */
class DecodeTest extends TestCase
{
    /**
     * Test decode of a certificate
     */
    public function testDecodeCertificate()
    {

        $this->post('api/decodeCertificate', ['certificate' => $this->getCertificate()])
             ->seeJsonEquals(
                 [
                     'common_name'       => 'ssltools.sslutil.com',
                     'subject_altname'   => null,
                     'organization'      => 'SSL Test',
                     'organization_unit' => 'Development',
                     'country_code'      => 'AU',
                     'valid_from'        => 1514617406,
                     'valid_to'          => 1546153406,
                     'issuer'            => [
                         'C'  => 'AU',
                         'CN' => 'ssltools.sslutil.com',
                         'L'  => 'Sydney',
                         'O'  => 'SSL Test',
                         'ST' => 'NSW',
                         'OU' => 'Development'
                     ],
                     'key_size'          => 2048,
                     'serial_number'     => '14225341186233066637',
                     'is_expired'        => false,
                     'is_has_ev'         => false,
                     'is_host_match'     => null
                 ]

             );
    }

    /**
     * Test decode certificate while passing no data
     */
    public function testMissingCertificate()
    {

        $this->post('api/decodeCertificate', [])
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
    }

    /**
     * Test decode invalid certificate
     */
    public function testInvalidCertificate()
    {
        $this->post('api/decodeCertificate', ['certificate' => 'invalidCertificate'])
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
     * Test decode certificate request
     */
    public function testDecodeCertificateRequest()
    {

        $this->post('api/decodeCertificateRequest', ['certificateRequest' => $this->getCertificateRequest()])
             ->seeJsonEquals(
                 [
                     'city'              => 'Sydney',
                     'common_name'       => 'ssltools.sslutil.com',
                     'country_code'      => 'AU',
                     'email'             => null,
                     'key_size'          => 2048,
                     'organization'      => 'SSL Test',
                     'organization_unit' => 'Development',
                     'state'             => 'NSW'
                 ]
             );
    }

    /**
     * Test decode certificate request while passing no data
     */
    public function testMissingCertificateRequest()
    {

        $this->post('api/decodeCertificateRequest', [])
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => '422 Unprocessable Entity',
                         'errors'      => [
                             'certificateRequest' => [
                                 'The certificate request field is required.'
                             ]
                         ],
                         'status_code' => 422
                     ]
                 ]

             );
    }

    /**
     * Test decode invalid certificate request
     */
    public function testInvalidCertificateRequest()
    {
        $this->post('api/decodeCertificateRequest', ['certificateRequest' => 'invalidCertificateRequest'])
             ->seeJsonEquals(
                 [
                     'error' => [
                         'message'     => 'Certificate Request (CSR) parse failed',
                         'status_code' => 500
                     ]
                 ]
             );
    }
}
