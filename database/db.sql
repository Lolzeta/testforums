CREATE TABLE users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(255) NOT NULL,
    email       VARCHAR(255) NOT NULL,
    password    VARCHAR(255) NOT NULL,
    created_at  TIMESTAMP NOT NULL default now(),
    updated_at  TIMESTAMP NOT NULL default now() on update now()
)Engine=INNODB;

CREATE TABLE rooms (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT NOT NULL,
    name        VARCHAR(100) NOT NULL,
    description VARCHAR(255) NULL,
    cathegory VARCHAR(255) NOT NULL,
    created_at  TIMESTAMP NOT NULL default now(),
    updated_at  TIMESTAMP NOT NULL default now() on update now(),

    CONSTRAINT fk_room_user FOREIGN KEY(user_id) REFERENCES users(id)
)Engine=INNODB;

CREATE TABLE logins (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(255) NOT NULL,
    ip          VARCHAR(100) NOT NULL,
    browser     VARCHAR(255) NOT NULL,
    status      ENUM('OK','FAULT') NOT NULL,
    created_at  TIMESTAMP NOT NULL default now()
);

CREATE TABLE items (
    id			int PRIMARY KEY AUTO_INCREMENT,
    room_id 	int NOT null,
    description	varchar(255) not null,
    cathegory varchar(255) not null,
    created_at	TIMESTAMP NOT NULL default now(),
    updated_at	TIMESTAMP NOT NULL default now() on update now(),
    
    CONSTRAINT fk_room_item FOREIGN KEY(room_id) REFERENCES rooms(id)
)Engine=INNODB;