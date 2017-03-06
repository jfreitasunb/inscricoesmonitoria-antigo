--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: arquivos_enviados; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE arquivos_enviados (
    id_user integer,
    nome_arquivo character varying(255),
    data_envio timestamp without time zone
);


ALTER TABLE public.arquivos_enviados OWNER TO monitoria;

--
-- Name: atuou_monitoria; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE atuou_monitoria (
    id_atuacao integer NOT NULL,
    atuou_disciplina character varying(200) NOT NULL
);


ALTER TABLE public.atuou_monitoria OWNER TO monitoria;

--
-- Name: atuou_monitoria_id_atuacao_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE atuou_monitoria_id_atuacao_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.atuou_monitoria_id_atuacao_seq OWNER TO monitoria;

--
-- Name: atuou_monitoria_id_atuacao_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE atuou_monitoria_id_atuacao_seq OWNED BY atuou_monitoria.id_atuacao;


--
-- Name: configura_monitoria; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE configura_monitoria (
    id_monitoria integer NOT NULL,
    ano_monitoria character varying(4),
    semestre_monitoria character varying(2),
    inicio_inscricao date,
    fim_inscricao date
);


ALTER TABLE public.configura_monitoria OWNER TO monitoria;

--
-- Name: configura_monitoria_id_monitoria_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE configura_monitoria_id_monitoria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.configura_monitoria_id_monitoria_seq OWNER TO monitoria;

--
-- Name: configura_monitoria_id_monitoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE configura_monitoria_id_monitoria_seq OWNED BY configura_monitoria.id_monitoria;


--
-- Name: cursos_graduacao; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE cursos_graduacao (
    id_curso_graduacao integer NOT NULL,
    nome_curso character varying(200) NOT NULL
);


ALTER TABLE public.cursos_graduacao OWNER TO monitoria;

--
-- Name: cursos_graduacao_id_curso_graduacao_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE cursos_graduacao_id_curso_graduacao_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cursos_graduacao_id_curso_graduacao_seq OWNER TO monitoria;

--
-- Name: cursos_graduacao_id_curso_graduacao_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE cursos_graduacao_id_curso_graduacao_seq OWNED BY cursos_graduacao.id_curso_graduacao;


--
-- Name: dados_academicos; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE dados_academicos (
    id_user integer NOT NULL,
    ira double precision NOT NULL,
    foi_monitor character varying(50) NOT NULL,
    monitor_convidado character varying(1) NOT NULL,
    nome_professor character varying(200),
    curso_graduacao integer NOT NULL
);


ALTER TABLE public.dados_academicos OWNER TO monitoria;

--
-- Name: dados_academicos_id_aluno_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE dados_academicos_id_aluno_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dados_academicos_id_aluno_seq OWNER TO monitoria;

--
-- Name: dados_academicos_id_aluno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE dados_academicos_id_aluno_seq OWNED BY dados_academicos.id_user;


--
-- Name: dados_bancarios; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE dados_bancarios (
    id_user integer NOT NULL,
    nomebanco character varying(100),
    numerobanco character varying(10),
    agenciabancaria character varying(10),
    numerocontacorrente character varying(10)
);


ALTER TABLE public.dados_bancarios OWNER TO monitoria;

--
-- Name: dados_pessoais; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE dados_pessoais (
    id_user integer NOT NULL,
    nome character varying(255),
    numerorg character varying(20),
    emissorrg character varying(100),
    cpf character varying(11),
    endereco character varying(255),
    cidade character varying(100),
    cep character varying(10),
    estado character varying(3),
    telefone character varying(15),
    celular character varying(15)
);


ALTER TABLE public.dados_pessoais OWNER TO monitoria;

--
-- Name: disciplinas_disponiveis; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE disciplinas_disponiveis (
    id integer NOT NULL,
    id_monitoria integer NOT NULL,
    codigo_disciplina integer NOT NULL
);


ALTER TABLE public.disciplinas_disponiveis OWNER TO monitoria;

--
-- Name: disciplinas_disponivies_id_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE disciplinas_disponivies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.disciplinas_disponivies_id_seq OWNER TO monitoria;

--
-- Name: disciplinas_disponivies_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE disciplinas_disponivies_id_seq OWNED BY disciplinas_disponiveis.id;


--
-- Name: disciplinas_mat; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE disciplinas_mat (
    codigo integer NOT NULL,
    nome character varying(200),
    creditos integer,
    status character varying(5)
);


ALTER TABLE public.disciplinas_mat OWNER TO monitoria;

--
-- Name: escolhas_candidatos; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE escolhas_candidatos (
    id_user bigint NOT NULL,
    escolha_aluno character varying(20),
    mencao_aluno character varying(2),
    id_monitoria integer
);


ALTER TABLE public.escolhas_candidatos OWNER TO monitoria;

--
-- Name: finaliza_escolhas; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE finaliza_escolhas (
    id_user integer NOT NULL,
    tipo_monitoria character varying(32),
    hora_escolhida character varying(7),
    concordatermos boolean,
    id_monitoria integer,
    finaliza_escolhas boolean
);


ALTER TABLE public.finaliza_escolhas OWNER TO monitoria;

--
-- Name: horario_escolhido_monitoria; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE horario_escolhido_monitoria (
    id_user integer NOT NULL,
    horario_monitoria character varying(100) NOT NULL,
    dia_semana character varying(50)
);


ALTER TABLE public.horario_escolhido_monitoria OWNER TO monitoria;

--
-- Name: horario_monitoria_id_horario_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE horario_monitoria_id_horario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.horario_monitoria_id_horario_seq OWNER TO monitoria;

--
-- Name: horario_monitoria_id_horario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE horario_monitoria_id_horario_seq OWNED BY horario_escolhido_monitoria.id_user;


--
-- Name: users; Type: TABLE; Schema: public; Owner: monitoria; Tablespace: 
--

CREATE TABLE users (
    id_user integer NOT NULL,
    login character varying(20) NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(100) NOT NULL,
    validation_code character varying(255),
    user_type integer DEFAULT 0 NOT NULL,
    ativo integer DEFAULT 0
);


ALTER TABLE public.users OWNER TO monitoria;

--
-- Name: users_id_user_seq; Type: SEQUENCE; Schema: public; Owner: monitoria
--

CREATE SEQUENCE users_id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_user_seq OWNER TO monitoria;

--
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: monitoria
--

ALTER SEQUENCE users_id_user_seq OWNED BY users.id_user;


--
-- Name: id_atuacao; Type: DEFAULT; Schema: public; Owner: monitoria
--

ALTER TABLE ONLY atuou_monitoria ALTER COLUMN id_atuacao SET DEFAULT nextval('atuou_monitoria_id_atuacao_seq'::regclass);


--
-- Name: id_monitoria; Type: DEFAULT; Schema: public; Owner: monitoria
--

ALTER TABLE ONLY configura_monitoria ALTER COLUMN id_monitoria SET DEFAULT nextval('configura_monitoria_id_monitoria_seq'::regclass);


--
-- Name: id_curso_graduacao; Type: DEFAULT; Schema: public; Owner: monitoria
--

ALTER TABLE ONLY cursos_graduacao ALTER COLUMN id_curso_graduacao SET DEFAULT nextval('cursos_graduacao_id_curso_graduacao_seq'::regclass);


--
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: monitoria
--

ALTER TABLE ONLY dados_academicos ALTER COLUMN id_user SET DEFAULT nextval('dados_academicos_id_aluno_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: monitoria
--

ALTER TABLE ONLY disciplinas_disponiveis ALTER COLUMN id SET DEFAULT nextval('disciplinas_disponivies_id_seq'::regclass);


--
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: monitoria
--

ALTER TABLE ONLY horario_escolhido_monitoria ALTER COLUMN id_user SET DEFAULT nextval('horario_monitoria_id_horario_seq'::regclass);


--
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: monitoria
--

ALTER TABLE ONLY users ALTER COLUMN id_user SET DEFAULT nextval('users_id_user_seq'::regclass);


--
-- Data for Name: arquivos_enviados; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY arquivos_enviados (id_user, nome_arquivo, data_envio) FROM stdin;
\.


--
-- Data for Name: atuou_monitoria; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY atuou_monitoria (id_atuacao, atuou_disciplina) FROM stdin;
\.


--
-- Name: atuou_monitoria_id_atuacao_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('atuou_monitoria_id_atuacao_seq', 1, false);


--
-- Data for Name: configura_monitoria; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY configura_monitoria (id_monitoria, ano_monitoria, semestre_monitoria, inicio_inscricao, fim_inscricao) FROM stdin;
\.


--
-- Name: configura_monitoria_id_monitoria_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('configura_monitoria_id_monitoria_seq', 1, false);


--
-- Data for Name: cursos_graduacao; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY cursos_graduacao (id_curso_graduacao, nome_curso) FROM stdin;
1	Matemática (Bacharelado/Licenciatura)
2	Ciências da Computação (Bacharelado/Licenciatura)
3	Estatística
4	Física (Bacharelado/Licenciatura)
5	Química (Bacharelado/Licenciatura)
6	Geologia/Geofísica
7	Engenharia (Mecânica/Elétrica/Civil/Redes/Mecatrônica/Química/Produção)
8	Outros
\.


--
-- Name: cursos_graduacao_id_curso_graduacao_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('cursos_graduacao_id_curso_graduacao_seq', 8, true);


--
-- Data for Name: dados_academicos; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY dados_academicos (id_user, ira, foi_monitor, monitor_convidado, nome_professor, curso_graduacao) FROM stdin;
\.


--
-- Name: dados_academicos_id_aluno_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('dados_academicos_id_aluno_seq', 1, false);


--
-- Data for Name: dados_bancarios; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY dados_bancarios (id_user, nomebanco, numerobanco, agenciabancaria, numerocontacorrente) FROM stdin;
\.


--
-- Data for Name: dados_pessoais; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY dados_pessoais (id_user, nome, numerorg, emissorrg, cpf, endereco, cidade, cep, estado, telefone, celular) FROM stdin;
\.


--
-- Data for Name: disciplinas_disponiveis; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY disciplinas_disponiveis (id, id_monitoria, codigo_disciplina) FROM stdin;
\.


--
-- Name: disciplinas_disponivies_id_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('disciplinas_disponivies_id_seq', 1, false);


--
-- Data for Name: disciplinas_mat; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY disciplinas_mat (codigo, nome, creditos, status) FROM stdin;
113115	Teoria dos Números	4	grad
117323	Teoria dos Números 2	4	grad
113263	Topologia dos Espaços Métricos	4	grad
117145	Álgebra 3	4	grad
113123	Álgebra Linear	6	grad
113611	Álgebra para Ensino 1 e 2	6	grad
113212	Análise 2	4	grad
117137	Análise 3	4	grad
113972	Análise Combinatória	4	grad
113859	Análise de Algorítmos	4	grad
113506	Análise Numérica 1	4	grad
113034	Cálculo 1	6	grad
113042	Cálculo 2	6	grad
113051	Cálculo 3	6	grad
113824	Cálculo de Probabilidade 1	6	grad
113832	Cálculo de Probabilidade 2	4	grad
113417	Cálculo Numérico	4	grad
113301	Equações Diferenciais 1	4	grad
113808	Fundamentos de Matemática 1	4	grad
117161	Geometria 1	4	grad
117170	Geometria 2	4	grad
113328	Geometria Diferencial 1	4	grad
117471	Geometria para o Ensino 1	6	grad
117480	Geometria para o Ensino 2	6	grad
113522	Métodos Matemáticos da Física 1	6	grad
113069	Variável Complexa 1	6	grad
117421	Álgebra para o Ensino 1	6	grad
117501	Álgebra para o Ensino 2	6	grad
117412	Introdução à Teoria da Metida e Integração	4	grad
113093	Introdução à Álgebra Linear	4	grad
117358	Lógica Matemática e Computacional	4	grad
117102	Métodos Matemáticos da Física 2	4	grad
113107	Álgebra 1	4	grad
113131	Álgebra 2	4	grad
113204	Análise 1	4	grad
200107	Cálculo 1 Semipresencial	6	grad
105881	Geometria Analítica para Matemática	4	grad
113701	Introdução à Matemática Superior	6	grad
113018	Matemática 1	4	grad
113026	Matemática 2	4	grad
117510	Regência 1	8	grad
117439	Regência 2	8	grad
\.


--
-- Data for Name: escolhas_candidatos; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY escolhas_candidatos (id_user, escolha_aluno, mencao_aluno, id_monitoria) FROM stdin;
\.


--
-- Data for Name: finaliza_escolhas; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY finaliza_escolhas (id_user, tipo_monitoria, hora_escolhida, concordatermos, id_monitoria, finaliza_escolhas) FROM stdin;
\.


--
-- Data for Name: horario_escolhido_monitoria; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY horario_escolhido_monitoria (id_user, horario_monitoria, dia_semana) FROM stdin;
\.


--
-- Name: horario_monitoria_id_horario_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('horario_monitoria_id_horario_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: monitoria
--

COPY users (id_user, login, password, email, validation_code, user_type, ativo) FROM stdin;
1	coordgrad	$2y$10$D/mVBW7QvbOCPdPBuaGce.RHlOvpEW.A7kzEDg1NJuVvfUzJLpj5q	coordgrad@mat.unb.br	\N	1	1
\.


--
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: monitoria
--

SELECT pg_catalog.setval('users_id_user_seq', 1, false);


--
-- Name: atuou_monitoria_pkey; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY atuou_monitoria
    ADD CONSTRAINT atuou_monitoria_pkey PRIMARY KEY (id_atuacao);


--
-- Name: configura_monitoria_pkey; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY configura_monitoria
    ADD CONSTRAINT configura_monitoria_pkey PRIMARY KEY (id_monitoria);


--
-- Name: cursos_graduacao_pkey; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY cursos_graduacao
    ADD CONSTRAINT cursos_graduacao_pkey PRIMARY KEY (id_curso_graduacao);


--
-- Name: dados_academicos_pkey; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY dados_academicos
    ADD CONSTRAINT dados_academicos_pkey PRIMARY KEY (id_user);


--
-- Name: disciplinas_disponivies_pkey; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY disciplinas_disponiveis
    ADD CONSTRAINT disciplinas_disponivies_pkey PRIMARY KEY (id);


--
-- Name: horario_monitoria_pkey; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY horario_escolhido_monitoria
    ADD CONSTRAINT horario_monitoria_pkey PRIMARY KEY (id_user);


--
-- Name: id_user; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY dados_pessoais
    ADD CONSTRAINT id_user UNIQUE (id_user);


--
-- Name: mat_pk; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY disciplinas_mat
    ADD CONSTRAINT mat_pk PRIMARY KEY (codigo);


--
-- Name: users_email_key; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users_login_key; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_login_key UNIQUE (login);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: monitoria; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_user);


--
-- Name: public; Type: ACL; Schema: -; Owner: monitoria
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM monitoria;
GRANT ALL ON SCHEMA public TO monitoria;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

