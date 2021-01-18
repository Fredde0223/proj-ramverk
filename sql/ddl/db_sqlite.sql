--
-- SQL-file creating tables
--



--
-- User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "acronym" TEXT UNIQUE NOT NULL,
    "password" TEXT,
    "email" TEXT,
    "city" TEXT,
    "country" TEXT,
    "activityscore" INTEGER
);

--
-- Question
--
DROP TABLE IF EXISTS Question;
CREATE TABLE Question (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "useracronym" TEXT NOT NULL,
    "title" TEXT NOT NULL,
    "content" TEXT NOT NULL,
    "tag1" TEXT,
    "tag2" TEXT,
    "tag3" TEXT,
    FOREIGN KEY (userid) REFERENCES User(id)
);

--
-- Answer
--
DROP TABLE IF EXISTS Answer;
CREATE TABLE Answer (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "useracronym" TEXT NOT NULL,
    "questionid" INTEGER NOT NULL,
    "content" TEXT NOT NULL,
    FOREIGN KEY (userid) REFERENCES User(id),
    FOREIGN KEY (questionid) REFERENCES Question(id)
);

--
-- CommentQ (comments for questions)
--
DROP TABLE IF EXISTS CommentQ;
CREATE TABLE CommentQ (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "useracronym" TEXT NOT NULL,
    "questionid" INTEGER NOT NULL,
    "content" TEXT NOT NULL,
    FOREIGN KEY (userid) REFERENCES User(id),
    FOREIGN KEY (questionid) REFERENCES Question(id)
);

--
-- CommentA (comments for answers)
--
DROP TABLE IF EXISTS CommentA;
CREATE TABLE CommentA (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "useracronym" TEXT NOT NULL,
    "answerid" INTEGER NOT NULL,
    "content" TEXT NOT NULL,
    FOREIGN KEY (userid) REFERENCES User(id),
    FOREIGN KEY (answerid) REFERENCES Answer(id)
);

--
-- Tag
--
DROP TABLE IF EXISTS Tag;
CREATE TABLE Tag (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "word" TEXT NOT NULL
);

--
-- Insert tag words
--
INSERT INTO Tag (word) VALUES ("Ball");
INSERT INTO Tag (word) VALUES ("Player");
INSERT INTO Tag (word) VALUES ("Arena");
INSERT INTO Tag (word) VALUES ("Match");
INSERT INTO Tag (word) VALUES ("Fans");
INSERT INTO Tag (word) VALUES ("Injury");
INSERT INTO Tag (word) VALUES ("Coach");
