<?php

namespace Src\Gof\Behavioral\Strategy;

class Checkin
{
    public function __construct(
        private readonly ParkingTicketRepository $parkingTicketRepository
    ) {
    }

    public function execute(CheckinInput $input): void
    {
        $existingTicket = $this->parkingTicketRepository->getByPlate($input->plate);
        if ($existingTicket !== null) {
            throw new VehicleAlreadyCheckinException('Duplicated plate');
        }
        $parkingTicket = new ParkingTicket(
            $input->plate,
            $input->checkinDate,
            $input->location
        );

        $this->parkingTicketRepository->save($parkingTicket);
    }
}
