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
