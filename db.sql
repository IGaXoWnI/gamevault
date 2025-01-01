create database gamevault;


create table users(
    user_id int AUTO_INCREMENT primary key not null ,
    username varchar(100) not null unique ,
    user_email varchar(150) not null unique ,
    user_password varchar(100) not null ,
    role varchar(25) not null 
);



create table games(
    game_id int AUTO_INCREMENT primary key not null,
    game_title varchar(100) not null ,
    game_description varchar(250) not null ,
    game_img varchar(300) not null ,
    genre varchar(50) not null ,
    added_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    release_date date not null ,
    user_id bigint references users(user_id) 

);
