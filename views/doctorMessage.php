<?php
print_r($params);
?>

<div style="margin:auto;  margin-top: 100px!important; margin-bottom: 100px!important; width:1000px; ">
<h1>Messages</h1>
  <div class="card">
    <div class="card-body">
  
  <table id="doctor_table" class="display pt-5 " style="width:80%;">
          <thead>
              <tr>
                  <th>Title</th>
                  <th>Client</th>
                  <th>Message</th>
                  <th>Time</th>

              </tr>
          </thead>
          <tbody>
          
                
              <?php foreach($params as $item): ?>
                <tr>
                    <td><?php echo $item['title']; ?></td>
                    <td><?php echo $item['client']; ?></td>
                    <td><?php echo $item['msg']; ?></td>
                    <td><?php echo $item['time']; ?></td>
                </tr>
              <?php endforeach; ?>

          </tbody>
        
      </table>


    </div>
  </div>
</div>
