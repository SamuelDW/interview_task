USE yordasgrouptask;

CREATE TABLE tblSubstances
(
    intSubstanceId                SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    intEuropeanCommunityId        SMALLINT UNSIGNED NULL,
    intChemicalAbstractsServiceId SMALLINT UNSIGNED NULL,
    dtmCreated                    DATETIME          NOT NULL,
    dtmUpdated                    DATETIME          NULL,
    stmTimestamp                  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (intSubstanceId),
    UNIQUE KEY K_intEuropeanCommunityId (intEuropeanCommunityId),
    UNIQUE KEY K_intChemicalAbstractsServiceId (intChemicalAbstractsServiceId),
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE utf8mb4_general_ci COMMENT = 'Record of all substances';


CREATE TABLE tblSubstanceNames
(
    intNameId        SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    intSubstanceId   SMALLINT UNSIGNED NOT NULL,
    strSubstanceName VARCHAR(255)      NOT NULL,
    dtmCreated       DATETIME          NOT NULL,
    dtmUpdated       DATETIME          NULL,
    stmTimestamp     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (intNameId),
    UNIQUE KEY K_strSubstanceName (strSubstanceName),
    CONSTRAINT FK_intSubstanceId_intSubstanceId FOREIGN KEY (intSubstanceId) REFERENCES tblSubstances (intSubstanceId)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE utf8mb4_general_ci COMMENT = 'Substances name for multiple names';


CREATE TABLE tblCandidateListReachSVHC
(
    intCandidateListReachSVHCId SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    intSubstanceId              SMALLINT UNSIGNED NOT NULL,
    intArticleId                SMALLINT UNSIGNED NOT NULL,
    dtmCreated                  DATETIME          NOT NULL,
    dtmUpdated                  DATETIME          NOT NULL,
    stmTimestamp                TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (intCandidateListReachSVHCId),
    CONSTRAINT FK_intSubstanceId_tblSubstance_intSubstanceID FOREIGN KEY (intSubstanceId) REFERENCES tblSubstances (intSubstanceId),
    CONSTRAINT FK_intArticleId_tblSubstance_intArticleID FOREIGN KEY (intArticleId) REFERENCES tblArticles (intArticleId)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE utf8mb4_general_ci COMMENT = 'Record of all substances on the SVHC list and reasons';


CREATE TABLE tblArticles
(
    intArticleId   SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    strArticleLink VARCHAR(255)      NOT NULL,
    dtmCreated     DATETIME          NOT NULL,
    dtmUpdated     DATETIME          NOT NULL,
    stmTimestamp   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (intArticleId),
    CONSTRAINT FK_intReasonForInclusionId_intReasonForInclusionId FOREIGN KEY (intArticleId) REFERENCES tblCandidateListReachSVHC (intArticleId)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE utf8mb4_general_ci COMMENT = 'Record of all substances';


CREATE TABLE tblToySafetyDirectiveList
(
    intToySafetyDirectiveId SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    intSubstanceId          SMALLINT UNSIGNED NOT NULL,
    intArticleId            SMALLINT          NOT NULL,
    dtmCreated              DATETIME          NOT NULL,
    dtmUpdated              DATETIME          NOT NULL,
    stmTimestamp            TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (intToySafetyDirectiveId),
    CONSTRAINT FK_intSubstanceId_intSubstanceId FOREIGN KEY (intSubstanceId) REFERENCES tblSubstances (intSubstanceId),
    CONSTRAINT FK_intArticleId_tblSubstance_intArticleID FOREIGN KEY (intArticleId) REFERENCES tblArticles (intArticleId)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE utf8mb4_general_ci COMMENT = 'Record of all substances';