Application working video Link: 
https://drive.google.com/file/d/1Jj87D5mduejsaVar4j_U7Pf3HtzGN45I/view?usp=sharing

Host url : http://dctlko.free.nf/index.html

File structure

online-voting-system/
├──index.html
├── admin/
│   ├── index.php
│   ├── login.php
│   ├── manage_candidates.php
│   ├── results.php
│   └── assets/
│       ├── css/
│       └── js/
├── user/
│   ├── index.php
│   └── vote.php
├── db/
│   └── db_connect.php
└── uploads/


user name: admin
password : admin123

INSERT INTO admin (username, password) 
VALUES ('admin', 'admin123');


DATA BASE DESIGN
database name : online_voting.

1. candidates table
   
CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    votes INT DEFAULT 0
);

2.admin table
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

3.votes table to track user votes
    CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    candidate_id INT NOT NULL,
    FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);






