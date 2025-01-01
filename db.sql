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
-- critique:
CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,        
    user_id INT NOT NULL,                     
    game_id INT NOT NULL,                     
             
    review TEXT,                            
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (user_id) REFERENCES users(user_id) ,
    FOREIGN KEY (game_id) REFERENCES games(game_id) 
);
-- bibliotheques
CREATE TABLE user_games (
    id INT AUTO_INCREMENT PRIMARY KEY,         
    user_id INT,                               
    game_id INT,                               
    status ENUM('en_cours', 'termine', 'abandonné') NOT NULL,  
                
    play_time INT,                            
    is_favorite BOOLEAN,                       
   added_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
   
    FOREIGN KEY (user_id) REFERENCES users(user_id),  
    FOREIGN KEY (game_id) REFERENCES games(game_id)    
);
-- chat_messages
create TABLE chat_messages{
    chat_id INT AUTO_INCREMENT PRIMARY KEY,
     user_id INT, 
     message TEXT,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(user_id)
}
CREATE TABLE favorite_games (
   favorite _id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,         
    game_id INT,       
  
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (game_id) REFERENCES games(game_id)
);
CREATE TABLE bans (
    bans_id INT AUTO_INCREMENT PRIMARY KEY,  
    user_id INT NOT NULL,                    
    banned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
    FOREIGN KEY (user_id) REFERENCES users(user_id)
  
);


