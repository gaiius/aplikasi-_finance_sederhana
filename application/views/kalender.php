<html>
<head>

<script language="javascript" type="text/javascript">
/*blocker*/
if(window.opener==null)
{
window.location="index.php";
}
/*--------*/
</script>

</head>
<body>
<center>

<div id="kalender"></div>
</center>
<script type="text/javascript" language="javascript">
<!--
var array_day=["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
var array_month=["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
var date;
var year;
var month;
var day;
var go_year;
var go_month;
var fulldate;
var isi;
var now_date=new Date();
var now_day=now_date.getDate();
var now_month=now_date.getMonth();
var now_year=now_date.getYear();
var url=document.location.href;
var tgt=url.lastIndexOf("tgt=");
tgt=url.slice(tgt+4);
tgt=window.opener.document.getElementById(tgt);
now();
/*now*/
function now()
{
date=new Date();
calendar(date);
}
/*--------*/
/*newdate*/
function newdate()
{
go_month=document.getElementById("sel_month");
date=new Date(go_year,go_month.value);
return calendar(date);
}
/*--------*/
/*calendar*/
function calendar(date)
{
year=date.getFullYear();
month=date.getMonth();
day=date.getDate();
isi="<form>";
isi+="<table align='center' border=1 cellpadding=3 cellspacing=0>";
/**baris 1 (menu2 perintah)**/
isi+="<tr>";
isi+="<td colspan='7' align='center'>";
/*today button*/
isi+="<input type='button' name='today' value='Today' onClick='now();' /> ";
/*--------*/
/*select month*/
date.setDate(1);
isi+="<select name='sel_month' id='sel_month'>";
for(i=0;i<10;i++)
{
if(i==month)
{var selected="selected='selected'";}
else{selected="";}
isi+="<option value=\"0"+i+"\" "+selected+">"+array_month[i]+"</option>";
}
for(i=10;i<12;i++)
{
if(i==month)
{var selected="selected='selected'";}
else{selected="";}
isi+="<option value=\""+i+"\" "+selected+">"+array_month[i]+"</option>";
}
isi+="</select> ";
/*--------*/
/*decrease tahun*/
go_year=year;
isi+="<input type='button' name='year_down' value='<' onClick=\"go_year=document.getElementById('sel_year').value-1; document.getElementById('sel_year').value=go_year;\" /> ";
/*--------*/
/*output tahun*/
if(go_year==year)
{go_year=year;}
else{go_year=go_year;}
isi+="<input type='text' name='sel_year' id='sel_year' value='"+go_year+"' size='3' disabled='disabled' /> ";
/*--------*/
/*increase tahun*/
isi+="<input type='button' name='year_up' value='>' onClick=\"go_year=document.getElementById('sel_year').value-1+2; document.getElementById('sel_year').value=go_year;\" /> ";
/*--------*/
/*go button*/
isi+="<input type='button' name='go' id='go' value='Go' onClick=\"newdate();\" />";
/*--------*/
isi+="</td>";
isi+="</tr>";
/**--------**/
/*baris 2 (bulan, tahun)*/
isi+="<tr>";
isi+="<td colspan=7 align='center'><b>"+ array_month[month]+", "+year+"</b></td>";
isi+="</tr>";
/*--------*/
/*baris 3 (header hari)*/
isi+="<tr bgcolor='#00CCFF'>";
for(i=0;i<7;i++)
{
isi+="<td align='center'>"+array_day[i]+"</td>";
}
isi+="</tr>";
/*--------*/
/**baris kalender**/
/*cell tanpa tanggal bagian atas*/
if(date.getDay()!=0)
{
isi+="<tr>";
for(i=0;i<date.getDay();i++)
{
isi+="<td>&nbsp;</td>";
}
}
/*--------*/
/*cell yang ada tanggalnya*/
while(date.getMonth()==month)
{
fulldate=year+"-"+(month+1);
if(date.getDay==0)
{
isi+="<tr>";
}
/*hari ini*/
if(date.getDate()==now_day && date.getMonth()==now_month && date.getYear()==now_year)
{
isi+="<td align='center' bgcolor='#00FF00'><b><a href='#' onClick=\"tgt.value=fulldate+'-'\+"+date.getDate()+"; window.close();\">"+date.getDate()+"</a></b></td>";
}
/*--------*/
/**hari lain**/
else
{
/*minggu+sabtu*/
if(date.getDay()==0 || date.getDay()==6)
{var bgcolor="bgcolor='#FEC281'";}
/*--------*/
/*hari biasa*/
else{bgcolor="";}
/*--------*/
isi+="<td align='center' "+bgcolor+"><a href='#' onClick=\"tgt.value=fulldate+'-'\+"+date.getDate()+"; window.close();\">"+date.getDate()+"</a></td>";
}
/**--------**/
if(date.getDay()==6)
{
isi+="</tr>";
}
date.setDate(date.getDate()+1);
}
/*--------*/
/*cell tanpa tanggal bagian bawah*/
for(i=date.getDay();i<=6;i++)
{
isi+="<td>&nbsp;</td>";
}
/*--------*/
isi+="</table>";
isi+="</form>";
/**--------**/
document.getElementById("kalender").innerHTML=isi;
}
$(function() { 

$("#kalender").datepicker({dateFormat: 'yy-mm-dd'});

});
/*--------*/
//-->
</script>
</body>
</html>