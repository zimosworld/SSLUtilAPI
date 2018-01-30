<?php

/**
 * Check SSL tests
 *
 * Class CheckTest
 */
class CheckTest extends TestCase
{
    /**
     * Test check SSL
     */
    public function testCheckSSL()
    {

        $this->post('api/checkSSL', ['hostname' => 'https://google.com'])
             ->seeJsonStructure([
                 'lookup_host',
                 'resolved_ip',
                 'port',
                 'valid_issuer'
             ])
            ->seeJson([
                'lookup_host' => 'google.com',
                'port'        => 443
            ]);

    }

}