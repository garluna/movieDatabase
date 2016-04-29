-- EXERCISE 1 --
-- Select all actors in the movie 'Die Another Day'
-- Format is <first> <last> with a space in between
select concat(first, ' ', last)
from Actor, MovieActor, Movie
where Actor.id = MovieActor.aid and MovieActor.mid = Movie.id and title = 'Die Another Day';

-- EXERCISE 2 --
-- Output the number of actors who have acted in more than one movie
select count(distinct M.aid)
from MovieActor as M, MovieActor as M2
where M.mid <> M2.mid and M.aid = M2.aid;

-- select count(aid)
-- from MovieActor 
-- where aid in (select aid
-- 				from MovieActor
-- 				group by aid
-- 				having count(*) > 1);

-- EXERCISE 3 --
-- Select the titles of all the movies that sold over a million tickets
select title
from Movie, Sales
where id = mid and ticketsSold > 1000000;

-- EXERCISE 4 --
-- Select the titles of al action movie that are rated greater than 75 on imdb 
select title
from Movie, MovieGenre, MovieRating
where Movie.id = MovieGenre.mid 
	and MovieGenre.mid = MovieRating.mid 
	and genre='Action'
	and rot>75;

-- EXERCISE 5 --
-- Produce a list of movies and their directors ordered by rating from worst to best
select title, concat(first, ' ', last)
from MovieDirector, Director, MovieRating, Movie
where MovieDirector.did = Director.id 
	and MovieDirector.mid=MovieRating.mid 
	and Movie.id=MovieRating.mid
order by MovieRating.imdb asc;