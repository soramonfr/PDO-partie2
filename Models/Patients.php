<?php

/**
 * Classe Patients qui correspond à la table patients en bdd
 */
class Patients
{
    private $id;
    private $lastname;
    private $firstname;
    private $birthdate;
    private $phone;
    private $mail;

    public function __construct($patient)
    {
        $this->setId($patient['id']);
        $this->setLastName($patient['lastName']);
        $this->setFirstName($patient['firstName']);
        $this->setBirthDate($patient['birthDate']);
        $this->setPhone($patient['phone']);
        $this->setMail($patient['mail']);
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param   mixed  $id  
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param   mixed  $lastname  
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param   mixed  $firstname  
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get the value of birthdate
     */ 
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set the value of birthdate
     *
     * @param   mixed  $birthdate  
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @param   mixed  $phone  
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @param   mixed  $mail  
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
}