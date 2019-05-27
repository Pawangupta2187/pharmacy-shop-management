

<!--set total amount in order table-->



<?php  
session_start();//
include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}
$x="";






  if(isset($_POST['Generate']))  
      {  
              if(isset($_POST['special_customer']))
              {
              $cust_id=$_POST['cust_id']; 
              //paid or not paid
             // echo $cust_id;
              $checkcustomer="SELECT * FROM `customer` WHERE cust_id='$cust_id'";//query for update special customer's transation record
                    $resultcheckcustomer=$con->query($checkcustomer);
                   if(!(mysqli_num_rows($resultcheckcustomer)>0))
              {
                 // echo "record not insert in customer record";
                 //print_r($sqlcustomer);
              //  echo"fdf";
                  $x="Record not found";
               
               goto end;

              }

              }

              for($i=0;$i<count($_POST['mname']);$i++)
                     {
                                     
                          $mname=$_POST['mname'][$i];       
                          $batch=$_POST['batch'][$i];
                          $sqlfetchitemid="SELECT * FROM `medicine` WHERE M_name='$mname' AND Batch='$batch'";
                          $resfetchitemid=$con->query($sqlfetchitemid);
                          $rowitem=mysqli_fetch_assoc($resfetchitemid);
                          $itemid=$rowitem['M_id'];
                          $quan=$_POST['quantity'][$i];
                          $sqlcheckstock="SELECT * FROM `stock` WHERE M_id='$itemid';";//fetch stock detail
                          $resultcheckstock=$con->query($sqlcheckstock);
                          if(!(mysqli_num_rows($resultcheckstock)>0))
                                        {   
                                            $x="error in fetch stock"; 
                                            goto end;            
                                         }
                          $rowcheckstock=mysqli_fetch_assoc($resultcheckstock);
                          if($rowcheckstock['Actuall_quantity']<$quan)
                                       {
                                            $j=$i+1;
                                            $x=" ".$mname."(".$j.") only left (".$rowcheckstock['Actuall_quantity'].")";
                                            goto end;
                                        }
                       }

              $date=date("Y-m-d"); 
              $totalprice=0;
              $sql="INSERT INTO `order`(`O_date`, `Amount`) VALUES ('$date','$totalprice');";//insert date amount in order table at beganing amount is 0 after that actuall amount update
              $result=$con->query($sql);

              if(!($result))
                    {
                      print_r($sql);
                      echo "wrong in order id";
                    }
            else
                {

                        $sql5="SELECT * FROM `order` WHERE O_date='$date' AND Amount='$totalprice'";
                        $result5=$con->query($sql5);
 
                              if(!(mysqli_num_rows($result5)>0))
                                  {
                                        echo "wrong in fetching id"; 
                                  }
                              else{
                                       $rows=mysqli_fetch_assoc($result5);
                                       $id=$rows['Order_id'];

                                       


                                       for($i=0;$i<count($_POST['mname']);$i++)  
                                           {  
                                                  $order=$id;
                                                  $mname=$_POST['mname'][$i];       
                                                  $batch=$_POST['batch'][$i];
                                                  $sqlfetchitemid="SELECT * FROM `medicine` WHERE M_name='$mname' AND Batch='$batch'";
                                                  $resfetchitemid=$con->query($sqlfetchitemid);
                                                  $rowitem=mysqli_fetch_assoc($resfetchitemid);
                                                  $itemid=$rowitem['M_id'];
                                                  $mrp=$_POST['mrp'][$i];
                                                  $quan=$_POST['quantity'][$i];
                                                  $dis=$_POST['discount'][$i];
                                                  $amt=$_POST['amount'][$i];
                                                  $totalprice=$totalprice+$amt;
                                                 // $customer=$_POST['special_customer'];//checked or uncheked for special customer
                                                 
                                                  $sql1="INSERT INTO `of_item`(`Order_id`,`Item_id`,`Item_mrp`,`Item_quantity`,`Item_discount`,`Item_amount`)VALUES('$order','$itemid','$mrp','$quan','$dis','$amt')"; //query for insert items detail in Of_item table
                                                  
                                                  $result1=$con->query($sql1);
                                                                 if(!($result1))
                                                                  {    

                                                                    $x="not completed";
                                                                    goto end;
                                                                  }


                                                  $sqlfetchstock="SELECT * FROM `stock` WHERE M_id='$itemid';";//fetch stock detail
                                                  $resultstock=$con->query($sqlfetchstock);

                                                  if(!(mysqli_num_rows($resultstock)>0))
                                                     {   
                                                              $x="error in fetch stock"; 
                                                              goto end;            
                                                     }
                                                  else
                                                     {      
                                                              $rowstock=mysqli_fetch_assoc($resultstock);
                                                              $actuallquantity=$rowstock['Actuall_quantity']-$quan;
                                                               

                                                               $stockupdate="UPDATE `stock` set Actuall_quantity='$actuallquantity' where M_id='$itemid';";//query for decrease stock
                                                               $resultupdate=$con->query($stockupdate);
                                                               if(!$resultupdate)
                                                                       {
                                                                            $x="error in update stock";
                                                                            goto end;
                                                                        }
                                                    }                  
                                            }        
                                            
                                                      
                                       $sqlupdateorder="UPDATE `order` set Amount='$totalprice' where Order_id='$order';";
                                        //update total amount of order
                                       $resupdateorder=$con->query($sqlupdateorder);
                                                      
                                                       
                                                        if(!($resupdateorder))
                                                        {
                                                              print_r($sqlupdateorder);
                                                        }
                                                                        else
                                                                                {
                                                                                        
                                                                                    if(isset($_POST['special_customer']))
                                                                                       {
                                                                                         //$cust_id=$_POST['cust_id'];
                                                                                           //echo $cust_id;
                                                                                         $status=$_POST['status'];
                                                                                          $sqlcustomer="INSERT INTO `customer_record`(`cust_id`,`Order_id`,`status`)VALUES('$cust_id','$id','$status')";//query for update special customer's transation record
                                                                                          $resultcustomer=$con->query($sqlcustomer);
                                                                                          if($resultcustomer)
                                                                                              {
                                                                                                 header("location:test.php?id=".$id);
                                                                                              }

                                                                                          }
                                                                                      else{
                                                                                            header("location:test.php?id=".$id);
                                                                                              
                                                                                           }
                                                                                }                        
                                                                        
                                                                   
                                                         
                                                                           


                                  } 
                                                                  







                }                                                
                   
      }                                                                     




end:




  
?>  
    <!DOCTYPE html>  
    <html>  
  
    <head>  
       <title>Pharmacy Shop Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"  type="text/css" meia="screen" href="bootstrap-4.3.1-dist\css\bootstrap.min.css">
  <script src="jquery-3.3.1.min.js"></script>
  <script src="bootstrap-4.3.1-dist\js\bootstrap.min.js"></script>
  
    <link rel="stylesheet" href="fontawesome-free-5.7.2-web\css\all.css">
     
    </head>  
    <scriptsrc="//code.jquery.com/jquery-1.12.0.min.js">  
        </script>  
        <scriptsrc="//code.jquery.com/jquery-migrate-1.2.1.min.js">  
         

<script>
function showHint(str) {//show medicine on dropdown 
    //alert(str);
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("sp").innerHTML= this.responseText;
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}

function validate()
{
if(!(confirm("Edit Confirm!")))
{
  return false;
}
}
</script>





            <body>  
            <div class="jumbotron jumbotron-fluid" style="background-color: #5FB48A; margin-bottom: 2px;padding: 4px;padding-top: 2px;">
  <h1 style="color:white; text-align: center;font-family: Arial"><b><i class="fa fa-plus-square" style="font-size:48px;color:white"></i> &nbsp;Pharmacy Shop Management &nbsp;<i class="fa fa-plus-square" style="font-size:48px;color:white"></i></b></h1>
 
  </div>

                <form action="" method="POST" onsubmit="return validate();"">  
                                      <table class="table  table-hover">  
                        <thead>  
                            <th>No</th>  
                            <th>Medicine Name</th>  
                            <th>Batch</th>
                            <th>Unit</th>
                            <th>MRP</th>
                            <th>Quantity</th>  
                            <th>Price</th>  
                            <th>Discount(%)</th>  
                            <th>Amount</th>  
                            <th><input type="button" value="+" id="add" class="btnbtn-primary"></th>  
                        </thead>  
                        <tbody class="detail">  
                            <tr>  
                                <td class="no">1</td> 




                         







                                <td><input type="text" class="form-control mname" name="mname[]" id="medicine" list="mname"  required onchange="showHint(this.value)">

                                     <datalist id="mname">
                                <?php
                                $sql4="select *from medicine;";
                                $result4=$con->query($sql4);
                                  if(mysqli_num_rows($result4)>0){ 
                                     while($row4=mysqli_fetch_assoc($result4)){
                                                              ?>
                         <option value="<?php echo $row4['M_name']; ?>">
                            <?php
                             }
                            }
                            ?>
                        </datalist>
                                </td>


                                 <td><input type="text" class="form-control batch" name="batch[]" id="batch" required list="batch"  ></td>
                                <span id="sp"></span>

                                  <td><input type="number" class="form-control unit" name="unit[]" id="unit" required></td>
                                   <td><input type="number" class="form-control mrp" name="mrp[]" id="mrp" required ></td>
                                <td><input type="number" class="form-control quantity" name="quantity[]" id="quantity" required ></td>  
                                <td><input type="number" class="form-control price" name="price[]" id="price" required></td>  
                                <td><input type="number" class="form-control discount" name="discount[]" required id="discount" ></td>  
                                <td><input type="number" class="form-control amount" name="amount[]" required id="amount "></td>  
                                <td><a href="#" class="remove">Delete</td> 

</tr>  
</tbody>  
<tfoot>  
<th></th>  
<th></th>  
<th></th>  
<th></th>  
<th></th>  
<th style="text-align:center;"> Special Customer<p><input type="checkbox" value="true" name="special_customer" id="special_customer" /></p><p><span id="x"></span></p><p><span><?php echo $x ?></span></p></th>  
<th  style="text-align:center;"> Paid&nbsp;<input type="radio" name="status" value="Paid">
     <p> Unpaid&nbsp;<input type="radio" name="status" value="Unpaid"></p>
     </th>  
  
<th style="text-align:center;" class="total"> Total Amount : 0<b></b></th>  
<th style="text-align:center;"> <input type="submit" class="btn" style="background-color: #5FB48A; color: white;" name="Generate" value="Generate Bill" ></th>
</tfoot>  
  
</table>  
</form> 

  <div class="container-fluid fixed-bottom" style="background-color: #5FB48A;padding: 2px;">
  <h3 style="color:white; text-align: center;font-family:sans-serif; "><b>Contact us</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Feedback</b></h3>
 
  </div> 
</body>  
</html>  
<script type="text/javascript">  

$('body').delegate('.batch','change',function()  
    {  

var st=$(this).val();

        var tr=$(this).parent().parent();

//alert("hello"+tr.find('.batch').val());
var bat=tr.find('.batch').val();

 var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {//fetching information of medicine detail
  if (this.readyState == 4 && this.status == 200) {
  //   this.responseText
  var myObj = JSON.parse(this.responseText);
   // alert(myObj[0]);    
    tr.find('.unit').val(myObj[0]);
  tr.find('.mrp').val(myObj[1]);

  }
};
xmlhttp.open("GET", "getunit.php?batch=" + bat, true);
xmlhttp.send();


  

    }); 





$(function()  
{  
    $('#add').click(function()  //function for add new row
        {  
        addnewrow();  

        });  
$('body').delegate('.remove','click',function()  //function for remove row
    {  
    $(this).parent().parent().remove();  
    });  
/*$('body').delegate('.quantity,.price,.discount,','keyup',function()  
    {  
    var tr=$(this).parent().parent();  
    var qty=tr.find('.quantity').val();  
    var price=tr.find('.price').val();  
  
    var dis=tr.find('.discount').val();  
    var amt =(qty * price)-(qty * price *dis)/100;  
    tr.find('.amount').val("Total amount"+amt);  
    total();  
    });  */

});


$('body').delegate('.quantity','keyup',function()  //function for set amount according to quantity
    {  
    var tr=$(this).parent().parent();  
    var qty=tr.find('.quantity').val();  
    var mrp=tr.find('.mrp').val();  
  
     
    var amt =(qty * mrp); 
    tr.find('.price').val(amt);  
   // total();  
    });  

$('body').delegate('.discount','keyup',function()  
    {  
    var tr=$(this).parent().parent();  
    var discount=tr.find('.discount').val();  
    var price=tr.find('.price').val();  
  
    var disc=tr.find('.discount').val();  
    var amnt=price-((price/100)*discount);
    //var amnt=(price-((price\100)*disc));
    //alert("fgfg"+$discount+$price+$disc);
    tr.find('.amount').val(amnt);  
   total();  
    }); 





//});
function total()  //for count total amount according to add new item
{  
var t=0;  
$('.amount').each(function(i,e)   
{  
var amt =$(this).val()-0;  
t+=amt;  
});  
$('.total').html(t);  
} 


function addnewrow()   //function for add new line for item when click + button
{ 
var n=($('.detail tr').length-0)+1;  

var tr = '<tr>'+  
'<td class="no">'+n+'</td>'+


 '<td><input type="text" class="form-control mname" name="mname[]" id="medicine" list="mname" required onchange="showHint(this.value)">'+

                                   '  <datalist id="mname">'+
                              "  <?php
                                $sql4="select *from medicine;";
                                $result4=$con->query($sql4);
                                  if(mysqli_num_rows($result4)>0){ 
                                     while($row4=mysqli_fetch_assoc($result4)){
                                                              ?>"+
                         '<option value="<?php echo $row4['M_name']; ?>">'+
                            "<?php
                             }
                            }
                            ?>"+
                       ' </datalist>'+
                               ' </td>'+

'<td><input type="text" class="form-control batch" name="batch[]" id="batch" required list="batch"></td>'+
'<span id="sp"></span>'+
'<td><input type="text" class="form-control unit" name="unit[]" required></td>'+
'<td><input type="text" class="form-control mrp" name="mrp[]" required ></td>'+
'<td><input type="text" class="form-control quantity" name="quantity[]" required></td>'+
'<td><input type="text" class="form-control price" name="price[]" required ></td>'+
'<td><input type="text" class="form-control discount" name="discount[]" required></td>'+
'<td><input type="text" class="form-control amount" name="amount[]"  required></td>  '+
'<td><a href="#" class="remove">Delete</td>'; 
/*'<td><input type="text" class="form-control productname" name="productname[]"></td>'+  
'<td><input type="text" class="form-control quantity" name="quantity[]"></td>'+  
'<td><input type="text" class="form-control price" name="price[]"></td>'+  
'<td><input type="text" class="form-control discount" name="discount[]"></td>'+  
'<td><input type="text" class="form-control amount" name="amount[]"></td>'+  
'<td><a href="#" class="remove">Delete</td>'+  
'</tr>';*/  


$('.detail').append(tr);   
}  
</script>  
<script type="text/javascript">
  
function validate()//alert box for confirmation
{
if(!(confirm("Confirm Order!")))
{
  return false;
}
}
</script>
<script type="text/javascript">
  $('input[type="checkbox"][name="special_customer"]').change(function() //if user checked the special customer checkbox then a input field appeared for enter customer id.
  {  
     if(this.checked) {
      
     // var id='<p><input type="text" name="cust_id" placeholder="Customer id"/></p>';
       document.getElementById("x").innerHTML='<input type="text" name="cust_id" class="form-control cust_id" placeholder="customer id" required/>';// do something when checked
     }
     else//when again uncheck the box input field get disappeared.
     {
      document.getElementById("x").innerHTML='';
     }
 });
</script>