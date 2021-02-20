<?php

session_start();

if(!isset($_SESSION["valid"])){
  header('Location: login.php');
}

include("conn.php");
if(isset($_POST["add"])){
  $results = mysqli_query($db, "INSERT into students (name, address, faculty, contact)
             values ('$_POST[name]', '$_POST[address]', '$_POST[faculty]', '$_POST[contact]')");
}

if(isset($_GET["del"])){

  $id = $_GET["del"];
  $results = mysqli_query($db, "DELETE FROM students WHERE id=$id");

}


  if(isset($_POST["update"])){
    $id = $_POST["id"];
    $results = mysqli_query($db, "UPDATE students SET name='$_POST[name]', address='$_POST[address]', faculty='$_POST[faculty]', contact='$_POST[contact]' WHERE id=$id");
    
  }

?>

<html>
<head>
</head>
<body>
<h3>Student Form</h3>
        <form method="POST">
          <?php
            if(isset($_GET["edit"])){
              $id = $_GET["edit"];
              $results = mysqli_query($db, "SELECT id, name, address, faculty, contact FROM students WHERE id=$id");
                $row = mysqli_fetch_array($results);
              ?>
                <input type="text" name="id" value="<?=$row["id"]?>" hidden/>
                <input type="text" name="name" placeholder="name" value="<?=$row["name"]?>"/>
                <input type="text" name="address" placeholder="address" value="<?=$row["address"]?>"/>
                <input type="text" name="faculty" placeholder="faculty" value="<?=$row["faculty"]?>"/>
                <input type="text" name="contact" placeholder="contact" value="<?=$row["contact"]?>"/>
          <?php

              echo '<button type="submit" name="update">Update</button>';
            }else{
              echo'
                <input type="text" name="name" placeholder="name"/>
                <input type="text" name="address" placeholder="address"/>
                <input type="text" name="faculty" placeholder="faculty"/>
                <input type="text" name="contact" placeholder="contact"/>
              <button type="submit" name="add">Add</button>';
            }
            ?>

        </form>


        <!-- After login.. -->
        <table>
          <thead>
          <h3>All Students</h3>
            <tr>
                    <th>Name</th>
              <th>Address</th>
                    <th>Faculty</th>
              <th>contact</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
            
            <?php

              $results = mysqli_query($db, "SELECT id, name, address, faculty, contact FROM students");
              while($row = mysqli_fetch_array($results)){
                  echo '<tr>';
                  echo '<td>'.$row["name"].'</td>';
                  echo '<td>'.$row["address"].'</td>';
                  echo '<td>'.$row["faculty"].'</td>';
                  echo '<td>'.$row["contact"].'</td>';
                  echo '<td>
                    <a href="?edit='.$row["id"].' "class="edit_btn" >Edit</a>
                  </td>
                  <td>
                    <a href="?del='.$row["id"].' "class="del_btn">Delete</a>
                  </td>
                </tr>';
              }
            ?>
              
        </table>

        <table>
          <thead>

          <h3>CSIT Students</h3>
            <tr>
                    <th>Name</th>
              <th>Address</th>
                    <th>Faculty</th>
              <th>contact</th>
            </tr>
          </thead>
            
            <?php

              $results = mysqli_query($db, "SELECT id, name, address, faculty, contact FROM students WHERE faculty='csit'");
              while($row = mysqli_fetch_array($results)){
                  echo '<tr>';
                  echo '<td>'.$row["name"].'</td>';
                  echo '<td>'.$row["address"].'</td>';
                  echo '<td>'.$row["faculty"].'</td>';
                  echo '<td>'.$row["contact"].'</td>';                 
              }
            ?>
              
        </table>
</body>
</html>