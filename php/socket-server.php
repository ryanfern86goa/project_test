<?php
// define TCP port & local host
$port=7924;
$host='127.0.0.1';
set_time_limit(0);
// create low level socket
if(!$socket=socket_create(AF_INET,SOCK_STREAM,0)){
    trigger_error('Error creating new socket',E_USER_ERROR);
}
// tie up socket to TCP port
if(!socket_bind($socket,$host,$port)){
    trigger_error('Error binding socket to TCP
port',E_USER_ERROR);
}
// begin listening connections
if(!socket_listen($socket)){
    trigger_error('Error listening socket
connections',E_USER_ERROR);
}
// create communication socket
if(!$comSocket=socket_accept($socket)){
    trigger_error('Error creating communication
socket',E_USER_ERROR);
}
// read socket input
$socketInput=socket_read($comSocket,1024);
// convert to uppercase socket input
$socketOutput=strtoupper(trim($socketInput))."n";
// write data back to socket server
if(!socket_write($comSocket,$socketOutput,strlen($socketOutput))){
    trigger_error('Error writing socket output',E_USER_ERROR);
}
// close sockets
socket_close($comSocket);
socket_close($socket);
?>