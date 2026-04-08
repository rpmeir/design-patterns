
drop schema if exists design_patterns cascade;

create schema design_patterns;

create table if not exists design_patterns.parking_tickets (
    plate text,
    checkin_date timestamp,
    checkout_date timestamp,
    fare numeric,
    location text
);


-- select * from design_patterns.parking_tickets;
