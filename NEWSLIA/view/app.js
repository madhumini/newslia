var cal = {
  // (A) SUPPORT FUNCTION - AJAX CALL
  ajax : function (data, load) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "Smart_Calandar_Ajax_Data.php");
    if (load) { xhr.onload = load; }
    xhr.send(data);
  },
  // (B) ON PAGE LOAD - ATTACH LISTENERS + DRAW
  init : function () {
    document.getElementById("calmonth").addEventListener("change", cal.draw);
    document.getElementById("calyear").addEventListener("change", cal.draw);
    cal.draw();
  },
  // (C) DRAW CALENDAR
  draw : function () {
    // (C1) FORM DATA
    let data = new FormData();
    data.append("req", "draw");
    data.append("month", document.getElementById("calmonth").value);
    data.append("year", document.getElementById("calyear").value);
    // (C2) ATTACH CLICK TO UPDATE EVENT ON AJAX LOAD
    cal.ajax(data, function(){
      let wrapper = document.getElementById("calwrap");
      wrapper.innerHTML = this.response;
      let all = wrapper.getElementsByClassName('day');
      
      all = wrapper.getElementsByClassName('calevt');
      if (all.length != 0) { for (let evt of all) {
        evt.addEventListener("click", cal.show);
      }}
    });
  },
};
window.addEventListener("DOMContentLoaded", cal.init);