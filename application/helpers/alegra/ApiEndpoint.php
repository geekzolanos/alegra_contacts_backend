<?php
/**
 * Endpoint para API de servicio Alegra
 */
class Zend_Controller_Action_Helper_ApiEndpoint extends Zend_Controller_Action_Helper_Abstract {
    const ALEGRA_URL = "https://app.alegra.com/api/v1";

    /**
     * @private
     * Datos de autenticacion
     */
    private $_authdata = [];

    /**
     * @private
     * Obtiene datos de autenticacion a partir de Config
     */
    private function _parseAuthData() {
        $bs = $this->getFrontController()->getParam('bootstrap');
        $config = $bs->getOption('alegra');
        $email = $config['api']['credentials']['email'];
        $key = $config['api']['credentials']['key'];      
        
        $this->_setAuthData($email, $key);
    }

    /**
     * @private
     * Setter de _authData
     */
    private function _setAuthData($email, $key) {
        if(!(isset($email) && isset($key))) {            
            throw new \Exception("NO_VALID_CREDENTIALS");
        }

        $this->_authData = ['email' => $email, 'key' => $key];
    }

    /**
     * @private
     * Entrega una cadena con los datos de autenticacion codificados
     */
    private function _getAuthData() {
        if(!isset($this->_authData)) {
            $this->_parseAuthData();
        }

        $strAuth = $this->_authData['email'] . ':' . $this->_authData['key'];
        return 'Basic ' . base64_encode($strAuth);        
    }
    
    /**
     * Obtiene el indice de contactos
     */
    public function getContacts() {
        $strAuth = $this->_getAuthData();
        $client = new Zend_Http_Client(Zend_Controller_Action_Helper_ApiEndpoint::ALEGRA_URL . '/contacts');
        $client->setParameterGet($this->getRequest()->getParams());
        $client->setHeaders('Authorization', $strAuth);

        $response = $client->request();

        return $response;
    }

    /**
     * Obtiene un contacto
     */
    public function getContactById($id) {
        $strAuth = $this->_getAuthData();
        $client = new Zend_Http_Client(Zend_Controller_Action_Helper_ApiEndpoint::ALEGRA_URL . '/contacts/' . $id);
        $client->setHeaders('Authorization', $strAuth);
        $response = $client->request();

        return $response;
    }

    /**
     * Almacena un nuevo contacto
     */
    public function postContact(Application_Model_Contacto $contact) {
        $strAuth = $this->_getAuthData();
        $client = new Zend_Http_Client(Zend_Controller_Action_Helper_ApiEndpoint::ALEGRA_URL . '/contacts');
        $client->setHeaders('Authorization', $strAuth);        
        $client->setRawData($contact->toJson());
        $response = $client->request(Zend_Http_Client::POST);

        return $response;
    }
    
    /**
     * Actualiza un contacto
     */
    public function putContactById($id, Application_Model_Contacto $contact) {
        $strAuth = $this->_getAuthData();
        $client = new Zend_Http_Client(Zend_Controller_Action_Helper_ApiEndpoint::ALEGRA_URL . '/contacts/' . $id);
        $client->setHeaders('Authorization', $strAuth);
        $client->setRawData($contact->toJson());
        $response = $client->request(Zend_Http_Client::PUT);

        return $response;
    }

    /**
     * Elimina un contacto
     */
    public function deleteContactById($id) {
        $strAuth = $this->_getAuthData();
        $client = new Zend_Http_Client(Zend_Controller_Action_Helper_ApiEndpoint::ALEGRA_URL . '/contacts/' . $id);
        $client->setHeaders('Authorization', $strAuth);
        $response = $client->request(Zend_Http_Client::DELETE);

        return $response;
    }

    /**
     * Obtiene la lista de precios
     */
    public function getPriceList() {
        $strAuth = $this->_getAuthData();
        $client = new Zend_Http_Client(Zend_Controller_Action_Helper_ApiEndpoint::ALEGRA_URL . '/price-lists/');
        $client->setHeaders('Authorization', $strAuth);
        $response = $client->request();

        return $response;   
    }

    /**
     * Obtiene el indice de Vendedores
     */
    public function getSellers() {
        $strAuth = $this->_getAuthData();
        $client = new Zend_Http_Client(Zend_Controller_Action_Helper_ApiEndpoint::ALEGRA_URL . '/sellers');
        $client->setParameterGet($this->getRequest()->getParams());
        $client->setHeaders('Authorization', $strAuth);

        $response = $client->request();

        return $response;
    }
}