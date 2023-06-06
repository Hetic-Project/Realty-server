BEGIN;

INSERT INTO `apartment`(
    `apartment_title`,
    `apartment_description`,
    `apartment_main_picture`,
    `apartment_360_picture`,
    `apartment_adress`,
    `apartment_zip_code`,
    `apartment_city`,
    `apartment_price`,
    `apartment_size`,
    `apartment_bedroom`,
    `apartment_capacity`,
) VALUES 
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/magazine/wp-content/uploads/2015/10/vue-tour-eiffel-643x429.jpg',
    'http://localhost:4000/images/pano1.jpg',
    'Avenue D''Iéna',
    75016,
    'Paris',
    1000,
    60,
    4,
    5
),
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/photo/paris/14622/img-2023-5-12-183922.webp',
    'http://localhost:4000/images/pano2.jpg',
    'rue Poussin, à Auteuil',
    75016,
    'Paris',
    900,
    40,
    3,
    4
),
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/photo/paris/20992/salon1.webp',
    'http://localhost:4000/images/pano3.jpg',
    'Quai de Grenelle',
    75015,
    'Paris',
    500,
    30,
    3,
    4
),
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/photo/paris/22819/img-2023-5-25-145914.jpg',
    'http://localhost:4000/images/pano4.jpg',
    'Rue Saint Placide',
    75016,
    'Paris',
    1500,
    100,
    10,
    11
),
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/magazine/wp-content/uploads/2015/11/rivoli-tuileries-1024x683.jpg',
    'http://localhost:4000/images/pano5.jpg',
    'Rue de Rivoli',
    75001,
    'Paris',
    1200,
    85,
    7,
    8
),
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/magazine/wp-content/uploads/2015/11/appartement-rue-de-l_oratoire.jpg',
    'http://localhost:4000/images/pano6.jpg',
    'Quartier Louvre',
    75001,
    'Paris',
    2000,
    105,
    10,
    11
),
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/photo/paris/19900/img-2023-5-14-162817.webp',
    'http://localhost:4000/images/pano7.jpg',
    'Rue de la Tremoille',
    75018,
    'Paris',
    1500,
    90,
    10,
    11
),
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/photo/paris/16512/16512-salon2.webp',
    'http://localhost:4000/images/pano8.jpg',
    'Rue passy',
    75016,
    'Paris',
    800,
    70,
    5,
    6
),
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/magazine/wp-content/uploads/2015/11/salon-suffren-paris.jpg',
    'http://localhost:4000/images/pano9.jpg',
    'champs de mars',
    75015,
    'Paris',
    750,
    65,
    3,
    4
),
(
    'Location',
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    'https://www.book-a-flat.com/photo/paris/18631/salon.webp',
    'http://localhost:4000/images/pano10.jpg',
    'Rue Saint Honoré',
    75001,
    'Paris',
    850,
    75,
    4,
    5
);

INSERT INTO `user` (
    `user_firstname`,
    `user_lastname`,
    `user_birth`,
    `user_password`,
    `user_phone`,
    `user_address`,
    `user_zip_code`,
    `user_city`,
    `user_mail`,
    `user_statut`

) VALUES 
(
    'Kevin',
    'Bernard',
    '2004/07/10',
    '1234',
    '06-00-00-00-00',
    '5 rue du mancho',
    '42000',
    'saint étienne'
    'kevin.bernard@gmail.com'
    'Client'
),
(
    'William',
    'Vandal',
    '1990/09/29',
    '1234',
    '06-00-00-00-00',
    '5 rue du mancho',
    '42000',
    'saint étienne'
    'vandal.william@gmail.com'
    'Logistique'
),
(
    'Mohamed',
    'Yaich',
    '2001/12/07',
    '1234',
    '06-00-00-00-00',
    '5 rue du mancho',
    '42000',
    'saint étienne'
    'mohamed.yaich@gmail.com'
    'Client'
),
(
    'Lucas',
    'Yalman',
    '2004/08/20',
    '1234',
    '06-00-00-00-00',
    '5 rue du mancho',
    '42000',
    'saint étienne'
    'kevin.bernard@gmail.com'
    'Admin'
),
(
    'Tom',
    'Cardonnel',
    '2003/06/18',
    '1234',
    '06-00-00-00-00',
    '5 rue du mancho',
    '42000',
    'saint étienne'
    'kevin.bernard@gmail.com'
    'Menage'
),
(
    'Rubens',
    'Cardonnel',
    '2004/06/21',
    '1234',
    '06-00-00-00-00',
    '5 rue du mancho',
    '42000',
    'saint étienne'
    'kevin.bernard@gmail.com'
    'Menage'
),
(
    'Alexendre',
    'Cardonnel',
    '2004/06/21',
    '1234',
    '06-00-00-00-00',
    '5 rue du mancho',
    '42000',
    'saint étienne'
    'kevin.bernard@gmail.com'
    'Logistique'
);

-- Appartements
-- client_id : 1, 3

INSERT INTO `apartment_rental` (
    `apartment_rental_user_id`,
    `apartment_rental_appartement_id`,
    `apartment_rental_start`,
    `apartment_rental_end`

) VALUES 
(1, 2, '2023/07/01', '2023/07/07'),
(2, 1, '2023/07/10', '2023/07/17'),
(1, 3, '2023/07/20', '2023/07/27'),
(2, 4, '2023/08/01', '2023/08/07'),
(1, 5, '2023/08/10', '2023/08/17'),
(2, 6, '2023/08/20', '2023/08/27');

INSERT INTO `service` (
    `service_name`

) VALUES 
('Vue sur le canal'),
('Front de mer'),
('Espace de travail dédié'),
('Baignoire'),
('Cheminée'),
('Vue panoramique sur la ville'),
('Wifi'),
('Ascenseur'),
('Patio ou balcon : privé(e)'),
('Caméras de surveillance extérieure et/ou dans les espaces communs');

INSERT INTO `apartment_service` (
    `apartment_service_apartment_id`,
    `apartment_service_service_id`

) VALUES 
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 1),
(2, 2),
(2, 8),
(2, 9),
(2, 6),
(3, 6),
(3, 5),
(3, 3),
(3, 2),
(3, 8),
(4, 7),
(4, 4),
(4, 2),
(4, 3),
(4, 10),
(5, 1),
(5, 5),
(5, 8),
(5, 10),
(5, 3),
(6, 5),
(6, 1),
(6, 2),
(6, 10),
(6, 1),
(7, 5),
(7, 3),
(7, 2),
(7, 1),
(7, 9),
(8, 1),
(8, 5),
(8, 8),
(8, 9),
(8, 10),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(10, 7),
(10, 8),
(10, 9),
(10, 10);

INSERT INTO `apartment_check` (
    `apartment_check_apartment_id`,
    `apartment_check_user_id`,
    `apartment_check_task`

) VALUES 
(2, 1, 'Vérifier l''eau chaude'),
(2, 1, 'Vérifier les piles dans la télécomande'),
(2, 1, 'Vérifier l''état des toilette'),
(2, 1, 'Vérifier le linge de maison'),
(2, 1, 'Vérifier l''état du climatiseur'),
(1, 2, 'Vérifier l''eau chaude'),
(1, 2, 'Vérifier les piles dans la télécomande'),
(1, 2, 'Vérifier l''état des toilette'),
(1, 2, 'Vérifier le linge de maison'),
(1, 2, 'Vérifier l''état du climatiseur'),
(3, 1, 'Vérifier l''eau chaude'),
(3, 1, 'Vérifier les piles dans la télécomande'),
(3, 1, 'Vérifier l''état des toilette'),
(3, 1, 'Vérifier le linge de maison'),
(3, 1, 'Vérifier l''état du climatiseur'),
(4, 2, 'Vérifier l''eau chaude'),
(4, 2, 'Vérifier les piles dans la télécomande'),
(4, 2, 'Vérifier l''état des toilette'),
(4, 2, 'Vérifier le linge de maison'),
(4, 2, 'Vérifier l''état du climatiseur'),
(5, 1, 'Vérifier l''eau chaude'),
(5, 1, 'Vérifier les piles dans la télécomande'),
(5, 1, 'Vérifier l''état des toilette'),
(5, 1, 'Vérifier le linge de maison'),
(5, 1, 'Vérifier l''état du climatiseur'),
(6, 2, 'Vérifier l''eau chaude'),
(6, 2, 'Vérifier les piles dans la télécomande'),
(6, 2, 'Vérifier l''état des toilette'),
(6, 2, 'Vérifier le linge de maison'),
(6, 2, 'Vérifier l''état du climatiseur'),

-- USER

INSERT INTO `user_problem` (
    `user_problem_user_id`,
    `user_problem_apartment_id`,
    `user_problem_description`

) VALUES ()

INSERT INTO `user_invoice` (
`user_invoice_user_id`,
`user_invoice_apartment_id`,
`user_invoice_date`,
`user_invoice_amount`

) VALUES ()

INSERT INTO `user_planning` (
`user_planning_user_id`,
`user_planning_apartment_id`,
`user_planning_date`
) VALUES ()
