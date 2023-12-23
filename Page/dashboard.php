<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
     <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="../css/dashboard.css">
    
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
          <a class="navbar-brand" href="home.html">Smart Green Office</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link active" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Products</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Solutions</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Contact</a>
                  </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="dashboard.html">
                          <img src="../upload/dashboard.png" alt="Dashboard" class="dashboard-icon">
                      </a>
                  </li>
  
              </ul>
          </div>
      </div>
  </nav>

  <!-- content -->
  <div class="container custom-container mt-4 mx-auto">
    <h2 class="text-center">Dashboard</h2>
    <div class="d-flex justify-content-center">
        <canvas id="myChart" class="w-full"></canvas>
 <script>

const xValues = [50,60,70,80,90,100,110,120,130,140,150];
const yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0.3,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
            </script>
    </div>
    <h2 class="text-center">Electric Current Room UD203</h2>
</div>






  <!-- footer -->
  <footer class="text-center mt-auto">
    <div class="contact-info">
        <p>Contact us at: <span>info@smarthometech.com</span></p>
    </div>
    
</footer>

  
  
</footer>



   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>