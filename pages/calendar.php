<?php
  include('../includes/database.php');
  include('../includes/header.php');

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script>  
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:false,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: '../includes/calendar/read.php',

   });
  });  
  </script>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Calendar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="calendar.php">Home</a></li>
          <li class="breadcrumb-item active">Calendar</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="container">
        <div class="card">
          <div class="card-body p-5">
            <div><a href="fypActivity.php"><button name="calendar" class="btn btn-primary mb-2">Table View</button></a></div>
            <div id="calendar"></div>
          </div>
        </div>
      </div>
  </section>

  </main><!-- End #main -->

<?php
  include('../includes/navbarcoordinator.php');
  include('../includes/footer.php');
  include('../includes/scripts.php'); 
?>
<script>
  document.title = "StudFYP | Calendar";
  var element = document.getElementById("fypactivity");
  element.classList.remove("collapsed");
</script>
