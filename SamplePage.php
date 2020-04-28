
<?php include "../inc/dbinfo.inc"; ?>
<html>
<head>
    <title>Impact Dashboard POC</title>
    <link href="css/insert.css" rel="stylesheet">
    <style>
      table{
      border-collapse:separate;
      border-spacing: 0 15px;
      }
      th{
      background-color: #4287f5;
      color: white;
      }
      th,td{
      width: 150px;
      text-align: left;
      border: 1px #f0f8ff;
      padding: 5px;
      }
      h2{
      color: #4287f5;
      }
    </style>
  </head>
<body>
<h1 align = "center" color ="Red">Impact Matrix</h1>

<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the EMPLOYEES table exists. */
  VerifyEmployeesTable($connection, DB_DATABASE);

  /* Ensure that the IMPACT_DETAILS table exists. */
  VerifyImpactDetailsTable($connection, DB_DATABASE);





?>



<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME']?>" method="POST">

  <hr>
  <h3>Customer Engagement Details</h3>
  <hr>

  <table border="0">

    <tr>
      <td>Customer | Project</td>
      <td>
        <input type="text" name="CUST_PROJ_NAME" maxlength="200" size="75" />
      </td>

    </tr>

    <tr>
      <td>Business Challenge</td>
      <td>
        <textarea name="B_CHALLENGE" cols="40" rows="5"></textarea>
      </td>

    </tr>

    <tr>
      <td>SDT Delivery Team</td>
      <td>
        <textarea name="SDT_TEAM" cols="40" rows="5"></textarea>
      </td>

    </tr>

    <tr>
      <td>Deliverables</td>
      <td>
        <textarea name="DELIVERABLES" cols="40" rows="5"></textarea>
      </td>

    </tr>


  </table>


  <h3>Customer Business Outcomes</h3>
  <hr>

  <table border="0">

    <tr>
      <td >Customer Business Outcome</td>
      <td>
        <textarea name="B_OUTCOME" cols="40" rows="5"></textarea>
      </td>

    </tr>


  </table>


  <h3>ProServe KPI Details</h3>
  <hr>

  <table border="0">

    <tr>
      <td>SOW total Amount</td>
      <td>
        <input type="number" name="SOW_TOT_AMT" maxlength="50" size="30" />
      </td>

      <td>SOW billable Amount</td>
      <td>
        <input type="number" name="SOW_BILL_AMT" maxlength="50" size="30" />
      </td>

      <td>SOW Investment</td>
      <td>
        <input type="number" name="SOW_INVEST_AMT" maxlength="50" size="30" />
      </td>

    </tr>

    <tr>
      <td>2019 Billed ProServe Revenue</td>
      <td>
        <input type="number" name="CURR_YR_PS_REV" maxlength="50" size="30" />
      </td>

      <td>2019 AWS Platform Revenue</td>
      <td>
        <input type="number" name="CURR_YR_AWS_REV" maxlength="50" size="30" />
      </td>

    </tr>
    <tr>
        <td>2019 Customer refernce (Y/N)</td>
          <td>
            <input type="radio" name="cust_ref_y" value = "Yes" />
            <label for = "cust_ref_y"> Yes</label>
            <input type="radio" name="cust_ref_n" value = "No" />
            <label for = "cust_ref_n"> No</label>

          </td>

        <td>CSAT Score</td>
        <td>
        <input type="number" name="CSAT_SCR" maxlength="50" size="30" />
      </td>

    </tr>

    <tr>
      <td>SDT project utilization</td>
      <td>
        <textarea name="SDT_PROJ_UTIL" cols="40" rows="5"></textarea>
      </td>

    </tr>

    <tr>
        <td>EDF(Y/N)</td>
          <td>
            <input type="radio" name="edf_y" value = "Yes" />
            <label for = "edf_y"> Yes</label>
            <input type="radio" name="edf_n" value = "No" />
            <label for = "edf_n"> No</label>

          </td>

    </tr>

    <tr>
        <td>DQ delivery review completed(Y/N)</td>
          <td>
            <input type="radio" name="dq_y" value = "Yes" />
            <label for = "dq_y"> Yes</label>
            <input type="radio" name="dq_n" value = "No" />
            <label for = "dq_n"> No</label>

          </td>

    </tr>

    <tr>
      <td>Published Artifact</td>
      <td>
        <textarea name="PUB_ART" cols="40" rows="5"></textarea>
      </td>

    </tr>

  </table>

  <h3>Risks</h3>
  <hr>

  <table border="0">

    <tr>
      <td>Risks & Challenges</td>
      <td>
        <textarea name="RISKS" cols="40" rows="5"></textarea>
      </td>

    </tr>

    <tr>
      <td>Asks of leadership team</td>
      <td>
        <textarea name="LDR_ASKS" cols="40" rows="5"></textarea>
      </td>

    </tr>

    <tr>

    <td>
        <input type="reset" name = "reset" value="Reset" style="height: 50px; width: 250px"/>
    </td>
    <td>
        <input type="submit" name = "submit" value="Submit" style="height: 50px; width: 250px"/>
    </td>

    </tr>

  </table>



  <script type ="text/javascript">
  function mess()
  {
    alert("Your record is successfully saved!);
    return true;
  }
  </script>

</form>

<?php
    if(isset($_POST['submit1'])) {
         /* If input fields are populated, add a row to the EMPLOYEES table. */
          $employee_name = htmlentities($_POST['NAME']);
          $employee_address = htmlentities($_POST['ADDRESS']);

        /*if (strlen($employee_name) || strlen($employee_address)) {*/
        if ($employee_name!='' || $employee_address!='') {
            AddEmployee($connection, $employee_name, $employee_address);
            $_POST['NAME'] ='';
            $_POST['ADDRESS'] ='';


            /*echo "<span style = "color:#00FF00;">Data Inserted successfully...!!</span>"*/

            }
        else{

            $_POST['NAME'] ='';
            $_POST['ADDRESS'] ='';

            //*echo "<span style = "color:#FF0000;">Data Insertion Failed!!Some Fields are Blank....!!</span>"*/
        }

        }

?>


<?php


        if(isset($_POST['submit'])) {
         /* If input fields are populated, add a row to the EMPLOYEES table. */
          $cust_name = htmlentities($_POST['CUST_PROJ_NAME']);
          $bus_chlng = htmlentities($_POST['B_CHALLENGE']);
          $sdt_team = htmlentities($_POST['SDT_TEAM']);
          $deliverables = htmlentities($_POST['DELIVERABLES']);
          $bus_outcome = htmlentities($_POST['B_OUTCOME']);
          $sow_total = htmlentities($_POST['SOW_TOT_AMT']);
          $sow_billable = htmlentities($_POST['SOW_BILL_AMT']);
          $sow_invest = htmlentities($_POST['SOW_INVEST_AMT']);
          $ps_rev = htmlentities($_POST['CURR_YR_PS_REV']);
          $aws_rev = htmlentities($_POST['CURR_YR_AWS_REV']);
          $cust_ref = 'Yes';/*htmlentities($_POST['CUR_YR_CUST_REF']);*/
          $csat = htmlentities($_POST['CSAT_SCR']);
          $proj_util = htmlentities($_POST['SDT_PROJ_UTIL']);
          $edf = 'Yes'; /*htmlentities($_POST['EDF']);*/
          $dq_rev = 'Yes'; /*htmlentities($_POST['DQ_REVIEW']);*/
          $artifacts = htmlentities($_POST['PUB_ART']);
          $risks = htmlentities($_POST['RISKS']);
          $ldr_asks = htmlentities($_POST['LDR_ASKS']);




        if ($cust_name!='' || $bus_chlng!='') {
            AddImactDetails($connection, $cust_name, $bus_chlng, $sdt_team, $deliverables, $bus_outcome,
                            $sow_total, $sow_billable, $sow_invest, $ps_rev, $aws_rev, $cust_ref,
                            $csat, $proj_util, $edf, $dq_rev, $artifacts, $risks,$ldr_asks );
            $_POST['CUST_PROJ_NAME'] ='';
            $_POST['B_CHALLENGE'] ='';


            /*echo "<span style = "color:#00FF00;">Data Inserted successfully...!!</span>"*/

            }
        else{

            $_POST['CUST_PROJ_NAME'] ='';
            $_POST['B_CHALLENGE'] ='';

            //*echo "<span style = "color:#FF0000;">Data Insertion Failed!!Some Fields are Blank....!!</span>"*/
        }

        }
  ?>



<!-- Display IMPACT_DETAILS data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>PROJECT NAME</td>
    <td>BUS_CHALLENGE</td>
    <td>SDT TEAM</td>
    <td>DELIVERABLED</td>
    <td>BUS_OUTCOME</td>
    <td>SOW_TOTAL_AMT</td>
    <td>SOW_BILL_AMT</td>
    <td>SOW_INVEST</td>
    <td>PROSER_REV</td>
    <td>AWS_REV</td>
    <td>CUST_REF</td>
    <td>CSAT</td>
    <td>PROJ_UTIL</td>
    <td>EDF</td>
    <td>DQ_REVIEW</td>
    <td>PUB_ARTIFACTS</td>
    <td>RISKS</td>
    <td>LDR_ASKS</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM IMPACT_DETAILS");

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>",
       "<td>",$query_data[3], "</td>",
       "<td>",$query_data[4], "</td>",
       "<td>",$query_data[5], "</td>",
       "<td>",$query_data[6], "</td>",
       "<td>",$query_data[7], "</td>",
       "<td>",$query_data[8], "</td>",
       "<td>",$query_data[9], "</td>",
       "<td>",$query_data[10], "</td>",
       "<td>",$query_data[11], "</td>",
       "<td>",$query_data[12], "</td>",
       "<td>",$query_data[13], "</td>",
       "<td>",$query_data[14], "</td>",
       "<td>",$query_data[15], "</td>",
       "<td>",$query_data[16], "</td>",
       "<td>",$query_data[17], "</td>",
       "<td>",$query_data[16], "</td>";

  echo "</tr>";
}
?>

</table>



</body>
</html>


<?php

/* Add an employee to the table. */
function AddEmployee($connection, $name, $address) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $address);

   // Check if record already exists or not
  $query = "SELECT count(*) as allcount FROM EMPLOYEES
          WHERE NAME='".$n."' && ADDRESS='".$a."'";
  $result = mysqli_query($connection,$query);
  $row = mysqli_fetch_array($result);
  $allcount = $row['allcount'];

  // insert new record
  if($allcount == 0){
     $insert_query = "INSERT INTO EMPLOYEES (NAME, ADDRESS) VALUES ('$n', '$a')";
     mysqli_query($connection,$insert_query);
  }



   /*if(mysqli_query($connection, $query))
   {
        header("location: SamplePage.php");

   }
   else
   {
        echo("<p>Error adding employee data.</p>");
   }*/

   /*if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");*/
}


/* Check whether the table exists and, if not, create it. */
function VerifyEmployeesTable($connection, $dbName) {
  if(!TableExists("EMPLOYEES", $connection, $dbName))
  {
     $query = "CREATE TABLE EMPLOYEES (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         NAME VARCHAR(45),
         ADDRESS VARCHAR(90)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}


function VerifyImpactDetailsTable($connection, $dbName) {
  if(!TableExists("IMPACT_DETAILS", $connection, $dbName))
  {
     $query = "CREATE TABLE IMPACT_DETAILS (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         CUST_PROJ_NAME VARCHAR(100),
         B_CHALLENGE VARCHAR(500),
         SDT_TEAM VARCHAR(500),
         DELIVERABLES VARCHAR(500),
         B_OUTCOME VARCHAR(500),
         SOW_TOT_AMT FLOAT(15,3),
         SOW_BILL_AMT FLOAT(15,3),
         SOW_INVEST_AMT FLOAT(15,3),
         CURR_YR_PS_REV FLOAT(15,3),
         CURR_YR_AWS_REV FLOAT(15,3),
         CUR_YR_CUST_REF VARCHAR(5),
         CSAT_SCR FLOAT(4,2),
         SDT_PROJ_UTIL VARCHAR(100),
         EDF VARCHAR(5),
         DQ_REVIEW VARCHAR(5),
         PUB_ART VARCHAR(500),
         RISKS VARCHAR(500),
         LDR_ASKS VARCHAR(500)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}



/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}

/* Add an record to the IMPACT_DETAILS table. */
function AddImactDetails($connection, $cust_name, $bus_chlng, $sdt_team, $deliverables, $bus_outcome,
                            $sow_total, $sow_billable, $sow_invest, $ps_rev, $aws_rev, $cust_ref,
                            $csat, $proj_util, $edf, $dq_rev, $artifacts, $risks,$ldr_asks){

   $c_n = mysqli_real_escape_string($connection, $cust_name);
   $b_c = mysqli_real_escape_string($connection, $bus_chlng);
   $team = mysqli_real_escape_string($connection, $sdt_team);
   $delvrbl = mysqli_real_escape_string($connection, $deliverables);
   $outcome = mysqli_real_escape_string($connection, $bus_outcome);
   $sow_t = mysqli_real_escape_string($connection, $sow_total);
   $sow_b = mysqli_real_escape_string($connection, $sow_billable);
   $sow_i = mysqli_real_escape_string($connection, $sow_invest);
   $p_rev = mysqli_real_escape_string($connection, $ps_rev);
   $a_rev = mysqli_real_escape_string($connection, $aws_rev);
   $c_ref = mysqli_real_escape_string($connection, $cust_ref);
   $csat_scr = mysqli_real_escape_string($connection, $csat);
   $util = mysqli_real_escape_string($connection, $proj_util);
   $edf = mysqli_real_escape_string($connection, $edf);
   $dq_r = mysqli_real_escape_string($connection, $dq_rev);
   $artfct = mysqli_real_escape_string($connection, $artifacts);
   $rsk = mysqli_real_escape_string($connection, $risks);
   $ask = mysqli_real_escape_string($connection, $ldr_asks);


 // Check if record already exists or not
  $query = "SELECT count(*) as allcount FROM IMPACT_DETAILS
          WHERE CUST_PROJ_NAME='".c_n."' ";
  $result = mysqli_query($connection,$query);
  $row = mysqli_fetch_array($result);
  $allcount = $row['allcount'];

  // insert new record
  if($allcount == 0){

   $insert_query = "INSERT INTO IMPACT_DETAILS (CUST_PROJ_NAME, B_CHALLENGE, SDT_TEAM, DELIVERABLES, B_OUTCOME, SOW_TOT_AMT,SOW_BILL_AMT, SOW_INVEST_AMT, CURR_YR_PS_REV, CURR_YR_AWS_REV, CUR_YR_CUST_REF, CSAT_SCR,SDT_PROJ_UTIL, EDF, DQ_REVIEW, PUB_ART, RISKS, LDR_ASKS)

   VALUES
   ('$c_n', '$b_c', '$team', '$delvrbl', '$outcome', '$sow_t',
   '$sow_b', '$sow_i', '$p_rev', '$a_rev', '$c_ref', '$csat_scr',
   '$util', '$edf', '$dq_r', '$artfct', '$rsk', '$ask')";

     mysqli_query($connection,$insert_query);
  }



   /*if(mysqli_query($connection, $query))
   {
        header("location: SamplePage.php");

   }
   else
   {
        echo("<p>Error adding employee data.</p>");
   }*/

   /*if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");*/
}


?>
