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

--
-- Name: compra_pk_seq; Type: SEQUENCE; Schema: public; Owner: softexpert
--

CREATE SEQUENCE compra_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.compra_pk_seq OWNER TO softexpert;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: compra; Type: TABLE; Schema: public; Owner: softexpert; Tablespace: 
--

CREATE TABLE compra (
    id bigint DEFAULT nextval('compra_pk_seq'::regclass) NOT NULL,
    total numeric(10,2) NOT NULL,
    total_imposto numeric(5,2) NOT NULL,
    fechada boolean DEFAULT false NOT NULL
);


ALTER TABLE public.compra OWNER TO softexpert;

--
-- Name: compra_produto_pk_seq; Type: SEQUENCE; Schema: public; Owner: softexpert
--

CREATE SEQUENCE compra_produto_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.compra_produto_pk_seq OWNER TO softexpert;

--
-- Name: compra_produto; Type: TABLE; Schema: public; Owner: softexpert; Tablespace: 
--

CREATE TABLE compra_produto (
    id bigint DEFAULT nextval('compra_produto_pk_seq'::regclass) NOT NULL,
    compra_id bigint NOT NULL,
    produto_id bigint NOT NULL,
    quantidade integer NOT NULL,
    total numeric(10,2) NOT NULL,
    total_imposto numeric(5,2) NOT NULL
);


ALTER TABLE public.compra_produto OWNER TO softexpert;

--
-- Name: produto_pk_seq; Type: SEQUENCE; Schema: public; Owner: softexpert
--

CREATE SEQUENCE produto_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produto_pk_seq OWNER TO softexpert;

--
-- Name: produto; Type: TABLE; Schema: public; Owner: softexpert; Tablespace: 
--

CREATE TABLE produto (
    id bigint DEFAULT nextval('produto_pk_seq'::regclass) NOT NULL,
    tipo_produto_id bigint NOT NULL,
    nome character varying(60) NOT NULL,
    preco numeric(10,2) NOT NULL,
    produtor character varying(150) NOT NULL,
    distribuidor character varying(150) NOT NULL
);


ALTER TABLE public.produto OWNER TO softexpert;

--
-- Name: tipo_produto_pk_seq; Type: SEQUENCE; Schema: public; Owner: softexpert
--

CREATE SEQUENCE tipo_produto_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_produto_pk_seq OWNER TO softexpert;

--
-- Name: tipo_produto; Type: TABLE; Schema: public; Owner: softexpert; Tablespace: 
--

CREATE TABLE tipo_produto (
    id bigint DEFAULT nextval('tipo_produto_pk_seq'::regclass) NOT NULL,
    imposto numeric(5,2) NOT NULL,
    tipo character varying(60) NOT NULL,
    descricao character varying(255) NOT NULL
);


ALTER TABLE public.tipo_produto OWNER TO softexpert;

--
-- Data for Name: compra; Type: TABLE DATA; Schema: public; Owner: softexpert
--

COPY compra (id, total, total_imposto, fechada) FROM stdin;
1	0.00	0.00	f
2	113.73	3.44	t
\.


--
-- Name: compra_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: softexpert
--

SELECT pg_catalog.setval('compra_pk_seq', 2, true);


--
-- Data for Name: compra_produto; Type: TABLE DATA; Schema: public; Owner: softexpert
--

COPY compra_produto (id, compra_id, produto_id, quantidade, total, total_imposto) FROM stdin;
1	1	5	2	30.00	3.09
2	1	2	2	25.00	0.75
3	2	1	10	50.00	1.15
4	2	4	5	16.25	0.66
5	2	3	1	9.98	0.51
6	2	2	3	37.50	1.13
\.


--
-- Name: compra_produto_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: softexpert
--

SELECT pg_catalog.setval('compra_produto_pk_seq', 6, true);


--
-- Data for Name: produto; Type: TABLE DATA; Schema: public; Owner: softexpert
--

COPY produto (id, tipo_produto_id, nome, preco, produtor, distribuidor) FROM stdin;
1	1	Feijão Preto 1 KG Tio João	5.00	Rio João	Distribuidora Tio João
2	2	Farinha de trigo 5kg Dona Benta	12.50	Moinho Dona Benta	Dona Benta
3	3	Açucar Refinado 5kg Boa Mesa	9.98	Boa Mesa	Distribuidora Boa Mesa
4	4	Sardinha com óleo em lata 125 g Coqueiro 	3.25	Coqueiro	Distribuidora Coqueiro
5	5	Pêssego enlatado 850 g GB	15.00	GB	Distribuidora GB
\.


--
-- Name: produto_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: softexpert
--

SELECT pg_catalog.setval('produto_pk_seq', 5, true);


--
-- Data for Name: tipo_produto; Type: TABLE DATA; Schema: public; Owner: softexpert
--

COPY tipo_produto (id, imposto, tipo, descricao) FROM stdin;
1	2.30	Feijão preto em grãos	Feijão preto em grãos
2	3.00	Farinha de trigo	Farinha de trigo
3	5.10	Açucar	Açucar 
4	4.06	Sardinha em lata	Sardinha em lata
5	10.30	Pêssego em calda	Pêssego em calda
\.


--
-- Name: tipo_produto_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: softexpert
--

SELECT pg_catalog.setval('tipo_produto_pk_seq', 5, true);


--
-- Name: compra_pkey; Type: CONSTRAINT; Schema: public; Owner: softexpert; Tablespace: 
--

ALTER TABLE ONLY compra
    ADD CONSTRAINT compra_pkey PRIMARY KEY (id);


--
-- Name: compra_produto_pkey; Type: CONSTRAINT; Schema: public; Owner: softexpert; Tablespace: 
--

ALTER TABLE ONLY compra_produto
    ADD CONSTRAINT compra_produto_pkey PRIMARY KEY (id);


--
-- Name: produto_pkey; Type: CONSTRAINT; Schema: public; Owner: softexpert; Tablespace: 
--

ALTER TABLE ONLY produto
    ADD CONSTRAINT produto_pkey PRIMARY KEY (id);


--
-- Name: tipo_produto_pkey; Type: CONSTRAINT; Schema: public; Owner: softexpert; Tablespace: 
--

ALTER TABLE ONLY tipo_produto
    ADD CONSTRAINT tipo_produto_pkey PRIMARY KEY (id);


--
-- Name: fk_compra_produto_compra; Type: FK CONSTRAINT; Schema: public; Owner: softexpert
--

ALTER TABLE ONLY compra_produto
    ADD CONSTRAINT fk_compra_produto_compra FOREIGN KEY (compra_id) REFERENCES compra(id);


--
-- Name: fk_compra_produto_produto; Type: FK CONSTRAINT; Schema: public; Owner: softexpert
--

ALTER TABLE ONLY compra_produto
    ADD CONSTRAINT fk_compra_produto_produto FOREIGN KEY (produto_id) REFERENCES produto(id);


--
-- Name: fk_produto_tipo_produto; Type: FK CONSTRAINT; Schema: public; Owner: softexpert
--

ALTER TABLE ONLY produto
    ADD CONSTRAINT fk_produto_tipo_produto FOREIGN KEY (tipo_produto_id) REFERENCES tipo_produto(id);


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

