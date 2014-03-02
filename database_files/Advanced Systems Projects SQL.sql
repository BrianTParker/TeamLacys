
create table customers
(
id int not null AUTO_INCREMENT,
first_name varchar(100) not null,
last_name varchar(100) not null,
phone varchar(20),
email varchar(30) not null,
password varchar(50) not null,
PRIMARY KEY(id),
CONSTRAINT uc_customer UNIQUE (email)
);

create table shipping
(
id int not null AUTO_INCREMENT,
street_address1 varchar(50) not null,
street_address2 varchar(50) not null,
city varchar(50) not null,
state varchar(2) not null,
zip varchar(20) not null,
PRIMARY KEY(id)
);


create table promotions
(
id int not null AUTO_INCREMENT,
percentage decimal not null,
PRIMARY KEY(id)
);

create table products
(
id int not null AUTO_INCREMENT,
name varchar(50) not null,
description varchar(500) not null,
price decimal not null,
promotion_id int,
image_location varchar(100) not null,
age_category varchar(20),
gender_category varchar(20),
article_category varchar(20),
PRIMARY KEY(id),
FOREIGN KEY(promotion_id) references promotions(id),
CONSTRAINT uc_products UNIQUE (name)
);

create table reviews
(
id int not null AUTO_INCREMENT,
product_id int not null,
customer_id int not null,
review varchar(500) not null,
PRIMARY KEY(id),
FOREIGN KEY(product_id) references products(id),
FOREIGN KEY(customer_id) references customers(id),
CONSTRAINT uc_reviews UNIQUE(product_id, customer_id)
);

create table purchase_summary
(
id int not null AUTO_INCREMENT,
amount_total decimal not null,
purchase_date date not null,
shipping_id int,
PRIMARY KEY(id),
FOREIGN KEY(shipping_id) references shipping(id)
);

create table purchase_details
(
id int not null AUTO_INCREMENT,
customer_id int not null,
product_id int not null,
amount decimal not null,
purchase_summary_id int not null,
PRIMARY KEY(id),
FOREIGN KEY(customer_id) references customers(id),
FOREIGN KEY(product_id) references products(id),
FOREIGN KEY(purchase_summary_id) references purchase_summary(id)
);




