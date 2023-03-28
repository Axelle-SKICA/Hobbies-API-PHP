BEGIN;

INSERT INTO level (name) VALUES 
    ('Really bad'),
    ('OK'),
    ('Good'),
    ('Really good')
;

INSERT INTO category (name) VALUES 
    ('Arts & crafts'),
    ('Food & beverages'),
    ('Litterature'),
    ('Movies & series'),
    ('Botanics'),
    ('Nature'),
    ('Socializing'),
    ('Sports'),
    ('Discovering the world'),
    ('Hidden talents')
;

INSERT INTO hobby (name, start_year, level_id) VALUES
('Knitting', 2000, 1),
('Crocheting', 2018, 3),
('Baking Xmas cookies', 2002, 4),
('Eating at restaurants', 1992, 4),
('Having healthy plants', 2017, 2),
('Drinking beer', 2009,3),
('Reading Harry Potter', 2000, 4),
('Reading english books', 2005,4),
('Watching Friday Night Lights (series)', 2008, 4),
('Hiking on volcanoes near Clermont-Ferrand', 2022, 3),
('Golfing', 2017, 2),
('Yoga', 2020, 1),
('Running', 2007, 2),
('Traveling (NZ, USA, Europe...)', 1990, 4),
('Petting dogs', 1990, 4),
('Singing in the shower', 1995, 1),
('Watching Xmas movies', 1996, 4)
;

INSERT INTO hobby_has_category (hobby_id, category_id) VALUES
(1,1),
(2,1),
(3,2),
(4,2),
(4,7),
(4,9),
(5,5),
(6,2),
(6,7),
(7,3),
(8,3),
(9,4),
(10,6),
(10,9),
(11,6),
(11,7),
(11,8),
(12,8),
(13,6),
(13,8),
(14,7),
(14,9),
(15,6),
(15,7),
(16,10),
(17,4)
;

COMMIT;
