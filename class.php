<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;

use Bitrix\Highloadblock as HL;

use Bitrix\Tasks\TaskTable;

CModule::IncludeModule("tasks");


class AnalogNewslist extends CBitrixComponent
{
    private $IBLOCK_ID;
    private $SECTION_ID;
    private $LIMIT;

    public function executeComponent()
    {

        $cacheId = md5('cache_' . serialize($this->arParams) . '_' . serialize($_GET['news']));

        if ($this->StartResultCache($this->arParams['CACHE_TIME'], [$this->IBLOCK_ID, $cacheId])) {
            $this->getResult();
            $this->includeComponentTemplate();
        }
    }

    private function getNav(){
        $nav = new \Bitrix\Main\UI\PageNavigation("news");
        $nav->allowAllRecords(true)
            ->setPageSize($this->LIMIT)
            ->initFromUri();
        return $nav;

    }
    private function getResult()
    {
        $nav = $this->getNav();

        \Bitrix\Main\Loader::includeModule('iblock');
        $result = \Bitrix\Iblock\ElementTable::getList(array(
            'filter' => array('IBLOCK_ID' => $this->IBLOCK_ID, 'IBLOCK_SECTION_ID' => $this->SECTION_ID),
            'select' =>  array('PREVIEW_PICTURE', 'NAME', 'ID', 'DATE_CREATE', 'PREVIEW_TEXT'),
            "count_total" => true,
            "offset" => $nav->getOffset(),
            "limit" => $nav->getLimit(),
        ));
        $nav->setRecordCount($result->getCount());

        while ($arRow = $result->Fetch()) {
            $this->arResult['items'][$arRow['ID']] = $arRow;

        }
        $this->arResult['nav'] = $nav;

    }

    public function onPrepareComponentParams($arParams)
    {
        $this->IBLOCK_ID = $arParams['IBLOCK_ID'];
        $this->SECTION_ID = $arParams['SECTION_ID'];
        $this->LIMIT = $arParams['LIMIT'];
        $result = array(
            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
            "SECTION_ID" => $arParams['SECTION_ID'],
            "LIMIT" => $arParams['LIMIT'],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000000,
        );

        return $result;
    }
}
