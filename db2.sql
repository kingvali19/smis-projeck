mysql -u root -p

SHOW DATABASES;

USE persons;

-- INSERT DATA

INSERT INTO persons (name, birth_date, phone)
VALUES ('Peter Wilson', '1990-07-15', '0711-020361');

INSERT INTO persons (name, birth_date, phone)
VALUES ('Carrie Simpson', '1995-05-01', '0251-031259');

INSERT INTO persons (name, birth_date, phone)
VALUES ('Victoria Ashworth', '1996-10-17', '0695-346721');

-- Show all data from persons 

SELECT * FROM persons;

-- ALTER

 ALTER TABLE persons ADD profession VARCHAR(20) AFTER name;

-- CHANGE POSITION
-- The following statement place the column fax after shipper_name column in shippers table.

mysql> ALTER TABLE persons MODIFY profession VARCHAR(20) AFTER phone;

-- Adding Constraints
mysql> ALTER TABLE persons ADD UNIQUE (phone);

-- Removing Columns
-- The basic syntax for removing a column from an existing table can be given with:

ALTER TABLE persons DROP COLUMN profession;


-- Changing Data Type of a Column
-- The following statement changes the current data type of the phone column in our shippers table from VARCHAR to CHAR and length from 20 to 15.

mysql> ALTER TABLE persons MODIFY phone CHAR(15);

-- Renaming Tables

ALTER TABLE persons RENAME personat;


-- UPDATE

UPDATE persons SET name = 'Shyhrete Buzaku'
WHERE id = 3;

-- Multiple Columns
UPDATE persons
SET name = 'John Doe', phone = '045600600'
WHERE id = 1;


-- Deleting Data from Tables from id 3

DELETE FROM persons WHERE id > 3;

-- DELETE ALL DATA

DELETE FROM persons;

-- SELECT

SELECT * FROM persons;

SELECT id, name, birth_date
FROM persons;


-- ORDER BY 

SELECT * FROM persons 
ORDER BY name ASC;

-- so it gets ordered lexically.

SELECT * FROM persons 
ORDER BY phone DESC;

SELECT * FROM persons 
ORDER BY name, phone;