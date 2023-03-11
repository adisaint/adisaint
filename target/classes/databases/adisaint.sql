CREATE DATABASE adisaint;

USE adisaint;

create table if not exists adisaint.account
(
    uid      int          not null
        primary key,
    username varchar(20)  not null,
    password varchar(128) not null,
    email    varchar(50)  not null,
    phone    varchar(20)  null
);

create table if not exists adisaint.account_information
(
    uid            int         not null
        primary key,
    username       varchar(20) not null,
    portrait       varchar(50) null,
    signature      varchar(30) null,
    nickname       varchar(16) null,
    gender         varchar(1)  null,
    birthday       date        null,
    job            varchar(20) null,
    primary_school varchar(20) null,
    middle_school  varchar(20) null,
    university     varchar(20) null,
    company        varchar(20) null,
    location       varchar(50) null,
    hometown       varchar(50) null,
    email          varchar(50) null
);

create table if not exists adisaint.account_information_privacy
(
    uid            int                  not null
        primary key,
    username       varchar(20)          not null,
    gender         tinyint(1) default 1 null,
    birthday       tinyint(1) default 1 null,
    job            tinyint(1) default 1 null,
    primary_school tinyint(1) default 1 null,
    middle_school  tinyint(1) default 1 null,
    university     tinyint(1) default 1 null,
    company        tinyint(1) default 1 null,
    location       tinyint(1) default 1 null,
    hometown       tinyint(1) default 1 null,
    email          tinyint(1) default 1 null
);

create table if not exists adisaint.account_status
(
    `uid`            int                  not null
        primary key,
    `username`       varchar(20)          not null,
    `status`         tinyint(1) default 1 null,
    `abnormal_cause` varchar(100)         null,
    `is_logged_in`   tinyint(1) default 0 null
);

create table if not exists adisaint.code
(
    `id`                varchar(16) not null
        primary key,
    `email`             varchar(64) null,
    `type`              varchar(20) not null,
    `verification_code` varchar(8)  not null,
    `generation_time`   datetime    not null,
    `expiration_time`   datetime    not null
);

create table if not exists adisaint.link
(
    `id`              bigint auto_increment
        primary key,
    `short_link`      varchar(6)    not null,
    `long_link`       varchar(1024) not null,
    `status`          tinyint(1)    not null,
    `generation_time` datetime      not null,
    `expiration_time` datetime      not null
);


INSERT INTO adisaint.account
VALUES (12345, 'adisaint', '', 'zhong_jia_hao@163.com', '18779737112');

INSERT INTO adisaint.account_information
VALUES (12345, 'adisaint', null, null, null, null, null, null, null, null, null, null, null, null,
        'zhong_jia_hao@163.com');

INSERT INTO adisaint.account_information_privacy (uid, username)
VALUES (12345, 'adisaint');

INSERT INTO adisaint.account_status (uid, username, status, abnormal_cause, is_logged_in)
VALUES (12345, 'adisaint', 1, null, 0);

INSERT INTO adisaint.code
VALUES (1, 'zhong_jia_hao@163.com', 'login', 12345, '2017-07-25 19:38:14', '2017-07-25 19:38:14');