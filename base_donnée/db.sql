create database if not exists Chef_Cuisinier;
use Chef_Cuisinier;


create table users(
    UserID int primary key auto_increment not null,
    full_Name varchar(50),
    Email varchar(200) unique not null,
    Password varchar(100) not null,
    PhoneNumber varchar(20),
    RoleID int  not null,
    ProfileImage varchar(200),
	foreign key (RoleID) references Roles(RoleID)
);

create table Roles(
    RoleID int primary key auto_increment,
    RoleName varchar(50) unique not null
);

create table Menu(
    MenuID int primary key auto_increment,
    Title varchar(50) not null,
    Description text not null,
    Price float not null,
    Status enum('Active','Archived') default 'Active',
    MenuImage varchar(255),
    chef_id int not null,
    foreign key (chef_id) references users(UserID)
);

create table Plates(
    PlateID int primary key auto_increment,
    PlateName varchar(100) not null,
    PlateDescription text,
    PlatePrice float not null,
    PlateImage varchar(255),
    MenuID int not null,
    foreign key (MenuID) references Menu(MenuID)ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE PlatesMenu (
    MenuID INT NOT NULL,
    PlateID INT NOT NULL,
    PRIMARY KEY (MenuID, PlateID),
    FOREIGN KEY (MenuID) REFERENCES Menu(MenuID) ON DELETE CASCADE,
    FOREIGN KEY (PlateID) REFERENCES Plates(PlateID) ON DELETE CASCADE
);


create table Reservations(
    ReservationID int primary key auto_increment,
    UserID int not null,
    ChefID int not null,
    MenuID int not null,
    ReservationDate timestamp not null,
    NumberOfPeople int not null check (NumberOfPeople > 0),
    Status enum('Pending', 'Approved', 'Rejected', 'Cancelled') default 'Pending',
    foreign key (UserID) references users(UserID),
    foreign key (ChefID) references users(UserID),
    foreign key (MenuID) references Menu(MenuID)
);

/*
CREATE TABLE Statistics (
    StatID INT PRIMARY KEY AUTO_INCREMENT,
    ChefID INT NOT NULL,
    Date DATE NOT NULL,
    PendingReservations INT DEFAULT 0,
    ApprovedReservations INT DEFAULT 0,
    CancelledReservations INT DEFAULT 0,
    TotalClients INT DEFAULT 0,
    FOREIGN KEY (ChefID) REFERENCES Users(UserID)
);
*/

