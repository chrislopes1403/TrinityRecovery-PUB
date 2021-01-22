<?php
use app\core\Application;
?>



<div class="" style="margin-top:80px; !important">
  <div class="messaging">
    <div class="inbox_msg">

      <div class="inbox_people">

          <div class="inbox_chat" id="inbox_chat">
          <?php if(Application::$app->user->FindDoctor()):?>
            <h4 id="chat_header">Clients</h4>
          <?php else:?>
            <h4 id="chat_header">Doctors</h4>
          <?php endif;?>
          <form class="form-inline my-1">
          <input id="search-list" name="search-list" class="form-control mr-sm-2" type="text" list="Users"  placeholder="Search"  autocomplete="off"/>
            <datalist id="Users" >


            <?php foreach($params as $item): ?>
                    <option onclick="searchUsers()"  value="<?php echo $item['firstname']; ?>-<?php echo $item['lastname']; ?>" >

                    <?php if(!Application::$app->user->FindDoctor()):?>Dr.<?php endif;?>
                    <?php echo $item['firstname']; ?> <?php echo $item['lastname']; ?>

                    </option>

              <?php endforeach; ?>


          </datalist>
      
          </form>
              
            <div id="loadbox">
            
                <div class="chat_list">
                  <div class="chat_people">
                    <div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>
                    <div class="chat_ib">
                      <div class="mt-1" style="width:300px; border-radius: 25px; height:20px; background-color:#E6E6E6;"></div> 
                      <div class="mt-1" style="width:150px; border-radius: 25px; height:20px; background-color:#E6E6E6;"></div> 
                      <div class="mt-1"  style="width:375px; border-radius: 25px; height:20px; background-color:#BDBBBB;"></div> 

                    </div>
                  </div>
                </div>
                
                <div class="chat_list">
                  <div class="chat_people">
                    <div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>
                    <div class="chat_ib">
                      <div class="mt-1" style="width:300px; border-radius: 25px; height:20px; background-color:#E6E6E6;"></div> 
                      <div class="mt-1" style="width:150px; border-radius: 25px; height:20px; background-color:#E6E6E6;"></div> 
                      <div class="mt-1"  style="width:310px; border-radius: 25px; height:20px; background-color:#BDBBBB;"></div> 
                    </div>
                  </div>
                </div>

                <div class="chat_list">
                  <div class="chat_people">
                    <div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>
                    <div class="chat_ib">
                      <div class="mt-1" style="width:300px; border-radius: 25px; height:20px; background-color:#E6E6E6;"></div> 
                      <div class="mt-1" style="width:150px; border-radius: 25px; height:20px; background-color:#E6E6E6;"></div> 
                      <div class="mt-1"  style="width:290px; border-radius: 25px; height:20px; background-color:#BDBBBB;"></div> 

                    </div>
                  </div>
                </div>

            </div>

            
          </div><!--chat-->

        </div><!--people-->

        <div class="mesgs">
          <div class="msg_history" id="msg_history">
           


          </div>

          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message" id="chat_text" />
              <button class="msg_send_btn" type="button" id="chat_submit" onclick=chatSubmit()><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>