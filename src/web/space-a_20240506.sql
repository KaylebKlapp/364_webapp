--
-- PostgreSQL database dump
--

-- Dumped from database version 14.11 (Ubuntu 14.11-0ubuntu0.22.04.1)
-- Dumped by pg_dump version 14.11 (Ubuntu 14.11-0ubuntu0.22.04.1)

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
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


--
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';


--
-- Name: verify(bigint, text); Type: FUNCTION; Schema: public; Owner: student
--

CREATE FUNCTION public.verify(dodid bigint, user_password text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
	declare
	verified integer;
	admin integer;
	begin
		select 1 into verified from people where DoD_ID=DoD_ID and 
			user_password=crypt(user_password, password);
		select 2 into admin from people where dodid=DoD_ID and
			pwd=crypt(password, pwd) and people.admin = TRUE;
	
		return coalesce(admin, verified, 0);
	end;
$$;


ALTER FUNCTION public.verify(dodid bigint, user_password text) OWNER TO student;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: airport; Type: TABLE; Schema: public; Owner: student
--

CREATE TABLE public.airport (
    "airport_ID" integer NOT NULL,
    airport_location character varying(255) NOT NULL
);


ALTER TABLE public.airport OWNER TO student;

--
-- Name: flight; Type: TABLE; Schema: public; Owner: student
--

CREATE TABLE public.flight (
    "flight_ID" integer NOT NULL,
    "plane_ID" integer NOT NULL,
    "from_airport_ID" integer NOT NULL,
    "to_airport_ID" integer NOT NULL,
    maximum_seats integer NOT NULL,
    departure_date_time time with time zone NOT NULL
);


ALTER TABLE public.flight OWNER TO student;

--
-- Name: people; Type: TABLE; Schema: public; Owner: student
--

CREATE TABLE public.people (
    "DoD_ID" bigint NOT NULL,
    last_name character varying(255) NOT NULL,
    pwd character varying(255) DEFAULT 1096 NOT NULL,
    admin boolean DEFAULT false NOT NULL
);


ALTER TABLE public.people OWNER TO student;

--
-- Name: plane; Type: TABLE; Schema: public; Owner: student
--

CREATE TABLE public.plane (
    "plane_ID" integer NOT NULL,
    "unit_ID" integer NOT NULL,
    active boolean NOT NULL,
    model character varying(255) NOT NULL
);


ALTER TABLE public.plane OWNER TO student;

--
-- Name: reservation; Type: TABLE; Schema: public; Owner: student
--

CREATE TABLE public.reservation (
    "DoD_ID" bigint NOT NULL,
    "flight_ID" integer NOT NULL,
    priority integer NOT NULL
);


ALTER TABLE public.reservation OWNER TO student;

--
-- Name: unit; Type: TABLE; Schema: public; Owner: student
--

CREATE TABLE public.unit (
    "unit_ID" integer NOT NULL,
    "airport_ID" integer NOT NULL,
    "POC_DoD_ID" bigint NOT NULL,
    unit_name character varying(255) NOT NULL
);


ALTER TABLE public.unit OWNER TO student;

--
-- Data for Name: airport; Type: TABLE DATA; Schema: public; Owner: student
--

COPY public.airport ("airport_ID", airport_location) FROM stdin;
0	Eglin AFB, FL, USA
1	Nellis AFB, NV, USA
2	Laughlin AFB, TX, USA
3	Columbus AFB, MS, USA
4	Holloman AFB, NM, USA
5	Whiteman AFB, MO, USA
6	Kadena AB, Okinawa, Japan
7	Ramstein AB, Rhineland-Palatinate, Germany
8	Incirlik AB, Adana, Turkey
9	Osan AB, Pyeongtaek, South Korea
10	RAF Mildenhall, Suffolk, England
11	Andersen AFB, Yigo, Guam
12	Misawa AB, Aomori, Japan
13	Aviano AB, Friuli Venezia Giulia, Italy
\.


--
-- Data for Name: flight; Type: TABLE DATA; Schema: public; Owner: student
--

COPY public.flight ("flight_ID", "plane_ID", "from_airport_ID", "to_airport_ID", maximum_seats, departure_date_time) FROM stdin;
0	0	0	1	10	09:30:00-07
1	0	0	4	10	12:30:00-07
2	0	0	3	10	15:30:00-07
3	0	0	3	10	18:30:00-07
4	1	1	2	10	19:45:00-07
5	1	2	3	10	07:00:00-07
6	1	3	4	10	14:00:00-07
7	2	4	5	10	10:15:00-07
8	2	5	6	10	08:30:00-07
9	3	6	7	10	16:45:00-07
10	3	7	8	10	11:00:00-07
11	4	8	9	10	13:30:00-07
\.


--
-- Data for Name: people; Type: TABLE DATA; Schema: public; Owner: student
--

COPY public.people ("DoD_ID", last_name, pwd, admin) FROM stdin;
1010101001	obrien	$1$TEhgLbU2$E5pKEwy2OVq9Yj.J6kjkB/	f
1010101011	obrien	$1$JLKcpYS6$xCouFBwyLU0q8PtNHFE0U/	f
1096109600	admin	$1$akPU169S$eBvr/GfJjOvyhvwLTkgmZ0	t
1234567890	Last0	$1$5Z1bU7dU$l0Xl.h/p9yzMohDkJ1dDp1	f
2345678901	Last1	$1$iC4QKAFl$3i.LsMR2x/5p0xW2vgPy01	f
3456789012	Last2	$1$l.cDgbX4$dDFu1T0tUbWw3vROh9GiQ1	f
4567890123	Last3	$1$sxBBcjqT$NTxPUY/aw89NQRyU8aUs7.	f
5678901234	Last4	$1$5hQhUIyT$3H0NcF7mOLCZxMryKxGGn1	f
6789012345	Last5	$1$fLyDZzPA$O5rsiY0RhjPxl9bdY8odp1	f
7890123456	Last6	$1$cPMRNhgN$qJZ9YyOMWRfo6fIOhVx4s0	f
8901234567	Last7	$1$p9Ygvtgo$V0S.zFCPKFc5ON8yCx1Jc/	f
9012345678	Last8	$1$8jB6XHE5$MpnNZYDo8zc.jyv4Kckc.0	f
1113456789	Last9	$1$OyVpVycb$JGWGWPpUpLSJ05hzfy3Xl0	f
\.


--
-- Data for Name: plane; Type: TABLE DATA; Schema: public; Owner: student
--

COPY public.plane ("plane_ID", "unit_ID", active, model) FROM stdin;
0	0	t	KC130
1	0	t	KC130
2	0	t	KC130
3	1	t	KC10
4	1	t	KC10
5	2	t	C5
6	2	f	C5
7	3	f	F-16
8	3	t	F-16
9	4	t	F-22
10	4	f	F-22
11	5	t	B-52
12	5	f	B-52
13	6	t	A-10
14	6	t	A-10
15	7	t	F-35
16	7	f	F-35
\.


--
-- Data for Name: reservation; Type: TABLE DATA; Schema: public; Owner: student
--

COPY public.reservation ("DoD_ID", "flight_ID", priority) FROM stdin;
2345678901	2	2
2345678901	3	1
3456789012	4	3
4567890123	5	4
5678901234	6	2
6789012345	7	5
7890123456	8	3
8901234567	9	1
9012345678	10	4
2345678901	11	2
\.


--
-- Data for Name: unit; Type: TABLE DATA; Schema: public; Owner: student
--

COPY public.unit ("unit_ID", "airport_ID", "POC_DoD_ID", unit_name) FROM stdin;
0	0	1234567890	Aerial Refuel Sq 1
1	0	1234567890	Aerial Refuel Sq 2
2	1	1234567890	Cargo Squadron
3	1	2345678901	Cargo Squadron 2
4	2	2345678901	Fighter Squadron 1
5	2	2345678901	Fighter Squadron 2
6	3	3456789012	Transport Squadron 1
7	3	3456789012	Transport Squadron 2
8	4	3456789012	Attack Squadron 1
9	4	4567890123	Attack Squadron 2
10	5	4567890123	Bomber Squadron 1
11	5	4567890123	Bomber Squadron 2
12	6	4567890123	Reconnaissance Squadron 1
13	6	4567890123	Reconnaissance Squadron 2
\.


--
-- Name: reservation DoD and Flight IDs; Type: CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT "DoD and Flight IDs" PRIMARY KEY ("DoD_ID", "flight_ID");


--
-- Name: people DoD_ID; Type: CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.people
    ADD CONSTRAINT "DoD_ID" PRIMARY KEY ("DoD_ID");


--
-- Name: airport airport_ID; Type: CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.airport
    ADD CONSTRAINT "airport_ID" PRIMARY KEY ("airport_ID");


--
-- Name: flight flight_ID; Type: CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.flight
    ADD CONSTRAINT "flight_ID" PRIMARY KEY ("flight_ID");


--
-- Name: plane plane_ID; Type: CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.plane
    ADD CONSTRAINT "plane_ID" PRIMARY KEY ("plane_ID");


--
-- Name: unit unit_ID; Type: CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.unit
    ADD CONSTRAINT "unit_ID" PRIMARY KEY ("unit_ID");


--
-- Name: reservation DoD_ID; Type: FK CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT "DoD_ID" FOREIGN KEY ("DoD_ID") REFERENCES public.people("DoD_ID") ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: unit POC_DoD_ID; Type: FK CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.unit
    ADD CONSTRAINT "POC_DoD_ID" FOREIGN KEY ("POC_DoD_ID") REFERENCES public.people("DoD_ID") ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: unit airport_ID; Type: FK CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.unit
    ADD CONSTRAINT "airport_ID" FOREIGN KEY ("airport_ID") REFERENCES public.airport("airport_ID") ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: reservation flight_ID; Type: FK CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT "flight_ID" FOREIGN KEY ("flight_ID") REFERENCES public.flight("flight_ID") ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: flight from_airport_ID; Type: FK CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.flight
    ADD CONSTRAINT "from_airport_ID" FOREIGN KEY ("from_airport_ID") REFERENCES public.airport("airport_ID") ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: flight plane_ID; Type: FK CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.flight
    ADD CONSTRAINT "plane_ID" FOREIGN KEY ("plane_ID") REFERENCES public.plane("plane_ID") ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: flight to_airport_ID; Type: FK CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.flight
    ADD CONSTRAINT "to_airport_ID" FOREIGN KEY ("to_airport_ID") REFERENCES public.airport("airport_ID") ON UPDATE CASCADE ON DELETE RESTRICT NOT VALID;


--
-- Name: plane unit_ID; Type: FK CONSTRAINT; Schema: public; Owner: student
--

ALTER TABLE ONLY public.plane
    ADD CONSTRAINT "unit_ID" FOREIGN KEY ("unit_ID") REFERENCES public.unit("unit_ID") ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

