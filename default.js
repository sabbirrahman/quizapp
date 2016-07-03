function $(id){
	return document.getElementById(id);
}

var username = ["admin", "nurmd", "marzia", "yasnaemu", "tanzia", "etiakter", "tahmina", "samsad", "shamim"];
var password = ["qwerty", "desert", "matrix", "dimention", "rhythm", "permutation", "combination", "theory", "hybrid"];

function check(form){
	var x = form.userid.value;
	var y = form.pswrd.value;
	localStorage.un = x;
	for(var i=0; i<9; i++) {
		if(x == username[i] && y == password[i]) {
			window.location.assign('qset1.htm');
			break;
		} else {
			continue;
		}
	}
	if(i == 9) {
		alert("Username or Password Not Found!");
	}
}

function findSelection(field){
    var test = document.getElementsByName(field);
    var sizes = test.length;
    for(var i=0; i < sizes; i++) {
        if (test[i].checked==true) {     
            return test[i].value;
        }
    }
}

function userans1(form){
	var a = findSelection("Q1");
	var b =	findSelection("Q2");
	var c =	findSelection("Q3");
	var d =	findSelection("Q4");
	var e =	findSelection("Q5");
	var f =	findSelection("Q6");
	var g =	findSelection("Q7");
	var h =	findSelection("Q8");
	var i =	findSelection("Q9");
	var j =	findSelection("Q10");
	
	var usrans = [a, b, c, d, e, f, g, h, i, j];
	
	var crtans = ["Q1O2", "Q2O1", "Q3O1", "Q4O3", "Q5O3", "Q6O1", "Q7O1", "Q8O3", "Q9O3", "Q10O1"];
	
	var c1 = 0;
	
	for(var k=0; k<10; k++) {
		if(usrans[k] == crtans[k])
			c1++;
		else
			continue;
	}
	alert("You have answered"+" "+c1+" "+"correct answers");
	window.location.assign('qset2.htm');
	localStorage.value1 = c1;
}

function userans2(form){
	var a = findSelection("Q1");
	var b =	findSelection("Q2");
	var c =	findSelection("Q3");
	var d =	findSelection("Q4");
	var e =	findSelection("Q5");
	var f =	findSelection("Q6");
	var g =	findSelection("Q7");
	var h =	findSelection("Q8");
	var i =	findSelection("Q9");
	var j =	findSelection("Q10");
	
	var usrans = [a, b, c, d, e, f, g, h, i, j];
	
	var crtans = ["Q1O3", "Q2O2", "Q3O2", "Q4O1", "Q5O1", "Q6O3", "Q7O3", "Q8O2", "Q9O1", "Q10O2"];
	
	var c2 = 0;
	
	for(var k=0; k<10; k++)
	{
		if(usrans[k] == crtans[k])
			c2++;
		else
			continue;
	}
	alert("You have answered"+" "+c2+" "+"correct answers");
	window.location.assign('qset3.htm');
	localStorage.value2 = c2;
}

function userans3(form){
	var a = findSelection("Q1");
	var b =	findSelection("Q2");
	var c =	findSelection("Q3");
	var d =	findSelection("Q4");
	var e =	findSelection("Q5");
	var f =	findSelection("Q6");
	var g =	findSelection("Q7");
	var h =	findSelection("Q8");
	var i =	findSelection("Q9");
	var j =	findSelection("Q10");
	
	var usrans = [a, b, c, d, e, f, g, h, i, j];
	
	var crtans = ["Q1O2", "Q2O4", "Q3O4", "Q4O4", "Q5O2", "Q6O1", "Q7O2", "Q8O4", "Q9O1", "Q10O2"];
	
	var c3 = 0;
	
	for(var k=0; k<10; k++)
	{
		if(usrans[k] == crtans[k])
			c3++;
		else
			continue;
	}
	alert("You have answered"+" "+c3+" "+"correct answers");
	window.location.assign('qset4.htm');
	localStorage.value3 = c3;
}

function userans4(form){
	var a = findSelection("Q1");
	var b =	findSelection("Q2");
	var c =	findSelection("Q3");
	var d =	findSelection("Q4");
	var e =	findSelection("Q5");
	var f =	findSelection("Q6");
	var g =	findSelection("Q7");
	var h =	findSelection("Q8");
	var i =	findSelection("Q9");
	var j =	findSelection("Q10");
	
	var usrans = [a, b, c, d, e, f, g, h, i, j];
	
	var crtans = ["Q1O2", "Q2O3", "Q3O4", "Q4O3", "Q5O2", "Q6O4", "Q7O3", "Q8O2", "Q9O3", "Q10O3"];
	
	var c4 = 0;
	
	for(var k=0; k<10; k++)
	{
		if(usrans[k] == crtans[k])
			c4++;
		else
			continue;
	}
	alert("You have answered"+" "+c4+" "+"correct answers");
	window.location.assign('qset5.htm');
	localStorage.value4 = c4;
}

function userans5(form){
	var a = findSelection("Q1");
	var b =	findSelection("Q2");
	var c =	findSelection("Q3");
	var d =	findSelection("Q4");
	var e =	findSelection("Q5");
	var f =	findSelection("Q6");
	var g =	findSelection("Q7");
	var h =	findSelection("Q8");
	var i =	findSelection("Q9");
	var j =	findSelection("Q10");
	
	var usrans = [a, b, c, d, e, f, g, h, i, j];
	
	var crtans = ["Q1O4", "Q2O3", "Q3O4", "Q4O2", "Q5O3", "Q6O1", "Q7O1", "Q8O1", "Q9O2", "Q10O4"];
	
	var c5 = 0;
	
	for(var k=0; k<10; k++)
	{
		if(usrans[k] == crtans[k])
			c5++;
		else
			continue;
	}
	alert("You have answered"+" "+c5+" "+"correct answers");
	window.location.assign('congrates.htm');
	localStorage.value5 = c5;
}

function result(){
	var count1 = str2num(localStorage.value1);
	var count2 = str2num(localStorage.value2);
	var count3 = str2num(localStorage.value3);
	var count4 = str2num(localStorage.value4);
	var count5 = str2num(localStorage.value5);
	var result = $("cng");
	var count = count1+count2+count3+count4+count5;
	result.innerHTML="Your result is"+"</br>Round One : "+count1+"</br>Round Two : "+count2+"</br>Round Three : "+count3+"</br>Round Four : "+count4+"</br>Round Five : "+count5+"</br>Total : "+count;
	displayDate();
}

function str2num(inp){
	switch(inp)
	{
		case '0': return 0; break;
		case '1': return 1; break;
		case '2': return 2; break;
		case '3': return 3; break;
		case '4': return 4; break;
		case '5': return 5; break;
		case '6': return 6; break;
		case '7': return 7; break;
		case '8': return 8; break;
		case '9': return 9; break;
		case '10': return 10; break;
	}
}

function displayDate()
{
	document.getElementById("time").innerHTML=Date();
}

var myVar=setInterval(function(){myTimer()},1000);
function myTimer()
{
	var d=new Date();
	var t=d.toLocaleTimeString();
	document.getElementById("clock").innerHTML=t;
}

//Disable right click script 
//visit http://www.rainbow.arch.scriptmania.com/scripts/ 
var message="Sorry, right-click has been disabled"; 
/////////////////////////////////// 
function clickIE() {if (document.all) {(message);return false;}} 
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) { 
if (e.which==2||e.which==3) {(message);return false;}}} 
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;} 
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;} 
document.oncontextmenu=new Function("return false") 