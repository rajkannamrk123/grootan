<?php

$conn = mysqli_connect("localhost","root","","csv");


 if(isset($_POST["import"])){
     $filename = $_FILES["file"]["tmp_name"];

     if($_FILES["file"]["size"]>0){
         $file = fopen($filename, "r");

         while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
             $sqlInsert = "Insert into data (name, type) values ('" . $column[0] . "','" . $column[1] ."')";

             $result = mysqli_query($conn, $sqlInsert);

             if(!empty($result)){
                 echo "CSV Data Imported into the Database";
            }else{
                echo "Problem in importing CSV";
            }
         }
     }
 }

 ?>

 <form class="form-horizoontal" action="" method="post" name="uploadCSV" enctype="multipart/form-data">

 <div>
     <label>Choose CSV File </label>
     <input type="file" name="file" accept=".csv">
     <button type="Submit" name="import">Import</button>


</div>

</form>

<?php



$sqlSelect = "SELECT * from data";

$result = mysqli_query($conn, $sqlSelect);

if(mysqli_num_rows($result) > 0){
    ?>
    <table>
    <thead>
    <tr>
    <th>USER ID</th>
    <th>USER NAME</th>
    <th> TYPE</th>
    </tr>
</thead>
<?php
while ($row = mysqli_fetch_array($result)){

?>
<tbody>
    <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['type'];?></td>
</tr>
</tbody>
<?php } ?>
</table>
<?php }

?>

        
    
}


}