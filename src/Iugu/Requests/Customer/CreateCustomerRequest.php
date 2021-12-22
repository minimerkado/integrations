<?php

namespace Iugu\Requests\Customer;

use Iugu\Requests\CustomVariable;
use Iugu\Requests\PostRequest;

class CreateCustomerRequest extends PostRequest
{
    protected string $name;
    protected string $email;
    protected ?string $notes = null;
    protected ?string $phone_prefix = null;
    protected ?string $cpf_cnpj = null;
    protected ?string $cc_emails = null;
    protected ?string $zip_code = null;
    protected ?string $number = null;
    protected ?string $street = null;
    protected ?string $city = null;
    protected ?string $district = null;
    protected ?string $state = null;
    protected ?string $complement = null;
    protected array $custom_variables = [];

    /**
     * @param string $name
     * @return CreateCustomerRequest
     */
    public function setName(string $name): CreateCustomerRequest
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $email
     * @return CreateCustomerRequest
     */
    public function setEmail(string $email): CreateCustomerRequest
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string|null $notes
     * @return CreateCustomerRequest
     */
    public function setNotes(?string $notes): CreateCustomerRequest
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @param string|null $phone_prefix
     * @return CreateCustomerRequest
     */
    public function setPhonePrefix(?string $phone_prefix): CreateCustomerRequest
    {
        $this->phone_prefix = $phone_prefix;
        return $this;
    }

    /**
     * @param string|null $cpf_cnpj
     * @return CreateCustomerRequest
     */
    public function setCpfCnpj(?string $cpf_cnpj): CreateCustomerRequest
    {
        $this->cpf_cnpj = $cpf_cnpj;
        return $this;
    }

    /**
     * @param string|null $cc_emails
     * @return CreateCustomerRequest
     */
    public function setCcEmails(?string $cc_emails): CreateCustomerRequest
    {
        $this->cc_emails = $cc_emails;
        return $this;
    }

    /**
     * @param string|null $zip_code
     * @return CreateCustomerRequest
     */
    public function setZipCode(?string $zip_code): CreateCustomerRequest
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    /**
     * @param string|null $number
     * @return CreateCustomerRequest
     */
    public function setNumber(?string $number): CreateCustomerRequest
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @param string|null $street
     * @return CreateCustomerRequest
     */
    public function setStreet(?string $street): CreateCustomerRequest
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @param string|null $city
     * @return CreateCustomerRequest
     */
    public function setCity(?string $city): CreateCustomerRequest
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string|null $district
     * @return CreateCustomerRequest
     */
    public function setDistrict(?string $district): CreateCustomerRequest
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @param string|null $state
     * @return CreateCustomerRequest
     */
    public function setState(?string $state): CreateCustomerRequest
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param string|null $complement
     * @return CreateCustomerRequest
     */
    public function setComplement(?string $complement): CreateCustomerRequest
    {
        $this->complement = $complement;
        return $this;
    }

    public function addCustomVariable(string $name, string $value, ?bool $destroy = null): CreateCustomerRequest
    {
        $this->custom_variables[] = new CustomVariable($name, $value, $destroy);
        return $this;
    }

    public function toJson(): ?array
    {
        return self::not_null([
            'name' => $this->name,
            'email' => $this->email,
            'notes' => $this->notes,
            'phone_prefix' => $this->phone_prefix,
            'cpf_cnpj' => $this->cpf_cnpj,
            'cc_emails' => $this->cc_emails,
            'zip_code' => $this->zip_code,
            'number' => $this->number,
            'street' => $this->street,
            'city' => $this->city,
            'district' => $this->district,
            'state' => $this->state,
            'complement' => $this->complement,
            'custom_variables' => collect($this->custom_variables)
                ->map(fn (CustomVariable $v) => $v->toJson())
                ->all(),
        ]);
    }

    public function getMethod()
    {
        return 'POST';
    }

    public function getPath()
    {
        return "/customers";
    }
}