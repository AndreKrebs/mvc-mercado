CREATE SEQUENCE produto_pk_seq 
	START 1
	INCREMENT 1
	NO MAXVALUE
	CACHE 1;
ALTER TABLE fact_stock_data_detail_seq owner TO pgadmin;

CREATE SEQUENCE tipo_produto_pk_seq 
	START 1
	INCREMENT 1
	NO MAXVALUE
	CACHE 1;
ALTER TABLE fact_stock_data_detail_seq owner TO pgadmin;

CREATE SEQUENCE compra_pk_seq 
	START 1
	INCREMENT 1
	NO MAXVALUE
	CACHE 1;
ALTER TABLE fact_stock_data_detail_seq owner TO pgadmin;

CREATE TABLE produto (
	id 	bigint unique not null,
	tipo_produto_id bigint not null,
	nome character varying(60) not null,
	preco decimal(10, 2) not null
);


CREATE TABLE tipo_produto (
	id 	bigint unique not null,
	imposto decimal(5,2) not null,
	tipo character varying(60) not null,
	descricao character varying(255) not null
);

CREATE TABLE compra (
	id 	bigint unique not null,
	total decimal(10, 2) not null
);

CREATE TABLE compra_produto (
	id 	bigint unique not null,
	compra_id bigint not null,
	produto_id bigint not null,
	total decimal(10, 2) not null
);


UPDATE produto SET id=nextval('produto_pk_seq');
UPDATE tipo_produto SET id=nextval('tipo_produto_pk_seq');
UPDATE compra SET id=nextval('compra_pk_seq');

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