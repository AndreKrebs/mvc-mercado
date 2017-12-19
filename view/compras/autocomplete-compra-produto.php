<?php

$valor = new ArrayObject();
$valor[] = array("id"=>"Ficedula hypoleuca","label"=>"Eurasian Pied Flycatcher","value"=>"Eurasian Pied Flycatcher");
$valor[] = array("id"=>"Muscicapa striata","label"=>"Spotted Flycatcher","value"=>"Spotted Flycatcher");
$valor[] = array("id"=>"Branta canadensis","label"=>"Greater Canada Goose","value"=>"Greater Canada Goose");
$valor[] = array("id"=>"Haematopus ostralegus","label"=>"Eurasian Oystercatcher","value"=>"Eurasian Oystercatcher");
$valor[] = array("id"=>"Aythya marila","label"=>"Greater Scaup","value"=>"Greater Scaup");
$valor[] = array("id"=>"Corvus corone","label"=>"Carrion Crow","value"=>"Carrion Crow");
$valor[] = array("id"=>"Sylvia atricapilla","label"=>"Blackcap","value"=>"Blackcap");
$valor[] = array("id"=>"Hydroprogne caspia","label"=>"Caspian Tern","value"=>"Caspian Tern");
$valor[] = array("id"=>"Bubulcus ibis","label"=>"Cattle Egret","value"=>"Cattle Egret");
$valor[] = array("id"=>"Aythya valisineria","label"=>"Canvasback","value"=>"Canvasback");
$valor[] = array("id"=>"Aythya affinis","label"=>"Lesser Scaup","value"=>"Lesser Scaup");
$valor[] = array("id"=>"Anas falcata","label"=>"Falcated Duck","value"=>"Falcated Duck");

echo json_encode($valor);