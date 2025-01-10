<?php
// ThaiCreate.Com By @W_IN //

date_default_timezone_set("Asia/Bangkok"); 
$date = date("l"); 

switch($date) 
{
case "Monday":
$printdate = "จันทร์ที่";
$printdate1 = "";
break;
case "Tuesday":
$printdate = "อังคารที่";
$printdate1 = "";
break;
case "Wednesday":
$printdate = "พุธที่";
$printdate1 = "";
break;
case "Thursday":
$printdate = "พฤหัสบดีที่";
$printdate1 = "";
break;
case "Friday":
$printdate = "ศุกร์ที่";
$printdate1 = "";
break;
case "Saturday":
$printdate = "เสาร์ที่";
$printdate1 = "";
break;
case "Sunday":
$printdate = "อาทิตย์ที่";
$printdate1 = "";
break;
}

$month = date("n"); 

switch($month)
{
case "1":
$printmonth = "เดือน มกราคม พ.ศ.";
$printmonth1 = "01";
$printmonth2 = "JAN";
break;
case "2":
$printmonth = "เดือน กุมภาพันธ์ พ.ศ.";
$printmonth1 = "02";
$printmonth2 = "FEB";
break;
case "3":
$printmonth = "เดือน มีนาคม พ.ศ.";
$printmonth1 = "03";
$printmonth2 = "MAR";
break;
case "4":
$printmonth = "เดือน เมษายน พ.ศ.";
$printmonth1 = "04";
$printmonth2 = "APR";
break;
case "5":
$printmonth = "พฤษภาคม พ.ศ.";
$printmonth1 = "05";
$printmonth2 = "MAY";
break;
case "6":
$printmonth = "เดือน มิถุนายน พ.ศ.";
$printmonth1 = "06";
$printmonth2 = "JUNE";
break;
case "7":
$printmonth = "เดือน กรกฎาคม พ.ศ.";
$printmonth1 = "07";
$printmonth2 = "JULY";
break;
case "8":
$printmonth = "เดือน สิงหาคม พ.ศ.";
$printmonth1 = "08";
$printmonth2 = "AUG";
break;
case "9":
$printmonth = "เดือน กันยายน พ.ศ.";
$printmonth1 = "09";
$printmonth2 = "SEPT";
break;
case "10":
$printmonth = "เดือน ตุลาคม พ.ศ.";
$printmonth1 = "10";
$printmonth2 = "OCT";
break;
case "11":
$printmonth = "เดือน พฤศจิกายน พ.ศ.";
$printmonth1 = "11";
$printmonth2 = "NOV";
break;
case "12":
$printmonth = "เดือน ธันวาคม พ.ศ.";
$printmonth1 = "12";
$printmonth2 = "DEC";
break;
}

$edate = "$printdate ".date("j")." $printmonth ".(date("Y"))."";
$edateadd = date("j")." $printmonth2 ".(date("Y"))."";
$e_date = date("j")."-$printmonth2-".(date("Y"))."";
$etime = strftime("| %H:%M");
$eIP = getenv("REMOTE_ADDR");
$itime = strftime("%H%M");
$iddate = date("j");
$idyear = date("Y");
$idyears = substr($idyear,2,4);
$seqid= $iddate."$itime";
$randid = $iddate."$printmonth1".$idyears;
$rand_id = "$randid$itime";

?>