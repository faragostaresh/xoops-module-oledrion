<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * oledrion
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Hossein Azizabadi (azizabadi@faragostaresh.com)
 * @version     $Id$
 */

class sms
{
    public static function sendSms($information = array(), $option = array())
    {
    	$to = intval($information['to']);
    	if (strlen($to) == 10 && substr($to, 0, 9)) {
        	$parameters = array();
        	$parameters['username'] = '';
        	$parameters['password'] = '';
        	$parameters['from'] = '';
        	$parameters['to'] = array($to);
        	$parameters['text'] =  $information['text'];
        	$parameters['isflash'] = false;
        	$parameters['udh'] = "";
        	$parameters['recId'] = array(0);
        	$parameters['status'] = 0x0;

        	ini_set("soap.wsdl_cache_enabled", "0");
        	$sms_client = new SoapClient("");
        	return $sms_client->SendSms($parameters)->SendSmsResult;
    	} else {
	    	return false;
    	}
    }   
}