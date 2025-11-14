<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $products = [
            [
                'name' => 'Penistrep bajuta 50ml',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Penistrep bajuta 100ml',
                'price' => '9000',
                'wholesale_price' => '8500',

            ],
            [
                'name' => 'ALFAMEC 100ml',
                'price' => '9000',
                'wholesale_price' => '8500',

            ],
            [
                'name' => 'Badex injection 50ml',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Bamectin injection 100ml',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Bamectin injection 50ml',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Bimectin injection 100ml',
                'price' => '7000',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'Bimectin injection 20ml',
                'price' => '2000',
                'wholesale_price' => '1800',

            ],
            [
                'name' => 'Supermec injection 10ml',
                'price' => '1500',
                'wholesale_price' => '1300',

            ],
            [
                'name' => 'Supermec injection 50ml',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Supermec injection 100ml',
                'price' => '9000',
                'wholesale_price' => '8500',

            ],
            [
                'name' => 'OXY-MET 20% LA 100ml',
                'price' => '5000',
                'wholesale_price' => '4800',

            ],
            [
                'name' => 'OXY-MET 10% 100ml',
                'price' => '4000',
                'wholesale_price' => '3800',

            ],
            [
                'name' => 'OXY-MET 10% 250ml',
                'price' => '9000',
                'wholesale_price' => '8700',

            ],
            [
                'name' => 'OXY-MET 10% 500ml',
                'price' => '15000',
                'wholesale_price' => '14500',

            ],
            [
                'name' => 'OXY-tong 100ml',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'OXY-tong 250ml',
                'price' => '9000',
                'wholesale_price' => '8700',

            ],
            [
                'name' => 'OXY-tong 500ml',
                'price' => '14000',
                'wholesale_price' => '13500',

            ],
            [
                'name' => 'ALAMYCIN LA 20% 100ml',
                'price' => '11500',
                'wholesale_price' => '11000',

            ],
            [
                'name' => 'NOORAVIT 100ml',
                'price' => '4500',
                'wholesale_price' => '4000',

            ],
            [
                'name' => 'OXYH 5% 100ml',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'TETRALOR 10% 100ml',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Newcastle tone',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'TATU-MOJA',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'Booster 1/2 litre',
                'price' => '2000',
                'wholesale_price' => '1800',

            ],
            [
                'name' => 'Booster 1 litre',
                'price' => '3000',
                'wholesale_price' => '2800',

            ],
            [
                'name' => 'Booster 5 litre',
                'price' => '11000',
                'wholesale_price' => '10000',

            ],
            [
                'name' => 'Oxy-vet 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Oxy-vet 250mls',
                'price' => '13000',
                'wholesale_price' => '12500',

            ],
            [
                'name' => 'Oxy-vet 500mls',
                'price' => '20000',
                'wholesale_price' => '19000',

            ],
            [
                'name' => 'Levamisole eagle 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Tylosin eagle 100mls',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'Pen-v1 50mls',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Pen-v1 100mls',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'Duduba 120mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Duduba 500mls',
                'price' => '11000',
                'wholesale_price' => '10000',

            ],
            [
                'name' => 'Dudumectin 100mls',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'Duduvil 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Farmbendazole 10% 1 litre',
                'price' => '13000',
                'wholesale_price' => '12000',

            ],
            [
                'name' => 'Vita-power 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Farmbendazole 10% 125mls',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'Oxyfetra 5% 100mls',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'Levacloa injection 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Penstreject 50mls',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Seven dust 200g',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'Amprolim 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Amprolim 100g',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Tylodoxi 30g',
                'price' => '4500',
                'wholesale_price' => '4000',

            ],
            [
                'name' => 'Tylodoxi 100g',
                'price' => '10000',
                'wholesale_price' => '9000',

            ],
            [
                'name' => 'Autophos',
                'price' => '45000',
                'wholesale_price' => '44000',

            ],
            [
                'name' => 'Homidium',
                'price' => '60000',
                'wholesale_price' => '50000',

            ],
            [
                'name' => 'Iver-drench 1 litre',
                'price' => '14000',
                'wholesale_price' => '13000',

            ],
            [
                'name' => 'Gumboro vaccine 200 dose',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Gumboro vaccine 500 dose',
                'price' => '6500',
                'wholesale_price' => '6000',

            ],
            [
                'name' => 'Newcastle vaccine 200 dose',
                'price' => '5000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Newcastle vaccine 500 dose',
                'price' => '6000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Fowl pox vaccine 200 dose',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'Fowl pox vaccine 500 dose',
                'price' => '11000',
                'wholesale_price' => '10000',

            ],
            [
                'name' => 'Wormicid 125ml',
                'price' => '3000',
                'wholesale_price' => '2000',

            ],
            [
                'name' => 'Wormicid 1 litre',
                'price' => '9000',
                'wholesale_price' => '8500',

            ],
            [
                'name' => 'Vetafos Gold 125ml',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'Vetafos Gold 1/2 litre',
                'price' => '10000',
                'wholesale_price' => '9000',

            ],
            [
                'name' => 'Vetafos Gold 1 litre',
                'price' => '18000',
                'wholesale_price' => '17000',

            ],
            [
                'name' => 'Hi-lect 100mls',
                'price' => '10000',
                'wholesale_price' => '9000',

            ],
            [
                'name' => 'Ivanor 50mls Red',
                'price' => '4500',
                'wholesale_price' => '4000',

            ],
            [
                'name' => 'Ivanor 100mls Red',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'Ivanor 250mls Red',
                'price' => '17000',
                'wholesale_price' => '15000',

            ],
            [
                'name' => 'Ivanor 500mls Red',
                'price' => '25000',
                'wholesale_price' => '24000',

            ],
            [
                'name' => 'Meriquine 100mls',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'Oxytetra 5% 200mls',
                'price' => '8000',
                'wholesale_price' => '7500',

            ],
            [
                'name' => 'Adamycin 200mls',
                'price' => '15000',
                'wholesale_price' => '13000',

            ],
            [
                'name' => 'Center Ivermec 50mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Center Ivermec 100mls',
                'price' => '8000',
                'wholesale_price' => '7500',

            ],
            [
                'name' => 'Center Ivermec 250mls',
                'price' => '16000',
                'wholesale_price' => '15000',

            ],
            [
                'name' => 'Center Ivermec 500mls',
                'price' => '25000',
                'wholesale_price' => '24000',

            ],
            [
                'name' => 'Suspension intramammary administration',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Eye wound powder (Kenya)',
                'price' => '1500',
                'wholesale_price' => '1200',

            ],
            [
                'name' => 'Ratrox',
                'price' => '500',
                'wholesale_price' => '250',

            ],
            [
                'name' => 'Seven dust 50g',
                'price' => '2500',
                'wholesale_price' => '2000',

            ],
            [
                'name' => 'Seven dust 100g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Needle 17G x 3/4',
                'price' => '500',
                'wholesale_price' => '250',

            ],
            [
                'name' => 'Needle 18G x 1/2',
                'price' => '500',
                'wholesale_price' => '250',

            ],
            [
                'name' => 'Needle 18G x 3/4',
                'price' => '500',
                'wholesale_price' => '250',

            ],
            [
                'name' => 'Needle 14G x 1',
                'price' => '500',
                'wholesale_price' => '250',

            ],
            [
                'name' => 'Epsom Salt',
                'price' => '2000',
                'wholesale_price' => '1500',

            ],
            [
                'name' => 'Mineral Block 2kg',
                'price' => '6000',
                'wholesale_price' => '5000',

            ],
            [
                'name' => 'Mineral Block 3kg',
                'price' => '7000',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'Mineral Block 5kg',
                'price' => '10000',
                'wholesale_price' => '9000',

            ],
            [
                'name' => 'Dairy mineral Block 3kg',
                'price' => '7000',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'Dairy mineral Block 5kg',
                'price' => '12000',
                'wholesale_price' => '11000',

            ],
            [
                'name' => 'Tick Buster 100mls',
                'price' => '0',
                'wholesale_price' => '0',

            ],
            [
                'name' => 'Tick Buster 200mls',
                'price' => '0',
                'wholesale_price' => '0',

            ],
            [
                'name' => 'Tick Buster 500mls',
                'price' => '17000',
                'wholesale_price' => '15500',

            ],
            [
                'name' => 'Tick Buster 1 litre',
                'price' => '30000',
                'wholesale_price' => '27000'
                ,

            ],
            [
                'name' => 'Ascare-P',
                'price' => '500',

                'wholesale_price' => '300',


            ],
            [
                'name' => 'BAOXYTETRA 30%',
                'price' => '7000',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'ALAMYCIN injection 20%',
                'price' => '11500',
                'wholesale_price' => '11000'
                ,

            ],
            [
                'name' => 'ALAMYCIN injection 30%',
                'price' => '0',
                'wholesale_price' => '0',

            ],
            [
                'name' => 'Alben 2.5% 125mls',
                'price' => '1500',
                'wholesale_price' => '1200',

            ],
            [
                'name' => 'Alben 2.5% 1/2 litre',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Alben 2.5% 1 litre',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Alben 10% 1 litre',
                'price' => '14000',
                'wholesale_price' => '13500'
                ,

            ],
            [
                'name' => 'Fluban 50mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Fluban 100mls',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'Respacare 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Respacare 250mls',
                'price' => '8000',
                'wholesale_price' => '7500',

            ],
            [
                'name' => 'Respacare 500mls',
                'price' => '11000',
                'wholesale_price' => '10000'
                ,

            ],
            [
                'name' => 'Respacare 1 litre',
                'price' => '20000',
                'wholesale_price' => '18000'
                ,

            ],
            [
                'name' => 'Baroxin 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Farm eye & wound powder',
                'price' => '2000',
                'wholesale_price' => '1500',

            ],
            [
                'name' => 'Shamba powder',
                'price' => '3000',
                'wholesale_price' => '2700',

            ],
            [
                'name' => 'Oxyvia 50mls',
                'price' => '2500',
                'wholesale_price' => '2000',

            ],
            [
                'name' => 'Oxyvia 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Oxyvia 250mls',
                'price' => '8500',
                'wholesale_price' => '8000',

            ],
            [
                'name' => 'Broiler Booster',
                'price' => '11000',
                'wholesale_price' => '10000'
                ,

            ],
            [
                'name' => 'Broiler extra (mineral & vitamin)',
                'price' => '13000',
                'wholesale_price' => '12000'
                ,

            ],
            [
                'name' => 'Fly killing bait powder 30g',
                'price' => '1000',
                'wholesale_price' => '500',

            ],
            [
                'name' => 'Zazafly fly & cockroach killer powder 30g',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Bavitamin injection 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Bamisole injection 100mls',
                'price' => '4500',
                'wholesale_price' => '4000',

            ],
            [
                'name' => 'Samectin 100mls',
                'price' => '7000',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'Needle 16G x 1',
                'price' => '500',
                'wholesale_price' => '250',

            ],
            [
                'name' => 'Needle 16G x 1/2',
                'price' => '500',
                'wholesale_price' => '250',

            ],
            [
                'name' => 'Needle 17G x 1',
                'price' => '500',
                'wholesale_price' => '250',

            ],
            [
                'name' => 'Dascarni worm powder 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Dascarni worm powder 100g',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Dawa-Tylodoxy powder 30g',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Dawa-Tylodoxy powder 100g',
                'price' => '17000',
                'wholesale_price' => '16500'
                ,

            ],
            [
                'name' => 'VITRANOR powder 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'VITRANOR powder 100g',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Coccimed powder 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Coccimed powder 100g',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Neoxychick powder 30g',
                'price' => '3500',
                'wholesale_price' => '3300',

            ],
            [
                'name' => 'Neoxychick powder 100g',
                'price' => '7500',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'Oxyfarm 20% powder 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Oxyfarm 20% powder 100g',
                'price' => '6500',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'TyDoxy Extra powder 30g',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'TyDoxy Extra powder 100g',
                'price' => '16000',
                'wholesale_price' => '15000'
                ,

            ],
            [
                'name' => 'OVIN powder 20g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'OVIN powder 100g',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Stress win powder 30g',
                'price' => '0',
                'wholesale_price' => '0',

            ],
            [
                'name' => 'Stress win powder 100g',
                'price' => '0',
                'wholesale_price' => '0',

            ],
            [
                'name' => 'Tylofarm 20% 30g',
                'price' => '4500',
                'wholesale_price' => '4000',

            ],
            [
                'name' => 'Tylofarm 20% 100g',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'Ascarex powder 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'OPTICLOX eye ointment',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Diminashish Plus',
                'price' => '7000',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'Diminabazene B12',
                'price' => '7000',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'Diminabazene Plain',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Intomazane B12',
                'price' => '11000',
                'wholesale_price' => '10500'
                ,

            ],
            [
                'name' => 'Veriben B12',
                'price' => '14000',
                'wholesale_price' => '13500'
                ,

            ],
            [
                'name' => 'PITCO (Diminazin)',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'Surividium B12',
                'price' => '13000',
                'wholesale_price' => '12500'
                ,

            ],
            [
                'name' => 'Albenor Bolus 2500mg',
                'price' => '1000',
                'wholesale_price' => '500',

            ],
            [
                'name' => 'Albenor Bolus 300mg',
                'price' => '300',
                'wholesale_price' => '250',

            ],
            [
                'name' => 'Sulfabolus',
                'price' => '1000',
                'wholesale_price' => '500',

            ],
            [
                'name' => 'Disetoprim',
                'price' => '350',
                'wholesale_price' => '300',

            ],
            [
                'name' => 'Multinor Bolus',
                'price' => '1000',
                'wholesale_price' => '500',

            ],
            [
                'name' => 'Albendazole 2500mg Bolus',
                'price' => '1000',
                'wholesale_price' => '500',

            ],
            [
                'name' => 'Farm OTC plus 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Farm OTC plus 100g',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Farm OTC 20% 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Farm OTC 20% 100g',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Egocin 20% powder 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Egocin 20% powder 100g',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Dawa-Boost powder 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Dawa-Boost powder 100g',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Cotivet powder 30g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Cotivet powder 100g',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'V. Multinor 50mls',
                'price' => '4000',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'V. Multinor 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'V. Multinor 250mls',
                'price' => '10000',
                'wholesale_price' => '9000',

            ],
            [
                'name' => 'Egocin 10% 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Sulfanor 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Floxinor 100mls',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'P-Strygonor 250mls',
                'price' => '25000',
                'wholesale_price' => '23000'
                ,

            ],
            [
                'name' => 'JOJO-Lick 1kg',
                'price' => '6500',
                'wholesale_price' => '6000',

            ],
            [
                'name' => 'MADLIME lick',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Oxy-rol 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Oxy-rol 250mls',
                'price' => '9000',
                'wholesale_price' => '8500',

            ],
            [
                'name' => 'Oxy-rol 500mls',
                'price' => '14000',
                'wholesale_price' => '13500'
                ,

            ],
            [
                'name' => 'BAOXYCLINE 500mls',
                'price' => '14000',
                'wholesale_price' => '13500'
                ,

            ],
            [
                'name' => 'IVERMED 50mls',
                'price' => '4500',
                'wholesale_price' => '4000',

            ],
            [
                'name' => 'IVERMED 100mls',
                'price' => '7000',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'Multivitamin 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Disposable syringe 20mls',
                'price' => '500',
                'wholesale_price' => '350',

            ],
            [
                'name' => 'Disposable syringe 60mls',
                'price' => '1500',
                'wholesale_price' => '1200',

            ],
            [
                'name' => 'Plastic steel syringe 10mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Plastic steel syringe 20mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Diminor Plus',
                'price' => '7000',
                'wholesale_price' => '6500',

            ],
            [
                'name' => 'Diminashish Plain',
                'price' => '6500',
                'wholesale_price' => '6000',

            ],
            [
                'name' => 'FARMOXY 10% 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Limoxin 100mls',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Mainland 100mls',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'Ton injection 100mls',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'Milking salve 100g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Milking salve 250g',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Milking salve 500g',
                'price' => '8500',
                'wholesale_price' => '8000',

            ],
            [
                'name' => 'Tylovet 100mls',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'Tylomed 100mls',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'BAYLOSIN 100mls',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'P-Strygonor 100mls',
                'price' => '10000',
                'wholesale_price' => '9000',

            ],
            [
                'name' => 'P-Strygonor 50mls',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Egocin 20% 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Ivanor 100mls',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'Tetranor 20% 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Tetranor 10% 250mls',
                'price' => '8500',
                'wholesale_price' => '8000',

            ],
            [
                'name' => 'Tetranor 10% 500mls',
                'price' => '14000',
                'wholesale_price' => '13500'
                ,

            ],
            [
                'name' => 'Mainland 500mls',
                'price' => '14000',
                'wholesale_price' => '13500'
                ,

            ],
            [
                'name' => 'Mainland 250mls',
                'price' => '8500',
                'wholesale_price' => '8000',

            ],
            [
                'name' => 'Tylonor 20% 100mls',
                'price' => '8500',
                'wholesale_price' => '8000',

            ],
            [
                'name' => 'BAOXYCLINE 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'BAOXYCLINE 250mls',
                'price' => '8000',
                'wholesale_price' => '7500',

            ],
            [
                'name' => 'Paranex 100mls',
                'price' => '6000',
                'wholesale_price' => '5700',

            ],
            [
                'name' => 'Paranex 250mls',
                'price' => '12500',
                'wholesale_price' => '12000'
                ,

            ],
            [
                'name' => 'Paranex 1/2 Litre',
                'price' => '23000',
                'wholesale_price' => '22000'
                ,

            ],
            [
                'name' => 'Paranex 1 Litre',
                'price' => '43000',
                'wholesale_price' => '42000'
                ,

            ],
            [
                'name' => 'Rol-vin 200g',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'Rol-vin dust 100g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Ultra-vin dust 50g',
                'price' => '2500',
                'wholesale_price' => '2000',

            ],
            [
                'name' => 'Ultra-vin dust 100g',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Ultra-vin dust 200g',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'Pig-Booster 2kg',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Josera 2kg',
                'price' => '12000',
                'wholesale_price' => '11000'
                ,

            ],
            [
                'name' => 'Mlolombe mix 2kg',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'D.C.P 1/2 kg',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'D.C.P 1kg',
                'price' => '5000',
                'wholesale_price' => '4000',

            ],
            [
                'name' => 'Baoxetra 50mls',
                'price' => '2500',
                'wholesale_price' => '2000',

            ],
            [
                'name' => 'Baoxetra 10% 100mls',
                'price' => '3000',
                'wholesale_price' => '2800',

            ],
            [
                'name' => 'Baoxetra 20% 100mls',
                'price' => '4000',
                'wholesale_price' => '3800',

            ],
            [
                'name' => 'Baoxetra 250mls',
                'price' => '8000',
                'wholesale_price' => '7500',

            ],
            [
                'name' => 'Basulpha injection 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'OXY-pit injection 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'OXY-pit injection 250mls',
                'price' => '9000',
                'wholesale_price' => '8500',

            ],
            [
                'name' => 'OXY-pit injection 500mls',
                'price' => '14000',
                'wholesale_price' => '13500'
                ,

            ],
            [
                'name' => 'Kilati 500mls',
                'price' => '22000',
                'wholesale_price' => '21000'
                ,

            ],
            [
                'name' => 'Kilati 1 Litre',
                'price' => '42000',
                'wholesale_price' => '41000'
                ,

            ],
            [
                'name' => 'Super Dip 2 Litre',
                'price' => '28000',
                'wholesale_price' => '27000'
                ,

            ],
            [
                'name' => 'Super Dip 1/2 Litre',
                'price' => '15000',
                'wholesale_price' => '14000'
                ,

            ],
            [
                'name' => 'Super Dip 3/4 Litre',
                'price' => '9000',
                'wholesale_price' => '8500',

            ],
            [
                'name' => 'R9 Super Dip 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'R9-Traz 1 Litre',
                'price' => '25000',
                'wholesale_price' => '23000'
                ,

            ],
            [
                'name' => 'R9-Traz 1/2 Litre',
                'price' => '14000',
                'wholesale_price' => '13000'
                ,

            ],
            [
                'name' => 'R9-Traz 250mls',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'Snowtaz 100mls',
                'price' => '3500',
                'wholesale_price' => '3000',

            ],
            [
                'name' => 'Snowtaz 1/2 Litre',
                'price' => '14000',
                'wholesale_price' => '13000'
                ,

            ],
            [
                'name' => 'Snowtaz 1 Litre',
                'price' => '25000',
                'wholesale_price' => '23000'
                ,

            ],
            [
                'name' => 'Double dip 100mls',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Double dip 200mls',
                'price' => '7500',
                'wholesale_price' => '7000',

            ],
            [
                'name' => 'Double dip 500mls',
                'price' => '14000',
                'wholesale_price' => '13000'
                ,

            ],
            [
                'name' => 'Double dip 1 Litre',
                'price' => '25000',
                'wholesale_price' => '24000'
                ,

            ],
            [
                'name' => 'Rol-Dip 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Rol-Dip 250mls',
                'price' => '8500',
                'wholesale_price' => '8000',

            ],
            [
                'name' => 'Rol-Dip 500mls',
                'price' => '15000',
                'wholesale_price' => '14500'
                ,

            ],
            [
                'name' => 'Rol-Dip 1 Litre',
                'price' => '29000',
                'wholesale_price' => '28000'
                ,

            ],
            [
                'name' => 'Alphatix 40mls',
                'price' => '2500',
                'wholesale_price' => '2200',

            ],
            [
                'name' => 'Alphatix 100mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Duo-Dip 100mls',
                'price' => '8000',
                'wholesale_price' => '7500',

            ],
            [
                'name' => 'Duo-Dip 200mls',
                'price' => '15000',
                'wholesale_price' => '14500'
                ,

            ],
            [
                'name' => 'Duo-Dip 500mls',
                'price' => '30000',
                'wholesale_price' => '29000'
                ,

            ],
            [
                'name' => 'Duo-Dip 1 Litre',
                'price' => '60000',
                'wholesale_price' => '58000'
                ,

            ],
            [
                'name' => 'Alba-Dip 100mls',
                'price' => '3000',
                'wholesale_price' => '27000'
                ,

            ],
            [
                'name' => 'Albadip 250mls',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Albadip 1/2 Litre',
                'price' => '12000',
                'wholesale_price' => '11000'
                ,

            ],
            [
                'name' => 'Albadip 1 Litre',
                'price' => '22000',
                'wholesale_price' => '21000'
                ,

            ],
            [
                'name' => 'Albevet 10% 1 Litre',
                'price' => '14000',
                'wholesale_price' => '13500'
                ,

            ],
            [
                'name' => 'Albevet 10% 1/2 Litre',
                'price' => '8000',
                'wholesale_price' => '7500',

            ],
            [
                'name' => 'Bamitraz 100mls',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Bamitraz 250mls',
                'price' => '0',
                'wholesale_price' => '0',

            ],
            [
                'name' => 'Bamitraz 500mls',
                'price' => '9000',
                'wholesale_price' => '8500',

            ],
            [
                'name' => 'Bamitraz 1 Litre',
                'price' => '20000',
                'wholesale_price' => '18500'
                ,

            ],
            [
                'name' => 'Cybadip 100mls',
                'price' => '3000',
                'wholesale_price' => '2500',

            ],
            [
                'name' => 'Cybadip 250mls',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Cybadip 1/2 Litre',
                'price' => '9000',
                'wholesale_price' => '8500',

            ],
            [
                'name' => 'Cybadip 1 Litre',
                'price' => '20000',
                'wholesale_price' => '18500'
                ,

            ],
            [
                'name' => 'Likilik 100mls',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Kilati 100mls',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Parafix 100mls',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Kilati 250mls',
                'price' => '12500',
                'wholesale_price' => '12000'
                ,

            ],
            [
                'name' => 'Miltzash 1/2 Litre',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'Miltzash 1 Litre',
                'price' => '17000',
                'wholesale_price' => '16000'
                ,

            ],
            [
                'name' => 'Levafas 1 Litre',
                'price' => '22000',
                'wholesale_price' => '21000'
                ,

            ],
            [
                'name' => 'Levafas 1/2 Litre',
                'price' => '12500',
                'wholesale_price' => '12000'
                ,

            ],
            [
                'name' => 'Levafas 125mls',
                'price' => '4000',
                'wholesale_price' => '3700',

            ],
            [
                'name' => 'Milvasol 1 Litre',
                'price' => '18000',
                'wholesale_price' => '17000'
                ,

            ],
            [
                'name' => 'Milvasol 1/2 Litre',
                'price' => '10000',
                'wholesale_price' => '9000',

            ],
            [
                'name' => 'Albevet 2.5% 1 Litre',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Albevet 2.5% 1/2 Litre',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Albevet 2.5% 120mls',
                'price' => '1500',
                'wholesale_price' => '1200',

            ],
            [
                'name' => 'Dawasole 1 Litre',
                'price' => '8000',
                'wholesale_price' => '7500',

            ],
            [
                'name' => 'Dawasole 1/2 Litre',
                'price' => '5000',
                'wholesale_price' => '4500',

            ],
            [
                'name' => 'Levimox Gold 1 Litre',
                'price' => '18500',
                'wholesale_price' => '18000'
                ,

            ],
            [
                'name' => 'Levimox Gold 1/2 Litre',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'Levimox Gold 150mls',
                'price' => '4000',
                'wholesale_price' => '3800',

            ],
            [
                'name' => 'ALBENOR 2.5% 1 Litre',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'ALBENOR 2.5% 1/2 Litre',
                'price' => '4000',
                'wholesale_price' => '3500',

            ],
            [
                'name' => 'Farmbendazole 1 Litre 2.5%',
                'price' => '6000',
                'wholesale_price' => '5500',

            ],
            [
                'name' => 'Farmbendazole 120mls 2.5%',
                'price' => '1500',
                'wholesale_price' => '1200',

            ],
            [
                'name' => 'Baoxile 1 Litre',
                'price' => '16000',
                'wholesale_price' => '15500'
                ,

            ],
            [
                'name' => 'Baoxile 1/2 Litre',
                'price' => '8500',
                'wholesale_price' => '8000',

            ],
            [
                'name' => 'Alamycin spray',
                'price' => '10000',
                'wholesale_price' => '9500',

            ],
            [
                'name' => 'Duo-Dip 50mls',
                'price' => '5000',
                'wholesale_price' => '4000',

            ],
        ];

        // // Sort alphabetically by name
// $products = collect($products)->sortBy('name')->values()->all();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                "name" => $product['name'],
                'slug' => Str::slug($product['name']),
                'price' => $product['price'],
                'wholesale_price' => $product['wholesale_price'],
                'buying_price' => '0',
                'created_at' => now(),
                'updated_at' => now(),

            ];
        }

        // Sort alphabetically by the name field afer build
        $data = collect($data)->sortBy('name')->values()->all();

        DB::table('products')->insert($data);

    }
}
