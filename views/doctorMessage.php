<?php
?>

<div style="margin:auto;  margin-top: 100px!important; margin-bottom: 100px!important; width:1000px; ">
<h1>Messages</h1>
  <div class="card">
    <div class="card-body">
  
  <table id="doctor_table" class="display pt-5 " style="width:95%;">
         
      <colgroup>
          <col span="1" style="width: 15%;">
          <col span="1" style="width: 15%;">
          <col span="1" style="width: 55%;">
          <col span="1" style="width: 15%;">
        </colgroup>
         
         
         
         
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
                    <td><input id="<?php echo $item['title']; ?>=+=<?php echo $item['client']; ?>" class="btn btn-danger" type="button" value="Delete" /></td>
                </tr>
              <?php endforeach; ?>

          </tbody>
        
      </table>


    </div>
  </div>
</div>
