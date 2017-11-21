<?php
/**
 * Controlador de ruta /contacts
 */
class ContactsController extends Zend_Rest_Controller
{
    /**
     * Instancia de ApiEndpoint
     */
    private $_endpoint;

    public function init()
    {
        // Deshabilitamos la renderizacion de las vistas
        $this->_helper->viewRenderer->setNoRender(true);

        // Helpers
        Zend_Controller_Action_HelperBroker::addPrefix(APPLICATION_PATH . '/helpers/alegra');
        $this->_endpoint = $this->getHelper('ApiEndpoint');

        // Tipo de respuesta
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    }

    /**
     * Accion Index
     */
    public function indexAction()
    {
        $req = $this->_endpoint->getContacts()->getBody();

        // La API de Alegra no entrega el total de registros disponibles,
        // por tanto no es posible hacer una paginacion real. Entregamos el maximo permitido
        // por la API (30 registros)
        $contacts = Zend_Json::decode($req);
        $total = count($contacts);
        
        $this->commitResponse($contacts, ['total' => $total]);
    }

    /**
     * Accion GET
     */
    public function getAction()
    {
        $id = $this->_getParam('id');
        $req = $this->_endpoint->getContactById($id)->getBody();
        $contact = Application_Model_Contacto::parseJson($req);
        
        $this->commitResponse($contact->toArray());
    }

    /**
     * Accion POST
     */
    public function postAction()
    {
        try {
            $contact = Application_Model_Contacto::parseJson($this->getRequest()->getRawBody());
            if($contact->isValid()) {
                $req = $this->_endpoint->postContact($contact)->getBody();
                $this->commitResponse($req);
            }
            else {
                throw new Exception("INVALID_CONTACT");
            }
        } catch(Exception $e) {
            $this->commitResponse("", [], 400);
        }         
    }

    /**
     * Accion PUT
     */
    public function putAction()
    {
        try {
            $id = $this->_getParam('id');
            $contact = Application_Model_Contacto::parseJson($this->getRequest()->getRawBody());
            if($contact->isValid(true)) {
                $req = $this->_endpoint->putContactById($id, $contact)->getBody();
                $this->commitResponse($req);
            }
            else {
                throw new Exception("INVALID_CONTACT");
            }
        } catch(Exception $e) {
            $this->commitResponse("", [], 400);
        }
    }

    /**
     * Accion DELETE
     */
    public function deleteAction()
    {
        $id = $this->_getParam('id');
        $req = $this->_endpoint->deleteContactById($id);

        $this->commitResponse($req);
    }

    /**
     * Accion HEAD
     */
    public function headAction()
    {
        // action body
    }

    /**
     * Establece la respuesta del servicio
     */
    private function commitResponse($req, $options = [], $statusCode = 200) {
        $response = $this->getResponse();
        $store = ['status' => $statusCode];
        
        $response->setHttpResponseCode($statusCode);

        if(is_string($req)) {
            try {
                $req = json_decode($req);
            }
            catch(Exception $e) {
                throw new Exception("JSON_INVALID_FORMAT");
            }
        }

        $store['data'] = $req;

        if(count($options) > 0) {
            foreach ($options as $k => $v) {
                $store[$k] = $v;
            }
        }

        $response->setBody(Zend_Json::encode($store));
    }
}









