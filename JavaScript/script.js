function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh)
}


function display_ct() {

    const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    const days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

    var x = new Date()
    var x1=  days[x.getDay()]+", "+months[x.getMonth()]+ " " + x.getDate() + " " + x.getFullYear(); 
    x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
    
    document.getElementById('clock').innerHTML = x1;
    display_c();
}