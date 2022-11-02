<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class ParseXml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * путь к фаилу указываем относительно папки public
     * пример files/data.xml
     */
    protected $signature = 'xml:parse {file=data.xml}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse xml file';

    protected $ids = array();

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $xmlFile = file_get_contents(public_path($this->argument('file')));
        $xmlObject = simplexml_load_string($xmlFile);

        $jsonFormatData = json_encode($xmlObject);
        $result = json_decode($jsonFormatData, true);

        foreach($result['offers']['offer'] as $car){

            $data = [
                'id' => $car['id'],
                'mark' => is_array($car['mark']) ? NULL : $car['mark'],
                'model' => is_array($car['model']) ? NULL : $car['model'],
                'generation' => is_array($car['generation']) ? NULL : $car['generation'],
                'year' => is_array($car['year']) ? NULL : $car['year'],
                'run' => is_array($car['run']) ? NULL : $car['run'],
                'color' => is_array($car['color']) ? NULL : $car['color'],
                'body_type' => is_array($car['body-type']) ? NULL : $car['body-type'],
                'engine_type' => is_array($car['engine-type']) ? NULL : $car['engine-type'],
                'transmission' => is_array($car['transmission']) ? NULL : $car['transmission'],
                'gear_type' => is_array($car['gear-type']) ? NULL : $car['gear-type'],
                'generation_id' => is_array($car['generation_id']) ? NULL : $car['generation_id']
            ];

            $this->ids[] = $car['id'];

            if(Car::find($car['id'])){
                $item = Car::find($car['id']);
                if($item->update($data)){
                    $this->info($car['id'] . ' обнавлён!');
                } else {
                    $this->error($car['id'] . ' не обновился!');
                }
            } else {
                $item = new Car();
                if($item->create($data)){
                    $this->info($car['id'] . ' добавлен!');
                } else {
                    $this->error($car['id'] . ' не добавлен!');
                }
            }
        }

        // удаление авто не из фаила
        DB::table('cars')->whereNotIn('id', $this->ids)->delete();

        $this->line('Фаил обработан!');
    }
}
