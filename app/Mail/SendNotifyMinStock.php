<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotifyMinStock extends Mailable
{
    use Queueable, SerializesModels;

    public $detail;
    public $level;
    public $introLines;
    public $outroLines;
    public $greeting;


    public function __construct($products)
    {
        $this->level = 'success';
        $this->introLines = [
            __('The stock of the following products is below the minimum:'),
            __("Please, check the stock of the products")
        ];
        $this->outroLines = [
            __('Create a new ingress to increase the stock of the products'),
            __('Thanks for using our application!')
        ];

        foreach ($products as $product) {
            $this->detail[] = [
                'name' => $product->name,
                'stock' => $product->stock,
                'min_stock' => $product->stock_min
            ];
        }

        $this->greeting = __('Hello!');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('Stock min Notifications'))
            ->markdown('emails.stock.stock_min');
    }
}
