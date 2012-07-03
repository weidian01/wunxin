// JavaScript Document

function showbox(a){
	if(a=="blt1"){
		document.getElementById(a).style.display="";
		document.getElementById("blt2").style.display="none";
		document.getElementById("bullt1").className="curr";
		document.getElementById("bullt2").className=""
		
		}
		else{
			document.getElementById(a).style.display="";
		document.getElementById("blt1").style.display="none";
		document.getElementById("bullt2").className="curr";
		document.getElementById("bullt1").className=""
			}
	}
function showAD(a,id){
	
	for(var i=1;i<4;i++)
	{document.getElementById(a+i).style.display="none";}
	document.getElementById(a+id).style.display="";
	}
function showcart(a){
 document.getElementById(a).style.display="";
	}
	function disshowcart(a){
 document.getElementById(a).style.display="none";
	}
function showmask(id,a){
 for(var i=1;i<7;i++)
{
	document.getElementById(a+i).className="picm";
	}
	document.getElementById(a+id).className="picm2";
	}
	function disshowmask(a){
 for(var i=1;i<7;i++)
{
	document.getElementById(a+i).className="picm2";
	}
	}
	function showqz(id,a){
 for(var i=1;i<8;i++)
{
	document.getElementById(a+i).className="picm";
	}
	document.getElementById(a+id).className="picm2";
	}
	function disshowqz(a){
 for(var i=1;i<8;i++)
{
	document.getElementById(a+i).className="picm2";
	}
	}
	function showbrandpic(id,a){
 for(var i=1;i<13;i++)
{
	document.getElementById(a+i).className="picm";
	}
	document.getElementById(a+id).className="picm2";
	}
	function disshowbrandpic(a){
 for(var i=1;i<13;i++)
{
	document.getElementById(a+i).className="picm2";
	}
	}
	