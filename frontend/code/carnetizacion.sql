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


create table usuario(
	id serial not null primary key,
	nomb_user varchar(20) not null,
	clave varchar(50) not null,
	CONSTRAINT id PRIMARY KEY(id)
);

create table estado_civil(
	id serial not null primary key,
	nombre varchar(255) not null
);

create table categoria(
	id serial not null primary key,
	nombre varchar(255) not null
);

create table calle(
	id serial not null primary key,
	nombre varchar(30) not null
);

CREATE TABLE public.casa
(
  id serial,
  nombre character varying(30),
  ncasa character varying(10),
  tipcasa character varying(100),
  alquilada boolean DEFAULT false,
  bano boolean DEFAULT false,
  cuarto boolean DEFAULT false,
  sala boolean DEFAULT false,
  comedor boolean DEFAULT false,
  tippiso character varying(255),
  tipconstruccion character varying(255),
  tiptecho character varying(255),
  inmuebles_id integer,
  CONSTRAINT casa_pkey PRIMARY KEY (id),
  CONSTRAINT inmuebles_id FOREIGN KEY (inmuebles_id)
      REFERENCES public.inmuebles (idinm) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

create table public.pago(
	idpago serial,
    pagocasa integer,
	casa_id integer,
	CONSTRAINT idpago PRIMARY KEY (idpago),
	CONSTRAINT casa_id FOREIGN KEY (casa_id)
		REFERENCES public.casa (id) MATCH SIMPLE
		ON UPDATE CASCADE ON DELETE CASCADE
);

create table nivel_instruccion(
	id serial not null primary key,
	nombre varchar(255) not null
);

CREATE TABLE public.trabajo
(
  idtrabajo serial,
  trabaja boolean DEFAULT false,
  antiguedad character varying(2),
  lugartrabajo character varying(255),
  sueldomensual integer,
  cargo character varying(255),
  CONSTRAINT idtrabajo PRIMARY KEY (idtrabajo)
);

CREATE TABLE public.persona
(
  id serial,
  nacionalidad character(1) NOT NULL,
  cedula character varying(10) NOT NULL,
  primer_nombre character varying(20) NOT NULL,
  segundo_nombre character varying(20),
  primer_apellido character varying(20) NOT NULL,
  segundo_apellido character varying(20),
  sexo character(1),
  fecha_nacimiento  date NOT NULL,
  lugar_nacimiento character varying(255) NOT NULL,
  foto character varying(255),
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone NOT NULL,
  estado_civil_id integer NOT NULL,
  categoria_id integer NOT NULL,
  jefefamilia boolean DEFAULT true,
  estudios_id integer,
  trabajo_id integer,
  usuario_id integer NOT NULL,
  CONSTRAINT persona_pkey PRIMARY KEY (id),
  CONSTRAINT persona_categoria_id_fkey FOREIGN KEY (categoria_id)
      REFERENCES public.categoria (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT persona_estado_civil_id_fkey FOREIGN KEY (estado_civil_id)
      REFERENCES public.estado_civil (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT persona_usuario_id_fkey FOREIGN KEY (usuario_id)
      REFERENCES public.usuario (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT trabajo_id FOREIGN KEY (trabajo_id)
      REFERENCES public.trabajo (idtrabajo) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE public.parentesco
(
    idpar serial,
    nombparent character varying(20),
    CONSTRAINT idpar PRIMARY KEY (idpar)
);

CREATE TABLE public.familiar
(
    idfam serial,
    cedula character varying(10),
    persona_id integer,
    pareja_id integer,
    familiar_id integer,
    parentesco_id integer,
    CONSTRAINT idfam PRIMARY KEY (idfam),
    CONSTRAINT familiar_id FOREIGN KEY (familiar_id)
        REFERENCES public.persona (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT pareja_id FOREIGN KEY (pareja_id)
        REFERENCES public.persona (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT parentesco_id FOREIGN KEY (parentesco_id)
        REFERENCES public.parentesco (idpar) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT persona_id FOREIGN KEY (persona_id)
        REFERENCES public.persona (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

CREATE TABLE public.direccion
(
  iddir serial,
  persona_id integer NOT NULL,
  casa_id integer,
  calle_id integer NOT NULL,
  CONSTRAINT iddir PRIMARY KEY (iddir),
  CONSTRAINT calle_id FOREIGN KEY (calle_id)
      REFERENCES public.calle (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT casa_id FOREIGN KEY (casa_id)
      REFERENCES public.casa (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE public.estudios
(
  idestu serial,
  nivelinstruccion character varying(255),
  profesion character varying(255),
  nombestudio character varying(255),
  CONSTRAINT idestu PRIMARY KEY (idestu)
);

CREATE TABLE public.pruebacovid
(
  idcovid serial,
  prueba_1 boolean,
  f_prueba1 date,
  resultado1 boolean,
  persona_id integer,
  CONSTRAINT idcovid PRIMARY KEY (idcovid),
  CONSTRAINT persona_id FOREIGN KEY (persona_id)
      REFERENCES public.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

create table documento(
	id serial not null primary key,
	nombre character varying(255) NOT NULL,
	archivo character varying(50) NOT NULL,
	created_at timestamp without time zone NOT NULL,
	persona_id integer NOT NULL,
	usuario_id integer NOT NULL,
	CONSTRAINT persona_id FOREIGN KEY (persona_id)
      		REFERENCES public.persona (id) MATCH SIMPLE
      		ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT usuario_id FOREIGN KEY (usuario_id)
      		REFERENCES public.usuario (id) MATCH SIMPLE
      		ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE public.enfermedad
(
  idenf serial,
  nombenf character varying(255),
  tratamiento character varying(255),
  persona_id integer,
  CONSTRAINT idenf PRIMARY KEY (idenf),
  CONSTRAINT persona_id FOREIGN KEY (persona_id)
      REFERENCES public.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE public.discapacidad
(
  iddisca serial,
  nombdisca character varying(255),
  persona_id integer,
  CONSTRAINT iddisca PRIMARY KEY (iddisca),
  CONSTRAINT persona_id FOREIGN KEY (persona_id)
      REFERENCES public.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE public.embarcacionnegocio
(
  idembneg serial,
  posee_emb boolean DEFAULT false,
  propietario boolean DEFAULT false,
  datosdueno character varying(255),
  operativa boolean DEFAULT false,
  matricula character varying(255),
  poseenegocio character varying(255),
  poseeconcesion boolean DEFAULT false,
  persona_id integer,
  CONSTRAINT idembneg PRIMARY KEY (idembneg),
  CONSTRAINT persona_id FOREIGN KEY (persona_id)
      REFERENCES public.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE public.inmuebles
(
  idinm serial,
  cocinas character varying(2),
  lavadora character varying(2),
  nevera character varying(2),
  aireacondicionado character varying(2),
  tv character varying(2),
  computadora character varying(2),
  camas character varying(2),
  CONSTRAINT idinm PRIMARY KEY (idinm)
);

CREATE TABLE public.mascota
(
  idmasc serial,
  perro boolean DEFAULT false,
  gato boolean DEFAULT false,
  aves boolean DEFAULT false,
  otros boolean DEFAULT false,
  persona_id integer,
  CONSTRAINT idmasc PRIMARY KEY (idmasc),
  CONSTRAINT persona_id FOREIGN KEY (persona_id)
      REFERENCES public.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE public.servicios
(
  idserv serial,
  luz boolean DEFAULT false,
  aguasblancas boolean DEFAULT false,
  gas boolean DEFAULT false,
  cloacas boolean DEFAULT false,
  internet boolean DEFAULT false,
  casa_id integer,
  CONSTRAINT idserv PRIMARY KEY (idserv),
  CONSTRAINT casa_id FOREIGN KEY (casa_id)
      REFERENCES public.casa (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE public.telefono
(
  idtelf serial,
  telffijo character varying(255),
  telfmovil character varying(255),
  persona_id integer,
  CONSTRAINT idtelf PRIMARY KEY (idtelf),
  CONSTRAINT persona_id FOREIGN KEY (persona_id)
      REFERENCES public.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE public.politica
(
  idpoli serial,
  movsocial character varying(255),
  mision character varying(255),
  persona_id integer,
  CONSTRAINT idpoli PRIMARY KEY (idpoli),
  CONSTRAINT persona_id FOREIGN KEY (persona_id)
      REFERENCES public.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE public.condicionisla
(
  idcond serial,
  status character varying(10),
  f_registro date,
  time_expulsion character varying(10),
	persona_id integer,
  CONSTRAINT idcond PRIMARY KEY (idcond),
	CONSTRAINT persona_id FOREIGN KEY (persona_id)
      REFERENCES public.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

create view v_persona
	as select p.id as id, p.nacionalidad||'-'||Cedula as cedula,
			p.primer_nombre||' '||p.segundo_nombre as nombre,
			p.primer_apellido||' '||p.segundo_apellido as apellido,
			p.fecha_nacimiento,
			p.lugar_nacimiento,
			e.nombre as estado_civil,
			ce.nombre as calle,
			ca.nombre as casa,
			ct.nombre as categoria
	from persona p
	left join estado_civil e on e.id=p.estado_civil_id
	left join casa ca on ca.id=p.casa_id
	left join calle ce on ce.id=ca.calle_id
	left join categoria ct on ct.id=p.categoria_id;

create view v_carnet
	as select cat.nombre as categoria,
			cedula as cedula,
			lpad(ce.id::text,2,'0') as calle,
			lpad(ca.id::text,3,'0') as casa,
			lpad(
				(
					select count(*)
					from persona sp
					where sp.casa_id=p.casa_id and sp.id<=p.id
				)::text,2,'0'
			) as residencia,
			lpad(p.id::text,4,'0') as persona
				from persona p
				left join casa ca on p.casa_id=ca.id
				left join calle ce on ce.id=ca.calle_id
				left join categoria cat on cat.id=p.categoria_id
				order by p.id;


insert into usuario (nombre,apellido,login,clave,perfil_id) values ('ADMIN','ADMIN','ADMIN',md5('ADMIN'),1);

insert into categoria (nombre) values ('ROQUEÑO'),('ROQUEÑA'),('RESIDENTE');

insert into estado_civil (nombre) values ('SOLTERO/A'),('CONCUVINO/A'),('CASADO/A'),('VIUDO/A'),('DIVORCIADO/A');

insert into nivel_instruccion(nombre) values('SIN INSTRUCCIÓN');
insert into nivel_instruccion(nombre) values('PRIMARIA');
insert into nivel_instruccion(nombre) values('BACHILLER');
insert into nivel_instruccion(nombre) values('TÉCNICO MEDIO');
insert into nivel_instruccion(nombre) values('TÉCNICO SUPERIOR');
insert into nivel_instruccion(nombre) values('UNIVERSITARIO');
insert into nivel_instruccion(nombre) values('POST GRADO');
insert into nivel_instruccion(nombre) values('DOCTORADO');
