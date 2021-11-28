function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh)
}


function display_ct() {

    const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    const days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

    var x = new Date()
    var x1=  days[x.getDay()]+", "+months[x.getMonth()]+ " " + x.getDate() + " " + x.getFullYear(); 
    x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
    
    document.getElementById('clock').innerHTML = x1;
    display_c();
}

function toogle (source){
    var checkBoxes = document.getElementsById("chx");

    for(var i=0; i<checkBoxes.length; i++) //i+=2;
    {
        checkBoxes[i].checked = source.checked;
    }
}