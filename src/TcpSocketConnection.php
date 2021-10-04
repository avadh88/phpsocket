<?php
namespace ebl;
use ebl\SocketInterface;

class TcpSocketConnection implements SocketInterface
{
    private $port   = 45123;
    private $host   = '0.0.0.0';
    private $socket = '';
    public function __construct($host,$port)
    {
        $this->host   = $host;
        $this->port   = $port;
        $this->socket = $this->SocketConnect();  
    }

    public function SocketConnect()
    {
        try
        {
            $socket = socket_create(AF_INET, SOCK_STREAM, 0);
            $result = socket_connect($socket, $this->host, $this->port);
            if ($result === false) 
            {
                trigger_error("socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n");
            }
            else
            {
                return $socket;
            }
        }
        catch(\Exception $e)
        {
            trigger_error($e->getMessage());
        }
        
    }

    public function socketWrite($data,$length='',$packFormat='')
    {
        // $socket    = $this->SocketConnect();
        $socket    = $this->socket;
        
        if(!empty($packFormat))
        {
            try
            {
                socket_write($socket,pack($packFormat, $data));
            }
            catch(\Exception $e)
            {
                trigger_error($e->getMessage());
            }
            
        }
        else
        {
            try 
            {
                socket_write($socket,$data);
            } 
            catch (\Exception $e) 
            {
                trigger_error($e->getMessage());
            }
            
        }
    }

    public function socketRead($readByte)
    {
        $socketData = '';
        //$socket     = $this->SocketConnect();
        $socket    = $this->socket;
        $socketData =  socket_read($socket,4);
        return $socketData;
    }

    public function SocketDisConnect()
    {
        //$socket     = $this->SocketConnect();
        $socket = $this->socket;
        socket_close($socket);
    }
}