
drop schema if exists design_patterns cascade;

create schema design_patterns;

create table if not exists design_patterns.grades (
    student_id integer,
    exam text,
    value numeric
);

create table if not exists design_patterns.averages (
    student_id integer,
    value numeric
);


-- select * from design_patterns.grades;

-- select * from design_patterns.averages;