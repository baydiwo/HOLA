<?php
require_once("login/session.php");
$user = new USER();
if(isset($_POST['save']))
{
    $clientname = strip_tags($_POST['clientName']);
    $orderdate = strip_tags($_POST['orderDate']);
    $hashtag = strip_tags($_POST['hashtag']);

    $user->saveclient($clientname,$orderdate,$hashtag);
    $user->redirect('client.php?r=clientsaved');
}
if(isset($_POST['savecontinue']))
{
    $clientname = strip_tags($_POST['clientName']);
    $orderdate = strip_tags($_POST['orderDate']);
    $hashtag = strip_tags($_POST['hashtag']);

    $user->saveclient($clientname,$orderdate,$hashtag);
    $user->redirect('admin.php?tag='.$hashtag);
}
