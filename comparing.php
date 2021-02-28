
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Welcome to my page</title>
  </head>
  <body background="bg3.jpg">

<img id="img2"src="2.jpeg" alt="2">
<table>

<div id="top5" class="container">
  <h2>Top 5 searched players:</h2>
<div id="searchedDIV">
</div>
</div>
<?php
include_once('connection.php');
  ?>
  <tr>
  <center>
  <form method="get"> <!--// onsubmit="return showButton()" -->
  <table>
  <tr><td colspan="2"><center> <h1>Compare players</h1></td></tr>
  <tr>
  <td><b>Select the name of your first player from the list: </b></td>
  <td>
  <select required name="player1" id="p1">
    <option value="" selected disabled hidden>--Select First Player--</option>
    <?php
    $result11 = mysqli_query($conn , "SELECT * FROM player2");
    while ($row = mysqli_fetch_assoc($result11)) {
    ?>
    <option value="<?php
        echo $row['name'];
        //echo utf8_encode($row['name']);
    ?>"> <?php
        echo $row['name'];
        //echo utf8_encode($row['name']);
    ?>
    </option>

    <?php
    }
    ?>
    </select>
  </td></tr>
  <tr><td><b>Select the name of your second player from the list:</b></td>
    <td>
    <select required name="player2" id="p2" onchange="same()">
      <option value="" selected disabled hidden>--Select Second Player--</option>
      <?php
      $result11 = mysqli_query($conn , "SELECT * FROM player2");
      while ($row = mysqli_fetch_assoc($result11)) {
      ?>
      <option value="<?php
          echo $row['name'];
          //echo utf8_encode($row['name']);
      ?>"> <?php
          echo $row['name'];
          //echo utf8_encode($row['name']);
      ?>
      </option>

      <?php
      }
      ?>
      </select>
    </td>
    <td><div id="isSame"></div></td>
  </tr>
  <tr><td colspan="2"><center><input type="submit" name="comparebtn" value="Compare!"/></center></td></tr>
  </table>
</tr>
<br>
<tr>
<a class="btn btn-primary" href="top5.php" role="button" target="_blank">Click here to see more stats!</a>
</tr>
</center>
<br>


  <?php
  //$name1 = $_GET['player1'];
  //$name2 = $_GET['player2'];
  //function compare(){
  //if (($_GET['player1'] !== $_GET['player2']) and isset($_GET['player1']) and isset($_GET['player2']))
  if (($_GET['player1'] !== $_GET['player2']) and isset($_GET['player1']) and isset($_GET['player2'])) {

  $name1 = $_GET['player1'];
  //$a = "%$name1%";
  //$a = utf8_encode($name1);
  $result1 = mysqli_query($conn , "SELECT * FROM player2 WHERE name = '$name1'");
  $rows1 = mysqli_num_rows($result1);
  while ($row = mysqli_fetch_assoc($result1)){
      $p1id =  $row['pid'];
      $p1name =  $row['name'];
      $p1team =  $row['team'];
      $p1goals = $row['goals'];
      $p1succdrib = $row['succ_dribb'];
      $p1tackles = $row['tackles'];
      $p1assists = $row['assists'];
      $p1accpasses = $row['acc_passes'];
      $p1rating = $row['rating'];
      $query1 = mysqli_query($conn,"UPDATE player2
  		SET searched = searched + '1' WHERE
  		name = '$p1name';");
    }

    $name2 = $_GET['player2'];
    //$b = "%$name2%";
    $result2 = mysqli_query($conn , "SELECT * FROM player2 WHERE name = '$name2'");
    $rows2 = mysqli_num_rows($result2);
    while ($row = mysqli_fetch_assoc($result2)){
      $p2id =  $row['pid'];
      $p2name =  $row['name'];
      $p2team =  $row['team'];
      $p2goals = $row['goals'];
      $p2succdrib = $row['succ_dribb'];
      $p2tackles = $row['tackles'];
      $p2assists = $row['assists'];
      $p2accpasses = $row['acc_passes'];
      $p2rating = $row['rating'];
      $query2 = mysqli_query($conn,"UPDATE player2
  		SET searched = searched + '1' WHERE
  		name = '$p2name';");
      }

if(isset($_GET['comparebtn'])){

        if (($rows1 > 0) and ($rows2 > 0) and isset($_GET['player1']) and isset($_GET['player2']) and ($_GET['player1'] !== $_GET['player2'])){
        echo "<table><tr>";
        echo "<td><b>First player : </b></td>";echo "<td><b><font color ='green'>";echo $p1name;echo "</font></b></td>";
        echo "<td><b>  Plays for : </b></td>";echo "<td><b>";echo $p1team;echo "</b></td>";
        echo "<td> </td><td><b>  Goals scored: </b></td>";
        if ($p1goals>=$p2goals){echo "<td><b><font color='#00CC00'>"; echo $p1goals; echo "</font></b></td>";}
        else {echo "<td><b><font color='#FF0000'>"; echo $p1goals; echo "</font></b></td>";}
        echo "<td><b>   Successfull dribbles: </b></td>";
        if ($p1succdrib>=$p2succdrib){echo "<td><b><font color='#00CC00'>"; echo $p1succdrib; echo "</font></b></td>";}
        else {echo "<td><b><font color='#FF0000'>"; echo $p1succdrib; echo "</font></b></td>";}
        echo "<td><b>   Assists: </b></td>";
        if ($p1assists>=$p2assists){echo "<td><b><font color='#00CC00'>"; echo $p1assists; echo "</font></b></td>";}
        else {echo "<td><b><font color='#FF0000'>"; echo $p1assists; echo "</font></b></td>";}
        echo "<td><b>Accurate Passes (%): </b></td>";
        if ($p1accpasses>=$p2accpasses){echo "<td><b><font color='#00CC00'>"; echo $p1accpasses; echo "</font></b></td>";}
        else {echo "<td><b><font color='#FF0000'>"; echo $p1accpasses; echo "</font></b></td>";}

        echo "</tr><br>";

        echo "<tr>";
        echo "<td><b>Second player : </b></td>";echo "<td><b><font color ='blue'>";echo $p2name;echo "</font></b></td>";
        echo "<td><b>  Plays for : </b></td>";echo "<td><b>"; echo $p2team; echo "</b></td>";
        echo "<td> </td><td><b>  Goals scored: </b></td>";
        if ($p2goals>=$p1goals){echo "<td><b><font color='#00CC00'>"; echo $p2goals; echo "</font></b></td>";}
        else {echo "<td><b><font color='#FF0000'>"; echo $p2goals; echo "</font></b></td>";}
        echo "<td><b>   Successfull dribbles: </b></td>";
        if ($p2succdrib>=$p1succdrib){echo "<td><b><font color='#00CC00'>"; echo $p2succdrib; echo "</font></b></td>";}
        else {echo "<td><b><font color='#FF0000'>"; echo $p2succdrib; echo "</font></b></td>";}
        echo "<td><b>Assists: </b></td>";
        if ($p2assists>=$p1assists){echo "<td><b><font color='#00CC00'>"; echo $p2assists; echo "</font></b></td>";}
        else {echo "<td><b><font color='#FF0000'>"; echo $p2assists; echo "</font></b><td>";}
        echo "<td><b>Accurate Passes (%): </b></td>";
        if ($p2accpasses>=$p1accpasses){echo "<td><b><font color='#00CC00'>"; echo $p2accpasses; echo "</font></b></td>";}
        else {echo "<td><b><font color='#FF0000'>"; echo $p2accpasses; echo "</font></b></td>";}

        echo "<td><center><button type='button' onclick='show()' id='myButtom' class='btn btn-primary'>Click Here to compare overall ratings</button></center></td>";
        echo "</tr>";
        echo "</table>";

      }
        else {
          echo "<font color='#FF0000'><b>Wrong entries, please try again!!</b></font>";}

}

}
else {
  echo "<font color='#FF0000'><b></b></font>";
}


?>


<br><br><br><br>
<br>
</table>

<div id="myDIV" class="container" style="display: none;">
  <canvas id="myChart"></canvas>
</div>

<div id="footer" class="center">

        <p><b>The results are provided by: <a href="https://www.sofascore.com/">SofaScore</a></b></p>
        <img id="sofa" src="SofaScore.jpeg" alt="sofa">


</div>

<script>

function same (pass){
var a =	document.getElementById('p1').value;
//	document.write(a);
  var b = document.getElementById('p2').value;
  if (a == b ){
    document.getElementById('isSame').innerHTML = "<font color='red'>Same player! Choose another player plz</font>";
    }
    else {
      document.getElementById('isSame').innerHTML = "<font color='#00CC00'>OK!</font>";
      }
  }

function searched(){
  xhr1 = new XMLHttpRequest();
  xhr1.open('POST' , 'searchedFetch.php' , true);
  xhr1.setRequestHeader('content-type','application/x-www-form-urlencoded');
  xhr1.send();
  xhr1.onreadystatechange = function()
  {
    document.getElementById('searchedDIV').innerHTML = xhr1.responseText;
  }
}

setInterval("searched()",1000);

function show() {

  var x = document.getElementById("myDIV");
  x.style.display = "block";
}


  let myChart = document.getElementById('myChart').getContext('2d');

  // Global Options
  Chart.defaults.global.defaultFontFamily = 'Lato';
  Chart.defaults.global.defaultFontSize = 18;
  Chart.defaults.global.defaultFontColor = '#777';

  let massPopChart = new Chart(myChart, {
    type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
    data:{
      labels:['<?php echo $p1name ; ?>', '<?php echo $p2name ; ?>'],
      datasets:[{
        label:'Rating',
        data:[
          <?php echo $p1rating ; ?>,
          <?php echo $p2rating ; ?>
        ],
        //backgroundColor:'green',
        backgroundColor:[
          'rgba(80, 189, 60, 0.65)',
          'rgba(0, 79, 148, 0.65)'
        ],
        borderWidth:1,
        borderColor:'#777',
        hoverBorderWidth:3,
        hoverBorderColor:'#000'
      }]
    },
    options:{
      scales:{
        yAxes: [{
            ticks: {
                max: 10,
                min: 0,
                stepSize: 1
            }
          }]
        },
      title:{
        display:true,
        text:'Rating out of 10',
        fontSize:25
      },
      legend:{
        display:false,
        position:'right',
        labels:{
          fontColor:'#000'
        }
      },
      layout:{
        padding:{
          left:50,
          right:0,
          bottom:0,
          top:0
        }
      },
      tooltips:{
        enabled:true
      }
    }
  });

</script>

  </body>
  </html>
