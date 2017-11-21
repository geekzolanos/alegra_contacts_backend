<?php

class PricelistsController extends Zend_Controller_Action
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
     * Obtiene la lista de precios
     */
    public function indexAction()
    {
        $req = $this->_endpoint->getPriceList()->getBody();
        $res = $this->parseResponse($req);
        $this->getResponse()->setBody($res);
    }

    /**
     * Serializa los datos procesados para su respuesta
     */
    private function parseResponse($req, $options = []) {
        $store = ['status' => '200'];

        if(is_string($req)) {
            try {
                $req = json_decode($req);
            }
            catch(Exception $e) {
                //
            }
        }
        $store['data'] = $req;

        if(count($options) > 0) {
            foreach ($options as $k => $v) {
                $store[$k] = $v;
            }
        }

        return Zend_Json::encode($store);
    }
}









