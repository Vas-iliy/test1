create table login
(
    id       int auto_increment
        primary key,
    email    varchar(30)                          not null,
    login    varchar(30)                          not null,
    password varchar(30)                          not null,
    auth     varchar(30)                          not null,
    timeNow  timestamp  default CURRENT_TIMESTAMP null,
    timeEnd  timestamp  default CURRENT_TIMESTAMP null,
    validate tinyint(1) default 0                 null,
    constraint login_email_uindex
        unique (email)
);

INSERT INTO train1.login (id, email, login, password, auth, timeNow, timeEnd, validate) VALUES (6, 'vkolyasev1999@mail.ru', 'Vasiliy', 'v', '7QD81wKq1uOGP24qpJB8', '2020-05-11 16:38:24', '2020-05-11 16:39:13', 1);