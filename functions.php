<?php 

    require_once 'database.php';
    date_default_timezone_set("Asia/Calcutta");
    $sdate=date("Y-m-d");
    $start= $sdate ." ". " 00:00:00";
    $end = $sdate ." ". " 23:59:59";
    function dis(){
        global $conn;
        $tdate = isset($_POST['fname']) ? $_POST['fname'] : '';
        $tdate = str_replace("T"," ", $tdate);
        $ttdate =isset($_POST['lname']) ? $_POST['lname'] : '';
        $ttdate = str_replace("T"," ", $ttdate);
        $tab = isset($_POST['fav']) ? $_POST['fav'] : '';
        if($tab =='borrow'){
            $query ="select * from ". $tab ." where sdate >'". $tdate . "'and  sdate <'". $ttdate. "'";
        }else if($tab =='duta'){
            $query ="select * from ". $tab ." where sdate >'". $tdate . "'and  sdate <'". $ttdate. "'";
        }else
        {
            $query ="select * from ". $tab ." where date >'". $tdate . "'and  date <'". $ttdate. "'";
        }
        #echo $query;
        $result3 = mysqli_query($conn, $query);
        return $result3;
    }
    #echo $start;
    function display_data(){
        global $conn;
        date_default_timezone_set("Asia/Calcutta");
        $sdate=date("Y-m-d");
        $start= $sdate. " 00:00:00";
        $end = $sdate. " 23:59:59";
       # $start="2023-09-27 00:00:00";
       # $end="2023-09-27 23:59:59";
        $query = "select * from borrow where sdate >'". $start . "'and  sdate <'". $end. "'";
        #echo $query;
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function display(){
        global $conn;
        date_default_timezone_set("Asia/Calcutta");
        $sdate=date("Y-m-d");
        $start= $sdate. " 00:00:00";
        $end = $sdate. " 23:59:59";
       # $start="2023-09-27 00:00:00";
        #$end="2023-09-27 23:59:59";
        $query = "select * from duta where sdate >'".$start. "'and  sdate <'". $end."'";
        #echo $query;
        $result2 = mysqli_query($conn, $query);
        return $result2;
    }
    function diss(){
        global $conn;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $query ="select * from book where name LIKE '%". $name . "%'";
        #echo $query;
        $result4 = mysqli_query($conn, $query);
        return $result4;
    }

?>