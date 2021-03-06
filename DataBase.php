<?php

class DataBase
{

    public static function ExcuteQuery($query)
    {
        $con = mysqli_connect('localhost','root','');
        mysqli_select_db($con, 'ShobraOrg');

        $sql = $query;
        if(mysqli_query($con,$sql)) {
            mysqli_close($con);
            return true;
        }
        else
        {
            mysqli_close($con);
            return false;
        }
    }

    public static function ExcuteRetreiveQuery($query)
    {
        $con = mysqli_connect('localhost','root','');
        mysqli_select_db($con, 'ShobraOrg');

        $sql = $query;
        if($results=mysqli_query($con,$sql)) {
            $listos=array();
            $results = mysqli_query($con, $sql);
            $check=false;
            while($row = mysqli_fetch_array($results)) {
                $listos[] = $row;
                $check = true;
            }
            mysqli_close($con);
            if ($check) {
                return $listos;
            }else{
                return false;
            }
        }
        else
        {
            mysqli_close($con);
            return false;

        }

    }

}

?>

