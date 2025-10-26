<?php
require_once 'database.php';
require_once 'functions.php';
$result = display_data();
$result2 = display();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <script type="text/javascript">
    function borrowFun() {
      alert("Borrow list updated shortly"); 
    }
    function returnFun() {
      alert("Return list updated shortly");
    }
    function logFun() {
      alert("Log list updated shortly");
    }
    </script>
<div class="header">
  <h1><center>Library Notification Management System</center></h1>
</div>
<div>
  <ul><li><a class="active" href="main.php">List</a></li>
    <li><a href="report.php">Report</a></li>
    <li><a href="search.php">Book Search</a></li>
    <li><a href="enrolment.php">Enrolment</a></li>
    <li><a href="dash.html">Dashboard</a></li>
    <li style="float:right"><a href="login.php">Logout</a></li>
  </ul>
</div><br>
<div class="div-1"><center>
  <?php 
    if(isset($_POST['borrow'])){
      echo "<script>borrowFun();</script>";
      $result = display_data();
        }
  ?>
  <form method="post">
  <input type="submit"  name="borrow" class="button button-1" value="Borrow" >
  </center>
</form>
  <table>
    <thead><tr>
      <th>Book ID</th>
      <th>Role</th>
      <th>Book Name</th>
      <th>Start Date</th>
      <th>Due Date</th>
 </thead>
 <tbody>
  <tr>
  <?php
    while($row=mysqli_fetch_assoc($result)){
  ?>
  <td><?php echo $row['bid']??''; ?></td>
  <td><?php echo $row['role_id']??''; ?></td> 
  <td><?php echo $row['book']??''; ?></td> 
  <td><?php echo $row['sdate']??''; ?></td> 
  <td><?php echo $row['edate']??''; ?></td>   
 </tr>
 <?php
  }
   ?>
  </tbody>
  </table>
</div>
 
<div class="div-2">
  <?php 
  if(isset($_POST['return'])){
    echo "<script>returnFun();</script>";
    $result2 = display();
      }   
?>
<form method="post">
  <center>
    <input type="submit" name="return" class="button button-1" value="Return"></center>
  </form>
  <table>
    <thead><tr>
      <th>Book ID</th>
      <th>Role</th>
      <th>Book Name</th>
      <th>Date</th>
      <th>Fine Amount</th>
 </thead>
 <tbody>
  <tr>
  <?php
    while($row=mysqli_fetch_assoc($result2)){
  ?>
  <td><?php echo $row['bid']??''; ?></td>
  <td><?php echo $row['role_id']??''; ?></td>
  <td><?php echo $row['book']??''; ?></td> 
  <td><?php echo $row['sdate']??''; ?></td> 
  <td><?php echo $row['fine']??''; ?></td>    
 </tr>
 <?php
  }
   ?>
  </tbody>
  </table> 
</div>
</body>
</html><!-- HTML !-->

