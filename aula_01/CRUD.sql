USE devstart_schools;

-- CREATE
INSERT INTO teachers (name, email, cpf)
VALUES (
  'Luis', 'luis@email.com', '12312312312',
  'Vitor', 'vitor@email.com', '12345678901'
);

-- READ
SELECT * FROM teachers
WHERE id = 1;

-- UPDATE
UPDATE teachers
SET name = 'Luis Vinicius'
WHERE id = 1;

-- DELETE
DELETE FROM teachers
WHERE id = 2;
