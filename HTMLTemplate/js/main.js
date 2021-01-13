const calender = document.querySelector('#app-calender');


const isWeekend =day =>
{
    return ((day % 7 === 0) || (day % 7 === 6));

}

for(let day = 1; day < 32; day++)
{
    const weekend = isWeekend(day);

    let name ="";
    if(day <= 7)
    {
        const date =  new Date(2020,0,day);

        const options = { weekday : "short"};
        
        const dayName = new Intl.DateTimeFormat('en-Us',options).format(date);
        name= `<div class="name">${dayName}</div>`
    }
   


    calender.insertAdjacentHTML(`beforeend`,
    `<div class="day ${weekend ? "weekend": ""}">${name}${day}</div>`
    );
}


document.querySelectorAll("#app-calender .day").forEach
(
    day=>{
        day.addEventListener("click",event=>{
            event.currentTarget.classList.toggle("selected");
        });
    });
