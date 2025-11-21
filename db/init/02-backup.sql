--
-- PostgreSQL database dump
--

\restrict xEuzeNVgcsxkFEfg0gvmJcVZLEJ5nSH07BbCclKDfqMzcPYeWveI0ZG6ftb4exd

-- Dumped from database version 16.10 (Ubuntu 16.10-0ubuntu0.24.04.1)
-- Dumped by pg_dump version 16.10 (Ubuntu 16.10-0ubuntu0.24.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: charli
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO charli;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cache; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO charli;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO charli;

--
-- Name: comentarios; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.comentarios (
    id bigint NOT NULL,
    reporte_id bigint NOT NULL,
    usuario_id bigint NOT NULL,
    texto text NOT NULL,
    publico boolean DEFAULT true NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.comentarios OWNER TO charli;

--
-- Name: comentarios_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

ALTER TABLE public.comentarios ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.comentarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: estados; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.estados (
    id smallint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.estados OWNER TO charli;

--
-- Name: estados_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

ALTER TABLE public.estados ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.estados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO charli;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO charli;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: charli
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: fotos; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.fotos (
    id bigint NOT NULL,
    reporte_id bigint NOT NULL,
    url character varying(255) NOT NULL,
    descripcion character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.fotos OWNER TO charli;

--
-- Name: fotos_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

ALTER TABLE public.fotos ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.fotos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO charli;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO charli;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO charli;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: charli
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO charli;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO charli;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: charli
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO charli;

--
-- Name: prioridades; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.prioridades (
    id smallint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.prioridades OWNER TO charli;

--
-- Name: prioridades_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

ALTER TABLE public.prioridades ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.prioridades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: reportes; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.reportes (
    id bigint NOT NULL,
    usuario_id bigint NOT NULL,
    titulo character varying(191) NOT NULL,
    descripcion text,
    direccion character varying(255),
    latitud numeric(10,7),
    longitud numeric(10,7),
    prioridad_id smallint NOT NULL,
    estado_id smallint NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    diametro numeric(10,2)
);


ALTER TABLE public.reportes OWNER TO charli;

--
-- Name: reportes_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

ALTER TABLE public.reportes ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.reportes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: rol_usuario; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.rol_usuario (
    usuario_id bigint NOT NULL,
    role_id smallint NOT NULL
);


ALTER TABLE public.rol_usuario OWNER TO charli;

--
-- Name: roles; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.roles (
    id smallint NOT NULL,
    nombre character varying(50) NOT NULL,
    slug character varying(50) NOT NULL,
    created_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.roles OWNER TO charli;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

CREATE SEQUENCE public.roles_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_id_seq OWNER TO charli;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: charli
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO charli;

--
-- Name: users; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO charli;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO charli;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: charli
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.usuarios (
    id bigint NOT NULL,
    nombre character varying(191) NOT NULL,
    email character varying(191) NOT NULL,
    telefono character varying(50),
    password character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    remember_token character varying(100),
    email_verified_at timestamp(0) without time zone
);


ALTER TABLE public.usuarios OWNER TO charli;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

ALTER TABLE public.usuarios ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: votos; Type: TABLE; Schema: public; Owner: charli
--

CREATE TABLE public.votos (
    id bigint NOT NULL,
    reporte_id bigint NOT NULL,
    usuario_id bigint NOT NULL,
    valor smallint NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.votos OWNER TO charli;

--
-- Name: votos_id_seq; Type: SEQUENCE; Schema: public; Owner: charli
--

ALTER TABLE public.votos ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.votos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.cache (key, value, expiration) FROM stdin;
laravel-cache-admin@ejemplo.com|127.0.0.1:timer	i:1762758350;	1762758350
laravel-cache-admin@ejemplo.com|127.0.0.1	i:1;	1762758350
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: comentarios; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.comentarios (id, reporte_id, usuario_id, texto, publico, created_at) FROM stdin;
5	4	1	Hola :D	t	2025-11-10 01:42:31.335607
6	4	2	Adios	t	2025-11-10 01:43:11.213121
8	6	2	Si esta muy gordo	t	2025-11-10 03:11:17.050332
9	6	3	WOW	t	2025-11-10 13:16:51.958981
\.


--
-- Data for Name: estados; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.estados (id, nombre) FROM stdin;
2	En revisión
3	Resuelto
1	Sin Atender
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: fotos; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.fotos (id, reporte_id, url, descripcion, created_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2025_11_09_233115_ajustar_usuarios_para_autenticacion	2
5	2025_11_10_002249_crear_roles_y_rol_usuario	2
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: prioridades; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.prioridades (id, nombre) FROM stdin;
1	Baja
2	Media
3	Alta
4	Crítica
\.


--
-- Data for Name: reportes; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.reportes (id, usuario_id, titulo, descripcion, direccion, latitud, longitud, prioridad_id, estado_id, created_at, updated_at, diametro) FROM stdin;
4	1	Bache en calle siempre viva	Un bache de aproximadamente 32cm en la avenida siempre viva	Av. Juarez	20.3861960	-99.9968149	1	1	2025-11-09 16:00:36.454989	2025-11-09 16:00:36.454989	\N
5	1	Bache en avenida francia	Un gran bache en la avenida francia que representa un peligro para la vialidad	Francia 235, Bosques de Banthi	20.3997997	-99.9601424	2	2	2025-11-10 03:04:00.884123	2025-11-10 03:04:00.884123	\N
6	1	Bache en cerro gordo	Esta Amplio	Cerro gordo 54	20.3849881	-99.9400583	3	3	2025-11-10 03:09:48.738254	2025-11-10 03:09:48.738254	\N
\.


--
-- Data for Name: rol_usuario; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.rol_usuario (usuario_id, role_id) FROM stdin;
1	1
4	1
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.roles (id, nombre, slug, created_at) FROM stdin;
1	Administrador	admin	2025-11-10 00:35:29
2	Gestor	gestor	2025-11-10 00:35:29
3	Ciudadano	ciudadano	2025-11-10 00:35:29
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
okTOZnoZNeZAvMp2rQjbgpJnQoxEk2sdFSMLV9Lh	\N	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHVyS3BMaXFFYnBYNnpsN0Z6SHlOMHdkdmgyTVdRcHJxWE8zTDVIRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXBvcnRlcy9jcmVhciI7czo1OiJyb3V0ZSI7czoxNDoicmVwb3J0ZXMuY3JlYXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1763365844
zdoF3HtkEAM4Su2L32dCf0Pkk9bU4Agp8alfN1T2	\N	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmxzSDVTWmliaExwS0VtcFQ4anBSZVpyaHJmU1AzYk5PcXFUbGZYQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXBvcnRlcy9hdGVuZGlkb3MiO3M6NToicm91dGUiO3M6MTg6InJlcG9ydGVzLmF0ZW5kaWRvcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1763368051
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.usuarios (id, nombre, email, telefono, password, created_at, remember_token, email_verified_at) FROM stdin;
1	Juan Perez	juan@example.com	555-111-2222	$2b$10$hashA	2025-11-05 11:44:11.470295	\N	\N
2	Maria Gomez	maria@example.com	555-333-4444	$2b$10$hashB	2025-11-05 11:44:11.470295	\N	\N
3	Carlos Ruiz	carlos@example.com	555-777-8888	$2b$10$hashC	2025-11-05 11:44:11.470295	\N	\N
4	Admin	admin@ejemplo.com	\N	$2y$12$1gbyt1MsCbGxAFmsek6dFOLhfjYb0PNU4qN3wAF1/8NKdElN9i4Be	2025-11-10 02:29:00	\N	\N
\.


--
-- Data for Name: votos; Type: TABLE DATA; Schema: public; Owner: charli
--

COPY public.votos (id, reporte_id, usuario_id, valor, created_at) FROM stdin;
\.


--
-- Name: comentarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.comentarios_id_seq', 9, true);


--
-- Name: estados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.estados_id_seq', 3, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: fotos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.fotos_id_seq', 3, true);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.migrations_id_seq', 5, true);


--
-- Name: prioridades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.prioridades_id_seq', 4, true);


--
-- Name: reportes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.reportes_id_seq', 11, true);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.roles_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 4, true);


--
-- Name: votos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: charli
--

SELECT pg_catalog.setval('public.votos_id_seq', 6, true);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: comentarios comentarios_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.comentarios
    ADD CONSTRAINT comentarios_pkey PRIMARY KEY (id);


--
-- Name: estados estados_nombre_key; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.estados
    ADD CONSTRAINT estados_nombre_key UNIQUE (nombre);


--
-- Name: estados estados_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: fotos fotos_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.fotos
    ADD CONSTRAINT fotos_pkey PRIMARY KEY (id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: prioridades prioridades_nombre_key; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.prioridades
    ADD CONSTRAINT prioridades_nombre_key UNIQUE (nombre);


--
-- Name: prioridades prioridades_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.prioridades
    ADD CONSTRAINT prioridades_pkey PRIMARY KEY (id);


--
-- Name: reportes reportes_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_pkey PRIMARY KEY (id);


--
-- Name: rol_usuario rol_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.rol_usuario
    ADD CONSTRAINT rol_usuario_pkey PRIMARY KEY (usuario_id, role_id);


--
-- Name: roles roles_nombre_unique; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_nombre_unique UNIQUE (nombre);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: roles roles_slug_unique; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_slug_unique UNIQUE (slug);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: usuarios usuarios_email_key; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_email_key UNIQUE (email);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- Name: votos ux_votos_unico_usuario_reporte; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.votos
    ADD CONSTRAINT ux_votos_unico_usuario_reporte UNIQUE (reporte_id, usuario_id);


--
-- Name: votos votos_pkey; Type: CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.votos
    ADD CONSTRAINT votos_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: charli
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: charli
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: charli
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: comentarios fk_comentarios_reporte; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.comentarios
    ADD CONSTRAINT fk_comentarios_reporte FOREIGN KEY (reporte_id) REFERENCES public.reportes(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: comentarios fk_comentarios_usuario; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.comentarios
    ADD CONSTRAINT fk_comentarios_usuario FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fotos fk_fotos_reporte; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.fotos
    ADD CONSTRAINT fk_fotos_reporte FOREIGN KEY (reporte_id) REFERENCES public.reportes(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reportes fk_reportes_estado; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT fk_reportes_estado FOREIGN KEY (estado_id) REFERENCES public.estados(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: reportes fk_reportes_prioridad; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT fk_reportes_prioridad FOREIGN KEY (prioridad_id) REFERENCES public.prioridades(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: reportes fk_reportes_usuario; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT fk_reportes_usuario FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: votos fk_votos_reporte; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.votos
    ADD CONSTRAINT fk_votos_reporte FOREIGN KEY (reporte_id) REFERENCES public.reportes(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: votos fk_votos_usuario; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.votos
    ADD CONSTRAINT fk_votos_usuario FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: rol_usuario rol_usuario_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.rol_usuario
    ADD CONSTRAINT rol_usuario_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- Name: rol_usuario rol_usuario_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: charli
--

ALTER TABLE ONLY public.rol_usuario
    ADD CONSTRAINT rol_usuario_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict xEuzeNVgcsxkFEfg0gvmJcVZLEJ5nSH07BbCclKDfqMzcPYeWveI0ZG6ftb4exd

