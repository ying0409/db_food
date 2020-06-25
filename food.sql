create table customer
(c_id		varchar(5) ,
name		varchar(10) not null,
account	varchar (10) not null,
password 	varchar (10) not null,
email     varchar(35),
primary key(c_id)
	) ENGINE=INNODB;

create table manager
(m_id		varchar(5) ,
name		varchar(10) not null,
account	varchar (10) not null,
password 	varchar (10) not null,
email     varchar(35),
primary key(m_id)
	) ENGINE=INNODB;

create table shop
(s_id		varchar(5),
 m_id      varchar(5),
name		varchar(10) not null,
time_id   varchar(5),
style 	varchar(10),
phone 	varchar(10),
website   varchar(20),
address   varchar(20),
aveprice  numeric(4,0),
primary key(s_id),
foreign key (m_id) references manager(m_id)
		on delete set null
	) ENGINE=INNODB;

create table discount
(d_id		varchar(5),
content	varchar(10) not null,
primary key(d_id)
	) ENGINE=INNODB;


create table provide
(s_id		varchar(5),
d_id		varchar(5),
t_id            varchar(5),
primary key(s_id,d_id),
foreign key (s_id) references shop(s_id)
		on delete cascade,
foreign key (d_id) references discount(d_id)
		on delete cascade
	) ENGINE=INNODB;

create table menu
(s_id		varchar(5),
name		varchar(10),
price     numeric(4,0),
primary key(s_id,name,price),
foreign key (s_id) references shop(s_id)
		on delete cascade
	) ENGINE=INNODB;

create table favorate
(c_id		varchar(5),
s_id		varchar(5),
primary key(c_id,s_id),
foreign key (c_id) references customer(c_id)
		on delete cascade,
foreign key (s_id) references shop(s_id)
		on delete cascade
	) ENGINE=INNODB;

create table comment
(c_id		varchar(5),
s_id		varchar(5),
star      numeric(5,0) not null,
content   varchar(10),
primary key(c_id,s_id),
foreign key (c_id) references customer(c_id)
		on delete cascade,
foreign key (s_id) references shop(s_id)
		on delete cascade
	) ENGINE=INNODB;
