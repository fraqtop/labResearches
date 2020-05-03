<?php


namespace App\Services;


use PhpOffice\PhpSpreadsheet\IOFactory;

class ParsingService
{
    private const EMPTY_ROWS_LIMIT = 3;
    private $loadedFilePath;
    private $spreadSheet;

    public function parse(
        string $filename,
        array $range,
        int $sheetNumber = 0,
        int $rowStart = 2,
        array $labels = null
    ): ?array
    {
        if (!$this->loadedFilePath || $filename !== $this->loadedFilePath) {
            $this->spreadSheet = IOFactory::load($filename);
        }
        $result = [];
        $sheet = $this->spreadSheet->getSheet($sheetNumber);
        $index = $rowStart;
        $labels = $labels ? $this->getSheetLabels($range, $labels): [];
        $emptyRows = 0;
        while (true) {
            $item = [];
            $isRowEmpty = true;
            foreach ($range as $letter) {
                $value = $sheet->getCell("$letter$index")->getFormattedValue();
                $item[$labels[$letter] ?? $letter] = $value;
                $isRowEmpty = $value ? false: $isRowEmpty;
            }
            if ($isRowEmpty) {
                ++$emptyRows;
                if ($emptyRows > static::EMPTY_ROWS_LIMIT) {
                    break;
                }
                ++$index;
                continue;
            } else {
                $emptyRows = 0;
            }
            $result[] = $item;
            ++$index;
        }
        return $result;
    }

    private function getSheetLabels(array $range, array $labels)
    {
        $result = [];
        $labelsCount = count($labels);
        for ($i = 0; $i < $labelsCount; ++$i) {
            $result[$range[$i]] = $labels[$i];
        }
        return $result;
    }

}