--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.1
-- Dumped by pg_dump version 9.4.1
-- Started on 2017-03-27 15:12:52 CDT

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 424 (class 3079 OID 11895)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 4433 (class 0 OID 0)
-- Dependencies: 424
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 172 (class 1259 OID 261122)
-- Name: acl_classes; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE acl_classes (
    id integer NOT NULL,
    class_type character varying(200) NOT NULL
);


ALTER TABLE acl_classes OWNER TO daiqui6_postgres;

--
-- TOC entry 173 (class 1259 OID 261125)
-- Name: acl_classes_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE acl_classes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE acl_classes_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 4434 (class 0 OID 0)
-- Dependencies: 173
-- Name: acl_classes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: daiqui6_postgres
--

ALTER SEQUENCE acl_classes_id_seq OWNED BY acl_classes.id;


--
-- TOC entry 174 (class 1259 OID 261127)
-- Name: acl_entries; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE acl_entries (
    id integer NOT NULL,
    class_id integer NOT NULL,
    object_identity_id integer,
    security_identity_id integer NOT NULL,
    field_name character varying(50) DEFAULT NULL::character varying,
    ace_order smallint NOT NULL,
    mask integer NOT NULL,
    granting boolean NOT NULL,
    granting_strategy character varying(30) NOT NULL,
    audit_success boolean NOT NULL,
    audit_failure boolean NOT NULL
);


ALTER TABLE acl_entries OWNER TO daiqui6_postgres;

--
-- TOC entry 175 (class 1259 OID 261131)
-- Name: acl_entries_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE acl_entries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE acl_entries_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 4435 (class 0 OID 0)
-- Dependencies: 175
-- Name: acl_entries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: daiqui6_postgres
--

ALTER SEQUENCE acl_entries_id_seq OWNED BY acl_entries.id;


--
-- TOC entry 176 (class 1259 OID 261133)
-- Name: acl_object_identities; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE acl_object_identities (
    id integer NOT NULL,
    parent_object_identity_id integer,
    class_id integer NOT NULL,
    object_identifier character varying(100) NOT NULL,
    entries_inheriting boolean NOT NULL
);


ALTER TABLE acl_object_identities OWNER TO daiqui6_postgres;

--
-- TOC entry 177 (class 1259 OID 261136)
-- Name: acl_object_identities_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE acl_object_identities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE acl_object_identities_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 4436 (class 0 OID 0)
-- Dependencies: 177
-- Name: acl_object_identities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: daiqui6_postgres
--

ALTER SEQUENCE acl_object_identities_id_seq OWNED BY acl_object_identities.id;


--
-- TOC entry 178 (class 1259 OID 261138)
-- Name: acl_object_identity_ancestors; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE acl_object_identity_ancestors (
    object_identity_id integer NOT NULL,
    ancestor_id integer NOT NULL
);


ALTER TABLE acl_object_identity_ancestors OWNER TO daiqui6_postgres;

--
-- TOC entry 179 (class 1259 OID 261141)
-- Name: acl_security_identities; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE acl_security_identities (
    id integer NOT NULL,
    identifier character varying(200) NOT NULL,
    username boolean NOT NULL
);


ALTER TABLE acl_security_identities OWNER TO daiqui6_postgres;

--
-- TOC entry 180 (class 1259 OID 261144)
-- Name: acl_security_identities_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE acl_security_identities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE acl_security_identities_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 4437 (class 0 OID 0)
-- Dependencies: 180
-- Name: acl_security_identities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: daiqui6_postgres
--

ALTER SEQUENCE acl_security_identities_id_seq OWNED BY acl_security_identities.id;


--
-- TOC entry 181 (class 1259 OID 261146)
-- Name: airline; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE airline (
    id integer NOT NULL,
    picture integer,
    gallery integer,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE airline OWNER TO daiqui6_postgres;

--
-- TOC entry 182 (class 1259 OID 261154)
-- Name: airline_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE airline_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE airline_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 183 (class 1259 OID 261156)
-- Name: airport; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE airport (
    id integer NOT NULL,
    address character varying(255) DEFAULT NULL::character varying,
    phone character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE airport OWNER TO daiqui6_postgres;

--
-- TOC entry 184 (class 1259 OID 261164)
-- Name: block; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE block (
    id integer NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    mincampaign integer NOT NULL,
    visible boolean NOT NULL,
    number integer DEFAULT 0
);


ALTER TABLE block OWNER TO daiqui6_postgres;

--
-- TOC entry 185 (class 1259 OID 261169)
-- Name: campaign; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign (
    id integer NOT NULL,
    block_id integer,
    picture integer,
    gallery integer,
    startdate date NOT NULL,
    enddate date NOT NULL,
    showstartdate date NOT NULL,
    showenddate date NOT NULL,
    instartdate date NOT NULL,
    inenddate date NOT NULL,
    title character varying(255) NOT NULL,
    subtitle character varying(255) NOT NULL,
    caption character varying(255) NOT NULL,
    priority integer,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description character varying(20000) DEFAULT NULL::character varying,
    available boolean NOT NULL,
    type character varying(255) NOT NULL,
    calification integer DEFAULT 0
);


ALTER TABLE campaign OWNER TO daiqui6_postgres;

--
-- TOC entry 186 (class 1259 OID 261176)
-- Name: campaign_car; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_car (
    id integer NOT NULL,
    car_id integer,
    cardiscount double precision NOT NULL
);


ALTER TABLE campaign_car OWNER TO daiqui6_postgres;

--
-- TOC entry 187 (class 1259 OID 261179)
-- Name: campaign_circuit; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_circuit (
    id integer NOT NULL,
    circuit_id integer,
    adultdiscount double precision NOT NULL,
    kiddiscount double precision NOT NULL
);


ALTER TABLE campaign_circuit OWNER TO daiqui6_postgres;

--
-- TOC entry 408 (class 1259 OID 264485)
-- Name: campaign_excursion_colective; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_excursion_colective (
    id integer NOT NULL,
    excursion_id integer,
    adultdiscount double precision NOT NULL,
    kiddiscount double precision NOT NULL
);


ALTER TABLE campaign_excursion_colective OWNER TO daiqui6_postgres;

--
-- TOC entry 409 (class 1259 OID 264491)
-- Name: campaign_excursion_exclusive; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_excursion_exclusive (
    id integer NOT NULL,
    excursion_id integer,
    adultdiscount double precision NOT NULL,
    kiddiscount double precision NOT NULL
);


ALTER TABLE campaign_excursion_exclusive OWNER TO daiqui6_postgres;

--
-- TOC entry 412 (class 1259 OID 264586)
-- Name: campaign_hotel; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_hotel (
    id integer NOT NULL,
    room_id integer,
    base double precision DEFAULT 0::double precision NOT NULL,
    individual double precision DEFAULT 0::double precision NOT NULL,
    chindividual integer NOT NULL,
    three double precision DEFAULT 0::double precision NOT NULL,
    adult1 double precision DEFAULT 0::double precision NOT NULL,
    adult2 double precision DEFAULT 0::double precision NOT NULL,
    adult3 double precision DEFAULT 0::double precision NOT NULL,
    chthree integer NOT NULL
);


ALTER TABLE campaign_hotel OWNER TO daiqui6_postgres;

--
-- TOC entry 188 (class 1259 OID 261188)
-- Name: campaign_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE campaign_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE campaign_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 189 (class 1259 OID 261190)
-- Name: campaign_medical; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_medical (
    id integer NOT NULL,
    medical_id integer,
    adultdiscount double precision NOT NULL,
    kiddiscount double precision NOT NULL
);


ALTER TABLE campaign_medical OWNER TO daiqui6_postgres;

--
-- TOC entry 190 (class 1259 OID 261193)
-- Name: campaign_package; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_package (
    id integer NOT NULL,
    package_id integer,
    adultdiscount double precision NOT NULL,
    kiddiscount double precision NOT NULL
);


ALTER TABLE campaign_package OWNER TO daiqui6_postgres;

--
-- TOC entry 410 (class 1259 OID 264517)
-- Name: campaign_rental_house; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_rental_house (
    id integer NOT NULL,
    roomdiscount double precision NOT NULL
);


ALTER TABLE campaign_rental_house OWNER TO daiqui6_postgres;

--
-- TOC entry 191 (class 1259 OID 261196)
-- Name: campaign_transfer_colective; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_transfer_colective (
    id integer NOT NULL,
    pricepxdiscount double precision
);


ALTER TABLE campaign_transfer_colective OWNER TO daiqui6_postgres;

--
-- TOC entry 192 (class 1259 OID 261199)
-- Name: campaign_transfer_exclusive; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaign_transfer_exclusive (
    id integer NOT NULL,
    price01_02 double precision,
    price03_04 double precision,
    price05_07 double precision,
    price08_12 double precision,
    price13_19 double precision,
    price20_30 double precision,
    price31_40 double precision
);


ALTER TABLE campaign_transfer_exclusive OWNER TO daiqui6_postgres;

--
-- TOC entry 411 (class 1259 OID 264522)
-- Name: campaignrantalhouses_rentalhouserooms; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaignrantalhouses_rentalhouserooms (
    rental_house_room_id integer NOT NULL,
    campaign_rental_house_id integer NOT NULL
);


ALTER TABLE campaignrantalhouses_rentalhouserooms OWNER TO daiqui6_postgres;

--
-- TOC entry 193 (class 1259 OID 261202)
-- Name: campaigntransfercolective_transfers; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaigntransfercolective_transfers (
    transfer_colective_id integer NOT NULL,
    campaign_transfer_colective_id integer NOT NULL
);


ALTER TABLE campaigntransfercolective_transfers OWNER TO daiqui6_postgres;

--
-- TOC entry 194 (class 1259 OID 261205)
-- Name: campaigntransferexclisive_transfers; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE campaigntransferexclisive_transfers (
    transfer_exclusive_id integer NOT NULL,
    campaign_transfer_exclusive_id integer NOT NULL
);


ALTER TABLE campaigntransferexclisive_transfers OWNER TO daiqui6_postgres;

--
-- TOC entry 195 (class 1259 OID 261208)
-- Name: cancelation_product; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE cancelation_product (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE cancelation_product OWNER TO daiqui6_postgres;

--
-- TOC entry 196 (class 1259 OID 261215)
-- Name: cancelation_product_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE cancelation_product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cancelation_product_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 197 (class 1259 OID 261217)
-- Name: car; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE car (
    id integer NOT NULL,
    car_class integer,
    car_luggage_capacity integer,
    car_category integer,
    capacity integer NOT NULL,
    air_conditioner boolean NOT NULL,
    cd_player boolean NOT NULL,
    doors integer NOT NULL,
    engine character varying(255) DEFAULT NULL::character varying,
    transsmission boolean,
    clima boolean,
    satellite boolean,
    powerdoorslock boolean,
    powerwindow boolean,
    tilt boolean,
    radio boolean,
    shuttlebus boolean,
    terminalpickup boolean,
    power integer
);


ALTER TABLE car OWNER TO daiqui6_postgres;

--
-- TOC entry 198 (class 1259 OID 261221)
-- Name: car_availability; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE car_availability (
    id integer NOT NULL,
    date date NOT NULL
);


ALTER TABLE car_availability OWNER TO daiqui6_postgres;

--
-- TOC entry 199 (class 1259 OID 261224)
-- Name: car_availability_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE car_availability_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE car_availability_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 200 (class 1259 OID 261226)
-- Name: car_availabilitys_car; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE car_availabilitys_car (
    car_availability_id integer NOT NULL,
    car_id integer NOT NULL
);


ALTER TABLE car_availabilitys_car OWNER TO daiqui6_postgres;

--
-- TOC entry 201 (class 1259 OID 261229)
-- Name: car_category; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE car_category (
    id integer NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    priority integer
);


ALTER TABLE car_category OWNER TO daiqui6_postgres;

--
-- TOC entry 202 (class 1259 OID 261236)
-- Name: car_category_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE car_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE car_category_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 203 (class 1259 OID 261238)
-- Name: car_class; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE car_class (
    id integer NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE car_class OWNER TO daiqui6_postgres;

--
-- TOC entry 204 (class 1259 OID 261245)
-- Name: car_class_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE car_class_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE car_class_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 205 (class 1259 OID 261247)
-- Name: car_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE car_item (
    realid integer NOT NULL,
    pickupplace_id integer,
    dropoffplace_id integer,
    enddate timestamp(0) without time zone NOT NULL
);


ALTER TABLE car_item OWNER TO daiqui6_postgres;

--
-- TOC entry 206 (class 1259 OID 261250)
-- Name: car_request; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE car_request (
    id integer NOT NULL,
    package integer,
    pickupplace_id integer,
    dropoffplace_id integer,
    enddate date NOT NULL,
    startdate date NOT NULL,
    endtime date NOT NULL,
    starttime date NOT NULL
);


ALTER TABLE car_request OWNER TO daiqui6_postgres;

--
-- TOC entry 207 (class 1259 OID 261253)
-- Name: car_searcher; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE car_searcher (
    id integer NOT NULL,
    pickupplace integer,
    dropoffplace integer,
    car integer,
    capacity integer,
    startdate date NOT NULL,
    enddate date NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    luggagecapacity integer
);


ALTER TABLE car_searcher OWNER TO daiqui6_postgres;

--
-- TOC entry 419 (class 1259 OID 264852)
-- Name: car_season; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE car_season (
    id integer NOT NULL,
    car_id integer,
    title character varying(255) NOT NULL,
    price double precision,
    startdate date NOT NULL,
    enddate date NOT NULL
);


ALTER TABLE car_season OWNER TO daiqui6_postgres;

--
-- TOC entry 418 (class 1259 OID 264850)
-- Name: car_season_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE car_season_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE car_season_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 208 (class 1259 OID 261257)
-- Name: cart_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE cart_item (
    realid integer NOT NULL,
    product integer,
    id character varying(255) NOT NULL,
    title character varying(255) NOT NULL,
    unitariprice double precision NOT NULL,
    quantity integer NOT NULL,
    totalprice double precision NOT NULL,
    startdate timestamp(0) without time zone NOT NULL,
    type character varying(255) NOT NULL
);


ALTER TABLE cart_item OWNER TO daiqui6_postgres;

--
-- TOC entry 209 (class 1259 OID 261263)
-- Name: cartitem_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE cartitem_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cartitem_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 210 (class 1259 OID 261265)
-- Name: chain; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE chain (
    id integer NOT NULL,
    picture integer,
    gallery integer,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying,
    available boolean,
    image character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE chain OWNER TO daiqui6_postgres;

--
-- TOC entry 211 (class 1259 OID 261274)
-- Name: chain_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE chain_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE chain_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 212 (class 1259 OID 261276)
-- Name: circuirsearcher_place; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuirsearcher_place (
    id_circuitsearcher integer NOT NULL,
    id_place integer NOT NULL
);


ALTER TABLE circuirsearcher_place OWNER TO daiqui6_postgres;

--
-- TOC entry 213 (class 1259 OID 261282)
-- Name: circuit; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuit (
    id integer NOT NULL,
    days integer,
    nights integer,
    polofromid integer,
    allow_kid boolean DEFAULT false NOT NULL
);


ALTER TABLE circuit OWNER TO daiqui6_postgres;

--
-- TOC entry 214 (class 1259 OID 261285)
-- Name: circuit_availability; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuit_availability (
    id integer NOT NULL,
    date date
);


ALTER TABLE circuit_availability OWNER TO daiqui6_postgres;

--
-- TOC entry 215 (class 1259 OID 261288)
-- Name: circuit_availability_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE circuit_availability_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE circuit_availability_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 216 (class 1259 OID 261290)
-- Name: circuit_circuitavailabilitys; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuit_circuitavailabilitys (
    circuit_id integer NOT NULL,
    circuit_availability_id integer NOT NULL
);


ALTER TABLE circuit_circuitavailabilitys OWNER TO daiqui6_postgres;

--
-- TOC entry 217 (class 1259 OID 261293)
-- Name: circuit_day; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuit_day (
    id integer NOT NULL,
    circuit integer,
    picture integer,
    gallery integer,
    title character varying(255) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    day integer,
    include character varying(2000) DEFAULT NULL::character varying,
    notinclude character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE circuit_day OWNER TO daiqui6_postgres;

--
-- TOC entry 218 (class 1259 OID 261303)
-- Name: circuit_day_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE circuit_day_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE circuit_day_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 219 (class 1259 OID 261305)
-- Name: circuit_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuit_item (
    realid integer NOT NULL,
    pickupplace integer,
    adults integer NOT NULL,
    kids integer NOT NULL,
    ocupation integer NOT NULL
);


ALTER TABLE circuit_item OWNER TO daiqui6_postgres;

--
-- TOC entry 220 (class 1259 OID 261308)
-- Name: circuit_request; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuit_request (
    id integer NOT NULL,
    circuit integer,
    adult integer NOT NULL,
    kid integer NOT NULL,
    startdate date NOT NULL,
    ocupation integer NOT NULL
);


ALTER TABLE circuit_request OWNER TO daiqui6_postgres;

--
-- TOC entry 221 (class 1259 OID 261311)
-- Name: circuit_searcher; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuit_searcher (
    id integer NOT NULL,
    circuit integer,
    days integer,
    title character varying(255) DEFAULT NULL::character varying,
    nights integer,
    date date NOT NULL,
    betweendates boolean,
    adults integer NOT NULL,
    kids integer NOT NULL,
    polofromid integer
);


ALTER TABLE circuit_searcher OWNER TO daiqui6_postgres;

--
-- TOC entry 222 (class 1259 OID 261315)
-- Name: circuit_season; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuit_season (
    id integer NOT NULL,
    circuit_id integer,
    title character varying(255) NOT NULL,
    adult_price double precision,
    kid_price double precision,
    adult_price_doble double precision,
    kid_price_doble double precision,
    startdate date NOT NULL,
    enddate date NOT NULL
);


ALTER TABLE circuit_season OWNER TO daiqui6_postgres;

--
-- TOC entry 223 (class 1259 OID 261328)
-- Name: circuit_season_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE circuit_season_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE circuit_season_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 224 (class 1259 OID 261330)
-- Name: circuits_days_places; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE circuits_days_places (
    circuit_day_id integer NOT NULL,
    place_id integer NOT NULL
);


ALTER TABLE circuits_days_places OWNER TO daiqui6_postgres;

--
-- TOC entry 225 (class 1259 OID 261333)
-- Name: classification__category; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE classification__category (
    id integer NOT NULL,
    parent_id integer,
    context character varying(255) DEFAULT NULL::character varying,
    media_id integer,
    name character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    slug character varying(255) NOT NULL,
    description character varying(255) DEFAULT NULL::character varying,
    "position" integer,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE classification__category OWNER TO daiqui6_postgres;

--
-- TOC entry 226 (class 1259 OID 261341)
-- Name: classification__category_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE classification__category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE classification__category_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 227 (class 1259 OID 261343)
-- Name: classification__collection; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE classification__collection (
    id integer NOT NULL,
    context character varying(255) DEFAULT NULL::character varying,
    media_id integer,
    name character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    slug character varying(255) NOT NULL,
    description character varying(255) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE classification__collection OWNER TO daiqui6_postgres;

--
-- TOC entry 228 (class 1259 OID 261351)
-- Name: classification__collection_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE classification__collection_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE classification__collection_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 229 (class 1259 OID 261353)
-- Name: classification__context; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE classification__context (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE classification__context OWNER TO daiqui6_postgres;

--
-- TOC entry 230 (class 1259 OID 261359)
-- Name: classification__tag; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE classification__tag (
    id integer NOT NULL,
    context character varying(255) DEFAULT NULL::character varying,
    name character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    slug character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE classification__tag OWNER TO daiqui6_postgres;

--
-- TOC entry 231 (class 1259 OID 261366)
-- Name: classification__tag_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE classification__tag_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE classification__tag_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 232 (class 1259 OID 261377)
-- Name: configuration_pam; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE configuration_pam (
    id integer NOT NULL,
    key_pam_eur character varying(255) NOT NULL,
    code_pam_eur integer NOT NULL,
    key_pam_usd character varying(255) NOT NULL,
    code_pam_usd integer NOT NULL,
    comercio character varying(255) NOT NULL,
    pasarela character varying(255) NOT NULL,
    absolute_dir character varying(255) NOT NULL,
    url_recive character varying(255) NOT NULL,
    url_ok character varying(255) NOT NULL,
    url_ko character varying(255) NOT NULL
);


ALTER TABLE configuration_pam OWNER TO daiqui6_postgres;

--
-- TOC entry 233 (class 1259 OID 261383)
-- Name: configuration_tpv; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE configuration_tpv (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    company_name character varying(255) NOT NULL,
    tax double precision NOT NULL,
    type character varying(255) NOT NULL
);


ALTER TABLE configuration_tpv OWNER TO daiqui6_postgres;

--
-- TOC entry 234 (class 1259 OID 261389)
-- Name: configuration_tpv_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE configuration_tpv_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE configuration_tpv_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 235 (class 1259 OID 261391)
-- Name: contact; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE contact (
    id integer NOT NULL,
    contact_cause integer,
    email character varying(255) DEFAULT NULL::character varying,
    name character varying(255) DEFAULT NULL::character varying,
    message character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE contact OWNER TO daiqui6_postgres;

--
-- TOC entry 236 (class 1259 OID 261400)
-- Name: contact_cause; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE contact_cause (
    id integer NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE contact_cause OWNER TO daiqui6_postgres;

--
-- TOC entry 237 (class 1259 OID 261408)
-- Name: contact_cause_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE contact_cause_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE contact_cause_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 238 (class 1259 OID 261410)
-- Name: contact_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE contact_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE contact_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 239 (class 1259 OID 261412)
-- Name: country; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE country (
    id integer NOT NULL,
    picture integer,
    gallery integer,
    market_id integer,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    isocode character varying(3) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE country OWNER TO daiqui6_postgres;

--
-- TOC entry 240 (class 1259 OID 261419)
-- Name: country_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE country_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE country_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 241 (class 1259 OID 261421)
-- Name: currency; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE currency (
    id integer NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    change double precision,
    nomenclator character varying(255) DEFAULT NULL::character varying,
    favicon character varying(255) DEFAULT NULL::character varying,
    code character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE currency OWNER TO daiqui6_postgres;

--
-- TOC entry 242 (class 1259 OID 261431)
-- Name: currency_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE currency_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE currency_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 243 (class 1259 OID 261433)
-- Name: document; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE document (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE document OWNER TO daiqui6_postgres;

--
-- TOC entry 244 (class 1259 OID 261440)
-- Name: document_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE document_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE document_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 245 (class 1259 OID 261442)
-- Name: documents_hotels; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE documents_hotels (
    document_id integer NOT NULL,
    hotel_id integer NOT NULL
);


ALTER TABLE documents_hotels OWNER TO daiqui6_postgres;

--
-- TOC entry 246 (class 1259 OID 261445)
-- Name: documents_packages; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE documents_packages (
    document_id integer NOT NULL,
    package_id integer NOT NULL
);


ALTER TABLE documents_packages OWNER TO daiqui6_postgres;

--
-- TOC entry 247 (class 1259 OID 261448)
-- Name: documents_products; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE documents_products (
    document_id integer NOT NULL,
    product_id integer NOT NULL
);


ALTER TABLE documents_products OWNER TO daiqui6_postgres;

--
-- TOC entry 248 (class 1259 OID 261451)
-- Name: documents_rentalhouse; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE documents_rentalhouse (
    document_id integer NOT NULL,
    rental_house_id integer NOT NULL
);


ALTER TABLE documents_rentalhouse OWNER TO daiqui6_postgres;

--
-- TOC entry 249 (class 1259 OID 261454)
-- Name: driver; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE driver (
    id integer NOT NULL,
    picture integer,
    title character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    lastname character varying(255) NOT NULL,
    dateofbirth date,
    experienceyears integer,
    email character varying(255) DEFAULT NULL::character varying,
    phone1 character varying(255) DEFAULT NULL::character varying,
    phone2 character varying(255) DEFAULT NULL::character varying,
    description text,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE driver OWNER TO daiqui6_postgres;

--
-- TOC entry 250 (class 1259 OID 261463)
-- Name: driver_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE driver_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE driver_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 251 (class 1259 OID 261465)
-- Name: drivers_cars; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE drivers_cars (
    driver_id integer NOT NULL,
    car_id integer NOT NULL
);


ALTER TABLE drivers_cars OWNER TO daiqui6_postgres;

--
-- TOC entry 252 (class 1259 OID 261468)
-- Name: duser; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE duser (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    username_canonical character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_canonical character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    salt character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    locked boolean NOT NULL,
    expired boolean NOT NULL,
    expires_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(255) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text NOT NULL,
    credentials_expired boolean NOT NULL,
    credentials_expire_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    date_of_birth timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    firstname character varying(64) DEFAULT NULL::character varying,
    lastname character varying(64) DEFAULT NULL::character varying,
    website character varying(64) DEFAULT NULL::character varying,
    biography character varying(1000) DEFAULT NULL::character varying,
    gender character varying(1) DEFAULT NULL::character varying,
    locale character varying(8) DEFAULT NULL::character varying,
    timezone character varying(64) DEFAULT NULL::character varying,
    phone character varying(64) DEFAULT NULL::character varying,
    facebook_uid character varying(255) DEFAULT NULL::character varying,
    facebook_name character varying(255) DEFAULT NULL::character varying,
    facebook_data text,
    twitter_uid character varying(255) DEFAULT NULL::character varying,
    twitter_name character varying(255) DEFAULT NULL::character varying,
    twitter_data text,
    gplus_uid character varying(255) DEFAULT NULL::character varying,
    gplus_name character varying(255) DEFAULT NULL::character varying,
    gplus_data text,
    token character varying(255) DEFAULT NULL::character varying,
    two_step_code character varying(255) DEFAULT NULL::character varying,
    passport bigint,
    facebook_id character varying(255) DEFAULT NULL::character varying,
    google_id character varying(255) DEFAULT NULL::character varying,
    twitter_id character varying(255) DEFAULT NULL::character varying,
    avatar character varying(255) DEFAULT NULL::character varying,
    picture character varying(255) DEFAULT NULL::character varying,
    address character varying(255) DEFAULT NULL::character varying,
    city character varying(255) DEFAULT NULL::character varying,
    state character varying(255) DEFAULT NULL::character varying,
    zipcode integer,
    country character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE duser OWNER TO daiqui6_postgres;

--
-- TOC entry 4438 (class 0 OID 0)
-- Dependencies: 252
-- Name: COLUMN duser.roles; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN duser.roles IS '(DC2Type:array)';


--
-- TOC entry 4439 (class 0 OID 0)
-- Dependencies: 252
-- Name: COLUMN duser.facebook_data; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN duser.facebook_data IS '(DC2Type:json)';


--
-- TOC entry 4440 (class 0 OID 0)
-- Dependencies: 252
-- Name: COLUMN duser.twitter_data; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN duser.twitter_data IS '(DC2Type:json)';


--
-- TOC entry 4441 (class 0 OID 0)
-- Dependencies: 252
-- Name: COLUMN duser.gplus_data; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN duser.gplus_data IS '(DC2Type:json)';


--
-- TOC entry 253 (class 1259 OID 261505)
-- Name: duser_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE duser_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE duser_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 254 (class 1259 OID 261507)
-- Name: excursion; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion (
    id integer NOT NULL,
    polofrom integer,
    duration integer,
    include character varying(2000) DEFAULT NULL::character varying,
    notinclude character varying(2000) DEFAULT NULL::character varying,
    sunday boolean,
    monday boolean,
    thuesday boolean,
    wednesday boolean,
    thursday boolean,
    friday boolean,
    saturday boolean,
    adultprice double precision,
    kid_price double precision
);


ALTER TABLE excursion OWNER TO daiqui6_postgres;

--
-- TOC entry 255 (class 1259 OID 261515)
-- Name: excursion_colective; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_colective (
    id integer NOT NULL,
    minpax integer
);


ALTER TABLE excursion_colective OWNER TO daiqui6_postgres;

--
-- TOC entry 256 (class 1259 OID 261518)
-- Name: excursion_colective_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_colective_item (
    realid integer NOT NULL,
    pickupplace integer,
    dropoffplace integer,
    adult integer NOT NULL,
    kid integer NOT NULL
);


ALTER TABLE excursion_colective_item OWNER TO daiqui6_postgres;

--
-- TOC entry 257 (class 1259 OID 261521)
-- Name: excursion_exclusive; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_exclusive (
    id integer NOT NULL
);


ALTER TABLE excursion_exclusive OWNER TO daiqui6_postgres;

--
-- TOC entry 258 (class 1259 OID 261524)
-- Name: excursion_exclusive_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_exclusive_item (
    realid integer NOT NULL,
    pickupplace integer,
    dropoffplace integer,
    adult integer NOT NULL,
    kid integer NOT NULL
);


ALTER TABLE excursion_exclusive_item OWNER TO daiqui6_postgres;

--
-- TOC entry 259 (class 1259 OID 261527)
-- Name: excursion_excursion_types; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_excursion_types (
    excursion_id integer NOT NULL,
    excursion_type_id integer NOT NULL
);


ALTER TABLE excursion_excursion_types OWNER TO daiqui6_postgres;

--
-- TOC entry 416 (class 1259 OID 264804)
-- Name: excursion_place; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_place (
    excursion_id integer NOT NULL,
    place_id integer NOT NULL
);


ALTER TABLE excursion_place OWNER TO daiqui6_postgres;

--
-- TOC entry 260 (class 1259 OID 261530)
-- Name: excursion_request; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_request (
    id integer NOT NULL,
    excursion integer,
    adult integer NOT NULL,
    kid integer NOT NULL,
    startdate date NOT NULL
);


ALTER TABLE excursion_request OWNER TO daiqui6_postgres;

--
-- TOC entry 261 (class 1259 OID 261533)
-- Name: excursion_searcher; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_searcher (
    id integer NOT NULL,
    polo integer,
    excursion integer,
    polofrom integer,
    date date NOT NULL,
    exclusive boolean NOT NULL,
    adults integer NOT NULL,
    kids integer NOT NULL
);


ALTER TABLE excursion_searcher OWNER TO daiqui6_postgres;

--
-- TOC entry 417 (class 1259 OID 264821)
-- Name: excursion_searcher_excursion_place; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_searcher_excursion_place (
    excursion_searcher_id integer NOT NULL,
    excursion_place_id integer NOT NULL
);


ALTER TABLE excursion_searcher_excursion_place OWNER TO daiqui6_postgres;

--
-- TOC entry 262 (class 1259 OID 261536)
-- Name: excursion_searcher_excursion_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_searcher_excursion_type (
    excursion_searcher_id integer NOT NULL,
    excursion_type_id integer NOT NULL
);


ALTER TABLE excursion_searcher_excursion_type OWNER TO daiqui6_postgres;

--
-- TOC entry 263 (class 1259 OID 261539)
-- Name: excursion_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE excursion_type (
    id integer NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE excursion_type OWNER TO daiqui6_postgres;

--
-- TOC entry 264 (class 1259 OID 261547)
-- Name: excursion_type_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE excursion_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE excursion_type_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 265 (class 1259 OID 261549)
-- Name: ext_log_entries; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE ext_log_entries (
    id integer NOT NULL,
    action character varying(8) NOT NULL,
    logged_at timestamp(0) without time zone NOT NULL,
    object_id character varying(64) DEFAULT NULL::character varying,
    object_class character varying(255) NOT NULL,
    version integer NOT NULL,
    data text,
    username character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE ext_log_entries OWNER TO daiqui6_postgres;

--
-- TOC entry 4442 (class 0 OID 0)
-- Dependencies: 265
-- Name: COLUMN ext_log_entries.data; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN ext_log_entries.data IS '(DC2Type:array)';


--
-- TOC entry 266 (class 1259 OID 261557)
-- Name: ext_log_entries_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE ext_log_entries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ext_log_entries_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 267 (class 1259 OID 261559)
-- Name: ext_translations; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE ext_translations (
    id integer NOT NULL,
    locale character varying(8) NOT NULL,
    object_class character varying(255) NOT NULL,
    field character varying(32) NOT NULL,
    foreign_key character varying(64) NOT NULL,
    content text
);


ALTER TABLE ext_translations OWNER TO daiqui6_postgres;

--
-- TOC entry 268 (class 1259 OID 261565)
-- Name: ext_translations_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE ext_translations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ext_translations_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 4443 (class 0 OID 0)
-- Dependencies: 268
-- Name: ext_translations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: daiqui6_postgres
--

ALTER SEQUENCE ext_translations_id_seq OWNED BY ext_translations.id;


--
-- TOC entry 421 (class 1259 OID 268203)
-- Name: faq; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE faq (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    description character varying(20000) NOT NULL,
    vote integer,
    priority integer
);


ALTER TABLE faq OWNER TO daiqui6_postgres;

--
-- TOC entry 420 (class 1259 OID 268201)
-- Name: faq_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE faq_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE faq_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 269 (class 1259 OID 261567)
-- Name: flight; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE flight (
    id integer NOT NULL,
    airline integer,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE flight OWNER TO daiqui6_postgres;

--
-- TOC entry 270 (class 1259 OID 261575)
-- Name: flight_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE flight_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE flight_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 271 (class 1259 OID 261577)
-- Name: flights_airports; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE flights_airports (
    flight_id integer NOT NULL,
    airport_id integer NOT NULL
);


ALTER TABLE flights_airports OWNER TO daiqui6_postgres;

--
-- TOC entry 272 (class 1259 OID 261580)
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE fos_user_group (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    roles text NOT NULL
);


ALTER TABLE fos_user_group OWNER TO daiqui6_postgres;

--
-- TOC entry 4444 (class 0 OID 0)
-- Dependencies: 272
-- Name: COLUMN fos_user_group.roles; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN fos_user_group.roles IS '(DC2Type:array)';


--
-- TOC entry 273 (class 1259 OID 261586)
-- Name: fos_user_group_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE fos_user_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_group_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 274 (class 1259 OID 261588)
-- Name: fos_user_user; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE fos_user_user (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    username_canonical character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_canonical character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    salt character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    locked boolean NOT NULL,
    expired boolean NOT NULL,
    expires_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(255) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text NOT NULL,
    credentials_expired boolean NOT NULL,
    credentials_expire_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    date_of_birth timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    firstname character varying(64) DEFAULT NULL::character varying,
    lastname character varying(64) DEFAULT NULL::character varying,
    website character varying(64) DEFAULT NULL::character varying,
    biography character varying(1000) DEFAULT NULL::character varying,
    gender character varying(1) DEFAULT NULL::character varying,
    locale character varying(8) DEFAULT NULL::character varying,
    timezone character varying(64) DEFAULT NULL::character varying,
    phone character varying(64) DEFAULT NULL::character varying,
    facebook_uid character varying(255) DEFAULT NULL::character varying,
    facebook_name character varying(255) DEFAULT NULL::character varying,
    facebook_data text,
    twitter_uid character varying(255) DEFAULT NULL::character varying,
    twitter_name character varying(255) DEFAULT NULL::character varying,
    twitter_data text,
    gplus_uid character varying(255) DEFAULT NULL::character varying,
    gplus_name character varying(255) DEFAULT NULL::character varying,
    gplus_data text,
    token character varying(255) DEFAULT NULL::character varying,
    two_step_code character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE fos_user_user OWNER TO daiqui6_postgres;

--
-- TOC entry 4445 (class 0 OID 0)
-- Dependencies: 274
-- Name: COLUMN fos_user_user.roles; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN fos_user_user.roles IS '(DC2Type:array)';


--
-- TOC entry 4446 (class 0 OID 0)
-- Dependencies: 274
-- Name: COLUMN fos_user_user.facebook_data; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN fos_user_user.facebook_data IS '(DC2Type:json)';


--
-- TOC entry 4447 (class 0 OID 0)
-- Dependencies: 274
-- Name: COLUMN fos_user_user.twitter_data; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN fos_user_user.twitter_data IS '(DC2Type:json)';


--
-- TOC entry 4448 (class 0 OID 0)
-- Dependencies: 274
-- Name: COLUMN fos_user_user.gplus_data; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN fos_user_user.gplus_data IS '(DC2Type:json)';


--
-- TOC entry 275 (class 1259 OID 261616)
-- Name: fos_user_user_group; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE fos_user_user_group (
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE fos_user_user_group OWNER TO daiqui6_postgres;

--
-- TOC entry 276 (class 1259 OID 261619)
-- Name: fos_user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE fos_user_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_user_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 277 (class 1259 OID 261621)
-- Name: gender; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE gender (
    id integer NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE gender OWNER TO daiqui6_postgres;

--
-- TOC entry 278 (class 1259 OID 261628)
-- Name: gender_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE gender_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE gender_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 279 (class 1259 OID 261630)
-- Name: hotel; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE hotel (
    id integer NOT NULL,
    zone integer,
    chainid integer,
    term_condition_hotel integer,
    cancelation_hotel integer,
    product_increment integer,
    stars integer,
    address character varying(255) DEFAULT NULL::character varying,
    email character varying(255) DEFAULT NULL::character varying,
    website character varying(255) DEFAULT NULL::character varying,
    phone character varying(255) DEFAULT NULL::character varying,
    mount_c double precision,
    mount_cc double precision,
    ai boolean,
    allow_infant boolean,
    available boolean,
    priority integer,
    payonline boolean,
    review_available boolean,
    remarks character varying(2000) DEFAULT NULL::character varying,
    hoteltype integer
);


ALTER TABLE hotel OWNER TO daiqui6_postgres;

--
-- TOC entry 280 (class 1259 OID 261641)
-- Name: hotel_facility; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE hotel_facility (
    id integer NOT NULL,
    hotelid integer,
    picture integer,
    gallery integer,
    hotelfacilitytype_id integer,
    title character varying(255) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE hotel_facility OWNER TO daiqui6_postgres;

--
-- TOC entry 281 (class 1259 OID 261649)
-- Name: hotel_facility_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE hotel_facility_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hotel_facility_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 282 (class 1259 OID 261651)
-- Name: hotel_price; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE hotel_price (
    id integer NOT NULL,
    season integer,
    room integer,
    base double precision NOT NULL,
    individual double precision NOT NULL,
    chindividual integer NOT NULL,
    three double precision NOT NULL,
    adult1 double precision DEFAULT (0)::double precision NOT NULL,
    adult2 double precision DEFAULT (0)::double precision NOT NULL,
    adult3 double precision DEFAULT (0)::double precision NOT NULL,
    chthree integer NOT NULL
);


ALTER TABLE hotel_price OWNER TO daiqui6_postgres;

--
-- TOC entry 283 (class 1259 OID 261657)
-- Name: hotel_price_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE hotel_price_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hotel_price_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 284 (class 1259 OID 261659)
-- Name: hotel_sales_agent; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE hotel_sales_agent (
    id integer NOT NULL,
    picture integer,
    hotelid integer,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    name character varying(255) DEFAULT NULL::character varying,
    lastname character varying(255) NOT NULL,
    phone1 character varying(255) DEFAULT NULL::character varying,
    phone character varying(255) DEFAULT NULL::character varying,
    email character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE hotel_sales_agent OWNER TO daiqui6_postgres;

--
-- TOC entry 285 (class 1259 OID 261669)
-- Name: hotel_sales_agent_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE hotel_sales_agent_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hotel_sales_agent_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 286 (class 1259 OID 261671)
-- Name: hotel_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE hotel_type (
    id integer NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE hotel_type OWNER TO daiqui6_postgres;

--
-- TOC entry 287 (class 1259 OID 261679)
-- Name: hotel_type_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE hotel_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hotel_type_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 288 (class 1259 OID 261681)
-- Name: kid_policy; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE kid_policy (
    id integer NOT NULL,
    hotelprice_id integer,
    ocupation_id integer,
    kid1 double precision NOT NULL,
    kid1_choice integer NOT NULL,
    kid2 double precision NOT NULL,
    kid2_choice integer NOT NULL,
    kid3 double precision NOT NULL,
    kid3_choice integer NOT NULL,
    kid4 double precision NOT NULL,
    kid4_choice integer NOT NULL,
    price double precision DEFAULT (0)::double precision NOT NULL,
    campaignhotel_id integer
);


ALTER TABLE kid_policy OWNER TO daiqui6_postgres;

--
-- TOC entry 289 (class 1259 OID 261685)
-- Name: kid_policy_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE kid_policy_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kid_policy_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 290 (class 1259 OID 261687)
-- Name: luggage_capacity; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE luggage_capacity (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE luggage_capacity OWNER TO daiqui6_postgres;

--
-- TOC entry 291 (class 1259 OID 261693)
-- Name: luggage_capacity_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE luggage_capacity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE luggage_capacity_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 292 (class 1259 OID 261695)
-- Name: market; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE market (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    increment double precision NOT NULL
);


ALTER TABLE market OWNER TO daiqui6_postgres;

--
-- TOC entry 293 (class 1259 OID 261698)
-- Name: market_campaigns; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE market_campaigns (
    campaign_id integer NOT NULL,
    market_id integer NOT NULL
);


ALTER TABLE market_campaigns OWNER TO daiqui6_postgres;

--
-- TOC entry 294 (class 1259 OID 261701)
-- Name: market_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE market_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE market_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 295 (class 1259 OID 261703)
-- Name: media__gallery; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE media__gallery (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    context character varying(64) NOT NULL,
    default_format character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE media__gallery OWNER TO daiqui6_postgres;

--
-- TOC entry 296 (class 1259 OID 261709)
-- Name: media__gallery_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE media__gallery_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE media__gallery_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 297 (class 1259 OID 261711)
-- Name: media__gallery_media; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE media__gallery_media (
    id integer NOT NULL,
    gallery_id integer,
    media_id integer,
    "position" integer NOT NULL,
    enabled boolean NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE media__gallery_media OWNER TO daiqui6_postgres;

--
-- TOC entry 298 (class 1259 OID 261714)
-- Name: media__gallery_media_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE media__gallery_media_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE media__gallery_media_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 299 (class 1259 OID 261716)
-- Name: media__media; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE media__media (
    id integer NOT NULL,
    category_id integer,
    name character varying(255) NOT NULL,
    description text,
    enabled boolean NOT NULL,
    provider_name character varying(255) NOT NULL,
    provider_status integer NOT NULL,
    provider_reference character varying(255) NOT NULL,
    provider_metadata text,
    width integer,
    height integer,
    length numeric(10,0) DEFAULT NULL::numeric,
    content_type character varying(255) DEFAULT NULL::character varying,
    content_size integer,
    copyright character varying(255) DEFAULT NULL::character varying,
    author_name character varying(255) DEFAULT NULL::character varying,
    context character varying(64) DEFAULT NULL::character varying,
    cdn_is_flushable boolean,
    cdn_flush_identifier character varying(64) DEFAULT NULL::character varying,
    cdn_flush_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    cdn_status integer,
    updated_at timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE media__media OWNER TO daiqui6_postgres;

--
-- TOC entry 4449 (class 0 OID 0)
-- Dependencies: 299
-- Name: COLUMN media__media.provider_metadata; Type: COMMENT; Schema: public; Owner: daiqui6_postgres
--

COMMENT ON COLUMN media__media.provider_metadata IS '(DC2Type:json)';


--
-- TOC entry 300 (class 1259 OID 261729)
-- Name: media__media_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE media__media_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE media__media_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 301 (class 1259 OID 261731)
-- Name: medical_program; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE medical_program (
    id integer NOT NULL,
    picture integer,
    gallery integer,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE medical_program OWNER TO daiqui6_postgres;

--
-- TOC entry 302 (class 1259 OID 261739)
-- Name: medical_program_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE medical_program_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE medical_program_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 303 (class 1259 OID 261741)
-- Name: medical_request; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE medical_request (
    id integer NOT NULL,
    medicalservice integer,
    startdate date NOT NULL
);


ALTER TABLE medical_request OWNER TO daiqui6_postgres;

--
-- TOC entry 304 (class 1259 OID 261744)
-- Name: medical_service; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE medical_service (
    id integer NOT NULL,
    medical_program integer,
    research character varying(2000) DEFAULT NULL::character varying,
    consultations character varying(2000) DEFAULT NULL::character varying,
    day integer,
    price double precision
);


ALTER TABLE medical_service OWNER TO daiqui6_postgres;

--
-- TOC entry 305 (class 1259 OID 261752)
-- Name: medical_service_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE medical_service_item (
    realid integer NOT NULL
);


ALTER TABLE medical_service_item OWNER TO daiqui6_postgres;

--
-- TOC entry 306 (class 1259 OID 261755)
-- Name: ocupation; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE ocupation (
    id integer NOT NULL,
    room integer,
    kids integer,
    adults integer
);


ALTER TABLE ocupation OWNER TO daiqui6_postgres;

--
-- TOC entry 307 (class 1259 OID 261758)
-- Name: ocupation_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE ocupation_item (
    realid integer NOT NULL,
    hotel integer,
    room integer,
    kids integer NOT NULL,
    adults integer NOT NULL,
    plan character varying(255) NOT NULL,
    infant integer NOT NULL,
    enddate date NOT NULL
);


ALTER TABLE ocupation_item OWNER TO daiqui6_postgres;

--
-- TOC entry 308 (class 1259 OID 261761)
-- Name: ocupation_searcher; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE ocupation_searcher (
    id integer NOT NULL,
    polo integer,
    hotel integer,
    chain integer,
    room integer,
    province integer,
    adults integer NOT NULL,
    kids integer NOT NULL,
    infants integer NOT NULL,
    startdate date NOT NULL,
    enddate date NOT NULL,
    ubication character varying(255) DEFAULT NULL::character varying,
    hoteltype integer
);


ALTER TABLE ocupation_searcher OWNER TO daiqui6_postgres;

--
-- TOC entry 309 (class 1259 OID 261765)
-- Name: ocupation_searcher_rental_house_facility_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE ocupation_searcher_rental_house_facility_type (
    ocupation_searcher_id integer NOT NULL,
    hotel_facility_id integer NOT NULL
);


ALTER TABLE ocupation_searcher_rental_house_facility_type OWNER TO daiqui6_postgres;

--
-- TOC entry 310 (class 1259 OID 261768)
-- Name: ocupation_searcher_rental_house_room_facility; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE ocupation_searcher_rental_house_room_facility (
    ocupation_searcher_id integer NOT NULL,
    rental_house_room_facility_id integer NOT NULL
);


ALTER TABLE ocupation_searcher_rental_house_room_facility OWNER TO daiqui6_postgres;

--
-- TOC entry 311 (class 1259 OID 261783)
-- Name: package; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE package (
    id integer NOT NULL,
    picture integer,
    gallery integer,
    term_condition_package integer,
    cancelation_packages integer,
    product_increment integer,
    title character varying(255) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    available boolean,
    priority integer,
    payonline boolean,
    remarks character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE package OWNER TO daiqui6_postgres;

--
-- TOC entry 312 (class 1259 OID 261792)
-- Name: package_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE package_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE package_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 313 (class 1259 OID 261794)
-- Name: package_option; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE package_option (
    id integer NOT NULL,
    id_package integer,
    include character varying(2000) DEFAULT NULL::character varying,
    notinclude character varying(2000) DEFAULT NULL::character varying,
    priceadult double precision,
    pricekid double precision,
    days integer,
    nigths integer
);


ALTER TABLE package_option OWNER TO daiqui6_postgres;

--
-- TOC entry 314 (class 1259 OID 261802)
-- Name: package_option_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE package_option_item (
    realid integer NOT NULL,
    pickupplace integer,
    kids integer NOT NULL,
    adults integer NOT NULL,
    infant integer NOT NULL
);


ALTER TABLE package_option_item OWNER TO daiqui6_postgres;

--
-- TOC entry 315 (class 1259 OID 261805)
-- Name: package_option_polos; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE package_option_polos (
    package_option_id integer NOT NULL,
    polo_id integer NOT NULL
);


ALTER TABLE package_option_polos OWNER TO daiqui6_postgres;

--
-- TOC entry 316 (class 1259 OID 261808)
-- Name: package_option_searcher; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE package_option_searcher (
    id integer NOT NULL,
    package integer,
    startdate date NOT NULL,
    days integer NOT NULL,
    night integer NOT NULL,
    adults integer NOT NULL,
    kids integer NOT NULL,
    infant integer NOT NULL
);


ALTER TABLE package_option_searcher OWNER TO daiqui6_postgres;

--
-- TOC entry 317 (class 1259 OID 261811)
-- Name: package_request; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE package_request (
    id integer NOT NULL,
    package integer,
    packageoption integer,
    adult integer NOT NULL,
    kid integer NOT NULL,
    startdate date NOT NULL
);


ALTER TABLE package_request OWNER TO daiqui6_postgres;

--
-- TOC entry 318 (class 1259 OID 261814)
-- Name: packageoptionsearcher_polo; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE packageoptionsearcher_polo (
    id integer NOT NULL
);


ALTER TABLE packageoptionsearcher_polo OWNER TO daiqui6_postgres;

--
-- TOC entry 319 (class 1259 OID 261817)
-- Name: payment; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE payment (
    id integer NOT NULL,
    curency integer,
    client_id integer,
    error text,
    response character varying(255) DEFAULT NULL::character varying,
    card_country character varying(255) DEFAULT NULL::character varying,
    auth_code character varying(255) DEFAULT NULL::character varying,
    card_type character varying(255) DEFAULT NULL::character varying,
    amount double precision NOT NULL,
    description text,
    order_id character varying(255) DEFAULT NULL::character varying,
    status character varying(255) DEFAULT NULL::character varying,
    created_from_ip character varying(45) DEFAULT NULL::character varying,
    pdfview integer DEFAULT 0 NOT NULL,
    date_created timestamp(0) without time zone NOT NULL
);


ALTER TABLE payment OWNER TO daiqui6_postgres;

--
-- TOC entry 320 (class 1259 OID 261831)
-- Name: payment_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE payment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE payment_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 321 (class 1259 OID 261833)
-- Name: place; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE place (
    id integer NOT NULL,
    polo integer,
    province integer,
    picture integer,
    gallery integer,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    latitude character varying(255) DEFAULT NULL::character varying,
    longitude character varying(255) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    ispickupplace_excursion boolean,
    ispickupplace_transfer boolean,
    ispickupplace_circuit boolean,
    ispickupplace_car boolean,
    type character varying(255) NOT NULL
);


ALTER TABLE place OWNER TO daiqui6_postgres;

--
-- TOC entry 322 (class 1259 OID 261843)
-- Name: place_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE place_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE place_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 323 (class 1259 OID 261845)
-- Name: place_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE place_type (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE place_type OWNER TO daiqui6_postgres;

--
-- TOC entry 324 (class 1259 OID 261851)
-- Name: place_type_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE place_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE place_type_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 325 (class 1259 OID 261853)
-- Name: place_type_place; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE place_type_place (
    place_id integer NOT NULL,
    place_type_id integer NOT NULL
);


ALTER TABLE place_type_place OWNER TO daiqui6_postgres;

--
-- TOC entry 326 (class 1259 OID 261856)
-- Name: polo; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE polo (
    id integer NOT NULL,
    picture integer,
    gallery integer,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying,
    priority integer
);


ALTER TABLE polo OWNER TO daiqui6_postgres;

--
-- TOC entry 327 (class 1259 OID 261864)
-- Name: polo_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE polo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE polo_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 328 (class 1259 OID 261869)
-- Name: polos_provinces; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE polos_provinces (
    polo_id integer NOT NULL,
    province_id integer NOT NULL
);


ALTER TABLE polos_provinces OWNER TO daiqui6_postgres;

--
-- TOC entry 329 (class 1259 OID 261872)
-- Name: product; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE product (
    id integer NOT NULL,
    product_increment integer,
    term_condition_product integer,
    cancelation_product integer,
    picture integer,
    gallery integer,
    provider integer,
    title character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description character varying(20000) DEFAULT NULL::character varying,
    available boolean,
    priority integer,
    payonline boolean DEFAULT false,
    review_available boolean,
    remarks character varying(2000) DEFAULT NULL::character varying,
    product_type character varying(255) DEFAULT NULL::character varying,
    type character varying(255) NOT NULL,
    numbersales integer DEFAULT 0
);


ALTER TABLE product OWNER TO daiqui6_postgres;

--
-- TOC entry 330 (class 1259 OID 261884)
-- Name: product_category; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE product_category (
    id integer NOT NULL,
    product integer,
    title character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE product_category OWNER TO daiqui6_postgres;

--
-- TOC entry 331 (class 1259 OID 261888)
-- Name: product_category_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE product_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE product_category_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 332 (class 1259 OID 261890)
-- Name: product_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE product_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 333 (class 1259 OID 261892)
-- Name: product_increment; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE product_increment (
    id integer NOT NULL,
    increment double precision DEFAULT (0)::double precision,
    product_type character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE product_increment OWNER TO daiqui6_postgres;

--
-- TOC entry 334 (class 1259 OID 261897)
-- Name: product_increment_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE product_increment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE product_increment_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 335 (class 1259 OID 261899)
-- Name: product_seo; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE product_seo (
    id integer NOT NULL,
    keywords character varying(255) NOT NULL,
    description character varying(2000) NOT NULL,
    producttype character varying(255) NOT NULL
);


ALTER TABLE product_seo OWNER TO daiqui6_postgres;

--
-- TOC entry 336 (class 1259 OID 261905)
-- Name: product_seo_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE product_seo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE product_seo_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 337 (class 1259 OID 261907)
-- Name: products_tags; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE products_tags (
    tag_id integer NOT NULL,
    product_id integer NOT NULL
);


ALTER TABLE products_tags OWNER TO daiqui6_postgres;

--
-- TOC entry 338 (class 1259 OID 261910)
-- Name: provider; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE provider (
    id integer NOT NULL,
    picture integer,
    gallery integer,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying,
    available boolean
);


ALTER TABLE provider OWNER TO daiqui6_postgres;

--
-- TOC entry 339 (class 1259 OID 261918)
-- Name: provider_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE provider_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE provider_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 340 (class 1259 OID 261920)
-- Name: province; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE province (
    id integer NOT NULL,
    picture integer,
    gallery integer,
    country integer,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description text,
    priority integer
);


ALTER TABLE province OWNER TO daiqui6_postgres;

--
-- TOC entry 341 (class 1259 OID 261926)
-- Name: province_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE province_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE province_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 342 (class 1259 OID 261928)
-- Name: rental_house; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house (
    id integer NOT NULL,
    zone integer,
    picture integer,
    gallery integer,
    term_condition_house integer,
    cancelation_house integer,
    product_increment integer,
    price double precision,
    private_rental boolean,
    title character varying(255) DEFAULT NULL::character varying,
    latitude character varying(255) DEFAULT NULL::character varying,
    longitude character varying(255) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    available boolean,
    priority integer,
    payonline boolean,
    remarks character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE rental_house OWNER TO daiqui6_postgres;

--
-- TOC entry 343 (class 1259 OID 261939)
-- Name: rental_house_availability_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE rental_house_availability_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rental_house_availability_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 344 (class 1259 OID 261941)
-- Name: rental_house_facility; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_facility (
    id integer NOT NULL,
    rentalhousefacilitytype_id integer,
    rental_house integer,
    picture integer,
    gallery integer,
    title character varying(255) DEFAULT NULL::character varying,
    description character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE rental_house_facility OWNER TO daiqui6_postgres;

--
-- TOC entry 345 (class 1259 OID 261949)
-- Name: rental_house_facility_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE rental_house_facility_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rental_house_facility_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 346 (class 1259 OID 261951)
-- Name: rental_house_facility_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_facility_type (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    icon character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE rental_house_facility_type OWNER TO daiqui6_postgres;

--
-- TOC entry 347 (class 1259 OID 261957)
-- Name: rental_house_facility_type_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE rental_house_facility_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rental_house_facility_type_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 348 (class 1259 OID 261959)
-- Name: rental_house_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE rental_house_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rental_house_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 349 (class 1259 OID 261961)
-- Name: rental_house_owner; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_owner (
    id integer NOT NULL,
    picture integer,
    name character varying(255) DEFAULT NULL::character varying,
    lastname character varying(255) DEFAULT NULL::character varying,
    phone1 character varying(255) NOT NULL,
    phone2 character varying(255) DEFAULT NULL::character varying,
    email character varying(255) DEFAULT NULL::character varying,
    address character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE rental_house_owner OWNER TO daiqui6_postgres;

--
-- TOC entry 350 (class 1259 OID 261972)
-- Name: rental_house_owner_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE rental_house_owner_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rental_house_owner_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 351 (class 1259 OID 261974)
-- Name: rental_house_rental_house_owner; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_rental_house_owner (
    rental_house_id integer NOT NULL,
    rental_house_owner_id integer NOT NULL
);


ALTER TABLE rental_house_rental_house_owner OWNER TO daiqui6_postgres;

--
-- TOC entry 352 (class 1259 OID 261977)
-- Name: rental_house_rental_house_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_rental_house_type (
    rental_house_id integer NOT NULL,
    rental_house_type_id integer NOT NULL
);


ALTER TABLE rental_house_rental_house_type OWNER TO daiqui6_postgres;

--
-- TOC entry 353 (class 1259 OID 261980)
-- Name: rental_house_request; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_request (
    id integer NOT NULL,
    rentalhouse integer,
    rentalhouseroom integer,
    adult integer NOT NULL,
    kid integer NOT NULL,
    enddate date NOT NULL,
    startdate date NOT NULL
);


ALTER TABLE rental_house_request OWNER TO daiqui6_postgres;

--
-- TOC entry 354 (class 1259 OID 261983)
-- Name: rental_house_room; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room (
    id integer NOT NULL,
    rental_house integer,
    price double precision
);


ALTER TABLE rental_house_room OWNER TO daiqui6_postgres;

--
-- TOC entry 355 (class 1259 OID 261986)
-- Name: rental_house_room_availability; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room_availability (
    id integer NOT NULL,
    rental_house_room integer,
    date date
);


ALTER TABLE rental_house_room_availability OWNER TO daiqui6_postgres;

--
-- TOC entry 356 (class 1259 OID 261989)
-- Name: rental_house_room_facility; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room_facility (
    id integer NOT NULL,
    title character varying(255) DEFAULT NULL::character varying,
    faicon character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE rental_house_room_facility OWNER TO daiqui6_postgres;

--
-- TOC entry 357 (class 1259 OID 261997)
-- Name: rental_house_room_facility_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE rental_house_room_facility_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rental_house_room_facility_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 358 (class 1259 OID 261999)
-- Name: rental_house_room_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room_item (
    realid integer NOT NULL,
    rentalhouse integer,
    room integer,
    adult integer NOT NULL,
    kid integer NOT NULL,
    enddate date NOT NULL
);


ALTER TABLE rental_house_room_item OWNER TO daiqui6_postgres;

--
-- TOC entry 359 (class 1259 OID 262002)
-- Name: rental_house_room_ocupation; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room_ocupation (
    id integer NOT NULL,
    adult integer,
    kid integer
);


ALTER TABLE rental_house_room_ocupation OWNER TO daiqui6_postgres;

--
-- TOC entry 360 (class 1259 OID 262005)
-- Name: rental_house_room_ocupation_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE rental_house_room_ocupation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rental_house_room_ocupation_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 361 (class 1259 OID 262007)
-- Name: rental_house_room_rental_house_room_facilities; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room_rental_house_room_facilities (
    rental_house_room_id integer NOT NULL,
    rental_house_room_facility_id integer NOT NULL
);


ALTER TABLE rental_house_room_rental_house_room_facilities OWNER TO daiqui6_postgres;

--
-- TOC entry 362 (class 1259 OID 262010)
-- Name: rental_house_room_rental_house_room_ocupations; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room_rental_house_room_ocupations (
    rental_house_room_id integer NOT NULL,
    rental_house_room_ocupation_id integer NOT NULL
);


ALTER TABLE rental_house_room_rental_house_room_ocupations OWNER TO daiqui6_postgres;

--
-- TOC entry 363 (class 1259 OID 262013)
-- Name: rental_house_room_searcher; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room_searcher (
    id integer NOT NULL,
    polo integer,
    rentalhouse integer,
    rentalhouseroom integer,
    province integer,
    house character varying(255) DEFAULT NULL::character varying,
    rooms integer,
    adults integer NOT NULL,
    kids integer NOT NULL,
    privaterental boolean,
    startdate date NOT NULL,
    enddate date NOT NULL
);


ALTER TABLE rental_house_room_searcher OWNER TO daiqui6_postgres;

--
-- TOC entry 364 (class 1259 OID 262017)
-- Name: rental_house_room_searcher_rental_house_facility_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room_searcher_rental_house_facility_type (
    rental_house_room_searcher_id integer NOT NULL,
    rental_house_facility_id integer NOT NULL
);


ALTER TABLE rental_house_room_searcher_rental_house_facility_type OWNER TO daiqui6_postgres;

--
-- TOC entry 365 (class 1259 OID 262020)
-- Name: rental_house_room_searcher_rental_house_room_facility; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_room_searcher_rental_house_room_facility (
    rental_house_room_searcher_id integer NOT NULL,
    rental_house_room_facility_id integer NOT NULL
);


ALTER TABLE rental_house_room_searcher_rental_house_room_facility OWNER TO daiqui6_postgres;

--
-- TOC entry 366 (class 1259 OID 262023)
-- Name: rental_house_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rental_house_type (
    id integer NOT NULL,
    picture integer,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE rental_house_type OWNER TO daiqui6_postgres;

--
-- TOC entry 367 (class 1259 OID 262030)
-- Name: rental_house_type_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE rental_house_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rental_house_type_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 368 (class 1259 OID 262032)
-- Name: rentalhouseroomsearcher_type; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE rentalhouseroomsearcher_type (
    id_rentalhouseroomsearcher integer NOT NULL,
    id_typehouse integer NOT NULL
);


ALTER TABLE rentalhouseroomsearcher_type OWNER TO daiqui6_postgres;

--
-- TOC entry 369 (class 1259 OID 262035)
-- Name: request; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE request (
    id integer NOT NULL,
    gender integer,
    createat date NOT NULL,
    paxname character varying(255) NOT NULL,
    paxlastname character varying(255) NOT NULL,
    paxemail character varying(255) NOT NULL,
    birthdate date NOT NULL,
    ipclient character varying(255) NOT NULL,
    captcha character varying(255) NOT NULL,
    sendclientrequest boolean NOT NULL,
    sendagentrequest boolean NOT NULL,
    remarks character varying(2000) DEFAULT NULL::character varying,
    type character varying(255) NOT NULL
);


ALTER TABLE request OWNER TO daiqui6_postgres;

--
-- TOC entry 370 (class 1259 OID 262042)
-- Name: request_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE request_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE request_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 423 (class 1259 OID 268238)
-- Name: result; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE result (
    id integer NOT NULL,
    searcher_id integer,
    pickupplace integer,
    dropoffplace_id integer,
    market integer,
    obj integer,
    flight integer,
    createat timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    product character varying(255) DEFAULT NULL::character varying,
    startdate timestamp(0) without time zone NOT NULL,
    enddate timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    adults integer,
    kids integer,
    infant integer,
    passengers integer,
    pickup_time date
);


ALTER TABLE result OWNER TO daiqui6_postgres;

--
-- TOC entry 422 (class 1259 OID 268236)
-- Name: result_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE result_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE result_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 371 (class 1259 OID 262044)
-- Name: review; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE review (
    id integer NOT NULL,
    description text NOT NULL,
    votes integer,
    created_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    user_id integer,
    show boolean DEFAULT false NOT NULL,
    title character varying(255),
    type character varying(255) NOT NULL,
    usefull integer
);


ALTER TABLE review OWNER TO daiqui6_postgres;

--
-- TOC entry 413 (class 1259 OID 264718)
-- Name: review_hotel; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE review_hotel (
    id integer NOT NULL,
    hotel_id integer
);


ALTER TABLE review_hotel OWNER TO daiqui6_postgres;

--
-- TOC entry 372 (class 1259 OID 262051)
-- Name: review_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE review_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE review_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 415 (class 1259 OID 264762)
-- Name: review_product; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE review_product (
    id integer NOT NULL,
    product_id integer
);


ALTER TABLE review_product OWNER TO daiqui6_postgres;

--
-- TOC entry 414 (class 1259 OID 264730)
-- Name: review_rental_house; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE review_rental_house (
    id integer NOT NULL,
    rentalhouse_id integer
);


ALTER TABLE review_rental_house OWNER TO daiqui6_postgres;

--
-- TOC entry 373 (class 1259 OID 262053)
-- Name: room; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE room (
    id integer NOT NULL,
    picture integer,
    gallery integer,
    hotelid integer,
    title character varying(255) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    numberofbeds integer DEFAULT 1 NOT NULL,
    area double precision DEFAULT 20::double precision NOT NULL
);


ALTER TABLE room OWNER TO daiqui6_postgres;

--
-- TOC entry 374 (class 1259 OID 262061)
-- Name: room_availability; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE room_availability (
    id integer NOT NULL,
    room integer,
    date date
);


ALTER TABLE room_availability OWNER TO daiqui6_postgres;

--
-- TOC entry 375 (class 1259 OID 262064)
-- Name: room_availability_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE room_availability_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE room_availability_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 376 (class 1259 OID 262066)
-- Name: room_facilities_rooms; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE room_facilities_rooms (
    room_id integer NOT NULL,
    rental_house_room_facility_id integer NOT NULL
);


ALTER TABLE room_facilities_rooms OWNER TO daiqui6_postgres;

--
-- TOC entry 377 (class 1259 OID 262069)
-- Name: room_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE room_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE room_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 378 (class 1259 OID 262076)
-- Name: sale; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE sale (
    id integer NOT NULL,
    curency integer,
    market integer,
    client_id integer,
    error text,
    response character varying(255) DEFAULT NULL::character varying,
    card_country character varying(255) DEFAULT NULL::character varying,
    auth_code character varying(255) DEFAULT NULL::character varying,
    card_type character varying(255) DEFAULT NULL::character varying,
    date timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    amount double precision,
    description character varying(255) DEFAULT NULL::character varying,
    orderid character varying(255) DEFAULT NULL::character varying,
    status character varying(255) DEFAULT NULL::character varying,
    pdf_view integer DEFAULT 0 NOT NULL,
    created timestamp(0) without time zone NOT NULL,
    created_from_ip character varying(45) DEFAULT NULL::character varying
);


ALTER TABLE sale OWNER TO daiqui6_postgres;

--
-- TOC entry 379 (class 1259 OID 262092)
-- Name: sale_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE sale_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sale_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 380 (class 1259 OID 262094)
-- Name: searcher; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE searcher (
    id integer NOT NULL,
    user_id integer,
    createat timestamp(0) without time zone,
    type character varying(255) NOT NULL,
    duration double precision DEFAULT 0::double precision
);


ALTER TABLE searcher OWNER TO daiqui6_postgres;

--
-- TOC entry 381 (class 1259 OID 262097)
-- Name: searcher_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE searcher_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE searcher_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 382 (class 1259 OID 262099)
-- Name: season; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE season (
    id integer NOT NULL,
    hotelid integer,
    startdate date,
    enddate date,
    description character varying(2000) DEFAULT NULL::character varying,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE season OWNER TO daiqui6_postgres;

--
-- TOC entry 383 (class 1259 OID 262107)
-- Name: season_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE season_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE season_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 384 (class 1259 OID 262109)
-- Name: service; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE service (
    id integer NOT NULL,
    sale integer,
    servicemanagementstatus integer,
    user_id integer,
    cartitem integer,
    confirmationcode character varying(255) DEFAULT NULL::character varying,
    remark character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE service OWNER TO daiqui6_postgres;

--
-- TOC entry 385 (class 1259 OID 262117)
-- Name: service_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE service_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE service_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 386 (class 1259 OID 262119)
-- Name: service_management_status; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE service_management_status (
    id integer NOT NULL,
    status character varying(255) NOT NULL,
    color character varying(255) NOT NULL
);


ALTER TABLE service_management_status OWNER TO daiqui6_postgres;

--
-- TOC entry 387 (class 1259 OID 262125)
-- Name: service_management_status_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE service_management_status_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE service_management_status_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 388 (class 1259 OID 262127)
-- Name: service_pax; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE service_pax (
    id integer NOT NULL,
    gender integer,
    service integer,
    name character varying(255) NOT NULL,
    birthdate date NOT NULL,
    lastname character varying(255) NOT NULL,
    document character varying(255) NOT NULL
);


ALTER TABLE service_pax OWNER TO daiqui6_postgres;

--
-- TOC entry 389 (class 1259 OID 262133)
-- Name: service_pax_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE service_pax_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE service_pax_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 390 (class 1259 OID 262135)
-- Name: subscription; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE subscription (
    id integer NOT NULL,
    email character varying(255) DEFAULT NULL::character varying,
    status boolean NOT NULL,
    datecreate date,
    dateupdate date
);


ALTER TABLE subscription OWNER TO daiqui6_postgres;

--
-- TOC entry 391 (class 1259 OID 262139)
-- Name: subscription_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE subscription_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE subscription_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 392 (class 1259 OID 262141)
-- Name: suplement; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE suplement (
    id integer NOT NULL,
    hotelid integer,
    title character varying(255) DEFAULT NULL::character varying,
    date date,
    adultprice double precision,
    kidprice double precision
);


ALTER TABLE suplement OWNER TO daiqui6_postgres;

--
-- TOC entry 393 (class 1259 OID 262145)
-- Name: suplement_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE suplement_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE suplement_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 394 (class 1259 OID 262147)
-- Name: tag; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE tag (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE tag OWNER TO daiqui6_postgres;

--
-- TOC entry 395 (class 1259 OID 262153)
-- Name: tag_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE tag_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tag_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 396 (class 1259 OID 262155)
-- Name: term_condition_product; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE term_condition_product (
    id integer NOT NULL,
    title character varying(2000) DEFAULT NULL::character varying,
    description character varying(2000) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL
);


ALTER TABLE term_condition_product OWNER TO daiqui6_postgres;

--
-- TOC entry 397 (class 1259 OID 262163)
-- Name: term_condition_product_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE term_condition_product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE term_condition_product_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 398 (class 1259 OID 262172)
-- Name: transfer; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE transfer (
    id integer NOT NULL,
    placefrom integer,
    placeto integer,
    reverse boolean,
    stop integer DEFAULT 0,
    endtime date,
    starttime date
);


ALTER TABLE transfer OWNER TO daiqui6_postgres;

--
-- TOC entry 399 (class 1259 OID 262175)
-- Name: transfer_colective; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE transfer_colective (
    id integer NOT NULL,
    pricepax double precision
);


ALTER TABLE transfer_colective OWNER TO daiqui6_postgres;

--
-- TOC entry 400 (class 1259 OID 262178)
-- Name: transfer_colective_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE transfer_colective_item (
    realid integer NOT NULL,
    pickupplace integer,
    dropoffplace integer,
    flight integer,
    passengers integer NOT NULL
);


ALTER TABLE transfer_colective_item OWNER TO daiqui6_postgres;

--
-- TOC entry 401 (class 1259 OID 262181)
-- Name: transfer_colective_request; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE transfer_colective_request (
    id integer NOT NULL,
    transfer integer,
    flight integer,
    passengers integer NOT NULL,
    startdate date NOT NULL
);


ALTER TABLE transfer_colective_request OWNER TO daiqui6_postgres;

--
-- TOC entry 402 (class 1259 OID 262184)
-- Name: transfer_exclusive; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE transfer_exclusive (
    id integer NOT NULL,
    price01_02 double precision,
    price03_04 double precision,
    price05_07 double precision,
    price08_12 double precision,
    price13_19 double precision,
    price20_30 double precision,
    price31_40 double precision
);


ALTER TABLE transfer_exclusive OWNER TO daiqui6_postgres;

--
-- TOC entry 403 (class 1259 OID 262187)
-- Name: transfer_exclusive_item; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE transfer_exclusive_item (
    realid integer NOT NULL,
    flight integer,
    pickupplace integer,
    dropoffplace integer,
    pickup_time date NOT NULL,
    passengers integer NOT NULL
);


ALTER TABLE transfer_exclusive_item OWNER TO daiqui6_postgres;

--
-- TOC entry 404 (class 1259 OID 262190)
-- Name: transfer_exclusive_request; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE transfer_exclusive_request (
    id integer NOT NULL,
    transfer integer,
    flight integer,
    pickup_time date NOT NULL,
    passengers integer NOT NULL,
    startdate date NOT NULL
);


ALTER TABLE transfer_exclusive_request OWNER TO daiqui6_postgres;

--
-- TOC entry 405 (class 1259 OID 262193)
-- Name: transfer_searcher; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE transfer_searcher (
    id integer NOT NULL,
    polofrom integer,
    poloto integer,
    transfer integer,
    placefrom integer,
    placeto integer,
    exclusive integer,
    passengers integer NOT NULL,
    date date NOT NULL,
    roundtrip boolean NOT NULL,
    dateroundtrip date NOT NULL,
    startdate date
);


ALTER TABLE transfer_searcher OWNER TO daiqui6_postgres;

--
-- TOC entry 406 (class 1259 OID 262217)
-- Name: zone; Type: TABLE; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE TABLE zone (
    id integer NOT NULL,
    province integer,
    picture integer,
    gallery integer,
    title character varying(255) DEFAULT NULL::character varying,
    slug character varying(255) NOT NULL,
    unique_slug character varying(255) NOT NULL,
    description character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE zone OWNER TO daiqui6_postgres;

--
-- TOC entry 407 (class 1259 OID 262225)
-- Name: zone_id_seq; Type: SEQUENCE; Schema: public; Owner: daiqui6_postgres
--

CREATE SEQUENCE zone_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE zone_id_seq OWNER TO daiqui6_postgres;

--
-- TOC entry 2830 (class 2604 OID 262227)
-- Name: id; Type: DEFAULT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_classes ALTER COLUMN id SET DEFAULT nextval('acl_classes_id_seq'::regclass);


--
-- TOC entry 2831 (class 2604 OID 262228)
-- Name: id; Type: DEFAULT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_entries ALTER COLUMN id SET DEFAULT nextval('acl_entries_id_seq'::regclass);


--
-- TOC entry 2833 (class 2604 OID 262229)
-- Name: id; Type: DEFAULT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_object_identities ALTER COLUMN id SET DEFAULT nextval('acl_object_identities_id_seq'::regclass);


--
-- TOC entry 2834 (class 2604 OID 262230)
-- Name: id; Type: DEFAULT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_security_identities ALTER COLUMN id SET DEFAULT nextval('acl_security_identities_id_seq'::regclass);


--
-- TOC entry 2913 (class 2604 OID 262231)
-- Name: id; Type: DEFAULT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ext_translations ALTER COLUMN id SET DEFAULT nextval('ext_translations_id_seq'::regclass);


--
-- TOC entry 4174 (class 0 OID 261122)
-- Dependencies: 172
-- Data for Name: acl_classes; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY acl_classes (id, class_type) FROM stdin;
\.


--
-- TOC entry 4450 (class 0 OID 0)
-- Dependencies: 173
-- Name: acl_classes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('acl_classes_id_seq', 1, false);


--
-- TOC entry 4176 (class 0 OID 261127)
-- Dependencies: 174
-- Data for Name: acl_entries; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) FROM stdin;
\.


--
-- TOC entry 4451 (class 0 OID 0)
-- Dependencies: 175
-- Name: acl_entries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('acl_entries_id_seq', 1, false);


--
-- TOC entry 4178 (class 0 OID 261133)
-- Dependencies: 176
-- Data for Name: acl_object_identities; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) FROM stdin;
\.


--
-- TOC entry 4452 (class 0 OID 0)
-- Dependencies: 177
-- Name: acl_object_identities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('acl_object_identities_id_seq', 1, false);


--
-- TOC entry 4180 (class 0 OID 261138)
-- Dependencies: 178
-- Data for Name: acl_object_identity_ancestors; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY acl_object_identity_ancestors (object_identity_id, ancestor_id) FROM stdin;
\.


--
-- TOC entry 4181 (class 0 OID 261141)
-- Dependencies: 179
-- Data for Name: acl_security_identities; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY acl_security_identities (id, identifier, username) FROM stdin;
\.


--
-- TOC entry 4453 (class 0 OID 0)
-- Dependencies: 180
-- Name: acl_security_identities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('acl_security_identities_id_seq', 1, false);


--
-- TOC entry 4183 (class 0 OID 261146)
-- Dependencies: 181
-- Data for Name: airline; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY airline (id, picture, gallery, title, slug, unique_slug, description) FROM stdin;
\.


--
-- TOC entry 4454 (class 0 OID 0)
-- Dependencies: 182
-- Name: airline_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('airline_id_seq', 5, true);


--
-- TOC entry 4185 (class 0 OID 261156)
-- Dependencies: 183
-- Data for Name: airport; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY airport (id, address, phone) FROM stdin;
\.


--
-- TOC entry 4186 (class 0 OID 261164)
-- Dependencies: 184
-- Data for Name: block; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY block (id, title, mincampaign, visible, number) FROM stdin;
1	Last Minute Deals	3	t	1
5	Special for You	3	t	5
4	Hot Deals	3	t	4
3	Trendy Now	3	t	3
2	Discover new Citys	4	t	2
\.


--
-- TOC entry 4187 (class 0 OID 261169)
-- Dependencies: 185
-- Data for Name: campaign; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign (id, block_id, picture, gallery, startdate, enddate, showstartdate, showenddate, instartdate, inenddate, title, subtitle, caption, priority, slug, unique_slug, description, available, type, calification) FROM stdin;
7	1	\N	\N	2016-12-31	2016-12-31	2016-11-25	2016-11-26	2016-11-25	2016-11-26	el mejor transfer	the bst	boo now	1	el-mejor-transfer	7-el-mejor-transfer	<p>https://www.facebook.com/loquesedicenet/videos/779978135475743/</p>	t	CampaignTransferColective	0
4	3	\N	\N	2016-12-30	2016-12-31	2016-11-24	2016-11-25	2016-11-24	2016-11-25	best excursion	best excursion	best excursion	1	best-excursion	4-best-excursion	<p>best excursion</p>	t	CampaignExcursion	0
37	1	\N	\N	2017-03-22	2017-04-30	2017-03-22	2017-04-30	2017-03-22	2017-04-30	ofer to soroa vinales	ofer to soroa vinales	book now	1	ofer-to-soroa-vinales	37-ofer-to-soroa-vinales	<p>ofer to soroa vinales</p>	t	CampaignCircuit	3
6	\N	\N	\N	2016-12-31	2016-12-31	2016-11-25	2016-12-31	2016-11-25	2016-11-26	best excursion colective	best excursion colective	best excursion colective	1	best-excursion-colective	6-best-excursion-colective	<p>-&gt;add(&#39;campaigns&#39;)</p>	t	CampaignExcursionExclusive	1
3	5	\N	\N	2016-12-30	2016-12-31	2016-11-23	2016-11-24	2016-11-23	2016-11-24	the best	the best	book now	1	the-best	3-the-best	<p>mira</p>\r\n\r\n<p>el correo es este</p>\r\n\r\n<p>perate q el correo lo perdi</p>\r\n\r\n<p>pq me formatearon esta mierda</p>\r\n\r\n<p>dejame darte el cell dl hermano d las q la saca</p>\r\n\r\n<p>53987991</p>\r\n\r\n<p>.adrian se llama</p>\r\n\r\n<p>dile q te dio el contacto una m,uchacha q su hermana me saco la cita</p>\r\n\r\n<p>yo pague 100</p>\r\n\r\n<p>pero fue en mayo</p>\r\n\r\n<p>tengo otro q tambien las saca pero ese me cobraba 200</p>\r\n\r\n<p>el contacto es este por si lo quieres tambien</p>\r\n\r\n<p>53577811</p>\r\n\r\n<p>yoani se llama este</p>	t	CampaignCar	0
5	4	\N	\N	2016-12-31	2016-12-31	2016-11-24	2016-12-31	2016-11-24	2016-11-25	best colective excursion	best colective excursion	book now	1	best-colective-excursion	5-best-colective-excursion	\N	t	CampaignExcursion	1
8	3	\N	\N	2016-12-31	2016-12-31	2016-11-25	2016-12-31	2016-11-25	2016-11-26	exclusivo del 31	exclusivo del 31	exclusivo del 31	1	exclusivo-del-31	8-exclusivo-del-31	\N	t	CampaignTransferExclusive	1
1	\N	32	\N	2016-11-30	2016-12-31	2016-11-23	2016-12-31	2016-11-23	2016-12-31	El mejor	el mejor de los circuits	book now	1	el-mejor	1-el-mejor	\N	t	CampaignCircuit	5
9	\N	\N	\N	2016-12-31	2017-01-01	2016-11-27	2016-12-31	2016-11-27	2016-11-28	the best room	the best room	book now	1	the-best-room	9-the-best-room	\N	t	CampaignRentalHouse	1
36	2	\N	\N	2017-03-22	2017-04-30	2017-03-22	2017-04-30	2017-03-22	2017-04-30	www	www	wwww	1	www	36-www	<p>www</p>	t	CampaignHotel	1
\.


--
-- TOC entry 4188 (class 0 OID 261176)
-- Dependencies: 186
-- Data for Name: campaign_car; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_car (id, car_id, cardiscount) FROM stdin;
3	2	30
\.


--
-- TOC entry 4189 (class 0 OID 261179)
-- Dependencies: 187
-- Data for Name: campaign_circuit; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_circuit (id, circuit_id, adultdiscount, kiddiscount) FROM stdin;
1	57	10	10
37	55	10	10
\.


--
-- TOC entry 4410 (class 0 OID 264485)
-- Dependencies: 408
-- Data for Name: campaign_excursion_colective; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_excursion_colective (id, excursion_id, adultdiscount, kiddiscount) FROM stdin;
5	5	50	20
\.


--
-- TOC entry 4411 (class 0 OID 264491)
-- Dependencies: 409
-- Data for Name: campaign_excursion_exclusive; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_excursion_exclusive (id, excursion_id, adultdiscount, kiddiscount) FROM stdin;
6	7	9	0
\.


--
-- TOC entry 4414 (class 0 OID 264586)
-- Dependencies: 412
-- Data for Name: campaign_hotel; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_hotel (id, room_id, base, individual, chindividual, three, adult1, adult2, adult3, chthree) FROM stdin;
36	1	100	10	2	10	0	0	0	2
\.


--
-- TOC entry 4455 (class 0 OID 0)
-- Dependencies: 188
-- Name: campaign_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('campaign_id_seq', 37, true);


--
-- TOC entry 4191 (class 0 OID 261190)
-- Dependencies: 189
-- Data for Name: campaign_medical; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_medical (id, medical_id, adultdiscount, kiddiscount) FROM stdin;
\.


--
-- TOC entry 4192 (class 0 OID 261193)
-- Dependencies: 190
-- Data for Name: campaign_package; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_package (id, package_id, adultdiscount, kiddiscount) FROM stdin;
\.


--
-- TOC entry 4412 (class 0 OID 264517)
-- Dependencies: 410
-- Data for Name: campaign_rental_house; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_rental_house (id, roomdiscount) FROM stdin;
9	10
\.


--
-- TOC entry 4193 (class 0 OID 261196)
-- Dependencies: 191
-- Data for Name: campaign_transfer_colective; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_transfer_colective (id, pricepxdiscount) FROM stdin;
7	10
\.


--
-- TOC entry 4194 (class 0 OID 261199)
-- Dependencies: 192
-- Data for Name: campaign_transfer_exclusive; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaign_transfer_exclusive (id, price01_02, price03_04, price05_07, price08_12, price13_19, price20_30, price31_40) FROM stdin;
8	10	10	10	10	10	10	10
\.


--
-- TOC entry 4413 (class 0 OID 264522)
-- Dependencies: 411
-- Data for Name: campaignrantalhouses_rentalhouserooms; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaignrantalhouses_rentalhouserooms (rental_house_room_id, campaign_rental_house_id) FROM stdin;
51	9
\.


--
-- TOC entry 4195 (class 0 OID 261202)
-- Dependencies: 193
-- Data for Name: campaigntransfercolective_transfers; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaigntransfercolective_transfers (transfer_colective_id, campaign_transfer_colective_id) FROM stdin;
10	7
\.


--
-- TOC entry 4196 (class 0 OID 261205)
-- Dependencies: 194
-- Data for Name: campaigntransferexclisive_transfers; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY campaigntransferexclisive_transfers (transfer_exclusive_id, campaign_transfer_exclusive_id) FROM stdin;
13	8
\.


--
-- TOC entry 4197 (class 0 OID 261208)
-- Dependencies: 195
-- Data for Name: cancelation_product; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY cancelation_product (id, title, description, slug, unique_slug) FROM stdin;
\.


--
-- TOC entry 4456 (class 0 OID 0)
-- Dependencies: 196
-- Name: cancelation_product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('cancelation_product_id_seq', 1, false);


--
-- TOC entry 4199 (class 0 OID 261217)
-- Dependencies: 197
-- Data for Name: car; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY car (id, car_class, car_luggage_capacity, car_category, capacity, air_conditioner, cd_player, doors, engine, transsmission, clima, satellite, powerdoorslock, powerwindow, tilt, radio, shuttlebus, terminalpickup, power) FROM stdin;
2	4	2	2	6	t	t	4	1.6	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
3	1	2	1	4	t	t	4	1.8	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
4	3	1	1	4	t	t	2	1.10	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
1	2	5	3	6	t	t	4	1.8	f	f	f	f	f	\N	f	f	f	0
\.


--
-- TOC entry 4200 (class 0 OID 261221)
-- Dependencies: 198
-- Data for Name: car_availability; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY car_availability (id, date) FROM stdin;
1	2016-11-15
2	2016-11-15
3	2016-11-17
4	2016-11-16
5	2016-11-18
6	2016-11-19
7	2016-11-21
8	2016-11-20
9	2016-11-23
10	2016-11-24
11	2016-11-22
12	2016-11-26
13	2016-11-27
14	2016-11-25
15	2016-11-30
16	2016-11-29
17	2016-12-02
18	2016-11-28
19	2016-12-03
20	2016-12-01
21	2016-12-04
22	2016-12-05
23	2016-12-08
24	2016-12-11
25	2016-12-06
26	2016-12-10
27	2016-12-09
28	2016-12-07
29	2016-12-12
30	2016-12-14
31	2016-12-15
32	2016-12-13
33	2016-12-18
34	2016-12-19
35	2016-12-17
36	2016-12-21
37	2016-12-22
38	2016-12-23
39	2016-12-20
41	2016-12-16
43	2016-12-29
44	2016-12-24
45	2016-12-28
46	2016-12-25
47	2016-12-30
48	2016-12-31
49	2016-12-01
50	2016-12-02
51	2016-12-03
52	2016-12-04
53	2016-12-05
54	2016-12-06
55	2016-12-08
56	2016-12-07
57	2016-12-10
58	2016-12-11
59	2016-12-13
60	2016-12-15
61	2016-12-09
62	2016-12-16
63	2016-12-17
64	2016-12-12
65	2016-12-14
66	2016-12-11
67	2016-12-12
68	2016-12-13
69	2016-12-15
70	2016-12-14
71	2016-12-17
72	2016-12-18
73	2016-12-19
74	2016-12-16
75	2016-12-22
76	2016-12-24
77	2016-12-21
78	2016-12-20
79	2016-12-27
80	2016-12-25
81	2016-12-29
82	2016-12-23
83	2016-12-31
84	2016-12-28
85	2016-12-30
86	2016-12-26
87	2016-11-27
88	2016-11-28
89	2016-11-29
90	2016-11-30
91	2016-12-01
92	2016-12-02
93	2016-12-03
94	2016-12-05
95	2016-12-06
96	2016-12-07
97	2016-12-09
98	2016-12-04
99	2016-12-11
100	2016-12-12
101	2016-12-13
102	2016-12-15
103	2016-12-08
104	2016-12-16
105	2016-12-14
106	2016-12-17
107	2016-12-10
108	2016-12-04
109	2016-12-05
110	2016-12-06
111	2016-12-07
112	2016-12-08
113	2016-12-09
114	2016-12-10
115	2016-12-30
116	2016-12-31
\.


--
-- TOC entry 4457 (class 0 OID 0)
-- Dependencies: 199
-- Name: car_availability_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('car_availability_id_seq', 116, true);


--
-- TOC entry 4202 (class 0 OID 261226)
-- Dependencies: 200
-- Data for Name: car_availabilitys_car; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY car_availabilitys_car (car_availability_id, car_id) FROM stdin;
1	1
2	1
3	1
4	1
5	1
6	1
7	1
8	1
9	1
10	1
11	1
12	1
13	1
14	1
15	1
16	1
17	1
18	1
19	1
20	1
21	1
22	1
23	1
24	1
25	1
26	1
27	1
28	1
29	1
30	1
31	1
32	1
33	1
34	1
35	1
36	1
37	1
38	1
39	1
41	1
43	1
44	1
45	1
46	1
47	1
48	1
49	2
50	2
51	2
52	2
53	2
54	2
55	2
56	2
57	2
58	2
59	2
60	2
61	2
62	2
63	2
64	2
65	2
66	3
67	3
68	3
69	3
70	3
71	3
72	3
73	3
74	3
75	3
76	3
77	3
78	3
79	3
80	3
81	3
82	3
83	3
84	3
85	3
86	3
87	4
88	4
89	4
90	4
91	4
92	4
93	4
94	4
95	4
96	4
97	4
98	4
99	4
100	4
101	4
102	4
103	4
104	4
105	4
106	4
107	4
108	3
109	3
110	3
111	3
112	3
113	3
114	3
115	2
116	2
\.


--
-- TOC entry 4203 (class 0 OID 261229)
-- Dependencies: 201
-- Data for Name: car_category; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY car_category (id, title, slug, unique_slug, priority) FROM stdin;
1	Luxury Plus	luxury-plus	1-luxury-plus	0
2	Standart	standart	2-standart	1
3	Higth Standart	higth-standart	3-higth-standart	2
4	Sport	sport	4-sport	4
\.


--
-- TOC entry 4458 (class 0 OID 0)
-- Dependencies: 202
-- Name: car_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('car_category_id_seq', 4, true);


--
-- TOC entry 4205 (class 0 OID 261238)
-- Dependencies: 203
-- Data for Name: car_class; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY car_class (id, title, slug, unique_slug) FROM stdin;
1	Class A	class-a	1-class-a
2	Class B	class-b	2-class-b
3	Class C	class-c	3-class-c
4	Class D	class-d	4-class-d
\.


--
-- TOC entry 4459 (class 0 OID 0)
-- Dependencies: 204
-- Name: car_class_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('car_class_id_seq', 4, true);


--
-- TOC entry 4207 (class 0 OID 261247)
-- Dependencies: 205
-- Data for Name: car_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY car_item (realid, pickupplace_id, dropoffplace_id, enddate) FROM stdin;
\.


--
-- TOC entry 4208 (class 0 OID 261250)
-- Dependencies: 206
-- Data for Name: car_request; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY car_request (id, package, pickupplace_id, dropoffplace_id, enddate, startdate, endtime, starttime) FROM stdin;
\.


--
-- TOC entry 4209 (class 0 OID 261253)
-- Dependencies: 207
-- Data for Name: car_searcher; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY car_searcher (id, pickupplace, dropoffplace, car, capacity, startdate, enddate, title, luggagecapacity) FROM stdin;
1	\N	\N	\N	\N	2016-12-04	2016-12-10	\N	\N
2	\N	\N	\N	\N	2016-12-06	2016-12-09	\N	\N
3	2	2	\N	\N	2016-12-06	2016-12-08	\N	\N
4	2	1	\N	\N	2016-12-06	2016-12-08	\N	\N
5	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
6	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
7	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
8	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
9	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
10	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
11	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
12	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
13	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
14	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
15	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
16	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
17	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
18	\N	\N	\N	\N	2016-12-06	2016-12-09	\N	\N
19	\N	\N	\N	\N	2016-12-06	2016-12-09	\N	\N
20	\N	\N	\N	\N	2016-12-06	2016-12-09	\N	\N
21	\N	\N	\N	\N	2016-12-06	2016-12-09	\N	\N
22	\N	\N	\N	\N	2016-12-06	2016-12-09	\N	\N
55	\N	\N	\N	\N	2015-12-06	2016-12-09	\N	\N
56	\N	\N	\N	\N	2015-12-06	2016-12-09	\N	\N
57	\N	\N	\N	\N	2016-12-06	2016-12-09	\N	\N
89	\N	\N	\N	\N	2016-12-05	2016-12-09	\N	\N
90	\N	\N	\N	\N	2016-12-05	2016-12-09	\N	\N
91	\N	\N	\N	\N	2016-12-05	2016-12-09	\N	\N
92	\N	\N	\N	\N	2016-12-05	2016-12-09	\N	\N
93	\N	\N	\N	\N	2016-12-05	2016-12-07	\N	\N
99	\N	\N	\N	\N	2016-12-06	2016-12-08	\N	\N
100	\N	\N	\N	\N	2016-12-06	2016-12-07	\N	\N
276	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
277	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
278	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
279	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
280	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
281	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
282	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
283	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
284	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
285	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
286	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
287	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
323	10	10	\N	\N	2016-12-30	2016-12-31	\N	\N
376	10	10	\N	\N	2016-12-07	2016-12-08	\N	\N
377	10	10	\N	\N	2016-12-07	2016-12-08	\N	\N
378	10	10	\N	\N	2016-12-07	2016-12-08	\N	\N
380	10	10	\N	\N	2016-12-07	2016-12-08	\N	\N
391	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
392	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
393	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
394	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
395	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
396	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
397	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
398	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
399	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
400	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
401	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
402	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
403	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
404	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
405	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
406	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
407	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
408	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
409	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
410	10	10	\N	\N	2016-12-09	2016-12-10	\N	\N
\.


--
-- TOC entry 4421 (class 0 OID 264852)
-- Dependencies: 419
-- Data for Name: car_season; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY car_season (id, car_id, title, price, startdate, enddate) FROM stdin;
1	1	alta	100	2017-01-23	2017-01-24
2	1	baja	10	2017-01-23	2017-01-24
3	1	media	10	2017-01-26	2017-04-30
\.


--
-- TOC entry 4460 (class 0 OID 0)
-- Dependencies: 418
-- Name: car_season_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('car_season_id_seq', 3, true);


--
-- TOC entry 4210 (class 0 OID 261257)
-- Dependencies: 208
-- Data for Name: cart_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY cart_item (realid, product, id, title, unitariprice, quantity, totalprice, startdate, type) FROM stdin;
1	9	a1804a496a41a9bd9c59e74f0be61f3a	3 Punto Rex Melia Cohiba - Viñales	60	1	60	2016-12-08 00:00:00	TransferColectiveItem
2	9	a1804a496a41a9bd9c59e74f0be61f3a	3 Punto Rex Melia Cohiba - Viñales	60	1	60	2016-12-08 00:00:00	TransferColectiveItem
3	17	67e1570f254303e4ab50ef730795e962	MELIA COHIBA Standart-Melia Cohiba (1 - 0)	110	1	110	2016-12-08 00:00:00	OcupationItem
4	51	fd368c6ca36e71d8797fa4d9ead1d4ff	Rental House: Casa Arcoiris - Room 1 - Casa Arcoiris	50	1	50	2016-12-20 00:00:00	RentalHouseRoomItem
\.


--
-- TOC entry 4461 (class 0 OID 0)
-- Dependencies: 209
-- Name: cartitem_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('cartitem_id_seq', 4, true);


--
-- TOC entry 4212 (class 0 OID 261265)
-- Dependencies: 210
-- Data for Name: chain; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY chain (id, picture, gallery, title, slug, unique_slug, description, available, image) FROM stdin;
1	\N	\N	Melia	melia	1-melia	\N	t	\N
3	\N	\N	Blau	blau	3-blau	\N	t	\N
4	\N	\N	Memories	memories	4-memories	\N	t	\N
2	\N	\N	Iberostar	iberoestar	2-iberoestar	\N	t	\N
\.


--
-- TOC entry 4462 (class 0 OID 0)
-- Dependencies: 211
-- Name: chain_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('chain_id_seq', 4, true);


--
-- TOC entry 4214 (class 0 OID 261276)
-- Dependencies: 212
-- Data for Name: circuirsearcher_place; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuirsearcher_place (id_circuitsearcher, id_place) FROM stdin;
\.


--
-- TOC entry 4215 (class 0 OID 261282)
-- Dependencies: 213
-- Data for Name: circuit; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuit (id, days, nights, polofromid, allow_kid) FROM stdin;
56	2	2	\N	f
57	2	2	\N	f
55	2	2	3	t
\.


--
-- TOC entry 4216 (class 0 OID 261285)
-- Dependencies: 214
-- Data for Name: circuit_availability; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuit_availability (id, date) FROM stdin;
4	2016-12-30
5	2016-12-31
6	2016-12-08
7	2016-12-09
8	2016-12-10
9	2016-12-17
10	2016-12-16
11	2016-12-15
12	2016-12-14
13	2016-12-21
14	2016-12-22
15	2016-12-23
16	2016-12-24
17	2016-12-31
18	2016-12-30
19	2016-12-29
20	2016-12-28
21	2016-12-07
22	2016-12-06
23	2016-12-05
24	2016-12-04
25	2016-12-11
26	2016-12-12
27	2016-12-13
28	2016-12-20
29	2016-12-19
30	2016-12-18
31	2016-12-25
32	2016-12-26
34	2016-12-27
35	2017-01-29
36	2017-01-30
37	2017-01-31
38	2017-02-01
39	2017-02-02
40	2017-02-03
41	2017-02-04
46	2017-02-09
53	2017-04-26
54	2017-04-11
55	2017-04-23
57	2017-04-25
65	2017-04-07
66	2017-04-01
67	2017-04-08
68	2017-04-06
69	2017-04-04
70	2017-04-03
71	2017-04-02
72	2017-04-05
73	2017-04-12
74	2017-04-09
75	2017-04-10
76	2017-04-16
77	2017-04-24
78	2017-04-17
79	2017-04-18
80	2017-04-19
81	2017-04-20
82	2017-04-13
83	2017-04-15
84	2017-04-29
85	2017-04-22
86	2017-04-21
87	2017-04-14
88	2017-04-27
89	2017-04-28
\.


--
-- TOC entry 4463 (class 0 OID 0)
-- Dependencies: 215
-- Name: circuit_availability_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('circuit_availability_id_seq', 89, true);


--
-- TOC entry 4218 (class 0 OID 261290)
-- Dependencies: 216
-- Data for Name: circuit_circuitavailabilitys; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuit_circuitavailabilitys (circuit_id, circuit_availability_id) FROM stdin;
57	4
57	5
55	6
55	7
55	8
55	9
55	10
55	11
55	12
55	13
55	14
55	15
55	16
55	17
55	18
55	19
55	20
55	21
55	22
55	23
55	24
55	25
55	26
55	27
55	28
55	29
55	30
55	31
55	32
55	34
55	35
55	36
55	37
55	38
55	39
55	40
55	41
55	46
55	53
55	54
55	55
55	57
55	65
55	66
55	67
55	68
55	69
55	70
55	71
55	72
55	73
55	74
55	75
55	76
55	77
55	78
55	79
55	80
55	81
55	82
55	83
55	84
55	85
55	86
55	87
55	88
55	89
\.


--
-- TOC entry 4219 (class 0 OID 261293)
-- Dependencies: 217
-- Data for Name: circuit_day; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuit_day (id, circuit, picture, gallery, title, description, day, include, notinclude, slug, unique_slug) FROM stdin;
3	56	27	\N	La Habana	\N	1	\N	\N	la-habana	3-la-habana
4	56	28	\N	Trinidad	\N	2	\N	\N	trinidad	4-trinidad
5	57	\N	\N	Dia 1 - Varadero	\N	1	\N	\N	dia-1-varadero	5-dia-1-varadero
6	57	\N	\N	Dia 2	\N	2	\N	\N	dia-2	6-dia-2
7	\N	\N	\N	sasas	\N	3	\N	\N	sasas	7-sasas
8	\N	\N	\N	asd	\N	1	\N	\N	asd	8-asd
9	\N	\N	\N	11	\N	111	\N	\N	11	9-11
10	\N	\N	\N	123	\N	1	\N	\N	123	10-123
11	55	\N	\N	vinnales2	\N	1	\N	\N	vinnales2	11-vinnales2
\.


--
-- TOC entry 4464 (class 0 OID 0)
-- Dependencies: 218
-- Name: circuit_day_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('circuit_day_id_seq', 12, true);


--
-- TOC entry 4221 (class 0 OID 261305)
-- Dependencies: 219
-- Data for Name: circuit_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuit_item (realid, pickupplace, adults, kids, ocupation) FROM stdin;
\.


--
-- TOC entry 4222 (class 0 OID 261308)
-- Dependencies: 220
-- Data for Name: circuit_request; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuit_request (id, circuit, adult, kid, startdate, ocupation) FROM stdin;
\.


--
-- TOC entry 4223 (class 0 OID 261311)
-- Dependencies: 221
-- Data for Name: circuit_searcher; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuit_searcher (id, circuit, days, title, nights, date, betweendates, adults, kids, polofromid) FROM stdin;
133	\N	\N	\N	\N	2016-11-19	\N	1	0	\N
243	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
244	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
245	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
246	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
247	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
248	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
249	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
250	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
251	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
252	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
253	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
254	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
255	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
256	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
257	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
258	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
259	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
260	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
261	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
262	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
263	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
264	\N	\N	\N	\N	2016-12-31	\N	1	1	\N
265	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
266	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
267	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
268	\N	\N	\N	\N	2016-11-27	\N	1	0	\N
269	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
270	\N	\N	\N	\N	2016-11-27	\N	1	0	\N
271	\N	\N	\N	\N	2016-11-27	\N	1	0	\N
272	\N	\N	\N	\N	2016-11-27	\N	1	0	\N
273	\N	\N	\N	\N	2016-11-27	\N	1	0	\N
274	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
275	\N	\N	\N	\N	2016-12-31	\N	1	0	\N
365	\N	\N	\N	\N	2016-12-07	\N	1	0	\N
366	\N	\N	\N	\N	2016-12-07	\N	1	0	\N
367	\N	\N	\N	\N	2016-12-07	\N	1	0	\N
368	\N	\N	\N	\N	2016-12-07	\N	1	0	\N
369	\N	\N	\N	\N	2016-12-07	\N	1	0	\N
370	\N	\N	\N	\N	2016-12-07	\N	1	0	\N
371	\N	\N	\N	\N	2016-12-07	\N	1	0	\N
572	55	\N	\N	\N	2017-01-20	f	1	0	\N
573	55	\N	\N	\N	2017-01-20	f	2	0	\N
574	55	\N	\N	\N	2017-01-20	f	2	0	\N
575	55	\N	\N	\N	2017-01-20	f	2	0	\N
576	55	\N	\N	\N	2017-01-29	f	2	0	\N
577	55	\N	\N	\N	2017-01-29	f	2	0	\N
580	55	\N	\N	\N	2017-01-29	f	1	0	\N
581	55	\N	\N	\N	2017-01-29	f	1	0	\N
582	55	\N	\N	\N	2017-01-29	f	1	0	\N
583	55	\N	\N	\N	2017-01-21	f	1	0	\N
584	55	\N	\N	\N	2017-01-29	f	1	0	\N
585	55	\N	\N	\N	2017-01-29	f	2	0	\N
586	55	\N	\N	\N	2017-01-29	f	2	0	\N
587	55	\N	\N	\N	2017-01-29	f	2	0	\N
588	55	\N	\N	\N	2017-01-29	f	2	0	\N
589	55	\N	\N	\N	2017-01-29	f	2	0	\N
590	55	\N	\N	\N	2017-01-29	f	2	0	\N
591	55	\N	\N	\N	2017-01-29	f	2	0	\N
592	55	\N	\N	\N	2017-01-29	f	2	0	\N
593	55	\N	\N	\N	2017-01-29	f	2	0	\N
594	55	\N	\N	\N	2017-01-29	f	2	0	\N
595	55	\N	\N	\N	2017-01-29	f	2	0	\N
596	55	\N	\N	\N	2017-01-29	f	2	0	\N
597	55	\N	\N	\N	2017-01-29	f	2	0	\N
598	55	\N	\N	\N	2017-01-29	f	2	0	\N
599	55	\N	\N	\N	2017-01-29	f	2	0	\N
600	55	\N	\N	\N	2017-01-29	f	2	0	\N
601	55	\N	\N	\N	2017-01-29	f	2	0	\N
602	55	\N	\N	\N	2017-01-29	f	2	0	\N
603	55	\N	\N	\N	2017-01-29	f	2	0	\N
604	55	\N	\N	\N	2017-01-29	f	2	0	\N
605	55	\N	\N	\N	2017-01-29	f	2	0	\N
606	55	\N	\N	\N	2017-01-29	f	2	0	\N
607	55	\N	\N	\N	2017-01-29	f	2	0	\N
608	55	\N	\N	\N	2017-01-29	f	2	0	\N
609	55	\N	\N	\N	2017-01-29	f	2	0	\N
610	55	\N	\N	\N	2017-01-29	f	2	0	\N
611	55	\N	\N	\N	2017-01-29	f	2	0	\N
612	55	\N	\N	\N	2017-01-29	f	2	0	\N
613	55	\N	\N	\N	2017-01-29	f	2	0	\N
614	55	\N	\N	\N	2017-01-29	f	2	0	\N
615	55	\N	\N	\N	2017-01-29	f	2	0	\N
616	55	\N	\N	\N	2017-01-21	f	2	0	\N
617	55	\N	\N	\N	2017-01-29	f	2	0	\N
618	55	\N	\N	\N	2017-01-29	f	2	0	\N
619	55	\N	\N	\N	2017-01-29	f	2	0	\N
620	55	\N	\N	\N	2017-01-21	f	2	0	\N
621	55	\N	\N	\N	2017-01-21	f	2	0	\N
622	55	\N	\N	\N	2017-01-21	f	2	0	\N
623	55	\N	\N	\N	2017-01-21	f	2	0	\N
624	55	\N	\N	\N	2017-01-21	f	2	0	\N
625	55	\N	\N	\N	2017-01-21	f	2	0	\N
626	55	\N	\N	\N	2017-01-21	f	2	0	\N
627	55	\N	\N	\N	2017-01-21	f	2	0	\N
628	55	\N	\N	\N	2017-01-21	f	2	0	\N
629	55	\N	\N	\N	2017-01-22	f	1	0	\N
630	55	\N	\N	\N	2017-01-29	f	1	0	\N
631	55	\N	\N	\N	2017-01-29	f	2	0	\N
632	55	\N	\N	\N	2017-01-30	f	2	0	\N
633	55	\N	\N	\N	2017-01-30	f	2	0	\N
634	55	\N	\N	\N	2017-01-19	f	2	0	\N
637	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
638	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
639	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
640	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
641	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
642	\N	\N	\N	\N	2017-01-31	\N	1	1	\N
643	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
644	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
645	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
646	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
647	\N	\N	\N	\N	2017-02-01	\N	1	0	\N
648	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
649	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
650	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
651	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
652	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
653	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
654	\N	\N	\N	\N	2017-01-31	\N	1	0	\N
655	55	\N	\N	\N	2017-03-15	f	1	0	\N
661	\N	\N	\N	\N	2017-03-25	\N	1	0	\N
662	\N	\N	\N	\N	2017-04-05	\N	1	0	\N
664	\N	\N	\N	\N	2017-04-11	\N	1	0	\N
665	\N	\N	\N	\N	2017-04-11	\N	1	0	\N
666	\N	\N	\N	\N	2017-04-27	\N	1	0	\N
667	\N	\N	\N	\N	2017-04-27	\N	1	0	\N
668	\N	\N	\N	\N	2017-04-18	\N	1	0	\N
669	\N	\N	\N	\N	2017-04-18	\N	1	0	\N
670	\N	\N	\N	\N	2017-04-18	\N	1	0	\N
671	\N	\N	\N	\N	2017-04-18	\N	1	0	\N
672	\N	\N	\N	\N	2017-04-18	\N	1	0	\N
673	\N	\N	\N	\N	2017-04-18	\N	1	0	\N
674	\N	\N	\N	\N	2017-04-18	\N	1	0	\N
675	\N	\N	\N	\N	2017-04-18	\N	1	0	\N
676	\N	\N	\N	\N	2017-04-18	\N	1	0	\N
677	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
678	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
679	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
680	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
681	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
682	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
683	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
684	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
685	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
686	\N	\N	\N	\N	2017-04-12	\N	1	0	\N
714	\N	\N	\N	\N	2017-03-28	\N	1	0	\N
715	\N	\N	\N	\N	2017-04-19	\N	1	0	\N
716	\N	\N	\N	\N	2017-04-19	\N	1	0	\N
\.


--
-- TOC entry 4224 (class 0 OID 261315)
-- Dependencies: 222
-- Data for Name: circuit_season; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuit_season (id, circuit_id, title, adult_price, kid_price, adult_price_doble, kid_price_doble, startdate, enddate) FROM stdin;
34	55	ALTA Apr 1, 2017 - Apr 30, 2017	150	150	100	100	2017-04-01	2017-04-30
\.


--
-- TOC entry 4465 (class 0 OID 0)
-- Dependencies: 223
-- Name: circuit_season_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('circuit_season_id_seq', 34, true);


--
-- TOC entry 4226 (class 0 OID 261330)
-- Dependencies: 224
-- Data for Name: circuits_days_places; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY circuits_days_places (circuit_day_id, place_id) FROM stdin;
3	5
3	6
3	7
4	4
5	5
5	6
5	7
6	10
8	10
10	3
11	10
\.


--
-- TOC entry 4227 (class 0 OID 261333)
-- Dependencies: 225
-- Data for Name: classification__category; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY classification__category (id, parent_id, context, media_id, name, enabled, slug, description, "position", created_at, updated_at) FROM stdin;
1	\N	daiquiri	\N	daiquiri	t	daiquiri	daiquiri	\N	2016-11-14 01:27:51	2016-11-14 01:27:51
\.


--
-- TOC entry 4466 (class 0 OID 0)
-- Dependencies: 226
-- Name: classification__category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('classification__category_id_seq', 1, true);


--
-- TOC entry 4229 (class 0 OID 261343)
-- Dependencies: 227
-- Data for Name: classification__collection; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY classification__collection (id, context, media_id, name, enabled, slug, description, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 4467 (class 0 OID 0)
-- Dependencies: 228
-- Name: classification__collection_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('classification__collection_id_seq', 1, false);


--
-- TOC entry 4231 (class 0 OID 261353)
-- Dependencies: 229
-- Data for Name: classification__context; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY classification__context (id, name, enabled, created_at, updated_at) FROM stdin;
daiquiri	daiquiri	t	2016-11-14 01:24:28	2016-11-14 01:26:05
\.


--
-- TOC entry 4232 (class 0 OID 261359)
-- Dependencies: 230
-- Data for Name: classification__tag; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY classification__tag (id, context, name, enabled, slug, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 4468 (class 0 OID 0)
-- Dependencies: 231
-- Name: classification__tag_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('classification__tag_id_seq', 1, false);


--
-- TOC entry 4234 (class 0 OID 261377)
-- Dependencies: 232
-- Data for Name: configuration_pam; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY configuration_pam (id, key_pam_eur, code_pam_eur, key_pam_usd, code_pam_usd, comercio, pasarela, absolute_dir, url_recive, url_ok, url_ko) FROM stdin;
1	d41qu1r1eur	978	d41qu1r1usd	840	Daiquiri Tours Cuba	http://localhost:9000/index.php	http://localhost:8090/app_dev.php/	/sale-payment/response	/sale-payment/ok	/sale-payment/fail
\.


--
-- TOC entry 4235 (class 0 OID 261383)
-- Dependencies: 233
-- Data for Name: configuration_tpv; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY configuration_tpv (id, title, company_name, tax, type) FROM stdin;
1	pam_test	PamInt S.A	6	ConfigurationPam
\.


--
-- TOC entry 4469 (class 0 OID 0)
-- Dependencies: 234
-- Name: configuration_tpv_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('configuration_tpv_id_seq', 1, true);


--
-- TOC entry 4237 (class 0 OID 261391)
-- Dependencies: 235
-- Data for Name: contact; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY contact (id, contact_cause, email, name, message) FROM stdin;
\.


--
-- TOC entry 4238 (class 0 OID 261400)
-- Dependencies: 236
-- Data for Name: contact_cause; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY contact_cause (id, title, description, slug, unique_slug) FROM stdin;
\.


--
-- TOC entry 4470 (class 0 OID 0)
-- Dependencies: 237
-- Name: contact_cause_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('contact_cause_id_seq', 1, false);


--
-- TOC entry 4471 (class 0 OID 0)
-- Dependencies: 238
-- Name: contact_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('contact_id_seq', 1, false);


--
-- TOC entry 4241 (class 0 OID 261412)
-- Dependencies: 239
-- Data for Name: country; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY country (id, picture, gallery, market_id, title, slug, unique_slug, isocode, description) FROM stdin;
2	\N	\N	1	United States	united-states	2-united-states	US	\N
3	\N	\N	\N	Cuba	cuba-1	3-cuba	CU	\N
1	\N	\N	3	Cuba	cuba	1-cuba	CU	<p>Cuba</p>
\.


--
-- TOC entry 4472 (class 0 OID 0)
-- Dependencies: 240
-- Name: country_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('country_id_seq', 3, true);


--
-- TOC entry 4243 (class 0 OID 261421)
-- Dependencies: 241
-- Data for Name: currency; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY currency (id, title, change, nomenclator, favicon, code, slug, unique_slug) FROM stdin;
1	Dollar	1	usd	fa-dollar	840	dollar	1-dollar
\.


--
-- TOC entry 4473 (class 0 OID 0)
-- Dependencies: 242
-- Name: currency_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('currency_id_seq', 1, true);


--
-- TOC entry 4245 (class 0 OID 261433)
-- Dependencies: 243
-- Data for Name: document; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY document (id, title, description, slug, unique_slug) FROM stdin;
1	licencia	\N	licencia	1-licencia
2	pasaporte	\N	pasaporte	2-pasaporte
\.


--
-- TOC entry 4474 (class 0 OID 0)
-- Dependencies: 244
-- Name: document_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('document_id_seq', 2, true);


--
-- TOC entry 4247 (class 0 OID 261442)
-- Dependencies: 245
-- Data for Name: documents_hotels; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY documents_hotels (document_id, hotel_id) FROM stdin;
\.


--
-- TOC entry 4248 (class 0 OID 261445)
-- Dependencies: 246
-- Data for Name: documents_packages; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY documents_packages (document_id, package_id) FROM stdin;
\.


--
-- TOC entry 4249 (class 0 OID 261448)
-- Dependencies: 247
-- Data for Name: documents_products; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY documents_products (document_id, product_id) FROM stdin;
\.


--
-- TOC entry 4250 (class 0 OID 261451)
-- Dependencies: 248
-- Data for Name: documents_rentalhouse; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY documents_rentalhouse (document_id, rental_house_id) FROM stdin;
\.


--
-- TOC entry 4251 (class 0 OID 261454)
-- Dependencies: 249
-- Data for Name: driver; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY driver (id, picture, title, name, lastname, dateofbirth, experienceyears, email, phone1, phone2, description, slug, unique_slug) FROM stdin;
\.


--
-- TOC entry 4475 (class 0 OID 0)
-- Dependencies: 250
-- Name: driver_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('driver_id_seq', 1, false);


--
-- TOC entry 4253 (class 0 OID 261465)
-- Dependencies: 251
-- Data for Name: drivers_cars; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY drivers_cars (driver_id, car_id) FROM stdin;
\.


--
-- TOC entry 4254 (class 0 OID 261468)
-- Dependencies: 252
-- Data for Name: duser; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY duser (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code, passport, facebook_id, google_id, twitter_id, avatar, picture, address, city, state, zipcode, country) FROM stdin;
1	lolo	lolo	lolo@gmail.com	lolo@gmail.com	t	iu726sglqvsck4s88cosowc48oo0ks0	jPISVDbMElngKA9LK5XL3SZGNwRiG+ZeBj0TVnSnoBB/oeOGCLfg5HjLlpVIlV1n3c/ekIs0kBZOv1okJ4vSSg==	2016-11-22 17:49:37	f	f	\N	\N	\N	a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}	f	\N	2016-11-13 20:13:13	2016-11-22 17:49:37	1991-01-12 00:00:00	Eliecer	Sanchez	\N	\N	m	es	America/Havana	58475531	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	91011242404	\N	\N	\N	\N	e630ee3c945f711e5367a2c0688f8a56.jpeg	\N	\N	\N	\N	\N
2	denis	denis	dlespinosa365@gmail.com	dlespinosa365@gmail.com	t	ghq8r0oug7sckc8w0048cssg0ssgksc	diYhizglUHeMLhkotEhV6tn1Tmrl6uLAYG0wLV1WKyen2MohsSqdWWBRwDEPQhPjMfTkuhaXkqG1PyGjNBeojQ==	2017-03-27 11:46:30	f	f	\N	\N	\N	a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}	f	\N	2016-11-23 22:00:11	2017-03-27 11:46:30	\N	\N	\N	\N	\N	u	\N	\N	\N	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
3	system	system	no-reply@daiquiricuba.com	no-reply@daiquiricuba.com	f	5ziek64om8co88800ggwwkkg4go4kw8	RCdyDTb1p7HA7fsKNpBfCCc+HC7lx9l2f97K9CN/zWyAR/LGPiWy7tjvckOJorbJwJ3P261ge026mOa8/pyt0A==	\N	f	f	\N	\N	\N	a:0:{}	f	\N	2016-12-04 11:50:08	2016-12-04 11:50:08	\N	\N	\N	\N	\N	u	\N	\N	\N	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
\.


--
-- TOC entry 4476 (class 0 OID 0)
-- Dependencies: 253
-- Name: duser_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('duser_id_seq', 3, true);


--
-- TOC entry 4256 (class 0 OID 261507)
-- Dependencies: 254
-- Data for Name: excursion; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion (id, polofrom, duration, include, notinclude, sunday, monday, thuesday, wednesday, thursday, friday, saturday, adultprice, kid_price) FROM stdin;
5	3	6	\N	\N	t	t	t	t	t	t	t	150	120
7	3	2	\N	\N	t	t	f	f	t	t	t	89	25
6	4	3	\N	\N	t	t	t	t	t	t	f	250	200
8	3	5	\N	\N	t	t	t	t	t	t	f	80	65
\.


--
-- TOC entry 4257 (class 0 OID 261515)
-- Dependencies: 255
-- Data for Name: excursion_colective; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_colective (id, minpax) FROM stdin;
6	30
5	1
\.


--
-- TOC entry 4258 (class 0 OID 261518)
-- Dependencies: 256
-- Data for Name: excursion_colective_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_colective_item (realid, pickupplace, dropoffplace, adult, kid) FROM stdin;
\.


--
-- TOC entry 4259 (class 0 OID 261521)
-- Dependencies: 257
-- Data for Name: excursion_exclusive; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_exclusive (id) FROM stdin;
7
8
\.


--
-- TOC entry 4260 (class 0 OID 261524)
-- Dependencies: 258
-- Data for Name: excursion_exclusive_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_exclusive_item (realid, pickupplace, dropoffplace, adult, kid) FROM stdin;
\.


--
-- TOC entry 4261 (class 0 OID 261527)
-- Dependencies: 259
-- Data for Name: excursion_excursion_types; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_excursion_types (excursion_id, excursion_type_id) FROM stdin;
5	1
6	2
7	1
8	2
\.


--
-- TOC entry 4418 (class 0 OID 264804)
-- Dependencies: 416
-- Data for Name: excursion_place; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_place (excursion_id, place_id) FROM stdin;
5	5
5	6
5	1
\.


--
-- TOC entry 4262 (class 0 OID 261530)
-- Dependencies: 260
-- Data for Name: excursion_request; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_request (id, excursion, adult, kid, startdate) FROM stdin;
\.


--
-- TOC entry 4263 (class 0 OID 261533)
-- Dependencies: 261
-- Data for Name: excursion_searcher; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_searcher (id, polo, excursion, polofrom, date, exclusive, adults, kids) FROM stdin;
94	\N	\N	\N	2016-11-25	f	1	0
95	\N	\N	\N	2016-11-25	f	1	0
96	\N	\N	\N	2016-11-30	f	1	0
97	\N	\N	\N	2016-11-19	t	1	0
98	\N	\N	\N	2016-11-21	t	1	0
288	\N	\N	\N	2016-12-31	f	1	0
289	\N	\N	\N	2016-12-31	f	1	0
290	\N	\N	\N	2016-12-31	f	1	0
291	\N	\N	\N	2016-12-31	f	1	0
292	\N	\N	\N	2016-12-31	f	1	0
293	\N	\N	\N	2016-12-31	f	1	0
294	\N	\N	\N	2016-12-31	f	1	0
295	\N	\N	\N	2016-12-31	f	1	1
296	\N	\N	\N	2016-12-31	f	1	1
297	\N	\N	\N	2016-12-31	f	1	0
298	\N	\N	\N	2016-12-31	f	2	0
299	\N	\N	\N	2016-12-31	f	2	0
300	\N	\N	\N	2016-12-31	t	1	0
301	\N	\N	\N	2016-12-31	t	1	1
359	\N	8	\N	2016-12-07	t	1	0
360	\N	\N	\N	2016-12-07	f	1	0
361	\N	\N	\N	2016-12-07	f	1	0
362	\N	\N	\N	2016-12-07	f	1	0
363	\N	\N	\N	2016-12-07	f	1	0
364	\N	\N	\N	2016-12-07	f	1	0
372	\N	\N	\N	2016-12-07	f	1	0
373	\N	\N	\N	2016-12-07	f	1	0
374	\N	\N	\N	2016-12-07	f	1	0
375	\N	\N	\N	2016-12-07	f	1	0
489	\N	\N	\N	2017-01-14	f	1	0
490	\N	\N	\N	2017-01-14	f	1	0
491	\N	\N	\N	2017-01-14	f	1	0
499	\N	5	\N	2017-01-17	f	1	0
500	\N	5	\N	2017-01-17	f	1	0
501	\N	5	\N	2017-01-17	f	1	0
502	\N	5	\N	2017-01-17	f	1	0
503	\N	5	\N	2017-01-17	f	1	0
504	\N	5	\N	2017-01-17	f	1	0
505	\N	5	\N	2017-01-17	f	1	0
506	\N	5	\N	2017-01-17	f	2	0
507	\N	5	\N	2017-01-17	f	2	0
508	\N	5	\N	2017-01-17	f	2	0
509	\N	5	\N	2017-01-17	f	2	0
510	\N	5	\N	2017-01-17	f	2	0
511	\N	5	\N	2017-01-17	f	1	0
534	\N	5	\N	2017-01-25	f	2	0
535	\N	5	\N	2017-01-20	f	3	3
536	\N	5	\N	2017-01-20	f	3	3
537	\N	5	\N	2017-01-20	f	3	3
538	\N	5	\N	2017-01-20	f	3	3
539	\N	5	\N	2017-01-20	f	3	3
540	\N	5	\N	2017-01-20	f	3	3
541	\N	5	\N	2017-01-20	f	3	3
542	\N	5	\N	2017-01-20	f	3	3
543	\N	5	\N	2017-01-20	f	3	0
544	\N	5	\N	2017-01-20	f	3	0
545	\N	5	\N	2017-01-20	f	3	0
546	\N	5	\N	2017-01-20	f	3	0
547	\N	5	\N	2017-01-20	f	3	0
548	\N	5	\N	2017-01-20	f	3	0
549	\N	5	\N	2017-01-20	f	3	0
550	\N	5	\N	2017-01-20	f	3	0
551	\N	5	\N	2017-01-20	f	3	0
552	\N	5	\N	2017-01-20	f	2	0
553	\N	5	\N	2017-01-20	f	2	0
554	\N	5	\N	2017-01-20	f	1	0
555	\N	5	\N	2017-01-20	f	1	0
556	\N	5	\N	2017-01-20	f	1	0
557	\N	5	\N	2017-01-20	f	1	0
558	\N	5	\N	2017-01-20	f	1	0
559	\N	5	\N	2017-01-20	f	1	0
560	\N	5	\N	2017-01-20	f	1	0
561	\N	5	\N	2017-01-20	f	1	0
562	\N	5	\N	2017-01-20	f	1	0
563	\N	5	\N	2017-01-20	f	2	0
564	\N	5	\N	2017-01-20	f	2	0
565	\N	5	\N	2017-01-20	f	2	0
566	\N	5	\N	2017-01-20	f	2	0
567	\N	5	\N	2017-01-20	f	2	0
568	\N	5	\N	2017-01-20	f	2	0
569	\N	5	\N	2017-01-20	f	2	0
570	\N	5	\N	2017-01-20	f	2	0
571	\N	8	\N	2017-01-20	f	1	0
578	\N	5	\N	2017-01-21	f	1	0
579	\N	5	\N	2017-01-21	f	1	0
635	\N	7	\N	2017-01-23	f	2	0
636	\N	7	\N	2017-01-23	f	2	0
657	\N	5	\N	2017-03-22	f	2	0
658	\N	5	\N	2017-03-22	f	2	0
659	\N	5	\N	2017-03-22	f	1	0
\.


--
-- TOC entry 4419 (class 0 OID 264821)
-- Dependencies: 417
-- Data for Name: excursion_searcher_excursion_place; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_searcher_excursion_place (excursion_searcher_id, excursion_place_id) FROM stdin;
489	2
490	2
491	1
\.


--
-- TOC entry 4264 (class 0 OID 261536)
-- Dependencies: 262
-- Data for Name: excursion_searcher_excursion_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_searcher_excursion_type (excursion_searcher_id, excursion_type_id) FROM stdin;
\.


--
-- TOC entry 4265 (class 0 OID 261539)
-- Dependencies: 263
-- Data for Name: excursion_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY excursion_type (id, title, description, slug, unique_slug) FROM stdin;
1	Countryside	<p>Countryside</p>	countryside	1-countryside
2	City	<p>City</p>	city	2-city
\.


--
-- TOC entry 4477 (class 0 OID 0)
-- Dependencies: 264
-- Name: excursion_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('excursion_type_id_seq', 2, true);


--
-- TOC entry 4267 (class 0 OID 261549)
-- Dependencies: 265
-- Data for Name: ext_log_entries; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY ext_log_entries (id, action, logged_at, object_id, object_class, version, data, username) FROM stdin;
\.


--
-- TOC entry 4478 (class 0 OID 0)
-- Dependencies: 266
-- Name: ext_log_entries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('ext_log_entries_id_seq', 1, false);


--
-- TOC entry 4269 (class 0 OID 261559)
-- Dependencies: 267
-- Data for Name: ext_translations; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY ext_translations (id, locale, object_class, field, foreign_key, content) FROM stdin;
556	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	36	www
2	en	Daiquiri\\AdminBundle\\Entity\\HotelType	title	1	City Hotel
3	en	Daiquiri\\AdminBundle\\Entity\\HotelType	slug	1	city-hotel
4	en	Daiquiri\\AdminBundle\\Entity\\HotelType	uniqueSlug	1	1-city-hotel
5	en	Daiquiri\\AdminBundle\\Entity\\HotelType	title	2	Beach Hotel
6	en	Daiquiri\\AdminBundle\\Entity\\HotelType	slug	2	beach-hotel
7	en	Daiquiri\\AdminBundle\\Entity\\HotelType	uniqueSlug	2	2-beach-hotel
8	en	Daiquiri\\AdminBundle\\Entity\\HotelType	title	3	Country Hotel
9	en	Daiquiri\\AdminBundle\\Entity\\HotelType	slug	3	country-hotel
10	en	Daiquiri\\AdminBundle\\Entity\\HotelType	uniqueSlug	3	3-country-hotel
11	en	Daiquiri\\AdminBundle\\Entity\\Chain	slug	1	melia
12	en	Daiquiri\\AdminBundle\\Entity\\Chain	uniqueSlug	1	1-melia
15	en	Daiquiri\\AdminBundle\\Entity\\Chain	slug	3	blau
16	en	Daiquiri\\AdminBundle\\Entity\\Chain	uniqueSlug	3	3-blau
17	en	Daiquiri\\AdminBundle\\Entity\\Chain	slug	4	memories
18	en	Daiquiri\\AdminBundle\\Entity\\Chain	uniqueSlug	4	4-memories
19	en	Daiquiri\\AdminBundle\\Entity\\HotelSalesAgent	title	1	Agente Ventas Melia Cohiba
20	en	Daiquiri\\AdminBundle\\Entity\\HotelSalesAgent	slug	1	agente-ventas-melia-cohiba
21	en	Daiquiri\\AdminBundle\\Entity\\HotelSalesAgent	uniqueSlug	1	1-agente-ventas-melia-cohiba
22	en	Daiquiri\\AdminBundle\\Entity\\Season	title	1	Season 1 - Melia Cohiba
23	en	Daiquiri\\AdminBundle\\Entity\\Season	slug	1	season-1-melia-cohiba
24	en	Daiquiri\\AdminBundle\\Entity\\Season	uniqueSlug	1	1-season-1-melia-cohiba
25	en	Daiquiri\\AdminBundle\\Entity\\Season	title	2	Season 2 -Melia Cohiba
26	en	Daiquiri\\AdminBundle\\Entity\\Season	slug	2	season-2-melia-cohiba
27	en	Daiquiri\\AdminBundle\\Entity\\Season	uniqueSlug	2	2-season-2-melia-cohiba
28	en	Daiquiri\\AdminBundle\\Entity\\Season	title	3	Season 3 - Melia Cohiba
29	en	Daiquiri\\AdminBundle\\Entity\\Season	slug	3	season-3-melia-cohiba
30	en	Daiquiri\\AdminBundle\\Entity\\Season	uniqueSlug	3	3-season-3-melia-cohiba
31	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	title	1	Parking
32	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	slug	1	parking
33	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	uniqueSlug	1	1-parking
34	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	1	Parking
35	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	1	parking
36	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	1	1-parking
37	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	title	2	Pool
38	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	slug	2	pool
39	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	uniqueSlug	2	2-pool
40	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	2	Pool
41	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	2	pool
42	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	2	2-pool
43	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	1	TV
44	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	1	tv
45	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	1	1-tv
49	en	Daiquiri\\AdminBundle\\Entity\\PlaceType	title	6	Hotel
50	en	Daiquiri\\AdminBundle\\Entity\\PlaceType	slug	6	hotel
51	en	Daiquiri\\AdminBundle\\Entity\\PlaceType	uniqueSlug	6	6-hotel
52	en	Daiquiri\\AdminBundle\\Entity\\Place	title	5	Melia Cohiba
53	en	Daiquiri\\AdminBundle\\Entity\\Place	slug	5	melia-cohiba
54	en	Daiquiri\\AdminBundle\\Entity\\Place	uniqueSlug	5	5-melia-cohiba
55	en	Daiquiri\\AdminBundle\\Entity\\Place	address	5	La Habana, Malecón, Cuba
68	en	Daiquiri\\AdminBundle\\Entity\\Season	title	4	Season Invierno - Melia Habana
69	en	Daiquiri\\AdminBundle\\Entity\\Season	slug	4	season-invierno-melia-habana
70	en	Daiquiri\\AdminBundle\\Entity\\Season	uniqueSlug	4	4-season-invierno-melia-habana
71	en	Daiquiri\\AdminBundle\\Entity\\Season	title	5	Season Primavera - Melia Habana
72	en	Daiquiri\\AdminBundle\\Entity\\Season	slug	5	season-primavera-melia-habana
73	en	Daiquiri\\AdminBundle\\Entity\\Season	uniqueSlug	5	5-season-primavera-melia-habana
74	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	3	Pool
75	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	3	pool-1
76	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	3	3-pool
77	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	4	Parking
78	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	4	parking-1
13	en	Daiquiri\\AdminBundle\\Entity\\Chain	slug	2	iberostar
14	en	Daiquiri\\AdminBundle\\Entity\\Chain	uniqueSlug	2	2-iberostar
79	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	4	4-parking
80	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	2	TV
81	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	2	tv-1
82	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	2	2-tv
83	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	3	WiFi
84	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	3	wifi
85	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	3	3-wifi
89	en	Daiquiri\\AdminBundle\\Entity\\Room	title	3	Junior Suite - Melia Habana
90	en	Daiquiri\\AdminBundle\\Entity\\Room	slug	3	junior-suite-melia-habana
91	en	Daiquiri\\AdminBundle\\Entity\\Room	uniqueSlug	3	3-junior-suite-melia-habana
92	en	Daiquiri\\AdminBundle\\Entity\\Place	title	6	Melia Habana
93	en	Daiquiri\\AdminBundle\\Entity\\Place	slug	6	melia-habana
94	en	Daiquiri\\AdminBundle\\Entity\\Place	uniqueSlug	6	6-melia-habana
155	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	10	10-wifi
156	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	7	TV
157	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	7	tv-4
158	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	7	7-tv
95	en	Daiquiri\\AdminBundle\\Entity\\Place	description	6	<p>El comit&eacute; de acci&oacute;n pol&iacute;tica que dirige tiene como objetivo declarado&nbsp;<strong>&ldquo;promover una transici&oacute;n incondicional en Cuba a la democracia, el Estado de derecho y el mercado libre&rdquo;</strong>.</p>\r\n\r\n<p>Aunque este abogado estadounidense ya trabaj&oacute; hace a&ntilde;os como asesor en el Departamento del Tesoro y conoce por tanto la agencia, algunos observadores ven su nombramiento como una se&ntilde;al de que Trump podr&iacute;a estar dispuesto a cumplir su promesa electoral de dar marcha atr&aacute;s a las medidas tomadas por Obama respecto a Cuba.</p>\r\n\r\n<p>Durante las primarias republicanas, Trump fue el &uacute;nico aspirante de su partido que apoyaba la pol&iacute;tica de deshielo, pero fue endureciendo su posici&oacute;n a medida que buscaba votos en Florida en las elecciones generales.</p>
96	en	Daiquiri\\AdminBundle\\Entity\\Place	address	6	3ra Avenida, Mirarmar, La Habana, Cuba
97	en	Daiquiri\\AdminBundle\\Entity\\HotelSalesAgent	title	6	Agente de Ventas - Memories Miramar
98	en	Daiquiri\\AdminBundle\\Entity\\HotelSalesAgent	slug	6	agente-de-ventas-memories-miramar
99	en	Daiquiri\\AdminBundle\\Entity\\HotelSalesAgent	uniqueSlug	6	6-agente-de-ventas-memories-miramar
100	en	Daiquiri\\AdminBundle\\Entity\\Season	title	6	Season Alta - Memories Miramar
101	en	Daiquiri\\AdminBundle\\Entity\\Season	slug	6	season-alta-memories-miramar
102	en	Daiquiri\\AdminBundle\\Entity\\Season	uniqueSlug	6	6-season-alta-memories-miramar
103	en	Daiquiri\\AdminBundle\\Entity\\Season	title	7	Season Baja - Memories Miramar
104	en	Daiquiri\\AdminBundle\\Entity\\Season	slug	7	season-baja-memories-miramar
105	en	Daiquiri\\AdminBundle\\Entity\\Season	uniqueSlug	7	7-season-baja-memories-miramar
106	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	title	3	WIFI
107	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	slug	3	wifi
108	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	uniqueSlug	3	3-wifi
109	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	5	WiFi
110	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	5	wifi
111	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	5	5-wifi
112	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	6	Parking
113	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	6	parking-2
114	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	6	6-parking
115	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	7	Pool
116	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	7	pool-2
117	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	7	7-pool
118	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	4	TV
119	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	4	tv-2
120	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	4	4-tv
121	en	Daiquiri\\AdminBundle\\Entity\\Room	title	4	Room Presidential - Memories Miramar
122	en	Daiquiri\\AdminBundle\\Entity\\Room	slug	4	room-presidential-memories-miramar
123	en	Daiquiri\\AdminBundle\\Entity\\Room	uniqueSlug	4	4-room-presidential-memories-miramar
124	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	5	WiFi
125	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	5	wifi-1
126	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	5	5-wifi
127	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	6	TV
128	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	6	tv-3
129	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	6	6-tv
130	en	Daiquiri\\AdminBundle\\Entity\\Room	title	5	Ejecutive Suite
131	en	Daiquiri\\AdminBundle\\Entity\\Room	slug	5	ejecutive-suite
132	en	Daiquiri\\AdminBundle\\Entity\\Room	uniqueSlug	5	5-ejecutive-suite
133	en	Daiquiri\\AdminBundle\\Entity\\Place	title	7	Memories Miramar
134	en	Daiquiri\\AdminBundle\\Entity\\Place	slug	7	memories-miramar
135	en	Daiquiri\\AdminBundle\\Entity\\Place	uniqueSlug	7	7-memories-miramar
136	en	Daiquiri\\AdminBundle\\Entity\\Place	description	7	<p>El comit&eacute; de acci&oacute;n pol&iacute;tica que dirige tiene como objetivo declarado&nbsp;<strong>&ldquo;promover una transici&oacute;n incondicional en Cuba a la democracia, el Estado de derecho y el mercado libre&rdquo;</strong>.</p>\r\n\r\n<p>Aunque este abogado estadounidense ya trabaj&oacute; hace a&ntilde;os como asesor en el Departamento del Tesoro y conoce por tanto la agencia, algunos observadores ven su nombramiento como una se&ntilde;al de que Trump podr&iacute;a estar dispuesto a cumplir su promesa electoral de dar marcha atr&aacute;s a las medidas tomadas por Obama respecto a Cuba.</p>\r\n\r\n<p>Durante las primarias republicanas, Trump fue el &uacute;nico aspirante de su partido que apoyaba la pol&iacute;tica de deshielo, pero fue endureciendo su posici&oacute;n a medida que buscaba votos en Florida en las elecciones generales.</p>
137	en	Daiquiri\\AdminBundle\\Entity\\Place	address	7	5ta Avenida, Miramar, La Habana, Cuba
138	en	Daiquiri\\AdminBundle\\Entity\\HotelSalesAgent	title	7	Agente Ventas Iberostar Varadero
213	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	33	-16
139	en	Daiquiri\\AdminBundle\\Entity\\HotelSalesAgent	slug	7	agente-ventas-iberostar-varadero
140	en	Daiquiri\\AdminBundle\\Entity\\HotelSalesAgent	uniqueSlug	7	7-agente-ventas-iberostar-varadero
141	en	Daiquiri\\AdminBundle\\Entity\\Season	title	8	Season 1 - Iberostar Varadero
142	en	Daiquiri\\AdminBundle\\Entity\\Season	slug	8	season-1-iberostar-varadero
143	en	Daiquiri\\AdminBundle\\Entity\\Season	uniqueSlug	8	8-season-1-iberostar-varadero
144	en	Daiquiri\\AdminBundle\\Entity\\Season	title	9	Season 2 - Iberostar Varadero
145	en	Daiquiri\\AdminBundle\\Entity\\Season	slug	9	season-2-iberostar-varadero
146	en	Daiquiri\\AdminBundle\\Entity\\Season	uniqueSlug	9	9-season-2-iberostar-varadero
147	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	8	Parking
148	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	8	parking-3
149	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	8	8-parking
150	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	9	Pool
151	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	9	pool-3
152	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	9	9-pool
153	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	10	WiFi
154	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	10	wifi-1
159	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	8	WiFi
160	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	8	wifi-2
161	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	8	8-wifi
162	en	Daiquiri\\AdminBundle\\Entity\\Room	title	6	Room Standart - Iberostar Varadero
163	en	Daiquiri\\AdminBundle\\Entity\\Room	slug	6	room-standart-iberostar-varadero
164	en	Daiquiri\\AdminBundle\\Entity\\Room	uniqueSlug	6	6-room-standart-iberostar-varadero
165	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	9	TV
166	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	9	tv-5
167	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	9	9-tv
168	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	10	WiFi
169	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	10	wifi-3
170	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	10	10-wifi
171	en	Daiquiri\\AdminBundle\\Entity\\Room	title	7	Junior Suite-Iberostar Varadero
172	en	Daiquiri\\AdminBundle\\Entity\\Room	slug	7	junior-suite-iberostar-varadero
173	en	Daiquiri\\AdminBundle\\Entity\\Room	uniqueSlug	7	7-junior-suite-iberostar-varadero
174	en	Daiquiri\\AdminBundle\\Entity\\Zone	title	3	Varadero
175	en	Daiquiri\\AdminBundle\\Entity\\Zone	slug	3	varadero
176	en	Daiquiri\\AdminBundle\\Entity\\Zone	uniqueSlug	3	3-varadero
177	en	Daiquiri\\AdminBundle\\Entity\\Place	title	8	Iberostar Varadero
178	en	Daiquiri\\AdminBundle\\Entity\\Place	slug	8	iberostar-varadero
179	en	Daiquiri\\AdminBundle\\Entity\\Place	uniqueSlug	8	8-iberostar-varadero
180	en	Daiquiri\\AdminBundle\\Entity\\Place	description	8	<p>El comit&eacute; de acci&oacute;n pol&iacute;tica que dirige tiene como objetivo declarado&nbsp;<strong>&ldquo;promover una transici&oacute;n incondicional en Cuba a la democracia, el Estado de derecho y el mercado libre&rdquo;</strong>.</p>\r\n\r\n<p>Aunque este abogado estadounidense ya trabaj&oacute; hace a&ntilde;os como asesor en el Departamento del Tesoro y conoce por tanto la agencia, algunos observadores ven su nombramiento como una se&ntilde;al de que Trump podr&iacute;a estar dispuesto a cumplir su promesa electoral de dar marcha atr&aacute;s a las medidas tomadas por Obama respecto a Cuba.</p>\r\n\r\n<p>Durante las primarias republicanas, Trump fue el &uacute;nico aspirante de su partido que apoyaba la pol&iacute;tica de deshielo, pero fue endureciendo su posici&oacute;n a medida que buscaba votos en Florida en las elecciones generales.</p>
181	en	Daiquiri\\AdminBundle\\Entity\\Place	address	8	Península de Hicacos, Varadero, Matanzas Cuba
182	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	17	17
183	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	18	-1
184	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	18	18
185	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	19	-2
186	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	19	19
187	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	20	-3
188	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	20	20
189	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	21	-4
190	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	21	21
191	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	22	-5
192	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	22	22
193	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	23	-6
194	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	23	23
195	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	24	-7
196	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	24	24
197	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	25	-8
198	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	25	25
199	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	26	-9
200	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	26	26
201	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	27	-10
202	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	27	27
203	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	28	-11
204	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	28	28
205	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	29	-12
206	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	29	29
207	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	30	-13
208	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	30	30
209	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	31	-14
210	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	31	31
211	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	32	-15
212	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	32	32
214	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	33	33
215	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	34	-17
216	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	34	34
217	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	35	-18
218	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	35	35
219	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	36	-19
220	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	36	36
221	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	37	-20
222	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	37	37
223	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	38	-21
224	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	38	38
225	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	39	-22
226	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	39	39
227	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	40	-23
228	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	40	40
229	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	41	-24
230	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	41	41
231	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	42	-25
232	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	42	42
233	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	43	-26
234	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	43	43
235	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	44	-27
236	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	44	44
237	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	45	-28
238	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	45	45
239	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	46	-29
240	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	46	46
241	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	47	-30
242	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	47	47
243	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	48	-31
244	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	48	48
245	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	49	-32
246	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	49	49
247	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	50	-33
248	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	50	50
46	en	Daiquiri\\AdminBundle\\Entity\\Room	title	1	Standart-Melia Cohiba
47	en	Daiquiri\\AdminBundle\\Entity\\Room	slug	1	standart-melia-cohiba
48	en	Daiquiri\\AdminBundle\\Entity\\Room	uniqueSlug	1	1-standart-melia-cohiba
86	en	Daiquiri\\AdminBundle\\Entity\\Room	title	2	Room Standart - Melia Habana
87	en	Daiquiri\\AdminBundle\\Entity\\Room	slug	2	room-standart-melia-habana
88	en	Daiquiri\\AdminBundle\\Entity\\Room	uniqueSlug	2	2-room-standart-melia-habana
249	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseType	title	1	Colonial House
250	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseType	slug	1	colonial-house
251	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseType	uniqueSlug	1	1-colonial-house
252	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseType	title	2	City House
253	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseType	slug	2	city-house
254	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseType	uniqueSlug	2	2-city-house
255	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseType	title	3	Country House
256	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseType	slug	3	country-house
257	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseType	uniqueSlug	3	3-country-house
258	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	slug	1	jose-maranon
259	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	uniqueSlug	1	1-jose-maranon
260	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	title	4	TV
261	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	slug	4	tv
262	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	uniqueSlug	4	4-tv
557	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	36	www
558	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	36	wwww
559	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	36	www
266	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacility	title	2	Parking
267	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacility	slug	2	parking
268	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacility	uniqueSlug	2	2-parking
269	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacility	title	3	Pool
270	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacility	slug	3	pool
271	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacility	uniqueSlug	3	3-pool
272	en	Daiquiri\\AdminBundle\\Entity\\Product	title	51	Room 1 - Casa Arcoiris
273	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	51	room-1-casa-arcoiris
274	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	51	51-room-1-casa-arcoiris
275	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	title	1	Casa Arcoiris
276	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	description	1	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>
277	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	slug	1	casa-arcoiris
278	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	uniqueSlug	1	1-casa-arcoiris
279	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	slug	2	junior-quesada
280	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	uniqueSlug	2	2-junior-quesada
281	en	Daiquiri\\AdminBundle\\Entity\\Product	title	52	Room 1 - Los Chinitos
282	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	52	room-1-los-chinitos
283	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	52	52-room-1-los-chinitos
284	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	title	2	Los Chinitos
285	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	description	2	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>
286	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	slug	2	los-chinitos
287	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	uniqueSlug	2	2-los-chinitos
288	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	slug	3	frank-rodriguez
289	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	uniqueSlug	3	3-frank-rodriguez
290	en	Daiquiri\\AdminBundle\\Entity\\Product	title	53	Room1 -Casa Frank
291	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	53	room1-casa-frank
292	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	53	53-room1-casa-frank
293	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	title	3	Casa Frank
294	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	slug	3	casa-frank
295	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	uniqueSlug	3	3-casa-frank
296	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	slug	4	maragarita-perez
297	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	uniqueSlug	4	4-maragarita-perez
298	en	Daiquiri\\AdminBundle\\Entity\\Product	title	54	Cuarto 1  - Maragarita
299	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	54	cuarto-1-maragarita
300	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	54	54-cuarto-1-maragarita
301	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	title	4	Casa Margarita
302	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	description	4	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>
303	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	slug	4	casa-margarita
304	en	Daiquiri\\AdminBundle\\Entity\\RentalHouse	uniqueSlug	4	4-casa-margarita
305	en	Daiquiri\\AdminBundle\\Entity\\Zone	title	4	Trinidad
306	en	Daiquiri\\AdminBundle\\Entity\\Zone	slug	4	trinidad
307	en	Daiquiri\\AdminBundle\\Entity\\Zone	uniqueSlug	4	4-trinidad
308	en	Daiquiri\\AdminBundle\\Entity\\Zone	title	5	Playa Larga
309	en	Daiquiri\\AdminBundle\\Entity\\Zone	slug	5	playa-larga
310	en	Daiquiri\\AdminBundle\\Entity\\Zone	uniqueSlug	5	5-playa-larga
311	en	Daiquiri\\AdminBundle\\Entity\\Zone	title	6	Viñales
312	en	Daiquiri\\AdminBundle\\Entity\\Zone	slug	6	vinales
313	en	Daiquiri\\AdminBundle\\Entity\\Zone	uniqueSlug	6	6-vinales
314	en	Daiquiri\\AdminBundle\\Entity\\Place	title	9	Soroa
315	en	Daiquiri\\AdminBundle\\Entity\\Place	slug	9	soroa
316	en	Daiquiri\\AdminBundle\\Entity\\Place	uniqueSlug	9	9-soroa
323	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	1	Season 1 - Soroa-Viñales
324	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	slug	1	season-1-soroa-vinales
325	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	uniqueSlug	1	1-season-1-soroa-vinales
326	en	Daiquiri\\AdminBundle\\Entity\\Product	title	55	Soroa-Viñales
327	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	55	soroa-vinales
328	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	55	55-soroa-vinales
329	en	Daiquiri\\AdminBundle\\Entity\\Product	description	55	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>
330	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	title	3	La Habana
331	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	slug	3	la-habana
332	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	uniqueSlug	3	3-la-habana
333	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	title	4	Trinidad
334	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	slug	4	trinidad
335	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	uniqueSlug	4	4-trinidad
336	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	2	Sesason 1 -La Habana- Trinidad
337	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	slug	2	sesason-1-la-habana-trinidad
338	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	uniqueSlug	2	2-sesason-1-la-habana-trinidad
339	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	3	Season 2 - La Habana - trinidad
340	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	slug	3	season-2-la-habana-trinidad
341	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	uniqueSlug	3	3-season-2-la-habana-trinidad
342	en	Daiquiri\\AdminBundle\\Entity\\Product	title	56	La Habana - Trinidad
343	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	56	la-habana-trinidad
344	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	56	56-la-habana-trinidad
560	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	36	36-www
561	en	Daiquiri\\AdminBundle\\Entity\\Campaign	description	36	<p>www</p>
565	en	Daiquiri\\ReservationBundle\\Entity\\Gender	title	2	Sr.
345	en	Daiquiri\\AdminBundle\\Entity\\Product	description	56	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>
346	en	Daiquiri\\AdminBundle\\Entity\\Product	remarks	56	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>
347	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	title	5	Dia 1 - Varadero
348	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	slug	5	dia-1-varadero
349	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	uniqueSlug	5	5-dia-1-varadero
350	en	Daiquiri\\AdminBundle\\Entity\\Place	title	10	Varadero
351	en	Daiquiri\\AdminBundle\\Entity\\Place	slug	10	varadero
352	en	Daiquiri\\AdminBundle\\Entity\\Place	uniqueSlug	10	10-varadero
353	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	title	6	Dia 2
354	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	slug	6	dia-2
355	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	uniqueSlug	6	6-dia-2
356	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	4	Season 1 - Varadero
357	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	slug	4	season-1-varadero
358	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	uniqueSlug	4	4-season-1-varadero
359	en	Daiquiri\\AdminBundle\\Entity\\Product	title	57	La Habana - Varadero
360	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	57	la-habana-varadero
361	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	57	57-la-habana-varadero
362	en	Daiquiri\\AdminBundle\\Entity\\Product	description	57	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>
363	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	1	El mejor
364	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	1	el mejor de los circuits
365	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	1	book now
366	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	1	el-mejor
367	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	1	1-el-mejor
368	en	Daiquiri\\AdminBundle\\Entity\\Package	description	1	<p>Cuba-Italia</p>
369	en	Daiquiri\\AdminBundle\\Entity\\Package	slug	1	cuba-italia
370	en	Daiquiri\\AdminBundle\\Entity\\Package	uniqueSlug	1	1-cuba-italia
371	en	Daiquiri\\AdminBundle\\Entity\\Polo	slug	5	florencia
372	en	Daiquiri\\AdminBundle\\Entity\\Polo	uniqueSlug	5	5-florencia
373	en	Daiquiri\\AdminBundle\\Entity\\Polo	slug	6	venecia
374	en	Daiquiri\\AdminBundle\\Entity\\Polo	uniqueSlug	6	6-venecia
386	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	3	the best
387	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	3	the best
388	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	3	book now
389	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	3	the-best
390	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	3	3-the-best
562	en	Daiquiri\\ReservationBundle\\Entity\\Gender	title	1	Mr.
563	en	Daiquiri\\ReservationBundle\\Entity\\Gender	slug	1	mr
391	en	Daiquiri\\AdminBundle\\Entity\\Campaign	description	3	<p>mira</p>\r\n\r\n<p>el correo es este</p>\r\n\r\n<p>perate q el correo lo perdi</p>\r\n\r\n<p>pq me formatearon esta mierda</p>\r\n\r\n<p>dejame darte el cell dl hermano d las q la saca</p>\r\n\r\n<p>53987991</p>\r\n\r\n<p>.adrian se llama</p>\r\n\r\n<p>dile q te dio el contacto una m,uchacha q su hermana me saco la cita</p>\r\n\r\n<p>yo pague 100</p>\r\n\r\n<p>pero fue en mayo</p>\r\n\r\n<p>tengo otro q tambien las saca pero ese me cobraba 200</p>\r\n\r\n<p>el contacto es este por si lo quieres tambien</p>\r\n\r\n<p>53577811</p>\r\n\r\n<p>yoani se llama este</p>
392	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	4	best excursion
393	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	4	best excursion
394	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	4	best excursion
395	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	4	best-excursion
396	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	4	4-best-excursion
397	en	Daiquiri\\AdminBundle\\Entity\\Campaign	description	4	<p>best excursion</p>
398	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	5	best colective excursion
399	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	5	best colective excursion
401	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	5	best-colective-excursion
402	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	5	5-best-colective-excursion
403	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	6	best excursion colective
404	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	6	best excursion colective
405	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	6	best excursion colective
406	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	6	best-excursion-colective
407	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	6	6-best-excursion-colective
408	en	Daiquiri\\AdminBundle\\Entity\\Campaign	description	6	<p>-&gt;add(&#39;campaigns&#39;)</p>
409	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	7	el mejor transfer
410	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	7	the bst
411	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	7	boo now
412	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	7	el-mejor-transfer
413	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	7	7-el-mejor-transfer
414	en	Daiquiri\\AdminBundle\\Entity\\Campaign	description	7	<p>https://www.facebook.com/loquesedicenet/videos/779978135475743/</p>
415	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	8	exclusivo del 31
416	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	8	exclusivo del 31
417	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	8	exclusivo del 31
418	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	8	exclusivo-del-31
419	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	8	8-exclusivo-del-31
420	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	9	the best room
421	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	9	the best room
422	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	9	book now
423	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	9	the-best-room
424	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	9	9-the-best-room
263	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacility	title	1	TV de 32 inch
264	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacility	slug	1	tv-de-32-inch
265	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacility	uniqueSlug	1	1-tv-de-32-inch
564	en	Daiquiri\\ReservationBundle\\Entity\\Gender	uniqueSlug	1	1-mr
566	en	Daiquiri\\ReservationBundle\\Entity\\Gender	slug	2	sr
567	en	Daiquiri\\ReservationBundle\\Entity\\Gender	uniqueSlug	2	2-sr
568	en	Daiquiri\\AdminBundle\\Entity\\Country	title	2	United States
569	en	Daiquiri\\AdminBundle\\Entity\\Country	slug	2	united-states
570	en	Daiquiri\\AdminBundle\\Entity\\Country	uniqueSlug	2	2-united-states
400	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	5	book now mother fucker
571	en	Daiquiri\\AdminBundle\\Entity\\Place	description	5	<p>W3Schools is optimized for learning, testing, and training. Examples might be simplified to improve reading and basic understanding. Tutorials, references, and examples are constantly reviewed to avoid errors, but we cannot warrant full correctness of all content. While using this site, you agree to have read and accepted our <a href="http://www.w3schools.com/about/about_copyright.asp">terms of use</a>, <a href="http://www.w3schools.com/about/about_privacy.asp">cookie </a>by Refsnes Data. All Rights Reserved.<br />\r\n<br />\r\n&nbsp;</p>
572	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	title	5	WIFI
573	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	slug	5	wifi-1
574	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseFacilityType	uniqueSlug	5	5-wifi
575	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	title	11	wifi en todo el lobby
576	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	slug	11	wifi-en-todo-el-lobby
577	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	uniqueSlug	11	11-wifi-en-todo-el-lobby
578	en	Daiquiri\\AdminBundle\\Entity\\HotelFacility	description	11	<p>wifi en todo el lobby description</p>
579	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	title	11	Spa
580	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	slug	11	spa
581	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseRoomFacility	uniqueSlug	11	11-spa
582	en	Daiquiri\\AdminBundle\\Entity\\Product	include	5	<p>include un almuerzo</p>
583	en	Daiquiri\\AdminBundle\\Entity\\Product	notinclude	5	<p>no incluye liquidos</p>
589	en	Daiquiri\\AdminBundle\\Entity\\Place	description	3	<p>&nbsp;</p>\r\n\r\n<p>El santuario consiste en una explanada y un patio limitado por una gran terraza amurallada de piedra caliza que sostiene un monumental podio, que estuvo rematado por un templo de m&aacute;rmol dedicado al dios en estilo grecorromano con influencias persas. El antiguo santuario conserva una serie de cisternas para abluciones rituales alimentadas por canales de agua desde el &laquo;r&iacute;o de Asclepio&raquo; (el actual Awali) y desde el manantial sagrado de &laquo;Ydll&raquo;. Estas instalaciones fueron usadas para los fines terap&eacute;uticos y purificadores que caracterizaban el culto de Eshm&uacute;n. Las excavaciones en el templo han proporcionado muchos artefactos de valor, entre los que destacan especialmente los grabados con textos fenicios, que han proporcionado informaci&oacute;n valiosa sobre la historia del lugar y de la antigua Sid&oacute;n</p>
590	en	Daiquiri\\AdminBundle\\Entity\\Place	description	9	<p>Hola Adri, me podrias decir c&oacute;mo configurar Paypal (cuenta business) con Magento 1.4.1.1, porque estoy intentando capturar los datos desde la administraci&oacute;n de Magento en la secci&oacute;n de PayPal, y cuando me registro con mi usuario de paypal me dice lo siguiente: &quot;Tiene un certificado API en lugar de una firma API. Para obtener una firma API, debe quitar las credenciales API actuales. Para recibir ayuda con este proceso, p&oacute;ngase en contacto con 1-866-888-4178&quot;<br />\r\n&iquest;&iquest;&iquest; Sabes que es lo que falta/sobra ???</p>
591	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	5	SEASON 2
592	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	slug	5	season-2
593	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	uniqueSlug	5	5-season-2
594	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	6	season de prueba
595	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	slug	6	season-de-prueba
596	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	uniqueSlug	6	6-season-de-prueba
600	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	10	s2
601	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	11	qw
602	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	12	e3
603	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	13	Alta
604	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	14	qw
605	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	15	12
606	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	16	22
607	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	17	asd
608	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	title	7	sasas
609	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	slug	7	sasas
610	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	uniqueSlug	7	7-sasas
611	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	18	qw
612	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	19	sasd
613	en	Daiquiri\\AdminBundle\\Entity\\Document	title	1	licencia
614	en	Daiquiri\\AdminBundle\\Entity\\Document	slug	1	licencia
615	en	Daiquiri\\AdminBundle\\Entity\\Document	uniqueSlug	1	1-licencia
616	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	20	alta
617	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	21	asdas
618	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	22	asd
619	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	23	una
620	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	title	8	asd
621	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	slug	8	asd
622	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	uniqueSlug	8	8-asd
623	en	Daiquiri\\AdminBundle\\Entity\\Product	title	59	as
624	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	59	as
625	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	59	59-as
627	en	Daiquiri\\AdminBundle\\Entity\\Product	title	60	11
628	en	Daiquiri\\AdminBundle\\Entity\\Product	slug	60	11
629	en	Daiquiri\\AdminBundle\\Entity\\Product	uniqueSlug	60	60-11
630	en	Daiquiri\\AdminBundle\\Entity\\Document	title	2	pasaporte
631	en	Daiquiri\\AdminBundle\\Entity\\Document	slug	2	pasaporte
632	en	Daiquiri\\AdminBundle\\Entity\\Document	uniqueSlug	2	2-pasaporte
634	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	title	9	11
635	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	slug	9	11
636	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	uniqueSlug	9	9-11
637	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	26	22
639	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	28	12
640	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	title	10	123
641	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	slug	10	123
642	en	Daiquiri\\AdminBundle\\Entity\\CircuitDay	uniqueSlug	10	10-123
645	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	31	4
646	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	32	11
647	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	slug	5	tony-tony
648	en	Daiquiri\\AdminBundle\\Entity\\RentalHouseOwner	uniqueSlug	5	5-tony-tony
656	en	Daiquiri\\AdminBundle\\Entity\\CircuitSeason	title	34	ALTA Apr 1, 2017 - Apr 30, 2017
657	en	Daiquiri\\AdminBundle\\Entity\\Country	title	3	Cuba
658	en	Daiquiri\\AdminBundle\\Entity\\Country	slug	3	cuba-1
659	en	Daiquiri\\AdminBundle\\Entity\\Country	uniqueSlug	3	3-cuba
660	en	Daiquiri\\AdminBundle\\Entity\\Market	title	3	RUSIA
661	en	Daiquiri\\AdminBundle\\Entity\\Campaign	title	37	ofer to soroa vinales
662	en	Daiquiri\\AdminBundle\\Entity\\Campaign	subtitle	37	ofer to soroa vinales
663	en	Daiquiri\\AdminBundle\\Entity\\Campaign	caption	37	book now
664	en	Daiquiri\\AdminBundle\\Entity\\Campaign	slug	37	ofer-to-soroa-vinales
665	en	Daiquiri\\AdminBundle\\Entity\\Campaign	uniqueSlug	37	37-ofer-to-soroa-vinales
666	en	Daiquiri\\AdminBundle\\Entity\\Campaign	description	37	<p>ofer to soroa vinales</p>
\.


--
-- TOC entry 4479 (class 0 OID 0)
-- Dependencies: 268
-- Name: ext_translations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('ext_translations_id_seq', 669, true);


--
-- TOC entry 4423 (class 0 OID 268203)
-- Dependencies: 421
-- Data for Name: faq; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY faq (id, title, description, vote, priority) FROM stdin;
\.


--
-- TOC entry 4480 (class 0 OID 0)
-- Dependencies: 420
-- Name: faq_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('faq_id_seq', 1, false);


--
-- TOC entry 4271 (class 0 OID 261567)
-- Dependencies: 269
-- Data for Name: flight; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY flight (id, airline, title, slug, unique_slug, description) FROM stdin;
\.


--
-- TOC entry 4481 (class 0 OID 0)
-- Dependencies: 270
-- Name: flight_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('flight_id_seq', 1, false);


--
-- TOC entry 4273 (class 0 OID 261577)
-- Dependencies: 271
-- Data for Name: flights_airports; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY flights_airports (flight_id, airport_id) FROM stdin;
\.


--
-- TOC entry 4274 (class 0 OID 261580)
-- Dependencies: 272
-- Data for Name: fos_user_group; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY fos_user_group (id, name, roles) FROM stdin;
\.


--
-- TOC entry 4482 (class 0 OID 0)
-- Dependencies: 273
-- Name: fos_user_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('fos_user_group_id_seq', 1, false);


--
-- TOC entry 4276 (class 0 OID 261588)
-- Dependencies: 274
-- Data for Name: fos_user_user; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code) FROM stdin;
\.


--
-- TOC entry 4277 (class 0 OID 261616)
-- Dependencies: 275
-- Data for Name: fos_user_user_group; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY fos_user_user_group (user_id, group_id) FROM stdin;
\.


--
-- TOC entry 4483 (class 0 OID 0)
-- Dependencies: 276
-- Name: fos_user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('fos_user_user_id_seq', 1, false);


--
-- TOC entry 4279 (class 0 OID 261621)
-- Dependencies: 277
-- Data for Name: gender; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY gender (id, title, slug, unique_slug) FROM stdin;
1	Mr.	mr	1-mr
2	Sr.	sr	2-sr
\.


--
-- TOC entry 4484 (class 0 OID 0)
-- Dependencies: 278
-- Name: gender_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('gender_id_seq', 2, true);


--
-- TOC entry 4281 (class 0 OID 261630)
-- Dependencies: 279
-- Data for Name: hotel; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY hotel (id, zone, chainid, term_condition_hotel, cancelation_hotel, product_increment, stars, address, email, website, phone, mount_c, mount_cc, ai, allow_infant, available, priority, payonline, review_available, remarks, hoteltype) FROM stdin;
5	1	1	\N	\N	\N	5	La Habana, Malecón, Cuba	meliacohiba@daiquiricuba.com	http://www.meliacohiba.com	58475531	200	54	t	t	t	0	t	t	\N	1
6	2	1	\N	\N	\N	5	3ra Avenida, Mirarmar, La Habana, Cuba	meliahabana@daiquiricuba.com	http://www.meliahabana.com	58475531	78	68	t	t	t	1	t	t	\N	1
7	2	4	\N	\N	\N	4	5ta Avenida, Miramar, La Habana, Cuba	memmoriesmiramar@daiquiricuba.com	http://www.memoriesmiramar.com	58475531	89	45	t	t	t	3	t	t	\N	1
8	3	2	\N	\N	\N	5	Península de Hicacos, Varadero, Matanzas Cuba	iberostarvaradero@daiquiricuba.com	http://iberostarvaradero.com	58475531	78	68	t	t	t	5	t	t	\N	2
\.


--
-- TOC entry 4282 (class 0 OID 261641)
-- Dependencies: 280
-- Data for Name: hotel_facility; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY hotel_facility (id, hotelid, picture, gallery, hotelfacilitytype_id, title, description, slug, unique_slug) FROM stdin;
1	5	\N	\N	1	Parking	\N	parking	1-parking
2	5	\N	\N	2	Pool	\N	pool	2-pool
3	6	\N	\N	2	Pool	\N	pool-1	3-pool
4	6	\N	\N	1	Parking	\N	parking-1	4-parking
5	7	\N	\N	3	WiFi	\N	wifi	5-wifi
6	7	\N	\N	1	Parking	\N	parking-2	6-parking
7	7	\N	\N	2	Pool	\N	pool-2	7-pool
8	8	\N	\N	1	Parking	\N	parking-3	8-parking
9	8	\N	\N	2	Pool	\N	pool-3	9-pool
10	8	\N	\N	3	WiFi	\N	wifi-1	10-wifi
11	5	\N	\N	5	wifi en todo el lobby	\N	wifi-en-todo-el-lobby	11-wifi-en-todo-el-lobby
\.


--
-- TOC entry 4485 (class 0 OID 0)
-- Dependencies: 281
-- Name: hotel_facility_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('hotel_facility_id_seq', 11, true);


--
-- TOC entry 4284 (class 0 OID 261651)
-- Dependencies: 282
-- Data for Name: hotel_price; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY hotel_price (id, season, room, base, individual, chindividual, three, adult1, adult2, adult3, chthree) FROM stdin;
4	5	3	150	35	1	25	202.5	300	412.5	1
5	4	3	78	25	1	15	97.5	156	222.300000000000011	1
6	5	2	145	10	1	5	159.5	290	427.75	1
7	4	2	200	15	1	10	230	400	580	1
8	7	5	230	42	1	25	326.600000000000023	460	632.5	1
9	6	5	95	5	1	10	99.75	190	275.5	1
10	7	4	60	50	1	25	90	120	165	1
11	6	4	89	70	1	60	151.300000000000011	178	213.599999999999994	1
12	9	7	124	35	1	45	167.400000000000006	248	316.199999999999989	1
13	8	7	200	50	1	25	300	400	550	1
14	1	1	85	45	1	5	123.25	170	250.75	1
23	2	1	100	15	1	10	115	200	290	1
24	3	1	85	15	2	25	100	170	233.75	1
\.


--
-- TOC entry 4486 (class 0 OID 0)
-- Dependencies: 283
-- Name: hotel_price_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('hotel_price_id_seq', 24, true);


--
-- TOC entry 4286 (class 0 OID 261659)
-- Dependencies: 284
-- Data for Name: hotel_sales_agent; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY hotel_sales_agent (id, picture, hotelid, title, slug, unique_slug, name, lastname, phone1, phone, email) FROM stdin;
1	11	5	Agente Ventas Melia Cohiba	agente-ventas-melia-cohiba	1-agente-ventas-melia-cohiba	Eliecer	Sanchez	58475531	72015532	lolo1@uci.cu
6	18	7	Agente de Ventas - Memories Miramar	agente-de-ventas-memories-miramar	6-agente-de-ventas-memories-miramar	Juan	Fernandez	58475531	58475531	juan@daiquiricuba.com
7	20	8	Agente Ventas Iberostar Varadero	agente-ventas-iberostar-varadero	7-agente-ventas-iberostar-varadero	Pepe	Guzman	58475531	58475531	pepe@daiquiricuba.com
\.


--
-- TOC entry 4487 (class 0 OID 0)
-- Dependencies: 285
-- Name: hotel_sales_agent_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('hotel_sales_agent_id_seq', 7, true);


--
-- TOC entry 4288 (class 0 OID 261671)
-- Dependencies: 286
-- Data for Name: hotel_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY hotel_type (id, title, description, slug, unique_slug) FROM stdin;
1	City Hotel	\N	city-hotel	1-city-hotel
2	Beach Hotel	\N	beach-hotel	2-beach-hotel
3	Country Hotel	\N	country-hotel	3-country-hotel
\.


--
-- TOC entry 4488 (class 0 OID 0)
-- Dependencies: 287
-- Name: hotel_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('hotel_type_id_seq', 3, true);


--
-- TOC entry 4290 (class 0 OID 261681)
-- Dependencies: 288
-- Data for Name: kid_policy; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY kid_policy (id, hotelprice_id, ocupation_id, kid1, kid1_choice, kid2, kid2_choice, kid3, kid3_choice, kid4, kid4_choice, price, campaignhotel_id) FROM stdin;
534	23	22	0	1	0	1	0	1	0	1	100	\N
535	23	23	0	1	0	1	0	1	0	1	400	\N
536	23	18	0	1	0	1	0	1	0	1	200	\N
537	23	19	0	1	0	1	0	1	0	1	300	\N
538	23	20	0	1	0	1	0	1	0	1	300	\N
539	23	21	0	1	0	1	0	1	0	1	390	\N
540	23	17	0	1	0	1	0	1	0	1	115	\N
22	4	25	20	1	0	1	0	1	0	1	270	\N
23	4	27	20	1	0	1	0	1	0	1	420	\N
24	4	24	0	1	0	1	0	1	0	1	202.5	\N
25	4	26	0	1	0	1	0	1	0	1	300	\N
26	4	28	0	1	0	1	0	1	0	1	412.5	\N
27	5	25	20	1	0	1	0	1	0	1	140.400000000000006	\N
28	5	27	30	1	0	1	0	1	0	1	210.599999999999994	\N
29	5	24	0	1	0	1	0	1	0	1	97.5	\N
30	5	26	0	1	0	1	0	1	0	1	156	\N
31	5	28	0	1	0	1	0	1	0	1	222.300000000000011	\N
32	6	32	10	1	15	1	20	1	25	1	478.5	\N
33	6	29	5	1	10	1	0	1	0	1	413.25	\N
34	6	30	10	1	0	1	0	1	0	1	420.5	\N
35	6	31	0	1	0	1	0	1	0	1	427.75	\N
36	7	32	8	1	16	1	20	1	24	1	664	\N
37	7	29	5	1	10	1	0	1	0	1	570	\N
38	7	30	15	1	0	1	0	1	0	1	570	\N
39	7	31	0	1	0	1	0	1	0	1	580	\N
40	8	40	20	1	15	1	0	1	0	1	379.5	\N
41	8	41	10	1	15	1	20	1	0	1	586.5	\N
42	8	34	15	1	0	1	0	1	0	1	425.5	\N
43	8	35	20	1	20	1	0	1	0	1	598	\N
44	8	36	50	1	55	1	75	1	0	1	506	\N
45	8	38	25	1	0	1	0	1	0	1	632.5	\N
46	8	33	0	1	0	1	0	1	0	1	326.600000000000023	\N
47	8	37	0	1	0	1	0	1	0	1	460	\N
48	8	39	0	1	0	1	0	1	0	1	632.5	\N
49	9	40	45	1	50	1	0	1	0	1	99.75	\N
50	9	41	55	1	60	1	65	1	0	1	114	\N
51	9	34	20	1	0	1	0	1	0	1	171	\N
52	9	35	10	1	15	1	0	1	0	1	261.25	\N
53	9	36	5	1	10	1	15	1	0	1	351.5	\N
54	9	38	25	1	0	1	0	1	0	1	261.25	\N
55	9	33	0	1	0	1	0	1	0	1	99.75	\N
56	9	37	0	1	0	1	0	1	0	1	190	\N
57	9	39	0	1	0	1	0	1	0	1	275.5	\N
58	10	43	40	1	0	1	0	1	0	1	96	\N
59	10	44	50	1	0	1	0	1	0	1	150	\N
60	10	42	0	1	0	1	0	1	0	1	90	\N
61	10	45	0	1	0	1	0	1	0	1	165	\N
62	11	43	12	1	0	1	0	1	0	1	167.319999999999993	\N
63	11	44	16	1	0	1	0	1	0	1	252.759999999999991	\N
64	11	42	0	1	0	1	0	1	0	1	151.300000000000011	\N
65	11	45	0	1	0	1	0	1	0	1	213.599999999999994	\N
66	12	47	10	1	0	1	0	1	0	1	359.600000000000023	\N
67	12	46	0	1	0	1	0	1	0	1	167.400000000000006	\N
68	13	47	15	1	0	1	0	1	0	1	570	\N
69	13	46	0	1	0	1	0	1	0	1	300	\N
356	\N	22	0	1	0	1	0	1	0	1	0	\N
357	\N	23	0	1	0	1	0	1	0	1	0	\N
358	\N	18	0	1	0	1	0	1	0	1	0	\N
359	\N	19	0	1	0	1	0	1	0	1	0	\N
360	\N	20	0	1	0	1	0	1	0	1	0	\N
361	\N	21	0	1	0	1	0	1	0	1	0	\N
368	\N	22	0	1	0	1	0	1	0	1	0	\N
369	\N	23	0	1	0	1	0	1	0	1	0	\N
370	\N	18	0	1	0	1	0	1	0	1	0	\N
371	\N	19	0	1	0	1	0	1	0	1	0	\N
372	\N	20	0	1	0	1	0	1	0	1	0	\N
373	\N	21	0	1	0	1	0	1	0	1	0	\N
386	\N	22	0	1	0	1	0	1	0	1	0	\N
387	\N	23	0	1	0	1	0	1	0	1	0	\N
388	\N	18	0	1	0	1	0	1	0	1	0	\N
389	\N	19	0	1	0	1	0	1	0	1	0	\N
390	\N	20	0	1	0	1	0	1	0	1	0	\N
391	\N	21	0	1	0	1	0	1	0	1	0	\N
398	\N	22	0	1	0	1	0	1	0	1	0	\N
399	\N	23	0	1	0	1	0	1	0	1	0	\N
400	\N	18	0	1	0	1	0	1	0	1	0	\N
401	\N	19	0	1	0	1	0	1	0	1	0	\N
402	\N	20	0	1	0	1	0	1	0	1	0	\N
403	\N	21	0	1	0	1	0	1	0	1	0	\N
422	\N	22	0	1	0	1	0	1	0	1	0	\N
423	\N	23	0	1	0	1	0	1	0	1	0	\N
424	\N	18	0	1	0	1	0	1	0	1	0	\N
425	\N	19	0	1	0	1	0	1	0	1	0	\N
426	\N	20	0	1	0	1	0	1	0	1	0	\N
427	\N	21	0	1	0	1	0	1	0	1	0	\N
428	\N	22	0	1	0	1	0	1	0	1	0	\N
429	\N	23	0	1	0	1	0	1	0	1	0	\N
430	\N	18	0	1	0	1	0	1	0	1	0	\N
431	\N	19	0	1	0	1	0	1	0	1	0	\N
432	\N	20	0	1	0	1	0	1	0	1	0	\N
433	\N	21	0	1	0	1	0	1	0	1	0	\N
145	\N	47	0	1	0	1	0	1	0	1	0	\N
146	\N	18	0	1	0	1	0	1	0	1	0	\N
147	\N	19	0	1	0	1	0	1	0	1	0	\N
148	\N	20	0	1	0	1	0	1	0	1	0	\N
149	\N	21	0	1	0	1	0	1	0	1	0	\N
150	\N	22	0	1	0	1	0	1	0	1	0	\N
151	\N	23	0	1	0	1	0	1	0	1	0	\N
152	\N	18	0	1	0	1	0	1	0	1	0	\N
153	\N	19	0	1	0	1	0	1	0	1	0	\N
154	\N	20	0	1	0	1	0	1	0	1	0	\N
155	\N	21	0	1	0	1	0	1	0	1	0	\N
156	\N	22	0	1	0	1	0	1	0	1	0	\N
157	\N	23	0	1	0	1	0	1	0	1	0	\N
446	\N	22	14	1	0	1	0	1	0	1	0	\N
447	\N	23	10	1	25	1	25	1	45	1	0	\N
448	\N	18	20	1	0	1	0	1	0	1	0	\N
449	\N	19	15	1	25	1	0	1	0	1	0	\N
450	\N	20	10	1	0	1	0	1	0	1	0	\N
451	\N	21	50	1	0	1	0	1	0	1	0	\N
452	\N	17	0	1	0	1	0	1	0	1	0	\N
465	\N	22	10	1	0	1	0	1	0	1	0	36
466	\N	23	10	1	10	1	10	1	10	1	0	36
467	\N	18	10	1	0	1	0	1	0	1	0	36
468	\N	19	10	1	10	1	0	1	0	1	0	36
469	\N	20	10	1	0	1	0	1	0	1	0	36
470	\N	21	10	1	0	1	0	1	0	1	0	36
471	14	22	10	1	0	1	0	1	0	1	76.5	\N
472	14	23	25	1	45	1	55	1	8	1	226.949999999999989	\N
473	14	18	12	1	0	1	0	1	0	1	159.800000000000011	\N
474	14	19	15	1	20	1	0	1	0	1	225.25	\N
475	14	20	10	1	0	1	0	1	0	1	246.5	\N
476	14	21	25	1	0	1	0	1	0	1	314.5	\N
477	14	17	0	1	0	1	0	1	0	1	123.25	\N
541	24	22	14	1	0	1	0	1	0	1	73.0999999999999943	\N
542	24	23	10	1	25	1	25	1	45	1	250.75	\N
543	24	18	20	1	0	1	0	1	0	1	153	\N
544	24	19	15	1	25	1	0	1	0	1	221	\N
545	24	20	10	1	0	1	0	1	0	1	246.5	\N
546	24	21	50	1	0	1	0	1	0	1	276.25	\N
547	24	17	0	1	0	1	0	1	0	1	100	\N
\.


--
-- TOC entry 4489 (class 0 OID 0)
-- Dependencies: 289
-- Name: kid_policy_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('kid_policy_id_seq', 547, true);


--
-- TOC entry 4292 (class 0 OID 261687)
-- Dependencies: 290
-- Data for Name: luggage_capacity; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY luggage_capacity (id, title, slug, unique_slug) FROM stdin;
1	2	2	1-2
2	3	3	2-3
3	4	4	3-4
4	5	5	4-5
5	6	6	5-6
\.


--
-- TOC entry 4490 (class 0 OID 0)
-- Dependencies: 291
-- Name: luggage_capacity_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('luggage_capacity_id_seq', 5, true);


--
-- TOC entry 4294 (class 0 OID 261695)
-- Dependencies: 292
-- Data for Name: market; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY market (id, title, increment) FROM stdin;
1	DEFAULT	0
3	RUSIA	10
\.


--
-- TOC entry 4295 (class 0 OID 261698)
-- Dependencies: 293
-- Data for Name: market_campaigns; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY market_campaigns (campaign_id, market_id) FROM stdin;
1	1
3	1
4	1
5	1
6	1
7	1
8	1
9	1
36	1
37	3
\.


--
-- TOC entry 4491 (class 0 OID 0)
-- Dependencies: 294
-- Name: market_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('market_id_seq', 3, true);


--
-- TOC entry 4297 (class 0 OID 261703)
-- Dependencies: 295
-- Data for Name: media__gallery; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY media__gallery (id, name, context, default_format, enabled, updated_at, created_at) FROM stdin;
1	hunday	daiquiri	daiquiri_800x600	t	2016-11-14 01:43:14	2016-11-14 01:43:14
2	renault	daiquiri	daiquiri_800x600	t	2016-11-14 01:45:10	2016-11-14 01:45:10
3	audia8	daiquiri	daiquiri_800x600	t	2016-11-14 01:48:01	2016-11-14 01:48:01
4	soroa galerry	daiquiri	daiquiri_40x40	t	2017-01-17 17:02:52	2017-01-17 16:58:43
\.


--
-- TOC entry 4492 (class 0 OID 0)
-- Dependencies: 296
-- Name: media__gallery_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('media__gallery_id_seq', 4, true);


--
-- TOC entry 4299 (class 0 OID 261711)
-- Dependencies: 297
-- Data for Name: media__gallery_media; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY media__gallery_media (id, gallery_id, media_id, "position", enabled, updated_at, created_at) FROM stdin;
1	1	1	1	t	2016-11-14 01:43:14	2016-11-14 01:43:14
2	1	2	2	t	2016-11-14 01:43:14	2016-11-14 01:43:14
3	2	4	1	t	2016-11-14 01:45:10	2016-11-14 01:45:10
4	2	5	2	t	2016-11-14 01:45:10	2016-11-14 01:45:10
5	3	7	1	t	2016-11-14 01:48:01	2016-11-14 01:48:01
6	3	8	2	t	2016-11-14 01:48:01	2016-11-14 01:48:01
8	4	39	2	t	2017-01-17 17:02:52	2017-01-17 17:02:52
9	4	40	3	t	2017-01-17 17:02:52	2017-01-17 17:02:52
7	4	38	1	t	2017-01-17 17:02:52	2017-01-17 16:58:43
\.


--
-- TOC entry 4493 (class 0 OID 0)
-- Dependencies: 298
-- Name: media__gallery_media_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('media__gallery_media_id_seq', 9, true);


--
-- TOC entry 4301 (class 0 OID 261716)
-- Dependencies: 299
-- Data for Name: media__media; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY media__media (id, category_id, name, description, enabled, provider_name, provider_status, provider_reference, provider_metadata, width, height, length, content_type, content_size, copyright, author_name, context, cdn_is_flushable, cdn_flush_identifier, cdn_flush_at, cdn_status, updated_at, created_at) FROM stdin;
1	1	slide-22_2016_01_20_152239.jpg	\N	f	sonata.media.provider.image	1	e8f335e5a14870ef5d4ae95be2194fa19a6f2a32.jpeg	{"filename":"slide-22_2016_01_20_152239.jpg"}	482	360	\N	image/jpeg	49340	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:42:57	2016-11-14 01:42:57
2	1	slide-22_2016_01_20_153128.jpg	\N	f	sonata.media.provider.image	1	5becd076e6f363163c19b660228ce941a5dbf5e5.jpeg	{"filename":"slide-22_2016_01_20_153128.jpg"}	482	360	\N	image/jpeg	49340	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:43:10	2016-11-14 01:43:10
3	1	slide-22_2016_01_20_152143.jpg	\N	f	sonata.media.provider.image	1	825fc23da517ce22b99df3b38ab713e6af881d52.jpeg	{"filename":"slide-22_2016_01_20_152143.jpg"}	482	360	\N	image/jpeg	49340	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:43:27	2016-11-14 01:43:27
4	1	slide-18_2016_01_20_154139.jpg	\N	f	sonata.media.provider.image	1	9fd91cefd205ee089c94eee6bebbf68cd272bb96.jpeg	{"filename":"slide-18_2016_01_20_154139.jpg"}	482	360	\N	image/jpeg	49920	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:44:41	2016-11-14 01:44:41
5	1	car_51_2016_01_20_154139.jpg	\N	f	sonata.media.provider.image	1	6f653894360c30f56aff510d53bb9bf679142d1f.jpeg	{"filename":"car_51_2016_01_20_154139.jpg"}	470	410	\N	image/jpeg	36377	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:45:05	2016-11-14 01:45:05
6	1	car_61_2016_01_20_164203.jpg	\N	f	sonata.media.provider.image	1	5d5f3f48e58768777af358d06615d5958ea3d2bf.jpeg	{"filename":"car_61_2016_01_20_164203.jpg"}	470	410	\N	image/jpeg	52814	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:45:27	2016-11-14 01:45:27
7	1	slide-22_2016_01_20_160105.jpg	\N	f	sonata.media.provider.image	1	ab351561b428d67bfc7fceae251757218428eb37.jpeg	{"filename":"slide-22_2016_01_20_160105.jpg"}	482	360	\N	image/jpeg	40462	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:47:27	2016-11-14 01:47:27
8	1	car_54_2016_01_20_160105.jpg	\N	f	sonata.media.provider.image	1	ade74d070388eaa2eddd144a1496b557f7b95d2a.jpeg	{"filename":"car_54_2016_01_20_160105.jpg"}	470	410	\N	image/jpeg	41865	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:47:54	2016-11-14 01:47:54
9	1	slide-24_2016_01_20_163606.jpg	\N	f	sonata.media.provider.image	1	4e63dbef8d59ce9b0517a410be470252739fd70b.jpeg	{"filename":"slide-24_2016_01_20_163606.jpg"}	482	360	\N	image/jpeg	48034	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:48:14	2016-11-14 01:48:14
10	1	car_54_2016_01_20_163219.jpg	\N	f	sonata.media.provider.image	1	ee7700530994caeb211556f596e9cbf1a74453fb.jpeg	{"filename":"car_54_2016_01_20_163219.jpg"}	470	410	\N	image/jpeg	48989	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-14 01:49:07	2016-11-14 01:49:07
11	1	avatar.PNG	\N	f	sonata.media.provider.image	1	206f55387a2edffcb489af097cefd1919782d106.png	{"filename":"avatar.PNG"}	337	363	\N	image/png	89388	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 11:48:42	2016-11-22 11:48:42
12	1	0.jpg	\N	f	sonata.media.provider.image	1	d519a867bb718cbea2f8eb9e25aafde8d5cecb04.jpeg	{"filename":"0.jpg"}	729	560	\N	image/jpeg	45880	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 12:07:31	2016-11-22 12:07:31
17	1	0.jpg	\N	f	sonata.media.provider.image	1	c8a115379b720ba8f123e3c8cccd805d04747048.jpeg	{"filename":"0.jpg"}	550	364	\N	image/jpeg	40322	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 12:19:48	2016-11-22 12:19:48
18	1	yo.png	\N	f	sonata.media.provider.image	1	fa38598e72d8f66cd6b4f029f679c155cabf0130.png	{"filename":"yo.png"}	260	310	\N	image/png	175705	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 12:25:21	2016-11-22 12:25:21
19	1	0.jpg	\N	f	sonata.media.provider.image	1	c892ae3f24866901e527597b6c76e0b61ba4e86c.jpeg	{"filename":"0.jpg"}	550	377	\N	image/jpeg	55447	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 12:33:10	2016-11-22 12:33:10
20	1	avatar3.jpg	\N	f	sonata.media.provider.image	1	01514c92daf7ae87cb04c1877c5d5c3a95d8f432.jpeg	{"filename":"avatar3.jpg"}	144	108	\N	image/jpeg	11983	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 12:39:07	2016-11-22 12:39:07
21	1	0.jpg	\N	f	sonata.media.provider.image	1	d3660827351d6fd9a60625422dcb3a20260a8fe9.jpeg	{"filename":"0.jpg"}	569	380	\N	image/jpeg	36800	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 12:47:55	2016-11-22 12:47:55
22	1	0.jpg	\N	f	sonata.media.provider.image	1	71909ef262aee81078b4b67ff6040f77fe439ece.jpeg	{"filename":"0.jpg"}	550	345	\N	image/jpeg	70263	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 14:57:31	2016-11-22 14:57:31
23	1	34xxx.jpg	\N	f	sonata.media.provider.image	1	c2a610ea8a81920253d94a66dddbffd2688c1575.jpeg	{"filename":"34xxx.jpg"}	900	506	\N	image/jpeg	145119	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 15:02:53	2016-11-22 15:02:53
24	1	0.jpg	\N	f	sonata.media.provider.image	1	2ac283fb5ddfd7a8c3bb61fa4af5255fc0c5a527.jpeg	{"filename":"0.jpg"}	720	480	\N	image/jpeg	108370	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 15:20:25	2016-11-22 15:20:25
25	1	0.jpg	\N	f	sonata.media.provider.image	1	dde0c9caa6a28efc7ef57fb7c22cdcc021de070e.jpeg	{"filename":"0.jpg"}	400	234	\N	image/jpeg	94221	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 15:24:44	2016-11-22 15:24:44
26	1	vinales1.jpg	\N	f	sonata.media.provider.image	1	efef521f1698e27378a577fbc649109ffbffa09f.jpeg	{"filename":"vinales1.jpg"}	1000	670	\N	image/jpeg	180448	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 15:45:03	2016-11-22 15:45:03
27	1	cuba.jpg	\N	f	sonata.media.provider.image	1	5b55a626427350785697368c2b2a7285bb3a121a.jpeg	{"filename":"cuba.jpg"}	700	466	\N	image/jpeg	88567	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 15:46:38	2016-11-22 15:46:38
28	1	Trinidad_(Kuba)_03.jpg	\N	f	sonata.media.provider.image	1	de59169e586e4f574cf634f212debf4344a32d7d.jpeg	{"filename":"Trinidad_(Kuba)_03.jpg"}	2048	1536	\N	image/jpeg	1051358	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 15:47:19	2016-11-22 15:47:19
29	1	ciudad-museo-de-Trinidad-en-Cuba-1.jpg	\N	f	sonata.media.provider.image	1	dbb44c4c67271713935ca80725293cf03565e455.jpeg	{"filename":"ciudad-museo-de-Trinidad-en-Cuba-1.jpg"}	649	433	\N	image/jpeg	50473	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 15:48:45	2016-11-22 15:48:45
30	1	varadero.jpg	\N	f	sonata.media.provider.image	1	6f530fb6e59bb93c392d14ba7c6ee7df796a78e7.jpeg	{"filename":"varadero.jpg"}	550	331	\N	image/jpeg	47335	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-22 15:52:07	2016-11-22 15:52:07
31	1	the-big-bang-theory-2847610.jpg	\N	f	sonata.media.provider.image	1	95028214e6aa78331070df2a254bbac813cc8768.jpeg	{"filename":"the-big-bang-theory-2847610.jpg"}	2500	1562	\N	image/jpeg	433517	\N	\N	daiquiri	\N	\N	\N	\N	2016-11-23 12:53:05	2016-11-23 12:53:05
32	1	your-body-is-a-wonderland-1920x1200.jpg	\N	f	sonata.media.provider.image	1	b3d78ad361df6685dcea05d8f5dee3b5d00093e3.jpeg	{"filename":"your-body-is-a-wonderland-1920x1200.jpg"}	1920	1200	\N	image/jpeg	263763	\N	\N	daiquiri	\N	\N	\N	\N	2016-12-14 18:48:38	2016-12-14 18:48:38
35	1	1024px-MRO_Cuba_Harvest_01.jpg	\N	f	sonata.media.provider.image	1	8e10fd4c91d0623704d397d739ade1f38c866a12.jpeg	{"filename":"1024px-MRO_Cuba_Harvest_01.jpg"}	1024	591	\N	image/jpeg	149488	\N	\N	daiquiri	\N	\N	\N	\N	2017-01-17 13:07:42	2017-01-17 13:07:42
36	1	Cuba.jpg	\N	f	sonata.media.provider.image	1	0d15194e133d21f963e0fc749165ddb505924b89.jpeg	{"filename":"Cuba.jpg"}	1919	1080	\N	image/jpeg	787157	\N	\N	daiquiri	\N	\N	\N	\N	2017-01-17 13:08:18	2017-01-17 13:08:18
37	1	800px-Vinales-cuba.JPG	\N	f	sonata.media.provider.image	1	9117454dfe44c136ae6679f4bcd4c2675ed5f536.jpeg	{"filename":"800px-Vinales-cuba.JPG"}	800	600	\N	image/jpeg	131813	\N	\N	daiquiri	\N	\N	\N	\N	2017-01-17 16:58:02	2017-01-17 16:58:02
38	1	imagen066.jpg	\N	f	sonata.media.provider.image	1	4311afe9e7439eb6c7004db543cbdb826c8e4bbf.jpeg	{"filename":"imagen066.jpg"}	100	93	\N	image/jpeg	15391	\N	\N	daiquiri	\N	\N	\N	\N	2017-01-17 16:58:34	2017-01-17 16:58:34
39	1	20161013_190807.jpg	\N	f	sonata.media.provider.image	1	c2b5d59a9ed901d1e2d5e1931de3435b01cec5db.jpeg	{"filename":"20161013_190807.jpg"}	2576	1932	\N	image/jpeg	1759373	\N	\N	daiquiri	\N	\N	\N	\N	2017-01-17 17:01:26	2017-01-17 17:01:26
40	1	20161013_230803.jpg	\N	f	sonata.media.provider.image	1	e9e5699b9390f22dd66bd7783944f14ad7edc9bc.jpeg	{"filename":"20161013_230803.jpg"}	2576	1932	\N	image/jpeg	1682796	\N	\N	daiquiri	\N	\N	\N	\N	2017-01-17 17:02:35	2017-01-17 17:02:35
\.


--
-- TOC entry 4494 (class 0 OID 0)
-- Dependencies: 300
-- Name: media__media_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('media__media_id_seq', 40, true);


--
-- TOC entry 4303 (class 0 OID 261731)
-- Dependencies: 301
-- Data for Name: medical_program; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY medical_program (id, picture, gallery, title, slug, unique_slug, description) FROM stdin;
\.


--
-- TOC entry 4495 (class 0 OID 0)
-- Dependencies: 302
-- Name: medical_program_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('medical_program_id_seq', 1, false);


--
-- TOC entry 4305 (class 0 OID 261741)
-- Dependencies: 303
-- Data for Name: medical_request; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY medical_request (id, medicalservice, startdate) FROM stdin;
\.


--
-- TOC entry 4306 (class 0 OID 261744)
-- Dependencies: 304
-- Data for Name: medical_service; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY medical_service (id, medical_program, research, consultations, day, price) FROM stdin;
\.


--
-- TOC entry 4307 (class 0 OID 261752)
-- Dependencies: 305
-- Data for Name: medical_service_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY medical_service_item (realid) FROM stdin;
\.


--
-- TOC entry 4308 (class 0 OID 261755)
-- Dependencies: 306
-- Data for Name: ocupation; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY ocupation (id, room, kids, adults) FROM stdin;
17	1	0	1
18	1	1	1
19	1	2	1
20	1	1	2
21	1	1	3
22	1	1	0
23	1	4	0
24	3	0	1
25	3	1	1
26	3	0	2
27	3	1	2
28	3	0	3
29	2	2	1
30	2	1	2
31	2	0	3
32	2	4	0
33	5	0	1
34	5	1	1
35	5	2	1
36	5	3	1
37	5	0	2
38	5	1	2
39	5	0	3
40	5	2	0
41	5	3	0
42	4	0	1
43	4	1	1
44	4	1	2
45	4	0	3
46	7	0	1
47	7	1	2
48	6	0	1
49	6	1	2
50	6	2	0
\.


--
-- TOC entry 4309 (class 0 OID 261758)
-- Dependencies: 307
-- Data for Name: ocupation_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY ocupation_item (realid, hotel, room, kids, adults, plan, infant, enddate) FROM stdin;
3	5	1	0	1	AI	0	2016-12-09
\.


--
-- TOC entry 4310 (class 0 OID 261761)
-- Dependencies: 308
-- Data for Name: ocupation_searcher; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY ocupation_searcher (id, polo, hotel, chain, room, province, adults, kids, infants, startdate, enddate, ubication, hoteltype) FROM stdin;
695	\N	\N	\N	\N	\N	1	0	0	2017-03-27	2017-03-28	\N	\N
696	\N	\N	\N	\N	\N	1	0	0	2017-03-27	2017-03-28	\N	\N
697	\N	\N	\N	\N	\N	1	0	0	2017-03-27	2017-03-28	\N	\N
698	\N	\N	\N	\N	\N	1	0	0	2017-03-27	2017-03-28	\N	\N
699	\N	\N	\N	\N	\N	1	0	0	2017-03-27	2017-03-28	\N	\N
700	\N	\N	\N	\N	\N	1	0	0	2017-03-27	2017-03-28	\N	\N
701	\N	\N	\N	\N	\N	1	0	0	2017-03-27	2017-03-28	\N	\N
702	\N	\N	\N	\N	\N	1	0	0	2017-03-27	2017-03-28	\N	\N
703	3	\N	\N	\N	\N	1	0	0	2017-03-28	2017-03-29	\N	\N
704	3	\N	\N	\N	\N	1	0	0	2017-03-28	2017-03-29	\N	\N
705	3	\N	\N	\N	\N	1	0	0	2017-03-28	2017-03-29	\N	\N
706	3	\N	\N	\N	\N	1	0	0	2017-03-28	2017-03-29	\N	\N
708	\N	\N	\N	\N	\N	1	0	0	2017-03-28	2017-03-29	\N	\N
709	\N	\N	\N	\N	\N	1	0	0	2017-03-28	2017-03-29	\N	\N
710	\N	\N	\N	\N	\N	1	0	0	2017-03-28	2017-03-29	\N	\N
711	\N	\N	\N	\N	\N	1	0	0	2017-03-28	2017-03-29	\N	\N
712	\N	\N	\N	\N	\N	1	0	0	2017-03-28	2017-03-29	\N	\N
\.


--
-- TOC entry 4311 (class 0 OID 261765)
-- Dependencies: 309
-- Data for Name: ocupation_searcher_rental_house_facility_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY ocupation_searcher_rental_house_facility_type (ocupation_searcher_id, hotel_facility_id) FROM stdin;
\.


--
-- TOC entry 4312 (class 0 OID 261768)
-- Dependencies: 310
-- Data for Name: ocupation_searcher_rental_house_room_facility; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY ocupation_searcher_rental_house_room_facility (ocupation_searcher_id, rental_house_room_facility_id) FROM stdin;
\.


--
-- TOC entry 4313 (class 0 OID 261783)
-- Dependencies: 311
-- Data for Name: package; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY package (id, picture, gallery, term_condition_package, cancelation_packages, product_increment, title, description, slug, unique_slug, available, priority, payonline, remarks) FROM stdin;
1	31	\N	\N	\N	\N	Cuba-Italia	<p>Cuba-Italia</p>	cuba-italia	1-cuba-italia	\N	\N	\N	\N
\.


--
-- TOC entry 4496 (class 0 OID 0)
-- Dependencies: 312
-- Name: package_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('package_id_seq', 1, true);


--
-- TOC entry 4315 (class 0 OID 261794)
-- Dependencies: 313
-- Data for Name: package_option; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY package_option (id, id_package, include, notinclude, priceadult, pricekid, days, nigths) FROM stdin;
\.


--
-- TOC entry 4316 (class 0 OID 261802)
-- Dependencies: 314
-- Data for Name: package_option_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY package_option_item (realid, pickupplace, kids, adults, infant) FROM stdin;
\.


--
-- TOC entry 4317 (class 0 OID 261805)
-- Dependencies: 315
-- Data for Name: package_option_polos; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY package_option_polos (package_option_id, polo_id) FROM stdin;
\.


--
-- TOC entry 4318 (class 0 OID 261808)
-- Dependencies: 316
-- Data for Name: package_option_searcher; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY package_option_searcher (id, package, startdate, days, night, adults, kids, infant) FROM stdin;
\.


--
-- TOC entry 4319 (class 0 OID 261811)
-- Dependencies: 317
-- Data for Name: package_request; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY package_request (id, package, packageoption, adult, kid, startdate) FROM stdin;
\.


--
-- TOC entry 4320 (class 0 OID 261814)
-- Dependencies: 318
-- Data for Name: packageoptionsearcher_polo; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY packageoptionsearcher_polo (id) FROM stdin;
\.


--
-- TOC entry 4321 (class 0 OID 261817)
-- Dependencies: 319
-- Data for Name: payment; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY payment (id, curency, client_id, error, response, card_country, auth_code, card_type, amount, description, order_id, status, created_from_ip, pdfview, date_created) FROM stdin;
\.


--
-- TOC entry 4497 (class 0 OID 0)
-- Dependencies: 320
-- Name: payment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('payment_id_seq', 1, false);


--
-- TOC entry 4323 (class 0 OID 261833)
-- Dependencies: 321
-- Data for Name: place; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY place (id, polo, province, picture, gallery, title, slug, unique_slug, latitude, longitude, description, ispickupplace_excursion, ispickupplace_transfer, ispickupplace_circuit, ispickupplace_car, type) FROM stdin;
2	3	1	\N	\N	Punto Rex Melia Cohiba	punto-rex-melia-cohiba	2-punto-rex-melia-cohiba	\N	\N	\N	t	t	t	t	place
4	4	4	\N	\N	Trinidad	trinidad	4-trinidad	\N	\N	\N	t	t	t	t	place
8	1	3	21	\N	Iberostar Varadero	iberostar-varadero	8-iberostar-varadero	\N	\N	<p>El comit&eacute; de acci&oacute;n pol&iacute;tica que dirige tiene como objetivo declarado&nbsp;<strong>&ldquo;promover una transici&oacute;n incondicional en Cuba a la democracia, el Estado de derecho y el mercado libre&rdquo;</strong>.</p>\r\n\r\n<p>Aunque este abogado estadounidense ya trabaj&oacute; hace a&ntilde;os como asesor en el Departamento del Tesoro y conoce por tanto la agencia, algunos observadores ven su nombramiento como una se&ntilde;al de que Trump podr&iacute;a estar dispuesto a cumplir su promesa electoral de dar marcha atr&aacute;s a las medidas tomadas por Obama respecto a Cuba.</p>\r\n\r\n<p>Durante las primarias republicanas, Trump fue el &uacute;nico aspirante de su partido que apoyaba la pol&iacute;tica de deshielo, pero fue endureciendo su posici&oacute;n a medida que buscaba votos en Florida en las elecciones generales.</p>	t	t	t	\N	hotel
10	1	3	\N	\N	Varadero	varadero	10-varadero	\N	\N	\N	t	t	t	t	place
5	3	1	12	\N	Melia Cohiba	melia-cohiba	5-melia-cohiba	23.1397237	-82.4027985	\N	t	t	t	\N	hotel
7	3	1	19	2	Memories Miramar	memories-miramar	7-memories-miramar	\N	\N	<p>El comit&eacute; de acci&oacute;n pol&iacute;tica que dirige tiene como objetivo declarado&nbsp;<strong>&ldquo;promover una transici&oacute;n incondicional en Cuba a la democracia, el Estado de derecho y el mercado libre&rdquo;</strong>.</p>\r\n\r\n<p>Aunque este abogado estadounidense ya trabaj&oacute; hace a&ntilde;os como asesor en el Departamento del Tesoro y conoce por tanto la agencia, algunos observadores ven su nombramiento como una se&ntilde;al de que Trump podr&iacute;a estar dispuesto a cumplir su promesa electoral de dar marcha atr&aacute;s a las medidas tomadas por Obama respecto a Cuba.</p>\r\n\r\n<p>Durante las primarias republicanas, Trump fue el &uacute;nico aspirante de su partido que apoyaba la pol&iacute;tica de deshielo, pero fue endureciendo su posici&oacute;n a medida que buscaba votos en Florida en las elecciones generales.</p>	t	t	t	\N	hotel
6	3	1	17	\N	Melia Habana	melia-habana	6-melia-habana	23.10947695935146	-82.44179248809814	<p>El comit&eacute; de acci&oacute;n pol&iacute;tica que dirige tiene como objetivo declarado&nbsp;<strong>&ldquo;promover una transici&oacute;n incondicional en Cuba a la democracia, el Estado de derecho y el mercado libre&rdquo;</strong>.</p>\r\n\r\n<p>Aunque este abogado estadounidense ya trabaj&oacute; hace a&ntilde;os como asesor en el Departamento del Tesoro y conoce por tanto la agencia, algunos observadores ven su nombramiento como una se&ntilde;al de que Trump podr&iacute;a estar dispuesto a cumplir su promesa electoral de dar marcha atr&aacute;s a las medidas tomadas por Obama respecto a Cuba.</p>\r\n\r\n<p>Durante las primarias republicanas, Trump fue el &uacute;nico aspirante de su partido que apoyaba la pol&iacute;tica de deshielo, pero fue endureciendo su posici&oacute;n a medida que buscaba votos en Florida en las elecciones generales.</p>	t	t	t	f	hotel
1	3	1	\N	\N	Punto Rex Miramar	punto-rex-miramar	1-punto-rex-miramar	23.10570736188678	-82.4410629272461	\N	t	t	t	t	place
9	2	2	35	4	Soroa	soroa	9-soroa	22.7703056	-82.99853430000002	\N	t	t	t	t	place
3	2	2	36	\N	Viñales	vinales	3-vinales	22.61756041261148	-83.71444702148438	\N	t	t	t	t	place
\.


--
-- TOC entry 4498 (class 0 OID 0)
-- Dependencies: 322
-- Name: place_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('place_id_seq', 10, true);


--
-- TOC entry 4325 (class 0 OID 261845)
-- Dependencies: 323
-- Data for Name: place_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY place_type (id, title, slug, unique_slug) FROM stdin;
1	Pick Up Place	pick-up-place	1-pick-up-place
2	Drop Off Place	drop-off-place	2-drop-off-place
3	City	city	3-city
4	Beach	beach	4-beach
5	Forest	forest	5-forest
6	Hotel	hotel	6-hotel
\.


--
-- TOC entry 4499 (class 0 OID 0)
-- Dependencies: 324
-- Name: place_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('place_type_id_seq', 6, true);


--
-- TOC entry 4327 (class 0 OID 261853)
-- Dependencies: 325
-- Data for Name: place_type_place; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY place_type_place (place_id, place_type_id) FROM stdin;
1	1
1	2
2	1
2	2
3	5
4	3
5	1
5	2
5	3
5	6
6	1
6	2
6	3
6	6
7	1
7	2
7	3
7	6
8	1
8	2
8	4
8	6
9	1
9	2
9	5
10	4
\.


--
-- TOC entry 4328 (class 0 OID 261856)
-- Dependencies: 326
-- Data for Name: polo; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY polo (id, picture, gallery, title, slug, unique_slug, description, priority) FROM stdin;
1	\N	\N	Varadero	varadero	1-varadero	\N	0
2	\N	\N	Viñales	vinales	2-vinales	\N	1
4	\N	\N	Trinidad	trinidad	4-trinidad	\N	4
3	\N	\N	Havana	havana	3-havana	\N	2
5	\N	\N	Florencia	florencia	5-florencia	\N	4
6	\N	\N	Venecia	venecia	6-venecia	\N	2
\.


--
-- TOC entry 4500 (class 0 OID 0)
-- Dependencies: 327
-- Name: polo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('polo_id_seq', 6, true);


--
-- TOC entry 4330 (class 0 OID 261869)
-- Dependencies: 328
-- Data for Name: polos_provinces; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY polos_provinces (polo_id, province_id) FROM stdin;
1	3
2	2
3	1
4	4
\.


--
-- TOC entry 4331 (class 0 OID 261872)
-- Dependencies: 329
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY product (id, product_increment, term_condition_product, cancelation_product, picture, gallery, provider, title, slug, unique_slug, description, available, priority, payonline, review_available, remarks, product_type, type, numbersales) FROM stdin;
2	\N	\N	\N	6	2	\N	Renault Fluence	renault-fluence	2-renault-fluence	<p>Hace unos d&iacute;as, mientras visitaba a unas amistades en el conocido barrio de Santo Su&aacute;rez, enclavado en el municipio de Diez de Octubre; una nube de humo se apoder&oacute; del vecindario y pint&oacute; el aire de un tupido gris cenizo. La algarab&iacute;a de los moradores, la mirada de los curiosos y los gritos de una se&ntilde;ora regordeta que, con una expresi&oacute;n terror&iacute;fica, se&ntilde;alaba hacia el entejado de una casucha de madera; atrajeron mi atenci&oacute;n sobre el hecho. Justo a pocos metros de donde visitaba ten&iacute;a lugar un incendio.</p>\r\n\r\n<p>Todos corrimos a sumarnos a la solidaridad de la barriada que, en pocos segundos, se hab&iacute;a movilizado. Una hilara de manos mov&iacute;an muebles y se devolv&iacute;an con sendos cubos u otros recipientes cargados con agua. Seg&uacute;n supimos luego, la se&ntilde;ora hab&iacute;a corrido a la bodega y dej&oacute; en cocci&oacute;n alg&uacute;n alimento. &ldquo;Un minuto&rdquo;, dijo y, justamente, en un minuto le hab&iacute;a cambiado la vida.</p>	t	1	t	t	\N	\N	car	0
1	\N	\N	\N	3	1	\N	Hunday Santa Fe	hunday-santa-fe	1-hunday-santa-fe	<p>Hace unos d&iacute;as, mientras visitaba a unas amistades en el conocido barrio de Santo Su&aacute;rez, enclavado en el municipio de Diez de Octubre; una nube de humo se apoder&oacute; del vecindario y pint&oacute; el aire de un tupido gris cenizo. La algarab&iacute;a de los moradores, la mirada de los curiosos y los gritos de una se&ntilde;ora regordeta que, con una expresi&oacute;n terror&iacute;fica, se&ntilde;alaba hacia el entejado de una casucha de madera; atrajeron mi atenci&oacute;n sobre el hecho. Justo a pocos metros de donde visitaba ten&iacute;a lugar un incendio.</p>\r\n\r\n<p>Todos corrimos a sumarnos a la solidaridad de la barriada que, en pocos segundos, se hab&iacute;a movilizado. Una hilara de manos mov&iacute;an muebles y se devolv&iacute;an con sendos cubos u otros recipientes cargados con agua. Seg&uacute;n supimos luego, la se&ntilde;ora hab&iacute;a corrido a la bodega y dej&oacute; en cocci&oacute;n alg&uacute;n alimento. &ldquo;Un minuto&rdquo;, dijo y, justamente, en un minuto le hab&iacute;a cambiado la vida.</p>	t	0	t	t	\N	\N	car	0
3	\N	\N	\N	10	3	\N	Audi A6	audi-a6	3-audi-a6	<p>Hace unos d&iacute;as, mientras visitaba a unas amistades en el conocido barrio de Santo Su&aacute;rez, enclavado en el municipio de Diez de Octubre; una nube de humo se apoder&oacute; del vecindario y pint&oacute; el aire de un tupido gris cenizo. La algarab&iacute;a de los moradores, la mirada de los curiosos y los gritos de una se&ntilde;ora regordeta que, con una expresi&oacute;n terror&iacute;fica, se&ntilde;alaba hacia el entejado de una casucha de madera; atrajeron mi atenci&oacute;n sobre el hecho. Justo a pocos metros de donde visitaba ten&iacute;a lugar un incendio.</p>\r\n\r\n<p>Todos corrimos a sumarnos a la solidaridad de la barriada que, en pocos segundos, se hab&iacute;a movilizado. Una hilara de manos mov&iacute;an muebles y se devolv&iacute;an con sendos cubos u otros recipientes cargados con agua. Seg&uacute;n supimos luego, la se&ntilde;ora hab&iacute;a corrido a la bodega y dej&oacute; en cocci&oacute;n alg&uacute;n alimento. &ldquo;Un minuto&rdquo;, dijo y, justamente, en un minuto le hab&iacute;a cambiado la vida.</p>	t	3	t	t	\N	\N	car	0
4	\N	\N	\N	9	3	\N	Audi A8	audi-a8	4-audi-a8	<p>Hace unos d&iacute;as, mientras visitaba a unas amistades en el conocido barrio de Santo Su&aacute;rez, enclavado en el municipio de Diez de Octubre; una nube de humo se apoder&oacute; del vecindario y pint&oacute; el aire de un tupido gris cenizo. La algarab&iacute;a de los moradores, la mirada de los curiosos y los gritos de una se&ntilde;ora regordeta que, con una expresi&oacute;n terror&iacute;fica, se&ntilde;alaba hacia el entejado de una casucha de madera; atrajeron mi atenci&oacute;n sobre el hecho. Justo a pocos metros de donde visitaba ten&iacute;a lugar un incendio.</p>\r\n\r\n<p>Todos corrimos a sumarnos a la solidaridad de la barriada que, en pocos segundos, se hab&iacute;a movilizado. Una hilara de manos mov&iacute;an muebles y se devolv&iacute;an con sendos cubos u otros recipientes cargados con agua. Seg&uacute;n supimos luego, la se&ntilde;ora hab&iacute;a corrido a la bodega y dej&oacute; en cocci&oacute;n alg&uacute;n alimento. &ldquo;Un minuto&rdquo;, dijo y, justamente, en un minuto le hab&iacute;a cambiado la vida.</p>	t	4	t	t	\N	\N	car	0
5	\N	\N	\N	\N	\N	\N	Excursion 1	excursion-1	5-excursion-1	<p>Excursion 1</p>	t	0	t	t	\N	\N	excursion_colective	0
6	\N	\N	\N	\N	\N	\N	Excursion 2	excursion-2	6-excursion-2	<p>Excursion 2</p>	t	2	t	t	\N	\N	excursion_colective	0
7	\N	\N	\N	\N	\N	\N	Excursion 3	excursion-3	7-excursion-3	<p>Excursion 3</p>	t	0	t	t	\N	\N	excursion_exclusive	0
8	\N	\N	\N	\N	\N	\N	Excursion 4	excursion-4	8-excursion-4	<p>Excursion 4</p>	t	4	t	t	\N	\N	excursion_exclusive	0
10	\N	\N	\N	\N	\N	\N	Viñales - Punto Rex Melia Cohiba	punto-rex-melia-cohiba-vinales-1	9-punto-rex-melia-cohiba-vinales-1	Viñales - Punto Rex Melia Cohiba	t	2	t	t	\N	Transfer Colective	transfer_colective	\N
11	\N	\N	\N	\N	\N	\N	Trinidad - Punto Rex Miramar	trinidad-punto-rex-miramar	11-trinidad-punto-rex-miramar	Trinidad - Punto Rex Miramar	t	1	t	t	\N	Transfer Colective	transfer_colective	\N
12	\N	\N	\N	\N	\N	\N	Punto Rex Miramar - Trinidad	trinidad-punto-rex-miramar-1	11-trinidad-punto-rex-miramar-1	Punto Rex Miramar - Trinidad	t	1	t	t	\N	Transfer Colective	transfer_colective	\N
13	\N	\N	\N	\N	\N	\N	Punto Rex Melia Cohiba - Trinidad	punto-rex-melia-cohiba-trinidad	13-punto-rex-melia-cohiba-trinidad	Punto Rex Melia Cohiba - Trinidad	t	0	t	t	\N	Transfer Exclusive	transfer_exclusive	\N
14	\N	\N	\N	\N	\N	\N	Trinidad - Punto Rex Melia Cohiba	punto-rex-melia-cohiba-trinidad-1	13-punto-rex-melia-cohiba-trinidad-1	Trinidad - Punto Rex Melia Cohiba	t	0	t	t	\N	Transfer Exclusive	transfer_exclusive	\N
15	\N	\N	\N	\N	\N	\N	Viñales - Punto Rex Miramar	vinales-punto-rex-miramar	15-vinales-punto-rex-miramar	Viñales - Punto Rex Miramar	t	3	t	t	\N	Transfer Exclusive	transfer_exclusive	\N
16	\N	\N	\N	\N	\N	\N	Punto Rex Miramar - Viñales	vinales-punto-rex-miramar-1	15-vinales-punto-rex-miramar-1	Punto Rex Miramar - Viñales	t	3	t	t	\N	Transfer Exclusive	transfer_exclusive	\N
18	\N	\N	\N	\N	\N	\N	\N	-1	18	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
19	\N	\N	\N	\N	\N	\N	\N	-2	19	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
20	\N	\N	\N	\N	\N	\N	\N	-3	20	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
21	\N	\N	\N	\N	\N	\N	\N	-4	21	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
22	\N	\N	\N	\N	\N	\N	\N	-5	22	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
23	\N	\N	\N	\N	\N	\N	\N	-6	23	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
24	\N	\N	\N	\N	\N	\N	\N	-7	24	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
25	\N	\N	\N	\N	\N	\N	\N	-8	25	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
26	\N	\N	\N	\N	\N	\N	\N	-9	26	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
27	\N	\N	\N	\N	\N	\N	\N	-10	27	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
28	\N	\N	\N	\N	\N	\N	\N	-11	28	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
29	\N	\N	\N	\N	\N	\N	\N	-12	29	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
30	\N	\N	\N	\N	\N	\N	\N	-13	30	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
31	\N	\N	\N	\N	\N	\N	\N	-14	31	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
32	\N	\N	\N	\N	\N	\N	\N	-15	32	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
33	\N	\N	\N	\N	\N	\N	\N	-16	33	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
34	\N	\N	\N	\N	\N	\N	\N	-17	34	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
17	\N	\N	\N	\N	\N	\N	\N		17	\N	t	\N	\N	\N	\N	Ocupation	ocupation	1
35	\N	\N	\N	\N	\N	\N	\N	-18	35	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
36	\N	\N	\N	\N	\N	\N	\N	-19	36	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
37	\N	\N	\N	\N	\N	\N	\N	-20	37	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
38	\N	\N	\N	\N	\N	\N	\N	-21	38	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
39	\N	\N	\N	\N	\N	\N	\N	-22	39	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
40	\N	\N	\N	\N	\N	\N	\N	-23	40	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
41	\N	\N	\N	\N	\N	\N	\N	-24	41	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
42	\N	\N	\N	\N	\N	\N	\N	-25	42	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
43	\N	\N	\N	\N	\N	\N	\N	-26	43	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
44	\N	\N	\N	\N	\N	\N	\N	-27	44	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
45	\N	\N	\N	\N	\N	\N	\N	-28	45	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
46	\N	\N	\N	\N	\N	\N	\N	-29	46	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
47	\N	\N	\N	\N	\N	\N	\N	-30	47	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
48	\N	\N	\N	\N	\N	\N	\N	-31	48	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
49	\N	\N	\N	\N	\N	\N	\N	-32	49	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
50	\N	\N	\N	\N	\N	\N	\N	-33	50	\N	t	\N	\N	\N	\N	Ocupation	ocupation	\N
52	\N	\N	\N	\N	\N	\N	Room 1 - Los Chinitos	room-1-los-chinitos	52-room-1-los-chinitos	\N	\N	\N	\N	\N	\N	Rental House Room	rental_house_room	\N
53	\N	\N	\N	\N	\N	\N	Room1 -Casa Frank	room1-casa-frank	53-room1-casa-frank	\N	\N	\N	\N	\N	\N	Rental House Room	rental_house_room	\N
54	\N	\N	\N	\N	\N	\N	Cuarto 1  - Maragarita	cuarto-1-maragarita	54-cuarto-1-maragarita	\N	\N	\N	\N	\N	\N	Rental House Room	rental_house_room	\N
56	\N	\N	\N	29	\N	\N	La Habana - Trinidad	la-habana-trinidad	56-la-habana-trinidad	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>	t	3	t	t	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>	Circuit	circuit	\N
57	\N	\N	\N	30	\N	\N	La Habana - Varadero	la-habana-varadero	57-la-habana-varadero	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>	t	2	t	t	\N	Circuit	circuit	\N
51	\N	\N	\N	\N	\N	\N	Room 1 - Casa Arcoiris	room-1-casa-arcoiris	51-room-1-casa-arcoiris	\N	\N	\N	\N	\N	\N	Rental House Room	rental_house_room	1
55	\N	\N	\N	26	4	\N	Soroa-Viñales	soroa-vinales	55-soroa-vinales	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>	t	0	t	t	\N	Circuit	circuit	\N
59	\N	\N	\N	\N	\N	\N	as	as	59-as	\N	\N	\N	\N	\N	\N	Rental House Room	rental_house_room	\N
60	\N	\N	\N	\N	\N	\N	11	11	60-11	\N	\N	\N	\N	\N	\N	Rental House Room	rental_house_room	\N
9	\N	\N	\N	\N	\N	\N	Punto Rex Melia Cohiba - Viñales	punto-rex-melia-cohiba-vinales	9-punto-rex-melia-cohiba-vinales	Punto Rex Melia Cohiba - Viñales	t	2	f	t	\N	Transfer Colective	transfer_colective	1
\.


--
-- TOC entry 4332 (class 0 OID 261884)
-- Dependencies: 330
-- Data for Name: product_category; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY product_category (id, product, title) FROM stdin;
\.


--
-- TOC entry 4501 (class 0 OID 0)
-- Dependencies: 331
-- Name: product_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('product_category_id_seq', 1, false);


--
-- TOC entry 4502 (class 0 OID 0)
-- Dependencies: 332
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('product_id_seq', 61, true);


--
-- TOC entry 4335 (class 0 OID 261892)
-- Dependencies: 333
-- Data for Name: product_increment; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY product_increment (id, increment, product_type) FROM stdin;
\.


--
-- TOC entry 4503 (class 0 OID 0)
-- Dependencies: 334
-- Name: product_increment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('product_increment_id_seq', 1, false);


--
-- TOC entry 4337 (class 0 OID 261899)
-- Dependencies: 335
-- Data for Name: product_seo; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY product_seo (id, keywords, description, producttype) FROM stdin;
\.


--
-- TOC entry 4504 (class 0 OID 0)
-- Dependencies: 336
-- Name: product_seo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('product_seo_id_seq', 1, false);


--
-- TOC entry 4339 (class 0 OID 261907)
-- Dependencies: 337
-- Data for Name: products_tags; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY products_tags (tag_id, product_id) FROM stdin;
\.


--
-- TOC entry 4340 (class 0 OID 261910)
-- Dependencies: 338
-- Data for Name: provider; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY provider (id, picture, gallery, title, slug, unique_slug, description, available) FROM stdin;
\.


--
-- TOC entry 4505 (class 0 OID 0)
-- Dependencies: 339
-- Name: provider_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('provider_id_seq', 1, false);


--
-- TOC entry 4342 (class 0 OID 261920)
-- Dependencies: 340
-- Data for Name: province; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY province (id, picture, gallery, country, title, slug, unique_slug, description, priority) FROM stdin;
1	\N	\N	\N	Havana	havana	1-havana	<p>Havana</p>	\N
2	\N	\N	\N	Pinar de Rio	pinar-de-rio	2-pinar-de-rio	<p>Pinar del Rio</p>	\N
3	\N	\N	\N	Matanzas	matanzas	3-matanzas	<p>Matanzas</p>	\N
4	\N	\N	\N	Santi Spiritus	santi-spiritus	4-santi-spiritus	<p>Santi Spiritus</p>	\N
\.


--
-- TOC entry 4506 (class 0 OID 0)
-- Dependencies: 341
-- Name: province_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('province_id_seq', 4, true);


--
-- TOC entry 4344 (class 0 OID 261928)
-- Dependencies: 342
-- Data for Name: rental_house; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house (id, zone, picture, gallery, term_condition_house, cancelation_house, product_increment, price, private_rental, title, latitude, longitude, description, slug, unique_slug, available, priority, payonline, remarks) FROM stdin;
1	6	22	\N	\N	\N	\N	100	t	Casa Arcoiris	\N	\N	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>	casa-arcoiris	1-casa-arcoiris	t	0	t	\N
2	4	23	\N	\N	\N	\N	\N	f	Los Chinitos	\N	\N	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>	los-chinitos	2-los-chinitos	t	2	t	\N
3	5	24	\N	\N	\N	\N	\N	f	Casa Frank	\N	\N	\N	casa-frank	3-casa-frank	t	2	t	\N
4	6	25	\N	\N	\N	\N	80	t	Casa Margarita	\N	\N	<p>En materia de inmigraci&oacute;n, dijo Spencer, Trump &ldquo;dej&oacute; la puerta abierta a alg&uacute;n tipo de amnist&iacute;a masiva en una fecha futura, hablando acerca de mantener a los &lsquo;buenos&rsquo; en el pa&iacute;s&rdquo;. Adem&aacute;s, dijo, Trump &ldquo;quiz&aacute;s sea el presidente m&aacute;s prosionista de la historia&rdquo;, citando su oposici&oacute;n al acuerdo nuclear de Ir&aacute;n, &ldquo;que, debemos admitir, que en realidad no era tan malo&rdquo;.</p>\r\n\r\n<p><strong>El evento se realiz&oacute; en el restaurante Maggiano, al noroeste de Washington, que emiti&oacute; una disculpa el lunes y dijo a CNN que donar&iacute;a 10.000 d&oacute;lares a la oficina en DC de la Liga Anti-Difamaci&oacute;n.</strong>&nbsp;En un comunicado, la direcci&oacute;n del restaurante dijo que se hizo la reserva de &uacute;ltima hora del viernes y con un nombre diferente al de la organizaci&oacute;n.</p>\r\n\r\n<p><strong>El equipo de transici&oacute;n de Trump respondi&oacute; en un comunicado el lunes diciendo que el presidente electo ha &ldquo;seguido denunciando el racismo&rdquo;.</strong></p>	casa-margarita	4-casa-margarita	t	4	t	\N
\.


--
-- TOC entry 4507 (class 0 OID 0)
-- Dependencies: 343
-- Name: rental_house_availability_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('rental_house_availability_id_seq', 127, true);


--
-- TOC entry 4346 (class 0 OID 261941)
-- Dependencies: 344
-- Data for Name: rental_house_facility; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_facility (id, rentalhousefacilitytype_id, rental_house, picture, gallery, title, description, slug, unique_slug) FROM stdin;
3	2	1	\N	\N	Pool	\N	pool	3-pool
1	4	1	\N	\N	TV	\N	tv	1-tv
2	1	1	\N	\N	Parking	\N	parking	2-parking
\.


--
-- TOC entry 4508 (class 0 OID 0)
-- Dependencies: 345
-- Name: rental_house_facility_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('rental_house_facility_id_seq', 3, true);


--
-- TOC entry 4348 (class 0 OID 261951)
-- Dependencies: 346
-- Data for Name: rental_house_facility_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_facility_type (id, title, slug, unique_slug, icon) FROM stdin;
1	Parking	parking	1-parking	\N
2	Pool	pool	2-pool	\N
3	WIFI	wifi	3-wifi	\N
4	TV	tv	4-tv	\N
5	WIFI	wifi-1	5-wifi	im im-wi-fi
\.


--
-- TOC entry 4509 (class 0 OID 0)
-- Dependencies: 347
-- Name: rental_house_facility_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('rental_house_facility_type_id_seq', 5, true);


--
-- TOC entry 4510 (class 0 OID 0)
-- Dependencies: 348
-- Name: rental_house_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('rental_house_id_seq', 4, true);


--
-- TOC entry 4351 (class 0 OID 261961)
-- Dependencies: 349
-- Data for Name: rental_house_owner; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_owner (id, picture, name, lastname, phone1, phone2, email, address, slug, unique_slug) FROM stdin;
1	\N	Jose	Marañon	58475531	\N	jose@elmaranon.com	Viñales al fondo, Pinar del Rio	jose-maranon	1-jose-maranon
2	\N	Junior	Quesada	58475531	\N	junior@quezada.com	Trinidad, Cuba	junior-quesada	2-junior-quesada
3	\N	Frank	Rodriguez	58475531	\N	frank@rodriguez.com	Playa Larga, La cienaga, Matanzas, Cuba	frank-rodriguez	3-frank-rodriguez
4	\N	Maragarita	Perez	58475531	\N	maragarita@margarita.com	Vinales, Pinar del Rio, Cuba	maragarita-perez	4-maragarita-perez
5	\N	tony	tony	9898	998	tony@tony.com	9898	tony-tony	5-tony-tony
\.


--
-- TOC entry 4511 (class 0 OID 0)
-- Dependencies: 350
-- Name: rental_house_owner_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('rental_house_owner_id_seq', 5, true);


--
-- TOC entry 4353 (class 0 OID 261974)
-- Dependencies: 351
-- Data for Name: rental_house_rental_house_owner; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_rental_house_owner (rental_house_id, rental_house_owner_id) FROM stdin;
2	2
3	3
4	4
1	5
\.


--
-- TOC entry 4354 (class 0 OID 261977)
-- Dependencies: 352
-- Data for Name: rental_house_rental_house_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_rental_house_type (rental_house_id, rental_house_type_id) FROM stdin;
1	1
2	1
3	2
4	3
1	3
\.


--
-- TOC entry 4355 (class 0 OID 261980)
-- Dependencies: 353
-- Data for Name: rental_house_request; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_request (id, rentalhouse, rentalhouseroom, adult, kid, enddate, startdate) FROM stdin;
\.


--
-- TOC entry 4356 (class 0 OID 261983)
-- Dependencies: 354
-- Data for Name: rental_house_room; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room (id, rental_house, price) FROM stdin;
51	1	50
52	2	50
53	3	35
54	4	25
\.


--
-- TOC entry 4357 (class 0 OID 261986)
-- Dependencies: 355
-- Data for Name: rental_house_room_availability; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room_availability (id, rental_house_room, date) FROM stdin;
1	51	2016-11-23
2	51	2016-11-24
3	51	2016-11-25
4	51	2016-11-26
5	51	2016-11-27
6	51	2016-11-29
7	51	2016-11-28
8	51	2016-11-30
9	51	2016-12-04
10	51	2016-12-01
11	51	2016-12-02
12	51	2016-12-06
13	51	2016-12-05
14	51	2016-12-08
15	51	2016-12-10
16	51	2016-12-03
17	51	2016-12-07
18	51	2016-12-14
19	51	2016-12-11
20	51	2016-12-12
21	51	2016-12-16
22	51	2016-12-13
23	51	2016-12-09
24	51	2016-12-19
25	51	2016-12-21
26	51	2016-12-15
27	51	2016-12-22
28	51	2016-12-18
29	51	2016-12-25
30	51	2016-12-24
31	51	2016-12-23
32	51	2016-12-27
33	51	2016-12-17
34	51	2016-12-28
35	51	2016-12-26
36	51	2016-12-20
37	51	2016-12-31
38	51	2016-12-29
39	51	2016-12-30
40	52	2016-11-23
41	52	2016-11-24
42	52	2016-11-25
43	52	2016-11-26
44	52	2016-11-27
45	52	2016-11-28
46	52	2016-11-29
47	52	2016-11-30
48	52	2016-12-02
49	52	2016-12-01
50	52	2016-12-03
51	52	2016-12-04
52	52	2016-12-05
53	52	2016-12-06
54	52	2016-12-08
55	52	2016-12-09
56	52	2016-12-10
57	52	2016-12-07
58	52	2016-12-22
59	52	2016-12-19
60	52	2016-12-18
61	52	2016-12-23
62	52	2016-12-21
63	52	2016-12-25
64	52	2016-12-24
65	52	2016-12-27
66	52	2016-12-20
67	52	2016-12-26
69	52	2016-12-29
70	52	2016-12-28
71	52	2016-12-31
72	52	2016-12-11
73	52	2016-12-12
74	52	2016-12-13
75	52	2016-12-14
76	52	2016-12-15
77	52	2016-12-30
78	52	2016-12-16
79	52	2016-12-17
80	53	2016-12-11
81	53	2016-12-12
82	53	2016-12-13
83	53	2016-12-15
84	53	2016-12-14
85	53	2016-12-25
86	53	2016-12-26
87	53	2016-12-17
88	53	2016-12-27
89	53	2016-12-16
90	53	2016-12-28
91	53	2016-12-30
92	53	2016-12-29
93	53	2016-12-31
94	53	2016-11-27
95	53	2016-11-28
96	53	2016-11-29
97	53	2016-11-30
98	53	2016-11-23
99	53	2016-11-25
100	53	2016-11-26
101	53	2016-11-24
102	54	2016-12-11
103	54	2016-12-12
104	54	2016-12-13
105	54	2016-12-14
106	54	2016-12-15
107	54	2016-12-01
108	54	2016-12-16
109	54	2016-12-03
110	54	2016-12-04
111	54	2016-12-07
112	54	2016-12-06
113	54	2016-12-08
114	54	2016-12-17
115	54	2016-12-02
116	54	2016-12-10
117	54	2016-11-24
118	54	2016-11-25
119	54	2016-11-23
120	54	2016-11-27
121	54	2016-11-29
122	54	2016-12-05
123	54	2016-11-28
124	54	2016-11-30
125	54	2016-11-26
126	54	2016-12-09
127	51	2017-01-01
\.


--
-- TOC entry 4358 (class 0 OID 261989)
-- Dependencies: 356
-- Data for Name: rental_house_room_facility; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room_facility (id, title, faicon, slug, unique_slug) FROM stdin;
1	TV	fa-tv	tv	1-tv
2	TV	fa-tv	tv-1	2-tv
3	WiFi	fa-wifi	wifi	3-wifi
4	TV	fa-tv	tv-2	4-tv
5	WiFi	fa-wifi	wifi-1	5-wifi
6	TV	fa-tv	tv-3	6-tv
7	TV	fa-tv	tv-4	7-tv
8	WiFi	fa-wifi	wifi-2	8-wifi
9	TV	fa-tv	tv-5	9-tv
10	WiFi	fa-wifi	wifi-3	10-wifi
11	Spa	im im-spa	spa	11-spa
\.


--
-- TOC entry 4512 (class 0 OID 0)
-- Dependencies: 357
-- Name: rental_house_room_facility_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('rental_house_room_facility_id_seq', 11, true);


--
-- TOC entry 4360 (class 0 OID 261999)
-- Dependencies: 358
-- Data for Name: rental_house_room_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room_item (realid, rentalhouse, room, adult, kid, enddate) FROM stdin;
4	1	51	1	0	2016-12-21
\.


--
-- TOC entry 4361 (class 0 OID 262002)
-- Dependencies: 359
-- Data for Name: rental_house_room_ocupation; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room_ocupation (id, adult, kid) FROM stdin;
3	3	0
5	1	1
6	1	2
7	2	1
1	0	3
2	2	1
4	1	2
\.


--
-- TOC entry 4513 (class 0 OID 0)
-- Dependencies: 360
-- Name: rental_house_room_ocupation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('rental_house_room_ocupation_id_seq', 8, true);


--
-- TOC entry 4363 (class 0 OID 262007)
-- Dependencies: 361
-- Data for Name: rental_house_room_rental_house_room_facilities; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room_rental_house_room_facilities (rental_house_room_id, rental_house_room_facility_id) FROM stdin;
51	1
51	5
52	1
52	3
53	2
54	1
\.


--
-- TOC entry 4364 (class 0 OID 262010)
-- Dependencies: 362
-- Data for Name: rental_house_room_rental_house_room_ocupations; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room_rental_house_room_ocupations (rental_house_room_id, rental_house_room_ocupation_id) FROM stdin;
51	4
52	1
52	2
52	7
53	1
53	3
53	6
54	1
54	2
54	3
54	5
54	6
54	7
51	3
51	6
51	1
\.


--
-- TOC entry 4365 (class 0 OID 262013)
-- Dependencies: 363
-- Data for Name: rental_house_room_searcher; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room_searcher (id, polo, rentalhouse, rentalhouseroom, province, house, rooms, adults, kids, privaterental, startdate, enddate) FROM stdin;
316	\N	\N	\N	\N	\N	0	1	0	f	2016-12-31	2017-01-01
317	\N	\N	\N	\N	\N	0	1	0	f	2016-12-31	2017-01-01
318	\N	\N	\N	\N	\N	0	1	0	f	2016-12-31	2017-01-01
319	\N	\N	\N	\N	\N	0	1	0	f	2016-12-31	2017-01-01
320	\N	\N	\N	\N	\N	0	1	0	f	2016-12-31	2017-01-01
321	\N	\N	\N	\N	\N	0	1	0	f	2017-01-31	2017-02-01
322	\N	\N	\N	\N	\N	0	1	0	f	2016-12-31	2017-01-01
379	\N	\N	\N	\N	\N	0	1	0	f	2016-12-07	2016-12-08
386	\N	\N	\N	\N	\N	0	1	0	f	2016-12-07	2016-12-08
387	\N	\N	\N	\N	\N	0	1	0	f	2016-12-07	2016-12-08
388	\N	\N	\N	\N	\N	0	1	0	f	2016-12-07	2016-12-08
411	\N	\N	\N	\N	\N	0	1	0	f	2016-12-18	2016-12-19
412	\N	\N	\N	\N	\N	0	1	0	f	2016-12-18	2016-12-19
413	\N	\N	\N	\N	\N	0	1	0	f	2016-12-18	2016-12-19
414	\N	\N	\N	\N	\N	0	1	0	f	2016-12-18	2016-12-19
415	\N	\N	\N	\N	\N	0	1	0	f	2016-12-18	2016-12-19
416	\N	\N	\N	\N	\N	0	1	0	f	2016-12-18	2016-12-19
417	\N	\N	\N	\N	\N	0	1	0	f	2016-12-20	2016-12-21
418	\N	\N	\N	\N	\N	0	1	0	f	2016-12-20	2016-12-21
419	\N	\N	\N	\N	\N	0	1	0	f	2016-12-20	2016-12-21
420	\N	\N	\N	\N	\N	0	1	0	f	2016-12-20	2016-12-21
421	\N	\N	\N	\N	\N	0	1	0	f	2016-12-20	2016-12-21
\.


--
-- TOC entry 4366 (class 0 OID 262017)
-- Dependencies: 364
-- Data for Name: rental_house_room_searcher_rental_house_facility_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room_searcher_rental_house_facility_type (rental_house_room_searcher_id, rental_house_facility_id) FROM stdin;
\.


--
-- TOC entry 4367 (class 0 OID 262020)
-- Dependencies: 365
-- Data for Name: rental_house_room_searcher_rental_house_room_facility; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_room_searcher_rental_house_room_facility (rental_house_room_searcher_id, rental_house_room_facility_id) FROM stdin;
\.


--
-- TOC entry 4368 (class 0 OID 262023)
-- Dependencies: 366
-- Data for Name: rental_house_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rental_house_type (id, picture, title, slug, unique_slug) FROM stdin;
1	\N	Colonial House	colonial-house	1-colonial-house
2	\N	City House	city-house	2-city-house
3	\N	Country House	country-house	3-country-house
\.


--
-- TOC entry 4514 (class 0 OID 0)
-- Dependencies: 367
-- Name: rental_house_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('rental_house_type_id_seq', 3, true);


--
-- TOC entry 4370 (class 0 OID 262032)
-- Dependencies: 368
-- Data for Name: rentalhouseroomsearcher_type; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY rentalhouseroomsearcher_type (id_rentalhouseroomsearcher, id_typehouse) FROM stdin;
\.


--
-- TOC entry 4371 (class 0 OID 262035)
-- Dependencies: 369
-- Data for Name: request; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY request (id, gender, createat, paxname, paxlastname, paxemail, birthdate, ipclient, captcha, sendclientrequest, sendagentrequest, remarks, type) FROM stdin;
1	1	2017-03-22	denis	denis	dlespinosa365@gmail.com	1999-03-22	127.0.0.1	tjqnno	t	t	dasf	TransferColectiveRequest
\.


--
-- TOC entry 4515 (class 0 OID 0)
-- Dependencies: 370
-- Name: request_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('request_id_seq', 1, true);


--
-- TOC entry 4425 (class 0 OID 268238)
-- Dependencies: 423
-- Data for Name: result; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY result (id, searcher_id, pickupplace, dropoffplace_id, market, obj, flight, createat, product, startdate, enddate, adults, kids, infant, passengers, pickup_time) FROM stdin;
5	716	\N	\N	1	55	\N	2017-03-24 16:12:53	CIRCUIT Soroa-Viñales	2017-04-19 00:00:00	\N	1	0	\N	\N	\N
6	718	\N	\N	1	10	\N	2017-03-27 12:06:21	TRANSFER Viñales - Punto Rex Melia Cohiba	2017-03-31 00:00:00	2017-04-01 00:00:00	\N	\N	\N	1	\N
7	718	\N	\N	1	11	\N	2017-03-27 12:06:21	TRANSFER Trinidad - Punto Rex Miramar	2017-03-31 00:00:00	2017-04-01 00:00:00	\N	\N	\N	1	\N
8	718	\N	\N	1	12	\N	2017-03-27 12:06:21	TRANSFER Punto Rex Miramar - Trinidad	2017-03-31 00:00:00	2017-04-01 00:00:00	\N	\N	\N	1	\N
9	718	\N	\N	1	13	\N	2017-03-27 12:06:21	TRANSFER Punto Rex Melia Cohiba - Trinidad	2017-03-31 00:00:00	2017-04-01 00:00:00	\N	\N	\N	1	\N
10	718	\N	\N	1	14	\N	2017-03-27 12:06:21	TRANSFER Trinidad - Punto Rex Melia Cohiba	2017-03-31 00:00:00	2017-04-01 00:00:00	\N	\N	\N	1	\N
11	718	\N	\N	1	15	\N	2017-03-27 12:06:21	TRANSFER Viñales - Punto Rex Miramar	2017-03-31 00:00:00	2017-04-01 00:00:00	\N	\N	\N	1	\N
12	718	\N	\N	1	16	\N	2017-03-27 12:06:21	TRANSFER Punto Rex Miramar - Viñales	2017-03-31 00:00:00	2017-04-01 00:00:00	\N	\N	\N	1	\N
\.


--
-- TOC entry 4516 (class 0 OID 0)
-- Dependencies: 422
-- Name: result_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('result_id_seq', 12, true);


--
-- TOC entry 4373 (class 0 OID 262044)
-- Dependencies: 371
-- Data for Name: review; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY review (id, description, votes, created_at, user_id, show, title, type, usefull) FROM stdin;
4	sdf	5	2017-01-06 15:47:03	2	f	sdf	ReviewHotel	1
6	asdasd	5	2017-01-06 21:15:37	2	f	asdasas	ReviewHotel	1
3	<p>The slice filter works as thePHP function for arrays and</p>\r\n\r\n<p>If the start is non-negative, the sequence will start at that start in the variable. If start is negative, the sequence will start that far from the end of the variable.</p>\r\n\r\n<p>If length is given and is positive, then the sequence will have up to that many elements in it. If the variable is shorter than the length, then only the available variable elements will be present. If length is given and is negative then the sequence will stop that many elements from the end of the variable. If it is omitted, then the sequence will have everything from offset up until the end of the variable.</p>\r\n\r\n<p>The slice filter works as thePHP function for arrays and</p>\r\n\r\n<p>If the start is non-negative, the sequence will start at that start in the variable. If start is negative, the sequence will start that far from the end of the variable.</p>\r\n\r\n<p>If length is given and is positive, then the sequence will have up to that many elements in it. If the variable is shorter than the length, then only the available variable elements will be present. If length is given and is negative then the sequence will stop that many elements from the end of the variable. If it is omitted, then the sequence will have everything from offset up until the end of the variable.</p>\r\n\r\n<p>The slice filter works as thePHP function for arrays and</p>\r\n\r\n<p>If the start is non-negative, the sequence will start at that start in the variable. If start is negative, the sequence will start that far from the end of the variable.</p>\r\n\r\n<p>If length is given and is positive, then the sequence will have up to that many elements in it. If the variable is shorter than the length, then only the available variable elements will be present. If length is given and is negative then the sequence will stop that many elements from the end of the variable. If it is omitted, then the sequence will have everything from offset up until the end of the variable.</p>	5	2016-12-26 15:08:03	2	t	la epste	ReviewHotel	20
5	asd	5	2017-01-06 21:04:34	2	f	asd	ReviewHotel	1
8	asd	5	2017-01-06 21:40:32	2	f	asd	ReviewHotel	1
10	asd	5	2017-01-09 15:53:36	2	f	asd	ReviewHotel	0
11	qd	5	2017-01-09 15:59:08	2	f	qdw	ReviewHotel	0
9	asas	5	2017-01-06 21:43:09	2	f	\N	ReviewHotel	2
12	sdfsdf	5	2017-01-10 12:15:30	2	f	dsfsdf	ReviewHotel	0
7	asd	5	2017-01-06 21:40:11	2	f	asd	ReviewHotel	1
13	asd	5	2017-01-10 17:02:17	2	f	asd	ReviewProduct	0
15	dfgd	5	2017-01-19 11:30:54	2	f	gdf	ReviewProduct	0
16	asd	5	2017-03-18 10:54:32	2	f	asd	ReviewProduct	0
14	holaa	5	2017-01-18 13:23:03	2	f	hola	ReviewProduct	1
\.


--
-- TOC entry 4415 (class 0 OID 264718)
-- Dependencies: 413
-- Data for Name: review_hotel; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY review_hotel (id, hotel_id) FROM stdin;
3	5
4	5
5	5
6	5
7	5
8	5
9	5
10	5
11	5
12	5
\.


--
-- TOC entry 4517 (class 0 OID 0)
-- Dependencies: 372
-- Name: review_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('review_id_seq', 16, true);


--
-- TOC entry 4417 (class 0 OID 264762)
-- Dependencies: 415
-- Data for Name: review_product; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY review_product (id, product_id) FROM stdin;
13	5
14	55
15	8
16	55
\.


--
-- TOC entry 4416 (class 0 OID 264730)
-- Dependencies: 414
-- Data for Name: review_rental_house; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY review_rental_house (id, rentalhouse_id) FROM stdin;
\.


--
-- TOC entry 4375 (class 0 OID 262053)
-- Dependencies: 373
-- Data for Name: room; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY room (id, picture, gallery, hotelid, title, description, slug, unique_slug, numberofbeds, area) FROM stdin;
1	\N	\N	5	Standart	\N	standart	1-standart	1	1
2	\N	\N	6	Room Standart - Melia Cohiba	\N	room-standart-melia-cohiba	2-room-standart-melia-cohiba	1	1
3	\N	\N	6	Junior Suite - Melia Habana	\N	junior-suite-melia-habana	3-junior-suite-melia-habana	1	1
4	\N	\N	7	Room Presidential - Memories Miramar	\N	room-presidential-memories-miramar	4-room-presidential-memories-miramar	1	1
5	\N	\N	7	Ejecutive Suite	\N	ejecutive-suite	5-ejecutive-suite	1	1
6	\N	\N	8	Room Standart - Iberostar Varadero	\N	room-standart-iberostar-varadero	6-room-standart-iberostar-varadero	1	1
7	\N	\N	8	Junior Suite-Iberostar Varadero	\N	junior-suite-iberostar-varadero	7-junior-suite-iberostar-varadero	1	1
\.


--
-- TOC entry 4376 (class 0 OID 262061)
-- Dependencies: 374
-- Data for Name: room_availability; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY room_availability (id, room, date) FROM stdin;
1	1	2016-11-23
2	1	2016-11-24
3	1	2016-11-25
4	1	2016-11-26
5	1	2016-11-27
6	1	2016-11-28
7	1	2016-12-02
8	1	2016-12-01
9	1	2016-11-30
10	1	2016-12-03
11	1	2016-11-29
12	1	2016-12-08
13	1	2016-12-06
14	1	2016-12-07
15	1	2016-12-09
16	1	2016-12-10
17	1	2016-12-12
18	1	2016-12-04
19	1	2016-12-11
20	1	2016-12-14
21	1	2016-12-05
22	1	2016-12-18
23	1	2016-12-19
24	1	2016-12-15
25	1	2016-12-13
26	1	2016-12-16
27	1	2016-12-17
28	1	2016-12-22
29	1	2016-12-20
30	1	2016-12-21
31	1	2016-12-23
32	1	2016-12-25
33	1	2016-12-24
34	1	2016-12-30
35	1	2016-12-27
36	1	2016-12-29
37	1	2016-12-31
38	1	2016-12-26
39	1	2016-12-28
40	1	2017-01-01
41	1	2017-01-02
42	1	2017-01-03
43	1	2017-01-05
44	1	2017-01-07
45	1	2017-01-09
46	1	2017-01-06
47	1	2017-01-11
48	1	2017-01-12
49	1	2017-01-13
50	1	2017-01-04
51	1	2017-01-15
52	1	2017-01-08
53	1	2017-01-16
54	1	2017-01-10
55	1	2017-01-18
56	1	2017-01-17
57	1	2017-01-20
58	1	2017-01-19
59	1	2017-01-21
60	1	2017-01-14
61	1	2017-01-25
62	1	2017-01-23
63	1	2017-01-27
64	1	2017-01-24
65	1	2017-02-19
66	1	2017-01-22
67	1	2017-01-26
68	1	2017-02-21
69	1	2017-02-24
70	1	2017-02-25
71	1	2017-02-23
72	1	2017-02-22
73	1	2017-02-27
74	1	2017-01-28
75	1	2017-03-01
76	1	2017-03-02
77	1	2017-02-26
78	1	2017-02-28
79	1	2017-03-04
80	1	2017-03-03
81	1	2017-03-12
82	1	2017-03-15
83	1	2017-03-13
84	1	2017-03-16
85	1	2017-02-20
86	1	2017-03-17
87	1	2017-03-19
88	1	2017-03-22
89	1	2017-03-21
90	1	2017-03-18
91	1	2017-03-23
92	1	2017-03-24
93	1	2017-03-20
94	1	2017-03-14
95	1	2017-03-26
96	1	2017-03-30
97	1	2017-03-25
98	1	2017-04-08
99	1	2017-03-28
100	1	2017-04-07
101	1	2017-04-01
103	1	2017-03-27
104	1	2017-04-05
105	1	2017-04-03
106	1	2017-04-04
107	1	2017-04-10
108	1	2017-03-29
109	1	2017-04-09
110	1	2017-04-11
111	1	2017-04-12
112	1	2017-04-14
113	1	2017-04-02
114	1	2017-04-15
115	1	2017-04-21
116	1	2017-04-22
117	1	2017-04-19
118	1	2017-04-18
119	1	2017-04-13
120	1	2017-04-16
121	1	2017-04-20
122	1	2017-04-24
123	1	2017-04-25
124	1	2017-04-23
125	1	2017-04-17
126	1	2017-04-28
127	1	2017-04-27
128	1	2017-04-26
129	1	2017-04-06
130	1	2017-04-29
131	3	2016-11-24
132	3	2016-11-25
133	3	2016-11-27
134	3	2016-11-28
135	3	2016-11-26
136	3	2016-11-29
137	3	2016-11-30
138	3	2016-12-05
139	3	2016-12-04
140	3	2016-12-02
141	3	2016-12-01
142	3	2016-12-08
143	3	2016-12-03
144	3	2016-12-12
145	3	2016-12-06
146	3	2016-12-15
147	3	2016-12-07
148	3	2016-12-11
149	3	2016-12-16
150	3	2016-12-19
151	3	2016-12-13
152	3	2016-12-14
153	3	2016-12-21
154	3	2016-12-22
155	3	2016-12-25
156	3	2016-12-18
157	3	2016-12-26
158	3	2016-12-27
159	3	2016-12-20
160	3	2016-12-28
161	3	2017-01-12
162	3	2017-01-10
163	3	2017-01-13
164	3	2017-01-14
165	3	2016-12-29
166	3	2017-01-11
167	3	2017-01-17
168	3	2017-01-15
169	3	2017-01-19
170	3	2017-01-16
171	3	2017-01-21
172	3	2017-01-20
173	3	2017-01-18
175	3	2017-01-25
176	3	2017-01-24
177	3	2017-01-26
178	3	2017-01-23
179	3	2017-02-01
180	3	2017-02-14
181	3	2017-02-02
182	3	2017-02-15
183	3	2017-02-03
185	3	2017-02-17
186	3	2017-01-30
187	3	2017-02-18
188	3	2017-02-19
189	3	2017-02-20
190	3	2017-02-23
191	3	2017-02-04
192	3	2017-02-22
193	3	2017-02-24
194	3	2017-02-25
195	3	2017-02-27
196	3	2017-02-26
197	3	2017-03-12
198	3	2017-03-13
199	3	2017-02-21
200	3	2017-03-14
201	3	2017-03-16
202	3	2017-03-15
203	3	2017-03-20
204	3	2017-02-28
205	3	2017-03-18
206	3	2017-03-23
207	3	2017-03-19
208	3	2017-03-21
209	3	2017-03-24
210	3	2017-03-22
211	3	2017-03-27
212	3	2017-04-02
213	3	2017-03-26
214	3	2017-03-17
215	3	2017-04-03
216	3	2017-04-06
217	3	2017-04-08
218	3	2017-04-04
219	3	2017-04-10
220	3	2017-04-05
221	3	2017-04-07
222	3	2017-04-09
223	3	2017-04-11
224	3	2017-04-01
225	3	2017-04-13
226	3	2017-04-14
227	3	2017-04-16
228	3	2017-04-17
229	3	2017-04-20
230	3	2017-04-21
231	3	2017-04-22
232	3	2017-04-12
233	3	2017-04-18
234	3	2017-04-19
235	3	2017-04-15
236	2	2016-11-23
237	2	2016-11-24
238	2	2016-11-26
239	2	2016-11-27
240	2	2016-11-29
241	2	2016-11-28
242	2	2016-11-30
243	2	2016-11-25
244	2	2016-12-07
245	2	2016-12-06
246	2	2016-12-05
247	2	2016-12-09
248	2	2016-12-04
249	2	2016-12-08
250	2	2016-12-10
251	2	2016-12-03
252	2	2016-12-01
253	2	2016-12-20
254	2	2016-12-19
255	2	2016-12-27
256	2	2016-12-22
257	2	2016-12-18
258	2	2016-12-28
259	2	2016-12-02
260	2	2016-12-21
261	2	2016-12-29
262	2	2017-01-08
263	2	2016-12-30
264	2	2016-12-31
266	2	2017-01-11
267	2	2017-01-10
268	2	2017-01-12
269	2	2017-01-14
270	2	2017-01-15
271	2	2017-01-17
272	2	2017-01-13
273	2	2017-01-20
274	2	2017-01-16
275	2	2017-01-30
276	2	2017-01-29
277	2	2017-01-18
278	2	2017-02-15
280	2	2017-01-31
281	2	2017-01-19
282	2	2017-02-20
283	2	2017-02-08
284	2	2017-02-23
286	2	2017-02-19
287	2	2017-02-21
288	2	2017-03-12
289	2	2017-03-14
290	2	2017-03-16
291	2	2017-03-15
292	2	2017-03-17
293	2	2017-03-18
294	2	2017-03-21
295	2	2017-03-13
296	2	2017-03-20
297	2	2017-03-19
299	2	2017-03-24
300	2	2017-03-25
301	2	2017-04-11
302	2	2017-04-14
303	2	2017-04-13
304	2	2017-04-17
305	2	2017-04-16
306	2	2017-04-19
307	2	2017-04-12
308	2	2017-04-15
309	2	2017-04-18
310	2	2017-04-21
311	2	2017-04-22
312	2	2017-04-20
313	2	2017-04-28
314	2	2017-04-23
315	2	2017-04-25
316	2	2017-04-27
317	2	2017-04-03
318	2	2017-04-02
319	2	2017-04-04
320	2	2017-04-06
321	2	2017-04-08
322	2	2017-04-10
323	2	2017-04-05
324	2	2017-04-07
325	2	2017-04-09
326	5	2016-11-27
327	5	2016-11-28
328	5	2016-11-29
329	5	2016-11-30
330	5	2016-12-11
331	5	2016-12-13
332	5	2016-12-14
333	5	2016-12-15
334	5	2016-12-16
336	5	2016-12-21
337	5	2016-12-22
338	5	2016-12-23
339	5	2016-12-20
340	5	2016-12-19
341	5	2016-12-24
342	5	2016-12-26
343	5	2016-12-17
344	5	2016-12-25
345	5	2016-12-27
346	5	2016-12-28
347	5	2016-12-30
348	5	2016-12-29
349	5	2016-12-18
350	5	2016-12-31
351	5	2016-12-12
352	5	2017-01-01
353	5	2017-01-02
354	5	2017-01-04
355	5	2017-01-05
356	5	2017-01-06
357	5	2017-01-12
358	5	2017-01-03
359	5	2017-01-07
360	5	2017-01-15
361	5	2017-01-08
362	5	2017-01-25
363	5	2017-01-23
364	5	2017-01-14
365	5	2017-02-09
366	5	2017-01-26
367	5	2017-01-31
368	5	2017-02-08
369	5	2017-02-21
370	5	2017-02-11
371	5	2017-02-22
372	5	2017-02-10
373	5	2017-04-17
374	5	2017-04-22
375	5	2017-04-28
376	5	2017-02-23
377	5	2017-04-27
378	5	2017-04-25
380	5	2017-04-29
381	5	2017-04-26
382	5	2017-04-23
383	5	2017-04-24
384	4	2016-11-27
385	4	2016-11-28
386	4	2016-11-29
387	4	2016-11-30
388	4	2016-11-23
389	4	2016-11-25
390	4	2016-11-24
391	4	2016-12-11
392	4	2016-12-15
393	4	2016-11-26
394	4	2016-12-12
395	4	2016-12-18
396	4	2016-12-13
397	4	2016-12-14
398	4	2016-12-21
399	4	2016-12-17
400	4	2016-12-22
401	4	2016-12-19
402	4	2016-12-16
403	4	2016-12-24
404	4	2016-12-20
405	4	2016-12-30
406	4	2016-12-23
407	4	2016-12-29
408	4	2016-12-31
409	4	2016-12-26
410	4	2016-12-27
411	4	2016-12-28
412	4	2016-12-25
413	4	2017-01-08
414	4	2017-01-09
415	4	2017-01-11
416	4	2017-01-13
417	4	2017-01-12
418	4	2017-01-10
419	4	2017-01-14
420	4	2017-01-23
421	4	2017-01-31
422	4	2017-01-15
423	4	2017-02-13
424	4	2017-02-14
425	4	2017-01-24
426	4	2017-02-15
427	4	2017-01-30
428	4	2017-01-29
429	4	2017-02-20
430	4	2017-02-23
431	4	2017-02-21
432	4	2017-02-26
433	4	2017-03-12
434	4	2017-02-18
435	4	2017-02-19
436	4	2017-03-14
437	4	2017-02-28
438	4	2017-02-27
440	4	2017-03-15
441	4	2017-03-19
442	4	2017-03-21
443	4	2017-03-17
444	4	2017-03-23
445	4	2017-03-16
446	4	2017-03-24
447	4	2017-03-13
448	4	2017-03-22
449	4	2017-03-26
450	4	2017-03-25
451	4	2017-03-28
452	4	2017-03-29
454	4	2017-04-11
455	4	2017-03-27
456	4	2017-04-13
457	4	2017-03-30
458	4	2017-04-10
459	4	2017-04-08
460	4	2017-04-12
462	4	2017-04-14
463	4	2017-04-15
464	4	2017-04-06
465	4	2017-04-05
466	4	2017-04-02
467	4	2017-04-04
468	4	2017-04-16
469	4	2017-04-17
470	4	2017-04-18
471	4	2017-04-03
472	4	2017-04-22
473	4	2017-04-21
474	4	2017-04-23
475	4	2017-04-20
476	4	2017-04-27
477	4	2017-04-24
478	4	2017-04-19
479	4	2017-04-25
480	4	2017-04-30
481	4	2017-04-28
482	4	2017-04-26
483	4	2017-04-29
484	5	2017-03-14
485	5	2017-03-15
486	5	2017-03-16
487	5	2017-03-17
488	5	2017-03-20
489	5	2017-03-21
490	5	2017-03-23
491	5	2017-03-19
492	5	2017-03-18
493	5	2017-04-19
494	5	2017-04-20
495	5	2017-01-09
496	5	2017-01-13
497	5	2017-04-21
498	5	2017-01-10
499	5	2017-02-26
500	5	2017-01-11
501	5	2017-01-28
502	5	2017-02-28
503	5	2017-01-27
504	5	2017-01-29
505	5	2017-02-27
506	5	2017-01-30
507	5	2017-02-24
508	5	2017-01-24
509	5	2017-01-16
510	5	2017-01-22
511	7	2016-11-23
512	7	2016-11-24
513	7	2016-11-25
514	7	2016-11-27
515	7	2016-11-26
516	7	2016-12-11
517	7	2016-11-29
518	7	2016-11-30
519	7	2016-12-19
520	7	2016-11-28
521	7	2016-12-18
522	7	2016-12-13
523	7	2016-12-14
524	7	2016-12-15
525	7	2016-12-20
526	7	2016-12-12
527	7	2016-12-23
528	7	2016-12-21
529	7	2016-12-16
530	7	2016-12-22
531	7	2016-12-24
532	7	2016-12-17
533	7	2016-12-27
534	7	2016-12-31
535	7	2016-12-28
536	7	2016-12-29
537	7	2016-12-30
538	7	2017-01-01
539	7	2017-01-02
540	7	2017-01-03
541	7	2017-01-05
542	7	2017-01-06
543	7	2017-01-04
544	7	2017-01-12
545	7	2017-01-11
546	7	2017-01-10
547	7	2017-01-14
548	7	2017-01-09
549	7	2017-01-07
550	7	2017-01-13
551	7	2017-01-08
552	7	2017-01-19
553	7	2017-01-15
554	7	2017-01-21
555	7	2017-01-20
556	7	2017-01-18
557	7	2017-01-16
558	7	2017-01-31
559	7	2017-01-17
560	7	2017-02-05
561	7	2017-01-29
562	7	2017-01-30
563	7	2017-02-06
564	7	2017-02-10
565	7	2017-02-18
566	7	2017-02-07
567	7	2017-02-17
568	7	2017-02-16
569	7	2017-02-09
570	7	2017-02-08
571	7	2017-02-13
572	7	2017-02-12
573	7	2017-02-11
574	7	2017-02-19
575	7	2017-02-15
576	7	2017-02-14
577	7	2017-02-24
578	7	2017-02-25
579	7	2017-02-20
580	7	2017-02-21
581	7	2017-02-28
582	7	2017-02-22
583	7	2017-03-05
584	7	2017-02-23
585	7	2017-02-27
586	7	2017-02-26
587	7	2017-03-08
588	7	2017-03-07
589	7	2017-03-06
590	7	2017-03-09
591	7	2017-03-11
592	7	2017-03-10
593	7	2017-03-18
594	7	2017-03-17
596	7	2017-03-16
597	7	2017-03-19
598	7	2017-03-20
599	7	2017-03-13
600	7	2017-03-22
601	7	2017-03-12
602	7	2017-03-23
603	7	2017-03-14
604	7	2017-03-21
606	7	2017-03-28
607	7	2017-03-26
608	7	2017-03-29
609	7	2017-04-09
610	7	2017-04-10
611	7	2017-04-11
612	7	2017-03-27
613	7	2017-04-14
614	7	2017-04-12
616	7	2017-04-13
617	7	2017-04-18
618	7	2017-04-15
619	7	2017-04-20
620	7	2017-04-16
622	7	2017-04-23
623	7	2017-04-19
624	7	2017-04-25
625	7	2017-04-24
626	7	2017-04-27
627	7	2017-04-28
628	7	2017-04-29
629	7	2017-04-26
630	7	2017-04-22
631	6	2016-12-20
632	6	2016-12-21
633	6	2016-12-23
634	6	2016-12-24
635	6	2017-01-08
636	6	2017-01-09
637	6	2017-01-10
638	6	2017-01-13
639	6	2017-01-16
640	6	2017-01-11
641	6	2017-01-17
642	6	2017-01-19
643	6	2017-01-12
644	6	2017-01-14
645	6	2017-02-15
646	6	2017-01-15
647	6	2017-02-18
648	6	2017-02-20
649	6	2017-02-22
650	6	2017-01-18
651	6	2017-01-20
652	6	2017-02-27
653	6	2017-02-16
654	6	2017-03-13
655	6	2017-03-16
656	6	2017-02-28
657	6	2017-03-17
658	6	2017-03-18
659	6	2017-03-24
660	6	2017-03-14
661	6	2017-03-15
662	6	2017-03-25
664	6	2017-03-26
665	6	2017-03-23
666	6	2017-03-20
667	6	2017-03-27
668	6	2017-03-30
669	6	2017-03-28
670	6	2017-03-22
671	6	2017-04-03
672	6	2017-04-02
673	6	2017-04-06
674	6	2017-04-05
675	6	2017-04-04
676	6	2017-04-01
677	6	2017-04-07
678	6	2017-04-08
679	6	2017-04-09
680	6	2017-04-12
681	6	2017-04-11
682	6	2017-03-29
683	6	2017-04-14
684	6	2017-04-15
686	6	2017-04-22
687	6	2017-04-10
688	6	2017-04-20
689	6	2017-04-21
690	6	2017-04-16
691	6	2017-04-19
692	6	2017-04-18
693	6	2017-04-17
694	6	2017-04-25
695	6	2017-04-23
696	6	2017-04-24
697	6	2017-04-26
698	6	2017-04-29
699	6	2017-04-27
700	6	2017-04-30
701	6	2017-04-28
\.


--
-- TOC entry 4518 (class 0 OID 0)
-- Dependencies: 375
-- Name: room_availability_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('room_availability_id_seq', 701, true);


--
-- TOC entry 4378 (class 0 OID 262066)
-- Dependencies: 376
-- Data for Name: room_facilities_rooms; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY room_facilities_rooms (room_id, rental_house_room_facility_id) FROM stdin;
2	2
2	3
3	2
3	3
4	4
5	6
5	5
6	7
6	8
7	9
7	10
1	11
\.


--
-- TOC entry 4519 (class 0 OID 0)
-- Dependencies: 377
-- Name: room_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('room_id_seq', 7, true);


--
-- TOC entry 4380 (class 0 OID 262076)
-- Dependencies: 378
-- Data for Name: sale; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY sale (id, curency, market, client_id, error, response, card_country, auth_code, card_type, date, amount, description, orderid, status, pdf_view, created, created_from_ip) FROM stdin;
1	1	1	2	\N	\N	\N	\N	\N	2016-12-04 11:50:08	\N	\N	1001DQ	\N	0	2016-12-04 11:50:08	127.0.0.1
2	1	1	2	\N	12	US	CU	DBT	2016-12-04 11:58:15	60	Transacción autorizada para pagos y preautorizaciones	1002DQ	\N	1	2016-12-04 11:58:15	127.0.0.1
3	1	1	2	\N	33	US	CU	DBT	2016-12-04 12:04:12	110	Transacción autorizada para pagos y preautorizaciones	1003DQ	\N	2	2016-12-04 12:04:12	127.0.0.1
4	1	1	2	\N	28	US	CU	DBT	2016-12-16 01:03:46	50	Transacción autorizada para pagos y preautorizaciones	1004DQ	\N	2	2016-12-16 01:03:46	127.0.0.1
\.


--
-- TOC entry 4520 (class 0 OID 0)
-- Dependencies: 379
-- Name: sale_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('sale_id_seq', 4, true);


--
-- TOC entry 4382 (class 0 OID 262094)
-- Dependencies: 380
-- Data for Name: searcher; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY searcher (id, user_id, createat, type, duration) FROM stdin;
1	1	2016-11-14 00:00:00	CarSearcher	0
2	1	2016-11-14 00:00:00	CarSearcher	0
3	1	2016-11-14 00:00:00	CarSearcher	0
4	1	2016-11-14 00:00:00	CarSearcher	0
5	1	2016-11-14 00:00:00	CarSearcher	0
6	1	2016-11-14 00:00:00	CarSearcher	0
7	1	2016-11-14 00:00:00	CarSearcher	0
8	1	2016-11-14 00:00:00	CarSearcher	0
9	1	2016-11-14 00:00:00	CarSearcher	0
10	1	2016-11-14 00:00:00	CarSearcher	0
11	1	2016-11-14 00:00:00	CarSearcher	0
12	1	2016-11-14 00:00:00	CarSearcher	0
13	1	2016-11-14 00:00:00	CarSearcher	0
14	1	2016-11-14 00:00:00	CarSearcher	0
15	1	2016-11-14 00:00:00	CarSearcher	0
16	1	2016-11-14 00:00:00	CarSearcher	0
17	1	2016-11-14 00:00:00	CarSearcher	0
18	1	2016-11-14 00:00:00	CarSearcher	0
19	1	2016-11-14 00:00:00	CarSearcher	0
20	1	2016-11-14 00:00:00	CarSearcher	0
21	1	2016-11-14 00:00:00	CarSearcher	0
22	1	2016-11-14 00:00:00	CarSearcher	0
55	\N	2016-11-14 00:00:00	CarSearcher	0
56	\N	2016-11-14 00:00:00	CarSearcher	0
57	\N	2016-11-14 00:00:00	CarSearcher	0
89	1	2016-11-14 00:00:00	CarSearcher	0
90	1	2016-11-14 00:00:00	CarSearcher	0
91	1	2016-11-14 00:00:00	CarSearcher	0
92	1	2016-11-14 00:00:00	CarSearcher	0
93	1	2016-11-14 00:00:00	CarSearcher	0
94	1	2016-11-14 00:00:00	ExcursionSearcher	0
95	1	2016-11-14 00:00:00	ExcursionSearcher	0
96	1	2016-11-14 00:00:00	ExcursionSearcher	0
97	1	2016-11-14 00:00:00	ExcursionSearcher	0
98	1	2016-11-14 00:00:00	ExcursionSearcher	0
99	1	2016-11-14 00:00:00	CarSearcher	0
100	\N	2016-11-14 00:00:00	CarSearcher	0
133	1	2016-11-15 00:00:00	CircuitSearcher	0
134	1	2016-11-16 00:00:00	TransferSearcher	0
135	1	2016-11-16 00:00:00	TransferSearcher	0
136	1	2016-11-17 00:00:00	TransferSearcher	0
137	\N	2016-11-17 00:00:00	TransferSearcher	0
138	\N	2016-11-17 00:00:00	TransferSearcher	0
139	\N	2016-11-17 00:00:00	TransferSearcher	0
140	\N	2016-11-17 00:00:00	TransferSearcher	0
141	\N	2016-11-17 00:00:00	TransferSearcher	0
142	\N	2016-11-17 00:00:00	TransferSearcher	0
143	\N	2016-11-19 00:00:00	TransferSearcher	0
144	\N	2016-11-19 00:00:00	TransferSearcher	0
145	\N	2016-11-19 00:00:00	TransferSearcher	0
146	\N	2016-11-19 00:00:00	TransferSearcher	0
147	\N	2016-11-19 00:00:00	TransferSearcher	0
148	\N	2016-11-19 00:00:00	TransferSearcher	0
149	\N	2016-11-19 00:00:00	TransferSearcher	0
150	\N	2016-11-19 00:00:00	TransferSearcher	0
151	\N	2016-11-19 00:00:00	TransferSearcher	0
152	\N	2016-11-19 00:00:00	TransferSearcher	0
153	1	2016-11-19 00:00:00	TransferSearcher	0
154	1	2016-11-19 00:00:00	TransferSearcher	0
155	1	2016-11-19 00:00:00	TransferSearcher	0
156	1	2016-11-19 00:00:00	TransferSearcher	0
157	1	2016-11-19 00:00:00	TransferSearcher	0
158	1	2016-11-19 00:00:00	TransferSearcher	0
159	1	2016-11-19 00:00:00	TransferSearcher	0
160	1	2016-11-19 00:00:00	TransferSearcher	0
161	1	2016-11-19 00:00:00	TransferSearcher	0
162	1	2016-11-19 00:00:00	TransferSearcher	0
163	1	2016-11-19 00:00:00	TransferSearcher	0
164	1	2016-11-19 00:00:00	TransferSearcher	0
165	1	2016-11-19 00:00:00	TransferSearcher	0
166	1	2016-11-19 00:00:00	TransferSearcher	0
167	1	2016-11-19 00:00:00	TransferSearcher	0
168	1	2016-11-19 00:00:00	TransferSearcher	0
169	1	2016-11-19 00:00:00	TransferSearcher	0
170	1	2016-11-19 00:00:00	TransferSearcher	0
171	1	2016-11-19 00:00:00	TransferSearcher	0
242	1	2016-11-22 00:00:00	TransferSearcher	0
243	1	2016-11-23 00:00:00	CircuitSearcher	0
244	1	2016-11-23 00:00:00	CircuitSearcher	0
245	1	2016-11-23 00:00:00	CircuitSearcher	0
246	1	2016-11-23 00:00:00	CircuitSearcher	0
247	1	2016-11-23 00:00:00	CircuitSearcher	0
248	1	2016-11-23 00:00:00	CircuitSearcher	0
249	1	2016-11-23 00:00:00	CircuitSearcher	0
250	1	2016-11-23 00:00:00	CircuitSearcher	0
251	1	2016-11-23 00:00:00	CircuitSearcher	0
252	1	2016-11-23 00:00:00	CircuitSearcher	0
253	1	2016-11-23 00:00:00	CircuitSearcher	0
254	1	2016-11-23 00:00:00	CircuitSearcher	0
255	1	2016-11-23 00:00:00	CircuitSearcher	0
256	1	2016-11-23 00:00:00	CircuitSearcher	0
257	1	2016-11-23 00:00:00	CircuitSearcher	0
258	1	2016-11-23 00:00:00	CircuitSearcher	0
259	1	2016-11-23 00:00:00	CircuitSearcher	0
260	1	2016-11-23 00:00:00	CircuitSearcher	0
261	1	2016-11-23 00:00:00	CircuitSearcher	0
262	1	2016-11-23 00:00:00	CircuitSearcher	0
263	1	2016-11-23 00:00:00	CircuitSearcher	0
264	1	2016-11-23 00:00:00	CircuitSearcher	0
265	1	2016-11-23 00:00:00	CircuitSearcher	0
266	1	2016-11-23 00:00:00	CircuitSearcher	0
267	1	2016-11-23 00:00:00	CircuitSearcher	0
268	1	2016-11-23 00:00:00	CircuitSearcher	0
269	1	2016-11-23 00:00:00	CircuitSearcher	0
270	1	2016-11-23 00:00:00	CircuitSearcher	0
271	1	2016-11-23 00:00:00	CircuitSearcher	0
272	1	2016-11-23 00:00:00	CircuitSearcher	0
273	1	2016-11-23 00:00:00	CircuitSearcher	0
274	1	2016-11-23 00:00:00	CircuitSearcher	0
275	1	2016-11-23 00:00:00	CircuitSearcher	0
276	2	2016-11-23 00:00:00	CarSearcher	0
277	2	2016-11-23 00:00:00	CarSearcher	0
278	2	2016-11-23 00:00:00	CarSearcher	0
279	2	2016-11-23 00:00:00	CarSearcher	0
280	2	2016-11-23 00:00:00	CarSearcher	0
281	2	2016-11-23 00:00:00	CarSearcher	0
282	2	2016-11-23 00:00:00	CarSearcher	0
283	2	2016-11-23 00:00:00	CarSearcher	0
284	2	2016-11-23 00:00:00	CarSearcher	0
285	2	2016-11-24 00:00:00	CarSearcher	0
286	2	2016-11-24 00:00:00	CarSearcher	0
287	2	2016-11-24 00:00:00	CarSearcher	0
288	2	2016-11-24 00:00:00	ExcursionSearcher	0
289	2	2016-11-24 00:00:00	ExcursionSearcher	0
290	2	2016-11-24 00:00:00	ExcursionSearcher	0
291	2	2016-11-24 00:00:00	ExcursionSearcher	0
292	2	2016-11-24 00:00:00	ExcursionSearcher	0
293	2	2016-11-24 00:00:00	ExcursionSearcher	0
294	2	2016-11-25 00:00:00	ExcursionSearcher	0
295	2	2016-11-25 00:00:00	ExcursionSearcher	0
296	2	2016-11-25 00:00:00	ExcursionSearcher	0
297	2	2016-11-25 00:00:00	ExcursionSearcher	0
298	2	2016-11-25 00:00:00	ExcursionSearcher	0
299	2	2016-11-25 00:00:00	ExcursionSearcher	0
300	2	2016-11-25 00:00:00	ExcursionSearcher	0
301	2	2016-11-25 00:00:00	ExcursionSearcher	0
302	2	2016-11-25 00:00:00	TransferSearcher	0
303	2	2016-11-25 00:00:00	TransferSearcher	0
304	2	2016-11-25 00:00:00	TransferSearcher	0
305	2	2016-11-25 00:00:00	TransferSearcher	0
306	2	2016-11-25 00:00:00	TransferSearcher	0
307	2	2016-11-25 00:00:00	TransferSearcher	0
308	2	2016-11-25 00:00:00	TransferSearcher	0
309	2	2016-11-25 00:00:00	TransferSearcher	0
310	2	2016-11-25 00:00:00	TransferSearcher	0
311	2	2016-11-25 00:00:00	TransferSearcher	0
312	2	2016-11-25 00:00:00	TransferSearcher	0
313	2	2016-11-25 00:00:00	TransferSearcher	0
314	2	2016-11-25 00:00:00	TransferSearcher	0
315	2	2016-11-25 00:00:00	TransferSearcher	0
316	2	2016-11-27 00:00:00	RentalHouseRoomSearcher	0
317	2	2016-11-27 00:00:00	RentalHouseRoomSearcher	0
318	2	2016-11-27 00:00:00	RentalHouseRoomSearcher	0
319	2	2016-11-27 00:00:00	RentalHouseRoomSearcher	0
320	2	2016-11-27 00:00:00	RentalHouseRoomSearcher	0
321	2	2016-11-27 00:00:00	RentalHouseRoomSearcher	0
322	2	2016-11-27 00:00:00	RentalHouseRoomSearcher	0
323	2	2016-12-02 00:00:00	CarSearcher	0
359	2	2016-12-03 00:00:00	ExcursionSearcher	0
360	2	2016-12-03 00:00:00	ExcursionSearcher	0
361	2	2016-12-03 00:00:00	ExcursionSearcher	0
362	2	2016-12-03 00:00:00	ExcursionSearcher	0
363	2	2016-12-03 00:00:00	ExcursionSearcher	0
364	2	2016-12-03 00:00:00	ExcursionSearcher	0
365	2	2016-12-03 00:00:00	CircuitSearcher	0
366	2	2016-12-03 00:00:00	CircuitSearcher	0
367	2	2016-12-03 00:00:00	CircuitSearcher	0
368	2	2016-12-03 00:00:00	CircuitSearcher	0
369	2	2016-12-03 00:00:00	CircuitSearcher	0
370	2	2016-12-03 00:00:00	CircuitSearcher	0
371	2	2016-12-03 00:00:00	CircuitSearcher	0
372	2	2016-12-03 00:00:00	ExcursionSearcher	0
373	2	2016-12-03 00:00:00	ExcursionSearcher	0
374	2	2016-12-03 00:00:00	ExcursionSearcher	0
375	2	2016-12-03 00:00:00	ExcursionSearcher	0
376	2	2016-12-03 00:00:00	CarSearcher	0
377	2	2016-12-03 00:00:00	CarSearcher	0
378	2	2016-12-03 00:00:00	CarSearcher	0
379	2	2016-12-03 00:00:00	RentalHouseRoomSearcher	0
380	2	2016-12-03 00:00:00	CarSearcher	0
381	2	2016-12-03 00:00:00	TransferSearcher	0
382	2	2016-12-03 00:00:00	TransferSearcher	0
383	2	2016-12-03 00:00:00	TransferSearcher	0
384	2	2016-12-03 00:00:00	TransferSearcher	0
385	2	2016-12-03 00:00:00	TransferSearcher	0
386	2	2016-12-03 00:00:00	RentalHouseRoomSearcher	0
387	2	2016-12-03 00:00:00	RentalHouseRoomSearcher	0
388	2	2016-12-03 00:00:00	RentalHouseRoomSearcher	0
389	2	2016-12-04 00:00:00	TransferSearcher	0
391	2	2016-12-05 00:00:00	CarSearcher	0
392	2	2016-12-05 00:00:00	CarSearcher	0
393	2	2016-12-05 00:00:00	CarSearcher	0
394	2	2016-12-05 00:00:00	CarSearcher	0
395	2	2016-12-05 00:00:00	CarSearcher	0
396	2	2016-12-05 00:00:00	CarSearcher	0
397	2	2016-12-05 00:00:00	CarSearcher	0
398	2	2016-12-05 00:00:00	CarSearcher	0
399	2	2016-12-05 00:00:00	CarSearcher	0
400	2	2016-12-05 00:00:00	CarSearcher	0
401	2	2016-12-05 00:00:00	CarSearcher	0
402	2	2016-12-05 00:00:00	CarSearcher	0
403	2	2016-12-05 00:00:00	CarSearcher	0
404	2	2016-12-05 00:00:00	CarSearcher	0
405	2	2016-12-05 00:00:00	CarSearcher	0
406	2	2016-12-05 00:00:00	CarSearcher	0
407	2	2016-12-05 00:00:00	CarSearcher	0
408	2	2016-12-05 00:00:00	CarSearcher	0
409	2	2016-12-05 00:00:00	CarSearcher	0
410	2	2016-12-05 00:00:00	CarSearcher	0
411	2	2016-12-14 00:00:00	RentalHouseRoomSearcher	0
412	2	2016-12-14 00:00:00	RentalHouseRoomSearcher	0
413	2	2016-12-14 00:00:00	RentalHouseRoomSearcher	0
414	2	2016-12-14 00:00:00	RentalHouseRoomSearcher	0
415	2	2016-12-14 00:00:00	RentalHouseRoomSearcher	0
416	2	2016-12-14 00:00:00	RentalHouseRoomSearcher	0
417	2	2016-12-16 00:00:00	RentalHouseRoomSearcher	0
418	2	2016-12-16 00:00:00	RentalHouseRoomSearcher	0
419	2	2016-12-16 00:00:00	RentalHouseRoomSearcher	0
420	2	2016-12-16 00:00:00	RentalHouseRoomSearcher	0
421	2	2016-12-16 00:00:00	RentalHouseRoomSearcher	0
422	2	2016-12-20 00:00:00	TransferSearcher	0
489	2	2017-01-10 00:00:00	ExcursionSearcher	0
490	2	2017-01-10 00:00:00	ExcursionSearcher	0
491	2	2017-01-10 00:00:00	ExcursionSearcher	0
499	2	2017-01-13 00:00:00	ExcursionSearcher	0
500	2	2017-01-13 00:00:00	ExcursionSearcher	0
501	2	2017-01-13 00:00:00	ExcursionSearcher	0
502	2	2017-01-13 00:00:00	ExcursionSearcher	0
503	2	2017-01-13 00:00:00	ExcursionSearcher	0
504	2	2017-01-13 00:00:00	ExcursionSearcher	0
505	2	2017-01-13 00:00:00	ExcursionSearcher	0
506	2	2017-01-13 00:00:00	ExcursionSearcher	0
507	2	2017-01-13 00:00:00	ExcursionSearcher	0
508	2	2017-01-13 00:00:00	ExcursionSearcher	0
509	2	2017-01-13 00:00:00	ExcursionSearcher	0
510	2	2017-01-13 00:00:00	ExcursionSearcher	0
511	2	2017-01-13 00:00:00	ExcursionSearcher	0
534	2	2017-01-16 00:00:00	ExcursionSearcher	0
535	2	2017-01-16 00:00:00	ExcursionSearcher	0
536	2	2017-01-16 00:00:00	ExcursionSearcher	0
537	2	2017-01-16 00:00:00	ExcursionSearcher	0
538	2	2017-01-16 00:00:00	ExcursionSearcher	0
539	2	2017-01-16 00:00:00	ExcursionSearcher	0
540	2	2017-01-16 00:00:00	ExcursionSearcher	0
541	2	2017-01-16 00:00:00	ExcursionSearcher	0
542	2	2017-01-16 00:00:00	ExcursionSearcher	0
543	2	2017-01-16 00:00:00	ExcursionSearcher	0
544	2	2017-01-16 00:00:00	ExcursionSearcher	0
545	2	2017-01-16 00:00:00	ExcursionSearcher	0
546	2	2017-01-16 00:00:00	ExcursionSearcher	0
547	2	2017-01-16 00:00:00	ExcursionSearcher	0
548	2	2017-01-16 00:00:00	ExcursionSearcher	0
549	2	2017-01-16 00:00:00	ExcursionSearcher	0
550	2	2017-01-16 00:00:00	ExcursionSearcher	0
551	2	2017-01-16 00:00:00	ExcursionSearcher	0
552	2	2017-01-16 00:00:00	ExcursionSearcher	0
553	2	2017-01-16 00:00:00	ExcursionSearcher	0
554	\N	2017-01-16 00:00:00	ExcursionSearcher	0
555	\N	2017-01-16 00:00:00	ExcursionSearcher	0
556	\N	2017-01-16 00:00:00	ExcursionSearcher	0
557	\N	2017-01-16 00:00:00	ExcursionSearcher	0
558	\N	2017-01-16 00:00:00	ExcursionSearcher	0
559	\N	2017-01-16 00:00:00	ExcursionSearcher	0
560	\N	2017-01-16 00:00:00	ExcursionSearcher	0
561	\N	2017-01-16 00:00:00	ExcursionSearcher	0
562	\N	2017-01-16 00:00:00	ExcursionSearcher	0
563	\N	2017-01-16 00:00:00	ExcursionSearcher	0
564	\N	2017-01-16 00:00:00	ExcursionSearcher	0
565	\N	2017-01-16 00:00:00	ExcursionSearcher	0
566	\N	2017-01-16 00:00:00	ExcursionSearcher	0
567	\N	2017-01-16 00:00:00	ExcursionSearcher	0
568	\N	2017-01-16 00:00:00	ExcursionSearcher	0
569	\N	2017-01-16 00:00:00	ExcursionSearcher	0
570	\N	2017-01-16 00:00:00	ExcursionSearcher	0
571	\N	2017-01-16 00:00:00	ExcursionSearcher	0
572	\N	2017-01-16 00:00:00	CircuitSearcher	0
573	\N	2017-01-16 00:00:00	CircuitSearcher	0
574	\N	2017-01-16 00:00:00	CircuitSearcher	0
575	\N	2017-01-16 00:00:00	CircuitSearcher	0
576	2	2017-01-16 00:00:00	CircuitSearcher	0
577	2	2017-01-16 00:00:00	CircuitSearcher	0
578	2	2017-01-17 00:00:00	ExcursionSearcher	0
579	2	2017-01-17 00:00:00	ExcursionSearcher	0
580	2	2017-01-17 00:00:00	CircuitSearcher	0
581	2	2017-01-17 00:00:00	CircuitSearcher	0
582	2	2017-01-17 00:00:00	CircuitSearcher	0
583	2	2017-01-17 00:00:00	CircuitSearcher	0
584	2	2017-01-17 00:00:00	CircuitSearcher	0
585	2	2017-01-17 00:00:00	CircuitSearcher	0
586	2	2017-01-17 00:00:00	CircuitSearcher	0
587	2	2017-01-17 00:00:00	CircuitSearcher	0
588	2	2017-01-17 00:00:00	CircuitSearcher	0
589	2	2017-01-17 00:00:00	CircuitSearcher	0
590	2	2017-01-17 00:00:00	CircuitSearcher	0
591	2	2017-01-17 00:00:00	CircuitSearcher	0
592	2	2017-01-17 00:00:00	CircuitSearcher	0
593	2	2017-01-17 00:00:00	CircuitSearcher	0
594	2	2017-01-17 00:00:00	CircuitSearcher	0
595	2	2017-01-17 00:00:00	CircuitSearcher	0
596	2	2017-01-17 00:00:00	CircuitSearcher	0
597	2	2017-01-17 00:00:00	CircuitSearcher	0
598	2	2017-01-17 00:00:00	CircuitSearcher	0
599	2	2017-01-17 00:00:00	CircuitSearcher	0
600	2	2017-01-17 00:00:00	CircuitSearcher	0
601	2	2017-01-17 00:00:00	CircuitSearcher	0
602	2	2017-01-17 00:00:00	CircuitSearcher	0
603	2	2017-01-17 00:00:00	CircuitSearcher	0
604	2	2017-01-17 00:00:00	CircuitSearcher	0
605	2	2017-01-17 00:00:00	CircuitSearcher	0
606	2	2017-01-17 00:00:00	CircuitSearcher	0
607	2	2017-01-17 00:00:00	CircuitSearcher	0
608	2	2017-01-17 00:00:00	CircuitSearcher	0
609	2	2017-01-17 00:00:00	CircuitSearcher	0
610	2	2017-01-17 00:00:00	CircuitSearcher	0
611	2	2017-01-17 00:00:00	CircuitSearcher	0
612	2	2017-01-17 00:00:00	CircuitSearcher	0
613	2	2017-01-17 00:00:00	CircuitSearcher	0
614	2	2017-01-17 00:00:00	CircuitSearcher	0
615	2	2017-01-17 00:00:00	CircuitSearcher	0
616	2	2017-01-17 00:00:00	CircuitSearcher	0
617	2	2017-01-17 00:00:00	CircuitSearcher	0
618	2	2017-01-17 00:00:00	CircuitSearcher	0
619	2	2017-01-17 00:00:00	CircuitSearcher	0
620	2	2017-01-17 00:00:00	CircuitSearcher	0
621	2	2017-01-17 00:00:00	CircuitSearcher	0
622	2	2017-01-17 00:00:00	CircuitSearcher	0
623	2	2017-01-17 00:00:00	CircuitSearcher	0
624	2	2017-01-17 00:00:00	CircuitSearcher	0
625	2	2017-01-17 00:00:00	CircuitSearcher	0
626	2	2017-01-17 00:00:00	CircuitSearcher	0
627	2	2017-01-17 00:00:00	CircuitSearcher	0
628	2	2017-01-17 00:00:00	CircuitSearcher	0
629	2	2017-01-18 00:00:00	CircuitSearcher	0
630	2	2017-01-18 00:00:00	CircuitSearcher	0
631	\N	2017-01-19 00:00:00	CircuitSearcher	0
632	\N	2017-01-19 00:00:00	CircuitSearcher	0
633	\N	2017-01-19 00:00:00	CircuitSearcher	0
634	\N	2017-01-19 00:00:00	CircuitSearcher	0
635	2	2017-01-19 00:00:00	ExcursionSearcher	0
636	2	2017-01-19 00:00:00	ExcursionSearcher	0
637	2	2017-01-26 00:00:00	CircuitSearcher	0
638	2	2017-01-26 00:00:00	CircuitSearcher	0
639	2	2017-01-26 00:00:00	CircuitSearcher	0
640	2	2017-01-26 00:00:00	CircuitSearcher	0
641	2	2017-01-26 00:00:00	CircuitSearcher	0
642	2	2017-01-26 00:00:00	CircuitSearcher	0
643	2	2017-01-26 00:00:00	CircuitSearcher	0
644	2	2017-01-26 00:00:00	CircuitSearcher	0
645	2	2017-01-26 00:00:00	CircuitSearcher	0
646	2	2017-01-27 00:00:00	CircuitSearcher	0
647	2	2017-01-27 00:00:00	CircuitSearcher	0
648	2	2017-01-27 00:00:00	CircuitSearcher	0
649	2	2017-01-27 00:00:00	CircuitSearcher	0
650	2	2017-01-27 00:00:00	CircuitSearcher	0
651	2	2017-01-27 00:00:00	CircuitSearcher	0
652	2	2017-01-27 00:00:00	CircuitSearcher	0
653	2	2017-01-27 00:00:00	CircuitSearcher	0
654	2	2017-01-27 00:00:00	CircuitSearcher	0
655	2	2017-03-18 00:00:00	CircuitSearcher	0
656	\N	2017-03-18 00:00:00	TransferSearcher	0
657	\N	2017-03-18 00:00:00	ExcursionSearcher	0
658	\N	2017-03-18 00:00:00	ExcursionSearcher	0
659	2	2017-03-18 00:00:00	ExcursionSearcher	0
661	2	2017-03-21 00:00:00	CircuitSearcher	0
662	2	2017-03-21 00:00:00	CircuitSearcher	0
663	2	2017-03-21 00:00:00	TransferSearcher	0
664	2	2017-03-21 00:00:00	CircuitSearcher	0
665	2	2017-03-21 00:00:00	CircuitSearcher	0
666	2	2017-03-22 00:00:00	CircuitSearcher	0
667	2	2017-03-22 00:00:00	CircuitSearcher	0
668	2	2017-03-22 00:00:00	CircuitSearcher	0
669	2	2017-03-22 00:00:00	CircuitSearcher	0
670	2	2017-03-22 00:00:00	CircuitSearcher	0
671	2	2017-03-22 00:00:00	CircuitSearcher	0
672	2	2017-03-22 00:00:00	CircuitSearcher	0
673	2	2017-03-22 00:00:00	CircuitSearcher	0
674	2	2017-03-22 00:00:00	CircuitSearcher	0
675	2	2017-03-22 00:00:00	CircuitSearcher	0
676	2	2017-03-22 00:00:00	CircuitSearcher	0
677	2	2017-03-22 00:00:00	CircuitSearcher	0
678	2	2017-03-22 00:00:00	CircuitSearcher	0
679	2	2017-03-22 00:00:00	CircuitSearcher	0
680	2	2017-03-22 00:00:00	CircuitSearcher	0
681	2	2017-03-22 00:00:00	CircuitSearcher	0
682	2	2017-03-22 00:00:00	CircuitSearcher	0
683	2	2017-03-22 00:00:00	CircuitSearcher	0
684	2	2017-03-22 00:00:00	CircuitSearcher	0
685	2	2017-03-22 00:00:00	CircuitSearcher	0
686	2	2017-03-22 00:00:00	CircuitSearcher	0
687	2	2017-03-22 00:00:00	TransferSearcher	0
688	2	2017-03-22 00:00:00	TransferSearcher	0
695	\N	\N	OcupationSearcher	0
696	\N	\N	OcupationSearcher	0
697	\N	\N	OcupationSearcher	0
698	\N	\N	OcupationSearcher	0
699	\N	\N	OcupationSearcher	0
700	\N	\N	OcupationSearcher	0
701	\N	\N	OcupationSearcher	0
702	\N	\N	OcupationSearcher	0
703	\N	\N	OcupationSearcher	0
704	2	2017-03-24 11:22:52	OcupationSearcher	0
705	2	2017-03-24 11:28:54	OcupationSearcher	0
706	2	2017-03-24 11:37:37	OcupationSearcher	0
708	2	2017-03-24 15:23:51	OcupationSearcher	\N
709	2	2017-03-24 15:24:21	OcupationSearcher	\N
710	2	2017-03-24 15:29:25	OcupationSearcher	0.316663026809689996
711	2	2017-03-24 15:30:41	OcupationSearcher	0.278234004974370008
712	2	2017-03-24 15:31:46	OcupationSearcher	0.279479026794429986
714	2	2017-03-24 16:12:18	CircuitSearcher	0.0844411849975589962
715	2	2017-03-24 16:12:31	CircuitSearcher	0.0142350196838379999
716	2	2017-03-24 16:12:53	CircuitSearcher	0.0315210819244379978
717	2	2017-03-27 11:54:29	TransferSearcher	4.50611114501950008e-05
718	2	2017-03-27 12:06:21	TransferSearcher	4.88758087158200008e-05
\.


--
-- TOC entry 4521 (class 0 OID 0)
-- Dependencies: 381
-- Name: searcher_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('searcher_id_seq', 718, true);


--
-- TOC entry 4384 (class 0 OID 262099)
-- Dependencies: 382
-- Data for Name: season; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY season (id, hotelid, startdate, enddate, description, title, slug, unique_slug) FROM stdin;
1	5	2016-11-01	2016-12-31	\N	Season 1 - Melia Cohiba	season-1-melia-cohiba	1-season-1-melia-cohiba
2	5	2017-01-01	2017-03-15	\N	Season 2 -Melia Cohiba	season-2-melia-cohiba	2-season-2-melia-cohiba
3	5	2017-03-16	2017-05-31	\N	Season 3 - Melia Cohiba	season-3-melia-cohiba	3-season-3-melia-cohiba
4	6	2016-11-15	2017-02-28	\N	Season Invierno - Melia Habana	season-invierno-melia-habana	4-season-invierno-melia-habana
5	6	2017-03-01	2017-04-30	\N	Season Primavera - Melia Habana	season-primavera-melia-habana	5-season-primavera-melia-habana
6	7	2016-11-10	2017-02-23	\N	Season Alta - Memories Miramar	season-alta-memories-miramar	6-season-alta-memories-miramar
7	7	2017-02-24	2017-04-18	\N	Season Baja - Memories Miramar	season-baja-memories-miramar	7-season-baja-memories-miramar
8	8	2016-11-01	2016-12-31	\N	Season 1 - Iberostar Varadero	season-1-iberostar-varadero	8-season-1-iberostar-varadero
9	8	2017-01-01	2017-02-28	\N	Season 2 - Iberostar Varadero	season-2-iberostar-varadero	9-season-2-iberostar-varadero
\.


--
-- TOC entry 4522 (class 0 OID 0)
-- Dependencies: 383
-- Name: season_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('season_id_seq', 9, true);


--
-- TOC entry 4386 (class 0 OID 262109)
-- Dependencies: 384
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY service (id, sale, servicemanagementstatus, user_id, cartitem, confirmationcode, remark) FROM stdin;
1	1	1	3	1	\N	\N
2	2	1	2	2	900905	\N
3	3	1	3	3	\N	\N
4	4	2	2	4	\N	\N
\.


--
-- TOC entry 4523 (class 0 OID 0)
-- Dependencies: 385
-- Name: service_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('service_id_seq', 4, true);


--
-- TOC entry 4388 (class 0 OID 262119)
-- Dependencies: 386
-- Data for Name: service_management_status; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY service_management_status (id, status, color) FROM stdin;
1	NEW	#6495ED
2	CONFIRMED	#008000
\.


--
-- TOC entry 4524 (class 0 OID 0)
-- Dependencies: 387
-- Name: service_management_status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('service_management_status_id_seq', 2, true);


--
-- TOC entry 4390 (class 0 OID 262127)
-- Dependencies: 388
-- Data for Name: service_pax; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY service_pax (id, gender, service, name, birthdate, lastname, document) FROM stdin;
1	1	1	juan	1998-12-04	morales	90090540181
2	1	2	juan	1998-12-04	morales	90090540181
3	1	3	denis	1998-12-04	espinosa	90090540181
4	1	4	juan	1998-12-16	magan	90090540181
\.


--
-- TOC entry 4525 (class 0 OID 0)
-- Dependencies: 389
-- Name: service_pax_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('service_pax_id_seq', 4, true);


--
-- TOC entry 4392 (class 0 OID 262135)
-- Dependencies: 390
-- Data for Name: subscription; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY subscription (id, email, status, datecreate, dateupdate) FROM stdin;
\.


--
-- TOC entry 4526 (class 0 OID 0)
-- Dependencies: 391
-- Name: subscription_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('subscription_id_seq', 1, false);


--
-- TOC entry 4394 (class 0 OID 262141)
-- Dependencies: 392
-- Data for Name: suplement; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY suplement (id, hotelid, title, date, adultprice, kidprice) FROM stdin;
1	5	Fin de año	2016-12-31	50	45
2	5	Noche Buena	2016-12-24	42	32
3	6	Nuevo año	2017-01-01	75	50
4	6	Año Viejo	2016-12-31	45	68
5	7	Suplemento 1	2016-12-24	78	68
6	7	Suplemento 2	2016-12-31	90	45
7	7	Suplemento 3	2017-01-01	65	45
8	8	Fin de Año	2016-12-31	58	31
9	8	Nuevo Año	2017-01-01	56	35
\.


--
-- TOC entry 4527 (class 0 OID 0)
-- Dependencies: 393
-- Name: suplement_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('suplement_id_seq', 9, true);


--
-- TOC entry 4396 (class 0 OID 262147)
-- Dependencies: 394
-- Data for Name: tag; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY tag (id, title, slug, unique_slug) FROM stdin;
1	paquete italia	paquete-italia	1-paquete-italia
\.


--
-- TOC entry 4528 (class 0 OID 0)
-- Dependencies: 395
-- Name: tag_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('tag_id_seq', 1, true);


--
-- TOC entry 4398 (class 0 OID 262155)
-- Dependencies: 396
-- Data for Name: term_condition_product; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY term_condition_product (id, title, description, slug, unique_slug) FROM stdin;
\.


--
-- TOC entry 4529 (class 0 OID 0)
-- Dependencies: 397
-- Name: term_condition_product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('term_condition_product_id_seq', 1, false);


--
-- TOC entry 4400 (class 0 OID 262172)
-- Dependencies: 398
-- Data for Name: transfer; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY transfer (id, placefrom, placeto, reverse, stop, endtime, starttime) FROM stdin;
9	2	3	t	0	\N	\N
10	3	2	t	0	\N	\N
11	4	1	t	0	\N	\N
12	1	4	t	0	\N	\N
13	2	4	t	0	\N	\N
14	4	2	t	0	\N	\N
15	3	1	t	0	\N	\N
16	1	3	t	0	\N	\N
\.


--
-- TOC entry 4401 (class 0 OID 262175)
-- Dependencies: 399
-- Data for Name: transfer_colective; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY transfer_colective (id, pricepax) FROM stdin;
9	60
10	60
11	350
12	350
\.


--
-- TOC entry 4402 (class 0 OID 262178)
-- Dependencies: 400
-- Data for Name: transfer_colective_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY transfer_colective_item (realid, pickupplace, dropoffplace, flight, passengers) FROM stdin;
1	2	3	\N	1
2	2	3	\N	1
\.


--
-- TOC entry 4403 (class 0 OID 262181)
-- Dependencies: 401
-- Data for Name: transfer_colective_request; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY transfer_colective_request (id, transfer, flight, passengers, startdate) FROM stdin;
1	9	\N	1	2017-03-26
\.


--
-- TOC entry 4404 (class 0 OID 262184)
-- Dependencies: 402
-- Data for Name: transfer_exclusive; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY transfer_exclusive (id, price01_02, price03_04, price05_07, price08_12, price13_19, price20_30, price31_40) FROM stdin;
13	600	500	400	300	200	100	50
14	600	500	400	300	200	100	50
15	250	230	200	180	160	150	137
16	250	230	200	180	160	150	137
\.


--
-- TOC entry 4405 (class 0 OID 262187)
-- Dependencies: 403
-- Data for Name: transfer_exclusive_item; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY transfer_exclusive_item (realid, flight, pickupplace, dropoffplace, pickup_time, passengers) FROM stdin;
\.


--
-- TOC entry 4406 (class 0 OID 262190)
-- Dependencies: 404
-- Data for Name: transfer_exclusive_request; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY transfer_exclusive_request (id, transfer, flight, pickup_time, passengers, startdate) FROM stdin;
\.


--
-- TOC entry 4407 (class 0 OID 262193)
-- Dependencies: 405
-- Data for Name: transfer_searcher; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY transfer_searcher (id, polofrom, poloto, transfer, placefrom, placeto, exclusive, passengers, date, roundtrip, dateroundtrip, startdate) FROM stdin;
134	\N	\N	\N	\N	\N	-1	1	2016-11-21	f	2016-11-22	\N
135	\N	\N	\N	\N	\N	-1	1	2016-11-21	f	2016-11-22	\N
136	\N	\N	\N	\N	\N	-1	1	2016-11-21	f	2016-11-22	\N
137	\N	\N	\N	\N	\N	-1	1	2016-11-21	f	2016-11-22	\N
138	\N	\N	\N	\N	\N	-1	1	2016-11-21	f	2016-11-22	\N
139	\N	\N	\N	\N	\N	-1	1	2016-11-21	f	2016-11-22	\N
140	\N	\N	\N	\N	\N	-1	1	2016-11-21	f	2016-11-22	\N
141	\N	\N	\N	\N	\N	-1	1	2016-11-21	f	2016-11-22	\N
142	\N	\N	\N	\N	\N	-1	1	2016-11-21	f	2016-11-22	\N
143	\N	\N	\N	\N	\N	-1	2	2016-11-23	f	2016-11-24	\N
144	\N	\N	\N	\N	\N	-1	2	2016-11-23	f	2016-11-24	\N
145	\N	\N	\N	\N	\N	-1	2	2016-11-23	f	2016-11-24	\N
146	\N	\N	\N	\N	\N	-1	1	2016-11-23	f	2016-11-24	\N
147	\N	\N	\N	\N	\N	-1	1	2016-11-23	f	2016-11-24	\N
148	\N	\N	\N	\N	\N	-1	1	2016-11-23	f	2016-11-24	\N
149	\N	\N	\N	\N	\N	-1	2	2016-11-23	t	2016-11-24	\N
150	\N	\N	\N	\N	\N	-1	1	2016-11-23	t	2016-11-24	\N
151	\N	\N	\N	\N	\N	-1	1	2016-11-23	t	2016-11-24	\N
152	\N	\N	\N	\N	\N	-1	1	2016-11-23	t	2016-11-24	\N
153	\N	\N	\N	\N	\N	-1	1	2016-11-23	t	2016-11-24	\N
154	\N	\N	\N	\N	\N	-1	1	2016-11-23	t	2016-11-24	\N
155	\N	\N	\N	\N	\N	-1	1	2016-11-23	t	2016-11-24	\N
156	\N	\N	\N	\N	\N	-1	1	2016-11-23	t	2016-11-24	\N
157	\N	\N	\N	\N	\N	-1	1	2016-11-23	t	2016-11-24	\N
158	\N	\N	\N	\N	\N	-1	2	2016-11-24	t	2016-11-25	\N
159	\N	\N	\N	\N	\N	-1	1	2016-11-24	t	2016-11-25	\N
160	\N	\N	\N	\N	\N	-1	1	2016-11-24	f	2016-11-25	\N
161	\N	\N	\N	\N	\N	-1	1	2016-11-24	f	2016-11-25	\N
162	\N	\N	\N	\N	\N	-1	1	2016-11-24	f	2016-11-25	\N
163	\N	\N	\N	\N	\N	-1	1	2016-11-24	f	2016-11-25	\N
164	\N	\N	\N	\N	\N	-1	1	2016-11-24	f	2016-11-25	\N
165	\N	\N	\N	\N	\N	-1	1	2016-11-24	f	2016-11-25	\N
166	\N	\N	\N	\N	\N	-1	1	2016-11-30	f	2016-11-25	\N
167	\N	\N	\N	\N	\N	-1	1	2016-11-30	f	2016-01-24	\N
168	\N	\N	\N	\N	\N	-1	2	2016-11-30	f	2016-01-24	\N
169	\N	\N	\N	\N	\N	-1	2	2016-11-30	f	2016-11-25	\N
170	\N	\N	\N	\N	\N	-1	2	2016-11-30	f	2016-11-25	\N
171	\N	\N	\N	\N	\N	-1	2	2016-11-30	f	2016-11-25	\N
242	\N	\N	\N	\N	\N	-1	1	2016-12-21	f	2016-11-27	\N
302	\N	\N	\N	3	\N	0	1	2016-11-29	f	2016-11-30	\N
303	\N	\N	\N	3	\N	0	1	2016-11-29	f	2016-11-30	\N
304	\N	\N	\N	\N	\N	-1	1	2016-12-31	f	2016-11-30	\N
305	\N	\N	\N	\N	\N	-1	1	2016-12-31	f	2016-11-30	\N
306	\N	\N	\N	\N	\N	-1	1	2016-12-31	t	2017-01-01	\N
307	\N	\N	\N	\N	\N	-1	1	2016-12-31	t	2017-01-01	\N
308	\N	\N	\N	\N	\N	-1	1	2016-12-31	t	2017-01-01	\N
309	\N	\N	\N	\N	\N	-1	1	2016-12-31	t	2017-01-01	\N
310	\N	\N	\N	\N	\N	-1	1	2016-12-31	t	2017-01-01	\N
311	\N	\N	\N	\N	\N	-1	1	2016-12-31	t	2017-01-01	\N
312	\N	\N	\N	2	\N	1	1	2016-12-31	f	2016-12-31	\N
313	\N	\N	\N	2	\N	1	40	2016-12-31	f	2016-12-31	\N
314	\N	\N	\N	2	\N	1	40	2016-12-31	f	2016-12-31	\N
315	\N	\N	\N	2	\N	1	40	2016-12-31	t	2017-01-01	\N
381	\N	\N	\N	\N	\N	-1	1	2016-12-07	f	2016-12-08	\N
382	\N	\N	\N	\N	\N	-1	1	2016-12-07	f	2016-12-08	\N
383	\N	\N	\N	\N	\N	1	1	2016-12-07	f	2016-12-08	\N
384	\N	\N	\N	\N	\N	1	1	2016-12-07	f	2016-12-08	\N
385	\N	\N	\N	\N	\N	1	1	2016-12-07	f	2016-12-08	\N
389	\N	\N	\N	\N	\N	-1	1	2016-12-08	f	2016-12-09	\N
422	\N	\N	\N	10	10	-1	1	2016-12-24	f	2016-12-25	\N
656	\N	\N	\N	5	5	-1	2	2017-03-14	t	2017-03-29	\N
663	\N	\N	\N	10	4	-1	1	2017-03-25	f	2017-03-26	\N
687	\N	\N	9	\N	\N	-1	1	2017-03-26	f	2017-03-27	\N
688	\N	\N	9	\N	\N	-1	1	2017-03-26	t	2017-03-27	\N
717	\N	\N	\N	\N	\N	-1	1	2017-03-31	f	2017-04-01	\N
718	\N	\N	\N	\N	\N	-1	1	2017-03-31	t	2017-04-01	\N
\.


--
-- TOC entry 4408 (class 0 OID 262217)
-- Dependencies: 406
-- Data for Name: zone; Type: TABLE DATA; Schema: public; Owner: daiqui6_postgres
--

COPY zone (id, province, picture, gallery, title, slug, unique_slug, description) FROM stdin;
1	1	\N	\N	Malecón	malecon	1-malecon	\N
2	1	\N	\N	Miramar	miramar	2-miramar	\N
3	3	\N	\N	Varadero	varadero	3-varadero	\N
4	4	\N	\N	Trinidad	trinidad	4-trinidad	\N
5	3	\N	\N	Playa Larga	playa-larga	5-playa-larga	\N
6	2	\N	\N	Viñales	vinales	6-vinales	\N
\.


--
-- TOC entry 4530 (class 0 OID 0)
-- Dependencies: 407
-- Name: zone_id_seq; Type: SEQUENCE SET; Schema: public; Owner: daiqui6_postgres
--

SELECT pg_catalog.setval('zone_id_seq', 6, true);


--
-- TOC entry 3054 (class 2606 OID 262233)
-- Name: acl_classes_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY acl_classes
    ADD CONSTRAINT acl_classes_pkey PRIMARY KEY (id);


--
-- TOC entry 3057 (class 2606 OID 262235)
-- Name: acl_entries_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY acl_entries
    ADD CONSTRAINT acl_entries_pkey PRIMARY KEY (id);


--
-- TOC entry 3064 (class 2606 OID 262237)
-- Name: acl_object_identities_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY acl_object_identities
    ADD CONSTRAINT acl_object_identities_pkey PRIMARY KEY (id);


--
-- TOC entry 3068 (class 2606 OID 262239)
-- Name: acl_object_identity_ancestors_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY acl_object_identity_ancestors
    ADD CONSTRAINT acl_object_identity_ancestors_pkey PRIMARY KEY (object_identity_id, ancestor_id);


--
-- TOC entry 3072 (class 2606 OID 262241)
-- Name: acl_security_identities_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY acl_security_identities
    ADD CONSTRAINT acl_security_identities_pkey PRIMARY KEY (id);


--
-- TOC entry 3075 (class 2606 OID 262243)
-- Name: airline_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY airline
    ADD CONSTRAINT airline_pkey PRIMARY KEY (id);


--
-- TOC entry 3081 (class 2606 OID 262245)
-- Name: airport_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY airport
    ADD CONSTRAINT airport_pkey PRIMARY KEY (id);


--
-- TOC entry 3083 (class 2606 OID 262247)
-- Name: block_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY block
    ADD CONSTRAINT block_pkey PRIMARY KEY (id);


--
-- TOC entry 3092 (class 2606 OID 262249)
-- Name: campaign_car_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_car
    ADD CONSTRAINT campaign_car_pkey PRIMARY KEY (id);


--
-- TOC entry 3095 (class 2606 OID 262251)
-- Name: campaign_circuit_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_circuit
    ADD CONSTRAINT campaign_circuit_pkey PRIMARY KEY (id);


--
-- TOC entry 3707 (class 2606 OID 264489)
-- Name: campaign_excursion_colective_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_excursion_colective
    ADD CONSTRAINT campaign_excursion_colective_pkey PRIMARY KEY (id);


--
-- TOC entry 3710 (class 2606 OID 264495)
-- Name: campaign_excursion_exclusive_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_excursion_exclusive
    ADD CONSTRAINT campaign_excursion_exclusive_pkey PRIMARY KEY (id);


--
-- TOC entry 3719 (class 2606 OID 264596)
-- Name: campaign_hotel_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_hotel
    ADD CONSTRAINT campaign_hotel_pkey PRIMARY KEY (id);


--
-- TOC entry 3098 (class 2606 OID 262257)
-- Name: campaign_medical_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_medical
    ADD CONSTRAINT campaign_medical_pkey PRIMARY KEY (id);


--
-- TOC entry 3101 (class 2606 OID 262259)
-- Name: campaign_package_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_package
    ADD CONSTRAINT campaign_package_pkey PRIMARY KEY (id);


--
-- TOC entry 3085 (class 2606 OID 262261)
-- Name: campaign_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign
    ADD CONSTRAINT campaign_pkey PRIMARY KEY (id);


--
-- TOC entry 3713 (class 2606 OID 264521)
-- Name: campaign_rental_house_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_rental_house
    ADD CONSTRAINT campaign_rental_house_pkey PRIMARY KEY (id);


--
-- TOC entry 3104 (class 2606 OID 262263)
-- Name: campaign_transfer_colective_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_transfer_colective
    ADD CONSTRAINT campaign_transfer_colective_pkey PRIMARY KEY (id);


--
-- TOC entry 3106 (class 2606 OID 262265)
-- Name: campaign_transfer_exclusive_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaign_transfer_exclusive
    ADD CONSTRAINT campaign_transfer_exclusive_pkey PRIMARY KEY (id);


--
-- TOC entry 3715 (class 2606 OID 264526)
-- Name: campaignrantalhouses_rentalhouserooms_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaignrantalhouses_rentalhouserooms
    ADD CONSTRAINT campaignrantalhouses_rentalhouserooms_pkey PRIMARY KEY (rental_house_room_id, campaign_rental_house_id);


--
-- TOC entry 3108 (class 2606 OID 262267)
-- Name: campaigntransfercolective_transfers_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaigntransfercolective_transfers
    ADD CONSTRAINT campaigntransfercolective_transfers_pkey PRIMARY KEY (transfer_colective_id, campaign_transfer_colective_id);


--
-- TOC entry 3112 (class 2606 OID 262269)
-- Name: campaigntransferexclisive_transfers_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY campaigntransferexclisive_transfers
    ADD CONSTRAINT campaigntransferexclisive_transfers_pkey PRIMARY KEY (transfer_exclusive_id, campaign_transfer_exclusive_id);


--
-- TOC entry 3116 (class 2606 OID 262271)
-- Name: cancelation_product_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY cancelation_product
    ADD CONSTRAINT cancelation_product_pkey PRIMARY KEY (id);


--
-- TOC entry 3125 (class 2606 OID 262273)
-- Name: car_availability_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY car_availability
    ADD CONSTRAINT car_availability_pkey PRIMARY KEY (id);


--
-- TOC entry 3127 (class 2606 OID 262275)
-- Name: car_availabilitys_car_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY car_availabilitys_car
    ADD CONSTRAINT car_availabilitys_car_pkey PRIMARY KEY (car_availability_id, car_id);


--
-- TOC entry 3131 (class 2606 OID 262277)
-- Name: car_category_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY car_category
    ADD CONSTRAINT car_category_pkey PRIMARY KEY (id);


--
-- TOC entry 3135 (class 2606 OID 262279)
-- Name: car_class_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY car_class
    ADD CONSTRAINT car_class_pkey PRIMARY KEY (id);


--
-- TOC entry 3139 (class 2606 OID 262281)
-- Name: car_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY car_item
    ADD CONSTRAINT car_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3120 (class 2606 OID 262283)
-- Name: car_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY car
    ADD CONSTRAINT car_pkey PRIMARY KEY (id);


--
-- TOC entry 3143 (class 2606 OID 262285)
-- Name: car_request_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY car_request
    ADD CONSTRAINT car_request_pkey PRIMARY KEY (id);


--
-- TOC entry 3148 (class 2606 OID 262287)
-- Name: car_searcher_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY car_searcher
    ADD CONSTRAINT car_searcher_pkey PRIMARY KEY (id);


--
-- TOC entry 3739 (class 2606 OID 264861)
-- Name: car_season_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY car_season
    ADD CONSTRAINT car_season_pkey PRIMARY KEY (id);


--
-- TOC entry 3154 (class 2606 OID 262289)
-- Name: cart_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY cart_item
    ADD CONSTRAINT cart_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3157 (class 2606 OID 262291)
-- Name: chain_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY chain
    ADD CONSTRAINT chain_pkey PRIMARY KEY (id);


--
-- TOC entry 3163 (class 2606 OID 262293)
-- Name: circuirsearcher_place_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuirsearcher_place
    ADD CONSTRAINT circuirsearcher_place_pkey PRIMARY KEY (id_circuitsearcher, id_place);


--
-- TOC entry 3170 (class 2606 OID 262297)
-- Name: circuit_availability_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuit_availability
    ADD CONSTRAINT circuit_availability_pkey PRIMARY KEY (id);


--
-- TOC entry 3172 (class 2606 OID 262299)
-- Name: circuit_circuitavailabilitys_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuit_circuitavailabilitys
    ADD CONSTRAINT circuit_circuitavailabilitys_pkey PRIMARY KEY (circuit_id, circuit_availability_id);


--
-- TOC entry 3176 (class 2606 OID 262301)
-- Name: circuit_day_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuit_day
    ADD CONSTRAINT circuit_day_pkey PRIMARY KEY (id);


--
-- TOC entry 3183 (class 2606 OID 262303)
-- Name: circuit_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuit_item
    ADD CONSTRAINT circuit_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3167 (class 2606 OID 262305)
-- Name: circuit_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuit
    ADD CONSTRAINT circuit_pkey PRIMARY KEY (id);


--
-- TOC entry 3186 (class 2606 OID 262307)
-- Name: circuit_request_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuit_request
    ADD CONSTRAINT circuit_request_pkey PRIMARY KEY (id);


--
-- TOC entry 3189 (class 2606 OID 262309)
-- Name: circuit_searcher_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuit_searcher
    ADD CONSTRAINT circuit_searcher_pkey PRIMARY KEY (id);


--
-- TOC entry 3193 (class 2606 OID 262313)
-- Name: circuit_season_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuit_season
    ADD CONSTRAINT circuit_season_pkey PRIMARY KEY (id);


--
-- TOC entry 3196 (class 2606 OID 262315)
-- Name: circuits_days_places_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY circuits_days_places
    ADD CONSTRAINT circuits_days_places_pkey PRIMARY KEY (circuit_day_id, place_id);


--
-- TOC entry 3200 (class 2606 OID 262317)
-- Name: classification__category_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY classification__category
    ADD CONSTRAINT classification__category_pkey PRIMARY KEY (id);


--
-- TOC entry 3205 (class 2606 OID 262319)
-- Name: classification__collection_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY classification__collection
    ADD CONSTRAINT classification__collection_pkey PRIMARY KEY (id);


--
-- TOC entry 3210 (class 2606 OID 262321)
-- Name: classification__context_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY classification__context
    ADD CONSTRAINT classification__context_pkey PRIMARY KEY (id);


--
-- TOC entry 3212 (class 2606 OID 262323)
-- Name: classification__tag_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY classification__tag
    ADD CONSTRAINT classification__tag_pkey PRIMARY KEY (id);


--
-- TOC entry 3216 (class 2606 OID 262327)
-- Name: configuration_pam_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY configuration_pam
    ADD CONSTRAINT configuration_pam_pkey PRIMARY KEY (id);


--
-- TOC entry 3218 (class 2606 OID 262329)
-- Name: configuration_tpv_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY configuration_tpv
    ADD CONSTRAINT configuration_tpv_pkey PRIMARY KEY (id);


--
-- TOC entry 3223 (class 2606 OID 262331)
-- Name: contact_cause_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY contact_cause
    ADD CONSTRAINT contact_cause_pkey PRIMARY KEY (id);


--
-- TOC entry 3220 (class 2606 OID 262333)
-- Name: contact_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY contact
    ADD CONSTRAINT contact_pkey PRIMARY KEY (id);


--
-- TOC entry 3227 (class 2606 OID 262335)
-- Name: country_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY country
    ADD CONSTRAINT country_pkey PRIMARY KEY (id);


--
-- TOC entry 3234 (class 2606 OID 262337)
-- Name: currency_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY currency
    ADD CONSTRAINT currency_pkey PRIMARY KEY (id);


--
-- TOC entry 3238 (class 2606 OID 262339)
-- Name: document_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY document
    ADD CONSTRAINT document_pkey PRIMARY KEY (id);


--
-- TOC entry 3242 (class 2606 OID 262341)
-- Name: documents_hotels_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY documents_hotels
    ADD CONSTRAINT documents_hotels_pkey PRIMARY KEY (document_id, hotel_id);


--
-- TOC entry 3246 (class 2606 OID 262343)
-- Name: documents_packages_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY documents_packages
    ADD CONSTRAINT documents_packages_pkey PRIMARY KEY (document_id, package_id);


--
-- TOC entry 3250 (class 2606 OID 262345)
-- Name: documents_products_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY documents_products
    ADD CONSTRAINT documents_products_pkey PRIMARY KEY (document_id, product_id);


--
-- TOC entry 3254 (class 2606 OID 262347)
-- Name: documents_rentalhouse_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY documents_rentalhouse
    ADD CONSTRAINT documents_rentalhouse_pkey PRIMARY KEY (document_id, rental_house_id);


--
-- TOC entry 3258 (class 2606 OID 262349)
-- Name: driver_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY driver
    ADD CONSTRAINT driver_pkey PRIMARY KEY (id);


--
-- TOC entry 3263 (class 2606 OID 262351)
-- Name: drivers_cars_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY drivers_cars
    ADD CONSTRAINT drivers_cars_pkey PRIMARY KEY (driver_id, car_id);


--
-- TOC entry 3267 (class 2606 OID 262353)
-- Name: duser_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY duser
    ADD CONSTRAINT duser_pkey PRIMARY KEY (id);


--
-- TOC entry 3276 (class 2606 OID 262355)
-- Name: excursion_colective_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_colective_item
    ADD CONSTRAINT excursion_colective_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3274 (class 2606 OID 262357)
-- Name: excursion_colective_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_colective
    ADD CONSTRAINT excursion_colective_pkey PRIMARY KEY (id);


--
-- TOC entry 3282 (class 2606 OID 262359)
-- Name: excursion_exclusive_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_exclusive_item
    ADD CONSTRAINT excursion_exclusive_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3280 (class 2606 OID 262361)
-- Name: excursion_exclusive_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_exclusive
    ADD CONSTRAINT excursion_exclusive_pkey PRIMARY KEY (id);


--
-- TOC entry 3286 (class 2606 OID 262363)
-- Name: excursion_excursion_types_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_excursion_types
    ADD CONSTRAINT excursion_excursion_types_pkey PRIMARY KEY (excursion_id, excursion_type_id);


--
-- TOC entry 3271 (class 2606 OID 262365)
-- Name: excursion_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion
    ADD CONSTRAINT excursion_pkey PRIMARY KEY (id);


--
-- TOC entry 3731 (class 2606 OID 264808)
-- Name: excursion_place_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_place
    ADD CONSTRAINT excursion_place_pkey PRIMARY KEY (excursion_id, place_id);


--
-- TOC entry 3290 (class 2606 OID 262367)
-- Name: excursion_request_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_request
    ADD CONSTRAINT excursion_request_pkey PRIMARY KEY (id);


--
-- TOC entry 3735 (class 2606 OID 264825)
-- Name: excursion_searcher_excursion_place_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_searcher_excursion_place
    ADD CONSTRAINT excursion_searcher_excursion_place_pkey PRIMARY KEY (excursion_searcher_id, excursion_place_id);


--
-- TOC entry 3298 (class 2606 OID 262369)
-- Name: excursion_searcher_excursion_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_searcher_excursion_type
    ADD CONSTRAINT excursion_searcher_excursion_type_pkey PRIMARY KEY (excursion_searcher_id, excursion_type_id);


--
-- TOC entry 3293 (class 2606 OID 262371)
-- Name: excursion_searcher_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_searcher
    ADD CONSTRAINT excursion_searcher_pkey PRIMARY KEY (id);


--
-- TOC entry 3302 (class 2606 OID 262373)
-- Name: excursion_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY excursion_type
    ADD CONSTRAINT excursion_type_pkey PRIMARY KEY (id);


--
-- TOC entry 3306 (class 2606 OID 262375)
-- Name: ext_log_entries_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY ext_log_entries
    ADD CONSTRAINT ext_log_entries_pkey PRIMARY KEY (id);


--
-- TOC entry 3312 (class 2606 OID 262377)
-- Name: ext_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY ext_translations
    ADD CONSTRAINT ext_translations_pkey PRIMARY KEY (id);


--
-- TOC entry 3742 (class 2606 OID 268210)
-- Name: faq_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY faq
    ADD CONSTRAINT faq_pkey PRIMARY KEY (id);


--
-- TOC entry 3316 (class 2606 OID 262379)
-- Name: flight_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY flight
    ADD CONSTRAINT flight_pkey PRIMARY KEY (id);


--
-- TOC entry 3321 (class 2606 OID 262381)
-- Name: flights_airports_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY flights_airports
    ADD CONSTRAINT flights_airports_pkey PRIMARY KEY (flight_id, airport_id);


--
-- TOC entry 3325 (class 2606 OID 262383)
-- Name: fos_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY fos_user_group
    ADD CONSTRAINT fos_user_group_pkey PRIMARY KEY (id);


--
-- TOC entry 3332 (class 2606 OID 262385)
-- Name: fos_user_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fos_user_user_group_pkey PRIMARY KEY (user_id, group_id);


--
-- TOC entry 3328 (class 2606 OID 262387)
-- Name: fos_user_user_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fos_user_user_pkey PRIMARY KEY (id);


--
-- TOC entry 3336 (class 2606 OID 262389)
-- Name: gender_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY gender
    ADD CONSTRAINT gender_pkey PRIMARY KEY (id);


--
-- TOC entry 3348 (class 2606 OID 262391)
-- Name: hotel_facility_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY hotel_facility
    ADD CONSTRAINT hotel_facility_pkey PRIMARY KEY (id);


--
-- TOC entry 3340 (class 2606 OID 262393)
-- Name: hotel_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY hotel
    ADD CONSTRAINT hotel_pkey PRIMARY KEY (id);


--
-- TOC entry 3356 (class 2606 OID 262395)
-- Name: hotel_price_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY hotel_price
    ADD CONSTRAINT hotel_price_pkey PRIMARY KEY (id);


--
-- TOC entry 3360 (class 2606 OID 262397)
-- Name: hotel_sales_agent_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY hotel_sales_agent
    ADD CONSTRAINT hotel_sales_agent_pkey PRIMARY KEY (id);


--
-- TOC entry 3366 (class 2606 OID 262399)
-- Name: hotel_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY hotel_type
    ADD CONSTRAINT hotel_type_pkey PRIMARY KEY (id);


--
-- TOC entry 3373 (class 2606 OID 262401)
-- Name: kid_policy_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY kid_policy
    ADD CONSTRAINT kid_policy_pkey PRIMARY KEY (id);


--
-- TOC entry 3375 (class 2606 OID 262403)
-- Name: luggage_capacity_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY luggage_capacity
    ADD CONSTRAINT luggage_capacity_pkey PRIMARY KEY (id);


--
-- TOC entry 3383 (class 2606 OID 262405)
-- Name: market_campaigns_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY market_campaigns
    ADD CONSTRAINT market_campaigns_pkey PRIMARY KEY (campaign_id, market_id);


--
-- TOC entry 3379 (class 2606 OID 262407)
-- Name: market_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY market
    ADD CONSTRAINT market_pkey PRIMARY KEY (id);


--
-- TOC entry 3389 (class 2606 OID 262409)
-- Name: media__gallery_media_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY media__gallery_media
    ADD CONSTRAINT media__gallery_media_pkey PRIMARY KEY (id);


--
-- TOC entry 3385 (class 2606 OID 262411)
-- Name: media__gallery_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY media__gallery
    ADD CONSTRAINT media__gallery_pkey PRIMARY KEY (id);


--
-- TOC entry 3392 (class 2606 OID 262413)
-- Name: media__media_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY media__media
    ADD CONSTRAINT media__media_pkey PRIMARY KEY (id);


--
-- TOC entry 3396 (class 2606 OID 262415)
-- Name: medical_program_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY medical_program
    ADD CONSTRAINT medical_program_pkey PRIMARY KEY (id);


--
-- TOC entry 3401 (class 2606 OID 262417)
-- Name: medical_request_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY medical_request
    ADD CONSTRAINT medical_request_pkey PRIMARY KEY (id);


--
-- TOC entry 3406 (class 2606 OID 262419)
-- Name: medical_service_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY medical_service_item
    ADD CONSTRAINT medical_service_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3404 (class 2606 OID 262421)
-- Name: medical_service_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY medical_service
    ADD CONSTRAINT medical_service_pkey PRIMARY KEY (id);


--
-- TOC entry 3413 (class 2606 OID 262423)
-- Name: ocupation_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY ocupation_item
    ADD CONSTRAINT ocupation_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3409 (class 2606 OID 262425)
-- Name: ocupation_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY ocupation
    ADD CONSTRAINT ocupation_pkey PRIMARY KEY (id);


--
-- TOC entry 3421 (class 2606 OID 262427)
-- Name: ocupation_searcher_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY ocupation_searcher
    ADD CONSTRAINT ocupation_searcher_pkey PRIMARY KEY (id);


--
-- TOC entry 3425 (class 2606 OID 262429)
-- Name: ocupation_searcher_rental_house_facility_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY ocupation_searcher_rental_house_facility_type
    ADD CONSTRAINT ocupation_searcher_rental_house_facility_type_pkey PRIMARY KEY (ocupation_searcher_id, hotel_facility_id);


--
-- TOC entry 3429 (class 2606 OID 262431)
-- Name: ocupation_searcher_rental_house_room_facility_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY ocupation_searcher_rental_house_room_facility
    ADD CONSTRAINT ocupation_searcher_rental_house_room_facility_pkey PRIMARY KEY (ocupation_searcher_id, rental_house_room_facility_id);


--
-- TOC entry 3444 (class 2606 OID 262435)
-- Name: package_option_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY package_option_item
    ADD CONSTRAINT package_option_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3441 (class 2606 OID 262437)
-- Name: package_option_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY package_option
    ADD CONSTRAINT package_option_pkey PRIMARY KEY (id);


--
-- TOC entry 3448 (class 2606 OID 262439)
-- Name: package_option_polos_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY package_option_polos
    ADD CONSTRAINT package_option_polos_pkey PRIMARY KEY (package_option_id, polo_id);


--
-- TOC entry 3451 (class 2606 OID 262441)
-- Name: package_option_searcher_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY package_option_searcher
    ADD CONSTRAINT package_option_searcher_pkey PRIMARY KEY (id);


--
-- TOC entry 3436 (class 2606 OID 262443)
-- Name: package_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY package
    ADD CONSTRAINT package_pkey PRIMARY KEY (id);


--
-- TOC entry 3455 (class 2606 OID 262445)
-- Name: package_request_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY package_request
    ADD CONSTRAINT package_request_pkey PRIMARY KEY (id);


--
-- TOC entry 3457 (class 2606 OID 262447)
-- Name: packageoptionsearcher_polo_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY packageoptionsearcher_polo
    ADD CONSTRAINT packageoptionsearcher_polo_pkey PRIMARY KEY (id);


--
-- TOC entry 3461 (class 2606 OID 262449)
-- Name: payment_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY payment
    ADD CONSTRAINT payment_pkey PRIMARY KEY (id);


--
-- TOC entry 3467 (class 2606 OID 262451)
-- Name: place_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY place
    ADD CONSTRAINT place_pkey PRIMARY KEY (id);


--
-- TOC entry 3471 (class 2606 OID 262453)
-- Name: place_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY place_type
    ADD CONSTRAINT place_type_pkey PRIMARY KEY (id);


--
-- TOC entry 3477 (class 2606 OID 262455)
-- Name: place_type_place_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY place_type_place
    ADD CONSTRAINT place_type_place_pkey PRIMARY KEY (place_id, place_type_id);


--
-- TOC entry 3481 (class 2606 OID 262457)
-- Name: polo_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY polo
    ADD CONSTRAINT polo_pkey PRIMARY KEY (id);


--
-- TOC entry 3487 (class 2606 OID 262461)
-- Name: polos_provinces_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY polos_provinces
    ADD CONSTRAINT polos_provinces_pkey PRIMARY KEY (polo_id, province_id);


--
-- TOC entry 3500 (class 2606 OID 262463)
-- Name: product_category_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY product_category
    ADD CONSTRAINT product_category_pkey PRIMARY KEY (id);


--
-- TOC entry 3502 (class 2606 OID 262465)
-- Name: product_increment_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY product_increment
    ADD CONSTRAINT product_increment_pkey PRIMARY KEY (id);


--
-- TOC entry 3495 (class 2606 OID 262467)
-- Name: product_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);


--
-- TOC entry 3504 (class 2606 OID 262469)
-- Name: product_seo_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY product_seo
    ADD CONSTRAINT product_seo_pkey PRIMARY KEY (id);


--
-- TOC entry 3508 (class 2606 OID 262471)
-- Name: products_tags_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY products_tags
    ADD CONSTRAINT products_tags_pkey PRIMARY KEY (tag_id, product_id);


--
-- TOC entry 3512 (class 2606 OID 262473)
-- Name: provider_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY provider
    ADD CONSTRAINT provider_pkey PRIMARY KEY (id);


--
-- TOC entry 3519 (class 2606 OID 262475)
-- Name: province_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY province
    ADD CONSTRAINT province_pkey PRIMARY KEY (id);


--
-- TOC entry 3537 (class 2606 OID 262477)
-- Name: rental_house_facility_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_facility
    ADD CONSTRAINT rental_house_facility_pkey PRIMARY KEY (id);


--
-- TOC entry 3541 (class 2606 OID 262479)
-- Name: rental_house_facility_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_facility_type
    ADD CONSTRAINT rental_house_facility_type_pkey PRIMARY KEY (id);


--
-- TOC entry 3546 (class 2606 OID 262481)
-- Name: rental_house_owner_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_owner
    ADD CONSTRAINT rental_house_owner_pkey PRIMARY KEY (id);


--
-- TOC entry 3529 (class 2606 OID 262483)
-- Name: rental_house_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house
    ADD CONSTRAINT rental_house_pkey PRIMARY KEY (id);


--
-- TOC entry 3552 (class 2606 OID 262485)
-- Name: rental_house_rental_house_owner_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_rental_house_owner
    ADD CONSTRAINT rental_house_rental_house_owner_pkey PRIMARY KEY (rental_house_id, rental_house_owner_id);


--
-- TOC entry 3556 (class 2606 OID 262487)
-- Name: rental_house_rental_house_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_rental_house_type
    ADD CONSTRAINT rental_house_rental_house_type_pkey PRIMARY KEY (rental_house_id, rental_house_type_id);


--
-- TOC entry 3560 (class 2606 OID 262489)
-- Name: rental_house_request_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_request
    ADD CONSTRAINT rental_house_request_pkey PRIMARY KEY (id);


--
-- TOC entry 3566 (class 2606 OID 262491)
-- Name: rental_house_room_availability_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room_availability
    ADD CONSTRAINT rental_house_room_availability_pkey PRIMARY KEY (id);


--
-- TOC entry 3568 (class 2606 OID 262493)
-- Name: rental_house_room_facility_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room_facility
    ADD CONSTRAINT rental_house_room_facility_pkey PRIMARY KEY (id);


--
-- TOC entry 3574 (class 2606 OID 262495)
-- Name: rental_house_room_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room_item
    ADD CONSTRAINT rental_house_room_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3576 (class 2606 OID 262497)
-- Name: rental_house_room_ocupation_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room_ocupation
    ADD CONSTRAINT rental_house_room_ocupation_pkey PRIMARY KEY (id);


--
-- TOC entry 3563 (class 2606 OID 262499)
-- Name: rental_house_room_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room
    ADD CONSTRAINT rental_house_room_pkey PRIMARY KEY (id);


--
-- TOC entry 3580 (class 2606 OID 262501)
-- Name: rental_house_room_rental_house_room_facilities_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room_rental_house_room_facilities
    ADD CONSTRAINT rental_house_room_rental_house_room_facilities_pkey PRIMARY KEY (rental_house_room_id, rental_house_room_facility_id);


--
-- TOC entry 3584 (class 2606 OID 262503)
-- Name: rental_house_room_rental_house_room_ocupations_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room_rental_house_room_ocupations
    ADD CONSTRAINT rental_house_room_rental_house_room_ocupations_pkey PRIMARY KEY (rental_house_room_id, rental_house_room_ocupation_id);


--
-- TOC entry 3590 (class 2606 OID 262505)
-- Name: rental_house_room_searcher_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room_searcher
    ADD CONSTRAINT rental_house_room_searcher_pkey PRIMARY KEY (id);


--
-- TOC entry 3594 (class 2606 OID 262507)
-- Name: rental_house_room_searcher_rental_house_facility_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room_searcher_rental_house_facility_type
    ADD CONSTRAINT rental_house_room_searcher_rental_house_facility_type_pkey PRIMARY KEY (rental_house_room_searcher_id, rental_house_facility_id);


--
-- TOC entry 3598 (class 2606 OID 262509)
-- Name: rental_house_room_searcher_rental_house_room_facility_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_room_searcher_rental_house_room_facility
    ADD CONSTRAINT rental_house_room_searcher_rental_house_room_facility_pkey PRIMARY KEY (rental_house_room_searcher_id, rental_house_room_facility_id);


--
-- TOC entry 3601 (class 2606 OID 262511)
-- Name: rental_house_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rental_house_type
    ADD CONSTRAINT rental_house_type_pkey PRIMARY KEY (id);


--
-- TOC entry 3607 (class 2606 OID 262513)
-- Name: rentalhouseroomsearcher_type_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY rentalhouseroomsearcher_type
    ADD CONSTRAINT rentalhouseroomsearcher_type_pkey PRIMARY KEY (id_rentalhouseroomsearcher, id_typehouse);


--
-- TOC entry 3610 (class 2606 OID 262515)
-- Name: request_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY request
    ADD CONSTRAINT request_pkey PRIMARY KEY (id);


--
-- TOC entry 3750 (class 2606 OID 268242)
-- Name: result_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY result
    ADD CONSTRAINT result_pkey PRIMARY KEY (id);


--
-- TOC entry 3723 (class 2606 OID 264727)
-- Name: review_hotel_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY review_hotel
    ADD CONSTRAINT review_hotel_pkey PRIMARY KEY (id);


--
-- TOC entry 3613 (class 2606 OID 262517)
-- Name: review_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY review
    ADD CONSTRAINT review_pkey PRIMARY KEY (id);


--
-- TOC entry 3729 (class 2606 OID 264766)
-- Name: review_product_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY review_product
    ADD CONSTRAINT review_product_pkey PRIMARY KEY (id);


--
-- TOC entry 3726 (class 2606 OID 264739)
-- Name: review_rental_house_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY review_rental_house
    ADD CONSTRAINT review_rental_house_pkey PRIMARY KEY (id);


--
-- TOC entry 3623 (class 2606 OID 262519)
-- Name: room_availability_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY room_availability
    ADD CONSTRAINT room_availability_pkey PRIMARY KEY (id);


--
-- TOC entry 3627 (class 2606 OID 262521)
-- Name: room_facilities_rooms_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY room_facilities_rooms
    ADD CONSTRAINT room_facilities_rooms_pkey PRIMARY KEY (room_id, rental_house_room_facility_id);


--
-- TOC entry 3618 (class 2606 OID 262523)
-- Name: room_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY room
    ADD CONSTRAINT room_pkey PRIMARY KEY (id);


--
-- TOC entry 3632 (class 2606 OID 262527)
-- Name: sale_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY sale
    ADD CONSTRAINT sale_pkey PRIMARY KEY (id);


--
-- TOC entry 3635 (class 2606 OID 262529)
-- Name: searcher_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY searcher
    ADD CONSTRAINT searcher_pkey PRIMARY KEY (id);


--
-- TOC entry 3638 (class 2606 OID 262531)
-- Name: season_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY season
    ADD CONSTRAINT season_pkey PRIMARY KEY (id);


--
-- TOC entry 3648 (class 2606 OID 262533)
-- Name: service_management_status_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY service_management_status
    ADD CONSTRAINT service_management_status_pkey PRIMARY KEY (id);


--
-- TOC entry 3652 (class 2606 OID 262535)
-- Name: service_pax_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY service_pax
    ADD CONSTRAINT service_pax_pkey PRIMARY KEY (id);


--
-- TOC entry 3645 (class 2606 OID 262537)
-- Name: service_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY service
    ADD CONSTRAINT service_pkey PRIMARY KEY (id);


--
-- TOC entry 3654 (class 2606 OID 262539)
-- Name: subscription_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY subscription
    ADD CONSTRAINT subscription_pkey PRIMARY KEY (id);


--
-- TOC entry 3657 (class 2606 OID 262541)
-- Name: suplement_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY suplement
    ADD CONSTRAINT suplement_pkey PRIMARY KEY (id);


--
-- TOC entry 3659 (class 2606 OID 262543)
-- Name: tag_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY tag
    ADD CONSTRAINT tag_pkey PRIMARY KEY (id);


--
-- TOC entry 3663 (class 2606 OID 262545)
-- Name: term_condition_product_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY term_condition_product
    ADD CONSTRAINT term_condition_product_pkey PRIMARY KEY (id);


--
-- TOC entry 3676 (class 2606 OID 262549)
-- Name: transfer_colective_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY transfer_colective_item
    ADD CONSTRAINT transfer_colective_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3671 (class 2606 OID 262551)
-- Name: transfer_colective_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY transfer_colective
    ADD CONSTRAINT transfer_colective_pkey PRIMARY KEY (id);


--
-- TOC entry 3680 (class 2606 OID 262553)
-- Name: transfer_colective_request_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY transfer_colective_request
    ADD CONSTRAINT transfer_colective_request_pkey PRIMARY KEY (id);


--
-- TOC entry 3687 (class 2606 OID 262555)
-- Name: transfer_exclusive_item_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY transfer_exclusive_item
    ADD CONSTRAINT transfer_exclusive_item_pkey PRIMARY KEY (realid);


--
-- TOC entry 3682 (class 2606 OID 262557)
-- Name: transfer_exclusive_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY transfer_exclusive
    ADD CONSTRAINT transfer_exclusive_pkey PRIMARY KEY (id);


--
-- TOC entry 3691 (class 2606 OID 262559)
-- Name: transfer_exclusive_request_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY transfer_exclusive_request
    ADD CONSTRAINT transfer_exclusive_request_pkey PRIMARY KEY (id);


--
-- TOC entry 3669 (class 2606 OID 262561)
-- Name: transfer_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY transfer
    ADD CONSTRAINT transfer_pkey PRIMARY KEY (id);


--
-- TOC entry 3698 (class 2606 OID 262563)
-- Name: transfer_searcher_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY transfer_searcher
    ADD CONSTRAINT transfer_searcher_pkey PRIMARY KEY (id);


--
-- TOC entry 3705 (class 2606 OID 262573)
-- Name: zone_pkey; Type: CONSTRAINT; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

ALTER TABLE ONLY zone
    ADD CONSTRAINT zone_pkey PRIMARY KEY (id);


--
-- TOC entry 3721 (class 1259 OID 264729)
-- Name: idx_10dd72c23243bb18; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_10dd72c23243bb18 ON review_hotel USING btree (hotel_id);


--
-- TOC entry 3259 (class 1259 OID 262574)
-- Name: idx_11667cd916db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_11667cd916db4f89 ON driver USING btree (picture);


--
-- TOC entry 3168 (class 1259 OID 264843)
-- Name: idx_1325f3a6ecb6bf02; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1325f3a6ecb6bf02 ON circuit USING btree (polofromid);


--
-- TOC entry 3743 (class 1259 OID 268299)
-- Name: idx_136ac11341714987; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_136ac11341714987 ON result USING btree (dropoffplace_id);


--
-- TOC entry 3744 (class 1259 OID 268301)
-- Name: idx_136ac1134666d46c; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_136ac1134666d46c ON result USING btree (obj);


--
-- TOC entry 3745 (class 1259 OID 268298)
-- Name: idx_136ac11357759bb4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_136ac11357759bb4 ON result USING btree (pickupplace);


--
-- TOC entry 3746 (class 1259 OID 268300)
-- Name: idx_136ac1136bac85cb; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_136ac1136bac85cb ON result USING btree (market);


--
-- TOC entry 3747 (class 1259 OID 268302)
-- Name: idx_136ac113c257e60e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_136ac113c257e60e ON result USING btree (flight);


--
-- TOC entry 3748 (class 1259 OID 268243)
-- Name: idx_136ac113c9f91e67; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_136ac113c9f91e67 ON result USING btree (searcher_id);


--
-- TOC entry 3633 (class 1259 OID 262575)
-- Name: idx_171f088fa76ed395; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_171f088fa76ed395 ON searcher USING btree (user_id);


--
-- TOC entry 3243 (class 1259 OID 262576)
-- Name: idx_1787c0633243bb18; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1787c0633243bb18 ON documents_hotels USING btree (hotel_id);


--
-- TOC entry 3244 (class 1259 OID 262577)
-- Name: idx_1787c063c33f7837; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1787c063c33f7837 ON documents_hotels USING btree (document_id);


--
-- TOC entry 3577 (class 1259 OID 262578)
-- Name: idx_181edfe0984cadac; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_181edfe0984cadac ON rental_house_room_rental_house_room_facilities USING btree (rental_house_room_id);


--
-- TOC entry 3578 (class 1259 OID 262579)
-- Name: idx_181edfe0985ce863; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_181edfe0985ce863 ON rental_house_room_rental_house_room_facilities USING btree (rental_house_room_facility_id);


--
-- TOC entry 3177 (class 1259 OID 262580)
-- Name: idx_1b042a031325f3a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1b042a031325f3a6 ON circuit_day USING btree (circuit);


--
-- TOC entry 3178 (class 1259 OID 262581)
-- Name: idx_1b042a0316db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1b042a0316db4f89 ON circuit_day USING btree (picture);


--
-- TOC entry 3179 (class 1259 OID 262582)
-- Name: idx_1b042a03472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1b042a03472b783a ON circuit_day USING btree (gallery);


--
-- TOC entry 3478 (class 1259 OID 262583)
-- Name: idx_1db5abff16db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1db5abff16db4f89 ON polo USING btree (picture);


--
-- TOC entry 3479 (class 1259 OID 262584)
-- Name: idx_1db5abff472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1db5abff472b783a ON polo USING btree (gallery);


--
-- TOC entry 3086 (class 1259 OID 262585)
-- Name: idx_1f1512dd16db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1f1512dd16db4f89 ON campaign USING btree (picture);


--
-- TOC entry 3087 (class 1259 OID 262586)
-- Name: idx_1f1512dd472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1f1512dd472b783a ON campaign USING btree (gallery);


--
-- TOC entry 3088 (class 1259 OID 262587)
-- Name: idx_1f1512dde9ed820c; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_1f1512dde9ed820c ON campaign USING btree (block_id);


--
-- TOC entry 3113 (class 1259 OID 262588)
-- Name: idx_2018ee1581f1026; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_2018ee1581f1026 ON campaigntransferexclisive_transfers USING btree (campaign_transfer_exclusive_id);


--
-- TOC entry 3114 (class 1259 OID 262589)
-- Name: idx_2018ee15b43e296d; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_2018ee15b43e296d ON campaigntransferexclisive_transfers USING btree (transfer_exclusive_id);


--
-- TOC entry 3655 (class 1259 OID 262590)
-- Name: idx_225d4664631066a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_225d4664631066a6 ON suplement USING btree (hotelid);


--
-- TOC entry 3277 (class 1259 OID 262591)
-- Name: idx_22e0178f57759bb4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_22e0178f57759bb4 ON excursion_colective_item USING btree (pickupplace);


--
-- TOC entry 3278 (class 1259 OID 262592)
-- Name: idx_22e0178fabbf655d; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_22e0178fabbf655d ON excursion_colective_item USING btree (dropoffplace);


--
-- TOC entry 3357 (class 1259 OID 262595)
-- Name: idx_291cec1d729f519b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_291cec1d729f519b ON hotel_price USING btree (room);


--
-- TOC entry 3358 (class 1259 OID 262596)
-- Name: idx_291cec1df0e45ba9; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_291cec1df0e45ba9 ON hotel_price USING btree (season);


--
-- TOC entry 3422 (class 1259 OID 262597)
-- Name: idx_2e027caa682c9107; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_2e027caa682c9107 ON ocupation_searcher_rental_house_facility_type USING btree (ocupation_searcher_id);


--
-- TOC entry 3423 (class 1259 OID 262598)
-- Name: idx_2e027caa79cf033f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_2e027caa79cf033f ON ocupation_searcher_rental_house_facility_type USING btree (hotel_facility_id);


--
-- TOC entry 3341 (class 1259 OID 262599)
-- Name: idx_3535ed9190d5293; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3535ed9190d5293 ON hotel USING btree (hoteltype);


--
-- TOC entry 3342 (class 1259 OID 262600)
-- Name: idx_3535ed93b28f0c3; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3535ed93b28f0c3 ON hotel USING btree (product_increment);


--
-- TOC entry 3343 (class 1259 OID 262601)
-- Name: idx_3535ed96b1f932d; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3535ed96b1f932d ON hotel USING btree (cancelation_hotel);


--
-- TOC entry 3344 (class 1259 OID 262602)
-- Name: idx_3535ed99d4071c0; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3535ed99d4071c0 ON hotel USING btree (chainid);


--
-- TOC entry 3345 (class 1259 OID 262603)
-- Name: idx_3535ed9a0ebc007; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3535ed9a0ebc007 ON hotel USING btree (zone);


--
-- TOC entry 3346 (class 1259 OID 262604)
-- Name: idx_3535ed9a8f321d6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3535ed9a8f321d6 ON hotel USING btree (term_condition_hotel);


--
-- TOC entry 3264 (class 1259 OID 262605)
-- Name: idx_380e656fc3423909; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_380e656fc3423909 ON drivers_cars USING btree (driver_id);


--
-- TOC entry 3265 (class 1259 OID 262606)
-- Name: idx_380e656fc3c6f69f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_380e656fc3c6f69f ON drivers_cars USING btree (car_id);


--
-- TOC entry 3287 (class 1259 OID 262607)
-- Name: idx_38bfd5cf1dd011e1; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_38bfd5cf1dd011e1 ON excursion_excursion_types USING btree (excursion_type_id);


--
-- TOC entry 3288 (class 1259 OID 262608)
-- Name: idx_38bfd5cf4ab4296f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_38bfd5cf4ab4296f ON excursion_excursion_types USING btree (excursion_id);


--
-- TOC entry 3442 (class 1259 OID 262609)
-- Name: idx_3ace959b57759bb4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3ace959b57759bb4 ON package_option_item USING btree (pickupplace);


--
-- TOC entry 3128 (class 1259 OID 262610)
-- Name: idx_3aecfbeb5ad4dd20; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3aecfbeb5ad4dd20 ON car_availabilitys_car USING btree (car_availability_id);


--
-- TOC entry 3129 (class 1259 OID 262611)
-- Name: idx_3aecfbebc3c6f69f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3aecfbebc3c6f69f ON car_availabilitys_car USING btree (car_id);


--
-- TOC entry 3608 (class 1259 OID 262612)
-- Name: idx_3b978f9fc7470a42; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3b978f9fc7470a42 ON request USING btree (gender);


--
-- TOC entry 3553 (class 1259 OID 262613)
-- Name: idx_3bf1e1215bd15c26; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3bf1e1215bd15c26 ON rental_house_rental_house_type USING btree (rental_house_id);


--
-- TOC entry 3554 (class 1259 OID 262614)
-- Name: idx_3bf1e12191751ac; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3bf1e12191751ac ON rental_house_rental_house_type USING btree (rental_house_type_id);


--
-- TOC entry 3708 (class 1259 OID 264490)
-- Name: idx_3c5ec0014ab4296f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3c5ec0014ab4296f ON campaign_excursion_colective USING btree (excursion_id);


--
-- TOC entry 3426 (class 1259 OID 262615)
-- Name: idx_3ecc2507682c9107; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3ecc2507682c9107 ON ocupation_searcher_rental_house_room_facility USING btree (ocupation_searcher_id);


--
-- TOC entry 3427 (class 1259 OID 262616)
-- Name: idx_3ecc2507985ce863; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_3ecc2507985ce863 ON ocupation_searcher_rental_house_room_facility USING btree (rental_house_room_facility_id);


--
-- TOC entry 3666 (class 1259 OID 262617)
-- Name: idx_4034a3c05bb10f94; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_4034a3c05bb10f94 ON transfer USING btree (placeto);


--
-- TOC entry 3667 (class 1259 OID 262618)
-- Name: idx_4034a3c0fbc3de7b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_4034a3c0fbc3de7b ON transfer USING btree (placefrom);


--
-- TOC entry 3201 (class 1259 OID 262619)
-- Name: idx_43629b36727aca70; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_43629b36727aca70 ON classification__category USING btree (parent_id);


--
-- TOC entry 3202 (class 1259 OID 262620)
-- Name: idx_43629b36e25d857e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_43629b36e25d857e ON classification__category USING btree (context);


--
-- TOC entry 3203 (class 1259 OID 262621)
-- Name: idx_43629b36ea9fdd75; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_43629b36ea9fdd75 ON classification__category USING btree (media_id);


--
-- TOC entry 3599 (class 1259 OID 262627)
-- Name: idx_44b0849516db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_44b0849516db4f89 ON rental_house_type USING btree (picture);


--
-- TOC entry 3058 (class 1259 OID 262628)
-- Name: idx_46c8b8063d9ab4a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_46c8b8063d9ab4a6 ON acl_entries USING btree (object_identity_id);


--
-- TOC entry 3059 (class 1259 OID 262629)
-- Name: idx_46c8b806df9183c9; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_46c8b806df9183c9 ON acl_entries USING btree (security_identity_id);


--
-- TOC entry 3060 (class 1259 OID 262630)
-- Name: idx_46c8b806ea000b10; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_46c8b806ea000b10 ON acl_entries USING btree (class_id);


--
-- TOC entry 3061 (class 1259 OID 262631)
-- Name: idx_46c8b806ea000b103d9ab4a6df9183c9; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_46c8b806ea000b103d9ab4a6df9183c9 ON acl_entries USING btree (class_id, object_identity_id, security_identity_id);


--
-- TOC entry 3727 (class 1259 OID 264767)
-- Name: idx_48a4b05a4584665a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_48a4b05a4584665a ON review_product USING btree (product_id);


--
-- TOC entry 3515 (class 1259 OID 262632)
-- Name: idx_4adad40b16db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_4adad40b16db4f89 ON province USING btree (picture);


--
-- TOC entry 3516 (class 1259 OID 262633)
-- Name: idx_4adad40b472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_4adad40b472b783a ON province USING btree (gallery);


--
-- TOC entry 3517 (class 1259 OID 262634)
-- Name: idx_4adad40b5373c966; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_4adad40b5373c966 ON province USING btree (country);


--
-- TOC entry 3093 (class 1259 OID 262635)
-- Name: idx_4b7702dcc3c6f69f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_4b7702dcc3c6f69f ON campaign_car USING btree (car_id);


--
-- TOC entry 3221 (class 1259 OID 262636)
-- Name: idx_4c62e638ddf06fb0; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_4c62e638ddf06fb0 ON contact USING btree (contact_cause);


--
-- TOC entry 3720 (class 1259 OID 264597)
-- Name: idx_4d563ab654177093; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_4d563ab654177093 ON campaign_hotel USING btree (room_id);


--
-- TOC entry 3349 (class 1259 OID 262638)
-- Name: idx_523846c016db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_523846c016db4f89 ON hotel_facility USING btree (picture);


--
-- TOC entry 3350 (class 1259 OID 262639)
-- Name: idx_523846c0472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_523846c0472b783a ON hotel_facility USING btree (gallery);


--
-- TOC entry 3351 (class 1259 OID 262640)
-- Name: idx_523846c0631066a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_523846c0631066a6 ON hotel_facility USING btree (hotelid);


--
-- TOC entry 3352 (class 1259 OID 262641)
-- Name: idx_523846c086968de; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_523846c086968de ON hotel_facility USING btree (hotelfacilitytype_id);


--
-- TOC entry 3228 (class 1259 OID 262642)
-- Name: idx_5373c96616db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_5373c96616db4f89 ON country USING btree (picture);


--
-- TOC entry 3229 (class 1259 OID 262643)
-- Name: idx_5373c966472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_5373c966472b783a ON country USING btree (gallery);


--
-- TOC entry 3230 (class 1259 OID 262644)
-- Name: idx_5373c966622f3f37; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_5373c966622f3f37 ON country USING btree (market_id);


--
-- TOC entry 3283 (class 1259 OID 262645)
-- Name: idx_545ec12957759bb4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_545ec12957759bb4 ON excursion_exclusive_item USING btree (pickupplace);


--
-- TOC entry 3284 (class 1259 OID 262646)
-- Name: idx_545ec129abbf655d; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_545ec129abbf655d ON excursion_exclusive_item USING btree (dropoffplace);


--
-- TOC entry 3474 (class 1259 OID 262647)
-- Name: idx_54d14232da6a219; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_54d14232da6a219 ON place_type_place USING btree (place_id);


--
-- TOC entry 3475 (class 1259 OID 262648)
-- Name: idx_54d14232f1809b68; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_54d14232f1809b68 ON place_type_place USING btree (place_type_id);


--
-- TOC entry 3390 (class 1259 OID 262652)
-- Name: idx_5c6dd74e12469de2; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_5c6dd74e12469de2 ON media__media USING btree (category_id);


--
-- TOC entry 3439 (class 1259 OID 262653)
-- Name: idx_647d736cf5cee5; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_647d736cf5cee5 ON package_option USING btree (id_package);


--
-- TOC entry 3187 (class 1259 OID 262654)
-- Name: idx_64ad97a1325f3a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_64ad97a1325f3a6 ON circuit_request USING btree (circuit);


--
-- TOC entry 3144 (class 1259 OID 262655)
-- Name: idx_683c744316cc45c9; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_683c744316cc45c9 ON car_request USING btree (pickupplace_id);


--
-- TOC entry 3145 (class 1259 OID 262656)
-- Name: idx_683c744341714987; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_683c744341714987 ON car_request USING btree (dropoffplace_id);


--
-- TOC entry 3146 (class 1259 OID 262657)
-- Name: idx_683c7443de686795; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_683c7443de686795 ON car_request USING btree (package);


--
-- TOC entry 3109 (class 1259 OID 262658)
-- Name: idx_6b7259a742348f7a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_6b7259a742348f7a ON campaigntransfercolective_transfers USING btree (campaign_transfer_colective_id);


--
-- TOC entry 3110 (class 1259 OID 262659)
-- Name: idx_6b7259a7fe15b631; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_6b7259a7fe15b631 ON campaigntransfercolective_transfers USING btree (transfer_colective_id);


--
-- TOC entry 3458 (class 1259 OID 262660)
-- Name: idx_6d28840d19eb6921; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_6d28840d19eb6921 ON payment USING btree (client_id);


--
-- TOC entry 3459 (class 1259 OID 262661)
-- Name: idx_6d28840dd677b63c; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_6d28840dd677b63c ON payment USING btree (curency);


--
-- TOC entry 3410 (class 1259 OID 262662)
-- Name: idx_6dd2e6a63535ed9; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_6dd2e6a63535ed9 ON ocupation_item USING btree (hotel);


--
-- TOC entry 3411 (class 1259 OID 262663)
-- Name: idx_6dd2e6a6729f519b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_6dd2e6a6729f519b ON ocupation_item USING btree (room);


--
-- TOC entry 3255 (class 1259 OID 262664)
-- Name: idx_6f2077c75bd15c26; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_6f2077c75bd15c26 ON documents_rentalhouse USING btree (rental_house_id);


--
-- TOC entry 3256 (class 1259 OID 262665)
-- Name: idx_6f2077c7c33f7837; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_6f2077c7c33f7837 ON documents_rentalhouse USING btree (document_id);


--
-- TOC entry 3614 (class 1259 OID 262666)
-- Name: idx_729f519b16db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_729f519b16db4f89 ON room USING btree (picture);


--
-- TOC entry 3615 (class 1259 OID 262667)
-- Name: idx_729f519b472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_729f519b472b783a ON room USING btree (gallery);


--
-- TOC entry 3616 (class 1259 OID 262668)
-- Name: idx_729f519b631066a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_729f519b631066a6 ON room USING btree (hotelid);


--
-- TOC entry 3462 (class 1259 OID 262669)
-- Name: idx_741d53cd16db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_741d53cd16db4f89 ON place USING btree (picture);


--
-- TOC entry 3463 (class 1259 OID 262670)
-- Name: idx_741d53cd1db5abff; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_741d53cd1db5abff ON place USING btree (polo);


--
-- TOC entry 3464 (class 1259 OID 262671)
-- Name: idx_741d53cd472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_741d53cd472b783a ON place USING btree (gallery);


--
-- TOC entry 3465 (class 1259 OID 262672)
-- Name: idx_741d53cd4adad40b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_741d53cd4adad40b ON place USING btree (province);


--
-- TOC entry 3380 (class 1259 OID 262673)
-- Name: idx_76218fe7622f3f37; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_76218fe7622f3f37 ON market_campaigns USING btree (market_id);


--
-- TOC entry 3381 (class 1259 OID 262674)
-- Name: idx_76218fe7f639f774; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_76218fe7f639f774 ON market_campaigns USING btree (campaign_id);


--
-- TOC entry 3102 (class 1259 OID 262675)
-- Name: idx_76d2fbb9f44cabff; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_76d2fbb9f44cabff ON campaign_package USING btree (package_id);


--
-- TOC entry 3184 (class 1259 OID 262676)
-- Name: idx_76e343e357759bb4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_76e343e357759bb4 ON circuit_item USING btree (pickupplace);


--
-- TOC entry 3121 (class 1259 OID 262677)
-- Name: idx_773de69d32e09c48; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_773de69d32e09c48 ON car USING btree (car_class);


--
-- TOC entry 3122 (class 1259 OID 262678)
-- Name: idx_773de69d897a2cc5; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_773de69d897a2cc5 ON car USING btree (car_category);


--
-- TOC entry 3123 (class 1259 OID 262679)
-- Name: idx_773de69dc2e0437c; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_773de69dc2e0437c ON car USING btree (car_luggage_capacity);


--
-- TOC entry 3611 (class 1259 OID 264696)
-- Name: idx_794381c6a76ed395; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_794381c6a76ed395 ON review USING btree (user_id);


--
-- TOC entry 3399 (class 1259 OID 262681)
-- Name: idx_7d956f5173f0cafe; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_7d956f5173f0cafe ON medical_request USING btree (medicalservice);


--
-- TOC entry 3484 (class 1259 OID 262682)
-- Name: idx_800943862e21d3e1; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_800943862e21d3e1 ON polos_provinces USING btree (polo_id);


--
-- TOC entry 3485 (class 1259 OID 262683)
-- Name: idx_80094386e946114a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_80094386e946114a ON polos_provinces USING btree (province_id);


--
-- TOC entry 3386 (class 1259 OID 262684)
-- Name: idx_80d4c5414e7af8f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_80d4c5414e7af8f ON media__gallery_media USING btree (gallery_id);


--
-- TOC entry 3387 (class 1259 OID 262685)
-- Name: idx_80d4c541ea9fdd75; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_80d4c541ea9fdd75 ON media__gallery_media USING btree (media_id);


--
-- TOC entry 3069 (class 1259 OID 262686)
-- Name: idx_825de2993d9ab4a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_825de2993d9ab4a6 ON acl_object_identity_ancestors USING btree (object_identity_id);


--
-- TOC entry 3070 (class 1259 OID 262687)
-- Name: idx_825de299c671cea1; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_825de299c671cea1 ON acl_object_identity_ancestors USING btree (ancestor_id);


--
-- TOC entry 3621 (class 1259 OID 262688)
-- Name: idx_89c5ba2c729f519b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_89c5ba2c729f519b ON room_availability USING btree (room);


--
-- TOC entry 3624 (class 1259 OID 262689)
-- Name: idx_8dcc52df54177093; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_8dcc52df54177093 ON room_facilities_rooms USING btree (room_id);


--
-- TOC entry 3625 (class 1259 OID 262690)
-- Name: idx_8dcc52df985ce863; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_8dcc52df985ce863 ON room_facilities_rooms USING btree (rental_house_room_facility_id);


--
-- TOC entry 3672 (class 1259 OID 262691)
-- Name: idx_9229dc9657759bb4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_9229dc9657759bb4 ON transfer_colective_item USING btree (pickupplace);


--
-- TOC entry 3673 (class 1259 OID 262692)
-- Name: idx_9229dc96abbf655d; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_9229dc96abbf655d ON transfer_colective_item USING btree (dropoffplace);


--
-- TOC entry 3674 (class 1259 OID 262693)
-- Name: idx_9229dc96c257e60e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_9229dc96c257e60e ON transfer_colective_item USING btree (flight);


--
-- TOC entry 3509 (class 1259 OID 262694)
-- Name: idx_92c4739c16db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_92c4739c16db4f89 ON provider USING btree (picture);


--
-- TOC entry 3510 (class 1259 OID 262695)
-- Name: idx_92c4739c472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_92c4739c472b783a ON provider USING btree (gallery);


--
-- TOC entry 3065 (class 1259 OID 262696)
-- Name: idx_9407e54977fa751a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_9407e54977fa751a ON acl_object_identities USING btree (parent_object_identity_id);


--
-- TOC entry 3149 (class 1259 OID 262699)
-- Name: idx_98293d8b57759bb4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_98293d8b57759bb4 ON car_searcher USING btree (pickupplace);


--
-- TOC entry 3150 (class 1259 OID 262700)
-- Name: idx_98293d8b773de69d; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_98293d8b773de69d ON car_searcher USING btree (car);


--
-- TOC entry 3151 (class 1259 OID 262701)
-- Name: idx_98293d8babbf655d; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_98293d8babbf655d ON car_searcher USING btree (dropoffplace);


--
-- TOC entry 3152 (class 1259 OID 262702)
-- Name: idx_98293d8bf5c1974e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_98293d8bf5c1974e ON car_searcher USING btree (luggagecapacity);


--
-- TOC entry 3711 (class 1259 OID 264496)
-- Name: idx_9a0afa034ab4296f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_9a0afa034ab4296f ON campaign_excursion_exclusive USING btree (excursion_id);


--
-- TOC entry 3272 (class 1259 OID 262705)
-- Name: idx_9b08e72f48862324; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_9b08e72f48862324 ON excursion USING btree (polofrom);


--
-- TOC entry 3699 (class 1259 OID 262707)
-- Name: idx_a0ebc00716db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a0ebc00716db4f89 ON zone USING btree (picture);


--
-- TOC entry 3700 (class 1259 OID 262708)
-- Name: idx_a0ebc007472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a0ebc007472b783a ON zone USING btree (gallery);


--
-- TOC entry 3701 (class 1259 OID 262709)
-- Name: idx_a0ebc0074adad40b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a0ebc0074adad40b ON zone USING btree (province);


--
-- TOC entry 3206 (class 1259 OID 262710)
-- Name: idx_a406b56ae25d857e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a406b56ae25d857e ON classification__collection USING btree (context);


--
-- TOC entry 3207 (class 1259 OID 262711)
-- Name: idx_a406b56aea9fdd75; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a406b56aea9fdd75 ON classification__collection USING btree (media_id);


--
-- TOC entry 3724 (class 1259 OID 264741)
-- Name: idx_a5f34c89cc197e87; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a5f34c89cc197e87 ON review_rental_house USING btree (rentalhouse_id);


--
-- TOC entry 3732 (class 1259 OID 264809)
-- Name: idx_a6d96c834ab4296f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a6d96c834ab4296f ON excursion_place USING btree (excursion_id);


--
-- TOC entry 3733 (class 1259 OID 264810)
-- Name: idx_a6d96c83da6a219; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a6d96c83da6a219 ON excursion_place USING btree (place_id);


--
-- TOC entry 3532 (class 1259 OID 262712)
-- Name: idx_a6f3e25216db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a6f3e25216db4f89 ON rental_house_facility USING btree (picture);


--
-- TOC entry 3533 (class 1259 OID 262713)
-- Name: idx_a6f3e25236defb08; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a6f3e25236defb08 ON rental_house_facility USING btree (rentalhousefacilitytype_id);


--
-- TOC entry 3534 (class 1259 OID 262714)
-- Name: idx_a6f3e252472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a6f3e252472b783a ON rental_house_facility USING btree (gallery);


--
-- TOC entry 3535 (class 1259 OID 262715)
-- Name: idx_a6f3e252fc3eb772; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a6f3e252fc3eb772 ON rental_house_facility USING btree (rental_house);


--
-- TOC entry 3402 (class 1259 OID 262716)
-- Name: idx_a79f7a1cd4ef974a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a79f7a1cd4ef974a ON medical_service USING btree (medical_program);


--
-- TOC entry 3294 (class 1259 OID 262717)
-- Name: idx_a9cc84021db5abff; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a9cc84021db5abff ON excursion_searcher USING btree (polo);


--
-- TOC entry 3295 (class 1259 OID 262718)
-- Name: idx_a9cc840248862324; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a9cc840248862324 ON excursion_searcher USING btree (polofrom);


--
-- TOC entry 3296 (class 1259 OID 262720)
-- Name: idx_a9cc84029b08e72f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_a9cc84029b08e72f ON excursion_searcher USING btree (excursion);


--
-- TOC entry 3595 (class 1259 OID 262721)
-- Name: idx_aa192ae6985ce863; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_aa192ae6985ce863 ON rental_house_room_searcher_rental_house_room_facility USING btree (rental_house_room_facility_id);


--
-- TOC entry 3596 (class 1259 OID 262722)
-- Name: idx_aa192ae6f6a4bf14; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_aa192ae6f6a4bf14 ON rental_house_room_searcher_rental_house_room_facility USING btree (rental_house_room_searcher_id);


--
-- TOC entry 3649 (class 1259 OID 262723)
-- Name: idx_abd861ddc7470a42; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_abd861ddc7470a42 ON service_pax USING btree (gender);


--
-- TOC entry 3650 (class 1259 OID 262724)
-- Name: idx_abd861dde19d9ad2; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_abd861dde19d9ad2 ON service_pax USING btree (service);


--
-- TOC entry 3445 (class 1259 OID 262725)
-- Name: idx_abe637322e21d3e1; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_abe637322e21d3e1 ON package_option_polos USING btree (polo_id);


--
-- TOC entry 3446 (class 1259 OID 262726)
-- Name: idx_abe63732d2ad0a4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_abe63732d2ad0a4 ON package_option_polos USING btree (package_option_id);


--
-- TOC entry 3158 (class 1259 OID 262727)
-- Name: idx_b10218ca16db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b10218ca16db4f89 ON chain USING btree (picture);


--
-- TOC entry 3159 (class 1259 OID 262728)
-- Name: idx_b10218ca472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b10218ca472b783a ON chain USING btree (gallery);


--
-- TOC entry 3333 (class 1259 OID 262729)
-- Name: idx_b3c77447a76ed395; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b3c77447a76ed395 ON fos_user_user_group USING btree (user_id);


--
-- TOC entry 3334 (class 1259 OID 262730)
-- Name: idx_b3c77447fe54d947; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b3c77447fe54d947 ON fos_user_user_group USING btree (group_id);


--
-- TOC entry 3164 (class 1259 OID 262731)
-- Name: idx_b45d93a09a9812fd; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b45d93a09a9812fd ON circuirsearcher_place USING btree (id_place);


--
-- TOC entry 3165 (class 1259 OID 262732)
-- Name: idx_b45d93a0b7d47c9f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b45d93a0b7d47c9f ON circuirsearcher_place USING btree (id_circuitsearcher);


--
-- TOC entry 3452 (class 1259 OID 262733)
-- Name: idx_b4ccea1345baebcb; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b4ccea1345baebcb ON package_request USING btree (packageoption);


--
-- TOC entry 3453 (class 1259 OID 262734)
-- Name: idx_b4ccea13de686795; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b4ccea13de686795 ON package_request USING btree (package);


--
-- TOC entry 3585 (class 1259 OID 262737)
-- Name: idx_b709215c1db5abff; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b709215c1db5abff ON rental_house_room_searcher USING btree (polo);


--
-- TOC entry 3586 (class 1259 OID 262738)
-- Name: idx_b709215c27302f0f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b709215c27302f0f ON rental_house_room_searcher USING btree (rentalhouseroom);


--
-- TOC entry 3587 (class 1259 OID 262739)
-- Name: idx_b709215c4adad40b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b709215c4adad40b ON rental_house_room_searcher USING btree (province);


--
-- TOC entry 3588 (class 1259 OID 262740)
-- Name: idx_b709215cb5bc1646; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_b709215cb5bc1646 ON rental_house_room_searcher USING btree (rentalhouse);


--
-- TOC entry 3322 (class 1259 OID 262741)
-- Name: idx_ba346ec289f53c8; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_ba346ec289f53c8 ON flights_airports USING btree (airport_id);


--
-- TOC entry 3323 (class 1259 OID 262742)
-- Name: idx_ba346ec91f478c5; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_ba346ec91f478c5 ON flights_airports USING btree (flight_id);


--
-- TOC entry 3591 (class 1259 OID 262743)
-- Name: idx_bad7734b41850d80; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_bad7734b41850d80 ON rental_house_room_searcher_rental_house_facility_type USING btree (rental_house_facility_id);


--
-- TOC entry 3592 (class 1259 OID 262744)
-- Name: idx_bad7734bf6a4bf14; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_bad7734bf6a4bf14 ON rental_house_room_searcher_rental_house_facility_type USING btree (rental_house_room_searcher_id);


--
-- TOC entry 3561 (class 1259 OID 262745)
-- Name: idx_baf18227fc3eb772; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_baf18227fc3eb772 ON rental_house_room USING btree (rental_house);


--
-- TOC entry 3096 (class 1259 OID 262746)
-- Name: idx_bb9f6f8acf2182c8; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_bb9f6f8acf2182c8 ON campaign_circuit USING btree (circuit_id);


--
-- TOC entry 3449 (class 1259 OID 262747)
-- Name: idx_bf8d558bde686795; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_bf8d558bde686795 ON package_option_searcher USING btree (package);


--
-- TOC entry 3549 (class 1259 OID 262748)
-- Name: idx_c10c41f85bd15c26; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c10c41f85bd15c26 ON rental_house_rental_house_owner USING btree (rental_house_id);


--
-- TOC entry 3550 (class 1259 OID 262749)
-- Name: idx_c10c41f8c8961719; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c10c41f8c8961719 ON rental_house_rental_house_owner USING btree (rental_house_owner_id);


--
-- TOC entry 3407 (class 1259 OID 262750)
-- Name: idx_c1a3ad60729f519b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c1a3ad60729f519b ON ocupation USING btree (room);


--
-- TOC entry 3317 (class 1259 OID 262751)
-- Name: idx_c257e60eec141ef8; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c257e60eec141ef8 ON flight USING btree (airline);


--
-- TOC entry 3173 (class 1259 OID 262752)
-- Name: idx_c2695d931d530028; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c2695d931d530028 ON circuit_circuitavailabilitys USING btree (circuit_availability_id);


--
-- TOC entry 3174 (class 1259 OID 262753)
-- Name: idx_c2695d93cf2182c8; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c2695d93cf2182c8 ON circuit_circuitavailabilitys USING btree (circuit_id);


--
-- TOC entry 3197 (class 1259 OID 262754)
-- Name: idx_c7123ab1c017343; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c7123ab1c017343 ON circuits_days_places USING btree (circuit_day_id);


--
-- TOC entry 3198 (class 1259 OID 262755)
-- Name: idx_c7123ab1da6a219; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c7123ab1da6a219 ON circuits_days_places USING btree (place_id);


--
-- TOC entry 3190 (class 1259 OID 262756)
-- Name: idx_c742c32e1325f3a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c742c32e1325f3a6 ON circuit_searcher USING btree (circuit);


--
-- TOC entry 3191 (class 1259 OID 264849)
-- Name: idx_c742c32eecb6bf02; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c742c32eecb6bf02 ON circuit_searcher USING btree (polofromid);


--
-- TOC entry 3299 (class 1259 OID 262757)
-- Name: idx_c946eb261dd011e1; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c946eb261dd011e1 ON excursion_searcher_excursion_type USING btree (excursion_type_id);


--
-- TOC entry 3300 (class 1259 OID 262758)
-- Name: idx_c946eb26a8f8c223; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_c946eb26a8f8c223 ON excursion_searcher_excursion_type USING btree (excursion_searcher_id);


--
-- TOC entry 3213 (class 1259 OID 262760)
-- Name: idx_ca57a1c7e25d857e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_ca57a1c7e25d857e ON classification__tag USING btree (context);


--
-- TOC entry 3498 (class 1259 OID 262762)
-- Name: idx_cdfc7356d34a04ad; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_cdfc7356d34a04ad ON product_category USING btree (product);


--
-- TOC entry 3564 (class 1259 OID 262763)
-- Name: idx_cf5eb5bfbaf18227; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_cf5eb5bfbaf18227 ON rental_house_room_availability USING btree (rental_house_room);


--
-- TOC entry 3488 (class 1259 OID 262764)
-- Name: idx_d34a04ad16db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d34a04ad16db4f89 ON product USING btree (picture);


--
-- TOC entry 3489 (class 1259 OID 262765)
-- Name: idx_d34a04ad3b28f0c3; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d34a04ad3b28f0c3 ON product USING btree (product_increment);


--
-- TOC entry 3490 (class 1259 OID 262766)
-- Name: idx_d34a04ad464ff655; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d34a04ad464ff655 ON product USING btree (cancelation_product);


--
-- TOC entry 3491 (class 1259 OID 262767)
-- Name: idx_d34a04ad472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d34a04ad472b783a ON product USING btree (gallery);


--
-- TOC entry 3492 (class 1259 OID 262768)
-- Name: idx_d34a04ad92c4739c; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d34a04ad92c4739c ON product USING btree (provider);


--
-- TOC entry 3493 (class 1259 OID 262769)
-- Name: idx_d34a04ad9468df6f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d34a04ad9468df6f ON product USING btree (term_condition_product);


--
-- TOC entry 3140 (class 1259 OID 262770)
-- Name: idx_d47131b216cc45c9; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d47131b216cc45c9 ON car_item USING btree (pickupplace_id);


--
-- TOC entry 3141 (class 1259 OID 262771)
-- Name: idx_d47131b241714987; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d47131b241714987 ON car_item USING btree (dropoffplace_id);


--
-- TOC entry 3393 (class 1259 OID 262772)
-- Name: idx_d4ef974a16db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d4ef974a16db4f89 ON medical_program USING btree (picture);


--
-- TOC entry 3394 (class 1259 OID 262773)
-- Name: idx_d4ef974a472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d4ef974a472b783a ON medical_program USING btree (gallery);


--
-- TOC entry 3544 (class 1259 OID 262774)
-- Name: idx_d7f770816db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d7f770816db4f89 ON rental_house_owner USING btree (picture);


--
-- TOC entry 3677 (class 1259 OID 262775)
-- Name: idx_d918ce5e4034a3c0; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d918ce5e4034a3c0 ON transfer_colective_request USING btree (transfer);


--
-- TOC entry 3678 (class 1259 OID 262776)
-- Name: idx_d918ce5ec257e60e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_d918ce5ec257e60e ON transfer_colective_request USING btree (flight);


--
-- TOC entry 3251 (class 1259 OID 262777)
-- Name: idx_da23d4c54584665a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_da23d4c54584665a ON documents_products USING btree (product_id);


--
-- TOC entry 3252 (class 1259 OID 262778)
-- Name: idx_da23d4c5c33f7837; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_da23d4c5c33f7837 ON documents_products USING btree (document_id);


--
-- TOC entry 3571 (class 1259 OID 262779)
-- Name: idx_dca38774729f519b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_dca38774729f519b ON rental_house_room_item USING btree (room);


--
-- TOC entry 3572 (class 1259 OID 262780)
-- Name: idx_dca38774b5bc1646; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_dca38774b5bc1646 ON rental_house_room_item USING btree (rentalhouse);


--
-- TOC entry 3430 (class 1259 OID 262781)
-- Name: idx_de68679516db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_de68679516db4f89 ON package USING btree (picture);


--
-- TOC entry 3431 (class 1259 OID 262782)
-- Name: idx_de6867952846bf7b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_de6867952846bf7b ON package USING btree (cancelation_packages);


--
-- TOC entry 3432 (class 1259 OID 262783)
-- Name: idx_de6867953b28f0c3; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_de6867953b28f0c3 ON package USING btree (product_increment);


--
-- TOC entry 3433 (class 1259 OID 262784)
-- Name: idx_de686795472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_de686795472b783a ON package USING btree (gallery);


--
-- TOC entry 3434 (class 1259 OID 262785)
-- Name: idx_de686795994abc57; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_de686795994abc57 ON package USING btree (term_condition_package);


--
-- TOC entry 3099 (class 1259 OID 262786)
-- Name: idx_df619b76592af3ba; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_df619b76592af3ba ON campaign_medical USING btree (medical_id);


--
-- TOC entry 3361 (class 1259 OID 262787)
-- Name: idx_e01670416db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e01670416db4f89 ON hotel_sales_agent USING btree (picture);


--
-- TOC entry 3362 (class 1259 OID 262788)
-- Name: idx_e016704631066a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e016704631066a6 ON hotel_sales_agent USING btree (hotelid);


--
-- TOC entry 3641 (class 1259 OID 262789)
-- Name: idx_e19d9ad2a76ed395; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e19d9ad2a76ed395 ON service USING btree (user_id);


--
-- TOC entry 3642 (class 1259 OID 262790)
-- Name: idx_e19d9ad2b4ac2222; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e19d9ad2b4ac2222 ON service USING btree (servicemanagementstatus);


--
-- TOC entry 3643 (class 1259 OID 262791)
-- Name: idx_e19d9ad2e54bc005; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e19d9ad2e54bc005 ON service USING btree (sale);


--
-- TOC entry 3291 (class 1259 OID 262792)
-- Name: idx_e30b12ed9b08e72f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e30b12ed9b08e72f ON excursion_request USING btree (excursion);


--
-- TOC entry 3581 (class 1259 OID 262793)
-- Name: idx_e38b57cb984cadac; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e38b57cb984cadac ON rental_house_room_rental_house_room_ocupations USING btree (rental_house_room_id);


--
-- TOC entry 3582 (class 1259 OID 262794)
-- Name: idx_e38b57cbb3d34300; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e38b57cbb3d34300 ON rental_house_room_rental_house_room_ocupations USING btree (rental_house_room_ocupation_id);


--
-- TOC entry 3505 (class 1259 OID 262795)
-- Name: idx_e3ab5a2c4584665a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e3ab5a2c4584665a ON products_tags USING btree (product_id);


--
-- TOC entry 3506 (class 1259 OID 262796)
-- Name: idx_e3ab5a2cbad26311; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e3ab5a2cbad26311 ON products_tags USING btree (tag_id);


--
-- TOC entry 3683 (class 1259 OID 262797)
-- Name: idx_e4970a3057759bb4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e4970a3057759bb4 ON transfer_exclusive_item USING btree (pickupplace);


--
-- TOC entry 3684 (class 1259 OID 262798)
-- Name: idx_e4970a30abbf655d; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e4970a30abbf655d ON transfer_exclusive_item USING btree (dropoffplace);


--
-- TOC entry 3685 (class 1259 OID 262799)
-- Name: idx_e4970a30c257e60e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e4970a30c257e60e ON transfer_exclusive_item USING btree (flight);


--
-- TOC entry 3736 (class 1259 OID 264826)
-- Name: idx_e4e7d6e0a8f8c223; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e4e7d6e0a8f8c223 ON excursion_searcher_excursion_place USING btree (excursion_searcher_id);


--
-- TOC entry 3737 (class 1259 OID 264827)
-- Name: idx_e4e7d6e0b3752e94; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e4e7d6e0b3752e94 ON excursion_searcher_excursion_place USING btree (excursion_place_id);


--
-- TOC entry 3628 (class 1259 OID 262800)
-- Name: idx_e54bc00519eb6921; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e54bc00519eb6921 ON sale USING btree (client_id);


--
-- TOC entry 3629 (class 1259 OID 262801)
-- Name: idx_e54bc0056bac85cb; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e54bc0056bac85cb ON sale USING btree (market);


--
-- TOC entry 3630 (class 1259 OID 262802)
-- Name: idx_e54bc005d677b63c; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e54bc005d677b63c ON sale USING btree (curency);


--
-- TOC entry 3740 (class 1259 OID 264864)
-- Name: idx_e88cb75bc3c6f69f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_e88cb75bc3c6f69f ON car_season USING btree (car_id);


--
-- TOC entry 3076 (class 1259 OID 262803)
-- Name: idx_ec141ef816db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_ec141ef816db4f89 ON airline USING btree (picture);


--
-- TOC entry 3077 (class 1259 OID 262804)
-- Name: idx_ec141ef8472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_ec141ef8472b783a ON airline USING btree (gallery);


--
-- TOC entry 3636 (class 1259 OID 262805)
-- Name: idx_f0e45ba9631066a6; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f0e45ba9631066a6 ON season USING btree (hotelid);


--
-- TOC entry 3155 (class 1259 OID 262806)
-- Name: idx_f0fe2527d34a04ad; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f0fe2527d34a04ad ON cart_item USING btree (product);


--
-- TOC entry 3247 (class 1259 OID 262807)
-- Name: idx_f22c4e38c33f7837; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f22c4e38c33f7837 ON documents_packages USING btree (document_id);


--
-- TOC entry 3248 (class 1259 OID 262808)
-- Name: idx_f22c4e38f44cabff; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f22c4e38f44cabff ON documents_packages USING btree (package_id);


--
-- TOC entry 3194 (class 1259 OID 262809)
-- Name: idx_f52769cccf2182c8; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f52769cccf2182c8 ON circuit_season USING btree (circuit_id);


--
-- TOC entry 3692 (class 1259 OID 262810)
-- Name: idx_f6ae25e54034a3c0; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f6ae25e54034a3c0 ON transfer_searcher USING btree (transfer);


--
-- TOC entry 3693 (class 1259 OID 262811)
-- Name: idx_f6ae25e548862324; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f6ae25e548862324 ON transfer_searcher USING btree (polofrom);


--
-- TOC entry 3694 (class 1259 OID 262812)
-- Name: idx_f6ae25e55a74863; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f6ae25e55a74863 ON transfer_searcher USING btree (poloto);


--
-- TOC entry 3695 (class 1259 OID 262813)
-- Name: idx_f6ae25e55bb10f94; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f6ae25e55bb10f94 ON transfer_searcher USING btree (placeto);


--
-- TOC entry 3696 (class 1259 OID 262814)
-- Name: idx_f6ae25e5fbc3de7b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f6ae25e5fbc3de7b ON transfer_searcher USING btree (placefrom);


--
-- TOC entry 3557 (class 1259 OID 262815)
-- Name: idx_f7cc52a027302f0f; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f7cc52a027302f0f ON rental_house_request USING btree (rentalhouseroom);


--
-- TOC entry 3558 (class 1259 OID 262816)
-- Name: idx_f7cc52a0b5bc1646; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f7cc52a0b5bc1646 ON rental_house_request USING btree (rentalhouse);


--
-- TOC entry 3414 (class 1259 OID 262817)
-- Name: idx_f8033af41db5abff; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f8033af41db5abff ON ocupation_searcher USING btree (polo);


--
-- TOC entry 3415 (class 1259 OID 262818)
-- Name: idx_f8033af43535ed9; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f8033af43535ed9 ON ocupation_searcher USING btree (hotel);


--
-- TOC entry 3416 (class 1259 OID 262819)
-- Name: idx_f8033af44adad40b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f8033af44adad40b ON ocupation_searcher USING btree (province);


--
-- TOC entry 3417 (class 1259 OID 262820)
-- Name: idx_f8033af4729f519b; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f8033af4729f519b ON ocupation_searcher USING btree (room);


--
-- TOC entry 3418 (class 1259 OID 262821)
-- Name: idx_f8033af49bfcd030; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f8033af49bfcd030 ON ocupation_searcher USING btree (hoteltype);


--
-- TOC entry 3419 (class 1259 OID 262822)
-- Name: idx_f8033af4b10218ca; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_f8033af4b10218ca ON ocupation_searcher USING btree (chain);


--
-- TOC entry 3369 (class 1259 OID 262823)
-- Name: idx_face33a4711638b3; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_face33a4711638b3 ON kid_policy USING btree (hotelprice_id);


--
-- TOC entry 3370 (class 1259 OID 262824)
-- Name: idx_face33a47ae03e27; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_face33a47ae03e27 ON kid_policy USING btree (ocupation_id);


--
-- TOC entry 3371 (class 1259 OID 264613)
-- Name: idx_face33a4eeb1c649; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_face33a4eeb1c649 ON kid_policy USING btree (campaignhotel_id);


--
-- TOC entry 3522 (class 1259 OID 262825)
-- Name: idx_fc3eb77216db4f89; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fc3eb77216db4f89 ON rental_house USING btree (picture);


--
-- TOC entry 3523 (class 1259 OID 262826)
-- Name: idx_fc3eb7723b28f0c3; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fc3eb7723b28f0c3 ON rental_house USING btree (product_increment);


--
-- TOC entry 3524 (class 1259 OID 262827)
-- Name: idx_fc3eb772472b783a; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fc3eb772472b783a ON rental_house USING btree (gallery);


--
-- TOC entry 3525 (class 1259 OID 262828)
-- Name: idx_fc3eb772a0ebc007; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fc3eb772a0ebc007 ON rental_house USING btree (zone);


--
-- TOC entry 3526 (class 1259 OID 262829)
-- Name: idx_fc3eb772cc754692; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fc3eb772cc754692 ON rental_house USING btree (term_condition_house);


--
-- TOC entry 3527 (class 1259 OID 262830)
-- Name: idx_fc3eb772f99f469; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fc3eb772f99f469 ON rental_house USING btree (cancelation_house);


--
-- TOC entry 3604 (class 1259 OID 262831)
-- Name: idx_fd3e8a4c6dca30a9; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fd3e8a4c6dca30a9 ON rentalhouseroomsearcher_type USING btree (id_typehouse);


--
-- TOC entry 3605 (class 1259 OID 262832)
-- Name: idx_fd3e8a4cee3a70bf; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fd3e8a4cee3a70bf ON rentalhouseroomsearcher_type USING btree (id_rentalhouseroomsearcher);


--
-- TOC entry 3688 (class 1259 OID 262833)
-- Name: idx_ff5613e84034a3c0; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_ff5613e84034a3c0 ON transfer_exclusive_request USING btree (transfer);


--
-- TOC entry 3689 (class 1259 OID 262834)
-- Name: idx_ff5613e8c257e60e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_ff5613e8c257e60e ON transfer_exclusive_request USING btree (flight);


--
-- TOC entry 3716 (class 1259 OID 264528)
-- Name: idx_fff52f732666d333; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fff52f732666d333 ON campaignrantalhouses_rentalhouserooms USING btree (campaign_rental_house_id);


--
-- TOC entry 3717 (class 1259 OID 264527)
-- Name: idx_fff52f73984cadac; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX idx_fff52f73984cadac ON campaignrantalhouses_rentalhouserooms USING btree (rental_house_room_id);


--
-- TOC entry 3307 (class 1259 OID 262835)
-- Name: log_class_lookup_idx; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX log_class_lookup_idx ON ext_log_entries USING btree (object_class);


--
-- TOC entry 3308 (class 1259 OID 262836)
-- Name: log_date_lookup_idx; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX log_date_lookup_idx ON ext_log_entries USING btree (logged_at);


--
-- TOC entry 3309 (class 1259 OID 262837)
-- Name: log_user_lookup_idx; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX log_user_lookup_idx ON ext_log_entries USING btree (username);


--
-- TOC entry 3310 (class 1259 OID 262838)
-- Name: log_version_lookup_idx; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX log_version_lookup_idx ON ext_log_entries USING btree (object_id, object_class, version);


--
-- TOC entry 3313 (class 1259 OID 262839)
-- Name: lookup_unique_idx; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX lookup_unique_idx ON ext_translations USING btree (locale, object_class, field, foreign_key);


--
-- TOC entry 3208 (class 1259 OID 262840)
-- Name: tag_collection; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX tag_collection ON classification__collection USING btree (slug, context);


--
-- TOC entry 3214 (class 1259 OID 262841)
-- Name: tag_context; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX tag_context ON classification__tag USING btree (slug, context);


--
-- TOC entry 3314 (class 1259 OID 262842)
-- Name: translations_lookup_idx; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE INDEX translations_lookup_idx ON ext_translations USING btree (locale, object_class, foreign_key);


--
-- TOC entry 3260 (class 1259 OID 262843)
-- Name: uniq_11667cd95e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_11667cd95e15a06e ON driver USING btree (unique_slug);


--
-- TOC entry 3261 (class 1259 OID 262844)
-- Name: uniq_11667cd9989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_11667cd9989d9b62 ON driver USING btree (slug);


--
-- TOC entry 3180 (class 1259 OID 262845)
-- Name: uniq_1b042a035e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_1b042a035e15a06e ON circuit_day USING btree (unique_slug);


--
-- TOC entry 3181 (class 1259 OID 262846)
-- Name: uniq_1b042a03989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_1b042a03989d9b62 ON circuit_day USING btree (slug);


--
-- TOC entry 3482 (class 1259 OID 262847)
-- Name: uniq_1db5abff5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_1db5abff5e15a06e ON polo USING btree (unique_slug);


--
-- TOC entry 3483 (class 1259 OID 262848)
-- Name: uniq_1db5abff989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_1db5abff989d9b62 ON polo USING btree (slug);


--
-- TOC entry 3089 (class 1259 OID 262849)
-- Name: uniq_1f1512dd5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_1f1512dd5e15a06e ON campaign USING btree (unique_slug);


--
-- TOC entry 3090 (class 1259 OID 262850)
-- Name: uniq_1f1512dd989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_1f1512dd989d9b62 ON campaign USING btree (slug);


--
-- TOC entry 3136 (class 1259 OID 262851)
-- Name: uniq_32e09c485e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_32e09c485e15a06e ON car_class USING btree (unique_slug);


--
-- TOC entry 3137 (class 1259 OID 262852)
-- Name: uniq_32e09c48989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_32e09c48989d9b62 ON car_class USING btree (slug);


--
-- TOC entry 3660 (class 1259 OID 262853)
-- Name: uniq_389b7835e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_389b7835e15a06e ON tag USING btree (unique_slug);


--
-- TOC entry 3661 (class 1259 OID 262854)
-- Name: uniq_389b783989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_389b783989d9b62 ON tag USING btree (slug);


--
-- TOC entry 3367 (class 1259 OID 262855)
-- Name: uniq_3b1b81a15e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_3b1b81a15e15a06e ON hotel_type USING btree (unique_slug);


--
-- TOC entry 3368 (class 1259 OID 262856)
-- Name: uniq_3b1b81a1989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_3b1b81a1989d9b62 ON hotel_type USING btree (slug);


--
-- TOC entry 3602 (class 1259 OID 262859)
-- Name: uniq_44b084955e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_44b084955e15a06e ON rental_house_type USING btree (unique_slug);


--
-- TOC entry 3603 (class 1259 OID 262860)
-- Name: uniq_44b08495989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_44b08495989d9b62 ON rental_house_type USING btree (slug);


--
-- TOC entry 3303 (class 1259 OID 262861)
-- Name: uniq_4564e40f5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_4564e40f5e15a06e ON excursion_type USING btree (unique_slug);


--
-- TOC entry 3304 (class 1259 OID 262862)
-- Name: uniq_4564e40f989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_4564e40f989d9b62 ON excursion_type USING btree (slug);


--
-- TOC entry 3117 (class 1259 OID 262863)
-- Name: uniq_464ff6555e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_464ff6555e15a06e ON cancelation_product USING btree (unique_slug);


--
-- TOC entry 3118 (class 1259 OID 262864)
-- Name: uniq_464ff655989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_464ff655989d9b62 ON cancelation_product USING btree (slug);


--
-- TOC entry 3472 (class 1259 OID 262865)
-- Name: uniq_466b27c55e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_466b27c55e15a06e ON place_type USING btree (unique_slug);


--
-- TOC entry 3473 (class 1259 OID 262866)
-- Name: uniq_466b27c5989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_466b27c5989d9b62 ON place_type USING btree (slug);


--
-- TOC entry 3062 (class 1259 OID 262867)
-- Name: uniq_46c8b806ea000b103d9ab4a64def17bce4289bf4; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_46c8b806ea000b103d9ab4a64def17bce4289bf4 ON acl_entries USING btree (class_id, object_identity_id, field_name, ace_order);


--
-- TOC entry 3520 (class 1259 OID 262868)
-- Name: uniq_4adad40b5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_4adad40b5e15a06e ON province USING btree (unique_slug);


--
-- TOC entry 3521 (class 1259 OID 262869)
-- Name: uniq_4adad40b989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_4adad40b989d9b62 ON province USING btree (slug);


--
-- TOC entry 3353 (class 1259 OID 262870)
-- Name: uniq_523846c05e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_523846c05e15a06e ON hotel_facility USING btree (unique_slug);


--
-- TOC entry 3354 (class 1259 OID 262871)
-- Name: uniq_523846c0989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_523846c0989d9b62 ON hotel_facility USING btree (slug);


--
-- TOC entry 3231 (class 1259 OID 262872)
-- Name: uniq_5373c9665e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_5373c9665e15a06e ON country USING btree (unique_slug);


--
-- TOC entry 3232 (class 1259 OID 262873)
-- Name: uniq_5373c966989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_5373c966989d9b62 ON country USING btree (slug);


--
-- TOC entry 3326 (class 1259 OID 262874)
-- Name: uniq_583d1f3e5e237e06; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_583d1f3e5e237e06 ON fos_user_group USING btree (name);


--
-- TOC entry 3376 (class 1259 OID 262875)
-- Name: uniq_5d6404805e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_5d6404805e15a06e ON luggage_capacity USING btree (unique_slug);


--
-- TOC entry 3377 (class 1259 OID 262876)
-- Name: uniq_5d640480989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_5d640480989d9b62 ON luggage_capacity USING btree (slug);


--
-- TOC entry 3268 (class 1259 OID 262877)
-- Name: uniq_6472fc592fc23a8; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_6472fc592fc23a8 ON duser USING btree (username_canonical);


--
-- TOC entry 3269 (class 1259 OID 262878)
-- Name: uniq_6472fc5a0d96fbf; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_6472fc5a0d96fbf ON duser USING btree (email_canonical);


--
-- TOC entry 3235 (class 1259 OID 262879)
-- Name: uniq_6956883f5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_6956883f5e15a06e ON currency USING btree (unique_slug);


--
-- TOC entry 3236 (class 1259 OID 262880)
-- Name: uniq_6956883f989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_6956883f989d9b62 ON currency USING btree (slug);


--
-- TOC entry 3055 (class 1259 OID 262881)
-- Name: uniq_69dd750638a36066; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_69dd750638a36066 ON acl_classes USING btree (class_type);


--
-- TOC entry 3619 (class 1259 OID 262882)
-- Name: uniq_729f519b5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_729f519b5e15a06e ON room USING btree (unique_slug);


--
-- TOC entry 3620 (class 1259 OID 262883)
-- Name: uniq_729f519b989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_729f519b989d9b62 ON room USING btree (slug);


--
-- TOC entry 3468 (class 1259 OID 262884)
-- Name: uniq_741d53cd5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_741d53cd5e15a06e ON place USING btree (unique_slug);


--
-- TOC entry 3469 (class 1259 OID 262885)
-- Name: uniq_741d53cd989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_741d53cd989d9b62 ON place USING btree (slug);


--
-- TOC entry 3073 (class 1259 OID 262888)
-- Name: uniq_8835ee78772e836af85e0677; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_8835ee78772e836af85e0677 ON acl_security_identities USING btree (identifier, username);


--
-- TOC entry 3132 (class 1259 OID 262889)
-- Name: uniq_897a2cc55e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_897a2cc55e15a06e ON car_category USING btree (unique_slug);


--
-- TOC entry 3133 (class 1259 OID 262890)
-- Name: uniq_897a2cc5989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_897a2cc5989d9b62 ON car_category USING btree (slug);


--
-- TOC entry 3513 (class 1259 OID 262891)
-- Name: uniq_92c4739c5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_92c4739c5e15a06e ON provider USING btree (unique_slug);


--
-- TOC entry 3514 (class 1259 OID 262892)
-- Name: uniq_92c4739c989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_92c4739c989d9b62 ON provider USING btree (slug);


--
-- TOC entry 3066 (class 1259 OID 262893)
-- Name: uniq_9407e5494b12ad6ea000b10; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_9407e5494b12ad6ea000b10 ON acl_object_identities USING btree (object_identifier, class_id);


--
-- TOC entry 3664 (class 1259 OID 262894)
-- Name: uniq_9468df6f5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_9468df6f5e15a06e ON term_condition_product USING btree (unique_slug);


--
-- TOC entry 3665 (class 1259 OID 262896)
-- Name: uniq_9468df6f989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_9468df6f989d9b62 ON term_condition_product USING btree (slug);


--
-- TOC entry 3542 (class 1259 OID 262898)
-- Name: uniq_a081e4cc5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_a081e4cc5e15a06e ON rental_house_facility_type USING btree (unique_slug);


--
-- TOC entry 3543 (class 1259 OID 262899)
-- Name: uniq_a081e4cc989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_a081e4cc989d9b62 ON rental_house_facility_type USING btree (slug);


--
-- TOC entry 3702 (class 1259 OID 262900)
-- Name: uniq_a0ebc0075e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_a0ebc0075e15a06e ON zone USING btree (unique_slug);


--
-- TOC entry 3703 (class 1259 OID 262901)
-- Name: uniq_a0ebc007989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_a0ebc007989d9b62 ON zone USING btree (slug);


--
-- TOC entry 3538 (class 1259 OID 262902)
-- Name: uniq_a6f3e2525e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_a6f3e2525e15a06e ON rental_house_facility USING btree (unique_slug);


--
-- TOC entry 3539 (class 1259 OID 262903)
-- Name: uniq_a6f3e252989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_a6f3e252989d9b62 ON rental_house_facility USING btree (slug);


--
-- TOC entry 3569 (class 1259 OID 262905)
-- Name: uniq_b04fbd615e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_b04fbd615e15a06e ON rental_house_room_facility USING btree (unique_slug);


--
-- TOC entry 3570 (class 1259 OID 262906)
-- Name: uniq_b04fbd61989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_b04fbd61989d9b62 ON rental_house_room_facility USING btree (slug);


--
-- TOC entry 3160 (class 1259 OID 262907)
-- Name: uniq_b10218ca5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_b10218ca5e15a06e ON chain USING btree (unique_slug);


--
-- TOC entry 3161 (class 1259 OID 262908)
-- Name: uniq_b10218ca989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_b10218ca989d9b62 ON chain USING btree (slug);


--
-- TOC entry 3318 (class 1259 OID 262909)
-- Name: uniq_c257e60e5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_c257e60e5e15a06e ON flight USING btree (unique_slug);


--
-- TOC entry 3319 (class 1259 OID 262910)
-- Name: uniq_c257e60e989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_c257e60e989d9b62 ON flight USING btree (slug);


--
-- TOC entry 3329 (class 1259 OID 262911)
-- Name: uniq_c560d76192fc23a8; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_c560d76192fc23a8 ON fos_user_user USING btree (username_canonical);


--
-- TOC entry 3330 (class 1259 OID 262912)
-- Name: uniq_c560d761a0d96fbf; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_c560d761a0d96fbf ON fos_user_user USING btree (email_canonical);


--
-- TOC entry 3337 (class 1259 OID 262913)
-- Name: uniq_c7470a425e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_c7470a425e15a06e ON gender USING btree (unique_slug);


--
-- TOC entry 3338 (class 1259 OID 262914)
-- Name: uniq_c7470a42989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_c7470a42989d9b62 ON gender USING btree (slug);


--
-- TOC entry 3496 (class 1259 OID 262915)
-- Name: uniq_d34a04ad5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_d34a04ad5e15a06e ON product USING btree (unique_slug);


--
-- TOC entry 3497 (class 1259 OID 262916)
-- Name: uniq_d34a04ad989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_d34a04ad989d9b62 ON product USING btree (slug);


--
-- TOC entry 3397 (class 1259 OID 262917)
-- Name: uniq_d4ef974a5e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_d4ef974a5e15a06e ON medical_program USING btree (unique_slug);


--
-- TOC entry 3398 (class 1259 OID 262918)
-- Name: uniq_d4ef974a989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_d4ef974a989d9b62 ON medical_program USING btree (slug);


--
-- TOC entry 3547 (class 1259 OID 262919)
-- Name: uniq_d7f77085e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_d7f77085e15a06e ON rental_house_owner USING btree (unique_slug);


--
-- TOC entry 3548 (class 1259 OID 262920)
-- Name: uniq_d7f7708989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_d7f7708989d9b62 ON rental_house_owner USING btree (slug);


--
-- TOC entry 3239 (class 1259 OID 262921)
-- Name: uniq_d8698a765e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_d8698a765e15a06e ON document USING btree (unique_slug);


--
-- TOC entry 3240 (class 1259 OID 262922)
-- Name: uniq_d8698a76989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_d8698a76989d9b62 ON document USING btree (slug);


--
-- TOC entry 3224 (class 1259 OID 262923)
-- Name: uniq_ddf06fb05e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_ddf06fb05e15a06e ON contact_cause USING btree (unique_slug);


--
-- TOC entry 3225 (class 1259 OID 262924)
-- Name: uniq_ddf06fb0989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_ddf06fb0989d9b62 ON contact_cause USING btree (slug);


--
-- TOC entry 3437 (class 1259 OID 262925)
-- Name: uniq_de6867955e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_de6867955e15a06e ON package USING btree (unique_slug);


--
-- TOC entry 3438 (class 1259 OID 262926)
-- Name: uniq_de686795989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_de686795989d9b62 ON package USING btree (slug);


--
-- TOC entry 3363 (class 1259 OID 262927)
-- Name: uniq_e0167045e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_e0167045e15a06e ON hotel_sales_agent USING btree (unique_slug);


--
-- TOC entry 3364 (class 1259 OID 262928)
-- Name: uniq_e016704989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_e016704989d9b62 ON hotel_sales_agent USING btree (slug);


--
-- TOC entry 3646 (class 1259 OID 262929)
-- Name: uniq_e19d9ad262602fa7; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_e19d9ad262602fa7 ON service USING btree (cartitem);


--
-- TOC entry 3078 (class 1259 OID 262930)
-- Name: uniq_ec141ef85e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_ec141ef85e15a06e ON airline USING btree (unique_slug);


--
-- TOC entry 3079 (class 1259 OID 262931)
-- Name: uniq_ec141ef8989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_ec141ef8989d9b62 ON airline USING btree (slug);


--
-- TOC entry 3639 (class 1259 OID 262932)
-- Name: uniq_f0e45ba95e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_f0e45ba95e15a06e ON season USING btree (unique_slug);


--
-- TOC entry 3640 (class 1259 OID 262933)
-- Name: uniq_f0e45ba9989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_f0e45ba9989d9b62 ON season USING btree (slug);


--
-- TOC entry 3530 (class 1259 OID 262938)
-- Name: uniq_fc3eb7725e15a06e; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_fc3eb7725e15a06e ON rental_house USING btree (unique_slug);


--
-- TOC entry 3531 (class 1259 OID 262939)
-- Name: uniq_fc3eb772989d9b62; Type: INDEX; Schema: public; Owner: daiqui6_postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_fc3eb772989d9b62 ON rental_house USING btree (slug);


--
-- TOC entry 4048 (class 2606 OID 264747)
-- Name: fk_10dd72c23243bb18; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY review_hotel
    ADD CONSTRAINT fk_10dd72c23243bb18 FOREIGN KEY (hotel_id) REFERENCES hotel(id);


--
-- TOC entry 4049 (class 2606 OID 264778)
-- Name: fk_10dd72c2bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY review_hotel
    ADD CONSTRAINT fk_10dd72c2bf396750 FOREIGN KEY (id) REFERENCES review(id) ON DELETE CASCADE;


--
-- TOC entry 3835 (class 2606 OID 262940)
-- Name: fk_11667cd916db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY driver
    ADD CONSTRAINT fk_11667cd916db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3799 (class 2606 OID 262945)
-- Name: fk_1325f3a6bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit
    ADD CONSTRAINT fk_1325f3a6bf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3800 (class 2606 OID 264838)
-- Name: fk_1325f3a6ecb6bf02; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit
    ADD CONSTRAINT fk_1325f3a6ecb6bf02 FOREIGN KEY (polofromid) REFERENCES polo(id);


--
-- TOC entry 4061 (class 2606 OID 268278)
-- Name: fk_136ac11341714987; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY result
    ADD CONSTRAINT fk_136ac11341714987 FOREIGN KEY (dropoffplace_id) REFERENCES place(id) ON DELETE SET NULL;


--
-- TOC entry 4063 (class 2606 OID 268288)
-- Name: fk_136ac1134666d46c; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY result
    ADD CONSTRAINT fk_136ac1134666d46c FOREIGN KEY (obj) REFERENCES product(id) ON DELETE SET NULL;


--
-- TOC entry 4060 (class 2606 OID 268273)
-- Name: fk_136ac11357759bb4; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY result
    ADD CONSTRAINT fk_136ac11357759bb4 FOREIGN KEY (pickupplace) REFERENCES place(id) ON DELETE SET NULL;


--
-- TOC entry 4062 (class 2606 OID 268283)
-- Name: fk_136ac1136bac85cb; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY result
    ADD CONSTRAINT fk_136ac1136bac85cb FOREIGN KEY (market) REFERENCES market(id) ON DELETE SET NULL;


--
-- TOC entry 4064 (class 2606 OID 268293)
-- Name: fk_136ac113c257e60e; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY result
    ADD CONSTRAINT fk_136ac113c257e60e FOREIGN KEY (flight) REFERENCES flight(id) ON DELETE SET NULL;


--
-- TOC entry 4059 (class 2606 OID 268244)
-- Name: fk_136ac113c9f91e67; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY result
    ADD CONSTRAINT fk_136ac113c9f91e67 FOREIGN KEY (searcher_id) REFERENCES searcher(id);


--
-- TOC entry 4002 (class 2606 OID 262950)
-- Name: fk_171f088fa76ed395; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY searcher
    ADD CONSTRAINT fk_171f088fa76ed395 FOREIGN KEY (user_id) REFERENCES duser(id);


--
-- TOC entry 3827 (class 2606 OID 262955)
-- Name: fk_1787c0633243bb18; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY documents_hotels
    ADD CONSTRAINT fk_1787c0633243bb18 FOREIGN KEY (hotel_id) REFERENCES hotel(id) ON DELETE CASCADE;


--
-- TOC entry 3828 (class 2606 OID 262960)
-- Name: fk_1787c063c33f7837; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY documents_hotels
    ADD CONSTRAINT fk_1787c063c33f7837 FOREIGN KEY (document_id) REFERENCES document(id) ON DELETE CASCADE;


--
-- TOC entry 3975 (class 2606 OID 262965)
-- Name: fk_181edfe0984cadac; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_rental_house_room_facilities
    ADD CONSTRAINT fk_181edfe0984cadac FOREIGN KEY (rental_house_room_id) REFERENCES rental_house_room(id) ON DELETE CASCADE;


--
-- TOC entry 3976 (class 2606 OID 262970)
-- Name: fk_181edfe0985ce863; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_rental_house_room_facilities
    ADD CONSTRAINT fk_181edfe0985ce863 FOREIGN KEY (rental_house_room_facility_id) REFERENCES rental_house_room_facility(id) ON DELETE CASCADE;


--
-- TOC entry 3804 (class 2606 OID 268221)
-- Name: fk_1b042a031325f3a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_day
    ADD CONSTRAINT fk_1b042a031325f3a6 FOREIGN KEY (circuit) REFERENCES circuit(id);


--
-- TOC entry 3803 (class 2606 OID 268216)
-- Name: fk_1b042a0316db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_day
    ADD CONSTRAINT fk_1b042a0316db4f89 FOREIGN KEY (picture) REFERENCES media__media(id) ON DELETE SET NULL;


--
-- TOC entry 3805 (class 2606 OID 268226)
-- Name: fk_1b042a03472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_day
    ADD CONSTRAINT fk_1b042a03472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id) ON DELETE SET NULL;


--
-- TOC entry 3933 (class 2606 OID 262990)
-- Name: fk_1db5abff16db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY polo
    ADD CONSTRAINT fk_1db5abff16db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3934 (class 2606 OID 262995)
-- Name: fk_1db5abff472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY polo
    ADD CONSTRAINT fk_1db5abff472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3760 (class 2606 OID 263000)
-- Name: fk_1f1512dd16db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign
    ADD CONSTRAINT fk_1f1512dd16db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3761 (class 2606 OID 263005)
-- Name: fk_1f1512dd472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign
    ADD CONSTRAINT fk_1f1512dd472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3762 (class 2606 OID 263010)
-- Name: fk_1f1512dde9ed820c; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign
    ADD CONSTRAINT fk_1f1512dde9ed820c FOREIGN KEY (block_id) REFERENCES block(id);


--
-- TOC entry 3775 (class 2606 OID 263015)
-- Name: fk_2018ee1581f1026; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaigntransferexclisive_transfers
    ADD CONSTRAINT fk_2018ee1581f1026 FOREIGN KEY (campaign_transfer_exclusive_id) REFERENCES campaign_transfer_exclusive(id) ON DELETE CASCADE;


--
-- TOC entry 3776 (class 2606 OID 263020)
-- Name: fk_2018ee15b43e296d; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaigntransferexclisive_transfers
    ADD CONSTRAINT fk_2018ee15b43e296d FOREIGN KEY (transfer_exclusive_id) REFERENCES transfer_exclusive(id) ON DELETE CASCADE;


--
-- TOC entry 4010 (class 2606 OID 263025)
-- Name: fk_225d4664631066a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY suplement
    ADD CONSTRAINT fk_225d4664631066a6 FOREIGN KEY (hotelid) REFERENCES hotel(id);


--
-- TOC entry 3841 (class 2606 OID 263030)
-- Name: fk_22e0178f57759bb4; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_colective_item
    ADD CONSTRAINT fk_22e0178f57759bb4 FOREIGN KEY (pickupplace) REFERENCES place(id);


--
-- TOC entry 3842 (class 2606 OID 263035)
-- Name: fk_22e0178f9a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_colective_item
    ADD CONSTRAINT fk_22e0178f9a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 3843 (class 2606 OID 263040)
-- Name: fk_22e0178fabbf655d; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_colective_item
    ADD CONSTRAINT fk_22e0178fabbf655d FOREIGN KEY (dropoffplace) REFERENCES place(id);


--
-- TOC entry 3874 (class 2606 OID 263055)
-- Name: fk_291cec1d729f519b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel_price
    ADD CONSTRAINT fk_291cec1d729f519b FOREIGN KEY (room) REFERENCES room(id);


--
-- TOC entry 3875 (class 2606 OID 263060)
-- Name: fk_291cec1df0e45ba9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel_price
    ADD CONSTRAINT fk_291cec1df0e45ba9 FOREIGN KEY (season) REFERENCES season(id);


--
-- TOC entry 3905 (class 2606 OID 263065)
-- Name: fk_2e027caa682c9107; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher_rental_house_facility_type
    ADD CONSTRAINT fk_2e027caa682c9107 FOREIGN KEY (ocupation_searcher_id) REFERENCES ocupation_searcher(id);


--
-- TOC entry 3906 (class 2606 OID 263070)
-- Name: fk_2e027caa79cf033f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher_rental_house_facility_type
    ADD CONSTRAINT fk_2e027caa79cf033f FOREIGN KEY (hotel_facility_id) REFERENCES rental_house_facility_type(id);


--
-- TOC entry 3840 (class 2606 OID 263075)
-- Name: fk_34c00eefbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_colective
    ADD CONSTRAINT fk_34c00eefbf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3863 (class 2606 OID 263080)
-- Name: fk_3535ed9190d5293; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel
    ADD CONSTRAINT fk_3535ed9190d5293 FOREIGN KEY (hoteltype) REFERENCES hotel_type(id);


--
-- TOC entry 3864 (class 2606 OID 263085)
-- Name: fk_3535ed93b28f0c3; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel
    ADD CONSTRAINT fk_3535ed93b28f0c3 FOREIGN KEY (product_increment) REFERENCES product_increment(id);


--
-- TOC entry 3865 (class 2606 OID 263090)
-- Name: fk_3535ed96b1f932d; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel
    ADD CONSTRAINT fk_3535ed96b1f932d FOREIGN KEY (cancelation_hotel) REFERENCES cancelation_product(id);


--
-- TOC entry 3866 (class 2606 OID 263095)
-- Name: fk_3535ed99d4071c0; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel
    ADD CONSTRAINT fk_3535ed99d4071c0 FOREIGN KEY (chainid) REFERENCES chain(id);


--
-- TOC entry 3867 (class 2606 OID 263100)
-- Name: fk_3535ed9a0ebc007; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel
    ADD CONSTRAINT fk_3535ed9a0ebc007 FOREIGN KEY (zone) REFERENCES zone(id);


--
-- TOC entry 3868 (class 2606 OID 263105)
-- Name: fk_3535ed9a8f321d6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel
    ADD CONSTRAINT fk_3535ed9a8f321d6 FOREIGN KEY (term_condition_hotel) REFERENCES term_condition_product(id);


--
-- TOC entry 3869 (class 2606 OID 263110)
-- Name: fk_3535ed9bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel
    ADD CONSTRAINT fk_3535ed9bf396750 FOREIGN KEY (id) REFERENCES place(id) ON DELETE CASCADE;


--
-- TOC entry 3836 (class 2606 OID 263115)
-- Name: fk_380e656fc3423909; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY drivers_cars
    ADD CONSTRAINT fk_380e656fc3423909 FOREIGN KEY (driver_id) REFERENCES driver(id) ON DELETE CASCADE;


--
-- TOC entry 3837 (class 2606 OID 263120)
-- Name: fk_380e656fc3c6f69f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY drivers_cars
    ADD CONSTRAINT fk_380e656fc3c6f69f FOREIGN KEY (car_id) REFERENCES car(id) ON DELETE CASCADE;


--
-- TOC entry 3848 (class 2606 OID 263125)
-- Name: fk_38bfd5cf1dd011e1; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_excursion_types
    ADD CONSTRAINT fk_38bfd5cf1dd011e1 FOREIGN KEY (excursion_type_id) REFERENCES excursion_type(id) ON DELETE CASCADE;


--
-- TOC entry 3849 (class 2606 OID 263130)
-- Name: fk_38bfd5cf4ab4296f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_excursion_types
    ADD CONSTRAINT fk_38bfd5cf4ab4296f FOREIGN KEY (excursion_id) REFERENCES excursion(id) ON DELETE CASCADE;


--
-- TOC entry 3916 (class 2606 OID 263135)
-- Name: fk_3ace959b57759bb4; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_option_item
    ADD CONSTRAINT fk_3ace959b57759bb4 FOREIGN KEY (pickupplace) REFERENCES place(id);


--
-- TOC entry 3917 (class 2606 OID 263140)
-- Name: fk_3ace959b9a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_option_item
    ADD CONSTRAINT fk_3ace959b9a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 3781 (class 2606 OID 263145)
-- Name: fk_3aecfbeb5ad4dd20; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_availabilitys_car
    ADD CONSTRAINT fk_3aecfbeb5ad4dd20 FOREIGN KEY (car_availability_id) REFERENCES car_availability(id) ON DELETE CASCADE;


--
-- TOC entry 3782 (class 2606 OID 263150)
-- Name: fk_3aecfbebc3c6f69f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_availabilitys_car
    ADD CONSTRAINT fk_3aecfbebc3c6f69f FOREIGN KEY (car_id) REFERENCES car(id) ON DELETE CASCADE;


--
-- TOC entry 3991 (class 2606 OID 263155)
-- Name: fk_3b978f9fc7470a42; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY request
    ADD CONSTRAINT fk_3b978f9fc7470a42 FOREIGN KEY (gender) REFERENCES gender(id);


--
-- TOC entry 3964 (class 2606 OID 263160)
-- Name: fk_3bf1e1215bd15c26; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_rental_house_type
    ADD CONSTRAINT fk_3bf1e1215bd15c26 FOREIGN KEY (rental_house_id) REFERENCES rental_house(id) ON DELETE CASCADE;


--
-- TOC entry 3965 (class 2606 OID 263165)
-- Name: fk_3bf1e12191751ac; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_rental_house_type
    ADD CONSTRAINT fk_3bf1e12191751ac FOREIGN KEY (rental_house_type_id) REFERENCES rental_house_type(id) ON DELETE CASCADE;


--
-- TOC entry 4039 (class 2606 OID 264497)
-- Name: fk_3c5ec0014ab4296f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_excursion_colective
    ADD CONSTRAINT fk_3c5ec0014ab4296f FOREIGN KEY (excursion_id) REFERENCES excursion_colective(id);


--
-- TOC entry 4040 (class 2606 OID 264502)
-- Name: fk_3c5ec001bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_excursion_colective
    ADD CONSTRAINT fk_3c5ec001bf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3907 (class 2606 OID 263170)
-- Name: fk_3ecc2507682c9107; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher_rental_house_room_facility
    ADD CONSTRAINT fk_3ecc2507682c9107 FOREIGN KEY (ocupation_searcher_id) REFERENCES ocupation_searcher(id);


--
-- TOC entry 3908 (class 2606 OID 263175)
-- Name: fk_3ecc2507985ce863; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher_rental_house_room_facility
    ADD CONSTRAINT fk_3ecc2507985ce863 FOREIGN KEY (rental_house_room_facility_id) REFERENCES rental_house_room_facility(id);


--
-- TOC entry 4011 (class 2606 OID 263180)
-- Name: fk_4034a3c05bb10f94; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer
    ADD CONSTRAINT fk_4034a3c05bb10f94 FOREIGN KEY (placeto) REFERENCES place(id);


--
-- TOC entry 4012 (class 2606 OID 263185)
-- Name: fk_4034a3c0bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer
    ADD CONSTRAINT fk_4034a3c0bf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 4013 (class 2606 OID 263190)
-- Name: fk_4034a3c0fbc3de7b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer
    ADD CONSTRAINT fk_4034a3c0fbc3de7b FOREIGN KEY (placefrom) REFERENCES place(id);


--
-- TOC entry 3816 (class 2606 OID 263195)
-- Name: fk_43629b36727aca70; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY classification__category
    ADD CONSTRAINT fk_43629b36727aca70 FOREIGN KEY (parent_id) REFERENCES classification__category(id) ON DELETE CASCADE;


--
-- TOC entry 3817 (class 2606 OID 263200)
-- Name: fk_43629b36e25d857e; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY classification__category
    ADD CONSTRAINT fk_43629b36e25d857e FOREIGN KEY (context) REFERENCES classification__context(id);


--
-- TOC entry 3818 (class 2606 OID 263205)
-- Name: fk_43629b36ea9fdd75; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY classification__category
    ADD CONSTRAINT fk_43629b36ea9fdd75 FOREIGN KEY (media_id) REFERENCES media__media(id) ON DELETE SET NULL;


--
-- TOC entry 3988 (class 2606 OID 263235)
-- Name: fk_44b0849516db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_type
    ADD CONSTRAINT fk_44b0849516db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3751 (class 2606 OID 263240)
-- Name: fk_46c8b8063d9ab4a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_entries
    ADD CONSTRAINT fk_46c8b8063d9ab4a6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3752 (class 2606 OID 263245)
-- Name: fk_46c8b806df9183c9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_entries
    ADD CONSTRAINT fk_46c8b806df9183c9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3753 (class 2606 OID 263250)
-- Name: fk_46c8b806ea000b10; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_entries
    ADD CONSTRAINT fk_46c8b806ea000b10 FOREIGN KEY (class_id) REFERENCES acl_classes(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4052 (class 2606 OID 264768)
-- Name: fk_48a4b05a4584665a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY review_product
    ADD CONSTRAINT fk_48a4b05a4584665a FOREIGN KEY (product_id) REFERENCES product(id);


--
-- TOC entry 4053 (class 2606 OID 264773)
-- Name: fk_48a4b05abf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY review_product
    ADD CONSTRAINT fk_48a4b05abf396750 FOREIGN KEY (id) REFERENCES review(id) ON DELETE CASCADE;


--
-- TOC entry 3948 (class 2606 OID 263255)
-- Name: fk_4adad40b16db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY province
    ADD CONSTRAINT fk_4adad40b16db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3949 (class 2606 OID 263260)
-- Name: fk_4adad40b472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY province
    ADD CONSTRAINT fk_4adad40b472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3950 (class 2606 OID 263265)
-- Name: fk_4adad40b5373c966; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY province
    ADD CONSTRAINT fk_4adad40b5373c966 FOREIGN KEY (country) REFERENCES country(id);


--
-- TOC entry 3763 (class 2606 OID 263270)
-- Name: fk_4b7702dcbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_car
    ADD CONSTRAINT fk_4b7702dcbf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3764 (class 2606 OID 263275)
-- Name: fk_4b7702dcc3c6f69f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_car
    ADD CONSTRAINT fk_4b7702dcc3c6f69f FOREIGN KEY (car_id) REFERENCES car(id);


--
-- TOC entry 3823 (class 2606 OID 263280)
-- Name: fk_4c62e638ddf06fb0; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY contact
    ADD CONSTRAINT fk_4c62e638ddf06fb0 FOREIGN KEY (contact_cause) REFERENCES contact_cause(id);


--
-- TOC entry 4046 (class 2606 OID 264598)
-- Name: fk_4d563ab654177093; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_hotel
    ADD CONSTRAINT fk_4d563ab654177093 FOREIGN KEY (room_id) REFERENCES room(id);


--
-- TOC entry 4047 (class 2606 OID 264603)
-- Name: fk_4d563ab6bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_hotel
    ADD CONSTRAINT fk_4d563ab6bf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3870 (class 2606 OID 263295)
-- Name: fk_523846c016db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel_facility
    ADD CONSTRAINT fk_523846c016db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3871 (class 2606 OID 263300)
-- Name: fk_523846c0472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel_facility
    ADD CONSTRAINT fk_523846c0472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3872 (class 2606 OID 263305)
-- Name: fk_523846c0631066a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel_facility
    ADD CONSTRAINT fk_523846c0631066a6 FOREIGN KEY (hotelid) REFERENCES hotel(id);


--
-- TOC entry 3873 (class 2606 OID 263310)
-- Name: fk_523846c086968de; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel_facility
    ADD CONSTRAINT fk_523846c086968de FOREIGN KEY (hotelfacilitytype_id) REFERENCES rental_house_facility_type(id);


--
-- TOC entry 3824 (class 2606 OID 263315)
-- Name: fk_5373c96616db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY country
    ADD CONSTRAINT fk_5373c96616db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3825 (class 2606 OID 263320)
-- Name: fk_5373c966472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY country
    ADD CONSTRAINT fk_5373c966472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3826 (class 2606 OID 263325)
-- Name: fk_5373c966622f3f37; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY country
    ADD CONSTRAINT fk_5373c966622f3f37 FOREIGN KEY (market_id) REFERENCES market(id);


--
-- TOC entry 3845 (class 2606 OID 263330)
-- Name: fk_545ec12957759bb4; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_exclusive_item
    ADD CONSTRAINT fk_545ec12957759bb4 FOREIGN KEY (pickupplace) REFERENCES place(id);


--
-- TOC entry 3846 (class 2606 OID 263335)
-- Name: fk_545ec1299a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_exclusive_item
    ADD CONSTRAINT fk_545ec1299a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 3847 (class 2606 OID 263340)
-- Name: fk_545ec129abbf655d; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_exclusive_item
    ADD CONSTRAINT fk_545ec129abbf655d FOREIGN KEY (dropoffplace) REFERENCES place(id);


--
-- TOC entry 3931 (class 2606 OID 263345)
-- Name: fk_54d14232da6a219; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY place_type_place
    ADD CONSTRAINT fk_54d14232da6a219 FOREIGN KEY (place_id) REFERENCES place(id) ON DELETE CASCADE;


--
-- TOC entry 3932 (class 2606 OID 263350)
-- Name: fk_54d14232f1809b68; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY place_type_place
    ADD CONSTRAINT fk_54d14232f1809b68 FOREIGN KEY (place_type_id) REFERENCES place_type(id) ON DELETE CASCADE;


--
-- TOC entry 3885 (class 2606 OID 263375)
-- Name: fk_5c6dd74e12469de2; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY media__media
    ADD CONSTRAINT fk_5c6dd74e12469de2 FOREIGN KEY (category_id) REFERENCES classification__category(id) ON DELETE SET NULL;


--
-- TOC entry 3772 (class 2606 OID 263380)
-- Name: fk_5f56e2dabf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_transfer_exclusive
    ADD CONSTRAINT fk_5f56e2dabf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3914 (class 2606 OID 263385)
-- Name: fk_647d736cbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_option
    ADD CONSTRAINT fk_647d736cbf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3915 (class 2606 OID 263390)
-- Name: fk_647d736cf5cee5; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_option
    ADD CONSTRAINT fk_647d736cf5cee5 FOREIGN KEY (id_package) REFERENCES package(id);


--
-- TOC entry 3808 (class 2606 OID 263395)
-- Name: fk_64ad97a1325f3a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_request
    ADD CONSTRAINT fk_64ad97a1325f3a6 FOREIGN KEY (circuit) REFERENCES circuit(id) ON DELETE CASCADE;


--
-- TOC entry 3809 (class 2606 OID 263400)
-- Name: fk_64ad97abf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_request
    ADD CONSTRAINT fk_64ad97abf396750 FOREIGN KEY (id) REFERENCES request(id) ON DELETE CASCADE;


--
-- TOC entry 3786 (class 2606 OID 263405)
-- Name: fk_683c744316cc45c9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_request
    ADD CONSTRAINT fk_683c744316cc45c9 FOREIGN KEY (pickupplace_id) REFERENCES place(id);


--
-- TOC entry 3787 (class 2606 OID 263410)
-- Name: fk_683c744341714987; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_request
    ADD CONSTRAINT fk_683c744341714987 FOREIGN KEY (dropoffplace_id) REFERENCES place(id);


--
-- TOC entry 3788 (class 2606 OID 263415)
-- Name: fk_683c7443bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_request
    ADD CONSTRAINT fk_683c7443bf396750 FOREIGN KEY (id) REFERENCES request(id) ON DELETE CASCADE;


--
-- TOC entry 3789 (class 2606 OID 263420)
-- Name: fk_683c7443de686795; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_request
    ADD CONSTRAINT fk_683c7443de686795 FOREIGN KEY (package) REFERENCES car(id) ON DELETE SET NULL;


--
-- TOC entry 3773 (class 2606 OID 263425)
-- Name: fk_6b7259a742348f7a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaigntransfercolective_transfers
    ADD CONSTRAINT fk_6b7259a742348f7a FOREIGN KEY (campaign_transfer_colective_id) REFERENCES campaign_transfer_colective(id) ON DELETE CASCADE;


--
-- TOC entry 3774 (class 2606 OID 263430)
-- Name: fk_6b7259a7fe15b631; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaigntransfercolective_transfers
    ADD CONSTRAINT fk_6b7259a7fe15b631 FOREIGN KEY (transfer_colective_id) REFERENCES transfer_colective(id) ON DELETE CASCADE;


--
-- TOC entry 3925 (class 2606 OID 263435)
-- Name: fk_6d28840d19eb6921; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY payment
    ADD CONSTRAINT fk_6d28840d19eb6921 FOREIGN KEY (client_id) REFERENCES duser(id);


--
-- TOC entry 3926 (class 2606 OID 263440)
-- Name: fk_6d28840dd677b63c; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY payment
    ADD CONSTRAINT fk_6d28840dd677b63c FOREIGN KEY (curency) REFERENCES currency(id);


--
-- TOC entry 3895 (class 2606 OID 263445)
-- Name: fk_6dd2e6a63535ed9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_item
    ADD CONSTRAINT fk_6dd2e6a63535ed9 FOREIGN KEY (hotel) REFERENCES hotel(id);


--
-- TOC entry 3896 (class 2606 OID 263450)
-- Name: fk_6dd2e6a6729f519b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_item
    ADD CONSTRAINT fk_6dd2e6a6729f519b FOREIGN KEY (room) REFERENCES room(id);


--
-- TOC entry 3897 (class 2606 OID 263455)
-- Name: fk_6dd2e6a69a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_item
    ADD CONSTRAINT fk_6dd2e6a69a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 3833 (class 2606 OID 263460)
-- Name: fk_6f2077c75bd15c26; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY documents_rentalhouse
    ADD CONSTRAINT fk_6f2077c75bd15c26 FOREIGN KEY (rental_house_id) REFERENCES rental_house(id) ON DELETE CASCADE;


--
-- TOC entry 3834 (class 2606 OID 263465)
-- Name: fk_6f2077c7c33f7837; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY documents_rentalhouse
    ADD CONSTRAINT fk_6f2077c7c33f7837 FOREIGN KEY (document_id) REFERENCES document(id) ON DELETE CASCADE;


--
-- TOC entry 3993 (class 2606 OID 263470)
-- Name: fk_729f519b16db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY room
    ADD CONSTRAINT fk_729f519b16db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3994 (class 2606 OID 263475)
-- Name: fk_729f519b472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY room
    ADD CONSTRAINT fk_729f519b472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3995 (class 2606 OID 263480)
-- Name: fk_729f519b631066a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY room
    ADD CONSTRAINT fk_729f519b631066a6 FOREIGN KEY (hotelid) REFERENCES hotel(id);


--
-- TOC entry 3927 (class 2606 OID 263485)
-- Name: fk_741d53cd16db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY place
    ADD CONSTRAINT fk_741d53cd16db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3928 (class 2606 OID 263490)
-- Name: fk_741d53cd1db5abff; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY place
    ADD CONSTRAINT fk_741d53cd1db5abff FOREIGN KEY (polo) REFERENCES polo(id);


--
-- TOC entry 3929 (class 2606 OID 263495)
-- Name: fk_741d53cd472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY place
    ADD CONSTRAINT fk_741d53cd472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3930 (class 2606 OID 263500)
-- Name: fk_741d53cd4adad40b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY place
    ADD CONSTRAINT fk_741d53cd4adad40b FOREIGN KEY (province) REFERENCES province(id);


--
-- TOC entry 3881 (class 2606 OID 263505)
-- Name: fk_76218fe7622f3f37; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY market_campaigns
    ADD CONSTRAINT fk_76218fe7622f3f37 FOREIGN KEY (market_id) REFERENCES market(id) ON DELETE CASCADE;


--
-- TOC entry 3882 (class 2606 OID 263510)
-- Name: fk_76218fe7f639f774; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY market_campaigns
    ADD CONSTRAINT fk_76218fe7f639f774 FOREIGN KEY (campaign_id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3769 (class 2606 OID 263515)
-- Name: fk_76d2fbb9bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_package
    ADD CONSTRAINT fk_76d2fbb9bf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3770 (class 2606 OID 264480)
-- Name: fk_76d2fbb9f44cabff; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_package
    ADD CONSTRAINT fk_76d2fbb9f44cabff FOREIGN KEY (package_id) REFERENCES package_option(id);


--
-- TOC entry 3806 (class 2606 OID 263525)
-- Name: fk_76e343e357759bb4; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_item
    ADD CONSTRAINT fk_76e343e357759bb4 FOREIGN KEY (pickupplace) REFERENCES place(id);


--
-- TOC entry 3807 (class 2606 OID 263530)
-- Name: fk_76e343e39a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_item
    ADD CONSTRAINT fk_76e343e39a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 3777 (class 2606 OID 263535)
-- Name: fk_773de69d32e09c48; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car
    ADD CONSTRAINT fk_773de69d32e09c48 FOREIGN KEY (car_class) REFERENCES car_class(id);


--
-- TOC entry 3778 (class 2606 OID 263540)
-- Name: fk_773de69d897a2cc5; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car
    ADD CONSTRAINT fk_773de69d897a2cc5 FOREIGN KEY (car_category) REFERENCES car_category(id);


--
-- TOC entry 3779 (class 2606 OID 263545)
-- Name: fk_773de69dbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car
    ADD CONSTRAINT fk_773de69dbf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3780 (class 2606 OID 263550)
-- Name: fk_773de69dc2e0437c; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car
    ADD CONSTRAINT fk_773de69dc2e0437c FOREIGN KEY (car_luggage_capacity) REFERENCES luggage_capacity(id);


--
-- TOC entry 3992 (class 2606 OID 264686)
-- Name: fk_794381c6a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY review
    ADD CONSTRAINT fk_794381c6a76ed395 FOREIGN KEY (user_id) REFERENCES duser(id);


--
-- TOC entry 3888 (class 2606 OID 263560)
-- Name: fk_7d956f5173f0cafe; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY medical_request
    ADD CONSTRAINT fk_7d956f5173f0cafe FOREIGN KEY (medicalservice) REFERENCES medical_service(id) ON DELETE CASCADE;


--
-- TOC entry 3889 (class 2606 OID 263565)
-- Name: fk_7d956f51bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY medical_request
    ADD CONSTRAINT fk_7d956f51bf396750 FOREIGN KEY (id) REFERENCES request(id) ON DELETE CASCADE;


--
-- TOC entry 3759 (class 2606 OID 263570)
-- Name: fk_7e91f7c2bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY airport
    ADD CONSTRAINT fk_7e91f7c2bf396750 FOREIGN KEY (id) REFERENCES place(id) ON DELETE CASCADE;


--
-- TOC entry 3822 (class 2606 OID 263575)
-- Name: fk_7fa3719bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY configuration_pam
    ADD CONSTRAINT fk_7fa3719bf396750 FOREIGN KEY (id) REFERENCES configuration_tpv(id) ON DELETE CASCADE;


--
-- TOC entry 3935 (class 2606 OID 263580)
-- Name: fk_800943862e21d3e1; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY polos_provinces
    ADD CONSTRAINT fk_800943862e21d3e1 FOREIGN KEY (polo_id) REFERENCES polo(id) ON DELETE CASCADE;


--
-- TOC entry 3936 (class 2606 OID 263585)
-- Name: fk_80094386e946114a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY polos_provinces
    ADD CONSTRAINT fk_80094386e946114a FOREIGN KEY (province_id) REFERENCES province(id) ON DELETE CASCADE;


--
-- TOC entry 3883 (class 2606 OID 263590)
-- Name: fk_80d4c5414e7af8f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY media__gallery_media
    ADD CONSTRAINT fk_80d4c5414e7af8f FOREIGN KEY (gallery_id) REFERENCES media__gallery(id);


--
-- TOC entry 3884 (class 2606 OID 263595)
-- Name: fk_80d4c541ea9fdd75; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY media__gallery_media
    ADD CONSTRAINT fk_80d4c541ea9fdd75 FOREIGN KEY (media_id) REFERENCES media__media(id);


--
-- TOC entry 3755 (class 2606 OID 263600)
-- Name: fk_825de2993d9ab4a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_object_identity_ancestors
    ADD CONSTRAINT fk_825de2993d9ab4a6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3756 (class 2606 OID 263605)
-- Name: fk_825de299c671cea1; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_object_identity_ancestors
    ADD CONSTRAINT fk_825de299c671cea1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3996 (class 2606 OID 263610)
-- Name: fk_89c5ba2c729f519b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY room_availability
    ADD CONSTRAINT fk_89c5ba2c729f519b FOREIGN KEY (room) REFERENCES room(id);


--
-- TOC entry 3997 (class 2606 OID 263615)
-- Name: fk_8dcc52df54177093; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY room_facilities_rooms
    ADD CONSTRAINT fk_8dcc52df54177093 FOREIGN KEY (room_id) REFERENCES room(id) ON DELETE CASCADE;


--
-- TOC entry 3998 (class 2606 OID 263620)
-- Name: fk_8dcc52df985ce863; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY room_facilities_rooms
    ADD CONSTRAINT fk_8dcc52df985ce863 FOREIGN KEY (rental_house_room_facility_id) REFERENCES rental_house_room_facility(id) ON DELETE CASCADE;


--
-- TOC entry 4015 (class 2606 OID 263625)
-- Name: fk_9229dc9657759bb4; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_colective_item
    ADD CONSTRAINT fk_9229dc9657759bb4 FOREIGN KEY (pickupplace) REFERENCES place(id);


--
-- TOC entry 4016 (class 2606 OID 263630)
-- Name: fk_9229dc969a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_colective_item
    ADD CONSTRAINT fk_9229dc969a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 4017 (class 2606 OID 263635)
-- Name: fk_9229dc96abbf655d; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_colective_item
    ADD CONSTRAINT fk_9229dc96abbf655d FOREIGN KEY (dropoffplace) REFERENCES place(id);


--
-- TOC entry 4018 (class 2606 OID 263640)
-- Name: fk_9229dc96c257e60e; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_colective_item
    ADD CONSTRAINT fk_9229dc96c257e60e FOREIGN KEY (flight) REFERENCES flight(id);


--
-- TOC entry 3844 (class 2606 OID 263645)
-- Name: fk_929434edbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_exclusive
    ADD CONSTRAINT fk_929434edbf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3946 (class 2606 OID 263650)
-- Name: fk_92c4739c16db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY provider
    ADD CONSTRAINT fk_92c4739c16db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3947 (class 2606 OID 263655)
-- Name: fk_92c4739c472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY provider
    ADD CONSTRAINT fk_92c4739c472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3754 (class 2606 OID 263660)
-- Name: fk_9407e54977fa751a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY acl_object_identities
    ADD CONSTRAINT fk_9407e54977fa751a FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities(id);


--
-- TOC entry 3790 (class 2606 OID 263675)
-- Name: fk_98293d8b57759bb4; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_searcher
    ADD CONSTRAINT fk_98293d8b57759bb4 FOREIGN KEY (pickupplace) REFERENCES place(id) ON DELETE SET NULL;


--
-- TOC entry 3791 (class 2606 OID 263680)
-- Name: fk_98293d8b773de69d; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_searcher
    ADD CONSTRAINT fk_98293d8b773de69d FOREIGN KEY (car) REFERENCES car(id) ON DELETE SET NULL;


--
-- TOC entry 3792 (class 2606 OID 263685)
-- Name: fk_98293d8babbf655d; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_searcher
    ADD CONSTRAINT fk_98293d8babbf655d FOREIGN KEY (dropoffplace) REFERENCES place(id) ON DELETE SET NULL;


--
-- TOC entry 3793 (class 2606 OID 263690)
-- Name: fk_98293d8bbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_searcher
    ADD CONSTRAINT fk_98293d8bbf396750 FOREIGN KEY (id) REFERENCES searcher(id) ON DELETE CASCADE;


--
-- TOC entry 4041 (class 2606 OID 264507)
-- Name: fk_9a0afa034ab4296f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_excursion_exclusive
    ADD CONSTRAINT fk_9a0afa034ab4296f FOREIGN KEY (excursion_id) REFERENCES excursion_exclusive(id);


--
-- TOC entry 4042 (class 2606 OID 264512)
-- Name: fk_9a0afa03bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_excursion_exclusive
    ADD CONSTRAINT fk_9a0afa03bf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3838 (class 2606 OID 263705)
-- Name: fk_9b08e72f48862324; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion
    ADD CONSTRAINT fk_9b08e72f48862324 FOREIGN KEY (polofrom) REFERENCES polo(id);


--
-- TOC entry 3839 (class 2606 OID 263715)
-- Name: fk_9b08e72fbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion
    ADD CONSTRAINT fk_9b08e72fbf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 4036 (class 2606 OID 263720)
-- Name: fk_a0ebc00716db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY zone
    ADD CONSTRAINT fk_a0ebc00716db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 4037 (class 2606 OID 263725)
-- Name: fk_a0ebc007472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY zone
    ADD CONSTRAINT fk_a0ebc007472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 4038 (class 2606 OID 263730)
-- Name: fk_a0ebc0074adad40b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY zone
    ADD CONSTRAINT fk_a0ebc0074adad40b FOREIGN KEY (province) REFERENCES province(id);


--
-- TOC entry 4043 (class 2606 OID 264529)
-- Name: fk_a18e664cbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_rental_house
    ADD CONSTRAINT fk_a18e664cbf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3819 (class 2606 OID 263735)
-- Name: fk_a406b56ae25d857e; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY classification__collection
    ADD CONSTRAINT fk_a406b56ae25d857e FOREIGN KEY (context) REFERENCES classification__context(id);


--
-- TOC entry 3820 (class 2606 OID 263740)
-- Name: fk_a406b56aea9fdd75; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY classification__collection
    ADD CONSTRAINT fk_a406b56aea9fdd75 FOREIGN KEY (media_id) REFERENCES media__media(id) ON DELETE SET NULL;


--
-- TOC entry 4051 (class 2606 OID 264783)
-- Name: fk_a5f34c89bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY review_rental_house
    ADD CONSTRAINT fk_a5f34c89bf396750 FOREIGN KEY (id) REFERENCES review(id) ON DELETE CASCADE;


--
-- TOC entry 4050 (class 2606 OID 264757)
-- Name: fk_a5f34c89cc197e87; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY review_rental_house
    ADD CONSTRAINT fk_a5f34c89cc197e87 FOREIGN KEY (rentalhouse_id) REFERENCES rental_house(id);


--
-- TOC entry 4054 (class 2606 OID 264811)
-- Name: fk_a6d96c834ab4296f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_place
    ADD CONSTRAINT fk_a6d96c834ab4296f FOREIGN KEY (excursion_id) REFERENCES excursion(id) ON DELETE CASCADE;


--
-- TOC entry 4055 (class 2606 OID 264816)
-- Name: fk_a6d96c83da6a219; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_place
    ADD CONSTRAINT fk_a6d96c83da6a219 FOREIGN KEY (place_id) REFERENCES place(id) ON DELETE CASCADE;


--
-- TOC entry 3957 (class 2606 OID 263745)
-- Name: fk_a6f3e25216db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_facility
    ADD CONSTRAINT fk_a6f3e25216db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3958 (class 2606 OID 263750)
-- Name: fk_a6f3e25236defb08; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_facility
    ADD CONSTRAINT fk_a6f3e25236defb08 FOREIGN KEY (rentalhousefacilitytype_id) REFERENCES rental_house_facility_type(id);


--
-- TOC entry 3959 (class 2606 OID 263755)
-- Name: fk_a6f3e252472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_facility
    ADD CONSTRAINT fk_a6f3e252472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3960 (class 2606 OID 263760)
-- Name: fk_a6f3e252fc3eb772; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_facility
    ADD CONSTRAINT fk_a6f3e252fc3eb772 FOREIGN KEY (rental_house) REFERENCES rental_house(id);


--
-- TOC entry 3890 (class 2606 OID 263765)
-- Name: fk_a79f7a1cbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY medical_service
    ADD CONSTRAINT fk_a79f7a1cbf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3891 (class 2606 OID 263770)
-- Name: fk_a79f7a1cd4ef974a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY medical_service
    ADD CONSTRAINT fk_a79f7a1cd4ef974a FOREIGN KEY (medical_program) REFERENCES medical_program(id);


--
-- TOC entry 3852 (class 2606 OID 263775)
-- Name: fk_a9cc84021db5abff; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_searcher
    ADD CONSTRAINT fk_a9cc84021db5abff FOREIGN KEY (polo) REFERENCES polo(id) ON DELETE SET NULL;


--
-- TOC entry 3853 (class 2606 OID 263780)
-- Name: fk_a9cc840248862324; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_searcher
    ADD CONSTRAINT fk_a9cc840248862324 FOREIGN KEY (polofrom) REFERENCES polo(id) ON DELETE SET NULL;


--
-- TOC entry 3854 (class 2606 OID 263790)
-- Name: fk_a9cc84029b08e72f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_searcher
    ADD CONSTRAINT fk_a9cc84029b08e72f FOREIGN KEY (excursion) REFERENCES excursion(id) ON DELETE SET NULL;


--
-- TOC entry 3855 (class 2606 OID 263795)
-- Name: fk_a9cc8402bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_searcher
    ADD CONSTRAINT fk_a9cc8402bf396750 FOREIGN KEY (id) REFERENCES searcher(id) ON DELETE CASCADE;


--
-- TOC entry 3986 (class 2606 OID 263800)
-- Name: fk_aa192ae6985ce863; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_searcher_rental_house_room_facility
    ADD CONSTRAINT fk_aa192ae6985ce863 FOREIGN KEY (rental_house_room_facility_id) REFERENCES rental_house_room_facility(id);


--
-- TOC entry 3987 (class 2606 OID 263805)
-- Name: fk_aa192ae6f6a4bf14; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_searcher_rental_house_room_facility
    ADD CONSTRAINT fk_aa192ae6f6a4bf14 FOREIGN KEY (rental_house_room_searcher_id) REFERENCES rental_house_room_searcher(id);


--
-- TOC entry 4008 (class 2606 OID 263810)
-- Name: fk_abd861ddc7470a42; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY service_pax
    ADD CONSTRAINT fk_abd861ddc7470a42 FOREIGN KEY (gender) REFERENCES gender(id);


--
-- TOC entry 4009 (class 2606 OID 263815)
-- Name: fk_abd861dde19d9ad2; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY service_pax
    ADD CONSTRAINT fk_abd861dde19d9ad2 FOREIGN KEY (service) REFERENCES service(id);


--
-- TOC entry 3918 (class 2606 OID 263820)
-- Name: fk_abe637322e21d3e1; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_option_polos
    ADD CONSTRAINT fk_abe637322e21d3e1 FOREIGN KEY (polo_id) REFERENCES polo(id) ON DELETE CASCADE;


--
-- TOC entry 3919 (class 2606 OID 263825)
-- Name: fk_abe63732d2ad0a4; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_option_polos
    ADD CONSTRAINT fk_abe63732d2ad0a4 FOREIGN KEY (package_option_id) REFERENCES package_option(id) ON DELETE CASCADE;


--
-- TOC entry 4022 (class 2606 OID 263830)
-- Name: fk_aca52197bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_exclusive
    ADD CONSTRAINT fk_aca52197bf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 4014 (class 2606 OID 263835)
-- Name: fk_af11b95bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_colective
    ADD CONSTRAINT fk_af11b95bf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3795 (class 2606 OID 263840)
-- Name: fk_b10218ca16db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY chain
    ADD CONSTRAINT fk_b10218ca16db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3796 (class 2606 OID 263845)
-- Name: fk_b10218ca472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY chain
    ADD CONSTRAINT fk_b10218ca472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3861 (class 2606 OID 263850)
-- Name: fk_b3c77447a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447a76ed395 FOREIGN KEY (user_id) REFERENCES duser(id) ON DELETE CASCADE;


--
-- TOC entry 3862 (class 2606 OID 263855)
-- Name: fk_b3c77447fe54d947; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447fe54d947 FOREIGN KEY (group_id) REFERENCES fos_user_group(id) ON DELETE CASCADE;


--
-- TOC entry 3797 (class 2606 OID 263860)
-- Name: fk_b45d93a09a9812fd; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuirsearcher_place
    ADD CONSTRAINT fk_b45d93a09a9812fd FOREIGN KEY (id_place) REFERENCES place(id);


--
-- TOC entry 3798 (class 2606 OID 263865)
-- Name: fk_b45d93a0b7d47c9f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuirsearcher_place
    ADD CONSTRAINT fk_b45d93a0b7d47c9f FOREIGN KEY (id_circuitsearcher) REFERENCES circuit_searcher(id);


--
-- TOC entry 3922 (class 2606 OID 263870)
-- Name: fk_b4ccea1345baebcb; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_request
    ADD CONSTRAINT fk_b4ccea1345baebcb FOREIGN KEY (packageoption) REFERENCES package_option(id);


--
-- TOC entry 3923 (class 2606 OID 263875)
-- Name: fk_b4ccea13bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_request
    ADD CONSTRAINT fk_b4ccea13bf396750 FOREIGN KEY (id) REFERENCES request(id) ON DELETE CASCADE;


--
-- TOC entry 3924 (class 2606 OID 263880)
-- Name: fk_b4ccea13de686795; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_request
    ADD CONSTRAINT fk_b4ccea13de686795 FOREIGN KEY (package) REFERENCES package(id) ON DELETE CASCADE;


--
-- TOC entry 3979 (class 2606 OID 263895)
-- Name: fk_b709215c1db5abff; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_searcher
    ADD CONSTRAINT fk_b709215c1db5abff FOREIGN KEY (polo) REFERENCES polo(id) ON DELETE SET NULL;


--
-- TOC entry 3980 (class 2606 OID 263900)
-- Name: fk_b709215c27302f0f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_searcher
    ADD CONSTRAINT fk_b709215c27302f0f FOREIGN KEY (rentalhouseroom) REFERENCES rental_house_room(id) ON DELETE SET NULL;


--
-- TOC entry 3981 (class 2606 OID 263905)
-- Name: fk_b709215c4adad40b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_searcher
    ADD CONSTRAINT fk_b709215c4adad40b FOREIGN KEY (province) REFERENCES province(id) ON DELETE SET NULL;


--
-- TOC entry 3982 (class 2606 OID 263910)
-- Name: fk_b709215cb5bc1646; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_searcher
    ADD CONSTRAINT fk_b709215cb5bc1646 FOREIGN KEY (rentalhouse) REFERENCES rental_house(id) ON DELETE SET NULL;


--
-- TOC entry 3983 (class 2606 OID 263915)
-- Name: fk_b709215cbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_searcher
    ADD CONSTRAINT fk_b709215cbf396750 FOREIGN KEY (id) REFERENCES searcher(id) ON DELETE CASCADE;


--
-- TOC entry 3859 (class 2606 OID 263920)
-- Name: fk_ba346ec289f53c8; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY flights_airports
    ADD CONSTRAINT fk_ba346ec289f53c8 FOREIGN KEY (airport_id) REFERENCES airport(id) ON DELETE CASCADE;


--
-- TOC entry 3860 (class 2606 OID 263925)
-- Name: fk_ba346ec91f478c5; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY flights_airports
    ADD CONSTRAINT fk_ba346ec91f478c5 FOREIGN KEY (flight_id) REFERENCES flight(id) ON DELETE CASCADE;


--
-- TOC entry 3984 (class 2606 OID 263930)
-- Name: fk_bad7734b41850d80; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_searcher_rental_house_facility_type
    ADD CONSTRAINT fk_bad7734b41850d80 FOREIGN KEY (rental_house_facility_id) REFERENCES rental_house_facility_type(id);


--
-- TOC entry 3985 (class 2606 OID 263935)
-- Name: fk_bad7734bf6a4bf14; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_searcher_rental_house_facility_type
    ADD CONSTRAINT fk_bad7734bf6a4bf14 FOREIGN KEY (rental_house_room_searcher_id) REFERENCES rental_house_room_searcher(id);


--
-- TOC entry 3969 (class 2606 OID 263940)
-- Name: fk_baf18227bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room
    ADD CONSTRAINT fk_baf18227bf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3970 (class 2606 OID 263945)
-- Name: fk_baf18227fc3eb772; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room
    ADD CONSTRAINT fk_baf18227fc3eb772 FOREIGN KEY (rental_house) REFERENCES rental_house(id);


--
-- TOC entry 3765 (class 2606 OID 263950)
-- Name: fk_bb9f6f8abf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_circuit
    ADD CONSTRAINT fk_bb9f6f8abf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3766 (class 2606 OID 263955)
-- Name: fk_bb9f6f8acf2182c8; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_circuit
    ADD CONSTRAINT fk_bb9f6f8acf2182c8 FOREIGN KEY (circuit_id) REFERENCES circuit(id);


--
-- TOC entry 3920 (class 2606 OID 263960)
-- Name: fk_bf8d558bbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_option_searcher
    ADD CONSTRAINT fk_bf8d558bbf396750 FOREIGN KEY (id) REFERENCES searcher(id) ON DELETE CASCADE;


--
-- TOC entry 3921 (class 2606 OID 263965)
-- Name: fk_bf8d558bde686795; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package_option_searcher
    ADD CONSTRAINT fk_bf8d558bde686795 FOREIGN KEY (package) REFERENCES package(id) ON DELETE SET NULL;


--
-- TOC entry 3962 (class 2606 OID 263970)
-- Name: fk_c10c41f85bd15c26; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_rental_house_owner
    ADD CONSTRAINT fk_c10c41f85bd15c26 FOREIGN KEY (rental_house_id) REFERENCES rental_house(id) ON DELETE CASCADE;


--
-- TOC entry 3963 (class 2606 OID 263975)
-- Name: fk_c10c41f8c8961719; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_rental_house_owner
    ADD CONSTRAINT fk_c10c41f8c8961719 FOREIGN KEY (rental_house_owner_id) REFERENCES rental_house_owner(id) ON DELETE CASCADE;


--
-- TOC entry 3893 (class 2606 OID 263980)
-- Name: fk_c1a3ad60729f519b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation
    ADD CONSTRAINT fk_c1a3ad60729f519b FOREIGN KEY (room) REFERENCES room(id);


--
-- TOC entry 3894 (class 2606 OID 263985)
-- Name: fk_c1a3ad60bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation
    ADD CONSTRAINT fk_c1a3ad60bf396750 FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3858 (class 2606 OID 263990)
-- Name: fk_c257e60eec141ef8; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY flight
    ADD CONSTRAINT fk_c257e60eec141ef8 FOREIGN KEY (airline) REFERENCES airline(id);


--
-- TOC entry 3801 (class 2606 OID 263995)
-- Name: fk_c2695d931d530028; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_circuitavailabilitys
    ADD CONSTRAINT fk_c2695d931d530028 FOREIGN KEY (circuit_availability_id) REFERENCES circuit_availability(id) ON DELETE CASCADE;


--
-- TOC entry 3802 (class 2606 OID 264000)
-- Name: fk_c2695d93cf2182c8; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_circuitavailabilitys
    ADD CONSTRAINT fk_c2695d93cf2182c8 FOREIGN KEY (circuit_id) REFERENCES circuit(id) ON DELETE CASCADE;


--
-- TOC entry 3814 (class 2606 OID 264005)
-- Name: fk_c7123ab1c017343; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuits_days_places
    ADD CONSTRAINT fk_c7123ab1c017343 FOREIGN KEY (circuit_day_id) REFERENCES circuit_day(id) ON DELETE CASCADE;


--
-- TOC entry 3815 (class 2606 OID 264010)
-- Name: fk_c7123ab1da6a219; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuits_days_places
    ADD CONSTRAINT fk_c7123ab1da6a219 FOREIGN KEY (place_id) REFERENCES place(id) ON DELETE CASCADE;


--
-- TOC entry 3810 (class 2606 OID 264015)
-- Name: fk_c742c32e1325f3a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_searcher
    ADD CONSTRAINT fk_c742c32e1325f3a6 FOREIGN KEY (circuit) REFERENCES circuit(id) ON DELETE SET NULL;


--
-- TOC entry 3811 (class 2606 OID 264020)
-- Name: fk_c742c32ebf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_searcher
    ADD CONSTRAINT fk_c742c32ebf396750 FOREIGN KEY (id) REFERENCES searcher(id) ON DELETE CASCADE;


--
-- TOC entry 3812 (class 2606 OID 264844)
-- Name: fk_c742c32eecb6bf02; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_searcher
    ADD CONSTRAINT fk_c742c32eecb6bf02 FOREIGN KEY (polofromid) REFERENCES polo(id);


--
-- TOC entry 3856 (class 2606 OID 264025)
-- Name: fk_c946eb261dd011e1; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_searcher_excursion_type
    ADD CONSTRAINT fk_c946eb261dd011e1 FOREIGN KEY (excursion_type_id) REFERENCES excursion_type(id);


--
-- TOC entry 3857 (class 2606 OID 264030)
-- Name: fk_c946eb26a8f8c223; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_searcher_excursion_type
    ADD CONSTRAINT fk_c946eb26a8f8c223 FOREIGN KEY (excursion_searcher_id) REFERENCES excursion_searcher(id);


--
-- TOC entry 3821 (class 2606 OID 264040)
-- Name: fk_ca57a1c7e25d857e; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY classification__tag
    ADD CONSTRAINT fk_ca57a1c7e25d857e FOREIGN KEY (context) REFERENCES classification__context(id);


--
-- TOC entry 3943 (class 2606 OID 264050)
-- Name: fk_cdfc7356d34a04ad; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY product_category
    ADD CONSTRAINT fk_cdfc7356d34a04ad FOREIGN KEY (product) REFERENCES product(id);


--
-- TOC entry 3937 (class 2606 OID 264055)
-- Name: fk_d34a04ad16db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY product
    ADD CONSTRAINT fk_d34a04ad16db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3938 (class 2606 OID 264060)
-- Name: fk_d34a04ad3b28f0c3; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY product
    ADD CONSTRAINT fk_d34a04ad3b28f0c3 FOREIGN KEY (product_increment) REFERENCES product_increment(id);


--
-- TOC entry 3939 (class 2606 OID 264065)
-- Name: fk_d34a04ad464ff655; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY product
    ADD CONSTRAINT fk_d34a04ad464ff655 FOREIGN KEY (cancelation_product) REFERENCES cancelation_product(id);


--
-- TOC entry 3940 (class 2606 OID 264070)
-- Name: fk_d34a04ad472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY product
    ADD CONSTRAINT fk_d34a04ad472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3941 (class 2606 OID 264075)
-- Name: fk_d34a04ad92c4739c; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY product
    ADD CONSTRAINT fk_d34a04ad92c4739c FOREIGN KEY (provider) REFERENCES provider(id);


--
-- TOC entry 3942 (class 2606 OID 264080)
-- Name: fk_d34a04ad9468df6f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY product
    ADD CONSTRAINT fk_d34a04ad9468df6f FOREIGN KEY (term_condition_product) REFERENCES term_condition_product(id);


--
-- TOC entry 3783 (class 2606 OID 264085)
-- Name: fk_d47131b216cc45c9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_item
    ADD CONSTRAINT fk_d47131b216cc45c9 FOREIGN KEY (pickupplace_id) REFERENCES place(id);


--
-- TOC entry 3784 (class 2606 OID 264090)
-- Name: fk_d47131b241714987; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_item
    ADD CONSTRAINT fk_d47131b241714987 FOREIGN KEY (dropoffplace_id) REFERENCES place(id);


--
-- TOC entry 3785 (class 2606 OID 264095)
-- Name: fk_d47131b29a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_item
    ADD CONSTRAINT fk_d47131b29a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 3886 (class 2606 OID 264100)
-- Name: fk_d4ef974a16db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY medical_program
    ADD CONSTRAINT fk_d4ef974a16db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3887 (class 2606 OID 264105)
-- Name: fk_d4ef974a472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY medical_program
    ADD CONSTRAINT fk_d4ef974a472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3961 (class 2606 OID 264110)
-- Name: fk_d7f770816db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_owner
    ADD CONSTRAINT fk_d7f770816db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 4019 (class 2606 OID 264115)
-- Name: fk_d918ce5e4034a3c0; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_colective_request
    ADD CONSTRAINT fk_d918ce5e4034a3c0 FOREIGN KEY (transfer) REFERENCES transfer_colective(id) ON DELETE CASCADE;


--
-- TOC entry 4020 (class 2606 OID 264120)
-- Name: fk_d918ce5ebf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_colective_request
    ADD CONSTRAINT fk_d918ce5ebf396750 FOREIGN KEY (id) REFERENCES request(id) ON DELETE CASCADE;


--
-- TOC entry 4021 (class 2606 OID 264125)
-- Name: fk_d918ce5ec257e60e; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_colective_request
    ADD CONSTRAINT fk_d918ce5ec257e60e FOREIGN KEY (flight) REFERENCES flight(id) ON DELETE SET NULL;


--
-- TOC entry 3831 (class 2606 OID 264130)
-- Name: fk_da23d4c54584665a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY documents_products
    ADD CONSTRAINT fk_da23d4c54584665a FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3832 (class 2606 OID 264135)
-- Name: fk_da23d4c5c33f7837; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY documents_products
    ADD CONSTRAINT fk_da23d4c5c33f7837 FOREIGN KEY (document_id) REFERENCES document(id) ON DELETE CASCADE;


--
-- TOC entry 3972 (class 2606 OID 264140)
-- Name: fk_dca38774729f519b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_item
    ADD CONSTRAINT fk_dca38774729f519b FOREIGN KEY (room) REFERENCES rental_house_room(id);


--
-- TOC entry 3973 (class 2606 OID 264145)
-- Name: fk_dca387749a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_item
    ADD CONSTRAINT fk_dca387749a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 3974 (class 2606 OID 264150)
-- Name: fk_dca38774b5bc1646; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_item
    ADD CONSTRAINT fk_dca38774b5bc1646 FOREIGN KEY (rentalhouse) REFERENCES rental_house(id);


--
-- TOC entry 3909 (class 2606 OID 264155)
-- Name: fk_de68679516db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package
    ADD CONSTRAINT fk_de68679516db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3910 (class 2606 OID 264160)
-- Name: fk_de6867952846bf7b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package
    ADD CONSTRAINT fk_de6867952846bf7b FOREIGN KEY (cancelation_packages) REFERENCES cancelation_product(id);


--
-- TOC entry 3911 (class 2606 OID 264165)
-- Name: fk_de6867953b28f0c3; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package
    ADD CONSTRAINT fk_de6867953b28f0c3 FOREIGN KEY (product_increment) REFERENCES product_increment(id);


--
-- TOC entry 3912 (class 2606 OID 264170)
-- Name: fk_de686795472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package
    ADD CONSTRAINT fk_de686795472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3913 (class 2606 OID 264175)
-- Name: fk_de686795994abc57; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY package
    ADD CONSTRAINT fk_de686795994abc57 FOREIGN KEY (term_condition_package) REFERENCES term_condition_product(id);


--
-- TOC entry 3767 (class 2606 OID 264180)
-- Name: fk_df619b76592af3ba; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_medical
    ADD CONSTRAINT fk_df619b76592af3ba FOREIGN KEY (medical_id) REFERENCES medical_service(id);


--
-- TOC entry 3768 (class 2606 OID 264185)
-- Name: fk_df619b76bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_medical
    ADD CONSTRAINT fk_df619b76bf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3876 (class 2606 OID 264190)
-- Name: fk_e01670416db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel_sales_agent
    ADD CONSTRAINT fk_e01670416db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3877 (class 2606 OID 264195)
-- Name: fk_e016704631066a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY hotel_sales_agent
    ADD CONSTRAINT fk_e016704631066a6 FOREIGN KEY (hotelid) REFERENCES hotel(id);


--
-- TOC entry 4004 (class 2606 OID 264200)
-- Name: fk_e19d9ad262602fa7; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_e19d9ad262602fa7 FOREIGN KEY (cartitem) REFERENCES cart_item(realid);


--
-- TOC entry 4005 (class 2606 OID 264205)
-- Name: fk_e19d9ad2a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_e19d9ad2a76ed395 FOREIGN KEY (user_id) REFERENCES duser(id) ON DELETE SET NULL;


--
-- TOC entry 4006 (class 2606 OID 264210)
-- Name: fk_e19d9ad2b4ac2222; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_e19d9ad2b4ac2222 FOREIGN KEY (servicemanagementstatus) REFERENCES service_management_status(id);


--
-- TOC entry 4007 (class 2606 OID 264215)
-- Name: fk_e19d9ad2e54bc005; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_e19d9ad2e54bc005 FOREIGN KEY (sale) REFERENCES sale(id);


--
-- TOC entry 3850 (class 2606 OID 264220)
-- Name: fk_e30b12ed9b08e72f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_request
    ADD CONSTRAINT fk_e30b12ed9b08e72f FOREIGN KEY (excursion) REFERENCES excursion(id) ON DELETE CASCADE;


--
-- TOC entry 3851 (class 2606 OID 264225)
-- Name: fk_e30b12edbf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_request
    ADD CONSTRAINT fk_e30b12edbf396750 FOREIGN KEY (id) REFERENCES request(id) ON DELETE CASCADE;


--
-- TOC entry 3977 (class 2606 OID 264230)
-- Name: fk_e38b57cb984cadac; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_rental_house_room_ocupations
    ADD CONSTRAINT fk_e38b57cb984cadac FOREIGN KEY (rental_house_room_id) REFERENCES rental_house_room(id) ON DELETE CASCADE;


--
-- TOC entry 3978 (class 2606 OID 264235)
-- Name: fk_e38b57cbb3d34300; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_rental_house_room_ocupations
    ADD CONSTRAINT fk_e38b57cbb3d34300 FOREIGN KEY (rental_house_room_ocupation_id) REFERENCES rental_house_room_ocupation(id) ON DELETE CASCADE;


--
-- TOC entry 3944 (class 2606 OID 264240)
-- Name: fk_e3ab5a2c4584665a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY products_tags
    ADD CONSTRAINT fk_e3ab5a2c4584665a FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE;


--
-- TOC entry 3945 (class 2606 OID 264245)
-- Name: fk_e3ab5a2cbad26311; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY products_tags
    ADD CONSTRAINT fk_e3ab5a2cbad26311 FOREIGN KEY (tag_id) REFERENCES tag(id) ON DELETE CASCADE;


--
-- TOC entry 4023 (class 2606 OID 264250)
-- Name: fk_e4970a3057759bb4; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_exclusive_item
    ADD CONSTRAINT fk_e4970a3057759bb4 FOREIGN KEY (pickupplace) REFERENCES place(id);


--
-- TOC entry 4024 (class 2606 OID 264255)
-- Name: fk_e4970a309a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_exclusive_item
    ADD CONSTRAINT fk_e4970a309a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 4025 (class 2606 OID 264260)
-- Name: fk_e4970a30abbf655d; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_exclusive_item
    ADD CONSTRAINT fk_e4970a30abbf655d FOREIGN KEY (dropoffplace) REFERENCES place(id);


--
-- TOC entry 4026 (class 2606 OID 264265)
-- Name: fk_e4970a30c257e60e; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_exclusive_item
    ADD CONSTRAINT fk_e4970a30c257e60e FOREIGN KEY (flight) REFERENCES flight(id);


--
-- TOC entry 4056 (class 2606 OID 264828)
-- Name: fk_e4e7d6e0a8f8c223; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_searcher_excursion_place
    ADD CONSTRAINT fk_e4e7d6e0a8f8c223 FOREIGN KEY (excursion_searcher_id) REFERENCES excursion_searcher(id);


--
-- TOC entry 4057 (class 2606 OID 264833)
-- Name: fk_e4e7d6e0b3752e94; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY excursion_searcher_excursion_place
    ADD CONSTRAINT fk_e4e7d6e0b3752e94 FOREIGN KEY (excursion_place_id) REFERENCES place(id);


--
-- TOC entry 3999 (class 2606 OID 264270)
-- Name: fk_e54bc00519eb6921; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY sale
    ADD CONSTRAINT fk_e54bc00519eb6921 FOREIGN KEY (client_id) REFERENCES duser(id);


--
-- TOC entry 4000 (class 2606 OID 264275)
-- Name: fk_e54bc0056bac85cb; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY sale
    ADD CONSTRAINT fk_e54bc0056bac85cb FOREIGN KEY (market) REFERENCES market(id) ON DELETE SET NULL;


--
-- TOC entry 4001 (class 2606 OID 264280)
-- Name: fk_e54bc005d677b63c; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY sale
    ADD CONSTRAINT fk_e54bc005d677b63c FOREIGN KEY (curency) REFERENCES currency(id);


--
-- TOC entry 4058 (class 2606 OID 264865)
-- Name: fk_e88cb75bc3c6f69f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY car_season
    ADD CONSTRAINT fk_e88cb75bc3c6f69f FOREIGN KEY (car_id) REFERENCES car(id);


--
-- TOC entry 3757 (class 2606 OID 264285)
-- Name: fk_ec141ef816db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY airline
    ADD CONSTRAINT fk_ec141ef816db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3758 (class 2606 OID 264290)
-- Name: fk_ec141ef8472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY airline
    ADD CONSTRAINT fk_ec141ef8472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 4003 (class 2606 OID 264295)
-- Name: fk_f0e45ba9631066a6; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY season
    ADD CONSTRAINT fk_f0e45ba9631066a6 FOREIGN KEY (hotelid) REFERENCES hotel(id);


--
-- TOC entry 3794 (class 2606 OID 264300)
-- Name: fk_f0fe2527d34a04ad; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY cart_item
    ADD CONSTRAINT fk_f0fe2527d34a04ad FOREIGN KEY (product) REFERENCES product(id);


--
-- TOC entry 3829 (class 2606 OID 264305)
-- Name: fk_f22c4e38c33f7837; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY documents_packages
    ADD CONSTRAINT fk_f22c4e38c33f7837 FOREIGN KEY (document_id) REFERENCES document(id) ON DELETE CASCADE;


--
-- TOC entry 3830 (class 2606 OID 264310)
-- Name: fk_f22c4e38f44cabff; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY documents_packages
    ADD CONSTRAINT fk_f22c4e38f44cabff FOREIGN KEY (package_id) REFERENCES package(id) ON DELETE CASCADE;


--
-- TOC entry 3892 (class 2606 OID 264315)
-- Name: fk_f4a5ba9d9a4d22d9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY medical_service_item
    ADD CONSTRAINT fk_f4a5ba9d9a4d22d9 FOREIGN KEY (realid) REFERENCES cart_item(realid) ON DELETE CASCADE;


--
-- TOC entry 3813 (class 2606 OID 264320)
-- Name: fk_f52769cccf2182c8; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY circuit_season
    ADD CONSTRAINT fk_f52769cccf2182c8 FOREIGN KEY (circuit_id) REFERENCES circuit(id);


--
-- TOC entry 3971 (class 2606 OID 264325)
-- Name: fk_f684df98baf18227; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_room_availability
    ADD CONSTRAINT fk_f684df98baf18227 FOREIGN KEY (rental_house_room) REFERENCES rental_house_room(id);


--
-- TOC entry 4030 (class 2606 OID 264330)
-- Name: fk_f6ae25e54034a3c0; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_searcher
    ADD CONSTRAINT fk_f6ae25e54034a3c0 FOREIGN KEY (transfer) REFERENCES transfer(id) ON DELETE SET NULL;


--
-- TOC entry 4031 (class 2606 OID 264335)
-- Name: fk_f6ae25e548862324; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_searcher
    ADD CONSTRAINT fk_f6ae25e548862324 FOREIGN KEY (polofrom) REFERENCES polo(id) ON DELETE SET NULL;


--
-- TOC entry 4032 (class 2606 OID 264340)
-- Name: fk_f6ae25e55a74863; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_searcher
    ADD CONSTRAINT fk_f6ae25e55a74863 FOREIGN KEY (poloto) REFERENCES polo(id) ON DELETE SET NULL;


--
-- TOC entry 4033 (class 2606 OID 264345)
-- Name: fk_f6ae25e55bb10f94; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_searcher
    ADD CONSTRAINT fk_f6ae25e55bb10f94 FOREIGN KEY (placeto) REFERENCES place(id) ON DELETE SET NULL;


--
-- TOC entry 4034 (class 2606 OID 264350)
-- Name: fk_f6ae25e5bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_searcher
    ADD CONSTRAINT fk_f6ae25e5bf396750 FOREIGN KEY (id) REFERENCES searcher(id) ON DELETE CASCADE;


--
-- TOC entry 4035 (class 2606 OID 264355)
-- Name: fk_f6ae25e5fbc3de7b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_searcher
    ADD CONSTRAINT fk_f6ae25e5fbc3de7b FOREIGN KEY (placefrom) REFERENCES place(id) ON DELETE SET NULL;


--
-- TOC entry 3966 (class 2606 OID 264360)
-- Name: fk_f7cc52a027302f0f; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_request
    ADD CONSTRAINT fk_f7cc52a027302f0f FOREIGN KEY (rentalhouseroom) REFERENCES rental_house_room(id) ON DELETE CASCADE;


--
-- TOC entry 3967 (class 2606 OID 264365)
-- Name: fk_f7cc52a0b5bc1646; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_request
    ADD CONSTRAINT fk_f7cc52a0b5bc1646 FOREIGN KEY (rentalhouse) REFERENCES rental_house(id) ON DELETE CASCADE;


--
-- TOC entry 3968 (class 2606 OID 264370)
-- Name: fk_f7cc52a0bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house_request
    ADD CONSTRAINT fk_f7cc52a0bf396750 FOREIGN KEY (id) REFERENCES request(id) ON DELETE CASCADE;


--
-- TOC entry 3898 (class 2606 OID 264375)
-- Name: fk_f8033af41db5abff; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher
    ADD CONSTRAINT fk_f8033af41db5abff FOREIGN KEY (polo) REFERENCES polo(id);


--
-- TOC entry 3899 (class 2606 OID 264380)
-- Name: fk_f8033af43535ed9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher
    ADD CONSTRAINT fk_f8033af43535ed9 FOREIGN KEY (hotel) REFERENCES hotel(id);


--
-- TOC entry 3900 (class 2606 OID 264385)
-- Name: fk_f8033af44adad40b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher
    ADD CONSTRAINT fk_f8033af44adad40b FOREIGN KEY (province) REFERENCES province(id);


--
-- TOC entry 3901 (class 2606 OID 264390)
-- Name: fk_f8033af4729f519b; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher
    ADD CONSTRAINT fk_f8033af4729f519b FOREIGN KEY (room) REFERENCES room(id);


--
-- TOC entry 3902 (class 2606 OID 264395)
-- Name: fk_f8033af49bfcd030; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher
    ADD CONSTRAINT fk_f8033af49bfcd030 FOREIGN KEY (hoteltype) REFERENCES hotel_type(id);


--
-- TOC entry 3903 (class 2606 OID 264400)
-- Name: fk_f8033af4b10218ca; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher
    ADD CONSTRAINT fk_f8033af4b10218ca FOREIGN KEY (chain) REFERENCES chain(id);


--
-- TOC entry 3904 (class 2606 OID 264405)
-- Name: fk_f8033af4bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY ocupation_searcher
    ADD CONSTRAINT fk_f8033af4bf396750 FOREIGN KEY (id) REFERENCES searcher(id) ON DELETE CASCADE;


--
-- TOC entry 3771 (class 2606 OID 264410)
-- Name: fk_f902d8d8bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaign_transfer_colective
    ADD CONSTRAINT fk_f902d8d8bf396750 FOREIGN KEY (id) REFERENCES campaign(id) ON DELETE CASCADE;


--
-- TOC entry 3878 (class 2606 OID 264415)
-- Name: fk_face33a4711638b3; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY kid_policy
    ADD CONSTRAINT fk_face33a4711638b3 FOREIGN KEY (hotelprice_id) REFERENCES hotel_price(id);


--
-- TOC entry 3879 (class 2606 OID 264420)
-- Name: fk_face33a47ae03e27; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY kid_policy
    ADD CONSTRAINT fk_face33a47ae03e27 FOREIGN KEY (ocupation_id) REFERENCES ocupation(id);


--
-- TOC entry 3880 (class 2606 OID 264608)
-- Name: fk_face33a4eeb1c649; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY kid_policy
    ADD CONSTRAINT fk_face33a4eeb1c649 FOREIGN KEY (campaignhotel_id) REFERENCES campaign_hotel(id);


--
-- TOC entry 3951 (class 2606 OID 264425)
-- Name: fk_fc3eb77216db4f89; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house
    ADD CONSTRAINT fk_fc3eb77216db4f89 FOREIGN KEY (picture) REFERENCES media__media(id);


--
-- TOC entry 3952 (class 2606 OID 264430)
-- Name: fk_fc3eb7723b28f0c3; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house
    ADD CONSTRAINT fk_fc3eb7723b28f0c3 FOREIGN KEY (product_increment) REFERENCES product_increment(id);


--
-- TOC entry 3953 (class 2606 OID 264435)
-- Name: fk_fc3eb772472b783a; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house
    ADD CONSTRAINT fk_fc3eb772472b783a FOREIGN KEY (gallery) REFERENCES media__gallery(id);


--
-- TOC entry 3954 (class 2606 OID 264440)
-- Name: fk_fc3eb772a0ebc007; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house
    ADD CONSTRAINT fk_fc3eb772a0ebc007 FOREIGN KEY (zone) REFERENCES zone(id);


--
-- TOC entry 3955 (class 2606 OID 264445)
-- Name: fk_fc3eb772cc754692; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house
    ADD CONSTRAINT fk_fc3eb772cc754692 FOREIGN KEY (term_condition_house) REFERENCES term_condition_product(id);


--
-- TOC entry 3956 (class 2606 OID 264450)
-- Name: fk_fc3eb772f99f469; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rental_house
    ADD CONSTRAINT fk_fc3eb772f99f469 FOREIGN KEY (cancelation_house) REFERENCES cancelation_product(id);


--
-- TOC entry 3989 (class 2606 OID 264455)
-- Name: fk_fd3e8a4c6dca30a9; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rentalhouseroomsearcher_type
    ADD CONSTRAINT fk_fd3e8a4c6dca30a9 FOREIGN KEY (id_typehouse) REFERENCES rental_house_type(id);


--
-- TOC entry 3990 (class 2606 OID 264460)
-- Name: fk_fd3e8a4cee3a70bf; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY rentalhouseroomsearcher_type
    ADD CONSTRAINT fk_fd3e8a4cee3a70bf FOREIGN KEY (id_rentalhouseroomsearcher) REFERENCES rental_house_room_searcher(id);


--
-- TOC entry 4027 (class 2606 OID 264465)
-- Name: fk_ff5613e84034a3c0; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_exclusive_request
    ADD CONSTRAINT fk_ff5613e84034a3c0 FOREIGN KEY (transfer) REFERENCES transfer_exclusive(id) ON DELETE CASCADE;


--
-- TOC entry 4028 (class 2606 OID 264470)
-- Name: fk_ff5613e8bf396750; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_exclusive_request
    ADD CONSTRAINT fk_ff5613e8bf396750 FOREIGN KEY (id) REFERENCES request(id) ON DELETE CASCADE;


--
-- TOC entry 4029 (class 2606 OID 264475)
-- Name: fk_ff5613e8c257e60e; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY transfer_exclusive_request
    ADD CONSTRAINT fk_ff5613e8c257e60e FOREIGN KEY (flight) REFERENCES flight(id) ON DELETE CASCADE;


--
-- TOC entry 4045 (class 2606 OID 264539)
-- Name: fk_fff52f732666d333; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaignrantalhouses_rentalhouserooms
    ADD CONSTRAINT fk_fff52f732666d333 FOREIGN KEY (campaign_rental_house_id) REFERENCES campaign_rental_house(id) ON DELETE CASCADE;


--
-- TOC entry 4044 (class 2606 OID 264534)
-- Name: fk_fff52f73984cadac; Type: FK CONSTRAINT; Schema: public; Owner: daiqui6_postgres
--

ALTER TABLE ONLY campaignrantalhouses_rentalhouserooms
    ADD CONSTRAINT fk_fff52f73984cadac FOREIGN KEY (rental_house_room_id) REFERENCES rental_house_room(id) ON DELETE CASCADE;


--
-- TOC entry 4432 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-03-27 15:12:53 CDT

--
-- PostgreSQL database dump complete
--

