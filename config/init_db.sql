-- Create DB --
create database if not exists mycamagru_db;

-- Users table --
create table if not exists mycamagru_db.users (
	user_id int not null auto_increment primary key,
	username varchar(20) not null,
	email varchar(255) not null,
	password varchar(255) not null,
	is_admin int not null default 0,
	active tinyint not null default 0,
	activation_code varchar(255) not null,
	activation_expiry datetime not null,
	activated_at datetime default null,
	notifications tinyint not null default 1,
	created_at timestamp not null default current_timestamp(),
	updated_at datetime default current_timestamp() on update current_timestamp()
);

-- Reset Password Table --
create table if not exists mycamagru_db.password_reset(
	id int not null auto_increment primary key,
	user_id int not null,
	email varchar(255) not null,
	reset_expiry datetime not null,
	reset_code varchar(255) not null,
	foreign key (user_id)
		references mycamagru_db.users (user_id)
		on delete cascade
);

-- Posts table --
create table if not exists mycamagru_db.posts (
	post_id int not null auto_increment primary key,
	owner_id int not null,
	post longblob not null,
	post_description varchar(250) not null,
	created_at timestamp not null default current_timestamp(),
	foreign key (owner_id)
		references mycamagru_db.users (user_id)
		on delete cascade
);

-- Likes table --
create table if not exists mycamagru_db.likes (
	like_id	int auto_increment primary key,
	post_id int not null,
	user_id int not null,
	unique key post_and_user_unique (post_id, user_id),
	foreign key (post_id)
		references mycamagru_db.posts (post_id)
		on delete cascade,
	foreign key (user_id)
		references mycamagru_db.users (user_id)
		on delete cascade 
);

-- Comment table --
create table if not exists mycamagru_db.comments (
	comment_id int auto_increment primary key,
	post_id int not null,
	comment varchar(1000) not null,
	comment_owner_id int not null,
	created_at timestamp not null default current_timestamp(),
	foreign key (post_id)
		references mycamagru_db.posts (post_id)
		on delete cascade,
	foreign key (comment_owner_id)
		references mycamagru_db.users (user_id)
		on delete cascade
);

