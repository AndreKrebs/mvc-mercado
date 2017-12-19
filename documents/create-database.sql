CREATE SEQUENCE produto_pk_seq 
	START 1
	INCREMENT 1
	NO MAXVALUE
	CACHE 1;

CREATE SEQUENCE tipo_produto_pk_seq 
	START 1
	INCREMENT 1
	NO MAXVALUE
	CACHE 1;

CREATE SEQUENCE compra_pk_seq 
	START 1
	INCREMENT 1
	NO MAXVALUE
	CACHE 1;

CREATE TABLE produto (
	id 	bigint unique not null primary key,
	tipo_produto_id bigint not null,
	nome character varying(60) not null,
	preco decimal(10, 2) not null,
        produtor character varying(150) not null,
        distribuidor character varying(150) not null,
);


CREATE TABLE tipo_produto (
	id 	bigint unique not null primary key,
	imposto decimal(5,2) not null,
	tipo character varying(60) not null,
	descricao character varying(255) not null
);

CREATE TABLE compra (
	id 	bigint unique not null primary key,
	total decimal(10, 2) not null,
        total_imposto decimal(5,2) not null
);

CREATE TABLE compra_produto (
	id 	bigint unique not null primary key,
	compra_id bigint not null,
	produto_id bigint not null,
	total decimal(10, 2) not null,
        total_imposto decimal(5,2) not null
);


ALTER TABLE produto ALTER COLUMN id SET DEFAULT nextval('produto_pk_seq'::regclass);
ALTER TABLE tipo_produto ALTER COLUMN id SET DEFAULT nextval('tipo_produto_pk_seq'::regclass);
ALTER TABLE compra ALTER COLUMN id SET DEFAULT nextval('compra_pk_seq'::regclass);

ALTER TABLE produto 
   ADD CONSTRAINT fk_produto_tipo_produto
   FOREIGN KEY (tipo_produto_id) 
   REFERENCES tipo_produto(id);

ALTER TABLE compra_produto 
   ADD CONSTRAINT fk_compra_produto_compra
   FOREIGN KEY (compra_id) 
   REFERENCES compra(id);

ALTER TABLE compra_produto 
   ADD CONSTRAINT fk_compra_produto_produto
   FOREIGN KEY (produto_id) 
   REFERENCES produto(id);
