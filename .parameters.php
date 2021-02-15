<?php
/** @var array $arCurrentValues */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule('iblock'))
    return;

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "",
        ),
        "SECTION_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "ID Секции",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "",
        ),
        "LIMIT" => array(
            "PARENT" => "BASE",
            "NAME" => "Количество строк на странице",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "",
        ),

    ),
);
