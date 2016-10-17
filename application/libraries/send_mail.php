<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
//class Send_mail extends CI_Controller {
class Send_mail {
    // property declaration
    //public $sendstatus = "";

    //administrator
    public function new_admin_to_user($sys_user_id) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_sys_user');
        $row = $ci->model_sys_user->get($sys_user_id);

		$lMessage = 
            "Hai ".$row->full_name.",".
            "<BR><BR>".
			"Terima kasih telah mendaftar mendaftar di Kredito.id.".
			"Akun Anda hampir siap ! Anda hanya selangkah lagi mengakses akun Rajakredit Anda. ".
            "<BR><BR>".
            "Silahkan klik link tersebut untuk memverivikasi akun anda, <a target='_blank' href='".base_url()."admin/activation/".$row->dynamic_code."'>Klik disini</a>.<BR>".
            "<BR>".
            "Jika link tersebut tisak bekerja, maka anda dapat menyalin link ini ke browser web Anda<BR>".
            "<a target='_blank' href='".base_url()."admin/activation/".$row->dynamic_code."'>".base_url()."admin/activation/".$row->dynamic_code."</a>.<BR>";
        
        $subject = 'Selamat datang Rajakredit Administrator - akun anda telah diaktifkan';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row->email, $subject, $message);
    }

    //administrator
    public function request_password_to_user($email) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_sys_user');
        $row = $ci->model_sys_user->get_by_email($email);

        $lMessage = 
            "To initiate the password reset process for your ".$row->email." ".APP_NAME." Administrator Account, click the link below:".
            "<BR>" .
            "<a target='_blank' href='".base_url()."admin/reset_password/".$row->dynamic_code."'>".base_url()."securty/reset_password/".$row->dynamic_code."</a>".
            "<BR><BR>".
            "If clicking the link above doesn't work, please copy and paste the URL in a new browser window instead.".
            "<BR><BR>".
            "If you've received this mail in error, it's likely that another user entered your email address by mistake while trying to reset a password. ".
            "If you didn't initiate the request, you don't need to take any further action and can safely disregard this email.";
        
        $subject = APP_NAME.' Administrator: Password Assistance';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row->email, $subject, $message);
    }

    //web
    public function new_registration_to_user($user_id) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_user');
        $row = $ci->model_user->get($user_id);

        $lMessage = 
            "Hi ".$row->full_name.",".
            "<BR><BR>".
          	"Terima kasih telah mendaftar mendaftar di Kredito.id.".
			"Akun Anda hampir siap ! Anda hanya selangkah lagi mengakses akun Rajakredit Anda. ".
            "<BR><BR>".
           "Silahkan klik link tersebut untuk memverivikasi akun anda, <a target='_blank' href='".base_url()."security/activation/".$row->dynamic_code."'>Aktifkan disini</a>.<BR>".
            "<BR>".
            "Jika link tersebut tisak bekerja, maka anda dapat menyalin link ini ke browser web Anda<BR>".
            "<a target='_blank' href='".base_url()."security/activation/".$row->dynamic_code."'>".base_url()."security/activation/".$row->dynamic_code."</a>.<BR>";
        
        $subject = 'Selamat datang di Kredito.id - Akun anda sudah dibuat';
        $message = $lEmailHeader.$lMessage.$lEmailFooter; 
        $this->send($row->email, $subject, $message);
    }
	public function new_loan_to_user($loan_id) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

       	$ci->load->model('model_loan');
        $row = $ci->model_loan->get($loan_id);

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($row->user_id);
		
	
		
		$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Pengajuan peminjaman anda telah kami terima. Nomor referensi pinjaman anda adalah <b>".$row->loan_code."</b>".
              
                "<BR><BR>".
                "Kami akan memproses pinjaman anda paling lambat 3 hari kerja".
                "<BR><BR>".
                "Silahkan klik link ini untuk <a target='_blank' href='".base_url()."security/activation/".$row_user->dynamic_code."'>Aktifkan akun anda</a>.<BR>".
                "<BR>".
                 "Jika link tersebut tisak bekerja, maka anda dapat menyalin link ini ke browser web Anda<BR>".
                "<a target='_blank' href='".base_url()."security/activation/".$row_user->dynamic_code."'>".base_url()."security/activation/".$row_user->dynamic_code."</a>.<BR>";
        
        $subject = 'Selama datang di Kredito.id - akun anda telah dibuat';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }
	
	public function multiple_loan_to_user($user_id,$code_loan,$email,$new=null) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

       	$ci->load->model('model_loan');
		$row = $ci->model_loan->get_product_by_code($code_loan,1);
		
       // $product = $ci->model_loan->get_loan_product_by_code($code_loan);
		if($user_id == null){
			$user_id=$row->user_id;
		}
        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($user_id);
		
	
		if($new == 0){
		$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Pengajuan peminjaman anda telah kami terima. Nomor referensi pinjaman anda adalah <b>".$row->loan_code."</b>".
              
                "<BR><BR>".
                "Kami akan memproses pinjaman anda paling lambat 3 hari kerja";
                
        
        $subject = 'Selama datang di Kredito.id - pengajuan anda berhasil telah kami terima';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
		}else if($new == 1){
			$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Pengajuan peminjaman anda telah kami terima. Nomor referensi pinjaman anda adalah <b>".$row->loan_code."</b>".
              
                "<BR><BR>".
                "Kami akan memproses pinjaman anda paling lambat 3 hari kerja.Silahkan login untuk melihat detail status pengajuan anda";
                
        
        $subject = 'Selama datang di Kredito.id - pengajuan anda berhasil telah kami terima';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
		}else{
			
			$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Pengajuan peminjaman anda telah kami terima. Nomor referensi pinjaman anda adalah <b>".$row->loan_code."</b>".
              
                "<BR><BR>".
                "Kami akan memproses pinjaman anda paling lambat 3 hari kerja".
                "<BR><BR>".
                "Silahkan klik link ini untuk <a target='_blank' href='".base_url()."security/activation/".$row_user->dynamic_code."'>Aktifkan akun anda</a>.<BR>".
                "<BR>".
                 "Jika link tersebut tisak bekerja, maka anda dapat menyalin link ini ke browser web Anda<BR>".
                "<a target='_blank' href='".base_url()."security/activation/".$row_user->dynamic_code."'>".base_url()."security/activation/".$row_user->dynamic_code."</a>.<BR>";
        
        $subject = 'Selama datang di Kredito.id - akun anda telah dibuat';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
			
		}
    }
	
	
	 public function new_loan_to_olduser($loan_id) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

       	$ci->load->model('model_loan');
        $row = $ci->model_loan->get_product($loan_id);

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($row->user_id);
		
	
		
		$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Pengajuan pinjaman anda telah kami terima. Nomor referensi pengajuan pinjaman anda adalah  <b>".$row->loan_code."</b>".
                "<BR><BR>".
                "Kami akan memproses pengajuan pinjaman anda paling lambat 3 hari kerja setelah anda melakukan pengajuan ini".
                "<BR><BR>".
                "<a target='_blank' href='".base_url()."'>Log in  Rajakredit.com untuk melihat status peminjaman anda</a>.<BR>".
                "<BR>".
                "Jika link tersebut tisak bekerja, maka anda dapat menyalin link ini ke browser web Anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        
        
        $subject = 'Kredito.id - Pengajuan pinjaman anda telah kami terima';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }

	public function new_loan_to_olduser_not_login($loan_id,$email) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

       	$ci->load->model('model_loan');
        $row = $ci->model_loan->get_product($loan_id);

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get_by_email_2($email);
		
	
		
		$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Pengajuan pinjaman anda telah kami terima. Nomor referensi pengajuan pinjaman anda adalah  <b>".$row->loan_code."</b>".
                "<BR><BR>".
                "Kami akan memproses pengajuan pinjaman anda paling lambat 3 hari kerja setelah anda melakukan pengajuan ini".
                "<BR><BR>".
                "<a target='_blank' href='".base_url()."'>Log in  Rajakredit.com untuk melihat status peminjaman anda</a>.<BR>".
                "<BR>".
                "Jika link tersebut tisak bekerja, maka anda dapat menyalin link ini ke browser web Anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        
        
        $subject = 'Kredito.id - Pengajuan pinjaman anda telah kami terima';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }
	
    public function request_password_to_web_user($email) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_user');
        $row = $ci->model_user->get_by_email($email);

        if ($row == false)
        {
            //
        }
        else
        {
            $lMessage = 
                "Untuk mengubah password akun rajakredit dari email ".$row->email." , silahkan klik link tersebut".
                "<BR>" .
                "<a target='_blank' href='".base_url()."security/forgot_my_password_reset/".$row->dynamic_code."'>".base_url()."security/forgot_my_password_reset/".$row->dynamic_code."</a>".
                "<BR><BR>".
                "Abaikan email ini jika anda tidak merasa ingin merubah password anda";
            
            $subject = 'Kredito.id: Permintaan ubah password';
            $message = $lEmailHeader.$lMessage.$lEmailFooter;
            $this->send($row->email, $subject, $message); 
        }
        
    }

    //borrower
    public function new_loan_request_to_borrower($loan_id) 
    {
        //Should not get cookie in this function, because need to send email to newly subscribe Borrower who is still inactive.
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_loan');
        $row = $ci->model_loan->get_loan($loan_id);

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($row->borrower_id);

        if (get_cookie("user_id") == "")
        {
            $lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
                "Pengajuan pinjaman anda telah kami terima. Nomor referensi pengajuan pinjaman anda adalah <b>".$row->code."</b>".
                "<BR><BR>".
                "Kami akan memproses pengajuan pinjaman anda paling lambat 3 hari kerja setelah anda melakukan pengajuan ini".
                "<BR><BR>".
                "Silahkan klik link tersebut untuk mengaktifkan akun anda. <a target='_blank' href='".base_url()."security/activation/".$row_user->dynamic_code."'>klik untuk aktifkan akun anda</a>.<BR>".
                "<BR>".
                "Jika link tersebut tisak bekerja, maka anda dapat menyalin link ini ke browser web Anda<BR>".
                "<a target='_blank' href='".base_url()."security/activation/".$row_user->dynamic_code."'>".base_url()."security/activation/".$row_user->dynamic_code."</a>.<BR>";
        }
        else
        {
            $lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
                "Pengajuan pinjaman anda telah kami terima. Nomor referensi pengajuan pinjaman anda adalah <b>".$row->code."</b>".
                "<BR><BR>".
                "Kami akan memproses pengajuan pinjaman anda paling lambat 3 hari kerja setelah anda melakukan pengajuan ini".
                "<BR><BR>".
                "<a target='_blank' href='".base_url()."'>Log in untuk melihat status pinjaman anda</a>.<BR>".
                "<BR>".
                 "Jika link tersebut tisak bekerja, maka anda dapat menyalin link ini ke browser web Anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        }
        
        
        $subject = 'RajaKredit.co.id - Pengajuan pinjaman anda telah kami terima';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }

    public function new_loan_request_to_admin($loan_id) 
    {
        $ci = get_instance();
        
        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_loan');
        $row = $ci->model_loan->get_loan($loan_id);

        $lMessage = 
            "<u>New loan request</u><BR><BR>".
            "Reference number: <b>".$row->code."</b><BR>".
            "Name: ".$row->b_full_name."<BR>".
            "Email: ".$row->b_email."<BR>".
            "Phone: ".$row->b_mobile_phone."<BR>".
            "Company: ".$row->b_company_name."<BR>".
            "Submitted Date: ".$row->created_date."<BR><BR>".
            "Loan Amount: MYR ".number_format($row->amount, 2)."<BR>".
            "Period: ".$row->period." months<BR>";
        
        $subject = APP_NAME.' - new loan request ('.$row->code.')';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;

        $param["status"] = 1;
        $ci->load->model('model_sys_user_group');
        $result_group = $ci->model_sys_user_group->listing($param);

        $param2["status"] = 1;
        $ci->load->model('model_sys_user');
        foreach ($result_group as $row_group)
        {
            $result_user = $ci->model_sys_user->listing($param2);
            foreach ($result_user as $row_user)
            {
                if ($row_user->sys_user_group_id == $row_group->sys_user_group_id && $row_group->loan_request_notification == 1)
                {
                    $this->send($row_user->email, $subject, $message);
                }
            }
        }
    }
	
	public function status_pinjaman($status,$user_id,$kode) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($user_id);
		
		if($status == 4){
			$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Pinjaman anda dengan nomor referensi <b>".$kode."</b> telah di verifikasi<BR>".
                "<BR><BR>".
                "Silahkan hubungi tim RajaKredit untuk informasi lebih lanjut".
                "<BR><BR>".
             
                "<BR>".
                "Silahkan login untuk melihat status pinjaman anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        $subject = 'Kredito.id - Pinjaman anda telah di verifikasi';
		} else if($status == 7){
			$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Pinjaman anda dengan nomor referensi <b>".$kode."</b> sedang dalam proses pencairan dana<BR>".
                "<BR><BR>".
				"Proses pencairan dana paling lambat 2 hari kerja".
				 "<BR><BR>".
                "Silahkan hubungi tim RajaKredit untuk informasi lebih lanjut".
                "<BR><BR>".
             
                "<BR>".
                "Silahkan login untuk melihat status pinjaman anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        $subject = 'Kredito.id - Pinjaman anda telah di verifikasi';
		}else if($status == 5){
			$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Mohon maaf, pinjaman anda dengan nomor referensi <b>".$kode."</b> ditolak<BR>".
                "<BR><BR>".
				"Tim analis keuangan kami menyatakan pinjaman anda belum memenuhi syarat".
				 "<BR><BR>".
                "Silahkan hubungi tim RajaKredit untuk informasi lebih lanjut".
                "<BR><BR>".
             
                "<BR>".
                "Silahkan login untuk melihat status pinjaman anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        $subject = 'Kredito.id - Pinjaman anda ditolak';
		}
		else if($status == 8){
			$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Selamat, dana pinjaman anda dengan nomor referensi <b>".$kode."</b> telah di cairkan<BR>".
                "<BR><BR>".
				"Tim analis keuangan kami menyatakan pinjaman anda belum memenuhi syarat".
				 "<BR><BR>".
                "Silahkan hubungi tim RajaKredit untuk informasi lebih lanjut".
                "<BR><BR>".
             
                "<BR>".
                "Silahkan login untuk melihat status pinjaman anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        $subject = 'Kredito.id - Pinjaman anda ditolak';
		}
		
		
		
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }

	
	public function status_pinjaman_refinance($status,$kode,$refinance) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

       // $ci->load->model('model_user');
       // $row_user = $ci->model_user->get($user_id);
		
		 $ci->load->model('model_loan');
        $row_user = $ci->model_loan->get_product_by_code($kode);
		
		if($status == 3){
			$lMessage = 
                "Hi ".$row_user->loan_name.",".
                "<BR><BR>".
				"Pengajuan pinjaman ".$refinance." dengan nomor referensi <b>".$kode."</b> sedang dalam proses<BR>".
                "<BR><BR>".
                "Kami akan menghubungi anda kembali paling lambat 2 hari kerja".
                "<BR><BR>".
             
                "<BR>".
                "Silahkan login untuk melihat status pinjaman anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        $subject = 'Kredito.id - Pinjaman anda sedang dalam proses';
		} else if($status == 4){
			$lMessage = 
                "Hi ".$row_user->loan_name.",".
                "<BR><BR>".
				"Pengajuan pinjaman ".$refinance." dengan nomor referensi <b>".$kode."</b> berhasil<BR>".
                "<BR><BR>".
				
				 "<BR><BR>".
                "Silahkan hubungi tim RajaKredit untuk informasi lebih lanjut".
                "<BR><BR>".
             
                "<BR>".
                "Silahkan login untuk melihat status pinjaman anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        $subject = 'Kredito.id - Pinjaman anda berhasil';
		}else if($status == 5){
			$lMessage = 
                "Hi ".$row_user->loan_name.",".
                "<BR><BR>".
				"Pengajuan pinjaman ".$refinance." dengan nomor referensi <b>".$kode."</b> di tolak<BR>".
                "<BR><BR>".
				"Tim analis keuangan kami menyatakan pinjaman anda belum memenuhi syarat".
				 "<BR><BR>".
                "Silahkan hubungi tim RajaKredit untuk informasi lebih lanjut".
                "<BR><BR>".
             
                "<BR>".
                "Silahkan login untuk melihat status pinjaman anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        $subject = 'Kredito.id - Pinjaman anda ditolak';
		}
		else if($status == 8){
			$lMessage = 
                "Hi ".$row_user->loan_name.",".
                "<BR><BR>".
				"Selamat, dana pinjaman anda dengan nomor referensi <b>".$kode."</b> telah di cairkan<BR>".
                "<BR><BR>".
				"Tim analis keuangan kami menyatakan pinjaman anda belum memenuhi syarat".
				 "<BR><BR>".
                "Silahkan hubungi tim RajaKredit untuk informasi lebih lanjut".
                "<BR><BR>".
             
                "<BR>".
                "Silahkan login untuk melihat status pinjaman anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        $subject = 'Kredito.id - Pinjaman anda ditolak';
		}
		
		
		
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->loan_email, $subject, $message);
    }
	
	public function status_suggest($loan_id,$status) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');
		
		 $ci->load->model('model_loan');
        $row = $ci->model_loan->get_loan($loan_id);

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($row->borrower_id);
	
	
		if($status == '1'){
			$lMessage = 
              //  "Kepada ".$row_user->full_name.",".
                "<BR><BR>".
				//"Pengajuan pinjaman dengan nomor referensi <b>".$row->code."</b> saat ini telah terdanai sebesar Rp ".$row->total_bid_amount."<BR>".
                "<BR><BR>".
                "Harap hubungi kami jika anda menyetujui dana untuk pinjaman anda tersebut".
                "<BR><BR>".
             
                "<BR>".
                "Untuk informasi lebih lanjut silahkan hubungi Costumer Service RajaKredit<BR>";
                  
  
			$subject = 'Kredito.id - Status Pengajuan Pinjaman Anda';
		}else if($status == '2'){
			
			$lMessage = 
                "Kepada ".$row_user->full_name.",".
                "<BR><BR>".
				"Terimakasih telah menyetujui dana untuk pinjaman anda sebesar Rp ".$row->total_bid_amount."<BR>".
                "<BR><BR>".
                "Kami akan memproses lebih lanjut peminjaman anda dan kami akan menghubungi anda secepatnya".
                "<BR><BR>".
                "<BR>".
                "Untuk informasi lebih lanjut silahkan hubungi Costumer Service RajaKredit<BR>";
                  
  
			$subject = 'Kredito.id - Status Pengajuan Pinjaman Anda';
			
			
		}

        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }

    //Investor
	
	 public function new_investor_upload_document_register($user_id) 
    {
        //Should not get cookie in this function, because need to send email to newly subscribe Borrower who is still inactive.
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        /*
        $ci->load->model('model_investment');
        $row = $ci->model_investment->get($investment_id);
        */

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($user_id);

        $lMessage = 
            "Hi ".$row_user->full_name.",".
            "<BR><BR>".
            "Terimakasih anda telah mengupload dokumen yang dibutuhkan untuk melakukan pendanaan".
            "<BR>".
            "Kami akan melakukan verifikasi dokumen anda";
           
        
        
        $subject = APP_NAME.' - Aktivasi akun investor anda';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }
	
	
	public function investor_active($user_id) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($user_id);
		
	
		
		$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Status anda sebagai investor di RajaKredit.co.id telah diaktifkan".
                "<BR><BR>".
                "Sekarang anda dapat melakukan bid kepada calon peminjam sesuai dengan limit dana yang diterima oleh Rajakredit.com".
                "<BR><BR>".
             
                "<BR>".
                "Silahkan login untuk melihat dana investasi anda dan melakukan bid kepada calon peminjam<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        
        
        $subject = 'Kredito.id - Status anda sebagai investor telah diaktifkan';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }
	public function investment_success($code,$user_id,$fund) 
    {
       $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($user_id);
		   $ci->load->model('model_investment');
		   $ci->load->model('model_bid');
		$fundtotal= $ci->model_investment->get_total_fund($user_id);
		
		//$fund= $ci->model_investment->get_total_fund(get_cookie("user_id"));
		$bid= $ci->model_bid->get_total_bid($user_id);
		$totaldeposit= $ci->model_bid->min_bid_fund($fundtotal->total,$bid->total);
		
	$ci->load->model('model_backend');
		
		$lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
				"Investasi anda dengan nomor referensi <b>".$code."</b> senilai Rp. ".$ci->model_backend->rupiah($fund). " telah kami terima</b>".
                "<BR><BR>".
                "Total investasi anda saat ini di Rajakredit sebesar Rp. <b>".$ci->model_backend->rupiah($totaldeposit) ."</b>".
				
                "<BR><BR>".
				"Silahkan gunakan dana investasi anda untuk bid kepada calon peminjam<BR>".
                "<BR>".
                "Silahkan login untuk melihat total dana investasi anda<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        
        
        
        $subject = 'Kredito.id - Dana investasi anda telah kami terima';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }


		
		 public function pengajuan_penambahan_saldo($investment_code) 
    {
        //Should not get cookie in this function, because need to send email to newly subscribe Borrower who is still inactive.
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_investment');
        $row = $ci->model_investment->get_by_code($investment_code);

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($row->investor_id);

        
            $lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
                "Pengjuan penambahan saldo dengan omor pengjuan <b>".$row->code_investment."</b>".
                "<BR><BR>".
                "Mohon segera melakukan konfirmasi pembayaran".
                "<BR><BR>";
       
        
        
        $subject = 'RajaKredit - Investasi anda berhasil di submit';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }
		
//Administrator
 public function new_investor_application_to_admin($user_id) 
    {
        $ci = get_instance();
        
        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_user');
        $row = $ci->model_user->get($user_id);

        $lMessage = 
            "<u>New Investor Application</u><BR><BR>".
            "Code: ".$row->user_code."<BR>".
            "Name: ".$row->full_name."<BR>".
            "Email: ".$row->email."<BR>".
            "Phone: ".$row->mobile_phone."<BR>".
            "Company: ".$row->company_name."<BR>".
            "Submitted Date: ".$row->created_date."<BR><BR>".
            "Fund: MYR ".number_format($row->total_fund, 2)."<BR>";
        
        $subject = APP_NAME.' - new investor application ('.$row->user_code.')';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;

        $param["status"] = 1;
        $ci->load->model('model_sys_user_group');
        $result_group = $ci->model_sys_user_group->listing($param);

        $param2["status"] = 1;
        $ci->load->model('model_sys_user');
        foreach ($result_group as $row_group)
        {
            $result_user = $ci->model_sys_user->listing($param2);
            foreach ($result_user as $row_user)
            {
                if ($row_user->sys_user_group_id == $row_group->sys_user_group_id && $row_group->investment_notification == 1)
                {
                    $this->send($row_user->email, $subject, $message);
                }
            }
        }
    }	
	
	
	
    public function new_investment_to_investor($investment_id) 
    {
        //Should not get cookie in this function, because need to send email to newly subscribe Borrower who is still inactive.
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_investment');
        $row = $ci->model_investment->get($investment_id);

        $ci->load->model('model_user');
        $row_user = $ci->model_user->get($row->investor_id);

        if (get_cookie("user_id") == "")
        {
            $lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
                "Investasi anda berhasil di submit . Nomor referensi pengajuan deposit anda adalah : <b>".$row->user_code."</b>".
                "<BR><BR>".
                "Kami akan memverifikasi investasi anda paling lambat 24 jam.".
                "<BR><BR>".
                "Silahkan klik link ini untuk <a target='_blank' href='".base_url()."security/activation/".$row_user->dynamic_code."'>aktivasi akun anda</a>.<BR>".
                "<BR>".
                "Jika link diatas tidak bekerja silahkan klik link dibawah ini:<BR>".
                "<a target='_blank' href='".base_url()."security/activation/".$row_user->dynamic_code."'>".base_url()."security/activation/".$row_user->dynamic_code."</a>.<BR>";
        }
        else
        {
            $lMessage = 
                "Hi ".$row_user->full_name.",".
                "<BR><BR>".
               "Investasi anda berhasil di submit . Nomor referensi pengajuan deposit anda adalah : <b>".$row->user_code."</b>".
                "<BR><BR>".
                "Kami akan memverifikasi investasi anda paling lambat 24 jam.".
                "<BR><BR>".
                "<a target='_blank' href='".base_url()."'>Silahkan Login  Rajakredit untuk melihat status deposit anda</a>.<BR>".
                "<BR>".
                "Jika link diatas tidak bekerja, maka silahkan klik link tersebut<BR>".
                "<a target='_blank' href='".base_url()."'>".base_url()."</a>.<BR>";    
        }
        
        
        $subject = 'RajaKredit - Investasi anda berhasil di submit';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }

    public function new_investment_to_admin($investment_id) 
    {
        $ci = get_instance();
        
        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');

        $ci->load->model('model_investment');
        $row = $ci->model_investment->get($investment_id);

        $lMessage = 
            "<u>New loan request</u><BR><BR>".
            "Reference number: <b>".$row->user_code."</b><BR>".
            "Name: ".$row->i_full_name."<BR>".
            "Email: ".$row->i_email."<BR>".
            "Phone: ".$row->i_mobile_phone."<BR>".
            "Company: ".$row->i_company_name."<BR>".
            "Submitted Date: ".$row->created_date."<BR><BR>".
            "Fund: MYR ".number_format($row->fund, 2)."<BR>";
        
        $subject = APP_NAME.' - new investment ('.$row->user_code.')';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;

        $param["status"] = 1;
        $ci->load->model('model_sys_user_group');
        $result_group = $ci->model_sys_user_group->listing($param);

        $param2["status"] = 1;
        $ci->load->model('model_sys_user');
        foreach ($result_group as $row_group)
        {
            $result_user = $ci->model_sys_user->listing($param2);
            foreach ($result_user as $row_user)
            {
                if ($row_user->sys_user_group_id == $row_group->sys_user_group_id && $row_group->investment_notification == 1)
                {
                    $this->send($row_user->email, $subject, $message);
                }
            }
        }
    }
	public function activation_bid($user_id,$loan_id,$code,$amount) 
    {
        $ci = get_instance();

        $lEmailHeader = $ci->config->item('email_header');
        $lEmailFooter = $ci->config->item('email_footer');
		
		  $ci->load->model('model_loan');
        $row = $ci->model_loan->get_loan($loan_id);
        $ci->load->model('model_user');
		 $ci->load->model('model_backend');
        $row_user = $ci->model_user->get($user_id);
		
	
		
		$lMessage = 
                "Hai ".$row_user->full_name.",".
                "<BR><BR>".
				"Ini adalah email konfirmasi untuk memastikan bahwa anda telah melakukan bid pada id pinjaman <b>".$row->user_code."</b>".
                "<BR><BR>".
                "Jika anda melakukan bid pada ID Pijaman tersebut dengan nilai Rp. ".$ci->model_backend->rupiah($amount)." harap aktivasi bid anda dengan mengklik link tersebut".
                "<BR><BR>".
             
              
                "<a target='_blank' href='".base_url()."investor/bid/activation/".$code."'>".base_url()."investor/bid/activation/".$code."</a>.<BR>";
        
        
        
        $subject = 'Kredito.id - Konfirmasi BID anda';
        $message = $lEmailHeader.$lMessage.$lEmailFooter;
        $this->send($row_user->email, $subject, $message);
    }
    
    function send($to, $subject, $message)
    {
        $ci = get_instance();
        $ci->load->library('email');
		
			/* KONEKSI HOSTING	
		$config['useragent']           = "CodeIgniter";
                $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "localhost";
        $config['smtp_port'] = "25";
      //  $config['smtp_user'] = $ci->config->item('gmail'); 
       // $config['smtp_pass'] = $ci->config->item('gmail_pwd');
         $config['mailtype'] = 'html';
                $config['charset']  = 'utf-8';
                $config['newline']  = "\r\n";
                $config['wordwrap'] = TRUE;
		
		*/
		
	
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = $ci->config->item('gmail'); 
        $config['smtp_pass'] = $ci->config->item('gmail_pwd');
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        $ci->email->from($ci->config->item('gmail'), $ci->config->item('gmail_name'));
        $list = array($to);
        $ci->email->to($list);
        $ci->email->reply_to($ci->config->item('gmail'), $ci->config->item('gmail_name'));
        $ci->email->subject($subject);
        $ci->email->message($message);
        $ci->email->send();

        /*
            $this->email->cc('another@another-example.com'); 
            $this->email->bcc('them@their-example.com'); 
            echo $this->email->print_debugger();

        */
    }
}