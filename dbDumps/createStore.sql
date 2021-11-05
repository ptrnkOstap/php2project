drop database if exists mystore;
create database mystore;
use mystore;

drop table if exists product_categories;
create table product_categories
(
    id          int unsigned not null PRIMARY KEY,
    description varchar(50)
);

drop table if exists products;
create table products
(
    id          serial PRIMARY KEY,
    name        varchar(70)  not null,
    description varchar(255) not null,
    price       bigint unsigned,
    category_id int unsigned not null,

    foreign key (category_id) references product_categories (id)
);

drop table if exists users;
create table users
(
    id            serial PRIMARY KEY,
    name          varchar(50)  not null,
    surname       varchar(50)  not null,
    email         varchar(50)  not null,
    password_hash varchar(255) not null
);

drop table if exists order_statues;
create table order_statuses
(
    id          int unsigned not null PRIMARY KEY,
    description varchar(50)  not null
);

drop table if exists orders;
create table orders
(
    id               serial PRIMARY KEY,
    user_id          bigint unsigned not null,
    delivery_address varchar(255)    not null,
    status_id        int unsigned    not null,
    created_at       datetime        not null,

    foreign key (user_id) references users (id),
    foreign key (status_id) references order_statuses (id)
);

drop table if exists order_content;
create table order_content
(
    order_id   bigint unsigned not null,
    product_id bigint unsigned not null,
    quantity   int unsigned    not null,

    PRIMARY KEY (order_id, product_id),
    foreign key (order_id) references orders (id),
    foreign key (product_id) references products (id)

);


