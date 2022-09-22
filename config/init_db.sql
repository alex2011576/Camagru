-- Create DB --
create database if not exists mycamagru_db;

-- Users table --
create table if not exists mycamagru_db.users (
	user_id int auto_increment primary key,
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