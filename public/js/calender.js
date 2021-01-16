
    const calender = document.querySelector('#app-calender');
    var dates = [];
    var currentYear;
    var currentMonth;
    var currentMonthNumber;
    var maxDays;

    const isWeekend =day =>
    {
        return ((day % 7 === 0) || (day % 7 === 6));

    }

    const calenderSetup=()=>
    {

        var month = document.getElementById("app-calender-title");
        var date = new Date();
        currentYear = date.getFullYear(); 
        currentMonth = date.toLocaleString('default', { month: 'long' });
        currentMonthNumber = date.getMonth();
        maxDays= getDaysInMonth(currentMonthNumber,currentYear);
        var Title =currentMonth+" "+currentYear;

        document.getElementById("app-calender-title").innerHTML=Title;

        for(let day = 1; day < maxDays+1; day++)
        {

            let holidays="";
            const weekend = isWeekend(day);

            let name ="";
        // if(day <= 7)
            {
                const date =  new Date(2020,0,day);

                const options = { weekday : "short"};
                
                const dayName = new Intl.DateTimeFormat('en-Us',options).format(date);
                name= `<div class="name">${dayName}</div>`
            }

            calender.insertAdjacentHTML(`beforeend`,
            `<div id="${day}"  class="day ${weekend ? "weekend": ""}">${name}<div ="d-inline">${day}</div><div  id="day_${day}"></div></div>`
            );
        }

        document.querySelectorAll("#app-calender .day").forEach
        (
            day=>{
                day.addEventListener("click",event=>{
                    //event.currentTarget.classList.toggle("selected");
                    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));



                    console.log("trying... appointment");
                    $.ajax({
                        url: "/appointment/booking/getAppointmentTimes",
                        type: "POST",
                        //data:{doctor:doctor,client:client,time:d,duration:duration,msg:msg},
                        dataType: "json",
                        traditional: true,
                        //contentType: "application/json; charset=utf-8",
                        success: function (data) 
                        {
                            console.log("success");
                            data = jQuery.parseJSON(JSON.stringify(data));
                            console.log(data);
                        }
                    }).fail(function(xhr, status, error) {
                         console.log(xhr,status,error);
                    }).done(function (data) {
                        data = jQuery.parseJSON(JSON.stringify(data));

                        console.log(data);
                        var time = document.getElementById('time');
                        var date = document.getElementById('date');
                        var op ="";
                        timeOptionsDivs=[];
                        timeOptions=[];
                        for(var i = 12; i < 18; i++)
                        {
                            op+='<option value="'+i+':00">'+i+':00</option>';
                            timeOptionsDivs.push(op);
                            timeOptions.push(i);
                            op="";
                            
                        }
                        var x = day.childNodes;                        
                        var z =(x[1]).innerHTML;
                        data.result.forEach(element=>{
                            d = new Date(element.time);
                        
                            var y = d.getDate();
                            var a = y.toString();
                            
                            if(z==a)
                            {
                            timeOptions.filter(time=>time==d.getHours());
                            }

                        });

                        time.innerHTML="";
                        timeOptionsDivs.forEach(t=>{
                            time.innerHTML+=t;
                        });
                        

                        date.innerHTML=currentYear+'/'+(currentMonthNumber+1)+'/'+z;

                    });



                    myModal.show();
                });
        });
    }



    const getHolidayData = async(month) =>
    {

        var holidays =await fetch('https://holidayapi.com/v1/holidays?pretty&key=cd994f74-b066-45d8-ba64-bee622625aef&country=US&year=2020&month='+month+'')
        .then(response => response.json())


        return holidays.holidays;

    }
    var getDaysInMonth = function(month,year) {
        // Here January is 1 based
        //Day 0 is the last day in the previous month
    return new Date(year, month, 0).getDate();
    // Here January is 0 based
    // return new Date(year, month+1, 0).getDate();
    };


    const loadHolidays = async () =>
    {
        var currentYear = new Date();
        currentYear = currentYear.getFullYear();  

        for(let mon = 1; mon < 13; mon++)
        {
            var x =await getHolidayData(mon);
            var month =
            {
                'days':getDaysInMonth(mon, currentYear),
                'holidays': x
            }

            dates.push(month);
        }

        return true;
    }



    const switchMonths = (select) =>
    {
    var date = new Date();
    realCurrentYear = date.getFullYear();
        if(select==0)
        {
            if((currentMonthNumber-1) < 0)
            {
                var date = new Date();
                realCurrentYear = date.getFullYear();
                
                if( (currentYear-1) < realCurrentYear )
                {
                    console.log("current Year cant be changed");      
                }
                else
                {
                    currentMonthNumber=11;
                    currentYear--;
                }
            }
            else
            {
                currentMonthNumber--;
            }
        }
        else if(select==1)
        {
            if( (currentMonthNumber+1) > 11 )
            {
                currentYear++;
                currentMonthNumber=0;
            }
            else
            {
                currentMonthNumber++;
            }
        }

        var mon = new Date(currentYear,currentMonthNumber);
        currentMonth = mon.toLocaleString('default', { month: 'long' });

        var Title =currentMonth+" "+currentYear;
        document.getElementById("app-calender-title").innerHTML=Title;

    
        getMonthHolidays();
    

    }


    const getMonthHolidays = () =>
    {
        var str2int=dates[currentMonthNumber].holidays;


        maxDays= getDaysInMonth(currentMonthNumber,currentYear);

        for(let day = 1; day < maxDays+1; day++)
        {
            document.getElementById('day_'+day+'').innerHTML="";


        }

        str2int.forEach(holiday => {

            var x = holiday.observed.split("-");
            var y=parseInt(x[2]);
            var z="";
            z+=holiday.name;
            document.getElementById('day_'+y+'').innerHTML=z;
            });
    }


    const  setup =async()=>
    {
        let spinner ="";

        spinner +='<div id="spin">'+
                        '<div class="spinner">'+
                            '<div class="rect1"></div>'+
                            '<div class="rect2"></div>'+
                            '<div class="rect3"></div>'+
                            '<div class="rect4"></div>'+
                            '<div class="rect5"></div>'+
                        '</div>'+
                    '</div>';

        document.getElementById('app-calender').innerHTML=spinner;
        await loadHolidays();
        document.getElementById('app-calender').innerHTML="";
        calenderSetup();
        getMonthHolidays();

    }

    const addAppointment=()=>
    {    
        
        var doctor=document.getElementById('doctor').innerHTML;
        var time=document.getElementById('time').value;
        var duration=document.getElementById('duration').value;
        var msg=document.getElementById('msg').value;
        var client=document.getElementById('client').value;
        var date=document.getElementById('date').innerHTML;
        var x = date.split("/");
        var y = time.split(":");

        var a,b;
        if(( currentMonthNumber+1 ) < 10 )
        {
            var c =currentMonthNumber+1;
            a = c.toString();
            b = '0'+a;
            
        }

        var d =currentYear+'-'+b+'-'+x[2]+' '+y[0]+':'+y[1]+':00';

        if((client=="")||(time==0)||(duration==0))
        {
            console.log("fill fields!");
        var x= document.getElementById('fields');
        x.style.display="block";
        return;
        } 



        
                    
                $.ajax({
                    url: "/appointment/booking/addAppointment",
                    type: "POST",
                    data:{doctor:doctor,client:client,time:d,duration:duration,msg:msg},
                    dataType: "json",
                    traditional: true,
                    //contentType: "application/json; charset=utf-8",
                    success: function (data) 
                    {
                    // console.log(data);
                    }
                }).done(function (data) {
                    console.log(data);
                    $(".modal-backdrop").remove();
                    $('#staticBackdrop').hide(); 
                    $('.toast').toast('show');


                });
    }




    setup();