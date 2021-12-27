<?php
declare(strict_types = 1);

use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Writer;

Sheet::macro(
    'styleCells',
    function (Sheet $sheet, string $cellRange, array $style) {
        $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
    }
);

Sheet::macro(
    'wrapText',
    function (Sheet $sheet, string $cellRange, ?bool $wrap = true) {
        $sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setWrapText($wrap);
    }
);

Sheet::macro(
    'setOrientation',
    function (Sheet $sheet, $orientation) {
        $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
    }
);

Sheet::macro(
    'setFillByColorInCell',
    function (Sheet $sheet, $cell, string $cellRange) {
        $sheet->styleCells(
            $cellRange,
            [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color'    => ['argb' => $sheet->getDelegate()->getCell($cell)],
                ],
            ]
        );
    }
);

Sheet::macro(
    'hideColumn',
    function (Sheet $sheet, string $column) {
        $sheet->getDelegate()->getColumnDimension($column)->setVisible(false);
    }
);

Sheet::macro(
    'setWidth',
    function (Sheet $sheet, $column, ?float $width = null) {
        if(is_array($column)){
            foreach ($column as $name => $width){
                $sheet->getDelegate()->getColumnDimension($name)->setWidth($width);
            }
        }
        else $sheet->getDelegate()->getColumnDimension($column)->setWidth($width);
    }
);

Writer::macro(
    'setDefaultProperties',
    function (Writer $writer) {
        $writer->getDelegate()->getProperties()
            ->setCreator('ГППЦ')
            ->setLastModifiedBy("ГППЦ")
            ->setTitle("ГППЦ выгрузка")
            ->setSubject("ГППЦ выгрузка")
            ->setDescription(
                "ГППЦ выгрузка"
            );
    }
);

Writer::macro(
    'setCreator',
    function (Writer $writer, string $creator) {
        $writer->getDelegate()->getProperties()->setCreator($creator);
    }
);
