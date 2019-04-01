<?php
/**
 * Created by PhpStorm.
 * User: archeta
 * Date: 28/03/2019
 * Time: 17.03
 */
include "../LazopSdk.php";

$c = new \LazopClient('https://api.lazada.co.id/rest','109297','Ul5a8UKBZ9E9KNUBXPscg5LSRBpSZjgu','500003016040Nndj141c7402SBzvF8eEr7MyTkhgJHWiRsBGaHurAysW7VkOuH');
$request = new LazopRequest('/seller/get','GET');
var_dump($c->execute($request, $c));
?>