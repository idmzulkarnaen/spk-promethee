<?php


function antiInjections($string) {
        $string = stripslashes($string);
        $string = strip_tags($string);
        return $string;
    }



function rupiah($uang) {
    $rp = "";
    $digit = strlen($uang);

    while ($digit > 3) {
        $rp = "." . substr($uang, -3) . $rp;
        $lebar = strlen($uang) - 3;
        $uang = substr($uang, 0, $lebar);
        $digit = strlen($uang);
    }
    $rp = $uang . $rp . ",-";
    return "Rp." . $rp;
}


function konvhijriah($tanggal) {

    switch ($hari) {
        case "Monday":
            $harinya = "Senin";
            break;
        case "Tuesday";
            $harinya = "Selasa";
            break;
        case "Wednesday":
            $harinya = "Rabu";
            break;
        case "Thursday":
            $harinya = "Kamis";
            break;
        case "Friday":
            $harinya = "Jum'at";
            break;
        case "Saturday":
            $harinya = "Sabtu";
            break;
        default:
            $harinya = "Minggu";
            break;
    }
    $array_bulan = array("Muharram", "Safar", "Rabiul Awwal", "Rabiul Akhir",
        "Jumadil Awwal", "Jumadil Akhir", "Rajab", "Sya'ban",
        "Ramadhan", "Syawwal", "Zulqaidah", "Zulhijjah");

    $date = makeInt(substr($tanggal, 8, 2));
    $month = makeInt(substr($tanggal, 5, 2));
    $year = makeInt(substr($tanggal, 0, 4));

    if (($year > 1582) || (($year == "1582") && ($month > 10)) || (($year == "1582") && ($month == "10") && ($date > 14))) {
        $jd = makeInt((1461 * ($year + 4800 + makeInt(($month - 14) / 12))) / 4) +
                makeInt((367 * ($month - 2 - 12 * (makeInt(($month - 14) / 12)))) / 12) -
                makeInt((3 * (makeInt(($year + 4900 + makeInt(($month - 14) / 12)) / 100))) / 4) +
                $date - 32075;
    } else {
        $jd = 367 * $year - makeInt((7 * ($year + 5001 + makeInt(($month - 9) / 7))) / 4) +
                makeInt((275 * $month) / 9) + $date + 1729777;
    }

    $wd = $jd % 7;
    $l = $jd - 1948440 + 10632;
    $n = makeInt(($l - 1) / 10631);
    $l = $l - 10631 * $n + 354;
    $z = (makeInt((10985 - $l) / 5316)) * (makeInt((50 * $l) / 17719)) + (makeInt($l / 5670)) * (makeInt((43 * $l) / 15238));
    $l = $l - (makeInt((30 - $z) / 15)) * (makeInt((17719 * $z) / 50)) - (makeInt($z / 16)) * (makeInt((15238 * $z) / 43)) + 29;
    $m = makeInt((24 * $l) / 709);
    $d = $l - makeInt((709 * $m) / 24);
    $y = 30 * $n + $z - 30;

    $g = $m - 1;
    $final = "$d $array_bulan[$g] $y H";

    return $final;
}

function tanggal($tanggal) {

    $array_bulan = array("","Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "Agustus", "September",
        "Oktober", "Nopember", "Desember");
    if(ceil(substr($tanggal, 5, 2))>0){
        $tanggalnya = substr($tanggal, 8, 2);
        $bulannya = $array_bulan[ceil(substr($tanggal, 5, 2)) - 1];
        $tahunnya = substr($tanggal, 0, 4);
        $jamnya = substr($tanggal, 11, 2);
        $menitnya = substr($tanggal, 14, 2);
        $detiknya = substr($tanggal, 17, 2);
        if( $jamnya!=""){
            if($jamnya>13){$jamnya=$jamnya-12; $time = " PM";}else{$time= " AM";}
            $tglsekarang = $tanggalnya . " " . $bulannya . " " . $tahunnya . " " . $jamnya . ":" . $menitnya . $time;
        }else{
            $tglsekarang = $tanggalnya . " " . $bulannya . " " . $tahunnya;
        }

        return $tglsekarang;
    }else{
        return "-";
    }
}

function tgl($tanggal) {

    $tanggalnya = substr($tanggal, 8, 2);
    $bulannya = substr($tanggal, 5, 2);
    $tahunnya = substr($tanggal, 0, 4);
    
    $tglsekarang = $tanggalnya . "-" . $bulannya . "-" . $tahunnya;

    return $tglsekarang;
}

function tanggalnya($tanggal) {
    $tanggalnya = substr($tanggal, 8, 2);
    $tglsekarang = $tanggalnya;
    return $tglsekarang;
}

function bulan($tanggal) {

    $array_bulan = array("Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "Agustus", "September",
        "Oktober", "Nopember", "Desember");

    
    $bulannya = $array_bulan[ceil(substr($tanggal, 5, 2)) - 1];
    $tahunnya = substr($tanggal, 0, 4);
    
    $tglsekarang = $bulannya . " " . $tahunnya;

    return $tglsekarang;
}

function tanggal2($tanggal) {

    $array_bulan = array("Jan", "Feb", "Mar",
        "Apr", "Mei", "Jun",
        "Jul", "Aug", "Sep",
        "Okt", "Nov", "Des");

    $tanggalnya = substr($tanggal, 8, 2);
    $bulannya = $array_bulan[ceil(substr($tanggal, 5, 2)) - 1];
    $tahunnya = substr($tanggal, 0, 4);
    $jamnya = substr($tanggal, 11, 2);
    
    $tglsekarang = $tanggalnya . " " . $bulannya . " " . $tahunnya;

    return $tglsekarang;
}

// fungsi enkripsi base64 dengan key
function encrypt($plain_text, $password="nicecode", $iv_len = 16)
{
$plain_text .= "\x13";
$n = strlen($plain_text);
if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
$i = 0;
$enc_text = $iv_len;
$iv = substr($password ^ $enc_text, 0, 512);
while ($i < $n) {
$block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
$enc_text .= $block;
$iv = substr($block . $iv, 0, 512) ^ $password;
$i += 16;
}
$hasil=base64_encode($enc_text);
$hasil=str_replace('=', '1', $hasil);
return str_replace('+', '2', $hasil);
}
 
// fungsi base64 decrypt
// untuk mendekripsi string base64
function decrypt($enc_text, $password="nicecode", $iv_len = 16)
{
$enc_text = str_replace('@', '+', $enc_text);
$enc_text = base64_decode($enc_text);
$n = strlen($enc_text);
$i = $iv_len;
$plain_text = '';
$iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
while ($i < $n) {
$block = substr($enc_text, $i, 16);
$plain_text .= $block ^ pack('H*', md5($iv));
$iv = substr($block . $iv, 0, 512) ^ $password;
$i += 16;
}
return preg_replace('/\\x13\\x00*$/', '', $plain_text);
}
 
function get_rnd_iv($iv_len)
{
$iv = '';
while ($iv_len-- > 0) {
$iv .= chr(mt_rand() & 0xff);
}
return $iv;
}

function lihatprofil($priv, $institusi, $status, $profil){
    
    if($priv == "Edurace Users" and $_SESSION['iduser'] != null){
        return $profil;
    }
    elseif($priv == "School" and $institusi == $_SESSION['INSTITUSI_ID']){
        return $profil;
    }
    elseif($priv == "Friends" and $status == "1"){
        return $profil;
    }
    else{
        return "None";
    }
}

function access_code(){
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWYZ0123456789";
    $code = substr( str_shuffle( $chars ), 0, 5 )."-".substr( str_shuffle( $chars ), 4, 5 );
    return $code;
}

function timeAgo($past, $tpast="", $now = "now") {

    // sets the default timezone
    //date_default_timezone_set($this->timezone);
    // finds the past in datetime
    IF($tpast!=""){
        $past = strtotime($past." ".$tpast);
    }else{
        $past = strtotime($past);
    }
    $yr = date('Y', $past);
    // finds the current datetime
    $now = strtotime($now);
    $yrnow = date('Y', $now);

    
    // creates the "time ago" string. This always starts with an "about..."
    $timeAgo = "";
    
    // finds the time difference
    $timeDifference = $now - $past;
    
    // rule 1
    // less than 29secs
    if($timeDifference <= 60) {
      $timeAgo = "1 min";
    }
    // rule 2
    // more than 29secs and less than 1min29secss
    else if($timeDifference > 30 && $timeDifference < 3600) {
        $mnt = floor($timeDifference/60);
      $timeAgo = $mnt." mins";
    }
    else if($timeDifference ==3600) {
        
      $timeAgo = "1 hr";
    }
    // rule 3
    // between 1min30secs and 44mins29secs
    else if($timeDifference >= 3600 &&
      $timeDifference <= (3600 * 24)
    ) {
      $hr = floor($timeDifference/3600);
      $timeAgo = $hr." hrs";
    }
    else if($timeDifference > ( 3600 * 24) &&
      $timeDifference <= (3600 * 24 * 2)
    ) {
      $timeAgo = "yesterday at ".date('H:i',$past);
    }

    else if($timeDifference > (3600 * 24 * 2)
 &&
      $timeDifference <= (3600 * 24 * 7)
    ) {
      $timeAgo = date('l H:i', $past);
    }
    // rule 4
    // between 44mins30secs and 1hour29mins59secs
    else if($timeDifference > (3600 * 24 * 7) && $yr == $yrnow)
    {
      $timeAgo = date('M d',$past)." at ".date('H:i',$past);
    }

    else
    {
      $timeAgo = date('M d Y',$past)." at ".date('H:i',$past);
    }
    

    return $timeAgo;
  }

/*
function ubahtgl($tanggal){
        $b = explode(" ", $tanggal);
        $c = explode(",", $b[1]);

        if ($c[0]=="January") {
            $bulan = 01;
        } else if ($c[0]=="February") {
            $bulan = 02;
        } else if ($c[0]=="March") {
            $bulan = 03;
        } else if ($c[0]=="April") {
            $bulan = 04;
        } else if ($c[0]=="Mei") {
            $bulan = 05;
        } else if ($c[0]=="June") {
            $bulan = 06;
        } else if ($c[0]=="July") {
            $bulan = 07;
        } else if ($c[0]=="August") {
            $bulan = 08;
        } else if ($c[0]=="September") {
            $bulan = 09;
        } else if ($c[0]=="October") {
            $bulan = 10;
        } else if ($c[0]=="November") {
            $bulan = 11;
        } else if ($c[0]=="December") {
            $bulan = 12;
        }
        
        return $b[2]."-".$bulan."-".$b[0];
    }
    */

    function DateEng($date="0000-00-00") { // fungsi atau method untuk mengubah tanggal ke format indonesia
       // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
            $month = array("January", "February", "March",
                               "April", "May", "June",
                               "July", "August", "September",
                               "October", "November", "December");
        
            $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
            $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
            $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
            
            $result = $month[(int)$bulan-1]." ".$tgl.", ".$tahun;
            return($result);
    }

    function DateEng2($date="0000-00-00") { // fungsi atau method untuk mengubah tanggal ke format indonesia
       // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
            $month = array("January", "February", "March",
                               "April", "May", "June",
                               "July", "August", "September",
                               "October", "November", "December");
        
            $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
            $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
            $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
            
            $result = $tgl." ".$month[(int)$bulan-1].", ".$tahun;
            return($result);
    }

    

?>
