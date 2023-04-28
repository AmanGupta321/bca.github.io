<?php
     $myfile = fopen("login_data.txt", "r") or die ("Unable to open file!");
     $uname = fgets($myfile);
     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "dbaman";
     $conn = mysqli_connect($servername, $username, $password, $database);
     if (!$conn)
     {
             die("Sorry we failed to connect: ". mysqli_connect_error());
     }
     else{
         $sql1 = "SELECT * FROM `register` WHERE username = '$uname'";        
         $result1 = mysqli_query($conn, $sql1);

         echo "<table>";
         while($row1 = mysqli_fetch_assoc($result1))
     {
         echo "<tr>"."<td colspan=4 id=upper>"."Name : ".$row1['firstName']." ".$row1['lastName']."</td>"."</tr>";
         echo "<tr>"."<td colspan=4>"."DOB : ".$row1['dob']."</td>"."</tr>";
         echo "<tr>"."<td colspan=4>"."Contact : ".$row1['contact']."</td>"."</tr>";
         echo "<tr>"."<td colspan=4>"."Email : ".$row1['Email']."</td>"."</tr>";
     }
         echo "<tr class=underline>";
         echo "<th>"."Item"."</th>";
         echo "<th>"."Price"."</th>";
         echo "<th>"."Quantity"."</th>";
         echo "<th>"."Total"."</th>";
         echo "</tr>";
         
     //Opening user selected item file
$pricedata = fopen("usi.txt", "r") or die ("Unable to open file!");
$ch = 0;
$arr = array();

//Forming array of data
while (!feof($pricedata)){
 $var = fgets($pricedata);
 $arr[$ch] = $var;
 $ch++; 
}
unset($arr[0]);
arsort($arr);
$newarr = array_values($arr);

/* Array For Product and is Quantity*/
$cart = array();
$count = 0  ;
$arraylength = 0;
for ($i=0; $i<$ch-1 ; $i++) { 
 for ($j=0; $j<$ch-1 ; $j++) { 
     if(trim($newarr[$i]) == (trim($newarr[$j]))) {
         $count++;
     }
 }	
 $cart[trim($newarr[$i])] = $count;
 $count = 0;
}


$alldessert = array("ck1" => "Red Velvet", "ck2" => "White Forest", "ck3" => "Black Forest", "ck4" => "Chocolate Truffle", "ck5" => "ButterScotch", "ck6" => "Vanilla", "ck7" => "Strawberry", "ck8" => "Mousse White", "p1" => "Apple Pie", "p2" => "Chocolate Pastry", "p3" => "Dark Chocolate Mousse", "c1" => "Butter Cookie", "c2" => "Macaroons", "c3" => "Peanut Butter Cookie", "c4" => "Chocolate Chip Cookie", "b1" => "Wheat Bread", "b2" => "White Bread", "b3" => "Whole Grain Bread", "b4" => "Donut Bread");

$alldessertprice = array("Red Velvet" => "600", "White Forest" => "500", "Black Forest" => "500", "Chocolate Truffle" => "450", "ButterScotch" => "450", "Vanilla" => "350", "Strawberry" => "600", "Mousse White" => "600", "Apple Pie" => "50", "Chocolate Pastry" => "40", "Dark Chocolate Mousse" => "80", "Butter Cookie" => "100", "Macaroons" => "180", "Peanut Butter Cookie" => "240", "Chocolate Chip Cookie" => "80", "Wheat Bread" => "35", "White Bread" => "30", "Whole Grain Bread" => "45", "Donut Bread" => "60");


// Final Sorted Array
 $topayfinalamt = 0;
 foreach ($cart as $key => $value) {
     foreach($alldessert as $k1 => $v){
         if(trim($key) == (trim($k1))){
             $producttotalprice = $value * $alldessertprice[$v];
             $topayfinalamt += $producttotalprice;
             echo "<tr>";
             echo "<td>".$v."</td>";
             echo "<td>"."₹".$alldessertprice[$v]."</td>";
             echo "<td>".$value."</td>";
             echo "<td>"."₹".$producttotalprice."</td>";
             echo"</tr>";
         }
     }
 }
 $filefinalprice = fopen("finalprice.txt", "w");
 fwrite($filefinalprice, $topayfinalamt);
 fclose($filefinalprice);              
     }
    
     $pricedata = fopen("finalprice.txt", "r") or die ("Unable to open file!");
     $r = fgets($pricedata);
     if(!$r){
         echo "<tr class=underline><td colspan=4><b>Your Cart is Empty";
     }
     else{
         echo "<tr class=underline><td colspan=4><b>Total Price : ₹ ";
         echo $r;
         echo '</b></td></tr>';
         fclose($pricedata);
     }
?>