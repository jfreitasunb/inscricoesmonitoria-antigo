--
-- PostgreSQL database dump
--


SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: inscricao_monitoria_disciplinas; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE inscricao_monitoria_disciplinas (
    codigo_unb integer NOT NULL,
    nome_disciplina character varying(100) NOT NULL
);


ALTER TABLE public.inscricao_monitoria_disciplinas OWNER TO monitoria;

--
-- Name: inscricao_monitoria_funcoes; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE inscricao_monitoria_funcoes (
    codigo integer NOT NULL,
    nome character varying(100) NOT NULL,
    pagina character varying(200) NOT NULL
);


ALTER TABLE public.inscricao_monitoria_funcoes OWNER TO monitoria;

--
-- Name: inscricao_monitoria_login; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE inscricao_monitoria_login (
    coduser integer NOT NULL,
    login character varying(100) NOT NULL,
    senha character varying(200) NOT NULL,
    status character varying(15) NOT NULL
);


ALTER TABLE public.inscricao_monitoria_login OWNER TO monitoria;

--
-- Name: inscricao_monitoria_login_coduser_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE inscricao_monitoria_login_coduser_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inscricao_monitoria_login_coduser_seq OWNER TO monitoria;

--
-- Name: inscricao_monitoria_login_coduser_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE inscricao_monitoria_login_coduser_seq OWNED BY inscricao_monitoria_login.coduser;


--
-- Name: inscricao_monitoria_login_login_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE inscricao_monitoria_login_login_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inscricao_monitoria_login_login_seq OWNER TO monitoria;

--
-- Name: inscricao_monitoria_login_login_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE inscricao_monitoria_login_login_seq OWNED BY inscricao_monitoria_login.login;


--
-- Name: inscricao_monitoria_login_senha_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE inscricao_monitoria_login_senha_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inscricao_monitoria_login_senha_seq OWNER TO monitoria;

--
-- Name: inscricao_monitoria_login_senha_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE inscricao_monitoria_login_senha_seq OWNED BY inscricao_monitoria_login.senha;


--
-- Name: inscricao_monitoria_login_status_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE inscricao_monitoria_login_status_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inscricao_monitoria_login_status_seq OWNER TO monitoria;

--
-- Name: inscricao_monitoria_login_status_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE inscricao_monitoria_login_status_seq OWNED BY inscricao_monitoria_login.status;


--
-- Name: coduser; Type: DEFAULT; Schema: public; Owner: monitoria
--

ALTER TABLE ONLY inscricao_monitoria_login ALTER COLUMN coduser SET DEFAULT nextval('inscricao_monitoria_login_coduser_seq'::regclass);


--
-- Data for Name: inscricao_monitoria_disciplinas; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY inscricao_monitoria_disciplinas (codigo_unb, nome_disciplina) FROM stdin;
\.


--
-- Data for Name: inscricao_monitoria_funcoes; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY inscricao_monitoria_funcoes (codigo, nome, pagina) FROM stdin;
\.


--
-- Data for Name: inscricao_monitoria_login; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY inscricao_monitoria_login (coduser, login, senha, status) FROM stdin;
\.


--
-- Name: inscricao_monitoria_login_coduser_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('inscricao_monitoria_login_coduser_seq', 1, false);


--
-- Name: inscricao_monitoria_login_login_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('inscricao_monitoria_login_login_seq', 1, false);


--
-- Name: inscricao_monitoria_login_senha_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('inscricao_monitoria_login_senha_seq', 1, false);


--
-- Name: inscricao_monitoria_login_status_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('inscricao_monitoria_login_status_seq', 1, false);


--
-- Name: inscricao_monitoria_funcoes_codigo_key; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY inscricao_monitoria_funcoes
    ADD CONSTRAINT inscricao_monitoria_funcoes_codigo_key UNIQUE (codigo);


--
-- Name: inscricao_monitoria_login_pkey; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY inscricao_monitoria_login
    ADD CONSTRAINT inscricao_monitoria_login_pkey PRIMARY KEY (coduser);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

