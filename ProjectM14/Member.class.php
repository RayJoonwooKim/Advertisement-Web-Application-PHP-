<?php
class Member{
    private $refmember;
    private $name;
    private $address;
    private $city;
    private $state;
    private $phone;
    private $email;
    private $password;
    private $membertype;
    
    public function __construct($name=null, $address=null, $city=null, $state=null, $phone=null, $email=null, $password=null, $membertype=null)
    {
        $this->name=$name;
        $this->address=$address;
        $this->city=$city;
        $this->state=$state;
        $this->phone=$phone;
        $this->email=$email;
        $this->password=$password;
        $this->membertype=$membertype;
    }
    /**
     * @return string
     */
    public function getRefmember()
    {
        return $this->refmember;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getMembertype()
    {
        return $this->membertype;
    }

    /**
     * @param string $refmember
     */
    public function setRefmember($refmember)
    {
        $this->refmember = $refmember;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $membertype
     */
    public function setMembertype($membertype)
    {
        $this->membertype = $membertype;
    }

    public function __toString()
    {
        return "Name : $this->name <br/> Email : $this->email <br/> Title : $this->membertype"; 
    }
    
    
    public function SignUp($connection, $name, $address, $city, $state, $phone, $email, $password, $membertype)
    {
        /*
        $name = $this->name;
        $address = $this->address;
        $city = $this->city;
        $state = $this->state;
        $phone = $this->phone;
        $email = $this->email;
        $password = $this->password;
        $membertype = $this->membertype;
        */

        $sql = "INSERT INTO members (name, address, city, state, phone, email, password, membertype) VALUES ('$name', '$address', '$city', '$state', '$phone', '$email', '$password', '$membertype')";
        $result = $connection->query($sql);
        
        return $result;
    }
    
    public function getLuckyMember($connectionID)
    {
        $sql = "SELECT * FROM members";
        $result = mysqli_query($connectionID, $sql);
        $numMembers = mysqli_num_rows($result);
        $luckyNumber = rand(0, $numMembers-1);
        
        return $luckyNumber;
    }

    
    
}