<?php

namespace App\Console\Commands;

use App\Models\Analysis;
use App\Models\AnalysisType;
use App\Services\ParsingService;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ParsePriceList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:price {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prices price list from excel file specified in {path}';

    private $parsingService;

    /**
     * Create a new command instance.
     *
     * @param ParsingService $parsingService
     *
     * @return void
     */
    public function __construct(ParsingService $parsingService)
    {
        parent::__construct();
        $this->parsingService = $parsingService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->parsingService->parse(
            $this->argument('path'),
            range('A', 'E'),
            0,
            2,
            ['label', 'price', 'code', 'duration', 'executor']
        );
        $this->savePrices($data);
        $data = $this->parsingService->parse(
            $this->argument('path'),
            range('A', 'D'),
            1,
            3,
            ['label', 'price', 'code', 'duration']
        );
        $this->savePrices($data);
        return null;
    }

    private function savePrices(array $data)
    {
        $currentTypeName = '';
        foreach ($data as $row) {
            if (!$row['price'] || !$row['code'] || !$row['duration']) {
                $currentTypeName = $row['label'];
                continue;
            }
            if (!empty($currentTypeName)) {
                try {
                    $type = AnalysisType::create([
                        'name' => $currentTypeName
                    ]);
                } catch (\Exception $exception) {
                    $this->error($exception->getMessage());
                }
                finally {
                    $currentTypeName = '';
                }

            }
            try {
                Analysis::create([
                    'code' => $row['code'],
                    'description' => $row['label'],
                    'price' => $row['price'],
                    'duration' => $row['duration'],
                    'executor' => empty($row['executor']) ? null: $row['executor'],
                    'type_id' => $type->id ?? null
                ]);
            } catch (\Exception $exception) {
                $this->error($exception->getMessage());
                continue;
            }
        }
    }
}
