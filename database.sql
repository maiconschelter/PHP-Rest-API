CREATE DATABASE restapi
	WITH OWNER = postgres
		ENCODING = 'UTF8'
		TABLESPACE = pg_default
		LC_COLLATE = 'en_US.UTF-8'
		LC_CTYPE = 'en_US.UTF-8'
		CONNECTION LIMIT = -1;

CREATE SCHEMA api AUTHORIZATION postgres;

CREATE SEQUENCE api.seq_tbmensagem_msgid
	INCREMENT 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1;

CREATE TABLE api.tbmensagem(
	 msgid INTEGER DEFAULT NEXTVAL('api.seq_tbmensagem_msgid'::regclass)
	,msgtexto VARCHAR(140) DEFAULT NULL
	,msgdata TIMESTAMP WITH TIME ZONE DEFAULT NOW()
	,CONSTRAINT pk_tbmensagem PRIMARY KEY(msgid)
);

ALTER TABLE api.tbmensagem OWNER TO postgres;