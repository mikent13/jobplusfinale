<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;

class Chikka extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chikka';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get new messages from Employees';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
     
    private $clientId = 'b00de5e0839604cdfe07a9e7b5e6c8127ef4bf36ab3b44c0b287ae0603a678c0';
    private $secretKey = 'aed7fabd8a0864f8c5a61b5f4dfb4fd3d1737e81d792ff22a3639748391d3612';
    private $shortCode = '292902017';
    private $sslVerify = false;
    
    //Chikka's default URI for sending SMS
    private $chikkaSendUrl = 'https://post.chikka.com/smsapi/request';
    
    private $send = 'send';
    private $incoming = 'incoming';
    private $reply = 'reply';
    private $outgoing = 'outgoing';
    //Based from Chikka's price breakdown

    

    

        
    public function handle()
    {
        //Handle query for new messages here via Chikka API
        /*
            1. Get Numbers
            2. Retrieve Incoming Message
            3. Extract Messages
        */
         
         //$this->send("639423873602", "Hi");
         $this->receive("639335532300", 'This is test', '2017-02-10 16:31');
    }
    
    public function receive($senderNumber, $message = null, $time = null){
        /*
            1. Scan Incoming Messages
            2. Manage Message
        */
         $requestId = $this->generateCode140(128);
         $messageId = $this->generateCode35(32);
         $sendData = array(
            'message_type'      => "incoming",
            'mobile_number'     => $senderNumber,
            'shortcode'         => $this->shortCode,
            'request_id'        => $requestId,
            'message'           => $message,
            'timestamp'         => strtotime($time)
            );
        $result = $this->sendApiRequest($sendData);
        echo json_encode($result);
    }
    
    public function reply($requestId, $recipientId, $message){
         //$requestId = $this->generateCode140(128);
         $messageId = $this->generateCode35(32);
         $sendData = array(
            'message_type'      => "REPLY",
            'mobile_number'     => $recipientId,
            'shortcode'         => $this->shortCode,
            'request_id'        => $requestId,
            'message_id'        => $messageId,
            'message'           => $message,
            'request_cost'      => $requestCode,
            'client_id'         => $this->clientId,
            'secret_key'        => $this->secretKey
            );
        $result = $this->sendApiRequest($sendData);
        echo json_encode($result);
        
    }
    
    public function send($recipientNumber, $message){
        /*
            1. Configure data
            2. Send
            3. Verify confirmation
        */
        $messageId = $this->generateCode35(32);
        $sendData = array(
            'message_type'      => "SEND",
            'mobile_number'     => $recipientNumber,
            'shortcode'         => $this->shortCode,
            'message_id'        => $messageId,
            'message'           => $message
            );
        
        $result = $this->sendApiRequest($sendData);
        /*
            1. Validate Response
            status, message, request_type = SEND
        */
    }
    
    public function generateCode35($length){
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, $length);
    }
    public function generateCode140($length){
        $str  = "0123456789abcdefghijklmnopqrstvwxyz";
        $str .= "0123456789abcdefghijklmnopqrstvwxyz";
        $str .= "0123456789abcdefghijklmnopqrstvwxyz";
        $str .= "0123456789abcdefghijklmnopqrstvwxyz";
        return substr(str_shuffle($str), 0, $length);
    }
    
    public function extractMessage(){
        /*
            1. Create Code Arrangement
            2. Set Priorities
            3. Manage Message
        */
    }
    
     public function receiveNotifications() {
        $fromChikka = $_POST;
        
        if (count(array_diff_key($this->expectedChikkaResponse, $fromChikka)) != 0) {
            $fromChikka = null;
        }
        return $fromChikka;
    }
    /**
     * sendApiRequest - the functionality that sends request to Chikka API endpoint
     * @param  [array] $data post params 
     * @return [object]       
     */
    private function sendApiRequest($data){
        $data = array_merge($data, array('client_id'=>$this->clientId, 'secret_key' => $this->secretKey));
        //  build a request query from arrays of data 
        $post = http_build_query($data);
        // If available, use CURL
        if (function_exists('curl_version')) {
            $to_chikka = curl_init( $this->chikkaSendUrl );
            curl_setopt( $to_chikka, CURLOPT_POST, true );
            curl_setopt( $to_chikka, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $to_chikka, CURLOPT_POSTFIELDS, $post );
            if (!$this->sslVerify) {
                curl_setopt( $to_chikka, CURLOPT_SSL_VERIFYPEER, false);
            }
            $from_chikka = curl_exec( $to_chikka );
            curl_close ( $to_chikka );
        } elseif (ini_get('allow_url_fopen')) {
            // No CURL available so try the awesome file_get_contents
            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $post
                )
            );
            $context = stream_context_create($opts);
            $from_chikka = file_get_contents($this->chikkaSendUrl, false, $context);
        } else {
            // No way of sending a HTTP post :(
            return false;
        }
        return $this->parseApiResponse($from_chikka, $data['message_type']);
    }
    /**
     * parseApiResponse - process and handle Chikka api responses
     * @param  [array] $response    Response from Chikka API
     * @param  [string] $requestType This is the message type of the sms 
     * @return [type]              
     */
    private function parseApiResponse($response, $requestType = null){
        $response = json_decode($response,true);
        if($requestType){
            $response['request_type'] = $requestType;
        }
        
        return json_decode(json_encode($response));;
    }
}
