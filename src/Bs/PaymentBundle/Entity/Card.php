<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/26/2017
 * Time: 9:44 PM
 */

namespace Bs\PaymentBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CardRepository")
 * @ORM\Table(name="card")
 */
class Card
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $cardNo;
    /**
     * @ORM\Column(type="string")
     */
    private $validityDate;
    /**
     * @ORM\Column(type="string")
     */
    private $accountNo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCardNo()
    {
        return $this->cardNo;
    }

    /**
     * @param mixed $cardNo
     */
    public function setCardNo($cardNo)
    {
        $this->cardNo = $cardNo;
    }

    /**
     * @return mixed
     */
    public function getValidityDate()
    {
        return $this->validityDate;
    }

    /**
     * @param mixed $validityDate
     */
    public function setValidityDate($validityDate)
    {
        $this->validityDate = $validityDate;
    }

    /**
     * @return mixed
     */
    public function getAccountNo()
    {
        return $this->accountNo;
    }

    /**
     * @param mixed $accountNo
     */
    public function setAccountNo($accountNo)
    {
        $this->accountNo = $accountNo;
    }

    /**
     * @return mixed
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param mixed $payments
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @ORM\OneToMany(targetEntity="Bs\PaymentBundle\Entity\Payment", mappedBy="card" ))
     */
    private $payments;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\UserBundle\Entity\User", inversedBy="cards")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->payments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add payment
     *
     * @param \Bs\PaymentBundle\Entity\Payment $payment
     *
     * @return Card
     */
    public function addPayment(\Bs\PaymentBundle\Entity\Payment $payment)
    {
        $this->payments[] = $payment;

        return $this;
    }

    /**
     * Remove payment
     *
     * @param \Bs\PaymentBundle\Entity\Payment $payment
     */
    public function removePayment(\Bs\PaymentBundle\Entity\Payment $payment)
    {
        $this->payments->removeElement($payment);
    }
}
