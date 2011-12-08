<?php
/**
 * Vivid Seats Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://github.com/TeamOneTickets/VividSeats/blob/master/LICENSE.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@teamonetickets.com so we can send you a copy immediately.
 *
 * @category    VividSeats
 * @package     VividSeats_Webservice
 * @copyright   Copyright (c) 2011 Team One Tickets & Sports Tours, Inc. (http://www.teamonetickets.com)
 * @license     https://github.com/TeamOneTickets/VividSeats/blob/master/LICENSE.txt     New BSD License
 */


/**
 * @category    VividSeats
 * @package     VividSeats_Webservice
 * @copyright   Copyright (c) 2011 Team One Tickets & Sports Tours, Inc. (http://www.teamonetickets.com)
 * @license     https://github.com/TeamOneTickets/VividSeats/blob/master/LICENSE.txt     New BSD License
 */
class VividSeats_Webservice
{
    /**
     * Vivid Seats API Token
     *
     * @var string
     * @link https://brokers.vividseats.com/API.action
     */
    public $apiToken;

    /**
     * Base URI for the REST client
     * You should override and use the sandbox (https://brokers.vividseats.com/API.action)
     * for testing and development
     *
     * @var string
     */
    protected $_baseUri = 'https://brokers.vividseats.com';

    /**
     * API version
     *
     * @var string
     * @link https://brokers.vividseats.com/API.action Find the current version
     */
    protected $_apiVersion = '1';


    /**
     * Reference to REST client object
     *
     * @var Zend_Rest_Client
     */
    protected $_rest = null;


    /**
     * Constructs a new Vivid Seats Web Services Client
     *
     * @param  mixed $config  An array or Zend_Config object with adapter parameters.
     * @return VividSeats_Webservice
     */
    public function __construct($config)
    {
        if ($config instanceof Zend_Config) {
            $config = $config->toArray();
        }

        /*
         * Verify that parameters are in an array.
         */
        if (!is_array($config)) {
            throw new VividSeats_Webservice_Exception(
                'Parameters must be in an array or a Zend_Config object'
            );
        }

        /*
         * Verify that an API token has been specified.
         */
        if (!is_string($config['apiToken']) || empty($config['apiToken'])) {
            throw new VividSeats_Webservice_Exception(
                'API token must be specified in a string'
            );
        }

        /*
         * See if we need to override the API version.
         */
        if (isset($config['apiVersion']) && !empty($config['apiVersion'])) {
            $this->_apiVersion = (string) $config['apiVersion'];
        }

        /*
         * See if we need to override the base URI.
         */
        if (isset($config['baseUri']) && !empty($config['baseUri'])) {
            $this->_baseUri = (string) $config['baseUri'];
        }

        $this->apiToken = (string) $config['apiToken'];
    }


    /**
     * List Orders
     *
     * @param  array $options Options to use for the search query
     * @return SimpleXMLElement
     */
    public function listOrders(array $options)
    {
        $endPoint = 'getOrders';

        $client = $this->getRestClient();
        $client->setUri($this->_baseUri);

        $defaultOptions = array(
            'status' => 'UNCONFIRMED'
        );

        $options = $this->_prepareOptions(
            $options,
            $defaultOptions
        );

        $client->getHttpClient()->resetParameters();
        $this->_setHeaders();

        $response = $client->restGet('/webservices/v' . $this->_apiVersion . '/' . $endPoint, $options);

        return $this->_postProcess($response);
    }


    /**
     * Accept an order
     *
     * @param int $options
     * @return SimpleXMLElement
     */
    public function acceptOrder($options)
    {
        $endPoint = 'confirmOrder';

        $client = $this->getRestClient();
        $client->setUri($this->_baseUri);

        $defaultOptions = array(
        );

        $options = $this->_prepareOptions(
            $options,
            $defaultOptions
        );

        $client->getHttpClient()->resetParameters();
        $this->_setHeaders();

        $response = $client->restPost('/webservices/v' . $this->_apiVersion . '/' . $endPoint, $options);

        return $this->_postProcess($response);
    }


    /**
     * Reject an order
     *
     * @param int $options
     * @return SimpleXMLElement
     */
    public function rejectOrder($options)
    {
        $endPoint = 'rejectOrder';

        $client = $this->getRestClient();
        $client->setUri($this->_baseUri);

        $defaultOptions = array(
        );

        $options = $this->_prepareOptions(
            $options,
            $defaultOptions
        );

        $client->getHttpClient()->resetParameters();
        $this->_setHeaders();

        $response = $client->restPost('/webservices/v' . $this->_apiVersion . '/' . $endPoint, $options);

        return $this->_postProcess($response);
    }


    /**
     * Ship an order
     *
     * @param int $options
     * @return SimpleXMLElement
     */
    public function shipOrder($options)
    {
        $endPoint = 'shipOrder';

        $client = $this->getRestClient();
        $client->setUri($this->_baseUri);

        $defaultOptions = array(
        );

        $options = $this->_prepareOptions(
            $options,
            $defaultOptions
        );

        $client->getHttpClient()->resetParameters();
        $this->_setHeaders();

        $response = $client->restPost('/webservices/v' . $this->_apiVersion . '/' . $endPoint, $options);

        return $this->_postProcess($response);
    }


    /**
     * Get the airbill for an order
     *
     * @param int $options
     * @return SimpleXMLElement
     */
    public function getAirbill($options)
    {
        $endPoint = 'getAirbill';

        $client = $this->getRestClient();
        $client->setUri($this->_baseUri);

        $defaultOptions = array(
        );

        $options = $this->_prepareOptions(
            $options,
            $defaultOptions
        );

        $client->getHttpClient()->resetParameters();
        $this->_setHeaders();

        $response = $client->restGet('/webservices/v' . $this->_apiVersion . '/' . $endPoint, $options);

        return $this->_postProcess($response);
    }


    /**
     * Get the PO for an order
     *
     * @param int $options
     * @return SimpleXMLElement
     */
    public function getPurchaseOrder($options)
    {
        $endPoint = 'getPurchaseOrder';

        $client = $this->getRestClient();
        $client->setUri($this->_baseUri);

        $defaultOptions = array(
        );

        $options = $this->_prepareOptions(
            $options,
            $defaultOptions
        );

        $client->getHttpClient()->resetParameters();
        $this->_setHeaders();

        $response = $client->restGet('/webservices/v' . $this->_apiVersion . '/' . $endPoint, $options);

        return $this->_postProcess($response);
    }


    /**
     * Returns a reference to the REST client
     *
     * @return Zend_Rest_Client
     */
    public function getRestClient()
    {
        if ($this->_rest === null) {
            $this->_rest = new Zend_Rest_Client();
        }
        return $this->_rest;
    }

    /**
     * Set REST client
     *
     * @param Zend_Rest_Client
     * @return VividSeats_Webservice
     */
    public function setRestClient(Zend_Rest_Client $client)
    {
        $this->_rest = $client;
        return $this;
    }


    /**
     * Set special headers for request
     *
     */
    protected function _setHeaders()
    {
        $headers = array(
            'User-Agent' => 'VividSeats_Webservice',
        );

        $this->_rest->getHttpClient()->setHeaders($headers);
    }


    /**
     * Prepare options for request
     *
     * @param  array  $options        User supplied options
     * @param  array  $defaultOptions Default options
     * @return array
     */
    protected function _prepareOptions(array $options, array $defaultOptions)
    {
        $options = array_merge($defaultOptions, $options, array('apiToken' => $this->apiToken));
        ksort($options);

        return $options;
    }


    /**
     * Allows post-processing logic to be applied.
     * Subclasses may override this method.
     *
     * @param string $responseBody The response body to process
     * @throws VividSeats_Webservice_Exception
     * @return SimpleXMLElement
     */
    protected function _postProcess($response)
    {
        /**
         * Uncomment for debugging to see the actual request and response
         */
        /**
        echo PHP_EOL;
        var_dump($this->getRestClient()->getHttpClient()->getLastRequest());
        echo PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;
        echo PHP_EOL;
        var_dump($this->getRestClient()->getHttpClient()->getLastResponse());
        echo PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;
         */


        if ($response->isError()) {
            throw new VividSeats_Webservice_Exception(
                'An error occurred sending request. Status code: '
                . $response->getStatus()
            );
        }

        $xml =  simplexml_load_string($response->getBody());
        require_once 'Onyx/Dump.php';
        //dump($xml);

        if (is_null($xml)) {
            throw new VividSeats_Webservice_Exception(
                'An error occurred with the XML received'
            );
        }

        return $xml;
    }


}
