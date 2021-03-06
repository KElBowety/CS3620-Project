<?php


class User extends Human implements IAddToDB
{
    private string $userName;
    private string $password;
    private string $regesterationDate;
    private string $lastSignIn;
    private int $type;
    private array $allowedPages;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */



    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): bool
    {
        if ($userName=="" || $userName==null)
            return false;

        $this->userName = $userName;
        return true;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): bool
    {
        if ($password=="" || $password==null)
            return false;
        $this->password = $password;
        return true;
    }

    /**
     * @return string
     */
    public function getRegesterationDate(): string
    {
        return $this->regesterationDate;
    }

    /**
     * @param string $regesterationDate
     */
    public function setRegesterationDate(string $regesterationDate): void
    {
        $this->regesterationDate = $regesterationDate;
    }

    public function logIn(): bool
    {
        $query="SELECT * FROM users WHERE userName='$this->userName' AND password='$this->password' ";
        $result=DataBase::ExcuteRetreiveQuery($query);
        if (count($result)==0)
        {
            return false;
        }
        $this->regesterationDate=$result[0][2];
        $this->lastSignIn=$result[0][3];
        $this->id=$result[0][4];
        $this->type=$result[0][5];

        $this->loadAllowedPages();
    }

    /**
     * @return string
     */
    public function getLastSignIn(): string
    {
        return $this->lastSignIn;
    }

    /**
     * @param string $lastSignIn
     */
    public function setLastSignIn(string $lastSignIn): void
    {
        $this->lastSignIn = $lastSignIn;
    }

    /**
     * @return array
     */
    public function getAllowedPages(): array
    {
        return $this->allowedPages;
    }

    /**
     * @param array $allowedPages
     */
    public function loadAllowedPages(): void
    {
        $query="SELECT pageId FROM pagepermissions WHERE userId='$this->type'";
        $this->allowedPages=DataBase::ExcuteRetreiveQuery($query);
    }

    function addToDB(): bool
    {

        $query="INSERT INTO people (id, name, type) VALUES ('$this->id','$this->name','1')";
        DataBase::ExcuteQuery($query);
        $query="INSERT INTO users(userName, password, registerationDate, LastSignIn, id, type) VALUES ('$this->userName','$this->password','$this->regesterationDate','$this->lastSignIn','$this->id','$this->type')";
        DataBase::ExcuteQuery($query);

    }
}