DROP TABLE IF EXISTS versions;
CREATE TABLE versions (
    id INT NOT NULL AUTO_INCREMENT,
    created TIMESTAMP NULL DEFAULT NULL,
    modified TIMESTAMP NULL DEFAULT NULL,
    util_creat INT,
    util_modif INT,
    version INT NOT NULL,
    table_name varchar(255) NOT NULL,
    id_field_name varchar(255) NOT NULL,
    id_field_value varchar(255) NOT NULL,
    model_name varchar(255) NOT NULL,
    operation varchar(8) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS versions_data;
CREATE TABLE versions_data (
    id INT NOT NULL AUTO_INCREMENT,
    version_id INT NOT NULL,
    field_name varchar(255) NOT NULL,
    old_value TEXT,
    new_value TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (version_id) REFERENCES versions(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;