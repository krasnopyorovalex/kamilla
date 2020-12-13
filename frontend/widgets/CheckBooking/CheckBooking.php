<?php

namespace frontend\widgets\CheckBooking;

use frontend\forms\CheckBookingForm;
use yii\base\Widget;

class CheckBooking extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('check_booking.twig', [
            'model' => new CheckBookingForm()
        ]);
    }
}