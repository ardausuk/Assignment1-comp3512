--
-- File generated with SQLiteStudio v3.4.4 on Mon Oct 9 23:58:59 2023
--
-- Text encoding used: UTF-8
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: types
CREATE TABLE IF NOT EXISTS types (
    type_id   INTEGER PRIMARY KEY,
    type_name TEXT
);

INSERT INTO types (
                      type_id,
                      type_name
                  )
                  VALUES (
                      1,
                      'Band/Group'
                  );

INSERT INTO types (
                      type_id,
                      type_name
                  )
                  VALUES (
                      2,
                      'Duo'
                  );

INSERT INTO types (
                      type_id,
                      type_name
                  )
                  VALUES (
                      3,
                      'Solo'
                  );

INSERT INTO types (
                      type_id,
                      type_name
                  )
                  VALUES (
                      4,
                      'Trio'
                  );


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
