<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

    <table  style="width: 100%">
        <tr>
            <th>Картинка</th>
            <th>ID</th>
            <th>Название</th>
            <th>Анонс</th>
            <th>Создано</th>
        </tr>
        <?php
        foreach ($arResult['items'] as $id => $row): ?>
            <tr >
                <td><img style="height: 40px; width: 40px"
                         src="<?= CFile::GetPath($row['PREVIEW_PICTURE']); ?>" alt="<?= $row['NAME'] ?>"></td>
                <td><?= $id ?></td>
                <td><?= $row['NAME'] ?></td>
                <td><?= $row['PREVIEW_TEXT'] ?></td>
                <td><?= $row['DATE_CREATE']->format('Y.m.d') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

<?
$APPLICATION->IncludeComponent(
    "bitrix:main.pagenavigation",
    "",
    array(
        "NAV_OBJECT" => $arResult['nav'],
        "SEF_MODE" => "N",
    ),
    false
);
?>