CREATE SCHEMA carnet;

CREATE TABLE carnet.usuario
(
  iduser serial NOT NULL,
  username character varying(255) NOT NULL,
  auth_key character varying(32) NOT NULL,
  password character varying(255) NOT NULL,
  password_reset_token character varying(255),
  email character varying(255) NOT NULL,
  status smallint NOT NULL DEFAULT 1,
  verification_token character varying(255) DEFAULT NULL::character varying,
  fkdepart integer,
  created_at timestamp without time zone,
  updated_at timestamp without time zone,
  CONSTRAINT user_pkey PRIMARY KEY (iduser),
  CONSTRAINT user_email_key UNIQUE (email),
  CONSTRAINT user_password_reset_token_key UNIQUE (password_reset_token),
  CONSTRAINT user_username_key UNIQUE (username)
);

CREATE TABLE carnet.departamento
(
  iddepart serial NOT NULL,
  nombdepart character varying(255),
  CONSTRAINT iddepart PRIMARY KEY (iddepart)
);

CREATE TABLE carnet.imagen
(
  idimag serial NOT NULL,
  nombimg character varying(255),
  extension character varying(5),
  ruta character varying(255),
  tamanio integer,
  CONSTRAINT idimag PRIMARY KEY (idimag)
);

CREATE TABLE carnet.personal
(
  idpers serial NOT NULL,
  ci character varying(10),
  nombcompleto character varying(255),
  sexo character varying(1),
  fkimag integer,
  fkdepart integer,
  CONSTRAINT idpers PRIMARY KEY (idpers),
  CONSTRAINT fkdepart FOREIGN KEY (fkdepart)
      REFERENCES carnet.departamento (iddepart) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fkimag FOREIGN KEY (fkimag)
      REFERENCES carnet.imagen (idimag) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

-- tabla de rbac
CREATE TABLE public.auth_rule
(
  name character varying(64) NOT NULL,
  data bytea,
  created_at integer,
  updated_at integer,
  CONSTRAINT auth_rule_pkey PRIMARY KEY (name)
);

CREATE TABLE public.auth_item
(
  name character varying(64) NOT NULL,
  type smallint NOT NULL,
  description text,
  rule_name character varying(64),
  data bytea,
  created_at integer,
  updated_at integer,
  CONSTRAINT auth_item_pkey PRIMARY KEY (name),
  CONSTRAINT auth_item_rule_name_fkey FOREIGN KEY (rule_name)
      REFERENCES public.auth_rule (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE public.auth_assignment
(
  item_name character varying(64) NOT NULL,
  user_id character varying(64) NOT NULL,
  created_at integer,
  CONSTRAINT auth_assignment_pkey PRIMARY KEY (item_name, user_id),
  CONSTRAINT auth_assignment_item_name_fkey FOREIGN KEY (item_name)
      REFERENCES public.auth_item (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE public.auth_item_child
(
  parent character varying(64) NOT NULL,
  child character varying(64) NOT NULL,
  CONSTRAINT auth_item_child_pkey PRIMARY KEY (parent, child),
  CONSTRAINT auth_item_child_child_fkey FOREIGN KEY (child)
      REFERENCES public.auth_item (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT auth_item_child_parent_fkey FOREIGN KEY (parent)
      REFERENCES public.auth_item (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);
