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
            <!--
            <div class="chat_list active_chat"  onclick=getChat(this)>
              <div class="chat_people">
                <div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>
                <div class="chat_ib">
                  <h5 class='toUser'>Sunil Rajput</h5> <span class="chat_date">Dec 25 2020 10:30pm</span>
                  <p>Test, which is a new approach to have all solutions 
                    astrology under one roof.</p>
                </div>
              </div>
            </div>

            <div class="chat_list"  onclick=getChat(this)>
              <div class="chat_people">
                <div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>
                <div class="chat_ib">
                  <h5 class='toUser'>Chris Lopes</h5> <span class="chat_date">Dec 25</span>
                  <p>Test, which is a new approach to have all solutions 
                    astrology under one roof.</p>
                </div>
              </div>
            </div>

            <div class="chat_list"  onclick=getChat(this)>
              <div class="chat_people">
                <div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>
                <div class="chat_ib">
                  <h5 class='toUser'>Bob Smith</h5> <span class="chat_date">Dec 25</span>
                  <p>Test, which is a new approach to have all solutions 
                    astrology under one roof.</p>
                </div>
              </div>
            </div>
            -->
          </div><!--chat-->

        </div><!--people-->

        <div class="mesgs">
          <div class="msg_history" id="msg_history">
            <!--
            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="/img/img11.jpg" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>Test which is a new approach to have all
                    solutions</p>
                  <span class="time_date"> 11:01 AM    |    June 9</span></div>
              </div>
            </div>

            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>

            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>
            
            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>

            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>

            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>

            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>

            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>

            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>

            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>

            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="/img/img11.jpg" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>Test, which is a new approach to have</p>
                  <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
              </div>
            </div>

            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Apollo University, Delhi, India Test</p>
                <span class="time_date"> 11:01 AM    |    Today</span> </div>
            </div>

            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="/img/img11.jpg" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>We work directly with our designers and suppliers,
                    and sell direct to you, which means quality, exclusive
                    products, at a price anyone can afford.</p>
                  <span class="time_date"> 11:01 AM    |    Today</span></div>
              </div>
            </div>
            -->
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