<?php namespace ChatGPT;

class ChatGPT
{

    function send($message, $messages = [])
    {
        $newMessages = array_merge($messages, [['content' => $message, 'role' => "user"]]);

        $randIP = mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://vtlchat-g1.vercel.app/api/openai/v1/chat/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'frequency_penalty' => 0,
            'messages' => $newMessages,
            'model' => 'gpt-3.5-turbo',
            'presence_penalty' => 0,
            'stream' => false,
            'temperature' => 0.5,
            'top_p' => 1,
        ], 448));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'authority: vtlchat-g1.vercel.app',
            'Accept: application/json, text/event-stream',
            'Content-Type: application/json',
            'Origin: https://vtlchat-g1.vercel.app',
            'Referer: https://vtlchat-g1.vercel.app/',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0',
            'CLIENT-IP: ' . $randIP,
            'X-FORWARDED-FOR: ' . $randIP,
            'REMOTE_ADDR: ' . $randIP
        ]);
        $result = curl_exec($ch);
        $response = json_decode($result);

        $history = array_merge($messages, [['content' => $message, 'role' => "user"]]);

        $resultMessages = [];

        if (isset($response->choices)) {
            foreach ($response->choices as $item) {
                $history = array_merge($history, [$item->message]);
                $resultMessages[] = $item->message;
            }
    
            return json_encode([
                'status' => true,
                'message' => null,
                'result' => [
                    'history' => $history,
                    'message' => $resultMessages
                ]
            ], 448);
        } else {
            return json_encode([
                'status' => false,
                'message' => "Error"
            ], 448);
        }
        
    }

}
