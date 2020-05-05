<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Dnetix\Redirection\PlacetoPay;
use App\Models\Order;

class SweepOrders extends Command
{
    /**
     * PlacetoPay For queries.
     *
     * @var string
     */
    protected $placetopay;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sweep:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sweep orders whith PENDING status every 15 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection/',
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ]);
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'SE EJECUTO';
        $now = new \DateTime();
        $ordersPending = Order::whereDate("updated_at",$now)
        ->where('status',1)
        ->orWhere('status',4)
        ->get();

        foreach ($ordersPending as $item) {
            $interval = $now->diff($item->updated_at);
            if($interval->format('%i') > 7){
                $response = $this->placetopay->query($item->requestId);
                if ($response->isSuccessful()) {
                    if ($response->status()->isApproved()) {
                        $item->status = 2;
                        $item->save();
                        echo 'SE CAMBIO EL ESTADO DE: ORDERID: '. $item->id;
                    }
                }
            }
        }
        
    }
}
