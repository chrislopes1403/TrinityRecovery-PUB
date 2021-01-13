<main id="main" style="margin-top:60px; margin-bottom:10px;">
        <div class="app-calender-container">
            <div class="app-calender-header"><i class="fa fa-angle-left fa-2x app-calender-arrow" onclick=switchMonths(0)></i><h2 class="app-calender-title" id="app-calender-title"></h2><i class="app-calender-arrow fa fa-angle-right fa-2x" onclick=switchMonths(1)></i></div>
            <div id="app-calender">
        
            </div>
        </div>

</main>   

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content" id="Modal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Make an Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="fields" style="color:red;" >Fill fields: name time duration.</div>

      <div class="modal-body">
        

      <label for="client" class="form-label">Your Name</label>
      <input type="text" class="form-control" id="client">

        <div class="mt-4">Doctor: Dr. <div id="doctor" class="d-inline"><?php echo $params['doctor']?></div> </div>


        <div>Date:<div id="date" class="d-inline"></div></div>


        <select select class="form-select mt-4" aria-label="Default select example" id="duration">
            <option value="0"  selected>Select an appointment Duration</option>
            <option value="30">30 minute</option>
            <option value="45">45 minute</option>
            <option value="1">1 hour</option>
        </select>
        <select select class="form-select mt-4" aria-label="Default select example" id="time">
            <option value="0" selected>Select an appointment Time</option>
            
        </select>
        <label for="message-text" class="col-form-label">Note For doctor:</label>
        <textarea class="form-control" id="msg"></textarea>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  onclick=addAppointment()>Submit</button>
      </div>
    </div>
  </div>
</div>




