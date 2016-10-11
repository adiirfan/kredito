<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tanggal extends CI_Model {
	 
	
	
function validasitanggal ($tanggal) {
    list($thn,$bln,$tgl) = explode("-",$tanggal);
    $thn = (int) $thn;
    $bln = (int) $bln;
    $tgl = (int) $tgl;
    $ts = mktime(1,1,1,$bln,$tgl,$thn);
    $hasil = date("Y-n-j",$ts);
    list($thn2,$bln2,$tgl2) = explode("-",$hasil);
    $thn2 = (int) $thn2;
    $bln2 = (int) $bln2;
    $tgl2 = (int) $tgl2;
    if ($tgl == $tgl2 && $bln == $bln2 && $thn == $thn2) {
        return true;
    } else {
        return false;
    }
}

 function replacebulan($bulan) {
        $bulan-=1;
        $array = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $intBulan = intVal($bulan);
        $result = $array[$intBulan];
        return $result;
    }

     function formatDate($input) {
        if (empty($input)) {
            $tanggal = "-";
        } else {
            sscanf($input, '%d-%d-%d', $y, $m, $d);
            $bulan = $this->model_tanggal->getBulan($m);
            $tanggal = $d . " " . $bulan . " " . $y;
        }

        return $tanggal;
    }
     function formatDateTime($input) {
        if (empty($input)) {
            $tanggal = "-";
        } else {
            sscanf($input, '%d-%d-%d %d:%d:%d', $y, $m, $d, $h, $i, $s);
            $bulan = getBln($m);
            
            $h = normalDigit($h);
            $i = normalDigit($i);
            $s = normalDigit($s);
            
            $tanggal = $d . " " . $bulan . " " . $y. " - ".$h.":".$i.":".$s."";
        }

        return $tanggal;
    }
    
     function formatTime($input) {
        if (empty($input)) {
            $tanggal = "-"; 
        } else {
            sscanf($input, '%d-%d-%d %d:%d:%d', $y, $m, $d, $h, $i, $s);
            
            $h = normalDigit($h);
            $i = normalDigit($i);
            
            //$tanggal = $h.":".$i."";
            $tanggal = "$h:$i";
        }

        return $tanggal;
    }

     function fieldDate($input) {
        sscanf($input, '%d-%d-%d', $y, $m, $d);
        $tanggal = $d . "/" . $m . "/" . $y;
        return $tanggal;
    }

     function sqlDate($input) {
        sscanf($input, '%d-%d-%d', $d, $m, $y);
        $tanggal = $y . "-" . $m . "-" . $d;
        return $tanggal;
    }

     function sqlDateDot($input) {
        sscanf($input, '%d.%d.%d', $d, $m, $y);
        $tanggal = $y . "-" . $m . "-" . $d;
        return $tanggal;
    }

     function tgl_indo($tgl) {
        $tanggal = substr($tgl, 8, 2);
        $bulan = getBln(substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }

     function getBulan($bln) {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }

     function getBln($bln) {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Agust";
                break;
            case 9:
                return "Sept";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }        
}

    function normalDigit($d) {
        switch ($d) {
            case 0:
                return "00";
                break;
            case 1:
                return "01";
                break;
            case 2:
                return "02";
                break;
            case 3:
                return "03";
                break;
            case 4:
                return "04";
                break;
            case 5:
                return "05";
                break;
            case 6:
                return "06";
                break;
            case 7:
                return "07";
                break;
            case 8:
                return "08";
                break;
            case 9:
                return "09";
                break;
            default :
                return $d;
        }
        
    }
    
    
     function getHari($h) {
        switch ($h) {
            case 'Mon':
                return "Senin";
                break;
            
            case 'Tue':
                return "Selasa";
                break;
            
            case 'Wed':
                return "Rabu";
                break;
            
            case 'Thu':
                return "Kamis";
                break;
            
            case 'Fri':
                return "Jumat";
                break;
            
            case 'Sat':
                return "Sabtu";
                break;
            
            case 'Sun':
                return "Minggu";
                break;
            
           default :
                return $h;
        }
    

 

}

function pilihan_tanggal($nama_tg, $nama_bl, $nama_th,
    $th_awal, $th_akhir,
    $tg_bawaan, $bl_bawaan, $th_bawaan)
{
	echo '<div class="row"><div class="col-xs-12 col-md-3" style="padding-left:0px;">';
	$NAMA_BULAN = array ("","Januari", "Pebruari", "Maret", 
                     "April","Mei","Juni",
	                 "Juli","Agustus","September", 
			  	     "Oktober", "November", "Desember");
   //global $NAMA_BULAN;
	print("");				
   // Tanggal
   print("<select  class=\"form-control search-select\" required=\"required\" name=\"$nama_tg\">\n");
	 print("<option value=\"\" >  </option>\n");
   $ada_selected = FALSE;
   for ($tg=1; $tg <= 31; $tg++)
   {
      if ($tg_bawaan == $tg)
	  {
         $selected = "selected";
	     $ada_selected = TRUE;  
	  }   
	  else
	     $selected = "";  
		  
      print("<option value=\"$tg\" $selected>$tg</option>\n");
		
   }
print("</select>"); 
  
	
   if ($ada_selected == FALSE)
	  print("<option value=\"0\" selected></option>\n");

   print("</select>\n");
	echo '</div>';
   // Bulan
   echo '<div class="col-xs-12 col-md-5" style="padding-left:0px;">';
   print("<select class=\"form-control search-select\"  required=\"required\" name=\"$nama_bl\">\n");
	
   $ada_selected = FALSE;
   for ($bl=1; $bl <= 12; $bl++)
   {
      if ($bl_bawaan == $bl)
	  {
	     $selected = "selected";
		 $ada_selected = TRUE;
	  }  
	  else
	     $selected = "";  
		  
      print("<option value=\"$bl\" $selected>$NAMA_BULAN[$bl]</option>\n");
   }		
	
   if ($ada_selected == FALSE)
	  print("<option value=\"0\" selected></option>\n");

   print("</select>\n");	
   echo '</div>';
   
   // Tahun
   echo '<div class="col-xs-12 col-md-4" style="padding-left:0px;">';
   print("<select  class=\"form-control search-select\" required=\"required\" name=\"$nama_th\">\n");
	
   $ada_selected = FALSE;
   for ($th=$th_awal; $th <= $th_akhir; $th++)
   {
      if ($th_bawaan == $th)
	  {
	     $selected = "selected";
         $ada_selected = TRUE;
	  }   
	  else
	     $selected = "";  
		  
      print("<option value=\"$th\" $selected>$th</option>\n");
   }		
	
   if ($ada_selected == FALSE)
      print("<option value=\"0\" selected></option>\n");

   print("</select>\n");
   print("");
   echo '</div>';
   echo '</div>';
}

function my_ke_tgl($tanggal)
// Mengubah format yyyy-mm-dd (format MYSQL) 
//          menjadi dd/mm/yyyy
{
   $y = substr($tanggal,0,4);
   $m = substr($tanggal,5,2);
   $d = substr($tanggal,8,2);
   
   return "$d/$m/$y";
}

function my_ke_tgl2($tanggal)
// Mengubah format yyyy-mm-dd (format MYSQL) 
//          menjadi dd  nama_bulan yyyy
{
   global $NAMA_BULAN;
   
   $y = (integer) substr($tanggal,0,4);
   $m = (integer) substr($tanggal,5,2);
   $d = (integer) substr($tanggal,8,2);
   
   return "$d $NAMA_BULAN[$m] $y";
}

function tgl_ke_my($tg, $bl, $th)
{
   $y = (int) $th;
   $m = (int) $bl;
   $d = (int) $tg;
   
   return sprintf("%04d-%02d-%02d", $y, $m, $d);
}




}
