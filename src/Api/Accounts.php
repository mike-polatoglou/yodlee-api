<?php

namespace YodleeApi\Api;

class Accounts extends ApiAbstract
{
    /**
     * Get all created accounts by the user.
     *
     * @param array
     * @return array
     */
    public function get(array $parameters = [])
    {
        $url = $this->getEndpoint('/accounts', $parameters);

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->get($url, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->account)) {

            return [];
        }

        return $response->account;
    }

    /**
     * Get detail about specific account.
     *
     * @param int
     * @return \stdClass
     */
    public function getDetail($accountId)
    {
        $url = $this->getEndpoint('/accounts/' . $accountId);

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->get($url, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->account)) {

            return new \stdClass;
        }

        return $response->account[0];
    }
}
