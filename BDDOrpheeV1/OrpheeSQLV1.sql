#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Ouvrage
#------------------------------------------------------------

CREATE TABLE Ouvrage(
        ID           int (11) Auto_increment  NOT NULL ,
        Nom          Varchar (200) ,
        Auteur       Varchar (200) ,
        DateCreation Date ,
        PRIMARY KEY (ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Fiche
#------------------------------------------------------------

CREATE TABLE Fiche(
        ID          int (11) Auto_increment  NOT NULL ,
        Nom         Varchar (200) ,
        Portrait    Varchar (200) ,
        Couverture  Varchar (200) ,
        SousTitre   Mediumtext ,
        Description Mediumtext ,
        Video       Varchar (200) ,
        Citation    Mediumtext ,
        PRIMARY KEY (ID ) ,
        UNIQUE (Portrait ,Couverture )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        ID         int (11) Auto_increment  NOT NULL ,
        Nom        Varchar (50) ,
        MotDePasse Varchar (100) ,
        PRIMARY KEY (ID ) ,
        UNIQUE (Nom )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Genre
#------------------------------------------------------------

CREATE TABLE Genre(
        ID  int (11) Auto_increment  NOT NULL ,
        Nom Varchar (200) ,
        PRIMARY KEY (ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Musique
#------------------------------------------------------------

CREATE TABLE Musique(
        ID     int (11) Auto_increment  NOT NULL ,
        Chemin Varchar (200) ,
        Nom    Varchar (200) ,
        PRIMARY KEY (ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Historique
#------------------------------------------------------------

CREATE TABLE Historique(
        ID             int (11) Auto_increment  NOT NULL ,
        DateHistorique Date ,
        Description    Mediumtext ,
        ID_Fiche       Int ,
        PRIMARY KEY (ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: OuvrageFiche
#------------------------------------------------------------

CREATE TABLE OuvrageFiche(
        Page     Int ,
        ID       Int NOT NULL ,
        ID_Fiche Int NOT NULL ,
        PRIMARY KEY (ID ,ID_Fiche )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: FicheUtilisateur
#------------------------------------------------------------

CREATE TABLE FicheUtilisateur(
        ID             Int NOT NULL ,
        ID_Utilisateur Int NOT NULL ,
        PRIMARY KEY (ID ,ID_Utilisateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: FicheGenre
#------------------------------------------------------------

CREATE TABLE FicheGenre(
        ID       Int NOT NULL ,
        ID_Genre Int NOT NULL ,
        PRIMARY KEY (ID ,ID_Genre )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MusiqueFiche
#------------------------------------------------------------

CREATE TABLE MusiqueFiche(
        ID         Int NOT NULL ,
        ID_Musique Int NOT NULL ,
        PRIMARY KEY (ID ,ID_Musique )
)ENGINE=InnoDB;

ALTER TABLE Historique ADD CONSTRAINT FK_Historique_ID_Fiche FOREIGN KEY (ID_Fiche) REFERENCES Fiche(ID);
ALTER TABLE OuvrageFiche ADD CONSTRAINT FK_OuvrageFiche_ID FOREIGN KEY (ID) REFERENCES Ouvrage(ID);
ALTER TABLE OuvrageFiche ADD CONSTRAINT FK_OuvrageFiche_ID_Fiche FOREIGN KEY (ID_Fiche) REFERENCES Fiche(ID);
ALTER TABLE FicheUtilisateur ADD CONSTRAINT FK_FicheUtilisateur_ID FOREIGN KEY (ID) REFERENCES Fiche(ID);
ALTER TABLE FicheUtilisateur ADD CONSTRAINT FK_FicheUtilisateur_ID_Utilisateur FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID);
ALTER TABLE FicheGenre ADD CONSTRAINT FK_FicheGenre_ID FOREIGN KEY (ID) REFERENCES Fiche(ID);
ALTER TABLE FicheGenre ADD CONSTRAINT FK_FicheGenre_ID_Genre FOREIGN KEY (ID_Genre) REFERENCES Genre(ID);
ALTER TABLE MusiqueFiche ADD CONSTRAINT FK_MusiqueFiche_ID FOREIGN KEY (ID) REFERENCES Fiche(ID);
ALTER TABLE MusiqueFiche ADD CONSTRAINT FK_MusiqueFiche_ID_Musique FOREIGN KEY (ID_Musique) REFERENCES Musique(ID);
