<?php

namespace Iugu\Responses;

use Common\Response;

class CustomerResponse implements Response
{
    protected string $id;
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

    public function __construct(string $body)
    {
        $this->parse($body);
    }


    public function parse(string $body)
    {
        $data = json_decode($body, true);
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->notes = $data['notes'] ?? null;
        $this->phone_prefix = $data['phone_prefix'] ?? null;
        $this->cpf_cnpj = $data['cpf_cnpj'] ?? null;
        $this->cc_emails = $data['cc_emails'] ?? null;
        $this->zip_code = $data['zip_code'] ?? null;
        $this->number = $data['number'] ?? null;
        $this->street = $data['street'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->district = $data['district'] ?? null;
        $this->state = $data['state'] ?? null;
        $this->complement = $data['complement'] ?? null;
        $this->custom_variables = $data['custom_variables'] ?? [];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @return string|null
     */
    public function getPhonePrefix(): ?string
    {
        return $this->phone_prefix;
    }

    /**
     * @return string|null
     */
    public function getCpfCnpj(): ?string
    {
        return $this->cpf_cnpj;
    }

    /**
     * @return string|null
     */
    public function getCcEmails(): ?string
    {
        return $this->cc_emails;
    }

    /**
     * @return string|null
     */
    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * @return array
     */
    public function getCustomVariables(): array
    {
        return $this->custom_variables;
    }
}