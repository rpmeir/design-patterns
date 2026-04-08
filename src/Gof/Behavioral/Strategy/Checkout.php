<?php

namespace Src\Gof\Behavioral\Strategy;

class Checkout
{
    public function __construct(
        private readonly ParkingTicketRepository $parkingTicketRepository
    ) {
    }

    public function execute(CheckoutInput $input): CheckoutOutput
    {
        $parkingTicket = $this->parkingTicketRepository->getByPlate($input->plate);
        if ($parkingTicket === null) {
            throw new VehicleNotFoundException('Vehicle not found');
        }
        if ($parkingTicket->getCheckoutDate() !== null) {
            throw new VehicleAlreadyCheckoutException('Vehicle already checkout');
        }
        $parkingTicket->checkout($input->checkoutDate);
        $this->parkingTicketRepository->update($parkingTicket);

        return new CheckoutOutput(
            plate: $parkingTicket->plate,
            fare: $parkingTicket->getFare()
        );
    }
}
