-- Set this up before running database related tests
-- NOTE: You'll need to edit tests-config.php with your DB location
create table users (
    userID int(9) unsigned not null auto_increment,
    username char(15) not null,
    password char(15) not null,
    PRIMARY KEY (userID),
    UNIQUE (username)
) ENGINE=InnoDB CHARSET=utf8;

INSERT INTO users (username, password) VALUES ('joestump', 'password');
INSERT INTO users (username, password) VALUES ('foobar', 'hello');
INSERT INTO users (username, password) VALUES ('dburka', 'bazzerszl');

