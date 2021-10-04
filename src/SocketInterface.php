<?php
namespace ebl;

interface SocketInterface
{
    public function SocketConnect();

    public function SocketDisConnect();

    public function SocketWrite($data,$length='',$packFormat='');

    public function SocketRead($readByte);
}