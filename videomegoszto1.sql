-- videomeogszto.sql
--------------------------------------------------------------
--        Farkas Bence                                      --
--        Gácsi Péter                                       --
--------------------------------------------------------------
-- Az adatbázist létrehozó script          					--
--------------------------------------------------------------






ALTER SESSION SET NLS_DATE_LANGUAGE = ENGLISH;
ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MON-YYYY';

CREATE TABLE Felhasznalok
(felhasznalonev 	VARCHAR2(20) NOT NULL,
jelszo				VARCHAR2(32) NOT NULL,
email				VARCHAR2(40) NOT NULL,
szuletesi_ido		DATE NOT NULL,
nem					VARCHAR2(10) NOT NULL,
kep         VARCHAR2(200) DEFAULT 'default.png' NOT NULL,
CONSTRAINT Felhasznalo_PRIMARY_KEY PRIMARY KEY (felhasznalonev));

INSERT INTO Felhasznalok VALUES ('jAnCsIaKiRaLy', 'c10c1a08ff41882e7249eafbf0f8786c', 'jancsi@freemail.com', '6-MAY-6', 'Férfi', 'default.png'); --jancsikiraly
INSERT INTO Felhasznalok VALUES ('NagyJozsef1', 'e10adc3949ba59abbe56e057f20f883e', 'proba234@gmail.com', '5-DEC-1978', 'Férfi', 'default.png'); --123456
INSERT INTO Felhasznalok VALUES ('Beluska1995', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'hahatalanmukodik@gmail.com', '25-NOV-1995', 'Férfi', 'default.png'); --qwerty
INSERT INTO Felhasznalok VALUES ('xxxnoscopeyyy', '138b6f104921a050728d1585e8548c0a', 'whatislove@gmail.com', '12-MAY-1983', 'Férfi', 'default.png'); --palinka
INSERT INTO Felhasznalok VALUES ('1984Kati', '138b6f104921a050728d1585e8548c0a', 'kati84@gmail.com', '12-JAN-1978', 'Nő', 'default.png'); --palinka
INSERT INTO Felhasznalok VALUES ('3l3m3r63', '1ea172d9a3ae431eaf69853242de06cb', 'tricky@freemail.com', '19-JUN-1991', 'Férfi', 'default.png'); --xwqadw
INSERT INTO Felhasznalok VALUES ('Somebody34', '141f21b851dfe606bbf4d2a55b4835a1', 'someybody34@gmail.com', '18-FEB-1986', 'Férfi', 'default.png'); --lillacska
INSERT INTO Felhasznalok VALUES ('KovacsBela02', '82e6246d622ec4a59e5b346a1a347101', '9gag@gmail.com', '12-MAY-1961', 'Férfi', 'default.png'); --19830512
INSERT INTO Felhasznalok VALUES ('KovacsBela01', '34e5cc84b82f70dd17a12240f0c91491', 'Bela.kovacs@freemail.com', '11-DEC-1967', 'Férfi', 'default.png'); --egykupica
INSERT INTO Felhasznalok VALUES ('2good4you', '5f4dcc3b5aa765d61d8327deb882cf99', 'rickrolled@gmail.com', '12-MAY-1983', 'Nő', 'default.png'); --password
INSERT INTO Felhasznalok VALUES ('Adatbgyak01', '865a77091bb05d4af86b1ca515bb9eea', 'sajatcim@gmail.com', '10-SEP-1998', 'Ferfi', 'default.png'); --ssadm
INSERT INTO Felhasznalok VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@videomegoszto.com', '24-SEP-1985', 'Ferfi', 'default.png'); --admin

CREATE TABLE Videok
(link				VARCHAR2(2000) NOT NULL,
cim					VARCHAR2(200) NOT NULL,
kategoria			VARCHAR2(20) NOT NULL,
feltoltes_ideje		DATE NOT NULL,
megtekintesek_szama NUMBER(10) DEFAULT 0 NOT NULL,
megjegyzes VARCHAR2(2000) DEFAULT 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.' NOT NULL,
felhasznalonev		VARCHAR2(20) NOT NULL,
CONSTRAINT Videok_FOREIGN_KEY FOREIGN KEY (felhasznalonev) REFERENCES Felhasznalok (felhasznalonev) ON DELETE CASCADE,
 CONSTRAINT Videok_PRIMARY_KEY PRIMARY KEY (link));

INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=jadtGMYYZBg', 'Kowalsky meg a Vega - Hála végre', 'Zene', '28-MAR-2017', 2152, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'NagyJozsef1');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=l7ZlSHGFfdc', 'FatBoy Slim - Valami', 'Zene', '28-MAR-2017', 123, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Beluska1995');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'Basshunter - DoTa', 'Zene', '27-MAR-2017', 242400, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'NagyJozsef1');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=5y_KJAg8bHI', 'Avicii- Wake me Up', 'Zene', '27-MAR-2017', 1020200, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', '3l3m3r63');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=jUqRAUxip4U', 'How to charleston', 'Dance', '28-MAR-2017', 120, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', '1984Kati');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'How to Jive', 'Dance', '26-MAR-2018', 945, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', '1984Kati');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', 'Top 5 viking weapons', 'History', '21-FEB-2017', 242400, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'KovacsBela01');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=D9ioyEvdggk', 'Stairway to Heaven - Led Zeppelin', 'Zene', '25-MAR-2017', 243213, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', '2good4you');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=1w7OgIMMRc4', 'Guns and Roses - Sweet Child O mine', 'Zene', '24-MAR-2017', 1220734, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', '2good4you');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=fWo9PAqLiXY', 'Top 10 ten facts about Vikings', 'History', '24-MAR-2017', 11311, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'KovacsBela01');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=pVHKp6ffURY', 'Scatman(ka bla..)', 'Zene', '25-MAR-2017', 115151, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', '3l3m3r63');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=RRIjnnbGYBw', 'Best MLG montages', 'Fun', '21-MAR-2017', 12, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'xxxnoscopeyyy');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=rosclr8QUqo', 'Best MLG montages2!', 'Fun', '28-FEB-2017', 27, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'xxxnoscopeyyy');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=aAnZak4H56Q', 'SQL Injection - Ethical Hacking Tutorial', 'IT', '12-MAR-2017', 30204, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Adatbgyak01');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=QHYuuXPdQNM', 'Oracle Database Tutorial', 'IT', '17-MAR-2017', 8202, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Somebody34');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=aH2V6zZv1kU', 'Metasploit bemutató', 'IT', '05-FEB-2017', 8413, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Adatbgyak01');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=djV11Xbc914', 'A-Ha - Taken on Me', 'Zene', '28-MAR-2017', 13441, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'KovacsBela02');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=1FC3ve0c8oo', 'Battlefiled 4 Gameplay', 'Gameplay', '20-MAR-2017', 2920, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'xxxnoscopeyyy');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=ugHJMnI_C_E', 'Msfvenom Metasploit Minute', 'IT', '17-FEB-2017', 5670, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Adatbgyak01');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', 'Independece Day 2 Trailer', 'Trailer', '24-DEC-2017', 4421, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Beluska1995');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'Bosszúállók: Végtelen háború (12E) - hivatalos szinkronizált előzetes 2', 'Trailer', '08-JAN-2018', 174022, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'KovacsBela02');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=aar7SU8sf9w', 'Total War Warhammer tilea Campaign', 'Gameplay', '08-MAY-2018', 17422, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Beluska1995');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=BtgrLqRZ3DM', 'Total War Thrones of Britania', 'Gameplay', '28-APR-2018', 64118, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Beluska1995');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=jPEYpryMp2s', 'Solo: A Star Wars Story Trailer', 'Trailer', '03-MAY-2018', 17402212, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Somebody34');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=vPBIr79rx4A', 'Harry Potter 9', 'Trailer', '13-APR-2018', 3121732, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', '2good4you');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=05cswnUFRJc', 'Dance off', 'Fun', '09-MAY-2018', 18422, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', '3l3m3r63');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=ZmInkxbvlCs', 'Tis But a Scratch', 'Fun', '30-APR-2018', 314282, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'KovacsBela1');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=TnOdAT6H94s', 'Vérnyúl', 'FUN', '18-APR-2018', 8174022, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'xxxnoscopeyyy');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=kx_G2a2hL6U', 'Biggus Dickus', 'Fun', '23-APR-2018', 374897, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', '1984Kati');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=FPbTWDeqQf0', 'MEDIEVAL COMBAT WORLD CHAMPIONSHIPS MALBORK 2015 POLAND VS USA', 'History', '28-APR-2018', 174022, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'Beluska1995');
INSERT INTO Videok VALUES('https://www.youtube.com/watch?v=twqM56f_cVo', 'Parov Stelar - Catgroove (TSC - Forsythe)', 'Dance', '08-May-2018', 84022, 'Ide kerül a feltöltő megjegyzése. Alapértelmezetten ez a szöveg jelenik meg.', 'KovacsBela02');




 
 
 
 
 
 
 
 
 
 
 
 
 
 
ALTER SESSION SET NLS_DATE_LANGUAGE = ENGLISH;
ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MON-YYYY HH24:MI:SS';
 
 
CREATE TABLE Hozzaszolasok
(link 				VARCHAR2(2000) NOT NULL,
felhasznalonev		VARCHAR2(20) NOT NULL,
mikor				DATE NOT NULL,
komment				VARCHAR2(500) NOT NULL,
CONSTRAINT Hozzaszolasok_FOREIGN_KEY FOREIGN KEY (felhasznalonev) REFERENCES Felhasznalok (felhasznalonev) ON DELETE CASCADE,
CONSTRAINT Hozzaszolasok_FOREIGN_KEY2 FOREIGN KEY (link) REFERENCES Videok (link) ON DELETE CASCADE,
CONSTRAINT Hozzaszolasok_PRIMARY_KEY PRIMARY KEY (felhasznalonev, link, mikor, komment));


INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'NagyJozsef1', '28-MAR-2018 16:21:08', 'Igazi zene végre, mindent elmond');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=l7ZlSHGFfdc', 'jAnCsIaKiRaLy', '23-JAN-2018 13:23:32', 'Mikor még alsóba jártam volt ez a sláger :D');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', '3l3m3r63', '12-FEB-2018 09:43:03', 'Nagyon király!');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', '3l3m3r63', '28-MAR-2018 20:12:11', 'Nem tetszett');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'Beluska1995', '28-MAR-2018 22:23:08', 'Tökre hasznos info volt!');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'KovacsBela01', '28-MAR-2018 11:55:15', 'Wow :D ');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=QHYuuXPdQNM', 'KovacsBela02', '08-JAN-2018 18:33:01', 'Bejött nekem si ');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', 'jAnCsIaKiRaLy', '28-MAR-2018 12:41:7', 'mgy a like');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'NagyJozsef1', '28-JAN-2018 14:50:41', 'kreatív komment1');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=RRIjnnbGYBw', 'xxxnoscopeyyy', '28-MAR-2018 23:10:22', 'kreatív komment 2');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'Adatbgyak01', '04-FEB-2018 21:34:10', 'kifogytam az ötletből');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', 'xxxnoscopeyyy', '12-MAR-2018 15:11:40', 'jó volt');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'Beluska1995', '15-FEB-2018 19:23:25', 'Tetszett');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'jAnCsIaKiRaLy', '28-MAR-2018 16:50:04', 'kell a 100rekord');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', '2good4you', '28-JAN-2018 14:13:55', 'plusz 1 rekord');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', 'jAnCsIaKiRaLy', '28-JAN-2018 20:32:11', 'Haladez király :D ');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', '1984Kati', '23-FEB-2018 22:43:03', 'Ez hasznos info volt');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', '2good4you', '21-MAR-2018 17:23:11', 'Micsoda mondanivaló');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=RRIjnnbGYBw', '2good4you', '25-MAR-2018 13:29:13', 'Plain text');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', '1984Kati', '29-JAN-2018 14:44:27', 'Plain text 2');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'KovacsBela02', '22-JAN-2018 23:50:51', 'Nekem nem tetszett nem volt elég részletes');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=fWo9PAqLiXY', 'xxxnoscopeyyy', '13-JAN-2018 21:26:41', 'Úristen mekkora fun');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=1w7OgIMMRc4', 'KovacsBela02', '20-MAR-2018 16:20:22', 'Elfogyott az ötlet megint');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=jUqRAUxip4U', '3l3m3r63', '02-MAR-2018 22:40:13', 'Lwaiy');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'jAnCsIaKiRaLy', '17-MAR-2018 19:44:32', 'Jó volt!!4 :D ');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', '1984Kati', '28-FEB-2018 16:24:21', 'Örök Élet, Ingyen sör');
INSERT INTO Hozzaszolasok VALUES('https://www.youtube.com/watch?v=fWo9PAqLiXY', 'Adatbgyak01', '28-MAR-2018 17:33:02', 'Csak az oldal!');



CREATE TABLE ListabanVan
(link	VARCHAR2(2000) NOT NULL,
felhasznalonev				VARCHAR2(20) NOT NULL,
lista_neve			VARCHAR2(20) NOT NULL,
CONSTRAINT ListabanVan_FOREIGN_KEY FOREIGN KEY (felhasznalonev) REFERENCES Felhasznalok (felhasznalonev) ON DELETE CASCADE,
CONSTRAINT ListabanVan_FOREIGN_KEY2 FOREIGN KEY (link) REFERENCES Videok (link) ON DELETE CASCADE,
CONSTRAINT ListabanVan_PRIMARY_KEY PRIMARY KEY (felhasznalonev, link, lista_neve));


INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'NagyJozsef1', 'hetvegere');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=l7ZlSHGFfdc', 'jAnCsIaKiRaLy', 'muzsika');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', '3l3m3r63', 'sajatKedvenc');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', '3l3m3r63', 'Dorikanak');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'Beluska1995', 'Tanulashoz');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'KovacsBela01', 'Lista1');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'KovacsBela02', 'Lista12');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=QHYuuXPdQNM', 'KovacsBela02', 'TancosVideok');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', 'jAnCsIaKiRaLy', 'Kedvenceim');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'NagyJozsef1', 'Péntek-esti');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=RRIjnnbGYBw', 'xxxnoscopeyyy', 'csapatos');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'Adatbgyak01', 'Oraanyag');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'Adatbgyak01', 'Oraanyag');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', 'xxxnoscopeyyy', 'csapatos');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'Beluska1995', 'NyuggerZene');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'jAnCsIaKiRaLy', 'Kedvenceim');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'NagyJozsef1', 'hetvegere');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', 'NagyJozsef1', 'hetvegere');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=QHYuuXPdQNM', 'NagyJozsef1', 'Péntek-esti');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'NagyJozsef1', 'hetvegere');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=l7ZlSHGFfdc', 'NagyJozsef1', 'hetvegere');
INSERT INTO ListabanVan VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', 'NagyJozsef1', 'Péntek-esti');


CREATE TABLE Megtekint
(link				VARCHAR2(2000) NOT NULL,
felhasznalonev 	VARCHAR2(20) NOT NULL,
megtekintes_ideje	DATE NOT NULL,
CONSTRAINT Megtekint_FOREIGN_KEY FOREIGN KEY (felhasznalonev) REFERENCES Felhasznalok (felhasznalonev) ON DELETE CASCADE,
CONSTRAINT Megtekint_FOREIGN_KEY2 FOREIGN KEY (link) REFERENCES Videok (link) ON DELETE CASCADE,
CONSTRAINT Megtekint_PRIMARY_KEY PRIMARY KEY (felhasznalonev,link, megtekintes_ideje));


INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'NagyJozsef1', '28-MAR-2018 16:19:04');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=l7ZlSHGFfdc', 'jAnCsIaKiRaLy', '23-JAN-2018 12:14:06');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', '3l3m3r63', '12-FEB-2018 07:43:21');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', '3l3m3r63', '28-MAR-2018 19:58:12');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'Beluska1995', '28-MAR-2018 21:41:06');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'KovacsBela01', '28-MAR-2018 11:48:23');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'KovacsBela02', '16-MAR-2018 12:08:19');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=QHYuuXPdQNM', 'KovacsBela02', '08-JAN-2018 18:27:01');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', 'jAnCsIaKiRaLy', '28-MAR-2018 12:38:46');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'NagyJozsef1', '28-JAN-2018 14:49:04');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=RRIjnnbGYBw', 'xxxnoscopeyyy', '28-MAR-2018 23:06:25');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'Adatbgyak01', '04-FEB-2018 21:32:08');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'Adatbgyak01', '15-MAR-2018 16:05:02');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', 'xxxnoscopeyyy', '12-MAR-2018 15:09:48');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'Beluska1995', '15-FEB-2018 19:22:58');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'jAnCsIaKiRaLy', '28-MAR-2018 16:47:04');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', '2good4you', '28-JAN-2018 14:11:38');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', 'jAnCsIaKiRaLy', '28-JAN-2018 16:49:03');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', '1984Kati', '23-FEB-2018 22:42:08');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', '2good4you', '21-MAR-2018 17:21:08');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=RRIjnnbGYBw', '2good4you', '25-MAR-2018 13:25:10');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', '1984Kati', '29-JAN-2018 14:42:31');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=1w7OgIMMRc4', 'Beluska1995', '24-FEB-2018 20:18:21');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'KovacsBela02', '22-JAN-2018 23:47:19');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=fWo9PAqLiXY', 'xxxnoscopeyyy', '13-JAN-2018 21:24:45');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=1w7OgIMMRc4', 'KovacsBela02', '20-MAR-2018 16:18:45');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=jUqRAUxip4U', '3l3m3r63', '02-MAR-2018 22:37:56');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'jAnCsIaKiRaLy', '17-MAR-2018 19:43:12');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=QHYuuXPdQNM', 'jAnCsIaKiRaLy', '18-MAR-2018 19:42:08');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', '3l3m3r63', '27-FEB-2018 08:23:45');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', '1984Kati', '28-FEB-2018 16:22:47');
INSERT INTO Megtekint VALUES('https://www.youtube.com/watch?v=fWo9PAqLiXY', 'Adatbgyak01', '28-MAR-2018 17:29:15');


CREATE TABLE Cimkek
(link				VARCHAR2(2000) NOT NULL,
cimke				VARCHAR2(20) NOT NULL,
CONSTRAINT Cimkek_FOREIGN_KEY FOREIGN KEY (link) REFERENCES Videok (link) ON DELETE CASCADE,
CONSTRAINT Cimkek_PRIMARY_KEY PRIMARY KEY (cimke,link));

INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'csapatos');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', 'retro');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=l7ZlSHGFfdc', 'fatboy');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=l7ZlSHGFfdc', 'partyhard');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=l7ZlSHGFfdc', 'electric');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=BLyHWIXTrlI', '90-es évek');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=jadtGMYYZBg', 'magyar');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=jadtGMYYZBg', 'music');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=jadtGMYYZBg', 'alter');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=5y_KJAg8bHI', 'avicii');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=5y_KJAg8bHI', 'electric');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=jUqRAUxip4U', 'charleston');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'howto');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'jive');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'szórakozás');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', 'weapons');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=kZndWyRz-28', 'vikings');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=D9ioyEvdggk', 'roses');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=D9ioyEvdggk', 'rock');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=D9ioyEvdggk', '80-as évek');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=1w7OgIMMRc4', 'rock');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=fWo9PAqLiXY', 'vikings');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=pVHKp6ffURY', 'scatman');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=pVHKp6ffURY', 'electric jazz');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=RRIjnnbGYBw', 'noscope');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=RRIjnnbGYBw', 'mlg fun');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=RRIjnnbGYBw', 'mlg compliation');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=rosclr8QUqo', 'mlg fun');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=aAnZak4H56Q', 'IT');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=aAnZak4H56Q', 'defense');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=aAnZak4H56Q', 'SQL');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=aAnZak4H56Q', 'ethical hacking');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=QHYuuXPdQNM', 'oracle');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=QHYuuXPdQNM', 'database');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=aH2V6zZv1kU', 'Metasploit');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=aH2V6zZv1kU', 'defense');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'dancing');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'fun');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'steps');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=V3ucBTI-f5s', 'rocky');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=1FC3ve0c8oo', 'battlefield');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=ugHJMnI_C_E', 'defense');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=ugHJMnI_C_E', 'Metasploit');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=ugHJMnI_C_E', 'CEH');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', 'akció');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=RXHN0sGbXfw', 'alien');
INSERT INTO Cimkek VALUES('https://www.youtube.com/watch?v=_qX2_D84r3Y', 'előzetes');