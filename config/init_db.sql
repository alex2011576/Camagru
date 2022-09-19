-- Create DB --
create database if not exists mycamagru_db;

-- Users table --
create table if not exists mycamagru_db.users (
	user_id int auto_increment primary key,
	username varchar(10) not null,
	email varchar(100) not null,
	password text not null,
	active tinyint not null default 0,
	activation_code text not null,
	activated_at datetime default null,
	notifications tinyint not null default 1,
	created_at timestamp not null default current_timestamp(),
	updated_at datetime default current_timestamp() on update current_timestamp()
);