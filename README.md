Instructions to test website for grading:

1) Open Up pgAdmin4

2) Run this command in a query:

DROP DATABASE IF EXISTS "space-a";

CREATE DATABASE "space-a"
    WITH
    OWNER = student
    ENCODING = 'UTF8'
    LC_COLLATE = 'en_US.UTF-8'
    LC_CTYPE = 'en_US.UTF-8'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

2) Run the following command in our repo's directory in your terminal 
"psql space-a < space-a_20240508.sql" 
Directory should be something like: "/home/student/public_html/364_webapp/src/web"
