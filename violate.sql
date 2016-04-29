-- PRIMARY KEY CONSTRAINT VIOLATIONS -- 
-- 1
-- Violates primary key constraint on Movie table by attempting to add 
-- two new rows with same id (primary key must be unique)
insert into Movie
	values (1, 'Some Movie', 1995, 'R', 'Fox Film Corporation');

insert into Movie
	values (1, 'Another Movie', 1996, 'PG', 'Fox Film Corporation');


-- 2
-- Violates primary key constraint on Actor table by attempting to add 
-- two new rows with same id (primary key must be unique)
insert into Actor
	values (1, 'Doe', 'Jane', 'Female', 19750525, 19750525);

insert into Actor
	values (1, 'Doe', 'John', 'Male', 19830412, 20110422);


-- 3
-- Violates primary key constraint on Director table by attempting to add 
-- two new rows with same id (primary key must be unique)
insert into Director
	values (1, 'Doe', 'Jane', 19750525, 19750525);

insert into Director
	values (1, 'Doe', 'John', 19830412, 20110422);




-- REFERENTIAL INTEGRITY CONSTRAINT VIOLATIONS -- 
-- 1 
-- Violates referential integrity constraint that links Sales' mid attribute
-- to the primary key of Movie by attempting to create a row in Sales with an mid
-- that is not present as an id in Movie
insert into Sales
	values (-1, 40, 40000);


-- 2 
-- Violates referential integrity constraint that links MovieGenre's mid attribute
-- to the primary key of Movie by attempting to create a row in MovieGenre with an mid
-- that is not present as an id in Movie
insert into MovieGenre
	values (-1, 'Action');


-- 3
-- Violates referential integrity constraint that links MovieDirector's mid attribute
-- to the primary key of Movie by attempting to create a row in MovieDirector with an mid
-- that is not present as an id in Movie
insert into MovieDirector
	values (-1, 112);


-- 4
-- Violates referential integrity constraint that links MovieDirector's did attribute
-- to the primary key of Director by attempting to create a row in MovieDirector with a did
-- that is not present as an id in Director
insert into MovieDirector
	values (3, -1);


-- 5
-- Violates referential integrity constraint that links MovieActor's mid attribute
-- to the primary key of Movie by attempting to create a row in MovieActor with an mid
-- that is not present as an id in Movie
insert into MovieActor
	values (-1, 10208, 'Cabbage eater');


-- 6
-- Violates referential integrity constraint that links MovieActor's aid attribute
-- to the primary key of Actor by attempting to create a row in MovieActor with an aid
-- that is not present as an id in Actor
insert into MovieActor
	values (100, -1, 'Loofa holder');


-- 7
-- Violates referential integrity constraint that links MovieRating's mid attribute
-- to the primary key of Movie by attempting to create a row in MovieRating with an mid
-- that is not present as an id in Movie
insert into MovieRating
	values (-1, 50, 22);


-- 8
-- Violates referential integrity constraint that links Review's mid attribute
-- to the primary key of Movie by attempting to create a row in Review with an mid
-- that is not present as an id in Movie
insert into Review
	values ('Bob Fred', '2000-05-21 02:30:54', -1, 100, 'Twas good');




-- CHECK CONSTRAINT VIOLATIONS -- 
-- 1
-- Violates CHECK constraint on 'ticketsSold' attribute in 'Sales' by attempting to
-- insert a ticketsSold value not in the range (ticketsSold >= 0) the constraint enforces
insert into Sales
	values (272, -3, 20140);


-- 2
-- Violates CHECK constraint on 'imdb' attribute in 'MovieRating' by attempting to
-- insert a imdb value not in the range (imdb >= 0 and imdb <= 100) the constraint enforces
insert into MovieRating
	values (272, 500, 22);


-- 3
-- Violates CHECK constraint on 'rot' attribute in 'MovieRating' by attempting to
-- insert a rot value not in the range (rot >= 0 and rot <= 100) the constraint enforces
insert into MovieRating
	values (272, 50, 220);