function cenlen(){
  var r = window.innerWidth * 0.1771875;
  var u = r+"px";
  var w = document.querySelector(".ytplayer_i");
  var x = window.innerHeight-80;
  var y = x+"px";
  var z = document.querySelector(".center");
  w.style.height = u;
  z.style.height = y;
}

window.onload = cenlen;
window.onresize = cenlen;
