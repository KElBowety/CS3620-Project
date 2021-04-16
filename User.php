<?php
require_once 'IRegistrationStrategy.php';
require_once 'AdminRegistrationStrategy.php';
require_once 'AccountantRegistrationStrategy.php';
require_once ('Human.php');
require_once ('IAddToDB.php');
require_once ('DataBase.php');
require_once ('IShowAll.php');
require_once ('IUpdateInDB.php');
require_once ('IRemoveFromDB.php');
require_once ('ProxyUserInterface.php');

class User extends Human implements IAddToDB, IShowAll, IUpdateInDB,IRemoveFromDB,ProxyUserInterface
{
    private string $userName;
    private string $password;
    private string $regesterationDate;
    private string $lastSignIn;
    private int $type;
    private array $allowedPages;
    private IRegistrationStrategy $registrationStrategy;

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


    public function getType(): int
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
        if ($userName == "" || $userName == null)
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
        if ($password == "" || $password == null)
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
        $query = "SELECT * FROM users WHERE userName='$this->userName' AND password='$this->password' ";
        $result = DataBase::ExcuteRetreiveQuery($query);

        if ($result == false) {
            return false;
        }
        $this->regesterationDate = $result[0][2];
        $this->lastSignIn = date('Y-m-d H:i:s');
        $this->id = $result[0]['humanId'];
        $this->type = $result[0]['type'];
        $this->loadAllowedPages();
        $this->updateInDB();

        return true;
    }

    public function setStrategy(int $type)
    {
        if ($type > 2 || $type <= 0)
            return false;
        if ($type == 1)
            $this->registrationStrategy = new AdminRegistrationStrategy();
        else
            $this->registrationStrategy = new AccountantRegistrationStrategy();
    }

    public function checkRegister($password): bool
    {
        if ($this->registrationStrategy == null)
            return false;
        return ($this->registrationStrategy->register($password));
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
        $query = "SELECT pageId FROM pagepermissions WHERE userId='$this->type'";
        $temp = DataBase::ExcuteRetreiveQuery($query);

        foreach ($temp as $value) {
            $this->allowedPages[] = $value[0];
        }


    }

    public function addToDB(): bool
    {
        $query="INSERT INTO human(name, type) VALUES ('$this->name', '3')";
        $check1=DataBase::ExcuteIdQuery($query);
        if ($check1==false)
        {
            return false;
        }
        $this->id=$check1;
        $this->regesterationDate = date('Y-m-d H:i:s');
        $query = "INSERT INTO users(userName, password, registerationDate, humanId, type) VALUES ('$this->userName','$this->password','$this->regesterationDate','$this->id','$this->type')";
        $check2 = DataBase::ExcuteQuery($query);
        if (!$check2) {
            $this->removeWrongInserted();
            return false;
        }
        return true;
    }


public function showAllData()

    {
        $query="SELECT  human.id,name, userName,password,regesterationDate,LastSignIn, Users.type FROM human INNER JOIN users ON users.humanId = human.id;";
        $result=DataBase::ExcuteRetreiveQuery($query);
        if ($result==false)
            return false;
        return $result;

    }


    public function updateInDB(): bool
    {
        $query= "UPDATE users SET userName='$this->userName', password='$this->password', LastSignIn='$this->lastSignIn'  WHERE id='$this->id'";
        DataBase::ExcuteQuery($query);
        return true;
    }

    public function removeFromDB(): bool
    {
        $query= "DELETE FROM users WHERE id='$this->id'";
        DataBase::ExcuteQuery($query);
        $query= "DELETE FROM people WHERE id='$this->id'";
        DataBase::ExcuteQuery($query);
        return true;
    }
    private function removeWrongInserted(): void
    {
        $query= "DELETE FROM human WHERE id='$this->id'";
        DataBase::ExcuteQuery($query);
    }

    public function changePassword(string $oldPassword, string $newPassword): bool
    {
        if ($oldPassword != $this->password)
        {
            return false;
        }
        $temp=$this->password;
        $this->password=$newPassword;
        if ($this->updateInDB())
        {
            return true;
        }else{
            $this->password=$temp;
            return false;
        }

    }
    public function checkAccess(int $pageId):bool
    {
        foreach ($this->allowedPages as $value)
        {
            if ($value==$pageId)
            {
                return true;
            }
        }
        return false;
    }

    public function getUsersFiltered()
    {
        // TODO: Implement getUsersFiltered() method.
    }
}