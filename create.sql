create table Movie (
	id int, 					
	title varchar(100),
	year int,
	rating varchar(10),
	company varchar(50), 
	PRIMARY KEY(id)								-- primary key; this uniquely identifies each Movie
) ENGINE=INNODB;

create table Actor (
	id int,						
	last varchar(20),
	first varchar(20),
	sex varchar(6),				
	dob date,
	dod date,
	PRIMARY KEY(id)								-- primary key; this uniquely identifies each Actor
) ENGINE=INNODB;

create table Sales (
	mid int,					
	ticketsSold int,			
	totalIncome int,
	FOREIGN KEY (mid) references Movie(id),		-- foreign key; this key links to the primary key of the Movie table and ensures that every row in Sales corresponds to an existing Movie
	UNIQUE(mid),								-- this ensures that we don't have more than one set of sales data for a single movie
	CHECK(ticketsSold >= 0)						-- CHECK constraint ensures that number of ticket sales makes senses (nonnegative)
) ENGINE=INNODB;

create table Director (	
	id int,						
	last varchar(20),
	first varchar(20),
	dob date,
	dod date,
	PRIMARY KEY(id)								-- primary key; this uniquely identifies each Director
) ENGINE=INNODB;

create table MovieGenre (
	mid int,							
	genre varchar(20),
	FOREIGN KEY (mid) references Movie(id)		-- foreign key; this key links to the primary key of the Movie table and ensures that every row in MovieGenre corresponds to an existing Movie
) ENGINE=INNODB;

create table MovieDirector (
	mid int,					
	did int,					
	FOREIGN KEY (mid) references Movie(id),		-- foreign key; this key links to the primary key of the Movie table and ensures that every row in MovieDirector corresponds to an existing Movie
	FOREIGN KEY (did) references Director(id)	-- foreign key; this key links to the primary key of the Director table and ensures that every row in MovieDirector corresponds to an existing Director
) ENGINE=INNODB;

create table MovieActor (
	mid int,
	aid int,				
	role varchar(50),
	FOREIGN KEY (mid) references Movie(id),		-- foreign key; this key links to the primary key of the Movie table and ensures that every row in MovieActor corresponds to an existing Movie
	FOREIGN KEY (aid) references Actor(id)		-- foreign key; this key links to the primary key of the Actor table and ensures that every row in MovieActor corresponds to an existing Actor
) ENGINE=INNODB;

create table MovieRating (
	mid int,			
	imdb int,					
	rot int,					
	FOREIGN KEY (mid) references Movie(id),		-- foreign key; this key links to the primary key of the Movie table and ensures that every row in MovieRating corresponds to an existing Movie
	CHECK(imdb >= 0 AND imdb <= 100),			-- CHECK constraint ensures that imdb rating number is in the correct range (between 0 and 100, inclusive)
	CHECK(rot >= 0 AND rot <= 100)				-- CHECK constraint ensures that rotten tomatoes rating number is in the correct range (between 0 and 100, inclusive)
) ENGINE=INNODB;

create table Review (
	name varchar(20),
	time timestamp,
	mid int,
	rating int,
	comment varchar(500),
	FOREIGN KEY (mid) references Movie(id)		-- foreign key; this key links to the primary key of the Movie table and ensures that every row in Review corresponds to an existing Movie
) ENGINE=INNODB;

create table MaxPersonID (
	id int
) ENGINE=INNODB;

create table MaxMovieID (
	id int
) ENGINE=INNODB;
