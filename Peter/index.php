<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D7 Classwork</title>
</head>
<body>
    <?php  

        class vehicles{
            public $name;
            public $model;
            public $makeYear;
            public $colour;
            public $fuelType;

            function __construct($name_arg, $model_arg, $year_arg, $col_arg, $fuel_arg)
            {
                $this->name = $name_arg;
                $this->model = $model_arg;
                $this->makeYear = $year_arg;
                $this->colour = $col_arg;
                $this->fuelType =$fuel_arg;
            }

            public function info()
            {
                $vehicleInfo = "<p>Vehicle-Name: {$this->name} <br> Vehicle-Model:  {$this->model}<br></p>" ;
                return $vehicleInfo;
            }
        }

        $vehicle1 =new vehicles('Chevy','Bel-Air', 1975,'Red', 'normal');
        $vehicle2 =new vehicles('VW','Beetle', 1970,'White', 'diesel');
        $vehicle3 =new vehicles('Shelby','Cobra', 1980,'Blue', 'super');

        $rtnInfo1 = $vehicle1->info();
        print "$rtnInfo1";
        $rtnInfo2 = $vehicle2->info();
        print "$rtnInfo2";
        $rtnInfo3 = $vehicle3->info();
        print "$rtnInfo3";

        class ships extends vehicles{
            public $length;
            public $lifeboats;

            function __construct($name_arg, $model_arg, $year_arg, $col_arg, $fuel_arg, $length_arg, $lifeboats_arg)
            {
                parent::__construct($name_arg, $model_arg, $year_arg, $col_arg, $fuel_arg);
                
                $this->length = $length_arg;
                $this->lifeboats = $lifeboats_arg;
            }
            function shipinfo(){
                // $shipinf ="<p>Vehicle-Name: {$this->name} <br> Vehicle-Model:  {$this->model}<br>Length: {$this->length} <br> Lifeboats: {$this->lifeboats}<br><hr> </p>" ;
                $shipinf = "<hr>". parent::info() . "Length: {$this->length} <br> Lifeboats: {$this->lifeboats}";
                return $shipinf;
            }
        }

        $ship1= new ships('Boaty Mc-Boatface', 'Big Ship', 2002, 'grey','diesel', '80m', 20);
        $ship2= new ships('Nice Boat', 'Kefir', 2012, 'Red','diesel', '10m', 2);
        $ship3= new ships('Swan', 'Pretty', 2000, 'white','magic', '4m', 0);

        $rtnInfo4 = $ship1->shipinfo();
        print "$rtnInfo4";
        $rtnInfo5 = $ship2->shipinfo();
        print "$rtnInfo5";
        $rtnInfo6 = $ship3->shipinfo();
        print "$rtnInfo6";


    ?>
</body>
</html>