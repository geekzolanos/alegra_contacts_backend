<?php
/**
 * Modelo "Contacto
 */
class Application_Model_Contacto
{
    private $id;
    private $name;
    private $identification;
    private $email;
    private $phonePrimary;
    private $phoneSecondary;
    private $fax;
    private $mobile;
    private $observations;
    private $ignoreRepeated;
    private $type;
    private $address;
    private $seller;
    private $term;
    private $priceList;
    private $internalContacts;

	// Evitamos que se pueda construir una instancia externa
    private function __construct() {
        //
    }

	/**
	 * Serializa los datos en un Array
	 */
    public function toArray() {
    	$res = array();

    	if(!empty($this->id)) {
    		$res['id'] = $this->id;
    	}

		if(!empty($this->name)) {
			$res['name'] = $this->name;
		}

		if(!empty($this->identification)) {
			$res['identification'] = $this->identification;
		}

		if(!empty($this->email)) {
			$res['email'] = $this->email;
		}

		if(!empty($this->phonePrimary)) {
			$res['phonePrimary'] = $this->phonePrimary;
		}

		if(!empty($this->phoneSecondary)) {
			$res['phoneSecondary'] = $this->phoneSecondary;
		}

		if(!empty($this->fax)) {
			$res['fax'] = $this->fax;
		}

		if(!empty($this->mobile)) {
			$res['mobile'] = $this->mobile;
		}

		if(!empty($this->observations)) {
			$res['observations'] = $this->observations;
		}

		if(!empty($this->type)) {
			$res['type'] = $this->type;
		}

		if(!empty($this->address)) {
			$res['address'] = $this->address;
		}

		if(!empty($this->seller)) {
			$res['seller'] = $this->seller;
		}

		if(!empty($this->term)) {
			$res['term'] = $this->term;
		}

		if(!empty($this->priceList)) {
			$res['priceList'] = $this->priceList;
		}

		if(!empty($this->internalContacts)) {
			$res['internalContacts'] = $this->internalContacts;
		}

        return $res;
    }

	/**
	 * Serializa los datos en JSON
	 */
    public function toJson() {
    	return Zend_Json::encode($this->toArray());
    }

	/**
	 * Genera un contacto a partir de un Array
	 */
    public static function parseArray($data) {
		$contact = new Application_Model_Contacto();
		
		if(isset($data['id'])) {
			$contact->setId($data['id']);
		}

    	if(isset($data['name'])) {
			$contact->setName($data['name']);
		}
		
		if(isset($data['identification'])) {
			$contact->setIdentification($data['identification']);
		}
		
		if(isset($data['type'])) {
			$contact->setType($data['type']);
		}
		
		if(isset($data['email'])) {
			$contact->setEmail($data['email']);		
		}
		
		if(isset($data['phonePrimary'])) {
			$contact->setPhonePrimary($data['phonePrimary']); 
		}
		
		if(isset($data['phoneSecondary'])) {
			$contact->setPhoneSecondary($data['phoneSecondary']); 
		}
		
		if(isset($data['fax'])) {
			$contact->setFax($data['fax']);	
		}
		
		if(isset($data['mobile'])) {
			$contact->setmobile($data['mobile']); 
		}
		
		if(isset($data['observations'])) {
			$contact->setObservations($data['observations']); 
		}
		
		if(isset($data['ignoreRepeated'])) {
			$contact->setIgnoreRepeated($data['ignoreRepeated']); 
		}
		
		if(isset($data['address'])) {
			$contact->setAddress($data['address']);
		}
		
		if(isset($data['seller'])) {
			$contact->setSeller($data['seller']);
		}
		
		if(isset($data['term'])) {
			$contact->setTerm($data['term']);
		}
		
		if(isset($data['priceList'])) {
			$contact->setPriceList($data['priceList']); 
		}
		
		if(isset($data['internalContacts'])) {
			$contact->setInternalContacts($data['internalContacts']); 
		}
		
		return $contact;
    }

	/**
	 * Genera un contacto a partir de JSON
	 */
    public static function parseJson($data) {
		$data = Zend_Json::decode($data);
    	return Application_Model_Contacto::parseArray($data);
    }

    /*
     * Setters
     */
	private function setId($val) { $this->id = $val; }
    private function setName($val) { $this->name = $val; }
    private function setIdentification($val) { $this->identification = $val; }
    private function setEmail($val) { $this->email = $val; }
    private function setPhonePrimary($val) { $this->phonePrimary = $val; }
    private function setPhoneSecondary($val) { $this->phoneSecondary = $val; }
    private function setFax($val) { $this->fax = $val; }
    private function setmobile($val) { $this->mobile = $val; }
    private function setObservations($val) { $this->observations = $val; }
	private function setIgnoreRepeated($val) { $this->type = is_bool($val) && $val; }
    private function setType($val) { $this->type = $val; }
    private function setAddress($val) { $this->address = $val; }
    private function setSeller($val) { $this->seller = $val; }
    private function setTerm($val) { $this->term = $val; }
    private function setPriceList($val) { $this->priceList = $val; }
    private function setInternalContacts($val) { $this->internalContacts = $val; }

    /*
     * Getters
     */
    public function getId() { return $this->Id; }
    public function getName() { return $this->Name; }
    public function getIdentification() { return $this->Identification; }
    public function getEmail() { return $this->Email; }
    public function getPhonePrimary() { return $this->PhonePrimary; }
    public function getPhoneSecondary() { return $this->PhoneSecondary; }
    public function getFax() { return $this->Fax; }
    public function getmobile() { return $this->mobile; }
    public function getObservations() { return $this->Observations; }
    public function getType() { return $this->Type; }
    public function getAddress() { return $this->Address; }
    public function getSeller() { return $this->Seller; }
    public function getTerm() { return $this->Term; }
    public function getPriceList() { return $this->PriceList; }
    public function getInternalContacts() { return $this->InternalContacts; }

    /*
     * Validators
     */
    private function hasValidName() {
        $validator = new Zend_Validate_Alpha(true);
    	return $validator->isValid($this->name);
    }

    private function hasValidIdentification() {    	
    	return !(empty($this->identification));
    }

    private function hasValidEmail() {
    	$validator = new Zend_Validate_StringLength(['max' => 100]);
    	return $validator->isValid($this->email);
    }

    private function hasValidPhonePrimary() {
    	$validator = new Zend_Validate_StringLength(['max' => 45]);
    	return $validator->isValid($this->phonePrimary);
    }

    private function hasValidPhoneSecondary() {
    	$validator = new Zend_Validate_StringLength(['max' => 45]);
    	return $validator->isValid($this->phoneSecondary);
    }

    private function hasValidFax() {
    	$validator = new Zend_Validate_StringLength(['max' => 45]);
    	return $validator->isValid($this->fax);
    }

    private function hasValidmobile() {
    	$validator = new Zend_Validate_StringLength(['max' => 45]);
    	return $validator->isValid($this->mobile);
    }

    private function hasValidObservations() {
    	$validator = new Zend_Validate_StringLength(['max' => 500]);
    	return $validator->isValid($this->observations);
    }

	private function hasValidIgnoreRepeated() {
		$this->type = is_bool($this->ignoreRepeated) && $this->ignoreRepeated;
    }

    private function hasValidType() {
    	return true;
    }

    private function hasValidAddress() {
    	// TODO: Validacion
    	return is_array($this->address);
    }

    private function hasValidSeller() {
		$validator = new Zend_Validate_Digits();
		return $validator->isValid($this->seller);
    }

    private function hasValidTerm() {
		$validator = new Zend_Validate_Digits();
		return $validator->isValid($this->term);
    }

    private function hasValidPriceList() {
		$validator = new Zend_Validate_Digits();
		return $validator->isValid($this->priceList);
    }

    private function hasValidInternalContacts() {
		foreach ($this->internalContacts as $c) {
			if(empty($c['name'])) {
				return false;
			}
		}

		return true;
    }

	/**
	 * @private
	 * Verifica que los campos requeridos no se encuentren vacios
	 */
    private function hasRequiredEmpty() {
		$notEmptyValidator = new Zend_Validate_NotEmpty();
	    return (!($notEmptyValidator->isValid($this->name)));
    }

	/**
	 * Valida todos los campos
	 * @param isEditing Si es true, ignora la validacion de los campos requeridos
	 */
    public function isValid($isEditing = false) {
    	// Solo permitimos que campos requeridos esten vacios durante la edicion
        if(!$isEditing && $this->hasRequiredEmpty()) {
        	return false;
        }

		// Durante la edicion, si existen campos vacios, los ignoramos. No ignoramos campos invalidos.
	    return (empty($this->name) || $this->hasValidName()) &&
			    (empty($this->identification) || $this->hasValidIdentification()) &&
			    (empty($this->email) || $this->hasValidEmail()) &&
			    (empty($this->phonePrimary) || $this->hasValidPhonePrimary()) &&
			    (empty($this->phoneSecondary)|| $this->hasValidPhoneSecondary()) &&
			    (empty($this->fax) || $this->hasValidFax()) &&
			    (empty($this->mobile) || $this->hasValidmobile()) &&
			    (empty($this->observations) || $this->hasValidObservations()) &&
			    (empty($this->ignoreRepeated) || $this->hasValidIgnoreRepeated()) &&
			    (empty($this->type) || $this->hasValidType()) &&
			    (empty($this->address) || $this->hasValidAddress()) &&
			    (empty($this->seller) || $this->hasValidSeller()) &&
			    (empty($this->term) || $this->hasValidTerm()) &&
			    (empty($this->priceList) || $this->hasValidPriceList()) &&
			    (empty($this->internalContacts) || $this->hasValidInternalContacts());
	}
	
	/**
	 * Retorna datos de depuracion
	 */
	public function getDebugData() {
		echo (
			'name: ' . (empty($this->name) || $this->hasValidName()) . '<br>' .
			'identification: ' . (empty($this->identification) || $this->hasValidIdentification()) . '<br>' .
			'email: ' . (empty($this->email) || $this->hasValidEmail()) . '<br>' .
			'phonePrimary: ' . (empty($this->phonePrimary) || $this->hasValidPhonePrimary()) . '<br>' .
			'phoneSecondary: ' . (empty($this->phoneSecondary)|| $this->hasValidPhoneSecondary()) . '<br>' .
			'fax: ' . (empty($this->fax) || $this->hasValidFax()) . '<br>' .
			'mobile: ' . (empty($this->mobile) || $this->hasValidmobile()) . '<br>' .
			'observations: ' . (empty($this->observations) || $this->hasValidObservations()) . '<br>' .
			'ignoreRepeated: ' . (empty($this->ignoreRepeated) || $this->hasValidIgnoreRepeated()) . '<br>' .
			'type: ' . (empty($this->type) || $this->hasValidType()) . '<br>' .
			'address: ' . (empty($this->address) || $this->hasValidAddress()) . '<br>' .
			'seller: ' . (empty($this->seller) || $this->hasValidSeller()) . '<br>' .
			'term: ' . (empty($this->term) || $this->hasValidTerm()) . '<br>' .
			'priceList: ' . (empty($this->priceList) || $this->hasValidPriceList()) . '<br>' .
			'internalContacts: ' . (empty($this->internalContacts) || $this->hasValidInternalContacts())
		);
	}
}