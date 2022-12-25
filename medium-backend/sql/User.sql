CREATE TABLE users (
  id VARCHAR(200),
  name VARCHAR(200),
  email VARCHAR(200) UNIQUE,
  total_stories INT DEFAULT 0
);

CREATE  TABLE login (
  email VARCHAR(200) UNIQUE,
  password VARCHAR(200)
);
