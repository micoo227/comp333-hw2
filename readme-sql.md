## Step 1

Start the web server using XAMPP. Then, go to http://localhost:8080/phpmyadmin/ to access the interface for the web app database. Within this interface, create a new database called "music-db" by clicking on "New" on the left-hand panel.

## Step 2

Create the users table inside music-db:

```sql
CREATE TABLE users (username VARCHAR(255) PRIMARY KEY NOT NULL,
    password VARCHAR(255));
```

Insert two accounts into the users table:

```sql
INSERT INTO users (username, password)
    VALUES ("Amelia-Earhart", "Youaom139&yu7");
INSERT INTO users (username, password)
    VALUES ("Otto", "StarWars2*");
```

## Step 3

Create the artists table inside music-db:

```sql
CREATE TABLE artists (song VARCHAR(255) PRIMARY KEY,
    artist VARCHAR(255));
```

Insert the following entries into the artists table:

```sql
INSERT INTO artists (song, artist)
    VALUES ("Freeway", "Aimee Mann");
INSERT INTO artists (song, artist)
    VALUES ("Days of Wine and Roses", "Bill Evans");
INSERT INTO artists (song, artist)
    VALUES ("These Walls", "Kendrick Lamar");
```

## Step 4

Create the ratings table inside music-db:

```sql
CREATE TABLE ratings (id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    song VARCHAR(255),
    ratings INT,
    FOREIGN KEY (song) REFERENCES artists(song) ON DELETE CASCADE,
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE);
```

Insert the following entries into the ratings table:

```sql
INSERT INTO ratings (username, song, ratings)
    VALUES ("Amelia-Earhart", "Freeway", 3);
INSERT INTO ratings (username, song, ratings)
    VALUES ("Amelia-Earhart", "Days of Wine and Roses", 4);
INSERT INTO ratings (username, song, ratings)
    VALUES ("Otto", "Days of Wine and Roses", 5);
INSERT INTO ratings (username, song, ratings)
    VALUES ("Amelia-Earhart", "These Walls", 4);
```