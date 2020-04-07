
CREATE DATABASE stuffonaut;
ALTER DATABASE stuffonaut CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE stuffonaut;

create table users (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,safeId CHAR(10),countryId INT,langId INT,isCompany TINYINT UNSIGNED,name VARCHAR(50),areaId INT,areaId0 INT,address VARCHAR(50),address2 VARCHAR(50),img VARCHAR(50),email VARCHAR(150),password VARCHAR(150),phone VARCHAR(50),userSinceDate INT,totAds INT,totActAds INT,active TINYINT UNSIGNED);

create table orgInfo (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,userSafeId CHAR(10),orgNumber VARCHAR(25),aboutOrganisation VARCHAR(255),logo CHAR(13));

create table ads (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,userId INT,adCode CHAR(6),countryGeoId INT,langId INT,cat1 INT,cat2 INT,area INT,area0 INT,area1 INT,area2 INT,area3 INT,adLatLng VARCHAR(30),isCompany BOOLEAN,adType TINYINT UNSIGNED,title VARCHAR(50),mainImg char(13),img VARCHAR(255),texts VARCHAR(2000),price FLOAT(11,2),createdDate INT,startDate INT,endDate INT,isEnhanced TINYINT UNSIGNED,adPassword VARCHAR(50),adPrice FLOAT(5, 2),isPaid TINYINT UNSIGNED,stars FLOAT(5, 4),voteSum INT,totVotes INT,numClicks INT,numComments INT,active TINYINT UNSIGNED);

create table categories (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,catId INT,parentId INT,countryId INT,langId INT,name VARCHAR(50),extraId TINYINT UNSIGNED,orderId INT,catAdTypes VARCHAR(5),totalAds INT,pricePrivate FLOAT,priceCompany FLOAT,active TINYINT UNSIGNED);

create table messages (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,fromUser INT,toUser INT,adId INT,sentDate INT,readDate INT,repliedDate INT,message VARCHAR(2000),img VARCHAR(50),senderDeleted TINYINT,reveiverDeleted TINYINT);

create table userSettings (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,userSafeId VARCHAR(10),startCat1 INT,startCat2 INT,hiddenCats VARCHAR(500));

create table favorites (id INT(6) UNSIGNED,userSafeId CHAR(10));

create table comments (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,parentCommentId INT,adId INT,userId INT,sellerUserId INT,commentCatId TINYINT UNSIGNED,dateSaved INT,commenterName varchar(25),hideProfileImg BOOLEAN,comment VARCHAR(255));

create table vehicleExtraData (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,countryGeoId INT,adId INT,vehicleMainType TINYINT UNSIGNED,isNew TINYINT UNSIGNED,make INT,model TINYINT UNSIGNED,year INT,driven INT,hp INT,fuel TINYINT UNSIGNED,gear TINYINT UNSIGNED,leasing TINYINT UNSIGNED,vehicleType TINYINT UNSIGNED,drive TINYINT UNSIGNED,color TINYINT UNSIGNED,class TINYINT UNSIGNED,motorMake INT,length INT,width INT,depth INT,weight INT,material TINYINT UNSIGNED,propulsion TINYINT UNSIGNED,isSharing TINYINT UNSIGNED,mooringAvailable TINYINT UNSIGNED,locationCountry INT,locationArea INT,locationArea0 INT,locationArea1 INT,locationArea2 INT,locationArea3 INT,portName VARCHAR(50),persons TINYINT UNSIGNED,manufacturer INT,regNum VARCHAR(15),machineryHours INT,accessory VARCHAR(50),gender TINYINT UNSIGNED);

create table codes (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,countryGeoId INT,typeId TINYINT UNSIGNED,code VARCHAR(10),userSafeId VARCHAR(10),startDate INT,expiryDate INT,timesUsed INT,totMaxUses INT,maxUsesPerUser TINYINT UNSIGNED,isActive TINYINT UNSIGNED);

create table codeUsed (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,codeId INT,userId INT,adId INT,dateUsed INT);

create table boatManufacturers (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,manufName VARCHAR(40),orderId INT,active TINYINT UNSIGNED);



/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
/* 
truncate table users;
truncate table orgInfo;
truncate table ads;
truncate table favorites;
truncate table comments;
truncate table vehicleExtraData;
UPDATE categories SET totalAds = 0;
truncate table messages;
*/





