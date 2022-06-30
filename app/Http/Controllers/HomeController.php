<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #comment added
       $stocksTable = \Lava::DataTable();  // Lava::DataTable() if using Laravel
       $stocksTable->addColumns(array(

    array('string', 'Date'),
    array('number', 'On'),
    array('number', 'Off')
  ));
       $sql="select TIME(created_at) as createdat,
 
    COUNT(IF(sensor_state=1, 1, NULL)) AS on_state,
    COUNT(IF(sensor_state=0, 1, NULL)) AS off_state
   FROM smoke_sensors GROUP BY created_at";
       //$sql="select count(sensor_state) as count_val,TIME(created_at) as createdat from smoke_sensors 
     //  group by createdat ";
      $result=DB::select($sql);
       foreach ($result as $data) {
        $rowData = array(
            $data->createdat,$data->on_state,$data->off_state
            );
        $stocksTable->addRow($rowData);
 
     
}

/*for ($a = 1; $a < 30; $a++)
    {
        $rowData = array(
          "2014-8-$a", rand(800,1000), rand(800,1000)
        );

        $stocksTable->addRow($rowData);
    }*/
$lineChart = \Lava::ColumnChart('Stocks')
                    ->setOptions(array(
                        'datatable' => $stocksTable,
                        'title' => 'Smoke Sensor States'

                      ));

//$chart->datatable($stocksTable);

        return View('Home.charts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
