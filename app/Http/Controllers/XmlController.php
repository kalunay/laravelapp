<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class XmlController extends Controller
{

    public $filepath = 'data.xml';
    protected $ids = array();

    public function index()
    {
        $xmlFile = file_get_contents(public_path($this->filepath));
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
                $item->update($data);
                //dump($item->id . ' is update');
            } else {
                $item = new Car();
                $item->create($data);
                //dump($data['id'] . ' is create');
            }
        }

        // удаление авто не из фаила
        DB::table('cars')->whereNotIn('id', $this->ids)->delete();

    }

}
