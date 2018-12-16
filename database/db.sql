CREATE TABLE users (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    username        VARCHAR(255) NOT NULL,
    email           VARCHAR(255) NOT NULL,
    password        VARCHAR(255) NOT NULL,
    created_at      TIMESTAMP NOT NULL default now(),
    updated_at      TIMESTAMP NOT NULL default now() on update now()
)Engine=INNODB;

CREATE TABLE rooms (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL,
    name            VARCHAR(100) NOT NULL,
    category        VARCHAR(100) NOT NULL,
    description     VARCHAR(255) NULL,
    created_at      TIMESTAMP NOT NULL default now(),
    updated_at      TIMESTAMP NOT NULL default now() on update now(),

    CONSTRAINT fk_room_user FOREIGN KEY(user_id) REFERENCES users(id)
)Engine=INNODB;

CREATE TABLE logins (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    username        VARCHAR(255) NOT NULL,
    ip              VARCHAR(100) NOT NULL,
    browser         VARCHAR(255) NOT NULL,
    status          ENUM('OK','FAULT') NOT NULL,
    created_at      TIMESTAMP NOT NULL default now()
);

CREATE TABLE threads (
    id			    int PRIMARY KEY AUTO_INCREMENT,
    room_id 	    int NOT null,
    user_id         int NOT null,
    name            VARCHAR(100) NOT NULL,
    description	    varchar(255) not null,
    created_at	    TIMESTAMP NOT NULL default now(),
    updated_at	    TIMESTAMP NOT NULL default now() on update now(),
    
    CONSTRAINT fk_room_thread FOREIGN KEY(room_id) REFERENCES rooms(id) ON DELETE CASCADE,
    CONSTRAINT fk_thread_user FOREIGN KEY(user_id) REFERENCES users(id)
)Engine=INNODB;

CREATE TABLE messages (
    id			    int PRIMARY KEY AUTO_INCREMENT,
    user_id         int NOT null,
    thread_id 	    int NOT null,
    description     varchar(255) not null,
    created_at	    TIMESTAMP NOT NULL default now(),
    updated_at	    TIMESTAMP NOT NULL default now() on update now(),
    
    CONSTRAINT fk_thread_message FOREIGN KEY(thread_id) REFERENCES threads(id) ON DELETE CASCADE,
    CONSTRAINT fk_message_user FOREIGN KEY(user_id) REFERENCES users(id)
)Engine=INNODB;