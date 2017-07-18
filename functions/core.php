<?php 

define('taknode_base_api_url','http://taknod.com/eset/sell/');

function taknode_json_price($apiKey)
{
	if (empty($apiKey)) {
		return null;
	}

	return file_get_contents(taknode_base_api_url.'esResellerPrice/'.$apiKey);
}

function taknode_core_check_callbak()
{
	//file_put_contents('postdata.dat',var_export($_POST, true));
	if (isset($_POST['error'])) {
		if ($_POST['error']=='200') {
			//success
			return $_POST;
		}else{
			return taknode_callback_error((int)$_POST['error']);
		}
	}
}

function taknode_callback_error($code)
{
	$errors=['کلید API نامعتبر.',
				'اطلاعات محصول اشتباه است.',
				'اطلاعات کاربر اشتباه است.',
				'اطلاعات لایسنس اشتباه است.',
				'کد درخواست لایسنس نا معتبر',
				'کد درخواست لایسنس قبلا استفاده شده است.',
				'خطا در دریافت لایسنس از سرور Eset .',
				-1=>'پارامتر ها کامل ارسال نشده است.',
				-2=>'عدم برقراری ارتباط با بانک.',
				-3=>'پرداخت ناموفق.'] ;
	return empty($error[$code]) ? 'خطای تعریف نشده!': $error[$code];
}