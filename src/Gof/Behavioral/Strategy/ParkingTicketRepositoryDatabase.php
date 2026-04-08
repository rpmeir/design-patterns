<?php

namespace Src\Gof\Behavioral\Strategy;

class ParkingTicketRepositoryDatabase implements ParkingTicketRepository
{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function getByPlate(string $plate): ?ParkingTicket
    {
        $result = $this->connection->query('SELECT * FROM design_patterns.parking_tickets WHERE plate = :plate', ['plate' => $plate]);
        if (empty($result)) {
            return null;
        }
        $data = $result[0];
        return new ParkingTicket(
            plate: $data['plate'],
            checkinDate: new \DateTimeImmutable($data['checkin_date']),
            location: $data['location']
        );
    }

    public function save(ParkingTicket $parkingTicket): void
    {
        $this->connection->execute(
            'INSERT INTO design_patterns.parking_tickets (plate, checkin_date, location, fare) VALUES (:plate, :checkin_date, :location, :fare)',
            [
                'plate' => $parkingTicket->plate,
                'checkin_date' => $parkingTicket->checkinDate->format('Y-m-d H:i:s'),
                'location' => $parkingTicket->location,
                'fare' => $parkingTicket->getFare(),
            ]
        );
    }

    public function update(ParkingTicket $parkingTicket): void
    {
        $this->connection->execute(
            'UPDATE design_patterns.parking_tickets SET checkout_date = :checkout_date, fare = :fare WHERE plate = :plate',
            [
                'checkout_date' => $parkingTicket->getCheckoutDate()?->format('Y-m-d H:i:s'),
                'fare' => $parkingTicket->getFare(),
                'plate' => $parkingTicket->plate,
            ]
        );
    }
}
