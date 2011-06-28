DROP TABLE IF EXISTS candidats_formations;
CREATE TABLE candidats_formations (
    id INT NOT NULL AUTO_INCREMENT,
    created TIMESTAMP NULL DEFAULT NULL,
    modified TIMESTAMP NULL DEFAULT NULL,
    util_creat INT,
    util_modif INT,
    actif BOOLEAN NOT NULL DEFAULT true,
    candidat_id INT,
    candidat_formation_type_id INT,
    date_these DATE,
    lieu_these VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (candidat_id) REFERENCES candidats(id),
    FOREIGN KEY (candidat_formation_type_id) REFERENCES candidats_formations_types(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;