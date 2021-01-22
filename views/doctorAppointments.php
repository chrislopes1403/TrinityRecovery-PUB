<?php

use app\core\Application;
use app\models\AppointmentModel;

$appointmentModel = new AppointmentModel;


$apts=$appointmentModel->getAppointments();

?>
<div style="margin:auto;  margin-top: 100px!important; margin-bottom: 100px!important; width:1000px; ">
  <h1>Appointments</h1>
  <div class="card">
    <div class="card-body">
  
  <table id="doctor_table" class="display pt-5 " style="width:80%; margin-top: 200 !important;  padding-top: 200  !important; max-height:600px;">
          <thead>
              <tr>
                  <th>Doctor</th>
                  <th>Client</th>
                  <th>Duration</th>
                  <th>Time</th>
                  <th>Message</th>
              </tr>
          </thead>
          <tbody>
          
                <?php foreach($apts as $item): ?>
                <tr>
                    <td><?php echo $item['doctor']; ?></td>
                    <td><?php echo $item['client']; ?></td>
                    <td><?php echo $item['duration']; ?> minutes/hours</td>
                    <td><?php echo $item['time']; ?></td>
                    <td><?php echo $item['msg']; ?></td>
                </tr>
                <?php endforeach; ?>
          </tbody>
        
      </table>


    </div>
  </div>
</div>
