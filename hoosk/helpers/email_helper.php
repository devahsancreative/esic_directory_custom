<?php
if(!function_exists('getEmailConfig')) {
    function getEmailConfig()
    {
        $config = array();
        $config['useragent'] = USERAGENT;
        $config['protocol']  = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailtype']  = MAILTYPE;
        $config['charset']   = CHARSET;
        $config['newline']   = NEWLINE;
        $config['wordwrap']  = WORDWRAP;
        return $config;
    }
}
if(!function_exists('sendEmail')) {
    function sendEmail($ci,$subject,$to,$message)
    {
        $ci->load->library('email');
        $settings = $ci->Hoosk_model->getSettings();
        $siteEmail = $settings[0]['siteEmail'];
        $config = getEmailConfig();
        $ci->email->initialize($config);
        $ci->email->from($siteEmail, 'From: Esic Directory');
        $ci->email->to($to);
        $ci->email->subject($subject);
        $ci->email->message($message);
        $ci->email->send();
        return true;
    }
}
if(!function_exists('newUserEmail')) {
    function newUserEmail($ci,$firstName, $email, $password){

        $subject = "Welcome To Esic Directory";
        $message = "Hi, ".$firstName." <br> Welcome To Esic Directory " . "    <br> Please Login To Activate Your Account <br>";
        $message .= "<a href='".BASE_URL."'>Click Here To Login</a><br>";
        $message .= "Your Password:". $password." .";
        sendEmail($ci,$subject,$email,$message);
        return true;
    }
}
