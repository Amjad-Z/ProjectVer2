<!DOCTYPE html>
<html>
<head>
<title>Top 5</title>
<style type="text/css">
BODY {
background-image: url(bg3.jpg);
 width: auto;
 height: auto;
}

#chart-container {
    width: 60%;
    height: auto;
}

#chart-container-2{
    width: 60%;
    height: auto;
}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>


</head>
<body>
    <div id="chart-container" class="container">
        <canvas id="graphCanvas"></canvas>
    </div>
<br>
    <div id="chart-container-2" class="container">
        <canvas id="graphCanvas2"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
            showGraph2();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                     var rating = [];

                    for (var i in data) {
                        name.push(data[i].name);
                        rating.push(data[i].rating);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Rating',
                                backgroundColor: [
                                  'rgba(255, 99, 132, 0.6)',
                                  'rgba(54, 162, 235, 0.6)',
                                  'rgba(255, 206, 86, 0.6)',
                                  'rgba(75, 192, 192, 0.6)',
                                  'rgba(153, 102, 255, 0.6)'
                                ],
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: rating
                            }
                        ]}

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
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
                    text:'Top 5 players (Rating out of 10)',
                    fontSize:20
                  },

                  legend:{
                    display:true,
                    position:'false'

                  }
                }
               });
                });
            }
        }

        function showGraph2()
        {
            {
                $.post("data2.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                     var goals = [];

                    for (var i in data) {
                        name.push(data[i].name);
                        goals.push(data[i].goals);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Goals',
                                backgroundColor:  [
                                  'rgba(255, 99, 132, 0.6)',
                                  'rgba(54, 162, 235, 0.6)',
                                  'rgba(255, 206, 86, 0.6)',
                                  'rgba(75, 192, 192, 0.6)',
                                  'rgba(153, 102, 255, 0.6)'
                                ],
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: goals
                            }
                        ]}

                    var graphTarget = $("#graphCanvas2");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
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
                    text:'Top scorers',
                    fontSize:20
                  },

                  legend:{
                    display:false,
                    position:'right'

                  }
                }
               });
                });
            }
        }


        </script>

</body>
</html>
