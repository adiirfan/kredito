<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Set_cookies {

	/************ WEB PROFILE ********************/
	public function setUserID($pUserID)
	{
		$cookie = array(
			'name'   => 'user_id',
			'value'  => $pUserID,
			'expire' => time()+86500,
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setEmail($pEmail)
	{
		$cookie = array(
			'name'   => 'email',
			'value'  => $pEmail,
			'expire' => time()+86500,
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setUserGroup($pUserGroup)
	{
		$cookie = array(
			'name'   => 'user_group',
			'value'  => $pUserGroup,
			'expire' => time()+86500,
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setFullName($pFullName)
	{
		$cookie = array(
			'name'   => 'full_name',
			'value'  => $pFullName,
			'expire' => time()+86500,
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setREmail($pEmail)
	{
		$cookie = array(
			'name'   => 'r_email',
			'value'  => $pEmail,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setRPassword($pPassword)
	{
		$cookie = array(
			'name'   => 'r_password',
			'value'  => $pPassword,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	/************ BORROWER ********************/
	public function setBAmount($pAmount)
	{
		$cookie = array(
			'name'   => 'b_amount',
			'value'  => $pAmount,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setBMonnth($pMonth)
	{
		$cookie = array(
			'name'   => 'b_month',
			'value'  => $pMonth,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setLoanID($pLoanID)
	{
		$cookie = array(
			'name'   => 'loan_id',
			'value'  => $pLoanID,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}


	/************ INVESTOR ********************/
	public function setIType($pType)
	{
		$cookie = array(
			'name'   => 'i_type',
			'value'  => $pType,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}
	public function setStatus($pStatus)
	{
		$cookie = array(
			'name'   => 'status',
			'value'  => $pStatus,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setInvestmentID($pInvestmentID)
	{
		$cookie = array(
			'name'   => 'investment_id',
			'value'  => $pInvestmentID,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}


	/************ ADMIN ********************/
	public function setAdminUserID($pUserID)
	{
		$cookie = array(
			'name'   => 'admin_userid',
			'value'  => $pUserID,
			'expire' => time()+86500,
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setAdminEmail($pEmail)
	{
		$cookie = array(
			'name'   => 'admin_email',
			'value'  => $pEmail,
			'expire' => time()+86500,
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setAdminFullName($pFullName)
	{
		$cookie = array(
			'name'   => 'admin_fullname',
			'value'  => $pFullName,
			'expire' => time()+86500,
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setAdminGroupName($pGroupName)
	{
		$cookie = array(
			'name'   => 'admin_groupname',
			'value'  => $pGroupName,
			'expire' => time()+86500,
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setAdminREmail($pEmail)
	{
		$cookie = array(
			'name'   => 'r_admin_email',
			'value'  => $pEmail,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}

	public function setAdminRPassword($pPassword)
	{
		$cookie = array(
			'name'   => 'r_admin_password',
			'value'  => $pPassword,
			'expire' => '31536000',
			'domain' => '',
			'path'   => '/',
			'prefix' => '',
			);
		set_cookie($cookie);
	}



}