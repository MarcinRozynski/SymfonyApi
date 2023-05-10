<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_employee")
 * @ORM\Entity()
 */
class Employee
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?string $id;
    /**
     * @var string|null
     *
     * @ORM\Column(name="first_name", type="string", length=100)
     */
    private $firstName;
    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=100)
     */
    private $lastName;
    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;
    /**
     * @var string|null
     *
     * @ORM\Column(name="phone_numer", type="string", length=50, nullable=true)
     */
    private $phoneNumber;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

}