<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name'=> 'Comedor De Madera',
             'description'=> '<p>Comedor de 4 puestos incluye.</p>
             <ul>
                 <li>- 4 sillas en cedro macizo pintado en el color de su elecci&oacute;n.</li>
                 <li>- Tapizado en tela tela lisa en sintentico tipo cuero o tipo lona dependiendo de sus gustos</li>
             </ul>', 
            'value' => '500000', 
            'url_image' => 'https://http2.mlstatic.com/comedor-en-cedro-4-puestos-elegante-en-oferta-D_NQ_NP_967726-MCO31117684419_062019-F.webp'],

            ['name'=> 'Escritorio',
            'description'=> '<p>COLOR: WENGUE NEO (OSCURO)</p>
            <ul>
                <li>Medidas: 100 Cm Ancho x 76,9 Cm Alto x 42,2 Cm Fondo</li>
                <li>Atributos: Escritorio b&aacute;sico con caj&oacute;n</li>
                <li>Material: Fabricado en Madera Aglomerada (MDP) y Cubierta en Melam&iacute;nico.</li>
            </ul>
            ', 
           'value' => '120000', 
           'url_image' => 'https://http2.mlstatic.com/escritorio-con-cajon-maderkit-m01140-prm-D_NQ_NP_920350-MCO31538554705_072019-O.webp'],
        ]);
    }
}
